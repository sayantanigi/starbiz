<?php
    $menuId = [];
	foreach($rolePer as $k => $v){
		$menuId[] = $v->menu_id;
	}

?>
@include('admin.header');
@include('admin.sidebar');
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>    
<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>

<style>

	small > p{
	  color:red;
	}
	
	p strong{
		font-weight: 600 !important;
		color: black !important;
	}
	
	.sa-confirm-button-container button{
		background-color: #146c43 !important;
		border-color: #146c43 !important;
	}
	
	.image_area {
	    position: relative;
	}

	img {
		display: block;
		max-width: 100%;
	}

	.preview {
		overflow: hidden;
		width: 160px; 
		height: 160px;
		margin: 10px;
		border: 1px solid red;
	}

	.preview1 {
		overflow: hidden;
		width: 160px; 
		height: 160px;
		margin: 10px;
		border: 1px solid red;
	}

	.modal-lg{
		max-width: 1000px !important;
	}

	.overlay {
		position: absolute;
		bottom: 10px;
		left: 0;
		right: 0;
		background-color: rgba(255, 255, 255, 0.5);
		overflow: hidden;
		height: 0;
		transition: .5s ease;
		width: 100%;
	}

	.image_area:hover .overlay {
		height: 50%;
		cursor: pointer;
	}

	.text {
		color: #333;
		font-size: 20px;
		position: absolute;
		top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
		text-align: center;
	}
	
	#img-container {
		border: 1px solid red;
		width: 75vw;
		height: 75vw;
		background: #666;
	}
	
	img {
		display: block;
		max-width: 100%;
	}
	
	/*Cover Image*/
	/*cover Image*/
	body{margin-top:20px;}

	.profile {
		width: 100%;
		position: relative;
		background: #FFF;
		border: 1px solid #D5D5D5;
		padding-bottom: 5px;
		margin-bottom: 20px;
	}

	.profile .image {
		display: block;
		position: relative;
		z-index: 1;
		overflow: hidden;
		text-align: center;
		border: 5px solid #FFF;
	}

	.profile .user {
		position: relative;
		padding: 0px 5px 5px;
	}

	.profile .user .avatar {
		position: absolute;
		left: 20px;
		top: -85px;
		z-index: 2;
	}

	.profile .user h2 {
		font-size: 16px;
		line-height: 20px;
		display: block;
		float: left;
		margin: 4px 0px 0px 135px;
		font-weight: bold;
	}

	.profile .user .actions {
		float: right;
	}

	.profile .user .actions .btn {
		margin-bottom: 0px;
	}

	.profile .info {
		float: left;
		margin-left: 20px;
	}

	.img-profile{
		height:100px;
		width:100px;
	}

	.img-cover{
		width:800px;
		height:300px;
	}

	@media (max-width: 768px) {
		.btn-responsive {
			padding:2px 4px;
			font-size:80%;
			line-height: 1;
			border-radius:3px;
		}
	}

	@media (min-width: 769px) and (max-width: 992px) {
		.btn-responsive {
			padding:4px 9px;
			font-size:90%;
			line-height: 1.2;
		}
	}


	/* input type file */

	.files input {
		outline: 2px dashed #92b0b3;
		outline-offset: -10px;
		-webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
		transition: outline-offset .15s ease-in-out, background-color .15s linear;
		/*padding: 120px 0px 85px 35%;*/
		padding: 52px 0px 46px 32%;
		text-align: center !important;
		margin: 0;
		width: 100% !important;
	}
	
	.files input:focus{
		outline: 2px dashed #92b0b3;  outline-offset: -10px;
		-webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
		transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
	 }
	 
	.files{ position:relative}
	.files:after {  
	    pointer-events: none;
		position: absolute;
		top: 60px;
		left: 0;
		width: 50px;
		right: 0;
		height: 56px;
		content: "";
		background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
		display: block;
		margin: 0 auto;
		background-size: 100%;
		background-repeat: no-repeat;
	}
	
	.color input{ background-color:#f1f1f1;}
	.files:before {
		position: absolute;
		bottom: 10px;
		left: 0;  pointer-events: none;
		width: 100%;
		right: 0;
		height: 57px;
		/*content: " or drag it here. ";*/
		display: block;
		margin: 0 auto;
		color: #2ea591;
		font-weight: 600;
		text-transform: capitalize;
		text-align: center;
	}

	/* input type file */
 </style>
 <div class="main-content">
   <div class="page-content">
      <div class="container-fluid">  
       <section class="bg-light-gray">
        <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0"><?= $title ?></h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
                    </div>

                </div>
            </div>
           </div>

            <div class="row">

                <div class="col-lg-12 mb-3">
                  <div class="card shadow rounded">
                     <div class="card-body">    
                        <form id="" action="{{url('admin/access-management/updateAccess')}}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group mb-2">
                                <label class="fw-semibold  text-black">User Type</label>
                                <select class="form-control" name="user_type"  id="user_type" required>
                                    <option value="">Select User Type</option>
                                    <option value="1111" <?=(@$roleId == 1111) ? 'selected' : ''?>>Admin</option>
                                    <option value="0000">Sub admin</option>
                                    <?php
									    if(!empty(@$userType)){
											foreach(@$userType as $k => $v){
												echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
											}
										}
									?>
                                </select>
                            </div>
							
							<div class="form-group mb-2" style="display:none;" id="tier_plan">
                                <label class="fw-semibold  text-black">Select Registration Tier</label>
                                <select class="form-control" name="regi_tier"  id="regi_tier">
                                    <option value="">Select Registration Tier</option>
                                </select>
                            </div>
							
							<br/>
							
							<!--<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">CMS</label>
                            </div>
							
							<div class="form-group mb-2">
							    <div class="row">
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black">
										<input type="checkbox" class="about_us" name="view[]" value="1"> About Us
										
										<input type="checkbox" name="created[]" value="1" class="about_us"  style="display:none;">
										<input type="checkbox" name="edited[]" value="1"  class="about_us"  style="display:none;">
										<input type="checkbox" name="deleted[]" value="1" class="about_us"  style="display:none;">
										
										</label>
										<input type="checkbox" name="menu_id[]" value="1" id="about_us" style="display:none;">
										
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black">
										<input type="checkbox" class="privacy_policy" name="view[]" value="1"> Privacy Policy
										
										<input type="checkbox" name="created[]" value="1" class="privacy_policy"  style="display:none;">
										<input type="checkbox" name="edited[]"  value="1" class="privacy_policy"  style="display:none;">
										<input type="checkbox" name="deleted[]" value="1" class="privacy_policy"  style="display:none;">
										
										</label>
										<input type="checkbox" name="menu_id[]" value="2" id="privacy_policy" style="display:none;">
										
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black">
										<input type="checkbox" class="term_condition" name="view[]" value="1"> Term & Condition
										
										<input type="checkbox" name="created[]" value="1" class="term_condition"  style="display:none;">
										<input type="checkbox" name="edited[]" value="1"  class="term_condition"  style="display:none;">
										<input type="checkbox" name="deleted[]" value="1" class="term_condition"  style="display:none;">
										
										</label>
										<input type="checkbox" name="menu_id[]" value="3" id="term_condition" style="display:none;">
										
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" class="faq" name="view[]" value="1"> FAQ</label>
										<input type="checkbox" name="menu_id[]" value="4" id="faq" style="display:none;">
										
										<input type="checkbox" name="created[]" value="1" class="faq"  style="display:none;">
										<input type="checkbox" name="edited[]" value="1"  class="faq"  style="display:none;">
										<input type="checkbox" name="deleted[]" value="1" class="faq"  style="display:none;">
										
									</div>
								</div>
                            </div>--->
							<?php 
								if((in_array(5,$menuId)) && (in_array(6,$menuId))){
                                    $userManage = 'checked';
								}else{
                                    $userManage = '';
                                }
                            ?>
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">User Management  &nbsp; <input type="checkbox" name="userMng" id="userMng" style="width:14px;height:14px;" <?=@$userManage?>></label>
                            </div>
							
							<div class="container" style="margin: 0px 20px;">
								<div class="form-group mb-2">
									<label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">User Type</label>
									
									<div class="row">
									
									    <?php
											$userTypeData = DB::table('role_permission')->where(['menu_id' => 5])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($userTypeData)){
												
												if($userTypeData->view == 1){
													$userTypeDatalist = 'checked';
												}else{
													$userTypeDatalist = '';
												}
												
												if($userTypeData->created == 1){
													$userTypeDataAdd = 'checked';
												}else{
													$userTypeDataAdd = '';
												}
												
												if($userTypeData->edited == 1){
													$userTypeDataEdited = 'checked';
												}else{
													$userTypeDataEdited = '';
												}
												
												if($userTypeData->deleted == 1){
													$userTypeDatadeleted = 'checked';
												}else{
													$userTypeDatadeleted = '';
												}
												
												
											}else{
												$userTypeDatalist    = '';
												$userTypeDataAdd     = '';
												$userTypeDataEdited  = '';
												$userTypeDatadeleted = '';
											}
												
									    ?>
									
										<div class="col-md-3"> 
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="user_type1 userMng_menu" value="1" <?=@$userTypeDatalist?>> User type list</label>
											
											<input type="checkbox" name="menu_id[]" value="5" class="userMng_menu" id="user_type1" <?=((in_array(5,$menuId)) ? 'checked' : '')?> style="display:none;">
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="user_type1 userMng_menu" value="1" <?=@$userTypeDataAdd?> > Add User type</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="user_type1 userMng_menu" value="1" <?=@$userTypeDataEdited?>> Edit User type</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="user_type1 userMng_menu" value="1" <?=@$userTypeDatadeleted?>> Delete User type</label>
										</div>
										
									</div>
								</div>
                            </div>
							
							<div class="container" style="margin: 0px 20px;">
								<div class="form-group mb-2">
									<label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Users </label>
									<div class="row">
									    <?php
											$UsersData = DB::table('role_permission')->where(['menu_id' => 6])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($UsersData)){
												
												if($UsersData->view == 1){
													$UsersDatalist = 'checked';
												}else{
													$UsersDatalist = '';
												}
												
												if($UsersData->created == 1){
													$UsersDataAdd = 'checked';
												}else{
													$UsersDataAdd = '';
												}
												
												if($UsersData->edited == 1){
													$UsersDataEdited = 'checked';
												}else{
													$UsersDataEdited = '';
												}
												
												if($UsersData->deleted == 1){
													$UsersDatadeleted = 'checked';
												}else{
													$UsersDatadeleted = '';
												}
												
												
											}else{
												$UsersDatalist    = '';
												$UsersDataAdd     = '';
												$UsersDataEdited  = '';
												$UsersDatadeleted = '';
											}
												
									    ?>
										<div class="col-md-3"> 
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="users userMng_menu" value="1"  <?=@$UsersDatalist?>> User List</label>
											
											<input type="checkbox" name="menu_id[]" value="6" class="userMng_menu" id="users" <?=((in_array(6,$menuId)) ? 'checked' : '')?> style="display:none;">
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="users userMng_menu" value="1" <?=@$UsersDataAdd?>> Add User</label>
											
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="users userMng_menu" value="1" <?=@$UsersDataEdited?>> Edit User</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="users userMng_menu" value="1" <?=@$UsersDatadeleted?>> Delete User</label>
										</div>
									</div>
								</div>
                            </div>
							
                            <?php 
								if((in_array(7,$menuId)) && (in_array(8,$menuId))){
                                    $eventManage = 'checked';
								}else{
                                    $eventManage = '';
                                }
                            ?>

							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Event Management &nbsp; <input type="checkbox" name="eventMng" id="eventMng" style="width:14px;height:14px;" <?=@$eventManage?>></label>
                            </div>
							
							<div class="container" style="margin: 0px 20px;">
								<div class="form-group mb-2">
									<label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Event Category</label>
									<div class="row">
									    <?php
											$EventData = DB::table('role_permission')->where(['menu_id' => 7])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($EventData)){
												
												if($EventData->view == 1){
													$EventDatalist = 'checked';
												}else{
													$EventDatalist = '';
												}
												
												if($EventData->created == 1){
													$EventDataAdd = 'checked';
												}else{
													$EventDataAdd = '';
												}
												
												if($EventData->edited == 1){
													$EventDataEdited = 'checked';
												}else{
													$EventDataEdited = '';
												}
												
												if($EventData->deleted == 1){
													$EventDatadeleted = 'checked';
												}else{
													$EventDatadeleted = '';
												}
												
												
											}else{
												$EventDatalist    = '';
												$EventDataAdd     = '';
												$EventDataEdited  = '';
												$EventDatadeleted = '';
											}
												
									    ?>
										<div class="col-md-3"> 
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="event_category eventMng_menu" value="1" <?=@$EventDatalist?>> Event Category list</label>
											
											<input type="checkbox" name="menu_id[]" value="7" class="eventMng_menu" id="event_category"  <?=((in_array(7,$menuId)) ? 'checked' : '')?> style="display:none;">
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="event_category eventMng_menu" value="1" <?=@$EventDataAdd?>> Add Event Category</label>
										
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="event_category eventMng_menu" value="1" <?=@$EventDataEdited?>> Edit Event Category</label>
									
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="event_category eventMng_menu" value="1" <?=@$EventDatadeleted?>> Delete Event Category</label>
										</div>
									</div>
								</div>
                            </div>
							
							<div class="container" style="margin: 0px 20px;">
								<div class="form-group mb-2">
									<label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Event </label>
									<div class="row">
									
									    <?php
											$MaineventData = DB::table('role_permission')->where(['menu_id' => 8])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($MaineventData)){
												
												if($MaineventData->view == 1){
													$MaineventDatalist = 'checked';
												}else{
													$MaineventDatalist = '';
												}
												
												if($MaineventData->created == 1){
													$MaineventDataAdd = 'checked';
												}else{
													$MaineventDataAdd = '';
												}
												
												if($MaineventData->edited == 1){
													$MaineventDataEdited = 'checked';
												}else{
													$MaineventDataEdited = '';
												}
												
												if($MaineventData->deleted == 1){
													$MaineventDatadeleted = 'checked';
												}else{
													$MaineventDatadeleted = '';
												}
												
												
											}else{
												$MaineventDatalist    = '';
												$MaineventDataAdd     = '';
												$MaineventDataEdited  = '';
												$MaineventDatadeleted = '';
											}
												
									    ?>
										<div class="col-md-3"> 
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="event eventMng_menu" value="1" <?=@$MaineventDatalist?>> Event List</label>
											
											<input type="checkbox" name="menu_id[]" value="8" class="eventMng_menu" id="event" <?=((in_array(8,$menuId)) ? 'checked' : '')?> style="display:none;">
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="event eventMng_menu" value="1" <?=@$MaineventDataAdd?>> Add Event</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="event eventMng_menu" value="1" <?=@$MaineventDataEdited?>> Edit Event</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="event eventMng_menu" value="1" <?=@$MaineventDatadeleted?>> Delete Event</label>
										</div>
									</div>
								</div>
                            </div>
							
                            <?php 
								if((in_array(9,$menuId)) && (in_array(10,$menuId))){
                                    $listingManage = 'checked';
								}else{
                                    $listingManage = '';
                                }
                            ?>
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Listing Management &nbsp; <input type="checkbox" name="listingMng" id="listingMng" style="width:14px;height:14px;" <?=@$listingManage?>></label>
                            </div>
							
							<div class="container" style="margin: 0px 20px;">
								<div class="form-group mb-2">
									<label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Listing Category </label>
									<div class="row">
									    <?php
											$listCatData = DB::table('role_permission')->where(['menu_id' => 9])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($listCatData)){
												
												if($listCatData->view == 1){
													$listCatDatalist = 'checked';
												}else{
													$listCatDatalist = '';
												}
												
												if($listCatData->created == 1){
													$listCatDataAdd = 'checked';
												}else{
													$listCatDataAdd = '';
												}
												
												if($listCatData->edited == 1){
													$listCatDataEdited = 'checked';
												}else{
													$listCatDataEdited = '';
												}
												
												if($listCatData->deleted == 1){
													$listCatDatadeleted = 'checked';
												}else{
													$listCatDatadeleted = '';
												}
												
												
											}else{
												$listCatDatalist    = '';
												$listCatDataAdd     = '';
												$listCatDataEdited  = '';
												$listCatDatadeleted = '';
											}
												
									    ?>
										<div class="col-md-3"> 
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="category listingMng_menu" value="1" <?=@$listCatDatalist?>> Listing Category List</label>
											
											<input type="checkbox" name="menu_id[]" value="9" class="listingMng_menu" id="category" <?=((in_array(9,$menuId)) ? 'checked' : '')?> style="display:none;">
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="category listingMng_menu" value="1" <?=@$listCatDataAdd?>> Add Listing Category</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="category listingMng_menu" value="1" <?=@$listCatDataEdited?>> Edit Listing Category</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="category listingMng_menu" value="1" <?=@$listCatDatadeleted?>> Delete Listing Category</label>
										</div>
									</div>
								</div>
                            </div>
							
							<div class="container" style="margin: 0px 20px;">
								<div class="form-group mb-2">
									<label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Listing  </label>
									<div class="row">
									    <?php
											$listingData = DB::table('role_permission')->where(['menu_id' => 10])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($listingData)){
												
												if($listingData->view == 1){
													$listingDatalist = 'checked';
												}else{
													$listingDatalist = '';
												}
												
												if($listingData->created == 1){
													$listingDataAdd = 'checked';
												}else{
													$listingDataAdd = '';
												}
												
												if($listingData->edited == 1){
													$listingDataEdited = 'checked';
												}else{
													$listingDataEdited = '';
												}
												
												if($listingData->deleted == 1){
													$listingDatadeleted = 'checked';
												}else{
													$listingDatadeleted = '';
												}
												
												
											}else{
												$listingDatalist    = '';
												$listingDataAdd     = '';
												$listingDataEdited  = '';
												$listingDatadeleted = '';
											}
												
									    ?>
										<div class="col-md-3"> 
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="listing listingMng_menu" value="1" <?=@$listingDatalist?>> Listing List</label>
											
											<input type="checkbox" name="menu_id[]" value="10" class="listingMng_menu" id="listing" <?=((in_array(10,$menuId)) ? 'checked' : '')?> style="display:none;">
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="listing listingMng_menu" value="1" <?=@$listingDataAdd?>> Add Listing</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="listing listingMng_menu" value="1" <?=@$listingDataEdited?>> Edit Listing</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="listing listingMng_menu" value="1" <?=@$listingDatadeleted?>> Delete Listing</label>
										</div>
									</div>
								</div>
                            </div>
							
							<?php 
								if((in_array(20,$menuId)) && (in_array(21,$menuId)) && (in_array(22,$menuId))){
                                    $productManage = 'checked';
								}else{
                                    $productManage = '';
                                }
                            ?>
							
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Product Management &nbsp; <input type="checkbox" name="productMng" id="productMng" style="width:14px;height:14px;" <?=@$productManage?>></label>
                            </div>
							
							<div class="container" style="margin: 0px 20px;">
								<div class="form-group mb-2">
									<label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Product Category </label>
									<div class="row">
									
										<?php
										    $productChe = DB::table('role_permission')->where(['menu_id' => 20])->select('*')->orderBy('id', 'DESC')->first();
										?>
										<div class="col-md-3">
                                            <?php
											    if(!empty($productChe)){
													if($productChe->view == 1){
														$checkProductList = 'checked';
													}else{
														$checkProductList = '';
													}
												}else{
													$checkProductList = '';
												}
											?>										
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="pro_category productMng_menu" value="1" <?=@$checkProductList?>> Product Category List</label>
											
											<input type="checkbox" name="menu_id[]" value="20" class="productMng_menu" id="pro_category" <?=((in_array(20,$menuId)) ? 'checked' : '')?> style="display:none;">
										</div>
										
										<div class="col-md-3">
										    <?php
											    if(!empty($productChe)){
													if($productChe->created == 1){
														$checkProductAdd = 'checked';
													}else{
														$checkProductAdd = '';
													}
												}else{
													$checkProductAdd = '';
												}
											?>
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="pro_category productMng_menu" value="1" <?=@$checkProductAdd?>> Add Product Category</label>
										</div>
										
										<div class="col-md-3">
										    <?php
											    if(!empty($productChe)){
													if($productChe->edited == 1){
														$checkProductEdit = 'checked';
													}else{
														$checkProductEdit = '';
													}
												}else{
													$checkProductEdit = '';
												}
											?>
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="pro_category productMng_menu" value="1" <?=@$checkProductEdit?>> Edit Product Category</label>
										</div>
										
										<div class="col-md-3">
										    <?php
											    if(!empty($productChe)){
													if($productChe->deleted == 1){
														$checkProductDelete = 'checked';
													}else{
														$checkProductDelete = '';
													}
												}else{
													$checkProductDelete = '';
												}
											?>
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="pro_category productMng_menu" value="1" <?=@$checkProductDelete?>> Delete Product Category</label>
										</div>
										
										
									</div>
								</div>
                            </div>
							
							
							<div class="container" style="margin: 0px 20px;">
								<div class="form-group mb-2">
									<label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Product Subcategory  </label>
									<div class="row">
									    <?php
										    $productSub = DB::table('role_permission')->where(['menu_id' => 21])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($productSub)){
												
												if($productSub->view == 1){
													$productSublist = 'checked';
												}else{
													$productSublist = '';
												}
												
												if($productSub->created == 1){
													$productSubAdd = 'checked';
												}else{
													$productSubAdd = '';
												}
												
												if($productSub->edited == 1){
													$productSubEdited = 'checked';
												}else{
													$productSubEdited = '';
												}
												
												if($productSub->deleted == 1){
													$productSubdeleted = 'checked';
												}else{
													$productSubdeleted = '';
												}
												
												
											}else{
												$productSublist = '';
												$productSubAdd = '';
												$productSubEdited = '';
												$productSubdeleted = '';
											}
											
										?>
										<div class="col-md-3">
                                            										
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="pro_subcategory productMng_menu" value="1" <?=@$productSublist?>> Product Subcategory List</label>
											
											<input type="checkbox" name="menu_id[]" value="21" class="productMng_menu" id="pro_subcategory" <?=((in_array(21,$menuId)) ? 'checked' : '')?> style="display:none;">
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="pro_subcategory productMng_menu" value="1" <?=@$productSubAdd?>> Add Product Subcategory</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="pro_subcategory productMng_menu" value="1" <?=@$productSubEdited?>> Edit Product Subcategory</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="pro_subcategory listingMng_menu" value="1" <?=@$productSubdeleted?>> Delete Product Subcategory</label>
										</div>
									</div>
								</div>
                            </div>
							
							
							
							<div class="container" style="margin: 0px 20px;">
								<div class="form-group mb-2">
									<label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Product</label>
									<div class="row">
									
									    <?php
										    $productData = DB::table('role_permission')->where(['menu_id' => 22])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($productData)){
												
												if($productData->view == 1){
													$productDatalist = 'checked';
												}else{
													$productDatalist = '';
												}
												
												if($productData->created == 1){
													$productDataAdd = 'checked';
												}else{
													$productDataAdd = '';
												}
												
												if($productData->edited == 1){
													$productDataEdited = 'checked';
												}else{
													$productDataEdited = '';
												}
												
												if($productData->deleted == 1){
													$productDatadeleted = 'checked';
												}else{
													$productDatadeleted = '';
												}
												
												
											}else{
												$productDatalist = '';
												$productDataAdd = '';
												$productDataEdited = '';
												$productDatadeleted = '';
											}
											
										?>
										<div class="col-md-3"> 
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="product-1 productMng_menu" value="1" <?=@$productDatalist?>> Product List</label>
											
											<input type="checkbox" name="menu_id[]" value="22" class="productMng_menu" id="product-1" <?=((in_array(22,$menuId)) ? 'checked' : '')?> style="display:none;">
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="product-1 productMng_menu" value="1" <?=@$productDataAdd?>> Add Product</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="product-1 productMng_menu" value="1" <?=@$productDataEdited?>> Edit Product</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="product-1 listingMng_menu" value="1" <?=@$productDatadeleted?>> Delete Product</label>
										</div>
									</div>
								</div>
                            </div>
							
                            <?php 
								if((in_array(11,$menuId))){
                                    $discountManage = 'checked';
								}else{
                                    $discountManage = '';
                                }
                            ?>

							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Discount &nbsp; <input type="checkbox" name="discountMng" id="discountMng" style="width:14px;height:14px;" <?=@$discountManage?>></label>
                               
                            </div>
							
							<div class="form-group mb-2">
							    <div class="row">
								
								    <?php
										$DiscountData = DB::table('role_permission')->where(['menu_id' => 11])->select('*')->orderBy('id', 'DESC')->first();
										
										if(!empty($DiscountData)){
											
											if($DiscountData->view == 1){
												$DiscountDatalist = 'checked';
											}else{
												$DiscountDatalist = '';
											}
											
											if($DiscountData->created == 1){
												$DiscountDataAdd = 'checked';
											}else{
												$DiscountDataAdd = '';
											}
											
											if($DiscountData->edited == 1){
												$DiscountDataEdited = 'checked';
											}else{
												$DiscountDataEdited = '';
											}
											
											if($DiscountData->deleted == 1){
												$DiscountDatadeleted = 'checked';
											}else{
												$DiscountDatadeleted = '';
											}
											
											
										}else{
											$DiscountDatalist = '';
											$DiscountDataAdd = '';
											$DiscountDataEdited = '';
											$DiscountDatadeleted = '';
										}
											
									?>
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="discount discountMng_menu" value="1" <?=@$DiscountDatalist?>> Discount List</label>
										<input type="checkbox" name="menu_id[]" value="11" id="discount" class="discountMng_menu" <?=((in_array(11,$menuId)) ? 'checked' : '')?> style="display:none;">
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="discount discountMng_menu" value="1" <?=@$DiscountDataAdd?>> Add Discount</label>
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="discount discountMng_menu" value="1" <?=@$DiscountDataEdited?>> Edit Discount</label>
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="discount discountMng_menu" value="1" <?=@$DiscountDatadeleted?>> Delete Discount</label>
									</div>
								</div>
                            </div>
							
                            <?php 
								if((in_array(12,$menuId))){
                                    $subscriptionManage = 'checked';
								}else{
                                    $subscriptionManage = '';
                                }
                            ?>
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Subscription &nbsp; <input type="checkbox" name="subscriptionMng" id="subscriptionMng" style="width:14px;height:14px;" <?=@$subscriptionManage?>></label>
                               
                            </div>
							
							<div class="form-group mb-2">
							    <div class="row">
								    <?php
										$SubscriptionData = DB::table('role_permission')->where(['menu_id' => 12])->select('*')->orderBy('id', 'DESC')->first();
										
										if(!empty($SubscriptionData)){
											
											if($SubscriptionData->view == 1){
												$SubscriptionDatalist = 'checked';
											}else{
												$SubscriptionDatalist = '';
											}
											
											if($SubscriptionData->created == 1){
												$SubscriptionDataAdd = 'checked';
											}else{
												$SubscriptionDataAdd = '';
											}
											
											if($SubscriptionData->edited == 1){
												$SubscriptionDataEdited = 'checked';
											}else{
												$SubscriptionDataEdited = '';
											}
											
											if($SubscriptionData->deleted == 1){
												$SubscriptionDatadeleted = 'checked';
											}else{
												$SubscriptionDatadeleted = '';
											}
											
											
										}else{
											$SubscriptionDatalist = '';
											$SubscriptionDataAdd = '';
											$SubscriptionDataEdited = '';
											$SubscriptionDatadeleted = '';
										}
											
									?>
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="view[]"  class="subscription subscriptionMng_menu" value="1" <?=@$SubscriptionDatalist?>> Subscription List</label>
										
										<input type="checkbox" name="menu_id[]" value="12" id="subscription" class="subscriptionMng_menu" style="display:none;" <?=((in_array(12,$menuId)) ? 'checked' : '')?>>
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="subscription subscriptionMng_menu" value="1" <?=@$SubscriptionDataAdd?>> Add Subscription</label>
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="subscription subscriptionMng_menu" value="1" <?=@$SubscriptionDataEdited?>> Edit Subscription</label>
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="subscription subscriptionMng_menu" value="1" <?=@$SubscriptionDatadeleted?>> Delete Subscription</label>
									</div>
								</div>
                            </div>
           
							<?php 
								if((in_array(13,$menuId)) && (in_array(14,$menuId)) && (in_array(15,$menuId))){
                                    $promotionManage = 'checked';
								}else{
                                    $promotionManage = '';
                                }
                            ?>
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Promotion Management &nbsp; <input type="checkbox" name="promotionMng" id="promotionMng" style="width:14px;height:14px;" <?=@$promotionManage?>></label>
                            </div>
							<div class="container" style="margin: 0px 20px;">
							    <label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Promotion</label>
								<div class="form-group mb-2">
									<div class="row">
									    <?php
											$PromotionData = DB::table('role_permission')->where(['menu_id' => 13])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($PromotionData)){
												
												if($PromotionData->view == 1){
													$PromotionDatalist = 'checked';
												}else{
													$PromotionDatalist = '';
												}
												
												if($PromotionData->created == 1){
													$PromotionDataAdd = 'checked';
												}else{
													$PromotionDataAdd = '';
												}
												
												if($PromotionData->edited == 1){
													$PromotionDataEdited = 'checked';
												}else{
													$PromotionDataEdited = '';
												}
												
												if($PromotionData->deleted == 1){
													$PromotionDatadeleted = 'checked';
												}else{
													$PromotionDatadeleted = '';
												}
												
												
											}else{
												$PromotionDatalist = '';
												$PromotionDataAdd = '';
												$PromotionDataEdited = '';
												$PromotionDatadeleted = '';
											}
												
									    ?>
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]"  class="promotion promotionMng_menu" value="1" <?=@$PromotionDatalist?>> Promotion Ads List</label>
											
											<input type="checkbox" name="menu_id[]" value="13" id="promotion" class="promotionMng_menu" <?=((in_array(13,$menuId)) ? 'checked' : '')?> style="display:none;">
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="promotion promotionMng_menu" value="1" <?=@$PromotionDataAdd?>> Add Promotion Ads</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="promotion promotionMng_menu" value="1" <?=@$PromotionDataEdited?>> Edit Promotion Ads</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="promotion promotionMng_menu" value="1" <?=@$PromotionDatadeleted?>> Delete Promotion Ads</label>
										</div>
									</div>
								</div>
                            </div>
							
							
							<div class="container" style="margin: 0px 20px;">
							    <label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Category</label>
								<div class="form-group mb-2">
									<div class="row">
									
									    <?php
											$PromotionCategory = DB::table('role_permission')->where(['menu_id' => 14])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($PromotionCategory)){
												
												if($PromotionCategory->view == 1){
													$PromotionCategorylist = 'checked';
												}else{
													$PromotionCategorylist = '';
												}
												
												if($PromotionCategory->created == 1){
													$PromotionCategoryAdd = 'checked';
												}else{
													$PromotionCategoryAdd = '';
												}
												
												if($PromotionCategory->edited == 1){
													$PromotionCategoryEdited = 'checked';
												}else{
													$PromotionCategoryEdited = '';
												}
												
												if($PromotionCategory->deleted == 1){
													$PromotionCategorydeleted = 'checked';
												}else{
													$PromotionCategorydeleted = '';
												}
												
												
											}else{
												$PromotionCategorylist = '';
												$PromotionCategoryAdd = '';
												$PromotionCategoryEdited = '';
												$PromotionCategorydeleted = '';
											}
												
									    ?>
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]"  class="promotion_cat promotionMng_menu" value="1" <?=@$PromotionCategorylist?>> Category List</label>
											
											<input type="checkbox" name="menu_id[]" value="14" id="promotion_cat" class="promotionMng_menu" style="display:none;" <?=((in_array(14,$menuId)) ? 'checked' : '')?>>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="promotion_cat promotionMng_menu" value="1" <?=@$PromotionCategoryAdd?>> Add Category</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="promotion_cat promotionMng_menu" value="1" <?=@$PromotionCategoryEdited?>> Edit Category</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="promotion_cat promotionMng_menu" value="1" <?=@$PromotionCategorydeleted?>> Delete Category</label>
										</div>
									</div>
								</div>
                            </div>
							
							
							<div class="container" style="margin: 0px 20px;">
							    <label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Plan</label>
								<div class="form-group mb-2">
									<div class="row">
									    <?php
											$PromotionPlan = DB::table('role_permission')->where(['menu_id' => 15])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($PromotionPlan)){
												
												if($PromotionPlan->view == 1){
													$PromotionPlanlist = 'checked';
												}else{
													$PromotionPlanlist = '';
												}
												
												if($PromotionPlan->created == 1){
													$PromotionPlanAdd = 'checked';
												}else{
													$PromotionPlanAdd = '';
												}
												
												if($PromotionPlan->edited == 1){
													$PromotionPlanEdited = 'checked';
												}else{
													$PromotionPlanEdited = '';
												}
												
												if($PromotionPlan->deleted == 1){
													$PromotionPlandeleted = 'checked';
												}else{
													$PromotionPlandeleted = '';
												}
												
												
											}else{
												$PromotionPlanlist    = '';
												$PromotionPlanAdd     = '';
												$PromotionPlanEdited  = '';
												$PromotionPlandeleted = '';
											}
												
									    ?>
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]"  class="promotion_plan promotionMng_menu" value="1" <?=@$PromotionPlanlist?>> Plan List</label>
											
											<input type="checkbox" name="menu_id[]" value="15" id="promotion_plan" class="promotionMng_menu" style="display:none;" <?=((in_array(15,$menuId)) ? 'checked' : '')?>>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="promotion_plan promotionMng_menu" value="1" <?=@$PromotionPlanAdd?>> Add Plan</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="promotion_plan promotionMng_menu" value="1" <?=@$PromotionPlanEdited?>> Edit Plan</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="promotion_plan promotionMng_menu" value="1" <?=@$PromotionPlandeleted?>> Delete Plan</label>
										</div>
									</div>
								</div>
                            </div>
							
							<?php 
								if((in_array(16,$menuId))){
                                    $invitationManage = 'checked';
								}else{
                                    $invitationManage = '';
                                }
                            ?>
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Invitation Management &nbsp; <input type="checkbox" name="interestMng" id="interestMng" style="width:14px;height:14px;" <?=@$invitationManage?>></label>
                            </div>
							
							<div class="form-group mb-2">
							    <div class="row">
								        <?php
											$InvitationData = DB::table('role_permission')->where(['menu_id' => 16])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($InvitationData)){
												
												if($InvitationData->view == 1){
													$InvitationDatalist = 'checked';
												}else{
													$InvitationDatalist = '';
												}
												
												if($InvitationData->created == 1){
													$InvitationDataAdd = 'checked';
												}else{
													$InvitationDataAdd = '';
												}
												
												if($InvitationData->edited == 1){
													$InvitationDataEdited = 'checked';
												}else{
													$InvitationDataEdited = '';
												}
												
												if($InvitationData->deleted == 1){
													$InvitationDatadeleted = 'checked';
												}else{
													$InvitationDatadeleted = '';
												}
												
												
											}else{
												$InvitationDatalist    = '';
												$InvitationDataAdd     = '';
												$InvitationDataEdited  = '';
												$InvitationDatadeleted = '';
											}
												
									    ?>
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="view[]"  class="interest interestMng_menu" value="1" <?=@$InvitationDatalist?>> Invitation List</label>
										
										<input type="checkbox" name="menu_id[]" value="16" id="interest" class="interestMng_menu" <?=((in_array(16,$menuId)) ? 'checked' : '')?> style="display:none;">
									</div>
									
									<div class="col-md-3" style="display:none;">
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="created[]" class="interest interestMng_menu" value="1" <?=@$InvitationDataAdd?>> Add Invitation</label>
									</div>
									
									<div class="col-md-3" style="display:none;">
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="edited[]" class="interest interestMng_menu" value="1" <?=@$InvitationDataEdited?>> Edit Invitation</label>
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="interest interestMng_menu" value="1" <?=@$InvitationDatadeleted?>> Delete Invitation</label>
									</div>
								</div>
                            </div>
							
							<?php 
								if((in_array(17,$menuId))){
                                    $transactionManage = 'checked';
								}else{
                                    $transactionManage = '';
                                }
                            ?>
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Transaction Management &nbsp; <input type="checkbox" name="transactionMng" id="transactionMng" style="width:14px;height:14px;" <?=@$transactionManage?>></label>
                            </div>
							
							<div class="form-group mb-2">
							    <div class="row">
								        <?php
											$TransactionData = DB::table('role_permission')->where(['menu_id' => 17])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($TransactionData)){
												
												if($TransactionData->view == 1){
													$TransactionDatalist = 'checked';
												}else{
													$TransactionDatalist = '';
												}
												
												if($TransactionData->created == 1){
													$TransactionDataAdd = 'checked';
												}else{
													$TransactionDataAdd = '';
												}
												
												if($TransactionData->edited == 1){
													$TransactionDataEdited = 'checked';
												}else{
													$TransactionDataEdited = '';
												}
												
												if($TransactionData->deleted == 1){
													$TransactionDatadeleted = 'checked';
												}else{
													$TransactionDatadeleted = '';
												}
												
												
											}else{
												$TransactionDatalist    = '';
												$TransactionDataAdd     = '';
												$TransactionDataEdited  = '';
												$TransactionDatadeleted = '';
											}
												
									    ?>
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="view[]"  class="transaction transactionMng_menu" value="1" <?=@$TransactionDatalist?>> Transaction List</label>
										
										<input type="checkbox" name="menu_id[]" value="17" id="transaction" class="transactionMng_menu" <?=((in_array(17,$menuId)) ? 'checked' : '')?> style="display:none;">
									</div>
									
									<div class="col-md-3" style="display:none;">
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="created[]" class="transaction transactionMng_menu" value="1" <?=@$TransactionDataAdd?>> Add Transaction</label>
									</div>
									
									<div class="col-md-3" style="display:none;">
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="edited[]" class="transaction transactionMng_menu" value="1" <?=@$TransactionDataEdited?>> Edit Transaction</label>
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="transaction transactionMng_menu" value="1" <?=@$TransactionDatadeleted?>> Delete Transaction</label>
									</div>
								</div>
                            </div>
							
							<?php 
								if((in_array(18,$menuId))){
                                    $tagsManage = 'checked';
								}else{
                                    $tagsManage = '';
                                }
                            ?>
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Tags Management &nbsp; <input type="checkbox" name="tagsMng" id="tagsMng" style="width:14px;height:14px;" <?=@$tagsManage?>></label>
                            </div>
							
							<div class="form-group mb-2">
							    <div class="row">
								        <?php
											$TagsData = DB::table('role_permission')->where(['menu_id' => 18])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($TagsData)){
												
												if($TagsData->view == 1){
													$TagsDatalist = 'checked';
												}else{
													$TagsDatalist = '';
												}
												
												if($TagsData->created == 1){
													$TagsDataAdd = 'checked';
												}else{
													$TagsDataAdd = '';
												}
												
												if($TagsData->edited == 1){
													$TagsDataEdited = 'checked';
												}else{
													$TagsDataEdited = '';
												}
												
												if($TagsData->deleted == 1){
													$TagsDatadeleted = 'checked';
												}else{
													$TagsDatadeleted = '';
												}
												
												
											}else{
												$TagsDatalist    = '';
												$TagsDataAdd     = '';
												$TagsDataEdited  = '';
												$TagsDatadeleted = '';
											}
												
									    ?>
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="view[]"  class="tags tagsMng_menu" value="1" <?=@$TagsDatalist?>> Tags List</label>
										
										<input type="checkbox" name="menu_id[]" value="18" id="tags" class="tagsMng_menu" style="display:none;" <?=((in_array(18,$menuId)) ? 'checked' : '')?>>
									</div>
									
									<div class="col-md-3" >
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="created[]" class="tags tagsMng_menu" value="1" <?=@$TagsDataAdd?>> Add Tags</label>
									</div>
									
									<div class="col-md-3" >
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="edited[]" class="tags tagsMng_menu" value="1"  <?=@$TagsDataEdited?>> Edit Tags</label>
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="tags tagsMng_menu" value="1" <?=@$TagsDatadeleted?>> Delete Tags</label>
									</div>
								</div>
                            </div>
							
							
							<?php 
								if((in_array(19,$menuId))){
                                    $interestManage = 'checked';
								}else{
                                    $interestManage = '';
                                }
                            ?>
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Interest Management &nbsp; <input type="checkbox" name="inteMng" id="inteMng" style="width:14px;height:14px;" <?=@$interestManage?>></label>
                            </div>
							
							<div class="form-group mb-2">
							    <div class="row">
								        <?php
											$InterestData = DB::table('role_permission')->where(['menu_id' => 19])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($InterestData)){
												
												if($InterestData->view == 1){
													$InterestDatalist = 'checked';
												}else{
													$InterestDatalist = '';
												}
												
												if($InterestData->created == 1){
													$InterestDataAdd = 'checked';
												}else{
													$InterestDataAdd = '';
												}
												
												if($InterestData->edited == 1){
													$InterestDataEdited = 'checked';
												}else{
													$InterestDataEdited = '';
												}
												
												if($InterestData->deleted == 1){
													$InterestDatadeleted = 'checked';
												}else{
													$InterestDatadeleted = '';
												}
												
												
											}else{
												$InterestDatalist    = '';
												$InterestDataAdd     = '';
												$InterestDataEdited  = '';
												$InterestDatadeleted = '';
											}
												
									    ?>
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="view[]"  class="inte inteMng_menu" value="1" <?=@$InterestDatalist?>> Interest List</label>
										
										<input type="checkbox" name="menu_id[]" value="19" id="inte" class="inteMng_menu" style="display:none;" <?=((in_array(19,$menuId)) ? 'checked' : '')?>>
									</div>
									
									<div class="col-md-3" >
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="created[]" class="inte inteMng_menu" value="1" <?=@$InterestDataAdd?>> Add Interest</label>
									</div>
									
									<div class="col-md-3" >
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="edited[]" class="inte inteMng_menu" value="1" <?=@$InterestDataEdited?>> Edit Interest</label>
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="inte inteMng_menu" value="1" <?=@$InterestDatadeleted?>> Delete Interest</label>
									</div>
								</div>
                            </div>
							
							<?php 
								if((in_array(23,$menuId))){
                                    $messageManage = 'checked';
								}else{
                                    $messageManage = '';
                                }
                            ?>
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Message Management &nbsp; <input type="checkbox" name="messageMng" id="messageMng" style="width:14px;height:14px;" <?=@$messageManage?>></label>
                            </div>
							
							<div class="form-group mb-2">
							    <div class="row">
								    <?php
										$messageData = DB::table('role_permission')->where(['menu_id' => 23])->select('*')->orderBy('id', 'DESC')->first();
										
										if(!empty($messageData)){
											
											if($messageData->view == 1){
												$messageDatalist = 'checked';
											}else{
												$messageDatalist = '';
											}
											
											if($messageData->created == 1){
												$messageDataAdd = 'checked';
											}else{
												$messageDataAdd = '';
											}
											
											if($messageData->edited == 1){
												$messageDataEdited = 'checked';
											}else{
												$messageDataEdited = '';
											}
											
											if($messageData->deleted == 1){
												$messageDatadeleted = 'checked';
											}else{
												$messageDatadeleted = '';
											}
											
											
										}else{
											$messageDatalist    = '';
											$messageDataAdd     = '';
											$messageDataEdited  = '';
											$messageDatadeleted = '';
										}
											
									?>
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="view[]"  class="message messageMng_menu" value="1" <?=@$messageDatalist?>> Message List</label>
										<input type="checkbox" name="menu_id[]" value="23" id="message" class="messageMng_menu" style="display:none;" <?=((in_array(23,$menuId)) ? 'checked' : '')?>>
									</div>
									
									<div class="col-md-3" >
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="created[]" class="message messageMng_menu" value="1" <?=@$messageDataAdd?>> Add Message</label>
									</div>
									
									<div class="col-md-3" style="display:none;">
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="edited[]" class="message messageMng_menu" value="1" <?=@$messageDataEdited?>> Edit Message</label>
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="message messageMng_menu" value="1" <?=@$messageDatadeleted?>> Delete Message</label>
									</div>
								</div>
                            </div>
							
							
							<?php 
								if((in_array(24,$menuId)) && (in_array(25,$menuId))){
                                    $emailManage = 'checked';
								}else{
                                    $emailManage = '';
                                }
                            ?>
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Email Management &nbsp; <input type="checkbox" name="emailMng" id="emailMng" style="width:14px;height:14px;" <?=@$emailManage?>></label>
                            </div>
							
							<div class="container" style="margin: 0px 20px;">
								<div class="form-group mb-2">
									<label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Template Creation</label>
									<div class="row">
									    <?php
											$templateData = DB::table('role_permission')->where(['menu_id' => 24])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($templateData)){
												
												if($templateData->view == 1){
													$templateDatalist = 'checked';
												}else{
													$templateDatalist = '';
												}
												
												if($templateData->created == 1){
													$templateDataAdd = 'checked';
												}else{
													$templateDataAdd = '';
												}
												
												if($templateData->edited == 1){
													$templateDataEdited = 'checked';
												}else{
													$templateDataEdited = '';
												}
												
												if($templateData->deleted == 1){
													$templateDatadeleted = 'checked';
												}else{
													$templateDatadeleted = '';
												}
												
												
											}else{
												$templateDatalist    = '';
												$templateDataAdd     = '';
												$templateDataEdited  = '';
												$templateDatadeleted = '';
											}
												
									    ?>
										<div class="col-md-3"> 
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="template_creation emailMng_menu" value="1" <?=@$templateDatalist?>> Template list</label>
											<input type="checkbox" name="menu_id[]" value="24" class="emailMng_menu" id="template_creation" style="display:none;" <?=((in_array(24,$menuId)) ? 'checked' : '')?>>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="template_creation emailMng_menu" value="1" <?=@$templateDataAdd?>> Add Template</label>
										
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="template_creation emailMng_menu" value="1" <?=@$templateDataEdited?>> Edit Template</label>
									
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="template_creation emailMng_menu" value="1" <?=@$templateDatadeleted?>> Delete Template</label>
										</div>
									</div>
								</div>
                            </div>
							
							<div class="container" style="margin: 0px 20px;">
								<div class="form-group mb-2">
									<label class="fw-semibold1  text-black" style="font-size: 13px;font-weight: 700;">Mailer </label>
									<div class="row">
									    <?php
											$mailerData = DB::table('role_permission')->where(['menu_id' => 25])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($mailerData)){
												
												if($mailerData->view == 1){
													$mailerDatalist = 'checked';
												}else{
													$mailerDatalist = '';
												}
												
												if($mailerData->created == 1){
													$mailerDataAdd = 'checked';
												}else{
													$mailerDataAdd = '';
												}
												
												if($mailerData->edited == 1){
													$mailerDataEdited = 'checked';
												}else{
													$mailerDataEdited = '';
												}
												
												if($mailerData->deleted == 1){
													$mailerDatadeleted = 'checked';
												}else{
													$mailerDatadeleted = '';
												}
												
												
											}else{
												$mailerDatalist    = '';
												$mailerDataAdd     = '';
												$mailerDataEdited  = '';
												$mailerDatadeleted = '';
											}
												
									    ?>
										<div class="col-md-3"> 
											<label class="fw-semibold1  text-black"><input type="checkbox" name="view[]" class="mailer_creation emailMng_menu" value="1" <?=@$mailerDatalist?>> Mailer List</label>
											
											<input type="checkbox" name="menu_id[]" value="25" class="emailMng_menu" id="mailer_creation" style="display:none;" <?=((in_array(25,$menuId)) ? 'checked' : '')?>>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="created[]" class="mailer_creation emailMng_menu" value="1" <?=@$mailerDataAdd?>> Add Mailer</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="edited[]" class="mailer_creation emailMng_menu" value="1" <?=@$mailerDataEdited?>> Edit Mailer</label>
										</div>
										
										<div class="col-md-3">
											<label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="mailer_creation emailMng_menu" value="1" <?=@$mailerDatadeleted?>> Delete Mailer</label>
										</div>
									</div>
								</div>
                            </div>
							
							
							<?php 
								if((in_array(26,$menuId))){
                                    $payoutManage = 'checked';
								}else{
                                    $payoutManage = '';
                                }
                            ?>
							
							<br/>
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Payout Management &nbsp; <input type="checkbox" name="payoutMng" id="payoutMng" style="width:14px;height:14px;" <?=@$payoutManage?>></label>
                            </div>
							
							<div class="form-group mb-2">
							    <div class="row">
								        <?php
											$PayoutData = DB::table('role_permission')->where(['menu_id' => 26])->select('*')->orderBy('id', 'DESC')->first();
											
											if(!empty($PayoutData)){
												
												if($PayoutData->view == 1){
													$PayoutDatalist = 'checked';
												}else{
													$PayoutDatalist = '';
												}
												
												if($PayoutData->created == 1){
													$PayoutDataAdd = 'checked';
												}else{
													$PayoutDataAdd = '';
												}
												
												if($PayoutData->edited == 1){
													$PayoutDataEdited = 'checked';
												}else{
													$PayoutDataEdited = '';
												}
												
												if($PayoutData->deleted == 1){
													$PayoutDatadeleted = 'checked';
												}else{
													$PayoutDatadeleted = '';
												}
											}else{
												$PayoutDatalist    = '';
												$PayoutDataAdd     = '';
												$PayoutDataEdited  = '';
												$PayoutDatadeleted = '';
											}
												
									    ?>
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="view[]"  class="payout payoutMng_menu" value="1" <?=@$PayoutDatalist?>> Payout List</label>
										<input type="checkbox" name="menu_id[]" value="26" id="payout" class="payoutMng_menu" style="display:none;" <?=((in_array(26,$menuId)) ? 'checked' : '')?>>
									</div>
									
									<div class="col-md-3" >
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="created[]" class="payout payoutMng_menu" value="1" <?=@$PayoutDataAdd?>> Add Payout</label>
									</div>
									
									<div class="col-md-3" >
									    <label class="fw-semibold1  text-black" ><input type="checkbox" name="edited[]" class="payout payoutMng_menu" value="1" <?=@$PayoutDataEdited?>> Edit Payout</label>
									</div>
									
									<div class="col-md-3">
									    <label class="fw-semibold1  text-black"><input type="checkbox" name="deleted[]" class="payout payoutMng_menu" value="1" <?=@$PayoutDatadeleted?>> View Payout</label>
									</div>
								</div>
                            </div>
							
							
                            <div class="form-group mt-3 mb-2">
                                <button class="btn btn-success text-uppercase px-5 shadow">Submit</button>
                                <a class="btn btn-danger waves-effect waves-light m-l-30" href="javascript:history.go(-1)">Back</a>
                            </div>
                        </form>
                     </div>
                  </div>      
                </div>
            </div>
        </div>
     </section>
   </div>
 </div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Crop Image Before Upload</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="profile_closeModal();">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="img-container">
					<div class="row">
						<div class="col-md-8">
							<img src="" id="sample_image" />
						</div>
						<div class="col-md-4">
							<div class="preview"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="crop" class="btn btn-primary">Crop</button>
				<button type="button" class="btn btn-secondary" onclick="profile_closeModal();">Cancel</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Crop Image Before Upload</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cover_closeModal();">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="img-container">
					<div class="row">
						<div class="col-md-8">
							<img src="" id="sample_image1" />
						</div>
						<div class="col-md-4">
							<div class="preview1"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="crop1" class="btn btn-primary">Crop</button>
				<button type="button" class="btn btn-secondary" onclick="cover_closeModal();">Cancel</button>
			</div>
		</div>
	</div>
</div>
<link href='<?php echo url('assets/admin/chosen/chosen.min.css'); ?>' rel='stylesheet' type='text/css'>
<script src='<?php echo url('assets/admin/chosen/chosen.jquery.min.js'); ?>' type='text/javascript'></script> 
 <script>
    $(document).on('change','#user_type',function(e){
		var user_type = $(this).val();
		
		if(user_type == '1111'){
			$('#tier_plan').css('display', 'none');
		}else if(user_type == '0000'){
			$('#tier_plan').css('display', 'none');
		}else{
			$('#tier_plan').css('display', 'block');
		}
		
	});
	
    var owl_image_Arr = [];

    function preview_image(upload_type) {
        if(upload_type == 'upload'){
           var total_file = document.getElementById("upload_image").files.length;   
        }else{
           var total_file = owl_image_Arr.length;   
        }
        
        var owl_image = '';
        
        if(total_file==0){
           owl_image += '<div class="item">'+
                            '<img src="<?= url('dist/images/noimage.jpg') ?>" class="owl-img-fluid">'+
                        '</div>';   
        }else{
           for(var i=0;i<total_file;i++){
              if(upload_type == 'upload'){
                 //console.log(event.target.files[i].name);
                 owl_image_Arr.push(URL.createObjectURL(event.target.files[i]));
                 var image_src = URL.createObjectURL(event.target.files[i]);
              }else{
                 var image_src = owl_image_Arr[i];
              }
              
			owl_image += '<div class="item">'+
			'<img src="'+image_src+'" class="owl-img-fluid">'+
			'</div>';                        
           }
        }
        
        owl.trigger('replace.owl.carousel', [owl_image]);
        owl.trigger('refresh.owl.carousel');
   }
   

    //HANDLING CHECKOUT FORM
     $(document).on('submit', '#manage_deal_form', function(e){
         e.preventDefault();
         var from = $("input[name=deal_start_date]").val(); 
         var to =$("input[name=deal_end_date]").val(); 

                if(Date.parse(from) > Date.parse(to)){
                    var errorRspnsArr = ["Deal End Date must be greater than Start Date!",'error','#DD6B55'];
                        alert_func(errorRspnsArr);
                    return false;
                }
         var deal_normal_price = parseFloat($('[name=deal_normal_price]').val());
         if(deal_normal_price == 0.00){
          var errorRspnsArr = ["Deal normal price must be greater than 0!",'error','#DD6B55'];
            alert_func(errorRspnsArr);
          return false;
         }
        var deal_price = parseFloat($('[name=deal_price]').val());
        if(deal_normal_price < deal_price){
          var errorRspnsArr = ["Deal normal price must be greater than deal price!",'error','#DD6B55'];
            alert_func(errorRspnsArr);
          return false;
        }

         var textareaContent = $('.summernote').summernote('code');
         var compareEmptyContentFirstCase =strcmp(textareaContent,'<ul><li><br></li></ul>');
         var compareEmptyContentSecondCase =strcmp(textareaContent,'<p><br></p>');

         if(compareEmptyContentFirstCase == 1 || compareEmptyContentSecondCase == 1 || textareaContent.length == 0){
            var errorRspnsArr = ["Deal Details can't be empty!",'error','#DD6B55'];
            alert_func(errorRspnsArr);
            return false;
         }else{

             //Throwing ajax request in server 
             $.ajax({
              url: adminUrl+'deals/create',
              method:'POST',
              data: new FormData(this),
              contentType:false,
              processData:false,
              beforeSend: function() {
                 
              },
              success:function(resposeData){
                 var data = JSON.parse(resposeData);
                 //console.log(data);
                 if(data.check == 'success'){
                   var responseArr = [data.msg,'success','#A5DC86'];
                   //var redirectURL = adminUrl+'vendors/edit/'+data.vendorId;    
                   var redirectURL = adminUrl+'deals/lists';
                   alert_response(responseArr,redirectURL);
                   return true; 
                 }else{
                    var responseArr = [data.msg,'error','#DD6B55'];
                    //var redirectURL = adminUrl+'vendors/edit/'+data.vendorId;
                    var redirectURL = adminUrl+'deals/lists';   
                    alert_response(responseArr,redirectURL);
                    return false;
                 }
              }
            });
         }    
    });
$(document).ready(function(){
	$("#submitform").on('submit', function(e){
		e.preventDefault();
		var form_data = new FormData(); 	
		//var profile_image = $("#upload_image").prop("files")[0]; 
		
		var fname = $('#fname').val(); 
		var lname = $('#lname').val(); 
		var email = $('#email').val();
		var status = $('#userstatus').val();
		var phone = $('#phone').val();
		var address = $('#autocomplete').val();
		var latitude = $('#latitude').val(); 
		var longitude = $('#longitude').val(); 
		var confirm_password = $('#confirm_password').val(); 
		var password = $('#password').val(); 
		var sportid = $('#sport').val(); 
		var guardian = $('#guardian').val(); 
		var profileImg = $('#profileImg').val(); 
		var coverImg = $('#coverImg').val(); 
		var country = $('#country').val(); 
		var state = $('#state').val(); 
		var city = $('#city').val(); 
		var pincode = $('#pincode').val(); 
		
		form_data.append("coverImg", coverImg);
		//form_data.append("profile_image", profile_image);
		form_data.append("fname", fname);
		form_data.append("lname", lname);
		form_data.append("email", email);
		form_data.append("status", status);
		form_data.append("phone", phone);
		form_data.append("address", address);
		form_data.append("latitude", latitude);
		form_data.append("longitude", longitude);
		form_data.append("country", country);
		form_data.append("state", state);
		form_data.append("city", city);
		form_data.append("pincode", pincode);
		form_data.append("password", password);
		form_data.append("confirm_password", confirm_password);
		form_data.append("sport_id", sportid);
		form_data.append("guardian", guardian);
		form_data.append("profileImg", profileImg);
		$.ajax({
		type: 'POST',
		url: '<?php echo url('admin/users/addIndividuals'); ?>',
		data: form_data,
		dataType:"json",
		contentType: false,
		cache: false,
		processData:false,
		error:function(){
		  $('#uploadsuccessfully').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
		},
		success: function(data){
			if(data.status == 1){
				swal({title: "Sucess!", text: "<strong>"+data.message+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('admin/individuals-players')?>"});
				$("#upload_image").va(''); 
				$('#fname').val(''); 
				$('#lname').val(''); 
				$('#email').val('');
				$('#phone').val('');
				$('#autocomplete').val('');
				$('#latitude').val(''); 
				$('#longitude').val(''); 
			}
			if(data.status == 0){
				swal({title: "Fail!", text: "<strong>"+data.message+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
			if(data.vali_error == 1){
				if(data.pass_error != ''){
					$('#pass_error').html(data.pass_error);
				}else{
					$('#pass_error').html('');
				}
				
				if(data.cnfpass_error != ''){
					$('#cnfpass_error').html(data.cnfpass_error);
				}else{
					$('#cnfpass_error').html('');
				}
				
				if(data.email_error != ''){
					$('#email_error').html(data.email_error);
				}else{
					$('#email_error').html('');
				}
				
			}
		}
		});
	});

});


 $(document).on('keyup','#fname',function(e){
        var fname = $(this).val();
        
        if(fname){
          $("#first_name").text(fname);
          $("#f-name").text(fname);
        }else{
         
          $("#first_name").text('First Name');
        }
    });
	 $(document).on('keyup','#lname',function(e){
        var lname = $(this).val();
        
        if(lname){
          $("#last_name").text(lname);
          $("#l-name").text(lname);
        }else{
         
          $("#last_name").text('Last Name');
        }
    });
	
	$(document).on('keyup','#email',function(e){
        var email = $(this).val();
        
        if(email){
          $("#individual_email").text(email);
        }else{
         
          $("#individual_email").text('Email');
        }
    });
	
	$(document).on('keyup','#phone',function(e){
        var phone = $(this).val();
        
        if(phone){
          $("#individual_phone").text(phone);
        }else{
         
          $("#individual_phone").text('phone');
        }
    });
	
	$(document).on('change','#user_type',function(e){
		var user_type = $(this).val();
		$.ajax({
			type: 'POST',
			url: '<?php echo url('admin/access-management/get_tier'); ?>',
			data: {user_type : user_type, "_token": "{{ csrf_token() }}"},
			success: function(data){
			    $("#regi_tier").html(data);
			}
		});
	});
	
	
	
	$(document).on('keyup','#country',function(e){
		var country = $(this).val();
		if(country){
		    $("#individual_country").text(country);
		}else{
		    $("#individual_country").text('country');
		}
	});

	$(document).on('keyup','#state',function(e){
		var state = $(this).val();
		if(state){
		    $("#individual_state").text(state);
		}else{
		    $("#individual_state").text('state');
		}
	});

	$(document).on('keyup','#city',function(e){
		var city = $(this).val();
		if(city){
		    $("#individual_city").text(city);
		}else{
		   $("#individual_city").text('city');
		}
	});

	$(document).on('keyup','#pincode',function(e){
		var zipcode = $(this).val();
		if(zipcode){
		    $("#individual_zipcode").text(zipcode);
		}else{
		    $("#individual_zipcode").text('zipcode');
		}
	});

	$(document).on('keyup','#autocomplete',function(e){
		var autocomplete = $(this).val();
		if(autocomplete){
		    $("#individual_address").text(autocomplete);
		}else{
		    $("#individual_address").text('Address');
		}
	});
	

	
upload_image.onchange = evt => {
const [file] = upload_image.files
if (file) {
blah.src = URL.createObjectURL(file)
}
}

 </script> 
 <script src="<?= url('assets/admin/plugins/smt-img-upld/js/singleimage-uploader.js')?>"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places"></script>
  <script>
	// $(document).ready(function() {
	// $("#lat_area").addClass("d-none");
	// $("#long_area").addClass("d-none");
	// });
	// google.maps.event.addDomListener(window, 'load', initialize);
	// function initialize() {
	// var input = document.getElementById('autocomplete');

	// var autocomplete = new google.maps.places.Autocomplete(input);
	// autocomplete.addListener('place_changed', function() {
	// var place = autocomplete.getPlace();
	// var address = place.formatted_address;
	// $("#individual_address").text(address);
	// $('#latitude').val(place.geometry['location'].lat());
	// $('#longitude').val(place.geometry['location'].lng());
	// // --------- show lat and long ---------------
	// $("#lat_area").removeClass("d-none");
	// $("#long_area").removeClass("d-none");
	// });
	// }
</script>

<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('autocomplete'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
			$('#latitude').val(place.geometry['location'].lat());
			$('#longitude').val(place.geometry['location'].lng());
            var latlng = new google.maps.LatLng(latitude, longitude);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var address = results[0].formatted_address;
                        var pin = results[0].address_components[results[0].address_components.length - 1].long_name;
                        var country = results[0].address_components[results[0].address_components.length - 2].long_name;
                        var state = results[0].address_components[results[0].address_components.length - 3].long_name;
                        var city = results[0].address_components[results[0].address_components.length - 4].long_name;
                        document.getElementById('country').value = country;
                        document.getElementById('state').value = state;
                        document.getElementById('city').value = city;
                        document.getElementById('pincode').value = pin;
						$("#individual_address").text(address);
						$("#individual_country").text(country);
						$("#individual_state").text(state);
						$("#individual_city").text(city);
						$("#individual_zipcode").text(pin);
                    }
                }
            });
        });
    });
</script>
<script>

$(document).ready(function(){

	var $modal = $('#modal');

	var image = document.getElementById('sample_image');

	var cropper;

	$('#upload_image').change(function(event){
		var files = event.target.files;

		var done = function(url){
			image.src = url;
			$modal.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 1,
            minCanvasWidth: 50,
            minCanvasHeight: 50,
            minCropBoxWidth: 50,
            minCropBoxHeight: 50,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:400,
			height:400
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				$.ajax({
					url:'<?php echo url("admin/users/cropImage")?>',
					method:'POST',
					data:{image:base64data, "_token": "{{ csrf_token() }}"},
					success:function(data)
					{
						$modal.modal('hide');
						console.log(data)
						$('#item img').attr('src', '<?php echo url('profile/'); ?>/' + data);
						$('#profileImg').val(data);
					}
				});
			};
		});
	});
	
});
</script>
<script>

$(document).ready(function(){

	var $modal = $('#modal1');

	var image = document.getElementById('sample_image1');

	var cropper;

	$('#cover_image').change(function(event){
		var files = event.target.files;

		var done = function(url){
			image.src = url;
			$modal.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			// aspectRatio: 1,
			// viewMode: 1,
            // minCanvasWidth: 50,
            // minCanvasHeight: 50,
            // minCropBoxWidth: 50,
            // minCropBoxHeight: 50,
			// preview:'.preview1'
			
			minCropBoxWidth: 400,
			 minCropBoxHeight: 280,
			 minCropBoxWidth: 400,
			 minCropBoxHeight: 280,
			 preview:'.preview1',
			
			//dragMode: 'move',
			//autoCropArea: 0.65,
			//restore: false,
			//guides: false,
			//center: false,
			viewMode: 2,
			//aspectRatio: 85 / 60,
			highlight: true,
			cropBoxMovable: true,
			cropBoxResizable: true,
			toggleDragModeOnDblclick: false,
			data:{ //define cropbox size
			width: 500,
			height:  350,
			},
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop1').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:400,
			height:400
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				$.ajax({
					url:'<?php echo url("admin/users/crop_CoverImage")?>',
					method:'POST',
					data:{image:base64data},
					success:function(data)
					{
						$modal.modal('hide');
						console.log(data)
						$('#Cover-Image img').attr('src', '<?php echo url('uploads/cover_image/'); ?>/' + data);
						$('#coverImg').val(data);
					}
				});
			};
		});
	});
	
});

function profile_closeModal(){
	$('#modal').modal('hide');
}
function cover_closeModal(){
	$('#modal1').modal('hide');
}

$(document).ready(function() {
  $(".subscription").click(function() {
    $("#subscription").prop("checked", this.checked);
  });
});

$('.subscription').change(function () {
	if ($('.subscription:checked').length > 0){
	    $('#subscription').prop('checked',true);
	}
	else {
	    $('#subscription').prop('checked',false);
	}
});

$('.discount').change(function () {
	if ($('.discount:checked').length > 0){
	    $('#discount').prop('checked',true);
	}
	else {
	    $('#discount').prop('checked',false);
	}
});

$('.listing').change(function () {
	if ($('.listing:checked').length > 0){
	    $('#listing').prop('checked',true);
	}
	else {
	    $('#listing').prop('checked',false);
	}
});

$('.category').change(function () {
	if ($('.category:checked').length > 0){
	    $('#category').prop('checked',true);
	}
	else {
	    $('#category').prop('checked',false);
	}
});

$('.event').change(function () {
	if ($('.event:checked').length > 0){
	    $('#event').prop('checked',true);
	}
	else {
	    $('#event').prop('checked',false);
	}
});

$('.event_category').change(function () {
	if ($('.event_category:checked').length > 0){
	    $('#event_category').prop('checked',true);
	}
	else {
	    $('#event_category').prop('checked',false);
	}
});

$('.users').change(function () {
	if ($('.users:checked').length > 0){
	    $('#users').prop('checked',true);
	}
	else {
	    $('#users').prop('checked',false);
	}
});

$('.user_type1').change(function () {
	if ($('.user_type1:checked').length > 0){
	    $('#user_type1').prop('checked',true);
	}
	else {
	    $('#user_type1').prop('checked',false);
	}
});

$('.about_us').change(function () {
	if ($('.about_us:checked').length > 0){
	    $('#about_us').prop('checked',true);
	}
	else {
	    $('#about_us').prop('checked',false);
	}
});

$('.privacy_policy').change(function () {
	if ($('.privacy_policy:checked').length > 0){
	    $('#privacy_policy').prop('checked',true);
	}
	else {
	    $('#privacy_policy').prop('checked',false);
	}
});

$('.term_condition').change(function () {
	if ($('.term_condition:checked').length > 0){
	    $('#term_condition').prop('checked',true);
	}
	else {
	    $('#term_condition').prop('checked',false);
	}
});

$('.faq').change(function () {
	if ($('.faq:checked').length > 0){
	    $('#faq').prop('checked',true);
	}
	else {
	    $('#faq').prop('checked',false);
	}
});

$('.promotion').change(function () {
	if ($('.promotion:checked').length > 0){
	    $('#promotion').prop('checked',true);
	}
	else {
	    $('#promotion').prop('checked',false);
	}
});

$('.interest').change(function () {
	if ($('.interest:checked').length > 0){
	    $('#interest').prop('checked',true);
	}
	else {
	    $('#interest').prop('checked',false);
	}
});

$('.transaction').change(function () {
	if ($('.transaction:checked').length > 0){
	    $('#transaction').prop('checked',true);
	}
	else {
	    $('#transaction').prop('checked',false);
	}
});


$('.tags').change(function () {
	if ($('.tags:checked').length > 0){
	    $('#tags').prop('checked',true);
	}
	else {
	    $('#tags').prop('checked',false);
	}
});


$('.message').change(function () {
	if ($('.message:checked').length > 0){
	    $('#message').prop('checked',true);
	}
	else {
	    $('#message').prop('checked',false);
	}
});

$('.template_creation').change(function () {
	if ($('.template_creation:checked').length > 0){
	    $('#template_creation').prop('checked',true);
	}
	else {
	    $('#template_creation').prop('checked',false);
	}
});


$('.mailer_creation').change(function () {
	if ($('.mailer_creation:checked').length > 0){
	    $('#mailer_creation').prop('checked',true);
	}
	else {
	    $('#mailer_creation').prop('checked',false);
	}
});


$('.inte').change(function () {
	if ($('.inte:checked').length > 0){
	    $('#inte').prop('checked',true);
	}
	else {
	    $('#inte').prop('checked',false);
	}
});



$('.promotion_cat').change(function () {
	if ($('.promotion_cat:checked').length > 0){
	    $('#promotion_cat').prop('checked',true);
	}
	else {
	    $('#promotion_cat').prop('checked',false);
	}
});

$('.promotion_plan').change(function () {
	if ($('.promotion_plan:checked').length > 0){
	    $('#promotion_plan').prop('checked',true);
	}
	else {
	    $('#promotion_plan').prop('checked',false);
	}
});


$('.pro_category').change(function () {
	if ($('.pro_category:checked').length > 0){
	    $('#pro_category').prop('checked',true);
	}
	else {
	    $('#pro_category').prop('checked',false);
	}
});

$('.pro_subcategory').change(function () {
	if ($('.pro_subcategory:checked').length > 0){
	    $('#pro_subcategory').prop('checked',true);
	}
	else {
	    $('#pro_subcategory').prop('checked',false);
	}
});


$('.product-1').change(function () {
	if ($('.product-1:checked').length > 0){
	    $('#product-1').prop('checked',true);
	}
	else {
	    $('#product-1').prop('checked',false);
	}
});


$('.payout').change(function () {
	if ($('.payout:checked').length > 0){
	    $('#payout').prop('checked',true);
	}
	else {
	    $('#payout').prop('checked',false);
	}
});



$(document).ready(function() {
    $("#userMng").change(function() {
        if (this.checked) {
            $(".userMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".userMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".userMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".userMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#userMng").prop("checked", true);
            }     
        }
        else {
            $("#userMng").prop("checked", false);
        }
    });
	
	
	
	$("#eventMng").change(function() {
        if (this.checked) {
            $(".eventMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".eventMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".eventMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".eventMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#eventMng").prop("checked", true);
            }     
        }
        else {
            $("#eventMng").prop("checked", false);
        }
    });
	
	$("#listingMng").change(function() {
        if (this.checked) {
            $(".listingMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".listingMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".listingMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".listingMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#listingMng").prop("checked", true);
            }     
        }
        else {
            $("#listingMng").prop("checked", false);
        }
    });
	
	
	$("#discountMng").change(function() {
        if (this.checked) {
            $(".discountMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".discountMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".discountMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".discountMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#discountMng").prop("checked", true);
            }     
        }
        else {
            $("#discountMng").prop("checked", false);
        }
    });
	
	$("#subscriptionMng").change(function() {
        if (this.checked) {
            $(".subscriptionMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".subscriptionMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".subscriptionMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".subscriptionMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#subscriptionMng").prop("checked", true);
            }     
        }
        else {
            $("#subscriptionMng").prop("checked", false);
        }
    });
	
	
	$("#promotionMng").change(function() {
        if (this.checked) {
            $(".promotionMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".promotionMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".promotionMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".promotionMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#promotionMng").prop("checked", true);
            }     
        }
        else {
            $("#promotionMng").prop("checked", false);
        }
    });
	
	
	$("#interestMng").change(function() {
        if (this.checked) {
            $(".interestMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".interestMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".interestMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".interestMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#interestMng").prop("checked", true);
            }     
        }
        else {
            $("#interestMng").prop("checked", false);
        }
    });
	
	$("#transactionMng").change(function() {
        if (this.checked) {
            $(".transactionMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".transactionMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".transactionMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".transactionMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#transactionMng").prop("checked", true);
            }     
        }
        else {
            $("#transactionMng").prop("checked", false);
        }
    });
	
	
	
	$("#tagsMng").change(function() {
        if (this.checked) {
            $(".tagsMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".tagsMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".tagsMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".tagsMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#tagsMng").prop("checked", true);
            }     
        }
        else {
            $("#tagsMng").prop("checked", false);
        }
    });
	
	
	$("#inteMng").change(function() {
        if (this.checked) {
            $(".inteMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".inteMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".inteMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".inteMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#inteMng").prop("checked", true);
            }     
        }
        else {
            $("#inteMng").prop("checked", false);
        }
    });
});

$("#messageMng").change(function() {
        if (this.checked) {
            $(".messageMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".messageMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".messageMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".messageMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#messageMng").prop("checked", true);
            }     
        }
        else {
            $("#messageMng").prop("checked", false);
        }
    });
	
	
	$("#emailMng").change(function() {
        if (this.checked) {
            $(".emailMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".emailMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".emailMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".emailMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#emailMng").prop("checked", true);
            }     
        }
        else {
            $("#emailMng").prop("checked", false);
        }
    });
	
	$("#payoutMng").change(function() {
        if (this.checked) {
            $(".payoutMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".payoutMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".payoutMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".payoutMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#payoutMng").prop("checked", true);
            }     
        }
        else {
            $("#payoutMng").prop("checked", false);
        }
    });
});
</script>
@include('admin.footer');