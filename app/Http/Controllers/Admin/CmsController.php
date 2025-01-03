<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class CmsController extends Controller {
  

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
			'title'   => 'Privacy Policy',
			'page'    => 'cms',
			'subpage' => 'privacy-policy'
		);
		
		$data['result'] = DB::table('cms')->where(['id' => 1])->select('*')->first();
        return view('admin.privacy', $data);
    }
	
	public function update_privacy(Request $request)
    { 
		

		$heading     = $request->heading;
		$description = $request->description;
		$status      = $request->status;
		
		$data = ['heading' => $heading, 'description' => $description, 'status' => $status, 'updated_at' => date('Y-m-d H:i:s')];
		$result = DB::table('cms')->where('id',1)->update($data);
		
		if($result){
			return redirect()->intended('admin/cms/privacy-policy')->with("status", "Privacy policy updated successfully!");
		}else{
			return redirect()->intended('admin/cms/privacy-policy')->with("error", "Some error occure, Please try again!");
		}
        
    }
	
	 public function term()
    { 
        $data = array(
			'title'   => 'Term & Condition',
			'page'    => 'cms',
			'subpage' => 'term-condition'
		);
		
		$data['result'] = DB::table('cms')->where(['id' => 2])->select('*')->first();
        return view('admin.term', $data);
    }
	
	public function update_term(Request $request)
    { 
		

		$heading     = $request->heading;
		$description = $request->description;
		$status      = $request->status;
		
		$data = ['heading' => $heading, 'description' => $description, 'status' => $status, 'updated_at' => date('Y-m-d H:i:s')];
		$result = DB::table('cms')->where('id',2)->update($data);
		
		if($result){
			return redirect()->intended('admin/cms/term-and-condition')->with("status", "Term and condition updated successfully!");
		}else{
			return redirect()->intended('admin/cms/term-and-condition')->with("error", "Some error occure, Please try again!");
		}
        
    }
	
	public function faq()
    { 
        $data = array(
			'title'   => 'FAQ',
			'page'    => 'cms',
			'subpage' => 'faq'
		);
		
		$data['result'] = DB::table('faq')->select('*')->get();
        return view('admin.faq', $data);
    }
	
	public function add_faq()
    { 
        $data = array(
			'title'   => 'Add FAQ',
			'page'    => 'cms',
			'subpage' => 'faq'
		);
        return view('admin.add_faq', $data);
    }
	
	public function save_faq(Request $request)
    { 
	
        $question = @$request->question;
		$answer   = @$request->answer;
		$status   = @$request->status;

		$data = ['question' => $question, 'answer' => $answer, 'status' => $status, 'created_at' => date('Y-m-d H:i:s')];
		
		$result = DB::table('faq')->insertGetId($data);
		
		if($result){
			return redirect()->intended('admin/cms/faq')->with("status", "FAQ added successfully!");
		}else{
			return redirect()->intended('admin/cms/faq')->with("error", "Some error occure, Please try again!");
		}
    }
	
	public function edit_faq($id)
    { 
	
        $data = array(
			'title'   => 'Edit FAQ',
			'page'    => 'cms',
			'subpage' => 'faq'
		);
	    $data['result'] = DB::table('faq')->where(['id' => $id])->select('*')->first();
	    	
        return view('admin.edit_faq', $data);
    }
	
	public function update_faq(Request $request)
    { 
		
		
		$question = @$request->question;
		$answer   = @$request->answer;
		$status   = @$request->status;
		$id       = @$request->id;

		$data = ['question' => $question, 'answer' => $answer, 'status' => $status, 'created_at' => date('Y-m-d H:i:s')];
		
		$result = DB::table('faq')->where('id',@$id)->update($data);
		
		if($result){
			return redirect()->intended('admin/cms/faq')->with("status", "FAQ updated successfully!");
		}else{
			return redirect()->intended('admin/cms/faq')->with("error", "Some error occure, Please try again!");
		}
        
    }
	
	
	
	
	
	public function delete_faq($id)
    { 
	    if(empty(@$id)){
			return false;
		}
		
        $result = DB::table('faq')->where('id', $id)->delete();
		if($result){
			//return back()->with("status", "User type added successfully!");
			return redirect()->intended('admin/cms/faq')->with("status", "FAQ deleted successfully!");
		}else{
			//return back()->with("error", "Some error occure, Please try again!");
			return redirect()->intended('admin/cms/faq')->with("error", "Some error occure, Please try again!");
		}
		
        
    }
	
	public function changestatus_faq(Request $request)
	{
		if ($request->faqId) {
			$id     = $request->faqId;
			$status = $request->status;
			if ($status == 1) {
				$msg = 'Your status is Activate';
			} else {
				$msg = 'Your status is Inctivate';
			}
			$result = DB::table('faq')->where('id',@$id)->update(['status'=>$status]);
			
			if ($result) {
				echo '["'.$msg.'", "success", "#A5DC86"]';
			} else {
				echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
			}
		}
	}
	
	public function about()
    { 
		
		
		$data = array(
			'title'   => 'About Us',
			'page'    => 'cms',
			'subpage' => 'about-us'
		);
		
		$data['aboutUs'] = DB::table('cms')->where(['id' => 3])->select('*')->first();
		
        return view('admin.about_us', $data);
        
    }
	
	public function  saveabout(Request $request){
		
		if ($request['upload_image']) {
            $img       = $request['upload_image'];
            $extn      = $img->getClientOriginalExtension();
            $path      = public_path('setting/');
            $file_name = rand() . '.' . $extn;
            $img->move($path, $file_name);
        } else {
			$where   = ['id' => 3];
		    $getData = DB::table('cms')->where($where)->select('image')->first();
			if($getData->image){
				$file_name = $getData->image;
			}else{
				$file_name = '';
			}
            
        }
		
		$heading     = $request->heading;
		$description = $request->description;
		$status      = $request->status;
		
		$data = ['heading' => $heading, 'description' => $description, 'image' => $file_name, 'status' => $status, 'updated_at' => date('Y-m-d H:i:s')];
		$count = DB::table('cms')->where(['id' => 3])->select('*')->count();
		if($count > 0){
			$result = DB::table('cms')->where('id',3)->update(@$data);
		}else{
			$result = DB::table('cms')->insertGetId($data);
		}
		
		
		if($result){
			return redirect()->intended('admin/cms/about-us')->with("status", "About us updated successfully!");
		}else{
			return redirect()->intended('admin/cms/about-us')->with("error", "Some error occure, Please try again!");
		}
	}
	
	
}