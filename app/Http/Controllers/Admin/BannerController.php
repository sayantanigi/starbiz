<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class BannerController extends Controller {
  

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
			'title' => 'Banner List',
			'page' => 'banner',
			'subpage' => 'banner'
		);
		
		$data['result'] = DB::table('banner')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.banner', $data);
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