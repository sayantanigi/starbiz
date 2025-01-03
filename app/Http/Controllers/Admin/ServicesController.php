<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ServicesController extends Controller {
  

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
			'title' => 'Services Lists',
			'page' => 'services',
			'subpage' => 'services'
		);

		$data['result'] = DB::table('services')->select('*')->orderBy('id', 'DESC')->get();
		
        return view('admin.services', $data);
    }
	
	public function add()
    { 
	
        $data = array(
			'title' => 'Add Services',
			'page' => 'services',
			'subpage' => 'services'
		);

		$data['category'] = DB::table('product_category')->select('*')->orderBy('name', 'ASC')->get();
		$data['listing'] = DB::table('listing')->select('*')->orderBy('business_name', 'ASC')->get();
        return view('admin.add_services', $data);
    }
	
	public function save(Request $request)
    { 		
		$service_name         = $request->service_name;
		$service_category     = $request->service_category;
		$service_price        = $request->service_price;
		$service_special      = $request->service_special;
		$service_description  = $request->service_description;
		$service_status       = $request->service_status;
		$service_listing      = $request->service_listing;

		

		
		$data = ['name' => $service_name, 'category' => $service_category, 'listing_id' => $service_listing, 'price' => $service_price, 'special_price' => @$service_special, 'description' => $service_description, 'status' => $service_status, 'user_id' => 0, 'created_at' => date('Y-m-d H:i:s')];
		$result = DB::table('services')->insertGetId($data);
		if($result){
			//print_r($_FILES);die;
		    $image = array();
		    if($file = $request->file('service_image')){
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('service/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data = ['image' => $image, 'service_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('services_image')->insertGetId($data);
			    }    
		    }
			return redirect()->intended('admin/services')->with("status", "Your services added successfully!");
		}else{
			return redirect()->intended('admin/services')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function edit($id)
    { 
	
        $data = array(
			'title'   => 'Edit Services',
			'page'    => 'services', 
			'subpage' => 'services'
		);

		$data['category'] = DB::table('product_category')->select('*')->orderBy('name', 'ASC')->get();
		$data['listing']  = DB::table('listing')->select('*')->orderBy('business_name', 'ASC')->get();
		$data['result']   = $result = DB::table('services')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
		
		// if($result->category){
			// $data['subcat'] = DB::table('product_subcategory')->where(['category_id' => $result->category])->select('*')->orderBy('name', 'ASC')->get();
		// }else{
			// $data['subcat'] = '';
		// }
        return view('admin.edit_service', $data);
    }
	
	public function update(Request $request)
    { 		
		$service_name         = $request->service_name;
		$service_category     = $request->service_category;
		$service_price        = $request->service_price;
		$service_special      = $request->service_special;
		$service_description  = $request->service_description;
		$service_status       = $request->service_status;
		$service_listing      = $request->service_listing;
		$service_id           = $request->service_id;


		
		$data = ['name' => $service_name, 'category' => $service_category, 'listing_id' => $service_listing, 'price' => $service_price, 'special_price' => @$service_special, 'description' => $service_description, 'status' => $service_status, 'user_id' => 0, 'updated_at' => date('Y-m-d H:i:s')];
		
		//print_r($data);die;
		$result = DB::table('services')->where('id',$service_id)->update(@$data);
		if($result){
			//print_r($_FILES);die;
		    $image = array();
		    if($file = $request->file('service_image')){
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('service/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data = ['image' => $image, 'service_id' => $service_id, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('services_image')->insertGetId($data);
			    }    
		    }
			return redirect()->intended('admin/services')->with("status", "Your service updated successfully!");
		}else{
			return redirect()->intended('admin/services')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function view($id)
    { 
	
        $data = array(
			'title'   => 'View Service Information',
			'page'    => 'services',
			'subpage' => 'services'
		);

		$data['category'] = DB::table('product_category')->select('*')->orderBy('name', 'ASC')->get();
		$data['listing'] = DB::table('listing')->select('*')->orderBy('business_name', 'ASC')->get();
		
		$data['result'] = DB::table('services')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.view_service', $data);
    }
	
	public function delete($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('services')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('admin/services')->with("status", "service deleted successfully!");
		}else{
			return redirect()->intended('admin/services')->with("error", "Some error occure, Please try again!");
		}
    }
	public function removeImg(Request $request){
		if ($request->item){
			$item = $request->item;
			$result = DB::table('services_image')->where('id', $item)->delete();
			if($result){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
		
	}
	
	public function getSub(Request $request){
		$output = '<option value="">Select Subcategory</option>';
		if ($request->category){
			$category = $request->category;
			$category = DB::table('product_subcategory')->where(['category_id' => $category])->select('*')->orderBy('name', 'ASC')->get();
			if($category){
				foreach($category as $k => $v){
					$output .= '<option value="'.$v->id.'">'.$v->name.'</option>';
				}
			}
		}
		echo $output;
		
	}
	
	public function changestatus(Request $request)
	{
		if ($request->id) {
			$id     = $request->id;
			$status = $request->status;
			
			if ($status == 1) {
				$msg = 'Your status is Activate';
			} else {
				$msg = 'Your status is Inctivate';
			}
			
			$result = DB::table('services')->where(['id' => $id])->update(['status'=>$status]);
			
			if ($result) {
				echo '["'.$msg.'", "success", "#A5DC86"]';
			} else {
				echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
			}
		}
	}
}	