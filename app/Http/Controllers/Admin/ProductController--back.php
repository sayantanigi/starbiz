<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller {
  

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
	
	public function product()
    { 
	
        $data = array(
			'title' => 'Product Lists',
			'page' => 'product',
			'subpage' => 'product'
		);

		$data['result'] = DB::table('product')->select('*')->orderBy('id', 'DESC')->get();
		
        return view('admin.product', $data);
    }
	
	public function add()
    { 
	
        $data = array(
			'title' => 'Add Product',
			'page' => 'product',
			'subpage' => 'product'
		);

		$data['category'] = DB::table('product_category')->select('*')->orderBy('name', 'ASC')->get();
		$data['listing'] = DB::table('listing')->select('*')->orderBy('business_name', 'ASC')->get();
        return view('admin.add_product', $data);
    }
	
	public function save(Request $request)
    { 		
		$product_name         = $request->product_name;
		$product_category     = $request->product_category;
		$product_price        = $request->product_price;
		$product_special      = $request->product_special;
		$product_quantity     = $request->product_quantity;
		$product_availability = $request->product_availability;
		$product_description  = $request->product_description;
		$product_status       = $request->product_status;
		$product_listing      = $request->product_listing;
		$product_subcategory  = $request->product_subcategory;
		

		
		$data = ['name' => $product_name, 'category' => $product_category, 'subcategory' => @$product_subcategory, 'listing_id' => $product_listing, 'price' => $product_price, 'special_price' => @$product_special, 'quantity' => $product_quantity, 'availability' => $product_availability, 'description' => $product_description, 'status' => $product_status, 'user_id' => 0, 'created_at' => date('Y-m-d H:i:s')];
		$result = DB::table('product')->insertGetId($data);
		if($result){
			//print_r($_FILES);die;
		    $image = array();
		    if($file = $request->file('product_image')){
				
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('product/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data = ['image' => $image, 'product_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('product_image')->insertGetId($data);
			    }    
		    }
		  
			return redirect()->intended('admin/product')->with("status", "Your product added successfully!");
		}else{
			return redirect()->intended('admin/product')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function edit($id)
    { 
	
        $data = array(
			'title'   => 'Edit Product',
			'page'    => 'product',
			'subpage' => 'product'
		);

		$data['category'] = DB::table('product_category')->select('*')->orderBy('name', 'ASC')->get();
		$data['listing'] = DB::table('listing')->select('*')->orderBy('business_name', 'ASC')->get();
		$data['result'] = $result = DB::table('product')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
		
		if($result->category){
			$data['subcat'] = DB::table('product_subcategory')->where(['category_id' => $result->category])->select('*')->orderBy('name', 'ASC')->get();
		}else{
			$data['subcat'] = '';
		}
        return view('admin.edit_product', $data);
    }
	
	public function update(Request $request)
    { 		
		$product_name         = $request->product_name;
		$product_category     = $request->product_category;
		$product_price        = $request->product_price;
		$product_special      = $request->product_special;
		$product_quantity     = $request->product_quantity;
		$product_availability = $request->product_availability;
		$product_description  = $request->product_description;
		$product_status       = $request->product_status;
		$product_listing      = $request->product_listing;
		$product_id           = $request->product_id;
		$product_subcategory  = $request->product_subcategory;

		
		$data = ['name' => $product_name, 'category' => $product_category, 'subcategory' => @$product_subcategory, 'listing_id' => $product_listing, 'price' => $product_price, 'special_price' => @$product_special, 'quantity' => $product_quantity, 'availability' => $product_availability, 'description' => $product_description, 'status' => $product_status, 'user_id' => 0, 'created_at' => date('Y-m-d H:i:s')];
		//$result = DB::table('product')->insertGetId($data);
		$result = DB::table('product')->where('id',$product_id)->update(@$data);
		if($result){
			//print_r($_FILES);die;
		    $image = array();
		    if($file = $request->file('product_image')){
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('product/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data = ['image' => $image, 'product_id' => $product_id, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('product_image')->insertGetId($data);
			    }    
		    }
			return redirect()->intended('admin/product')->with("status", "Your product updated successfully!");
		}else{
			return redirect()->intended('admin/product')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function delete($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('product')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('admin/product')->with("status", "product deleted successfully!");
		}else{
			return redirect()->intended('admin/product')->with("error", "Some error occure, Please try again!");
		}
    }
	public function removeImg(Request $request){
		if ($request->item){
			$item = $request->item;
			$result = DB::table('product_image')->where('id', $item)->delete();
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
			$id = $request->id;
			$status = $request->status;
			
			if ($status == 1) {
				$msg = 'Your status is Activate';
			} else {
				$msg = 'Your status is Inctivate';
			}
			
			$result = DB::table('product')->where(['id' => $id])->update(['status'=>$status]);
			
			if ($result) {
				echo '["'.$msg.'", "success", "#A5DC86"]';
			} else {
				echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
			}
		}
	}
	
	public function view($id)
    { 
	
        $data = array(
			'title' => 'View Product Information',
			'page' => 'product',
			'subpage' => 'product'
		);

		$data['category'] = DB::table('product_category')->select('*')->orderBy('name', 'ASC')->get();
		$data['listing'] = DB::table('listing')->select('*')->orderBy('business_name', 'ASC')->get();
		
		$data['result'] = DB::table('product')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.view_product', $data);
    }
	
    public function category()
    { 
	
        $data = array(
			'title' => 'Category Lists',
			'page' => 'product',
			'subpage' => 'product-category'
		);

		$data['result'] = DB::table('product_category')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.product_category', $data);
    }
	
	 public function add_category()
    { 
	
        $data = array(
			'title' => 'Add Category',
			'page' => 'product',
			'subpage' => 'product-category'
		);
        return view('admin.add_product_category', $data);
    }
	
	public function save_category(Request $request)
    { 
	
		$name = $request->name;
		$pckstatus = $request->pckstatus;
		$data = ['name' => $name, 'status' => $pckstatus, 'created_at' => date('Y-m-d H:i:s')];
        $result =  DB::table('product_category')->insertGetId($data);
		if($result){
			return redirect()->intended('admin/product/category')->with("status", "Your product category added successfully!");
		}else{
			return redirect()->intended('admin/product/category')->with("error", "Some error occure, Please try again!");
		}
    }
	
	 public function edit_category($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $data = array(
			'title' => 'Edit Category',
			'page' => 'product',
			'subpage' => 'product-category'
		);

		$data['result'] = DB::table('product_category')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.edit_product_category', $data);
    }
	
	 public function update_category(Request $request)
    { 
	    $name = $request->name;
		$pckstatus = $request->pckstatus;
		$catId = $request->catId;
		$data = ['name' => $name, 'status' => $pckstatus, 'updated_at' => date('Y-m-d H:i:s')];
		$result = DB::table('product_category')->where('id',$catId)->update(@$data);
		if($result){
			return redirect()->intended('admin/product/category')->with("status", "Your product category updated successfully!");
		}else{
			return redirect()->intended('admin/product/category')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function delete_category($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('product_category')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('admin/product/category')->with("status", "product deleted successfully!");
		}else{
			return redirect()->intended('admin/product/category')->with("error", "Some error occure, Please try again!");
		}
		
        
    }
	
	 public function subcategory()
    { 
	
        $data = array(
			'title' => 'Subcategory List',
			'page' => 'product',
			'subpage' => 'product-subcategory'
		);
		$data['result'] = DB::table('product_subcategory')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.product_subcategory', $data);
    }
	
	 public function add_subcategory()
    { 
	
        $data = array(
			'title' => 'Add Subcategory',
			'page' => 'product',
			'subpage' => 'product-subcategory'
		);
		$data['cat'] = DB::table('product_category')->select('*')->orderBy('name', 'ASC')->get();
        return view('admin.add_product_subcategory', $data);
    }
	
	public function save_subcategory(Request $request)
    { 
	
		$category    = $request->category;
		$subcategory = $request->subcategory;
		$pckstatus   = $request->pckstatus;
		
		$data = ['category_id' => $category, 'name' => $subcategory, 'status' => $pckstatus, 'created_at' => date('Y-m-d H:i:s')];
        $result =  DB::table('product_subcategory')->insertGetId($data);
		if($result){
			return redirect()->intended('admin/product/subcategory')->with("status", "Your product subcategory added successfully!");
		}else{
			return redirect()->intended('admin/product/subcategory')->with("error", "Some error occure, Please try again!");
		}
    }
	
	 public function edit_subcategory($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $data = array(
			'title' => 'Edit Category',
			'page' => 'product',
			'subpage' => 'product-subcategory'
		);

		$data['result'] = DB::table('product_subcategory')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
		$data['cat'] = DB::table('product_category')->select('*')->orderBy('name', 'ASC')->get();
        return view('admin.edit_product_subcategory', $data);
    }
	
	public function update_subcategory(Request $request)
    { 
	
		$category    = $request->category;
		$subcategory = $request->subcategory;
		$pckstatus   = $request->pckstatus;
		$id   = $request->id;
		
		$data = ['category_id' => $category, 'name' => $subcategory, 'status' => $pckstatus, 'updated_at' => date('Y-m-d H:i:s')];
        //$result =  DB::table('product_subcategory')->insertGetId($data);
		$result = DB::table('product_subcategory')->where('id',$id)->update(@$data);
		if($result){
			return redirect()->intended('admin/product/subcategory')->with("status", "Your product subcategory updated successfully!");
		}else{
			return redirect()->intended('admin/product/subcategory')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function delete_subcategory($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('product_subcategory')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('admin/product/subcategory')->with("status", "product subcategory deleted successfully!");
		}else{
			return redirect()->intended('admin/product/subcategory')->with("error", "Some error occur, Please try again!");
		}
    }
}	