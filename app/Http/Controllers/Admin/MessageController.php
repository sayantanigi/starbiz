<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class MessageController extends Controller {
  

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
			'title' => 'Send Message List',
			'page' => 'message',
			'subpage' => 'message'
		);

		$data['result'] = DB::table('sentonesignalmsg')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
		// $data['result1'] = DB::table('users')->where(['user_type' => 8])->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.sendonesignalmsg', $data);
    }	
	
    public function sendMessage()
    { 
	
        $data = array(
			'title' => 'Send Message',
			'page' => 'message',
			'subpage' => 'message'
		);

		$data['result'] = DB::table('users')->where(['user_type' => 10])->select('*')->orderBy('id', 'DESC')->get();
		$data['result1'] = DB::table('users')->where(['user_type' => 8])->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.send_message', $data);
    }
	
	public function saveMessage(Request $request)
    { 
	    
	    $message  = $request->message;
		$playerId = [];
		
		if($request->user){
			$user    = $request->user;
			foreach($user as $k => $v){
				$checkUser = DB::table('onesignal_users')->where(['user_id' => $v])->select('*')->orderBy('signal_id', 'DESC')->first();
				$playerId[] = $checkUser->player_id;
			}
		}
		$playerId1 = [];
		if($request->otheruser){
			$user    = $request->otheruser;
			foreach($user as $k => $v){
				$checkUser = DB::table('onesignal_users')->where(['user_id' => $v])->select('*')->orderBy('signal_id', 'DESC')->first();
				$playerId1[] = $checkUser->player_id;
			}
		}
		
		$arrayMerge = array_merge($playerId,$playerId1);
		
		$array_1 = [];
		$array_2 = [];
		if($request->otheruser){
			$array_1    = $request->otheruser;
		}
		
		if($request->user){
			$array_2    = $request->user;
		}
		
		$arrayMerge_2 = array_merge($array_2,$array_1);
		if($arrayMerge_2){
			$merge = implode(',', $arrayMerge_2);
		}else{
			$merge = '';
		}
		
		$result = $this->sendPushMessage($message, $arrayMerge);
		if($result){
			$data = ['message' => $message, 'recipients' => $merge, 'status' => 1, 'created_at' => date('Y-m-d H:i:s')];
			DB::table('sentonesignalmsg')->insertGetId($data);
		   return redirect()->intended("admin/message/add");
		}
    }
	
	public function sendPushMessage($message, $playerId){
        $content = array(
            "en" => $message
        );
	    //$recipients = implode(',', $playerId);
		//print_r($recipients);die;
        $fields = array(
			'app_id' => "4b778cab-7f66-49b9-82bc-ea28b970d0ed",
			//'include_player_ids' => [$pushData['playerId']],
			'include_player_ids' => $playerId,
			'data' => array("name"=>"StarBiz Team"),
			'large_icon' =>"https://techc.igiapp.com/starbiz/setting/50666795.png",
			'contents' => $content
        );        

        $fields = json_encode($fields); 

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
         'Authorization: Basic YWVhODE4MWUtODQ2OS00ZmJiLThjNmItN2JiYTI3MjE1YmQ4'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
	
	function get_recipients(Request $request){
		
		
		$select_query = DB::table('sentonesignalmsg')->where(['id' => @$request->id])->select('recipients')->orderBy('id', 'DESC')->first();
		$name = [];
		if(!empty($select_query)){
			$recipients = explode(',', $select_query->recipients);
			foreach($recipients as $k => $v){
				$userInfo = DB::table('users')->where(['id' => @$v])->select('*')->orderBy('id', 'DESC')->first();
				$userType = DB::table('user_type')->where(['id' => @$userInfo->user_type])->select('*')->orderBy('id', 'DESC')->first();
				
				$first_name = $userInfo->first_name;
				$last_name = $userInfo->last_name;
				$userType = $userType->name;
				
				$name[] = "".$first_name.' '.$last_name." (".$userType.")";
			}
		}
		//print_r($name);die;
		if($name){
			echo join(" , ", $name);
		}
	}
	
	function delete_message(Request $request){
			$id = $request->id;
			$delete_query = DB::table('sentonesignalmsg')->where('id', $id)->delete();
			if(!empty($delete_query)){
				$response['status'] = 1;
				$response['message'] = 'Message deleted successfully.';
			}else{
				$response['status'] = 0;
				$response['message'] = 'error.';
			}
		
		echo json_encode($response);
	}
	
	
}	