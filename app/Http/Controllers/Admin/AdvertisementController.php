<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AdvertisementController extends Controller {
  

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
			'title' => 'Advertisement Lists',
			'page' => 'advertisement',
			'subpage' => 'advertisement'
		);

	    $data['result'] = DB::table('transaction')->where(['payment_type' => 7])->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.advertisement', $data);
    }
}