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

class ForgetpasswordController extends Controller {
  

	public function __construct()
	{

		// $this->middleware(function ($request, $next) {
			// $this->userData = session()->get('userData');

			// if (!session()->get('USERLOGINID')) {
			   // return redirect()->intended('login');
			// }

			// // let the request continue through the stack
			// return $next($request);
		// });
	}	
	
    public function index()
    { 
	
         $data = array(
			 'title'   => 'Users Lists',
			 'page'    => 'users',
			 'subpage' => 'users'
		 );

		$data['userType']  = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        return view('forgetpassword', $data);
    }
	
	public function SentOTP(Request $request)
    { 
		$validator = $request->validate([
			
				'email' => 'required|email',
			]
		);
		if($validator){
			
			$checkuser = DB::table('users')->where(['status' => 1, 'email' => @$request->email])->select('*')->orderBy('id', 'DESC')->first();
			
			if(!empty($checkuser))
			{ 
		        $otpData = array(
					'otp'=>$this->generate_otp(4),
				); 
				$where = array('id' => $checkuser->id);
				$result = DB::table('users')->where($where)->update(@$otpData);
				if($result){
					$otp = DB::table('users')->where(['email' => @$request->email])->select('*')->orderBy('id', 'DESC')->first();
							
					$setting = DB::table('settings')->where(['settingId' => 1])->select('*')->orderBy('settingId', 'DESC')->first();				
					$imagePath = url('uploads/setting/'.@$setting->logo.'');
					$imagebackPath = '';
					
					$subject = "OTP (StarBiz)";
					$message = "<!Doctype html>
					<html>
					<head>
					<meta charset='utf-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1'>
					<title>OTP</title>
					<link href='https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap' rel='stylesheet'>
					<body>
					<div style='max-width:600px;
					margin:auto;
					border:1px solid #eee;
					box-shadow:0 0 10px rgba(0, 0, 0, .15);
					line-height:17px;
					font-size:13px;
					box-sizing:border-box; -webkit-print-color-adjust: exact;font-family: Poppins, sans-serif; background:url(".@$imagebackPath.")'>
					<div style='padding:20px; box-sizing: border-box;text-align: center; background: #fff;'>
					<a href='#'><img src='".@$imagePath."' style='width: 350px; height80px;'></a>
					</div>
					<div style='width: 400px; margin:50px auto;background: #ffffffd1;padding: 50px;text-align: center;'>
					<h1 style=' font-size: 30px; line-height: 32px; color: #0b0b0b; margin: 30px 0;'>Dear User</h1>
					<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>Your One Time Password(OTP) is: ".@$otp->otp."</p>
					<p>Do not share your OTP with anyone!</p>
					</div>
					<div style='background: #000;
					text-align: left;
					box-sizing: border-box;
					width: 100%;
					padding: 20px 50px;
					color: #fff;'>
					<p style='margin: 5px 0;font-size: 12px;'>Warm Regards,</p>
					<p style='margin: 5px 0;font-size: 12px;'>StarBiz Team</p>
					<p style='margin: 5px 0;font-size: 12px;'><strong>Email:</strong> <a href='#' style='color: #78daff;'>info@starbiz.com</a></p>
					<br/>
					<p style='margin: 5px 0;font-size: 11px;'>This is an automated response, please do not reply.</p>
					</div>
					</div>
					</body>
					</html>";
					
					require_once 'vendor/email/vendor/autoload.php';
					$mail = new PHPMailer(true);
					$mail->CharSet = 'UTF-8';
					$mail->SetFrom('info@starbiz.com','StarBiz');
					$mail->AddAddress(strip_tags(@$request->email));
					$mail->IsHTML(true);
					$mail->Subject = $subject;
					$mail->Body = $message;
					$mail->IsSMTP();
					$mail->SMTPAuth   = true; 
					$mail->SMTPSecure = 'tls'; 
					$mail->Host       = 'smtp.gmail.com';
					$mail->Port       = 587;  
					$mail->Username = 'rameshwebdev21@gmail.com';            
					$mail->Password = 'gqbtiijrzaljwkhz'; 
					$send = $mail->send();
				   
					return redirect()->intended('forgetpassword?otpuserId='.@$otp->id.'')->with("forget_status", "OTP sent on your email.Please check your email inbox.");
				}else{
					return redirect()->intended('forgetpassword')->with("error", "Some error occurred, Please try again.");
				}
				
		    }else{
				return redirect()->intended('forgetpassword')->with("error", "User not found.");
			}
		}else{
			return back()->withErrors('message', $validator);
		}
	}
	
	public function submitOTP(Request $request)
    { 
	    
		
		$validator = $request->validate([
			
				'otpuserId'    => 'required',
				'otp'       => 'required|numeric',
			]
		);
		if($validator){
			$checkuser = DB::table('users')->where(['id' => @$request->otpuserId, 'otp' => @$request->otp])->select('*')->orderBy('id', 'DESC')->get();
			if(count($checkuser) > 0)
			{ 
				return redirect()->intended('resetpassword?otpuserId='.@$request->otpuserId.'')->with("status", "OTP verified successfully.Please enter new password.");
		     
		    }else{
				return redirect()->intended('forgetpassword')->with("error", "Some error occurred, Please try again.");
			}
	    }else{
		    return back()->withErrors('message', $validator);
	    }
	}
	
	 public function reset_password()
    { 
	    
         $data = array(
			 'title'   => 'Users Lists',
			 'page'    => 'users',
			 'subpage' => 'users'
		 );

		$data['userType']  = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        return view('reset_password', $data);
    }
	
	
	public function savePassword(Request $request)
    { 
	    
		
		$validator = $request->validate([
			
				'otpuserId'       => 'required',
				//'otp'       => 'required|numeric',
				'newPassword'       => 'required'
			]
		);
		if($validator){
			
			$checkuser = DB::table('users')->where(['id' => @$request->otpuserId])->select('*')->orderBy('id', 'DESC')->get();
			if(count($checkuser) > 0)
			{ 
		        $data = array(
					'password' => md5(@$request->newPassword),
					'otp'=>$this->generate_otp(6),
				); 		

				//$where="id = '".@$request->userId."'";
				$where = array('id' => @$request->otpuserId);
				$result = DB::table('users')->where($where)->update(@$data);
				if($result){
					
					/*$otp = DB::table('users')->where(['email' => @$request->email])->select('*')->orderBy('id', 'DESC')->first();
					$response = [
						'status' => 1,
						'userId' => @$request->userId,
						'message' => 'Password Updated successfully.'
					];
					return response()->json($response, 200);*/
					
					return redirect()->intended('resetpassword')->with("status", "Your password updated successfully.Please login now.");
					
					
				}else{
					return redirect()->intended('resetpassword')->with("error", "Some error occurred, Please try again.");
				}
				
		    }else{
				return redirect()->intended('resetpassword')->with("error", "users not found.");
			}

	    }else{
		    return back()->withErrors('message', $validator);
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