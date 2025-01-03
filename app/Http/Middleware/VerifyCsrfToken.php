<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
	 
	
    protected $except = [
       '/api/register',
       '/api/login',
       '/api/getOtp',
       '/api/verifyOtp',
       '/api/recoveryUpdatePassword',
       '/api/indentificationDocument',
       '/api/profileEdit',
       '/api/uploadProfile',
       '/api/addBusiness',
       '/api/editBusiness',
       '/api/addFavbusiness',
       '/api/changePassword',
       '/api/addEvent',
       '/api/editEvent',
       '/api/addFavevent',
       '/api/sendInvitation',
       '/api/invitationAccept',
       '/api/invitationReject',
       '/api/resendInvitation',
       '/api/addpromotionAds',
       '/api/editpromotionAds',
       '/api/uploadsPhoto',
       '/api/deletePhoto',
       '/api/networkfilterList',
       '/api/walletWithdraw',
       '/api/addProduct',
       '/api/updateProduct',
       '/api/deleteProduct',
       '/api/sendMsg',
       '/api/allChats',
       '/api/addUserOneSignalId',
       '/api/stripeConnect',
       '/api/userStripeInfo',
       '/api/addCategory',
       '/api/deleteCategory',
       '/api/addService',
       '/api/updateService',
       '/api/deleteService',
       '/api/discountCode',
       '/api/addEventCategory',
       '/api/deleteBusiness',
       '/api/deleteEvent',
       '/api/deletePromotion',
       '/api/addAdvertise',
       '/api/addfavNetworkUsers',
       '/api/referInvite',
    ];
}
