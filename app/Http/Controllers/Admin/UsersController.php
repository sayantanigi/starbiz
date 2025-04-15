<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Stripe;
class UsersController extends Controller
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
    public function index()
    {
        $data = array(
            'title' => 'Active Users Lists',
            'page' => 'active_users',
            'subpage' => 'active_users'
        );
        $data['result'] = DB::table('users')->where('status', 1)->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.users', $data);
    }
    public function inactive_users()
    {
        $data = array(
            'title' => 'Inactive Users Lists',
            'page' => 'inactive_users',
            'subpage' => 'inactive_users'
        );
        $data['result'] = DB::table('users')->where('status', 0)->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.inactive_users', $data);
    }
    public function add()
    {
        $data = array(
            'title' => 'Add Users',
            'page' => 'users',
            'subpage' => 'users'
        );
        $data['tags'] = DB::table('tags')->where(['status' => "1"])->select('*')->get();
        $data['interest'] = DB::table('interest')->where(['status' => "1"])->select('*')->get();
        $data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        return view('admin.add_user', $data);
    }
    public function save(Request $request)
    {
        $fname = $request->fname;
        $lname = $request->lname;
        $email = $request->email;
        $phone = $request->phone;
        $user_type = $request->user_type;
        $address = $request->address;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $zipcode = $request->pincode;
        $status = $request->status;
        $password = $request->password;
        $profile_bio = @$request->profile_bio;
        //$dob = @$request->dob;
        if (@$request->dob) {
            $dob = date('Y-m-d', strtotime(@$request->dob));
        } else {
            $dob = '';
        }
        if ($request->profileImg) {
            $profileImg = $request->profileImg;
        } else {
            $profileImg = '';
        }
        if (!empty(@$request->tags)) {
            $tags = implode(',', @$request->tags);
        } else {
            $tags = "";
        }
        if (!empty(@$request->area_interest)) {
            $area_interest = implode(',', @$request->area_interest);
        } else {
            $area_interest = "";
        }
        $data = ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone' => @$phone, 'address' => @$address, 'country' => @$country, 'state' => @$state, 'city' => @$city, 'latitude' => $latitude, 'longitude' => @$longitude, 'profile_image' => @$profileImg, 'zipcode' => @$zipcode, 'user_type' => @$user_type, 'password' => md5(@$password), 'status' => @$status, 'bio' => $profile_bio, 'area_interest' => $area_interest, 'tags' => $tags, 'dob' => $dob, 'created_at' => date('Y-m-d H:i:s')];
        $result = DB::table('users')->insertGetId($data);
        if ($result) {
            //return back()->with("status", "User type added successfully!");
            return redirect()->intended('admin/users')->with("status", "User added successfully!");
        } else {
            //return back()->with("error", "Some error occure, Please try again!");
            return redirect()->intended('admin/users')->with("error", "Some error occure, Please try again!");
        }
    }
    public function changestatus(Request $request)
    {
        if ($request->userId) {
            $userId = $request->userId;
            $status = $request->status;
            if ($status == 1) {
                $msg = 'Your status is Activate';
            } else {
                $msg = 'Your status is Inctivate';
            }
            $result = DB::table('users')->where('id', @$userId)->update(['status' => $status]);
            if ($result) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
    public function edit($id)
    {
        if (empty($id)) {
            return false;
        }
        $data = array(
            'title' => 'Edit Users',
            'page' => 'users',
            'subpage' => 'users'
        );
        $data['result'] = DB::table('users')->where(['id' => $id])->select('*')->first();
        $data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        $data['tags'] = DB::table('tags')->where(['status' => "1"])->select('*')->get();
        $data['interest'] = DB::table('interest')->where(['status' => "1"])->select('*')->get();
        return view('admin.edit_user', $data);
    }
    public function update(Request $request)
    {
        $fname = $request->fname;
        $lname = $request->lname;
        $email = $request->email;
        $phone = $request->phone;
        $user_type = $request->user_type;
        $address = $request->address;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $zipcode = $request->pincode;
        $status = $request->status;
        $id = $request->id;
        $profile_bio = @$request->profile_bio;
        if (@$request->dob) {
            $dob = date('Y-m-d', strtotime(@$request->dob));
        } else {
            $dob = '';
        }
        if ($request->profileImg) {
            $profileImg = $request->profileImg;
        } else {
            $profile_image = DB::table('users')->where(['id' => $id])->select('profile_image')->first();
            $profileImg = $profile_image->profile_image;
        }
        if (!empty(@$request->tags)) {
            $tags = implode(',', @$request->tags);
        } else {
            $tags = "";
        }
        if (!empty(@$request->area_interest)) {
            $area_interest = implode(',', @$request->area_interest);
        } else {
            $area_interest = "";
        }
        $data = ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone' => @$phone, 'address' => @$address, 'country' => @$country, 'state' => @$state, 'city' => @$city, 'latitude' => $latitude, 'longitude' => @$longitude, 'profile_image' => @$profileImg, 'zipcode' => @$zipcode, 'user_type' => @$user_type, 'status' => @$status, 'bio' => $profile_bio, 'area_interest' => $area_interest, 'tags' => $tags, 'dob' => $dob, 'updated_at' => date('Y-m-d H:i:s')];
        $result = DB::table('users')->where('id', $id)->update(@$data);
        if ($result) {
            return redirect()->intended('admin/users')->with("status", "User updated successfully!");
        } else {
            return redirect()->intended('admin/users')->with("error", "Some error occure, Please try again!");
        }
    }
    function delete_user($id)
    {

        if (empty(@$id)) {
            return false;
        }

        try {
            // Start transaction
            DB::beginTransaction();

            // Delete user-related data in other tables
            DB::table('academics')->where('user_id', $id)->delete();
            DB::table('advertise')->where('user_id', $id)->delete();
            DB::table('athletics')->where('user_id', $id)->delete();
            DB::table('chat')->where(function ($query) use ($id) {
                $query->where('sender_id', $id)->orWhere('receiver_id', $id);
            })->delete();
            DB::table('compose_email')->where('user_id', $id)->delete();
            DB::table('email_template')->where('user_id', $id)->delete();
            DB::table('experience')->where('user_id', $id)->delete();

            // Handle events
            $eventresults = DB::table('events')->where('user_id', $id)->get();
            foreach ($eventresults as $event) {
                DB::table('event_image')->where('event_id', $event->id)->delete();
                DB::table('event_ticket')->where('event_id', $event->id)->delete();
                DB::table('favouriteevent')->where('event_id', $event->id)->delete();
                DB::table('invitation')->where('event_id', $event->id)->delete();
                DB::table('notifications')->where('event_id', $event->id)->delete();
                DB::table('transaction')->where('event_id', $event->id)->delete();
            }
            DB::table('events')->where('user_id', $id)->delete();

            // Delete related data for the user
            DB::table('guardian')->where('user_id', $id)->delete();
            DB::table('favouritebusiness')->where('user_id', $id)->delete();
            DB::table('favouriteusers')->where('user_id', $id)->delete();


            $listingresults = DB::table('listing')->where('user_id', $id)->get();
            foreach ($listingresults as $listing) {
                // Delete related images for the listing
                DB::table('listing_image')->where('listing_id', $listing->id)->delete();

                // Delete related products
                $listingproductresults = DB::table('product')->where('listing_id', $listing->id)->get();
                foreach ($listingproductresults as $product) {
                    // Delete related product images
                    DB::table('product_image')->where('product_id', $product->id)->delete();
                }
                DB::table('product')->where('listing_id', $listing->id)->delete();

                // Delete related services and their images
                $listingservicesresults = DB::table('services')->where('listing_id', $listing->id)->get();
                foreach ($listingservicesresults as $service) {
                    DB::table('services_image')->where('service_id', $service->id)->delete();
                }
                DB::table('services')->where('listing_id', $listing->id)->delete();
            }

            DB::table('listing')->where('user_id', $id)->delete();


            // Other related data deletion
            DB::table('promotion')->where('user_id', $id)->delete();
            DB::table('reference')->where('user_id', $id)->delete();
            // // DB::table('referral_rewards_transaction')->where('user_id', $id)->delete();
            DB::table('reffer')->where('sender_id', $id)->delete();
            DB::table('stripe_connect')->where('userId', $id)->delete();
            DB::table('user_document')->where('user_id', $id)->delete();
            DB::table('user_gallery_photo')->where('user_id', $id)->delete();
            DB::table('wallet')->where('user_id', $id)->delete();
            DB::table('withdraw_request')->where('user_id', $id)->delete();

            // // Finally delete the user
            DB::table('users')->where('id', $id)->delete();

            // Commit transaction
            DB::commit();

            // Return success message
            return redirect()->intended('admin/users')->with("status", "User deleted successfully!");
        } catch (\Exception $e) {
            // Rollback transaction in case of an error
            DB::rollBack();

            // Return error message
            return redirect()->intended('admin/users')->with("error", "An error occurred, Please try again!");
        }





        // $result = DB::table('users')->where('id', $id)->delete();
        // if ($result) {
        //     return redirect()->intended('admin/users')->with("status", "User deleted successfully!");
        // } else {
        //     return redirect()->intended('admin/users')->with("error", "Some error occure, Please try again!");
        // }
    }



    function getUnreadCount($admin_id)
    {
        $unreadCount = DB::table('notifications')
            ->where('receiver_id', $admin_id)
            ->where('status', '1')
            ->where('noti_type','admin')
            ->count();

        // Return the unread count as a JSON response
        return response()->json(['unread_count' => $unreadCount]);
    }















    function edit_profile($id)
    {
        if (empty($id)) {
            return false;
        }
        $data = array(
            'title' => 'Edit Profile',
            'page' => 'users',
            'subpage' => 'users'
        );
        // $data['result'] = DB::table('users')->where(['id' => $id])->select('*')->first();
        // $data['userType'] = DB::table('user_type')->where(['status' => 1])->select('*')->get();
        $data['profile'] = DB::table('users')->where(['id' => $id])->select('*')->first();
        $data['academics'] = DB::table('academics')->where(['user_id' => $id])->select('*')->get();
        $data['athletics'] = DB::table('athletics')->where(['user_id' => $id])->select('*')->first();
        $data['exprience'] = DB::table('experience')->where(['user_id' => $id])->select('*')->get();
        $data['reference'] = DB::table('reference')->where(['user_id' => $id])->select('*')->get();
        $data['guardian'] = DB::table('guardian')->where(['user_id' => $id])->select('*')->get();
        $data['tags'] = DB::table('tags')->where(['status' => "1"])->select('*')->get();
        $data['interest'] = DB::table('interest')->where(['status' => "1"])->select('*')->get();
        //print_r($data['academics']);die;
        return view('admin.athletic', $data);
    }
    function updateProfile(Request $request)
    {
        $row = DB::table('users')->where(['id' => @$request->userId])->select('*')->first();
        $fname = !empty(@$request->fname) ? @$request->fname : $row->first_name;
        $lname = !empty(@$request->lname) ? @$request->lname : $row->last_name;
        $email = !empty(@$request->email) ? @$request->email : $row->email;
        $phone = !empty(@$request->phone) ? @$request->phone : $row->phone;
        $address = !empty(@$request->address) ? @$request->address : $row->address;
        $country = !empty(@$request->country) ? @$request->country : $row->country;
        $state = !empty(@$request->state) ? @$request->state : $row->state;
        $city = !empty(@$request->city) ? @$request->city : $row->city;
        $pincode = !empty(@$request->pincode) ? @$request->pincode : $row->zipcode;
        $profile_bio = !empty(@$request->profile_bio) ? @$request->profile_bio : $row->bio;
        //$area_interest = !empty(@$request->area_interest) ? @$request->area_interest : $row->area_interest;
        $latitude = !empty(@$request->latitude) ? @$request->latitude : $row->latitude;
        $longitude = !empty(@$request->longitude) ? @$request->longitude : $row->longitude;
        $userId = @$request->userId;
        if (!empty(@$request->tags)) {
            $tags = implode(',', @$request->tags);
        } else {
            $tags = "";
        }
        if (!empty(@$request->area_interest)) {
            $area_interest = implode(',', @$request->area_interest);
        } else {
            $area_interest = "";
        }
        $data = ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone' => @$phone, 'address' => @$address, 'country' => @$country, 'state' => @$state, 'city' => @$city, 'latitude' => $latitude, 'longitude' => @$longitude, 'zipcode' => @$pincode, 'bio' => $profile_bio, 'area_interest' => $area_interest, 'tags' => $tags, 'updated_at' => date('Y-m-d H:i:s')];
        $result = DB::table('users')->where('id', $userId)->update(@$data);
        if (!empty($request->college)) {
            DB::table('academics')->where('user_id', $userId)->delete();
            $i = 0;
            foreach ($request->college as $k => $v) {
                $academics = [
                    'school_name' => @$v,
                    'course_name' => @$request->course[$i],
                    'rank' => @$request->rank[$i],
                    'graduation_year' => @$request->graduation_year[$i],
                    'gpa' => @$request->gpa[$i],
                    'act_score' => @$request->act_score[$i],
                    'user_id' => @$request->userId,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('academics')->insertGetId($academics);
                $i++;
            }
        }
        $athletic_row = DB::table('athletics')->where(['user_id' => @$request->userId])->select('*')->first();
        $feet = !empty(@$request->feet) ? trim(@$request->feet, "'") : $athletic_row->feet;
        $inches = !empty(@$request->inches) ? trim(@$request->inches, '"') : $athletic_row->inches;
        $weight = !empty(@$request->weight) ? @$request->weight : $athletic_row->weight;
        $strength = !empty(@$request->strength) ? @$request->strength : $athletic_row->strength;
        if (!empty($athletic_row)) {
            $athletic_data = [
                'feet' => $feet,
                'inches' => $inches,
                'weight' => $weight,
                'strength' => $strength,
                'user_id' => $userId,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table('athletics')->where('id', $athletic_row->id)->update(@$athletic_data);
        } else {
            $athletic_data = [
                'feet' => $feet,
                'inches' => $inches,
                'weight' => $weight,
                'strength' => $strength,
                'user_id' => $userId,
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('athletics')->insertGetId($athletic_data);
        }
        if (!empty($request->club_name)) {
            DB::table('experience')->where('user_id', $userId)->delete();
            $i = 0;
            foreach ($request->club_name as $k => $v) {
                $experience = [
                    'club_name' => @$v,
                    'designation' => @$request->club_designation[$i],
                    'start_date' => date('Y-m-d', strtotime(@$request->start_date[$i])),
                    'end_date' => date('Y-m-d', strtotime(@$request->end_date[$i])),
                    'information' => @$request->information[$i],
                    'user_id' => @$request->userId,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('experience')->insertGetId($experience);
                $i++;
            }
        }
        if (!empty($request->coach_name)) {
            DB::table('reference')->where('user_id', $userId)->delete();
            $i = 0;
            foreach ($request->coach_name as $k => $v) {
                $experience = [
                    'coach_name' => @$v,
                    'coach_email' => @$request->coach_email[$i],
                    'user_id' => @$request->userId,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('reference')->insertGetId($experience);
                $i++;
            }
        }
        if (!empty($request->guardian_name)) {
            DB::table('guardian')->where('user_id', $userId)->delete();
            $i = 0;
            foreach ($request->guardian_name as $k => $v) {
                $experience = [
                    'guardian_name' => @$v,
                    'guardian_email' => @$request->guardian_email[$i],
                    'guardian_phone' => @$request->guardian_phone[$i],
                    'guardian_relation' => @$request->guardian_relation[$i],
                    'user_id' => @$request->userId,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                DB::table('guardian')->insertGetId($experience);
                $i++;
            }
        }
        $response['status'] = 1;
        $response['message'] = 'Profile updated successfully.';
        echo json_encode($response);
    }
    function delete_academic(Request $request)
    {
        $academicId = $request->academic;
        $userId = @$request->userId;
        $result = DB::table('academics')->where('id', $academicId)->delete();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
    function delete_experience(Request $request)
    {
        $experienceId = $request->experience;
        $userId = @$request->userId;
        $result = DB::table('experience')->where('id', $experienceId)->delete();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
    function delete_reference(Request $request)
    {
        $referenceId = $request->reference;
        $userId = @$request->userId;
        $result = DB::table('reference')->where('id', $referenceId)->delete();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
    function delete_guardian(Request $request)
    {
        $guardianId = $request->guardian;
        $userId = @$request->userId;
        $result = DB::table('guardian')->where('id', $guardianId)->delete();
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
    function view($id)
    {
        $data = array(
            'title' => 'View User Information',
            'page' => 'users',
            'subpage' => 'users'
        );
        $data['result'] = DB::table('users')->where(['id' => $id])->select('*')->first();
        return view('admin.view_user', $data);
    }
    public function type()
    {
        $data = array(
            'title' => 'Users Type',
            'page' => 'users',
            'subpage' => 'user-type'
        );
        $data['result'] = DB::table('user_type')->select('*')->get();
        return view('admin.user_type', $data);
    }
    public function addusertype()
    {
        $data = array(
            'title' => 'Add User Type',
            'page' => 'users',
            'subpage' => 'user-type'
        );
        return view('admin.add_user_type', $data);
    }
    public function save_user_type(Request $request)
    {
        $user_type = $request->name;
        $status = $request->status;
        $data = ['name' => $user_type, 'status' => $status, 'created_at' => date('Y-m-d H:i:s')];
        $result = DB::table('user_type')->insertGetId($data);
        if ($result) {
            //return back()->with("status", "User type added successfully!");
            return redirect()->intended('admin/user-type')->with("status", "User type added successfully!");
        } else {
            //return back()->with("error", "Some error occure, Please try again!");
            return redirect()->intended('admin/user-type')->with("error", "Some error occure, Please try again!");
        }
    }
    public function editusertype($id)
    {
        if (empty(@$id)) {
            return false;
        }
        $data = array(
            'title' => 'Edit User Type',
            'page' => 'users',
            'subpage' => 'user-type'
        );
        $data['result'] = DB::table('user_type')->where(['id' => $id])->select('*')->first();
        return view('admin.edit_user_type', $data);
    }
    public function update_user_type(Request $request)
    {
        $user_type = $request->name;
        $status = $request->status;
        $id = $request->id;
        $data = ['name' => $user_type, 'status' => $status, 'updated_at' => date('Y-m-d H:i:s')];
        $result = DB::table('user_type')->where('id', @$id)->update($data);
        if ($result) {
            //return back()->with("status", "User type added successfully!");
            return redirect()->intended('admin/user-type')->with("status", "User type updated successfully!");
        } else {
            //return back()->with("error", "Some error occure, Please try again!");
            return redirect()->intended('admin/user-type')->with("error", "Some error occure, Please try again!");
        }
    }
    public function delete_user_type($id)
    {
        if (empty(@$id)) {
            return false;
        }
        $result = DB::table('user_type')->where('id', $id)->delete();
        if ($result) {
            //return back()->with("status", "User type added successfully!");
            return redirect()->intended('admin/user-type')->with("status", "User type deleted successfully!");
        } else {
            //return back()->with("error", "Some error occure, Please try again!");
            return redirect()->intended('admin/user-type')->with("error", "Some error occure, Please try again!");
        }
    }
    public function saveprofile(Request $request)
    {
        if ($request['profilePic']) {
            $img = $request['profilePic'];
            $extn = $img->getClientOriginalExtension();
            $path = public_path('setting/');
            $file_name = rand() . '.' . $extn;
            $img->move($path, $file_name);
        } else {
            $where = ['id' => session()->get('ADMINLOGINID')];
            $getData = DB::table('admin')->where($where)->select('profile')->first();
            $file_name = $getData->profile;
        }
        $name = $request->username;
        $email = $request->email;
        $data = ['name' => $name, 'email' => $email, 'profile' => $file_name, 'updated_at' => date('Y-m-d H:i:s')];
        $result = DB::table('admin')->where('id', session()->get('ADMINLOGINID'))->update(@$data);
        if ($result) {
            //return redirect()->intended('admin/profile')->withSuccess('update successfully.');
            return back()->with("status1", "update successfully!");
        } else {
            return back()->with("error1", "Some error occure, Please try again.!");
        }
    }
    public function changepassword(Request $request)
    {
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
    function cropImage()
    {
        $data = $_POST['image'];
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $imageName = time() . '.png';
        $image_name = 'public/profile/' . $imageName;
        file_put_contents($image_name, $data);
        echo $imageName;
    }
    public function subscription($id)
    {
        if (empty(@$id)) {
            return false;
        }
        $data = array(
            'title' => 'Users Subscription',
            'page' => 'users',
            'subpage' => 'users'
        );
        $data['userId'] = $id;
        $user_type = DB::table('users')->where(['id' => $id])->select('user_type')->orderBy('id', 'DESC')->first();
        $data['result'] = DB::table('sub_plan')->where(['user_type' => $user_type->user_type])->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.package', $data);
    }
    public function payment()
    {
        $data = array(
            'title' => 'Payment',
            'page' => 'users',
            'subpage' => 'users'
        );
        $data['userId'] = @$userId = @$_GET['uid'];
        $data['subId'] = @$subId = @$_GET['sid'];
        $data['subInfo'] = DB::table('sub_plan')->where(['id' => $subId])->select('*')->orderBy('id', 'DESC')->first();
        $data['userInfo'] = DB::table('users')->where(['id' => $userId])->select('*')->orderBy('id', 'DESC')->first();
        return view('admin.payment', $data);
    }
    function submit_payment(Request $request)
    {
        require "vendor/stripe/stripe-php/init.php";
        //print_r($request->input('stripeToken'));
        $token = $request->stripeToken;
        $sub_id = $_POST['sub_id'];
        $sub_name = $_POST['sub_name'];
        $user_id = $_POST['user_id'];
        $amount = $_POST['amount'];
        $address = $_POST['card_address'];
        $country = $_POST['card_country'];
        $state = $_POST['card_state'];
        $city = $_POST['card_city'];
        $zipcode = $_POST['card_zipcode'];
        $card_name = $_POST['card_name'];
        $email = $_POST['email'];
        $itemPrice = $amount;
        $currency = 'usd';
        $stripe = array(
            "secret_key" => "sk_test_51MPhgSIuZrwn6gWgucZ3pq3OGKnLaQMxviXsKtZb4F7tenDBs25KovJkAB4tii3db6CMW1tdWSk2CB9thQ8yOYdX00iUs05KRN",
            "publishable_key" => "pk_test_51MPhgSIuZrwn6gWggTu5pxq41l6ZODzSg2zZ1kjKynv3yR61OZDey3AcNm2iwioDVJqSuJ3TCXJCdOAJn1VaNfyk00QkWY7DPT"
        );
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        try {
            $customer = \Stripe\Customer::create(array(
                'email' => $email,
                'source' => $token
            ));
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }
        if (empty($api_error) && $customer) {
            $itemName = @$sub_name;
            $orderID = "ORDNO-" . $this->generate_otp(6);
            $itemPriceCents = ($itemPrice * 100);
            try {
                $charge = \Stripe\Charge::create(array(
                    'customer' => $customer->id,
                    'amount' => $itemPriceCents,
                    'currency' => 'usd',
                    'description' => $itemName,
                    'metadata' => array(
                        'order_id' => $orderID
                    )
                ));
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }
            if (empty($api_error) && $charge) {
                $chargeJson = $charge->jsonSerialize();
                if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
                    $transactionID = $chargeJson['balance_transaction'];
                    $paidAmount = $chargeJson['amount'];
                    $paidAmount = ($paidAmount / 100);
                    $paidCurrency = $chargeJson['currency'];
                    $payment_status = $chargeJson['status'];
                    $chargeID = $chargeJson['id'];
                    $paymentDate = date('Y-m-d H:i:s');
                    if ($payment_status == 'succeeded') {
                        $sub_info = DB::table('sub_plan')->where(['id' => @$sub_id])->select('*')->orderBy('id', 'DESC')->first();
                        if ($sub_info->type == 1) {
                            $current_period_start = date('Y-m-d');
                            $current_period_end = date('Y-m-d', strtotime($current_period_start . ' + ' . @$sub_info->duration . ' month'));
                        } else {
                            $current_period_start = date('Y-m-d');
                            $current_period_end = date('Y-m-d', strtotime($current_period_start . ' + ' . @$sub_info->duration . ' year'));
                        }
                        $data = ['user_name' => $card_name, 'user_id' => $user_id, 'address' => $address, 'country' => $country, 'state' => @$state, 'city' => @$city, 'zipcode' => $zipcode, 'sub_id' => @$sub_id, 'amount' => @$itemPrice, 'currency' => @$currency, 'txn_id' => $transactionID, 'charge_id' => $chargeID, 'status' => $payment_status, 'expiry_date' => $current_period_end, 'created_at' => $paymentDate, 'order_id' => $orderID, 'payment_type' => '1'];
                        $result = DB::table('transaction')->insertGetId($data);
                        return redirect()->intended('admin/users')->with("status", "Your Payment has been Successful!");
                    } else {
                        return redirect()->intended('admin/users')->with("error", "Your Payment has Failed. Some error occure, Please try again!");
                    }
                } else {
                    return redirect()->intended('admin/users')->with("error", "Your Payment has Failed. Some error occure, Please try again!");
                }
            } else {
                return redirect()->intended('admin/users')->with("error", "Charge creation failed! $api_error");
            }
        } else {
            return redirect()->intended('admin/users')->with("error", "Invalid card details! $api_error");
        }
    }
    public function generate_otp($length)
    {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function contact_admin()
    {
        $data = array('title' => 'Contact Admin', 'page' => '', 'subpage' => '');
        $data['result'] = DB::table('contact_admin')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.contact_admin', $data);
    }
    public function reffer()
    {
        $data = array('title' => 'referral Code', 'page' => '', 'subpage' => '');
        $data['result'] = DB::table('reffer')->select('*')->orderBy('id', 'DESC')->get();
        return view('admin.reffer_code', $data);
    }
}