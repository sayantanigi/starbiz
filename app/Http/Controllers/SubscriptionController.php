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
class SubscriptionController extends Controller
{
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        // $this->userData = session()->get('userData');
        // if (!session()->get('ID_LOGIN') || !session()->get('ADMINLOGINID')) {
        // return redirect()->intended('admin');
        // }
        // // let the request continue through the stack
        // return $next($request);
        // });
    }
    public function index()
    {
        $data = array(
            'title' => 'Subscription Plan',
            'page' => 'subscription',
            'subpage' => 'subscription'
        );
        $data['plan'] = DB::table('sub_plan')->where(['status' => 1])->select('*')->get();
        return view('account/plan', $data);
    }
    public function payment() {
        if (empty(@$_GET['amt'])) {
            echo 'Amount is required.';
            exit();
        }
        if (empty(@$_GET['subId'])) {
            echo 'subId is required.';
            exit();
        }
        $data['userId'] = $userId = session()->get('USERLOGINID');
        $data['amount'] = $amount = @$_GET['amt'];
        $data['subId'] = $subId = @$_GET['subId'];
        $data['subInfo'] = DB::table('sub_plan')->where(['id' => $subId])->select('*')->orderBy('id', 'DESC')->first();
        $data['userInfo'] = DB::table('users')->where(['id' => $userId])->select('*')->orderBy('id', 'DESC')->first();
        return view('sub_payment', $data);
    }
    public function sub_payment(Request $request) {
        $stripeDetails = DB::table('settings')->where('settingId','1')->select('*')->first();
        $stripePublishableKey = $stripeDetails->stripe_publishable_key;
        $stripeSecretKey = $stripeDetails->stripe_secret_key;
        require "vendor/stripe/stripe-php/init.php";
        if ($request->stripeToken) {
            $token = $request->stripeToken;
            $sub_id = $_POST['sub_id'];
            $sub_name = $_POST['sub_name'];
            $user_id = $_POST['user_id'];
            $amount = $_POST['amount'];
            $address = $_POST['card_address'];
            $country = $_POST['card_country'];
            $state = $_POST['card_state'];
            $city = $_POST['card_city'];
            $zipcode = $_POST['card_zipcode'];
            $card_name = $_POST['card_name'];
            $email = $_POST['email'];
            $itemPrice = $amount;
            $currency = 'usd';
            //print_r($token);die;
            $stripe = array(
                "secret_key" => $stripeSecretKey,
                "publishable_key" => $stripePublishableKey
            );
            //print_r($stripe['secret_key']);die;
            \Stripe\Stripe::setApiKey($stripe['secret_key']);
            try {
                $customer = \Stripe\Customer::create(array(
                    'email' => $email,
                    'source' => $token
                ));
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }
            if (empty($api_error) && $customer) {
                $itemName = @$sub_name;
                $orderID = "ORDNO-" . $this->generate_otp(6);
                $itemPriceCents = ($itemPrice * 100);
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
                $subInfo = DB::table('sub_plan')->where(['id' => $sub_id])->select('*')->orderBy('id', 'DESC')->first();
                $stripeSubId = '';
                if (!empty(@$subInfo)) {
                    if (!empty(@$subInfo->stripe_plan_id)) {
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
                        } catch (Exception $e) {
                            $api_error = $e->getMessage();
                        }
                    }
                }
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
                if (empty($api_error) && $subscription) {
                    //$chargeJson = $subscription->jsonSerialize();
                    //print_r($chargeJson);die;
                    $subsData = $subscription->jsonSerialize();
                    if ($subsData['status'] == 'active') {
                        /*$transactionID  =  $chargeJson['balance_transaction'];
                        $paidAmount     =  $chargeJson['amount'];
                        $paidAmount     =  ($paidAmount/100);
                        $paidCurrency   =  $chargeJson['currency'];
                        $payment_status =  $chargeJson['status'];
                        $chargeID       =  $chargeJson['id'];
                        $paymentDate    =  date('Y-m-d H:i:s');*/
                        //print_r($chargeJson);
                        $transactionID = $subscrID = $subsData['id'];
                        $custID = $subsData['customer'];
                        $planID = $subsData['plan']['id'];
                        $planAmount = ($subsData['plan']['amount'] / 100);
                        $planCurrency = $subsData['plan']['currency'];
                        $planinterval = $subsData['plan']['interval'];
                        $planIntervalCount = $subsData['plan']['interval_count'];
                        $paymentDate = date('Y-m-d H:i:s');
                        $payment_status = 'succeeded';
                        $chargeID = '';
                        if ($payment_status == 'succeeded') {
                            $sub_info = DB::table('sub_plan')->where(['id' => @$sub_id])->select('*')->orderBy('id', 'DESC')->first();
                            if ($sub_info->type == 1) {
                                $current_period_start = date('Y-m-d');
                                $current_period_end = date('Y-m-d', strtotime($current_period_start . ' + ' . @$sub_info->duration . ' month'));
                            } else {
                                $current_period_start = date('Y-m-d');
                                $current_period_end = date('Y-m-d', strtotime($current_period_start . ' + ' . @$sub_info->duration . ' year'));
                            }
                            $beforeSubExpire = DB::table('transaction')->whereRaw("user_id = " . @$user_id . " AND payment_type = 1 AND expiry_date > '" . date('Y-m-d') . "'")->select('*')->orderBy('id', 'DESC')->first();
                            if (!empty(@$beforeSubExpire)) {
                                $date_1 = date_create(date('Y-m-d'));
                                $date_2 = date_create($beforeSubExpire->expiry_date);
                                $diff = date_diff($date_1, $date_2);
                                $sub_remaining_days = $diff->format("%a");
                                $subDays = $sub_remaining_days . 'Days';
                                $subExpiryDate = date('Y-m-d', strtotime('' . $subDays . '', strtotime($current_period_end))) . PHP_EOL;
                                $userPreviousCount = DB::table('users')->where(['id' => @$user_id])->select('*')->first();
                                $access_business = DB::table('sub_permision_menu')->where(['sub_id' => @$sub_id, 'menu_id' => 1])->select('*')->first();
                                $businessCount = 0;
                                if (!empty(@$access_business)) {
                                    $businessCount = @$access_business->number_of + @$userPreviousCount->businessCount;
                                }
                                $access_event = DB::table('sub_permision_menu')->where(['sub_id' => @$sub_id, 'menu_id' => 2])->select('*')->first();
                                $eventCount = 0;
                                if (!empty(@$access_event)) {
                                    $eventCount = @$access_event->number_of + @$userPreviousCount->eventCount;
                                }
                                $access_invitation = DB::table('sub_permision_menu')->where(['sub_id' => @$sub_id, 'menu_id' => 3])->select('*')->first();
                                $invitationCount = 0;
                                if (!empty(@$access_invitation)) {
                                    $invitationCount = @$access_invitation->number_of + @$userPreviousCount->eventCount;
                                }
                                $access_promotion = DB::table('sub_permision_menu')->where(['sub_id' => @$sub_id, 'menu_id' => 4])->select('*')->first();
                                $promotionCount = 0;
                                if (!empty(@$access_promotion)) {
                                    $promotionCount = @$access_promotion->number_of + @$userPreviousCount->eventCount;
                                }
                            } else {
                                $subExpiryDate = $current_period_end;
                                //$userPreviousCount = DB::table('users')->where(['id' => @$user_id])->select('*')->first();
                                $access_business = DB::table('sub_permision_menu')->where(['sub_id' => @$sub_id, 'menu_id' => 1])->select('*')->first();
                                $businessCount = 0;
                                if (!empty(@$access_business)) {
                                    $businessCount = @$access_business->number_of;
                                }
                                $access_event = DB::table('sub_permision_menu')->where(['sub_id' => @$sub_id, 'menu_id' => 2])->select('*')->first();
                                $eventCount = 0;
                                if (!empty(@$access_event)) {
                                    $eventCount = @$access_event->number_of;
                                }
                                $access_invitation = DB::table('sub_permision_menu')->where(['sub_id' => @$sub_id, 'menu_id' => 3])->select('*')->first();
                                $invitationCount = 0;
                                if (!empty(@$access_invitation)) {
                                    $invitationCount = @$access_invitation->number_of;
                                }
                                $access_promotion = DB::table('sub_permision_menu')->where(['sub_id' => @$sub_id, 'menu_id' => 4])->select('*')->first();
                                $promotionCount = 0;
                                if (!empty(@$access_promotion)) {
                                    $promotionCount = @$access_promotion->number_of;
                                }
                            }
                            // echo $promotionCount;
                            // echo '<br/>';
                            // echo $invitationCount;
                            // echo '<br/>';
                            // echo $eventCount;
                            // echo '<br/>';
                            // echo $businessCount;die;
                            $statusMsg = 'Your Payment has been Successful!';
                            $data = ['user_name' => @$card_name, 'user_id' => @$user_id, 'address' => @$address, 'country' => @$country, 'state' => @$state, 'city' => @$city, 'zipcode' => @$zipcode, 'sub_id' => @$sub_id, 'amount' => @$itemPrice, 'currency' => @$currency, 'txn_id' => @$transactionID, 'order_id' => @$orderID, 'charge_id' => @$chargeID, 'status' => @$payment_status, 'expiry_date' => @$subExpiryDate, 'stripe_sub_id' => @$stripeSubId, 'payment_type' => 1, 'auto_renew_status' => '1', 'created_at' => @$paymentDate];
                            $result = DB::table('transaction')->insertGetId($data);
                            DB::table('users')->where('id', @$user_id)->update(['auto_renew_status' => '1', 'eventCount' => @$eventCount, 'businessCount' => @$businessCount, 'invitationCount' => @$invitationCount, 'promotionCount' => @$promotionCount, 'spend_money' => DB::raw('spend_money+' . @$itemPrice)]);
                            $myInfo = DB::table('users')->where(['id' => @$user_id])->select('*')->first();
                            $referralInfo = DB::table('reffer')->where(['reffer_user_email' => @$myInfo->email])->select('*')->first();
                            $referral_setting = DB::table('referral_comission_setting')->select('*')->first();
                            if (!empty($referralInfo)) {
                                $senderId = '';
                                $reffer_code = '';
                                if (@$referralInfo) {
                                    if (@$referralInfo->sender_id) {
                                        $senderId = @$referralInfo->sender_id;
                                    }
                                    if (@$referralInfo->reffer_code) {
                                        $reffer_code = @$referralInfo->reffer_code;
                                    }
                                }
                                if ((@$myInfo->spend_money != 0) && (@$myInfo->spend_money >= @$referral_setting->spend_money)) {
                                    $referalData = ['referral_user_id' => @$user_id, 'user_id' => @$senderId, 'referral_code' => @$reffer_code, 'referral_earned_point' => @$referral_setting->reward_points, 'my_earned_point' => @$referral_setting->referred_by_points, 'created_at' => date('Y-m-d H:i:s')];
                                    DB::table('referral_rewards_transaction')->insertGetId($referalData);
                                    DB::table('users')->where('id', @$user_id)->update(['earned_rewords_point' => DB::raw('earned_rewords_point+' . $referral_setting->reward_points)]);
                                    DB::table('users')->where('id', @$senderId)->update(['earned_rewords_point' => DB::raw('earned_rewords_point+' . $referral_setting->referred_by_points)]);
                                }
                            } else {
                                if ((@$myInfo->spend_money != 0) && (@$myInfo->spend_money >= @$referral_setting->spend_money)) {
                                    $referalData = ['referral_user_id' => '', 'user_id' => @$user_id, 'referral_code' => '', 'referral_earned_point' => @$referral_setting->reward_points, 'my_earned_point' => '', 'created_at' => date('Y-m-d H:i:s')];
                                    DB::table('referral_rewards_transaction')->insertGetId($referalData);
                                    DB::table('users')->where('id', @$user_id)->update(['earned_rewords_point' => DB::raw('earned_rewords_point+' . @$referral_setting->reward_points)]);
                                }
                            }
                            if (@$myInfo->spend_money == @$referral_setting->spend_money) {
                                DB::table('users')->where('id', @$user_id)->update(['spend_money' => 0]);
                            } elseif (@$myInfo->spend_money > @$referral_setting->spend_money) {
                                $total = @$myInfo->spend_money - @$referral_setting->spend_money;
                                DB::table('users')->where('id', @$user_id)->update(['spend_money' => @$total]);
                            }
                            //die;
                            //return redirect()->intended('admin/users')->with("status", "Your Payment has been Successful!");
                            //redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$vendortxndata->tranId."&userId=".$userId.""),'refresh');
                            //return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$transactionID."&userId=".$user_id."");
                            return redirect()->intended('dashboard')->with("status", "" . $statusMsg . "<br/>Transaction Id : " . $transactionID . "");
                        } else {
                            $statusMsg = "Transaction has been failed!";
                            $payment_status = 'failed';
                            $txnId = '';
                            //redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
                            //return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
                            return redirect()->intended('dashboard')->with("error", "$statusMsg");
                        }
                    } else {
                        $statusMsg = "Transaction has been failed!";
                        $payment_status = 'failed';
                        $txnId = '';
                        //redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
                        //return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
                        return redirect()->intended('dashboard')->with("error", "$statusMsg");
                    }
                } else {
                    //$statusMsg = "Charge creation failed! $api_error";
                    $statusMsg = "Subscription creation failed! " . $api_error;
                    $payment_status = 'failed';
                    $txnId = '';
                    //redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id.""),'refresh');
                    //return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
                    return redirect()->intended('dashboard')->with("error", "$statusMsg");
                }
            } else {
                $statusMsg = "Invalid card details! $api_error";
                $payment_status = 'failed';
                $txnId = '';
                //redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
                //return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
                return redirect()->intended('dashboard')->with("error", "$statusMsg");
            }
        } else {
            $statusMsg = "Error on form submission.";
            $payment_status = 'failed';
            $txnId = '';
            $userId = '';
            //redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
            //return redirect()->intended("webview/paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId."");
            return redirect()->intended('dashboard')->with("error", "$statusMsg");
        }
    }
    public function generate_otp($length) {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}