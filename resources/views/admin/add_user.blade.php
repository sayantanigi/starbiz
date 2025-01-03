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
	.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
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

                <div class="col-lg-6 mb-3">
                  <div class="card shadow rounded">
                     <div class="card-body">    
                        <form id="" action="{{url('admin/users/save')}}" method="post" enctype="multipart/form-data" >
                            @csrf
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">User Type</label>
                                <select class="form-control" name="user_type" required id="user_type">
                                    <?php
									    if(!empty(@$userType)){
											foreach(@$userType as $k => $v){
												echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
											}
										}
									?>
                                </select>
                            </div>
							
                            <div class="form-group mb-2">
                                <label class="fw-semibold  text-black">First Name</label>
                                <input type="text" class="form-control" name="fname"  id="fname" required autocomplete="off">
                            </div>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Last Name</label>
                                <input type="text" class="form-control" name="lname"  id="lname" required autocomplete="off">
                            </div>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Email</label>
                                <input type="email" class="form-control" name="email"  id="email" required autocomplete="off">
                            </div>
                            <small id="email_error"></small>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Phone</label>
                                <input type="text" class="form-control" name="phone"  id="phone" required autocomplete="off">
                            </div>
							
							
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Address</label>
								<input type="text" class="form-control" name="address"  id="autocomplete" required autocomplete="off">
								<input type="hidden" placeholder="Near"  name="latitude" id="latitude">
			                    <input type="hidden" placeholder="Near" name="longitude" id="longitude">
                            </div>
							
							<div class="mb-2 col-lg-12">
								<label class="fw-semibold  text-black">Dob</label>
								<input type="date" class="form-control" name="dob" id="dob"  required autocomplete="off">
								<span id="error_dob" class="text-danger"></span>
							</div>
							
							<div class="row">
								<div class="mb-2 col-lg-6">
									<label class="fw-semibold  text-black">Country</label>
									<input type="text" class="form-control" name="country" id="country" required autocomplete="off">
									<span id="error_country" class="text-danger"></span>
								</div> 
								
								<div class="mb-2 col-lg-6">
									<label class="fw-semibold  text-black">State</label>
									<input type="text" class="form-control" name="state" id="state" required autocomplete="off">
									<span id="error_state" class="text-danger"></span>
								</div>
								
								<div class="mb-2 col-lg-6">
									<label class="fw-semibold  text-black">City</label>
									<input type="text" class="form-control" name="city" id="city" required autocomplete="off">
									<span id="error_city" class="text-danger"></span>
								</div> 
								
								<div class="mb-2 col-lg-6">
									<label class="fw-semibold  text-black">Zip Code</label>
									<input type="text" class="form-control" name="pincode" id="pincode" required autocomplete="off">
									<span id="error_pincode" class="text-danger"></span>
								</div>
							</div>
							
							<div class="mb-2 col-lg-12">
								<label class="fw-semibold  text-black">Profile Bio</label>
								<textarea class="form-control editor summermote" name="profile_bio" id="profile_bio"><?php echo !empty($profile->bio) ? $profile->bio : ''; ?></textarea>
								<span id="error_profile_bio" class="text-danger"></span>
							</div> 
							
							<div class="mb-2 col-lg-12">        
								<label class="fw-semibold  text-black">Interest</label>   
								<select class="form-control" name="area_interest[]" id="area_interest" multiple data-placeholder="Select Interest">
									<option value="">Select Interest</option>
									<?php
										if(!empty(@$interest)){
											foreach(@$interest as $k => $v){
												echo '<option value="'.@$v->id.'" >'.@$v->name.'</option>';
											}
										}
									?>
								</select>
								<span id="error_tags" class="text-danger"></span>
							</div>
							
							<div class="mb-2 col-lg-12">        
								<label class="fw-semibold  text-black">Tags</label>   
								<select class="form-control" name="tags[]" id="tags" multiple data-placeholder="Select Tags">
									<option value="">Select Tags</option>
									<?php
										if(!empty(@$tags)){
											foreach(@$tags as $k => $v){
												echo '<option value="'.@$v->id.'" >'.@$v->name.'</option>';
											}
										}
									?>
								</select>
								<span id="error_tags" class="text-danger"></span>
							</div>
 
                            <div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Status</label>
                                <select class="form-control" name="status" required id="userstatus">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>


							<div class="form-group mb-2 files">
                                <label class="fw-semibold  text-black">Profile Image</label>
                                <input type="file" class="form-control" name="upload_image"  id="upload_image" >
                                <input type="hidden" class="form-control" name="profileImg"  id="profileImg" >
                            </div>
							

							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Password</label>
                                <input type="password" class="form-control" name="password"  id="password" required autocomplete="off">
                            </div>
							<small id="pass_error"></small>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password"  id="confirm_password" required autocomplete="off">
                            </div>
                            <small id="cnfpass_error"></small>
							
                            <div class="form-group mt-3 mb-2">
                                <button class="btn btn-success text-uppercase px-5 shadow">Submit</button>
                                <a class="btn btn-danger waves-effect waves-light m-l-30" href="javascript:history.go(-1)">Back</a>
                            </div>
                        </form>
                     </div>
                  </div>      
                </div>
                
                <div class="col-lg-6 mb-3">
                    <div class="card shadow rounded">
                        <div class="card-body">
                            <div class="row">
							<div class="container">
									<div class="col-md-12">
										<div class="profile clearfix">                            
											<div class="image item" id="Cover-Image">
											    <img src="<?= !empty(@$user->cover_image) ? url('profile/cover_image/'.@$user->cover_image.'') : url('profile/bnr.jpg'); ?>" class="img-cover" style="width: 100%;object-fit: contain;background-color: #eee;height: auto;">
											</div>                            
											<div class="user clearfix">
												<div class="avatar item" id="item">
													<img src="<?= url('profile/unnamed.jpg') ?>" class="img-thumbnail img-profile" id="blah">
												</div>                                
												<h2><span id="f-name"><?=@$user->first_name; ?></span> <span id="l-name"><?=@$user->last_name; ?></span></h2>                                
												                                                                                              
											</div>                          
											<div class="info">
																						
											</div>                              
										</div>
									</div>
								</div>
								
                                <div class="col-lg-12 mb-3">
									<div class="card rounded">
									<div class="card-body">
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>First Name</h6></label><p class="text-muted" id="first_name"></p></div>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Last Name</h6></label><p class="text-muted" id="last_name"></p></div>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Email</h6></label><p class="text-muted" id="individual_email"></p></div>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Phone</h6></label><p class="text-muted" id="individual_phone"></p></div>
									
									
									<div class="d-flex align-items-center justify-content-between mb-2">
									<h6 class="card-title mb-0">Address</h6>
									</div>
									<p id="individual_address"></p>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Country</h6></label><p class="text-muted" id="individual_country"></p></div>
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>State</h6></label><p class="text-muted" id="individual_state"></p></div>
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>City</h6></label><p class="text-muted" id="individual_city"></p></div>
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Zipcode</h6></label><p class="text-muted" id="individual_zipcode"></p></div>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0"><h6>Sport</h6></label><p class="text-muted" id="individual_sport"><?=@$sports->sports_name; ?></p></div>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Status</h6></label><p class="text-muted" id="individual_status"></p></div>
									
									</div>
									</div>
									
                                </div>
                                  
                            </div>
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
	
	$(document).on('change','#sport',function(e){
        var sport = $(this).val();
		
       $.ajax({
		type: 'POST',
		url: '<?php echo url('admin/users/getSport_byId'); ?>',
		data: {sportId : sport},
		success: function(data){
			$("#individual_sport").text(data);
		}
		});
        
    });
	
	$(document).on('change','#userstatus',function(e){
        var status = $(this).val();
        
        if(status == 1){
          $("#individual_status").text('Active');
        }
		if(status == 0){
          $("#individual_status").text('Inactive');
        }
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
  <link href='<?php echo url("assets/chosen/chosen.min.css"); ?>' rel='stylesheet' type='text/css'>
<script src='<?php echo url("assets/chosen/chosen.jquery.min.js"); ?>' type='text/javascript'></script> 
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

$(document).ready(function(){
	$('#sel1').chosen({disable_search_threshold: 10,width:'200px'});
	$('#sel2').chosen({width:'200px'});
	$('#sel3').chosen({no_results_text:"Not found",width:'200px'});
	$('#tags').chosen({max_selected_options:10,width:'100%'});
	$('#area_interest').chosen({max_selected_options:10,width:'100%'});
	$('#sel5').chosen({allow_single_deselect:true,width:'200px'});
}); 

$(document).ready(function() {
		$('.editor').summernote({
			placeholder: '',
			height: 200
		});
	});
</script>
@include('admin.footer');