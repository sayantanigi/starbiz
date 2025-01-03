<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Stripe;

class LoginController extends Controller {
  

	public function __construct()
	{

		// $this->middleware(function ($request, $next) {
			// $this->userData = session()->get('userData');

			// if (!session()->get('ID_LOGIN') || !session()->get('ADMINLOGINID')) {
			   // return redirect()->intended('admin');
			// }

			// // let the request continue through the stack
			// return $next($request);
		// });
	}	
	
    public function index()
    { 
	
         $data = array(
			 'title'   => 'Users Lists',
			 'page'    => 'users',
			 'subpage' => 'users'
		 );

		// $data['result'] = DB::table('users')->select('*')->orderBy('id', 'DESC')->get();
        return view('login', $data);
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
		
		$email    = $request->email;
		$password = md5($request->password);
		
		$status = 1;
		$credentials = ['email' => $email, 'password' => $password];
		$checkAuth = DB::table('users')->where($credentials)->select('*')->get();
		if(count($checkAuth) == 1){
			session()->put('USERLOGINID', $checkAuth[0]->id);
			
			//session()->put('ROLE_ID', @$checkAuth[0]->role_id);
			if($checkAuth[0]->status == 1){
				session()->put('IDLOGIN', TRUE);
				return redirect()->intended('dashboard')->withSuccess('Signed in');
			}else{
				return redirect()->intended('document');
			}
			
		}else{
			$validator['text'] = 'Whoops! invalid email and password.';
			return back()->withErrors($validator);
		}
    }
	
	public function logout(Request $request) {
		Session::flush();

		return redirect('/login');
	}
}