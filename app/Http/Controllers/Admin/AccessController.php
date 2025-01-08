<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Stripe;

class AccessController extends Controller {


	public function __construct()
	{

		$this->middleware(function ($request, $next) {
			$this->userData = session()->get('userData');

			if (!session()->get('ID_LOGIN') || !session()->get('ADMINLOGINID')) {
			   return redirect()->intended('admin');
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

		$data['result'] = DB::table('users')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.users', $data);
    }

	public function add()
    {

        $data = array(
			'title'   => 'Add Access',
			'page'    => 'access-mng',
			'subpage' => 'access-mng'
		);
		$data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        return view('admin.add_access_mng', $data);
    }

	public function save(Request $request)
    {
		$view    = $request->view;
		$created = $request->created;
		$edited  = $request->edited;
		$deleted = $request->deleted;
		$menu_id = $request->menu_id;
		$role_id = $request->user_type;

		$where = array('role_id' => $role_id);
		DB::table('role_permission')->where($where)->delete();

		if(!empty($menu_id)) {
        		foreach ($menu_id as $key => $value) {

					 // echo @$view[$key] . $value;
					 // echo "<br/>";

        			if(@$menu_id[$key]) {

        				if(@$view[$key]) {
        					$viewvalue = $view[$key];
        				} else {
        					$viewvalue = "0";
        				}

        				if(@$created[$key]) {
        					$createdvalue = $created[$key];
        				} else {
        					$createdvalue = "0";
        				}

        				if(@$edited[$key]) {
        					$editedvalue = $edited[$key];
        				} else {
        					$editedvalue = "0";
        				}

        				if(@$deleted[$key]) {
        					$deletedvalue = $deleted[$key];
        				} else {
        					$deletedvalue = "0";
        				}

        				$mydata = array(
							'role_id' => $role_id,
							'menu_id' => @$menu_id[$key],
							'view'    => @$viewvalue,
							'created' => @$createdvalue,
							'edited'  => @$editedvalue,
							'deleted' => @$deletedvalue,
							'permission_status' => '1',
							'per_created_at'    => date('Y-m-d H:i:s')
        				);
						//print_r($mydata);

						/*if (!$this->Commonmodel->add_details('role_permission', $mydata)) {
						    $msg = 'error';
						} else {
						    $msg = '["Permission updated successfully!", "success", "#A5DC86"]';
						}*/
						$result = DB::table('role_permission')->insertGetId($mydata);
        			}
        		}

        		return redirect()->intended('admin/users')->with("status", "User added successfully!");
        	}



		// $data = ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone' => @$phone, 'address' => @$address, 'country' => @$country, 'state' => @$state, 'city' => @$city, 'latitude' => $latitude, 'longitude' => @$longitude, 'profile_image' => @$profileImg, 'zipcode' => @$zipcode, 'user_type' => @$user_type, 'password' => md5(@$password), 'status' => @$status, 'created_at' => date('Y-m-d H:i:s')];

		// $result = DB::table('users')->insertGetId($data);
		// if($result){
		    // //return back()->with("status", "User type added successfully!");
			// return redirect()->intended('admin/users')->with("status", "User added successfully!");
		// }else{
		    // //return back()->with("error", "Some error occure, Please try again!");
			// return redirect()->intended('admin/users')->with("error", "Some error occure, Please try again!");
		// }

    }

	public function user()
    {

        $data = array(
			'title'   => 'User List',
			'page'    => 'access-mng',
			'subpage' => 'access-mng1'
		);
		$data['result'] = DB::table('admin')->select('*')->get();
        return view('admin.admin_user_list', $data);
    }

	public function adduser()
    {

        $data = array(
			'title'   => 'Add User',
			'page'    => 'access-mng',
			'subpage' => 'access-mng1'
		);

        return view('admin.add_admin_user', $data);
    }

	public function edit($id)
    {

		if(empty($id)){
			return false;
		}

        $data = array(
			'title'   => 'Edit Users',
			'page'    => 'access-mng',
			'subpage' => 'access-mng1'
		);
		$data['result']   = DB::table('admin')->where(['id' => $id])->select('*')->first();
		$data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        return view('admin.edit_admin_user', $data);
    }


	public function saveuser(Request $request)
    {

        $validatedData = $request->validate([
			'email' => 'required|email|unique:admin',
			'password' => 'required',
		]);
		//print_r($validatedData);die;
		if (!$validatedData) {
            return back()->withErrors('message', $validatedData);
			//return Redirect::back()->withErrors('message', $validatedData);
        }

		$user_type = $request->user_type;
		$name      = $request->name;
		//$username = $request->username;
		$email     = $request->email;
		$password  = $request->password;

		$mydata = ['name' => $name, 'email' => $email, 'password' => md5($password), 'status' => 1, 'role_id' => $user_type];
		$result = DB::table('admin')->insertGetId($mydata);
		if($result){
			return redirect()->intended('admin/access-management/userlist')->with("status", "User added successfully!");
		}else{
			return redirect()->intended('admin/access-management/userlist')->with("error", "Some error occure, Please try again!");
		}
    }

	public function update(Request $request)
    {
	    \DB::enableQueryLog();

		$user_type = $request->user_type;
		$name      = $request->name;
		$id        = $request->id;
		$email     = $request->email;

		if(!empty($request->password)){
			$mydata = ['password' => md5($request->password)];
		}

		$mydata = ['name' => $name, 'email' => $email,  'role_id' => $user_type, 'updated_at' => date('Y-m-d H:i:s')];
		//print_r($id);die;

		$result = DB::table('admin')->where('id',$id)->update(@$mydata);
		// $query = \DB::getQueryLog();
		// dd(end($query));die;
		if($result){
			return redirect()->intended('admin/access-management/userlist')->with("status", "User updated successfully!");
		}else{
			return redirect()->intended('admin/access-management/userlist')->with("error", "Some error occure, Please try again!");
		}
    }



	function get_tier(Request $request){

		$output = '<option value="">Select Registration Tier</option>';
		if($request->user_type){
			$result = DB::table('sub_plan')->where(['status' => 1, 'user_type' => @$request->user_type])->select('*')->orderBy('name', 'ASC')->get();

			foreach($result as $row){
			    $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
			}
			//return $output;
		}
		echo $output;

	}



	public function changestatus(Request $request)
	{
		$response = [];
		if ($request->id) {
			$userId = $request->id;
			$status = $request->status;
			if ($status == 1) {
				$msg = 'Your status is Activate';
			} else {
				$msg = 'Your status is Inctivate';
			}
			$result = DB::table('admin')->where('id',@$userId)->update(['status'=>$status]);

			if ($result) {
				$response['status'] = 1;
			} else {
				$response['status'] = 0;
			}
		}

		echo json_encode($response);
	}



	// public function update(Request $request)
    // {


		// $fname = $request->fname;
		// $lname = $request->lname;
		// $email = $request->email;
		// $phone = $request->phone;
		// $user_type = $request->user_type;
		// $address = $request->address;
		// $latitude = $request->latitude;
		// $longitude = $request->longitude;
		// $country = $request->country;
		// $state = $request->state;
		// $city = $request->city;
		// $zipcode = $request->pincode;
		// $status = $request->status;
		// $id = $request->id;

		// if($request->profileImg){
			// $profileImg = $request->profileImg;
		// }else{
			// $profile_image = DB::table('users')->where(['id' => $id])->select('profile_image')->first();
			// $profileImg = $profile_image->profile_image;
		// }

		// $data = ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone' => @$phone, 'address' => @$address, 'country' => @$country, 'state' => @$state, 'city' => @$city, 'latitude' => $latitude, 'longitude' => @$longitude, 'profile_image' => @$profileImg, 'zipcode' => @$zipcode, 'user_type' => @$user_type, 'status' => @$status, 'updated_at' => date('Y-m-d H:i:s')];

		// $result = DB::table('users')->where('id',$id)->update(@$data);
		// if($result){
			// return redirect()->intended('admin/users')->with("status", "User updated successfully!");
		// }else{
			// return redirect()->intended('admin/users')->with("error", "Some error occure, Please try again!");
		// }

    // }

	function delete_user($id){
		if(empty(@$id)){
			return false;
		}

        $result = DB::table('users')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('admin/users')->with("status", "User deleted successfully!");
		}else{
			return redirect()->intended('admin/users')->with("error", "Some error occure, Please try again!");
		}
	}

	function edit_profile($id){
		if(empty($id)){
			return false;
		}

        $data = array(
			'title' => 'Edit Profile',
			'page' => 'users',
			'subpage' => 'users'
		);
		// $data['result'] = DB::table('users')->where(['id' => $id])->select('*')->first();
		// $data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();

		$data['profile']   = DB::table('users')->where(['id' => $id])->select('*')->first();
		$data['academics'] = DB::table('academics')->where(['user_id' => $id])->select('*')->get();
		$data['athletics'] = DB::table('athletics')->where(['user_id' => $id])->select('*')->first();
		$data['exprience'] = DB::table('experience')->where(['user_id' => $id])->select('*')->get();
		$data['reference'] = DB::table('reference')->where(['user_id' => $id])->select('*')->get();
		$data['guardian']  = DB::table('guardian')->where(['user_id' => $id])->select('*')->get();
		//print_r($data['academics']);die;
        return view('admin.athletic', $data);
	}

	function updateProfile(Request $request){

		$row = DB::table('users')->where(['id' => @$request->userId])->select('*')->first();

		$fname         = !empty(@$request->fname) ? @$request->fname : $row->first_name;
		$lname         = !empty(@$request->lname) ? @$request->lname : $row->last_name;
		$email         = !empty(@$request->email) ? @$request->email : $row->email;
		$phone         = !empty(@$request->phone) ? @$request->phone : $row->phone;
		$address       = !empty(@$request->address) ? @$request->address : $row->address;
		$country       = !empty(@$request->country) ? @$request->country : $row->country;
		$state         = !empty(@$request->state) ? @$request->state : $row->state;
		$city          = !empty(@$request->city) ? @$request->city : $row->city;
		$pincode       = !empty(@$request->pincode) ? @$request->pincode : $row->zipcode;
		$profile_bio   = !empty(@$request->profile_bio) ? @$request->profile_bio : $row->bio;
		$area_interest = !empty(@$request->area_interest) ? @$request->area_interest : $row->area_interest;
		$latitude      = !empty(@$request->latitude) ? @$request->latitude : $row->latitude;
		$longitude     = !empty(@$request->longitude) ? @$request->longitude : $row->longitude;
		$userId        = @$request->userId;

		$data = ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone' => @$phone, 'address' => @$address, 'country' => @$country, 'state' => @$state, 'city' => @$city, 'latitude' => $latitude, 'longitude' => @$longitude, 'zipcode' => @$pincode, 'bio' => $profile_bio, 'area_interest' => $area_interest, 'updated_at' => date('Y-m-d H:i:s')];

		$result = DB::table('users')->where('id',$userId)->update(@$data);
		if(!empty($request->college)){
			DB::table('academics')->where('user_id', $userId)->delete();
			$i = 0;
			foreach($request->college as $k => $v){
				$academics = [
					'school_name'     => @$v,
					'course_name'     => @$request->course[$i],
					'rank'            => @$request->rank[$i],
					'graduation_year' => @$request->graduation_year[$i],
					'gpa'             => @$request->gpa[$i],
					'act_score'       => @$request->act_score[$i],
					'user_id'         => @$request->userId,
					'created_at'      => date('Y-m-d H:i:s'),
				];
				DB::table('academics')->insertGetId($academics);
				$i++;
			}
		}

		$athletic_row = DB::table('athletics')->where(['user_id' => @$request->userId])->select('*')->first();
		$feet     = !empty(@$request->feet) ?  trim(@$request->feet, "'") : $athletic_row->feet;
		$inches   = !empty(@$request->inches) ? trim(@$request->inches, '"') : $athletic_row->inches;
		$weight   = !empty(@$request->weight) ? @$request->weight : $athletic_row->weight;
		$strength = !empty(@$request->strength) ? @$request->strength : $athletic_row->strength;



		if(!empty($athletic_row)){
			$athletic_data = [
				'feet'       => $feet,
				'inches'     => $inches,
				'weight'     => $weight,
				'strength'   => $strength,
				'user_id'    => $userId,
				'updated_at' => date('Y-m-d H:i:s')
			];
			DB::table('athletics')->where('id',$athletic_row->id)->update(@$athletic_data);
		}else{
			$athletic_data = [
				'feet'       => $feet,
				'inches'     => $inches,
				'weight'     => $weight,
				'strength'   => $strength,
				'user_id'    => $userId,
				'created_at' => date('Y-m-d H:i:s')
			];
			DB::table('athletics')->insertGetId($athletic_data);
		}

		if(!empty($request->club_name)){
			DB::table('experience')->where('user_id', $userId)->delete();
			$i = 0;
			foreach($request->club_name as $k => $v){
				$experience = [
					'club_name'   => @$v,
					'designation' => @$request->club_designation[$i],
					'start_date'  => date('Y-m-d', strtotime(@$request->start_date[$i])),
					'end_date'    => date('Y-m-d', strtotime(@$request->end_date[$i])),
					'information' => @$request->information[$i],
					'user_id'     => @$request->userId,
					'created_at'  => date('Y-m-d H:i:s'),
				];
				DB::table('experience')->insertGetId($experience);
				$i++;
			}
		}

		if(!empty($request->coach_name)){
			DB::table('reference')->where('user_id', $userId)->delete();
			$i = 0;
			foreach($request->coach_name as $k => $v){
				$experience = [
					'coach_name' => @$v,
					'coach_email' => @$request->coach_email[$i],
					'user_id' => @$request->userId,
					'created_at' => date('Y-m-d H:i:s'),
				];
				DB::table('reference')->insertGetId($experience);
				$i++;
			}
		}

		if(!empty($request->guardian_name)){
			DB::table('guardian')->where('user_id', $userId)->delete();
			$i = 0;
			foreach($request->guardian_name as $k => $v){
				$experience = [
					'guardian_name' => @$v,
					'guardian_email' => @$request->guardian_email[$i],
					'guardian_phone' => @$request->guardian_phone[$i],
					'guardian_relation' => @$request->guardian_relation[$i],
					'user_id' => @$request->userId,
					'created_at' => date('Y-m-d H:i:s'),
				];
				DB::table('guardian')->insertGetId($experience);
				$i++;
			}
		}
		$response['status'] = 1;
		$response['message'] = 'Profile updated successfully.';
		echo json_encode($response);
	}

	function delete_academic(Request $request){
		$academicId = $request->academic;
		$userId = @$request->userId;
		$result = DB::table('academics')->where('id', $academicId)->delete();
		if($result){
			echo 1;
		}else{
			echo 0;
		}
	}

	function delete_experience(Request $request){
		$experienceId = $request->experience;
		$userId = @$request->userId;
		$result = DB::table('experience')->where('id', $experienceId)->delete();
		if($result){
			echo 1;
		}else{
			echo 0;
		}
	}

	function delete_reference(Request $request){
		$referenceId = $request->reference;
		$userId = @$request->userId;
		$result = DB::table('reference')->where('id', $referenceId)->delete();
		if($result){
			echo 1;
		}else{
			echo 0;
		}
	}

	function delete_guardian(Request $request){
		$guardianId = $request->guardian;
		$userId = @$request->userId;
		$result = DB::table('guardian')->where('id', $guardianId)->delete();
		if($result){
			echo 1;
		}else{
			echo 0;
		}
	}

	function view($id){
		$data = array(
			'title' => 'View User Information',
			'page' => 'users',
			'subpage' => 'users'
		);
		$data['result'] = DB::table('users')->where(['id' => $id])->select('*')->first();
        return view('admin.view_user', $data);
	}

	 public function type()
    {

        $data = array(
			'title' => 'Users Type',
			'page' => 'users',
			'subpage' => 'user-type'
		);
        $data['result'] = DB::table('user_type')->select('*')->get();
        return view('admin.user_type', $data);
    }

	public function addusertype()
    {

        $data = array(
			'title' => 'Add User Type',
			'page' => 'users',
			'subpage' => 'user-type'
		);

        return view('admin.add_user_type', $data);
    }

	public function save_user_type(Request $request)
    {


		$user_type = $request->name;
		$status = $request->status;
		$data = ['name' => $user_type, 'status' => $status, 'created_at' => date('Y-m-d H:i:s')];
		$result = DB::table('user_type')->insertGetId($data);
		if($result){
		    //return back()->with("status", "User type added successfully!");
			return redirect()->intended('admin/user-type')->with("status", "User type added successfully!");
		}else{
		    //return back()->with("error", "Some error occure, Please try again!");
			return redirect()->intended('admin/user-type')->with("error", "Some error occure, Please try again!");
		}

    }

	public function editusertype($id)
    {
	    if(empty(@$id)){
			return false;
		}

        $data = array(
			'title' => 'Edit User Type',
			'page' => 'users',
			'subpage' => 'user-type'
		);

        $data['result'] = DB::table('user_type')->where(['id' => $id])->select('*')->first();
        return view('admin.edit_user_type', $data);
    }

	public function update_user_type(Request $request)
    {


		$user_type = $request->name;
		$status = $request->status;
		$id = $request->id;
		$data = ['name' => $user_type, 'status' => $status, 'updated_at' => date('Y-m-d H:i:s')];
		$result = DB::table('user_type')->where('id',@$id)->update($data);
		if($result){
		    //return back()->with("status", "User type added successfully!");
			return redirect()->intended('admin/user-type')->with("status", "User type updated successfully!");
		}else{
		    //return back()->with("error", "Some error occure, Please try again!");
			return redirect()->intended('admin/user-type')->with("error", "Some error occure, Please try again!");
		}

    }
	public function delete_user_type($id)
    {
	    if(empty(@$id)){
			return false;
		}

        $result = DB::table('user_type')->where('id', $id)->delete();
		if($result){
			//return back()->with("status", "User type added successfully!");
			return redirect()->intended('admin/user-type')->with("status", "User type deleted successfully!");
		}else{
			//return back()->with("error", "Some error occure, Please try again!");
			return redirect()->intended('admin/user-type')->with("error", "Some error occure, Please try again!");
		}


    }





	public function  saveprofile(Request $request){

		if ($request['profilePic']) {
            $img = $request['profilePic'];
            $extn = $img->getClientOriginalExtension();
            $path = public_path('setting/');
            $file_name = rand() . '.' . $extn;
            $img->move($path, $file_name);
        } else {
			$where = ['id' => session()->get('ADMINLOGINID')];
		    $getData = DB::table('admin')->where($where)->select('profile')->first();
            $file_name = $getData->profile;
        }

		$name = $request->username;
		$email = $request->email;
		$data = ['name' => $name, 'email' => $email, 'profile' => $file_name, 'updated_at' => date('Y-m-d H:i:s')];
		$result = DB::table('admin')->where('id',session()->get('ADMINLOGINID'))->update(@$data);
		if($result){
			//return redirect()->intended('admin/profile')->withSuccess('update successfully.');
			return back()->with("status1", "update successfully!");
		}else{
			return back()->with("error1", "Some error occure, Please try again.!");
		}

	}

	public function  changepassword(Request $request){

		$where = ['id' => session()->get('ADMINLOGINID')];
		$getData = DB::table('admin')->where($where)->select('password')->first();


		 $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

		if(md5($request->old_password) != @$getData->password){
            return back()->with("error", "Old Password Doesn't match!");
        }

		$result = DB::table('admin')->where('id',session()->get('ADMINLOGINID'))->update(['password' => md5($request->new_password)]);
		return back()->with("status", "Password changed successfully!");
	}

	function cropImage (){
		$data = $_POST['image'];
		$image_array_1 = explode(";", $data);
		$image_array_2 = explode(",", $image_array_1[1]);
		$data = base64_decode($image_array_2[1]);
		$imageName = time().'.png';
		$image_name = 'public/profile/'.$imageName;
		file_put_contents($image_name, $data);
	    echo $imageName;
	}

	public function subscription($id)
    {

	    if(empty(@$id)){
			return false;
		}

        $data = array(
			'title'   => 'Users Subscription',
			'page'    => 'users',
			'subpage' => 'users'
		);
		$data['userId'] = $id;
		$user_type = DB::table('users')->where(['id' => $id])->select('user_type')->orderBy('id', 'DESC')->first();

		$data['result'] = DB::table('sub_plan')->where(['user_type' => $user_type->user_type])->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.package', $data);
    }

	public function payment()
    {
	    $data = array(
			'title' => 'Payment',
			'page' => 'users',
			'subpage' => 'users'
		);

		$data['userId'] = @$userId = @$_GET['uid'];
		$data['subId'] = @$subId = @$_GET['sid'];
		$data['subInfo'] = DB::table('sub_plan')->where(['id' => $subId])->select('*')->orderBy('id', 'DESC')->first();
		$data['userInfo'] = DB::table('users')->where(['id' => $userId])->select('*')->orderBy('id', 'DESC')->first();

        return view('admin.payment', $data);
    }

	function submit_payment(Request $request){
		//require "vendor/stripe-php/init.php";
		//print_r($request->input('stripeToken'));
		$token      = $request->stripeToken;
		$sub_id     = $_POST['sub_id'];
		$sub_name   = $_POST['sub_name'];
		$user_id    = $_POST['user_id'];
		$amount     = $_POST['amount'];
		$address    = $_POST['card_address'];
		$country    = $_POST['card_country'];
		$state      = $_POST['card_state'];
		$city       = $_POST['card_city'];
		$zipcode    = $_POST['card_zipcode'];
		$card_name  = $_POST['card_name'];
		$email      = $_POST['email'];
		$itemPrice  = $amount;
        $currency   = 'usd';

		$stripe = array(
			"secret_key"      => "sk_test_51MPhgSIuZrwn6gWgucZ3pq3OGKnLaQMxviXsKtZb4F7tenDBs25KovJkAB4tii3db6CMW1tdWSk2CB9thQ8yOYdX00iUs05KRN",
			"publishable_key" => "pk_test_51MPhgSIuZrwn6gWggTu5pxq41l6ZODzSg2zZ1kjKynv3yR61OZDey3AcNm2iwioDVJqSuJ3TCXJCdOAJn1VaNfyk00QkWY7DPT"
		);

		\Stripe\Stripe::setApiKey($stripe['secret_key']);

		try {
			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'source'  => $token
			));
		} catch(Exception $e) {
			$api_error = $e->getMessage();
		}



		if(empty($api_error) && $customer)
		{
			$itemName = @$sub_name;
			$orderID = "ORDNO-".$this->generate_otp(6);
			$itemPriceCents = ($itemPrice*100);
			//print_r($orderID);die;

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
					$transactionID = $chargeJson['balance_transaction'];
					$paidAmount = $chargeJson['amount'];
					$paidAmount = ($paidAmount/100);
					$paidCurrency = $chargeJson['currency'];
					$payment_status = $chargeJson['status'];
					$chargeID = $chargeJson['id'];
					$paymentDate = date('Y-m-d H:i:s');
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

						//echo $current_period_end;die;

						$data = ['user_name' => $card_name, 'user_id' => $user_id, 'address' => $address, 'country' => $country, 'state' => @$state, 'city' => @$city, 'zipcode' => $zipcode, 'sub_id' => @$sub_id, 'amount' => @$itemPrice, 'currency' => @$currency, 'txn_id' => $transactionID, 'charge_id' => $chargeID, 'status' => $payment_status, 'expiry_date' => $current_period_end, 'created_at' => $paymentDate];
						$result = DB::table('transaction')->insertGetId($data);
						return redirect()->intended('admin/users')->with("status", "Your Payment has been Successful!");

					}else{
						return redirect()->intended('admin/users')->with("error", "Your Payment has Failed. Some error occure, Please try again!");
					}
				}else{
					return redirect()->intended('admin/users')->with("error", "Your Payment has Failed. Some error occure, Please try again!");
				}
			}else{
				return redirect()->intended('admin/users')->with("error", "Charge creation failed! $api_error");

			}
		}else{

			return redirect()->intended('admin/users')->with("error", "Invalid card details! $api_error");
		}
	}

    public function updateAccess(Request $request)
    {
		$view = $request->view;
		$created = $request->created;
		$edited = $request->edited;
		$deleted = $request->deleted;
		$menu_id = $request->menu_id;
		$role_id = $request->user_type;

		$where = array('role_id' => $role_id);
		DB::table('role_permission')->where($where)->delete();

		if(!empty($menu_id)) {
			foreach ($menu_id as $key => $value) {

				 // echo @$view[$key] . $value;
				 // echo "<br/>";

				if(@$menu_id[$key]) {

					if(@$view[$key]) {
						$viewvalue = $view[$key];
					} else {
						$viewvalue = "0";
					}

					if(@$created[$key]) {
						$createdvalue = $created[$key];
					} else {
						$createdvalue = "0";
					}

					if(@$edited[$key]) {
						$editedvalue = $edited[$key];
					} else {
						$editedvalue = "0";
					}

					if(@$deleted[$key]) {
						$deletedvalue = $deleted[$key];
					} else {
						$deletedvalue = "0";
					}

					$mydata = array(
						'role_id'           => $role_id,
						'menu_id'           => @$menu_id[$key],
						'view'              => @$viewvalue,
						'created'           => @$createdvalue,
						'edited'            => @$editedvalue,
						'deleted'           => @$deletedvalue,
						'permission_status' => '1',
						'per_created_at'    => date('Y-m-d H:i:s')
					);
					//print_r($mydata);

					/*if (!$this->Commonmodel->add_details('role_permission', $mydata)) {
						$msg = 'error';
					} else {
						$msg = '["Permission updated successfully!", "success", "#A5DC86"]';
					}*/
					$result = DB::table('role_permission')->insertGetId($mydata);
				}
			}

			return redirect()->intended('admin/access-management/userlist')->with("status", "Access updated successfully!");
		}


    }

	function editAccess($id){

        $roleId = base64_decode($id);
        if($roleId == 0){
            $roleId = '0000';
        }
        //echo $roleId;die;
        $data = array(
			'title' => 'Edit Access',
			'page' => 'access-mng',
			'subpage' => 'access-mng1'
		);
		$data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
		$data['rolePer'] = $rolePer = DB::table('role_permission')->where(['role_id' => $roleId])->select('*')->get();
        //print_r($rolePer);die;
        $data['roleId'] = $roleId;
        return view('admin.edit_access', $data);
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