<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class InvitationController extends Controller {
  

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
			'title' => 'Invitation Lists',
			'page' => 'invitation',
			'subpage' => 'invitation'
		);

		$Sql = "SELECT invitation.id as invId, invitation.event_id, invitation.status as status1, invitation.comment, repeat_invitation.invitation_id, repeat_invitation.sender_id, repeat_invitation.receiver_id, repeat_invitation.amount, repeat_invitation.hour, repeat_invitation.status FROM invitation INNER JOIN repeat_invitation ON invitation.id = repeat_invitation.invitation_id";
	    $data['result'] = DB::select($Sql);
		//print_r($data['result']);
        return view('admin.invitation', $data);
    }
}	