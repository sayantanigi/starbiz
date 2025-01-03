<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EmailtemplateController extends Controller {

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


	
	
	function index($flag='')
	{
		$result = DB::table('email_template')->select('*')->orderBy('id', 'asc')->get();		
		
		$data = array(
            'flag' => $flag,
            'title' => 'StarBiz',
			'page'=>'template',
			'subpage'=>'temp-creation',
            'heading'=>'List of Template',
            'result'=>$result,
        );
		return view('admin.email_management.template_list', $data);
	}
	
	public function create(){
		$data = array(
			'heading'=>'Add Template',
			'title'=>'StarBiz',
			'page'=>'template',
			'subpage'=>'temp-creation',
			'button'=>'Create',
			// 'subject' =>set_value('subject'),
			// 'body' =>set_value('body'),
			// 'attachment' =>set_value('attachment'),
			// 'id' =>set_value('id'),
		);
		// $this->load->view('admin/header', $data);
		// $this->load->view('admin/sidebar');
		// $this->load->view('admin/email_management/template_form',$data);
		// $this->load->view('admin/footer');
		return view('admin.email_management.template_form', $data);
	}
	
	function create_action(Request $request)
	{
		if($_FILES['attachment']['name'] != '') {

			$src = $_FILES['attachment']['tmp_name'];
			$filEnc = time();
			$avatar ='email'.'_'.rand(11111, 99999)."_".$_FILES['attachment']['name'];
			$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
			$dest = getcwd() . '/public/email/' . $avatar1;
			if (move_uploaded_file($src, $dest)) {
			$attachment  = $avatar1;
			}
		} else {
		  $attachment ='';
		}
		
		$data = array(
			'subject'      => $request->subject,
			'body'         => $request->body,
			'attachment'   => $attachment,
			'created_date' => date('Y-m-d H:i:s'),
		);
		
		// $this->db->insert('email_template',$data);
		// $this->session->set_flashdata('msg', 'template created Successfully!');
		// redirect(base_url("admin/emailtemplate"));
		
		$result = DB::table('email_template')->insertGetId($data);
		if($result){
			return redirect()->intended('admin/emailtemplate')->with("status", "template created Successfully!");
		}else{
			return redirect()->intended('admin/emailtemplate')->with("error", "Some error occure, Please try again!");
		}
	}
	
	public function update($id)
	{
		$template_id  =base64_decode($id);
		//$update_data = $this->Adminmodel->get_single_record('*', 'email_template', array('id' => $template_id), '', 1);
		$update_data = DB::table('email_template')->where(['id' => $template_id])->select('*')->orderBy('id', 'asc')->first();		;
		
		$data=array(
			'heading'    => 'Update Template',
			'button'     => 'Update',
			'subject'    => @$update_data->subject,
			'body'       => @$update_data->body,
			'attachment' => @$update_data->attachment,
			'id'         => @$template_id,
			'title'      => 'StarBiz',
			'page'       => 'template',
			'subpage'    => 'temp-creation',
		);
		
		// //$this->load->view('admin/email_management/template_form',$data);
		// $this->load->view('admin/header', $data);
		// $this->load->view('admin/sidebar');
		// $this->load->view('admin/email_management/template_form',$data);
		// $this->load->view('admin/footer');
		return view('admin.email_management.template_form', $data);
	}
	
	function update_action(Request $request)
	{
		if($_FILES['attachment']['name'] != '') {
			$src = $_FILES['attachment']['tmp_name'];
			$filEnc = time();
			$avatar ='email'.'_'.rand(11111, 99999)."_".$_FILES['attachment']['name'];
			$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
			$dest = getcwd() . '/public/email/' . $avatar1;
			if (move_uploaded_file($src, $dest)) {
				$attachment  = $avatar1;
				@unlink('public/email/'.$request->old_attachment);
			}
		} else {
		    $attachment = $request->old_attachment;
		}

		$data=array(
			'subject' => $request->subject,
			'body' => $request->body,
			'attachment' => $attachment,
		);
		
		
		$result = DB::table('email_template')->where(['id' => $request->id])->update($data);
		if($result){
			return redirect()->intended('admin/emailtemplate')->with("status", "template updated Successfully!");
		}else{
			return redirect()->intended('admin/emailtemplate')->with("error", "Some error occure, Please try again!");
		}

		
	}
	
	function delete_template(Request $request){
			$id = $request->id;
			$delete_query = DB::table('email_template')->where('id', $id)->delete();
			if(!empty($delete_query)){
				$response['status'] = 1;
				$response['message'] = 'Template deleted successfully.';
			}else{
				$response['status'] = 0;
				$response['message'] = 'error.';
			}
		
		echo json_encode($response);
	}
	
  
 
}	