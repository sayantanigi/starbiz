<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller {
  

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
			'title' => 'Transaction List',
			'page' => 'transaction',
			'subpage' => 'txnlist'
		);
		
        $data['result'] = DB::table('transaction')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.transaction', $data);
    }
	
	public function view($id)
    {
		$data = array(
			'title' => 'View Transaction',
			'page' => 'transaction',
			'subpage' => 'txnlist'
		);
		$data['result'] = DB::table('transaction')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.view_transaction', $data);
	}
	
	public function  saveprofile(Request $request){
		
		if ($request['profilePic']) {
            $img        =  $request['profilePic'];
            $extn       =  $img->getClientOriginalExtension();
            $path       =  public_path('setting/');
            $file_name  =  rand() . '.' . $extn;
            $img->move($path, $file_name);
        } else {
			$where      = ['id' => session()->get('ADMINLOGINID')];
		    $getData    = DB::table('admin')->where($where)->select('profile')->first();
            $file_name  = $getData->profile;
        }
		
		$name  = $request->username;
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
	
	
}