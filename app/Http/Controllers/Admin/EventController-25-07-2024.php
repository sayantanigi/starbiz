<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class EventController extends Controller {
  

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
			'title' => 'Events Lists',
			'page' => 'events',
			'subpage' => 'events'
		);

		$data['result'] = DB::table('events')->select('*')->orderBy('id', 'DESC')->get();
		
        return view('admin.event', $data);
    }
	
	public function add()
    { 
	
        $data = array(
			'title' => 'Add Event',
			'page' => 'events',
			'subpage' => 'events'
		);

		$data['result']  = DB::table('users')->select('*')->orderBy('id', 'DESC')->first();
		$data['cat'] = DB::table('event_category')->select('*')->orderBy('name', 'ASC')->get();
		$data['profile'] = [];
		$data['academics'] = [];
		$data['athletics'] = [];
		$data['exprience'] = [];
		$data['reference'] = [];
		$data['guardian'] = [];
	
        return view('admin.add_event', $data);
    }
	
	
	public function save(Request $request)
    { 		
		$event_name        = $request->event_name;
		$event_description = $request->event_description;
		$event_category    = $request->event_category;
		$event_start_date  = $request->event_start_date;
		$event_end_date    = $request->event_end_date;
		$event_start_time  = $request->event_start_time;
		$event_end_time    = $request->event_end_time;
		$frt_image         = $request->frt_image;
		$bck_image         = $request->bck_image;
		$startDate         = date('Y-m-d H:i:s', strtotime($event_start_date.''.$event_start_time));
		$endDate           = date('Y-m-d H:i:s', strtotime($event_end_date.''.$event_end_time));
      
	  if(empty($request->eventId)){
		  
			if ($request['frt_image']) {
				$img = $request['frt_image'];
				$extn = $img->getClientOriginalExtension();
				$path = public_path('events/');
				$frt_image = rand() . '.' . $extn;
				$img->move($path, $frt_image);
			} else {
				$frt_image = '';
			}
		
			if ($request['bck_image']) {
				$img = $request['bck_image'];
				$extn = $img->getClientOriginalExtension();
				$path = public_path('events/');
				$bck_image = rand() . '.' . $extn;
				$img->move($path, $bck_image);
			} else {
				$bck_image = '';
			}
		
		    $data = ['event_name' => $event_name, 'description' => $event_description, 'user_id' => '0', 'category' => @$event_category, 'start_date' => @$startDate, 'end_date' => @$endDate, 'backgroung_image' => @$bck_image, 'front_image' => @$frt_image, 'status' => '1', 'created_at' => date('Y-m-d H:i:s')];
		    $result = DB::table('events')->insertGetId($data);
			if($result){
				$response['status'] = 1;
				$response['msg'] = 'Your event added successfully.';
				$response['eventId'] = $result;
			}else{
				$response['status'] = 0;
				$response['msg'] = 'Some error occure, Please try again.';
				$response['eventId'] = '';
			}
			echo json_encode($response);
	  }else{
		  if ($request['frt_image']) {
				$img = $request['frt_image'];
				$extn = $img->getClientOriginalExtension();
				$path = public_path('events/');
				$frt_image = rand() . '.' . $extn;
				$img->move($path, $frt_image);
			} else {
				$frt_image = '';
			}
		
			if ($request['bck_image']) {
				$img = $request['bck_image'];
				$extn = $img->getClientOriginalExtension();
				$path = public_path('events/');
				$bck_image = rand() . '.' . $extn;
				$img->move($path, $bck_image);
			} else {
				$bck_image = '';
			}
		
		    $data = ['event_name' => $event_name, 'description' => $event_description, 'user_id' => '0', 'category' => @$event_category, 'start_date' => @$startDate, 'end_date' => @$endDate, 'backgroung_image' => @$bck_image, 'front_image' => @$frt_image, 'status' => '1', 'updated_at' => date('Y-m-d H:i:s')];
		    $result = DB::table('events')->where('id',$request->eventId)->update(@$data);
			if($result){
				$response['status'] = 1;
				$response['msg'] = 'Your event added successfully.';
				$response['eventId'] = $request->eventId;
			}else{
				$response['status'] = 0;
				$response['msg'] = 'Some error occure, Please try again.';
				$response['eventId'] = '';
			}
			echo json_encode($response);
	  }

    }
	
	public function saveTicket(Request $request){
		$eventId = $request->eventId;
		
		if(!empty($request->ticket_name)){
			 DB::table('event_ticket')->where('event_id', $eventId)->delete();
			 $i = 0;
			 foreach($request->ticket_name as $k => $v){
				 $academics = [
					'ticket_name' => @$v,
					'ticket_price' => @$request->ticket_price[$i],
					'ticket_offer_price' => @$request->ticket_offer_price[$i],
					'feature' => @$request->graduation_year[$i],
					'feature' => @$request->ticket_features[$i],
					'event_id' => @$eventId,
					'created_at' => date('Y-m-d H:i:s'),
				 ];
				 DB::table('event_ticket')->insertGetId($academics);
				 $i++;
			 }
		 }
	}
	
	public function saveLocation(Request $request){
		
		$eventId         = $request->eventId;
		$event_location  = $request->event_location;
		$event_country   = $request->event_country;
		$event_state     = $request->event_state;
		$event_city      = $request->event_city;
		$event_zipcode   = $request->event_zipcode;
		$event_zipcode   = $request->event_zipcode;
		$event_latitude  = $request->event_latitude;
		$event_longitude = $request->event_longitude;
		
		
		$data = ['location' => $event_location, 'country' => $event_country, 'state' => $event_state, 'city' => @$event_city, 'zipcode' => @$event_zipcode,  'latitude' => $event_latitude, 'longitude' => @$event_longitude, 'updated_at' => date('Y-m-d H:i:s')];

		$result = DB::table('events')->where('id',$eventId)->update(@$data);
		if($result){
			$response['status'] = 1;
			$response['msg'] = 'Your event added successfully.';
			$response['eventId'] = $request->eventId;
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['eventId'] = '';
		}

	}
	
	public function saveEventImage(Request $request)
	{
		  $image = array();
		  if($file = $request->file('image')){
			  foreach($file as $file){
				  $image_name = md5(rand(1000,10000));
				  $ext = strtolower($file->getClientOriginalExtension());
				  $image_full_name = $image_name.'.'.$ext;
				  $uploade_path = public_path('events/');
				  $image_url = $image_full_name;
				  $file->move($uploade_path,$image_full_name);
				  $image = $image_url;
				  
				  $data = ['image' => $image, 'event_id' => $request->eventId, 'created_at' => date('Y-m-d H:i:s')];
				  $result[] = DB::table('event_image')->insertGetId($data);
			  }    
		  }
		  
		if($result){
			$response['status'] = 1;
			$response['msg'] = 'Your event added successfully.';
			$response['eventId'] = $request->eventId;
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['eventId'] = '';
		}
		  
		echo json_encode($response);  
	  
	}
	
	function edit($id){
		if(empty(@$id)){
			return false;
		}
		
		$data = array(
			'title' => 'Edit Event',
			'page' => 'events',
			'subpage' => 'events'
		);

		$data['result']  = DB::table('events')->where(['id' => @$id])->select('*')->orderBy('id', 'DESC')->first();
		$data['ticket']  = DB::table('event_ticket')->where(['event_id' => @$id])->select('*')->orderBy('id', 'ASC')->get();
		$data['image']  = DB::table('event_image')->where(['event_id' => @$id])->select('*')->orderBy('id', 'ASC')->get();
		$data['cat'] = DB::table('event_category')->select('*')->orderBy('name', 'ASC')->get();
		//print_r($data['result']);die;
        return view('admin.edit_event', $data);
	}
	
	public function changestatus(Request $request)
	{
		if ($request->id) {
			$id = $request->id;
			$status = $request->status;
			if ($status == 1) {
				$msg = 'Your status is Activate';
			} else {
				$msg = 'Your status is Inctivate';
			}
			$result = DB::table('events')->where('id',@$id)->update(['status'=>$status]);
			
			if ($result) {
				echo '["'.$msg.'", "success", "#A5DC86"]';
			} else {
				echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
			}
		}
	}
	
	// public function edit($id)
    // { 
	    
		// if(empty($id)){
			// return false;
		// }
		
        // $data = array(
			// 'title' => 'Edit Users',
			// 'page' => 'users',
			// 'subpage' => 'users'
		// );
		// $data['result'] = DB::table('users')->where(['id' => $id])->select('*')->first();
		// $data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        // return view('admin.edit_user', $data);
    // }
	
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
	
	
	 public function view($id)
    { 
	
        $data = array(
			'title' => 'View Event Information',
			'page' => 'events',
			'subpage' => 'events'
		);
		
		//echo $id;die;

		$data['result'] = DB::table('events')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.view_event', $data);
    }
	
	function delete_event($id){
		if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('events')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('admin/event')->with("status", "Event deleted successfully!");
		}else{
			return redirect()->intended('admin/event')->with("error", "Some error occure, Please try again!");
		}
	}
	
	
	
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
					'school_name' => @$v,
					'course_name' => @$request->course[$i],
					'rank'        => @$request->rank[$i],
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
	
	public function update(Request $request)
    { 		
		$event_name        = $request->event_name;
		$event_description = $request->event_description;
		$event_category    = $request->event_category;
		$event_start_date  = $request->event_start_date;
		$event_end_date    = $request->event_end_date;
		$event_start_time  = $request->event_start_time;
		$event_end_time    = $request->event_end_time;
		$frt_image         = $request->frt_image;
		$bck_image         = $request->bck_image;
		$startDate         = date('Y-m-d H:i:s', strtotime($event_start_date.''.$event_start_time));
		$endDate           = date('Y-m-d H:i:s', strtotime($event_end_date.''.$event_end_time));
		$eventId           = $request->eventId;
		
		
		if (!empty($request['frt_image']) && $request['frt_image'] != 'undefined') {
			$img = $request['frt_image'];
			$extn = $img->getClientOriginalExtension();
			$path = public_path('events/');
			$frt_image = rand() . '.' . $extn;
			$img->move($path, $frt_image);
		} else {
			$result = DB::table('events')->where(['id' => $eventId])->select('front_image')->first();
			$frt_image = $result->front_image;
		}
		
		if (!empty($request['bck_image']) && $request['bck_image'] != 'undefined') {
			$img = $request['bck_image'];
			$extn = $img->getClientOriginalExtension();
			$path = public_path('events/');
			$bck_image = rand() . '.' . $extn;
			$img->move($path, $bck_image);
		} else {
			$result = DB::table('events')->where(['id' => $eventId])->select('backgroung_image')->first();
			$bck_image = $result->backgroung_image;
		}
		
		$data = ['event_name' => $event_name, 'description' => $event_description, 'category' => @$event_category, 'start_date' => @$startDate, 'end_date' => @$endDate, 'backgroung_image' => @$bck_image, 'front_image' => @$frt_image, 'updated_at' => date('Y-m-d H:i:s')];
		
		$result = DB::table('events')->where('id',$eventId)->update(@$data);
		if($result){
			$response['status'] = 1;
			$response['msg'] = 'Your event updated successfully.';
			$response['eventId'] = $eventId;
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['eventId'] = '';
		}
		echo json_encode($response);
		

    }
	
	public function updateTicket(Request $request){
		$eventId = $request->eventId;
		
		if(!empty($request->ticket_name)){
			 DB::table('event_ticket')->where('event_id', $eventId)->delete();
			 $i = 0;
			 foreach($request->ticket_name as $k => $v){
				 $academics = [
					'ticket_name'        => @$v,
					'ticket_price'       => @$request->ticket_price[$i],
					'ticket_offer_price' => @$request->ticket_offer_price[$i],
					'feature'    => @$request->graduation_year[$i],
					'feature'    => @$request->ticket_features[$i],
					'event_id'   => @$eventId,
					'created_at' => date('Y-m-d H:i:s'),
				 ];
				 DB::table('event_ticket')->insertGetId($academics);
				 $i++;
			 }
		 }
	}
	
	public function updateLocation(Request $request){
		
		$eventId = $request->eventId;
		$event_location  = $request->event_location;
		$event_country   = $request->event_country;
		$event_state     = $request->event_state;
		$event_city      = $request->event_city;
		$event_zipcode   = $request->event_zipcode;
		$event_zipcode   = $request->event_zipcode;
		$event_latitude  = $request->event_latitude;
		$event_longitude = $request->event_longitude;
		
		
		$data = ['location' => $event_location, 'country' => $event_country, 'state' => $event_state, 'city' => @$event_city, 'zipcode' => @$event_zipcode,  'latitude' => $event_latitude, 'longitude' => @$event_longitude, 'updated_at' => date('Y-m-d H:i:s')];

		$result = DB::table('events')->where('id',$eventId)->update(@$data);
		if($result){
			$response['status'] = 1;
			$response['msg'] = 'Your event update successfully.';
			$response['eventId'] = $request->eventId;
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['eventId'] = '';
		}

	}
	
	public function updateEventImage(Request $request)
	{     
	      $result = [1]; 
		  $image = array();
		  if($file = $request->file('image')){
			  foreach($file as $file){
				  $image_name = md5(rand(1000,10000));
				  $ext = strtolower($file->getClientOriginalExtension());
				  $image_full_name = $image_name.'.'.$ext;
				  $uploade_path = public_path('events/');
				  $image_url = $image_full_name;
				  $file->move($uploade_path,$image_full_name);
				  $image = $image_url;
				  
				  $data = ['image' => $image, 'event_id' => $request->eventId, 'created_at' => date('Y-m-d H:i:s')];
				  $result[] = DB::table('event_image')->insertGetId($data);
			  }    
		  }
		  
		if($result){
			$response['status'] = 1;
			$response['msg'] = 'Your event update successfully.';
			$response['eventId'] = $request->eventId;
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['eventId'] = '';
		}
		  
		echo json_encode($response);  
	  
	}
	
	
	public function deleteGallery(Request $request)
    { 
	    if(empty(@$request->gId)){
			return false;
		}
		
        $result = DB::table('event_image')->where('id', @$request->gId)->delete();
		if($result){
			echo 1;
		}else{
			echo 0;
		}
    }
	
	 public function event_category()
    { 
	
        $data = array(
			'title' => 'Category Lists',
			'page' => 'events',
			'subpage' => 'category'
		);

		$data['result'] = DB::table('event_category')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.event_category', $data);
    }
	
	 public function add_category()
    { 
	
        $data = array(
			'title' => 'Add Category',
			'page' => 'events',
			'subpage' => 'category'
		);
        return view('admin.add_category', $data);
    }
	
	public function save_category(Request $request)
    { 
	
		$name = $request->name;
		$pckstatus = $request->pckstatus;
		$data = ['name' => $name, 'status' => $pckstatus, 'created_at' => date('Y-m-d H:i:s')];
        $result =  DB::table('event_category')->insertGetId($data);
		if($result){
			return redirect()->intended('admin/event/category')->with("status", "Your event category added successfully!");
		}else{
			return redirect()->intended('admin/event/category')->with("error", "Some error occure, Please try again!");
		}
    }
	
	 public function edit_category($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $data = array(
			'title' => 'Edit Category',
			'page' => 'events',
			'subpage' => 'category'
		);

		$data['result'] = DB::table('event_category')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.edit_category', $data);
    }
	
	 public function update_category(Request $request)
    { 
	    $name = $request->name;
		$pckstatus = $request->pckstatus;
		$catId = $request->catId;
		$data = ['name' => $name, 'status' => $pckstatus, 'updated_at' => date('Y-m-d H:i:s')];
        //$result =  DB::table('event_category')->insertGetId($data);
		$result = DB::table('event_category')->where('id',$catId)->update(@$data);
		if($result){
			return redirect()->intended('admin/event/category')->with("status", "Your event category updated successfully!");
		}else{
			return redirect()->intended('admin/event/category')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function delete_category($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('event_category')->where('id', $id)->delete();
		if($result){
			//return back()->with("status", "User type added successfully!");
			return redirect()->intended('admin/event/category')->with("status", "Category deleted successfully!");
		}else{
			//return back()->with("error", "Some error occure, Please try again!");
			return redirect()->intended('admin/event/category')->with("error", "Some error occure, Please try again!");
		}
		
        
    }
	
}