<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailerController extends Controller {

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

    function index($flag = ''){
		$result = DB::table('compose_email')->where(['type' => 'draft'])->select('*')->orderBy('id', 'DESC')->get();
		$data = array(
			'flag'    => $flag,
			'title'   => 'Draft List',
			'heading' => 'Draft List',
			'result'  => $result,
			'page'    => 'template',
			'subpage' => 'template',
			'submenu' => 'draftlist',

        );
		
		
		// $this->load->view('admin/header', $data);
		// $this->load->view('admin/sidebar');
		// $this->load->view('admin/email_management/draftlist');
		// $this->load->view('admin/footer');
		return view('admin.email_management.draftlist', $data);
	}
	
	function update($flag = ''){
		if(empty(@$_GET['dId'])){
			return false;
		}
		
		$data = array(
			'flag'    => $flag,
			'title'   => 'Compose Mail',
			'heading' => 'Compose Mail',
			'result'  => @$result,
			'page'    => 'template',
			'subpage' => 'template',
			'submenu' => 'composelist',

        );

		//$data['result'] = $this->Adminmodel->get_single_record('*', 'compose_email', array('id' => base64_decode(@$_GET['dId'])), array('id', 'DESC'), 1);
	    //$data['users']  = $this->Adminmodel->get_all_record('*', 'users', array('status' => 1), array('id', 'asc'), '');
		$data['users']  = DB::table('users')->where(['status' => 1])->select('*')->orderBy('id', 'asc')->get();
		$data['result'] = DB::table('compose_email')->where(['id' => base64_decode(@$_GET['dId'])])->select('*')->orderBy('id', 'DESC')->first();
		return view('admin.email_management.composeemail', $data);
	}
	
	function send_new_mail(Request $request){
		
		if($_FILES['attachment']['name'] != '') {
			$src = $_FILES['attachment']['tmp_name'];
			$filEnc = time();
			$avatar ='mail'.'_'.rand(11111, 99999)."_".$_FILES['attachment']['name'];
			$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
			$dest = getcwd() . '/public/email/' . $avatar1;
			if (move_uploaded_file($src, $dest)) {
				$attachment  = $avatar1;
			}
		} else {
			//$attachment ='';

			$email_attach = DB::table('email_template')->where(['id' => @$request->id])->select('attachment')->orderBy('id', 'DESC')->first();
			if(!empty(@$email_attach)){
				$attachment = $email_attach->attachment;
			}else{
				$attachment = '';
			}
		}
		
		if(isset($request->sent))
		{
			$to=[];
		   
			foreach ($request->guest as $value){
				$to[] = $value;
			}
			
			$recipients = implode(',', $to);
			$email_data = array('body' => @$request->body, 'attachment' => @$attachment);
			
			//$msg = $this->load->view('admin/email_management/email_template',$email_data,TRUE);
			$msg = view('admin.email_management.email_template', $email_data);
			
			$result = $this->mail_send_management('phptest@goigi.in', 'phptest@goigi.in', $to, $msg, @$request->subject, 'rameshwebdev21@gmail.com', 'gqbtiijrzaljwkhz');
			
			if(!empty($result)){
				
				$data = array('subject' => @$request->subject, 'body' => @$request->body, 'attachment' => $attachment, 'type' => 'send', 'status' => '1', 'created_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients);
				
				$result = DB::table('compose_email')->insertGetId($data);
				
				if($result){
					return redirect()->intended('admin/mailer/list_send_mail')->with("status", "Sent successfully!");
				}else{
					return redirect()->intended('admin/mailer/list_send_mail')->with("error", "Some error occure, Please try again!");
				}
			}
			//echo $recipients;
			//print_r($result);
		}else{
			$to=[];
		   
			foreach ($_POST['guest'] as $value){
				$to[] = $value;
			}
			
			$recipients = implode(',', $to);
			
			$data = array('subject' => @$request->subject, 'body' => @$request->body, 'attachment' => $attachment, 'type' => 'draft', 'status' => '1', 'created_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients);
			
			$result = DB::table('compose_email')->insertGetId($data);
			if($result){
				return redirect()->intended('admin/mailer')->with("status", "Sent successfully!");
			}else{
				return redirect()->intended('admin/mailer')->with("error", "Some error occure, Please try again!");
			}
		}

	}
	
	function list_send_mail($flag = ''){
		
        $result = DB::table('compose_email')->where(['type' => 'send'])->select('*')->orderBy('id', 'DESC')->get();
		
		$data = array(
            'flag'    => $flag,
            'title'   => 'Send Mail Template List',
            'page'    => 'template',
			'subpage' => 'template',
            'heading' => 'Send Mail Template List',
            'result'  => $result,
			'submenu' => 'sendlist',
        );
		
		// $this->load->view('admin/header', $data);
		// $this->load->view('admin/sidebar');
		// $this->load->view('admin/email_management/send_mail_list');
		// $this->load->view('admin/footer');
		return view('admin.email_management.send_mail_list', $data); 
	}
	
	function existing_template($flag = ''){
	
		//$result = $this->Adminmodel->get_all_record('*', 'email_template', '', array('id', 'asc'), '');
		$result = DB::table('email_template')->select('*')->orderBy('id', 'asc')->get();
		$data = array(
            'flag'    => $flag,
            'title'   => 'StarBiz',
            'page'    => 'template',
			'subpage' => 'template',
            'heading' => 'List of Template',
            'result'  => $result,
			'submenu' => 'existinglist',
        );
		
		// $this->load->view('admin/header', $data);
		// $this->load->view('admin/sidebar');
		// $this->load->view('admin/email_management/use_template');
		// $this->load->view('admin/footer');
		return view('admin.email_management.use_template', $data); 
	}
	
	function add_use_template(){
		if(empty(@$_GET['id'])){
			return false;
		}
		$data = array(
            'title' => 'Add Use Template',
            'page'=>'template',
			'subpage'=>'template',
            'heading'=>'Add Use Template',
        );
		//$data['result'] = $this->Adminmodel->get_single_record('*', 'email_template', 'id = '.base64_decode(@$_GET['id']).'', array('id', 'asc'), '');
		//$data['users'] = $this->Adminmodel->get_all_record('*', 'users', array('status' => 1), array('id', 'asc'), '');
		
		$data['result'] = DB::table('email_template')->where(['id' => base64_decode(@$_GET['id'])])->select('*')->orderBy('id', 'asc')->first();
		//print_r($data['result']);die;
		$data['users'] = DB::table('users')->where(['status' => 1])->select('*')->orderBy('id', 'asc')->get();
		
		// $this->load->view('admin/header', $data);
		// $this->load->view('admin/sidebar');
		// $this->load->view('admin/email_management/add_use_template');
		// $this->load->view('admin/footer');
		return view('admin.email_management.add_use_template', $data); 
	}
	
	
	function save_use_template(Request $request){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			
			if($_FILES['attachment']['name'] != '') {
				$src = $_FILES['attachment']['tmp_name'];
				$filEnc = time();
				$avatar ='mail'.'_'.rand(11111, 99999)."_".$_FILES['attachment']['name'];
				$avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
				$dest = getcwd() . '/public/email/' . $avatar1;
				if (move_uploaded_file($src, $dest)) {
					$attachment  = $avatar1;
				}
			} else {
				$email_attach = DB::table('email_template')->where(['id' => @$request->id])->select('attachment')->orderBy('id', 'DESC')->first();
				if(!empty(@$email_attach)){
					$attachment = $email_attach->attachment;
				}else{
					$attachment = '';
				}
				
			}
			
			if(isset($_POST['sent']))
			{
                $to=[];
			   
				foreach ($_POST['guest'] as $value){
					$to[] = $value;
				}
				
				$recipients = implode(',', $to);
				$email_data = array('body' => @$_POST['body'], 'attachment' => @$attachment);

				$msg = view('admin.email_management.email_template', $email_data);

				$result = $this->mail_send_management('phptest@goigi.in', 'phptest@goigi.in', $to, $msg, @$request->subject, 'rameshwebdev21@gmail.com', 'gqbtiijrzaljwkhz');
				
				if(!empty($result)){
					
					$data = array('subject' => @$request->subject, 'body' => @$request->body, 'attachment' => $attachment, 'type' => 'send', 'status' => '1', 'update_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients, 'created_date' => date('Y-m-d H:i:s'));

					$result = DB::table('compose_email')->insertGetId($data);
					
					if($result){
						return redirect()->intended('admin/mailer/existing_template')->with("status", "Sent successfully!");
					}else{
						return redirect()->intended('admin/mailer/existing_template')->with("error", "Some error occure, Please try again!");
					}

					
				}
			}else{
				$to=[];
			   
				foreach ($_POST['guest'] as $value){
					$to[] = $value;
				}
				$recipients = implode(',', $to);
				
				$data = array('subject' => @$request->subject, 'body' => @$request->body, 'attachment' => $attachment, 'type' => 'draft', 'status' => '1', 'update_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients, 'created_date' => date('Y-m-d H:i:s'));
				
				$result = DB::table('compose_email')->insertGetId($data);
					
				if($result){
					return redirect()->intended('admin/mailer/existing_template')->with("status", "Save successfully!");
				}else{
					return redirect()->intended('admin/mailer/existing_template')->with("error", "Some error occure, Please try again!");
				}
			}
		}
	}
	
	
	function new_compose_mail(){
		
		$data = array(
			'title'   => 'Compose New Mail',
			'heading' => 'Compose New Mail',
			'page'    => 'template',
			'subpage' => 'template',
			'submenu' => 'composelist',
		);
		$data['users'] = DB::table('users')->where(['status' => 1])->select('*')->orderBy('id', 'asc')->get();
		$data['result'] = '';
		// $this->load->view('admin/header', $data);
		// $this->load->view('admin/sidebar');
		// $this->load->view('admin/email_management/composeemail');
		// $this->load->view('admin/footer');
		return view('admin.email_management.composeemail', $data); 
	}
	
	// function send_new_mail(){
		// if($_SERVER['REQUEST_METHOD'] == 'POST'){
			// $userId = $this->session->userdata('loguserId');
			
			// if($_FILES['attachment']['name'] != '') {
				// $src = $_FILES['attachment']['tmp_name'];
				// $filEnc = time();
				// $avatar ='mail'.'_'.rand(11111, 99999)."_".$_FILES['attachment']['name'];
				// $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
				// $dest = getcwd() . '/public/email/' . $avatar1;
				// if (move_uploaded_file($src, $dest)) {
					// $attachment  = $avatar1;
				// }
			// } else {
				
				// $email_attach = DB::table('email_template')->where(['id' => @$request->id])->select('attachment')->orderBy('id', 'DESC')->first();
				// if(!empty(@$email_attach)){
					// $attachment = @$email_attach->attachment;
				// }else{
					// $attachment = '';
				// }
			// }
			
			// if(isset($_POST['sent']))
			// {
                // $to=[];
			   
				// foreach ($_POST['guest'] as $value){
					// $to[] = $value;
				// }
				
				// $recipients = implode(',', $to);
				
				// $email_data = array('body' => @$_POST['body'], 'attachment' => @$attachment);
				
				// $msg = view('admin.email_management.email_template', $email_data);
				
				// $result = $this->mail_send_management('phptest@goigi.in', 'phptest@goigi.in', $to, $msg, @$request->subject, 'rameshwebdev21@gmail.com', 'gqbtiijrzaljwkhz');
			
				// if(!empty($result)){
					// $data = array('subject' => @$request->subject, 'body' => @$request->body, 'attachment' => $attachment, 'type' => 'send', 'status' => '1', 'created_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients);
					// $result = DB::table('compose_email')->insertGetId($data);
					// if($result){
						// return redirect()->intended('admin/mailer/list_send_mail')->with("status", "Sent successfully!");
					// }else{
						// return redirect()->intended('admin/mailer/list_send_mail')->with("error", "Some error occure, Please try again!");
					// }
				// }
				// //echo $recipients;
				// //print_r($result);
			// }else{
				// $to=[];
			   
				// foreach ($_POST['guest'] as $value){
					// $to[] = $value;
				// }
				// $recipients = implode(',', $to);
				
				
				// $data = array('subject' => @$request->subject, 'body' => @$request->body, 'attachment' => $attachment, 'type' => 'draft', 'status' => '1', 'created_date' => date('Y-m-d H:i:s'), 'recipients' => $recipients);
				
				// $result = DB::table('compose_email')->insertGetId($data);
				// if($result){
					// return redirect()->intended('admin/mailer/list_send_mail')->with("status", "Save successfully!");
				// }else{
					// return redirect()->intended('admin/mailer/list_send_mail')->with("error", "Some error occure, Please try again!");
				// }
			// }
			
		// }
	// }
	
	function get_recipients(Request $request){
		
		
		$select_query = DB::table('compose_email')->where(['id' => @$request->id])->select('recipients')->orderBy('id', 'DESC')->first();
		if(!empty($select_query)){
			echo $select_query->recipients;
		}
	}
	
	
	function delete_send_list(Request $request){
		
			$id = $request->id;
			$delete_query = DB::table('compose_email')->where('id', $id)->delete();
			if(!empty($delete_query)){
				$response['status'] = 1;
				$response['message'] = 'mail deleted successfully.';
			}else{
				$response['status'] = 0;
				$response['message'] = 'error.'; 
			}
		
		echo json_encode($response);
	}
	function mail_send_management($to_email = '', $from_email = '', $bcc = '', $msg = '', $subject = '', $mail_username = '', $mail_password = ''){
		require_once 'vendor/email/vendor/autoload.php';
		$mail = new PHPMailer();
		$mail->SMTPDebug = 0; //Enable verbose debug output
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->IsSMTP();
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = $mail_username;                
		$mail->Password = $mail_password;
		$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587; // TCP port to connect to
		$mail->setFrom($from_email);
		$mail->addAddress($to_email);
		if(!empty($bcc)){
			foreach($bcc as $v){
				$mail->AddBCC($v);//data taken from table
			}
		}
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		return $mail->send();
	}

	
  
 
}	