<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stripe;

use Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class AdvertisementController extends Controller {

	public function index()
    {
		if(empty(@$_GET['userId'])){
			echo 'userId is required.';exit();
		}

		if(empty(@$_GET['planId'])){
			echo 'planId is required.';exit();
		}

		if(empty(@$_GET['adsId'])){
			echo 'adsId is required.';exit();
		}


		$data['userId'] = $userId = @$_GET['userId'];
		//$data['amount']  = $amount = @$_GET['amount'];
		$data['adsId']  = $adsId = @$_GET['adsId'];
		$data['planId']  = $planId = @$_GET['planId'];

        $data['planInfo'] = $planInfo = DB::table('advertise_sub_plan')->where(['id' => $planId])->select('*')->orderBy('id', 'DESC')->first();

        if(@$_GET['preferredListing'] == 1){
			$preferredListing = DB::table('advertise_sub_plan')->where(['id' => $planId, 'preferred_listing' => @$_GET['preferredListing']])->select('preferred_listing', 'preferred_listing_price')->orderBy('id', 'DESC')->first();

			$preferred_listing_price = @$preferredListing->preferred_listing_price;
			$data['preferredListing'] = 'Yes';
		}else{
			$preferred_listing_price = 0;
			$data['preferredListing'] = 'No';
		}

		if(!empty(@$planInfo->discount) || @$planInfo->discount != 0){
			$percent = @$planInfo->discount;
			$discount_value = (@$planInfo->price / 100) * @$percent;
			$new_price = @$planInfo->price - $discount_value;
		}else{
			@$percent = 0;
			$new_price = @$planInfo->price;
		}

		if(@$_GET['duration']){
			$data['duration'] = @$_GET['duration'];
		}else{
			$data['duration'] = '';
		}

		$data['newprice'] = @$new_price + @$preferred_listing_price;
        $data['userInfo'] = DB::table('users')->where(['id' => $userId])->select('*')->orderBy('id', 'DESC')->first();
		return view('advertisepaymentpage', $data);
    }


	public function submit_advertisement_payment(Request $request) {
        $stripeDetails = DB::table('settings')->where('settingId','1')->select('*')->first();
        $stripePublishableKey = $stripeDetails->stripe_publishable_key;
        $stripeSecretKey = $stripeDetails->stripe_secret_key;
		require "vendor/stripe/stripe-php/init.php";
        if($request->stripeToken){
			$token            =  $request->stripeToken;
			$sub_id           =  $_POST['sub_id'];
			$sub_name         =  $_POST['sub_name'];
			$user_id          =  $_POST['user_id'];
			$amount           =  $_POST['amount'];
			$address          =  $_POST['card_address'];
			$country          =  $_POST['card_country'];
			$state            =  $_POST['card_state'];
			$city             =  $_POST['card_city'];
			$zipcode          =  $_POST['card_zipcode'];
			$card_name        =  $_POST['card_name'];
			$email            =  $_POST['email'];
			$itemPrice        =  $amount;
			$currency         =  'usd';
			$adsId            =  $_POST['adsId'];
			$preferredListing =  $_POST['preferredListing'];
			$duration         =  $_POST['duration'];

			$stripe = array(
				"secret_key"      => $stripe_secret_key,
				"publishable_key" => $stripe_publishable_key
			);

			\Stripe\Stripe::setApiKey($stripe['secret_key']);

			try {
				$customer = \Stripe\Customer::create(array(
					'email'  => $email,
					'source' => $token
				));
			} catch(Exception $e) {
				$api_error = $e->getMessage();
			}

			if(empty($api_error) && $customer)
			{
				$itemName = @$sub_name;
				$orderID  = "ORDNO-".$this->generate_otp(6);
				$itemPriceCents = ($itemPrice*100);

				try {
					$charge = \Stripe\Charge::create(array(
						'customer'    => @$customer->id,
						'amount'      => @$itemPriceCents,
						'currency'    => 'usd',
						'description' => @$itemName,
						'metadata' => array(
							'order_id' => @$orderID
						)
					));
				} catch(Exception $e) {
					$api_error = $e->getMessage();
				}

				//echo $api_error;die;

				if(empty($api_error) && $charge)
				{


					$chargeJson = $charge->jsonSerialize();
					if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)
					{
						$transactionID  = $chargeJson['balance_transaction'];
						$paidAmount     = $chargeJson['amount'];
						$paidAmount     = ($paidAmount/100);
						$paidCurrency   = $chargeJson['currency'];
						$payment_status = $chargeJson['status'];
						$chargeID       = $chargeJson['id'];
						$paymentDate    = date('Y-m-d H:i:s');
						//print_r($chargeJson);
						if($payment_status == 'succeeded')
						{



							$sub_info = DB::table('advertise_sub_plan')->where(['id' => @$sub_id])->select('*')->orderBy('id', 'DESC')->first();
							if($sub_info->plan_type == 'Monthly'){
								$current_period_start = date('Y-m-d');
								$current_period_end   = date('Y-m-d', strtotime($current_period_start. ' + '.@$sub_info->plan_duration.' month'));
							}elseif($sub_info->plan_type == 'Yearly'){
								$current_period_start = date('Y-m-d');
								$current_period_end   = date('Y-m-d', strtotime($current_period_start. ' + '.@$sub_info->plan_duration.' year'));
							}elseif($sub_info->plan_type == 'Daily'){
								$current_period_start = date('Y-m-d');
								$current_period_end   = date('Y-m-d', strtotime($current_period_start. ' + '.@$sub_info->plan_duration.' day'));
							}

							DB::table('advertise')->where(['id' => @$adsId])->update(['status' => 1]);

							$statusMsg = 'Your Payment has been Successful!';
							$data = ['user_name' => @$card_name, 'user_id' => @$user_id, 'address' => @$address, 'country' => @$country, 'state' => @$state, 'city' => @$city, 'zipcode' => @$zipcode, 'adv_sub_id' => @$sub_id, 'amount' => @$itemPrice, 'currency' => @$currency, 'txn_id' => @$transactionID, 'order_id' => @$orderID, 'charge_id' => @$chargeID, 'status' => @$payment_status, 'expiry_date' => @$current_period_end, 'payment_type' => '7', 'adv_id' => @$adsId, 'preferredListing' => @$preferredListing, 'duration' => @$duration, 'created_at' => @$paymentDate];

							$result = DB::table('transaction')->insertGetId($data);

							//return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$transactionID."&userId=".$user_id."");
							return redirect()->intended('dashboard')->with("status", "".$statusMsg."<br/>Transaction Id : ".$transactionID."");

						}else{
							$statusMsg = "Transaction has been failed!";
							$payment_status = 'failed';
							$txnId = '';
							//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
							//return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
							return redirect()->intended('dashboard')->with("error", "$statusMsg");
						}
					}else{
						$statusMsg = "Transaction has been failed!";
						$payment_status = 'failed';
						$txnId = '';
						//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
						//return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");

						//return redirect()->intended('dashboard')->with("error", "$statusMsg");
						return redirect()->intended('dashboard')->with("error", "$statusMsg");
					}
				}else{
					$statusMsg = "Charge creation failed! $api_error";
					$payment_status = 'failed';
					$txnId = '';
					//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id.""),'refresh');
					//return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
					return redirect()->intended('dashboard')->with("error", "$statusMsg");
				}
			}else{

				$statusMsg = "Invalid card details! $api_error";
				$payment_status = 'failed';
				$txnId = '';
				//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
				//return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
				return redirect()->intended('dashboard')->with("error", "$statusMsg");
			}
		}else{
			$statusMsg = "Error on form submission.";
			$payment_status = 'failed';
			$txnId = '';
			$userId = '';
			//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
			//return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId."");
			return redirect()->intended('dashboard')->with("error", "$statusMsg");
		}
	}

	public function generate_otp($length)
	{
		$characters = '123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++)
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}


}