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
		$product_special      = 0;
		$product_quantity     = 0;
		$product_availability = 0;
		$product_description  = $request->product_description;
		$product_status       = $request->product_status;
		$product_listing      = $request->product_listing;
		$product_tags      = $request->tags;
		$product_subcategory  = 0;
		

		
		$data = ['name' => $product_name, 'category' => $product_category, 'subcategory' => @$product_subcategory, 'listing_id' => $product_listing, 'price' => $product_price, 'special_price' => @$product_special, 'quantity' => $product_quantity, 'availability' => $product_availability, 'description' => $product_description, 'status' => $product_status, 'tags' => $product_tags, 'user_id' => 0, 'created_at' => date('Y-m-d H:i:s')];
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
		$data['listing']  = DB::table('listing')->select('*')->orderBy('business_name', 'ASC')->get();
		$data['result']   = $result = DB::table('product')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
		
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
		$product_special      = 0;
		$product_quantity     = 0;
		$product_availability = 0;
		$product_description  = $request->product_description;
		$product_status       = $request->product_status;
		$product_listing      = $request->product_listing;
		$product_id           = $request->product_id;
		$product_subcategory  = 0;
		$product_tags         = @$request->tags;

		
		$data = ['name' => $product_name, 'category' => $product_category, 'subcategory' => @$product_subcategory, 'listing_id' => $product_listing, 'price' => $product_price, 'special_price' => @$product_special, 'quantity' => $product_quantity, 'availability' => $product_availability, 'description' => $product_description, 'status' => $product_status, 'tags' => $product_tags, 'user_id' => 0, 'created_at' => date('Y-m-d H:i:s')];
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
			$id     = $request->id;
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
			'title'   => 'View Product Information',
			'page'    => 'product',
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
			'title'   => 'Category Lists',
			'page'    => 'product',
			'subpage' => 'product-category'
		);

		$data['result'] = DB::table('product_category')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.product_category', $data);
    }
	
	 public function add_category()
    { 
	
        $data = array(
			'title'   => 'Add Category',
			'page'    => 'product',
			'subpage' => 'product-category'
		);
        return view('admin.add_product_category', $data);
    }
	
	public function save_category(Request $request)
    { 
	
		$name      = $request->name;
		$pckstatus = $request->pckstatus;
		$data      = ['name' => $name, 'status' => $pckstatus, 'created_at' => date('Y-m-d H:i:s')];
        $result    =  DB::table('product_category')->insertGetId($data);
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
			'title'   => 'Edit Category',
			'page'    => 'product',
			'subpage' => 'product-category'
		);

		$data['result'] = DB::table('product_category')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.edit_product_category', $data);
    }
	
	 public function update_category(Request $request)
    { 
	    $name      = $request->name;
		$pckstatus = $request->pckstatus;
		$catId     = $request->catId;
		$data      = ['name' => $name, 'status' => $pckstatus, 'updated_at' => date('Y-m-d H:i:s')];
		$result    = DB::table('product_category')->where('id',$catId)->update(@$data);
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
			'title'   => 'Subcategory List',
			'page'    => 'product',
			'subpage' => 'product-subcategory'
		);
		$data['result'] = DB::table('product_subcategory')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.product_subcategory', $data);
    }
	
	 public function add_subcategory()
    { 
	
        $data = array(
			'title'   => 'Add Subcategory',
			'page'    => 'product',
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
			'title'   => 'Edit Category',
			'page'    => 'product',
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
	
	public function uploads_product(){
		 $data = array(
			'title'   => 'Upload Bulk Product',
			'page'    => 'product',
			'subpage' => 'product'
		);

		//$data['result'] = DB::table('product')->select('*')->orderBy('id', 'DESC')->get();
		
        return view('admin.bulk_product', $data);
	}
	
	public function saveBulkproduct(){
		$csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv','text/xls','text/xlsx', 'text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream',  'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel');
		
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
			if(is_uploaded_file($_FILES['file']['tmp_name'])){
				
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);
				while(($line = fgetcsv($csvFile)) !== FALSE){ 
				    
					$proCat = DB::table('product_category')->where(['name' => htmlentities($line[1])])->select('*')->orderBy('name', 'ASC')->first();
					if($proCat){
						if($proCat->id){
							$catName = $proCat->id;
						}else{
							$catName = '';
						}
					}else{
						$catName = '';
					}
					
					$proSub = DB::table('product_subcategory')->where(['name' => htmlentities($line[2])])->select('*')->orderBy('name', 'ASC')->first();
					if($proSub){
						if($proSub->id){
							$subName = $proSub->id;
						}else{
							$subName = '';
						}
					}else{
						$subName = '';
					}
					
					$listing = DB::table('listing')->where(['business_name' => htmlentities($line[3])])->select('*')->orderBy('name', 'ASC')->first();
					if($listing){
						if($listing->id){
							$listingName = $listing->id;
						}else{
							$listingName = '';
						}
					}else{
						$listingName = '';
					}
					
					$data = ['name' => htmlentities($line[0]), 'category' => @$catName, 'subcategory' => @$subName, 'listing_id' => @$listingName, 'price' => htmlentities($line[4]), 'special_price' => htmlentities($line[5]), 'quantity' => htmlentities($line[6]), 'availability' => htmlentities($line[7]), 'description' => htmlentities($line[8]), 'status' => 1, 'user_id' => 0, 'created_at' => date('Y-m-d H:i:s')];
					$result = DB::table('product')->insertGetId($data);
				}
				
				//close opened csv file
                fclose($csvFile);
				return redirect()->intended('admin/product')->with("status", "product uploaded successfully!");
			}else{
				return redirect()->intended('admin/product')->with("error", "Some Error Occurred!");
			}
		}else{
			return redirect()->intended('admin/product')->with("error", "Wrong file uploads or file is required.");
		}
	}
	
	public function purchaseList(){
		 $data = array(
			'title'   => 'Product Purchase List',
			'page'    => 'product',
			'subpage' => 'product-purchaselist'
		);
		
		if(!empty($_GET['from_date']) && !empty($_GET['to_date'])){
			$data['result'] = DB::table('transaction')->whereRaw("(DATE(created_at) BETWEEN '".@$_GET['from_date']."' AND '".@$_GET['to_date']."') AND payment_type = 6")->select('*')->get();
		}else{
		    $data['result'] = DB::table('transaction')->where(['payment_type' => 6])->select('*')->orderBy('id', 'DESC')->get();
		}
        return view('admin.purchase_list', $data);
	}
	
	function orderinfo(Request $request){
		$newre = '';
		if(!empty($request->ordid)){
			//$sql = $this->db->query("SELECT * FROM orders WHERE id = ".$this->input->post('ordid')." ORDER BY id DESC");
		   // $orders = ($sql->num_rows() > 0) ? $sql->row() : FALSE;
			
			$orders = DB::table('transaction')->where(['id' => $request->ordid])->select('*')->orderBy('id', 'DESC')->first();
			
			
			if(!empty($orders)){
				
				if(@$orders->status == 'succeeded'){
					$status = 'succeeded';
				}elseif(@$orders->status == 2){
					$status = 'Not Processed';
				}elseif(@$orders->status == 0){
					$status = 'Rejected';
				}
				
				//$user_info = $this->Adminmodel->get_single_row_info('first_name, last_name, email, phone, city, address_line_1, address_line_2, zip', 'orders_user_info', 'orderid = '.@$orders->id.'', '', 1);
				
				$user_info = DB::table('users')->where(['id' => $orders->user_id])->select('*')->orderBy('id', 'DESC')->first();
				
				//print_r($user_info);die;
				$newre .='
				
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close closepopup_3" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel" style="margin: 21px 72px;font-size:16px;">Preview <b id="client-name">
						#'.$orders->order_id.' '.@$status.' 
						</b></h4>
						</div>
						<div class="modal-body" id="preview-info-body">
							<div class="table-responsive">
								<table class="table more-info-purchase table_2" >
									<tbody>
									
										<tr>
											<td><b>Email</b></td>
											<td><a href="mailto:'.@$user_info->email.'">'.@$user_info->email.'</a></td>
										</tr>
										
										<tr>
											<td><b>City</b></td>
											<td>'.@$user_info->city.'</td>
										</tr>
										
										<tr>
											<td><b>Address</b></td>
											<td>'.(!empty(@$user_info->address) ? @$user_info->address : '').'</td>
										</tr>
										
										<tr>
											<td><b>Zipcode</b></td>
											<td>'.@$user_info->zipcode.'</td>
										</tr>
										
										<!--<tr>
											<td><b>Notes</b></td>
											<td></td>
										</tr>-->
										
										<!--<tr>
											<td><b>Come from site</b></td>
											<td>
											<a target="_blank" href="http://localhost/Ecommerce-CodeIgniter-Bootstrap-master/shopping-cart" class="orders-referral">
											http://localhost/Ecommerce-CodeIgniter-Bootstrap-master/shopping-cart                                                        </a>
											</td>
										</tr>-->
										
										<!--<tr>
											<td><b>Payment Type</b></td>
											<td>'.@$orders->payment_type.'</td>
										</tr>-->
										
										<!--<tr>
											<td><b>Discount</b></td>
											<td>-%</td>
										</tr>-->
										
										<tr>
											<td colspan="2"><b>Products Info</b></td>
										</tr>
										
										<tr>
											<td colspan="2">
												'.$this->get_order_product($orders->product_info, $orders->amount).'	
											</td>
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default closepopup_3" data-dismiss="modal">Close</button>
						</div>
					</div>
					
				';
			}
		}
		$response['html'] = $newre; 
		echo json_encode($response);
	}
	
	function get_order_product($products = '', $totalAmount = ''){
		$result = '';
		//$vendor_id = $this->session->userdata('loguserId');
		if(!empty($products)){
			$pro_data = unserialize($products);
			// print_r($pro_data);
			// return;
			foreach($pro_data as $k => $v){
				    
					
				    if(@$v['specipication'] == 'service'){
						
						echo $echo = 1;
						$productInfo = DB::table('services')->where(['id' => $v['product_id']])->select('*')->orderBy('id', 'DESC')->first();	
						$productImg = DB::table('services_image')->where(['service_id' => @$productinfo->id])->select('*')->orderBy('id', 'ASC')->first();
						
						
						if(!empty(@$productImg->image) && file_exists('public/service/'.@$productImg->image.'')){
							$proimg = url('service/'.@$productImg->image.'');
						}else{
							$proimg = url('noimage.jpg');
						} 
						
						if(@$productinfo->user_id == 0){
							$vendorName = 'Admin';
						}else{
							$vendorinfo = DB::table('users')->where(['id' => @$productinfo->user_id])->select('*')->orderBy('id', 'DESC')->first();
							$vendorName = @$vendorinfo->first_name.' '.@$vendorinfo->last_name;
						}
					
					}else{
						//$productinfo = $this->Adminmodel->get_single_row_info('*', 'product', 'product_id = '.@$v['product_id'].'', '', 1);
						$productinfo = DB::table('product')->where(['id' => @$v['product_id']])->select('*')->orderBy('id', 'DESC')->first();
						//$vendorinfo = $this->Adminmodel->get_single_row_info('first_name, last_name', 'users', 'id = '.@$v['vendor_id'].'', '', 1);
						
						if(@$productinfo->user_id == 0){
							$vendorName = 'Admin';
						}else{
							$vendorinfo = DB::table('users')->where(['id' => @$productinfo->user_id])->select('*')->orderBy('id', 'DESC')->first();
							$vendorName = @$vendorinfo->first_name.' '.@$vendorinfo->last_name;
						}
					
					    $productImg = DB::table('product_image')->where(['product_id' => @$productinfo->id])->select('*')->orderBy('id', 'ASC')->first();
					
						if(!empty(@$productImg->image) && file_exists('./public/product/'.@$productImg->image.'')){
							$proimg = url('product/'.@$productImg->image.'');
						}else{
							$proimg = url('noimage.jpg');
						}
					
			        }
					//echo $echo;
					
					
				if(!empty(@$productinfo)){
					
					/*if(@$productinfo->user_id == 0){
						$vendorName = 'Admin';
					}else{
						$vendorinfo = DB::table('users')->where(['id' => @$productinfo->user_id])->select('*')->orderBy('id', 'DESC')->first();
						$vendorName = @$vendorinfo->first_name.' '.@$vendorinfo->last_name;
					}*/
					
					/*$productImg = DB::table('product_image')->where(['product_id' => @$productinfo->id])->select('*')->orderBy('id', 'ASC')->first();
					
					if(!empty(@$productImg->image) && file_exists('./public/product/'.@$productImg->image.'')){
						$proimg = url('product/'.@$productImg->image.'');
					}else{
						$proimg = url('noimage.jpg');
					}*/
					
					
					$result .='<div style="word-break: break-all;">
					<div>
					<img src="'.@$proimg.'" alt="Product" style="width:100px; margin-right:10px;" class="img-responsive">
					</div>
					
					<div style=" background-color: #f1f1f1; border-radius: 2px; padding: 2px 5px;">
					<b>Product Name:</b>
					'.@$v['product_name'].'
					</div>
					<!--<a data-toggle="tooltip" data-placement="top" title="" target="_blank" href="'.url('product/product-details?pId='.base64_encode(@$v['product_id']).'').'" data-original-title="Click to preview">
					'.url('product/product-details?pId='.base64_encode(@$v['product_id']).'').' -->
						<div style=" background-color: #f1f1f1; border-radius: 2px; padding: 2px 5px;">
							<b>Quantity:</b> '.$v['quantity'].' / 
							<b>Price: $'.@$productinfo->special_price.'</b>
						</div>
					<!--</a>-->
					
					<div style=" background-color: #f1f1f1; border-radius: 2px; padding: 2px 5px;">
					<b>Vendor:</b>
					'.@$vendorName.'
					</div>
					<div class="clearfix"></div>
					</div>
					<div style="padding-top:10px; font-size:16px;">Total amount of products: $'.@$totalAmount.'</div>
					<hr>';
				
			    }
			}
		}
		return $result;
	}
	
}	