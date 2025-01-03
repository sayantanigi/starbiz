
@include('admin.header');
@include('admin.sidebar');

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
#progressbar li {
    width: 33% !important;
}


/* input type file */

.files input {
    outline: 2px dashed #92b0b3 !important;
    outline-offset: -10px !important;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear !important;
    transition: outline-offset .15s ease-in-out, background-color .15s linear !important;
    /*padding: 120px 0px 85px 35%;*/
	padding: 52px 0px 46px 32% !important;
    text-align: center !important;
    margin: 0 !important;
    width: 100% !important;
}
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px !important;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear !important;
    transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3 !important;
 }
.files{ position:relative}
.files:after {  pointer-events: none !important;
    position: absolute !important;
    top: 60px !important;
    left: 0 !important;
    width: 50px !important;
    right: 0 !important;
    height: 56px !important;
    content: "" !important;
    background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png) !important;
    display: block !important;
    margin: 0 auto !important;
    background-size: 100% !important;
    background-repeat: no-repeat !important;
}
.color input{ background-color:#f1f1f1;}
.files:before {
    position: absolute !important;
    bottom: 10px !important;
    left: 0;  pointer-events: none !important;
    width: 100% !important;
    right: 0 !important;
    height: 57px !important;
    /*content: " or drag it here. ";*/
    display: block !important;
    margin: 0 auto !important;
    color: #2ea591 !important;
    font-weight: 600 !important;
    text-transform: capitalize !important;
    text-align: center !important;
}

/*Crop*/
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

.preview2 {
	overflow: hidden;
	height: 160px;
	margin: 10px;
	border: 1px solid red;
}	width: 160px; 


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

.uploadedimg {
    display: inline-block;
    vertical-align: top;
    position: relative;
    margin-right: 5px;
    margin-bottom: 5px;
}
.uploadedimg img {
    border-radius: 5px;
}
.uploadedimg img {
    width: 90px;
    height: 90px;
    object-fit: cover;
}
.closeimg {
    position: absolute;
    right: 2px;
    top: 2px;
    width: 24px;
    height: 24px;
    line-height: 24px;
    text-align: center;
    border-radius: 50%;
    background: #fff;
    z-index: 1;
}

.chosen-choices{
	height: 44px !important;
	top: 2px !important;
}
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
                            <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
                    </div>
                </div>
            </div>
           </div>
            <div class="row">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center p-20 mt-3 mb-2">
                            <div class="card p-4">
                                <h2 id="heading"><?= $title ?></h2>
                                <p>Fill all form field to go to next step</p>
                                <form id="msform" action="" method="POST" enctype="multipart/form-data" >
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active " id="account">
                                            <a href="#" id="account1"> <div class="progressIcon"><i class="fa fa-user"></i></div>
                                            <strong>Event Info</strong></a>
                                        </li>
										
                                        <!--<li id="academics" class="<?php echo !empty($academics) ? 'active' : ''; ?>">
                                           <a href="#" id="academics1"> <div class="progressIcon"><i class="fa fa-graduation-cap"></i></div>
                                            <strong>Event Ticket</strong></a>
                                        </li>-->
										
                                        <li id="athletics" class="<?php echo !empty($athletics) ? 'active' : ''; ?>">
                                          <a href="#">  <div class="progressIcon"><i class="fa fa-futbol"></i></div>
                                            <strong>Location</strong></a>
                                        </li>
										
                                        <li id="exprience" class="<?php echo !empty($exprience) ? 'active' : ''; ?>">
                                           <a href="#"> <div class="progressIcon"><i class="fa fa-briefcase"></i></div>
                                            <strong>Event Photos</strong></a>
                                        </li>
										
                                        <!--<li id="reference" class="<?php echo !empty($reference) ? 'active' : ''; ?>">
                                            <a href="#"><div class="progressIcon"><i class="fa fa-bullhorn"></i></div>
                                            <strong>Reference</strong></a>
                                        </li>
										
										<li id="guardian" class="<?php echo !empty($guardian) ? 'active' : ''; ?>">
                                            <a href="#"><div class="progressIcon"><i class="fa fa-users"></i></div>
                                            <strong>Guardian</strong></a>
                                        </li>-->
                                    </ul>
                                    
                                    <fieldset id="step_1" class="<?php echo !empty($profile) ? 'pro-Info' : 'pro-Info'; ?>">
                                        <div class="form-card">
                                            <div class=" pt-3">
                                                <h3 class="text-uppercase text-center h4 fw-bold mb-3">Event Info</h3>
                                                <div class="row">
												   <!--<div class="mb-2 col-lg-6">
													   <div class="container">
															<div class="col-md-5">
																<div class="profile clearfix" >                            
																	<div class="image item" id="teamCover-Img">
																		<img src="<?=!empty(@$team[0]->teamcover_image) ? url('uploads/team_image/'.@$team[0]->teamcover_image.'') : url('profile/bnr.jpg'); ?>" class="img-cover" style="width: 100%;object-fit: contain;background-color: #eee;height: auto;" id="blah2">
																	</div>    
																		
																	
																</div>
															</div>
														</div>
													</div>-->
													
													<!--<div class="mb-2 col-lg-6">
													   <div class="container">
															<div class="col-md-5">
																<div class="profile clearfix" >                            
																	<div class="image item" id="teamCover-Img">
																		<img src="<?=!empty(@$team[0]->teamcover_image) ? url('uploads/team_image/'.@$team[0]->teamcover_image.'') : url('profile/bnr.jpg'); ?>" class="img-cover" style="width: 100%;object-fit: contain;background-color: #eee;height: auto;" id="blah1">
																	</div>    
																		
																	
																</div>
															</div>
														</div>
													</div>--->
													
													
													
								
													
													<!--<div class="mb-2 col-lg-6 files">
														<label >Select Background Banner</label>
														<input type="file" class="form-control" name="bck_image"  id="bck_image" >
														<input type="hidden" class="form-control" name="eventId"  id="eventId" >
														
														<span id="error_teamImg" class="text-danger"></span>
													</div>
														
													<div class="mb-2 col-lg-6 files">
														<label >Select Add Center Image</label>
														<input type="file" class="form-control" name="frt_image"  id="frt_image" >
														
														<span id="error_teamcoverImg" class="text-danger"></span>
													</div>-->
													
                                                    <div class="mb-2 col-lg-12">
                                                        <label>Event Name</label>
                                                        <input type="text" class="form-control" name="event_name" id="event_name" value=""> 
														<input type="hidden" class="form-control" name="eventId"  id="eventId" >
														<span id="error_event_name" class="text-danger"></span>
                                                    </div> 
													
													<div class="mb-2 col-lg-12">
                                                        <label>Description</label>
                                                        <textarea class="form-control " name="event_description" id="event_description"></textarea>
														<span id="error_event_description" class="text-danger"></span>
                                                    </div> 
													
                                                    <div class="mb-2 col-lg-12">
                                                        <label>Event Category</label>
                                                        <select class="form-control" name="event_category" id="event_category">
														    <?php
															    if(!empty(@$cat)){
																	foreach(@$cat as $k => $v){
																		echo '
																			<option value="'.@$v->id.'">'.@$v->name.'</option>
																		';
																	}
																}
															?>
														    
														</select>
														<span id="error_event_category" class="text-danger"></span>
                                                    </div> 
													
													
                                                    <div class="mb-2 col-lg-6">
                                                        <label> Date</label>
                                                        <input type="date" class="form-control" name="event_start_date" id="event_start_date" >		
														<span id="error_event_start_date" class="text-danger"></span>
                                                    </div> 
													
													<!--<div class="mb-2 col-lg-6">
                                                        <label>End Date</label>
                                                        <input type="date" class="form-control" name="event_end_date" id="event_end_date" >		
														<span id="error_event_end_date" class="text-danger"></span>
                                                    </div> --->
													
													<div class="mb-2 col-lg-6">
                                                        <label>Time</label>
                                                        <input type="time" class="form-control" name="event_start_time" id="event_start_time" >		
														<span id="error_event_start_time" class="text-danger"></span>
                                                    </div> 
													<!--<div class="mb-2 col-lg-6">
                                                        <label>End Time</label>
                                                        <input type="time" class="form-control" name="event_end_time" id="event_end_time" >		
														<span id="error_event_end_time" class="text-danger"></span>
                                                    </div>-->
													
													<div class="mb-2 col-lg-6">
                                                        <label>Phone</label>
                                                        <input type="number" class="form-control" name="event_phone" id="event_phone" >		
														<span id="error_event_phone" class="text-danger"></span>
                                                    </div>
													
													<div class="mb-2 col-lg-6">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="event_email" id="event_email" >		
														<span id="error_event_email" class="text-danger"></span>
                                                    </div>
													
													<div class="mb-2 col-lg-6">
                                                        <label>Tags</label>
                                                        <select  class="form-control" name="event_tags[]" id="event_tags" multiple data-placeholder="Select Tags">
                                                            <?php
															    if(@$tags){
																	foreach(@$tags as $k => $v){
																		echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
																	}
																}
															?>														
                                                        </select>														
														<span id="error_event_tags" class="text-danger"></span>
                                                    </div>
													
													<div class="mb-2 col-lg-6">
                                                        <label>Website</label>
                                                        <input type="text" class="form-control" name="event_website" id="event_website" >		
														<span id="error_event_website" class="text-danger"></span>
                                                    </div>
													
                                                </div>
                                                
                                            </div>
                                        </div> 
                                        <input type="button" name="next" class="next action-button" value="Next" id="first-next-button" />
										<br/><br/>
										<p id="userinfo_err"></p>
                                    </fieldset>
                                   <!--<fieldset id="step_2" class="<?php echo !empty($academics) ? 'academic-Info' : 'academic-Info'; ?>">
                                        <div class="form-card">
                                           <div class="pt-3 field_wrapper">
                                                <h3 class="text-uppercase text-center h4 fw-bold mb-3">Event Ticket</h3>
												
													<div class="row">
													
                                                    <div class="mb-2 col-lg-4">
                                                        <label>Ticket Name</label>
                                                        <input type="text" class="form-control" name="ticket_name[]" id="ticket_name" value="">
														<span id="error_ticket_name" class="text-danger"></span>
                                                    </div> 
													
                                                    <div class="mb-2 col-lg-4">
                                                        <label>Price (In USD)</label>
                                                        <input type="text" class="form-control" name="ticket_price[]" id="ticket_price" value="">
														<span id="error_ticket_price" class="text-danger"></span>
                                                    </div> 
													
													<div class="mb-2 col-lg-4">
                                                        <label>Offer Price (In USD) </label>
                                                        <input type="text" class="form-control" name="ticket_offer_price[]" id="ticket_offer_price" value="">
														<span id="error_ticket_offer_price" class="text-danger"></span>
                                                    </div> 
													
													<div class="mb-2 col-lg-12">
														<label>Features </label>
														<textarea class="form-control editor summermote features" name="ticket_features[]" id="ticket_features"></textarea>
														<span id="error_ticket_features" class="text-danger"></span>
													</div>
													
                                                    
													
                                                </div>
												
                                                <div class="my-3 text-center">
                                                    <a href="javascript:void(0);" title="Add field" class="btn btn-secondary rounded-0 fw-bold add_button">Add More </a>
                                                </div>
                                            </div>
                                        </div> 
                                        <input type="button" name="next" class="next action-button" value="Next" id="second-next-button"/> 
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
										<br/><br/>
										<p id="academicinfo_err"></p>
                                    </fieldset>-->
                                    <fieldset id="step_3" class="<?php echo !empty($athletics) ? 'athletics-Info' : 'athletics-Info'; ?>">
                                        <div class="form-card">
                                            <div class=" pt-3">
                                                <h3 class="text-uppercase text-center h4 fw-bold mb-3">Location</h3>
                                                <div class="row">
                                                    

														<div class="row">
														
														   <div class="mb-2 col-lg-12">
																<label>Location</label>
																<input type="text" class="form-control" name="event_location" id="event_location" value="">
																<input type="hidden" class="form-control" name="event_latitude" id="event_latitude" value="">
																<input type="hidden" class="form-control" name="event_longitude" id="event_longitude" value="">
																<span id="error_event_location" class="text-danger"></span>
														   </div>
														   
														    <div class="mb-2 col-lg-6">
																<label>Country</label>
																<input type="text" class="form-control" name="event_country" id="event_country" value=''>
																<span id="error_event_country" class="text-danger"></span>
														   </div>
														   
														   <div class="mb-2 col-lg-6">
																<label>State</label>
																<input type="text" class="form-control" name="event_state" id="event_state" value=''>
																<span id="error_event_state" class="text-danger"></span>
														   </div>
														   
														   <div class="mb-2 col-lg-6">
																<label>City</label>
																<input type="text" class="form-control" name="event_city" id="event_city" value=''>
																<span id="error_event_city" class="text-danger"></span>
														   </div>
														   
														   <div class="mb-2 col-lg-6">
																<label>Zipcode</label>
																<input type="text" class="form-control" name="event_zipcode" id="event_zipcode" value=''>
																<span id="error_event_zipcode" class="text-danger"></span>
														   </div>
														</div>
                                                   
                                                </div>
                                            </div>
                                        </div> 
                                        <input type="button" name="next" class="next action-button" value="Next" id="third-next-button"/> 
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
										<br><br/>
										<p id="athleticsinfo_err"></p>
                                    </fieldset>
                                    <fieldset id="step_4" class="step_4 <?php echo !empty($exprience) ? 'expriences-Info' : 'expriences-Info'; ?>">
                                        <div class="form-card">
                                            <div class="pt-3 field_wrapper1">
                                                <h3 class="text-uppercase text-center h4 fw-bold mb-3">Event Photos</h3>
												
												    <div class="row">
														<div class="mb-2 col-lg-12 files">
															<label>Event Images</label>
															<input type="file" class="form-control" name="event_image" id="event_image" multiple>
															<span id="error_club_name" class="text-danger"></span>
														</div> 
														
														<div class="eventphoto my-3 specific_preview">
														</div>
														
													</div>
												
												 <!--<div class="my-3 text-center">
                                                    <a href="javascript:void(0);" title="Add field" class="btn btn-secondary rounded-0 fw-bold add_button1">Add More </a>
                                                </div>-->
												
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" id="four-next-button"/> 
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
										<br><br/>
										<p id="experienceinfo_err"></p>
                                    </fieldset>
                                   
									
									
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </section>
   </div>
 </div>
 <script>
 $(document).ready(function(){
	// var editstart_date = "<?php echo !empty($exprience->start_date) ? date('m/d/Y', strtotime($exprience->start_date)) : ''; ?>";
	// $(".step_4 #start_date").val(editstart_date);
	$('#first-next-button').click(function(){
		var mobile_validation = /^\d{10}$/;
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var error_event_name = '';
		var error_event_description = '';
		var error_event_category = '';
		var error_event_start_date = '';
		//var error_event_end_date = '';
		var error_event_start_time = '';
		//var error_event_end_time = '';
		var error_event_phone = '';
		var error_event_email = '';

		if($.trim($('#event_name').val()).length == 0){
			error_event_name = 'Please enter event name.';
			$('#error_event_name').text(error_event_name);
			$('#event_name').addClass('has-error');
		}
		else
		{
			error_event_name = '';
			$('#error_event_name').text(error_event_name);
			$('#event_name').removeClass('has-error');
		}
		
		if($.trim($('#event_description').val()).length == 0){
			error_event_description = 'Please enter event description.';
			$('#error_event_description').text(error_event_description);
			$('#event_description').addClass('has-error');
		}
		else
		{
			error_event_description = '';
			$('#error_event_description').text(error_event_description);
			$('#event_description').removeClass('has-error');
		}
		
		
		if($.trim($('#event_category').val()).length == 0){
			error_event_category = 'Please enter event category.';
			$('#error_event_category').text(error_event_category);
			$('#event_category').addClass('has-error');
		}
		else
		{
			error_event_category = '';
			$('#error_event_category').text(error_event_category);
			$('#event_category').removeClass('has-error');
		}
		
		
		if($.trim($('#event_start_date').val()).length == 0){
			error_event_start_date = 'Please select start date.';
			$('#error_event_start_date').text(error_event_start_date);
			$('#event_start_date').addClass('has-error');
		}
		else
		{
			error_event_start_date = '';
			$('#error_event_start_date').text(error_event_start_date);
			$('#event_start_date').removeClass('has-error');
		}
		
		/*if($.trim($('#event_end_date').val()).length == 0){
			error_event_end_date = 'Please select end date.';
			$('#error_event_end_date').text(error_event_end_date);
			$('#event_end_date').addClass('has-error');
		}
		else
		{
			error_event_end_date = '';
			$('#error_event_end_date').text(error_event_end_date);
			$('#event_end_date').removeClass('has-error');
		}*/
		
		
		if($.trim($('#event_start_time').val()).length == 0){
			error_event_start_time = 'Please select start time.';
			$('#error_event_start_time').text(error_event_start_time);
			$('#event_start_time').addClass('has-error');
		}
		else
		{
			error_event_start_time = '';
			$('#error_event_start_time').text(error_event_start_time);
			$('#event_start_time').removeClass('has-error');
		}
		
		
		/*if($.trim($('#event_end_time').val()).length == 0){
			error_event_end_time = 'Please select end time.';
			$('#error_event_end_time').text(error_event_end_time);
			$('#event_end_time').addClass('has-error');
		}
		else
		{
			error_event_end_time = '';
			$('#error_event_end_time').text(error_event_end_time);
			$('#event_end_time').removeClass('has-error');
		}*/
		
		
		if($.trim($('#event_phone').val()).length == 0){
			error_event_phone = 'Please enter phone number.';
			$('#error_event_phone').text(error_event_phone);
			$('#event_phone').addClass('has-error');
		}
		else
		{
			error_event_phone = '';
			$('#error_event_phone').text(error_event_phone);
			$('#event_phone').removeClass('has-error');
		}
		
		if($.trim($('#event_email').val()).length == 0){
			error_event_email = 'Please enter email.';
			$('#error_event_email').text(error_event_email);
			$('#event_email').addClass('has-error');
		}
		else
		{
			error_event_email = '';
			$('#error_event_email').text(error_event_email);
			$('#event_email').removeClass('has-error');
		}
		
		
		
		if(error_event_name != '' || error_event_description != '' || error_event_category != '' || error_event_start_date != '' || error_event_start_time != '' || error_event_phone !='' || error_event_email !=''){
			$('#step_1').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_3').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#userinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">One or more mandatory fields have not been populated. Please check and resubmit.</small></div>');
			return false;
		}else{
			var form_data = new FormData();
			
			var event_name = $('#event_name').val();	
			var event_description = $('#event_description').val();	
			var event_category = $('#event_category').val();	
			var event_start_date = $('#event_start_date').val();	
			var event_end_date = $('#event_end_date').val();	
			var event_start_time = $('#event_start_time').val();	
			var event_end_time= $('#event_end_time').val();	
			//var frt_image = $('#frt_image').prop('files')[0];
			//var bck_image = $('#bck_image').prop('files')[0];
			var eventId = $('#eventId').val();
			var event_phone = $('#event_phone').val();	
			var event_email = $('#event_email').val();
			var event_website = $('#event_website').val();

			// event_tags = [];
			// $("input[name='event_tags[]']").each(function() {
			// event_tags.push($(this).val());
			// });		

            var event_tags = $('#event_tags').val();			
			
			form_data.append("event_name", event_name);
			form_data.append("event_description", event_description);
			form_data.append("event_category", event_category);
			form_data.append("event_start_date", event_start_date);
			form_data.append("event_end_date", event_end_date);
			form_data.append("event_end_date", event_end_date);
			form_data.append("event_start_time", event_start_time);
			form_data.append("event_end_time", event_end_time);
			//form_data.append("frt_image", frt_image);
			//form_data.append("bck_image", bck_image);
			form_data.append("eventId", eventId);
			form_data.append("event_phone", event_phone);
			form_data.append("event_email", event_email);
			form_data.append("event_website", event_website);
			form_data.append("event_tags", event_tags);
			
			
			

			$.ajax({
			headers: {
			'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},		
			type: 'POST',
			url: '<?php echo url('admin/event/save');?>',
			data: form_data,
			dataType:"json",
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				if(data.status == 1){
					$('#eventId').val(data.eventId);
				}
			}
			});
			
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_3').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$("#athletics").addClass("active"); 
			$('#userinfo_err').html('<small style="color:red;"></small>');
		}
	});
	
	$('#second-next-button').click(function(){
		var error_ticket_name = '';
		var error_ticket_price = '';
		var error_ticket_offer_price = '';
		var error_ticket_features = '';

		
		if($.trim($('#ticket_name').val()).length == 0){
			error_ticket_name = 'Please enter ticket name.';
			$('#error_ticket_name').text(error_ticket_name);
			$('#ticket_name').addClass('has-error');
		}
		else
		{
			error_ticket_name = '';
			$('#error_ticket_name').text(error_ticket_name);
			$('#ticket_name').removeClass('has-error');
		}
		
		if($.trim($('#ticket_price').val()).length == 0){
			error_ticket_price = 'Please enter ticket price.';
			$('#error_ticket_price').text(error_ticket_price);
			$('#ticket_price').addClass('has-error');
		}
		else
		{
			error_ticket_price = '';
			$('#error_ticket_price').text(error_ticket_price);
			$('#ticket_price').removeClass('has-error');
		}
		
		
		if($.trim($('#ticket_offer_price').val()).length == 0){
			error_ticket_offer_price = 'Please enter ticket offer price.';
			$('#error_ticket_offer_price').text(error_ticket_offer_price);
			$('#ticket_offer_price').addClass('has-error');
		}
		else
		{
			error_ticket_offer_price = '';
			$('#error_ticket_offer_price').text(error_ticket_offer_price);
			$('#ticket_offer_price').removeClass('has-error');
		}
		
		
		if($.trim($('#ticket_features').val()).length == 0){
			error_ticket_features = 'Please enter ticket features';		
			$('#error_ticket_features').text(error_ticket_features);		
			$('#ticket_features').addClass('has-error');		
		}else{	
			error_ticket_features = '';		
			$('#error_ticket_features').text(error_ticket_features);		
			$('#ticket_features').removeClass('has-error');	
		}
			
		
		
		if(error_ticket_name != '' || error_ticket_price != '' || error_ticket_offer_price != '' || error_ticket_features != '' ){
			$('#step_2').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$("#academics").addClass("active");
			 $('#academicinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">One or more mandatory fields have not been populated. Please check and resubmit.</small></div>');
			return false;
		}else{
				ticket_name = [];
				$("input[name='ticket_name[]']").each(function() {
				ticket_name.push($(this).val());
				});

				ticket_price = [];
				$("input[name='ticket_price[]']").each(function() {
				ticket_price.push($(this).val());
				});

				ticket_offer_price = [];
				$("input[name='ticket_offer_price[]']").each(function() {
				ticket_offer_price.push($(this).val());
				});

				// ticket_features = [];
				// $("input[name='ticket_features[]']").each(function() {
				// ticket_features.push($(this).val());
				// });
				
				ticket_features = [];
				$(".features").each(function() {
				ticket_features.push($(this).val());
				});


				var eventId = $('#eventId').val();

				$.ajax({
				type: 'POST',
				url: '<?php echo url('admin/event/saveTicket');?>',
				data: {ticket_name : ticket_name, ticket_price : ticket_price, ticket_offer_price : ticket_offer_price, ticket_features : ticket_features, eventId : eventId, "_token": "{{ csrf_token() }}"},
				dataType: 'text',
				success: function(data){
				}
				});
				$('#step_3').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
				$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
				$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
				$("#athletics").addClass("active");
				$('#academicinfo_err').html('<small style="color:red;"></small>');
		}
		
	});
	
	$('#third-next-button').click(function(){
		var error_event_location = '';
		var error_event_country = '';
		var error_event_state = '';
		var error_event_city = '';
		var error_event_zipcode = '';

		
		if($.trim($('#event_location').val()).length == 0){
			error_event_location = 'Please enter event location.';
			$('#error_event_location').text(error_event_location);
			$('#event_location').addClass('has-error');
		}
		else
		{
			error_event_location = '';
			$('#error_event_location').text(error_event_location);
			$('#event_location').removeClass('has-error');
		}
		
		
		if($.trim($('#event_country').val()).length == 0){
			error_event_country = 'Please enter event country.';
			$('#error_event_country').text(error_event_country);
			$('#event_country').addClass('has-error');
		}
		else
		{
			error_event_country = '';
			$('#error_event_country').text(error_event_country);
			$('#event_country').removeClass('has-error');
		}
		
		
		if($.trim($('#event_state').val()).length == 0){
			error_event_state = 'Please enter event state.';
			$('#error_event_state').text(error_event_state);
			$('#event_state').addClass('has-error');
		}
		else
		{
			error_event_state = '';
			$('#error_event_state').text(error_event_state);
			$('#event_state').removeClass('has-error');
		}
		
		if($.trim($('#event_city').val()).length == 0){
			error_event_city = 'Please enter event city.';
			$('#error_event_city').text(error_event_city);
			$('#event_city').addClass('has-error');
		}
		else
		{
			error_event_city = '';
			$('#error_event_city').text(error_event_city);
			$('#event_city').removeClass('has-error');
		}
		
		if($.trim($('#event_zipcode').val()).length == 0){
			error_event_zipcode = 'Please enter event zipcode.';
			$('#error_event_zipcode').text(error_event_zipcode);
			$('#event_zipcode').addClass('has-error');
		}
		else
		{
			error_event_zipcode = '';
			$('#error_event_zipcode').text(error_event_zipcode);
			$('#event_zipcode').removeClass('has-error');
		}
		
	
		
		if(error_event_location != '' || error_event_country != '' || error_event_state != '' || error_event_city != '' || error_event_zipcode != ''){
			$('#step_3').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			//$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$("#athletics").addClass("active");
            $('#athleticsinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">One or more mandatory fields have not been populated. Please check and resubmit.</small></div>');
			return false;
		}else{
				var event_location = $('#event_location').val();	
				var event_country = $('#event_country').val();	
				var event_state = $('#event_state').val();	
				var event_city = $('#event_city').val();	
				var event_zipcode = $('#event_zipcode').val();	
				var event_latitude = $('#event_latitude').val();	
				var event_longitude = $('#event_longitude').val();	
				var eventId = $('#eventId').val();

				$.ajax({
				type: 'POST',
				url: '<?php echo url('admin/event/saveLocation');?>',
				data: {event_location : event_location, event_country : event_country, event_state : event_state, event_city : event_city, event_zipcode : event_zipcode, eventId : eventId, event_longitude : event_longitude, event_latitude : event_latitude, "_token": "{{ csrf_token() }}"},
				dataType: 'text',
				success: function(data){

				}
				});
			$('#step_4').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			//$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_3').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$("#exprience").addClass("active");
			$('#athleticsinfo_err').html('<small style="color:red;"></small>');
		}
		
	});
	
	$('#four-next-button').click(function(){

		var form_data = new FormData(); 
		var totalfiles = document.getElementById('event_image').files.length;
		
		var eventId = $('#eventId').val();
		form_data.append("eventId", eventId);
		
		for (var index = 0; index < totalfiles; index++) {
		   form_data.append("image[]",  document.getElementById('event_image').files[index]);
		}
		
		
		
		if(totalfiles == 0){
			$('#step_4').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_3').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			//$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#experienceinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">Please select choose images. Please check and resubmit.</small></div>');
			return false;
		}else{
			

			$.ajax({
			headers: {
			'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},		
			type: 'POST',
			url: '<?php echo url('admin/event/saveEventImage');?>',
			data: form_data,
			dataType:"json",
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				if(data.status == 1){
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('admin/event')?>"});
				}
			}
			});
			$('#step_5').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_4').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			//$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_3').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$("#reference").addClass("active");
			$('#experienceinfo_err').html('<small style="color:red;"></small>');
		}
		
	});
	
	
	$('#five-next-button').click(function(){
		var error_coach_name = '';
		var error_coach_email = '';
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		if($.trim($('#coach_name').val()).length == 0){
			error_coach_name = 'Please enter coach name';
			$('#error_coach_name').text(error_coach_name);
			$('#coach_name').addClass('has-error');
		}
		else
		{
			error_coach_name = '';
			$('#error_coach_name').text(error_coach_name);
			$('#coach_name').removeClass('has-error');
		}
		
		if($.trim($('#coach_email').val()).length == 0){
			error_coach_email = 'Please enter coach email';
			$('#error_coach_email').text(error_coach_email);
			$('#coach_email').addClass('has-error');
		}
		else
		{
			if (!filter.test($('#coach_email').val()))
			{
				error_coach_email = 'Invalid email';
				$('#error_coach_email').text(error_coach_email);
				$('#coach_email').addClass('has-error');
			}
			else
			{
				error_coach_email = '';
				$('#error_coach_email').text(error_coach_email);
				$('#coach_email').removeClass('has-error');
			}
		}
		
		
		
		if(error_coach_email != '' || error_coach_name != '' ){
			$('#step_5').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_4').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_3').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			//$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
            $('#referenceinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">One or more mandatory fields have not been populated. Please check and resubmit.</small></div>');
			return false;
		}else{
			
			coach_name = [];
			$("input[name='coach_name[]']").each(function() {
			coach_name.push($(this).val());
			});
			
			coach_email = [];
			$("input[name='coach_email[]']").each(function() {
			coach_email.push($(this).val());
			});
			
			var userId = $('#userId').val();
			
			$.ajax({
			type: 'POST',
			url: '<?php echo url('admin/users/updateProfile');?>',
			data: {coach_email : coach_email, coach_name : coach_name, userId : userId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(data){
			}
			});
			
			$('#step_6').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_5').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_4').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			//$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_3').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$("#guardian").addClass("active");
			$('#referenceinfo_err').html('<small style="color:red;"></small>');
		}
		
	});
	
	$("#msform").submit(function (event) {
        var  guardian_name  = $('#guardian_name').val(); 
		var  guardian_email  = $('#guardian_email').val(); 
		var  guardian_phone  = $('#guardian_phone').val(); 
		var  guardian_relation  = $('#guardian_relation').val(); 
		
	    var error_guardian_name = '';
	    var error_guardian_email = '';
	    var error_guardian_phone = '';
	    var error_guardian_relation = '';
		
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		if($.trim($('#guardian_name').val()).length == 0){
			error_guardian_name = 'Please enter guardian name';
			$('#error_guardian_name').text(error_guardian_name);
			$('#guardian_name').addClass('has-error');
		}
		else
		{
			error_guardian_name = '';
			$('#error_guardian_name').text(error_guardian_name);
			$('#guardian_name').removeClass('has-error');
		}
		
		
		if($.trim($('#guardian_email').val()).length == 0)
		{
			error_guardian_email = 'please enter guardian email';
			$('#error_guardian_email').text(error_guardian_email);
			$('#guardian_email').addClass('has-error');
		}
		else
		{
			if (!filter.test($('#guardian_email').val()))
			{
				error_guardian_email = 'Invalid email';
				$('#error_guardian_email').text(error_guardian_email);
				$('#guardian_email').addClass('has-error');
			}
			else
			{
				error_guardian_email = '';
				$('#error_guardian_email').text(error_guardian_email);
				$('#guardian_email').removeClass('has-error');
			}
		}
		
		
		if($.trim($('#guardian_phone').val()).length == 0){
			error_guardian_phone = 'Please enter guardian phone';
			$('#error_guardian_phone').text(error_guardian_phone);
			$('#guardian_phone').addClass('has-error');
		}
		else
		{
			error_guardian_phone = '';
			$('#error_guardian_phone').text(error_guardian_phone);
			$('#guardian_phone').removeClass('has-error');
		}
		
		if($.trim($('#guardian_relation').val()).length == 0){
			error_guardian_relation = 'Please enter guardian relation';
			$('#error_guardian_relation').text(error_guardian_relation);
			$('#guardian_relation').addClass('has-error');
		}
		else
		{
			error_guardian_relation = '';
			$('#error_guardian_relation').text(error_guardian_relation);
			$('#guardian_relation').removeClass('has-error');
		}
		
		if(error_guardian_name != '' || error_guardian_email != '' || error_guardian_phone != '' || error_guardian_relation != ''){
			$('#guardianinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">One or more mandatory fields have not been populated. Please check and resubmit.</small></div>');
			return false;
		}else{
			$('#guardianinfo_err').html('<small style="color:red;"></small>');
		}


		event.preventDefault();
		$.ajax({
		headers: {
		'X-CSRF-TOKEN': "{{ csrf_token() }}"
		},	
		type: 'POST',
		url: '<?php echo url('admin/users/updateProfile');?>',
		data: new FormData(this),
		dataType: 'json', 
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){ 
			if(data.status == 1){
				swal({title: "Sucess!", text: "<strong>"+data.message+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				
			}
			if(data.status == 0){
				swal({title: "Fail!", text: "<strong>"+data.message+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
		}
		});

		});

});
 </script>
 <script>
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
              
              /*owl_image += '<div class="item">'+
                                '<img src="'+image_src+'" class="owl-img-fluid">'+
                                '<a href="javascript:void(0);" class="closeimg" data-index="'+i+'"><i class="fa fa-times"></i></a>'+
                            '</div>';*/
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
/*$(document).on('keyup','#feet',function(e){
        var feet = $(this).val();
        
        if(feet){
			//console.log(feet)
          $("#feet").val(feet+"'");
        }
    });	
$(document).on('change','#inches',function(e){
        var inches = $(this).val();
        
        if(inches){

          $("#inches").val(inches+'"');
        }
    });	*/	
$(document).ready(function(){
	$("#submitform").on('submit', function(e){
		e.preventDefault();
		var form_data = new FormData(); 	
		var profile_image = $("#upload_image").prop("files")[0]; 
		
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
		
		form_data.append("profile_image", profile_image);
		form_data.append("fname", fname);
		form_data.append("lname", lname);
		form_data.append("email", email);
		form_data.append("status", status);
		form_data.append("phone", phone);
		form_data.append("address", address);
		form_data.append("latitude", latitude);
		form_data.append("longitude", longitude);
		form_data.append("longitude", longitude);
		form_data.append("password", password);
		form_data.append("confirm_password", confirm_password);
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
				swal({title: "Sucess!", text: "<strong>"+data.message+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
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
   
 
 </script> 
 <script src="<?= url('assets/admin/plugins/smt-img-upld/js/singleimage-uploader.js')?>"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places"></script>
 <link href='<?php echo url("assets/chosen/chosen.min.css"); ?>' rel='stylesheet' type='text/css'>
<script src='<?php echo url("assets/chosen/chosen.jquery.min.js"); ?>' type='text/javascript'></script>   
  <!--<script>
	$(document).ready(function() {
	$("#lat_area").addClass("d-none");
	$("#long_area").addClass("d-none");
	});
	google.maps.event.addDomListener(window, 'load', initialize);
	function initialize() {
	var input = document.getElementById('autocomplete');
	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.addListener('place_changed', function() {
	var place = autocomplete.getPlace();
	$('#latitude').val(place.geometry['location'].lat());
	$('#longitude').val(place.geometry['location'].lng());
	// --------- show lat and long ---------------
	$("#lat_area").removeClass("d-none");
	$("#long_area").removeClass("d-none");
	});
	}
</script>-->
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
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function(){
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;
    setProgressBar(current);
    // $(".next").click(function(){
    // current_fs = $(this).parent();
    // next_fs = $(this).parent().next();
    // //Add Class Active
    // $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    // //show the next fieldset
    // next_fs.show();
    // //hide the current fieldset with style
    // current_fs.animate({opacity: 0}, {
    // step: function(now) {
    // // for making fielset appear animation
    // opacity = 1 - now;
    // current_fs.css({
   // // 'display': 'none',
    // 'position': 'relative'
    // });
    // next_fs.css({'opacity': opacity});
    // },
    // duration: 500
    // });
    // setProgressBar(++current);
    // });
    $(".previous").click(function(){
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    //show the previous fieldset
    previous_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    previous_fs.css({'opacity': opacity});
    },
    duration: 500
    });
    setProgressBar(--current);
    });
    function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
    .css("width",percent+"%")
    }
    $(".submit").click(function(){
    return false;
    })
    });
</script>
<script>
$(document).ready(function(){
	
$('#country').change(function(){
	var country_id = $('#country').val();
	if(country_id != '')
	{
		$.ajax({
			url:"<?php echo url('admin/users/state'); ?>",
			method:"POST",
			data:{country_id:country_id},
			success:function(data)
			{
				$('#state').html(data);
				$('#city').html('<option value="">Select City</option>');
			}
		});
	}
	else
	{
		$('#state').html('<option value="">Select State</option>');
		$('#city').html('<option value="">Select City</option>');
	}
});

$('#state').change(function(){
	var state_id = $('#state').val();
	if(state_id != '')
	{
		$.ajax({
			url:"<?php echo url('admin/users/city'); ?>",
			method:"POST",
			data:{state_id:state_id},
			success:function(data)
			{
			  $('#city').html(data);
			}
		});
	}
	else
	{
	    $('#city').html('<option value="">Select City</option>');
	}
});

//document.getElementById("resquestion").innerHTML  = ""+question+"";
});
	
</script>	

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
	
    var fieldHTML = '<div class="row"><div class="mb-2 col-lg-4"> <label>Ticket Name</label><input type="text"  name="ticket_name[]" class="form-control"></div> <div class="mb-2 col-lg-4"><label>Price (In USD)</label> <input type="text"  name="ticket_price[]" class="form-control" ></div> <div class="mb-2 col-lg-4"><label>Offer Price (In USD)</label><input type="text" class="form-control"  name="ticket_offer_price[]"></div><div class="mb-2 col-lg-12"><label>Features</label><textarea type="text" class="form-control textarea features" name="ticket_features[]" ></textarea></div><a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold remove_button" style="width: 100px;">Remove</a> </div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
			$(wrapper).find('.textarea').summernote();
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button1'); //Add button selector
    var wrapper = $('.field_wrapper1'); //Input field wrapper
	
    var fieldHTML = '<div class="row"><div class="mb-2 col-lg-6"> <label>Club Name</label><input type="text"  name="club_name[]" class="form-control"></div> <div class="mb-2 col-lg-6"><label>Designation</label> <input type="text"  name="club_designation[]" class="form-control" ></div> <div class="mb-2 col-lg-6"><label>Start Date</label><input type="date" class="form-control"  name="start_date[]"></div><div class="mb-2 col-lg-6"> <label>End Date</label><input type="date" class="form-control"  name="end_date[]"></div><div class="mb-2 col-lg-12"><label>Information</label><textarea type="text" class="form-control textarea information" name="information[]" ></textarea> </div> <a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold remove_button1" style="width: 100px;">Remove</a> </div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
			$(wrapper).find('.textarea').summernote();
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button1', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button2'); //Add button selector
    var wrapper = $('.field_wrapper2'); //Input field wrapper
	
    var fieldHTML = '<div class="row"><div class="mb-2 col-lg-6"> <label>Coach Name</label><input type="text"  name="coach_name[]" class="form-control"></div> <div class="mb-2 col-lg-6"><label>Coach Email</label> <input type="text"  name="coach_email[]" class="form-control" ></div>  <a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold remove_button2" style="width: 100px;">Remove</a> </div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button2', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});


$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button3'); //Add button selector
    var wrapper = $('.field_wrapper3'); //Input field wrapper
	
    var fieldHTML = '<div class="row"><div class="mb-2 col-lg-6"> <label>Guardian Name</label><input type="text"  name="guardian_name[]" class="form-control"></div> <div class="mb-2 col-lg-6"><label>Guardian Email</label> <input type="email"  name="guardian_email[]" class="form-control" ></div>  <div class="mb-2 col-lg-6"><label>Guardian Phone</label> <input type="text"  name="guardian_phone[]" class="form-control" ></div><div class="mb-2 col-lg-6"><label>Guardian Relation</label> <input type="text"  name="guardian_relation[]" class="form-control" ></div><a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold remove_button3" style="width: 100px;">Remove</a> </div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button3', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

<script type="text/javascript">
		
	$(document).ready(function() {
		$('.editor').summernote({
			placeholder: '',
			height: 200
		});
	});
	
function confirmDelete(id) {
var userId = $("a#hiddenuserid_"+id).data().value; 
    swal({
        title: "Are you sure you want to hide this data?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "<?php echo url('admin/users/delete-academic'); ?>",
            type: "POST",
            data: {
                academic: id, userId:userId, "_token": "{{ csrf_token() }}"
            },
            dataType: "html",
            success: function (data) {
				if(data == 1){
					swal({title: "Sucess!", text: "<strong>You have successfully deleted this data.</strong>", type: "success", showConfirmButton: true, html:true});
					$('.academicUserinfo_'+id).remove();
				}else{
					swal({title: "Fail!", text: "<strong>Some error occure, Please try again.</strong>", type: "error", showConfirmButton: true, html:true});
				}
               
            }
			
            
        });
    });
}

function guarDelete(id) {
var userId = $("a#guaruserid_"+id).data().value; 
    swal({
        title: "Are you sure you want to hide this data?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "<?php echo url('admin/users/delete-guardian'); ?>",
            type: "POST",
            data: {
                guardian: id, userId:userId,  "_token": "{{ csrf_token() }}"
            },
            dataType: "html",
            success: function (data) {
				
                if(data == 1){
					swal({title: "Sucess!", text: "<strong>You have successfully deleted this data.</strong>", type: "success", showConfirmButton: true, html:true});
					$('.guardianUserinfo_'+id).remove();
				}else{
					swal({title: "Fail!", text: "<strong>Some error occure, Please try again.</strong>", type: "error", showConfirmButton: true, html:true});
				}
            }
			
            
        });
    });
}


function expDelete(id) {
var userId = $("a#expuserid_"+id).data().value; 
    swal({
        title: "Are you sure you want to hide this data?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "<?php echo url('admin/users/delete-experience'); ?>",
            type: "POST",
            data: {
                experience: id, userId:userId,  "_token": "{{ csrf_token() }}"
            },
            dataType: "html",
            success: function (data) {
				if(data == 1){
					swal({title: "Sucess!", text: "<strong>You have successfully deleted this data.</strong>", type: "success", showConfirmButton: true, html:true});
					$('.experienceUserinfo_'+id).remove();
				}else{
					swal({title: "Fail!", text: "<strong>Some error occure, Please try again.</strong>", type: "error", showConfirmButton: true, html:true});
					//$('.experienceUserinfo_'+id).remove();
				}
                
            }
			
            
        });
    });
}

function refDelete(id) {
var userId = $("a#refuserid_"+id).data().value; 
    swal({
        title: "Are you sure you want to hide this data?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "<?php echo url('admin/users/delete-reference'); ?>",
            type: "POST",
            data: {
                reference: id, userId:userId, "_token": "{{ csrf_token() }}"
            },
            dataType: "html",
            success: function (data) {
				if(data == 1){
					swal({title: "Sucess!", text: "<strong>You have successfully deleted this data.</strong>", type: "success", showConfirmButton: true, html:true});
					$('.referenceUserinfo_'+id).remove();
				}else{
					swal({title: "Fail!", text: "<strong>Some error occure, Please try again.</strong>", type: "error", showConfirmButton: true, html:true});
				}
            }
			
            
        });
    });
}
$("#progressbar").on("click", "#account", function(event){
	$('.pro-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.academic-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.athletics-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.expriences-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.references-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.guardian-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#account").addClass("active");
	$("#academics").removeClass("active");
	$("#athletics").removeClass("active");
	$("#exprience").removeClass("active");
	$("#reference").removeClass("active");
	$("#guardian").removeClass("active");
	 
});
 $("#progressbar").on("click", "#academics", function(event){
	// console.log('clicked');
	$('.academic-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.pro-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.athletics-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.expriences-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.references-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.guardian-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#academics").addClass("active");
	$("#athletics").removeClass("active");
	$("#exprience").removeClass("active");
	$("#reference").removeClass("active");
	$("#guardian").removeClass("active");
	$("#account").removeClass("active");
 });
 
  $("#progressbar").on("click", "#athletics", function(event){
	// console.log('clicked');
	$('.athletics-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.academic-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.pro-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.expriences-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.references-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.guardian-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#athletics").addClass("active");
	$("#exprience").removeClass("active");
	$("#reference").removeClass("active");
	$("#guardian").removeClass("active");
	$("#academics").removeClass("active");
	$("#account").removeClass("active");
 });
 
  $("#progressbar").on("click", "#exprience", function(event){
	// console.log('clicked');
	$('.expriences-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.athletics-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.academic-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.pro-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.references-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.guardian-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#exprience").addClass("active");
	$("#reference").removeClass("active");
	$("#guardian").removeClass("active");
	$("#athletics").removeClass("active");
	$("#academics").removeClass("active");
	$("#account").removeClass("active");
 });
 
  $("#progressbar").on("click", "#reference", function(event){
	// console.log('clicked');
	$('.references-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.guardian-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.expriences-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.athletics-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.academic-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.pro-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#reference").addClass("active");
	$("#guardian").removeClass("active");
	$("#exprience").removeClass("active");
	$("#athletics").removeClass("active");
	$("#academics").removeClass("active");
	$("#account").removeClass("active");
});

 $("#progressbar").on("click", "#guardian", function(event){
	// console.log('clicked');
	$('.guardian-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.references-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.expriences-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.athletics-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.academic-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.pro-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#guardian").addClass("active");
	$("#reference").removeClass("active");
	$("#exprience").removeClass("active");
	$("#athletics").removeClass("active");
	$("#academics").removeClass("active");
	$("#account").removeClass("active");
});

document.getElementById("frt_image").onchange = function(event) {
let file = event.target.files[0];
	let blobURL = URL.createObjectURL(file);
	document.getElementById("blah1").src = blobURL;
}

document.getElementById("bck_image").onchange = function(event) {
let file = event.target.files[0];
	let blobURL = URL.createObjectURL(file);
	document.getElementById("blah2").src = blobURL;
}


</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places"></script>
 
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('event_location'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
			$('#event_latitude').val(place.geometry['location'].lat());
			$('#event_longitude').val(place.geometry['location'].lng());
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
                        document.getElementById('event_country').value = country;
                        document.getElementById('event_state').value = state;
                        document.getElementById('event_city').value = city;
                        document.getElementById('event_zipcode').value = pin;
                    }
                }
            });
        });
    });
	
	
	var num = 0;
var dataTransfer = new DataTransfer();
const input = document.querySelector('#event_image');
$(document).ready(function(e){
	$(document).on('change','#event_image',function(e){
		//$("#sortable").css('opacity','0.05');
		var output = $(".specific_preview");
		var totalfiles = document.getElementById('event_image').files.length;
		
				var match = ['image/jpeg', 'image/png', 'image/jpg', 'image/jpg', 'image/gif'];
				for (var index = 0; index < totalfiles; index++) {
					dataTransfer.items.add(document.getElementById('event_image').files[index]);
					var fileType = document.getElementById('event_image').files[index].type;
					if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]))){
						swal({title: "Fail", text: "<strong>Sorry only JPG, JPEG, GIF, PNG files are allowed to upload.</strong>", type: "error", showConfirmButton: true, html:true});
						return false;
					}else{
						var fileName = document.getElementById('event_image').files[index].name;
						var extension = fileName.split('.').pop().toLowerCase();
						if (extension == 'gif' || extension == 'png' || extension == 'jpg' || extension == 'jpeg') {
							// var html =	'<div class="uploadlist draggable-item preview-image preview-show-'+[index]+'" id="preview'+[index]+'">'+
							// '<a href="javascript:void(0);" class="closemedia image-cancel" data-no="'+[index]+'"  id="img'+[index]+'"><i class="fas fa-times"></i></a>'+
							// ' <div class="image-zone" ><img id="pro-img-" src="'+window.URL.createObjectURL(this.files[index])+'" class="imageall" style="width: 70%;height: 70px;border-radius: 10px;"></div>'+
							// '</div>';
							var html =	'<div class="uploadedimg preview-show-'+[index]+'" id="preview'+[index]+'">'+
								'<img src="'+window.URL.createObjectURL(this.files[index])+'">'+
								'<a  href="javascript:void(0);" class="closeimg image-cancel" data-no="'+[index]+'"  id="img'+[index]+'"><i class="fa fa-times" style="color: black;"></i></a>'+
							'</div>';
							output.append(html);
						}else{
							var html =	'<div class="uploadlist draggable-item uploadvideo preview-image preview-show-'+[index]+'" id="preview'+[index]+'">'+
							'<a href="javascript:void(0);" class="closemedia image-cancel" data-no="'+[index]+'" id="img'+[index]+'"><i class="fas fa-times" style="color: black;"></i></a>'+
							' <div class="image-zone"><video id="pro-img-"><source  src="'+window.URL.createObjectURL(this.files[index])+'" class="imageall"></video></div>'+
							'</div>';
							output.append(html);
						}
						num = num + 1;
					}
				}
			
        input.files = dataTransfer.files;
	});


 $(document.body).on('click', '.image-cancel' ,function(){ 
        var item = $(this).attr('data-no');
		console.log(item)
		dataTransfer.items.remove(item)
		input.files = dataTransfer.files
		// Delete element from DOM and update order
		//item.parentNode.remove()
		$('#preview'+item+'').remove();
		//updateOrder();
 });
  
 
});

$(document).ready(function(){
		$('#sel1').chosen({disable_search_threshold: 10,width:'200px'});
		$('#sel2').chosen({width:'200px'});
		$('#sel3').chosen({no_results_text:"Not found",width:'200px'});
		$('#event_tags').chosen({max_selected_options:10,width:'100%'});
		$('#sel5').chosen({allow_single_deselect:true,width:'200px'});
	});
</script>
@include('admin.footer');	