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

// Route::get('/', function () {
    // return view('welcome');
// });

Route::get('/', function () {
	return redirect('/login');
});

Route::get('/login','App\Http\Controllers\LoginController@index');
Route::get('/logout','App\Http\Controllers\LoginController@logout');
Route::post('/submitLogin','App\Http\Controllers\LoginController@submitLogin');
Route::get('/register','App\Http\Controllers\RegisterController@index');
Route::post('/saveRegister','App\Http\Controllers\RegisterController@saveRegister');
Route::get('/document','App\Http\Controllers\DocumentController@index');
Route::post('/saveDocument','App\Http\Controllers\DocumentController@saveDocument');
Route::get('/dashboard','App\Http\Controllers\DashboardController@index');
Route::get('/forgetpassword','App\Http\Controllers\ForgetpasswordController@index');
Route::post('/SentOTP','App\Http\Controllers\ForgetpasswordController@SentOTP');
Route::post('/submitOTP','App\Http\Controllers\ForgetpasswordController@submitOTP');
Route::get('/resetpassword','App\Http\Controllers\ForgetpasswordController@reset_password');
Route::post('/savePassword','App\Http\Controllers\ForgetpasswordController@savePassword');
Route::post('/dashboard/addEvent','App\Http\Controllers\DashboardController@addEvent');
Route::post('/dashboard/updateEvent','App\Http\Controllers\DashboardController@updateEvent');
Route::post('/dashboard/saveAds','App\Http\Controllers\DashboardController@saveAds');
Route::post('/dashboard/updateAds','App\Http\Controllers\DashboardController@updateAds');
Route::post('/dashboard/get_promotion_detail','App\Http\Controllers\DashboardController@get_promotion_detail');
Route::post('/dashboard/get_promotion_edit_detail','App\Http\Controllers\DashboardController@get_promotion_edit_detail');
Route::post('/dashboard/get_event_detail','App\Http\Controllers\DashboardController@get_event_detail');
Route::post('/dashboard/get_event_image_gallery','App\Http\Controllers\DashboardController@get_event_image_gallery');
Route::post('/dashboard/get_payment_list','App\Http\Controllers\DashboardController@get_payment_list');

Route::get('/dashboard/delete-promotion/{id}','App\Http\Controllers\DashboardController@delete_promotion');
Route::get('/dashboard/delete-event/{id}','App\Http\Controllers\DashboardController@delete_event');
Route::post('/dashboard/get_event_edit_detail','App\Http\Controllers\DashboardController@get_event_edit_detail');
Route::post('/dashboard/addRemoveBookmarkEvent','App\Http\Controllers\DashboardController@addRemoveBookmarkEvent');
Route::post('/dashboard/addRemoveBookmarkBusiness','App\Http\Controllers\DashboardController@addRemoveBookmarkBusiness');
Route::post('/dashboard/get_business_detail','App\Http\Controllers\DashboardController@get_business_detail');
Route::post('/dashboard/get_business_image_gallery','App\Http\Controllers\DashboardController@get_business_image_gallery');
Route::post('/dashboard/addBusiness','App\Http\Controllers\DashboardController@addBusiness');
Route::post('/dashboard/get_business_edit_detail','App\Http\Controllers\DashboardController@get_business_edit_detail');
Route::post('/dashboard/updateBusiness','App\Http\Controllers\DashboardController@updateBusiness');
Route::get('/dashboard/delete-business/{id}','App\Http\Controllers\DashboardController@delete_business');
Route::post('/dashboard/addProductCat','App\Http\Controllers\DashboardController@addProductCat');
Route::post('/dashboard/get_product_category','App\Http\Controllers\DashboardController@get_product_category');
Route::post('/dashboard/addProduct','App\Http\Controllers\DashboardController@addProduct');
Route::post('/dashboard/addService','App\Http\Controllers\DashboardController@addService');
Route::post('/dashboard/sendInvitation','App\Http\Controllers\DashboardController@sendInvitation');
Route::post('/dashboard/sendCounterInvitation','App\Http\Controllers\DashboardController@sendCounterInvitation');
Route::post('/dashboard/get_counter_offer','App\Http\Controllers\DashboardController@get_counter_offer');
Route::post('/dashboard/accept_invitation','App\Http\Controllers\DashboardController@accept_invitation');
Route::post('/dashboard/reject_invitation','App\Http\Controllers\DashboardController@reject_invitation');
Route::get('/dashboard/adspayment','App\Http\Controllers\DashboardController@promotion_payment');
Route::post('/dashboard/submitAdspayment','App\Http\Controllers\DashboardController@submit_promotion_payment');
Route::post('/dashboard/get_product_details','App\Http\Controllers\DashboardController@get_product_details');
Route::post('/dashboard/get_product_image_gallery','App\Http\Controllers\DashboardController@get_product_image_gallery');
Route::post('/dashboard/get_service_details','App\Http\Controllers\DashboardController@get_service_details');
Route::post('/dashboard/get_service_image_gallery','App\Http\Controllers\DashboardController@get_service_image_gallery');
Route::post('/dashboard/add_to_cart','App\Http\Controllers\DashboardController@add_to_cart');
Route::get('/dashboard/addtoCart','App\Http\Controllers\DashboardController@addtoCart');
Route::post('/dashboard/change','App\Http\Controllers\DashboardController@change');
Route::post('/dashboard/remove_product','App\Http\Controllers\DashboardController@remove_product');
Route::get('/dashboard/network','App\Http\Controllers\DashboardController@network');
Route::post('/dashboard/addRemoveBookmarkUsers','App\Http\Controllers\DashboardController@addRemoveBookmarkUsers');
Route::post('/dashboard/get_user_profileInfo','App\Http\Controllers\DashboardController@get_user_profileInfo');
Route::get('/dashboard/stripeconnect','App\Http\Controllers\DashboardController@stripeConnect');
Route::get('/dashboard/stripeReturn','App\Http\Controllers\DashboardController@stripeReturn');
Route::get('/dashboard/stripe-connect','App\Http\Controllers\DashboardController@stripe_connect');
Route::get('/dashboard/profile','App\Http\Controllers\DashboardController@profile');
Route::get('/dashboard/upcoming-event','App\Http\Controllers\DashboardController@upcomingEvent');
Route::get('/dashboard/refferalLink','App\Http\Controllers\DashboardController@refferalLink');
Route::post('/dashboard/get_profile_info','App\Http\Controllers\DashboardController@get_profile_info');
Route::post('/dashboard/updateProdule','App\Http\Controllers\DashboardController@updateProdule');
Route::post('/dashboard/updatePassword','App\Http\Controllers\DashboardController@updatePassword');
Route::post('/dashboard/updateProfile','App\Http\Controllers\DashboardController@updateProfile');
Route::get('/dashboard/productPayment','App\Http\Controllers\DashboardController@productPayment');
Route::post('/dashboard/product_stripe_payment','App\Http\Controllers\DashboardController@product_stripe_payment');
Route::get('/dashboard/wallet','App\Http\Controllers\DashboardController@wallet');
Route::get('/dashboard/transaction','App\Http\Controllers\DashboardController@transaction');
Route::get('/dashboard/reward','App\Http\Controllers\DashboardController@reward');
Route::get('/dashboard/term-and-condition','App\Http\Controllers\DashboardController@term');
Route::get('/dashboard/cancelSubscription','App\Http\Controllers\DashboardController@cancelSubscription');
Route::post('/dashboard/saveAdvs','App\Http\Controllers\DashboardController@saveAdvs');
Route::get('/dashboard/advertisement','App\Http\Controllers\AdvertisementController@index');
Route::post('/dashboard/submitAdvertisepayment','App\Http\Controllers\AdvertisementController@submit_advertisement_payment');
Route::get('/dashboard/network-details/{id}','App\Http\Controllers\DashboardController@network_details');
Route::get('/dashboard/get_stripe_info_test','App\Http\Controllers\DashboardController@get_stripe_info_test');
Route::get('/dashboard/topup-payment-page','App\Http\Controllers\DashboardController@topupPaymentpage');
Route::post('/dashboard/topup-stripe-payment','App\Http\Controllers\DashboardController@topup_stripe_payment');
Route::post('/dashboard/withdrawAmount','App\Http\Controllers\DashboardController@withdrawAmount');
Route::get('/dashboard/purchase-history','App\Http\Controllers\DashboardController@purchase_history');
Route::get('/dashboard/load_network_data','App\Http\Controllers\DashboardController@load_network_data');
Route::get('/dashboard/sale-list','App\Http\Controllers\DashboardController@saleList');
Route::post('/dashboard/referInvite','App\Http\Controllers\DashboardController@referInvite');
Route::get('/dashboard/load_allbusiness_data','App\Http\Controllers\DashboardController@load_allbusiness_data');
Route::post('/dashboard/get_invitee_user_model','App\Http\Controllers\DashboardController@get_invitee_user_model');
Route::post('/dashboard/get_user_photo','App\Http\Controllers\DashboardController@get_user_photo');
Route::post('/dashboard/editService','App\Http\Controllers\DashboardController@editService');
Route::post('/dashboard/get_service_edit_detail','App\Http\Controllers\DashboardController@get_service_edit_detail');
Route::post('/dashboard/editProduct','App\Http\Controllers\DashboardController@editProduct');
Route::post('/dashboard/get_product_edit_detail','App\Http\Controllers\DashboardController@get_product_edit_detail');
Route::post('/dashboard/delete_product','App\Http\Controllers\DashboardController@delete_product');
Route::post('/dashboard/delete_service','App\Http\Controllers\DashboardController@delete_service');
Route::post('/dashboard/searchInvitePeople','App\Http\Controllers\DashboardController@searchInvitePeople');
Route::post('/dashboard/autoSuggestion','App\Http\Controllers\DashboardController@autoSuggestion');
Route::get('/dashboard/search','App\Http\Controllers\DashboardController@search');
Route::get('/dashboard/downloadCsvAll','App\Http\Controllers\DashboardController@downloadCsvAll');
Route::get('/dashboard/downloadCsvWallet','App\Http\Controllers\DashboardController@downloadCsvWallet');
Route::post('/dashboard/resent_referral','App\Http\Controllers\DashboardController@resent_referral');
Route::get('/dashboard/downloadCsvReferral','App\Http\Controllers\DashboardController@downloadCsvReferral');
Route::get('/dashboard/deleteAccount','App\Http\Controllers\DashboardController@deleteAccount');


Route::get('/subscription/plan','App\Http\Controllers\SubscriptionController@index');
Route::get('/subscription/payment','App\Http\Controllers\SubscriptionController@payment');
Route::post('/subscription/sub-payment','App\Http\Controllers\SubscriptionController@sub_payment');

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
Route::get('/admin/subscription/access-menu/','App\Http\Controllers\Admin\SubscriptionController@access_menu');
Route::get('/admin/subscription/add-access-menu/','App\Http\Controllers\Admin\SubscriptionController@add_access_menu');
Route::post('/admin/subscription/saveMenu/','App\Http\Controllers\Admin\SubscriptionController@saveMenu');
Route::get('/admin/subscription/access-menu-edit/{id}','App\Http\Controllers\Admin\SubscriptionController@access_menu_edit');
Route::post('/admin/subscription/updateMenu/','App\Http\Controllers\Admin\SubscriptionController@updateMenu');
Route::get('/admin/subscription/delete-access-menu/{id}','App\Http\Controllers\Admin\SubscriptionController@delete_access_menu');
Route::get('/admin/subscription/testPlan','App\Http\Controllers\Admin\SubscriptionController@testPlan');
//admin users
Route::get('/admin/users','App\Http\Controllers\Admin\UsersController@index');
Route::get('/admin/inactive-users','App\Http\Controllers\Admin\UsersController@inactive_users');
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
Route::get('/admin/users/subscription/{id}','App\Http\Controllers\Admin\UsersController@subscription');
Route::get('/admin/users/payment','App\Http\Controllers\Admin\UsersController@payment');

Route::post('/admin/users/submit-payment','App\Http\Controllers\Admin\UsersController@submit_payment');
Route::get('/admin/users/view/{id}','App\Http\Controllers\Admin\UsersController@view');

// admin event
Route::get('/admin/event','App\Http\Controllers\Admin\EventController@index');
Route::get('/admin/event/add','App\Http\Controllers\Admin\EventController@add');
Route::post('/admin/event/save','App\Http\Controllers\Admin\EventController@save');
Route::post('/admin/event/saveTicket','App\Http\Controllers\Admin\EventController@saveTicket');
Route::post('/admin/event/saveLocation','App\Http\Controllers\Admin\EventController@saveLocation');
Route::post('/admin/event/saveEventImage','App\Http\Controllers\Admin\EventController@saveEventImage');

Route::get('/admin/event/edit/{id}','App\Http\Controllers\Admin\EventController@edit');
Route::post('/admin/event/update','App\Http\Controllers\Admin\EventController@update');
Route::post('/admin/event/updateTicket','App\Http\Controllers\Admin\EventController@updateTicket');
Route::post('/admin/event/updateLocation','App\Http\Controllers\Admin\EventController@updateLocation');
Route::post('/admin/event/updateEventImage','App\Http\Controllers\Admin\EventController@updateEventImage');
Route::post('/admin/event/deleteGallery','App\Http\Controllers\Admin\EventController@deleteGallery');
Route::get('/admin/event/delete-event/{id}','App\Http\Controllers\Admin\EventController@delete_event');

Route::get('/admin/event/category','App\Http\Controllers\Admin\EventController@event_category');
Route::get('/admin/event/add-category','App\Http\Controllers\Admin\EventController@add_category');
Route::post('/admin/event/save-category','App\Http\Controllers\Admin\EventController@save_category');
Route::get('/admin/event/edit-category/{id}','App\Http\Controllers\Admin\EventController@edit_category');
Route::get('/admin/event/delete-category/{id}','App\Http\Controllers\Admin\EventController@delete_category');

Route::post('/admin/event/update-category','App\Http\Controllers\Admin\EventController@update_category');
Route::post('/admin/event/changestatus','App\Http\Controllers\Admin\EventController@changestatus');
Route::get('/admin/event/view/{id}','App\Http\Controllers\Admin\EventController@view');

//Listing
Route::get('/admin/listing','App\Http\Controllers\Admin\ListingController@index');
Route::get('/admin/listing/add','App\Http\Controllers\Admin\ListingController@add');

Route::post('/admin/listing/getlistsubcategory','App\Http\Controllers\Admin\ListingController@getlistsubcategory');

Route::post('/admin/listing/getstate','App\Http\Controllers\Admin\ListingController@getstate');
Route::post('/admin/listing/getcity','App\Http\Controllers\Admin\ListingController@getcity');
Route::post('/admin/listing/save','App\Http\Controllers\Admin\ListingController@save');
Route::get('/admin/listing/edit/{id}','App\Http\Controllers\Admin\ListingController@edit');
Route::post('/admin/listing/update','App\Http\Controllers\Admin\ListingController@update');
Route::post('/admin/listing/deleteGallery','App\Http\Controllers\Admin\ListingController@deleteGallery');
Route::post('/admin/listing/changestatus','App\Http\Controllers\Admin\ListingController@changestatus');
Route::get('/admin/listing/view/{id}','App\Http\Controllers\Admin\ListingController@view');
Route::get('/admin/listing/delete-listing/{id}','App\Http\Controllers\Admin\ListingController@delete_listing');

Route::get('/admin/listing/category','App\Http\Controllers\Admin\ListingController@listing_category');
Route::get('/admin/listing/add-category','App\Http\Controllers\Admin\ListingController@add_category');
Route::post('/admin/listing/save-category','App\Http\Controllers\Admin\ListingController@save_category');
Route::get('/admin/listing/edit-category/{id}','App\Http\Controllers\Admin\ListingController@edit_category');
Route::post('/admin/listing/update-category','App\Http\Controllers\Admin\ListingController@update_category');
Route::get('/admin/listing/delete-category/{id}','App\Http\Controllers\Admin\ListingController@delete_category');

Route::get('/admin/listing/uploadListing','App\Http\Controllers\Admin\ListingController@uploads_listing');
Route::post('/admin/listing/saveBulklisting','App\Http\Controllers\Admin\ListingController@saveBulklisting');

//listing subcategory
Route::get('/admin/listing/subcategory','App\Http\Controllers\Admin\ListingController@listing_subcategory');
Route::get('/admin/listing/add-subcategory','App\Http\Controllers\Admin\ListingController@add_subcategory');
Route::post('/admin/listing/save-subcategory','App\Http\Controllers\Admin\ListingController@save_subcategory');
Route::get('/admin/listing/edit-subcategory/{id}','App\Http\Controllers\Admin\ListingController@edit_subcategory');
Route::post('/admin/listing/update-subcategory','App\Http\Controllers\Admin\ListingController@update_subcategory');
Route::get('/admin/listing/delete-subcategory/{id}','App\Http\Controllers\Admin\ListingController@delete_subcategory');


//listing subcategory sub
Route::get('/admin/listing/subcategory-sub','App\Http\Controllers\Admin\ListingController@listing_sub_category_sub');
Route::get('/admin/listing/add-subcategory-sub','App\Http\Controllers\Admin\ListingController@add_subcategory_sub');
//Route::get('/admin/listing/save-subcategory-save','App\Http\Controllers\Admin\ListingController@save_subcategory_save');
Route::post('/admin/listing/save-subcategory-save','App\Http\Controllers\Admin\ListingController@save_subcategory_save');
Route::post('/admin/listing/update-subcategory-update','App\Http\Controllers\Admin\ListingController@update_subcategory_update');
Route::get('/admin/listing/edit-subcategory-sub/{id}','App\Http\Controllers\Admin\ListingController@edit_subcategory_sub');


//Discount
Route::get('/admin/discount/add','App\Http\Controllers\Admin\DiscountController@add');
Route::post('/admin/discount/save','App\Http\Controllers\Admin\DiscountController@save');
Route::get('/admin/discount','App\Http\Controllers\Admin\DiscountController@index');
Route::get('/admin/discount/edit/{id}','App\Http\Controllers\Admin\DiscountController@edit');
Route::post('/admin/discount/update','App\Http\Controllers\Admin\DiscountController@update');
Route::get('/admin/discount/delete/{id}','App\Http\Controllers\Admin\DiscountController@delete');

//CMS
Route::get('/admin/cms/privacy-policy','App\Http\Controllers\Admin\CmsController@index');
Route::post('/admin/cms/update-privacy','App\Http\Controllers\Admin\CmsController@update_privacy');
Route::get('/admin/cms/term-and-condition','App\Http\Controllers\Admin\CmsController@term');
Route::post('/admin/cms/update-term','App\Http\Controllers\Admin\CmsController@update_term');
Route::get('/admin/cms/faq','App\Http\Controllers\Admin\CmsController@faq');
Route::get('/admin/cms/add-faq','App\Http\Controllers\Admin\CmsController@add_faq');
Route::post('/admin/cms/save-faq','App\Http\Controllers\Admin\CmsController@save_faq');
Route::get('/admin/cms/edit-faq/{id}','App\Http\Controllers\Admin\CmsController@edit_faq');
Route::post('/admin/cms/update-faq','App\Http\Controllers\Admin\CmsController@update_faq');
Route::get('/admin/cms/delete-faq/{id}','App\Http\Controllers\Admin\CmsController@delete_faq');
Route::post('/admin/cms/changestatus-faq','App\Http\Controllers\Admin\CmsController@changestatus_faq');
Route::get('/admin/cms/about-us','App\Http\Controllers\Admin\CmsController@about');
Route::post('/admin/cms/saveabout','App\Http\Controllers\Admin\CmsController@saveabout');

//Transaction
Route::get('/admin/transaction','App\Http\Controllers\Admin\TransactionController@index');
Route::get('/admin/transaction/view/{id}','App\Http\Controllers\Admin\TransactionController@view');

//Access Management
Route::get('/admin/access-management/add','App\Http\Controllers\Admin\AccessController@add');
Route::post('/admin/access-management/get_tier','App\Http\Controllers\Admin\AccessController@get_tier');
Route::post('/admin/access-management/save','App\Http\Controllers\Admin\AccessController@save');
Route::get('/admin/access-management/adduser','App\Http\Controllers\Admin\AccessController@adduser');
Route::post('/admin/access-management/saveuser','App\Http\Controllers\Admin\AccessController@saveuser');
Route::get('/admin/access-management/userlist','App\Http\Controllers\Admin\AccessController@user');
Route::get('/admin/access-management/edit/{id}','App\Http\Controllers\Admin\AccessController@edit');
Route::post('/admin/access-management/update','App\Http\Controllers\Admin\AccessController@update');
Route::get('/admin/access-management/edit-access/{id}','App\Http\Controllers\Admin\AccessController@editAccess');
Route::post('/admin/access-management/updateAccess','App\Http\Controllers\Admin\AccessController@updateAccess');
Route::post('/admin/access-management/changestatus','App\Http\Controllers\Admin\AccessController@changestatus');


//promotion
Route::get('/admin/promotion','App\Http\Controllers\Admin\PromotionController@index');
Route::get('/admin/promotion/add','App\Http\Controllers\Admin\PromotionController@add');
Route::post('/admin/promotion/save','App\Http\Controllers\Admin\PromotionController@save');
Route::get('/admin/promotion/edit/{id}','App\Http\Controllers\Admin\PromotionController@edit');
Route::post('/admin/promotion/update','App\Http\Controllers\Admin\PromotionController@update');
Route::get('/admin/promotion/delete/{id}','App\Http\Controllers\Admin\PromotionController@delete_user');
Route::get('/admin/promotion/view/{id}','App\Http\Controllers\Admin\PromotionController@view');

Route::get('/admin/promotion/category','App\Http\Controllers\Admin\PromotionController@category');
Route::get('/admin/promotion/category/add','App\Http\Controllers\Admin\PromotionController@add_category');
Route::post('/admin/promotion/category/save','App\Http\Controllers\Admin\PromotionController@save_category');
Route::get('/admin/promotion/category/edit/{id}','App\Http\Controllers\Admin\PromotionController@edit_category');
Route::post('/admin/promotion/category/update','App\Http\Controllers\Admin\PromotionController@update_category');
Route::get('/admin/promotion/category/delete/{id}','App\Http\Controllers\Admin\PromotionController@delete_category');
Route::get('/admin/promotion/plan/add','App\Http\Controllers\Admin\PromotionController@add_plan');
Route::post('/admin/promotion/plan/save','App\Http\Controllers\Admin\PromotionController@save_plan');
Route::get('/admin/promotion/plan','App\Http\Controllers\Admin\PromotionController@plan_list');
Route::get('/admin/promotion/plan/edit/{id}','App\Http\Controllers\Admin\PromotionController@edit_plan');
Route::post('/admin/promotion/plan/update','App\Http\Controllers\Admin\PromotionController@update_plan');
Route::get('/admin/promotion/plan/delete/{id}','App\Http\Controllers\Admin\PromotionController@delete_plan');


//Tags
Route::get('/admin/tags','App\Http\Controllers\Admin\TagsController@index');
Route::get('/admin/tags/add','App\Http\Controllers\Admin\TagsController@add');
Route::post('/admin/tags/save','App\Http\Controllers\Admin\TagsController@save');
Route::get('/admin/tags/edit/{id}','App\Http\Controllers\Admin\TagsController@edit');
Route::post('/admin/tags/update','App\Http\Controllers\Admin\TagsController@update');
Route::get('/admin/tags/delete/{id}','App\Http\Controllers\Admin\TagsController@delete');


//Interest
Route::get('/admin/interest','App\Http\Controllers\Admin\InterestController@index');
Route::get('/admin/interest/add','App\Http\Controllers\Admin\InterestController@add');
Route::post('/admin/interest/save','App\Http\Controllers\Admin\InterestController@save');
Route::get('/admin/interest/edit/{id}','App\Http\Controllers\Admin\InterestController@edit');
Route::post('/admin/interest/update','App\Http\Controllers\Admin\InterestController@update');
Route::get('/admin/interest/delete/{id}','App\Http\Controllers\Admin\InterestController@delete');


//Invitation
Route::get('/admin/invitation','App\Http\Controllers\Admin\InvitationController@index');


//Product
Route::get('/admin/product/category','App\Http\Controllers\Admin\ProductController@category');
Route::get('/admin/product/category/add','App\Http\Controllers\Admin\ProductController@add_category');
Route::post('/admin/product/category/save_category','App\Http\Controllers\Admin\ProductController@save_category');
Route::get('/admin/product/category/edit/{id}','App\Http\Controllers\Admin\ProductController@edit_category');
Route::post('/admin/product/category/update_category','App\Http\Controllers\Admin\ProductController@update_category');
Route::get('/admin/product/category/delete/{id}','App\Http\Controllers\Admin\ProductController@delete_category');

Route::get('/admin/product/subcategory','App\Http\Controllers\Admin\ProductController@subcategory');
Route::get('/admin/product/subcategory/add','App\Http\Controllers\Admin\ProductController@add_subcategory');
Route::post('/admin/product/subcategory/save','App\Http\Controllers\Admin\ProductController@save_subcategory');
Route::get('/admin/product/subcategory/edit/{id}','App\Http\Controllers\Admin\ProductController@edit_subcategory');
Route::post('/admin/product/subcategory/update','App\Http\Controllers\Admin\ProductController@update_subcategory');
Route::get('/admin/product/subcategory/delete/{id}','App\Http\Controllers\Admin\ProductController@delete_subcategory');

Route::get('/admin/product/','App\Http\Controllers\Admin\ProductController@product');
Route::get('/admin/product/add','App\Http\Controllers\Admin\ProductController@add');
Route::post('/admin/product/save','App\Http\Controllers\Admin\ProductController@save');
Route::post('/admin/product/changestatus','App\Http\Controllers\Admin\ProductController@changestatus');
Route::get('/admin/product/edit/{id}','App\Http\Controllers\Admin\ProductController@edit');
Route::post('/admin/product/update','App\Http\Controllers\Admin\ProductController@update');
Route::get('/admin/product/delete/{id}','App\Http\Controllers\Admin\ProductController@delete');
Route::get('/admin/product/view/{id}','App\Http\Controllers\Admin\ProductController@view');
Route::post('/admin/product/removeImg','App\Http\Controllers\Admin\ProductController@removeImg');
Route::post('/admin/product/getSub','App\Http\Controllers\Admin\ProductController@getSub');
Route::get('/admin/product/uploadProduct','App\Http\Controllers\Admin\ProductController@uploads_product');
Route::post('/admin/product/saveBulkproduct','App\Http\Controllers\Admin\ProductController@saveBulkproduct');

Route::get('/admin/product/purchaseList','App\Http\Controllers\Admin\ProductController@purchaseList');
Route::post('/admin/product/orderinfo','App\Http\Controllers\Admin\ProductController@orderinfo');


//Services
Route::get('/admin/services','App\Http\Controllers\Admin\ServicesController@index');
Route::get('/admin/services/add','App\Http\Controllers\Admin\ServicesController@add');
Route::post('/admin/services/save','App\Http\Controllers\Admin\ServicesController@save');
Route::get('/admin/services/edit/{id}','App\Http\Controllers\Admin\ServicesController@edit');
Route::post('/admin/services/update','App\Http\Controllers\Admin\ServicesController@update');
Route::get('/admin/services/view/{id}','App\Http\Controllers\Admin\ServicesController@view');
Route::get('/admin/services/delete/{id}','App\Http\Controllers\Admin\ServicesController@delete');
Route::post('/admin/services/removeImg','App\Http\Controllers\Admin\ServicesController@removeImg');
Route::post('/admin/services/changestatus','App\Http\Controllers\Admin\ServicesController@changestatus');

//send Message
Route::get('/admin/message/add','App\Http\Controllers\Admin\MessageController@sendMessage');
Route::post('/admin/message/saveMessage','App\Http\Controllers\Admin\MessageController@saveMessage');
Route::get('/admin/message','App\Http\Controllers\Admin\MessageController@index');
Route::post('/admin/message/get_recipients','App\Http\Controllers\Admin\MessageController@get_recipients');
Route::post('/admin/message/delete_message','App\Http\Controllers\Admin\MessageController@delete_message');

//oneSignal
Route::post('/payment/updateplayerId','App\Http\Controllers\PaymentController@updateplayerId');

//Email Template
Route::get('/admin/emailtemplate','App\Http\Controllers\Admin\EmailtemplateController@index');
Route::get('/admin/emailtemplate/create','App\Http\Controllers\Admin\EmailtemplateController@create');
Route::post('/admin/emailtemplate/create_action','App\Http\Controllers\Admin\EmailtemplateController@create_action');
Route::get('/admin/emailtemplate/update/{id}','App\Http\Controllers\Admin\EmailtemplateController@update');
Route::post('/admin/emailtemplate/update_action','App\Http\Controllers\Admin\EmailtemplateController@update_action');
Route::post('/admin/emailtemplate/delete_template','App\Http\Controllers\Admin\EmailtemplateController@delete_template');

//Mailer
Route::get('/admin/mailer','App\Http\Controllers\Admin\MailerController@index');
Route::post('/admin/mailer/get_recipients','App\Http\Controllers\Admin\MailerController@get_recipients');
Route::get('/admin/mailer/update','App\Http\Controllers\Admin\MailerController@update');
Route::post('/admin/mailer/send_new_mail','App\Http\Controllers\Admin\MailerController@send_new_mail');
Route::get('/admin/mailer/list_send_mail','App\Http\Controllers\Admin\MailerController@list_send_mail');
Route::get('/admin/mailer/existing_template','App\Http\Controllers\Admin\MailerController@existing_template');
Route::get('/admin/mailer/add_use_template','App\Http\Controllers\Admin\MailerController@add_use_template');
Route::post('/admin/mailer/save_use_template','App\Http\Controllers\Admin\MailerController@save_use_template');
Route::get('/admin/mailer/new_compose_mail','App\Http\Controllers\Admin\MailerController@new_compose_mail');
Route::post('/admin/mailer/delete_send_list','App\Http\Controllers\Admin\MailerController@delete_send_list');

//Banner
Route::get('/admin/banner/','App\Http\Controllers\Admin\BannerController@index');
Route::get('/admin/banner/add','App\Http\Controllers\Admin\BannerController@add');
Route::post('/admin/banner/save','App\Http\Controllers\Admin\BannerController@save');
Route::get('/admin/banner/edit/{id}','App\Http\Controllers\Admin\BannerController@edit');
Route::post('/admin/banner/update','App\Http\Controllers\Admin\BannerController@update');
Route::get('/admin/banner/delete/{id}','App\Http\Controllers\Admin\BannerController@delete');
Route::post('/admin/banner/changestatus','App\Http\Controllers\Admin\BannerController@changestatus');

// referral
Route::get('/admin/referral-setting/','App\Http\Controllers\Admin\RefersettingController@index');
Route::post('/admin/referral-setting/saveSetting/','App\Http\Controllers\Admin\RefersettingController@saveSetting');

//payout
Route::get('/admin/payout/','App\Http\Controllers\Admin\PayoutController@index');
Route::get('/admin/payout/downloadCsv','App\Http\Controllers\Admin\PayoutController@downloadCsv');
Route::get('/admin/payout/view/{id}','App\Http\Controllers\Admin\PayoutController@view');
Route::get('/admin/payout/downloadPayoutReportCsv/{id}','App\Http\Controllers\Admin\PayoutController@downloadPayoutReportCsv');
Route::get('/admin/wallet/withdraw-request','App\Http\Controllers\Admin\WalletController@index');

//API
Route::get('/api/usertypeList','App\Http\Controllers\Api\ApiController@usertypeList_get');
Route::get('/api/planList','App\Http\Controllers\Api\ApiController@planList_get');
Route::get('/api/planDetails','App\Http\Controllers\Api\ApiController@planDetails_get');
Route::post('/api/register','App\Http\Controllers\Api\ApiController@register_post');
Route::post('/api/indentificationDocument','App\Http\Controllers\Api\ApiController@indentificationDocument_post');
Route::post('/api/login','App\Http\Controllers\Api\ApiController@login_post');
Route::post('/api/getOtp','App\Http\Controllers\Api\ApiController@getOtp_post');
Route::post('/api/verifyOtp','App\Http\Controllers\Api\ApiController@verifyOtp_post');
Route::post('/api/recoveryUpdatePassword','App\Http\Controllers\Api\ApiController@recoveryUpdatePassword_post');
Route::get('/api/profileInfo','App\Http\Controllers\Api\ApiController@profileInfo_get');
Route::post('/api/profileEdit','App\Http\Controllers\Api\ApiController@profileEdit_post');
Route::post('/api/uploadProfile','App\Http\Controllers\Api\ApiController@uploadProfile_post');
Route::get('/api/businessCategory','App\Http\Controllers\Api\ApiController@businessCategory_get');
Route::get('/api/businessSubcategoryByCatId','App\Http\Controllers\Api\ApiController@businessSubcategoryBycatId_get');
Route::post('/api/addBusiness','App\Http\Controllers\Api\ApiController@addBusiness_post');
Route::get('/api/businessDetails','App\Http\Controllers\Api\ApiController@businessDetails_get');
Route::post('/api/editBusiness','App\Http\Controllers\Api\ApiController@editBusiness_post');
Route::get('/api/myBusiness','App\Http\Controllers\Api\ApiController@myBusiness_get');
Route::post('/api/addFavbusiness','App\Http\Controllers\Api\ApiController@addFavbusiness_post');
Route::get('/api/myFavBusiness','App\Http\Controllers\Api\ApiController@myFavBusiness_get');
Route::get('/api/businessByCategory','App\Http\Controllers\Api\ApiController@businessByCategory_get');
Route::get('/api/searchBisuness','App\Http\Controllers\Api\ApiController@searchBisuness_get');
Route::post('/api/changePassword','App\Http\Controllers\Api\ApiController@changePassword_post');
Route::post('/api/addEvent','App\Http\Controllers\Api\ApiController@addEvent_post');
Route::post('/api/editEvent','App\Http\Controllers\Api\ApiController@editEvent_post');
Route::get('/api/eventDetails','App\Http\Controllers\Api\ApiController@eventDetails_get');
Route::get('/api/myEvent','App\Http\Controllers\Api\ApiController@myEvent_get');
Route::post('/api/addFavevent','App\Http\Controllers\Api\ApiController@addFavevent_post');
Route::get('/api/myFavEvent','App\Http\Controllers\Api\ApiController@myFavEvent_get');
Route::get('/api/upcomingEvent','App\Http\Controllers\Api\ApiController@upcomingEvent_get');
Route::get('/api/searchEvent','App\Http\Controllers\Api\ApiController@searchEvent_get');
Route::get('/api/invitations','App\Http\Controllers\Api\ApiController@invitations_get');
Route::post('/api/sendInvitation','App\Http\Controllers\Api\ApiController@sendInvitation_post');
Route::post('/api/invitationAccept','App\Http\Controllers\Api\ApiController@invitationAccept_post');
Route::post('/api/invitationReject','App\Http\Controllers\Api\ApiController@invitationReject_post');
Route::get('/api/acceptedInvitationList','App\Http\Controllers\Api\ApiController@acceptedInvitationList_get');
Route::get('/api/pendingInvitationList','App\Http\Controllers\Api\ApiController@pendingInvitationList_get');
Route::get('/api/rejectInvitationList','App\Http\Controllers\Api\ApiController@rejectInvitationList_get');
Route::post('/api/resendInvitation','App\Http\Controllers\Api\ApiController@resendInvitation_post');
Route::get('/api/counterOfferList','App\Http\Controllers\Api\ApiController@counterOfferList_get');
Route::post('/api/addpromotionAds','App\Http\Controllers\Api\ApiController@addpromotionAds_post');
Route::get('/api/adsDetails','App\Http\Controllers\Api\ApiController@adsDetails_get');
Route::post('/api/editpromotionAds','App\Http\Controllers\Api\ApiController@editpromotionAds_post');
Route::get('/api/myAdsList','App\Http\Controllers\Api\ApiController@myAdsList_get');
Route::get('/api/allAdsList','App\Http\Controllers\Api\ApiController@allAdsList_get');
Route::get('/api/eventCategory','App\Http\Controllers\Api\ApiController@eventCategory_get');
Route::get('/api/tags','App\Http\Controllers\Api\ApiController@tags_get');
Route::get('/api/newtwork','App\Http\Controllers\Api\ApiController@newtwork_get');
Route::get('/api/eventByCategory','App\Http\Controllers\Api\ApiController@eventByCategory_get');
Route::post('/api/uploadsPhoto','App\Http\Controllers\Api\ApiController@uploadsPhoto_post');
Route::get('/api/photos','App\Http\Controllers\Api\ApiController@photos_get');
Route::post('/api/deletePhoto','App\Http\Controllers\Api\ApiController@deletePhoto_post');
Route::get('/api/transactionList','App\Http\Controllers\Api\ApiController@transactionList_get');
Route::get('/api/interestList','App\Http\Controllers\Api\ApiController@interestList_get');
Route::get('/api/promotionAdsCategory','App\Http\Controllers\Api\ApiController@promotionAdsCategory_get');
Route::get('/api/promotionPlanList','App\Http\Controllers\Api\ApiController@promotionPlanList_get');
Route::get('/api/ageRangeList','App\Http\Controllers\Api\ApiController@ageRangeList_get');
Route::get('/api/householdIncomeList','App\Http\Controllers\Api\ApiController@householdIncomeList_get');
Route::get('/api/myPromotionList','App\Http\Controllers\Api\ApiController@myPromotionList_get');
Route::get('/api/allPromotionList','App\Http\Controllers\Api\ApiController@allPromotionList_get');
Route::get('/api/searchPromotion','App\Http\Controllers\Api\ApiController@searchPromotion_get');
Route::get('/api/networkList','App\Http\Controllers\Api\ApiController@networkList_get');
Route::post('/api/networkfilterList','App\Http\Controllers\Api\ApiController@networkfilterList_post');
Route::get('/api/userProfile','App\Http\Controllers\Api\ApiController@userProfile_get');
Route::get('/api/notificationList','App\Http\Controllers\Api\ApiController@notificationList_get');
Route::get('/api/topuptransactionList','App\Http\Controllers\Api\ApiController@topuptransactionList_get');
Route::post('/api/walletWithdraw','App\Http\Controllers\Api\ApiController@walletWithdraw_post');
Route::get('/api/withdrawtransactionList','App\Http\Controllers\Api\ApiController@withdrawtransactionList_get');
Route::get('/api/alltransactionList','App\Http\Controllers\Api\ApiController@alltransactionList_get');
Route::get('/api/productCategoryList','App\Http\Controllers\Api\ApiController@productCategoryList_get');
Route::get('/api/productSubcategoryList','App\Http\Controllers\Api\ApiController@productSubcategory_get');
Route::post('/api/addProduct','App\Http\Controllers\Api\ApiController@addProduct_post');
Route::get('/api/productDeatils','App\Http\Controllers\Api\ApiController@productDeatils_get');
Route::post('/api/updateProduct','App\Http\Controllers\Api\ApiController@updateProduct_post');
Route::get('/api/productList','App\Http\Controllers\Api\ApiController@productList_get');
Route::post('/api/deleteProduct','App\Http\Controllers\Api\ApiController@deleteProduct_post');
Route::post('/api/sendMsg','App\Http\Controllers\Api\ApiController@sendMsg_post');
Route::post('/api/allChats','App\Http\Controllers\Api\ApiController@allChats_post');
Route::post('/api/addUserOneSignalId','App\Http\Controllers\Api\ApiController@addUserOneSignalId_post');

Route::post('/api/stripeConnect','App\Http\Controllers\Api\ApiController@stripeConnect_post');
Route::post('/api/userStripeInfo','App\Http\Controllers\Api\ApiController@userStripeInfo_post');
Route::get('/api/bannerList','App\Http\Controllers\Api\ApiController@bannerList_get');
Route::get('/api/promotionManagement','App\Http\Controllers\Api\ApiController@promotionManagement_get');
Route::get('/api/eventManagement','App\Http\Controllers\Api\ApiController@eventManagement_get');
Route::get('/api/subscriptionManagement','App\Http\Controllers\Api\ApiController@subscriptionManagement_get');
Route::get('/api/networkManagement','App\Http\Controllers\Api\ApiController@networkManagement_get');
Route::get('/api/appearanceManagement','App\Http\Controllers\Api\ApiController@appearanceManagement_get');
Route::get('/api/businessManagement','App\Http\Controllers\Api\ApiController@businessManagement_get');
Route::post('/api/addCategory','App\Http\Controllers\Api\ApiController@addCategory_post');
Route::post('/api/deleteCategory','App\Http\Controllers\Api\ApiController@deleteCategory_post');
Route::get('/api/categoryList','App\Http\Controllers\Api\ApiController@categoryList_get');
Route::post('/api/addService','App\Http\Controllers\Api\ApiController@addService_post');
Route::get('/api/serviceDetails','App\Http\Controllers\Api\ApiController@serviceDetails_get');
Route::post('/api/updateService','App\Http\Controllers\Api\ApiController@updateService_post');
Route::get('/api/serviceList','App\Http\Controllers\Api\ApiController@serviceList_get');
Route::post('/api/deleteService','App\Http\Controllers\Api\ApiController@deleteService_post');
Route::get('/api/searchService','App\Http\Controllers\Api\ApiController@searchService_get');
Route::get('/api/planDetailstest','App\Http\Controllers\Api\ApiController@planDetailstest_get');
Route::get('/api/faq','App\Http\Controllers\Api\ApiController@faq_get');
Route::get('/api/term-and-condition','App\Http\Controllers\Api\ApiController@term_get');
Route::get('/api/privacy-policy','App\Http\Controllers\Api\ApiController@privacyPolicy_get');
Route::get('/api/about-us','App\Http\Controllers\Api\ApiController@aboutUs_get');
Route::post('/api/discountCode','App\Http\Controllers\Api\ApiController@discountCode_post');
Route::post('/api/addEventCategory','App\Http\Controllers\Api\ApiController@addEventCategory_post');
Route::get('/api/eventList','App\Http\Controllers\Api\ApiController@eventList_get');
Route::get('/api/athleticList','App\Http\Controllers\Api\ApiController@athleticList_get');
Route::get('/api/upcomingInvitationList','App\Http\Controllers\Api\ApiController@upcomingInvitationList_get');
Route::get('/api/ongoingInvitationList','App\Http\Controllers\Api\ApiController@ongoingInvitationList_get');
Route::get('/api/purchaseList','App\Http\Controllers\Api\ApiController@purchaseList_get');
Route::get('/api/newInvitationList','App\Http\Controllers\Api\ApiController@newInvitationList_get');
Route::get('/api/subscriptionHistory','App\Http\Controllers\Api\ApiController@subscriptionHistory_get');
Route::post('/api/deleteEvent','App\Http\Controllers\Api\ApiController@deleteEvent_post');
Route::post('/api/deleteBusiness','App\Http\Controllers\Api\ApiController@deleteBusiness_post');
Route::post('/api/deletePromotion','App\Http\Controllers\Api\ApiController@deletePromotion_post');
Route::get('/api/advertisePlanList','App\Http\Controllers\Api\ApiController@AdvertisePlanList_get');
Route::post('/api/addAdvertise','App\Http\Controllers\Api\ApiController@addAdvertise_post');
Route::post('/api/addfavNetworkUsers','App\Http\Controllers\Api\ApiController@addfavNetworkUsers_post');
Route::get('/api/myNetworkList','App\Http\Controllers\Api\ApiController@myNetworkList_get');
Route::get('/api/completeInvitationList','App\Http\Controllers\Api\ApiController@completeInvitationList_get');
Route::post('/api/referInvite','App\Http\Controllers\Api\ApiController@referInvite_post');
Route::get('/api/myReferrals','App\Http\Controllers\Api\ApiController@myReferrals_get');
Route::post('/api/deleteAccount','App\Http\Controllers\Api\ApiController@deleteAccount_post');
Route::post('/api/clearsingleitem','App\Http\Controllers\Api\ApiController@clearsingleitem_post');
Route::post('/api/clearallitem','App\Http\Controllers\Api\ApiController@clearallitem_post');
Route::get('/api/walletBalance','App\Http\Controllers\Api\ApiController@walletBalance_get');
Route::post('/api/addToCart','App\Http\Controllers\Api\ApiController@addToCart_post');
Route::post('/api/totalCart','App\Http\Controllers\Api\ApiController@totalCart_post');
Route::post('/api/cart_list','App\Http\Controllers\Api\ApiController@cart_list_post');
Route::post('/api/removeCartList','App\Http\Controllers\Api\ApiController@removeCartList_post');
Route::get('/api/stripeStatus','App\Http\Controllers\Api\ApiController@stripeStatus_get');


//webview api
Route::get('/webview/paymentPage','App\Http\Controllers\PaymentController@paymentPage');
Route::get('/webview/proceedfromcartpaymentPage','App\Http\Controllers\PaymentController@proceedfromcartpaymentPage');
Route::post('/webview/web_view_stripe_payment','App\Http\Controllers\PaymentController@web_view_stripe_payment');
Route::post('/webview/proceed_from_cart_web_view_stripe_payment','App\Http\Controllers\PaymentController@proceed_from_cart_web_view_stripe_payment');
Route::get('/webview/paymentStatus','App\Http\Controllers\PaymentController@paymentStatus');

Route::get('/webview/promotionPaymentPage','App\Http\Controllers\PaymentController@promotionPaymentPage');
Route::post('/webview/promotion_web_view_stripe_payment','App\Http\Controllers\PaymentController@promotion_web_view_stripe_payment');
Route::get('/webview/promotionpaymentStatus','App\Http\Controllers\PaymentController@promotionpaymentStatus');

Route::get('/webview/topupPayment','App\Http\Controllers\PaymentController@topupPaymentpage');
Route::post('/webview/topup_web_view_stripe_payment','App\Http\Controllers\PaymentController@topup_web_view_stripe_payment');
Route::get('/webview/topupPaymentStatus','App\Http\Controllers\PaymentController@topupPaymentStatus');
Route::get('/webview/stripeReturn','App\Http\Controllers\PaymentController@stripeReturn');
Route::get('/webview/stripeConnectStatus','App\Http\Controllers\PaymentController@stripeConnectStatus');
Route::get('/webview/productPayment','App\Http\Controllers\PaymentController@productPayment');
Route::post('/webview/product_stripe_payment','App\Http\Controllers\PaymentController@product_stripe_payment');
Route::get('/webview/productPaymentStatus','App\Http\Controllers\PaymentController@productPaymentStatus');
Route::get('/webview/advertisePayment','App\Http\Controllers\PaymentController@advertisePayment');
Route::post('/webview/submit_advertisement_payment','App\Http\Controllers\PaymentController@submit_advertisement_payment');
Route::get('/webview/advertisepaymentStatus','App\Http\Controllers\PaymentController@advertisepaymentStatus');
