<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class RefersettingController extends Controller {
  

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
			'title' => 'Referral Setting',
			'page' => 'users',
			'subpage' => 'users'
		);

		$data['result'] = DB::table('referral_comission_setting')->where(['id' => 1])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.referral_setting', $data);
    }
	
	public function  saveSetting(Request $request){
		
		
		
		$spend_money        = $request->spend_money;
		$id                 = $request->id;
		$reward_points      = $request->reward_points;
		$referred_by_points = $request->referred_by_points;

		
		$data = ['spend_money' => $spend_money, 'reward_points' => $reward_points, 'referred_by_points' => $referred_by_points, 'updated_at' => date('Y-m-d H:i:s')];
		$result = DB::table('referral_comission_setting')->where('id', @$id)->update(@$data);
		if($result){
			return back()->with("status", "Your site setting update successfully.!");
		}else{
			return back()->with("error", "Some error occure, Please try again.!");
		}
		
	}
}