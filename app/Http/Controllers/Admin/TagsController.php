<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class TagsController extends Controller {
  

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
			'title' => 'Tags Lists',
			'page' => 'tags',
			'subpage' => 'tags'
		);

		$data['result'] = DB::table('tags')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.tags', $data);
    }
	
	public function add()
    { 
	
        $data = array(
			'title' => 'Add Tags',
			'page' => 'tags',
			'subpage' => 'tags'
		);
		//$data['cat'] = DB::table('listing_category')->select('*')->orderBy('name', 'ASC')->get();
		//$data['country'] = DB::table('countries')->select('*')->orderBy('name', 'ASC')->get();
        return view('admin.add_tags', $data);
    }
	public function save(Request $request)
    { 
	
		$name = $request->name;
		$pckstatus = $request->pckstatus;
		$data = ['name' => $name, 'status' => $pckstatus, 'created_at' => date('Y-m-d H:i:s')];
        $result =  DB::table('tags')->insertGetId($data);
		if($result){
			return redirect()->intended('admin/tags')->with("status", "Your tags added successfully!");
		}else{
			return redirect()->intended('admin/tags')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function edit($id)
    { 
	
        if(empty(@$id)){
			return false;
		}
		
		$data = array(
			'title' => 'Edit Tags',
			'page' => 'tags',
			'subpage' => 'tags'
		);

		$data['result']  = DB::table('tags')->where(['id' => @$id])->select('*')->orderBy('id', 'DESC')->first();
		//$data['cat'] = DB::table('listing_category')->select('*')->orderBy('name', 'ASC')->get();
		//$data['country'] = DB::table('countries')->select('*')->orderBy('name', 'ASC')->get();
        return view('admin.edit_tags', $data);
    }
	
	public function update(Request $request)
    { 
	
		$name = $request->name;
		$pckstatus = $request->pckstatus;
		$id = $request->id;
		
		$data = ['name' => $name, 'status' => $pckstatus, 'updated_at' => date('Y-m-d H:i:s')];
		$result = DB::table('tags')->where('id',$id)->update(@$data);
		
		if($result){
			return redirect()->intended('admin/tags')->with("status", "Your tags updated successfully!");
		}else{
			return redirect()->intended('admin/tags')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function delete($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('tags')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('admin/tags')->with("status", "Tags deleted successfully!");
		}else{
			return redirect()->intended('admin/tags')->with("error", "Some error occure, Please try again!");
		}

    }
}	