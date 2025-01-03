<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class InterestController extends Controller {
  

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
			'title' => 'Interest Lists',
			'page' => 'interest',
			'subpage' => 'interest'
		);

		$data['result'] = DB::table('interest')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.interest', $data);
    }
	
	public function add()
    { 
	
        $data = array(
			'title' => 'Add Interest',
			'page' => 'interest',
			'subpage' => 'interest'
		);
		//$data['cat'] = DB::table('listing_category')->select('*')->orderBy('name', 'ASC')->get();
		//$data['country'] = DB::table('countries')->select('*')->orderBy('name', 'ASC')->get();
        return view('admin.add_interest', $data);
    }
	public function save(Request $request)
    { 
	
		$name = $request->name;
		$pckstatus = $request->pckstatus;
		$data = ['name' => $name, 'status' => $pckstatus, 'created_at' => date('Y-m-d H:i:s')];
        $result =  DB::table('interest')->insertGetId($data);
		if($result){
			return redirect()->intended('admin/interest')->with("status", "Your interest added successfully!");
		}else{
			return redirect()->intended('admin/interest')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function edit($id)
    { 
	
        if(empty(@$id)){
			return false;
		}
		
		$data = array(
			'title' => 'Edit Interest',
			'page' => 'interest',
			'subpage' => 'interest'
		);

		$data['result']  = DB::table('interest')->where(['id' => @$id])->select('*')->orderBy('id', 'DESC')->first();
		//$data['cat'] = DB::table('listing_category')->select('*')->orderBy('name', 'ASC')->get();
		//$data['country'] = DB::table('countries')->select('*')->orderBy('name', 'ASC')->get();
        return view('admin.edit_interest', $data);
    }
	
	public function update(Request $request)
    { 
	
		$name = $request->name;
		$pckstatus = $request->pckstatus;
		$id = $request->id;
		
		$data = ['name' => $name, 'status' => $pckstatus, 'updated_at' => date('Y-m-d H:i:s')];
		$result = DB::table('interest')->where('id',$id)->update(@$data);
		
		if($result){
			return redirect()->intended('admin/interest')->with("status", "Your interest updated successfully!");
		}else{
			return redirect()->intended('admin/interest')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function delete($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('interest')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('admin/interest')->with("status", "Interest deleted successfully!");
		}else{
			return redirect()->intended('admin/interest')->with("error", "Some error occure, Please try again!");
		}

    }
}	