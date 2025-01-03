<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Stripe;
class SubscriptionController extends Controller
{
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
    function testPlan() {
        $stripeDetails = DB::table('settings')->where('settingId','1')->select('*')->first();
        $stripePublishableKey = $stripeDetails->stripe_publishable_key;
        $stripeSecretKey = $stripeDetails->stripe_secret_key;
        $itemPrice = 19.00 * 100;
        require "vendor/stripe/stripe-php/init.php";
        $stripe = array(
            "secret_key" => $stripeSecretKey,
            "publishable_key" => $stripePublishableKey
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        try {
            $plan = \Stripe\Plan::create(array(
                "product" => [
                    "name" => "Advanced"
                ],
                "amount" => @$itemPrice,
                "currency" => 'usd',
                "interval" => 'month',
                "interval_count" => 1
            ));
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }
        print_r($plan);
    }
    public function index()
    {
        $data = array(
            'title' => 'Subscription',
            'page' => 'subscription',
            'subpage' => 'sub'
        );
        $data['result'] = DB::table('sub_plan')->select('*')->get();
        $data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        $data['menus'] = DB::table('sub_access_menu')->where(['status' => 1])->select('*')->get();
        return view('admin.subscription', $data);
    }
    public function add()
    {
        $data = array(
            'title' => 'Add Subscription',
            'page' => 'subscription',
            'subpage' => 'sub'
        );
        $data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        $data['menus'] = DB::table('sub_access_menu')->where(['status' => 1])->select('*')->get();
        return view('admin.add_sub', $data);
    }
    public function save(Request $request) {
        $stripeDetails = DB::table('settings')->where('settingId','1')->select('*')->first();
        $stripePublishableKey = $stripeDetails->stripe_publishable_key;
        $stripeSecretKey = $stripeDetails->stripe_secret_key;
        require "vendor/stripe/stripe-php/init.php";
        $name = $request->name;
        $description = $request->description;
        $plan = $request->plan;
        $duration = $request->duration;
        $type = $request->type;
        $status = $request->pckstatus;
        $user_type = $request->user_type;
        $menus = @$request->menus;
        $menuIds = array_column($menus, 'menu_id');
        $menuIds = implode(",", $menuIds);
        if ($request->plan == 1) {
            $amount = '0.00';
        } else {
            $amount = $request->amount;
        }
        if (@$request->access) {
            $access = implode(',', @$request->access);
        } else {
            $access = '';
        }
        $data = ['name' => $name, 'description' => $description, 'plan' => $plan, 'type' => $type, 'duration' => $duration, 'status' => $status, 'amount' => @$amount, 'user_type' => $user_type, 'access' => @$access, 'created_at' => date('Y-m-d H:i:s')];
        $result = DB::table('sub_plan')->insertGetId($data);
        if ($result) {
            DB::table('sub_permision_menu')->where('sub_id', $result)->delete();
            if (@$menus) {
                foreach ($menus as $menu) {
                    $array = [
                        'sub_id' => $result,
                        'menu_id' => $menu['menu_id'],
                        'read_access' => $menu['has_read_access'],
                        'write_access' => $menu['has_write_access'],
                        'full_access' => $menu['has_full_access'],
                        'number_of' => $menu['number_count'],
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    DB::table('sub_permision_menu')->insertGetId($array);
                }
            }
            $planInterval = '';
            if ($type == 1) {
                $planInterval = 'month';
            } elseif ($type == 2) {
                $planInterval = 'year';
            }
            $currency = 'usd';
            $stripe = array(
                "secret_key" => $stripeSecretKey,
                "publishable_key" => $stripePublishableKey
            );
            \Stripe\Stripe::setApiKey($stripe['secret_key']);
            if ($plan == 2) {
                $itemPrice = $amount * 100;
                try {
                    $plan = \Stripe\Plan::create(array(
                        "product" => [
                            "name" => @$name
                        ],
                        "amount" => @$itemPrice,
                        "currency" => @$currency,
                        "interval" => @$planInterval,
                        "interval_count" => @$duration
                    ));
                } catch (Exception $e) {
                    $api_error = $e->getMessage();
                }
                if (empty($api_error) && $plan) {
                    DB::table('sub_plan')->where('id', @$result)->update(['stripe_plan_id' => $plan->id]);
                }
            }
            $response['status'] = 1;
            $response['message'] = "Subscription plan added successfully!";
            //return redirect()->intended('admin/subscription')->with("status", "Subscription plan added successfully!");
        } else {
            //return redirect()->intended('admin/subscription')->with("error", "Some error occure, Please try again!");
            $response['status'] = 0;
            $response['message'] = "Some error occure, Please try again!";
        }
        echo json_encode($response);
    }
    public function edit($id)
    {
        $data = array(
            'title' => 'Edit Subscription',
            'page' => 'subscription',
            'subpage' => 'sub'
        );
        $data['result'] = DB::table('sub_plan')->where(['id' => $id])->select('*')->first();
        $data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        $data['menus'] = DB::table('sub_access_menu')->where(['status' => 1])->select('*')->get();
        return view('admin.edit_sub', $data);
    }
    public function update(Request $request)
    {
        $name = $request->name;
        $description = $request->description;
        $plan = $request->plan;
        $duration = $request->duration;
        $type = $request->type;
        $status = $request->pckstatus;
        $id = $request->id;
        $user_type = $request->user_type;
        $menus = @$request->menus;
        $menuIds = array_column($menus, 'menu_id');
        $menuIds = implode(",", $menuIds);
        if ($request->plan == 1) {
            $amount = '0.00';
        } else {
            $amount = $request->amount;
        }
        if ($request->access) {
            $access = implode(',', $request->access);
        } else {
            $access = '';
        }
        $data = ['name' => $name, 'description' => $description, 'plan' => $plan, 'type' => $type, 'duration' => $duration, 'status' => $status, 'amount' => @$amount, 'user_type' => $user_type, 'access' => $access, 'updated_at' => date('Y-m-d H:i:s')];
        $result = DB::table('sub_plan')->where('id', @$id)->update($data);
        if ($result) {
            DB::table('sub_permision_menu')->where('sub_id', $id)->delete();
            if (@$menus) {
                foreach ($menus as $menu) {
                    $array = [
                        'sub_id' => $id,
                        'menu_id' => $menu['menu_id'],
                        'read_access' => $menu['has_read_access'],
                        'write_access' => $menu['has_write_access'],
                        'full_access' => $menu['has_full_access'],
                        'number_of' => $menu['number_count'],
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    DB::table('sub_permision_menu')->insertGetId($array);
                }
            }
            $response['status'] = 1;
            $response['message'] = "Subscription plan updated successfully!";
            //return redirect()->intended('admin/subscription')->with("status", "Subscription plan updated successfully!");
        } else {
            $response['status'] = 0;
            $response['message'] = "Some error occure, Please try again!";
            //return redirect()->intended('admin/subscription')->with("error", "Some error occure, Please try again!");
        }
        echo json_encode($response);
    }
    public function delete($id)
    {
        if (empty(@$id)) {
            return false;
        }
        $result = DB::table('sub_plan')->where('id', $id)->delete();
        if ($result) {
            //return back()->with("status", "User type added successfully!");
            return redirect()->intended('admin/subscription')->with("status", "Subscription plan deleted successfully!");
        } else {
            //return back()->with("error", "Some error occure, Please try again!");
            return redirect()->intended('admin/subscription')->with("error", "Some error occure, Please try again!");
        }
    }
    public function access_menu()
    {
        $data = array(
            'title' => 'Access Menu',
            'page' => 'subscription',
            'subpage' => 'access-menu'
        );
        $data['result'] = DB::table('sub_access_menu')->select('*')->get();
        return view('admin.sub_access_menu', $data);
    }
    public function add_access_menu()
    {
        $data = array(
            'title' => 'Add Access Menu',
            'page' => 'subscription',
            'subpage' => 'access-menu'
        );
        // $data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        // $data['menus']    = DB::table('sub_access_menu')->where(['status' => 1])->select('*')->get();
        return view('admin.add_sub_access_menu', $data);
    }
    public function saveMenu(Request $request)
    {
        $name = $request->name;
        $status = $request->pckstatus;
        $data = ['menu' => $name, 'status' => $status, 'created_at' => date('Y-m-d H:i:s')];
        $result = DB::table('sub_access_menu')->insertGetId($data);
        if ($result) {
            return redirect()->intended('admin/subscription/access-menu')->with("status", "Menu added successfully!");
        } else {
            return redirect()->intended('admin/subscription/access-menu')->with("error", "Some error occure, Please try again!");
        }
    }
    public function access_menu_edit($id)
    {
        $data = array(
            'title' => 'Edit Access Menu',
            'page' => 'subscription',
            'subpage' => 'access-menu'
        );
        $data['result'] = DB::table('sub_access_menu')->where(['id' => $id])->select('*')->first();
        return view('admin.edit_sub_access_menu', $data);
    }
    public function updateMenu(Request $request)
    {
        $name = $request->name;
        $status = $request->pckstatus;
        $id = $request->id;
        $data = ['menu' => $name, 'status' => $status, 'updated_at' => date('Y-m-d H:i:s')];
        $result = DB::table('sub_access_menu')->where('id', @$id)->update($data);
        //print_r($result);die;
        if ($result) {
            return redirect()->intended('admin/subscription/access-menu')->with("status", "Menu updated successfully!");
        } else {
            return redirect()->intended('admin/subscription/access-menu')->with("error", "Some error occure, Please try again!");
        }
    }
    public function delete_access_menu($id)
    {
        if (empty(@$id)) {
            return false;
        }
        $result = DB::table('sub_access_menu')->where('id', $id)->delete();
        if ($result) {
            //return back()->with("status", "User type added successfully!");
            return redirect()->intended('admin/subscription/access-menu')->with("status", "Menu deleted successfully!");
        } else {
            //return back()->with("error", "Some error occure, Please try again!");
            return redirect()->intended('admin/subscription/access-menu')->with("error", "Some error occure, Please try again!");
        }
    }
}