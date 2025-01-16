<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Stripe;

use Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class DashboardController extends Controller {
  

	public function __construct()
	{

		$this->middleware(function ($request, $next) {
			
			
			$usersub = DB::table('transaction')->whereRaw("user_id = '".session()->get('USERLOGINID')."' AND expiry_date >= '".date('Y-m-d')."' AND payment_type = 1 AND status = 'succeeded'")->limit(1)->select('*')->orderBy('id', 'DESC')->first();
			
			$this->SUBID = @$usersub->sub_id;
			
			$this->userData = session()->get('userData');

			if (!session()->get('USERLOGINID') || !session()->get('IDLOGIN')) {
			   return redirect()->intended('login');
			}

			// let the request continue through the stack
			return $next($request);
		});
	}	
	
    public function index()
    { 
	
	   //print_r(session()->get('shopping_cart'));die;
	   

	   
        $data = array(
			'title'   => 'Dashboard Lists',
			'page'    => 'users',
			'subpage' => 'users'
		);
		
		$Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='1' AND repeat_invitation.status='1' AND (repeat_invitation.sender_id = '".session()->get('USERLOGINID')."' OR repeat_invitation.receiver_id = '".session()->get('USERLOGINID')."')";
		$data['appe'] = DB::select($Sql);
		//print_r($data['appe']);die;
		
		
		//Event Mgmt
		//$Sql = "SELECT * FROM events WHERE status = '1' AND DATE(start_date) >= '".date('Y-m-d')."' order by id DESC";
		//$data['eventList'] = DB::select($Sql);
		
		$Sql = "SELECT * FROM events WHERE status = '1' AND DATE(start_date) >= '".date('Y-m-d')."' order by id DESC";
		$data['eventList'] = DB::select($Sql);
		
		$eventsList = DB::table('events')->where(['status' => 1, 'user_id' => session()->get('USERLOGINID')])->select('*')->orderBy('id', 'DESC')->get();
		$data['myeventList'] = $eventsList;
		
		$Sql = "SELECT * FROM promotion WHERE status = '1'";
		$data['adsList'] = DB::select($Sql);
		
		
		$Sql = "SELECT * FROM promotion WHERE status = '1' AND user_id = '".session()->get('USERLOGINID')."'";
		$data['myadsList'] = DB::select($Sql);
		
		
		
		$Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='1' AND repeat_invitation.status='1' AND (repeat_invitation.sender_id = '".session()->get('USERLOGINID')."' OR repeat_invitation.receiver_id = '".session()->get('USERLOGINID')."')";
		$data['accept'] = DB::select($Sql);
		
		
		$Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='2' AND repeat_invitation.status='2' AND (repeat_invitation.sender_id = '".session()->get('USERLOGINID')."' OR repeat_invitation.receiver_id = '".session()->get('USERLOGINID')."')";
		$data['sent'] = DB::select($Sql);
		
		
		
		$Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='0' AND repeat_invitation.status='0' AND (repeat_invitation.sender_id = '".session()->get('USERLOGINID')."' OR repeat_invitation.receiver_id = '".session()->get('USERLOGINID')."')";
		$data['reject'] = DB::select($Sql);
		
       
		$data['eventCat'] = DB::table('event_category')->where(['status' => 1])->select('*')->orderBy('name', 'ASC')->get();
		
		
		$counterSql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='3' AND repeat_invitation.status='3' AND  repeat_invitation.receiver_id = '".session()->get('USERLOGINID')."'";
		$data['counter'] = DB::select($counterSql);
		
		
		$pendingSql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='2' AND repeat_invitation.status='2' AND (repeat_invitation.sender_id = '".session()->get('USERLOGINID')."' OR repeat_invitation.receiver_id = '".session()->get('USERLOGINID')."')";
		$data['pending'] = DB::select($pendingSql);
		
		
		$rejectSql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='0' AND repeat_invitation.status='0' AND (repeat_invitation.sender_id = '".session()->get('USERLOGINID')."' OR repeat_invitation.receiver_id = '".session()->get('USERLOGINID')."')";
		$data['rejectIn'] = DB::select($rejectSql);
		
		
		$Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id WHERE invitation.status='1' AND repeat_invitation.status='1' AND (repeat_invitation.sender_id = '".session()->get('USERLOGINID')."' OR repeat_invitation.receiver_id = '".session()->get('USERLOGINID')."')";
		$data['complete'] = DB::select($Sql);
		
		//print_r($data['accept']);die;
		
		$data['income']   = DB::table('household_income')->select('*')->orderBy('id', 'ASC')->get();
		$data['age']      = DB::table('age_range')->select('*')->orderBy('id', 'ASC')->get();
		$data['category'] = DB::table('promotion_category')->select('*')->orderBy('name', 'ASC')->get();
		$data['tags'] = DB::table('tags')->select('*')->orderBy('name', 'ASC')->get();
		
		$data['allBusiness'] = DB::table('listing')->select('*')->where(['status' => 1])->limit(10)->orderBy('id', 'DESC')->get();
		$data['allBusinessCount'] = DB::table('listing')->select('*')->where(['status' => 1])->orderBy('id', 'DESC')->count();
		$data['myBusiness'] = DB::table('listing')->select('*')->where(['status' => 1, 'user_id' => session()->get('USERLOGINID')])->orderBy('id', 'DESC')->get();
		$favBusiness = "SELECT listing.* FROM listing INNER JOIN favouritebusiness ON listing.id = favouritebusiness.listing_id WHERE favouritebusiness.user_id='".session()->get('USERLOGINID')."'";		$data['favBusiness'] = DB::select($favBusiness);
		$data['listing_category'] = DB::table('listing_category')->where(['status' => 1])->select('*')->orderBy('name', 'ASC')->get();
		$data['product_category'] = DB::table('product_category')->where(['status' => 1])->select('*')->orderBy('name', 'ASC')->get();
		
		$Sql = "SELECT event_name, id FROM events WHERE status = '1' AND user_id = '".session()->get('USERLOGINID')."' AND DATE(start_date) >= '".date('Y-m-d')."' order by id DESC";
		$data['upcomingEventList'] = DB::select($Sql);
		
		$Sql = "SELECT first_name, last_name, id FROM users WHERE status = '1' AND user_type = '10' order by id DESC";
		$data['athletic'] = DB::select($Sql);
		
		
		
		$data['usersubInfo'] = DB::table('transaction')->whereRaw("user_id = '".session()->get('USERLOGINID')."' AND expiry_date >= '".date('Y-m-d')."' AND payment_type = 1 AND status = 'succeeded'")->limit(1)->select('*')->orderBy('id', 'DESC')->first();
		//print_r($data['usersubInfo']);die;
		
		$data['plan']  = DB::table('sub_plan')->where(['status' => 1, 'user_type' => 8])->select('*')->get();
		$data['adsPlan']  = DB::table('ads_sub_plan')->where(['status' => 1])->select('*')->get();
		$setting  = DB::table('settings')->select('*')->first();
		
		/*$ip = $_SERVER["REMOTE_ADDR"];
		$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));*/
		//print_r($query);die;
		
		
		
		/*$allBu = "SELECT *, 
		(6371 * acos(cos(radians(" . $query['lat'] . ")) * cos(radians(`latitude`)) * cos(radians(`longitude`) - radians(" . $query['lon'] . ")) + sin(radians(" . $query['lat'] . ")) * sin(radians(`latitude`)))) as distance FROM listing
		having distance < 2000";
		$data['allBu'] = DB::select($allBu);*/
		//print_r($data['allBu']);die;
		
		/*$searchSql = "SELECT *, ( 6367 * acos( cos( radians('".$query['lat']."') ) * cos( radians(latitude) ) * cos( radians(longitude ) - radians('".$query['lon']."') ) + sin( radians('".$query['lat']."') ) * sin( radians(latitude) ) ) ) AS distance FROM `listing` having `distance` < ".@$setting->kilometer." order by id desc limit 10";*/
		
		//$data['allBusiness'] = DB::select($searchSql);
		//print_r($data['searchSql']);die;
        return view('account.dashboard', $data);
    }
	
	public function addEvent(Request $request)
	{
	
	    //print_r($request->event_tags);die;
		if($request->event_tags){
			$tags = implode(',', (array) @$request->event_tags);
		}else{
			$tags = '';
		}
		$startDate = $request->event_date.' '.$request->event_time;
		$start_date = date('Y-m-d H:i:s', strtotime($startDate));
		//$endDate = $request->endDate.' '.$request->endTime;
		//$end_date = date('Y-m-d H:i:s', strtotime($endDate));
		
		
		
		/*$accessList = DB::table('sub_permision_menu')->where(['sub_id' => @$this->SUBID, 'menu_id' => 2])->select('number_of')->first();
		if(!empty(@$accessList)){
			$userCountBusiness = DB::table('listing')->where(['user_id' => session()->get('USERLOGINID')])->select('*')->count();
			if(@$accessList->number_of > @$userCountBusiness){
				
			}else{
				$response['status'] = 0;
			    $response['msg'] = 'Your event adding limit is over now.';
				echo json_encode($response);exit();	
			}
		}*/
		
		$accessList = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->select('eventCount')->first();
		if(!empty(@$accessList)){
			if(@$accessList->eventCount > 0){
				
			}else{
				$response['status'] = 0;
			    $response['msg'] = 'Your event adding limit is over now.';
				echo json_encode($response);exit();	
			}
		}
		
		
		
		$data = ['event_name' => @$request->event_name, 'description' => @$request->event_description, 'category' => @$request->event_category, 'user_id' => @$request->userId, 'start_date' => @$start_date, 'location' => @$request->event_address, 'country' => @$request->event_country, 'state'  => @$request->event_state, 'city' => @$request->event_city, 'latitude' => @$request->event_latitude, 'longitude' => @$request->event_longitude, 'zipcode' => @$request->event_zipcode, 'status' => 1, 'email' => @$request->event_email, 'phone' => @$request->event_phone, 'website' => @$request->event_website, 'tags' => @$tags, 'created_at' => date('Y-m-d H:i:s')];
		
		$result = DB::table('events')->insertGetId($data);
		
		if($result){
			
			if(!empty($request->eventTicket)){
				$i = 0;
				foreach($request->eventTicket as $k => $v){
					
					$academics = [
						'ticket_name'        => @$v['ticketName'],
						'ticket_price'       => @$v['ticketPrice'],
						'ticket_offer_price' => @$v['ticketOfferPrice'],
						'feature'            => @$v['ticketFeatures'],
						'event_id'           => @$result,
						'created_at'         => date('Y-m-d H:i:s'),
					];
					DB::table('event_ticket')->insertGetId($academics);
					$i++;
				}
			}
			
			$image = array();
			if($file = $request->file('event_image')){
				foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('events/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data  = ['image' => $image, 'event_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('event_image')->insertGetId($data);
				}    
			}
			
			DB::table('users')->where(['id' => session()->get('USERLOGINID')])->update(['eventCount' => DB::raw('eventCount-1')]);
	 
			$response['status'] = 1;
			$response['msg'] = 'Your event added successfully.';
			$response['eventId'] = $result;
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['eventId'] = '';
		}
		echo json_encode($response);	
	}
	
	public function saveAds(Request $request)
    { 		
		$ads_name        = @$request->ads_name;
		//$url           = $request->url;
		$url             = '';
		//$description   = $request->description;
		$description     = '';
		$file_type       = @$request->file_type;
		$category        = @$request->category;
		$gender          = @$request->gender;
		$age             = @$request->age;
		$parental_status = @$request->parental_status;
		$income          = @$request->income;
		$location        = @$request->location;
		$latitude        = @$request->latitude;
		$longitude       = @$request->longitude;
		//$radius        = $request->radius;
		$radius          = '';
		
		if(!empty(@$request->places)){
			@$places = implode(',', @$request->places);
		}else{
			@$places = '';
		}
		
		//print_r($_FILES);die;
		if (!empty($request['ads_image']) && @$request['ads_image'] != 'undefined') {
            $img  = $request['ads_image'];
            $extn = $img->getClientOriginalExtension();
            $path = public_path('ads/');
            $file_name = rand() . '.' . $extn;
            $img->move($path, $file_name);
        } else {
            $file_name = '';
        }
		
		$accessList = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->select('promotionCount')->first();
		if(!empty(@$accessList)){
			if(@$accessList->promotionCount > 0){
				
			}else{
				$response['status'] = 0;
			    $response['msg'] = 'Your promotion adding limit is over now.';
				echo json_encode($response);exit();	
			}
		}
		
		
		$data = ['ads_name' => $ads_name, 'url' => $url, 'category' => $category, 'description' => $description, 'file_type' => @$file_type, 'image' => @$file_name, 'user_id' => session()->get('USERLOGINID'), 'status' => 1, 'places' => @$places, 'gender' => @$gender, 'age_range' => @$age, 'parental_status' => @$parental_status, 'income' => $income, 'location' => $location, 'latitude' => $latitude, 'longitude' => $longitude, 'radius' => @$radius, 'created_at' => date('Y-m-d H:i:s')];

		$result = DB::table('promotion')->insertGetId($data);
		if($result){
			$response['status'] = 1;
			$response['msg'] = 'Ads added successfully!';
			$response['adsId'] = $result;
			//return redirect()->intended('admin/promotion')->with("status", "Ads added successfully!");
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['adsId'] = '';
		}
		echo json_encode($response);	
    }
	public function get_promotion_detail(Request $request)
    {
		
		$output = '';
		$file   = '';
		if(@$request->promotionId){
			$promotionInfo = DB::table('promotion')->where(['status' => 1, 'id' => @$request->promotionId])->select('*')->first();
			
			if(!empty(@$promotionInfo->image) && file_exists('public/ads/'.@$promotionInfo->image.'')){
				$imageUrl = url('ads/'.@$promotionInfo->image.'');
			}else{
				$imageUrl = url('noimage.jpg');
			}
			
			if($promotionInfo->file_type == 1){
				$file = '<img class="w-100" src="'.@$imageUrl.'" alt="">';
			}elseif($promotionInfo->file_type == 2){
				$file = '<video class="w-100" src="'.@$imageUrl.'"></video>';
			}
			
			if(@$promotionInfo->user_id == 0){
				$username = 'Administrator';
				$profile  = url('profile/unnamed.jpg');
			}else{
				$userInfo = DB::table('users')->where(['id' => @$promotionInfo->user_id])->select('*')->first();
				$username = @$userInfo->first_name.' '.@$userInfo->last_name;
				
				if(!empty(@$userInfo->profile_image) && file_exists('public/profile/'.@$userInfo->profile_image.'')){
					$profile = url('profile/'.@$userInfo->profile_image.'');
				}else{
					$profile = url('noimage.jpg');
				}
			}
			
			$output = '<div class="row PromotionDetail">
                <div class="col-md-8 col-sm-12 PromotionImg">
                  '.$file.'
                </div>
                <div class="col-md-4 col-sm-12 PromotionData">
                  <img class="OwnerImg"
                    src="'.@$profile.'"
                    alt="">
                  <p class="TitleText">'.@$promotionInfo->ads_name.'</p>
                  <p class="OwnerText"><b>Owner:</b> '.@$username.'</p>
				  
                  <!--<ul>
                    <li>Tag Item</li>
                    <li>Tag Item</li>
                    <li>Tag</li>
                    <li>Tag Item</li>
                    <li>Tag Item</li>
                  </ul>-->
				  
                </div>
                <div class="col-md-12 col-sm-12 PromotionData">
                  <p class="BodyText">'.strip_tags(@$promotionInfo->description).'</p>
                </div>
              </div>';
			  
		}
		echo $output;
	}
	public function get_promotion_edit_detail(Request $request)
    {
		$promotionInfo = '';
		if(@$request->promotionId){
			$promotionInfo = DB::table('promotion')->where(['status' => 1, 'id' => @$request->promotionId])->select('*')->first();
		}
		echo json_encode($promotionInfo);
	}
	
	public function updateAds(Request $request)
    { 		
		$ads_name        = @$request->ads_name;
		//$url           = $request->url;
		$url             = '';
		//$description   = $request->description;
		$description     = '';
		$file_type       = @$request->file_type;
		$category        = @$request->category;
		$gender          = @$request->gender;
		$age             = @$request->age;
		$parental_status = @$request->parental_status;
		$income          = @$request->income;
		$location        = @$request->location;
		$latitude        = @$request->latitude;
		$longitude       = @$request->longitude;
		//$radius        = $request->radius;
		$radius          = '';
		$id              = @$request->id;
		
		if(!empty(@$request->places)){
			@$places = implode(',', @$request->places);
		}else{
			@$places = '';
		}
		
		//print_r($_FILES);die;
		if (!empty(@$request['ads_image']) && @$request['ads_image'] != 'undefined') {
            $img  = @$request['ads_image'];
            $extn = @$img->getClientOriginalExtension();
            $path = public_path('ads/');
            $file_name = rand() . '.' . $extn;
            $img->move($path, $file_name);
        } else {
			$file_name = '';
			$file = DB::table('promotion')->where(['id' => @$request->id])->select('*')->first();
			if(!empty($file)){
				if($file->image){
					$file_name = @$file->image;
				}
			}
            
        }
		
		
		$data = ['ads_name' => $ads_name, 'url' => $url, 'category' => $category, 'description' => $description, 'file_type' => @$file_type, 'image' => @$file_name, 'places' => @$places, 'gender' => @$gender, 'age_range' => @$age, 'parental_status' => @$parental_status, 'income' => $income, 'location' => $location, 'latitude' => $latitude, 'longitude' => $longitude, 'radius' => @$radius, 'updated_at' => date('Y-m-d H:i:s')];

		$result = DB::table('promotion')->where(['id' => @$id])->update(@$data);
		
		if($result){
			$response['status'] = 1;
			$response['msg'] = 'Ads updated successfully!';
			$response['adsId'] = $result;
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['adsId'] = '';
		}
		echo json_encode($response);	
    }
	
	
	public function delete_promotion($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('promotion')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('dashboard')->with("status", "Your promotion ads deleted successfully!");
		}else{
			return redirect()->intended('dashboard')->with("error", "Some error occure, Please try again!");
		} 
    }
	
	
	
	public function get_event_edit_detail(Request $request)
    {
		$eventInfo = '';
		$response  = [];
		if(@$request->eventId){
			$eventInfo = DB::table('events')->where(['status' => 1, 'id' => @$request->eventId])->select('*')->first();
			$response['event_name'] = $eventInfo->event_name;
			$response['location']   = $eventInfo->location;
			$response['latitude']   = $eventInfo->latitude;
			$response['longitude']  = $eventInfo->longitude;
			$response['country']    = $eventInfo->country;
			$response['state']      = $eventInfo->state;
			$response['city']       = $eventInfo->city;
			$response['zipcode']    = $eventInfo->zipcode;
			$response['description']    = $eventInfo->description;
			$response['category']    = $eventInfo->category;
			$response['phone']    = $eventInfo->phone;
			$response['email']    = $eventInfo->email;
			$response['website']  = $eventInfo->website;
			$response['id']       = $eventInfo->id;
			$response['date']    = date('Y-m-d', strtotime($eventInfo->start_date));
			$response['time']     = date('H:i:s', strtotime($eventInfo->start_date));
			
			if(@$eventInfo->tags){
				$exTags = explode(",", @$eventInfo->tags);
				foreach($exTags as $k => $v){
					$tagsArray[] = $v;
				}
			}
		}
		$response['tags'] = $tagsArray;
		echo json_encode($response);
	}
	
	public function updateEvent(Request $request)
    { 		
		//print_r($request->event_tags);die;
		if(@$request->event_tags){
			@$tags = implode(',', (array) @$request->event_tags);
		}else{
			@$tags = '';
		}
		
		$startDate = @$request->event_date.' '.@$request->event_time;
		$start_date = date('Y-m-d H:i:s', strtotime($startDate));
		
		//$endDate = $request->endDate.' '.$request->endTime;
		//$end_date = date('Y-m-d H:i:s', strtotime($endDate));
		
		$data = ['event_name' => @$request->event_name, 'description' => @$request->event_description, 'category' => @$request->event_category, 'start_date' => @$start_date, 'location' => @$request->event_address, 'country' => @$request->event_country, 'state'  => @$request->event_state, 'city' => @$request->event_city, 'latitude' => @$request->event_latitude, 'longitude' => @$request->event_longitude, 'zipcode' => @$request->event_zipcode, 'email' => @$request->event_email, 'phone' => @$request->event_phone, 'website' => @$request->event_website, 'tags' => @$tags, 'updated_at' => date('Y-m-d H:i:s')];
		
		//$result = DB::table('events')->insertGetId($data);
		$result = DB::table('events')->where(['id' => @$request->eventId])->update(@$data);
		
		if($result){
			
			if(!empty(@$request->eventTicket)){
				$i = 0;
				foreach(@$request->eventTicket as $k => $v){
					
					$academics = [
						'ticket_name'        => @$v['ticketName'],
						'ticket_price'       => @$v['ticketPrice'],
						'ticket_offer_price' => @$v['ticketOfferPrice'],
						'feature'            => @$v['ticketFeatures'],
						'event_id'           => @$request->eventId,
						'created_at'         => date('Y-m-d H:i:s'),
					];
					DB::table('event_ticket')->insertGetId($academics);
					$i++;
				}
			}
			
			$image = array();
			if($file = $request->file('event_image')){
				foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('events/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data  = ['image' => $image, 'event_id' => @$request->eventId, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('event_image')->insertGetId($data);
				}    
			}
	 
			$response['status'] = 1;
			$response['msg'] = 'Your event updated successfully.';
			$response['eventId'] = @$request->eventId;
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['eventId'] = '';
		}
		echo json_encode($response);	
    }
	
	public function delete_event($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('events')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('dashboard')->with("status", "Your event deleted successfully!");
		}else{
			return redirect()->intended('dashboard')->with("error", "Some error occure, Please try again!");
		} 
    }
	
	
	public function addRemoveBookmarkEvent(Request $request)
    { 		
	    $response = [];
	    if($request->eventId){
			$eventId = $request->eventId;
			$userId  = session()->get('USERLOGINID');
			
			$numRows = DB::table('favouriteevent')->where(['user_id' => @$userId, 'event_id' => @$eventId])->select('*')->orderBy('id', 'DESC')->count();
			
			if($numRows ==0){
				$myfavview=array(
					'user_id'    => @$userId,
					'event_id'   => @$eventId,
					'created_at' => date("Y-m-d H:i:s")
				);
				$result = DB::table('favouriteevent')->insertGetId($myfavview);
				if($result){
					$response = ["status" => 1, "message" => "Successfully added in favourite list."];
					//return response()->json($response, 200);
				}
			}else{
				$blockwhere = array( 
					'user_id'  => @$userId,
					'event_id' => @$eventId
				); 
				$result = DB::table('favouriteevent')->where($blockwhere)->delete();
				if($result){
					$response = ["status" => 2, "message" => "Successfully removed from favourite list."];
					//return response()->json($response, 200);
				}
			}
			
		}
		
		echo json_encode($response);
	}
	
	public function get_event_detail(Request $request)
    {
		
		$output = '';
		$file   = '';
		$gallaryBlock   = '';
		if(@$request->eventId){
			$eventInfo = DB::table('events')->where(['status' => 1, 'id' => @$request->eventId])->select('*')->first();
			
			$image_1  = DB::table('event_image')->where(['event_id' => @$eventInfo->id])->select('*')->orderBy('id', 'DESC')->first();
			
			if(!empty(@$image_1->image) && file_exists('public/events/'.@$image_1->image.'')){
				$imageUrl = url('events/'.@$image_1->image.'');
			}else{
				$imageUrl = url('noimage.jpg');
			}
			
			// if($promotionInfo->file_type == 1){
				// $file = '<img class="w-100" src="'.@$imageUrl.'" alt="">';
			// }elseif($promotionInfo->file_type == 2){
				// $file = '<video class="w-100" src="'.@$imageUrl.'"></video>';
			// }
			
			if(@$eventInfo->user_id == 0){
				$username = 'Administrator';
				$profile  = url('profile/unnamed.jpg');
			}else{
				$userInfo = DB::table('users')->where(['id' => @$eventInfo->user_id])->select('*')->first();
				$username = @$userInfo->first_name.' '.@$userInfo->last_name;
				
				if(!empty(@$userInfo->profile_image) && file_exists('public/profile/'.@$userInfo->profile_image.'')){
					$profile = url('profile/'.@$userInfo->profile_image.'');
				}else{
					$profile = url('noimage.jpg');
				}
			}
			
			$tagsConcate = '';
			if(!empty(@$eventInfo->tags)){
				$tagsId = explode(',', @$eventInfo->tags);
				foreach($tagsId as $tagKey => $tagVal){
					$tags  = DB::table('tags')->where(['id' => @$tagVal])->select('*')->orderBy('id', 'ASC')->first();
					//print_r($tags);die;
					$tagsConcate.='<li>'.@$tags->name.'</li>';
				}
			}
			
			$startDate  = $eventInfo->start_date;
			$start_date = date('Y-m-d', strtotime($startDate));
			$start_time = date('H:i:s', strtotime($startDate));
			
			$eventImg  = DB::table('event_image')->where(['event_id' => @$eventInfo->id])->select('*')->orderBy('id', 'DESC')->get();
			if(count($eventImg) > 0){
				foreach($eventImg as $imgKey => $imgVal){
					
					if(!empty(@$imgVal->image) && file_exists('public/events/'.@$imgVal->image.'')){
						$imageUrl_1 = url('events/'.@$imgVal->image.'');
					}else{
						$imageUrl_1 = url('noimage.jpg');
					}
					
					$gallaryBlock.= '
						<a href="javascript:void(0);" class="eventsPhotos" relid="'.@$eventInfo->id.'" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
						  <img
							src="'.@$imageUrl_1.'"
							alt="">
						</a>
					';
					
				}
			}
			
			$photoSection = '';
			if(!empty(@$gallaryBlock)){
				$photoSection='<div class="col-md-12 col-sm-12 PeopleContainer mt-2">
					<div class="TopSection">
						<p>Photos</p>
						<a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
							<img src="'.url('assets/home/images/Icon6.png').'" alt="">
						</a>
					</div>
					<div class="EventPhotoContainer">
						'.@$gallaryBlock.'
					</div>
				</div>';
			}
			
			$inviteeProfile = '';
			$inviteeId = [];
			$invitation  = DB::table('invitation')->where(['event_id' => @$eventInfo->id])->select('*')->get();
			if(count($invitation) > 0){
				foreach($invitation as $k => $v){
					$get_receiverInfo  = DB::table('repeat_invitation')->where(['invitation_id' => @$v->id])->select('*')->first();                    if(@$get_receiverInfo){						if(@$get_receiverInfo->receiver_id){							$inviteeId[] = @$get_receiverInfo->receiver_id;						}					}
				}
			}
			
			
			if(@$request->block == 'one'){
				 $block = '';
			}else{
				$block = '<div class="d-flex flex-row gap-3">
                        <a href="" data-bs-toggle="modal" data-bs-target="#EventInvitedModal" class="inviteeUserModel" relid-event="'.@$eventInfo->id.'">
                          <img src="'.url('assets/home/images/Icon7.png').'" alt="">
                        </a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#EventInvitedModal" class="inviteeUserModel" relid-event="'.@$eventInfo->id.'">
                          <img src="'.url('assets/home/images/Icon6.png').'" alt="">
                        </a>
                      </div>';
			}
			
			if(count($inviteeId) > 0){
				$inviteeId = array_unique($inviteeId);
				$eventAttendeeId = join(",", $inviteeId);
				
				$attendeeUser = DB::table('users')->whereRaw("status = 1 AND id IN($eventAttendeeId)")->select('*')->orderBy('id', 'ASC')->get();
				if(count($attendeeUser) > 0){
					
					$i = 1;
					foreach($attendeeUser as $k => $v){
						
						if(@$i == 1){
							$class = '';
						}else{
							$class = 'position-absolute z-1';
						}
						
						if(!empty(@$v->profile_image) && file_exists('public/profile/'.@$v->profile_image.'')){
						    $profile_1 = url('profile/'.@$v->profile_image.'');
						}else{
							$profile_1  = url('profile/unnamed.jpg');
						}
						
						//$inviteeProfile.='';
						
						
						$inviteeProfile.='<div class="PeopleContainer">
							<div class="TopSection">
							<p>Invited People</p>
							    '.@$block.'
							</div>
							<div class="PhotoSection">
							    <img class="'.@$class.'" src="'.@$profile_1.'" alt="" >
							</div>
						</div>';
				  
						$i++;
					}
				}else{
					$inviteeProfile='';
				}
			}else{
				$inviteeProfile='';
			}
			
			
			
			$output = '<div class="row PromotionDetail">
                <div class="col-md-8 col-sm-12 PromotionImg">
                  <img class="w-100" src="'.@$imageUrl.'" alt="">
                </div>
                <div class="col-md-4 col-sm-12 PromotionData">
                  <img class="OwnerImg"
                    src="'.@$profile.'"
                    alt="">
                  <p class="TitleText">'.@$eventInfo->event_name.'</p>
                  <p class="OwnerText"><b>Owner:</b> '.@$username.'</p>
				  
				   <p class="OwnerText"><b>Location:</b> '.@$eventInfo->location.'</p>
				  <p class="OwnerText"><b>Date:</b> '.@$startDate.'</p>
				  <p class="OwnerText"><b>Time:</b> '.@$start_time.'</p>
				  
                  <ul>
                    '.@$tagsConcate.'
                  </ul>
				  
				  '.@$inviteeProfile.'
                </div>
                
				
				<div class="col-md-12 col-sm-12 PromotionData">
                  <p class="BodyText">'.strip_tags(@$eventInfo->description).'</p>
                </div>
				
				'.@$photoSection.'	
              </div>
			  ';
			  
		}
		echo $output;
	}
	public function get_event_image_gallery(Request $request)
    {
		$output        = '';
		$galleryPhotos = '';
		if(@$request->eventId){
			$eventImg  = DB::table('event_image')->where(['event_id' => @$request->eventId])->select('*')->orderBy('id', 'ASC')->get();
			if(count($eventImg) > 0){								$i = 1;
				foreach($eventImg as $imgKey => $imgVal){					
					if(!empty(@$imgVal->image) && file_exists('public/events/'.@$imgVal->image.'')){
						$imageUrl_1 = url('events/'.@$imgVal->image.'');
					}else{
						$imageUrl_1 = url('noimage.jpg');
					}
					$galleryPhotos.='
						<div class="carousel-item '.((@$i == 1) ? 'active' : '').'">						    <img style="height: 75vh;" src="'.@$imageUrl_1.'" class="d-block w-100" alt="">
						</div>
					';					$i++;
				}	
				
				$output= '
					<div class="row PromotionDetail">
						<div class="col-md-12 col-sm-12 PromotionImg">
						  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-inner"> 
							  '.@$galleryPhotos.'
							</div>
							<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
							  data-bs-slide="prev">
							  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
							  data-bs-slide="next">
							  <span class="carousel-control-next-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Next</span>
							</button>
						  </div>
						</div>
					  </div>
				';	
			}
		}
		echo $output;
	}
	
	public function get_payment_list(Request $request){
		$paymentList = '';
		$output      = '';
		
		if($request->userId){
			
			$subList  = DB::table('transaction')->where(['user_id' => @$request->userId, 'payment_type' => 1])->select('*')->orderBy('id', 'DESC')->get();
			
			if(count($subList) > 0){
				foreach($subList as $k => $v){
					$status = '';
					// if($v->status == 'succeeded'){
						// $status = 'Success';
					// }
					
					if(@$v->expiry_date >= date('Y-m-d')){
						$status = 'Activated';
					}elseif(@$v->expiry_date < date('Y-m-d')){
						$status = 'Expired';
					}else{ 
						$status = '';
					}
					
					$paymentList.='
						<div class="col-lg-4 col-md-4 ps-0 mb-4">
						  <div class="TransactionBlock">
							<div class="TransactionData">
							  <img src="'.url('assets/home/images/CompleteIcon.png').'" alt="">
							  <div class="TransactionTextdata">
								<p class="m-0">Payment order #'.@$v->order_id.'</p>
								<p class="m-0">'.date('M d, Y', strtotime(@$v->created_at)).' - '.date('M d, Y', strtotime(@$v->expiry_date)).'</p>
								<p class="m-0">'.@$status.'</p>
							  </div>
							</div>
							<p class="TransactionAmount">$'.@$v->amount.'</p>
						  </div>
						</div>
					';
				}
			}else{
				$paymentList = 'Not found any subscription list';
			}
			
			$output = '
			    <div class="row m-0">
                '.@$paymentList.'
              </div>
			';
		}
		echo $output;
	}
	
	public function addRemoveBookmarkBusiness(Request $request)
    { 		
	    $response = [];
	    if($request->businessId){
			$businessId = $request->businessId;
			$userId  = session()->get('USERLOGINID');
			
			$numRows = DB::table('favouritebusiness')->where(['user_id' => @$userId, 'listing_id' => @$businessId])->select('*')->orderBy('id', 'DESC')->count();
			
			if($numRows ==0){
				$myfavview=array(
					'user_id'    => @$userId,
					'listing_id'   => @$businessId,
					'created_at' => date("Y-m-d H:i:s")
				);
				$result = DB::table('favouritebusiness')->insertGetId($myfavview);
				if($result){
					$response = ["status" => 1, "message" => "Successfully added in favourite list."];
					//return response()->json($response, 200);
				}
			}else{
				$blockwhere = array( 
					'user_id'  => @$userId,
					'listing_id' => @$businessId
				); 
				$result = DB::table('favouritebusiness')->where($blockwhere)->delete();
				if($result){
					$response = ["status" => 2, "message" => "Successfully removed from favourite list."];
					//return response()->json($response, 200);
				}
			}
			
		}
		
		echo json_encode($response);
	}
	
	
	public function get_business_detail(Request $request)
    {
		$output = '';
		$file   = '';
		$gallaryBlock   = '';
		$productOutPut   = '';
		$serviceOutPut   = '';
		if(@$request->businessId){
			$listingInfo = DB::table('listing')->where(['status' => 1, 'id' => @$request->businessId])->select('*')->first();
			
			$image_1  = DB::table('listing_image')->where(['listing_id' => @$listingInfo->id])->select('*')->orderBy('id', 'DESC')->first();
			
			if(!empty(@$image_1->image) && file_exists('public/listing/'.@$image_1->image.'')){
				$imageUrl = url('listing/'.@$image_1->image.'');
			}else{
				$imageUrl = url('noimage.jpg');
			}
			
			// if($promotionInfo->file_type == 1){
				// $file = '<img class="w-100" src="'.@$imageUrl.'" alt="">';
			// }elseif($promotionInfo->file_type == 2){
				// $file = '<video class="w-100" src="'.@$imageUrl.'"></video>';
			// }
			
			if(@$listingInfo->user_id == 0){
				$username = 'Administrator';
				$profile  = url('profile/unnamed.jpg');
			}else{
				$userInfo = DB::table('users')->where(['id' => @$listingInfo->user_id])->select('*')->first();
				$username = @$userInfo->first_name.' '.@$userInfo->last_name;
				
				if(!empty(@$userInfo->profile_image) && file_exists('public/profile/'.@$userInfo->profile_image.'')){
					$profile = url('profile/'.@$userInfo->profile_image.'');
				}else{
					$profile = url('noimage.jpg');
				}
			}
			
			$tagsConcate = '';
			if(!empty(@$listingInfo->tags)){
				$tagsId = explode(',', @$listingInfo->tags);
				foreach($tagsId as $tagKey => $tagVal){
					//$tags  = DB::table('tags')->where(['id' => @$tagVal])->select('*')->orderBy('id', 'ASC')->first();
					//print_r($tags);die;
					$tagsConcate.='<li>'.@$tagVal.'</li>';
				}
			}
			
			// $startDate  = @$listingInfo->start_date;
			// $start_date = date('Y-m-d', strtotime($startDate));
			// $start_time = date('H:i:s', strtotime($startDate));
			
			$listingImg  = DB::table('listing_image')->where(['listing_id' => @$listingInfo->id])->select('*')->orderBy('id', 'DESC')->get();
			if(count($listingImg) > 0){
				foreach($listingImg as $imgKey => $imgVal){
					
					if(!empty(@$imgVal->image) && file_exists('public/listing/'.@$imgVal->image.'')){
						$imageUrl_1 = url('listing/'.@$imgVal->image.'');
					}else{
						$imageUrl_1 = url('noimage.jpg');
					}
					
					$gallaryBlock.= '
						<a href="javascript:void(0);" class="businessPhotos" relid="'.@$listingInfo->id.'" data-bs-toggle="modal" data-bs-target="#BusinessPhotosModal">
						  <img
							src="'.@$imageUrl_1.'"
							alt="">
						</a>
					';
					
				}
			}
			
			$photoSection = '';
			if(!empty(@$gallaryBlock)){
				$photoSection = '<div class="col-md-12 col-sm-12 PeopleContainer mt-2">
					<div class="TopSection">
						<p>Photos</p>
						<a href="javascript:void(0);" class="businessPhotos" relid="'.@$listingInfo->id.'" data-bs-toggle="modal" data-bs-target="#BusinessPhotosModal">
							<img src="'.url('assets/home/images/Icon6.png').'" alt="">
						</a>
					</div>
					<div class="EventPhotoContainer">
						'.@$gallaryBlock.'
					</div>
				</div>';
			}
			
			$productList  = DB::table('product')->where(['listing_id' => @$listingInfo->id])->select('*')->orderBy('id', 'DESC')->get();
			
			if(count($productList) > 0){
				foreach($productList as $k => $v){
					
					$proImg  = DB::table('product_image')->where(['product_id' => @$v->id])->select('*')->orderBy('id', 'ASC')->first();
						
					if(!empty($proImg)){
						if(!empty($proImg->image) && file_exists('public/product/'.$proImg->image.'')){
							$productImg = url('product/'.$proImg->image.'');
						}else{
							$productImg = url('noimage.jpg');
						}
					}else{
						$productImg = url('noimage.jpg');
					}
					
					if(@$v->user_id == session()->get('USERLOGINID')){
						$addTocart = '';
					}else{
						$addTocart = '<a href="javascript:void(0);" class="AddToCartBlock AddToCartNotify" relid="'.@$v->id.'" specipication="product">
							<img class="ColorIcon" src="'.url('assets/home/images/NavIcon6.png').'" alt="">
							<img class="WhiteIcon" src="'.url('assets/home/images/Icon26.png').'" alt="">
						</a>';
					}
					
					// $addTocart = '<a href="javascript:void(0);" class="AddToCartBlock AddToCartNotify" relid="'.@$v->id.'" specipication="product">
							// <img class="ColorIcon" src="'.url('assets/home/images/NavIcon6.png').'" alt="">
							// <img class="WhiteIcon" src="'.url('assets/home/images/Icon26.png').'" alt="">
						// </a>';
					$productOutPut.='
						<div class="ProductBlock ps-0 product-details" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#ProductDetailsModal"
						style="cursor: pointer;">
						<img src="'.@$productImg.'" alt="">
							<div class="ProductTextBlock">
									'.@$addTocart.'
								<p class="m-0 Heading">'.substr(@$v->name,0,15).'</p> 
								<p class="m-0 Price">$'.@$v->price.'</p>
							</div>
						</div>
					';
				}
			}else{
				$productOutPut = '';
			}
			
			$serviceList  = DB::table('services')->where(['listing_id' => @$listingInfo->id])->select('*')->orderBy('id', 'DESC')->get();
			if(count($serviceList) > 0){
				foreach($serviceList as $k => $v){
					
					$serImg  = DB::table('services_image')->where(['service_id' => @$v->id])->select('*')->orderBy('id', 'ASC')->first();
						
					if(!empty($serImg)){
						if(!empty($serImg->image) && file_exists('public/service/'.$serImg->image.'')){
							$serviceImg = url('service/'.$serImg->image.'');
						}else{
							$serviceImg = url('noimage.jpg');
						}
					}else{
						$serviceImg = url('noimage.jpg');
					}
					
					if(@$v->user_id == session()->get('USERLOGINID')){
						$addTocart = '';
					}else{
						$addTocart = '<a href="javascript:void(0);" class="AddToCartBlock AddToCartNotify" relid="'.@$v->id.'" specipication="service">
							<img class="ColorIcon" src="'.url('assets/home/images/NavIcon6.png').'" alt="">
							<img class="WhiteIcon" src="'.url('assets/home/images/Icon26.png').'" alt="">
						</a>';
					}		
					$serviceOutPut.='
						<div class="ProductBlock ps-0 service-details" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#ServiceDetailsModal"
                        style="cursor: pointer;">
                        <img src="'.@$serviceImg.'" alt="">
                        <div class="ProductTextBlock">
						    '.@$addTocart.'
                          <p class="m-0 Heading">'.substr(@$v->name,0,15).'</p>
                          <p class="m-0 Price">$'.@$v->price.'</p>
                        </div>
                      </div>
					';
				}
			}else{
				$serviceOutPut = '';
			}
			
			$productORService = '';
			if(!empty(@$serviceOutPut) || !empty(@$productOutPut)){
				$productORService = '<div class="col-md-12 col-sm-12 PeopleContainer mt-2">
                  <div class="PeopleContainer">
						<div class="TopSection mb-0">
							<p>Products & Services</p>
							<div class="d-flex flex-row gap-3">
								<!--<a href="">
								<i class="fa fa-plus" aria-hidden="true" style="color: #b48a42;"></i>
								</a>
								<a href="" data-bs-toggle="modal" data-bs-target="#BusinessPSModal">
								<img src="'.url('assets/home/images/Icon6.png').'" alt="">
								</a>-->
							</div>
						</div>
					
						<div class="ProductServiceSection ps-0">
						    '.@$productOutPut.'
						</div>
						<div class="ProductServiceSection ps-0">
						    '.@$serviceOutPut.'
						</div>
                  </div>
                </div>';
			}
			
			$output = '<div class="row PromotionDetail">
                <div class="col-md-8 col-sm-12 PromotionImg position-relative">
				<div class="ProductIconContainer">
                    <a href="" class="QRBlock" data-bs-toggle="modal" data-bs-target="#BusinessQRModal">
                      <img class="QRImg" src="'.url('assets/home/images/Icon27.png').'" alt="">
                    </a>
                  </div>
                  <img class="w-100" src="'.@$imageUrl.'" alt="">
                </div>
                <div class="col-md-4 col-sm-12 PromotionData">
                  <img class="OwnerImg"
                    src="'.@$profile.'"
                    alt="">
                  <p class="TitleText">'.@$listingInfo->business_name.'</p>
                  <p class="OwnerText"><b>Owner:</b> '.@$username.'</p>
				  
				   <p class="OwnerText"><b>Location:</b> '.@$listingInfo->address.'</p>
				   <p class="OwnerText"><b>Phone:</b> '.@$listingInfo->phone.'</p>
				   <p class="OwnerText"><b>Email:</b> '.@$listingInfo->email.'</p>
				   <p class="OwnerText"><b>Website:</b> '.@$listingInfo->website.'</p>
				  <!--<p class="OwnerText"><b>Date:</b> '.@$startDate.'</p>
				  <p class="OwnerText"><b>Time:</b> '.@$start_time.'</p>-->
				  
                  <ul>
                    '.@$tagsConcate.'
                  </ul>
				  
				  <!--<div class="PeopleContainer">
                    <div class="TopSection">
                      <p>Invited People</p>
                      <div class="d-flex flex-row gap-3">
                        <a href="" data-bs-toggle="modal" data-bs-target="#EventInvitedModal">
                          <img src="'.url('assets/home/images/Icon7.png').'" alt="">
                        </a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#EventInvitedModal">
                          <img src="'.url('assets/home/images/Icon6.png').'" alt="">
                        </a>
                      </div>
                    </div>
                    <div class="PhotoSection">
                      <img
                        src="https://images.unsplash.com/photo-1541271696563-3be2f555fc4e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/pleasant-looking-teenage-girl-wears-comfortable-hoodie-had-combed-dark-hair-looks-camera-with-little-smile_273609-38963.jpg?t=st=1731403649~exp=1731407249~hmac=963e1e2f465e3a549ade5f6d2b1a1c76cd808d814e09a26492d113f093c98df9&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/happy-ethnic-teenager-with-afro-hair-smiles-positively-wears-purple-hoodie-being-good-mood_273609-46758.jpg?t=st=1731403690~exp=1731407290~hmac=897578c7d33f1e3ec028b597051e6fd4d50f34983a8216b006cbe6470479bcc6&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/view-female-soccer-player_23-2150888397.jpg?t=st=1731403756~exp=1731407356~hmac=4056b8a1fc9e97b53ad916d89700567781e74de02d93a20828a84245bcc2b240&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/close-up-woman-portrait-new-york_23-2150868218.jpg?t=st=1731403874~exp=1731407474~hmac=4b89bc31aa4d76a4a7861e2904825b05b0c42a47cccfa13bfe5ea4be52198ecf&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/international-day-education-celebration_23-2150931022.jpg?t=st=1731403870~exp=1731407470~hmac=286b5917d5d08c0f5291a305bf2ea8abda079436000dcaa1fdb7b536cb1bbf2c&w=826"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/portrait-elegant-professional-businesswoman_23-2150917246.jpg?t=st=1731403456~exp=1731407056~hmac=709ab44fb2fe8a9c29b06e38c60ffa2dade979f272ab9821233ddfc73a4481a0&w=826"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/confident-young-businesswoman-smiling-looking-camera-indoors-generated-by-artificial-intelligence_188544-125559.jpg?t=st=1731403789~exp=1731407389~hmac=63d2f919b22ce1bc0a1ebbf081b67b0120c62ddc96a22e20802a9dcb22ec9f5d&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/female-freelancer-portrait_1409-7005.jpg?t=st=1731403923~exp=1731407523~hmac=cac4092395d9d3bed18406c8be637fd00d88f7cccb769cf62cc6ea24c68bcc3b&w=1380"
                        alt="">
                      <span class="PhotoCount">
                        <p>+5</p>
                      </span>
                    </div>-->
                  </div>
				  
                </div>
				
				'.@$productORService.'
				
                
				
					<div class="col-md-12 col-sm-12 PromotionData">
					  <p class="BodyText">'.strip_tags(@$listingInfo->description).'</p>
					</div>
					
					'.@$photoSection.'
				
				</div>
			  ';
			  
		}
		echo $output;
	}
	
	public function get_business_image_gallery(Request $request)
    {
		$output        = '';
		$galleryPhotos = '';
		
		if(@$request->businessId){
			$listingImg  = DB::table('listing_image')->where(['listing_id' => @$request->businessId])->select('*')->orderBy('id', 'ASC')->get();
			if(count($listingImg) > 0){
				foreach($listingImg as $imgKey => $imgVal){
					
					if(!empty(@$imgVal->image) && file_exists('public/listing/'.@$imgVal->image.'')){
						$imageUrl_1 = url('listing/'.@$imgVal->image.'');
					}else{
						$imageUrl_1 = url('noimage.jpg');
					}
					
					$galleryPhotos.='
						<div class="carousel-item active">
							<img style="height: 75vh;"
							  src="'.@$imageUrl_1.'"
							  class="d-block w-100" alt="">
						</div>
					';
				}	
				
				$output= '
					<div class="row PromotionDetail">
						<div class="col-md-12 col-sm-12 PromotionImg">
						  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
						  
							<div class="carousel-inner">
							  
							  '.@$galleryPhotos.'
							  
							 
							</div>
							
							<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
							  data-bs-slide="prev">
							  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
							  data-bs-slide="next">
							  <span class="carousel-control-next-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Next</span>
							</button>
						  </div>
						</div>
					  </div>
				';
					
			}
		}
		echo $output;
	}
	
	public function addBusiness(Request $request)
    { 		
	    
		
		$listing_business_name = @$request->business_name;
		$listing_name   = @$request->name;
		$country        = @$request->business_country;
		$state          = @$request->business_state;
		$city           = @$request->business_city;
		$onlineBusiness = 0;
		$chk_address    = 0;
		$address        = @$request->business_address;
		$latitude       = @$request->business_latitude;
		$longitude      = @$request->business_longitude;
		$description    = @$request->business_description;
		$phone          = @$request->business_phone;
		$email          = @$request->business_email;
		$website        = @$request->business_website;
		$category       = @$request->business_category;
		$subcategory    = 0;
		$userId         = @$request->business_userId;
		$tags           = @$request->business_tags;
		
		
		/*$accessList = DB::table('sub_permision_menu')->where(['sub_id' => @$this->SUBID, 'menu_id' => 1])->select('number_of')->first();
		if(!empty(@$accessList)){
			$userCountBusiness = DB::table('listing')->where(['user_id' => session()->get('USERLOGINID')])->select('*')->count();
			if(@$accessList->number_of > @$userCountBusiness){
				
			}else{
				$response['status'] = 0;
			    $response['msg'] = 'Your business adding limit is over now.';
				echo json_encode($response);exit();	
			}
		}*/
		
		if(@$request->add_product_or_not == 1){
			$stripe  = DB::table('stripe_connect')->where(['userId' => session()->get('USERLOGINID')])->select('*')->first();
			if($stripe){
			    $stripecon = $this->get_stripe_info($stripe->stripe_acc_id);
				if($stripecon == 1){
					
				}else{
					$response['status'] = 2;
					$response['msg'] = 'Please connect your stripe.If you want to add product or services.';
					echo json_encode($response);exit();	
				}
			}else{
				$response['status'] = 2;
				$response['msg'] = 'Please connect your stripe.If you want to add product or services.';
				echo json_encode($response);exit();	
			}
		} 
		
		$accessList = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->select('businessCount')->first();
		if(!empty(@$accessList)){
			if(@$accessList->businessCount > 0){
				
			}else{
				$response['status'] = 0;
			    $response['msg'] = 'Your business adding limit is over now.';
				echo json_encode($response);exit();	
			}
		}
		
		
		
		
		
		$data = ['business_name' => @$listing_business_name, 'name' => @$listing_name, 'country' => @$country, 'city' => @$city, 'state' => @$state, 'online_busi' => @$onlineBusiness, 'address' => @$address, 'latitude' => @$latitude, 'longitude' => @$longitude, 'description' => @$description, 'phone' => @$phone, 'email' => @$email, 'website' => @$website, 'google_map_address' => @$chk_address, 'status' => 1, 'category' => @$category, 'subcategory' => @$subcategory, 'user_id' => @$userId, 'tags' => @$tags, 'created_at' => date('Y-m-d H:i:s')];
		$result = DB::table('listing')->insertGetId($data);
		if($result){
		    $image = array();
		    if($file = $request->file('business_image')){
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext        = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path    = public_path('listing/');
					$image_url       = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data  = ['image' => $image, 'listing_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('listing_image')->insertGetId($data);
			    }    
		    }
			
			DB::table('users')->where(['id' => session()->get('USERLOGINID')])->update(['businessCount' => DB::raw('businessCount-1')]);
		  
			$response['status'] = 1;
			$response['msg'] = 'Your business listing added successfully.';
			$response['businessId'] = @$result;
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['businessId'] = '';
		}
		echo json_encode($response);	
    }
	
	public function get_business_edit_detail(Request $request)
    {
		$businessInfo = '';
		$response  = [];
		if(@$request->businessId){
			$businessInfo = DB::table('listing')->where(['status' => 1, 'id' => @$request->businessId])->select('*')->first();
			$response['business_name'] = $businessInfo->business_name;
			$response['name'] = $businessInfo->name;
			$response['address']      = $businessInfo->address;
			$response['latitude']     = $businessInfo->latitude;
			$response['longitude']    = $businessInfo->longitude;
			$response['country']      = $businessInfo->country;
			$response['state']        = $businessInfo->state;
			$response['city']         = $businessInfo->city;
			$response['zipcode']      = $businessInfo->zipcode;
			$response['description']  = $businessInfo->description;
			$response['category']     = $businessInfo->category;
			$response['phone']        = $businessInfo->phone;
			$response['email']        = $businessInfo->email;
			$response['website']      = $businessInfo->website;
			$response['id']           = $businessInfo->id;
			$response['tags']         = $businessInfo->tags;
		}
		echo json_encode($response);
	}
	
	public function get_service_edit_detail(Request $request)
    {
		$businessInfo = '';
		$response  = [];
		if(@$request->serviceId){
			$businessInfo = DB::table('services')->where(['status' => 1, 'id' => @$request->serviceId])->select('*')->first();
			$response['name'] = $businessInfo->name;
			$response['category']      = $businessInfo->category;
			$response['listing_id']     = $businessInfo->listing_id;
			$response['price']    = $businessInfo->price;
			$response['description']      = $businessInfo->description;
			$response['tags']        = $businessInfo->tags;
			$response['id']        = $businessInfo->id;
	
		}
		echo json_encode($response);
	}
	
	public function get_product_edit_detail(Request $request)
    {
		$businessInfo = '';
		$response  = [];
		if(@$request->productId){
			$businessInfo = DB::table('product')->where(['status' => 1, 'id' => @$request->productId])->select('*')->first();
			$response['name'] = $businessInfo->name;
			$response['category']      = $businessInfo->category;
			$response['listing_id']     = $businessInfo->listing_id;
			$response['price']    = $businessInfo->price;
			$response['description']      = $businessInfo->description;
			$response['tags']        = $businessInfo->tags;
			$response['id']        = $businessInfo->id;
	
		}
		echo json_encode($response);
	}
	
	public function updateBusiness(Request $request)
    { 		
	
		$listing_business_name = @$request->business_name;
		$listing_name          = @$request->name;
		$country   = @$request->business_country;
		$state     = @$request->business_state;
		$city      = @$request->business_city;
		$onlineBusiness = 0;
		
		$chk_address = 0;
		
		$address     = @$request->business_address;
		$latitude    = @$request->business_latitude;
		$longitude   = @$request->business_longitude;
		$description = @$request->business_description;
		$phone       = @$request->business_phone;
		$email       = @$request->business_email;
		$website     = @$request->business_website;
		$category    = @$request->business_category;
		$tags        = @$request->business_tags;
		$subcategory = 0;
		//$userId    = @$request->business_userId;
		
		$data = ['business_name' => @$listing_business_name, 'name' => @$listing_name, 'country' => @$country, 'city' => @$city, 'state' => @$state, 'online_busi' => @$onlineBusiness, 'address' => @$address, 'latitude' => @$latitude, 'longitude' => @$longitude, 'description' => @$description, 'phone' => @$phone, 'email' => @$email, 'website' => @$website, 'google_map_address' => @$chk_address, 'category' => @$category, 'subcategory' => @$subcategory, 'tags' => @$tags, 'updated_at' => date('Y-m-d H:i:s')];
		
		$result = DB::table('listing')->where(['id' => @$request->businessId])->update(@$data);
		if($result){
		    $image = array();
		    if($file = $request->file('business_image')){
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext        = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path    = public_path('listing/');
					$image_url       = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data  = ['image' => $image, 'listing_id' => @$request->businessId, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('listing_image')->insertGetId($data);
			    }    
		    }
		  
			$response['status'] = 1;
			$response['msg'] = 'Your business listing updated successfully.';
			$response['businessId'] = @$request->businessId;
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['businessId'] = '';
		}
		echo json_encode($response);	
    }
	
	public function delete_business($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('listing')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('dashboard')->with("status", "Your business listing deleted successfully!");
		}else{
			return redirect()->intended('dashboard')->with("error", "Some error occure, Please try again!");
		} 
    }
	
	public function addProductCat(Request $request)
    { 
	    $response = [];
	    if($request->cat_name){
			$count = DB::table('product_category')->where(['name' => @$request->cat_name])->select('*')->orderBy('id', 'ASC')->count();
			if($count > 0){
				$response['status'] = 0;
				$response['msg'] = 'category already exist.';
			}else{
				$data = ['name' => @$request->cat_name, 'status' => 1, 'created_at' => date('Y-m-d H:i:s')];
				$result = DB::table('product_category')->insertGetId($data);
				if($result){
					$response['status'] = 1;
					$response['msg'] = 'category added successfully.';
				}else{
					$response['status'] = 0;
					$response['msg'] = 'Some error occure, Please try again.';
				}
			}
		}
		echo json_encode($response);
	}
	
	public function get_product_category(Request $request)
    {
		$output = '';
		$product = DB::table('product_category')->select('*')->orderBy('name', 'ASC')->get();
		if(count($product) > 0){
			foreach($product as $k => $v){
				$output.='<option value="'.@$v->id.'">'.@$v->name.'</option>';
			}
		}
		echo $output;
	}
	
	public function addProduct(Request $request)
    {
		
		$response = [];
		$product_name         = @$request->product_name;
		$product_category     = @$request->product_category;
		$product_price        = @$request->product_price;
		$product_special      = 0;
		$product_quantity     = 0;
		$product_availability = 0;
		$product_description  = @$request->product_description;
		$product_status       = 1;
		$product_listing      = @$request->product_listing;
		$product_tags         = @$request->product_tags;
		$product_subcategory  = 0;
		

		
		$data = ['name' => @$product_name, 'category' => @$product_category, 'subcategory' => @$product_subcategory, 'listing_id' => @$product_listing, 'price' => @$product_price, 'special_price' => @$product_special, 'quantity' => @$product_quantity, 'availability' => @$product_availability, 'description' => @$product_description, 'status' => @$product_status, 'tags' => @$product_tags, 'user_id' => session()->get('USERLOGINID'), 'created_at' => date('Y-m-d H:i:s')];
		$result = DB::table('product')->insertGetId($data);
		if($result){
			//print_r($_FILES);die;
		    $image = array();
		    if($file = $request->file('product_image')){
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('product/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data = ['image' => $image, 'product_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('product_image')->insertGetId($data);
			    }    
		    }
			$response['status'] = 1;
			$response['msg'] = 'Your product added successfully.';
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
		}
		
		echo json_encode($response);
	}
	
	public function addService(Request $request)
    {
		$response = [];
		
		$service_name         = @$request->service_name;
		$service_category     = @$request->service_category;
		$service_price        = @$request->service_price;
		$service_tags         = @$request->service_tags;
		$service_special      = 0;
		$service_description  = @$request->service_description;
		$service_status       = 1;
		$service_listing      = @$request->service_listing_id;

		

		
		$data = ['name' => $service_name, 'category' => $service_category, 'listing_id' => $service_listing, 'price' => $service_price, 'special_price' => @$service_special, 'description' => $service_description, 'status' => $service_status, 'user_id' => session()->get('USERLOGINID'), 'created_at' => date('Y-m-d H:i:s')];
		$result = DB::table('services')->insertGetId($data);
		if($result){
			//print_r($_FILES);die;
		    $image = array();
		    if($file = $request->file('service_image')){
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('service/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data = ['image' => $image, 'service_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('services_image')->insertGetId($data);
			    }    
		    }
			//return redirect()->intended('admin/services')->with("status", "Your services added successfully!");
			$response['status'] = 1;
			$response['msg'] = 'Your services added successfully!';
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
		}
		echo json_encode($response);
	}
	
	public function editService(Request $request)
    {
		$response = [];
		
		$service_name         = @$request->service_name;
		$service_category     = @$request->service_category;
		$service_price        = @$request->service_price;
		$service_tags         = @$request->service_tags;
		$service_special      = 0;
		$service_description  = @$request->service_description;
		$service_status       = 1;
		$service_listing      = @$request->service_listing_id;
		$edit_service_id      = @$request->edit_service_id;

		

		
		$data = ['name' => $service_name, 'category' => $service_category, 'listing_id' => $service_listing, 'price' => $service_price, 'special_price' => @$service_special, 'description' => $service_description, 'tags' => $service_tags, 'status' => $service_status, 'created_at' => date('Y-m-d H:i:s')];
		$result = DB::table('services')->where(['id' => $edit_service_id])->update($data);
		
		if($result){
			//print_r($_FILES);die;
		    $image = array();
		    if($file = $request->file('service_image')){
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('service/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data = ['image' => $image, 'service_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('services_image')->insertGetId($data);
			    }    
		    }
			//return redirect()->intended('admin/services')->with("status", "Your services added successfully!");
			$response['status'] = 1;
			$response['msg'] = 'Your services updated successfully!';
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
		}
		echo json_encode($response);
	}
	
	
	public function editProduct(Request $request)
    {
		
		$response = [];
		$product_name         = @$request->product_name;
		$product_category     = @$request->product_category;
		$product_price        = @$request->product_price;
		$product_special      = 0;
		$product_quantity     = 0;
		$product_availability = 0;
		$product_description  = @$request->product_description;
		$product_status       = 1;
		$product_listing      = @$request->product_listing;
		$product_tags         = @$request->product_tags;
		$edit_product_id         = @$request->edit_product_id;
		$product_subcategory  = 0;
		

		
		$data = ['name' => @$product_name, 'category' => @$product_category, 'subcategory' => @$product_subcategory, 'listing_id' => @$product_listing, 'price' => @$product_price, 'special_price' => @$product_special, 'quantity' => @$product_quantity, 'availability' => @$product_availability, 'description' => @$product_description, 'status' => @$product_status, 'tags' => @$product_tags, 'updated_at' => date('Y-m-d H:i:s')];
		
		$result = DB::table('product')->where(['id' => $edit_product_id])->update($data);
		if($result){
			//print_r($_FILES);die;
		    $image = array();
		    if($file = $request->file('product_image')){
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('product/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data = ['image' => $image, 'product_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('product_image')->insertGetId($data);
			    }    
		    }
			$response['status'] = 1;
			$response['msg'] = 'Your product updated successfully.';
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
		}
		
		echo json_encode($response);
	}
	
	public function sendInvitation(Request $request)
    {
		$response = [];
		
		$eventId         = @$request->invi_event_name;
		$description     = @$request->invi_description;
		$receiverId      = @$request->invi_event_user;
		$amount          = @$request->invi_price;
		$start_time      = @$request->invi_start_time;
		$end_time        = @$request->invi_end_time;
		$senderId        = session()->get('USERLOGINID');
		
		if(@$start_time){
			$startTime = date('H:i:s', strtotime(@$start_time));
		}else{
			$startTime = '';
		}
		
		if(@$end_time){
			$endTime = date('H:i:s', strtotime(@$end_time));
		}else{
			$endTime = '';
		}
		
		$accessList = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->select('invitationCount')->first();
		if(!empty(@$accessList)){
			if(@$accessList->invitationCount > 0){
				
			}else{
				$response['status'] = 0;
			    $response['msg'] = 'Your sending invitation limit is over now.';
				echo json_encode($response);exit();	
			}
		}
		
		$data = ['event_id' => @$eventId, 'status' => '2', 'description' => @$description, 'created_at' => date("Y-m-d H:i:s")];
		$result = DB::table('invitation')->insertGetId($data);
		if($result){
			
			$repeatData = ['sender_id' => @$senderId, 'receiver_id' => @$receiverId, 'amount' => @$amount, 'start_time' => @$start_time, 'end_time' => $end_time, 'status' => '2', 'invitation_id' => $result, 'created_at' => date("Y-m-d H:i:s")];
			DB::table('repeat_invitation')->insertGetId($repeatData);
			
			DB::table('users')->where(['id' => session()->get('USERLOGINID')])->update(['invitationCount' => DB::raw('invitationCount-1')]);
			
			$response['status'] = 1;
			$response['msg'] = 'Your invitation sent successfully.';
			
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
		}
		echo json_encode($response);
	}
	
	public function sendCounterInvitation(Request $request)
    {
		$response = [];
		$counterOffer = @$request->counter_offer;
		$invi_id = @$request->invi_id;
		$invitationList = DB::table('repeat_invitation')->where(['invitation_id' => $invi_id])->limit(1)->select('*')->orderBy('id', 'DESC')->first();
		
		//$data = ['invitation_id' => @$invi_id, 'sender_id' => @$invitationList->sender_id, 'receiver_id' => @$invitationList->receiver_id, 'amount' => @$counterOffer, 'start_time' => @$invitationList->start_time, 'end_time' => @$invitationList->end_time, 'status' => '3', 'created_at' => date("Y-m-d H:i:s")];
		
		$data = ['status' => '3', 'updated_at' => date("Y-m-d H:i:s")];
		$result = DB::table('invitation')->where(['id' => $invi_id])->update($data);
		if($result){
			$repeatdata = ['invitation_id' => @$invi_id, 'sender_id' => @$invitationList->sender_id, 'receiver_id' => @$invitationList->receiver_id, 'amount' => @$counterOffer, 'start_time' => @$invitationList->start_time, 'end_time' => @$invitationList->end_time, 'status' => '3', 'created_at' => date("Y-m-d H:i:s")];
			DB::table('repeat_invitation')->insertGetId($repeatdata); 
			
			$response['status'] = 1;
			$response['msg'] = 'Your counter offer sent successfully.';
			
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
		}
		echo json_encode($response);
	}
	
	public function get_counter_offer(Request $request)
    {
		@$output1 = '';
		@$output2 = '';
		if($request->inviTd){
			$offerList = DB::table('repeat_invitation')->where(['invitation_id' => @$request->inviTd])->select('*')->orderBy('id', 'ASC')->get();
			if(count($offerList)){
				foreach($offerList as $k => $v){
					if($k == 0){
						$output1.='
							
								<div class="BlockDataInner1">
								  <span>
									<img src="'.url('assets/home/images/Icon5.png').'" alt="">
								  </span>
								  <p>Original offer</p>
								</div>
								<p class="Price1">$'.@$v->amount.'</p>
							
						';
					}else{
						$output2.='
						
							<div class="BlockData2" >
								<div class="BlockDataInner2">
								  <span>
									<img src="'.url('assets/home/images/Icon5.png').'" alt="">
								  </span>
								  <p>Counter offer</p>
								  <p class="Price2">$'.@$v->amount.'</p>
								</div>
							</div><br/>
							
						
						';
					}
				}
			}
		}
		$response['output1'] = $output1;
		$response['output2'] = $output2;
		echo json_encode($response);
		
	}
	
	public function accept_invitation(Request $request)
    {
		
		$response = [];
		if(@$request->invi_id){
			$data = ['status' => '1', 'updated_at' => date("Y-m-d H:i:s")];
			$result = DB::table('invitation')->where(['id' => @$request->invi_id])->update(@$data);
			if($result){
				DB::table('repeat_invitation')->where(['invitation_id' => @$request->invi_id])->orderBy('id','desc')->take(1)->update(['status' => '1', 'updated_at' => date("Y-m-d H:i:s")]);
				$response['status'] = 1;
				$response['msg'] = 'Invitation accepted successfully.';
			}else{
				$response['status'] = 0;
				$response['msg'] = 'Some error occure, Please try again.';
		    }
		
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
		}
		echo json_encode($response);
	}
	
	public function reject_invitation(Request $request)
    {
		$response = [];
		if(@$request->invi_id){
			$data = ['status' => '0', 'updated_at' => date("Y-m-d H:i:s")];
			$result = DB::table('invitation')->where(['id' => @$request->invi_id])->update(@$data);
			if($result){
				DB::table('repeat_invitation')->where(['invitation_id' => @$request->invi_id])->orderBy('id','desc')->take(1)->update(['status' => '0', 'updated_at' => date("Y-m-d H:i:s")]);
				
				$response['status'] = 1;
				$response['msg'] = 'Invitation rejected successfully.';
				
			}else{
				$response['status'] = 0;
				$response['msg'] = 'Some error occure, Please try again.';
			}
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
		}
		echo json_encode($response);
	}
	
	public function promotion_payment() 
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
        
        $data['planInfo'] = $planInfo = DB::table('ads_sub_plan')->where(['id' => $planId])->select('*')->orderBy('id', 'DESC')->first();
        
        if(@$_GET['preferredListing'] == 1){
			$preferredListing = DB::table('ads_sub_plan')->where(['id' => $planId, 'preferred_listing' => @$_GET['preferredListing']])->select('preferred_listing', 'preferred_listing_price')->orderBy('id', 'DESC')->first();
			
			$preferred_listing_price = @$preferredListing->preferred_listing_price;
			$data['preferredListing'] = 'Yes';
		}else{
			$preferred_listing_price = 0;
			$data['preferredListing'] = 'No';
		}
		
		if(!empty($planInfo->discount) || $planInfo->discount != 0){
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
		return view('promotionpaymentpage', $data);
    }
	
	public function submit_promotion_payment(Request $request) 
    {
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
				"secret_key"      => STRIPE_SECRET_KEY,				"publishable_key" => STRIPE_PUBLISHABLE_KEY
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
							
							if(!empty(@$duration)){
								$current_period_end   = date('Y-m-d', strtotime($current_period_end. ' + '.@$duration.' day'));
							}
							
							$statusMsg = 'Your Payment has been Successful!';
							$data = ['user_name' => $card_name, 'user_id' => $user_id, 'address' => $address, 'country' => $country, 'state' => @$state, 'city' => @$city, 'zipcode' => $zipcode, 'ads_id' => @$sub_id, 'amount' => @$itemPrice, 'currency' => @$currency, 'txn_id' => $transactionID, 'order_id' => $orderID, 'charge_id' => $chargeID, 'status' => $payment_status, 'expiry_date' => $current_period_end, 'payment_type' => '2', 'promotion_id' => $adsId, 'preferredListing' => $preferredListing, 'duration' => $duration, 'created_at' => $paymentDate];
							
							$result = DB::table('transaction')->insertGetId($data);
							
							DB::table('users')->where('id',@$user_id)->update(['spend_money' => DB::raw('spend_money+'.@$itemPrice)]);
							
							$myInfo = DB::table('users')->where(['id' => @$user_id])->select('*')->first();
							$referralInfo = DB::table('reffer')->where(['reffer_user_email' => @$myInfo->email])->select('*')->first();
							$referral_setting = DB::table('referral_comission_setting')->select('*')->first();
							
							if(!empty($referralInfo)){
								
								$senderId = '';
								$reffer_code = '';
								if(@$referralInfo){
									if(@$referralInfo->sender_id){
										$senderId = @$referralInfo->sender_id;
									}
									
									if(@$referralInfo->reffer_code){
										$reffer_code = @$referralInfo->reffer_code;
									}
								}
								
								if((@$myInfo->spend_money != 0) && (@$myInfo->spend_money >= @$referral_setting->spend_money)){
									
									$referalData = ['referral_user_id' => @$user_id, 'user_id' => @$senderId, 'referral_code' => @$reffer_code, 'referral_earned_point' => @$referral_setting->reward_points, 'my_earned_point' => @$referral_setting->referred_by_points, 'created_at' => date('Y-m-d H:i:s')];
									DB::table('referral_rewards_transaction')->insertGetId($referalData);
									
									DB::table('users')->where('id',@$user_id)->update(['earned_rewords_point' => DB::raw('earned_rewords_point+'.$referral_setting->reward_points)]);
									
									DB::table('users')->where('id',@$senderId)->update(['earned_rewords_point' => DB::raw('earned_rewords_point+'.$referral_setting->referred_by_points)]); 
								} 

							}else{
								
								if((@$myInfo->spend_money != 0) && (@$myInfo->spend_money >= @$referral_setting->spend_money)){
									
									$referalData = ['referral_user_id' => NULL, 'user_id' => @$user_id, 'referral_code' => '', 'referral_earned_point' => @$referral_setting->reward_points, 'my_earned_point' => '', 'created_at' => date('Y-m-d H:i:s')];
									DB::table('referral_rewards_transaction')->insertGetId($referalData);
									
									DB::table('users')->where('id',@$user_id)->update(['earned_rewords_point' => DB::raw('earned_rewords_point+'.@$referral_setting->reward_points)]);
								}
							}
							
							if(@$myInfo->spend_money == @$referral_setting->spend_money){
								DB::table('users')->where('id',@$user_id)->update(['spend_money' => 0]);
							}elseif(@$myInfo->spend_money > @$referral_setting->spend_money){
								$total = @$myInfo->spend_money - @$referral_setting->spend_money;
								DB::table('users')->where('id',@$user_id)->update(['spend_money' => @$total]);
							}
							
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
	
	function get_product_details(Request $request){
		$output = '';
		$gallaryBlock  = '';
		if(@$request->productId){
			
			$productInfo = DB::table('product')->where(['status' => 1, 'id' => @$request->productId])->select('*')->first();
			
			$image_1  = DB::table('product_image')->where(['product_id' => @$productInfo->id])->select('*')->orderBy('id', 'ASC')->first();
			
			if(!empty(@$image_1->image) && file_exists('public/product/'.@$image_1->image.'')){
				$imageUrl = url('product/'.@$image_1->image.'');
			}else{
				$imageUrl = url('noimage.jpg');
			}
			
			if(@$productInfo->user_id == 0){
				$username = 'Administrator';
				$profile  = url('profile/unnamed.jpg');
			}else{
				$userInfo = DB::table('users')->where(['id' => @$productInfo->user_id])->select('*')->first();
				$username = @$userInfo->first_name.' '.@$userInfo->last_name;
				
				if(!empty(@$userInfo->profile_image) && file_exists('public/profile/'.@$userInfo->profile_image.'')){
					$profile = url('profile/'.@$userInfo->profile_image.'');
				}else{
					$profile = url('noimage.jpg');
				}
			}
			
			$tagsConcate = '';
			if(!empty(@$productInfo->tags)){
				$tagsId = explode(',', @$productInfo->tags);
				foreach($tagsId as $tagKey => $tagVal){
					$tagsConcate.='<li>'.@$tagVal.'</li>';
				}
			}
			
			$productImg  = DB::table('product_image')->where(['product_id' => @$productInfo->id])->select('*')->orderBy('id', 'ASC')->get();
			if(count($productImg) > 0){
				foreach($productImg as $imgKey => $imgVal){
					
					if(!empty(@$imgVal->image) && file_exists('public/product/'.@$imgVal->image.'')){
						$imageUrl_1 = url('product/'.@$imgVal->image.'');
					}else{
						$imageUrl_1 = url('noimage.jpg');
					}
					
					$gallaryBlock.= '
						<a href="javascript:void(0);" class="productPhotos" relid="'.@$productInfo->id.'" data-bs-toggle="modal" data-bs-target="#ProductPhotosModal">
						  <img
							src="'.@$imageUrl_1.'"
							alt="">
						</a>
					';
					
				}
			}
			
			if(@$productInfo->user_id == session()->get('USERLOGINID')){
				$quantityAndBuyNow = '';
			}else{
				$quantityAndBuyNow = '<div class="QuantityAddBlock">
					<p class="m-0 QuantityTextHeading">Quantity</p>
					<div class="QuantityContainer">
					  <a class="decrement">
						<i class="fa fa-minus" aria-hidden="true"></i>
					  </a>
					  <span>
						<p class="m-0 QuantityCount counter" id="counterId">1</p>
						
						
					  </span>
					  <a class="increment">
						<i class="fa fa-plus" aria-hidden="true"></i>
					  </a>
					</div>
				  </div>
				  
				  <div class="BtnContainer">
					<a class="BuyNowBtn" id="BuyNowSection" relid="'.@$request->productId.'" specipication="product">
					  <p class="m-0">Buy Now</p>
					</a>
					<a class="AddToCartBtn AddToCartNotify" relid="'.@$request->productId.'" specipication="product">
					  <img src="'.url('assets/home/images/Icon25.png').'" alt="">
					</a>
					
				  </div>';
			}
			
			if(@$productInfo->user_id == session()->get('USERLOGINID')){
				$deleteProduct='<a href="javascript:void(0)" class="edit-product" data-bs-toggle="modal" data-bs-target="#EditProductModal" relid="'.@$productInfo->id.'">
				<i class="fa fa-pencil-square" aria-hidden="true"></i>
				</a>

				<a href="javascript:void(0);" class="deleteProduct" relid="'.@$productInfo->id.'">
				<i class="fa fa-trash" aria-hidden="true"></i>
				</a>';
			}else{
				$deleteProduct='';
			}
			
			
			$output.='
				<div class="row PromotionDetail">
					<div class="col-md-8 col-sm-12 PromotionImg position-relative">
					  <img class="w-100" src="'.@$imageUrl.'" alt="">
					  <div class="ProductIconContainer">
						'.@$deleteProduct.'
						
					  </div>
					</div>
					<div class="col-md-4 col-sm-12 PromotionData">
					  <img class="OwnerImg"
						src="'.@$profile.'"
						alt="">
					  <p class="TitleText">'.@$productInfo->name.'</p>
					  <p class="OwnerText"><b>Price:</b>'.@$productInfo->price.'</p>
					  <ul>
						'.@$tagsConcate.'
					  </ul>
					  
					'.@$quantityAndBuyNow.'
				  
					</div>
					<div class="col-md-12 col-sm-12 PromotionData">
					  <p class="BodyText">'.@$productInfo->description.'</p>
					</div>
					<div class="col-md-12 col-sm-12 PeopleContainer mt-2">
					  <div class="TopSection">
						<p>Photos</p>
						<a href="" data-bs-toggle="modal" data-bs-target="#BusinessPhotosModal">
						  <img src="'.url('assets/home/images/Icon6.png').'" alt="">
						</a>
					  </div>
					  <div class="EventPhotoContainer">
						'.@$gallaryBlock.'
						
					  </div>
					</div>
				</div>
			';
		}
		echo $output;
	}
	
	public function get_product_image_gallery(Request $request)
    {
		$output        = '';
		$galleryPhotos = '';
		
		if(@$request->productId){
			//$listingImg  = DB::table('product_image')->where(['product_id' => @$request->productId])->select('*')->orderBy('id', 'ASC')->get();
			$productImg  = DB::table('product_image')->where(['product_id' => @$request->productId])->select('*')->orderBy('id', 'ASC')->get();
			//print_r($listingImg);die;
			
			if(count($productImg) > 0){
				foreach($productImg as $imgKey => $imgVal){
					
					if(!empty(@$imgVal->image) && file_exists('public/product/'.@$imgVal->image.'')){
						$imageUrl_1 = url('product/'.@$imgVal->image.'');
					}else{
						$imageUrl_1 = url('noimage.jpg');
					}
					
					$galleryPhotos.='
						<div class="carousel-item active">
							<img style="height: 75vh;"
							  src="'.@$imageUrl_1.'"
							  class="d-block w-100" alt="">
						</div>
					';
				}	
				
				$output= '
					<div class="row PromotionDetail">
						<div class="col-md-12 col-sm-12 PromotionImg">
						  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
						  
							<div class="carousel-inner">
							  
							  '.@$galleryPhotos.'
							  
							 
							</div>
							
							<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
							  data-bs-slide="prev">
							  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
							  data-bs-slide="next">
							  <span class="carousel-control-next-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Next</span>
							</button>
						  </div>
						</div>
					  </div>
				';
					
			}
		}
		echo $output;
	}
	
	function get_service_details(Request $request){
		$output = '';
		$gallaryBlock  = '';
		if(@$request->serviceId){
			
			$serviceInfo = DB::table('services')->where(['status' => 1, 'id' => @$request->serviceId])->select('*')->first();
			
			$image_1  = DB::table('services_image')->where(['service_id' => @$serviceInfo->id])->select('*')->orderBy('id', 'ASC')->first();
			
			if(!empty(@$image_1->image) && file_exists('public/service/'.@$image_1->image.'')){
				$imageUrl = url('service/'.@$image_1->image.'');
			}else{
				$imageUrl = url('noimage.jpg');
			}
			
			if(@$serviceInfo->user_id == 0){
				$username = 'Administrator';
				$profile  = url('profile/unnamed.jpg');
			}else{
				$userInfo = DB::table('users')->where(['id' => @$serviceInfo->user_id])->select('*')->first();
				$username = @$userInfo->first_name.' '.@$userInfo->last_name;
				
				if(!empty(@$userInfo->profile_image) && file_exists('public/profile/'.@$userInfo->profile_image.'')){
					$profile = url('profile/'.@$userInfo->profile_image.'');
				}else{
					$profile = url('noimage.jpg');
				}
			}
			
			$tagsConcate = '';
			if(!empty(@$serviceInfo->tags)){
				$tagsId = explode(',', @$serviceInfo->tags);
				foreach($tagsId as $tagKey => $tagVal){
					$tagsConcate.='<li>'.@$tagVal.'</li>';
				}
			}
			
			$serviceImg  = DB::table('services_image')->where(['service_id' => @$serviceInfo->id])->select('*')->orderBy('id', 'ASC')->get();
			if(count($serviceImg) > 0){
				foreach($serviceImg as $imgKey => $imgVal){
					
					if(!empty(@$imgVal->image) && file_exists('public/service/'.@$imgVal->image.'')){
						$imageUrl_1 = url('service/'.@$imgVal->image.'');
					}else{
						$imageUrl_1 = url('noimage.jpg');
					}
					
					$gallaryBlock.= '
						<a href="javascript:void(0);" class="servicePhotos" relid="'.@$serviceInfo->id.'" data-bs-toggle="modal" data-bs-target="#ServicePhotosModal">
						  <img
							src="'.@$imageUrl_1.'"
							alt="">
						</a>
					';
					
				}
			}
			
			
			if(@$serviceInfo->user_id == session()->get('USERLOGINID')){
					$deleteService='<a href="javascript:void(0)" class="edit-services" relid="'.@$serviceInfo->id.'" data-bs-toggle="modal" data-bs-target="#editServiceModel">
					<i class="fa fa-pencil-square" aria-hidden="true"></i>
					</a>
					<a href="javascript:void(0)" relid="'.@$serviceInfo->id.'"  class="deleteService"> 
					<i class="fa fa-trash" aria-hidden="true"></i>
					</a>';
			}else{
				$deleteService='';
			}
			
			
			if(@$productInfo->user_id == session()->get('USERLOGINID')){
				$quantityAndBuyNow = '';
			}else{
				$quantityAndBuyNow = '<div class="QuantityAddBlock">
					<p class="m-0 QuantityTextHeading">Quantity</p>
					<div class="QuantityContainer">
					  <a class="decrement">
						<i class="fa fa-minus" aria-hidden="true"></i>
					  </a>
					  <span>
						<p class="m-0 QuantityCount counter" id="counterId">1</p>
						
						
					  </span>
					  <a class="increment">
						<i class="fa fa-plus" aria-hidden="true"></i>
					  </a>
					</div>
				  </div>
				  
				  <div class="BtnContainer">
					<a class="BuyNowBtn" id="BuyNowSection" relid="'.@$request->serviceId.'" specipication="service">
					  <p class="m-0">Buy Now</p>
					</a>
					<a class="AddToCartBtn AddToCartNotify" relid="'.@$request->serviceId.'" specipication="service">
					  <img src="'.url('assets/home/images/Icon25.png').'" alt="">
					</a>
					
				  </div>';
			}
			
			$output.='
				<div class="row PromotionDetail">
					<div class="col-md-8 col-sm-12 PromotionImg position-relative">
					  <img class="w-100" src="'.@$imageUrl.'" alt="">
					  <div class="ProductIconContainer">
					  
						'.@$deleteService.'
						
					  </div>
					</div>
					<div class="col-md-4 col-sm-12 PromotionData">
					  <img class="OwnerImg"
						src="'.@$profile.'"
						alt="">
					  <p class="TitleText">'.@$serviceInfo->name.'</p>
					  <p class="OwnerText"><b>Price:</b>'.@$serviceInfo->price.'</p>
					  <ul>
						'.@$tagsConcate.'
					  </ul>
					  
					  '.@$quantityAndBuyNow.'
					</div>
					<div class="col-md-12 col-sm-12 PromotionData">
					  <p class="BodyText">'.@$serviceInfo->description.'</p>
					</div>
					<div class="col-md-12 col-sm-12 PeopleContainer mt-2">
					  <div class="TopSection">
						<p>Photos</p>
						<a href="" data-bs-toggle="modal" data-bs-target="#BusinessPhotosModal">
						  <img src="'.url('assets/home/images/Icon6.png').'" alt="">
						</a>
					  </div>
					  <div class="EventPhotoContainer">
						'.@$gallaryBlock.'
						
					  </div>
					</div>
				</div>
			';
		}
		echo $output;
	}
	
	public function get_service_image_gallery(Request $request)
    {
		$output        = '';
		$galleryPhotos = '';
		
		if(@$request->serviceId){
			//$listingImg  = DB::table('product_image')->where(['product_id' => @$request->productId])->select('*')->orderBy('id', 'ASC')->get();
			$serviceImg  = DB::table('services_image')->where(['service_id' => @$request->serviceId])->select('*')->orderBy('id', 'ASC')->get();
			//print_r($listingImg);die;
			
			if(count($serviceImg) > 0){
				foreach($serviceImg as $imgKey => $imgVal){
					
					if(!empty(@$imgVal->image) && file_exists('public/service/'.@$imgVal->image.'')){
						$imageUrl_1 = url('service/'.@$imgVal->image.'');
					}else{
						$imageUrl_1 = url('noimage.jpg');
					}
					
					$galleryPhotos.='
						<div class="carousel-item active">
							<img style="height: 75vh;"
							  src="'.@$imageUrl_1.'"
							  class="d-block w-100" alt="">
						</div>
					';
				}	
				
				$output= '
					<div class="row PromotionDetail">
						<div class="col-md-12 col-sm-12 PromotionImg">
						  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
						  
							<div class="carousel-inner">
							  
							  '.@$galleryPhotos.'
							  
							 
							</div>
							
							<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
							  data-bs-slide="prev">
							  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
							  data-bs-slide="next">
							  <span class="carousel-control-next-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Next</span>
							</button>
						  </div>
						</div>
					  </div>
				';
					
			}
		}
		echo $output;
	}
	
	function add_to_cart(Request $request){
	
		
			$product_id = @$request->productId;
			$quantity = @$request->quantity;
			
			if(@$request->specipication == 'product'){
				
				//$product = $this->Mymodel->get_single_row_info('*', 'product', 'product_status = "1" AND product_id = '.@$product_id.'', '', 1);
				$product = DB::table('product')->where(['status' => 1, 'id' => @$product_id])->select('*')->first();

				//print_r($product);die;
				$image_1  = DB::table('product_image')->where(['product_id' => @$product_id])->select('*')->orderBy('id', 'ASC')->first();

				if(!empty(@$image_1->image) && file_exists('public/product/'.@$image_1->image.'')){
				    $imageUrl = url('product/'.@$image_1->image.'');
				}else{
				    $imageUrl = url('noimage.jpg');
				}
				
				$specipication = 'product';
			}else{
				$product = DB::table('services')->where(['status' => 1, 'id' => @$product_id])->select('*')->first();

				//print_r($product);die;
				$image_1  = DB::table('services_image')->where(['service_id' => @$product_id])->select('*')->orderBy('id', 'ASC')->first();

				if(!empty(@$image_1->image) && file_exists('public/service/'.@$image_1->image.'')){
				    $imageUrl = url('service/'.@$image_1->image.'');
				}else{
				    $imageUrl = url('noimage.jpg');
				}
				$specipication = 'service';
			}

			
			
			
			$cartArray = array('product'.$product_id => array('id' => $product->id, 'name' => $product->name, 'product_price' => $product->price, 'product_special_price' => $product->special_price, 'image' => $imageUrl, 'quantity' => $quantity, 'specipication' => $specipication));
			
			if(empty(session()->get('shopping_cart'))) {
				
				session()->put('shopping_cart', $cartArray);
				$status = "<div class='box'>Product is added to your cart!</div>";
				$response['status'] = 1;
				$response['message'] = $status;
			}else {
					$array_keys = array_keys(session()->get('shopping_cart'));
				if(in_array($product_id,$array_keys)) {
					$status = "<div class='box' style='color:red;'>
					Product is already added to your cart!</div>";	
					$response['status'] = 0;
					$response['message'] = $status;
				} else {
					//$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
					
					session()->put('shopping_cart', array_merge(session()->get('shopping_cart'), $cartArray));
					
					$status = "<div class='box'>Product is added to your cart!</div>";
					$response['status'] = 1;
					$response['message'] = $status;
				}
			}
			 
			// if(empty($this->session->userdata('shopping_cart'))){
			// $this->session->set_userdata('shopping_cart', $cartArray);
			// echo 'empty';
			// }else{
			// $array1 = array ( 'id' => 2, 'name' => 'Universal Excavator Driver Cab Seat', 'product_price' => 130.00, 'product_special_price' => 125.00 );
			// $array2 = $cartArray;
			// //print_r($array1);echo"<br/>";
			// //print_r($array2);echo"<br/>";die;

			// $array_merge = array_merge($array1, $array2);
			// print_r($array_merge);
			// //echo 'not empty';
			// //$this->session->set_userdata('shopping_cart', array_merge($this->session->userdata('shopping_cart'), $cartArray));
			// }
		
		echo json_encode($response);
	}
	
	public function addtoCart()
    { 
	
	    //print_r(session()->get('shopping_cart'));die;
        $data = array(
			'title'   => 'Add to Cart',
			'page'    => 'users',
			'subpage' => 'users'
		);
		// $data['plan']  = DB::table('sub_plan')->where(['status' => 1])->select('*')->get();
		// $data['adsPlan']  = DB::table('ads_sub_plan')->where(['status' => 1])->select('*')->get();
		$data['product'] = (!empty(session()->get('shopping_cart')) ? session()->get('shopping_cart') : []);
        return view('account.add_to_cart', $data);
    }
	
	function change(Request $request){
		
		    $cart = session()->get('shopping_cart');
			$cart['product'.$request->id]['quantity'] = $request->quantity;
			session()->put('shopping_cart', $cart);
			Session::save();
            $response['status'] = 1;
			echo json_encode($response);
			
	}
	
	function remove_product(Request $request){
		$status="";
		
		if($request->id) {
            $cart = session()->get('shopping_cart');
            if(isset($cart['product'.$request->id])) {
                unset($cart['product'.$request->id]);
                session()->put('shopping_cart', $cart);
				Session::save();
            }
            session()->flash('success', 'Product removed successfully');
        }
		$response['status'] = 1;
		echo json_encode($response);
		
	}
	
	function network(){
		$data = array(
			'title'   => 'Network Lists',
			'page'    => 'users',
			'subpage' => 'users'
		);
		//$data['allMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10, 'user_type'])->select('*')->get();
		$data['allMem']  = DB::table('users')->whereRaw("id != '".session()->get('USERLOGINID')."' AND (user_type = 8 OR user_type = 10) AND status = 1")->limit(15)->select('*')->orderBy('id', 'ASC')->get();
		
		$data['countCreator']  = DB::table('users')->whereRaw("id != '".session()->get('USERLOGINID')."' AND (user_type = 8 OR user_type = 10) AND status = 1")->select('*')->count();
		
		$Sql = "SELECT users.id as userId, users.first_name, users.last_name, users.profile_image, favouriteusers.fav_user_id, favouriteusers.user_id FROM users INNER JOIN favouriteusers ON users.id = favouriteusers.user_id WHERE users.status='1' AND users.id='".session()->get('USERLOGINID')."'";
		$data['myMem'] = DB::select($Sql);
		//print_r($data['myMem']);die;
		
		$data['AdvsPlan']  = DB::table('advertise_sub_plan')->where(['status' => 1])->select('*')->get();

		return view('account.network', $data);
	}
	
	function addRemoveBookmarkUsers(Request $request){
		$response = [];
	    if($request->userId){
			$favUserId = $request->userId;
			$userId  = session()->get('USERLOGINID');
			
			$numRows = DB::table('favouriteusers')->where(['user_id' => @$userId, 'fav_user_id' => @$favUserId])->select('*')->orderBy('id', 'DESC')->count();
			
			if($numRows ==0){
				$myfavview=array(
					'user_id'    => @$userId,
					'fav_user_id'   => @$favUserId,
					'created_at' => date("Y-m-d H:i:s")
				);
				$result = DB::table('favouriteusers')->insertGetId($myfavview);
				if($result){
					$response = ["status" => 1, "message" => "Successfully added in favourite list."];
					//return response()->json($response, 200);
				}
			}else{
				$blockwhere = array( 
					'user_id'  => @$userId,
					'fav_user_id' => @$favUserId
				); 
				$result = DB::table('favouriteusers')->where($blockwhere)->delete();
				if($result){
					$response = ["status" => 2, "message" => "Successfully removed from favourite list."];
					//return response()->json($response, 200);
				}
			}
			
		}
		
		echo json_encode($response);
	}
	
	
	function get_user_profileInfo_1(Request $request){
		$output = '';
		if(@$request->userId){
			
			$userInfo  = DB::table('users')->where(['id' => @$request->userId])->select('*')->first();
			
			if(!empty(@$userInfo->profile_image) && file_exists('public/profile/'.@$userInfo->profile_image.'')){
				$profilePic = url('profile/'.@$userInfo->profile_image.'');
			}else{
				$profilePic = url('profile/unnamed.jpg');
			}
			
			if(!empty(@$userInfo->dob) && @$userInfo->dob != '0000-00-00'){
				$dob = date('d F Y', strtotime(@$userInfo->dob));
			}else{
				$dob = '';
			}
			$interestTgas = '';
			if(@$userInfo->area_interest){
				$exInterest = explode(",", @$userInfo->area_interest);
				foreach($exInterest as $k => $v){
					$interest  = DB::table('interest')->where(['id' => @$v])->select('*')->first();
					$interestTgas.='<li>'.@$interest->name.'</li>';
				}
			}
			
			$Info = '
				<div class="Tab active" onclick="openTab(event, Info)">Info</div>
				<div class="Tab" onclick="openTab(event, Photos)">Photos</div>
				<div class="Tab" onclick="openTab(event, Events)">Events</div>
			';
			
			
			$output='
			    <div class="TabBar">
				  <div class="Pagination">
					<a href="" id="Home"><i class="fa fa-angle-left" aria-hidden="true"></i> Home / Profile</a>
				  </div>

				  <div class="row m-0" style="background: #fff;">
					<div class="col-lg-9 col-md-9 col-sm-12 UserProfileDataContainer">
					  <img class="AddBanner" src="'.url('assets/home/images/AddBaner.png').'" alt="">
					  <a href="" class="LikeBtnBlock">
						<img src="'.url('assets/home/images/Icon29.png').'" alt="">
					  </a>
					  <img class="UserProfileImg" src="'.@$profilePic.'" alt="">
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 UserDataContainer">
					  <div>
						<p class="m-0 UserName">'.@$userInfo->first_name.' '.@$userInfo->last_name.'</p>
						<p class="m-0 UserNameTag">ATHLETE & ENTERTAINER</p>
					  </div>
					  <a href="" class="UserAddBtn" data-bs-toggle="modal" data-bs-target="#AdvertiseModal">
						<p class="m-0">Advertise</p>
					  </a>
					</div>
				  </div>

				  <div class="TabContainer">
					<div class="Tab active" onclick="openTab(event, "Info")">Info</div>
					<div class="Tab" onclick="openTab(event, "Photos")">Photos</div>
					<div class="Tab" onclick="openTab(event, "Events")">Events</div>
				  </div>
				</div>

				<div id="Info" class="row m-0 TabContent active">
				  <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="ProfileDataBlock">
					  <p class="m-0 HeadingText">About me</p>
					  <p class="m-0 SubHeadingText">'.@$userInfo->bio.'</p>
					</div>
					<div class="ProfileDataBlock">
					  <p class="m-0 HeadingText">Basic info</p>
					  <p class="m-0 SubHeadingText">Birthday: '.@$dob.'</p>
					</div>
					<div class="ProfileDataBlock">
					  <p class="m-0 HeadingText">Interest</p>
					  <ul>
						'.@$interestTgas.'
					  </ul>
					  
					</div>
				  </div>
				</div>

				<div id="Photos" class="row m-0 TabContent">
				  <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="EventPhotoContainer">
					  <a href="">
						<img
						  src="https://img.freepik.com/free-photo/blue-holi-color-explosion-young-woman-dancing_23-2148129343.jpg?t=st=1731406746~exp=1731410346~hmac=aac3004aa5f9db23dd6c266f0c5351a065f18d551f3da09872c50dc1851d2c1f&amp;w=1380"
						  alt="">
					  </a>
					  <a href="">
						<img
						  src="https://img.freepik.com/free-photo/close-up-people-dancing-yellow-explosion-holi-color_23-2148129155.jpg?t=st=1731406654~exp=1731410254~hmac=e14e090ddbf68f2d9247a7ccfa46a4342c248a318fa4268954954fcbed03faea&amp;w=740"
						  alt="">
					  </a>
					  <a href="">
						<img
						  src="https://img.freepik.com/free-photo/green-holi-color-powder-crowd_23-2148129312.jpg?t=st=1731406659~exp=1731410259~hmac=bbd9797f2b5a6ab957dc738298432651e61989de3a9a3dac15534dc439224e36&amp;w=1380"
						  alt="">
					  </a>
					  <a href="">
						<img
						  src="https://img.freepik.com/free-photo/group-people-enjoying-holi-color_23-2148129319.jpg?t=st=1731406297~exp=1731409897~hmac=acd19fe86608034c5d2c2cddd5ba441729d9c046cfd629ff77eec2bc60c8b980&amp;w=1380"
						  alt="">
					  </a>
					  <a href="">
						<img
						  src="https://img.freepik.com/free-photo/black-man-surrounded-by-orange-smoke_410324-20.jpg?t=st=1731406716~exp=1731410316~hmac=793484971ee67895250accc8aa03bf8873cdb16f98f451ed9751c18de6dee65d&amp;w=740"
						  alt="">
					  </a>
					  <a href="">
						<img
						  src="https://img.freepik.com/free-photo/green-blue-holi-color-powder-crowd_23-2148129315.jpg?t=st=1731407223~exp=1731410823~hmac=38dd34eb6b370798b180a31014e9d25d2e438d6d5b09c4b82e79e3d79448f403&amp;w=1380"
						  alt="">
					  </a>
					</div>
				  </div>
				</div>

				<div id="Events" class="row m-0 TabContent">
				  <div class="Card col-lg-3 col-md-3 col-sm-6">
					<div class="CardInner">
					  <div class="Cover"></div>
					  <img class="UserImage"
						src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&amp;w=1887&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
						alt="">
					  <p class="Heading">Event Name</p>
					  <p class="SubHeading">Event Organizer Name</p>
					  <p class="SubHeading">Location: </p>
					  <p class="SubHeading">Date: </p>
					  <p class="SubHeading">Time: </p>
					  <div class="IconContainer">
						<a href="">
						  <i class="fa fa-heart" aria-hidden="true"></i>
						</a>
					  </div>
					</div>
				  </div>
				</div>
			';
		}
		echo @$output;
	}
	function get_user_profileInfo(Request $request){
		$output = '';
		$info = '';
		if(@$request->userId){
			
			$userInfo  = DB::table('users')->where(['id' => @$request->userId])->select('*')->first();
			
			if(!empty(@$userInfo->profile_image) && file_exists('public/profile/'.@$userInfo->profile_image.'')){
				$profilePic = url('profile/'.@$userInfo->profile_image.'');
			}else{
				$profilePic = url('profile/unnamed.jpg');
			}
			
			if(!empty(@$userInfo->dob) && @$userInfo->dob != '0000-00-00'){
				$dob = date('d F Y', strtotime(@$userInfo->dob));
			}else{
				$dob = '';
			}
			$interestTgas = '';
			if(@$userInfo->area_interest){
				$exInterest = explode(",", @$userInfo->area_interest);
				foreach($exInterest as $k => $v){
					$interest  = DB::table('interest')->where(['id' => @$v])->select('*')->first();
					$interestTgas.='<li>'.@$interest->name.'</li>';
				}
			}
			
			$userType = '';
			if(@$userInfo->user_type == 8){
				$userType = 'SERVICE PROVIDER';
			}elseif(@$userInfo->user_type == 10){
				$userType = 'A & E';
			}
			
			
			$Sql = "SELECT advertise.id as advsId, advertise.title, advertise.image, advertise.status, transaction.adv_id, transaction.adv_sub_id, transaction.adv_user_id FROM advertise INNER JOIN transaction ON advertise.id = transaction.adv_id WHERE advertise.status='1' AND transaction.adv_user_id='".@$request->userId."' AND transaction.expiry_date >= '".date('Y-m-d')."'";
			$bannerAdvs = DB::select($Sql);
			
			$banner_Advs = '';
			if(count(@$bannerAdvs) > 0){
				$i = 1;
				foreach(@$bannerAdvs as $k => $v){
					if(!empty(@$v->image) && file_exists('public/ads/'.@$v->image.'')){
						$banner_Advs.='
						    <div class="carousel-item '.((@$i == 1) ? 'active' : '').'">
								<img style="height: 250px !important; border-radius: 20px;" src="'.url('ads/'.@$v->image.'').'"
								  class="d-block w-100 object-fit-cover" alt="">
							</div>
						';
					}else{
						$banner_Advs.='
						    <div class="carousel-item active">
								<img style="height: 250px !important; border-radius: 20px;" src="'.url('bnr.jpg').'"
								  class="d-block w-100 object-fit-cover" alt="">
							</div>
						';
					}
					$i++;
				}
		    }else{
				$banner_Advs='<img class="AddBanner" src="'.url('bnr.jpg').'" alt="">';
			}
			
					
			$output='
			
			<div class="col-lg-9 col-md-9 col-sm-12 UserProfileDataContainer">
			
						<div id="carouselExampleControls" class="carousel slide AddBanner" data-bs-ride="carousel">
							<div class="carousel-inner">
							  
							  '.@$banner_Advs.'
							</div>
							
							
						  </div>
					 
					  <a href="" class="LikeBtnBlock">
						<img src="'.url('assets/home/images/Icon29.png').'" alt="">
					  </a>
					  <img class="UserProfileImg" src="'.@$profilePic.'" alt="">
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-12 UserDataContainer">
					  <div>
						<p class="m-0 UserName">'.@$userInfo->first_name.' '.@$userInfo->last_name.'</p>
						<p class="m-0 UserNameTag">'.@$userType.'</p>
					  </div>
					  <a href="" class="UserAddBtn" data-bs-toggle="modal" data-bs-target="#AdvertiseModal">
						<p class="m-0">Advertise</p>
					  </a>
					</div>
					';
					
					$info = '
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="ProfileDataBlock">
							  <p class="m-0 HeadingText">About me</p>
							  <p class="m-0 SubHeadingText">'.@$userInfo->bio.'</p>
							</div>
							<div class="ProfileDataBlock">
							  <p class="m-0 HeadingText">Basic info</p>
							  <p class="m-0 SubHeadingText">Birthday: '.@$dob.'</p>
							</div>
							<div class="ProfileDataBlock">
							  <p class="m-0 HeadingText">Interest</p>
								<ul>
								'.@$interestTgas.'
								</ul>
							</div>
						  </div>
					    ';
			}
			
		// $response['output'] = @$output;
		 //$response['info'] = @$info;
		 echo $output;
	}
	
	public function stripe_connect()
    {
		
		$data = array(
			'title'   => 'Stripe Connect',
			'page'    => 'users',
			'subpage' => 'users'
		);
		$data['allMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		//$data['myMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		
		$Sql = "SELECT users.id as userId, users.first_name, users.last_name, users.profile_image, favouriteusers.fav_user_id, favouriteusers.user_id FROM users INNER JOIN favouriteusers ON users.id = favouriteusers.user_id WHERE users.status='1' AND users.id='".session()->get('USERLOGINID')."'";
		$data['myMem'] = DB::select($Sql);
		//print_r($data['myMem']);die;
		$data['stripe']  = DB::table('stripe_connect')->where(['userId' => session()->get('USERLOGINID')])->select('*')->first();
		if($data['stripe']){
			$data['stripecon'] = $this->get_stripe_info($data['stripe']->stripe_acc_id);
			//print_r($data['stripecon']);die;
		}else{
			$data['stripecon'] = '';
		}
		
		return view('account.stripe', $data);
	}
	
	public function stripeConnect()
    {
		

		require "vendor/stripe/stripe-php/init.php";
		
			$userId = session()->get('USERLOGINID');

			$userInfo =  DB::table('users')->where(['id' => $userId])->select('*')->orderBy('id', 'DESC')->first();
			if(!empty($userInfo))
            {
				$stripe = new \Stripe\StripeClient(STRIPE_SECRET_KEY);
				
				try {  
					$account = $stripe->accounts->create(
						[
							'country' => 'US',
							//'country' => ''.@$userInfo->countryNameCode.'',
							'type' => 'express',
							'email' => ''.@$userInfo->email.'',
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
							'refresh_url' => url('dashboard/stripeReturn?userId='.$userId.''),
							'return_url' => url('dashboard/stripeReturn?userId='.$userId.''),
							'type' => 'account_onboarding',
						]
					);
					
				} catch(Exception $e) {  
					$api_error = $e->getMessage();  
				} 
					
				//echo $api_error;die;
			    if(empty($api_error)){
					
					
					$mydata = array(
						'userId' => $userId,
						'stripe_acc_id' => $stripe_acc_id,
						'expires_at' => $link['expires_at'],
						'url' => $link['url']
					);

					$check =  DB::table('stripe_connect')->where(['userId' => $userId])->select('*')->orderBy('id', 'DESC')->first();
					if(!empty($check)){
						$result = DB::table('stripe_connect')->where(['userId' => $userId])->update($mydata);
					}else{
						$result = DB::table('stripe_connect')->insertGetId($mydata);
					}
					if(!empty($result)){

						return redirect()->intended(''.$link['url'].'');
					}
				}
				
			
			}
				
		
	}
	
	function get_stripe_info($stripe_acc_id = '')
	{
		$url = 'https://api.stripe.com/v1/accounts/'.@$stripe_acc_id.'';
		$skey = STRIPE_SECRET_KEY;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "".$url."");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
		curl_setopt($ch, CURLOPT_POST, 1);
		$headers = array();
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Authorization: Bearer ".$skey."";
		//$headers[] = "client_secret: ".STRIPE_SECRET_KEY."";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		//print_r($result);
		$get_data = json_decode($result);
		if(!empty($get_data->payouts_enabled) AND !empty($get_data->charges_enabled) AND $get_data->payouts_enabled == 1 AND $get_data->charges_enabled == 1)
		{
			$status = '1';
		}else{
			$status = '0';
		}
		return $status;
	}
	
	public function stripeReturn(){
		if(!empty($_GET['userId'])){
			//$useracc_info = $this->db->query("select * from stripe_connect where userId = ".$_GET['userId']."")->row();
			$useracc_info = DB::table('stripe_connect')->where(['userId' => $_GET['userId']])->select('*')->orderBy('id', 'DESC')->first();
			if(!empty($useracc_info)){
				$skey = STRIPE_SECRET_KEY;
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
						
						return redirect()->intended("dashboard/stripe-connect?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId."");
					}else{
						//echo 'Your account is not connected. Please try again.';
						$statusMsg = 'Your account is not connected. Please try again.';
						$status = 'fail';
						$userId = @$_GET['userId'];
						$stripeAccid = '';
						
						//redirect(base_url("payment/stripeConnectStatus?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId.""),'refresh'); 
						
						return redirect()->intended("dashboard/stripe-connect?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId."");
					}
				}else{
					//echo 'user stripe account id not found.';
					$statusMsg = 'user stripe account id not found.';
					$status = 'fail';
					$stripeAccid = ''; 
					$userId = @$_GET['userId'];
					//redirect(base_url("payment/stripeConnectStatus?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId.""),'refresh'); 
					
					return redirect()->intended("dashboard/stripe-connect?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId."");
				}
			}else{
				$statusMsg = 'user not found';
				//echo 'user not found.';
				$status = 'fail';
				$stripeAccid = '';
				$userId = @$_GET['userId'];
				
				//redirect(base_url("payment/stripeConnectStatus?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId.""),'refresh'); 
				
				return redirect()->intended("dashboard/stripe-connect?statusMsg=".$statusMsg."&status=".$status."&stripeaccId=".$stripeAccid."&userId=".$userId."");
			}
		}
	}
	
	public function profile()
    {
		
		$data = array(
			'title'   => 'Profile',
			'page'    => 'users',
			'subpage' => 'users'
		);
		$data['allMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		//$data['myMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		
		$Sql = "SELECT users.id as userId, users.first_name, users.last_name, users.profile_image, favouriteusers.fav_user_id, favouriteusers.user_id FROM users INNER JOIN favouriteusers ON users.id = favouriteusers.user_id WHERE users.status='1' AND users.id='".session()->get('USERLOGINID')."'";
		$data['myMem'] = DB::select($Sql);
		//print_r($data['myMem']);die;
		$data['stripe']  = DB::table('stripe_connect')->where(['userId' => session()->get('USERLOGINID')])->select('*')->first();
		if($data['stripe']){
			$data['stripecon'] = $this->get_stripe_info($data['stripe']->stripe_acc_id);
		}else{
			$data['stripecon'] = '';
		}
		$data['userInfo']  = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->select('*')->first();
		$data['tags'] = DB::table('tags')->select('*')->orderBy('name', 'ASC')->get();
		return view('account.profile', $data);
	}
	
	public function upcomingEvent()
    {
		
		$data = array(
			'title'   => 'Upcoming Event',
			'page'    => 'users',
			'subpage' => 'users'
		);
		$data['allMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		//$data['myMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		
		$Sql = "SELECT users.id as userId, users.first_name, users.last_name, users.profile_image, favouriteusers.fav_user_id, favouriteusers.user_id FROM users INNER JOIN favouriteusers ON users.id = favouriteusers.user_id WHERE users.status='1' AND users.id='".session()->get('USERLOGINID')."'";
		$data['myMem'] = DB::select($Sql);
		//print_r($data['myMem']);die;
		$data['stripe']  = DB::table('stripe_connect')->where(['userId' => session()->get('USERLOGINID')])->select('*')->first();
		if($data['stripe']){
			$data['stripecon'] = $this->get_stripe_info($data['stripe']->stripe_acc_id);
		}else{ 
			$data['stripecon'] = '';
		}
		$Sql = "SELECT * FROM events WHERE status = '1' AND DATE(start_date) >= '".date('Y-m-d')."' order by id DESC";
		$data['eventList'] = DB::select($Sql);
		
		$data['usersubInfo'] = DB::table('transaction')->whereRaw("user_id = '".session()->get('USERLOGINID')."' AND expiry_date >= '".date('Y-m-d')."' AND payment_type = 1 AND status = 'succeeded'")->limit(1)->select('*')->orderBy('id', 'DESC')->first();
		return view('account.upcoming_event', $data);
	}
	
	public function refferalLink()
    {
		
		$data = array(
			'title'   => 'Referral Link',
			'page'    => 'users',
			'subpage' => 'users'
		);
		
		/*$data['allMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		$Sql = "SELECT users.id as userId, users.first_name, users.last_name, users.profile_image, favouriteusers.fav_user_id, favouriteusers.user_id FROM users INNER JOIN favouriteusers ON users.id = favouriteusers.user_id WHERE users.status='1' AND users.id='".session()->get('USERLOGINID')."'";
		$data['myMem'] = DB::select($Sql);
		$data['stripe']  = DB::table('stripe_connect')->where(['userId' => session()->get('USERLOGINID')])->select('*')->first();
		if($data['stripe']){
			$data['stripecon'] = $this->get_stripe_info($data['stripe']->stripe_acc_id);
		}else{
			$data['stripecon'] = '';
		}
		$Sql = "SELECT * FROM events WHERE status = '1' AND DATE(start_date) >= '".date('Y-m-d')."' order by id DESC";
		$data['eventList'] = DB::select($Sql);*/
		
		$data['myReferral']  = DB::table('reffer')->where(['sender_id' => session()->get('USERLOGINID')])->select('*')->get();
		$data['myReward']  = DB::table('referral_rewards_transaction')->where(['user_id' => session()->get('USERLOGINID')])->select('*')->get();
		$data['userInfo']  = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->select('earned_rewords_point')->first();
		
		$data['pendingReferral']  = DB::table('reffer')->where(['sender_id' => session()->get('USERLOGINID'), 'status' => '2'])->select('*')->get();
		
		return view('account.refferal', $data);
	}
	public function get_profile_info(Request $request)
    {
		$response = [];
		if($request->userId){
			$userInfo  = DB::table('users')->where(['status' => 1, 'id' => $request->userId])->select('*')->first();
			if(!empty(@$userInfo)){
				$response['fname']      = @$userInfo->first_name;
				$response['lname']      = @$userInfo->last_name;
				$response['location']  = @$userInfo->address;
				$response['country']   = @$userInfo->country;
				$response['state']     = @$userInfo->state;
				$response['city']      = @$userInfo->city;
				$response['zipcode']   = @$userInfo->zipcode;
				$response['latitude']  = @$userInfo->latitude;
				$response['longitude'] = @$userInfo->longitude;
				$response['phone']     = @$userInfo->phone;
				$response['email']     = @$userInfo->email;
				$response['dob']       = @$userInfo->dob;
				$response['bio']       = strip_tags(@$userInfo->bio);
				$response['id']        = @$userInfo->id;
				
				$tagsConcate = [];
				if(!empty(@$userInfo->tags)){
					$tagsId = explode(',', @$userInfo->tags);
					foreach($tagsId as $tagKey => $tagVal){
						$tags  = DB::table('tags')->where(['id' => @$tagVal])->select('*')->orderBy('id', 'ASC')->first();
						//print_r($tags);die;
						$tagsConcate[] = $tags->id;
					}
				}
				$response['tags']   = @$tagsConcate;
			}
		}
		echo json_encode(@$response);
	}
	
	public function updateProdule(Request $request)
    {

		$location       = @$request->location;
		$zipcode        = @$request->zipcode;
		$latitude       = @$request->latitude;
		$longitude      = @$request->longitude;
		$country        = @$request->country;
		$state          = @$request->state;
		$city           = @$request->city;
		$phone          = @$request->phone;
		$email          = @$request->email;
		$userId         = @$request->userId;
		$bio            = @$request->bio;
		$firstName      = @$request->fname;
		$lastName       = @$request->lname;
		
		/*@$firstName = '';
		@$lastName  = '';
		if(@$request->name){
			$exName = explode(' ', @$request->name);
			@$firstName = @$exName[0];
			@$lastName  = @$exName[1];
		}*/
		
		if(@$request->tags){
			@$tags = implode(',', (array) @$request->tags);
		}else{
			@$tags = '';
		}
		
		if(@$request->dob){
			@$dob = date('Y-m-d', strtotime(@$request->dob));
		}else{
			@$dob = '';
		}
		
		/*if (!empty($request->profileImg) && @$request->profileImg != 'undefined') {
			$img = $request->profileImg;
			$extn = $img->getClientOriginalExtension();
			$path = public_path('profile/');
			$profile = rand() . '.' . $extn;
			$img->move($path, $profile);
		} else {
			$userInfo = DB::table('users')->where(['id' => $userId])->select('profile_image')->orderBy('id', 'DESC')->first();
			if(!empty($userInfo->profile_image)){
				$profile = $userInfo->profile_image;
			}else{
				$profile = '';
			}
		}*/
		

		
		//$data = ['first_name' => @$firstName, 'last_name' => @$lastName, 'email' => @$email, 'phone' => @$phone, 'address' => @$location, 'country' => @$country, 'state' => @$state, 'latitude' => @$latitude, 'longitude' => @$longitude, 'city' => @$city, 'bio' => @$bio, 'tags' => @$tags, 'dob' => @$dob, 'profile_image' => @$profile, 'updated_at' => date('Y-m-d H:i:s')];
		
		$data = ['first_name' => @$firstName, 'last_name' => @$lastName, 'email' => @$email, 'phone' => @$phone, 'address' => @$location, 'country' => @$country, 'state' => @$state, 'latitude' => @$latitude, 'longitude' => @$longitude, 'city' => @$city, 'bio' => @$bio, 'tags' => @$tags, 'dob' => @$dob, 'updated_at' => date('Y-m-d H:i:s')];
		
		
		$result = DB::table('users')->where(['id' => @$userId])->update(@$data);
		if($result){
			
			$image = array();
			if($file = $request->file('files')){
				//print_r($file);die;
				foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('photos/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data = ['image' => $image, 'user_id' => @$userId, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('user_gallery_photo')->insertGetId($data);
				}     
			}
				
			$response['status'] = 1;
			$response['msg']    = 'Your profile information updated successfully.';
			$response['userId'] = @$result;
		}else{
			$response['status'] = 0;
			$response['msg']    = 'Some error occure, Please try again.';
			$response['userId'] = '';
		}
		echo json_encode($response);	
	}
	
	public function updatePassword(Request $request)
    { 
	
	    $validator = Validator::make($request->all(), [
            'oldPassword'     => 'required',
				'newPassword'     => 'required|min:6',
				'confirmPassword' => 'required|same:newPassword',
        ]);
		
		if($validator){

			$userInfo = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->select('password')->orderBy('id', 'DESC')->first();
			
			if(md5(@$request->oldPassword) != $userInfo->password){

				return response()->json([
					'error' => 'Old password is not matched!',
					'status' => 0
				]);
			}
			$data = ['password' => md5($request->newPassword)];
			$result = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->update(@$data);
			if($result){
				
				return response()->json([
				    'message' => 'Password updated successfully.',
					'status' => 1
				]);
				
			}else{
				
				return response()->json([
					'error' => 'Some problems occurred, please try again!',
					'status' => 0
				]);
			}
			
		}else{
			
			return response()->json([
				'error' => $validator->errors()->all(),
				'status' => 0
			]);
		}
	}
	
	public function updateProfile(Request $request)
    { 
	    if (!empty($request->profileImage) && ($request->profileImage != 'undefined')) {
			$img = $request->profileImage;
			$extn = $img->getClientOriginalExtension();
			$path = public_path('profile/');
			$profile = rand() . '.' . $extn;
			$img->move($path, $profile);
		} else {
			$userInfo = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->select('profile_image')->orderBy('id', 'DESC')->first();
			if(!empty($userInfo->profile_image)){
				$profile = $userInfo->profile_image;
			}else{
				$profile = '';
			}
		}
		$result = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->update(['profile_image' => $profile]);
		if($result){
			$response['status'] = 1;
			$response['msg'] = 'Your profile image updated successfully.';
			$response['userId'] = session()->get('USERLOGINID');
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['userId'] = '';
		}
		echo json_encode($response);
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
		return view('account.product_payment', $data);
    }
	
	public function product_stripe_payment(Request $request) 
    { 
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
					'specipication' => $product['specipication'],
				];
				$i++;
			}
			
			//print_r($products_to_order[0]['product_id']);die;
			$productId = $products_to_order[0]['product_id'];
			$productUserId = DB::table('product')->where(['id' => $productId])->select('user_id')->first();
			$stripe  = DB::table('stripe_connect')->where(['userId' => @$productUserId->user_id])->select('*')->first();
			
			$stripeAccountId = '';
			if($stripe){
			    $stripecon = $this->get_stripe_info($stripe->stripe_acc_id);
				if($stripecon == 1){
					$stripeAccountId = $stripe->stripe_acc_id;
				}else{
					$stripeNotConnect = 'Your stripe not connected.Please connect stripe first.';
					$status = 0;
					return redirect()->intended("dashboard/stripe-connect?statusMsg=".$stripeNotConnect."&status=".$status."");
					exit();
				}
			}else{
				$stripeNotConnect = 'Your stripe not connected.Please connect stripe first.';
				$status = 0;
				return redirect()->intended("dashboard/stripe-connect?statusMsg=".$stripeNotConnect."&status=".$status."");
				exit();
			}
			
			//print_r($products_to_order);die;
			
			$stripe = array(
				"secret_key"      => STRIPE_SECRET_KEY,
				"publishable_key" => STRIPE_PUBLISHABLE_KEY
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
				
				$percentage = 0.2;
				$adminPercentage  = DB::table('settings')->select('admin_percentage')->first();
				if($adminPercentage){
					if(@$adminPercentage->admin_percentage){
						$percentage = $adminPercentage->admin_percentage/100;
					}
				}
				
				
				$application_fee = intval($itemPrice * $percentage);
				
				try {  
					$charge = \Stripe\Charge::create(array( 
						'customer' => $customer->id, 
						'amount'   => $itemPriceCents, 
						'currency' => 'usd', 
						'description' => $itemName,
						"destination" => $stripeAccountId,
						"application_fee" => $application_fee,
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
							
							//return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$transactionID."&userId=".$user_id."");
							
							return redirect()->intended('dashboard')->with("status", "".$statusMsg."<br/>Transaction Id : ".$transactionID."");
							
						}else{
							$statusMsg = "Transaction has been failed!"; 
							$payment_status = 'failed';
							$txnId = '';
							//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
							//return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
							return redirect()->intended('dashboard')->with("error", "$statusMsg");
						}
					}else{
						$statusMsg = "Transaction has been failed!"; 
						$payment_status = 'failed';
						$txnId = '';
						//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
						//return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
						return redirect()->intended('dashboard')->with("error", "$statusMsg");
					}
				}else{
					$statusMsg = "Charge creation failed! $api_error";  
					$payment_status = 'failed';
					$txnId = '';
				    //redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id.""),'refresh');
					//return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
					return redirect()->intended('dashboard')->with("error", "$statusMsg");
				}
			}else{
				
				$statusMsg = "Invalid card details! $api_error";
				$payment_status = 'failed';
				$txnId = '';
				//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
				//return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
				return redirect()->intended('dashboard')->with("error", "$statusMsg");
			}
		}else{
			$statusMsg = "Error on form submission."; 
			$payment_status = 'failed';
			$txnId = '';
			$userId = '';
			//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
			//return redirect()->intended("webview/productPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId."");
			return redirect()->intended('dashboard')->with("error", "$statusMsg");
			
		}
	}
	
	public function wallet()
    {
		
		$data = array(
			'title'   => 'Wallet Link',
			'page'    => 'users',
			'subpage' => 'users'
		);
		
		/*$data['allMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		$Sql = "SELECT users.id as userId, users.first_name, users.last_name, users.profile_image, favouriteusers.fav_user_id, favouriteusers.user_id FROM users INNER JOIN favouriteusers ON users.id = favouriteusers.user_id WHERE users.status='1' AND users.id='".session()->get('USERLOGINID')."'";
		$data['myMem'] = DB::select($Sql);
		$data['stripe']  = DB::table('stripe_connect')->where(['userId' => session()->get('USERLOGINID')])->select('*')->first();
		if($data['stripe']){
			$data['stripecon'] = $this->get_stripe_info($data['stripe']->stripe_acc_id);
		}else{
			$data['stripecon'] = '';
		}
		
		$Sql = "SELECT * FROM events WHERE status = '1' AND DATE(start_date) >= '".date('Y-m-d')."' order by id DESC";
		$data['eventList'] = DB::select($Sql);*/
		
		$Sql = "SELECT * FROM transaction WHERE user_id = ".session()->get('USERLOGINID')." AND (payment_type = '4' OR payment_type = '3') order by id DESC";
	    $data['alltranList'] = DB::select($Sql);
		
		$tranList  = DB::table('transaction')->where(['payment_type' => 3, 'user_id' => session()->get('USERLOGINID')])->select('*')->orderBy('id', 'DESC')->get(); 
		$data['toptranList'] = $tranList;	

        $WithdrawtranList  = DB::table('transaction')->where(['payment_type' => 4, 'user_id' => session()->get('USERLOGINID')])->select('*')->orderBy('id', 'DESC')->get();
		$data['withdrawList'] = $WithdrawtranList;	
        
        $data['walletAmount']  = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->select('wallet_amount')->orderBy('id', 'DESC')->first(); 		
		return view('account.wallet', $data);
	}
	
	public function withdrawAmount(Request $request) {
		$response = [];
		if($request->withdrawAmount && $request->withdrawAccountno){
			$userInfo  = DB::table('users')->where(['status' => 1, 'id' => @$request->userId])->select('*')->orderBy('id', 'DESC')->first();
			
			if(($userInfo->wallet_amount == '') || ($userInfo->wallet_amount == null)){
			    $response = ["status" => 0, "msg" => 'balance not available in your wallet.'];
			    echo json_encode($response);exit();
			}elseif($userInfo->wallet_amount == 0){
			    $response = ["status" => 0, "msg" => 'balance not available in your wallet.'];
			   echo json_encode($response);exit();
			}elseif($userInfo->wallet_amount < $request->withdrawAmount){
			    $response = ["status" => 0, "msg" => 'your wallet balance is not sufficient for withdraw.'];
			    echo json_encode($response);exit();
			}
			
			$user_name       = @$userInfo->first_name.' '.@$userInfo->last_name;
            $transactionID   = "txn_".$this->generate_txnId(24);
            $chargeID        = "ch_".$this->generate_txnId(24);
            $orderID         = "ORDNO-".$this->generate_otp(6);
			
			$data = ['user_name' => @$user_name, 'user_id' => @$userInfo->id, 'address' => @$userInfo->address, 'country' =>  @$userInfo->country, 'state' =>  @$userInfo->state, 'city' =>  @$userInfo->city, 'zipcode' =>  @$userInfo->zipcode, 'amount' => $request->withdrawAmount, 'currency' => 'usd', 'txn_id' => $transactionID, 'order_id' => @$orderID, 'charge_id' => @$chargeID, 'status' => 'succeeded', 'payment_type' => '4', 'created_at' => date('Y-m-d H:i:s')];
			
			
			
			$result = DB::table('transaction')->insertGetId($data);
			if($result){
				$updateAmount = $userInfo->wallet_amount - $request->withdrawAmount;
                DB::table('users')->where(['id' => @$userInfo->id])->update(['wallet_amount' => $updateAmount]); 
				$walletData = ['user_id' => @$userInfo->id, 'amount' => @$request->withdrawAmount, 'currency' => 'usd', 'txn_id' => $transactionID, 'order_id' => $orderID, 'charge_id' => $chargeID, 'status' => 'succeeded', 'created_at' => date('Y-m-d H:i:s'), 'type' => '2'];
				DB::table('wallet')->insertGetId($walletData);
				
				
				$walletRequestdata = ['withdrawAmount' => $request->withdrawAmount, 'user_id' => @$userInfo->id, 'bankName' => @$request->bankName, 'withdrawAccountno' =>  $request->withdrawAccountno, 'swiftCode' =>  @$request->swiftCode, 'created_at' => date('Y-m-d H:i:s')];
				DB::table('withdraw_request')->insertGetId($walletRequestdata); 
				
				$response = ["status" => 1, 'userId' => @$userInfo->id, "msg" => "successfully withdraw."];
			}else{
				$response = ["status" => 0, "msg" => 'Some error occurs, Please try again.'];
			}
		}else{
			$response['status'] = 0;
			$response['msg'] = 'amount and account number is required.';
		}
		echo json_encode($response);
	}
	
	public function generate_txnId($length)
	{
		$characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++)
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
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
		return view('account.topuppayment', $data);
    }
	
	public function topup_stripe_payment(Request $request) 
    {
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
				"secret_key"      => STRIPE_SECRET_KEY,
				"publishable_key" => STRIPE_PUBLISHABLE_KEY
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

							//return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$transactionID."&userId=".$user_id."");
							return redirect()->intended('dashboard')->with("status", "".$statusMsg."<br/>Transaction Id : ".$transactionID."");
							
						}else{
							$statusMsg = "Transaction has been failed!"; 
							$payment_status = 'failed';
							$txnId = '';
							//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
							//return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
							return redirect()->intended('dashboard')->with("error", "$statusMsg");
						}
					}else{
						$statusMsg = "Transaction has been failed!"; 
						$payment_status = 'failed';
						$txnId = '';
						//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
						//return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
						return redirect()->intended('dashboard')->with("error", "$statusMsg");
					}
				}else{
					$statusMsg = "Charge creation failed! $api_error";  
					$payment_status = 'failed';
					$txnId = '';
					//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id.""),'refresh');
					//return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
					return redirect()->intended('dashboard')->with("error", "$statusMsg");
				}
			}else{
				
				$statusMsg = "Invalid card details! $api_error";
				$payment_status = 'failed';
				$txnId = '';
				//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
				//return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$user_id."");
				return redirect()->intended('dashboard')->with("error", "$statusMsg");
			}
		}else{
			$statusMsg = "Error on form submission."; 
			$payment_status = 'failed';
			$txnId = '';
			$userId = '';
			//redirect(base_url("paymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId.""),'refresh');
			//return redirect()->intended("webview/topupPaymentStatus?statusMsg=".$statusMsg."&status=".$payment_status."&txnId=".$txnId."&userId=".$userId."");
			return redirect()->intended('dashboard')->with("error", "$statusMsg");
			
		}
	}
	
	public function transaction()
    {
		
		$data = array(
			'title'   => 'Transaction Link',
			'page'    => 'users',
			'subpage' => 'users'
		);
		$data['allMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		//$data['myMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		
		$Sql = "SELECT users.id as userId, users.first_name, users.last_name, users.profile_image, favouriteusers.fav_user_id, favouriteusers.user_id FROM users INNER JOIN favouriteusers ON users.id = favouriteusers.user_id WHERE users.status='1' AND users.id='".session()->get('USERLOGINID')."'";
		$data['myMem'] = DB::select($Sql);
		//print_r($data['myMem']);die;
		$data['stripe']  = DB::table('stripe_connect')->where(['userId' => session()->get('USERLOGINID')])->select('*')->first();
		if($data['stripe']){
			$data['stripecon'] = $this->get_stripe_info($data['stripe']->stripe_acc_id);
		}else{
			$data['stripecon'] = '';
		}
		$Sql = "SELECT * FROM events WHERE status = '1' AND DATE(start_date) >= '".date('Y-m-d')."' order by id DESC";
		$data['eventList'] = DB::select($Sql);
		
		$data['transactionList']  = DB::table('transaction')->where(['user_id' => session()->get('USERLOGINID')])->select('*')->get();
		
		return view('account.transaction', $data);
	}
	
	public function reward()
    {
		
		$data = array(
			'title'   => 'Reward Link',
			'page'    => 'users',
			'subpage' => 'users'
		);
		$data['allMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		//$data['myMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		
		$Sql = "SELECT users.id as userId, users.first_name, users.last_name, users.profile_image, favouriteusers.fav_user_id, favouriteusers.user_id FROM users INNER JOIN favouriteusers ON users.id = favouriteusers.user_id WHERE users.status='1' AND users.id='".session()->get('USERLOGINID')."'";
		$data['myMem'] = DB::select($Sql);
		//print_r($data['myMem']);die;
		$data['stripe']  = DB::table('stripe_connect')->where(['userId' => session()->get('USERLOGINID')])->select('*')->first();
		if($data['stripe']){
			$data['stripecon'] = $this->get_stripe_info($data['stripe']->stripe_acc_id);
		}else{
			$data['stripecon'] = '';
		}
		$Sql = "SELECT * FROM events WHERE status = '1' AND DATE(start_date) >= '".date('Y-m-d')."' order by id DESC";
		$data['eventList'] = DB::select($Sql);
		
		$data['myReward']  = DB::table('referral_rewards_transaction')->where(['user_id' => session()->get('USERLOGINID')])->select('*')->get();
		$data['userInfo']  = DB::table('users')->where(['id' => session()->get('USERLOGINID')])->select('earned_rewords_point')->first();
		return view('account.reward', $data);
	}
	
	public function term()
    {
		
		$data = array(
			'title'   => 'Term and Condition',
			'page'    => 'users',
			'subpage' => 'users'
		);
		$data['allMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		//$data['myMem']  = DB::table('users')->where(['status' => 1, 'user_type' => 10])->select('*')->get();
		
		$Sql = "SELECT users.id as userId, users.first_name, users.last_name, users.profile_image, favouriteusers.fav_user_id, favouriteusers.user_id FROM users INNER JOIN favouriteusers ON users.id = favouriteusers.user_id WHERE users.status='1' AND users.id='".session()->get('USERLOGINID')."'";
		$data['myMem'] = DB::select($Sql);
		//print_r($data['myMem']);die;
		$data['stripe']  = DB::table('stripe_connect')->where(['userId' => session()->get('USERLOGINID')])->select('*')->first();
		if($data['stripe']){
			$data['stripecon'] = $this->get_stripe_info($data['stripe']->stripe_acc_id);
		}else{
			$data['stripecon'] = '';
		}
		$Sql = "SELECT * FROM events WHERE status = '1' AND DATE(start_date) >= '".date('Y-m-d')."' order by id DESC";
		$data['eventList'] = DB::select($Sql);
		
		$data['cms'] = DB::table('cms')->where(['id' => 2])->select('*')->first();
		return view('account.term', $data);
	}
	
	function cancelSubscription(Request $request){
		$update = [];
			require "vendor/stripe/stripe-php/init.php";
			$stripe = new \Stripe\StripeClient(STRIPE_SECRET_KEY);
			if ($request->userId) {
				$userId = $request->userId;
				$status = $request->status;
				if($status == '0'){
					$current_date = date("Y-m-d");
					
					//$subscription = $this->db->query("select * from transaction where user_id = '".@$userId."' AND payment_type = '1' AND DATE(end_date) >= '".@$current_date."' AND auto_renew_status = '1'")->result();
					
					$subscription = DB::table('transaction')->whereRaw("user_id = '".@$userId."' AND expiry_date >= '".date('Y-m-d')."' AND payment_type = 1 AND status = 'succeeded'")->select('*')->get();
					
                    if(!empty(@$subscription)){
						foreach($subscription as $k => $v){
							@$subId = @$v->stripe_sub_id;
							@$id    = @$v->id;
							
							$subCancel = $stripe->subscriptions->cancel("$subId", []);
							$subsData = $subCancel->jsonSerialize();
							if($subsData['status'] == 'canceled'){
								
								$update[] = DB::table('transaction')->where(['id' => @$id])->update(['auto_renew_status' => '0']);
								//$update[] = $this->db->query("update transaction set auto_renew_status = '0' where id = '".@$id."'");
								//$this->db->query("update users set auto_renew_status = '0' where id = '".@$userId."'");
								DB::table('users')->where(['id' => @$userId])->update(['auto_renew_status' => '0']);
								
							}
					    }
						$response['status'] = 1;
						$response['message'] = 'Your auto renew subscription is canceled.';
					}else{
						//$this->db->query("update users set auto_renew_status = '".$status."' where id = '".@$userId."'");
						DB::table('users')->where(['id' => @$userId])->update(['auto_renew_status' => @$status]);
						$response['status'] = 1;
						$response['message'] = 'Your auto renew subscription is start.';
					}
					
				}else{
					//$this->db->query("update users set auto_renew_status = '".$status."' where id = '".@$userId."'");
					DB::table('users')->where(['id' => @$userId])->update(['auto_renew_status' => @$status]);
					$response['status'] = 1;
					$response['message'] = 'Your auto renew subscription is start.';
				}
			}else{
				$response['status'] = 0;
				$response['message'] = 'Some error occure, Please try again.';
			}
	    echo json_encode($response);
	}
	
	public function saveAdvs(Request $request)
    { 		
		$title        = @$request->title;

		if (!empty($request['ads_image']) && @$request['ads_image'] != 'undefined') {
            $img  = $request['ads_image'];
            $extn = $img->getClientOriginalExtension();
            $path = public_path('ads/');
            $file_name = rand() . '.' . $extn;
            $img->move($path, $file_name);
        } else {
            $file_name = '';
        }
		
		
		$data = ['title' => $title, 'image' => @$file_name, 'user_id' => session()->get('USERLOGINID'), 'status' => 0, 'created_at' => date('Y-m-d H:i:s')];

		$result = DB::table('advertise')->insertGetId($data);
		if($result){
			$response['status'] = 1;
			$response['msg'] = 'Your advertise added successfully.';
			$response['adsId'] = $result;
			//return redirect()->intended('admin/promotion')->with("status", "Ads added successfully!");
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occure, Please try again.';
			$response['adsId'] = '';
		}
		echo json_encode($response);	
    }
	
	public function network_details($id)
    {
		
		$data = array(
			'title'   => 'Network Details',
			'page'    => 'users',
			'subpage' => 'users'
		);
		$data['AdvsPlan']  = DB::table('advertise_sub_plan')->where(['status' => 1])->select('*')->get();
		$data['userInfo']  = DB::table('users')->where(['id' => @$id])->select('*')->first();
		return view('account.network_details', $data);
	}
	
	function get_stripe_info_test($stripe_acc_id = 'acct_1QSbKL4FJ1jMkTDF')
	{
		$url = 'https://api.stripe.com/v1/accounts/'.@$stripe_acc_id.'';
		$skey = STRIPE_SECRET_KEY;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "".$url."");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
		curl_setopt($ch, CURLOPT_POST, 1);
		$headers = array();
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Authorization: Bearer ".$skey."";
		//$headers[] = "client_secret: ".STRIPE_SECRET_KEY."";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		print_r($result);
		$get_data = json_decode($result);
		if(!empty($get_data->payouts_enabled) AND !empty($get_data->charges_enabled) AND $get_data->payouts_enabled == 1 AND $get_data->charges_enabled == 1)
		{
			$status = '1';
		}else{
			$status = '0';
		}
		return $status;
	}
	
	public function purchase_history()
    {
		
		$data = array(
			'title'   => 'Purchase History',
			'page'    => 'users',
			'subpage' => 'users'
		);
		$data['purList']  = DB::table('transaction')->where(['payment_type' => 6, 'user_id' => session()->get('USERLOGINID')])->select('*')->get();
		
		return view('account.purchasehistory', $data);
	}
	public function load_network_data()
    {
		if(!empty($_GET['lastId'])){
			$lastId = $_GET['lastId'];
			//echo $lastId;die;
			$newre = '';
			
			$get_data = DB::table('users')->whereRaw("id != '".session()->get('USERLOGINID')."' AND (user_type = 8 OR user_type = 10) AND status = 1 AND id > ".$lastId."")->limit(10)->select('*')->orderBy('id', 'ASC')->get();
			
			if(count($get_data) > 0){
				foreach($get_data as $k => $v){
					if(!empty(@$v->profile_image) && file_exists('public/profile/'.@$v->profile_image.'')){
						$profilePic = url('profile/'.@$v->profile_image.'');
					}else{
						$profilePic = url('profile/unnamed.jpg');
					}
					
					$userType = '';
					if(@$v->user_type == 8){
						$userType = 'SERVICE PROVIDER';
					}elseif(@$v->user_type == 10){
						$userType = 'A & E';
					}
					
					$numRows = DB::table('favouriteusers')->where(['user_id' => session()->get('USERLOGINID'), 'fav_user_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->count();
					
					if($numRows > 0){
						$fav = '<i class="fa fa-heart" aria-hidden="true"></i>';
					}else{
						$fav = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
					}
				
					$newre.='
						<div class="Card col-lg-4 col-md-4 col-sm-6 mt-3 post-item" relid-1="'.@$v->id.'">
						  <div class="NetworkCartBlock" >
							<a href="'.url('dashboard/network-details/'.@$v->id.'').'"><div class="UserDetails NetworkProfile-11" relid="'.@$v->id.'">
							  <img src="'.@$profilePic.'" alt="" >
							  <p class="Heading" style="color:black;">'.@$v->first_name.' '.@$v->last_name.'</p>
							</div></a>
							
							<div class="BtnDetails">
							  <div class="NameTag">
								<p class="m-0">'.@$userType.'</p>
								
							  </div>
							  
							  <a href="javascript:void(0)" class="LikeBtn allmemLike bookmarkUsers" id="allbookmarkUsers_'.@$v->id.'" relid="'.@$v->id.'">
								'.@$fav.'
							  </a>
							  
							</div>
						  </div>
						</div>
					';
				}
			}
		}
		echo $newre;
	}
	
	public function saleList()
    {
		
		$data = array(
			'title'   => 'Sales List',
			'page'    => 'users',
			'subpage' => 'users'
		);
		
		$data['myProList'] = [];
		//$data['purList']  = DB::table('transaction')->where(['payment_type' => 6, 'user_id' => session()->get('USERLOGINID')])->select('*')->get();
		$proList  = DB::table('transaction')->where(['payment_type' => 6])->select('*')->get();
		if(count($proList) > 0){
			foreach($proList as $k => $v){
				$productInfo = unserialize($v->product_info);
				
				foreach($productInfo as $proKey => $proVal){
					$proList_1 = DB::table('product')->where(['id' => @$proVal['product_id'], 'user_id' => session()->get('USERLOGINID')])->select('*')->first();
					
					if(!empty(@$proList_1)){
						$data['myProList'][] =  $proList_1;
					}
					
					
				}
			}
		}
		
		//print_r($data['myProList']);die;
		
		return view('account.salelist', $data);
	}
	
	public function referInvite(Request $request)
    { 		
		$refer_name   = @$request->name;
		$refer_email   = @$request->email;
		$refer_phone   = @$request->phone;
		$refer_code    = @$request->code;
		$sender_id     = session()->get('USERLOGINID');

		
		$data = ['sender_id' => $sender_id, 'reffer_user_name' => @$refer_name, 'reffer_user_email' => @$refer_email, 'reffer_user_phone' => @$refer_phone, 'status' => '2', 'reffer_code' => @$refer_code, 'created_at' => date('Y-m-d H:i:s')];

		$result = DB::table('reffer')->insertGetId($data);
		if($result){
			
			$setting = DB::table('settings')->where(['settingId' => 1])->select('*')->orderBy('settingId', 'DESC')->first();				
			$imagePath = url('setting/'.@$setting->logo.'');
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
			box-sizing:border-box; -webkit-print-color-adjust: exact;font-family: Poppins, sans-serif; background:url(".@$imagebackPath.")'>
			<div style='padding:20px; box-sizing: border-box;text-align: center; background: #fff;'>
			<a href='#'><img src='".@$imagePath."' style='width: 80%;'></a>
			</div>
			<div style='width: 400px; margin:50px auto;background: #ffffffd1;padding: 50px;text-align: center;'>
			<h1 style=' font-size: 30px; line-height: 32px; color: #0b0b0b; margin: 30px 0;'>Dear ".@$refer_name."</h1>
			<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>Your Refer Code is: ".@$refer_code."</p>
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

			$this->sentMail($refer_email, $message, $subject);	
			$response['status'] = 1;
			$response['msg'] = 'Your referral request has been sent successfully!';
			$response['referId'] = $result;
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occurred, Please try again.';
			$response['adsId'] = '';
		}
		echo json_encode($response);	
    }
	
	
	
	public function resent_referral(Request $request)
    { 		
		$id   = @$request->referralId;
		
         $referralInfo = DB::table('reffer')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
		
		
			
			$setting = DB::table('settings')->where(['settingId' => 1])->select('*')->orderBy('settingId', 'DESC')->first();				
			$imagePath = url('setting/'.@$setting->logo.'');
			$imagebackPath = '';
			$subject = "Referral Code (StarBiz)";
			
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
			box-sizing:border-box; -webkit-print-color-adjust: exact;font-family: Poppins, sans-serif; background:url(".@$imagebackPath.")'>
			<div style='padding:20px; box-sizing: border-box;text-align: center; background: #fff;'>
			<a href='#'><img src='".@$imagePath."' style='width: 80%;'></a>
			</div>
			<div style='width: 400px; margin:50px auto;background: #ffffffd1;padding: 50px;text-align: center;'>
			<h1 style=' font-size: 30px; line-height: 32px; color: #0b0b0b; margin: 30px 0;'>Dear ".@$referralInfo->reffer_user_name."</h1>
			<p style='font-size: 15px;color: #262626;line-height: 24px;margin: 20px 0;'>Your Refer Code is: ".@$referralInfo->reffer_code."</p>
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

			$this->sentMail($referralInfo->reffer_user_email, $message, $subject);	
			$response['status'] = 1;
			$response['msg'] = 'Your referral request has been sent successfully!';
			
		
		echo json_encode($response);	
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
		$mail->Username = 'starbiznetwork7@gmail.com';                
		$mail->Password = 'krvm xzzz vumq fdll';
		return $mail->send();
	}
	
	
	public function load_allbusiness_data()
    {
		
		$businessMng = DB::table('sub_permision_menu')->where(['sub_id' => $_GET['subId'], 'menu_id' => 1])->select('*')->first();
		if(!empty($_GET['lastId'])){
			$lastId = $_GET['lastId'];
			//echo $lastId;die;
			$newre = '';
			$get_data = DB::table('listing')->select('*')->whereRaw("status = 1 AND id < ".$lastId."")->limit(5)->orderBy('id', 'DESC')->get();
			if(count($get_data) > 0){
				foreach($get_data as $k => $v){
					$category = DB::table('listing_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
						$image    = DB::table('listing_image')->where(['listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
						
						if(@$v->user_id == 0){
							$userName = 'Admin';							$userProfile = url('profile/unnamed.jpg');
						}else{
							$checkUser = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
							if($checkUser){
								$userName = $checkUser->first_name.' '.$checkUser->last_name;
							}else{
								$userName = '';
							}
							if(!empty($checkUser->profile_image) && file_exists('public/profile/'.$checkUser->profile_image.'')){
								$userProfile = url('profile/'.$checkUser->profile_image.'');
							}else{
								$userProfile = url('profile/unnamed.jpg');
							}
						}
						if(!empty($image->image) && file_exists('public/listing/'.$image->image.'')){
							$galleryImg = url('listing/'.$image->image.'');
						}else{
							$galleryImg = url('noimage.jpg');
						}
						
						// $startDate  = $v->start_date;
						// $start_date = date('Y-m-d', strtotime($startDate));
						// $start_time = date('H:i:s', strtotime($startDate));
						
						$numRows = DB::table('favouritebusiness')->where(['user_id' => session()->get('USERLOGINID'), 'listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->count();
						
						if($numRows > 0){
							$fav = '<i class="fa fa-heart" aria-hidden="true"></i>';
						}else{
							$fav = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
						}
                        
						if(@$businessMng->write_access == 1 || @$businessMng->full_access == 1){
							$edit = '<a  href="javascript::void(0);" class="edit-business-detail" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#EditBusinessModal">
								<i class="fa fa-pencil-square" aria-hidden="true"></i>
							</a>';
						}else{
							$edit = '';
						}
						
                        if(@$businessMng->full_access == 1){						
							$delete = '<a href="javascript:void(0)" onclick="deleteBusiness('. @$v->id .')" data-bs-toggle="modal" data-bs-target="#DeleteEventModal-1">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</a>';
					    }else{
							$delete = '';
						}
						
					$newre.='
					<div class="Card col-lg-3 col-md-3 col-sm-6 post-item" relid-1="'.@$v->id.'">
					<div class="CardInner business-detail-1"   style="background:url('.@$galleryImg.') no-repeat center center / cover;" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#DetailsMyBusinessModal">
					<div class="Cover" ></div>
					<img class="UserImage"
					src="'.@$userProfile.'"
					alt="">
					<p class="Heading">'.@$v->business_name.'</p>
					<p class="SubHeading">'.@$userName.'</p>
					<p class="SubHeading">Location: '.substr(@$v->address,0,40).'</p>
					<!--<p class="SubHeading">Date: '.@$start_date.'</p>
					<p class="SubHeading">Time: '.@$start_time.'</p>-->
					<div class="IconContainer" >

					<a href="javascript:void(0);" class="bookmarkBusiness" id="allbookmarkBusiness_'.@$v->id.'" relid="'.@$v->id.'">
					'.@$fav.'
					</a>
					'.@$edit.'
					'.@$delete.'
					</div>
					</div>
					</div>
					';
				}
			}
		}
		echo $newre;
	}
	
	
	public function get_invitee_user_model(Request $request)
    { 		
	
	    $inviteeProfile = '';
			$inviteeId = [];
			$invitation  = DB::table('invitation')->where(['event_id' => @$request->eventId])->select('*')->get();
			if(count($invitation) > 0){
				foreach($invitation as $k => $v){
					$get_receiverInfo  = DB::table('repeat_invitation')->where(['invitation_id' => @$v->id])->select('*')->first();
					$inviteeId[] = $get_receiverInfo->receiver_id;
				}
			}
			
			if(count($inviteeId) > 0){
				$inviteeId = array_unique($inviteeId);
				$eventAttendeeId = join(",", $inviteeId);
				
				$attendeeUser = DB::table('users')->whereRaw("status = 1 AND id IN($eventAttendeeId)")->select('*')->orderBy('id', 'ASC')->get();
				if(count($attendeeUser) > 0){
					
					$i = 1;
					foreach($attendeeUser as $k => $v){
						
						if(@$i == 1){
							$class = '';
						}else{
							$class = 'position-absolute z-1';
						}
						
						if(!empty(@$v->profile_image) && file_exists('public/profile/'.@$v->profile_image.'')){
						    $profile_1 = url('profile/'.@$v->profile_image.'');
						}else{
							$profile_1  = url('profile/unnamed.jpg');
						}
						
						$inviteeProfile.='
						<div class="col-lg-4 col-md-4 ps-0">
                          <div class="InvitedContainBlock">
                            <div class="Data">
                              <img
                                src="'.@$profile_1.'"
                                alt="">
                              <p>'.@$v->first_name.' '.@$v->last_name.'</p>
                            </div>
                            <a href="">
                              Invited
                            </a>
                          </div>
                        </div>
						
						';
						$i++;
					}
				}else{
					$inviteeProfile='Not found any invited people list.';
				}
			}else{
				$inviteeProfile='Not found any invited people list.';
			}
			
			$allAthaleticUser = '';
			$allAthaletic = DB::table('users')->whereRaw("status = 1 AND user_type = 8")->select('*')->orderBy('id', 'DESC')->get();
			if(count($allAthaletic) > 0){
				foreach($allAthaletic as $k => $v){
					
					if(!empty(@$v->profile_image) && file_exists('public/profile/'.@$v->profile_image.'')){
						$profile_2 = url('profile/'.@$v->profile_image.'');
					}else{
						$profile_2  = url('profile/unnamed.jpg');
					}
					$allAthaleticUser.= '
					    <div class="col-lg-4 col-md-4 ps-0 mb-4">
                          <div class="AllContainBlock">
                            <div class="Data">
                              <img src="'.@$profile_2.'" alt="">
                               <p>'.@$v->first_name.' '.@$v->last_name.'</p>
                            </div>
                            <a href="">
                              <img src="'.url('assets/home/images/Icon7.png').'" alt="">
                            </a>
                          </div>
                        </div>
					
					';
				}
			}else{
				$allAthaleticUser ='Not found any user list.';
			}
			
			
	    $newre='
                    <div class="tab-pane fade show active" id="AllTab" role="tabpanel" aria-labelledby="All-Tab">
                      <div class="row m-0 AllContain">
                        '.@$allAthaleticUser.'
                      </div>
                    </div>
                    <div class="tab-pane fade" id="InvitedPeopleTab" role="tabpanel"
                      aria-labelledby="InvitedPeople-Tab">
                      <div class="row m-0 InvitedContain">
					  
                        '.@$inviteeProfile.'
						
                      </div>
                    </div>';
					echo $newre;
	}
	
	public function get_user_photo(Request $request)
    {
		$output        = '';
		$galleryPhotos = '';
		
		if(@$request->userId){
			$gallery  = DB::table('user_gallery_photo')->where(['user_id' => @$request->userId])->select('*')->get();
			if(count($gallery) > 0){
				$i=1;
				foreach($gallery as $imgKey => $imgVal){
					
					if(!empty(@$imgVal->image) && file_exists('public/photos/'.@$imgVal->image.'')){
						$imageUrl_1 = url('photos/'.@$imgVal->image.'');
					}else{
						$imageUrl_1 = url('noimage.jpg');
					}
					
					$galleryPhotos.='
						<div class="carousel-item '.((@$i == 1) ? 'active' : '').'">
							<img style="height: 75vh;"
							  src="'.@$imageUrl_1.'"
							  class="d-block w-100" alt="">
						</div>
					';
					$i++;
				}	
				
				$output= '
					<div class="row PromotionDetail">
						<div class="col-md-12 col-sm-12 PromotionImg">
						  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
						  
							<div class="carousel-inner">
							  
							  '.@$galleryPhotos.'
							  
							 
							</div>
							
							<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
							  data-bs-slide="prev">
							  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
							  data-bs-slide="next">
							  <span class="carousel-control-next-icon" aria-hidden="true"></span>
							  <span class="visually-hidden">Next</span>
							</button>
						  </div>
						</div>
					  </div>
				';
					
			}
		}
		echo $output;
	}
	
	public function delete_product(Request $request)
    { 
	    if(empty(@$request->productId)){
			return false;
		}
		
        $result = DB::table('product')->where('id', @$request->productId)->delete();
		if($result){
			$response['status'] = 1;
			$response['msg'] = 'Your product deleted successfully.';
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occurred, Please try again.';
		} 
		echo json_encode($response);	
    }
	
	public function delete_service(Request $request)
    { 
	    if(empty(@$request->serviceId)){
			return false;
		}
		
        $result = DB::table('services')->where('id', @$request->serviceId)->delete();
		if($result){
			$response['status'] = 1;
			$response['msg'] = 'Your service deleted successfully.';
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Some error occurred, Please try again.';
		} 
		echo json_encode($response);	
    }
	
	public function searchInvitePeople(Request $request)
    {
		 $inviteeProfile = '';
			$inviteeId = [];
			$invitation  = DB::table('invitation')->where(['event_id' => @$request->eventId])->select('*')->get();
			if(count($invitation) > 0){
				foreach($invitation as $k => $v){
					$get_receiverInfo  = DB::table('repeat_invitation')->where(['invitation_id' => @$v->id])->select('*')->first();
					$inviteeId[] = $get_receiverInfo->receiver_id;
				}
			}
			
			if(count($inviteeId) > 0){
				$inviteeId = array_unique($inviteeId);
				$eventAttendeeId = join(",", $inviteeId);
				
				$attendeeUser = DB::table('users')->whereRaw("status = 1 AND id IN($eventAttendeeId)")->select('*')->orderBy('id', 'ASC')->get();
				if(count($attendeeUser) > 0){
					
					$i = 1;
					foreach($attendeeUser as $k => $v){
						
						if(@$i == 1){
							$class = '';
						}else{
							$class = 'position-absolute z-1';
						}
						
						if(!empty(@$v->profile_image) && file_exists('public/profile/'.@$v->profile_image.'')){
						    $profile_1 = url('profile/'.@$v->profile_image.'');
						}else{
							$profile_1  = url('profile/unnamed.jpg');
						}
						
						$inviteeProfile.='
						<div class="col-lg-4 col-md-4 ps-0">
                          <div class="InvitedContainBlock">
                            <div class="Data">
                              <img
                                src="'.@$profile_1.'"
                                alt="">
                              <p>'.@$v->first_name.' '.@$v->last_name.'</p>
                            </div>
                            <a href="">
                              Invited
                            </a>
                          </div>
                        </div>
						
						';
						$i++;
					}
				}else{
					$inviteeProfile='Not found any invited people list.';
				}
			}else{
				$inviteeProfile='Not found any invited people list.';
			}
			
			$allAthaleticUser = '';
			$allAthaletic = DB::table('users')->whereRaw("status = 1 AND user_type = 8 AND CONCAT(first_name, ',', last_name) LIKE '%$request->searchText%'")->select('*')->orderBy('id', 'DESC')->get();
			if(count($allAthaletic) > 0){
				foreach($allAthaletic as $k => $v){
					
					if(!empty(@$v->profile_image) && file_exists('public/profile/'.@$v->profile_image.'')){
						$profile_2 = url('profile/'.@$v->profile_image.'');
					}else{
						$profile_2  = url('profile/unnamed.jpg');
					}
					$allAthaleticUser.= '
					    <div class="col-lg-4 col-md-4 ps-0 mb-4">
                          <div class="AllContainBlock">
                            <div class="Data">
                              <img src="'.@$profile_2.'" alt="">
                               <p>'.@$v->first_name.' '.@$v->last_name.'</p>
                            </div>
                            <a href="">
                              <img src="'.url('assets/home/images/Icon7.png').'" alt="">
                            </a>
                          </div>
                        </div>
					
					';
				}
			}else{
				$allAthaleticUser ='Not found any user list.';
			}
			
			
	    $newre='
                    <div class="tab-pane fade show active" id="AllTab" role="tabpanel" aria-labelledby="All-Tab">
                      <div class="row m-0 AllContain">
                        '.@$allAthaleticUser.'
                      </div>
                    </div>
                    <div class="tab-pane fade" id="InvitedPeopleTab" role="tabpanel"
                      aria-labelledby="InvitedPeople-Tab">
                      <div class="row m-0 InvitedContain">
					  
                        '.@$inviteeProfile.'
						
                      </div>
                    </div>';
					echo $newre;
	}
	
	
	function autoSuggestion(Request $request){
		$output = '';
		
		if(@$request->keyword){
			$Sql = "SELECT business_name as name, 'business' as const_value FROM listing where business_name LIKE '%$request->keyword%' AND status = '1' UNION SELECT CONCAT(first_name, ' ', last_name) as name, 'user' as const_value  FROM users where CONCAT(first_name, ',', last_name) LIKE '%$request->keyword%' AND status = '1' UNION SELECT event_name as name, 'event' as const_value FROM events where event_name LIKE '%$request->keyword%' AND status = '1' AND DATE(start_date) >= '".date('Y-m-d')."'";
			$result = DB::select($Sql);
			//$output.='<ul id="country-list">';
			if(count(@$result) > 0){
				foreach($result as $k => $v){
					
					
					$output.='<div class="col-md-12 col-sm-12 SearchDataContainer">
						<a href="javascript:void(0);" search="'.$v->name.'" keywork="'.@$v->const_value.'" class="selectCountry">
							<div class="SearchDataBlock">
							    <img class="ActiveImg" src="'.url('assets/home/images/Icon17.png').'" alt="">
							</div>
							<p>'.$v->name.'</p>
						</a>
					</div>';
				}
			}else{
				$output.='';
			}
		}
		//$output.='</ul>';
		echo $output;
	}
	
	function search(){
		if(!empty(@$_GET['search']) && !empty(@$_GET['keyword'])){
			$search  = $_GET['search'];
			$keyword = $_GET['keyword'];
			$Sql = "SELECT business_name as name, id, user_id, 'start_date' as start_date, 'location' as location FROM listing where business_name LIKE '%$search%' AND status = '1' UNION SELECT CONCAT(first_name, ' ', last_name) as name, id, 'user_id' as user_id, 'start_date' as start_date, 'location' as location FROM users where CONCAT(first_name, ' ', last_name) LIKE '%$search%' AND status = '1' UNION SELECT event_name as name, id, user_id, start_date, location FROM events where event_name LIKE '%$search%' AND status = '1' AND DATE(start_date) >= '".date('Y-m-d')."'";
			$data['result'] = DB::select($Sql);
			//print_r($data['result']);die;
		}
		$data['AdvsPlan']=[];
		return view('account.search', $data);
	}
	function downloadCsvAll(){

		$filename = 'transaction_list'.date('Ymd').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

		if(!empty(@$_GET['search']) && @$_GET['type'] == 'filter'){
			$data['list'] = DB::table('events')->where(['status' => 1, 'id' => @$_GET['search']])->select('*')->orderBy('id', 'DESC')->get();
		}elseif(!empty(@$_GET['promoter']) && @$_GET['type'] == 'filterPromoter'){
			$data['list'] = DB::table('events')->where(['status' => 1, 'user_id' => @$_GET['promoter']])->select('*')->orderBy('id', 'DESC')->get();
		}elseif(@$_GET['promoter'] == 0 && @$_GET['type'] == 'filterPromoter'){
			$data['list'] = DB::table('events')->where(['status' => 1, 'user_id' => @$_GET['promoter']])->select('*')->orderBy('id', 'DESC')->get();
		}else{
			$data['list']  = DB::table('transaction')->where(['user_id' => session()->get('USERLOGINID')])->select('*')->get();
		}

		$array = [];
		
		

		foreach($data['list'] as $k => $v ){
			/*if(@$v->user_id == 0){
				$name = 'Admin';
				$email  = 'admin@gmail.com';
			}else{
				//$userInfo = $this->db->query("select * from users where user_id = ".@$v->user_id."")->row();
				$userInfo = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
				$name = @$userInfo->first_name.' '.@$userInfo->last_name;
				$email = @$userInfo->email;
			}

			
			$payoutAmount = DB::select("select sum(amount) as Totalamount from transaction where event_id = ".@$v->id." AND status = 'succeeded'");
			
			$getPer = DB::table('settings')->select('admin_percentage')->first();
                                                   
			$percentage = $getPer->admin_percentage;		
			$totalWidth = @$payoutAmount[0]->Totalamount;								
			$adminShare = ($percentage / 100) * $totalWidth;	
			$promoterShare = @$payoutAmount[0]->Totalamount - $adminShare;*/
			
			if(($v->payment_type == '') || ($v->payment_type == 1)){
				if(@$v->sub_id){
					$subInfo = DB::table('sub_plan')->where(['id' => @$v->sub_id])->select('name')->first();
					//print_r($subInfo);
					if(!empty($subInfo)){
						$subname = $subInfo->name;
					}else{
						$subname = '--';
					}
				}else{
					$subname = '--';
				}
				$payment = 'Subscription Payment';
			}elseif($v->payment_type == 3){
				$payment = 'Top Up';
				$subname = '--';
			}elseif($v->payment_type == 4){
				$payment = 'Withdraw';
				$subname = '--';
			}elseif($v->payment_type == 5){
				$payment = 'Invited Event Payment';
				$subname = '--';
			}elseif($v->payment_type == 6){
				$payment = 'Product Payment';
				$subname = '--';
			}else{
				if(@$v->sub_id){
					$subInfo = DB::table('ads_sub_plan')->where(['id' => @$v->sub_id])->select('name')->first();
					//print_r($subInfo);
					if(!empty($subInfo)){
						$subname = $subInfo->name;
					}else{
						$subname = '--';
					}
					
				}else{
					$subname = '--';
				}
				$payment = 'Ads Payment';
			}
			
			$array[] = [
			    'OrderId' => @$v->order_id,
			    'PaymentDate' => date('F d, Y', strtotime(@$v->created_at)),
			    'Amount' => @$v->amount,
			    'TransactionId' => @$v->txn_id,
			    'PaymentType' => $payment,
			];
		}
		
		//print_r($array);die;
		
		$file = fopen('php://output', 'w');
		$header = array("OrderId", "Payment Date", "Amount", "TransactionId", "Payment Type"); 
		fputcsv($file, $header);
		foreach ($array as $key=>$line)
		{ 
			fputcsv($file, $line); 
		}
		fclose($file); 
		exit; 
	}
	
	
	function downloadCsvWallet(){

		$filename = 'wallet_list'.date('Ymd').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

		if(!empty(@$_GET['search']) && @$_GET['type'] == 'filter'){
			$data['list'] = DB::table('events')->where(['status' => 1, 'id' => @$_GET['search']])->select('*')->orderBy('id', 'DESC')->get();
		}elseif(!empty(@$_GET['promoter']) && @$_GET['type'] == 'filterPromoter'){
			$data['list'] = DB::table('events')->where(['status' => 1, 'user_id' => @$_GET['promoter']])->select('*')->orderBy('id', 'DESC')->get();
		}elseif(@$_GET['promoter'] == 0 && @$_GET['type'] == 'filterPromoter'){
			$data['list'] = DB::table('events')->where(['status' => 1, 'user_id' => @$_GET['promoter']])->select('*')->orderBy('id', 'DESC')->get();
		}else{
			$Sql = "SELECT * FROM transaction WHERE user_id = ".session()->get('USERLOGINID')." AND (payment_type = '4' OR payment_type = '3') order by id DESC";
			$data['list'] = DB::select($Sql);
		}

		$array = [];
		
		

		foreach($data['list'] as $k => $v ){
			/*if(@$v->user_id == 0){
				$name = 'Admin';
				$email  = 'admin@gmail.com';
			}else{
				//$userInfo = $this->db->query("select * from users where user_id = ".@$v->user_id."")->row();
				$userInfo = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
				$name = @$userInfo->first_name.' '.@$userInfo->last_name;
				$email = @$userInfo->email;
			}

			
			$payoutAmount = DB::select("select sum(amount) as Totalamount from transaction where event_id = ".@$v->id." AND status = 'succeeded'");
			
			$getPer = DB::table('settings')->select('admin_percentage')->first();
                                                   
			$percentage = $getPer->admin_percentage;		
			$totalWidth = @$payoutAmount[0]->Totalamount;								
			$adminShare = ($percentage / 100) * $totalWidth;	
			$promoterShare = @$payoutAmount[0]->Totalamount - $adminShare;*/
			
			if(@$v->payment_type == 3){
				$type = 'Top Up';
				$Red = '';
			}elseif(@$v->payment_type == 4){
				$type = 'Withdraw';
				$Red = 'Red';
			}
			$date = '';
			if(!empty(@$v->created_at) && @$v->created_at == '0000-00-00 00:00:00'){
				$date = date('M d, Y', strtotime(@$v->created_at));
			}
			
			$array[] = [
			    'OrderId' => @$v->order_id,
			    'PaymentDate' => date('F d, Y', strtotime(@$v->created_at)),
			    'Amount' => @$v->amount,
			    //'TransactionId' => @$v->txn_id,
			    'PaymentType' => $type,
			];
		}
		
		//print_r($array);die;
		
		$file = fopen('php://output', 'w');
		$header = array("OrderId", "Payment Date", "Amount", "Payment Type"); 
		fputcsv($file, $header);
		foreach ($array as $key=>$line)
		{ 
			fputcsv($file, $line); 
		}
		fclose($file); 
		exit; 
	}
	
	function downloadCsvReferral(){

		$filename = 'myreferral_list'.date('Ymd').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

		if(!empty(@$_GET['search']) && @$_GET['type'] == 'filter'){
			$data['list'] = DB::table('events')->where(['status' => 1, 'id' => @$_GET['search']])->select('*')->orderBy('id', 'DESC')->get();
		}elseif(!empty(@$_GET['promoter']) && @$_GET['type'] == 'filterPromoter'){
			$data['list'] = DB::table('events')->where(['status' => 1, 'user_id' => @$_GET['promoter']])->select('*')->orderBy('id', 'DESC')->get();
		}elseif(@$_GET['promoter'] == 0 && @$_GET['type'] == 'filterPromoter'){
			$data['list'] = DB::table('events')->where(['status' => 1, 'user_id' => @$_GET['promoter']])->select('*')->orderBy('id', 'DESC')->get();
		}else{
			$data['list']  = DB::table('reffer')->where(['sender_id' => session()->get('USERLOGINID')])->select('*')->get();
		}

		$array = [];
		
		

		foreach($data['list'] as $k => $v ){
			/*if(@$v->user_id == 0){
				$name = 'Admin';
				$email  = 'admin@gmail.com';
			}else{
				//$userInfo = $this->db->query("select * from users where user_id = ".@$v->user_id."")->row();
				$userInfo = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
				$name = @$userInfo->first_name.' '.@$userInfo->last_name;
				$email = @$userInfo->email;
			}

			
			$payoutAmount = DB::select("select sum(amount) as Totalamount from transaction where event_id = ".@$v->id." AND status = 'succeeded'");
			
			$getPer = DB::table('settings')->select('admin_percentage')->first();
                                                   
			$percentage = $getPer->admin_percentage;		
			$totalWidth = @$payoutAmount[0]->Totalamount;								
			$adminShare = ($percentage / 100) * $totalWidth;	
			$promoterShare = @$payoutAmount[0]->Totalamount - $adminShare;*/
			
			$userInfo = DB::table('users')->where(['email' => $v->reffer_user_email])->select('*')->first();
					
			if(!empty(@$userInfo)){
				
				if(@$userInfo->first_name || @$userInfo->last_name){
					$userName = @$userInfo->first_name.' '.@$userInfo->last_name;
				}else{
					$userName = @$v->reffer_user_name;
				}
				
				if(@$userInfo->email){
					$userEmail = @$userInfo->email;
				}else{
					$userEmail = @$v->reffer_user_email;
				}
				
				$registerStatus = 1;
				$date_of_activation = date('M d, Y', strtotime(@$userInfo->created_at));
				$date_of_activationClass="DoneStatus";
				$style = 'style="margin-bottom: -36px;"';
				
				if((@$userInfo->first_name || @$userInfo->last_name) && @$userInfo->email && @$userInfo->phone && @$userInfo->address && @$userInfo->profile_image && @$userInfo->bio && @$userInfo->dob){
					$profileStatus = 1;
				}else{
					$profileStatus = 0;
				}
				
				
				$eventInfo = DB::table('events')->where(['user_id' => $userInfo->id])->select('*')->get();
				if(count(@$eventInfo) > 0){
					$eventStatus = 1;
				}else{
					$eventStatus = 0;
				}
				
				
				
			}else{
				$userName = @$v->reffer_user_name;
				$userEmail = @$v->reffer_user_email;
				$registerStatus = 0;
				$profileStatus = 0;
				$eventStatus = 0;
				$date_of_activation = '';
				$style = '';
				$date_of_activationClass="PendingStatus";
			}
			
			if($registerStatus == 1){
				$signUp = '<img src="'.url('assets/home/images/Icon33.png').'" alt="">';
				$signUpClass = 'm-0';
				$signUpStatus = 'Done';
				$signUpStatusClass = 'DoneStatus';
			}else{
				$signUp = '<img src="'.url('assets/home/images/Icon34.png').'" alt="">';
				$signUpClass = 'notm-0';
				$signUpStatus = 'Pending';
				$signUpStatusClass = 'PendingStatus';
			}
			
			if($profileStatus == 1){
				$profile = '<img src="'.url('assets/home/images/Icon33.png').'" alt="">';
				$profileClass = 'm-0';
			}else{
				$profile = '<img src="'.url('assets/home/images/Icon34.png').'" alt="">';
				$profileClass = 'notm-0';
			}
			
			if($eventStatus == 1){
				$event = '<img src="'.url('assets/home/images/Icon33.png').'" alt="">';
				$eventClass = 'm-0';
			}else{
				$event = '<img src="'.url('assets/home/images/Icon34.png').'" alt="">';
				$eventClass = 'notm-0';
			}
			
			$status = '';
			$referColor = '';
			if(@$v->status == '2'){
				$status = 'Pending';
				$referColor = 'notm-0';
				$statusClass="PendingStatus";
			}elseif(@$v->status == '1'){
				$status = 'Successful';
				$referColor = 'm-0';
				$statusClass="DoneStatus";
			}
			
			$array[] = [
			    'UserName' => @$userName,
			    'ReferralStatus' => @$status,
			    'SignedUp' => @$signUpStatus,
			    //'TransactionId' => @$v->txn_id,
			    'SinceDateofActive' => $date_of_activation,
			];
		}
		
		//print_r($array);die;
		
		$file = fopen('php://output', 'w');
		$header = array("UserName", "Referral Status", "Signed Up", "Since Date of Active"); 
		fputcsv($file, $header);
		foreach ($array as $key=>$line)
		{ 
			fputcsv($file, $line); 
		}
		fclose($file); 
		exit; 
	}
	
	function deleteAccount(){ 
		require "vendor/stripe/stripe-php/init.php";
		$stripe = new \Stripe\StripeClient('sk_test_51MPhgSIuZrwn6gWgucZ3pq3OGKnLaQMxviXsKtZb4F7tenDBs25KovJkAB4tii3db6CMW1tdWSk2CB9thQ8yOYdX00iUs05KRN');
		$stripe->accounts->delete('acct_1QCbhRRJtyjKAQ0z', []);
	}
	
}