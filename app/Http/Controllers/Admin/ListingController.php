<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class ListingController extends Controller {
	public function __construct() {
		$this->middleware(function ($request, $next) {
			$this->userData = session()->get('userData');
			if (!session()->get('ID_LOGIN') || !session()->get('ADMINLOGINID')) {
			   return redirect()->intended('admin');
			}
			return $next($request);
		});
	}
    public function index() {
        $data = array(
			'title' => 'Listing Lists',
			'page' => 'listing',
			'subpage' => 'listing'
		);
		$data['result'] = DB::table('listing')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.listing', $data);
    }
	public function add() {
        $data = array(
			'title' => 'Add Listing',
			'page' => 'listing',
			'subpage' => 'listing'
		);
		$data['cat'] = DB::table('listing_category')->select('*')->orderBy('name', 'ASC')->get();
		$data['country'] = DB::table('countries')->select('*')->orderBy('name', 'ASC')->get();
		$data['tags'] = DB::table('tags')->select('*')->orderBy('name', 'ASC')->get();
        return view('admin.add_listing', $data);
    }
	function getstate(Request $request){
		$output = '<option value="">Select State</option>';
		if($request->country_name){
			$result = DB::table('states')->where(['country_id' => $request->country_name])->select('*')->orderBy('name', 'ASC')->get();
			foreach($result as $row){
			    $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
			}
		}
		echo $output;
	}
	function getcity(Request $request){
		$output = '<option value="">Select City</option>';
		if($request->state_name){
			$result = DB::table('cities')->where(['state_id' => $request->state_name])->select('*')->orderBy('name', 'ASC')->get();
			foreach($result as $row){
			    $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
			}
		}
		echo $output;
	}
	function getlistsubcategory(Request $request){
		$output = '<option value="">Select Subcategory</option>';
		if($request->catId){
			$result = DB::table('listing_sub_category')->where(['listing_cat_id' => $request->catId])->select('*')->orderBy('name', 'ASC')->get();
			foreach($result as $row){
			    $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
			}
		}
		echo $output;
	}
	public function save(Request $request) {
		$listing_business_name = $request->listing_business_name;
		$listing_name = $request->listing_name;
		/*$country  $request->country;
		$state = $request->state;
		$city = $request->city;
		if($request->online_business){
			$onlineBusiness = $request->online_business;
		}else{
			$onlineBusiness = 0;
		}*/
		$country = 0;
		$state = 0;
		$city = 0;
		$onlineBusiness = 0;
		/*if($request->chk_address == 0){
			$address = $request->address;
			$latitude = $request->latitude;
			$longitude = $request->longitude;
		}elseif($request->chk_address == 1){
			$address = $request->google_address;
			$latitude = $request->google_latitude;
			$longitude = $request->google_longitude;
		}
		$chk_address = $request->chk_address;*/
		$chk_address = 0;
		$address     = $request->google_address;
		$latitude    = $request->google_latitude;
		$longitude   = $request->google_longitude;
		$description = $request->description;
		$phone       = $request->phone;
		$email       = $request->email;
		$website     = $request->website;
		$category    = $request->category;
		$subcategory = 0;
		$listing_tags = '';
		if(@$request->listing_tags){
			$listing_tags = implode(",", @$request->listing_tags);
		}
		$data = ['business_name' => $listing_business_name, 'name' => $listing_name, 'country' => $country, 'city' => $city, 'state' => @$state, 'online_busi' => $onlineBusiness, 'address' => $address, 'latitude' => $latitude, 'longitude' => $longitude, 'description' => $description, 'phone' => $phone, 'email' => $email, 'website' => $website, 'google_map_address' => $chk_address, 'status' => 1, 'category' => $category, 'subcategory' => $subcategory, 'user_id' => 0, 'tags' => $listing_tags, 'created_at' => date('Y-m-d H:i:s')];
		$result = DB::table('listing')->insertGetId($data);
		if($result){
			$getLogo = DB::table('settings')->first();
            $result1 = 'businessID='.$result;
            $QRName = $result.'_qrcode.png';
            $directoryPath = 'public/listingQR/';
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true); // Create the directory if it doesn't exist
            }
            //QrCode::format('png')->size(200)->generate($result, $directoryPath . '/' . $QRName);
            QrCode::format('png')->size(200)->format('png')->merge('/public/setting/'.$getLogo->logo)->errorCorrection('M')->generate($result1, $directoryPath . '/' . $QRName);
            $fullUrl = 'listingQR/'. $QRName;
            $update_data = array('qrpath' => $fullUrl);
            DB::table('listing')->where(['id' => $result])->update(@$update_data);
		    $image = array();
		    if($file = $request->file('listing_gallery')){
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext        = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path    = public_path('listing/');
					$image_url       = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data  = ['image' => $image, 'listing_id' => $result, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('listing_image')->insertGetId($data);
			    }
		    }
			return redirect()->intended('admin/listing')->with("status", "Your listing added successfully!");
		}else{
			return redirect()->intended('admin/listing')->with("error", "Some error occure, Please try again!");
		}
    }
	function edit($id){
		if(empty(@$id)){
			return false;
		}
		$data = array(
			'title'   => 'Edit Listing',
			'page'    => 'listing',
			'subpage' => 'listing'
		);
		$data['result']  = DB::table('listing')->where(['id' => @$id])->select('*')->orderBy('id', 'DESC')->first();
		$data['cat'] = DB::table('listing_category')->select('*')->orderBy('name', 'ASC')->get();
		if(!empty($data['result']->category)){
			$data['subcat'] = DB::table('listing_sub_category')->where(['listing_cat_id' => $data['result']->category])->select('*')->orderBy('name', 'ASC')->get();
		}else{
			$data['subcat'] = "";
		}
		$data['country'] = DB::table('countries')->select('*')->orderBy('name', 'ASC')->get();
		$data['tags'] = DB::table('tags')->select('*')->orderBy('name', 'ASC')->get();
        return view('admin.edit_listing', $data);
	}
	public function update(Request $request) {
		$listing_business_name = $request->listing_business_name;
		$listing_name = $request->listing_name;
		/*$country = $request->country;
		$state = $request->state;
		$city = $request->city;
		if($request->online_business) {
			$onlineBusiness = $request->online_business;
		} else {
			$onlineBusiness = 0;
		}
		if($request->chk_address == 0) {
			$address   = $request->address;
			$latitude  = $request->latitude;
			$longitude = $request->longitude;
		}elseif($request->chk_address == 1) {
			$address   = $request->google_address;
			$latitude  = $request->google_latitude;
			$longitude = $request->google_longitude;
		}
		$chk_address = $request->chk_address;*/
		$chk_address = 0;
		$country = 0;
		$state = 0;
		$city = 0;
		$onlineBusiness = 0;
		$address = $request->google_address;
		$latitude = $request->google_latitude;
		$longitude = $request->google_longitude;
		$description = $request->description;
		$phone = $request->phone;
		$email = $request->email;
		$website = $request->website;
		$category = $request->category;
		$listing_id = $request->listing_id;
		$subcategory = 0;
		$tags = $request->listing_tags;
		$listing_tags = '';
		if(@$request->listing_tags){
			$listing_tags = implode(",", @$request->listing_tags);
		}
		$data = ['business_name' => $listing_business_name, 'name' => $listing_name, 'country' => $country, 'city' => $city, 'state' => @$state, 'online_busi' => $onlineBusiness, 'address' => $address, 'latitude' => $latitude, 'longitude' => $longitude, 'description' => $description, 'phone' => $phone, 'email' => $email, 'website' => $website, 'tags' => @$tags, 'google_map_address' => $chk_address, 'category' => $category, 'subcategory' => $subcategory, 'tags' => $listing_tags, 'updated_at' => date('Y-m-d H:i:s')];
		$result = DB::table('listing')->where('id',$listing_id)->update(@$data);
		if($result){
		    $image = array();
		    if($file = $request->file('listing_gallery')){
			    foreach($file as $file){
					$image_name = md5(rand(1000,10000));
					$ext = strtolower($file->getClientOriginalExtension());
					$image_full_name = $image_name.'.'.$ext;
					$uploade_path = public_path('listing/');
					$image_url = $image_full_name;
					$file->move($uploade_path,$image_full_name);
					$image = $image_url;
					$data = ['image' => $image, 'listing_id' => $listing_id, 'created_at' => date('Y-m-d H:i:s')];
					DB::table('listing_image')->insertGetId($data);
			    }
		    }
			return redirect()->intended('admin/listing')->with("status", "Your listing updated successfully!");
		}else{
			return redirect()->intended('admin/listing')->with("error", "Some error occure, Please try again!");
		}
    }
	public function changestatus(Request $request) {
		if ($request->id) {
			$id = $request->id;
			$status = $request->status;
			if ($status == 1) {
				$msg = 'Your status is Activate';
			} else {
				$msg = 'Your status is Inctivate';
			}
			$result = DB::table('listing')->where(['id' => $id])->update(['status'=>$status]);
			if ($result) {
				echo '["'.$msg.'", "success", "#A5DC86"]';
			} else {
				echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
			}
		}
	}
	public function view($id) {
        $data = array(
			'title' => 'View Listing Information',
			'page' => 'listing',
			'subpage' => 'listing'
		);
		$data['result'] = DB::table('listing')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.view_listing', $data);
    }
	function delete_listing($id){
		if(empty(@$id)){
			return false;
		}
        $result = DB::table('listing')->where('id', $id)->delete();
		if($result){
			return redirect()->intended('admin/listing')->with("status", "Listing deleted successfully!");
		} else {
			return redirect()->intended('admin/listing')->with("error", "Some error occure, Please try again!");
		}
	}
	public function deleteGallery(Request $request) {
	    if(empty(@$request->gId)){
			return false;
		}
        $result = DB::table('listing_image')->where('id', @$request->gId)->delete();
		if($result) {
			echo 1;
		} else {
			echo 0;
		}
    }
	public function listing_category() {
        $data = array(
			'title' => 'Category Lists',
			'page' => 'listing',
			'subpage' => 'listing-category'
		);
		$data['result'] = DB::table('listing_category')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.listing_category', $data);
    }
	public function add_category() {
        $data = array(
			'title' => 'Add Category',
			'page' => 'listing',
			'subpage' => 'listing-category'
		);
        return view('admin.add_listing_category', $data);
    }
	public function save_category(Request $request) {
		$name = $request->name;
		$pckstatus = $request->pckstatus;
		$data = ['name' => $name, 'status' => $pckstatus, 'created' => date('Y-m-d H:i:s')];
        $result =  DB::table('listing_category')->insertGetId($data);
		if($result) {
			return redirect()->intended('admin/listing/category')->with("status", "Your listing category added successfully!");
		} else {
			return redirect()->intended('admin/listing/category')->with("error", "Some error occure, Please try again!");
		}
    }
	public function edit_category($id) {
	    if(empty(@$id)){
			return false;
		}
        $data = array(
			'title' => 'Edit Category',
			'page'    => 'listing',
			'subpage' => 'listing-category'
		);
		$data['result'] = DB::table('listing_category')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.edit_listing_category', $data);
    }
	public function update_category(Request $request) {
	    $name = $request->name;
		$pckstatus = $request->pckstatus;
		$catId = $request->catId;
		$data = ['name' => $name, 'status' => $pckstatus];
		$result = DB::table('listing_category')->where('id',$catId)->update(@$data);
		if($result) {
			return redirect()->intended('admin/listing/category')->with("status", "Your listing category updated successfully!");
		} else {
			return redirect()->intended('admin/listing/category')->with("error", "Some error occure, Please try again!");
		}
    }
	public function delete_category($id) {
	    if(empty(@$id)) {
			return false;
		}
        $result = DB::table('listing_category')->where('id', $id)->delete();
		if($result) {
			return redirect()->intended('admin/listing/category')->with("status", "Category deleted successfully!");
		} else {
			return redirect()->intended('admin/listing/category')->with("error", "Some error occure, Please try again!");
		}
    }
	public function listing_subcategory() {
	    $data = array(
			'title' => 'Listing Subcategory',
			'page' => 'listing',
			'subpage' => 'listing-sub'
		);
		$data['result'] = DB::table('listing_sub_category')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.listing_subcategory', $data);
    }
	public function add_subcategory() {
        $data = array(
			'title' => 'Add Subcategory',
			'page' => 'listing',
			'subpage' => 'listing-sub'
		);
		$data['cat'] = DB::table('listing_category')->select('*')->orderBy('name', 'ASC')->get();
		//$data['country'] = DB::table('countries')->select('*')->orderBy('name', 'ASC')->get();
        return view('admin.add_listing_sub_cat', $data);
    }
	public function save_subcategory(Request $request) {
		$category = $request->category;
		$subcategory = $request->subcategory;
		$pckstatus = $request->pckstatus;
		$data = ['name' => $subcategory, 'listing_cat_id' => $category, 'status' => $pckstatus, 'created_at' => date('Y-m-d H:i:s')];
        $result =  DB::table('listing_sub_category')->insertGetId($data);
		if($result) {
			return redirect()->intended('admin/listing/subcategory')->with("status", "Your listing subcategory added successfully!");
		} else {
			return redirect()->intended('admin/listing/subcategory')->with("error", "Some error occure, Please try again!");
		}
    }
	public function edit_subcategory($id) {
	    if(empty(@$id)){
			return false;
		}
        $data = array(
			'title' => 'Edit Sucategory',
			'page' => 'listing',
			'subpage' => 'listing-sub'
		);
        $data['cat'] = DB::table('listing_category')->select('*')->orderBy('name', 'ASC')->get();
		$data['result'] = DB::table('listing_sub_category')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.edit_listing_subcategory', $data);
    }
	public function update_subcategory(Request $request) {
		$category = $request->category;
		$subcategory = $request->subcategory;
		$pckstatus = $request->pckstatus;
		$id = $request->id;
		$data = ['name' => $subcategory, 'listing_cat_id' => $category, 'status' => $pckstatus, 'updated_at' => date('Y-m-d H:i:s')];
        //$result = DB::table('listing_sub_category')->insertGetId($data);
		$result = DB::table('listing_sub_category')->where('id',$id)->update(@$data);
		if($result) {
			return redirect()->intended('admin/listing/subcategory')->with("status", "Your listing subcategory updated successfully!");
		} else {
			return redirect()->intended('admin/listing/subcategory')->with("error", "Some error occure, Please try again!");
		}
    }
	public function delete_subcategory($id) {
	    if(empty(@$id)) {
			return false;
		}
        $result = DB::table('listing_sub_category')->where('id', $id)->delete();
		if($result) {
			return redirect()->intended('admin/listing/subcategory')->with("status", "Sucategory deleted successfully!");
		} else {
			return redirect()->intended('admin/listing/subcategory')->with("error", "Some error occure, Please try again!");
		}
    }
	public function listing_sub_category_sub() {
	    $data = array(
			'title' => 'Listing Subcategory Sub',
			'page' => 'listing',
			'subpage' => 'listing-sub-sub'
		);
		$data['result'] = DB::table('listing_subcategory_sub')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.listing_subcategory_sub', $data);
    }
	public function add_subcategory_sub() {
        $data = array(
			'title' => 'Add Subcategory Sub',
			'page' => 'listing',
			'subpage' => 'listing-sub-sub'
		);
		$data['sub'] = DB::table('listing_sub_category')->select('*')->orderBy('name', 'ASC')->get();
		//$data['country'] = DB::table('countries')->select('*')->orderBy('name', 'ASC')->get();
        return view('admin.add_listing_subcat_cat', $data);
    }
	public function save_subcategory_save(Request $request) {
		$subcategory = $request->subcategory;
		$subcategorysub = $request->subcategorysub;
		$pckstatus = $request->pckstatus;
		$data = ['name' => $subcategorysub, 'listing_subcategory_id' => $subcategory, 'status' => $pckstatus, 'created_at' => date('Y-m-d H:i:s')];
        $result =  DB::table('listing_subcategory_sub')->insertGetId($data);
		if($result) {
			return redirect()->intended('admin/listing/subcategory-sub')->with("status", "Your listing subcategory sub added successfully!");
		} else {
			return redirect()->intended('admin/listing/subcategory-sub')->with("error", "Some error occure, Please try again!");
		}
    }
	public function edit_subcategory_sub($id) {
	    if(empty(@$id)){
			return false;
		}
        $data = array(
			'title' => 'Edit Subcategory Sub',
			'page' => 'listing',
			'subpage' => 'listing-sub-sub'
		);
        $data['sub'] = DB::table('listing_sub_category')->select('*')->orderBy('name', 'ASC')->get();
		$data['result'] = DB::table('listing_subcategory_sub')->where(['id' => $id])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.edit_listing_subcategory_sub', $data);
    }
	public function update_subcategory_update(Request $request) {
		$subcategory = $request->subcategory;
		$subcategorysub = $request->subcategorysub;
		$pckstatus = $request->pckstatus;
		$id = $request->id;
		$data = ['name' => $subcategorysub, 'listing_subcategory_id' => $subcategory, 'status' => $pckstatus, 'updated_at' => date('Y-m-d H:i:s')];
        //$result =  DB::table('listing_subcategory_sub')->insertGetId($data);
		$result = DB::table('listing_subcategory_sub')->where('id',$id)->update(@$data);
		if($result) {
			return redirect()->intended('admin/listing/subcategory-sub')->with("status", "Your listing subcategory sub updated successfully!");
		} else {
			return redirect()->intended('admin/listing/subcategory-sub')->with("error", "Some error occure, Please try again!");
		}
    }
	public function uploads_listing(){
		 $data = array(
			'title' => 'Upload Bulk Listing',
			'page' => 'listing',
			'subpage' => 'listing'
		);
		//$data['result'] = DB::table('product')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.bulk_listing', $data);
	}
	public function saveBulklisting(){
		$csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv','text/xls','text/xlsx', 'text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream',  'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel');
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)) {
			if(is_uploaded_file($_FILES['file']['tmp_name'])) {
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);
				while(($line = fgetcsv($csvFile)) !== FALSE) {
					$countries = DB::table('countries')->where(['name' => htmlentities($line[2])])->select('*')->orderBy('name', 'ASC')->first();
					if($countries) {
						if($countries->id) {
							$countriesName = $countries->id;
						}else{
							$countriesName = 0;
						}
					}else{
						$countriesName = 0;
					}
					$states = DB::table('states')->where(['name' => htmlentities($line[3])])->select('*')->orderBy('name', 'ASC')->first();
					if($states) {
						if($states->id) {
							$statesName = $states->id;
						} else {
							$statesName = 0;
						}
					} else {
						$statesName = 0;
					}
					$cities = DB::table('cities')->where(['name' => htmlentities($line[4])])->select('*')->orderBy('name', 'ASC')->first();
					if($cities) {
						if($cities->id) {
							$citiesName = $cities->id;
						} else {
							$citiesName = 0;
						}
					} else {
						$citiesName = 0;
					}
					$listCat = DB::table('listing_category')->where(['name' => htmlentities($line[5])])->select('*')->orderBy('name', 'ASC')->first();
					if($listCat) {
						if($listCat->id) {
							$listCatName = $listCat->id;
						} else {
							$listCatName = 0;
						}
					} else {
						$listCatName = 0;
					}
					$listSub = DB::table('listing_sub_category')->where(['name' => htmlentities($line[6])])->select('*')->orderBy('name', 'ASC')->first();
					if($listSub) {
						if($listSub->id) {
							$listSubName = $listSub->id;
						} else {
							$listSubName = 0;
						}
					} else {
						$listSubName = 0;
					}
					$data = ['business_name' => htmlentities($line[0]), 'name' => htmlentities($line[1]), 'country' => @$countriesName, 'state' => @$statesName, 'city' => @$citiesName, 'online_busi' => 1, 'category' => @$listCatName, 'subcategory' => @$listSubName, 'address' => htmlentities($line[7]), 'description' => htmlentities($line[8]), 'phone' => htmlentities($line[9]), 'email' => htmlentities($line[10]), 'website' => htmlentities($line[11]), 'latitude' => htmlentities($line[12]), 'longitude' => htmlentities($line[13]), 'status' => 1, 'user_id' => 0, 'created_at' => date('Y-m-d H:i:s')];
					$result = DB::table('listing')->insertGetId($data);
				}
                fclose($csvFile);
				return redirect()->intended('admin/listing')->with("status", "listing uploaded successfully!");
			} else {
				return redirect()->intended('admin/listing')->with("error", "Some Error Occurred!");
			}
		} else {
			return redirect()->intended('admin/listing')->with("error", "Wrong file uploads or file is required.");
		}
	}
}