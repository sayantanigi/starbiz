<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DiscountController extends Controller {
  

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
			'title' => 'Discount Lists',
			'page' => 'discount',
			'subpage' => 'discount'
		);

		$data['result'] = DB::table('discount')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.discount', $data);
    }
	
	public function add()
    { 
	
        $data = array(
			'title' => 'Add Discount',
			'page' => 'discount',
			'subpage' => 'discount'
		);
		//$data['userType'] = DB::table('discount')->where(['status' => 1])->select('*')->get();
        return view('admin.add_discount', $data);
    }
	
	public function save(Request $request)
    { 		
		$type = $request->type;
		$discount = '';
		if($type == 0){
			$discount = $request->amount;
		}elseif($type == 1){
			$discount = $request->percentage;
		}
		$promo_code = $request->promo_code;
		$expire_on = date('Y-m-d', strtotime($request->expire_on));
		$status = $request->status;
		
		
		$data = ['type' => $type, 'coupon_code' => $promo_code, 'expire_on' => $expire_on, 'status' => @$status, 'discount' => @$discount, 'created_at' => date('Y-m-d H:i:s')];

		$result = DB::table('discount')->insertGetId($data);
		if($result){
			return redirect()->intended('admin/discount')->with("status", "Your discount added successfully!");
		}else{
			return redirect()->intended('admin/discount')->with("error", "Some error occure, Please try again!");
		}
        
    }
	
	public function edit($id)
    { 
	    
		if(empty($id)){
			return false;
		}
		
        $data = array(
			'title' => 'Edit Discount',
			'page' => 'discount',
			'subpage' => 'discount'
		);
		$data['result'] = DB::table('discount')->where(['id' => $id])->select('*')->first();
		$data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        return view('admin.edit_discount', $data);
    }
	
	public function changestatus(Request $request)
	{
		if ($request->userId) {
			$userId = $request->userId;
			$status = $request->status;
			if ($status == 1) {
				$msg = 'Your status is Activate';
			} else {
				$msg = 'Your status is Inctivate';
			}
			$result = DB::table('users')->where('id',@$userId)->update(['status'=>$status]);
			
			if ($result) {
				echo '["'.$msg.'", "success", "#A5DC86"]';
			} else {
				echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
			}
		}
	}
	
	
	
	public function update(Request $request)
    { 
		$type = $request->type;
		$discount = '';
		if($type == 0){
			$discount = $request->amount;
		}elseif($type == 1){
			$discount = $request->percentage;
		}
		$promo_code = $request->promo_code;
		$expire_on = date('Y-m-d', strtotime($request->expire_on));
		$status = $request->status;
		$id = $request->id;
		
		
		$data = ['type' => $type, 'coupon_code' => $promo_code, 'expire_on' => $expire_on, 'status' => @$status, 'discount' => @$discount, 'created_at' => date('Y-m-d H:i:s')];

		//$result = DB::table('discount')->insertGetId($data);
		$result = DB::table('discount')->where('id',$id)->update(@$data);
		if($result){
			return redirect()->intended('admin/discount')->with("status", "Your discount updated successfully!");
		}else{
			return redirect()->intended('admin/discount')->with("error", "Some error occure, Please try again!");
		}
        
    }
	
	function delete($id){
		if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('discount')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('admin/discount')->with("status", "Discount deleted successfully!");
		}else{
			return redirect()->intended('admin/discount')->with("error", "Some error occure, Please try again!");
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
		
		$data['profile'] = DB::table('users')->where(['id' => $id])->select('*')->first();
		$data['academics'] = DB::table('academics')->where(['user_id' => $id])->select('*')->get();
		$data['athletics'] = DB::table('athletics')->where(['user_id' => $id])->select('*')->first();
		$data['exprience'] = DB::table('experience')->where(['user_id' => $id])->select('*')->get();
		$data['reference'] = DB::table('reference')->where(['user_id' => $id])->select('*')->get();
		$data['guardian'] = DB::table('guardian')->where(['user_id' => $id])->select('*')->get();
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
					'school_name' => @$v,
					'course_name' => @$request->course[$i],
					'rank' => @$request->rank[$i],
					'graduation_year' => @$request->graduation_year[$i],
					'gpa' => @$request->gpa[$i],
					'act_score' => @$request->act_score[$i],
					'user_id' => @$request->userId,
					'created_at' => date('Y-m-d H:i:s'),
				 ];
				 DB::table('academics')->insertGetId($academics);
				 $i++;
			 }
		 }
		 
		 $athletic_row = DB::table('athletics')->where(['user_id' => @$request->userId])->select('*')->first();
		 
		 $feet = !empty(@$request->feet) ?  trim(@$request->feet, "'") : $athletic_row->feet;
		 $inches = !empty(@$request->inches) ? trim(@$request->inches, '"') : $athletic_row->inches;
		 $weight = !empty(@$request->weight) ? @$request->weight : $athletic_row->weight;
		 $strength = !empty(@$request->strength) ? @$request->strength : $athletic_row->strength;
		 
		 
		 
		 if(!empty($athletic_row)){
			$athletic_data = [
				'feet' => $feet,
				'inches' => $inches,
				'weight' => $weight,
				'strength' => $strength,
				'user_id' => $userId,
				'updated_at' => date('Y-m-d H:i:s')
			];
			 
			 DB::table('athletics')->where('id',$athletic_row->id)->update(@$athletic_data);
		 }else{
			 
			 $athletic_data = [
				'feet' => $feet,
				'inches' => $inches,
				'weight' => $weight,
				'strength' => $strength,
				'user_id' => $userId,
				'created_at' => date('Y-m-d H:i:s')
			];
			 DB::table('athletics')->insertGetId($athletic_data);
		 }
		 
		 if(!empty($request->club_name)){
			 DB::table('experience')->where('user_id', $userId)->delete();
			 $i = 0;
			 foreach($request->club_name as $k => $v){
				 $experience = [
					'club_name' => @$v,
					'designation' => @$request->club_designation[$i],
					'start_date' => date('Y-m-d', strtotime(@$request->start_date[$i])),
					'end_date' => date('Y-m-d', strtotime(@$request->end_date[$i])),
					'information' => @$request->information[$i],
					'user_id' => @$request->userId,
					'created_at' => date('Y-m-d H:i:s'),
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
	
	
}