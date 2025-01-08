<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class WalletController extends Controller {
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->userData = session()->get('userData');
            if (!session()->get('ID_LOGIN') || !session()->get('ADMINLOGINID')) {
                return redirect()->intended('admin');
            }
            // let the request continue through the stack
            return $next($request);
        });
    }
    public function index() {
        $data = array(
            'title' => 'Withdraw Wallet Request',
            'page' => 'withdraw_request',
            'subpage' => 'withdraw_request'
        );
        $data['result'] = DB::table('withdraw_request')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.wallet_request', $data);
    }
}	