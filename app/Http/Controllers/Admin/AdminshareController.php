<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AdminshareController extends Controller {
    public function __construct() {
		$this->middleware(function ($request, $next) {
			$this->userData = session()->get('userData');
			if (!session()->get('ID_LOGIN') || !session()->get('ADMINLOGINID')) {
			   return redirect()->intended('admin');
			}
			// let the request continue through the stack
			return $next($request);
		});
	}
    public function index() {
        $data = array(
			'title'   => 'Admin Share Details',
			'page'    => 'admin_share',
			'subpage' => ''
		);
		$where = ['settingId' => 1];
		$data['result'] = DB::table('settings')->where($where)->select('*')->first();
        return view('admin.admin_share', $data);
    }

    public function saveadminshare(Request $request){
        $appearence_share      = $request->appearence_share;
		$product_share        = $request->product_share;
		$service_share        = $request->service_share;
		$data = ['appearence_share' => $appearence_share, 'product_share' => $product_share, 'service_share' => $service_share];
		$result = DB::table('settings')->where('settingId',1)->update(@$data);
		if($result){
			//return redirect()->intended('admin/profile')->withSuccess('update successfully.');
			return back()->with("status", "Your admin share data saved successfully.!");
		}else{
			return back()->with("error", "Some error occure, Please try again.!");
		}

	}
}