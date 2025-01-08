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

class RegisterController extends Controller {
  

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
			 'title'   => 'Users Lists',
			 'page'    => 'users',
			 'subpage' => 'users'
		 );

		$data['userType']  = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        return view('register', $data);
    }
	public function saveRegister(Request $request)
    { 
		$validator = $request->validate([
			
				'fname' => 'required',
				'lname' => 'required',
				'user_type'  => 'required|numeric',
				'email'     => 'required|email|unique:users,email', 
				'password'  => 'required|min:6'
			]
		);
		if($validator){
			
			//print_r(@$_POST);die;
			
			/*$firstName = ''; 
			$lastName = ''; 
			
			if(!empty($request->name)){
				$explodeName = explode(' ', $request->name);
				$firstName = @$explodeName[0];
				$lastName = @$explodeName[1];
			}*/
			
			$data = ['first_name' => @$request->fname, 'last_name' => @$request->lname, 'user_type' => @$request->user_type, 'email' => @$request->email, 'password' => md5(@$request->password), 'status' => 0, 'created_at' => date('Y-m-d H:i:s')];
			$result = DB::table('users')->insertGetId($data);
			
			if($result){
				
				
				if(!empty(@$request->referral_code)){
					$refer = DB::table('reffer')->where(['reffer_user_email' => @$request->email, 'reffer_code' => @$request->referral_code])->select('*')->first();
					if(!empty(@$refer)){
						DB::table('reffer')->where(['reffer_user_email' => @$request->email])->update(['status' => '1']);
					}
				}
				
				
				$setting = DB::table('settings')->where(['settingId' => 1])->select('*')->orderBy('settingId', 'DESC')->first();				
				$imagePath = url('setting/'.@$setting->logo.'');
				$imagebackPath = '';
				$subject = "StarBiz Registration";

				$message = "<!Doctype html>
				<html>
				<head>
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
				<title>StarBiz Registration</title>
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
				<a href='#'><img src='".@$imagePath."' style='width: 80%;'></a>
				</div>
				<div style='width: 400px; margin:50px auto;background: #ffffffd1;padding: 50px;text-align: center;'>
				<h3>Your registration is successfully completed. Please see below details.</h3>
				<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'><b>Email: </b>: ".strip_tags(@$request->email)."</p>
				<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'><b>Password: </b>: ".@$request->password."</p>
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
				
				//echo $message;die;
				
				$to = 	@$request->email;	
				$this->sentMail($to, $message, $subject); 
				
				
				//email
				/*$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <no-reply@StarBiz.com>' . "\r\n";
				$subject = 'StarBiz Registration';		
				$to = 	@$request->email;
				$message = " 
				<h3>Your registration is successfully completed. Please see below details.</h3> 
				<p><b>Email: </b>".strip_tags(@$request->email)."</p> 
				<p><b>Password: </b>".@$request->password."</p>";
				mail($to, $subject, $message, $headers);*/
				
				$checkAuth = DB::table('users')->where(['id' => $result])->select('*')->get();
				if(count($checkAuth) == 1){
					session()->put('USERLOGINID', $checkAuth[0]->id);
					//session()->put('IDLOGIN', TRUE);
				}
				
				return redirect()->intended('document')->with("status", "registration is successfully completed.Please upload your document for verification.");
			}else{
				return redirect()->intended('document')->with("error", "Some error occure, Please try again.");
			}
			
		}else{
			return back()->withErrors('message', $validator);
		}
	}
	
	function sentMail($email = '', $msg = '', $subject = ''){
		    require_once 'vendor/email/vendor/autoload.php';
		    $mail = new PHPMailer(true);
			
			$mail->CharSet = 'UTF-8';
			$mail->SetFrom('no-reply@StarBiz.com','StarBiz');
			$mail->AddAddress($email);
			$mail->IsHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $msg;
			$mail->IsSMTP();
			$mail->SMTPAuth   = true; 
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
			//$mail->Host       = "smtp.googlemail.com";
			$mail->Host = 'smtp.gmail.com'; 
			$mail->Port       = 587;  
			//$mail->Username = 'gowologlobal@gmail.com';                
			//$mail->Password = 'hovndmbbedmhhemg';
			//$mail->Username = 'rameshwebdev21@gmail.com';                
			$mail->Username = 'starbiznetwork7@gmail.com';                
			//$mail->Password = 'gqbtiijrzaljwkhz';
			$mail->Password = 'krvm xzzz vumq fdll';
			return $mail->send();
			
          
	}
}
	