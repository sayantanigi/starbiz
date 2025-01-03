<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class PayoutController extends Controller {
  

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
			'title' => 'Payout List',
			'page' => 'payout',
			'subpage' => 'payout'
		);
		
		if(!empty(@$_GET['search']) && @$_GET['type'] == 'filter'){

			// $sql = "SELECT * FROM `events` WHERE event_status = '1' and event_id = '".@$_GET['search']."' ORDER BY event_id DESC";
            // $data['list'] = $this->db->query($sql)->result();
			$data['result'] = DB::table('events')->where(['status' => 1, 'id' => @$_GET['search']])->select('*')->orderBy('id', 'DESC')->get();

		}elseif(!empty(@$_GET['promoter']) && @$_GET['type'] == 'filterPromoter'){

			// $sql = "SELECT * FROM `events` WHERE event_status = '1' and user_id = '".@$_GET['promoter']."' ORDER BY event_id DESC";
            // $data['list'] = $this->db->query($sql)->result();
			$data['result'] = DB::table('events')->where(['status' => 1, 'user_id' => @$_GET['promoter']])->select('*')->orderBy('id', 'DESC')->get();

		}elseif(@$_GET['promoter'] == 0 && @$_GET['type'] == 'filterPromoter'){
			$data['result'] = DB::table('events')->where(['status' => 1, 'user_id' => @$_GET['promoter']])->select('*')->orderBy('id', 'DESC')->get();
		}else{
			//$data['result'] = DB::table('transaction')->where(['payment_type' => 5, 'status' => 'succeeded'])->select('*')->orderBy('id', 'DESC')->get();
			$data['result'] = DB::table('events')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
		}
		
		$data['eventlist'] = DB::table('events')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.payout', $data);
    }
	
	
	function downloadCsv(){

		$filename = 'payout_list'.date('Ymd').'.csv'; 
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
			$data['list'] = DB::table('events')->where(['status' => 1])->select('*')->orderBy('id', 'DESC')->get();
		}

		$array = [];
		
		

		foreach($data['list'] as $k => $v ){
			if(@$v->user_id == 0){
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
			$promoterShare = @$payoutAmount[0]->Totalamount - $adminShare;
			
			$array[] = [
			    'EventName' => @$v->event_name,
			    'PromoterName' => @$name,
			    'PromoterEmail' => @$email,
			    'TotalAmount' => (!empty(@$payoutAmount[0]->Totalamount) ? 'USD '.@$payoutAmount[0]->Totalamount.'' : 'USD 0'),
			    'AdminShare' => 'USD '.@$adminShare,
			    'PromoterShare' => 'USD '.@$promoterShare,
			];
		}
		
		//print_r($array);die;
		
		$file = fopen('php://output', 'w');
		$header = array("Event Name", "Promoter Name", "Promoter Email", "Total Amount", "Admin Share", "Promoter Share"); 
		fputcsv($file, $header);
		foreach ($array as $key=>$line)
		{ 
			fputcsv($file, $line); 
		}
		fclose($file); 
		exit; 
	}
	
	
	public function view($id)
    { 
        $data = array(
			'title' => 'Payout Report List',
			'page' => 'payout',
			'subpage' => 'payout'
		);
		$data['EVENTID'] = $id;
		$data['result'] = DB::table('transaction')->where(['event_id' => @$id, 'status' => 'succeeded'])->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.user_transaction_list', $data);
    }
	
	public function downloadPayoutReportCsv($eventId){
		
		$data['result'] = DB::table('transaction')->where(['event_id' => @$eventId, 'status' => 'succeeded'])->select('*')->orderBy('id', 'DESC')->get();
		$filename = 'payout_list'.date('Ymd').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");
		$array = [];
		
		foreach($data['result'] as $k => $v ){
			
			if(@$v->user_id == 0){
				$userName   = 'Admin';
				$userEmail  = 'admin@gmail.com';
			}else{
				$userInfo = DB::table('users')->where(['id' => @$v->user_id])->select('*')->first();
				if($userInfo){
					$userName  = $userInfo->first_name.' '.$userInfo->last_name;
					$userEmail = $userInfo->email;
				}else{
					$userName   = '';
					$userEmail  = '';
				}
			}

			if(@$v->created_at){
				$date = date('M d, Y \a\t h:i A', strtotime(@$v->created_at ?? ''));
			}else{
				$date = date('M d, Y \a\t h:i A', strtotime(@$v->created_at ?? ''));
			}
			
			$getPer = DB::table('settings')->select('admin_percentage')->first();
			$percentage = $getPer->admin_percentage;	
			
			$totalWidth = @$v->amount;						
			$adminShare = ($percentage / 100) * $totalWidth;
			$promoterShare = @$v->amount - $adminShare;

			$array[] = [

			    'UserName' => @$userInfo->first_name.' '.@$userInfo->last_name,
			    'PaidAmount' => 'USD '.@$v->amount,
			    'AdminShare' => 'USD '.@$adminShare,
			    'PromoterShare' => 'USD '.@$promoterShare,
			    'Charge' => @$v->charge_id,
			    'PaymentStatus' => @$v->status,
			    'PaymentDate' => @$date,
			];
		}
		
		$file = fopen('php://output', 'w');
		$header = array("UserName", "PaidAmount", "Admin Share", "Promoter Share", "Charge", "PaymentStatus", "PaymentDate"); 
		fputcsv($file, $header);
		foreach ($array as $key=>$line)
		{ 
			fputcsv($file, $line); 
		}
		fclose($file); 
		exit; 
	}
	
	public function add()
    { 
        $data = array(
			'title' => 'Add Banner',
			'page' => 'banner',
			'subpage' => 'banner'
		);
        return view('admin.add_banner', $data);
    }
	
	public function save(Request $request)
    { 
	
	    if ($request['upload_image']) {
            $img = $request['upload_image'];
            $extn = $img->getClientOriginalExtension();
            $path = public_path('banner/');
            $file_name = rand() . '.' . $extn;
            $img->move($path, $file_name);
        } else {
			$file_name = '';
        }
	
        $heading = $request->heading;
		$status  = @$request->status;

		$data = ['image' => $file_name, 'name' => $heading, 'status' => $status, 'created_at' => date('Y-m-d H:i:s')];
		
		$result = DB::table('banner')->insertGetId($data);
		
		if($result){
			return redirect()->intended('admin/banner')->with("status", "Banner added successfully!");
		}else{
			return redirect()->intended('admin/banner')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function edit($id)
    { 
	
        $data = array(
			'title' => 'Edit Banner',
			'page' => 'banner',
			'subpage' => 'banner'
		);
	    $data['result'] = DB::table('banner')->where(['id' => $id])->select('*')->first();
	    	
        return view('admin.edit_banner', $data);
    }
	
	public function update(Request $request)
    { 
		
        $heading = $request->heading;
        $id      = $request->id;
		$status  = @$request->status;
		
		if ($request['upload_image']) {
            $img = $request['upload_image'];
            $extn = $img->getClientOriginalExtension();
            $path = public_path('banner/');
            $file_name = rand() . '.' . $extn;
            $img->move($path, $file_name);
        } else {
			$bannerImg = DB::table('banner')->where(['id' => $id])->select('image')->first();
			if($bannerImg->image){
				$file_name = $bannerImg->image;
			}else{
			    $file_name = '';
			}
        }

		$data = ['image' => $file_name, 'name' => $heading, 'status' => $status, 'created_at' => date('Y-m-d H:i:s')];
		$result = DB::table('banner')->where(['id' => $id])->update($data);
		
		if($result){
			return redirect()->intended('admin/banner')->with("status", "Banner updated successfully!");
		}else{
			return redirect()->intended('admin/banner')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function delete($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('banner')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('admin/banner')->with("status", "Banner deleted successfully!");
		}else{
			return redirect()->intended('admin/banner')->with("error", "Some error occure, Please try again!");
		} 
    }
	
	public function changestatus(Request $request)
	{
		if ($request->bannerId) {
			
			$id     = $request->bannerId;
			$status = $request->status;
			
			if ($status == 1) {
				$msg = 'Your status is Activate';
			} else {
				$msg = 'Your status is Inctivate';
			}
			$result = DB::table('banner')->where('id',@$id)->update(['status'=>$status]);
			
			if ($result) {
				echo '["'.$msg.'", "success", "#A5DC86"]';
			} else {
				echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
			}
		}
	}
	
	
	
	
}