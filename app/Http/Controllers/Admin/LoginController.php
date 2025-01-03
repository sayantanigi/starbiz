<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\User as Authenticatable;


class LoginController extends Controller {
   //
   
    public function index()
    {
        return view('admin.login');
    }
	
	public function submitLogin(Request $request)
    {
		
		//print_r($request);die;
		
		$validatedData = $request->validate([
			'email' => 'required|email',
			'password' => 'required',
		]);
		//print_r($validatedData);die;
		if (!$validatedData) {
            return back()->withErrors('message', $validatedData);
			//return Redirect::back()->withErrors('message', $validatedData);
        }
		
		$email = $request->email;
		$password = md5($request->password);
		$status = 1;
		$credentials = ['email' => $email, 'password' => $password, 'status' => $status];
		$checkAuth = DB::table('admin')->where($credentials)->select('*')->get();
		//print_r($checkAuth);die; 
		if(count($checkAuth) > 0){
			//echo 1;die;
			session()->put('ADMINLOGINID', $checkAuth[0]->id);
			session()->put('ID_LOGIN', TRUE);
			session()->put('ROLE_ID', @$checkAuth[0]->role_id);
			return redirect()->intended('admin/dashboard')->withSuccess('Signed in');
		}else{
			$validator['text'] = 'Whoops! invalid email and password.';
			return back()->withErrors($validator);
		}
		
		
    }
	public function logout(Request $request) {
		Session::flush();

		return redirect('/admin');
	}
}