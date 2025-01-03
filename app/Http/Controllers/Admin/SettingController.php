<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class SettingController extends Controller {
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
            'title' => 'Site Setting',
            'page' => 'setting',
            'subpage' => ''
        );
        $where = ['settingId' => 1];
        $data['result'] = DB::table('settings')->where($where)->select('*')->first();
        return view('admin.site_setting', $data);
    }
    public function savesite_setting(Request $request) {
        $address = $request->address;
        $email = $request->email;
        $phone = $request->phone;
        $facebook = $request->facebook;
        $twitter = $request->twitter;
        $linkedin = $request->linkedin;
        $instagram = $request->instagram;
        $youtube = $request->youtube;
        $adminshare = $request->adminshare;
        $radius = $request->radius;
        $stripe_publishable_key = $request->stripe_publishable_key;
        $stripe_secret_key = $request->stripe_secret_key;
        $data = [
            'address' => $address,
            'email' => $email,
            'phone' => $phone,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'linkedin' => $linkedin,
            'instagram' => $instagram,
            'youtube' => $youtube,
            'admin_percentage' => $adminshare,
            'kilometer' => $radius,
            'stripe_publishable_key' => $stripe_publishable_key,
            'stripe_secret_key' => $stripe_secret_key
        ];
        $result = DB::table('settings')->where('settingId', 1)->update(@$data);
        if ($result) {
            //return redirect()->intended('admin/profile')->withSuccess('update successfully.');
            return back()->with("status", "Your site setting update successfully.!");
        } else {
            return back()->with("error", "Some error occure, Please try again.!");
        }
    }
    public function logo_setting() {
        $data = array(
            'title' => 'Logo Setting',
            'page' => 'setting',
            'subpage' => ''
        );
        $where = ['settingId' => 1];
        $data['result'] = DB::table('settings')->where($where)->select('*')->first();
        return view('admin.logo_setting', $data);
    }
    public function savelogo_setting(Request $request) {
        if ($request['logo']) {
            $img = $request['logo'];
            $extn = $img->getClientOriginalExtension();
            $path = public_path('setting/');
            $logo = rand() . '.' . $extn;
            $img->move($path, $logo);
        } else {
            $where = ['settingId' => 1];
            $getData = DB::table('settings')->where($where)->select('logo')->first();
            $logo = $getData->logo;
        }
        if ($request['sec_logo']) {
            $img = $request['sec_logo'];
            $extn = $img->getClientOriginalExtension();
            $path = public_path('setting/');
            $sec_logo = rand() . '.' . $extn;
            $img->move($path, $sec_logo);
        } else {
            $where = ['settingId' => 1];
            $getData = DB::table('settings')->where($where)->select('sec_logo')->first();
            $sec_logo = $getData->sec_logo;
        }
        if ($request['favicon']) {
            $img = $request['favicon'];
            $extn = $img->getClientOriginalExtension();
            $path = public_path('setting/');
            $favicon = rand() . '.' . $extn;
            $img->move($path, $favicon);
        } else {
            $where = ['settingId' => 1];
            $getData = DB::table('settings')->where($where)->select('favicon')->first();
            $favicon = $getData->favicon;
        }
        $title = $request->title;
        $data = ['title' => $title, 'logo' => $logo, 'sec_logo' => $sec_logo, 'favicon' => $favicon];
        $result = DB::table('settings')->where('settingId', 1)->update(@$data);
        if ($result) {
            //return redirect()->intended('admin/profile')->withSuccess('update successfully.');
            return back()->with("status", "Your logo setting update successfully.!");
        } else {
            return back()->with("error", "Some error occure, Please try again.!");
        }
    }
    public function changepassword(Request $request) {
        $where = ['id' => session()->get('ADMINLOGINID')];
        $getData = DB::table('admin')->where($where)->select('password')->first();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        if (md5($request->old_password) != @$getData->password) {
            return back()->with("error", "Old Password Doesn't match!");
        }
        $result = DB::table('admin')->where('id', session()->get('ADMINLOGINID'))->update(['password' => md5($request->new_password)]);
        return back()->with("status", "Password changed successfully!");
    }
}