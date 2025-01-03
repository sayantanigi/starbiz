<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {

        return redirect('/admin');
    
    });


Route::get('/admin','App\Http\Controllers\Admin\LoginController@index');
Route::get('/admin/dashboard','App\Http\Controllers\Admin\DashboardController@index');
Route::post('/admin/logincontroller/submitLogin','App\Http\Controllers\Admin\LoginController@submitLogin');

//admin profile
Route::get('/admin/profile','App\Http\Controllers\Admin\ProfileController@index');
Route::post('/admin/profilecontroller/saveprofile','App\Http\Controllers\Admin\ProfileController@saveprofile');
Route::post('/admin/profilecontroller/changepassword','App\Http\Controllers\Admin\ProfileController@changepassword');

//admin setting
Route::get('/admin/site-setting','App\Http\Controllers\Admin\SettingController@index');
Route::post('/admin/setting/savesite-setting','App\Http\Controllers\Admin\SettingController@savesite_setting');
Route::get('/admin/logo-setting','App\Http\Controllers\Admin\SettingController@logo_setting');
Route::post('/admin/setting/savelogo-setting','App\Http\Controllers\Admin\SettingController@savelogo_setting');

//logout
Route::get('/admin/logout','App\Http\Controllers\Admin\LoginController@logout');


//admin user
Route::get('/admin/user-type','App\Http\Controllers\Admin\UsersController@type');
Route::get('/admin/add-user-type','App\Http\Controllers\Admin\UsersController@addusertype');
Route::post('/admin/save-user-type','App\Http\Controllers\Admin\UsersController@save_user_type');
Route::get('/admin/edit-user-type/{id}','App\Http\Controllers\Admin\UsersController@editusertype');
Route::post('/admin/update-user-type','App\Http\Controllers\Admin\UsersController@update_user_type');
Route::get('/admin/delete-user-type/{id}','App\Http\Controllers\Admin\UsersController@delete_user_type');

//admin subscription
Route::get('/admin/subscription','App\Http\Controllers\Admin\SubscriptionController@index');
Route::get('/admin/subscription/add','App\Http\Controllers\Admin\SubscriptionController@add');
Route::post('/admin/subscription/save','App\Http\Controllers\Admin\SubscriptionController@save');
Route::get('/admin/subscription/edit/{id}','App\Http\Controllers\Admin\SubscriptionController@edit');
Route::post('/admin/subscription/update','App\Http\Controllers\Admin\SubscriptionController@update');
Route::get('/admin/subscription/delete/{id}','App\Http\Controllers\Admin\SubscriptionController@delete');

//admin users
Route::get('/admin/users','App\Http\Controllers\Admin\UsersController@index');
Route::get('/admin/users/add','App\Http\Controllers\Admin\UsersController@add');
Route::post('/admin/users/cropImage','App\Http\Controllers\Admin\UsersController@cropImage');
Route::post('/admin/users/save','App\Http\Controllers\Admin\UsersController@save');
Route::post('/admin/users/changestatus','App\Http\Controllers\Admin\UsersController@changestatus');
Route::get('/admin/users/edit/{id}','App\Http\Controllers\Admin\UsersController@edit');
Route::post('/admin/users/update','App\Http\Controllers\Admin\UsersController@update');
Route::get('/admin/users/delete-user/{id}','App\Http\Controllers\Admin\UsersController@delete_user');
Route::get('/admin/users/edit-profile/{id}','App\Http\Controllers\Admin\UsersController@edit_profile');
Route::post('/admin/users/updateProfile','App\Http\Controllers\Admin\UsersController@updateProfile');
Route::post('/admin/users/delete-academic','App\Http\Controllers\Admin\UsersController@delete_academic');
Route::post('/admin/users/delete-experience','App\Http\Controllers\Admin\UsersController@delete_experience');
Route::post('/admin/users/delete-reference','App\Http\Controllers\Admin\UsersController@delete_reference');
Route::post('/admin/users/delete-guardian','App\Http\Controllers\Admin\UsersController@delete_guardian');
