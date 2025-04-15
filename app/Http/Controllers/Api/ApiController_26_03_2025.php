<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class ApiController extends Controller {
    public function __construct() {}
    public function usertypeList_get() {
        $list = DB::table('user_type')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'name' => @$v->name,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "No Data found."];
            return response()->json($response, 200);
        }
    }
    public function planList_get() {
        if (!empty(@$_GET['userType'])) {
            $list = DB::table('sub_plan')->where(['status' => 1, 'user_type' => @$_GET['userType']])->select('*')->orderBy('id', 'DESC')->get();
            if (!empty($list)) {
                foreach ($list as $k => $v) {
                    $planType = '';
                    if ($v->plan == 1) {
                        $planType = 'Free';
                    } else if ($v->plan == 2) {
                        $planType = 'Paid';
                    }
                    $planDuration = '';
                    if ($v->type == 1) {
                        $planDuration = 'Month';
                        if(@$v->duration > 1) {
                            $plan_duration = $v->duration." ".$planDuration;
                            $plan_duration .= 's';
                        } else {
                            $plan_duration = $v->duration." ".$planDuration;
                        }
                    } else if ($v->type == 2) {
                        $planDuration = 'Year';
                        if(@$v->duration > 1) {
                            $plan_duration = $v->duration." ".$planDuration;
                            $plan_duration .= 's';
                        } else {
                            $plan_duration = $v->duration." ".$planDuration;
                        }
                    }
                    $nav = @$v->description;
                    $nav = str_replace(array('<li>', '</li>'), '&&', $nav);
                    $nav = str_replace(array('<ul>', '</ul>'), '', $nav);
                    $nav = array_filter(explode('&&', $nav));
                    $nav1 = [];
                    foreach ($nav as $k1 => $v1) {
                        $nav1[] = [$k1 => $v1];
                    }
                    $accessList = DB::table('sub_permision_menu')->where(['sub_id' => @$v->id])->select('*')->get();
                    $accessArray = [];
                    if (count($accessList) > 0) {
                        foreach ($accessList as $accessKey => $accessVal) {
                            $accessMenu = DB::table('sub_access_menu')->where(['id' => @$accessVal->menu_id])->select('*')->first();
                            $menu = ['menuId' => $accessMenu->id, 'accessMenu' => $accessMenu->menu];
                            if (empty(@$accessVal->number_of)) {
                                $number_of = 0;
                            } else {
                                $number_of = @$accessVal->number_of;
                            }
                            $accessArray[] = [
                                'menu' => $menu,
                                'read_access' => @$accessVal->read_access,
                                'write_access' => @$accessVal->write_access,
                                'number_of' => @$number_of,
                            ];
                        }
                    }
                    $description  = implode('', array_map('implode', $nav1));
                    $array[] = [
                        'planId' => @$v->id,
                        'name' => @$v->name,
                        'planType' => @$planType,
                        'planDuration' => @$plan_duration,
                        'amount' => @$v->amount,
                        'description' => $description,
                        'subAccess' => $accessArray,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userType id is required."];
            return response()->json($response, 200);
        }
    }
    public function planDetails_get() {
        if (!empty(@$_GET['planId'])) {
            $list = DB::table('sub_plan')->where(['status' => 1, 'id' => @$_GET['planId']])->select('*')->orderBy('id', 'DESC')->first();
            if (!empty($list)) {
                $planType = '';
                if ($list->plan == 1) {
                    $planType = 'Free';
                } else if ($list->plan == 2) {
                    $planType = 'Paid';
                }
                $planDuration = '';
                if ($list->type == 1) {
                    $planDuration = 'Month';
                } else if ($list->type == 2) {
                    $planDuration = 'Year';
                }
                $nav = @$list->description;
                $nav = str_replace(array('<li>', '</li>'), '&&', $nav);
                $nav = str_replace(array('<ul>', '</ul>'), '', $nav);
                $nav = array_filter(explode('&&', $nav));
                $nav1 = [];
                foreach ($nav as $k => $v) {
                    $nav1[] = [$k => $v];
                }
                $accessList = DB::table('sub_permision_menu')->where(['sub_id' => @$list->id])->select('*')->get();
                $accessArray = [];
                if (count($accessList) > 0) {
                    foreach ($accessList as $accessKey => $accessVal) {
                        $accessMenu = DB::table('sub_access_menu')->where(['id' => @$accessVal->menu_id])->select('*')->first();
                        $menu = ['menuId' => $accessMenu->id, 'accessMenu' => $accessMenu->menu];
                        if (empty(@$accessVal->number_of)) {
                            $number_of = 0;
                        } else {
                            $number_of = @$accessVal->number_of;
                        }
                        $accessArray[] = [
                            'menu' => $menu,
                            'read_access' => @$accessVal->read_access,
                            'write_access' => @$accessVal->write_access,
                            'number_of' => @$number_of,
                        ];
                    }
                }
                $array = [
                    'planId' => @$list->id,
                    'name' => @$list->name,
                    'planType' => @$planType,
                    'planDuration' => @$planDuration,
                    'amount' => @$list->amount,
                    'description' => $nav1,
                    'subAccess' => $accessArray
                ];
                $response = ["status" => 1, "planDetails" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "planId id is required."];
            return response()->json($response, 200);
        }
    }
    public function register_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'firstName' => 'required',
                'userType' => 'required|numeric',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6'
            ]
        );
        if (!$validator->fails()) {
            $data = ['first_name' => @$request->firstName, 'last_name' => @$request->lastName, 'user_type' => @$request->userType, 'email' => @$request->email, 'password' => md5(@$request->password), 'status' => 1, 'created_at' => date('Y-m-d H:i:s')];
            $result = DB::table('users')->insertGetId($data);
            if ($result) {
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
				<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'><b>Email: </b> ".strip_tags(@$request->email)."</p>
				<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'><b>Password: </b> ".@$request->password."</p>
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
				$to = @$request->email;
				$this->sentMail($to, $message, $subject);
                $response = ["status" => 1, "message" => 'registration is successfully completed.', 'userId' => $result];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function login_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );
        if (!$validator->fails()) {
            $email = $request->email;
            $password = md5($request->password);
            $status = 1;
            $credentials = ['email' => $email, 'password' => $password, 'status' => $status];
            $accessArray = [];
            $subArray = [];
            $checkAuth = DB::table('users')->where($credentials)->select('*')->get();
            if (count($checkAuth) == 1) {
                $userSub = DB::table('transaction')->where(['user_id' => $checkAuth[0]->id, 'payment_type' => 1])->select('*')->orderBy('id', 'DESC')->first();
                if (!empty($userSub)) {
                    if (@$userSub->expiry_date >= date('Y-m-d')) {
                        $subStatus = 'Active';
                    } else {
                        $subStatus = 'Expired';
                    }
                    $subInfo = DB::table('sub_plan')->where(['id' => $userSub->sub_id])->select('*')->orderBy('id', 'DESC')->first();
                    $accessList = DB::table('sub_permision_menu')->where(['sub_id' => @$subInfo->id])->select('*')->get();
                    if (count($accessList) > 0) {
						$businessCount      = 0;
						$eventCount         = 0;
						$invitationCount    = 0;
						$promotionCount     = 0;
						$networkCount       = 0;
						if($checkAuth[0]->businessCount){
							$businessCount = $checkAuth[0]->businessCount;
						}
						if($checkAuth[0]->eventCount){
							$eventCount = $checkAuth[0]->eventCount;
						}
						if($checkAuth[0]->invitationCount){
							$invitationCount = $checkAuth[0]->invitationCount;
						}
						if($checkAuth[0]->promotionCount){
							$promotionCount = $checkAuth[0]->promotionCount;
						}
						$arrayAcc = array($businessCount, $eventCount, $invitationCount, $promotionCount, $networkCount);
						$i = 0;
                        foreach ($accessList as $accessKey => $accessVal) {
                            $accessMenu = DB::table('sub_access_menu')->where(['id' => @$accessVal->menu_id])->select('*')->first();
                            $menu = ['menuId' => $accessMenu->id, 'accessMenu' => $accessMenu->menu];
                            $accessArray[] = [
                                'menu' => $menu,
                                'read_access' => @$accessVal->read_access,
                                'write_access' => @$accessVal->write_access,
                                'number_of' => $arrayAcc[$accessKey],
                            ];
                        }
						$i++;
                    }
                    $subArray = ['subId' => @$subInfo->id, 'subName' => @$subInfo->name, 'status' => @$subStatus, 'expiryDate' => @$userSub->expiry_date, 'subAccess' => $accessArray];
                }
                $response = ["status" => 1, "userId" => $checkAuth[0]->id, 'firstName' => $checkAuth[0]->first_name, 'lastName' => $checkAuth[0]->last_name, 'email' => $checkAuth[0]->email, 'userType' => @$checkAuth[0]->user_type, 'message' => 'login successfully..!!', 'subInfo' => @$subArray];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Invalid Email/Password!'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function getOtp_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email'
            ]
        );
        if (!$validator->fails()) {
            $checkuser = DB::table('users')->where(['status' => 1, 'email' => @$request->email])->select('*')->orderBy('id', 'DESC')->first();
            if (!empty($checkuser)) {
                $otpData = array(
                    'otp' => $this->generate_otp(6),
                );
                $where = array('id' => $checkuser->id);
                $result = DB::table('users')->where($where)->update(@$otpData);
                if ($result) {
                    $otp = DB::table('users')->where(['email' => @$request->email])->select('*')->orderBy('id', 'DESC')->first();
                    $setting = DB::table('settings')->where(['settingId' => 1])->select('*')->orderBy('settingId', 'DESC')->first();
                    $imagePath = url('uploads/setting/' . @$setting->logo . '');
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
					box-sizing:border-box; -webkit-print-color-adjust: exact;font-family: Poppins, sans-serif; background:url(" . @$imagebackPath . ")'>
					<div style='padding:20px; box-sizing: border-box;text-align: center; background: #fff;'>
					<a href='#'><img src='" . @$imagePath . "' style='width: 80%;'></a>
					</div>
					<div style='width: 400px; margin:50px auto;background: #ffffffd1;padding: 50px;text-align: center;'>
					<h1 style=' font-size: 30px; line-height: 32px; color: #0b0b0b; margin: 30px 0;'>Dear User</h1>
					<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>Your One Time Password(OTP) is: " . @$otp->otp . "</p>
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
                    $mail->SetFrom('info@starbiz.com', 'StarBiz');
                    $mail->AddAddress(strip_tags(@$request->email));
                    $mail->IsHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body = $message;
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 587;
                    $mail->Username = 'starbiznetwork7@gmail.com';
                    $mail->Password = 'krvm xzzz vumq fdll';
                    $send = $mail->send();
                    $response = [
                        'status' => 1,
                        'userId' => $otp->id,
                        'otp' => $otp->otp
                    ];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "Some error occure, Please try again."];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => "users not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function verifyOtp_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'otp' => 'required|numeric',
            ]
        );
        if (!$validator->fails()) {
            $checkuser = DB::table('users')->where(['id' => @$request->userId, 'otp' => @$request->otp])->select('*')->orderBy('id', 'DESC')->get();
            if (count($checkuser) > 0) {
                $response = [
                    'status' => 1,
                    'userId' => @$request->userId,
                    'message' => 'otp verified successfully.'
                ];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Invalid Otp"];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function recoveryUpdatePassword_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'newPassword' => 'required'
            ]
        );
        if (!$validator->fails()) {
            $checkuser = DB::table('users')->where(['id' => @$request->userId])->select('*')->orderBy('id', 'DESC')->get();
            if (count($checkuser) > 0) {
                $data = array(
                    'password' => md5(@$request->newPassword),
                    'otp' => $this->generate_otp(6),
                );
                $where = array('id' => @$request->userId);
                $result = DB::table('users')->where($where)->update(@$data);
                if ($result) {
                    $otp = DB::table('users')->where(['email' => @$request->email])->select('*')->orderBy('id', 'DESC')->first();
                    $response = [
                        'status' => 1,
                        'userId' => @$request->userId,
                        'message' => 'Password Updated successfully.'
                    ];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "Some error occure, Please try again."];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => "users not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function indentificationDocument_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'documentType' => 'required',
                'documentNumber' => 'required',
                'dob' => 'required',
            ]
        );
        if (!$validator->fails()) {
            if ($request->profilePhoto) {
                $img = $request->profilePhoto;
                $extn = $img->getClientOriginalExtension();
                $path = public_path('profile/');
                $profile = rand() . '.' . $extn;
                $img->move($path, $profile);
            } else {
                $profile = '';
            }
            /*if ($request->documentPhoto) {
                $img = $request->documentPhoto;
                $extn = $img->getClientOriginalExtension();
                $path = public_path('document/');
                $document = rand() . '.' . $extn;
                $img->move($path, $document);
            } else {
                $document = '';
            }*/
            $image = array();
            if ($file = $request->file('documentPhoto')) {
                foreach ($file as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $uploade_path = public_path('document/');
                    $image_url = $image_full_name;
                    $file->move($uploade_path, $image_full_name);
                    $image[] = $image_url;
                }
            }
            if (!empty(@$image)) {
                @$documentPhoto = implode(',', @$image);
            } else {
                @$documentPhoto = '';
            }
            $data = ['user_id' => $request->userId, 'document_type' => $request->documentType, 'document_number' => $request->documentNumber, 'document_photo' => $documentPhoto, 'dob' => date('Y-m-d', strtotime($request->dob)), 'created_at' => date('Y-m-d H:i:s')];
            $userCount = DB::table('user_document')->where(['user_id' => @$request->userId])->select('*')->orderBy('id', 'DESC')->count();
            if (@$userCount > 0) {
                $result = DB::table('user_document')->where(['user_id' => @$request->userId])->update(@$data);
            } else {
                $result = DB::table('user_document')->insertGetId($data);
            }
            if ($result) {
                $profileData = array('profile_image' => $profile);
                $where = array('id' => @$request->userId);
                DB::table('users')->where($where)->update(@$profileData);
                $response = [
                    'status' => 1,
                    'userId' => @$request->userId,
                    'message' => 'Your document uploaded successfully.'
                ];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some error occure, Please try again."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function profileInfo_get() {
        if (!empty(@$_GET['userId'])) {
            $checkuser = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if (!empty($checkuser)) {
                $userType = DB::table('user_type')->where(['id' => @$checkuser->user_type])->select('name')->orderBy('id', 'DESC')->first();
                $tagArray = [];
                if (@$checkuser->tags) {
                    $tags = explode(',', @$checkuser->tags);
                    foreach ($tags as $k => $v) {
                        $tagsInfo = DB::table('tags')->where(['id' => @$v])->select('*')->orderBy('id', 'DESC')->first();
                        $tagArray[] = [
                            'id' => $tagsInfo->id,
                            'name' => $tagsInfo->name,
                        ];
                    }
                }
                $gallery = [];
                $photo = DB::table('user_gallery_photo')->where(['user_id' => @$checkuser->id])->select('*')->orderBy('id', 'DESC')->get();
                if ($photo) {
                    foreach ($photo as $k1 => $v1) {
                        if (!empty(@$v1->image) && file_exists('public/photos/' . @$v1->image . '')) {
                            $gallery[] = [
                                'id' => @$v1->id,
                                'image' => url('photos/' . @$v1->image . ''),
                            ];
                        }
                    }
                }
                $interestArray = [];
                if (@$checkuser->area_interest) {
                    $interest = explode(',', @$checkuser->area_interest);
                    foreach ($interest as $k2 => $v2) {
                        $interestInfo = DB::table('interest')->where(['id' => @$v2])->select('*')->orderBy('id', 'DESC')->first();
                        $interestArray[] = [
                            'id' => $interestInfo->id,
                            'name' => $interestInfo->name,
                        ];
                    }
                }
                if (!empty(@$checkuser->profile_image) && file_exists('public/profile/' . @$checkuser->profile_image . '')) {
                    $profilePic = url('profile/' . @$checkuser->profile_image . '');
                } else {
                    $profilePic = url('profile/unnamed.jpg');
                }
                if (!empty(@$checkuser->cover_image) && file_exists('public/profile/' . @$checkuser->cover_image . '')) {
                    $coverPic = url('profile/' . @$checkuser->cover_image . '');
                } else {
                    $coverPic = url('profile/unnamed.jpg');
                }
				$userDoc = DB::table('user_document')->where(['user_id' => @$checkuser->id])->select('dob')->orderBy('id', 'DESC')->first();
                $array = array(
                    'userId' => @$checkuser->id,
                    'firstName' => @$checkuser->first_name,
                    'lastName' => @$checkuser->last_name,
                    'email' => @$checkuser->email,
                    'phone' => @$checkuser->phone,
                    'userType' => @$userType->name,
                    'profileImge' => @$profilePic,
                    'coverImge' => @$coverPic,
                    'address' => @$checkuser->address,
                    'country' => @$checkuser->country,
                    'state' => @$checkuser->state,
                    'city' => @$checkuser->city,
                    'zipcode' => @$checkuser->zipcode,
                    'bio' => @$checkuser->bio,
                    'phone' => @$checkuser->phone,
                    // 'dob' => @$userDoc->dob,
                    'dob' => @$checkuser->dob,
                    'tags' => @$tagArray,
                    'interest' => @$interestArray,
                    'photos' => @$gallery,
                    'created' => @$checkuser->created_at,
                    'updated' => @$checkuser->updated_at,
                );
                $response = [
                    'status' => 1,
                    'personalInfo' => @$array
                ];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No details found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function profileEdit_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email',
                'userType' => 'required',
                'address' => 'required',
                //'country'   => 'required',
                //'state'     => 'required',
                //'city'      => 'required',
                //'zipcode'   => 'required',
                //'latitude'  => 'required',
                //'longitude' => 'required',
                'bio' => 'required',
                'phone' => 'required',
                'dob' => 'required',
                'tags' => 'required',
                'interest' => 'required',
            ]
        );
        if (!$validator->fails()) {
            if ($request->tags) {
                $tags = implode(',', $request->tags);
            } else {
                $tags = '';
            }
            if ($request->interest) {
                $interest = implode(',', $request->interest);
            } else {
                $interest = '';
            }
            if ($request->dob) {
                $dob = date('Y-m-d', strtotime($request->dob));
            } else {
                $dob = '';
            }
            $data = [
                'first_name' => @$request->firstName,
                'last_name' => @$request->lastName,
                'email' => @$request->email,
                'user_type' => @$request->userType,
                'address' => @$request->address,
                'country' => @$request->country,
                'state' => @$request->state,
                'city' => @$request->city,
                'zipcode' => @$request->zipcode,
                // 'latitude'   => $request->latitude,
                // 'longitude'  => $request->longitude,
                'bio' => @$request->bio,
                'tags' => @$tags,
                'area_interest' => @$interest,
                'phone' => @$request->phone,
                'dob' => @$dob,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $result = DB::table('users')->where(['id' => $request->userId])->update(@$data);
            if (!empty($result)) {
                $image = array();
                if ($file = $request->file('photos')) {
                    //print_r($file);die;
                    foreach ($file as $file) {
                        $image_name = md5(rand(1000, 10000));
                        $ext = strtolower($file->getClientOriginalExtension());
                        $image_full_name = $image_name . '.' . $ext;
                        $uploade_path = public_path('photos/');
                        $image_url = $image_full_name;
                        $file->move($uploade_path, $image_full_name);
                        $image = $image_url;
                        $data = ['image' => $image, 'user_id' => @$request->userId, 'created_at' => date('Y-m-d H:i:s')];
                        DB::table('user_gallery_photo')->insertGetId($data);
                    }
                }
                $response = [
                    'status' => 1,
                    'userId' => @$request->userId,
                    'message' => 'Your information updated successfully.'
                ];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some error occure, Please try again."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function uploadProfile_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            if ($request->profilePhoto) {
                $img = $request->profilePhoto;
                $extn = $img->getClientOriginalExtension();
                $path = public_path('profile/');
                $profile = rand() . '.' . $extn;
                $img->move($path, $profile);
            } else {
                $userInfo = DB::table('users')->where(['id' => $request->userId])->select('profile_image')->orderBy('id', 'DESC')->first();
                if (!empty($userInfo->profile_image)) {
                    $profile = $userInfo->profile_image;
                } else {
                    $profile = '';
                }
            }
            if ($request->coverPhoto) {
                $img = $request->coverPhoto;
                $extn = $img->getClientOriginalExtension();
                $path = public_path('profile/');
                $cover = rand() . '.' . $extn;
                $img->move($path, $profile);
            } else {
                $userInfo1 = DB::table('users')->where(['id' => $request->userId])->select('cover_image')->orderBy('id', 'DESC')->first();
                if (!empty($userInfo1->cover_image)) {
                    $cover = $userInfo1->cover_image;
                } else {
                    $cover = '';
                }
            }
            $data = ['profile_image' => $profile, 'cover_image' => $cover];
            $result = DB::table('users')->where(['id' => $request->userId])->update(@$data);
            if (!empty($result)) {
                $response = [
                    'status' => 1,
                    'userId' => @$request->userId,
                    'message' => 'Your photo uploaded successfully.'
                ];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some error occure, Please try again."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function businessCategory_get() {
        $list = DB::table('listing_category')->where(['status' => 1])->select('*')->orderBy('name', 'ASC')->get();
        if (!empty($list)) {
            $array[] = [
                'id' => 0,
                'name' => 'All',
            ];
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'name' => @$v->name,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "No Data found."];
            return response()->json($response, 200);
        }
    }
    public function businessSubcategoryBycatId_get() {
        if (!empty($_GET['catId'])) {
            $list = DB::table('listing_sub_category')->where(['status' => 1, 'listing_cat_id' => @$_GET['catId']])->select('*')->orderBy('name', 'ASC')->get();
            if (!empty($list)) {
                foreach ($list as $k => $v) {
                    $array[] = [
                        'id' => @$v->id,
                        'name' => @$v->name,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "catId is required."];
            return response()->json($response, 200);
        }
    }
    public function addBusiness_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'businessName' => 'required',
                'name' => 'required',
                //'country' => 'required',
                //'state' => 'required',
                //'city' => 'required',
                'category' => 'required',
                //'subcategory' => 'required',
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                //'description' => 'required',
                'phone' => 'required',
                'email' => 'required',
            ]
        );
        /*if($request->onlineBusiness){
            $onlineBusiness = $request->onlineBusiness;
        }else{
            $onlineBusiness = 0;
        }*/
        @$country = 0;
        @$city = 0;
        @$state = 0;
        $onlineBusiness = 0;
        if (!$validator->fails()) {
            $accessList = DB::table('users')->where(['id' => $request->userId])->select('businessCount')->first();
            if(!empty(@$accessList)){
                if(@$accessList->businessCount > 0){
                }else{
                    $response = ["status" => 0, "error" => "Your business adding limit is over now."];
                    return response()->json($response, 200);exit();
                }
            }
            $data = ['business_name' => @$request->businessName, 'name' => @$request->name, 'country' => @$country, 'city' => @$city, 'state' => @$state, 'online_busi' => @$onlineBusiness, 'address' => @$request->address, 'latitude' => @$request->latitude, 'longitude' => @$request->longitude, 'description' => @$request->description, 'tags' => @$request->tags, 'phone' => @$request->phone, 'email' => @$request->email, 'website' => @$request->website, 'google_map_address' => 0, 'status' => 1, 'category' => @$request->category, 'subcategory' => @$request->subcategory, 'user_id' => $request->userId, 'created_at' => date('Y-m-d H:i:s')];
            $result = DB::table('listing')->insertGetId($data);
            $result1 = 'businessID='.$result;
            $getLogo = DB::table('settings')->first();
            $QRName = $result.'_qrcode.png';
            $directoryPath = 'public/listingQR/';
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true); // Create the directory if it doesn't exist
            }
            //QrCode::format('png')->size(200)->generate($result, $directoryPath . '/' . $QRName);
            QrCode::format('png')->size(200)->format('png')->merge('/public/setting/'.$getLogo->logo)->errorCorrection('M')->generate($result1, $directoryPath . '/' . $QRName);
            $fullUrl = 'listingQR/'. $QRName;
            $update_data = array('qrpath' => $fullUrl);
            DB::table('listing')->where(['id' => $result])->update(@$update_data);
            if (!empty($result)) {
                $image = array();
                if ($file = $request->file('listingGallery')) {
                    //print_r($file);die;
                    foreach ($file as $file) {
                        $image_name = md5(rand(1000, 10000));
                        $ext = strtolower($file->getClientOriginalExtension());
                        $image_full_name = $image_name . '.' . $ext;
                        $uploade_path = public_path('listing/');
                        $image_url = $image_full_name;
                        $file->move($uploade_path, $image_full_name);
                        $image = $image_url;
                        $data = ['image' => $image, 'listing_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
                        DB::table('listing_image')->insertGetId($data);
                    }
                }
                DB::table('users')->where(['id' => @$request->userId])->update(['businessCount' => DB::raw('businessCount-1')]);
                $response = [
                    'status' => 1,
                    'businessId' => @$result,
                    'message' => 'Your listing added successfully!'
                ];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some error occure, Please try again."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function businessDetails_get() {
        if (!empty(@$_GET['businessId'])) {
            $list = DB::table('listing')->where(['id' => @$_GET['businessId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($list) {
                $category = DB::table('listing_category')->where(['id' => @$list->category])->select('name')->orderBy('id', 'DESC')->first();
                $subcategory = DB::table('listing_sub_category')->where(['id' => @$list->subcategory])->select('name')->orderBy('id', 'DESC')->first();
                $country = DB::table('countries')->where(['id' => @$list->country])->select('name')->orderBy('id', 'DESC')->first();
                $state = DB::table('states')->where(['id' => @$list->state])->select('name')->orderBy('id', 'DESC')->first();
                $city = DB::table('cities')->where(['id' => @$list->city])->select('name')->orderBy('id', 'DESC')->first();
                $gallery = [];
                $image = DB::table('listing_image')->where(['listing_id' => @$list->id])->select('*')->orderBy('id', 'DESC')->get();
                if ($image) {
                    foreach ($image as $k => $v) {
                        $gallery[] = ['image' => url('listing/' . $v->image . '')];
                    }
                }
                $organizerName = DB::table('users')->where(['id' => $list->user_id])->select('*')->orderBy('id', 'DESC')->first();
                $organizer = @$organizerName->first_name . ' ' . @$organizerName->last_name;
                if (!empty(@$organizerName->profile_image) && file_exists('public/profile/' . @$organizerName->profile_image . '')) {
                    $profilePic = url('profile/' . @$organizerName->profile_image . '');
                } else {
                    $profilePic = url('profile/unnamed.jpg');
                }
                $productList = DB::table('product')->where(['listing_id' => $list->id])->select('*')->orderBy('id', 'DESC')->get();
                $productArray = [];
                if (count(@$productList) > 0) {
                    foreach (@$productList as $proKey => $proVal) {
                        $cateInfo = DB::table('product_category')->where(['id' => $proVal->category])->select('*')->orderBy('id', 'DESC')->first();
                        $catName = '';
                        $catId = '';
                        if (!empty(@$cateInfo)) {
                            if ($cateInfo->name) {
                                $catName = $cateInfo->name;
                                $catId = $cateInfo->id;
                            }
                        }
                        $image_1 = DB::table('product_image')->where(['product_id' => @$proVal->id])->select('*')->orderBy('id', 'DESC')->first();
                        if (!empty($image_1)) {
                            if (!empty($image_1->image) && file_exists('public/product/' . $image_1->image . '')) {
                                $productImg = url('product/' . $image_1->image . '');
                            }
                        }
						$rating = DB::table('business_review')->where(['product_id' => @$proVal->id])->select('*')->orderBy('id', 'DESC')->get();
						$ratingArray = [];
						if(count($rating) > 0){
							foreach($rating as $ratingKey => $ratingVal){
								$userInfo = DB::table('users')->where(['id' => @$ratingVal->user_id])->select('*')->orderBy('id', 'DESC')->first();
								if (!empty(@$userInfo->profile_image) && file_exists('public/profile/' . @$userInfo->profile_image . '')) {
								    $profilePic = url('profile/' . @$userInfo->profile_image . '');
								} else {
								    $profilePic = url('profile/unnamed.jpg');
								}
								$ratingArray[] = [
									'ratingId' => @$ratingVal->id,
									'userName' => @$userInfo->first_name.' '.@$userInfo->last_name,
									'profilePic' => @$profilePic,
									//'comment'  => @$v->comment,
									'rating'   => @$ratingVal->rating,
								];
							}
						}
                        $productArray[] = [
                            'productId' => @$proVal->id,
                            'productName' => @$proVal->name,
                            'categoryId' => @$catId,
                            'categoryName' => @$catName,
                            'price' => @$proVal->price,
                            'specialPrice' => @$proVal->special_price,
                            'productImg' => @$productImg,
                            'description' => @$proVal->description,
                            'ratingArray' => @$ratingArray,
                        ];
                    }
                }
                $servicesList = DB::table('services')->where(['listing_id' => $list->id])->select('*')->orderBy('id', 'DESC')->get();
                $serArray = [];
                if (count(@$servicesList) > 0) {
                    foreach (@$servicesList as $serKey => $serVal) {
                        $servInfo = DB::table('product_category')->where(['id' => $serVal->id])->select('*')->orderBy('id', 'DESC')->first();
                        $sercatName = '';
                        $sercatId = '';
                        if (!empty(@$servInfo)) {
                            if ($servInfo->name) {
                                $servicecatName = $servInfo->name;
                                $servicecatId = $servInfo->id;
                            }
                        }
                        $image_2 = DB::table('services_image')->where(['service_id' => @$serVal->id])->select('*')->orderBy('id', 'DESC')->first();
                        if (!empty($image_2)) {
                            if (!empty($image_2->image) && file_exists('public/service/' . $image_2->image . '')) {
                                $serviceImg = url('service/' . $image_2->image . '');
                            }
                        }
						$rating = DB::table('business_review')->where(['product_id' => @$serVal->id])->select('*')->orderBy('id', 'DESC')->get();
						$ratingArray = [];
						if(count($rating) > 0){
							foreach($rating as $ratingKey => $ratingVal){
								$userInfo = DB::table('users')->where(['id' => @$ratingVal->user_id])->select('*')->orderBy('id', 'DESC')->first();
								if (!empty(@$userInfo->profile_image) && file_exists('public/profile/' . @$userInfo->profile_image . '')) {
								    $profilePic = url('profile/' . @$userInfo->profile_image . '');
								} else {
								    $profilePic = url('profile/unnamed.jpg');
								}
								$ratingArray[] = [
									'ratingId' => @$ratingVal->id,
									'userName' => @$userInfo->first_name.' '.@$userInfo->last_name,
									'profilePic' => @$profilePic,
									//'comment'  => @$v->comment,
									'rating'   => @$ratingVal->rating,
								];
							}
						}
                        $serArray[] = [
                            'serviceId' => @$serVal->id,
                            'serviceName' => @$serVal->name,
                            'servicecategoryId' => @$servicecatId,
                            'servicecategoryName' => @$servicecatName,
                            'price' => @$serVal->price,
                            'specialPrice' => @$serVal->special_price,
                            'serviceImg' => @$serviceImg,
                            'description' => @$serVal->description,
							'ratingArray' => @$ratingArray,
                        ];
                    }
                }
                if(!empty(@$list->qrpath)){
                    $qrPath = url(@$list->qrpath);
                } else {
                    $qrPath = url('noimage.jpg');
                }
                $array = array(
                    'businessId' => @$list->id,
                    'user_id' => @$list->user_id,
                    'businessName' => @$list->business_name,
                    'name' => @$list->name,
                    'profilePic' => @$profilePic,
                    'country' => @$country->name,
                    'state' => @$state->name,
                    'city' => @$city->name,
                    'category' => @$category->name,
                    'subcategory' => @$subcategory->name,
                    'address' => @$list->address,
                    'latitude' => @$list->latitude,
                    'longitude' => @$list->longitude,
                    'longitude' => @$list->longitude,
                    'onlineBusiness' => @$list->online_busi,
                    'description' => @$list->description,
                    'email' => @$list->email,
                    'phone' => @$list->phone,
                    'website' => @$list->website,
                    'tags' => @$list->tags,
                    'gallery' => @$gallery,
                    'created' => @$list->created_at,
                    'updated' => @$list->updated_at,
                    'product' => @$productArray,
                    'service' => @$serArray,
                    'qr_code' => $qrPath
                );
                $response = [
                    'status' => 1,
                    'businessInfo' => @$array
                ];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No details found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "businessId is required."];
            return response()->json($response, 200);
        }
    }
    public function editBusiness_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'listingId' => 'required',
                'businessName' => 'required',
                'name' => 'required',
                //'country' => 'required',
                //'state' => 'required',
                //'city' => 'required',
                'category' => 'required',
                //'subcategory' => 'required',
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                //'description' => 'required',
                'phone' => 'required',
                'email' => 'required',
            ]
        );
        if ($request->onlineBusiness) {
            $onlineBusiness = $request->onlineBusiness;
        } else {
            $onlineBusiness = 0;
        }
        if (!$validator->fails()) {
            $data = ['business_name' => $request->businessName, 'name' => $request->name, 'country' => $request->country, 'city' => $request->city, 'state' => $request->state, 'online_busi' => $onlineBusiness, 'address' => $request->address, 'latitude' => $request->latitude, 'longitude' => $request->longitude, 'description' => $request->description, 'tags' => @$request->tags, 'phone' => $request->phone, 'email' => $request->email, 'website' => $request->website, 'google_map_address' => 0, 'category' => $request->category, 'subcategory' => $request->subcategory, 'updated_at' => date('Y-m-d H:i:s')];
            //$result = DB::table('listing')->insertGetId($data);
            $result = DB::table('listing')->where(['id' => $request->listingId])->update(@$data);
            $result1 = 'businessID='.$request->listingId;
            $getLogo = DB::table('settings')->first();
            $QRName = $request->listingId.'_qrcode.png';
            $directoryPath = 'public/listingQR/';
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true); // Create the directory if it doesn't exist
            }
            QrCode::format('png')->size(200)->format('png')->merge('/public/setting/'.$getLogo->logo)->errorCorrection('M')->generate($result1, $directoryPath . '/' . $QRName);
            $fullUrl = 'listingQR/'. $QRName;
            $update_data = array('qrpath' => $fullUrl);
            DB::table('listing')->where(['id' => $request->listingId])->update(@$update_data);
            if (!empty($result)) {
                $image = array();
                if ($file = $request->file('listingGallery')) {
                    foreach ($file as $file) {
                        $image_name = md5(rand(1000, 10000));
                        $ext = strtolower($file->getClientOriginalExtension());
                        $image_full_name = $image_name . '.' . $ext;
                        $uploade_path = public_path('listing/');
                        $image_url = $image_full_name;
                        $file->move($uploade_path, $image_full_name);
                        $image = $image_url;
                        $data = ['image' => $image, 'listing_id' => $request->listingId, 'created_at' => date('Y-m-d H:i:s')];
                        DB::table('listing_image')->insertGetId($data);
                    }
                }
                $response = [
                    'status' => 1,
                    'businessId' => @$request->listingId,
                    'message' => 'Your listing updated successfully!'
                ];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some error occure, Please try again."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function myBusiness_get() {
        if (!empty(@$_GET['userId'])) {
            $checkUser = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($checkUser) {
                $businessList = DB::table('listing')->where(['status' => 1, 'user_id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->get();
                if (count($businessList) > 0) {
                    foreach ($businessList as $k => $v) {
                        $category = DB::table('listing_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
                        $image = DB::table('listing_image')->where(['listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                        if (!empty($image->image) && file_exists('public/listing/' . $image->image . '')) {
                            $galleryImg = url('listing/' . $image->image . '');
                        } else {
                            $galleryImg = url('noimage.jpg');
                        }
                        $favBusiness = DB::table('favouritebusiness')->where(['user_id' => @$_GET['userId'], 'listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->get();
                        if (count($favBusiness) > 0) {
                            $favorite = 1;
                        } else {
                            $favorite = 0;
                        }
                        $array[] = [
                            'businessId' => @$v->id,
                            'businessName' => @$v->business_name,
                            'address' => @$v->address,
                            'category' => @$category->name,
                            'image' => @$galleryImg,
                            'favorite' => @$favorite,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "business not found."];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    function addFavbusiness_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'businessId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $numRows = DB::table('favouritebusiness')->where(['user_id' => @$request->userId, 'listing_id' => @$request->businessId])->select('*')->orderBy('id', 'DESC')->count();
            if ($numRows == 0) {
                $myfavview = array(
                    'user_id' => @$request->userId,
                    'listing_id' => @$request->businessId,
                    'created_at' => date("Y-m-d H:i:s")
                );
                $result = DB::table('favouritebusiness')->insertGetId($myfavview);
                if ($result) {
                    $response = ["status" => 1, "message" => "Successfully added in favourite list."];
                    return response()->json($response, 200);
                }
            } else {
                $blockwhere = array(
                    'user_id' => @$request->userId,
                    'listing_id' => @$request->businessId
                );
                $result = DB::table('favouritebusiness')->where($blockwhere)->delete();
                if ($result) {
                    $response = ["status" => 1, "message" => "Successfully removed from favourite list."];
                    return response()->json($response, 200);
                }
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function myFavBusiness_get() {
        $array = [];
        if (!empty(@$_GET['userId'])) {
            $checkUser = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($checkUser) {
                $favBusiness = DB::table('favouritebusiness')->where(['user_id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->get();
                if (count($favBusiness) > 0) {
                    foreach ($favBusiness as $k => $v) {
                        $listing = DB::table('listing')->where(['id' => $v->listing_id])->select('*')->orderBy('id', 'DESC')->first();
                        if (!empty(@$listing)) {
                            $category = DB::table('listing_category')->where(['id' => @$listing->category])->select('name')->orderBy('id', 'DESC')->first();
                            $image = DB::table('listing_image')->where(['listing_id' => @$listing->id])->select('*')->orderBy('id', 'DESC')->first();
                            if (!empty($image->image) && file_exists('public/listing/' . $image->image . '')) {
                                $galleryImg = url('listing/' . $image->image . '');
                            } else {
                                $galleryImg = url('noimage.jpg');
                            }
                            $favBusiness = DB::table('favouritebusiness')->where(['user_id' => @$_GET['userId'], 'listing_id' => @$listing->id])->select('*')->orderBy('id', 'DESC')->get();
                            if (count($favBusiness) > 0) {
                                $favorite = 1;
                            } else {
                                $favorite = 0;
                            }
                            $array[] = [
                                'businessId' => @$listing->id,
                                'user_id' => @$listing->user_id,
                                'businessName' => @$listing->business_name,
                                'address' => @$listing->address,
                                'category' => @$category->name,
                                'image' => @$galleryImg,
                                'favorite' => @$favorite,
                            ];
                        }
                    }
                    $response = ["status" => 1, "list" => @$array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "business not found."];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function businessByCategory_get() {
        if (!empty(@$_GET['categoryId'])) {
            $businessList = DB::table('listing')->where(['category' => @$_GET['categoryId'], 'status' => 1])->select('*')->orderBy('id', 'DESC')->get();
            if (count($businessList) > 0) {
                foreach ($businessList as $k => $v) {
                    $category = DB::table('listing_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
                    $image = DB::table('listing_image')->where(['listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                    if (!empty($image->image) && file_exists('public/listing/' . $image->image . '')) {
                        $galleryImg = url('listing/' . $image->image . '');
                    } else {
                        $galleryImg = url('noimage.jpg');
                    }
                    $array[] = [
                        'businessId' => @$v->id,
                        'user_id' => @$v->user_id,
                        'businessName' => @$v->business_name,
                        'address' => @$v->address,
                        'category' => @$category->name,
                        'image' => @$galleryImg,
                    ];
                }
                $response = ["status" => 1, "list" => @$array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "business not found."];
                return response()->json($response, 200);
            }
        } else {
            $businessList = DB::table('listing')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
            if ($businessList) {
                foreach ($businessList as $k => $v) {
                    $category = DB::table('listing_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
                    $image = DB::table('listing_image')->where(['listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                    if (!empty($image->image) && file_exists('public/listing/' . $image->image . '')) {
                        $galleryImg = url('listing/' . $image->image . '');
                    } else {
                        $galleryImg = url('noimage.jpg');
                    }
                    $array[] = [
                        'businessId' => @$v->id,
                        'businessName' => @$v->business_name,
                        'user_id' => @$v->user_id,
                        'address' => @$v->address,
                        'category' => @$category->name,
                        'image' => @$galleryImg,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "business not found."];
                return response()->json($response, 200);
            }
        }
    }
    public function searchBisuness_get() {
        $location = (!empty(@$_GET['location']) ? @$_GET['location'] : '');
        $latitude = (!empty(@$_GET['latitude']) ? @$_GET['latitude'] : '');
        $longitude = (!empty(@$_GET['longitude']) ? @$_GET['longitude'] : '');
        $radius = 500;
        if (!empty($latitude) && !empty($longitude)) {
            $searchSql2 = "SELECT *, ( 6367 * acos( cos( radians('" . $latitude . "') ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians('" . $longitude . "') ) + sin( radians('" . $latitude . "') ) * sin( radians( `latitude` ) ) ) ) AS distance FROM `listing` having `distance` < '" . $radius . "' ";
            $searchSql2 .= " AND (status = '1') ORDER BY distance DESC, business_name ASC, name ASC";
        } else if ($latitude == '' && $longitude == '' && $location != '') {
            $searchSql2 = "SELECT * FROM listing WHERE address LIKE '%" . $location . "%' ";
            $searchSql2 .= " AND (status = '1') ORDER BY  business_name ASC, name ASC";
        } else {
            $searchSql2 = "SELECT * FROM listing WHERE status = '1' ORDER BY  business_name ASC, name ASC";
        }
        $list = DB::select($searchSql2);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $category = DB::table('listing_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
                $image = DB::table('listing_image')->where(['listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                if (!empty($image->image) && file_exists('public/listing/' . $image->image . '')) {
                    $galleryImg = url('listing/' . $image->image . '');
                } else {
                    $galleryImg = url('noimage.jpg');
                }
                $array[] = [
                    'businessId' => @$v->id,
                    'businessName' => @$v->business_name,
                    'address' => @$v->address,
                    'category' => @$category->name,
                    'image' => @$galleryImg,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "business not found."];
            return response()->json($response, 200);
        }
    }
    public function changePassword_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'oldPassword' => 'required',
                'newPassword' => 'required|min:6',
                'confirmPassword' => 'required|same:newPassword',
            ]
        );
        if (!$validator->fails()) {
            $userInfo = DB::table('users')->where(['id' => @$request->userId])->select('password')->orderBy('id', 'DESC')->first();
            if (md5(@$request->oldPassword) != $userInfo->password) {
                $response = ["status" => 0, "error" => "Old password is not matched!"];
                return response()->json($response, 200);
                exit();
            }
            $data = ['password' => md5($request->password)];
            $result = DB::table('users')->where(['id' => $request->userId])->update(@$data);
            if ($result) {
                $response = ["status" => 1, "message" => "Password updated successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some problems occurred, please try again!"];
                return response()->json($response, 200);
                exit();
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function addEvent_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'eventName' => 'required',
                'description' => 'required',
                'category' => 'required',
                'date' => 'required',
                //'time' => 'required',
                'location' => 'required',
                //'country' => 'required',
                //'state' => 'required',
                //'city' => 'required',
                //'zipcode' => 'required',
                //'latitude' => 'required',
                //'longitude' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]
        );
        if (!$validator->fails()) {
			$accessList = DB::table('users')->where(['id' => @$request->userId])->select('eventCount')->first();
            if(!empty(@$accessList)){
                if(@$accessList->eventCount > 0){
                }else{
                    $response = ["status" => 0, "error" => "Your event adding limit is over now."];
                    return response()->json($response, 200);exit();
                }
            }
            if ($request->tags) {
                $tags = implode(',', $request->tags);
            } else {
                $tags = '';
            }
            $start_date = '';
            if ($request->date) {
                $startDate = $request->date . ' ' . $request->time;
                $start_date = date('Y-m-d H:i:s', strtotime($startDate));
            }
			$start_time = '';
			if ($request->start_time) {
                $start_time = $request->start_time;
                $start_time = date('H:i:s', strtotime($start_time));
            }
			$end_time = '';
			if ($request->end_time) {
                $end_time = $request->end_time;
                $end_time = date('H:i:s', strtotime($end_time));
            }
            //$endDate = $request->endDate.' '.$request->endTime;
            //$end_date = date('Y-m-d H:i:s', strtotime($endDate));
            $data = ['event_name' => @$request->eventName, 'description' => @$request->description, 'category' => @$request->category, 'user_id' => @$request->userId, 'start_date' => @$start_date, 'location' => @$request->location, 'country' => @$request->country, 'state' => @$request->state, 'city' => @$request->city, 'latitude' => @$request->latitude, 'longitude' => @$request->longitude, 'zipcode' => @$request->zipcode, 'status' => 1, 'email' => @$request->email, 'phone' => @$request->phone, 'website' => @$request->website, 'tags' => @$tags, 'start_time' => @$start_time, 'end_time' => @$end_time, 'created_at' => date('Y-m-d H:i:s')];
            $result = DB::table('events')->insertGetId($data);
            if ($result) {
                if (!empty($request->eventTicket)) {
                    $i = 0;
                    foreach ($request->eventTicket as $k => $v) {
                        $academics = [
                            'ticket_name' => @$v['ticketName'],
                            'ticket_price' => @$v['ticketPrice'],
                            'ticket_offer_price' => @$v['ticketOfferPrice'],
                            'feature' => @$v['ticketFeatures'],
                            'event_id' => @$result,
                            'created_at' => date('Y-m-d H:i:s'),
                        ];
                        DB::table('event_ticket')->insertGetId($academics);
                        $i++;
                    }
                }
                $image = array();
                if ($file = $request->file('eventImage')) {
                    foreach ($file as $file) {
                        $image_name = md5(rand(1000, 10000));
                        $ext = strtolower($file->getClientOriginalExtension());
                        $image_full_name = $image_name . '.' . $ext;
                        $uploade_path = public_path('events/');
                        $image_url = $image_full_name;
                        $file->move($uploade_path, $image_full_name);
                        $image = $image_url;
                        $data = ['image' => $image, 'event_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
                        DB::table('event_image')->insertGetId($data);
                    }
                }
				DB::table('users')->where(['id' => @$request->userId])->update(['eventCount' => DB::raw('eventCount-1')]);
                $response = ["status" => 1, "eventId" => $result, "message" => "Your event added sucessfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some problems occurred, please try again!"];
                return response()->json($response, 200);
                exit();
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function editEvent_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
				'eventId' => 'required',
				'eventName' => 'required',
				'description' => 'required',
				'category' => 'required',
				'date' => 'required',
				//'time' => 'required',
				'location' => 'required',
				//'country' => 'required',
				//'state' => 'required',
				//'city' => 'required',
				//'zipcode' => 'required',
				//'latitude' => 'required',
				//'longitude' => 'required',
				'email' => 'required',
				'phone' => 'required',
				'start_time' => 'required',
				'end_time' => 'required',
            ]
        );
        if (!$validator->fails()) {
            if ($request->tags) {
                $tags = implode(',', $request->tags);
            } else {
                $tags = '';
            }
            $startDate = $request->date . ' ' . $request->time;
            $start_date = date('Y-m-d H:i:s', strtotime($startDate));
			$start_time = '';
			if ($request->start_time) {
                $start_time = $request->start_time;
                $start_time = date('H:i:s', strtotime($start_time));
            }
			$end_time = '';
			if ($request->end_time) {
                $end_time = $request->end_time;
                $end_time = date('H:i:s', strtotime($end_time));
            }
            $data = ['event_name' => @$request->eventName, 'description' => @$request->description, 'category' => @$request->category, 'start_date' => @$start_date, 'location' => @$request->location, 'country' => @$request->country, 'state' => @$request->state, 'city' => @$request->city, 'latitude' => @$request->latitude, 'longitude' => @$request->longitude, 'zipcode' => @$request->zipcode, 'email' => @$request->email, 'phone' => @$request->phone, 'website' => @$request->website, 'tags' => $tags, 'start_time' => @$start_time, 'end_time' => @$end_time, 'updated_at' => date('Y-m-d H:i:s')];
            $result = DB::table('events')->where(['id' => @$request->eventId])->update(@$data);
            if ($result) {
                if (!empty($request->eventTicket)) {
                    DB::table('event_ticket')->where('event_id', @$request->eventId)->delete();
                    $i = 0;
                    foreach ($request->eventTicket as $k => $v) {
                        $academics = [
                            'ticket_name' => @$v['ticketName'],
                            'ticket_price' => @$v['ticketPrice'],
                            'ticket_offer_price' => @$v['ticketOfferPrice'],
                            'feature' => @$v['ticketFeatures'],
                            'event_id' => @$request->eventId,
                            'created_at' => date('Y-m-d H:i:s'),
                        ];
                        DB::table('event_ticket')->insertGetId($academics);
                        $i++;
                    }
                }
                $image = array();
                if ($file = $request->file('eventImage')) {
                    foreach ($file as $file) {
                        $image_name = md5(rand(1000, 10000));
                        $ext = strtolower($file->getClientOriginalExtension());
                        $image_full_name = $image_name . '.' . $ext;
                        $uploade_path = public_path('events/');
                        $image_url = $image_full_name;
                        $file->move($uploade_path, $image_full_name);
                        $image = $image_url;
                        $data = ['image' => $image, 'event_id' => @$request->eventId, 'created_at' => date('Y-m-d H:i:s')];
                        DB::table('event_image')->insertGetId($data);
                    }
                }
                $response = ["status" => 1, "eventId" => @$request->eventId, "message" => "Your event updated sucessfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some problems occurred, please try again!"];
                return response()->json($response, 200);
                exit();
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function eventDetails_get() {
        if (!empty($_GET['eventId'])) {
            $list = DB::table('events')->where(['status' => 1, 'id' => $_GET['eventId']])->select('*')->orderBy('id', 'DESC')->first();
            if (!empty($list)) {
                $category = DB::table('event_category')->where(['status' => 1, 'id' => $list->category])->select('*')->orderBy('id', 'DESC')->first();
                $startDate = $list->start_date;
                $start_date = date('Y-m-d', strtotime($startDate));
                $time = date('H:i:s', strtotime($startDate));
                //$endDate = $list->end_date;
                //$end_date = date('Y-m-d H:i:s', strtotime($endDate));
                $ticket = [];
                $eventTicket = DB::table('event_ticket')->where(['event_id' => $list->id])->select('*')->orderBy('id', 'DESC')->get();
                if (!empty($eventTicket)) {
                    foreach ($eventTicket as $k => $v) {
                        $ticket[] = [
                            'ticketName' => @$v->ticket_name,
                            'ticketPrice' => @$v->ticket_price,
                            'ticketOfferPrice' => @$v->ticket_offer_price,
                            'ticketFeatures' => @$v->feature,
                        ];
                    }
                }
                $eventImg = [];
                $eventGallery = DB::table('event_image')->where(['event_id' => @$list->id])->select('*')->orderBy('id', 'DESC')->get();
                if (!empty($eventGallery)) {
                    foreach ($eventGallery as $k => $v) {
                        $eventImg[] = ['image' => url('events/' . $v->image . '')];
                    }
                }
                $eventImg_1 = DB::table('event_image')->where(['event_id' => @$list->id])->select('*')->orderBy('id', 'DESC')->first();
                if (!empty($eventImg_1->image) && file_exists('public/events/' . $eventImg_1->image . '')) {
                    $bannerImg = url('events/' . $eventImg_1->image . '');
                } else {
                    $bannerImg = '';
                }
                $selected_tags = array();
                if (!empty($list->tags)) {
                    $explodeTags = explode(',', $list->tags);
                    foreach ($explodeTags as $k => $v) {
                        $eventTags = DB::table('tags')->where(['id' => $v])->select('*')->orderBy('name', 'DESC')->first();
                        $selected_tags[] = @$eventTags->name;
                    }
                }
                if ($list->user_id == 0) {
                    $organizer = 'Admin';
                    $profilePic = url('profile/unnamed.jpg');
                } else {
                    $organizerName = DB::table('users')->where(['id' => $list->user_id])->select('*')->orderBy('id', 'DESC')->first();
                    $organizer = @$organizerName->first_name . ' ' . @$organizerName->last_name;
                    if (!empty(@$organizerName->profile_image) && file_exists('public/profile/' . @$organizerName->profile_image . '')) {
                        $profilePic = url('profile/' . @$organizerName->profile_image . '');
                    } else {
                        $profilePic = url('profile/unnamed.jpg');
                    }
                }
                $inviteeProfile = [];
                $inviteeId = [];
                $invitation = DB::table('invitation')->where(['event_id' => @$list->id])->select('*')->get();
                if (count($invitation) > 0) {
                    foreach ($invitation as $k => $v) {
                        $get_receiverInfo = DB::table('repeat_invitation')->where(['invitation_id' => @$v->id])->select('*')->first();
						if($get_receiverInfo){
							if($get_receiverInfo->receiver_id){
								$inviteeId[] = $get_receiverInfo->receiver_id;
							}
						}
                    }
                }
                if (count($inviteeId) > 0) {
                    $inviteeId = array_unique($inviteeId);
                    $eventAttendeeId = join(",", $inviteeId);
                    $attendeeUser = DB::table('users')->whereRaw("status = 1 AND id IN($eventAttendeeId)")->select('*')->orderBy('id', 'ASC')->get();
                    if (count($attendeeUser) > 0) {
                        $i = 1;
                        foreach ($attendeeUser as $k => $v) {
                            if (@$i == 1) {
                                $class = '';
                            } else {
                                $class = 'position-absolute z-1';
                            }
                            if (!empty(@$v->profile_image) && file_exists('public/profile/' . @$v->profile_image . '')) {
                                $profile_1 = url('profile/' . @$v->profile_image . '');
                            } else {
                                $profile_1 = url('profile/unnamed.jpg');
                            }
                            $inviteeProfile[] = [
                                'userId' => @$v->id,
                                'userName' => @$v->first_name . ' ' . @$v->last_name,
                                'profile' => @$profile_1
                            ];
                            //$inviteeProfile.='<img class="'.@$class.'" src="'.@$profile_1.'" alt="" >';
                            $i++;
                        }
                    } else {
                        $inviteeProfile = [];
                    }
                } else {
                    $inviteeProfile = [];
                }
                /*if(!empty(@$organizerName->profile_image) && file_exists('public/profile/'.@$organizerName->profile_image.'')){
                    $profilePic = url('profile/'.@$organizerName->profile_image.'');
                } else {
                    $profilePic = url('profile/unnamed.jpg');
                }*/
                $array = [
                    'eventId' => @$list->id,
                    'eventName' => @$list->event_name,
                    'description' => @$list->description,
                    'category' => @$category->name,
                    'date' => $start_date,
                    'time' => $time,
                    'start_time' => @$list->start_time,
                    'end_time'   => @$list->end_time,
                    'location' => @$list->location,
                    'country' => @$list->country,
                    'state' => @$list->state,
                    'city' => @$list->city,
                    'zipcode' => @$list->zipcode,
                    'latitude' => @$list->latitude,
                    'longitude' => @$list->longitude,
                    'email' => @$list->email,
                    'phone' => @$list->phone,
                    'website' => @$list->website,
                    'tags' => @$selected_tags,
                    //'eventTicket' => @$ticket,
                    'eventImg' => @$eventImg,
                    'bannerImg' => @$bannerImg,
                    'organizer' => @$organizer,
                    'invitedUser' => @$inviteeProfile,
                    'organizerPic' => @$profilePic,
                ];
                $response = ["status" => 1, "eventDetail" => @$array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No data found."];
                return response()->json($response, 200);
                exit();
            }
        } else {
            $response = ["status" => 0, "error" => "eventId is required."];
            return response()->json($response, 200);
        }
    }
    public function myEvent_get() {
        if (!empty(@$_GET['userId'])) {
            $array = [];
            $checkUser = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($checkUser) {
                $eventsList = DB::table('events')->where(['status' => 1, 'user_id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->get();
                if (count($eventsList) > 0) {
                    foreach ($eventsList as $k => $v) {
                        $category = DB::table('event_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
                        $image = DB::table('event_image')->where(['event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                        if (!empty($image->image) && file_exists('public/events/' . $image->image . '')) {
                            $galleryImg = url('events/' . $image->image . '');
                        } else {
                            $galleryImg = url('noimage.jpg');
                        }
                        $startDate = $v->start_date;
                        $date = date('Y-m-d', strtotime($startDate));
                        $time = date('H:i:s', strtotime($startDate));
                        $userName = $checkUser->first_name . ' ' . $checkUser->last_name;
                        if (!empty($checkUser->profile_image) && file_exists('public/profile/' . $checkUser->profile_image . '')) {
                            $userPic = url('profile/' . $checkUser->profile_image . '');
                        } else {
                            $userPic = url('noimage.jpg');
                        }
                        $array[] = [
                            'eventId' => @$v->id,
                            'eventName' => @$v->event_name,
                            'date' => $date,
                            'time' => $time,
							'start_time' => @$v->start_time,
							'end_time' => @$v->end_time,
                            'location' => @$v->location,
                            'category' => @$category->name,
                            'image' => @$galleryImg,
                            'userName' => @$userName,
                            'userPic' => @$userPic,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "events not found."];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    function addFavevent_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'eventId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $numRows = DB::table('favouriteevent')->where(['user_id' => @$request->userId, 'event_id' => @$request->eventId])->select('*')->orderBy('id', 'DESC')->count();
            if ($numRows == 0) {
                $myfavview = array(
                    'user_id' => @$request->userId,
                    'event_id' => @$request->eventId,
                    'created_at' => date("Y-m-d H:i:s")
                );
                $result = DB::table('favouriteevent')->insertGetId($myfavview);
                if ($result) {
                    $response = ["status" => 1, "message" => "Successfully added in favourite list."];
                    return response()->json($response, 200);
                }
            } else {
                $blockwhere = array(
                    'user_id' => @$request->userId,
                    'event_id' => @$request->eventId
                );
                $result = DB::table('favouriteevent')->where($blockwhere)->delete();
                if ($result) {
                    $response = ["status" => 1, "message" => "Successfully removed from favourite list."];
                    return response()->json($response, 200);
                }
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function myFavEvent_get() {
        if (!empty(@$_GET['userId'])) {
            $checkUser = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($checkUser) {
                $eventsList1 = DB::table('favouriteevent')->where(['user_id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->get();
                if (count($eventsList1) > 0) {
                    foreach ($eventsList1 as $k => $v) {
                        $eventsList = DB::table('events')->where(['status' => 1, 'id' => $v->event_id])->select('*')->orderBy('id', 'DESC')->first();
                        $category = DB::table('event_category')->where(['id' => @$eventsList->category])->select('name')->orderBy('id', 'DESC')->first();
                        $image = DB::table('event_image')->where(['event_id' => @$eventsList->id])->select('*')->orderBy('id', 'DESC')->first();
                        if (!empty($image->image) && file_exists('public/events/' . $image->image . '')) {
                            $galleryImg = url('events/' . $image->image . '');
                        } else {
                            $galleryImg = url('noimage.jpg');
                        }
                        $startDate = @$eventsList->start_date;
                        $date = date('Y-m-d', strtotime($startDate));
                        $time = date('H:i:s', strtotime($startDate));
                        $eventAddedBy = DB::table('users')->where(['id' => @$eventsList->user_id])->select('*')->orderBy('id', 'DESC')->first();
                        $userName = $eventAddedBy->first_name . ' ' . $eventAddedBy->last_name;
                        if (!empty($checkUser->profile_image) && file_exists('public/profile/' . $checkUser->profile_image . '')) {
                            $userPic = url('profile/' . $checkUser->profile_image . '');
                        } else {
                            $userPic = url('noimage.jpg');
                        }
                        $array[] = [
                            'eventId' => @$eventsList->id,
                            'eventName' => @$eventsList->event_name,
                            'date' => $date,
                            'time' => $time,
							'start_time' => @$eventsList->start_time,
							'end_time' => @$eventsList->end_time,
                            'location' => @$eventsList->location,
                            'category' => @$category->name,
                            'image' => @$galleryImg,
                            'userName' => @$userName,
                            'userPic' => @$userPic,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "business not found."];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function upcomingEvent_get() {
        //$where = "status = '1' and DATE(end_date) > ".date('Y-m-d')."";
        //$eventsList = DB::table('events')->where(['status' => 1])->whereDate('DATE(start_date)', '>=', date('Y-m-d'))->select('*')->orderBy('id', 'DESC')->get();
        $date = date('Y-m-d');
        $eventsList = DB::select("select * from events where DATE(start_date) > '$date' order by DATE(start_date) ASC");
        if ($eventsList) {
            foreach ($eventsList as $k => $v) {
                $category = DB::table('event_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
                $image = DB::table('event_image')->where(['event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                if (!empty($image->image) && file_exists('public/events/' . $image->image . '')) {
                    $galleryImg = url('events/' . $image->image . '');
                } else {
                    $galleryImg = url('noimage.jpg');
                }
                $startDate = $v->start_date;
                $date = date('Y-m-d', strtotime($startDate));
                $time = date('H:i:s', strtotime($startDate));
                if ($v->user_id == 0) {
                    $userPic = url('noimage.jpg');
                    $userName = 'Admin';
                } else {
                    $checkUser = DB::table('users')->where(['id' => $v->user_id])->select('*')->orderBy('id', 'DESC')->first();
                    $userName = $checkUser->first_name . ' ' . $checkUser->last_name;
                    if (!empty($checkUser->profile_image) && file_exists('public/profile/' . $checkUser->profile_image . '')) {
                        $userPic = url('profile/' . $checkUser->profile_image . '');
                    } else {
                        $userPic = url('noimage.jpg');
                    }
                }
                $array[] = [
                    'eventId' => @$v->id,
                    'eventName' => @$v->event_name,
                    'date' => $date,
                    'time' => $time,
                    'start_time' => @$v->start_time,
                    'end_time' => @$v->end_time,
                    'location' => @$v->location,
                    'category' => @$category->name,
                    'image' => @$galleryImg,
                    'userName' => @$userName,
                    'userPic' => @$userPic,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "events not found."];
            return response()->json($response, 200);
        }
    }
    public function searchEvent_get() {
        $location = (!empty(@$_GET['location']) ? @$_GET['location'] : '');
        $latitude = (!empty(@$_GET['latitude']) ? @$_GET['latitude'] : '');
        $longitude = (!empty(@$_GET['longitude']) ? @$_GET['longitude'] : '');
        $radius = 500;
        if (!empty($latitude) && !empty($longitude)) {
            $searchSql2 = "SELECT *, ( 6367 * acos( cos( radians('" . $latitude . "') ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians('" . $longitude . "') ) + sin( radians('" . $latitude . "') ) * sin( radians( `latitude` ) ) ) ) AS distance FROM `events` having `distance` < '" . $radius . "' ";
            $searchSql2 .= " AND (status = '1') ORDER BY distance DESC, event_name ASC";
        } else if ($latitude == '' && $longitude == '' && $location != '') {
            $searchSql2 = "SELECT * FROM events WHERE location LIKE '%" . $location . "%' ";
            $searchSql2 .= " AND (status = '1') ORDER BY  event_name ASC";
        } else {
            $searchSql2 = "SELECT * FROM events WHERE status = '1' ORDER BY  event_name ASC";
        }
        $list = DB::select($searchSql2);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $category = DB::table('event_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
                $image = DB::table('event_image')->where(['event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                if (!empty($image->image) && file_exists('public/events/' . $image->image . '')) {
                    $galleryImg = url('events/' . $image->image . '');
                } else {
                    $galleryImg = url('noimage.jpg');
                }
                $startDate = @$v->start_date;
                $date = date('Y-m-d', strtotime($startDate));
                $time = date('H:i:s', strtotime($startDate));
                if ($v->user_id == 0) {
                    $userPic = url('noimage.jpg');
                    $userName = 'Admin';
                } else {
                    $checkUser = DB::table('users')->where(['id' => $v->user_id])->select('*')->orderBy('id', 'DESC')->first();
                    $userName = $checkUser->first_name . ' ' . $checkUser->last_name;
                    if (!empty($checkUser->profile_image) && file_exists('public/profile/' . $checkUser->profile_image . '')) {
                        $userPic = url('profile/' . $checkUser->profile_image . '');
                    } else {
                        $userPic = url('noimage.jpg');
                    }
                }
                $array[] = [
                    'eventId' => @$v->id,
                    'eventName' => @$v->event_name,
                    'date' => $date,
                    'time' => $time,
                    'location' => @$v->location,
                    'category' => @$category->name,
                    'image' => @$galleryImg,
                    'userName' => @$userName,
                    'userPic' => @$userPic,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "event not found."];
            return response()->json($response, 200);
        }
    }
    public function invitations_get(){
        $list = DB::table('users')->where(['user_type' => 4, 'status' => 1])->select('*')->orderBy('id', 'DESC')->get();
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                if (!empty($v->profile_image) && file_exists('public/profile/' . $v->profile_image . '')) {
                    $userPic = url('profile/' . $v->profile_image . '');
                } else {
                    $userPic = url('noimage.jpg');
                }
                $array[] = [
                    'userId' => @$v->id,
                    'userName' => @$v->first_name . ' ' . @$v->last_name,
                    'userPic' => @$userPic,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "data not found."];
            return response()->json($response, 200);
        }
    }
    public function sendInvitation_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'senderId' => 'required',
                'receiverId' => 'required',
                //'hour' => 'required',
                'amount' => 'required',
                'eventId' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $accessList = DB::table('users')->where(['id' => @$request->senderId])->select('invitationCount')->first();
			if(!empty(@$accessList)) {
				if(@$accessList->invitationCount > 0) {
				} else {
					$response = ["status" => 0, "error" => "Your sending invitation limit is over now."];
                    return response()->json($response, 200);exit();
				}
			}
            $data = ['event_id' => @$request->eventId, 'status' => '2', 'created_at' => date("Y-m-d H:i:s")];
            $result = DB::table('invitation')->insertGetId($data);
            if ($result) {
				DB::table('users')->where(['id' => @$request->senderId])->update(['invitationCount' => DB::raw('invitationCount-1')]);
                if (@$request->start_time) {
                    $start_time = date('H:i:s', strtotime(@$request->start_time));
                } else {
                    $start_time = '';
                }
                if (@$request->end_time) {
                    $end_time = date('H:i:s', strtotime(@$request->end_time));
                } else {
                    $end_time = '';
                }
                $repeatData = ['sender_id' => @$request->senderId, 'receiver_id' => @$request->receiverId, 'amount' => @$request->amount, 'start_time' => @$start_time, 'end_time' => $end_time, 'status' => '2', 'invitation_id' => $result, 'created_at' => date("Y-m-d H:i:s")];
                DB::table('repeat_invitation')->insertGetId($repeatData);
                //Notification//
                $userInfo = DB::table('users')->where(['id' => @$request->senderId, 'status' => 1])->select('*')->orderBy('id', 'DESC')->first();
                $notiMsg = '' . @$userInfo->first_name . ' ' . @$userInfo->last_name . ' has invite you for join event.';
                $notiData = ['noti_msg' => $notiMsg, 'event_id' => @$request->eventId, 'sender_id' => @$request->senderId, 'receiver_id' => @$request->receiverId, 'type' => 1, 'status' => '1', 'created_at' => date("Y-m-d H:i:s")];
                DB::table('notifications')->insertGetId($notiData);
                //Notification//
                $response = ["status" => 1, 'invitationId' => $result, "message" => "Your invitation sent successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function invitationAccept_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'invitationId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $data = ['status' => '1', 'updated_at' => date("Y-m-d H:i:s"), 'comment' => $request->comment];
            $result = DB::table('invitation')->where(['id' => $request->invitationId])->update(@$data);
            $inviInfo = DB::table('repeat_invitation')->where(['invitation_id' => $request->invitationId])->select('*')->orderBy('id', 'DESC')->first();
            $invitationInfo = DB::table('invitation')->where(['id' => $request->invitationId])->select('*')->orderBy('id', 'DESC')->first();
            //Notification//
            $userInfo = DB::table('users')->where(['id' => @$inviInfo->sender_id, 'status' => 1])->select('*')->orderBy('id', 'DESC')->first();
            $receiverInfo = DB::table('users')->where(['id' => @$inviInfo->receiver_id, 'status' => 1])->select('*')->orderBy('id', 'DESC')->first();
            $notiMsg = '' . @$userInfo->first_name . ' ' . @$userInfo->last_name . ' your event invitation is accepted from ' . @$receiverInfo->first_name . ' ' . @$receiverInfo->last_name . '.';
            $notiData = ['noti_msg' => $notiMsg, 'event_id' => @$invitationInfo->event_id, 'sender_id' => @$inviInfo->sender_id, 'receiver_id' => @$inviInfo->receiver_id, 'type' => 2, 'status' => '1', 'created_at' => date("Y-m-d H:i:s")];
            DB::table('notifications')->insertGetId($notiData);
            //Notification//
            if ($result) {
                DB::table('repeat_invitation')->where(['invitation_id' => $request->invitationId])->orderBy('id', 'desc')->take(1)->update(['status' => '1', 'updated_at' => date("Y-m-d H:i:s")]);
                $response = ["status" => 1, 'invitationId' => $request->invitationId, "message" => "Request accepted successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function invitationReject_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'invitationId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $data = ['status' => '0', 'updated_at' => date("Y-m-d H:i:s"), 'comment' => $request->comment];
            $result = DB::table('invitation')->where(['id' => $request->invitationId])->update(@$data);
            if ($result) {
                $inviInfo = DB::table('repeat_invitation')->where(['invitation_id' => $request->invitationId])->select('*')->orderBy('id', 'DESC')->first();
                $invitationInfo = DB::table('invitation')->where(['id' => $request->invitationId])->select('*')->orderBy('id', 'DESC')->first();
                //Notification//
                $userInfo = DB::table('users')->where(['id' => @$inviInfo->sender_id, 'status' => 1])->select('*')->orderBy('id', 'DESC')->first();
                $receiverInfo = DB::table('users')->where(['id' => @$inviInfo->receiver_id, 'status' => 1])->select('*')->orderBy('id', 'DESC')->first();
                $notiMsg = '' . $userInfo->first_name . ' ' . $userInfo->last_name . ' your event invitation is rejected from ' . $receiverInfo->first_name . ' ' . $receiverInfo->last_name . '.';
                $notiData = ['noti_msg' => $notiMsg, 'event_id' => @$invitationInfo->event_id, 'sender_id' => @$inviInfo->sender_id, 'receiver_id' => @$inviInfo->receiver_id, 'type' => 2, 'status' => '1', 'created_at' => date("Y-m-d H:i:s")];
                DB::table('notifications')->insertGetId($notiData);
                //Notification//
                DB::table('repeat_invitation')->where(['invitation_id' => $request->invitationId])->orderBy('id', 'desc')->take(1)->update(['status' => '0', 'updated_at' => date("Y-m-d H:i:s")]);
                $response = ["status" => 1, 'invitationId' => $request->invitationId, "message" => "Request rejected successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function acceptedInvitationList_get() {
        if (!empty(@$_GET['userId'])) {
            $userCheck = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->count();
            if ($userCheck > 0) {
                $Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, invitation.comment, invitation.comment, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status, repeat_invitation.start_time, repeat_invitation.end_time FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='1' AND repeat_invitation.status='1' AND (repeat_invitation.sender_id = '" . @$_GET['userId'] . "' OR repeat_invitation.receiver_id = '" . @$_GET['userId'] . "')";
                $list = DB::select($Sql);
                if ($list) {
                    foreach ($list as $k => $v) {
                        if (!empty(@$v->start_time)) {
                            $startTime = date('H:i:s', strtotime(@$v->start_time));
                        } else {
                            $startTime = '';
                        }
                        if (!empty(@$v->end_time)) {
                            $endTime = date('H:i:s', strtotime(@$v->end_time));
                        } else {
                            $endTime = '';
                        }
                        $userInfo = DB::select("select first_name, last_name from users where user_type = '4' AND (id = '" . $v->sender_id . "' OR id = '" . $v->receiver_id . "') LIMIT 1");
                        $eventInfo = DB::select("select event_name, location, start_date from events where id = '" . $v->event_id . "' LIMIT 1");
                        if (!empty(@$eventInfo[0]->start_date)) {
                            $start_date = date('Y-m-d H:i:s', strtotime(@$eventInfo[0]->start_date));
                        } else {
                            $start_date = '';
                        }
                        $getEvent_image = DB::table('event_image')->where('event_id', @$v->event_id)->first();
                        if (!empty(@$getEvent_image->image) && file_exists('public/events/' . $getEvent_image->image . '')) {
                            $image = url('events/'.@$getEvent_image->image.'');
                        } else {
                            $image = url('noimage.jpg');;
                        }
                        $array[] = [
                            'invitationId' => @$v->invId,
                            'eventId' => @$v->event_id,
                            'image' => $image,
							'receiver_id' => @$v->receiver_id,
                            'sender_id' => @$v->sender_id,
                            'athleteName' => @$userInfo[0]->first_name . ' ' . @$userInfo[0]->last_name,
                            'eventName' => @$eventInfo[0]->event_name,
                            'location' => @$eventInfo[0]->location,
                            'eventDate' => @$start_date,
                            'startTime' => @$startTime,
                            'endTime' => @$endTime,
                            'amount' => @$v->amount,
                            'hour' => @$v->hour,
                            'comment' => @$v->comment,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => 'data not found.'];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => 'user not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function pendingInvitationList_get() {
        if (!empty(@$_GET['userId'])) {
            $userCheck = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->count();
            if ($userCheck > 0) {
                $Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status, repeat_invitation.start_time, repeat_invitation.end_time FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='2' AND repeat_invitation.status='2' AND (repeat_invitation.sender_id = '" . @$_GET['userId'] . "' OR repeat_invitation.receiver_id = '" . @$_GET['userId'] . "')";
                $list = DB::select($Sql);
                if ($list) {
                    foreach ($list as $k => $v) {
                        if (!empty(@$v->start_time)) {
                            $startTime = date('H:i:s', strtotime(@$v->start_time));
                        } else {
                            $startTime = '';
                        }
                        if (!empty(@$v->end_time)) {
                            $endTime = date('H:i:s', strtotime(@$v->end_time));
                        } else {
                            $endTime = '';
                        }
                        $userInfo = DB::select("select first_name, last_name from users where user_type = '4' AND (id = '" . $v->sender_id . "' OR id = '" . $v->receiver_id . "') LIMIT 1");
                        $eventInfo = DB::select("select event_name, location, start_date from events where id = '" . $v->event_id . "' LIMIT 1");
                        if (!empty(@$eventInfo[0]->start_date)) {
                            $start_date = date('Y-m-d H:i:s', strtotime(@$eventInfo[0]->start_date));
                        } else {
                            $start_date = '';
                        }
                        $getEvent_image = DB::table('event_image')->where('event_id', @$v->event_id)->first();
                        if (!empty(@$getEvent_image->image) && file_exists('public/events/' . $getEvent_image->image . '')) {
                            $image = url('events/'.@$getEvent_image->image.'');
                        } else {
                            $image = url('noimage.jpg');;
                        }
                        $array[] = [
                            'invitationId' => @$v->invId,
                            'eventId' => @$v->event_id,
                            'image' => $image,
							'receiver_id' => @$v->receiver_id,
                            'sender_id' => @$v->sender_id,
                            'athleteName' => @$userInfo[0]->first_name . ' ' . @$userInfo[0]->last_name,
                            'eventName' => @$eventInfo[0]->event_name,
                            'location' => @$eventInfo[0]->location,
                            'eventDate' => @$start_date,
                            'startTime' => @$startTime,
                            'endTime' => @$endTime,
                            'amount' => @$v->amount,
                            'hour' => @$v->hour,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => 'data not found.'];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => 'user not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function rejectInvitationList_get() {
        if (!empty(@$_GET['userId'])) {
            $userCheck = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->count();
            if ($userCheck > 0) {
                $Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, invitation.comment, repeat_invitation.id as repeat_id, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status, repeat_invitation.start_time, repeat_invitation.end_time FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='0' AND repeat_invitation.status='0' AND (repeat_invitation.sender_id = '" . @$_GET['userId'] . "' OR repeat_invitation.receiver_id = '" . @$_GET['userId'] . "')";
                $list = DB::select($Sql);
                if ($list) {
                    foreach ($list as $k => $v) {
                        if (!empty(@$v->start_time)) {
                            $startTime = date('H:i:s', strtotime(@$v->start_time));
                        } else {
                            $startTime = '';
                        }
                        if (!empty(@$v->end_time)) {
                            $endTime = date('H:i:s', strtotime(@$v->end_time));
                        } else {
                            $endTime = '';
                        }
                        $userInfo = DB::select("select first_name, last_name from users where user_type = '4' AND (id = '" . $v->sender_id . "' OR id = '" . $v->receiver_id . "') LIMIT 1");
                        $eventInfo = DB::select("select event_name, location, start_date from events where id = '" . $v->event_id . "' LIMIT 1");
                        if (!empty(@$eventInfo[0]->start_date)) {
                            $start_date = date('Y-m-d H:i:s', strtotime(@$eventInfo[0]->start_date));
                        } else {
                            $start_date = '';
                        }
                        $getEvent_image = DB::table('event_image')->where('event_id', @$v->event_id)->first();
                        if (!empty(@$getEvent_image->image) && file_exists('public/events/' . $getEvent_image->image . '')) {
                            $image = url('events/'.@$getEvent_image->image.'');
                        } else {
                            $image = url('noimage.jpg');;
                        }
                        $array[] = [
                            'repeat_id' => @$v->repeat_id,
                            'invitationId' => @$v->invId,
                            'eventId' => @$v->event_id,
                            'image' => $image,
							'receiver_id' => @$v->receiver_id,
                            'sender_id' => @$v->sender_id,
                            'athleteName' => @$userInfo[0]->first_name . ' ' . @$userInfo[0]->last_name,
                            'eventName' => @$eventInfo[0]->event_name,
                            'location' => @$eventInfo[0]->location,
                            'eventDate' => @$start_date,
                            'startTime' => @$startTime,
                            'endTime' => @$endTime,
                            'amount' => @$v->amount,
                            'hour' => @$v->hour,
                            'comment' => @$v->comment,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => 'data not found.'];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => 'user not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function newInvitationList_get() {
        if (!empty(@$_GET['userId'])) {
            $userCheck = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->count();
            if ($userCheck > 0) {
                $Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status, repeat_invitation.start_time, repeat_invitation.end_time FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='2' AND repeat_invitation.status='2' AND (repeat_invitation.sender_id = '" . @$_GET['userId'] . "' OR repeat_invitation.receiver_id = '" . @$_GET['userId'] . "')";
                $list = DB::select($Sql);
                if ($list) {
                    foreach ($list as $k => $v) {
                        if (!empty(@$v->start_time)) {
                            $startTime = date('H:i:s', strtotime(@$v->start_time));
                        } else {
                            $startTime = '';
                        }
                        if (!empty(@$v->end_time)) {
                            $endTime = date('H:i:s', strtotime(@$v->end_time));
                        } else {
                            $endTime = '';
                        }
                        $userInfo = DB::select("select first_name, last_name from users where user_type = '4' AND (id = '" . $v->sender_id . "' OR id = '" . $v->receiver_id . "') LIMIT 1");
                        $eventInfo = DB::select("select event_name, location, start_date from events where id = '" . $v->event_id . "' LIMIT 1");
                        if (!empty(@$eventInfo[0]->start_date)) {
                            $start_date = date('Y-m-d H:i:s', strtotime(@$eventInfo[0]->start_date));
                        } else {
                            $start_date = '';
                        }
                        $getEvent_image = DB::table('event_image')->where('event_id', @$v->event_id)->first();
                        if (!empty(@$getEvent_image->image) && file_exists('public/events/' . $getEvent_image->image . '')) {
                            $image = url('events/'.@$getEvent_image->image.'');
                        } else {
                            $image = url('noimage.jpg');;
                        }
                        $array[] = [
                            'invitationId' => @$v->invId,
                            'eventId' => @$v->event_id,
                            'image' => $image,
							'receiver_id' => @$v->receiver_id,
                            'sender_id' => @$v->sender_id,
                            'athleteName' => @$userInfo[0]->first_name . ' ' . @$userInfo[0]->last_name,
                            'eventName' => @$eventInfo[0]->event_name,
                            'location' => @$eventInfo[0]->location,
                            'eventDate' => @$start_date,
                            'startTime' => @$startTime,
                            'endTime' => @$endTime,
                            'amount' => @$v->amount,
                            'hour' => @$v->hour,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => 'data not found.'];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => 'user not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function completeInvitationList_get() {
        if (!empty(@$_GET['userId'])) {
            $userCheck = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->count();
            if ($userCheck > 0) {
                //$Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status, repeat_invitation.start_time, repeat_invitation.end_time FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='1' AND repeat_invitation.status='1' AND (repeat_invitation.sender_id = '" . @$_GET['userId'] . "' OR repeat_invitation.receiver_id = '" . @$_GET['userId'] . "')";
                //$Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, invitation.comment, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status, repeat_invitation.start_time, repeat_invitation.end_time FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id JOIN events ON events.id = invitation.event_id WHERE invitation.status='1' AND repeat_invitation.status='1' AND (repeat_invitation.sender_id = '" . @$_GET['userId'] . "' OR repeat_invitation.receiver_id = '" . @$_GET['userId'] . "') AND events.start_date < '".date('Y-m-d')."'";
                $Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, invitation.comment, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status, repeat_invitation.start_time, repeat_invitation.end_time FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id JOIN events ON events.id = invitation.event_id WHERE invitation.status='5' AND repeat_invitation.status='5' AND (repeat_invitation.sender_id = '" . @$_GET['userId'] . "' OR repeat_invitation.receiver_id = '" . @$_GET['userId'] . "')";
                $list = DB::select($Sql);
                if ($list) {
                    foreach ($list as $k => $v) {
                        if (!empty(@$v->start_time)) {
                            $startTime = date('H:i:s', strtotime(@$v->start_time));
                        } else {
                            $startTime = '';
                        }
                        if (!empty(@$v->end_time)) {
                            $endTime = date('H:i:s', strtotime(@$v->end_time));
                        } else {
                            $endTime = '';
                        }
                        $userInfo = DB::select("select first_name, last_name from users where user_type = '4' AND (id = '" . $v->sender_id . "' OR id = '" . $v->receiver_id . "') LIMIT 1");
                        $eventInfo = DB::select("select event_name, location, start_date from events where id = '" . $v->event_id . "' LIMIT 1");
                        if (!empty(@$eventInfo[0]->start_date)) {
                            $start_date = date('Y-m-d H:i:s', strtotime(@$eventInfo[0]->start_date));
                        } else {
                            $start_date = '';
                        }
                        $getEvent_image = DB::table('event_image')->where('event_id', @$v->event_id)->first();
                        if (!empty(@$getEvent_image->image) && file_exists('public/events/' . $getEvent_image->image . '')) {
                            $image = url('events/'.@$getEvent_image->image.'');
                        } else {
                            $image = url('noimage.jpg');;
                        }
                        $array[] = [
                            'invitationId' => @$v->invId,
                            'eventId' => @$v->event_id,
                            'image' => $image,
							'receiver_id' => @$v->receiver_id,
                            'sender_id' => @$v->sender_id,
                            'athleteName' => @$userInfo[0]->first_name . ' ' . @$userInfo[0]->last_name,
                            'eventName' => @$eventInfo[0]->event_name,
                            'location' => @$eventInfo[0]->location,
                            'eventDate' => @$start_date,
                            'startTime' => @$startTime,
                            'endTime' => @$endTime,
                            'amount' => @$v->amount,
                            'hour' => @$v->hour,
                            'comment' => @$v->comment,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => 'data not found.'];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => 'user not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function resendInvitation_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'senderId' => 'required',
                'receiverId' => 'required',
                //'hour' => 'required',
                'amount' => 'required',
                'invitationId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            /*$numRows = DB::table('invitation')->where(['sender_id' => @$request->senderId, 'receiver_id' => @$request->receiverId, 'event_id' => @$request->eventId, 'status' => '2'])->select('*')->orderBy('id', 'DESC')->count();
            if($numRows > 0){
                $response = ["status" => 0, "error" => "Already send invitation."];
                return response()->json($response, 200);exit();
            }*/
            $rdata = DB::table('repeat_invitation')->where(['invitation_id' => @$request->invitationId])->select('*')->orderBy('id', 'DESC')->first();
            $start_time = $rdata->start_time;
            $end_time = $rdata->end_time;
            $data = ['status' => '3', 'updated_at' => date("Y-m-d H:i:s"), 'comment' => $request->comment];
            //$result = DB::table('invitation')->insertGetId($data);
            $result = DB::table('invitation')->where(['id' => $request->invitationId])->update($data);
            if ($result) {
                $repeatData = ['sender_id' => @$request->senderId, 'receiver_id' => @$request->receiverId, 'amount' => @$request->amount, 'hour' => @$request->hour, 'start_time' => @$start_time, 'end_time' => @$end_time, 'status' => '3', 'invitation_id' => $request->invitationId, 'created_at' => date("Y-m-d H:i:s")];
                DB::table('repeat_invitation')->insertGetId($repeatData);
                $response = ["status" => 1, 'invitationId' => $request->invitationId, "message" => "Your invitation sent successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function counterOfferList_get() {
        if (!empty(@$_GET['userId'])) {
            $userCheck = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->count();
            if ($userCheck > 0) {
                $Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, invitation.comment, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status, repeat_invitation.start_time, repeat_invitation.end_time FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='3' AND repeat_invitation.status='3' AND  repeat_invitation.receiver_id = '" . @$_GET['userId'] . "'";
                $list = DB::select($Sql);
                if ($list) {
                    foreach ($list as $k => $v) {
                        if (!empty(@$v->start_time)) {
                            $startTime = date('H:i:s', strtotime(@$v->start_time));
                        } else {
                            $startTime = '';
                        }
                        if (!empty(@$v->end_time)) {
                            $endTime = date('H:i:s', strtotime(@$v->end_time));
                        } else {
                            $endTime = '';
                        }
                        $userInfo = DB::select("select first_name, last_name from users where user_type = '4' AND (id = '" . $v->sender_id . "' OR id = '" . $v->receiver_id . "') LIMIT 1");
                        $eventInfo = DB::select("select event_name, location, start_date from events where id = '" . $v->event_id . "' LIMIT 1");
                        if (!empty(@$eventInfo[0]->start_date)) {
                            $start_date = date('Y-m-d H:i:s', strtotime(@$eventInfo[0]->start_date));
                        } else {
                            $start_date = '';
                        }
                        $getEvent_image = DB::table('event_image')->where('event_id', @$v->event_id)->first();
                        if (!empty(@$getEvent_image->image) && file_exists('public/events/' . $getEvent_image->image . '')) {
                            $image = url('events/'.@$getEvent_image->image.'');
                        } else {
                            $image = url('noimage.jpg');;
                        }
                        $array[] = [
                            'invitationId' => @$v->invId,
                            'eventId' => @$v->event_id,
                            'image' => $image,
							'receiver_id' => @$v->receiver_id,
                            'sender_id' => @$v->sender_id,
                            'athleteName' => @$userInfo[0]->first_name.' '.@$userInfo[0]->last_name,
                            'eventName' => @$eventInfo[0]->event_name,
                            'location' => @$eventInfo[0]->location,
                            'eventDate' => @$start_date,
                            'startTime' => @$startTime,
                            'endTime' => @$endTime,
                            'amount' => @$v->amount,
                            'hour' => @$v->hour,
                            'comment' => @$v->comment
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => 'data not found.'];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => 'user not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function promotionAdsCategory_get() {
        $Sql = "SELECT * FROM promotion_category WHERE status = '1' ORDER BY name ASC";
        $list = DB::select($Sql);
        if ($list) {
            foreach ($list as $k => $v) {
                $array[] = [
                    'catId' => @$v->id,
                    'name' => @$v->name,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'data not found.'];
            return response()->json($response, 200);
        }
    }
    public function promotionPlanList_get() {
        $Sql = "SELECT * FROM ads_sub_plan WHERE status = '1' ORDER BY id DESC";
        $list = DB::select($Sql);
        if ($list) {
            foreach ($list as $k => $v) {
                if (@$v->plan_type == 'Monthly') {
                    $plan_type = 'Month';
                } elseif (@$v->plan_type == 'Yearly') {
                    $plan_type = 'year';
                } elseif (@$v->plan_type == 'Daily') {
                    $plan_type = 'Day';
                }
                if (empty(@$v->discount) || @$v->discount == 0) {
                    $discount = 0;
                } else {
                    $discount = @$v->discount;
                }
                if (empty(@$v->price) || @$v->price == 0) {
                    $price = 0;
                } else {
                    $price = @$v->price;
                }
                $array[] = [
                    'id' => @$v->id,
                    'name' => @$v->name,
                    'plan' => @$v->plan,
                    'type' => @$plan_type,
                    'duration' => @$v->plan_duration,
                    'discount' => @$discount,
                    'amount' => @$price,
                    'adsType' => @$v->ads_type,
                    'description' => @$v->description,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'data not found.'];
            return response()->json($response, 200);
        }
    }
    public function addpromotionAds_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'title' => 'required',
                'category' => 'required',
                'type' => 'required',
                'gender' => 'required',
                'householdIncome' => 'required',
            ]
        );
        if (!$validator->fails()) {
			$accessList = DB::table('users')->where(['id' => $request->userId])->select('promotionCount')->first();
            if(!empty(@$accessList)){
                if(@$accessList->promotionCount > 0){
                } else {
                    $response = ["status" => 0, "error" => "Your promotion ads adding limit is over now."];
                    return response()->json($response, 200);exit();
                }
            }
            if ($request['image']) {
                $img = $request['image'];
                $extn = $img->getClientOriginalExtension();
                $path = public_path('ads/');
                $file_name = rand() . '.' . $extn;
                $img->move($path, $file_name);
            } else {
				$file_name = '';
            }
            $ageRange = [];
			if(@$request->ageRange){
				$ageRange = implode(",", @$request->ageRange);
			}
            @$radius = '';
            @$description = '';
            $data = ['ads_name' => @$request->title, 'file_type' => @$request->type, 'image' => $file_name, 'description' => @$description, 'user_id' => @$request->userId, 'category' => @$request->category, 'gender' => @$request->gender, 'age_range' => @$ageRange, 'parental_status' => @$request->parentalStatus, 'income' => @$request->householdIncome, 'location' => @$request->location, 'latitude' => @$request->latitude, 'longitude' => @$request->longitude, 'radius' => @$radius, 'status' => '1', 'created_at' => date("Y-m-d H:i:s")];
            $result = DB::table('promotion')->insertGetId($data);
            if ($result) {
                $fileUrl = url('ads/' . $file_name . '');
                if (@$request->type == 1) {
                    $type = 'Image';
                } elseif (@$request->type == 2) {
                    $type = 'Video';
                }
                $cat = DB::select("select name from promotion_category where id = '" . @$request->category . "' LIMIT 1");
				DB::table('users')->where(['id' => @$request->userId])->update(['promotionCount' => DB::raw('promotionCount-1')]);
                $response = ["status" => 1, "adsId" => $result, "title" => @$request->title, "image" => $fileUrl, "type" => $type, "category" => @$cat[0]->name, "message" => "Your promotion ads added successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function adsDetails_get() {
        if (!empty(@$_GET['adsId'])) {
            $places = [];
            $Sql = "SELECT * FROM promotion WHERE id = '" . @$_GET['adsId'] . "'";
            $list = DB::select($Sql);
            if ($list) {
                foreach ($list as $k => $v) {
                    if (!empty($v->image) && file_exists('public/ads/' . $v->image . '')) {
                        $image = url('ads/' . $v->image . '');
                    } else {
                        $image = '';
                    }
                    if (@$v->file_type == 1) {
                        $type = 'Image';
                    } elseif (@$v->file_type == 2) {
                        $type = 'Video';
                    }
                    if (@$v->category) {
                        $cat = DB::select("select name from promotion_category where id = '" . @$v->category . "' LIMIT 1");
                        $catName = $cat[0]->name;
                    } else {
                        $catName = '';
                    }
                    if (@$v->age_range) {
						$explodeAge = explode(",", @$v->age_range);
						foreach($explodeAge as $k1 => $v1){
							//$age = DB::select("select id, age from age_range where id = '" . @$v . "' LIMIT 1");
							$age = DB::table('age_range')->where(['id' => @$v1])->select('*')->orderBy('id', 'DESC')->first();
							$ageRange[] = $age->age;
							$ageRangeId[] = $age->id;
						}
                        // $age = DB::select("select age from age_range where id = '" . @$v->age_range . "' LIMIT 1");
                        // $ageName = $age[0]->age;
                    } else {
                        $ageRange = [];
                        $ageRangeId = [];
                    }
                    if (@$v->income) {
                        $income = DB::select("select income from household_income where id = '" . @$v->income . "' LIMIT 1");
                        $incomeName = $income[0]->income;
                    } else {
                        $incomeName = '';
                    }
                    if (@$v->places) {
                        $explode = explode(',', @$v->places);
                        foreach ($explode as $k1 => $v1) {
                            $places[] = [
                                'places' => @$v1
                            ];
                        }
                    }
                    $array[] = [
                        'adsId' => @$v->id,
                        'title' => @$v->ads_name,
                        //'description' => strip_tags(@$v->description),
                        'image' => @$image,
                        'type' => @$type,
                        'category' => @$catName,
                        'gender' => @$v->gender,
                        'ageRange' => @$ageRange,
                        'ageRangeId' => @$ageRangeId,
                        'parentalStatus' => @$v->parental_status,
                        'householdIncome' => @$incomeName,
                        'location' => @$v->location,
                        'latitude' => @$v->latitude,
                        'longitude' => @$v->longitude,
                        'places' => @$places,
                        //'radius' => @$v->radius,
                    ];
                }
                $response = ["status" => 1, "adsDetail" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'data not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'adsId is required.'];
            return response()->json($response, 200);
        }
    }
    public function editpromotionAds_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                //'adsName' => 'required',
                //'url'     => 'required',
                //'description' => 'required',
                'adsId' => 'required',
                'title' => 'required',
                'category' => 'required',
                'type' => 'required',
                'gender' => 'required',
                'ageRange' => 'required',
                //'parentalStatus' => 'required',
                'householdIncome' => 'required',
                'location' => 'required',
                //'radius' => 'required',
            ]
        );
        if (!$validator->fails()) {
            if ($request['image']) {
                $img = $request['image'];
                $extn = $img->getClientOriginalExtension();
                $path = public_path('ads/');
                $file_name = rand() . '.' . $extn;
                $img->move($path, $file_name);
            } else {
                $image = DB::table('promotion')->where(['id' => @$request->adsId])->select('image')->orderBy('id', 'DESC')->first();
                if ($image->image) {
                    $file_name = $image->image;
                } else {
                    $file_name = '';
                }
            }
			$ageRange = '';
			if(@$request->ageRange){
				$ageRange = implode(",", @$request->ageRange);
			}
            @$radius = '';
            @$description = '';
            $data = ['ads_name' => @$request->title, 'file_type' => @$request->type, 'image' => $file_name, 'description' => @$description, 'category' => @$request->category, 'gender' => @$request->gender, 'age_range' => @$ageRange, 'parental_status' => @$request->parentalStatus, 'income' => @$request->householdIncome, 'location' => @$request->location, 'latitude' => @$request->latitude, 'longitude' => @$request->longitude, 'radius' => @$radius, 'updated_at' => date("Y-m-d H:i:s")];
            $result = DB::table('promotion')->where(['id' => $request->adsId])->update($data);
            if ($result) {
                $fileUrl = url('ads/' . $file_name . '');
                if (@$request->type == 1) {
                    $type = 'Image';
                } elseif (@$request->type == 2) {
                    $type = 'Video';
                }
                $cat = DB::select("select name from promotion_category where id = '" . @$request->category . "' LIMIT 1");
                $response = ["status" => 1, "adsId" => $request->adsId, "title" => @$request->title, "image" => $fileUrl, "type" => $type, "category" => @$cat[0]->name, "message" => "Your promotion ads updated successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function ageRangeList_get() {
        $Sql = "SELECT * FROM age_range WHERE status = '1'";
        $list = DB::select($Sql);
        if ($list) {
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'ageRange' => @$v->age,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'data not found.'];
            return response()->json($response, 200);
        }
    }
    public function householdIncomeList_get() {
        $Sql = "SELECT * FROM household_income WHERE status = '1'";
        $list = DB::select($Sql);
        if ($list) {
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'income' => @$v->income,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'data not found.'];
            return response()->json($response, 200);
        }
    }
    public function myAdsList_get() {
        if (!empty(@$_GET['userId'])) {
            $userCheck = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->count();
            if ($userCheck > 0) {
                $Sql = "SELECT * FROM promotion WHERE status = '1' AND user_id = '" . @$_GET['userId'] . "'";
                $list = DB::select($Sql);
                if ($list) {
                    foreach ($list as $k => $v) {
                        if (!empty($v->image) && file_exists('public/ads/' . $v->image . '')) {
                            $image = url('ads/' . $v->image . '');
                        } else {
                            $image = '';
                        }
                        $array[] = [
                            'adsId' => @$v->id,
                            'adsName' => @$v->ads_name,
                            'url' => @$v->url,
                            'description' => strip_tags(@$v->description),
                            'image' => @$image,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => 'data not found.'];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => 'user not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function allAdsList_get() {
        $Sql = "SELECT * FROM promotion WHERE status = '1'";
        $list = DB::select($Sql);
        if ($list) {
            foreach ($list as $k => $v) {
                if (!empty($v->image) && file_exists('public/ads/' . $v->image . '')) {
                    $image = url('ads/' . $v->image . '');
                } else {
                    $image = '';
                }
                if(@$v->user_id != '0') {
                    $getUserData = DB::table('users')->where('id', @$v->user_id)->first();
                    $name = @$getUserData->first_name." ".@$getUserData->last_name;
                    $userImage = url('profile/' . @$getUserData->profile_image . '');
                } else {
                    $getUserData = DB::table('settings')->where('settingId', '1')->first();
                    $name = 'Admin';
                    $userImage = url('setting/' . @$getUserData->favicon . '');
                }
                $array[] = [
                    'adsId' => @$v->id,
                    'adsName' => @$v->ads_name,
                    'url' => @$v->url,
                    'description' => strip_tags(@$v->description),
                    'name' => @$name,
                    'userImage' => @$userImage,
                    'image' => @$image,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'data not found.'];
            return response()->json($response, 200);
        }
    }
    public function addEventCategory_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'category' => 'required',
            ]
        );
        if ($validator->fails()) {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        } else {
            $data = ['name' => @$request->category, 'status' => 1, 'created_at' => date('Y-m-d H:i:s')];
            $result = DB::table('event_category')->insertGetId($data);
            if ($result) {
                $response = ["status" => 1, "catId" => @$result, "message" => "category added successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some error occurred, please try again."];
                return response()->json($response, 200);
            }
        }
    }
    public function eventCategory_get() {
        $list = DB::table('event_category')->where(['status' => 1])->select('*')->orderBy('name', 'ASC')->get();
        if (!empty($list)) {
            $array[] = [
                'id' => 0,
                'name' => 'All',
            ];
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'name' => @$v->name,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "No Data found."];
            return response()->json($response, 200);
        }
    }
    public function tags_get() {
        $list = DB::table('tags')->where(['status' => 1])->select('*')->orderBy('name', 'ASC')->get();
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'name' => @$v->name,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "No Data found."];
            return response()->json($response, 200);
        }
    }
    public function eventByCategory_get() {
        if (!empty(@$_GET['categoryId'])) {
            // echo "44";die;
            //$eventList = DB::table('events')->where(['category' => @$_GET['categoryId'], 'status' => 1])->select('*')->orderBy('id', 'DESC')->get();
            $date = date('Y-m-d');
            $eventList = DB::select("select * from events where DATE(start_date) >= '$date' AND category = " . @$_GET['categoryId'] . " AND status = '1' order by DATE(start_date) ASC");
            if ($eventList) {
                foreach ($eventList as $k => $v) {
                    $category = DB::table('event_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
                    $image = DB::table('event_image')->where(['event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                    if (!empty($image->image) && file_exists('public/events/' . $image->image . '')) {
                        $galleryImg = url('events/' . $image->image . '');
                    } else {
                        $galleryImg = url('noimage.jpg');
                    }
                    $startDate = @$v->start_date;
                    $start_date = date('Y-m-d H:i:s', strtotime($startDate));
                    $endDate = @$v->end_date;
                    $end_date = date('Y-m-d H:i:s', strtotime($endDate));
                    if ($v->user_id == 0) {
                        $userPic = url('noimage.jpg');
                        $userName = 'Admin';
                    } else {
                        $checkUser = DB::table('users')->where(['id' => $v->user_id])->select('*')->orderBy('id', 'DESC')->first();
                        $userName = $checkUser->first_name . ' ' . $checkUser->last_name;
                        if (!empty($checkUser->profile_image) && file_exists('public/profile/' . $checkUser->profile_image . '')) {
                            $userPic = url('profile/' . $checkUser->profile_image . '');
                        } else {
                            $userPic = url('noimage.jpg');
                        }
                    }
                    $checkfav = DB::table('favouriteevent')->where('user_id', $v->user_id)->where('event_id', @$v->id)->first();
                    if(!empty($checkfav)) {
                        $isFav = 1;
                    } else {
                        $isFav = 0;
                    }
                    $array[] = [
                        'eventId' => @$v->id,
                        'eventName' => @$v->event_name,
                        'startDate' => $start_date,
                        'endDate' => $end_date,
                        'start_time' => @$v->start_time,
                        'end_time' => @$v->end_time,
                        'location' => @$v->location,
                        'category' => @$category->name,
                        'image' => @$galleryImg,
                        'userName' => @$userName,
                        'userPic' => @$userPic,
                        'isFav' => @$isFav
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Events not found."];
                return response()->json($response, 200);
            }
        } else {
            // echo "555";die;
            //$eventList = DB::table('events')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
            $date = date('Y-m-d');
            $eventList = DB::select("select * from events where DATE(start_date) >= '$date' AND status = '1' order by DATE(start_date) ASC");
            if ($eventList) {
                foreach ($eventList as $k => $v) {
                    $category = DB::table('event_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
                    $image = DB::table('event_image')->where(['event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                    if (!empty($image->image) && file_exists('public/events/' . $image->image . '')) {
                        $galleryImg = url('events/' . $image->image . '');
                    } else {
                        $galleryImg = url('noimage.jpg');
                    }
                    $startDate = @$v->start_date;
                    $start_date = date('Y-m-d H:i:s', strtotime($startDate));
                    $endDate = @$v->end_date;
                    $end_date = date('Y-m-d H:i:s', strtotime($endDate));
                    if ($v->user_id == 0) {
                        $userPic = url('noimage.jpg');
                        $userName = 'Admin';
                    } else {
                        $checkUser = DB::table('users')->where(['id' => $v->user_id])->select('*')->orderBy('id', 'DESC')->first();
                        $userName = $checkUser->first_name . ' ' . $checkUser->last_name;
                        if (!empty($checkUser->profile_image) && file_exists('public/profile/' . $checkUser->profile_image . '')) {
                            $userPic = url('profile/' . $checkUser->profile_image . '');
                        } else {
                            $userPic = url('noimage.jpg');
                        }
                    }
                    $array[] = [
                        'eventId' => @$v->id,
                        'eventName' => @$v->event_name,
                        'startDate' => $start_date,
                        'endDate' => $end_date,
						'start_time' => @$v->start_time,
                        'end_time' => @$v->end_time,
                        'location' => @$v->location,
                        'category' => @$category->name,
                        'image' => @$galleryImg,
                        'userName' => @$userName,
                        'userPic' => @$userPic,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "business not found."];
                return response()->json($response, 200);
            }
        }
    }
    function uploadsPhoto_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $image = array();
            if ($file = $request->file('photos')) {
                foreach ($file as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $uploade_path = public_path('photos/');
                    $image_url = $image_full_name;
                    $file->move($uploade_path, $image_full_name);
                    $image = $image_url;
                    $data = ['image' => $image, 'user_id' => @$request->userId, 'created_at' => date('Y-m-d H:i:s')];
                    DB::table('user_gallery_photo')->insertGetId($data);
                }
                $response = ["status" => 1, 'userId' => $request->userId, "message" => "Your photos uploaded successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Photo is required.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function photos_get() {
        if (!empty(@$_GET['userId'])) {
            $list = DB::table('user_gallery_photo')->where(['user_id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->get();
            if (!empty($list)) {
                foreach ($list as $k => $v) {
                    if (!empty(@$v->image) && file_exists('public/photos/' . @$v->image . '')) {
                        $photos = url('photos/' . @$v->image . '');
                    } else {
                        $photos = url('photos/noimage.jpg');
                    }
                    $array[] = [
                        'id' => @$v->id,
                        'photos' => @$photos,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function deletePhoto_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'photoId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $delete = DB::table('user_gallery_photo')->where(['id' => $request->photoId])->delete();
            if ($delete) {
                $response = ["status" => 1, "message" => "photo deleted successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function transactionList_get() {
        if (!empty(@$_GET['userId'])) {
            $list = DB::table('transaction')->where(['user_id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->get();
            if (!empty($list)) {
                foreach ($list as $k => $v) {
					if($v->status == 'succeeded') {
						$status = 'Success';
					} else {
						$status = 'Failed';
					}
					if(($v->payment_type == '') || ($v->payment_type == 1)) {
						$payment = 'Subscription Payment';
					} elseif($v->payment_type == 3) {
						$payment = 'Top Up';
					} elseif($v->payment_type == 4) {
						$payment = 'Withdraw';
					} elseif($v->payment_type == 5) {
						$payment = 'Invited Event Payment';
					} elseif($v->payment_type == 6) {
						$payment = 'Product Payment';
					} else {
						$payment = 'Ads Payment';
					}
                    $array[] = [
                        'id' => @$v->id,
                        'txnId' => @$v->txn_id,
                        'orderId' => @$v->order_id,
                        'amount' => @$v->amount,
                        'currency' => @$v->currency,
                        'chargeId' => @$v->charge_id,
                        'status' => @$status,
                        'payment' => @$payment,
                        'paymentDate' => @$v->created_at,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function interestList_get() {
        $list = DB::table('interest')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'name' => @$v->name,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "No Data found."];
            return response()->json($response, 200);
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
    function sentMail($email = '', $msg = '', $subject = '') {
        require_once 'vendor/email/vendor/autoload.php';
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->SetFrom('no-reply@StarBiz.com', 'StarBiz');
        $mail->AddAddress($email);
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $msg;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //$mail->Host = "smtp.googlemail.com";
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        //$mail->Username = 'gowologlobal@gmail.com';
        //$mail->Password = 'hovndmbbedmhhemg';
        $mail->Username = 'starbiznetwork7@gmail.com';
        $mail->Password = 'krvm xzzz vumq fdll';
        return $mail->send();
    }
    public function myPromotionList_get() {
        if (!empty(@$_GET['userId'])) {
            $userCheck = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->count();
            if ($userCheck > 0) {
                $Sql = "SELECT * FROM promotion WHERE status = '1' AND user_id = '" . @$_GET['userId'] . "'";
                $list = DB::select($Sql);
                if ($list) {
                    foreach ($list as $k => $v) {
                        if (!empty($v->image) && file_exists('public/ads/' . $v->image . '')) {
                            $image = url('ads/' . $v->image . '');
                        } else {
                            $image = '';
                        }
                        if ($v->user_id == 0) {
                            $organizer = 'Admin';
                            $profilePic = url('profile/unnamed.jpg');
                        } else {
                            $organizerName = DB::table('users')->where(['id' => $v->user_id])->select('*')->orderBy('id', 'DESC')->first();
                            $organizer = @$organizerName->first_name . ' ' . @$organizerName->last_name;
                            if (!empty(@$organizerName->profile_image) && file_exists('public/profile/' . @$organizerName->profile_image . '')) {
                                $profilePic = url('profile/' . @$organizerName->profile_image . '');
                            } else {
                                $profilePic = url('profile/unnamed.jpg');
                            }
                        }
                        $array[] = [
                            'adsId' => @$v->id,
                            'adsName' => @$v->ads_name,
                            'url' => @$v->url,
                            'description' => strip_tags(@$v->description),
                            'image' => @$image,
                            'profileImg' => @$profilePic,
                            'userName' => @$organizer,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => 'data not found.'];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => 'user not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function allPromotionList_get() {
        $Sql = "SELECT promotion.*, promotion.status, promotion.id FROM promotion WHERE promotion.status = '1' and promotion.id IN(select promotion_id from transaction where promotion_id = promotion.id and payment_type = '2' and expiry_date >= '" . date('Y-m-d') . "')";
        $list = DB::select($Sql);
        if ($list) {
            foreach ($list as $k => $v) {
                if (!empty($v->image) && file_exists('public/ads/' . $v->image . '')) {
                    $image = url('ads/' . $v->image . '');
                } else {
                    $image = '';
                }
                if ($v->user_id == 0) {
                    $organizer = 'Admin';
                    $profilePic = url('profile/unnamed.jpg');
                } else {
                    $organizerName = DB::table('users')->where(['id' => $v->user_id])->select('*')->orderBy('id', 'DESC')->first();
                    $organizer = @$organizerName->first_name . ' ' . @$organizerName->last_name;
                    if (!empty(@$organizerName->profile_image) && file_exists('public/profile/' . @$organizerName->profile_image . '')) {
                        $profilePic = url('profile/' . @$organizerName->profile_image . '');
                    } else {
                        $profilePic = url('profile/unnamed.jpg');
                    }
                }
                $array[] = [
                    'adsId' => @$v->id,
                    'adsName' => @$v->ads_name,
                    'url' => @$v->url,
                    'description' => strip_tags(@$v->description),
                    'image' => @$image,
                    'profileImg' => @$profilePic,
                    'userName' => @$organizer,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'data not found.'];
            return response()->json($response, 200);
        }
    }
    public function searchPromotion_get() {
        if (!empty(@$_GET['searchText'])) {
            $where = " and (ads_name LIKE '" . @$_GET['searchText'] . "' OR description LIKE '" . @$_GET['searchText'] . "')";
            $Sql = "SELECT promotion.*, promotion.status, promotion.id FROM promotion WHERE promotion.status = '1' $where and promotion.id IN(select promotion_id from transaction where promotion_id = promotion.id and payment_type = '2' and expiry_date >= '" . date('Y-m-d') . "')";
            $list = DB::select($Sql);
            if ($list) {
                foreach ($list as $k => $v) {
                    if (!empty($v->image) && file_exists('public/ads/' . $v->image . '')) {
                        $image = url('ads/' . $v->image . '');
                    } else {
                        $image = '';
                    }
                    $array[] = [
                        'adsId' => @$v->id,
                        'adsName' => @$v->ads_name,
                        'url' => @$v->url,
                        'description' => strip_tags(@$v->description),
                        'image' => @$image,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'data not found.'];
                return response()->json($response, 200);
            }
        } else {
            //$where = " and (ads_name LIKE '".@$_GET['searchText']."' OR description LIKE '".@$_GET['searchText']."')";
            $Sql = "SELECT promotion.*, promotion.status, promotion.id FROM promotion WHERE promotion.status = '1' and promotion.id IN(select promotion_id from transaction where promotion_id = promotion.id and payment_type = '2' and expiry_date >= '" . date('Y-m-d') . "')";
            $list = DB::select($Sql);
            if ($list) {
                foreach ($list as $k => $v) {
                    if (!empty($v->image) && file_exists('public/ads/' . $v->image . '')) {
                        $image = url('ads/' . $v->image . '');
                    } else {
                        $image = '';
                    }
                    $array[] = [
                        'adsId' => @$v->id,
                        'adsName' => @$v->ads_name,
                        'url' => @$v->url,
                        'description' => strip_tags(@$v->description),
                        'image' => @$image,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'data not found.'];
                return response()->json($response, 200);
            }
        }
    }
    public function networkList_get() {
        if (!empty(@$_GET['searchText']) && @$_GET['searchText'] != '') {
            $tags = DB::table('tags')->where(['status' => 1, 'name' => @$_GET['searchText']])->select('*')->orderBy('id', 'DESC')->first();
            if (!empty($tags)) {
                $tagsId = $tags->id;
                $whereTags = 'OR FIND_IN_SET("' . $tagsId . '", tags)';
            } else {
                $whereTags = '';
            }
            $Sql = "SELECT * FROM users WHERE status = '1' AND (CONCAT(first_name,' ',last_name) like '%" . $_GET['searchText'] . "%' OR email like '%" . $_GET['searchText'] . "%' " . $whereTags . ") order by id DESC";
            $list = DB::select($Sql);
            if (!empty($list)) {
                foreach ($list as $k => $v) {
                    if (!empty(@$v->profile_image) && file_exists('public/profile/' . @$v->profile_image . '')) {
                        $profilePic = url('profile/' . @$v->profile_image . '');
                    } else {
                        $profilePic = url('profile/unnamed.jpg');
                    }
                    $userType = DB::table('user_type')->where(['id' => @$v->user_type])->select('*')->orderBy('id', 'DESC')->first();
                    $array[] = [
                        'userId' => @$v->id,
                        'firstName' => @$v->first_name,
                        'lastName' => @$v->last_name,
                        'email' => @$v->email,
                        'address' => @$v->address,
                        'profilePic' => @$profilePic,
                        'userType' => @$userType->name,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        } else {
            $list = DB::table('users')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
            if (!empty($list)) {
                foreach ($list as $k => $v) {
                    if (!empty(@$v->profile_image) && file_exists('public/profile/' . @$v->profile_image . '')) {
                        $profilePic = url('profile/' . @$v->profile_image . '');
                    } else {
                        $profilePic = url('profile/unnamed.jpg');
                    }
                    $userType = DB::table('user_type')->where(['id' => @$v->user_type])->select('*')->orderBy('id', 'DESC')->first();
                    $array[] = [
                        'userId' => @$v->id,
                        'firstName' => @$v->first_name,
                        'lastName' => @$v->last_name,
                        'email' => @$v->email,
                        'address' => @$v->address,
                        'profilePic' => @$profilePic,
                        'userType' => @$userType->name,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        }
    }
    public function networkfilterList_post(Request $request) {
        $userTypeId = '';
        if (!empty($request->userType)) {
            $userType = DB::table('user_type')->where(['name' => @$request->userType])->select('id')->orderBy('id', 'DESC')->first();
            if (!empty($userType)) {
                $userTypeId = $userType->id;
                //$user_type = 'OR FIND_IN_SET("'.$userTypeId.'", user_type)';
            } else {
                $userTypeId = '';
            }
        }
        $tagsId = '';
        if (!empty($request->tags)) {
            $tags = DB::table('tags')->where(['name' => @$request->tags])->select('id')->orderBy('id', 'DESC')->first();
            if (!empty($tags)) {
                $tagsId = $tags->id;
                //$sql.= 'OR FIND_IN_SET("'.$tagsId.'", tags)';
            } else {
                $tagsId = '';
            }
        }
        $Sql = "SELECT * FROM users WHERE status = '1'";
        if (!empty($userTypeId) && !empty($tagsId)) {
            $Sql .= " and FIND_IN_SET($userTypeId, user_type) and FIND_IN_SET($tagsId, tags)";
            //echo 1;
        } elseif (!empty($userTypeId) && empty($tagsId)) {
            $Sql .= " and FIND_IN_SET($userTypeId, user_type)";
            //echo 2;
        } elseif (empty($userTypeId) && !empty($tagsId)) {
            $Sql .= " and FIND_IN_SET($tagsId, tags)";
            //echo 3;
        }
        $list = DB::select($Sql);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                if (!empty(@$v->profile_image) && file_exists('public/profile/' . @$v->profile_image . '')) {
                    $profilePic = url('profile/' . @$v->profile_image . '');
                } else {
                    $profilePic = url('profile/unnamed.jpg');
                }
                $userType = DB::table('user_type')->where(['id' => @$v->user_type])->select('*')->orderBy('id', 'DESC')->first();
                $array[] = [
					'userId' => @$v->id,
					'firstName' => @$v->first_name,
					'lastName' => @$v->last_name,
					'email' => @$v->email,
					'address' => @$v->address,
					'profilePic' => @$profilePic,
					'userType' => @$userType->name,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "No Data found."];
            return response()->json($response, 200);
        }
    }
    public function userProfile_get() {
        if (!empty(@$_GET['userId'])) {
            $userInfo = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($userInfo) {
                if (!empty(@$userInfo->profile_image) && file_exists('public/profile/' . @$userInfo->profile_image . '')) {
                    $profilePic = url('profile/' . @$userInfo->profile_image . '');
                } else {
                    $profilePic = url('profile/unnamed.jpg');
                }
                if (!empty(@$userInfo->cover_image) && file_exists('public/profile/' . @$userInfo->cover_image . '')) {
                    $coverPic = url('profile/' . @$userInfo->cover_image . '');
                } else {
                    $coverPic = url('profile/unnamed.jpg');
                }
                $userType = DB::table('user_type')->where(['id' => @$userInfo->user_type])->select('*')->orderBy('id', 'DESC')->first();
                if ($userInfo->area_interest) {
                    $Exinterest = explode(',', $userInfo->area_interest);
                    foreach ($Exinterest as $k => $v) {
                        $interest = DB::table('interest')->where(['id' => @$v])->select('*')->orderBy('id', 'DESC')->first();
                        if ($interest) {
                            $interestArray[] = $interest->name;
                        }
                    }
                }
                $gallery = [];
                $galleryPhoto = DB::table('user_gallery_photo')->where(['user_id' => @$userInfo->id])->select('*')->orderBy('id', 'DESC')->get();
                if ($galleryPhoto) {
                    foreach ($galleryPhoto as $k => $v) {
                        if (!empty(@$v->image) && file_exists('public/photos/' . @$v->image . '')) {
                            $gallery[] = url('photos/' . @$v->image . '');
                        } else {
                            $gallery[] = url('photos/noimage.jpg');
                        }
                    }
                }
                $Eventarray = [];
                $eventsList = DB::table('events')->where(['status' => 1, 'user_id' => @$userInfo->id])->select('*')->orderBy('id', 'DESC')->get();
                if ($eventsList) {
                    foreach ($eventsList as $k => $v) {
                        $checkUser = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
                        $category = DB::table('event_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
                        $image = DB::table('event_image')->where(['event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                        if (!empty($image->image) && file_exists('public/events/' . $image->image . '')) {
                            $galleryImg = url('events/' . $image->image . '');
                        } else {
                            $galleryImg = url('noimage.jpg');
                        }
                        $startDate = $v->start_date;
                        $start_date = date('Y-m-d H:i:s', strtotime($startDate));
                        $endDate = $v->end_date;
                        $end_date = date('Y-m-d H:i:s', strtotime($endDate));
                        $userName = $checkUser->first_name . ' ' . $checkUser->last_name;
                        if (!empty($checkUser->profile_image) && file_exists('public/profile/' . $checkUser->profile_image . '')) {
                            $userPic = url('profile/' . $checkUser->profile_image . '');
                        } else {
                            $userPic = url('noimage.jpg');
                        }
                        $Eventarray[] = [
							'eventId' => @$v->id,
							'eventName' => @$v->event_name,
							'startDate' => $start_date,
							'endDate' => $end_date,
							'location' => @$v->location,
							'category' => @$category->name,
							'image' => @$galleryImg,
							'userName' => @$userName,
							'userPic' => @$userPic,
                        ];
                    }
                }
                $bannerImg = [];
                $Sql = "SELECT advertise.id as advsId, advertise.title, advertise.image, advertise.status, transaction.adv_id, transaction.adv_sub_id, transaction.adv_user_id FROM advertise INNER JOIN transaction ON advertise.id = transaction.adv_id WHERE advertise.status='1' AND transaction.adv_user_id='" . @$userInfo->id . "' AND transaction.expiry_date >= '" . date('Y-m-d') . "'";
                $bannerAdvs = DB::select($Sql);
                if (count(@$bannerAdvs) > 0) {
                    foreach (@$bannerAdvs as $k => $v) {
                        if (!empty(@$v->image) && file_exists('public/ads/' . @$v->image . '')) {
                            $bannerImg[] = url('ads/' . @$v->image . '');
                        }
                    }
                }
                $array = [
                    'userId' => @$userInfo->id,
                    'firstName' => @$userInfo->first_name,
                    'lastName' => @$userInfo->last_name,
                    'email' => @$userInfo->email,
                    'address' => @$userInfo->address,
                    'profilePic' => @$profilePic,
                    'coverPic' => @$coverPic,
                    'userType' => @$userType->name,
                    'aboutMe' => @$userInfo->bio,
                    'phone' => @$userInfo->phone,
                    'dob' => @$userInfo->dob,
                    'interest' => @$interestArray,
                    'photos' => @$gallery,
                    'events' => @$Eventarray,
                    'bannerImg' => @$bannerImg,
                ];
                $response = ["status" => 1, "userInfo" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function notificationList_get() {
		if(!empty(@$_GET['userId'])){
		    //$query = DB::table('notifications')->select('*')->when($count < 3, function ($q) { }, function($q) {});
			$list = DB::table('notifications')->whereRaw("receiver_id = '".@$_GET['userId']."' OR noti_type = 'query'")->select('*')->orderBy('id', 'DESC')->get();
			if (count($list) > 0) {
				foreach ($list as $k => $v) {
					$eventInfo = DB::table('events')->where(['status' => 1, 'id' => @$v->event_id])->select('*')->orderBy('id', 'DESC')->first();
					$userInfo = DB::table('users')->where(['status' => 1, 'id' => @$v->sender_id])->select('*')->orderBy('id', 'DESC')->first();
					if (!empty(@$userInfo->profile_image) && file_exists('public/profile/' . @$userInfo->profile_image . '')) {
						$profilePic = url('profile/' . @$userInfo->profile_image . '');
					} else {
						$profilePic = url('profile/unnamed.jpg');
					}
					$replylist = DB::table('replay_notification')->whereRaw("(sender_id = '".@$_GET['userId']."' OR receiver_id = '".@$_GET['userId']."') AND notification_id = ".@$v->id."")->select('*')->orderBy('id', 'DESC')->get();
					$replayArrayList = [];
					if(count($replylist) > 0){
						foreach($replylist as $replyKey => $replyVal){
							$userInfo_1 = DB::table('users')->where(['status' => 1, 'id' => @$replyVal->sender_id])->select('*')->orderBy('id', 'DESC')->first();
							if (!empty(@$userInfo_1->profile_image) && file_exists('public/profile/' . @$userInfo_1->profile_image . '')) {
							    $profilePic_1 = url('profile/' . @$userInfo_1->profile_image . '');
							} else {
							    $profilePic_1 = url('profile/unnamed.jpg');
							}
							$replayArrayList[] = ['id' => @$replyVal->id, 'profilePic' => $profilePic_1, 'message' => $replyVal->message];
						}
					}
					$array[] = [
						'id' => @$v->id,
						'notiMsg' => @$v->noti_msg,
						'eventName' => @$eventInfo->event_name,
						'userName' => @$userInfo->first_name . ' ' . @$userInfo->last_name,
						'profilePic' => @$profilePic,
						'date' => @$v->created_at,
						'notiType' => @$v->noti_type,
						'receiverId' => @$v->receiver_id,
						'comment' => @$replayArrayList,
					];
				}
				$response = ["status" => 1, "list" => $array];
				return response()->json($response, 200);
			} else {
				$response = ["status" => 0, "error" => "data not found."];
				return response()->json($response, 200);
			}
		}else{
			$response = ["status" => 0, "error" => "userId is required."];
			return response()->json($response, 200);
		}
    }
	public function countUnreadNotification_post(Request $request) {
		$validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $list = DB::table('notifications')->where(['receiver_id' => @$request->userId, 'status' => '1'])->select('*')->orderBy('id', 'DESC')->count();
			$response = ["status" => 1, "count" => $list];
			return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
	public function allReadNotification_post(Request $request) {
		$validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $data = array('status' => '0');
			$result = DB::table('notifications')->where(['receiver_id' => $request->userId])->update(@$data);
			if ($result) {
                $response = ["status" => 1, "message" => "Successfully read all notifications."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
	public function deleteNotification_post(Request $request) {
		$validator = Validator::make(
            $request->all(),
            [
                'notiId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $delete = DB::table('notifications')->where(['id' => $request->notiId])->delete();
            if ($delete) {
                $response = ["status" => 1, "message" => "notification deleted successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function topuptransactionList_get() {
        if (!empty(@$_GET['userId'])) {
            $userInfo = DB::table('users')->where(['status' => 1, 'id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($userInfo) {
                $tranList = DB::table('transaction')->where(['payment_type' => 3, 'user_id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->get();
                if (count($tranList) > 0) {
                    foreach ($tranList as $k => $v) {
                        $array[] = [
							'id' => $v->id,
							'userName' => $v->user_name,
							'amount' => $v->amount,
							'transactionId' => $v->txn_id,
							'status' => 'success',
							'paymentDate' => @$v->created_at,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "data not found."];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function withdrawtransactionList_get() {
        if (!empty(@$_GET['userId'])) {
            $userInfo = DB::table('users')->where(['status' => 1, 'id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($userInfo) {
                $tranList = DB::table('transaction')->where(['payment_type' => 4, 'user_id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->get();
                if (count($tranList) > 0) {
                    foreach ($tranList as $k => $v) {
                        $array[] = [
							'id' => $v->id,
							'userName' => $v->user_name,
							'amount' => $v->amount,
							'transactionId' => $v->txn_id,
							'status' => 'success',
							'paymentDate' => @$v->created_at,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "data not found."];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function alltransactionList_get() {
        if (!empty(@$_GET['userId'])) {
            $userInfo = DB::table('users')->where(['status' => 1, 'id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($userInfo) {
                //$tranList  = DB::table('transaction')->where(['payment_type' => 4, 'user_id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->get();
                $Sql = "SELECT * FROM transaction WHERE user_id = " . @$_GET['userId'] . " AND (payment_type = '4' OR payment_type = '3') order by id DESC";
                $tranList = DB::select($Sql);
                if ($tranList) {
                    foreach ($tranList as $k => $v) {
                        if (@$v->payment_type == 3) {
                            $type = 'Top Up';
                        } elseif (@$v->payment_type == 4) {
                            $type = 'Withdraw';
                        }
                        $array[] = [
                            'id' => $v->id,
                            'userName' => $v->user_name,
                            'amount' => $v->amount,
                            'transactionId' => $v->txn_id,
                            'status' => 'success',
                            'type' => $type,
                            'paymentDate' => @$v->created_at,
                        ];
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "data not found."];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function walletWithdraw_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'amount' => 'required',
                'accountNumber' => 'required',
                'userId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $userInfo = DB::table('users')->where(['status' => 1, 'id' => @$request->userId])->select('*')->orderBy('id', 'DESC')->first();
            if (($userInfo->wallet_amount == '') || ($userInfo->wallet_amount == null)) {
                $response = ["status" => 0, "error" => 'balance not available in your wallet.'];
                return response()->json($response, 200);
                exit;
            } elseif ($userInfo->wallet_amount == 0) {
                $response = ["status" => 0, "error" => 'balance not available in your wallet.'];
                return response()->json($response, 200);
                exit;
            } elseif ($userInfo->wallet_amount < $request->amount) {
                $response = ["status" => 0, "error" => 'your wallet balance is not sufficient for withdraw.'];
                return response()->json($response, 200);
                exit;
            }
            $user_name = @$userInfo->first_name . ' ' . @$userInfo->last_name;
            $transactionID = "txn_" . $this->generate_txnId(24);
            $chargeID = "ch_" . $this->generate_txnId(24);
            $orderID = "ORDNO-" . $this->generate_otp(6);
            $data = ['user_name' => $user_name, 'user_id' => @$userInfo->id, 'address' => @$userInfo->address, 'country' => @$userInfo->country, 'state' => @$userInfo->state, 'city' => @$userInfo->city, 'zipcode' => @$userInfo->zipcode, 'amount' => $request->amount, 'currency' => 'usd', 'txn_id' => $transactionID, 'order_id' => $orderID, 'charge_id' => $chargeID, 'status' => 'succeeded', 'payment_type' => '4', 'created_at' => date('Y-m-d H:i:s')];
            $result = DB::table('transaction')->insertGetId($data);
            if ($result) {
                $updateAmount = $userInfo->wallet_amount - $request->amount;
                DB::table('users')->where(['id' => @$userInfo->id])->update(['wallet_amount' => $updateAmount]);
                $walletData = ['user_id' => @$userInfo->id, 'amount' => @$request->amount, 'currency' => 'usd', 'txn_id' => $transactionID, 'order_id' => $orderID, 'charge_id' => $chargeID, 'status' => 'succeeded', 'created_at' => date('Y-m-d H:i:s'), 'type' => '2'];
                DB::table('wallet')->insertGetId($walletData);
                $response = ["status" => 1, 'userId' => @$userInfo->id, "message" => "successfully withdraw."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occurs, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function generate_txnId($length) {
        $characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function productCategoryList_get() {
        $list = DB::table('product_category')->where(['status' => 1])->select('*')->orderBy('name', 'ASC')->get();
        if ($list) {
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'name' => @$v->name,
                ];
            }
            $response = ["status" => 1, 'list' => @$array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'Not found any category'];
            return response()->json($response, 200);
        }
    }
    public function productSubcategory_get() {
        if (@$_GET['categoryId']) {
            $list = DB::table('product_subcategory')->where(['category_id' => @$_GET['categoryId']])->select('*')->orderBy('name', 'ASC')->get();
            if ($list) {
                foreach ($list as $k => $v) {
                    $array[] = [
                        'id' => @$v->id,
                        'name' => @$v->name,
                        'categoryId' => @$v->category_id,
                    ];
                }
                $response = ["status" => 1, 'list' => @$array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Not found any subcategory'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'categoryId is required.'];
            return response()->json($response, 200);
        }
    }
    public function addProduct_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'productName' => 'required',
                'category' => 'required',
                //'subcategory' => 'required',
                'listingId' => 'required',
                'price' => 'required',
                //'specialPrice' => 'required',
                //'quantity' => 'required',
                //'availability' => 'required',
                'description' => 'required',
                //'status' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $productName = @$request->productName;
            $category = @$request->category;
            $subcategory = 0;
            $listingId = @$request->listingId;
            $price = @$request->price;
            $specialPrice = 0;
            $quantity = 0;
            $availability = 0;
            $description = @$request->description;
            $status = 1;
            $userId = @$request->userId;
            $tags = @$request->tags;
            $data = ['name' => @$productName, 'category' => @$category, 'subcategory' => @$subcategory, 'listing_id' => @$listingId, 'price' => @$price, 'special_price' => @$specialPrice, 'quantity' => @$quantity, 'availability' => @$availability, 'description' => @$description, 'status' => @$status, 'user_id' => @$userId, 'tags' => @$tags, 'created_at' => date('Y-m-d H:i:s')];
            $result = DB::table('product')->insertGetId($data);
            $result1 = 'productID='.$result;
            $getLogo = DB::table('settings')->first();
            $QRName = $result.'_qrcode.png';
            $directoryPath = 'public/productQR/';
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true); // Create the directory if it doesn't exist
            }
            //QrCode::format('png')->size(200)->generate($result, $directoryPath . '/' . $QRName);
            QrCode::format('png')->size(200)->format('png')->merge('/public/setting/'.$getLogo->logo)->errorCorrection('M')->generate($result1, $directoryPath . '/' . $QRName);
            $fullUrl = 'productQR/'. $QRName;
            $update_data = array('qrpath' => $fullUrl);
            DB::table('product')->where(['id' => $result])->update(@$update_data);
            if ($result) {
                $image = array();
                if ($file = $request->file('productImage')) {
                    foreach ($file as $file) {
                        $image_name = md5(rand(1000, 10000));
                        $ext = strtolower($file->getClientOriginalExtension());
                        $image_full_name = $image_name . '.' . $ext;
                        $uploade_path = public_path('product/');
                        $image_url = $image_full_name;
                        $file->move($uploade_path, $image_full_name);
                        $image = $image_url;
                        $data = ['image' => $image, 'product_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
                        DB::table('product_image')->insertGetId($data);
                    }
                }
                $response = ["status" => 1, "productId" => $result, 'message' => 'product added successfully.'];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occur, Please try again!'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function productDeatils_get() {
        if (@$_GET['productId']) {
            $list = DB::table('product')->where(['id' => @$_GET['productId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($list) {
                if(!empty(@$list->user_id)) {
                    $userData = DB::table('users')->where(['id' => @$list->user_id])->select('*')->orderBy('id', 'DESC')->first();
                    if ($userData->first_name) {
                        $full_name = $userData->first_name.' '.$userData->last_name;
                    } else {
                        $full_name = '';
                    }
                    if (!empty($userData->profile_image) && file_exists('public/profile/' . @$userData->profile_image . '')) {
                        $user_image = url('profile/' . $userData->profile_image . '');
                    } else {
                        $user_image = '';
                    }
                } else {
                    $full_name = '';
                    $user_image = '';
                }
                $category = DB::table('product_category')->where(['id' => @$list->category])->select('*')->orderBy('id', 'DESC')->first();
                if ($category->name) {
                    $catName = $category->name;
                } else {
                    $catName = '';
                }
                if(@$list->subcategory != 0){
                    $subcategory = DB::table('product_subcategory')->where(['id' => @$list->subcategory])->select('*')->orderBy('id', 'DESC')->first();
                    if ($subcategory->name) {
                        $subcatName = $subcategory->name;
                    } else {
                        $subcatName = 'No Subcategory available';
                    }
                } else {
                    $subcatName = 'No Subcategory available';
                }
                $gallery = [];
                $image = DB::table('product_image')->where(['product_id' => @$list->id])->select('*')->orderBy('id', 'DESC')->get();
                if ($image) {
                    foreach ($image as $k => $v) {
                        if (!empty($v->image) && file_exists('public/product/' . @$v->image . '')) {
                            $gallery[] = url('product/' . $v->image . '');
                        } else {
                            $gallery[] = '';
                        }
                    }
                }
                if(!empty(@$list->qrpath)){
                    $qrPath = url(@$list->qrpath);
                } else {
                    $qrPath = url('noimage.jpg');
                }
				$rating = DB::table('business_review')->where(['product_id' => @$list->id])->select('*')->orderBy('id', 'DESC')->get();
				$ratingArray = [];
				if(count($rating) > 0){
					foreach($rating as $ratingKey => $ratingVal){
						$userInfo = DB::table('users')->where(['id' => @$ratingVal->user_id])->select('*')->orderBy('id', 'DESC')->first();
						if (!empty(@$userInfo->profile_image) && file_exists('public/profile/' . @$userInfo->profile_image . '')) {
							$profilePic = url('profile/' . @$userInfo->profile_image . '');
						} else {
							$profilePic = url('profile/unnamed.jpg');
						}
						$ratingArray[] = [
							'ratingId' => @$ratingVal->id,
							'userName' => @$userInfo->first_name.' '.@$userInfo->last_name,
							'profilePic' => @$profilePic,
							//'comment'  => @$v->comment,
							'rating'   => @$ratingVal->rating,
						];
					}
				}
                $array = [
                    'productId' => @$list->id,
                    'productName' => @$list->name,
                    'ownername' => @$full_name,
                    'ownerimage' => @$user_image,
                    'productName' => @$list->name,
                    'categoryId' => @$list->category,
                    'categoryName' => @$catName,
                    'subcategoryId' => @$list->subcategory,
                    'subcategoryName' => @$subcatName,
                    'listingId' => @$list->listing_id,
                    'price' => @$list->price,
                    'specialPrice' => @$list->special_price,
                    'quantity' => @$list->quantity,
                    'availability' => @$list->availability,
                    'description' => @$list->description,
                    'status' => @$list->status,
                    'tags' => @$list->tags,
                    'qr_code' => $qrPath,
                    'galleryImage' => @$gallery,
					'ratingArray' => @$ratingArray,
                ];
                $response = ["status" => 1, 'productDetail' => @$array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'No product data found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'productId is required.'];
            return response()->json($response, 200);
        }
    }
    public function updateProduct_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'productId' => 'required',
                'productName' => 'required',
                'category' => 'required',
                //'subcategory' => 'required',
                'listingId' => 'required',
                'price' => 'required',
                //'specialPrice' => 'required',
                //'quantity' => 'required',
                //'availability' => 'required',
                'description' => 'required',
                //'status' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $productName = $request->productName;
            $category = $request->category;
            $subcategory = 0;
            $listingId = $request->listingId;
            $price = $request->price;
            $specialPrice = 0;
            $quantity = 0;
            $availability = 0;
            $description = $request->description;
            $status = 1;
            $productId = $request->productId;
            $tags = @$request->tags;
            $data = ['name' => @$productName, 'category' => @$category, 'subcategory' => @$subcategory, 'listing_id' => @$listingId, 'price' => @$price, 'special_price' => @$specialPrice, 'quantity' => @$quantity, 'availability' => @$availability, 'description' => @$description, 'status' => @$status, 'tags' => @$tags, 'updated_at' => date('Y-m-d H:i:s')];
            //$result = DB::table('product')->insertGetId($data);
            $result = DB::table('product')->where('id', $productId)->update(@$data);
            $result1 = 'productID='.$productId;
            $getLogo = DB::table('settings')->first();
            $QRName = $productId.'_qrcode.png';
            $directoryPath = 'public/productQR/';
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true); // Create the directory if it doesn't exist
            }
            //QrCode::format('png')->size(200)->generate($result, $directoryPath . '/' . $QRName);
            QrCode::format('png')->size(200)->format('png')->merge('/public/setting/'.$getLogo->logo)->errorCorrection('M')->generate($result1, $directoryPath . '/' . $QRName);
            $fullUrl = 'productQR/'. $QRName;
            $update_data = array('qrpath' => $fullUrl);
            DB::table('product')->where(['id' => $productId])->update(@$update_data);
            if ($result) {
                $image = array();
                if ($file = $request->file('productImage')) {
                    foreach ($file as $file) {
                        $image_name = md5(rand(1000, 10000));
                        $ext = strtolower($file->getClientOriginalExtension());
                        $image_full_name = $image_name . '.' . $ext;
                        $uploade_path = public_path('product/');
                        $image_url = $image_full_name;
                        $file->move($uploade_path, $image_full_name);
                        $image = $image_url;
                        $data = ['image' => $image, 'product_id' => $productId, 'updated_at' => date('Y-m-d H:i:s')];
                        DB::table('product_image')->insertGetId($data);
                    }
                }
                $response = ["status" => 1, "productId" => $productId, 'message' => 'product updated successfully.'];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occur, Please try again!'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function productList_get() {
        $list = DB::table('product')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
        if ($list) {
            foreach ($list as $k => $v) {
                $category = DB::table('product_category')->where(['id' => @$v->category])->select('*')->orderBy('id', 'DESC')->first();
                if ($category) {
                    if ($category->name) {
                        $catName = $category->name;
                    } else {
                        $catName = '';
                    }
                } else {
                    $catName = '';
                }
                $subcategory = DB::table('product_subcategory')->where(['id' => @$v->subcategory])->select('*')->orderBy('id', 'DESC')->first();
                if ($subcategory) {
                    if ($subcategory->name) {
                        $subcatName = $subcategory->name;
                    } else {
                        $subcatName = '';
                    }
                } else {
                    $subcatName = '';
                }
                $image = DB::table('product_image')->where(['product_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->get();
                if ($image) {
                    foreach ($image as $k1 => $v1) {
                        if (!empty($v1->image) && file_exists('public/product/' . $v1->image . '')) {
                            $gallery[] = url('product/' . $v1->image . '');
                        }
                    }
                }
                if(!empty(@$v->qrpath)){
                    $qrPath = url(@$v->qrpath);
                } else {
                    $qrPath = url('noimage.jpg');
                }
                $array[] = [
                    'productId' => @$v->id,
                    'productName' => @$v->name,
                    'categoryId' => @$v->category,
                    'categoryName' => @$catName,
                    'subcategoryId' => @$v->subcategory,
                    'subcategoryName' => @$subcatName,
                    'listingId' => @$v->listing_id,
                    'price' => @$v->price,
                    'specialPrice' => @$v->special_price,
                    'quantity' => @$v->quantity,
                    'availability' => @$v->availability,
                    'description' => @$v->description,
                    'status' => @$v->status,
                    'tags' => @$v->tags,
                    'qr_code' => $qrPath,
                    'galleryImage' => @$gallery,
                ];
            }
            $response = ["status" => 1, 'list' => @$array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'No product list found.'];
            return response()->json($response, 200);
        }
    }
    public function deleteProduct_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'productId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $result = DB::table('product')->where(['id' => @$request->productId])->delete();
            if ($result) {
                $image = DB::table('product_image')->where(['product_id' => @$request->productId])->select('*')->orderBy('id', 'DESC')->get();
                if ($image) {
                    foreach ($image as $k1 => $v1) {
                        if (!empty($v1->image) && file_exists('public/product/' . $v1->image . '')) {
                            unlink('public/product/' . $v1->image . '');
                        }
                    }
                }
                $response = ["status" => 1, 'message' => 'product deleted successfully.'];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occur, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function sendMsg_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'senderId' => 'required',
                'receiverId' => 'required',
                'message' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $senderId = $request->senderId;
            $receiverId = $request->receiverId;
            $message = $request->message;
            $data = ['message' => @$message, 'sender_id' => @$senderId, 'receiver_id' => @$receiverId, 'status' => 1, 'created_at' => date('Y-m-d H:i:s')];
            $result = DB::table('chat')->insertGetId($data);
            if ($result) {
                $senderInfo = DB::table('users')->where(['id' => @$senderId])->select('*')->orderBy('id', 'DESC')->first();
                $senderName = $senderInfo->first_name . ' ' . $senderInfo->last_name;
                if (!empty($senderName->profile_image) && file_exists('public/profile/' . $senderName->profile_image . '')) {
                    $profilePic = url('profile/' . $senderName->profile_image . '');
                } else {
                    $profilePic = url('profile/noimage.jpg');
                }
                $response = ["status" => 1, "senderId" => $senderId, 'message' => $message, 'senderName' => $senderName, 'profilePic' => $profilePic, 'message' => 'send message successfully.'];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occur, Please try again!'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function allChats_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'senderId' => 'required',
                'receiverId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $senderId = $request->senderId;
            $receiverId = $request->receiverId;
            $Sql = "SELECT * FROM chat WHERE (sender_id = " . @$senderId . " and receiver_id = " . @$receiverId . ") OR (sender_id = " . @$receiverId . " and receiver_id = " . @$senderId . ") ORDER BY id ASC";
            $list = DB::select($Sql);
            $senderInfo = DB::table('users')->where(['id' => @$senderId])->select('*')->orderBy('id', 'DESC')->first();
            $receiverInfo = DB::table('users')->where(['id' => @$receiverId])->select('*')->orderBy('id', 'DESC')->first();
            if ($list) {
                foreach ($list as $k => $v) {
                    if (@$v->sender_id == @$senderId) {
                        $senderName = $senderInfo->first_name . ' ' . $senderInfo->last_name;
                        $senderImage = (!empty(@$senderInfo->profile_image) ? url('public/profile/' . @$senderInfo->profile_image . '') : url('public/noimage.jpg'));
                        $senderMsg = @$v->message;
                        $created = date('Y-m-d H:i:s', strtotime(@$v->created_at));
                        $arr[] = [
                            'msgId' => @$v->id,
                            'senderName' => $senderName,
                            'senderProfile' => $senderImage,
                            'senderMsg' => $senderMsg,
                            'msgDate' => $created,
                        ];
                    } else {
                        $receiverName = $receiverInfo->first_name . ' ' . $receiverInfo->last_name;
                        $receiverImage = (!empty(@$receiverInfo->profile_image) ? url('public/profile/' . @$receiverInfo->profile_image . '') : url('public/noimage.jpg'));
                        $receiverMsg = @$v->message;
                        $created = date('Y-m-d H:i:s', strtotime(@$v->created_at));
                        $arr[] = [
                            'msgId' => @$v->id,
                            'receiverName' => $receiverName,
                            'receiverImage' => $receiverImage,
                            'receiverMsg' => $receiverMsg,
                            'msgDate' => $created,
                        ];
                    }
                }
                $response = ["status" => 1, 'list' => $arr];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No chats list found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function addUserOneSignalId_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'onesignalUserId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $userInfo = DB::table('onesignal_users')->where(['user_id' => $request->userId])->select('*')->orderBy('signal_id', 'DESC')->first();
            if ($userInfo) {
                $mydata = array(
                    'player_id' => $request->onesignalUserId,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $res = DB::table('onesignal_users')->where(['signal_id' => $userInfo->signal_id])->update($mydata);
                if ($res) {
                    $response = ["status" => 1, "signalId" => $userInfo->signal_id, "message" => "onesignalUserId is updated successfully"];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "Something went wrong!"];
                    return response()->json($response, 200);
                }
            } else {
                $mydata = array(
                    'user_id' => $request->userId,
                    'player_id' => $request->onesignalUserId,
                    'created_at' => date('Y-m-d H:i:s'),
                );
                $result = DB::table('onesignal_users')->insertGetId($mydata);
                if ($result) {
                    $response = ["status" => 1, "signalId" => $result, "message" => "onesignalUserId is added successfully"];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "Something went wrong!"];
                    return response()->json($response, 200);
                }
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function stripeConnect_post(Request $request) {
        //require_once(APPPATH.'libraries/stripe-php/init.php');
        //require_once APPPATH.'third_party/stripe/vendor/autoload.php';
        require "vendor/stripe/stripe-php/init.php";
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
            ]
        );
        if ($validator->fails()) {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        } else {
            $userId = @$request->userId;
            //$userInfo = $this->Apimodel->get_cond('users', "userId=".$userId."");
            $userInfo = DB::table('users')->where(['id' => $request->userId])->select('*')->orderBy('id', 'DESC')->first();
            if (!empty($userInfo)) {
                $stripe = new \Stripe\StripeClient(STRIPE_SECRET_KEY);
                try {
                    $account = $stripe->accounts->create(
                        [
                            'country' => 'US',
                            //'country' => ''.@$userInfo->countryNameCode.'',
                            'type' => 'express',
                            'email' => '' . @$userInfo->email . '',
                            'capabilities' => [
                                'card_payments' => ['requested' => true],
                                'transfers' => ['requested' => true],
                            ],
                        ]
                    );
                    $stripe_acc_id = $account['id'];
                    $link = $stripe->accountLinks->create(
                        [
                            'account' => $stripe_acc_id,
                            'refresh_url' => url('webview/stripeReturn?userId=' . $userId . ''),
                            'return_url' => url('webview/stripeReturn?userId=' . $userId . ''),
                            'type' => 'account_onboarding',
                        ]
                    );
                } catch (Exception $e) {
                    $api_error = $e->getMessage();
                }
                if (empty($api_error)) {
                    $mydata = array(
                        'userId' => $userId,
                        'stripe_acc_id' => $stripe_acc_id,
                        'expires_at' => $link['expires_at'],
                        'url' => $link['url']
                    );
                    $check = DB::table('stripe_connect')->where(['userId' => $userId])->select('*')->orderBy('id', 'DESC')->first();
                    if (!empty($check)) {
                        $result = DB::table('stripe_connect')->where(['userId' => $userId])->update($mydata);
                    } else {
                        $result = DB::table('stripe_connect')->insertGetId($mydata);
                    }
                    if (!empty($result)) {
                        /*$this->response([
                            'status'=>"1",
                            'stripeUrl' => $link['url'],
                            'returnUrl' => url('webview/stripeReturn?userId='.$userId.''),
                        ], 200);*/
                        $response = ["status" => 1, "stripeUrl" => $link['url'], "returnUrl" => url('webview/stripeReturn?userId=' . $userId . '')];
                        return response()->json($response, 200);
                    } else {
                        /*$this->response([
                            'status'=>"0",
                            'error' => 'Something went wrong!',
                        ], 200);*/
                        $response = ["status" => 0, "error" => "Something went wrong!"];
                        return response()->json($response, 200);
                    }
                } else {
                    /*$this->response([
                        'status'=>"0",
                        'error' => $api_error,
                    ], 200);*/
                    $response = ["status" => 0, "error" => $api_error];
                    return response()->json($response, 200);
                }
            } else {
                /*$this->response([
                    'status' => "0",
                    'error' => 'User not found.'
                ], 400);*/
                $response = ["status" => 0, "error" => "User not found."];
                return response()->json($response, 200);
            }
        }
    }
    function userStripeInfo_post(Request $request) {
        require "vendor/stripe/stripe-php/init.php";
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
            ]
        );
        if ($validator->fails()) {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        } else {
            $userId = $request->userId;
            //$userInfo = $this->Apimodel->get_cond('users', "userId=".$userId."");
            $userInfo = DB::table('users')->where(['id' => @$userId])->select('*')->orderBy('id', 'DESC')->first();
            if (!empty($userInfo)) {
                //$guideInfo = $this->Apimodel->get_cond('stripe_connect', "userId='".$userId."'");
                $guideInfo = DB::table('stripe_connect')->where(['userId' => @$userId])->select('*')->orderBy('id', 'DESC')->first();
                if ($guideInfo) {
                    $stripeAccId = $guideInfo->stripe_acc_id;
                    $stripeStatus = $this->get_stripe_info($stripeAccId);
                    if ($stripeStatus == 1) {
                        $url = 'https://api.stripe.com/v1/accounts/' . @$stripeAccId . '';
                        $skey = STRIPE_SECRET_KEY;
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "" . $url . "");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        $headers = array();
                        $headers[] = "Content-Type: application/x-www-form-urlencoded";
                        $headers[] = "Authorization: Bearer " . $skey . "";
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        $result = curl_exec($ch);
                        $get_data = json_decode($result);
                        $arr = array(
                            'stripeId' => @$get_data->id,
                            'name' => @$get_data->business_profile->name,
                            'phone' => @$get_data->business_profile->support_phone,
                            'email' => @$get_data->email,
                            'website' => @$get_data->business_profile->url,
                            'capabilities' => [
                                'card_payments' => @$get_data->capabilities->card_payments,
                                'transfers' => @$get_data->capabilities->transfers
                            ],
                            'charges_enabled' => @$get_data->charges_enabled,
                            'country' => @$get_data->country,
                            'created' => @$get_data->created,
                            'default_currency' => @$get_data->default_currency,
                            'external_accounts' => [
                                'brand' => @$get_data->external_accounts->data[0]->brand,
                                'country' => @$get_data->external_accounts->data[0]->country,
                                'cvc_check' => @$get_data->external_accounts->data[0]->cvc_check,
                                'cvc_check' => @$get_data->external_accounts->data[0]->cvc_check,
                                'exp_month' => @$get_data->external_accounts->data[0]->exp_month,
                                'exp_year' => @$get_data->external_accounts->data[0]->exp_year,
                                'last4' => @$get_data->external_accounts->data[0]->last4,
                                'fingerprint' => @$get_data->external_accounts->data[0]->fingerprint,
                                'funding' => @$get_data->external_accounts->data[0]->funding,
                            ],
                            'payouts_enabled' => @$get_data->payouts_enabled,
                            'type' => @$get_data->type,
                        );
                        /*$arr = $this->arrcheck($arr);
                        $this->response([
                            'status'=>"1",
                            'stripeInfo'=>$arr
                        ], 200);*/
                        $response = ["status" => 1, "stripeInfo" => @$arr];
                        return response()->json($response, 200);
                    } else {
                        /*$this->response([
                            'status' => "0",
                            'error' => 'stripe not connected..'
                        ], 400);*/
                        $response = ["status" => 0, "error" => "stripe not connected."];
                        return response()->json($response, 200);
                    }
                } else {
                    /*$this->response([
                        'status' => "0",
                        'error' => 'stripe not found.'
                    ], 400);*/
                    $response = ["status" => 0, "error" => "stripe not found."];
                    return response()->json($response, 200);
                }
            } else {
                /*$this->response([
                    'status' => "0",
                    'error' => 'User not found.'
                ], 400);*/
                $response = ["status" => 0, "error" => "User not found."];
                return response()->json($response, 200);
            }
        }
    }
    function get_stripe_info($stripe_acc_id = '') {
        $url = 'https://api.stripe.com/v1/accounts/' . @$stripe_acc_id . '';
        $skey = STRIPE_SECRET_KEY;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "" . $url . "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        $headers[] = "Authorization: Bearer " . $skey . "";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        $get_data = json_decode($result);
        if (!empty($get_data->payouts_enabled) and !empty($get_data->charges_enabled) and $get_data->payouts_enabled == 1 and $get_data->charges_enabled == 1) {
            $status = '1';
        } else {
            $status = '0';
        }
        return $status;
    }
    public function bannerList_get() {
        $list = DB::table('banner')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
        if ($list) {
            foreach ($list as $k => $v) {
                if (!empty($v->image) && file_exists('public/banner/' . $v->image . '')) {
                    $bannerImg = url('banner/' . $v->image . '');
                } else {
                    $bannerImg = '';
                }
                $array[] = [
                    'id' => @$v->id,
                    'name' => @$v->name,
                    'image' => @$bannerImg,
                ];
            }
            $response = ["status" => 1, 'list' => @$array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'No banner list found.'];
            return response()->json($response, 200);
        }
    }
    public function promotionManagement_get() {
        $Sql = "SELECT * FROM promotion WHERE status = '1' order by id desc";
        $list = DB::select($Sql);
        if ($list) {
            if (!empty($list[0]->image) && file_exists('public/ads/' . $list[0]->image . '')) {
                $image = url('ads/' . $list[0]->image . '');
            } else {
                $image = '';
            }
            if ($list[0]->user_id == 0) {
                $organizer = 'Admin';
                $profilePic = url('profile/unnamed.jpg');
            } else {
                $organizerName = DB::table('users')->where(['id' => $list[0]->user_id])->select('*')->orderBy('id', 'DESC')->first();
                $organizer = @$organizerName->first_name . ' ' . @$organizerName->last_name;
                if (!empty(@$organizerName->profile_image) && file_exists('public/profile/' . @$organizerName->profile_image . '')) {
                    $profilePic = url('profile/' . @$organizerName->profile_image . '');
                } else {
                    $profilePic = url('profile/unnamed.jpg');
                }
            }
            $array[] = [
                'adsId' => @$list[0]->id,
                'adsName' => @$list[0]->ads_name,
                'url' => @$list[0]->url,
                'description' => strip_tags(@$list[0]->description),
                'image' => @$image,
                'profileImg' => @$profilePic,
                'userName' => @$organizer,
            ];
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'data not found.'];
            return response()->json($response, 200);
        }
    }
    public function eventManagement_get() {
        if (!empty($_GET['userId']) || $_GET['userId'] != '' ) {
        $Sql = "SELECT * FROM events WHERE status = '1' AND DATE(start_date) >= '" . date('Y-m-d') . "' order by id DESC";
        $eventsList = DB::select($Sql);
        if ($eventsList) {
            $category = DB::table('event_category')->where(['id' => @$eventsList[0]->category])->select('name')->orderBy('id', 'DESC')->first();
            $image = DB::table('event_image')->where(['event_id' => @$eventsList[0]->id])->select('*')->orderBy('id', 'DESC')->first();
            if (@$eventsList[0]->user_id == 0) {
                $userName = 'Admin';
            } else {
                $checkUser = DB::table('users')->where(['id' => @$eventsList[0]->user_id])->select('*')->orderBy('id', 'DESC')->first();
                if ($checkUser) {
                    $userName = $checkUser->first_name . ' ' . $checkUser->last_name;
                } else {
                    $userName = '';
                }
            }
            if (!empty($image->image) && file_exists('public/events/' . $image->image . '')) {
                $galleryImg = url('events/' . $image->image . '');
            } else {
                $galleryImg = url('noimage.jpg');
            }
            $startDate = $eventsList[0]->start_date;
            $start_date = date('Y-m-d H:i:s', strtotime($startDate));
            $endDate = $eventsList[0]->end_date;
            $end_date = date('Y-m-d H:i:s', strtotime($endDate));
            if (!empty($checkUser->profile_image) && file_exists('public/profile/' . $checkUser->profile_image . '')) {
                $userPic = url('profile/' . $checkUser->profile_image . '');
            } else {
                $userPic = url('noimage.jpg');
            }
            $checkfav = DB::table('favouriteevent')->where('user_id', $_GET['userId'])->where('event_id', $eventsList[0]->id)->first();
            if(!empty($checkfav)) {
                $isFav = 1;
            } else {
                $isFav = 0;
            }
            $array = [
                'eventId' => @$eventsList[0]->id,
                'eventName' => @$eventsList[0]->event_name,
                'startDate' => $start_date,
                'start_time' => $eventsList[0]->start_time,
                'endDate' => $end_date,
                'end_time' => $eventsList[0]->end_time,
                'location' => @$eventsList[0]->location,
                'category' => @$category->name,
                'image' => @$galleryImg,
                'userName' => @$userName,
                'userPic' => @$userPic,
                'isFav' => @$isFav,
            ];
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "events not found."];
            return response()->json($response, 200);
        }
    } else {
        $response = ["status" => 0, "error" => "Events not found."];
        return response()->json($response, 200);
    }
    }
    public function subscriptionManagement_get() {
        $accessArray = [];
        $subArray = [];
        if (!empty(@$_GET['userId'])) {
            $checkUser = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($checkUser) {
                //$eventsList = DB::table('events')->where(['status' => 1, 'user_id' => @$_GET['userId'], 'start_date' => ">=".date('Y-m-d H:i:s').""])->select('*')->orderBy('id', 'DESC')->first();
                $Sql = "SELECT * FROM transaction WHERE payment_type = '1' AND status = 'succeeded' AND user_id = '" . @$_GET['userId'] . "' order by id DESC";
                $subList = DB::select($Sql);
                if ($subList) {
                    $subInfo = DB::table('sub_plan')->where(['id' => @$subList[0]->sub_id])->select('*')->orderBy('id', 'DESC')->first();
                    $accessList = DB::table('sub_permision_menu')->where(['sub_id' => @$subInfo->id])->select('*')->get();
                    if (@$subList[0]->expiry_date >= date('Y-m-d')) {
                        $status = 'Active Plan';
                    } else {
                        $status = 'Expired Plan';
                    }
                    if (count($accessList) > 0) {
                        foreach ($accessList as $accessKey => $accessVal) {
                            $accessMenu = DB::table('sub_access_menu')->where(['id' => @$accessVal->menu_id])->select('*')->first();
                            $menu = ['menuId' => $accessMenu->id, 'accessMenu' => $accessMenu->menu];
                            if (empty(@$accessVal->number_of)) {
                                $number_of = 0;
                            } else {
                                $number_of = @$accessVal->number_of;
                            }
                            $accessArray[] = [
                                'menu' => $menu,
                                'read_access' => @$accessVal->read_access,
                                'write_access' => @$accessVal->write_access,
                                //'full_access'  => @$accessVal->full_access,
                                'number_of' => @$number_of,
                            ];
                        }
                    }
                    $subArray = ['subId' => @$subInfo->id, 'subName' => @$subInfo->name, 'status' => @$status, 'expiryDate' => @$subList[0]->expiry_date, 'subAccess' => $accessArray];
                    $userName = $checkUser->first_name . ' ' . $checkUser->last_name;
                    if (!empty($checkUser->profile_image) && file_exists('public/profile/' . $checkUser->profile_image . '')) {
                        $userPic = url('profile/' . $checkUser->profile_image . '');
                    } else {
                        $userPic = url('noimage.jpg');
                    }
                    $array = [
                        'subId' => @$subInfo->id,
                        'name' => @$subInfo->name,
                        'description' => strip_tags(@$subInfo->description),
                        'amount' => @$subInfo->amount,
                        'expiryDate' => @$subList[0]->expiry_date,
                        'status' => @$status,
                        'userName' => @$userName,
                        'userPic' => @$userPic,
                        'subInfo' => @$subArray
                    ];
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => "subscription not found."];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function networkManagement_get() {
        $list = DB::table('users')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->first();
        if (!empty($list)) {
            if (!empty(@$list->profile_image) && file_exists('public/profile/' . @$list->profile_image . '')) {
                $profilePic = url('profile/' . @$list->profile_image . '');
            } else {
                $profilePic = url('profile/unnamed.jpg');
            }
            $userType = DB::table('user_type')->where(['id' => @$list->user_type])->select('*')->orderBy('id', 'DESC')->first();
            $array = [
                'userId' => @$list->id,
                'firstName' => @$list->first_name,
                'lastName' => @$list->last_name,
                'email' => @$list->email,
                'address' => @$list->address,
                'profilePic' => @$profilePic,
                'userType' => @$userType->name,
            ];
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "No network list found."];
            return response()->json($response, 200);
        }
    }
    public function appearanceManagement_get() {
        if (!empty(@$_GET['userId'])) {
            $userCheck = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->count();
            if ($userCheck > 0) {
                $Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, invitation.comment, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='1' AND repeat_invitation.status='1' AND (repeat_invitation.sender_id = '" . @$_GET['userId'] . "' OR repeat_invitation.receiver_id = '" . @$_GET['userId'] . "')";
                $list = DB::select($Sql);
                if ($list) {
                    //$userInfo = DB::select("select first_name, last_name from users where user_type = '4' AND (id = '".$list[0]->sender_id."' OR id = '".$list[0]->receiver_id."') LIMIT 1");
                    $userInfo = DB::select("select first_name, last_name from users where id = '" . $list[0]->sender_id . "' OR id = '" . $list[0]->receiver_id . "' LIMIT 1");
                    $eventInfo = DB::select("select event_name, location, start_date from events where id = '" . $list[0]->event_id . "' LIMIT 1");
                    $getEvent_image = DB::table('event_image')->where('event_id', @$list[0]->event_id)->first();
                    if (!empty(@$getEvent_image->image) && file_exists('public/events/' . $getEvent_image->image . '')) {
                        $image = url('events/'.@$getEvent_image->image.'');
                    } else {
                        $image = url('noimage.jpg');;
                    }
                    $event_time = DB::table('events')->where('id', @$list[0]->event_id)->first();
					if($eventInfo){
						$array = [
							'invitationId' => @$list[0]->invId,
							'eventId' => @$list[0]->event_id,
                            'image' => $image,
							'athleteName' => @$userInfo[0]->first_name . ' ' . @$userInfo[0]->last_name,
							'eventName' => @$eventInfo[0]->event_name,
							'eventDate' => @$eventInfo[0]->start_date,
                            'start_time' => @$event_time->start_time,
                            'end_time' => @$event_time->end_time,
							'location' => @$eventInfo[0]->location,
							'amount' => @$list[0]->amount,
							'hour' => @$list[0]->hour,
							'senderId' => @$list[0]->sender_id,
							'receiverId' => @$list[0]->receiver_id,
                            'comment' => @$list[0]->comment,
						];
						$response = ["status" => 1, "list" => $array];
						return response()->json($response, 200);
					}else{
						$response = ["status" => 0, "error" => 'data not found.'];
                        return response()->json($response, 200);
					}
                } else {
                    $response = ["status" => 0, "error" => 'data not found.'];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => 'user not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function businessManagement_get() {
        if (!empty($_GET['userId']) || $_GET['userId'] != '' ) {
            $businessList = DB::table('listing')->where(['status' => 1])->limit(9)->select('*')->orderBy('id', 'DESC')->get();
            if ($businessList) {
                foreach ($businessList as $k => $v) {
                    $category = DB::table('listing_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
                    $image = DB::table('listing_image')->where(['listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                    if (!empty($image->image) && file_exists('public/listing/' . $image->image . '')) {
                        $galleryImg = url('listing/' . $image->image . '');
                    } else {
                        $galleryImg = url('noimage.jpg');
                    }
                    $checkfav = DB::table('favouritebusiness')->where('user_id', $_GET['userId'])->where('user_id', @$v->id)->first();
                    if(!empty($checkfav)) {
                        $isFav = 1;
                    } else {
                        $isFav = 0;
                    }
                    $array[] = [
                        'businessId' => @$v->id,
                        'businessName' => @$v->business_name,
                        'address' => @$v->address,
                        'category' => @$category->name,
                        'image' => @$galleryImg,
                        'isFav' => @$isFav
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Business not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "Business not found."];
            return response()->json($response, 200);
        }
    }
    public function addCategory_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'category' => 'required',
            ]
        );
        if ($validator->fails()) {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        } else {
            /*$data = ['name' => @$request->category, 'status' => 1, 'created_at' => date('Y-m-d H:i:s')];
            $result = DB::table('product_category')->insertGetId($data);
            if ($result) {
                $response = ["status" => 1, "catId" => @$result, "message" => "category added successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some error occurred, please try again."];
                return response()->json($response, 200);
            }*/
            // Check if the category already exists
            $existingCategory = DB::table('product_category')->where('name', $request->category)->first();
            if ($existingCategory) {
                $response = ["status" => 0, "error" => "Category name already exists."];
                return response()->json($response, 200);
            }
            $data = [
                'name' => $request->category,
                'user_id' => $request->userId,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $result = DB::table('product_category')->insertGetId($data);
            if ($result) {
                $response = ["status" => 1, "catId" => $result, "message" => "Category added successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some error occurred, please try again."];
                return response()->json($response, 200);
            }
        }
    }
    public function deleteCategory_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'catId' => 'required',
            ]
        );
        if ($validator->fails()) {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        } else {
            $result = DB::table('product_category')->where(['id' => $request->catId])->delete();
            if ($result) {
                $response = ["status" => 1, "message" => "category deleted successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some error occurred, please try again."];
                return response()->json($response, 200);
            }
        }
    }
    public function categoryList_get() {
        $list = DB::table('product_category')->where(['status' => 1])->select('*')->orderBy('name', 'ASC')->get();
        if ($list) {
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'name' => @$v->name,
                ];
            }
            $response = ["status" => 1, 'list' => @$array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'Not found any category'];
            return response()->json($response, 200);
        }
    }
    public function addService_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'serviceName' => 'required',
                'category' => 'required',
                'listingId' => 'required',
                'price' => 'required',
                //'specialPrice' => 'required',
                'description' => 'required',
                //'tags' => 'required'
            ]
        );
        if (!$validator->fails()) {
            $serviceName = $request->serviceName;
            $category = $request->category;
            $listingId = $request->listingId;
            $price = $request->price;
            $specialPrice = 0;
            $description = $request->description;
            $status = 1;
            $userId = $request->userId;
            /*if($request->tags){
                $tags = implode(',', $request->tags);
            } else {
                $tags = '';
            }*/
            $data = ['name' => @$serviceName, 'category' => @$category, 'listing_id' => @$listingId, 'price' => @$price, 'special_price' => @$specialPrice, 'description' => @$description, 'tags' => @$request->tags, 'status' => @$status, 'user_id' => @$userId, 'created_at' => date('Y-m-d H:i:s')];
            $result = DB::table('services')->insertGetId($data);
            $result1 = 'serviceID='.$result;
            $getLogo = DB::table('settings')->first();
            $QRName = $result.'_qrcode.png';
            $directoryPath = 'public/servicesQR/';
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true); // Create the directory if it doesn't exist
            }
            //QrCode::format('png')->size(200)->generate($result, $directoryPath . '/' . $QRName);
            QrCode::format('png')->size(200)->format('png')->merge('/public/setting/'.$getLogo->logo)->errorCorrection('M')->generate($result1, $directoryPath . '/' . $QRName);
            $fullUrl = 'servicesQR/'. $QRName;
            $update_data = array('qrpath' => $fullUrl);
            DB::table('services')->where(['id' => $result])->update(@$update_data);
            if ($result) {
                $image = array();
                if ($file = $request->file('serviceImage')) {
                    foreach ($file as $file) {
                        $image_name = md5(rand(1000, 10000));
                        $ext = strtolower($file->getClientOriginalExtension());
                        $image_full_name = $image_name . '.' . $ext;
                        $uploade_path = public_path('service/');
                        $image_url = $image_full_name;
                        $file->move($uploade_path, $image_full_name);
                        $image = $image_url;
                        $data = ['image' => $image, 'service_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
                        DB::table('services_image')->insertGetId($data);
                    }
                }
                $response = ["status" => 1, "serviceId" => $result, 'message' => 'service added successfully.'];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occur, Please try again!'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function serviceDetails_get() {
        if (@$_GET['serviceId']) {
            $list = DB::table('services')->where(['id' => @$_GET['serviceId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($list) {
                if(!empty(@$list->user_id)) {
                    $userData = DB::table('users')->where(['id' => @$list->user_id])->select('*')->orderBy('id', 'DESC')->first();
                    if ($userData->first_name) {
                        $full_name = $userData->first_name.' '.$userData->last_name;
                    } else {
                        $full_name = '';
                    }
                    if (!empty($userData->profile_image) && file_exists('public/profile/' . @$userData->profile_image . '')) {
                        $user_image = url('profile/' . $userData->profile_image . '');
                    } else {
                        $user_image = '';
                    }
                } else {
                    $full_name = '';
                    $user_image = '';
                }
                $category = DB::table('product_category')->where(['id' => @$list->category])->select('*')->orderBy('id', 'DESC')->first();
                if ($category->name) {
                    $catName = $category->name;
                } else {
                    $catName = '';
                }
                /*$subcategory  = DB::table('product_subcategory')->where(['id' => @$list->subcategory])->select('*')->orderBy('id', 'DESC')->first();
                if($subcategory->name){
                    $subcatName = $subcategory->name;
                }else{
                    $subcatName = '';
                }*/
                $gallery = [];
                $serviceImg = '';
                $image = DB::table('services_image')->where(['service_id' => @$list->id])->select('*')->orderBy('id', 'DESC')->get();
                if ($image) {
                    if (!empty(@$image[0]->image) && file_exists('public/service/' . @$image[0]->image . '')) {
                        $serviceImg = url('service/' . @$image[0]->image . '');
                    } else {
                        $serviceImg = '';
                    }
                    foreach ($image as $k => $v) {
                        if (!empty($v->image) && file_exists('public/service/' . @$v->image . '')) {
                            $gallery[] = url('service/' . $v->image . '');
                        } else {
                            $gallery[] = '';
                        }
                    }
                }
                if(!empty(@$list->qrpath)){
                    $qrPath = url(@$list->qrpath);
                } else {
                    $qrPath = url('noimage.jpg');
                }
				$rating = DB::table('business_review')->where(['product_id' => @$list->id])->select('*')->orderBy('id', 'DESC')->get();
				$ratingArray = [];
				if(count($rating) > 0){
					foreach($rating as $ratingKey => $ratingVal){
						$userInfo = DB::table('users')->where(['id' => @$ratingVal->user_id])->select('*')->orderBy('id', 'DESC')->first();
						if (!empty(@$userInfo->profile_image) && file_exists('public/profile/' . @$userInfo->profile_image . '')) {
							$profilePic = url('profile/' . @$userInfo->profile_image . '');
						} else {
							$profilePic = url('profile/unnamed.jpg');
						}
						$ratingArray[] = [
							'ratingId' => @$ratingVal->id,
							'userName' => @$userInfo->first_name.' '.@$userInfo->last_name,
							'profilePic' => @$profilePic,
							//'comment'  => @$v->comment,
							'rating'   => @$ratingVal->rating,
						];
					}
				}
                $array = [
                    'serviceId' => @$list->id,
                    'serviceName' => @$list->name,
                    'ownername' => @$full_name,
                    'ownerimage' => @$user_image,
                    'categoryId' => @$list->category,
                    'categoryName' => @$catName,
                    'tags' => @$list->tags,
                    'listingId' => @$list->listing_id,
                    'price' => @$list->price,
                    'specialPrice' => @$list->special_price,
                    'description' => @$list->description,
                    'status' => @$list->status,
                    'image' => @$serviceImg,
                    'qr_code' => $qrPath,
                    'galleryImage' => @$gallery,
					'ratingArray' => @$ratingArray,
                ];
                $response = ["status" => 1, 'serviceDetail' => @$array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'No service data found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'serviceId is required.'];
            return response()->json($response, 200);
        }
    }
    public function updateService_post(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'serviceId' => 'required',
                'serviceName' => 'required',
                'category' => 'required',
                'listingId' => 'required',
                'price' => 'required',
                //'specialPrice' => 'required',
                'description' => 'required',
                'tags'       => 'required'
            ]
        );
        if (!$validator->fails()) {
            $serviceName = $request->serviceName;
            $category = $request->category;
            $listingId = $request->listingId;
            $price = $request->price;
            $specialPrice = $request->specialPrice;
            $description = $request->description;
            $status = 1;
            $serviceId = $request->serviceId;
            // if($request->tags){
            // $tags = implode(',', $request->tags);
            // }else{
            // $tags = '';
            // }
            $data = ['name' => @$serviceName, 'category' => @$category, 'listing_id' => @$listingId, 'price' => @$price, 'special_price' => @$specialPrice, 'description' => @$description, 'tags' => @$request->tags, 'status' => @$status, 'updated_at' => date('Y-m-d H:i:s')];
            //$result = DB::table('services')->insertGetId($data);
            $result = DB::table('services')->where('id', $serviceId)->update(@$data);
            $result1 = 'serviceID='.$serviceId;
            $getLogo = DB::table('settings')->first();
            $QRName = $serviceId.'_qrcode.png';
            $directoryPath = 'public/servicesQR/';
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true); // Create the directory if it doesn't exist
            }
            //QrCode::format('png')->size(200)->generate($result, $directoryPath . '/' . $QRName);
            QrCode::format('png')->size(200)->format('png')->merge('/public/setting/'.$getLogo->logo)->errorCorrection('M')->generate($result1, $directoryPath . '/' . $QRName);
            $fullUrl = 'servicesQR/'. $QRName;
            $update_data = array('qrpath' => $fullUrl);
            DB::table('services')->where(['id' => $serviceId])->update(@$update_data);
            if ($result) {
                $image = array();
                if ($file = $request->file('serviceImage')) {
                    foreach ($file as $file) {
                        $image_name = md5(rand(1000, 10000));
                        $ext = strtolower($file->getClientOriginalExtension());
                        $image_full_name = $image_name . '.' . $ext;
                        $uploade_path = public_path('service/');
                        $image_url = $image_full_name;
                        $file->move($uploade_path, $image_full_name);
                        $image = $image_url;
                        $data = ['image' => $image, 'service_id' => $serviceId, 'created_at' => date('Y-m-d H:i:s')];
                        DB::table('services_image')->insertGetId($data);
                    }
                }
                $response = ["status" => 1, "serviceId" => $serviceId, 'message' => 'service updated successfully.'];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occur, Please try again!'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function serviceList_get() {
        $list = DB::table('services')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
        if ($list) {
            foreach ($list as $k => $v) {
                $category = DB::table('product_category')->where(['id' => @$v->category])->select('*')->orderBy('id', 'DESC')->first();
                if ($category) {
                    if ($category->name) {
                        $catName = $category->name;
                    } else {
                        $catName = '';
                    }
                } else {
                    $catName = '';
                }
                /*$subcategory  = DB::table('product_subcategory')->where(['id' => @$v->subcategory])->select('*')->orderBy('id', 'DESC')->first();
                if($subcategory){
                    if($subcategory->name){
                        $subcatName = $subcategory->name;
                    }else{
                        $subcatName = '';
                    }
                }else{
                    $subcatName = '';
                }*/
                $image = DB::table('services_image')->where(['service_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                if (!empty(@$image->image) && file_exists('public/service/' . @$image->image . '')) {
                    $serviceImg = url('service/' . @$image->image . '');
                } else {
                    $serviceImg = '';
                }
                if(!empty(@$v->qrpath)){
                    $qrPath = url(@$v->qrpath);
                } else {
                    $qrPath = url('noimage.jpg');
                }
                $array[] = [
                    'serviceId' => @$v->id,
                    'serviceName' => @$v->name,
                    'categoryId' => @$v->category,
                    'categoryName' => @$catName,
                    'listingId' => @$v->listing_id,
                    'price' => @$v->price,
                    'specialPrice' => @$v->special_price,
                    'description' => @$v->description,
                    'status' => @$v->status,
                    'qr_code' => $qrPath,
                    'image' => @$serviceImg,
                ];
            }
            $response = ["status" => 1, 'list' => @$array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'No service list found.'];
            return response()->json($response, 200);
        }
    }
    public function deleteService_post(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'serviceId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $result = DB::table('services')->where(['id' => @$request->serviceId])->delete();
            if ($result) {
                $image = DB::table('services_image')->where(['service_id' => @$request->serviceId])->select('*')->orderBy('id', 'DESC')->get();
                if ($image) {
                    foreach ($image as $k1 => $v1) {
                        if (!empty($v1->image) && file_exists('public/service/' . $v1->image . '')) {
                            unlink('public/service/' . $v1->image . '');
                            DB::table('services_image')->where(['id' => @$v1->service_id])->delete();
                        }
                    }
                }
                $response = ["status" => 1, 'message' => 'service deleted successfully.'];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occur, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function searchService_get()
    {
        $searchText = (!empty(@$_GET['searchText']) ? @$_GET['searchText'] : '');
        $category = (!empty(@$_GET['category']) ? @$_GET['category'] : '');
        $tags = (!empty(@$_GET['tags']) ? @$_GET['tags'] : '');
        if (!empty($searchText)) {
            $sql = "SELECT * FROM services WHERE status = '1'";
            $sql .= " AND (name LIKE '%" . $searchText . "%' OR description LIKE '%" . $searchText . "%')";
        } elseif (empty($category) && !empty($tags)) {
            $sql = "SELECT * FROM services WHERE status = '1'";
            $sql .= " AND FIND_IN_SET('" . $tags . "', tags)";
            //$sql.= " AND category = ".$category."";
        } elseif (!empty($category) && empty($tags)) {
            $sql = "SELECT * FROM services WHERE status = '1'";
            $sql .= " AND category = " . $category . "";
        } elseif (!empty($category) && !empty($tags)) {
            $sql = "SELECT * FROM services WHERE status = '1'";
            $sql .= " AND category = " . $category . "";
            $sql .= " AND FIND_IN_SET('" . $tags . "', tags)";
        } else {
            $sql = "SELECT * FROM services WHERE status = '1'";
        }
        $list = DB::select($sql);
        if ($list) {
            foreach ($list as $k => $v) {
                $category = DB::table('product_category')->where(['id' => @$v->category])->select('*')->orderBy('id', 'DESC')->first();
                if ($category) {
                    if ($category->name) {
                        $catName = $category->name;
                    } else {
                        $catName = '';
                    }
                } else {
                    $catName = '';
                }
                /*$subcategory  = DB::table('product_subcategory')->where(['id' => @$v->subcategory])->select('*')->orderBy('id', 'DESC')->first();
                            if($subcategory){
                                if($subcategory->name){
                                    $subcatName = $subcategory->name;
                                }else{
                                    $subcatName = '';
                                }
                            }else{
                                $subcatName = '';
                            }*/
                $image = DB::table('services_image')->where(['service_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
                //print_r($image);die;
                if (!empty(@$image->image) && file_exists('public/service/' . @$image->image . '')) {
                    $serviceImg = url('service/' . @$image->image . '');
                } else {
                    $serviceImg = '';
                }
                $array[] = [
                    'serviceId' => @$v->id,
                    'serviceName' => @$v->name,
                    'categoryId' => @$v->category,
                    'categoryName' => @$catName,
                    'listingId' => @$v->listing_id,
                    'price' => @$v->price,
                    'specialPrice' => @$v->special_price,
                    'description' => @$v->description,
                    'status' => @$v->status,
                    'image' => @$serviceImg,
                ];
            }
            $response = ["status" => 1, 'list' => @$array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'No service list found.'];
            return response()->json($response, 200);
        }
    }
    public function planDetailstest_get()
    {
        if (!empty(@$_GET['planId'])) {
            $list = DB::table('sub_plan')->where(['status' => 1, 'id' => @$_GET['planId']])->select('*')->orderBy('id', 'DESC')->first();
            if (!empty($list)) {
                $planType = '';
                if ($list->plan == 1) {
                    $planType = 'Free';
                } else if ($list->plan == 2) {
                    $planType = 'Paid';
                }
                $planDuration = '';
                if ($list->type == 1) {
                    $planDuration = 'Month';
                } else if ($list->type == 2) {
                    $planDuration = 'Year';
                }
                $nav = @$list->description;
                $nav = str_replace(array('<li>', '</li>'), '&&', $nav);
                $nav = str_replace(array('<ul>', '</ul>'), '', $nav);
                //$n = explode('11', $nav);die;
                $nav = array_filter(explode('&&', $nav));
                $nav1 = [];
                // foreach($nav as $k => $v){
                // $nav1[] = $v;
                // }
                foreach ($nav as $k => $v) {
                    //$eventImg[] = ['image' => url('events/'.$v->image.'')];
                    $nav1[] = ['point' => $v];
                }
                $array = [
                    'planId' => @$list->id,
                    'name' => @$list->name,
                    'planType' => @$planType,
                    'planDuration' => @$planDuration,
                    'amount' => @$list->amount,
                    'description' => $nav1,
                ];
                $response = ["status" => 1, "planDetails" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "planId id is required."];
            return response()->json($response, 200);
        }
    }
    public function faq_get()
    {
        $list = DB::table('faq')->where(['status' => 1])->select('*')->orderBy('id', 'ASC')->get();
        if (count(@$list) > 0) {
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'question' => @$v->question,
                    'answer' => @$v->answer,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "data not found."];
            return response()->json($response, 200);
        }
    }
    public function term_get()
    {
        $list = DB::table('cms')->where(['id' => 2, 'status' => 1])->select('*')->orderBy('id', 'ASC')->get();
        if (count(@$list) > 0) {
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'heading' => @$v->heading,
                    'description' => @$v->description,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "data not found."];
            return response()->json($response, 200);
        }
    }
    public function privacyPolicy_get()
    {
        $list = DB::table('cms')->where(['id' => 1, 'status' => 1])->select('*')->orderBy('id', 'ASC')->get();
        if (count(@$list) > 0) {
            foreach ($list as $k => $v) {
                $array[] = [
                    'id' => @$v->id,
                    'heading' => @$v->heading,
                    'description' => strip_tags(@$v->description),
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "data not found."];
            return response()->json($response, 200);
        }
    }
    public function aboutUs_get()
    {
        $list = DB::table('cms')->where(['id' => 3, 'status' => 1])->select('*')->orderBy('id', 'ASC')->get();
        if (count(@$list) > 0) {
            $image = '';
            foreach ($list as $k => $v) {
                if (!empty(@$v->image) && file_exists('public/setting/' . @$v->image . '')) {
                    @$image = url('setting/' . @$v->image . '');
                }
                $array[] = [
                    'id' => @$v->id,
                    'heading' => @$v->heading,
                    'description' => strip_tags(@$v->description),
                    'image' => @$image,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "data not found."];
            return response()->json($response, 200);
        }
    }
    public function discountCode_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'couponCode' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $list = DB::table('discount')->whereRaw("coupon_code = '" . @$request->couponCode . "' AND status = 1")->select('*')->first();
            if ($list) {
                if (@$list->expire_on >= date('Y-m-d')) {
                } else {
                    $response = ["status" => 0, "error" => 'Your coupon code is expired.'];
                    return response()->json($response, 200);
                    exit();
                }
                if ($list->type == 0) {
                    $type = 'amount';
                } elseif ($list->type == 1) {
                    $type = 'percentage';
                }
                $array = [
                    'id' => @$list->id,
                    'type' => @$type,
                    'discount' => @$list->discount,
                    'couponCode' => @$list->coupon_code,
                ];
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'No data found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function eventList_get() {
		if(!empty(@$_GET['userId'])){
			$date = date('Y-m-d');
			$eventsList = DB::select("select * from events where user_id = ".$_GET['userId']." AND DATE(start_date) >= '$date' order by DATE(start_date) ASC");
			if ($eventsList) {
				foreach ($eventsList as $k => $v) {
					$array[] = [
						'eventId' => @$v->id,
						'eventName' => @$v->event_name,
						'startTime' => @$v->start_time,
						'endTime' => @$v->end_time,
					];
				}
				$response = ["status" => 1, "list" => $array];
				return response()->json($response, 200);
			} else {
				$response = ["status" => 0, "error" => "events not found."];
				return response()->json($response, 200);
			}
	    }else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function athleticList_get() {
        $userId = $_GET['userId'];
        $list = DB::table('users')->where('status', 1)->where('user_type', 4)->where('id', '!=', $userId)->select('*')->orderBy('id', 'DESC')->get();
        //print_r($list); die();
        if (count($list) > 0) {
            foreach ($list as $k => $v) {
                if (!empty(@$v->profile_image) && file_exists('public/profile/' . @$v->profile_image . '')) {
                    $profilePic = url('profile/' . @$v->profile_image . '');
                } else {
                    $profilePic = url('profile/unnamed.jpg');
                }
                $userType = DB::table('user_type')->where(['id' => @$v->user_type])->select('*')->orderBy('id', 'DESC')->first();
                $array[] = [
                    'userId' => @$v->id,
                    'firstName' => @$v->first_name,
                    'lastName' => @$v->last_name,
                    'email' => @$v->email,
                    'address' => @$v->address,
                    'profilePic' => @$profilePic,
                    'userType' => @$userType->name,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "No Data found."];
            return response()->json($response, 200);
        }
    }
    public function upcomingInvitationList_get() {
		$array = [];
        if (!empty(@$_GET['userId'])) {
            $userCheck = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->count();
            if ($userCheck > 0) {
                $Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, invitation.comment, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status, repeat_invitation.start_time, repeat_invitation.end_time FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='1' AND repeat_invitation.status='1' AND (repeat_invitation.sender_id = '" . @$_GET['userId'] . "' OR repeat_invitation.receiver_id = '" . @$_GET['userId'] . "')";
                $list = DB::select($Sql);
                if (count($list) > 0) {
                    foreach ($list as $k => $v) {
                        $eventInfo = DB::select("select event_name, location, start_date from events where id = '".$v->event_id."' AND DATE(start_date) > '" . date('Y-m-d') . "' LIMIT 1");
                        if (count($eventInfo) > 0) {
                            if (!empty(@$v->start_time)) {
                                $startTime = date('H:i:s', strtotime(@$v->start_time));
                            } else {
                                $startTime = '';
                            }
                            if (!empty(@$v->end_time)) {
                                $endTime = date('H:i:s', strtotime(@$v->end_time));
                            } else {
                                $endTime = '';
                            }
                            $userInfo = DB::select("select first_name, last_name from users where user_type = '10' AND (id = '" . $v->sender_id . "' OR id = '" . $v->receiver_id . "') LIMIT 1");
                            if (!empty(@$eventInfo[0]->start_date)) {
                                $start_date = date('Y-m-d H:i:s', strtotime(@$eventInfo[0]->start_date));
                            } else {
                                $start_date = '';
                            }
                            $getEvent_image = DB::table('event_image')->where('event_id', @$v->event_id)->first();
                            if (!empty(@$getEvent_image->image) && file_exists('public/events/' . $getEvent_image->image . '')) {
                                $image = url('events/'.@$getEvent_image->image.'');
                            } else {
                                $image = url('noimage.jpg');;
                            }
                            $array[] = [
                                'invitationId' => @$v->invId,
                                'eventId' => @$v->event_id,
                                'image' => $image,
                                'receiverId' => @$v->receiver_id,
                                'athleteName' => @$userInfo[0]->first_name . ' ' . @$userInfo[0]->last_name,
                                'eventName' => @$eventInfo[0]->event_name,
                                'location' => @$eventInfo[0]->location,
                                'eventDate' => @$start_date,
                                'startTime' => @$startTime,
                                'endTime' => @$endTime,
                                'amount' => @$v->amount,
                                'hour' => @$v->hour,
                                'comment' => @$v->comment
                            ];
                        }
                    }
					if(count($array) > 0){
						$response = ["status" => 1, "list" => $array];
                        return response()->json($response, 200);
					}else{
						$response = ["status" => 0, "error" => 'data not found.'];
                        return response()->json($response, 200);
					}
                } else {
                    $response = ["status" => 0, "error" => 'data not found.'];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => 'user not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function ongoingInvitationList_get()
    {
        if (!empty(@$_GET['userId'])) {
            $userCheck = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->count();
            if ($userCheck > 0) {
                //echo date('Y-m-d h:i A');die;
                $Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, invitation.comment, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status, repeat_invitation.start_time, repeat_invitation.end_time FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='1' AND repeat_invitation.status='1' AND repeat_invitation.start_time < '" . date('H:i:s') . "' AND repeat_invitation.end_time > '" . date('H:i:s') . "' AND (repeat_invitation.sender_id = '" . @$_GET['userId'] . "' OR repeat_invitation.receiver_id = '" . @$_GET['userId'] . "')";
                $list = DB::select($Sql);
                if ($list) {
                    foreach ($list as $k => $v) {
                        //print_r($v->sender_id);die;
                        $eventInfo = DB::select("select event_name, location, start_date from events where id = '" . $v->event_id . "' AND DATE(start_date) = '" . date('Y-m-d') . "' LIMIT 1");
                        if (count($eventInfo) > 0) {
                            if (!empty(@$v->start_time)) {
                                $startTime = date('H:i:s', strtotime(@$v->start_time));
                            } else {
                                $startTime = '';
                            }
                            if (!empty(@$v->end_time)) {
                                $endTime = date('H:i:s', strtotime(@$v->end_time));
                            } else {
                                $endTime = '';
                            }
                            $userInfo = DB::select("select first_name, last_name from users where user_type = '4' AND (id = '" . $v->sender_id . "' OR id = '" . $v->receiver_id . "') LIMIT 1");
                            //print_r($userInfo);die;
                            if (!empty(@$eventInfo[0]->start_date)) {
                                $start_date = date('Y-m-d H:i:s', strtotime(@$eventInfo[0]->start_date));
                            } else {
                                $start_date = '';
                            }
                            $getEvent_image = DB::table('event_image')->where('event_id', @$v->event_id)->first();
                            if (!empty(@$getEvent_image->image) && file_exists('public/events/' . $getEvent_image->image . '')) {
                                $image = url('events/'.@$getEvent_image->image.'');
                            } else {
                                $image = url('noimage.jpg');;
                            }
                            $array[] = [
                                'invitationId' => @$v->invId,
                                'eventId' => @$v->event_id,
                                'image' => $image,
                                'athleteName' => @$userInfo[0]->first_name . ' ' . @$userInfo[0]->last_name,
                                'eventName' => @$eventInfo[0]->event_name,
                                'location' => @$eventInfo[0]->location,
                                'eventDate' => @$start_date,
                                'startTime' => @$startTime,
                                'endTime' => @$endTime,
                                'amount' => @$v->amount,
                                'hour' => @$v->hour,
                                'comment' => @$v->comment,
                            ];
                        } else {
                            $response = ["status" => 0, "error" => 'No ongoing invitation list found.'];
                            return response()->json($response, 200);
                        }
                    }
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
                } else {
                    $response = ["status" => 0, "error" => 'No ongoing invitation list found.'];
                    return response()->json($response, 200);
                }
            } else {
                $response = ["status" => 0, "error" => 'user not found.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => 'userId is required.'];
            return response()->json($response, 200);
        }
    }
    public function purchaseList_get() {
        if (!empty(@$_GET['userId'])) {
            $list = DB::table('transaction')->where(['user_id' => @$_GET['userId'], 'payment_type' => 6])->select('*')->orderBy('id', 'DESC')->get();
            if (count($list) > 0) {
                //print_r($list);die;
                foreach ($list as $k => $v) {
                    $pro_data = unserialize(@$v->product_info);
                    foreach ($pro_data as $productKey => $productVal) {
						if(@$productVal['specipication'] == 'service'){
							$productInfo = DB::table('services')->where(['id' => $productVal['product_id']])->select('*')->orderBy('id', 'DESC')->first();
							$proImg = DB::table('services_image')->where(['service_id' => $productVal['product_id']])->select('*')->orderBy('id', 'ASC')->first();
							if(!empty(@$proImg->image) && file_exists('public/service/'.@$proImg->image.'')){
								$productImg = url('service/'.@$proImg->image.'');
							}else{
								$productImg = url('noimage.jpg');
							}
						}else{
							$productInfo = DB::table('product')->where(['id' => $productVal['product_id']])->select('*')->orderBy('id', 'DESC')->first();
							$proImg = DB::table('product_image')->where(['product_id' => $productVal['product_id']])->select('*')->orderBy('id', 'ASC')->first();
							if(!empty(@$proImg->image) && file_exists('public/product/'.@$proImg->image.'')){
								$productImg = url('product/'.@$proImg->image.'');
							}else{
								$productImg = url('noimage.jpg');
							}
						}
						$rating = DB::table('business_review')->where(['product_id' => @$productVal['product_id']])->select('*')->orderBy('id', 'DESC')->get();
						$ratingArray = [];
						if(count($rating) > 0){
							foreach($rating as $ratingKey => $ratingVal){
								$userInfo = DB::table('users')->where(['id' => @$ratingVal->user_id])->select('*')->orderBy('id', 'DESC')->first();
								if (!empty(@$userInfo->profile_image) && file_exists('public/profile/' . @$userInfo->profile_image . '')) {
								    $profilePic = url('profile/' . @$userInfo->profile_image . '');
								} else {
								    $profilePic = url('profile/unnamed.jpg');
								}
								$ratingArray[] = [
									'ratingId' => @$ratingVal->id,
									'userName' => @$userInfo->first_name.' '.@$userInfo->last_name,
									'profilePic' => @$profilePic,
									//'comment'  => @$v->comment,
									'rating'   => @$ratingVal->rating,
								];
							}
						}
                        $array[] = [
                            'productId' => @$productInfo->id,
                            'productName' => @$productInfo->name,
                            'product_image' => @$productImg,
                            'amount' => @$productVal['price'],
                            'orderId' => @$v->order_id,
                            'txnId' => @$v->txn_id,
                            'currency' => @$v->currency,
                            'chargeId' => @$v->charge_id,
                            'paymentDate' => @$v->created_at,
                            'ratingArray' => @$ratingArray,
                        ];
                    }
                    /*$array[] = [
                        'id'          => @$v->id,
                        'txnId'       => @$v->txn_id,
                        'orderId'     => @$v->order_id,
                        'amount'      => @$v->amount,
                        'currency'    => @$v->currency,
                        'chargeId'    => @$v->charge_id,
                        'paymentDate' => @$v->created_at,
                    ];*/
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function subscriptionHistory_get() {
        if (!empty(@$_GET['userId'])) {
            $list = DB::table('transaction')->where(['user_id' => @$_GET['userId'], 'payment_type' => 1])->select('*')->orderBy('id', 'DESC')->get();
            if ($list->isNotEmpty()) {
                foreach ($list as $k => $v) {
                    if (@$v->status == 'succeeded') {
                        $status = 1;
                    } else {
                        $status = 0;
                    }
                    $array[] = [
                        'id' => @$v->id,
                        'txnId' => @$v->txn_id,
                        'orderId' => @$v->order_id,
                        'amount' => @$v->amount,
                        'currency' => @$v->currency,
                        'chargeId' => @$v->charge_id,
                        'paymentDate' => @$v->created_at,
                        'expiry_date' => @$v->expiry_date,
                        'status' => @$status,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function deleteEvent_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'eventId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $getEventInviatationData = DB::table('invitation')->WHERE('event_id', @$request->eventId)->first();
            if (!empty($getEventInviatationData)) {
                foreach ($getEventInviatationData as $value) {
                    DB::table('repeat_invitation')->where('invitation_id', @$value->id)->delete();
                }
            }
            DB::table('invitation')->where('event_id', @$request->eventId)->delete();
            $getEventTicketData = DB::table('event_ticket')->WHERE('event_id', @$request->eventId)->delete();
            $getEventImageData = DB::table('event_image')->WHERE('event_id', @$request->eventId)->delete();
            $result = DB::table('events')->where('id', @$request->eventId)->delete();
            if ($result) {
                $response = ["status" => 1, "message" => "event deleted successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function deleteBusiness_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'businessId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $checkListing = DB::table('listing')->WHERE('id', @$request->businessId)->first();
            if (!empty($checkListing)) {
                $checkListingProduct = DB::table('product')->WHERE('listing_id', @$request->businessId)->get();
                foreach ($checkListingProduct as $value) {
                    DB::table('product_image')->where('product_id', @$value->id)->delete();
                }
                DB::table('product')->where('listing_id', @$request->businessId)->delete();
                $checkListingServices = DB::table('services')->WHERE('listing_id', @$request->businessId)->get();
                foreach ($checkListingServices as $value) {
                    DB::table('services_image')->where('service_id', @$value->id)->delete();
                }
                DB::table('services')->where('listing_id', @$request->businessId)->delete();
            }
            DB::table('listing_image')->where('listing_id', @$request->businessId)->delete();
            $result = DB::table('listing')->where('id', @$request->businessId)->delete();
            if ($result) {
				$productData = DB::table('product')->where('listing_id', @$request->businessId)->delete();
				$servicesData = DB::table('services')->where('listing_id', @$request->businessId)->delete();
                $response = ["status" => 1, "message" => "Business deleted successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function deletePromotion_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'promotionId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $result = DB::table('promotion')->where('id', @$request->promotionId)->delete();
            if ($result) {
                $response = ["status" => 1, "message" => "promotion ads deleted successfully."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function AdvertisePlanList_get() {
        $Sql = "SELECT * FROM advertise_sub_plan WHERE status = '1' ORDER BY id DESC";
        $list = DB::select($Sql);
        if ($list) {
            foreach ($list as $k => $v) {
                if (@$v->plan_type == 'Monthly') {
                    $plan_type = 'Month';
                } elseif (@$v->plan_type == 'Yearly') {
                    $plan_type = 'year';
                } elseif (@$v->plan_type == 'Daily') {
                    $plan_type = 'Day';
                }
                if (empty(@$v->discount) || @$v->discount == 0) {
                    $discount = 0;
                } else {
                    $discount = @$v->discount;
                }
                if (empty(@$v->price) || @$v->price == 0) {
                    $price = 0;
                } else {
                    $price = @$v->price;
                }
                $nav = @$v->description;
                $nav = str_replace(array('<li>', '</li>'), '&&', $nav);
                $nav = str_replace(array('<ul>', '</ul>'), '', $nav);
                //$n = explode('11', $nav);die;
                $nav = array_filter(explode('&&', $nav));
                $nav1 = [];
                // foreach($nav as $k => $v){
                // $nav1[] = $v;
                // }
                foreach ($nav as $k1 => $v1) {
                    //$eventImg[] = ['image' => url('events/'.$v->image.'')];
                    $nav1[] = [$k1 => $v1];
                }
                $array[] = [
                    'id' => @$v->id,
                    'name' => @$v->name,
                    'plan' => @$v->plan,
                    'type' => @$plan_type,
                    'duration' => @$v->plan_duration,
                    'discount' => @$discount,
                    'amount' => @$price,
                    'adsType' => @$v->ads_type,
                    'description' => @$nav1,
                ];
            }
            $response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => 'data not found.'];
            return response()->json($response, 200);
        }
    }
    public function addAdvertise_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'userId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $title = @$request->title;
            if (!empty($request['ads_image']) && @$request['ads_image'] != 'undefined') {
                $img = $request['ads_image'];
                $extn = $img->getClientOriginalExtension();
                $path = public_path('ads/');
                $file_name = rand() . '.' . $extn;
                $img->move($path, $file_name);
            } else {
                $file_name = '';
            }
            $data = ['title' => $title, 'image' => @$file_name, 'user_id' => @$request->userId, 'status' => 0, 'created_at' => date('Y-m-d H:i:s')];
            $result = DB::table('advertise')->insertGetId($data);
            if ($result) {
                $response = ["status" => 1, "message" => "Your advertise added successfully.", 'adsId' => $result];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.', 'adsId' => ''];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function addfavNetworkUsers_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'favUserId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $numRows = DB::table('favouriteusers')->where(['user_id' => @$request->userId, 'fav_user_id' => @$request->favUserId])->select('*')->orderBy('id', 'DESC')->count();
            if ($numRows == 0) {
                $myfavview = array(
                    'user_id' => @$request->userId,
                    'fav_user_id' => @$request->favUserId,
                    'created_at' => date("Y-m-d H:i:s")
                );
                $result = DB::table('favouriteusers')->insertGetId($myfavview);
                if ($result) {
                    $response = ["status" => 1, "message" => "Successfully added in favorite list."];
                    return response()->json($response, 200);
                }
            } else {
                $blockwhere = array(
                    'user_id' => @$request->userId,
                    'fav_user_id' => @$request->favUserId
                );
                $result = DB::table('favouriteusers')->where($blockwhere)->delete();
                if ($result) {
                    $response = ["status" => 1, "message" => "Successfully removed from favorite list."];
                    return response()->json($response, 200);
                }
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function myNetworkList_get() {
        $array = [];
        if (!empty(@$_GET['userId'])) {
            $Sql = "SELECT users.id as userId, users.first_name, users.last_name, users.profile_image, favouriteusers.fav_user_id, favouriteusers.user_id FROM users INNER JOIN favouriteusers ON users.id = favouriteusers.user_id WHERE users.status='1' AND users.id='" . @$_GET['userId'] . "'";
            $list = DB::select($Sql);
            if (count($list) > 0) {
                foreach ($list as $k => $v) {
                    $userInfo = DB::table('users')->where(['id' => @$v->fav_user_id])->select('*')->first();
                    if (!empty(@$userInfo->profile_image) && file_exists('public/profile/' . @$userInfo->profile_image . '')) {
                        $profilePic = url('profile/' . @$userInfo->profile_image . '');
                    } else {
                        $profilePic = url('profile/unnamed.jpg');
                    }
                    $userType = '';
                    if (@$userInfo->user_type == 3) {
                        $userType = 'SERVICE PROVIDER';
                    } elseif (@$userInfo->user_type == 4) {
                        $userType = 'A & E';
                    }
                    $array[] = [
                        'favUserId' => @$userInfo->id,
                        'firstName' => @$userInfo->first_name,
                        'lastName' => @$userInfo->last_name,
                        'email' => @$userInfo->email,
                        'address' => @$userInfo->address,
                        'profilePic' => @$profilePic,
                        'userType' => @$userType,
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function referInvite_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'referrerName' => 'required',
                'referrerEmail' => 'required',
                'referrerPhone' => 'required',
                'referrerCode' => 'required',
                'senderId' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $data = ['sender_id' => @$request->senderId, 'reffer_user_name' => @$request->referrerName, 'reffer_user_email' => @$request->referrerEmail, 'reffer_user_phone' => @$request->referrerPhone, 'status' => '2', 'reffer_code' => @$request->referrerCode, 'created_at' => date('Y-m-d H:i:s')];
            $result = DB::table('reffer')->insertGetId($data);
            if (!empty(@$result)) {
                $setting = DB::table('settings')->where(['settingId' => 1])->select('*')->orderBy('settingId', 'DESC')->first();
                $imagePath = url('setting/' . @$setting->logo . '');
                $imagebackPath = '';
                $subject = "Refer Code (StarBiz)";
                $message = "<!Doctype html>
				<html>
				<head>
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
				<title>Refer Code (StarBiz)</title>
				<link href='https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap' rel='stylesheet'>
				<body>
				<div style='max-width:600px;
				margin:auto;
				border:1px solid #eee;
				box-shadow:0 0 10px rgba(0, 0, 0, .15);
				line-height:17px;
				font-size:13px;
				box-sizing:border-box; -webkit-print-color-adjust: exact;font-family: Poppins, sans-serif; background:url(" . @$imagebackPath . ")'>
				<div style='padding:20px; box-sizing: border-box;text-align: center; background: #fff;'>
				<a href='#'><img src='" . @$imagePath . "' style='width: 80%;'></a>
				</div>
				<div style='width: 400px; margin:50px auto;background: #ffffffd1;padding: 50px;text-align: center;'>
				<h1 style=' font-size: 30px; line-height: 32px; color: #0b0b0b; margin: 30px 0;'>Dear " . @$request->referrerName . "</h1>
				<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>Your Refer Code is: " . @$request->referrerCode . "</p>
				<p>Do not share your Refer Code with anyone.Please download starBiz App and register and use this refer code.</p>
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
                $this->sentMail(@$request->referrerEmail, $message, $subject);
                $response = ["status" => 1, "message" => "You have been successfully referred."];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "Some error occurred, Please try again."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
    public function myReferrals_get() {
        $array = [];
        if (!empty(@$_GET['userId'])) {
            $list = DB::table('reffer')->where(['sender_id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->get();
            if (count($list) > 0) {
                foreach ($list as $k => $v) {
                    $userInfo = DB::table('users')->where(['email' => $v->reffer_user_email])->select('*')->first();
                    if (!empty(@$userInfo)) {
                        if (@$userInfo->first_name || @$userInfo->last_name) {
                            $userName = @$userInfo->first_name . ' ' . @$userInfo->last_name;
                        } else {
                            $userName = @$v->reffer_user_name;
                        }
                        if (@$userInfo->email) {
                            $userEmail = @$userInfo->email;
                        } else {
                            $userEmail = @$v->reffer_user_email;
                        }
                        $registerStatus = 1;
                        if ((@$userInfo->first_name || @$userInfo->last_name) && @$userInfo->email && @$userInfo->phone && @$userInfo->address && @$userInfo->profile_image && @$userInfo->bio && @$userInfo->dob) {
                            $profileStatus = 1;
                        } else {
                            $profileStatus = 0;
                        }
                        $eventInfo = DB::table('events')->where(['user_id' => $userInfo->id])->select('*')->get();
                        if (count(@$eventInfo) > 0) {
                            $eventStatus = 1;
                        } else {
                            $eventStatus = 0;
                        }
                    } else {
                        $userName = @$v->reffer_user_name;
                        $userEmail = @$v->reffer_user_email;
                        $registerStatus = 0;
                        $profileStatus = 0;
                        $eventStatus = 0;
                    }
                    if (@$v->status == '2') {
                        $status = 'Pending';
                    } elseif (@$v->status == '1') {
                        $status = 'Successful';
                    }
                    $array[] = [
                        'userName' => @$userName,
                        'referralStatus' => @$status,
                        'signUp' => @$registerStatus,
                        'profileComplete' => @$profileStatus,
                        'createEvent' => @$eventStatus
                    ];
                }
                $response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "No Data found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function deleteAccount_post(Request $request){
        $userId = $request->userId ?? null;
        if(!empty($request->userId) || $request->userId != '') {
            $deletewhere = array(
                'user_id' => @$request->userId,
            );
            DB::table('academics')->where($deletewhere)->delete();
            DB::table('advertise')->where($deletewhere)->delete();
            DB::table('athletics')->where($deletewhere)->delete();
            $chatresults = DB::table('chat')->where(function ($query) use ($userId) {$query->where('sender_id', $userId)->orWhere('receiver_id', $userId);})->get();
            if(!empty($chatresults)) {
                DB::table('chat')->where(function ($query) use ($userId) {$query->where('sender_id', $userId)->orWhere('receiver_id', $userId);})->delete();
            }
            DB::table('compose_email')->where($deletewhere)->delete();
            DB::table('email_template')->where($deletewhere)->delete();
            DB::table('experience')->where($deletewhere)->delete();
            $eventresults = DB::table('events')->where('user_id', $userId)->get();
            if(!empty($eventresults)) {
                foreach ($eventresults as $event) {
                    $eventimageresults = DB::table('event_image')->where('event_id', $event->id)->get();
                    if(!empty($eventimageresults)) {
                        DB::table('event_image')->where('event_id', $event->id)->delete();
                    }
                    $eventticketresults = DB::table('event_ticket')->where('event_id', $event->id)->get();
                    if(!empty($eventticketresults)) {
                        DB::table('event_ticket')->where('event_id', $event->id)->delete();
                    }
                    $faveventresults = DB::table('favouriteevent')->where('event_id', $event->id)->get();
                    if(!empty($faveventresults)) {
                        DB::table('favouriteevent')->where('event_id', $event->id)->delete();
                    }
                    $eventinvitationtresults = DB::table('invitation')->where('event_id', $event->id)->get();
                    if(!empty($eventinvitationtresults)) {
                        foreach ($eventinvitationtresults as $eventinvitation) {
                            DB::table('repeat_invitation')->where('invitation_id', $eventinvitation->id)->delete();
                        }
                        DB::table('invitation')->where('event_id', $event->id)->delete();
                    }
                    $eventnotificationstresults = DB::table('notifications')->where('event_id', $event->id)->get();
                    if(!empty($eventnotificationstresults)) {
                        DB::table('notifications')->where('event_id', $event->id)->delete();
                    }
                    $transactionresults = DB::table('transaction')->where('event_id', $event->id)->get();
                    if(!empty($transactionresults)) {
                        DB::table('transaction')->where('event_id', $event->id)->delete();
                    }
                }
                DB::table('favouriteevent')->where($deletewhere)->delete();
                DB::table('events')->where('user_id', $userId)->delete();
                DB::table('transaction')->where('user_id', $userId)->delete();
            }
            DB::table('guardian')->where($deletewhere)->delete();
            DB::table('favouritebusiness')->where($deletewhere)->delete();
            DB::table('favouriteusers')->where($deletewhere)->delete();
            $listingresults = DB::table('listing')->where('user_id', $userId)->get();
            if(!empty($listingresults)){
                foreach ($listingresults as $listing) {
                    $listingimageresults = DB::table('listing_image')->where('listing_id', $listing->id)->get();
                    if(!empty($listingimageresults)) {
                        DB::table('listing_image')->where('listing_id', $listing->id)->delete();
                    }
                    $listingproductresults = DB::table('product')->where('listing_id', $listing->id)->get();
                    if(!empty($listingproductresults)) {
                        DB::table('product')->where('listing_id', $listing->id)->delete();
                    }
                    $listingservicesresults = DB::table('services')->where('listing_id', $listing->id)->get();
                    if(!empty($listingservicesresults)) {
                        foreach ($listingservicesresults as $services) {
                            $servicesimageresults = DB::table('services_image')->where('service_id', $services->id)->get();
                            if(!empty($servicesimageresults)) {
                                DB::table('services_image')->where('service_id', $services->id)->delete();
                            }
                        }
                        DB::table('services')->where('listing_id', $listing->id)->delete();
                    }
                }
                DB::table('listing')->where('user_id', $userId)->delete();
            }
            $notificationresults = DB::table('notifications')->where(function ($query) use ($userId) {$query->where('sender_id', $userId)->orWhere('receiver_id', $userId);})->get();
            if(!empty($notificationresults)) {
                DB::table('notifications')->where(function ($query) use ($userId) {$query->where('sender_id', $userId)->orWhere('receiver_id', $userId);})->delete();
            }
            $repeateventinvitationresults = DB::table('repeat_invitation')->where(function ($query) use ($userId) {$query->where('sender_id', $userId)->orWhere('receiver_id', $userId);})->get();
            if(!empty($repeateventinvitationresults)) {
                DB::table('repeat_invitation')->where(function ($query) use ($userId) {$query->where('sender_id', $userId)->orWhere('receiver_id', $userId);})->delete();
            }
            $productresults = DB::table('product')->where('user_id', $userId)->get();
            if(!empty($productresults)) {
                foreach ($productresults as $product) {
                    $productimageresults = DB::table('product_image')->where('product_id', $product->id)->get();
                    if(!empty($productimageresults)) {
                        DB::table('product_image')->where('product_id', $product->id)->delete();
                    }
                }
                DB::table('product_category')->where('user_id', $userId)->update(['user_id' => '']);
                DB::table('product')->where('user_id', $userId)->delete();
            }
            DB::table('promotion')->where($deletewhere)->delete();
            DB::table('reference')->where($deletewhere)->delete();
            DB::table('referral_rewards_transaction')->where(function ($query) use ($userId) {$query->where('referral_user_id', $userId)->orWhere('user_id', $userId);})->delete();
            DB::table('reffer')->where('sender_id', $userId)->delete();
            DB::table('stripe_connect')->where('userId', $userId)->delete();
            DB::table('user_document')->where('user_id', $userId)->delete();
            DB::table('user_gallery_photo')->where('user_id', $userId)->delete();
            DB::table('wallet')->where('user_id', $userId)->delete();
            DB::table('withdraw_request')->where('user_id', $userId)->delete();
            DB::table('users')->where('id', $userId)->delete();
            $response = ["status" => 1, "message" => "Account Deleted"];
            return response()->json($response, 200);
        } else {
            $response = ['status' => 0, "error" => "User ID not found."];
            return response()->join($response, 200);
        }
    }
    public function clearsingleitem_post(Request $request) {
        $item_id = $request->input('item_id');
        //$userId = $request->input('userId');
        //$checkinvitationList = DB::table('repeat_invitation')->where(function ($query) use ($userId) {$query->where('sender_id', $userId)->orWhere('receiver_id', $userId);})->Where('invitation_id', $invitation_id)->get();
        $checkinvitationRecord = DB::table('repeat_invitation')->Where('id', $item_id)->get();
        if(!empty($checkinvitationRecord)) {
            //DB::table('repeat_invitation')->where(function ($query) use ($userId) {$query->where('sender_id', $userId)->orWhere('receiver_id', $userId);})->Where('invitation_id', $invitation_id)->delete();
            DB::table('repeat_invitation')->Where('id', $item_id)->delete();
            $response = ["status" => 1, "message" => "Removed."];
            return response()->json($response, 200);
        } else {
            $response = ["status" => 0, "error" => "Some error occurred, Please try again."];
            return response()->json($response, 200);
        }
    }
    public function clearallitem_post(Request $request) {
        $userId = $request->input('userId');
        $checkrejectedData = DB::table('invitation')->where('status', '0')->get();
        if(!empty($checkrejectedData)) {
            foreach ($checkrejectedData as $reject) {
                $getRepeatInvitation = DB::table('repeat_invitation')->WHERE('invitation_id', $reject->id)->get();
                foreach ($getRepeatInvitation as $invitation) {
                    if($invitation->sender_id == $userId) {
                        DB::table('repeat_invitation')->WHERE('sender_id', $userId)->WHERE('invitation_id', $reject->id)->UPDATE(['sender_id' => '0']);
                    } else if($invitation->receiver_id == $userId) {
                        DB::table('repeat_invitation')->WHERE('receiver_id', $userId)->WHERE('invitation_id', $reject->id)->UPDATE(['receiver_id' => '0']);
                    }
                }
                $response = ["status" => 1, "message" => "Cleared All data."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "Some error occurred, Please try again."];
            return response()->json($response, 200);
        }
    }
	public function walletBalance_get()  {
        $accessArray = [];
        $subArray = [];
        if (!empty(@$_GET['userId'])) {
            $checkUser = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($checkUser) {
				if(empty($checkUser->wallet_amount) AND ($checkUser->wallet_amount == NULL)){
					$walletBalance = 0;
				}else{
					$walletBalance = $checkUser->wallet_amount;
				}
				$response = ["status" => 1, "wallet" => ['walletBalance' => $walletBalance]];
				return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
    public function addToCart_post(Request $request) {
        try{
            $user_id = $request->input('user_id');
            $item_id = $request->input('item_id');
            $type = $request->input('type');
            $quantity = $request->input('quantity');
            if($type === '1'){
                $checkCartData = DB::table('add_to_cart')->where('user_id',$user_id)->where('product_id', $item_id)->where('type', $type)->first();
                if(!empty($checkCartData)){
                    $finalQuantity = @$checkCartData->quantity + @$quantity;
                    $data = array(
                        'quantity' => $finalQuantity
                    );
                    if($finalQuantity > 0){
                        DB::table('add_to_cart')->where('product_id', $item_id)->where('user_id', $user_id)->where('type', $type)->update($data);
                        $productDetails = DB::table('product')->where('id', $item_id)->first();
                        $checkuCartData = DB::table('add_to_cart')->where('user_id',$user_id)->where('product_id', $item_id)->where('type', $type)->first();
                        $data1 = array(
                            'mrp' => $checkuCartData->quantity*$productDetails->price,
                            'discount' => '0',
                            'final_price' => $checkuCartData->quantity*$productDetails->price,
                        );
                        DB::table('add_to_cart')->where('product_id', $item_id)->where('user_id', $user_id)->where('type', $type)->update($data1);
                    } else {
                        DB::table('add_to_cart')->where('product_id', $item_id)->where('user_id', $user_id)->where('type', $type)->delete();
                    }
                    $response = ["status" => 1, "success" => "Cart updated"];
                    return response()->json($response, 200);
                } else {
                    $productDetails = DB::table('product')->where('id', $item_id)->first();
                    $data = array(
                        'user_id' => @$user_id,
                        'product_id' => @$item_id,
                        'type' => @$type,
                        'quantity' => $quantity,
                        'mrp' => $quantity*@$productDetails->price,
                        'discount' => '0',
                        'final_price' => $quantity*@$productDetails->price,
                        'created_date' => date("Y-m-d H:i:s")
                    );
                    $result = DB::table('add_to_cart')->insertGetId($data);
                    $response = ["status" => 1, "success" => "Added to cart."];
                    return response()->json($response, 200);
                }
            } else {
                $checkCartData = DB::table('add_to_cart')->where('user_id',$user_id)->where('product_id', $item_id)->where('type', $type)->first();
                $finalQuantity = @$checkCartData->quantity + @$quantity;
                if(!empty($checkCartData)){
                    $data = array(
                        'quantity' => $finalQuantity
                    );
                    if($finalQuantity > 0){
                        DB::table('add_to_cart')->where('product_id', $item_id)->where('user_id', $user_id)->where('type', $type)->update($data);
                        $productDetails = DB::table('services')->where('id', $item_id)->first();
                        $checkuCartData = DB::table('add_to_cart')->where('user_id',$user_id)->where('product_id', $item_id)->where('type', $type)->first();
                        $data1 = array(
                            'mrp' => $checkuCartData->quantity*$productDetails->price,
                            'discount' => '0',
                            'final_price' => $checkuCartData->quantity*$productDetails->price,
                        );
                        DB::table('add_to_cart')->where('product_id', $item_id)->where('user_id', $user_id)->where('type', $type)->update($data1);
                    } else {
                        DB::table('add_to_cart')->where('product_id', $item_id)->where('user_id', $user_id)->where('type', $type)->delete();
                    }
                    $response = ["status" => 1, "success" => "Cart updated"];
                    return response()->json($response, 200);
                } else {
                    $productDetails = DB::table('services')->where('id', $item_id)->first();
                    $data = array(
                        'user_id' => @$user_id,
                        'product_id' => @$item_id,
                        'type' => @$type,
                        'quantity' => $quantity,
                        'mrp' => $quantity*@$productDetails->price,
                        'discount' => '0',
                        'final_price' => $quantity*@$productDetails->price,
                        'created_date' => date("Y-m-d H:i:s")
                    );
                    $result = DB::table('add_to_cart')->insertGetId($data);
                    $response = ["status" => 1, "success" => "Added to cart."];
                    return response()->json($response, 200);
                }
            }
        } catch (\Throwable $th) {
			$response = ["status" => 0, "error" => $th->getMessage()];
            return response()->json($response, 200);
		}
    }
    public function totalCart_post(Request $request) {
		try {
			$user_id = $request->input('user_id');
            $totalCart = DB::table('add_to_cart')->where('user_id', $user_id)->count('id');
			$response = array('status'=>'1', 'result'=>$totalCart);
            return response()->json($response, 200);
		} catch (\Throwable $th) {
			$response = array('status'=>'0', 'result'=>$th->getMessage());
            return response()->json($response, 200);
		}
	}
    public function cart_list_post(Request $request) {
        try {
            $user_id = $request->input('user_id');
            if (empty($user_id)) {
                return response()->json(['status' => 'error', 'result' => 'User ID is required'], 400);
            }
            // Fetch product-based cart items
            $productCartDetails = DB::table('add_to_cart')
                ->join('product', 'add_to_cart.product_id', '=', 'product.id')
                ->where('add_to_cart.user_id', $user_id)
                ->where('add_to_cart.type', '1')
                ->select('product.id as prod_id','product.name','add_to_cart.id as cart_id','add_to_cart.mrp','add_to_cart.quantity','add_to_cart.final_price','add_to_cart.discount','add_to_cart.type')->get();
            // Fetch service-based cart items
            $serviceCartDetails = DB::table('add_to_cart')
                ->join('services', 'add_to_cart.product_id', '=', 'services.id')
                ->where('add_to_cart.user_id', $user_id)
                ->where('add_to_cart.type',  '2')
                ->select('services.id as service_id','services.name','add_to_cart.id as cart_id','add_to_cart.mrp','add_to_cart.quantity','add_to_cart.final_price','add_to_cart.discount','add_to_cart.type')->get();
            // Combine and format cart details
            $cartList = [];
            $totalSaved = 0;
            $totalAmount = 0;
            if(!empty($productCartDetails)){
                foreach ($productCartDetails as $item) {
                    $getpro_Img = DB::table('product_image')->where('product_id', $item->prod_id)->first();
                    $cartList[] = [
                        'item_id' => $item->prod_id,
                        'item_image' => !empty($getpro_Img->image) ? asset('product/' . $getpro_Img->image) : asset('no_image.png'),
                        'item_name' => $item->name,
                        'quantity' => $item->quantity,
                        'type' => $item->type,
                        'final_price' => number_format($item->final_price, 2),
                    ];
                    $totalSaved += $item->mrp - $item->final_price;
                    $totalAmount += $item->final_price;
                }
            }
            if(!empty($serviceCartDetails)){
                foreach ($serviceCartDetails as $sitem) {
                    $getser_Img = DB::table('services_image')->where('service_id', $sitem->service_id)->first();
                    $cartList[] = [
                        'item_id' => $sitem->service_id,
                        'item_image' => !empty($getser_Img->image) ? asset('service/' . $getser_Img->image) : asset('no_image.png'),
                        'item_name' => $sitem->name,
                        'quantity' => $sitem->quantity,
                        'type' => $sitem->type,
                        'final_price' => number_format($sitem->final_price, 2),
                    ];
                    $totalSaved += $sitem->mrp - $sitem->final_price;
                    $totalAmount += $sitem->final_price;
                }
            }
            // Response
            if (!empty($cartList)) {
                return response()->json([
                    'status' => '1',
                    'result' => [
                        'cartList' => $cartList,
                        'total_saved' => number_format($totalSaved, 2),
                        'total_amount' => number_format($totalAmount, 2),
                    ],
                ], 200);
            } else {
                return response()->json(['status' => '0', 'result' => 'No cart data found'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => '0', 'result' => $th->getMessage()], 200);
        }
    }
    public function removeCartList_post(Request $request){
        try {
            $user_id = $request->input('user_id');
            $item_id = $request->input('item_id');
            $checkCartDate = DB::table('add_to_cart')->where('product_id', $item_id)->where('user_id', $user_id)->get();
            if ($checkCartDate->isNotEmpty()) {
                DB::table('add_to_cart')->where('product_id', $item_id)->where('user_id', $user_id)->delete();
                $response = ['status' => '1', 'result' => 'Removed'];
            } else {
                $response = ['status' => '0', 'result' => 'No Data Found'];
            }
        } catch (\Throwable $th) {
            $response = ['status' => 'error', 'result' => $th->getMessage()];
        }
        return response()->json($response, 200);
    }
	public function stripeStatus_get(){
		if(!empty(@$_GET['userId'])){
			$guideInfo = DB::table('stripe_connect')->where(['userId' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
			if ($guideInfo) {
				$stripeAccId = $guideInfo->stripe_acc_id;
				$stripeStatus = $this->get_stripe_info($stripeAccId);
				if ($stripeStatus == 1) {
					$response = ["status" => 1, "message" => "Stripe connected successfully."];
					return response()->json($response, 200);
				}else{
					$response = ["status" => 0, "error" => "Stripe not connected."];
					return response()->json($response, 200);
				}
			}else{
				$response = ["status" => 0, "error" => "Stripe not connected."];
				return response()->json($response, 200);
			}
		}else{
			$response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
		}
	}
	public function salesList_get(){
		$mySalesList = [];
		if(!empty(@$_GET['userId'])){
			$proList  = DB::table('transaction')->where(['payment_type' => 6])->select('*')->get();
			if(count($proList) > 0){
				foreach($proList as $k => $v){
					$productInfo = unserialize($v->product_info);
					if (is_array($productInfo) || is_object($productInfo))
					{
						foreach($productInfo as $proKey => $proVal){
							if(@$proVal['specipication'] == 'service'){
								$proList_1 = DB::table('services')->whereRaw("id = ".$proVal['product_id']." AND user_id = ".@$_GET['userId']."")->select('*', DB::raw("'service' as type"))->orderBy('id', 'DESC')->first();
								$tranId[] = ['product' => @$proList_1->id, 'type' => 'service'];
							}else{
								$proList_1 = DB::table('product')->whereRaw("id = ".$proVal['product_id']." AND user_id = ".@$_GET['userId']."")->select('*', DB::raw("'product' as type"))->first();
								$tranId[] = ['product' => @$proList_1->id, 'type' => 'product'];
							}
							if(!empty(@$proList_1)){
							    $mySalesList[] =  $proList_1;
							}
						}
					}
				}
				if(count(@$mySalesList) > 0){
					foreach(@$mySalesList as $k => $v){
						if(@$v->type == 'service'){
							$proImg = DB::table('services_image')->where(['service_id' => @$v->id])->select('*')->orderBy('id', 'ASC')->first();
							if(!empty(@$proImg->image) && file_exists('public/service/'.@$proImg->image.'')){
								$productImg = url('service/'.@$proImg->image.'');
							}else{
								$productImg = url('noimage.jpg');
							}
						} else {
							$proImg = DB::table('product_image')->where(['product_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
							if(!empty(@$proImg->image) && file_exists('public/product/'.@$proImg->image.'')){
								$productImg = url('product/'.@$proImg->image.'');
							}else{
								$productImg = url('noimage.jpg');
							}
						}
						$listing = DB::table('listing')->where(['id' => @$v->listing_id])->select('*')->orderBy('id', 'DESC')->first();
						$getPer = DB::table('settings')->select('admin_percentage')->first();
						$percentage = $getPer->admin_percentage;
						$totalWidth = @$v->price;
						$adminShare = ($percentage / 100) * $totalWidth;
						$promoterShare = @$v->price - $adminShare;
						$array[] = [
							'productName' => @$v->name,
							'productImg'  => @$productImg,
							'type' => @$v->type,
							'businessName' => @$listing->business_name,
							'amount' => @$v->price,
							'adminShare' => @$adminShare,
							'spShare' => @$promoterShare,
							'salesOn' => date('M d, Y', strtotime($v->created_at))
						];
					}
                    $response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
				} else {
                    $response = ["status" => 0, "error" => "Not found any sales list."];
                    return response()->json($response, 200);
				}
			} else {
				$response = ["status" => 0, "error" => "Not found any sales list."];
                return response()->json($response, 200);
			}
		} else {
			$response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
		}
	}
	public function rewardsAll_get(){
		if(!empty(@$_GET['userId'])){
			$myReward  = DB::table('referral_rewards_transaction')->where(['user_id' => @$_GET['userId']])->select('*')->get();
			if(count(@$myReward) > 0){
				foreach($myReward as $k => $v){
					$my_earned_point = '--';
					if(!empty($v->my_earned_point)){
					    $my_earned_point = $v->my_earned_point;
					}else{
						$my_earned_point = $v->referral_earned_point;
					}
					$active_date = '';
					if(!empty(@$v->created_at) && @$v->created_at != '0000-00-00 00:00:00'){
						$active_date = date('M d, Y', strtotime(@$v->created_at));
					}
					$array[] = [
					    'myRewars' => $my_earned_point,
					    'date' => $active_date,
					];
				}
				$response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
			} else {
				$response = ["status" => 0, "error" => "Not found any rewards."];
                return response()->json($response, 200);
			}
		} else {
			$response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
		}
	}
	public function rewardsEarned_get(){
		if(!empty(@$_GET['userId'])) {
			$myReward  = DB::table('referral_rewards_transaction')->where(['user_id' => @$_GET['userId']])->select('*')->get();
			if(count(@$myReward) > 0) {
				foreach($myReward as $k => $v) {
					$my_earned_point = '--';
					if(!empty($v->my_earned_point)) {
					    $my_earned_point = $v->my_earned_point;
					} else {
						$my_earned_point = $v->referral_earned_point;
					}
					$active_date = '';
					if(!empty(@$v->created_at) && @$v->created_at != '0000-00-00 00:00:00') {
						$active_date = date('M d, Y', strtotime(@$v->created_at));
					}
					$array[] = [
					    'myRewars' => $my_earned_point,
					    'date' => $active_date,
					];
				}
				$response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
			} else {
				$response = ["status" => 0, "error" => "Not found any rewards."];
                return response()->json($response, 200);
			}
		} else {
			$response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
		}
	}
	public function AllInvitation_get(){
		$allAthaletic = DB::table('users')->whereRaw("status = 1 AND user_type = 4")->select('*')->orderBy('id', 'DESC')->get();
		if(count($allAthaletic) > 0){
			foreach($allAthaletic as $k => $v) {
				if(!empty(@$v->profile_image) && file_exists('public/profile/'.@$v->profile_image.'')) {
					$profile_2 = url('profile/'.@$v->profile_image.'');
				} else {
					$profile_2  = url('profile/unnamed.jpg');
				}
				$array[] = [
					'userId' => $v->id,
					'userName' => @$v->first_name.' '.@$v->last_name,
					'profileImge' => $profile_2,
				];
			}
			$response = ["status" => 1, "list" => $array];
            return response()->json($response, 200);
		} else {
			$response = ["status" => 0, "error" => "Not found any user."];
            return response()->json($response, 200);
		}
	}
	public function InvitedPeople_get(){
		if(!empty(@$_GET['eventId'])){
			$inviteeProfile = [];
                $inviteeId = [];
                $invitation = DB::table('invitation')->where(['event_id' => @$_GET['eventId']])->select('*')->get();
                if (count($invitation) > 0) {
                    foreach ($invitation as $k => $v) {
                        $get_receiverInfo = DB::table('repeat_invitation')->where(['invitation_id' => @$v->id])->select('*')->first();
						if($get_receiverInfo){
							if($get_receiverInfo->receiver_id){
								$inviteeId[] = $get_receiverInfo->receiver_id;
							}
						}
                    }
                }
                if (count($inviteeId) > 0) {
                    $inviteeId = array_unique($inviteeId);
                    $eventAttendeeId = join(",", $inviteeId);
                    $attendeeUser = DB::table('users')->whereRaw("status = 1 AND id IN($eventAttendeeId)")->select('*')->orderBy('id', 'ASC')->get();
                    if (count($attendeeUser) > 0) {
                        $i = 1;
                        foreach ($attendeeUser as $k => $v) {
                            if (@$i == 1) {
                                $class = '';
                            } else {
                                $class = 'position-absolute z-1';
                            }
                            if (!empty(@$v->profile_image) && file_exists('public/profile/' . @$v->profile_image . '')) {
                                $profile_1 = url('profile/' . @$v->profile_image . '');
                            } else {
                                $profile_1 = url('profile/unnamed.jpg');
                            }
                            $inviteeProfile[] = [
                                'userId' => @$v->id,
                                'userName' => @$v->first_name . ' ' . @$v->last_name,
                                'profile' => @$profile_1
                            ];
                            //$inviteeProfile.='<img class="'.@$class.'" src="'.@$profile_1.'" alt="" >';
                            $i++;
                        }
                    } else {
                        $inviteeProfile = [];
                    }
                } else {
                    $inviteeProfile = [];
                }
				$response = ["status" => 1, "list" => $inviteeProfile];
                return response()->json($response, 200);
		}else{
			$response = ["status" => 0, "error" => "eventId is required."];
            return response()->json($response, 200);
		}
	}
    public function rewardsBalance_get()  {
        $accessArray = [];
        $subArray = [];
        if (!empty(@$_GET['userId'])) {
            $checkUser = DB::table('users')->where(['id' => @$_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($checkUser) {
				if(empty($checkUser->earned_rewords_point) AND ($checkUser->earned_rewords_point == NULL)){
					$walletBalance = 0;
				}else{
					$walletBalance = $checkUser->earned_rewords_point;
				}
				$response = ["status" => 1, "wallet" => ['rewardsBalance' => $walletBalance]];
				return response()->json($response, 200);
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
	public function addReview_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'productId' => 'required',
                //'comment' => 'required',
                'rating' => 'required',
            ]
        );
        if (!$validator->fails()) {
			$checkUser = DB::table('business_review')->where(['product_id' => @$request->productId, 'user_id' => @$request->userId])->select('*')->orderBy('id', 'DESC')->first();
			if ($checkUser) {
				$response = ["status" => 0, "error" => 'Already added rating.'];
                return response()->json($response, 200);exit();
			}
            $data = array('user_id' => @$request->userId, 'product_id' => @$request->productId, 'rating' => @$request->rating, 'created_at' => date('Y-m-d H:i:s'));
			$result = DB::table('business_review')->insertGetId($data);
			if($result){
				$response = ["status" => 1, "message" => 'Successfully added your review.'];
                return response()->json($response, 200);
			}else {
                $response = ["status" => 0, "error" => 'Some error occure, Please try again.'];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
	public function reviewList_get() {
        if (!empty(@$_GET['businessMenberId'])) {
            $checkUser = DB::table('users')->where(['id' => @$_GET['businessMenberId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($checkUser) {
                $reviewList = DB::table('business_review')->where(['business_menber_id' => @$_GET['businessMenberId']])->select('*')->orderBy('id', 'DESC')->get();
				if(count(@$reviewList) > 0){
					foreach($reviewList as $k => $v){
						$userInfo = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
						if (!empty(@$userInfo->profile_image) && file_exists('public/profile/' . @$userInfo->profile_image . '')) {
							$profilePic = url('profile/' . @$userInfo->profile_image . '');
						} else {
							$profilePic = url('profile/unnamed.jpg');
						}
						$array[] = [
							'reviewId' => @$v->id,
							'userName' => @$userInfo->first_name.' '.@$userInfo->last_name,
							'profilePic' => @$profilePic,
							'comment'  => @$v->comment,
							'rating'   => @$v->rating,
						];
					}
					$response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
				} else {
					$response = ["status" => 0, "error" => "review list not found."];
                    return response()->json($response, 200);
				}
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
        }
    }
	function referralInviteUserList_get(){
		if (!empty(@$_GET['loginUserId'])) {
            $checkUser = DB::table('users')->where(['id' => @$_GET['loginUserId']])->select('*')->orderBy('id', 'DESC')->first();
            if ($checkUser) {
                $allUser = DB::table('users')->whereRaw("id != ".@$_GET['loginUserId']."")->select('*')->orderBy('id', 'DESC')->get();
				if(count(@$allUser) > 0){
					foreach(@$allUser as $k => $v){
						if (!empty(@$v->profile_image) && file_exists('public/profile/' . @$v->profile_image . '')) {
							$profilePic = url('profile/' . @$v->profile_image . '');
						} else {
							$profilePic = url('profile/unnamed.jpg');
						}
						$array[] = [
						    'id' => @$v->id,
						    'userName' => @$v->first_name.' '.@$v->last_name,
						    'profilePic' => @$profilePic,
						];
					}
					$response = ["status" => 1, "list" => $array];
                    return response()->json($response, 200);
				} else {
					$response = ["status" => 0, "error" => "user list not found."];
                    return response()->json($response, 200);
				}
            } else {
                $response = ["status" => 0, "error" => "user not found."];
                return response()->json($response, 200);
            }
        } else {
            $response = ["status" => 0, "error" => "loginUserId is required."];
            return response()->json($response, 200);
        }
	}
    public function myRewards_get(){
		if(!empty(@$_GET['userId'])){
			$myReward  = DB::table('referral_rewards_transaction')->where(['user_id' => @$_GET['userId']])->select('*')->get();
			if(count(@$myReward) > 0){
				foreach($myReward as $k => $v){
					$my_earned_point = '--';
					if(!empty($v->my_earned_point)){
					    $my_earned_point = $v->my_earned_point;
					}else{
						$my_earned_point = $v->referral_earned_point;
					}
					$active_date = '';
					if(!empty(@$v->created_at) && @$v->created_at != '0000-00-00 00:00:00'){
						$active_date = date('M d, Y', strtotime(@$v->created_at));
					}
					$array[] = [
					    'referralCode' => $v->referral_code,
					    'myRewards'    => $my_earned_point,
					    'date'         => $active_date,
					    'status'       => 'Success',
					];
				}
				$response = ["status" => 1, "list" => $array];
                return response()->json($response, 200);
			}else{
				$response = ["status" => 0, "error" => "Not found any rewards."];
                return response()->json($response, 200);
			}
		}else{
			$response = ["status" => 0, "error" => "userId is required."];
            return response()->json($response, 200);
		}
	}
	public function addReferralCode_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'userId' => 'required',
                'referralCode' => 'required',
            ]
        );
        if (!$validator->fails()) {
			$userInfo = DB::table('users')->where(['id' => @$request->userId])->select('*')->orderBy('id', 'DESC')->first();
			if($userInfo){
				//echo @$userInfo->email;die;
			    $refer = DB::table('reffer')->where(['reffer_user_email' => @$userInfo->email, 'reffer_code' => @$request->referralCode])->select('*')->first();
				if(!empty(@$refer)){
					$result = DB::table('reffer')->where(['reffer_user_email' => @$userInfo->email])->update(['status' => '1']);
					if($result){
						$reward_points = 5;
						$datatran_Data = array("referral_user_id" => @$request->userId, "user_id" => @$refer->sender_id, 'my_earned_point' => '5', 'created_at' => date('Y-m-d H:i:s'), 'referral_code' => @$request->referralCode);
						DB::table('referral_rewards_transaction')->insertGetId($datatran_Data);
						DB::table('users')->where('id',@$refer->sender_id)->update(['earned_rewords_point' => DB::raw('earned_rewords_point+'.$reward_points)]);
						$response = ["status" => 1, "message" => 'Successfully added your referal code.'];
                        return response()->json($response, 200);
					}else{
						$response = ["status" => 0, "error" => "Some error occured, Please try again."];
				        return response()->json($response, 200);
					}
				}else{
					$response = ["status" => 0, "error" => "referral code is invalid."];
				    return response()->json($response, 200);
				}
			}else{
				$response = ["status" => 0, "error" => "user not found."];
				return response()->json($response, 200);
			}
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
	public function contactInvitee_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'senderId' => 'required',
                'receiverId' => 'required',
                'message' => 'required',
            ]
        );
        if (!$validator->fails()) {
			$notiData = ['noti_msg' => @$request->message, 'sender_id' => @$request->senderId, 'receiver_id' => @$request->receiverId, 'type' => 6, 'status' => '1', 'noti_type' => 'query', 'created_at' => date("Y-m-d H:i:s")];
            $result = DB::table('notifications')->insertGetId($notiData);
			if($result){
				$response = ["status" => 1, "message" => 'Successfully sent your message.'];
				return response()->json($response, 200);
			}else{
				$response = ["status" => 0, "error" => "Some error occured, Please try again."];
				return response()->json($response, 200);
			}
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
	public function replayMsg_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'notiId' => 'required',
                'senderId' => 'required',
                'receiverId' => 'required',
                'message' => 'required',
            ]
        );
        if (!$validator->fails()) {
			$notiData = ['notification_id' => @$request->notiId, 'message' => @$request->message, 'sender_id' => @$request->senderId, 'receiver_id' => @$request->receiverId, 'created_at' => date("Y-m-d H:i:s")];
            $result = DB::table('replay_notification')->insertGetId($notiData);
			if($result){
				$response = ["status" => 1, "message" => 'Your replay sent successfully.'];
				return response()->json($response, 200);
			}else{
				$response = ["status" => 0, "error" => "Some error occured, Please try again."];
				return response()->json($response, 200);
			}
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
	public function contactAdmin_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'senderId' => 'required',
                'message' => 'required',
            ]
        );
        if (!$validator->fails()) {
			$notiData = ['message' => @$request->message, 'sender_id' => @$request->senderId, 'created_at' => date("Y-m-d H:i:s")];
            $result = DB::table('contact_admin')->insertGetId($notiData);
			if($result){
				$response = ["status" => 1, "message" => 'Successfully sent your message.'];
				return response()->json($response, 200);
			}else{
				$response = ["status" => 0, "error" => "Some error occured, Please try again."];
				return response()->json($response, 200);
			}
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
	public function appearanceInitiate_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'invitationId' => 'required'
            ]
        );
        if (!$validator->fails()) {
			$data = ['status' => '4', 'updated_at' => date("Y-m-d H:i:s"), 'comment' => $request->comment];
            $result = DB::table('invitation')->where(['id' => $request->invitationId])->update(@$data);
			if ($result) {
				$inviInfo = DB::table('repeat_invitation')->where(['invitation_id' => $request->invitationId])->select('*')->orderBy('id', 'DESC')->first();
				$invitationInfo = DB::table('invitation')->where(['id' => $request->invitationId])->select('*')->orderBy('id', 'DESC')->first();
				//Notification//
				$userInfo = DB::table('users')->where(['id' => @$inviInfo->sender_id, 'status' => 1])->select('*')->orderBy('id', 'DESC')->first();
				$receiverInfo = DB::table('users')->where(['id' => @$inviInfo->receiver_id, 'status' => 1])->select('*')->orderBy('id', 'DESC')->first();
				$notiMsg = 'Your event is start now.';
				$notiData = ['noti_msg' => $notiMsg, 'event_id' => @$invitationInfo->event_id, 'sender_id' => @$inviInfo->sender_id, 'receiver_id' => @$inviInfo->receiver_id, 'type' => 2, 'status' => '1', 'created_at' => date("Y-m-d H:i:s")];
				DB::table('notifications')->insertGetId($notiData);
				//Notification//
				DB::table('repeat_invitation')->where(['invitation_id' => $request->invitationId])->orderBy('id', 'desc')->take(1)->update(['status' => '4', 'updated_at' => date("Y-m-d H:i:s")]);
				$response = ["status" => 1, 'invitationId' => $request->invitationId, "message" => "Appeareance start successfully."];
				return response()->json($response, 200);
			}else{
				$response = ["status" => 0, "error" => "Some error occured, Please try again."];
				return response()->json($response, 200);
			}
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
	public function appearanceEnd_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'invitationId' => 'required'
            ]
        );
        if (!$validator->fails()) {
			$data = ['status' => '5', 'updated_at' => date("Y-m-d H:i:s"), 'comment' => $request->comment];
            $result = DB::table('invitation')->where(['id' => $request->invitationId])->update(@$data);
			if ($result) {
				$inviInfo = DB::table('repeat_invitation')->where(['invitation_id' => $request->invitationId])->select('*')->orderBy('id', 'DESC')->first();
				$invitationInfo = DB::table('invitation')->where(['id' => $request->invitationId])->select('*')->orderBy('id', 'DESC')->first();
				//Notification//
				$userInfo = DB::table('users')->where(['id' => @$inviInfo->sender_id, 'status' => 1])->select('*')->orderBy('id', 'DESC')->first();
				$receiverInfo = DB::table('users')->where(['id' => @$inviInfo->receiver_id, 'status' => 1])->select('*')->orderBy('id', 'DESC')->first();
				$notiMsg = 'Your event is end now.';
				$notiData = ['noti_msg' => $notiMsg, 'event_id' => @$invitationInfo->event_id, 'sender_id' => @$inviInfo->sender_id, 'receiver_id' => @$inviInfo->receiver_id, 'type' => 2, 'status' => '1', 'created_at' => date("Y-m-d H:i:s")];
				DB::table('notifications')->insertGetId($notiData);
				//Notification//
				DB::table('repeat_invitation')->where(['invitation_id' => $request->invitationId])->orderBy('id', 'desc')->take(1)->update(['status' => '5', 'updated_at' => date("Y-m-d H:i:s")]);
				$response = ["status" => 1, 'invitationId' => $request->invitationId, "message" => "Appeareance end successfully."];
				return response()->json($response, 200);
			}else{
				$response = ["status" => 0, "error" => "Some error occured, Please try again."];
				return response()->json($response, 200);
			}
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
	public function appearanceNotAttend_post(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'invitationId' => 'required'
            ]
        );
        if (!$validator->fails()) {
			$data = ['status' => '0', 'updated_at' => date("Y-m-d H:i:s"), 'comment' => $request->comment];
            $result = DB::table('invitation')->where(['id' => $request->invitationId])->update(@$data);
			if ($result) {
				$inviInfo = DB::table('repeat_invitation')->where(['invitation_id' => $request->invitationId])->select('*')->orderBy('id', 'DESC')->first();
				$invitationInfo = DB::table('invitation')->where(['id' => $request->invitationId])->select('*')->orderBy('id', 'DESC')->first();
				//Notification//
				$userInfo = DB::table('users')->where(['id' => @$inviInfo->sender_id, 'status' => 1])->select('*')->orderBy('id', 'DESC')->first();
				$receiverInfo = DB::table('users')->where(['id' => @$inviInfo->receiver_id, 'status' => 1])->select('*')->orderBy('id', 'DESC')->first();
				$notiMsg = 'Your event is end now.';
				$notiData = ['noti_msg' => $notiMsg, 'event_id' => @$invitationInfo->event_id, 'sender_id' => @$inviInfo->sender_id, 'receiver_id' => @$inviInfo->receiver_id, 'type' => 2, 'status' => '1', 'created_at' => date("Y-m-d H:i:s")];
				DB::table('notifications')->insertGetId($notiData);
				//Notification//
				DB::table('repeat_invitation')->where(['invitation_id' => $request->invitationId])->orderBy('id', 'desc')->take(1)->update(['status' => '0', 'updated_at' => date("Y-m-d H:i:s")]);
				$response = ["status" => 1, 'invitationId' => $request->invitationId, "message" => "Appeareance not attended."];
				return response()->json($response, 200);
			}else{
				$response = ["status" => 0, "error" => "Some error occured, Please try again."];
				return response()->json($response, 200);
			}
        } else {
            $response = ["status" => 0, "error" => $validator->errors()->toArray()];
            return response()->json($response, 200);
        }
    }
}