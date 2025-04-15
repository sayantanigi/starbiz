<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Stripe;
class LoginController extends Controller {
    public function __construct() {
        /*$this->middleware(function ($request, $next) {
            $this->userData = session()->get('userData');
            if (!session()->get('ID_LOGIN') || !session()->get('ADMINLOGINID')) {
                return redirect()->intended('admin');
            }
            return $next($request);
        });*/
    }
    public function index() {
        $data = array(
            'title' => 'Users Lists',
            'page' => 'users',
            'subpage' => 'users'
        );
        return view('login', $data);
    }
    public function submitLogin(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!$validatedData) {
            return back()->withErrors('message', $validatedData);
        }
        $email = $request->email;
        $password = md5($request->password);
        $credentials = ['email' => $email, 'password' => $password];
        $checkAuth = DB::table('users')->where($credentials)->select('*')->get();
        if (count($checkAuth) == 1) {
            session()->put('USERLOGINID', $checkAuth[0]->id);
            if ($checkAuth[0]->user_type == 3) {
                if ($checkAuth[0]->status == 1) {
                    session()->put('IDLOGIN', TRUE);
                    return redirect()->intended('dashboard')->withSuccess('Signed in');
                } else {
                    $checkDocumentData = DB::table('user_document')->where('user_id', $checkAuth[0]->id)->first();
                    if(!empty($checkDocumentData)) {
                        $validator['text'] = 'Please wait for document approval.';
                        return back()->withErrors($validator);
                    } else {
                        return redirect()->intended('document');
                    }
                }
            } else {
                $validator['text'] = 'Athletes & Entertainers are not allowed to login in this portal.';
                return back()->withErrors($validator);
            }
        } else {
            $validator['text'] = 'Oops! invalid email and password.';
            return back()->withErrors($validator);
        }
    }
    public function logout(Request $request) {
        Session::flush();
        return redirect('/login');
    }
}