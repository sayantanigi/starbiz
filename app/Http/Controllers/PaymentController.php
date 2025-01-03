<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//use Stripe;


class PaymentController extends Controller {


	public function __construct()
	{

	}

	public function paymentPage()
    {
		if(empty(@$_GET['userId'])){
			echo 'userId is required.';exit();
		}
		if(empty(@$_GET['amount'])){
			echo 'Amount is required.';exit();
		}
		if(empty(@$_GET['subId'])){
			echo 'subId is required.';exit();
		}

		$data['userId'] = $userId = @$_GET['userId'];
		$data['amount']  = $amount = @$_GET['amount'];
		$data['subId']  = $subId = @$_GET['subId'];

        $data['subInfo'] = DB::table('sub_plan')->where(['id' => $subId])->select('*')->orderBy('id', 'DESC')->first();
        $data['userInfo'] = DB::table('users')->where(['id' => $userId])->select('*')->orderBy('id', 'DESC')->first();
		return view('webviewpayment', $data);
    }

	public function web_view_stripe_payment(Request $request) {
        $stripeDetails = DB::table('settings')->where('settingId','1')->select('*')->first();
        $stripePublishableKey = $stripeDetails->stripe_publishable_key;
        $stripeSecretKey = $stripeDetails->stripe_secret_key;
		require "vendor/stripe/stripe-php/init.php";
        if($request->stripeToken){
			$token     = $request->stripeToken;
			$sub_id    =  $_POST['sub_id'];
			$sub_name  =  $_POST['sub_name'];
			$user_id   =  $_POST['user_id'];
			$amount    =  $_POST['amount'];
			$address   =  $_POST['card_address'];
			$country   =  $_POST['card_country'];
			$state     =  $_POST['card_state'];
			$city      =  $_POST['card_city'];
			$zipcode   =  $_POST['card_zipcode'];
			$card_name =  $_POST['card_name'];
			$email     =  $_POST['email'];
			$itemPrice =  $amount;
			$currency  =  'usd';

			$stripe = array(
				"secret_key"      => $stripeSecretKey,
				"publishable_key" => $stripePublishableKey
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

				/*try {
					$charge = \Stripe\Charge::create(array(
						'customer' => $customer->id,
						'amount'   => $itemPriceCents,
						'currency' => 'usd',
						'description' => $itemName,
						'metadata' => array(
							'order_id' => $orderID
						)
					));
				} catch(Exception $e) {
					$api_error = $e->getMessage();
				}*/

				//echo $api_error;die;

				$subInfo  = DB::table('sub_plan')->where(['id' => $sub_id])->select('*')->orderBy('id', 'DESC')->first();
				$stripeSubId = '';
				if(!empty(@$subInfo)){
					if(!empty(@$subInfo->stripe_plan_id)){
						try {
							$subscription = \Stripe\Subscription::create(array(
								"customer" => $customer->id,
								"items" => array(
									array(
										"plan" => @$subInfo->stripe_plan_id,
									),
								),
							));
							$stripeSubId = @$subscription['id'];
						}catch(Exception $e) {
							$api_error = $e->getMessage();
						}
					}
				}
				if(empty($api_error) && $subscription)
				{


					$subsData = $subscription->jsonSerialize();
					if($subsData['status'] == 'active')
					{
						/*$transactionID  =  $chargeJson['balance_transaction'];
						$paidAmount     =  $chargeJson['amount'];
						$paidAmount     =  ($paidAmount/100);
						$paidCurrency   =  $chargeJson['currency'];
						$payment_status =  $chargeJson['status'];
						$chargeID       =  $chargeJson['id'];
						$paymentDate    =  date('Y-m-d H:i:s');*/

						$transactionID = $subscrID = $subsData['id'];
						$custID = $subsData['customer'];
						$planID = $subsData['plan']['id'];
						$planAmount = ($subsData['plan']['amount']/100);
						$planCurrency = $subsData['plan']['currency'];
						$planinterval = $subsData['plan']['interval'];
						$planIntervalCount = $subsData['plan']['interval_count'];
						$paymentDate    =  date('Y-m-d H:i:s');
						$payment_status = 'succeeded';
						$chargeID = '';

						//print_r($chargeJson);
						if($payment_status == 'succeeded')
						{

							$sub_info = DB::table('sub_plan')->where(['id' => @$sub_id])->select('*')->orderBy('id', 'DESC')->first();
							if($sub_info->type == 1){
								$current_period_start = date('Y-m-d');
								$current_period_end = date('Y-m-d', strtotime($current_period_start. ' + '.@$sub_info->duration.' month'));
							}else{
								$current_period_start = date('Y-m-d');
								$current_period_end = date('Y-m-d', strtotime($current_period_start. ' + '.@$sub_info->duration.' year'));
							}

							$statusMsg = 'Your Payment has been Successful!';
							$data = ['user_name' => @$card_name, 'user_id' => @$user_id, 'address' => @$address, 'country' => @$country, 'state' => @$state, 'city' => @$city, 'zipcode' => @$zipcode, 'sub_id' => @$sub_id, 'amount' => @$itemPrice, 'currency' => @$currency, 'txn_id' => @$transactionID, 'order_id' => @$orderID, 'charge_id' => @$chargeID, 'status' => @$payment_status, 'expiry_date' => @$current_period_end, 'payment_type' => '1', 'created_at' => @$paymentDate];

							$result = DB::table('transaction')->insertGetId($data);
							//return redirect()->intended('admin/users')->with("status", "Your Payment has been Successful!");
							//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$vendortxndata->tranId."&userId=".$userId.""),'refresh');
							return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$transactionID."&userId=".$user_id."");

						}else{
							$statusMsg = "Transaction has been failed!";
							$payment_status = 'failed';
							$txnId = '';
							//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
							return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
						}
					}else{
						$statusMsg = "Transaction has been failed!";
						$payment_status = 'failed';
						$txnId = '';
						//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
						return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
					}
				}else{

					$statusMsg = "Subscription creation failed! ".$api_error;
					$payment_status = 'failed';
					$txnId = '';
				    //redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id.""),'refresh');
					return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
				}
			}else{

				$statusMsg = "Invalid card details! $api_error";
				$payment_status = 'failed';
				$txnId = '';
				//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
				return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
			}
		}else{
			$statusMsg = "Error on form submission.";
			$payment_status = 'failed';
			$txnId = '';
			$userId = '';
			//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
			return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId."");

		}
	}

	public function paymentStatus()
    {
        echo "<br>".$statusMsg = @$_GET['statusMsg']."<br>";
        echo "Status : "."<br>".$status = @$_GET['status']."<br>";
        echo "txnId : "."<br>".$txnId = @$_GET['txnId']."<br>";
        echo "userId :"."<br>".$payId = @$_GET['userId'];
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

	public function promotionPaymentPage()
    {
		if(empty(@$_GET['userId'])){
			echo 'userId is required.';exit();
		}
		// if(empty(@$_GET['amount'])){
			// echo 'Amount is required.';exit();
		// }
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

        $data['planInfo'] = $planInfo = DB::table('ads_sub_plan')->where(['id' => $planId])->select('*')->orderBy('id', 'DESC')->first();

        if(@$_GET['preferredListing'] == 1){
			$preferredListing = DB::table('ads_sub_plan')->where(['id' => $planId, 'preferred_listing' => @$_GET['preferredListing']])->select('preferred_listing', 'preferred_listing_price')->orderBy('id', 'DESC')->first();


			if(!empty(@$preferredListing->preferred_listing_price)){
				$preferred_listing_price = @$preferredListing->preferred_listing_price;
			}else{
				$preferred_listing_price =0;
			}
			$data['preferredListing'] = 'Yes';
		}else{
			$preferred_listing_price = 0;
			$data['preferredListing'] = 'No';
		}

		//echo $preferred_listing_price;die;

		if(!empty(@$planInfo->discount) || @$planInfo->discount != 0){
			$percent = $planInfo->discount;
			$discount_value = ($planInfo->price / 100) * $percent;
			$new_price = $planInfo->price - $discount_value;
		}else{
			$percent = 0;
			$new_price = $planInfo->price;
		}

		if(@$_GET['duration']){
			$data['duration'] = @$_GET['duration'];
		}else{
			$data['duration'] = '';
		}

		$data['newprice'] = $new_price + $preferred_listing_price;
        $data['userInfo'] = DB::table('users')->where(['id' => $userId])->select('*')->orderBy('id', 'DESC')->first();
		return view('promotionwebviewpayment', $data);
    }

	public function promotion_web_view_stripe_payment(Request $request) {
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
				"secret_key"      => $stripeSecretKey,
				"publishable_key" => $stripePublishableKey
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
						'customer'    => $customer->id,
						'amount'      => $itemPriceCents,
						'currency'    => 'usd',
						'description' => $itemName,
						'metadata' => array(
							'order_id' => $orderID
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



							$sub_info = DB::table('ads_sub_plan')->where(['id' => @$sub_id])->select('*')->orderBy('id', 'DESC')->first();
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

							DB::table('promotion')->where(['id' => $adsId])->update(['status' => 1]);

							$statusMsg = 'Your Payment has been Successful!';
							$data = ['user_name' => $card_name, 'user_id' => $user_id, 'address' => $address, 'country' => $country, 'state' => @$state, 'city' => @$city, 'zipcode' => $zipcode, 'sub_id' => @$sub_id, 'amount' => @$itemPrice, 'currency' => @$currency, 'txn_id' => $transactionID, 'order_id' => $orderID, 'charge_id' => $chargeID, 'status' => $payment_status, 'expiry_date' => $current_period_end, 'payment_type' => '2', 'promotion_id' => $adsId, 'preferredListing' => $preferredListing, 'duration' => $duration, 'created_at' => $paymentDate];

							$result = DB::table('transaction')->insertGetId($data);
							return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$transactionID."&userId=".$user_id."");

						}else{
							$statusMsg = "Transaction has been failed!";
							$payment_status = 'failed';
							$txnId = '';
							//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
							return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
						}
					}else{
						$statusMsg = "Transaction has been failed!";
						$payment_status = 'failed';
						$txnId = '';
						//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
						return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
					}
				}else{
					$statusMsg = "Charge creation failed! $api_error";
					$payment_status = 'failed';
					$txnId = '';
					//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id.""),'refresh');
					return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
				}
			}else{

				$statusMsg = "Invalid card details! $api_error";
				$payment_status = 'failed';
				$txnId = '';
				//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
				return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
			}
		}else{
			$statusMsg = "Error on form submission.";
			$payment_status = 'failed';
			$txnId = '';
			$userId = '';
			//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
			return redirect()->intended("webview/promotionpaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId."");

		}
	}
	public function promotionpaymentStatus()
    {
        echo "<br>".$statusMsg = @$_GET['statusMsg']."<br>";
        echo "Status : "."<br>".$status = @$_GET['status']."<br>";
        echo "txnId : "."<br>".$txnId = @$_GET['txnId']."<br>";
        echo "userId :"."<br>".$payId = @$_GET['userId'];
    }

    public function topupPaymentpage()
    {
		if(empty(@$_GET['userId'])){
			echo 'userId is required.';exit();
		}

		if(empty(@$_GET['amount'])){
			echo 'Amount is required.';exit();
		}

		$data['userId']  = $userId = @$_GET['userId'];
		$data['amount']  = $amount = @$_GET['amount'];



        $data['userInfo'] = DB::table('users')->where(['id' => $userId])->select('*')->orderBy('id', 'DESC')->first();
		return view('topuppayment', $data);
    }

    public function topup_web_view_stripe_payment(Request $request) {
        $stripeDetails = DB::table('settings')->where('settingId','1')->select('*')->first();
        $stripePublishableKey = $stripeDetails->stripe_publishable_key;
        $stripeSecretKey = $stripeDetails->stripe_secret_key;
		require "vendor/stripe/stripe-php/init.php";
        if($request->stripeToken){
			$token            =  $request->stripeToken;
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

			$stripe = array(
				"secret_key"      => $stripeSecretKey,
				"publishable_key" => $stripePublishableKey
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
				$itemName = 'Top Up Payment';
				$orderID  = "ORDNO-".$this->generate_otp(6);
				$itemPriceCents = ($itemPrice*100);

				try {
					$charge = \Stripe\Charge::create(array(
						'customer'    => $customer->id,
						'amount'      => $itemPriceCents,
						'currency'    => 'usd',
						'description' => $itemName,
						'metadata' => array(
							'order_id' => $orderID
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

                            $wallet = DB::table('users')->where(['id' => $user_id])->select('*')->orderBy('id', 'DESC')->first();
                            if(($wallet->wallet_amount == '') || ($wallet->wallet_amount == null)){
                                $walletAmount = 0;
                            }elseif($wallet->wallet_amount == 0){
                                $walletAmount = 0;
                            }elseif($wallet->wallet_amount > 0){
                                $walletAmount = $wallet->wallet_amount;
                            }


                            $WALLETAMOUNT = $walletAmount +	$itemPrice;

                            DB::table('users')->where(['id' => $user_id])->update(['wallet_amount' => $WALLETAMOUNT]);

							$statusMsg = 'Your Payment has been Successful!';
							$data = ['user_name' => $card_name, 'user_id' => $user_id, 'address' => $address, 'country' => $country, 'state' => @$state, 'city' => @$city, 'zipcode' => $zipcode, 'amount' => @$itemPrice, 'currency' => @$currency, 'txn_id' => $transactionID, 'order_id' => $orderID, 'charge_id' => $chargeID, 'status' => $payment_status, 'payment_type' => '3', 'created_at' => $paymentDate];
							$result = DB::table('transaction')->insertGetId($data);

                            $walletData = ['user_id' => $user_id, 'amount' => @$itemPrice, 'currency' => @$currency, 'txn_id' => $transactionID, 'order_id' => $orderID, 'charge_id' => $chargeID, 'status' => $payment_status, 'created_at' => $paymentDate, 'type' => '1'];
                            DB::table('wallet')->insertGetId($walletData);

							return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$transactionID."&userId=".$user_id."");

						}else{
							$statusMsg = "Transaction has been failed!";
							$payment_status = 'failed';
							$txnId = '';
							//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
							return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
						}
					}else{
						$statusMsg = "Transaction has been failed!";
						$payment_status = 'failed';
						$txnId = '';
						//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
						return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
					}
				}else{
					$statusMsg = "Charge creation failed! $api_error";
					$payment_status = 'failed';
					$txnId = '';
					//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id.""),'refresh');
					return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
				}
			}else{

				$statusMsg = "Invalid card details! $api_error";
				$payment_status = 'failed';
				$txnId = '';
				//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
				return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
			}
		}else{
			$statusMsg = "Error on form submission.";
			$payment_status = 'failed';
			$txnId = '';
			$userId = '';
			//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
			return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId."");

		}
	}

    public function topupPaymentStatus()
    {
        echo "<br>".$statusMsg = @$_GET['statusMsg']."<br>";
        echo "Status : "."<br>".$status = @$_GET['status']."<br>";
        echo "txnId : "."<br>".$txnId = @$_GET['txnId']."<br>";
        echo "userId :"."<br>".$payId = @$_GET['userId'];
    }

	public function updateplayerId(Request $request)
	{
		$user_id = 1;


		$getPlayerInfo = DB::table('onesignal_users')->where(['user_id' => $user_id])->select('*')->orderBy('signal_id', 'DESC')->first();


		if(@$getPlayerInfo->signal_id)
		{
			$signal_id= $getPlayerInfo->signal_id;

			$mydata = array(
				'player_id' => $request->player_id
			);

			$result = DB::table('onesignal_users')->where(['signal_id' => @$signal_id])->update(['player_id' => $request->player_id]);

			if($result) {
				echo "1";
			} else {
				echo "0";
			}

		}else{

			$addData = array(
				'user_id'    => $user_id,
				'player_id'  => $request->player_id,
				'created_at' => date('Y-m-d H:m:i'),
			);

			$result = DB::table('onesignal_users')->insertGetId($addData);

			if($result) {
				echo "1";
			} else {
				echo "0";
			}

		}

	}


	function stripeReturn(){
        $stripeDetails = DB::table('settings')->where('settingId','1')->select('*')->first();
        $stripePublishableKey = $stripeDetails->stripe_publishable_key;
        $stripeSecretKey = $stripeDetails->stripe_secret_key;
		if(!empty($_GET['userId'])){
			//$useracc_info = $this->db->query("select * from stripe_connect where userId = ".$_GET['userId']."")->row();
			$useracc_info = DB::table('stripe_connect')->where(['userId' => $_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
			if(!empty($useracc_info)){
				$skey = $stripeSecretKey;
				if(!empty($useracc_info->stripe_acc_id)){
					$row = $this->get_stripe_info($useracc_info->stripe_acc_id, $skey);
					$get_data = json_decode($row);
					//print_r($get_data);die;
					if(!empty($get_data->payouts_enabled) AND !empty($get_data->charges_enabled) AND $get_data->payouts_enabled == 1 AND $get_data->charges_enabled == 1){
						$statusMsg = 'Your account is connected to stripe successfully.';
						$status = 'success';
						$userId = @$_GET['userId'];
						$stripeAccid = @$get_data->id;
						// echo "<br>Your account is connected to stripe successfully.<br>";
						// echo "UserId : "."".@$_GET['userId']."<br>";
						// echo "Stripe Account Id : "."".@$get_data->id."<br>";
						//redirect(base_url("payment/stripeConnectStatus?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId.""),'refresh');

						return redirect()->intended("webview/stripeConnectStatus?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId."");
					}else{
						//echo 'Your account is not connected. Please try again.';
						$statusMsg = 'Your account is not connected. Please try again.';
						$status = 'fail';
						$userId = @$_GET['userId'];
						$stripeAccid = '';

						//redirect(base_url("payment/stripeConnectStatus?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId.""),'refresh');

						return redirect()->intended("webview/stripeConnectStatus?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId."");
					}
				}else{
					//echo 'user stripe account id not found.';
					$statusMsg = 'user stripe account id not found.';
					$status = 'fail';
					$stripeAccid = '';
					$userId = @$_GET['userId'];
					//redirect(base_url("payment/stripeConnectStatus?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId.""),'refresh');

					return redirect()->intended("webview/stripeConnectStatus?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId."");
				}
			}else{
				$statusMsg = 'user not found';
				//echo 'user not found.';
				$status = 'fail';
				$stripeAccid = '';
				$userId = @$_GET['userId'];

				//redirect(base_url("payment/stripeConnectStatus?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId.""),'refresh');

				return redirect()->intended("webview/stripeConnectStatus?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId."");
			}
		}
	}

	function stripeConnectStatus(){
		echo "<br>".@$_GET['statusMsg']."<br>";
        echo "Status : "."<br>".@$_GET['status']."<br>";
        echo "Stripe Account Id : "."<br>".@$_GET['stripeaccId']."<br>";
        echo "UserId :"."<br>".@$_GET['userId'];
	}

	function get_stripe_info($stripe_acc_id = '', $skey = ''){
		$url = 'https://api.stripe.com/v1/accounts/'.@$stripe_acc_id.'';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "".$url."");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		$headers = array();
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Authorization: Bearer ".$skey."";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		return $result;
	}


	 public function productPayment()
    {
		if(empty(@$_GET['userId'])){
			echo 'userId is required.';exit();
		}

		// if(empty(@$_GET['productId'])){
			// echo 'productId is required.';exit();
		// }

		// if(empty(@$_GET['shippingCharge'])){
			// echo 'Shipping Charge is required.';exit();
		// }

		if(empty(@$_GET['totalAmount'])){
			echo 'Total amount is required.';exit();
		}

		// if(empty(@$_GET['amount'])){
			// echo 'Amount is required.';exit();
		// }

		// $data['userId']  = $userId = @$_GET['userId'];
		// $data['amount']  = $amount = @$_GET['amount'];

        //print_r(@$_GET['product']);



		/*foreach(@$_GET['product'] as  $productValue){
            foreach($productValue as $k => $v){
				echo $k .'=>'. $v;
				echo "<br/>";
			}
		}*/




        $data['product']      = @$_GET['product'];
        $data['totalAmount']  = @$_GET['totalAmount'];
        $data['userId']       = @$_GET['userId'];

        $data['userInfo'] = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
		return view('product_payment', $data);
    }

	public function product_stripe_payment(Request $request) {
        $stripeDetails = DB::table('settings')->where('settingId','1')->select('*')->first();
        $stripePublishableKey = $stripeDetails->stripe_publishable_key;
        $stripeSecretKey = $stripeDetails->stripe_secret_key;
		require "vendor/stripe/stripe-php/init.php";
        if($request->stripeToken){
			$token     = $request->stripeToken;
			$user_id   =  $_POST['user_id'];
			$amount    =  $_POST['amount'];
			$address   =  $_POST['card_address'];
			$country   =  $_POST['card_country'];
			$state     =  $_POST['card_state'];
			$city      =  $_POST['card_city'];
			$zipcode   =  $_POST['card_zipcode'];
			$card_name =  $_POST['card_name'];
			$email     =  $_POST['email'];
			$itemPrice =  $amount;
			$currency  =  'usd';

			$products_info = [];
            $i = 0;
			$post = $_POST['product'];

			//$post['products'] = array();
			$products_to_order = array();
			foreach ($post as $product) {

				$products_to_order[] = [
					'product_id' => $product['productId'],
					'product_name' => $product['productName'],
					'price' => $product['price'],
					'quantity' => $product['quantity'],
				];
				$i++;
			}
			//print_r($products_to_order);die;

			$stripe = array(
				"secret_key"      => $stripeSecretKey,
				"publishable_key" => $stripePublishableKey
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
				$itemName = 'StarBiz Product';
				$orderID  = "ORDNO-".$this->generate_otp(6);
				$itemPriceCents = ($itemPrice*100);

				try {
					$charge = \Stripe\Charge::create(array(
						'customer' => $customer->id,
						'amount'   => $itemPriceCents,
						'currency' => 'usd',
						'description' => $itemName,
						'metadata' => array(
							'order_id' => $orderID
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
						$transactionID  =  $chargeJson['balance_transaction'];
						$paidAmount     =  $chargeJson['amount'];
						$paidAmount     =  ($paidAmount/100);
						$paidCurrency   =  $chargeJson['currency'];
						$payment_status =  $chargeJson['status'];
						$chargeID       =  $chargeJson['id'];
						$paymentDate    =  date('Y-m-d H:i:s');
						//print_r($chargeJson);
						if($payment_status == 'succeeded')
						{



							$statusMsg = 'Your Payment has been Successful!';

							$data = ['user_name' => $card_name, 'user_id' => $user_id, 'address' => $address, 'country' => $country, 'state' => @$state, 'city' => @$city, 'zipcode' => $zipcode, 'amount' => @$itemPrice, 'currency' => @$currency, 'txn_id' => $transactionID, 'order_id' => $orderID, 'charge_id' => $chargeID, 'status' => $payment_status, 'payment_type' => 6, 'product_info' => serialize($products_to_order), 'created_at' => $paymentDate];

							$result = DB::table('transaction')->insertGetId($data);

							return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$transactionID."&userId=".$user_id."");

						}else{
							$statusMsg = "Transaction has been failed!";
							$payment_status = 'failed';
							$txnId = '';
							//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
							return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
						}
					}else{
						$statusMsg = "Transaction has been failed!";
						$payment_status = 'failed';
						$txnId = '';
						//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
						return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
					}
				}else{
					$statusMsg = "Charge creation failed! $api_error";
					$payment_status = 'failed';
					$txnId = '';
				    //redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id.""),'refresh');
					return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
				}
			}else{

				$statusMsg = "Invalid card details! $api_error";
				$payment_status = 'failed';
				$txnId = '';
				//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
				return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
			}
		}else{
			$statusMsg = "Error on form submission.";
			$payment_status = 'failed';
			$txnId = '';
			$userId = '';
			//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
			return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId."");

		}
	}

	public function productPaymentStatus()
    {
        echo "<br>".$statusMsg = @$_GET['statusMsg']."<br>";
        echo "Status : "."<br>".$status = @$_GET['status']."<br>";
        echo "txnId : "."<br>".$txnId = @$_GET['txnId']."<br>";
        echo "userId :"."<br>".$userId = @$_GET['userId'];
    }

	public function advertisePayment()
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

		if(empty(@$_GET['networkUserId'])){
			echo 'networkUserId is required.';exit();
		}


		$data['userId'] = $userId = @$_GET['userId'];
		//$data['amount']  = $amount = @$_GET['amount'];
		$data['adsId']  = $adsId = @$_GET['adsId'];
		$data['planId']  = $planId = @$_GET['planId'];
		$data['networkUserId']  = $networkUserId = @$_GET['networkUserId'];

        $data['planInfo'] = $planInfo = DB::table('advertise_sub_plan')->where(['id' => $planId])->select('*')->orderBy('id', 'DESC')->first();

        if(@$_GET['preferredListing'] == 1){
			$preferredListing = DB::table('advertise_sub_plan')->where(['id' => $planId, 'preferred_listing' => @$_GET['preferredListing']])->select('preferred_listing', 'preferred_listing_price')->orderBy('id', 'DESC')->first();

			if(!empty(@$preferredListing->preferred_listing_price)){
				$preferred_listing_price = @$preferredListing->preferred_listing_price;
			}else{
				$preferred_listing_price =0;
			}
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
		return view('webviewadvertisepayment', $data);
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
			$network_user_id  =  $_POST['network_user_id'];

			$stripe = array(
				"secret_key"      => $stripeSecretKey,
				"publishable_key" => $stripePublishableKey
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
							$data = ['user_name' => @$card_name, 'user_id' => @$user_id, 'address' => @$address, 'country' => @$country, 'state' => @$state, 'city' => @$city, 'zipcode' => @$zipcode, 'adv_sub_id' => @$sub_id, 'amount' => @$itemPrice, 'currency' => @$currency, 'txn_id' => @$transactionID, 'order_id' => @$orderID, 'charge_id' => @$chargeID, 'status' => @$payment_status, 'expiry_date' => @$current_period_end, 'payment_type' => '7', 'adv_id' => @$adsId, 'adv_user_id' => @$network_user_id, 'preferredListing' => @$preferredListing, 'duration' => @$duration, 'created_at' => @$paymentDate];

							$result = DB::table('transaction')->insertGetId($data);

							return redirect()->intended("webview/advertisepaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$transactionID."&userId=".$user_id."");

						}else{
							$statusMsg = "Transaction has been failed!";
							$payment_status = 'failed';
							$txnId = '';

							return redirect()->intended("webview/advertisepaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");

						}
					}else{
						$statusMsg = "Transaction has been failed!";
						$payment_status = 'failed';
						$txnId = '';

						return redirect()->intended("webview/advertisepaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");


					}
				}else{
					$statusMsg = "Charge creation failed! $api_error";
					$payment_status = 'failed';
					$txnId = '';

					return redirect()->intended("webview/advertisepaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
				}
			}else{

				$statusMsg = "Invalid card details! $api_error";
				$payment_status = 'failed';
				$txnId = '';

				return redirect()->intended("webview/advertisepaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
			}
		}else{
			$statusMsg = "Error on form submission.";
			$payment_status = 'failed';
			$txnId = '';
			$userId = '';

			return redirect()->intended("webview/advertisepaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId."");
		}
	}

	public function advertisepaymentStatus()
    {
        echo "<br>".$statusMsg = @$_GET['statusMsg']."<br>";
        echo "Status : "."<br>".$status = @$_GET['status']."<br>";
        echo "txnId : "."<br>".$txnId = @$_GET['txnId']."<br>";
        echo "userId :"."<br>".$userId = @$_GET['userId'];
    }
}