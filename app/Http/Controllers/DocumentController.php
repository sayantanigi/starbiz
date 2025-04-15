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

class DocumentController extends Controller {
  

	public function __construct()
	{

		$this->middleware(function ($request, $next) {
			$this->userData = session()->get('userData');

			if (!session()->get('USERLOGINID')) {
			   return redirect()->intended('login');
			}

			// let the request continue through the stack
			return $next($request);
		});
	}	
	
    public function index()
    { 
	
         $data = array(
			 'title'   => 'Users Lists',
			 'page'    => 'users',
			 'subpage' => 'users'
		 );

		$data['userType']  = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        return view('identifydoc', $data);
    }
	
	public function saveDocument(Request $request)
    { 
		$validator = $request->validate([
				'documentType' => 'required',
				'documentNumber'  => 'required',
				'dob'     => 'required', 
			]
		);
		if($validator){			
			if ($request->profilePhoto) {
				$img = $request->profilePhoto;
				$extn = $img->getClientOriginalExtension();
				$path = public_path('profile/');
				$profile = rand() . '.' . $extn;
				$img->move($path, $profile);
			} else {
			    $profile = '';
			}			
			$image = array();
			if($file = $request->file('documentPhoto')){
				foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('document/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image[] = $image_url;
					//$data  = ['image' => $image, 'event_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
					//DB::table('event_image')->insertGetId($data);
				}				
			}
			if(!empty(@$image)){
				@$documentPhoto = implode(',', @$image);
			}else{
				@$documentPhoto = '';
			}
			$data = ['user_id' => session()->get('USERLOGINID'), 'document_type' => $request->documentType, 'document_number' => $request->documentNumber, 'document_photo' => $documentPhoto, 'dob' => date('Y-m-d', strtotime($request->dob)), 'created_at' => date('Y-m-d H:i:s')];
			$userCount = DB::table('user_document')->where(['user_id' => session()->get('USERLOGINID')])->select('*')->orderBy('id', 'DESC')->count();
			if(@$userCount > 0){
				$result = DB::table('user_document')->where(['user_id' => session()->get('USERLOGINID')])->update(@$data);
			}else{
				$result = DB::table('user_document')->insertGetId($data);
			}
			if($result){
				$profileData = array('profile_image' => $profile, 'dob' => date('Y-m-d', strtotime($request->dob)));	
				$where = array('id' => session()->get('USERLOGINID'));
				DB::table('users')->where($where)->update(@$profileData);
				return redirect()->intended('document')->with("doc_status", "Your document uploaded successfully.Please wait for admin approval.");
			}else{
				return redirect()->intended('document')->with("error", "Some error occurred, Please try again.");
			}
		}else{
			return back()->withErrors('message', $validator);
		}
	}
}