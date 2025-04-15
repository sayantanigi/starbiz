<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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

                <div class="col-lg-7 mb-3">
                  <div class="card shadow rounded">
                     <div class="card-body">    
                        <form action="{{url('admin/promotion/update')}}" method="post" enctype="multipart/form-data" >
                            @csrf
							
							
							<div class="form-group mb-2" >
                                <label class="fw-semibold  text-black"> Category *</label>
								<select class="form-control" name="category" id="category" required>
								    <option value="">Choose Category</option>
								    <?php
								        if($category){
											foreach($category as $k => $v){
												echo '<option value="'.@$v->id.'" '.((@$v->id == @$result->category) ? 'selected' : '').'>'.@$v->name.'</option>';
											}
										}
								    ?>
								</select>
                            </div>
							
							
							<div class="form-group mb-2" >
                                <label class="fw-semibold  text-black">Type </label>
								<select class="form-control" name="file_type" id="file_type" required>
								    <option value="1" <?=((@$result->file_type == 1) ? 'selected' : '')?>>Image</option>
								    <option value="2" <?=((@$result->file_type == 2) ? 'selected' : '')?>>Video</option>
								</select>
                            </div>
							
							
                            <div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Title * </label>
                                <input type="text" class="form-control" name="ads_name"  id="ads_name"  autocomplete="off" required value="<?=@$result->ads_name?>">
                            </div>
							<small id="err_ads_name"></small>
							
							<!--<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">URL (For Ex:http://yoururl.com) </label>
								<input type="text" class="form-control" name="url"  id="url"  autocomplete="off" required value="<?=@$result->url?>">
                            </div>-->
							
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Uploads Files</label>
								<input type="file" class="form-control" name="ads_image"  id="ads_image" >
								<input type="hidden" class="form-control" name="id"  id="id" value="<?=@$result->id?>">
                            </div>
							
							
							<!--<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Description * </label>
                                <textarea type="text" class="form-control editor summermote" name="description"  id="description"  autocomplete="off"  required><?=@$result->description?></textarea>
                            </div>-->
							
							<?php
							    $cate = [];
							    if(!empty(@$result->places)){
									$exCat = explode(',', @$result->places);
									foreach($exCat as $k => $v){
										$cate[] = $v;
									}
								}
							?>
							<!--<div class="form-group mb-2">
								<label class="fw-semibold  text-black">Select Places<span class="mand">*</span></label><br>
								<label class="checkbox-inline" style="margin-bottom: 0;">
									<input type="checkbox" class="category" name="places[]" id="places" value="Home" <?=(in_array('Home',$cate) ? 'checked' : '')?>>
									Home Screen &nbsp;
								</label>

								<label class="checkbox-inline" style="margin-bottom: 0;">
									<input type="checkbox" class="category" name="places[]" id="places" value="Ads" <?=(in_array('Ads',$cate) ? 'checked' : '')?>>
									Ads Screen &nbsp;
								</label>
								
								<label class="checkbox-inline" style="margin-bottom: 0;">
									<input type="checkbox" class="category" name="places[]" id="places" value="Listing" <?=(in_array('Listing',$cate) ? 'checked' : '')?>>
									Listing Screen &nbsp;
								</label>
								
								<label class="checkbox-inline" style="margin-bottom: 0;">
									<input type="checkbox" class="category" name="places[]" id="places" value="Event" <?=(in_array('Event',$cate) ? 'checked' : '')?>>
									Event Screen &nbsp;
								</label>
								<div class="error invalid-feedback" id="ads-category" style="margin-top: 0;"></div>
							</div>-->
							
							
							<div class="form-group mb-2">
                                <?php 
									if(@$result->file_type == 1){
									    echo '<img src="'.url('ads/'.@$result->image.'').'" style="width:30%;">';
									}else{
										echo '<video src="'.url('ads/'.@$result->image.'').'" style="width:30%;"></video>';
									}
								?>
                            </div>
							
							
							
							<div class="form-group mb-2" >
                                <label class="fw-semibold  text-black">Gender </label>
								<select class="form-control" name="gender" id="gender" required>
								    <option value="Male" <?=((@$result->gender == 'Male') ? 'selected' : '')?>>Male</option>
								    <option value="Female" <?=((@$result->gender == 'Female') ? 'selected' : '')?>>Female</option>
								    <option value="All Gender" <?=((@$result->gender == 'All Gender') ? 'selected' : '')?>>All Gender</option>
								</select>
                            </div>
							
							<!--<div class="form-group mb-2" >
                                <label class="fw-semibold  text-black">Age</label>
								<select class="form-control" name="age" id="age" required>
								    <option value="">Choose Age</option>
								    <?php
									    if(@$age){
											foreach(@$age as $k => $v){
												echo '<option value="'.@$v->id.'" '.((@$result->age_range == @$v->id) ? 'selected' : '').'>'.@$v->age.'</option>';
											}
										}
									?>
								</select>
                            </div>-->														
							<?php	
								if(!empty(@$result->age_range)){
									$selected_category= array(); 							
									$exCat = explode(',', (!empty(@$result->age_range) ? @$result->age_range: ''));		
									foreach ($exCat as $cat){						
									    $selected_category[]= $cat;			
									}	
								}								
							?>


							<div class="form-group mb-2" >                              
							<label class="fw-semibold  text-black">Age</label>		
							<select class="form-control" name="age[]" id="age" multiple data-placeholder="Select Age">		
						    <option value="">Choose Age</option>						
							<?php									
							if(@$age){					
							foreach(@$age as $k => $v){			
							echo '<option value="'.@$v->id.'" '.(in_array(@$v->id,$selected_category) ? 'selected' : '').'>'.@$v->age.'</option>';											
							}										
							}									
							?>								
							</select>             
							</div>
							
							
							<!--<div class="form-group mb-2" >
                                <label class="fw-semibold  text-black">Parental Status</label>
								<select class="form-control" name="parental_status" id="parental_status" required>
								    <option value="Parent" <?=((@$result->parental_status == 'Parent') ? 'selected' : '')?>>Parent</option>
								    <option value="Not a Parent" <?=((@$result->parental_status == 'Not a Parent') ? 'selected' : '')?>>Not a Parent</option>
								</select>
                            </div>--->
							
							
							<div class="form-group mb-2" >
                                <label class="fw-semibold  text-black">Household Income</label>
								<select class="form-control" name="income" id="income" required>
								    <option value="">Choose Income</option>
								    <?php
									    if(@$income){
											foreach(@$income as $k => $v){
												echo '<option value="'.@$v->id.'" '.((@$result->income == @$v->id) ? 'selected' : '').'>'.@$v->income.'</option>';
											}
										}
									?>
								</select>
                            </div>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Location</label>
								<input type="text" class="form-control" name="location"  id="autocomplete" value="<?=@$result->location?>">
								<input type="hidden" class="form-control" name="latitude"  id="latitude" >
								<input type="hidden" class="form-control" name="longitude"  id="longitude" >
                            </div>
							
							<!--<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Radius In Miles</label>
								<input type="text" class="form-control" name="radius"  id="radius" value="<?=@$result->radius?>">
                            </div>-->
							
							
							
							<div class="form-group mb-2" >
                                <label class="fw-semibold  text-black">Status</label>
								<select class="form-control" name="user_status" id="user_status" required>
								    <option value="1" <?=((@$result->status == 1) ? 'selected' : '')?>>Active</option>
								    <option value="0" <?=((@$result->status == 0) ? 'selected' : '')?>>Inactive</option>
								</select>
                                
                            </div>
							
							
                            <div class="form-group mt-3 mb-2">
                                <button class="btn btn-success text-uppercase px-5 shadow">Submit</button>
                                <a class="btn btn-danger waves-effect waves-light m-l-30" href="javascript:history.go(-1)">Back</a>
                            </div>
                        </form>
                     </div>
                  </div>      
                </div>
                
                <!--<div class="col-lg-5 mb-3">
                    <div class="card shadow rounded">
                       <div class="card-body">
                            <div class="row">
                               
								
								 <div class="col-lg-12 mb-3">
									<div class="card rounded">
									<div class="card-body">
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Subscription Name</h6></label><p class="text-muted" id="package-name"></p></div>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Subscription Description</h6></label><p class="text-muted" id="package-description"></p></div>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Subscription Type</h6></label><p class="text-muted" id="package-type"></p></div>
									
									<div class="mt-3" id="pac-amount" style="display:none;"> <label class="tx-11 font-weight-bold mb-0 "><h6>Subscription Amount</h6></label><p class="text-muted" id="package-amount"></p></div>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Subscription Duration</h6> </label><br/><span class="text-muted" id="package-duraction_1"></span> <span class="text-muted" id="package-duraction_2"></span></div>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Status</h6></label><p class="text-muted" id="package-status"></p></div>

									</div>
									</div>
									
                                </div>
                                
                            </div>
                        </div>
                    </div>

                       
                </div>-->


            </div>
        </div>
     </section>
   </div>
 </div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places"></script> <link href='<?php echo url("assets/chosen/chosen.min.css"); ?>' rel='stylesheet' type='text/css'><script src='<?php echo url("assets/chosen/chosen.jquery.min.js"); ?>' type='text/javascript'></script>
<script>
$(document).ready(function(){
	$("#submitform").on('submit', function(e){
		e.preventDefault();
		//var form_data = new FormData(); 	
		$.ajax({
		type: 'POST',
		url: '<?php echo url('admin/subscription/addsub'); ?>',
		data: new FormData(this),
		dataType:"json",
		contentType: false,
		cache: false,
		processData:false,
		error:function(){
		  $('#uploadsuccessfully').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
		},
		success: function(data){
			if(data.status == 1){
				swal({title: "Sucess!", text: "<strong>"+data.message+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('admin/subscription')?>"});
			}
			if(data.status == 0){
				swal({title: "Fail!", text: "<strong>"+data.message+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
			
			if(data.vali_error == 1){
				if(data.pck_name_error != ''){
					$('#pck_name_error').html(data.pck_name_error);
				}else{
					$('#pck_name_error').html('');
				}
				
				if(data.pck_desc_error != ''){
					$('#pck_desc_error').html(data.pck_desc_error);
				}else{
					$('#pck_desc_error').html('');
				}
				
				if(data.pck_amount_error != ''){
					$('#pck_amount_error').html(data.pck_amount_error);
				}else{
					$('#pck_amount_error').html('');
				}
				
				if(data.pck_duration_1_error != ''){
					$('#pck_duration_1_error').html(data.pck_duration_1_error);
				}else{
					$('#pck_duration_1_error').html('');
				}
				
				if(data.pck_duration_2_error != ''){
					$('#pck_duration_2_error').html(data.pck_duration_2_error);
				}else{
					$('#pck_duration_2_error').html('');
				}
				
				if(data.status_error != ''){
					$('#status_error').html(data.status_error);
				}else{
					$('#status_error').html('');
				}
				
				if(data.user_type_error != ''){
					$('#user_type_error').html(data.user_type_error);
				}else{
					$('#user_type_error').html('');
				}
				if(data.pck_type_error != ''){
					$('#pck_type_error').html(data.pck_type_error);
				}else{
					$('#pck_type_error').html('');
				}
				
				
			}
		}
		});
	});

});

 $(document).on('keyup','#name',function(e){
        var pck_name = $(this).val();
        
        if(pck_name){ 
          $("#package-name").text(pck_name);
        }else{
         
          $("#package-name").text('Package Name');
        }
    });
	$("#description").on("summernote.change", function (e) {   // callback as jquery custom event 
		var pckstatus = $(this).val();
		var pck = pckstatus.replace(/(<([^>]+)>)/ig,"");
		if(pck){
		  $("#package-description").text(pck);
		}else{
		  $("#package-description").text('Package Description');
		}
	});
	
	$(document).on('keyup','#amount',function(e){
        var pck_amount = $(this).val();
        
        if(pck_amount){
          $("#package-amount").text('$'+pck_amount);
        }else{
         
          $("#package-amount").text('Package Amount');
        }
    });
	
	
	
	
	
	$(document).on('change','#duration',function(e){
        var pck_duration_1 = $('#duration').val();
       
         if(pck_duration_1){
           $("#package-duraction_1").text(pck_duration_1);
         }
    });
	
	$(document).on('change','#type',function(e){
        var pck_duration_2 = $('#type').val();
		
		if(pck_duration_2 == 1){
          $("#package-duraction_2").text('Month');
        }
		if(pck_duration_2 == 2){
         $("#package-duraction_2").text('Year');
        }
		
       
    });
	
	$(document).on('change','#pckstatus',function(e){
        var pckstatus = $(this).val();
        
        if(pckstatus == 1){
          $("#package-status").text('Active');
        }
		if(pckstatus == 0){
          $("#package-status").text('Inactive');
        }
    });
	
	
	
	
	$(document).on('change','#plan',function(e){
        var pck_type = $('#plan').val();
		if(pck_type == 2){
			var pckType = 'Paid';
			$("#package-type").text(pckType);
		}else if(pck_type == 1){
			var pckType = 'Free';
			$("#package-type").text(pckType);
		}
        if(pck_type == 2){
           $("#amount_type").css('display', 'block');
           $("#pac-amount").css('display', 'block');
        }else if(pck_type == 1){
		   $("#amount_type").css('display', 'none');	
		   $("#pac-amount").css('display', 'none');
		}
		
    });
	
	$(document).on('click','.chkReason',function(e){
        var check = $(this).val();
		if(check == 0){
			$("#mannual_block").css('display', 'block');	
			$("#auto_block").css('display', 'none');	
		}else if(check == 1){
			$("#mannual_block").css('display', 'none');	
			$("#auto_block").css('display', 'block');
		}
		
    });
</script> 
<script>
$(document).ready(function() {
	$('.editor').summernote({
		placeholder: '',
		height: 200
	});
});
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
                    }
                }
            });
        });
    });
</script>

<script>
$(document).ready(function() { 
	var location={
		latitude:'',
		longitude:''
	};
	if (navigator.geolocation){
	    navigator.geolocation.getCurrentPosition(showPosition);
	}
	else{
		//latitudeAndLongitude.innerHTML="Geolocation is not supported by this browser.";
		//
	}

	function showPosition(position){ 
		location.latitude=position.coords.latitude;
		location.longitude=position.coords.longitude;
		//latitudeAndLongitude.innerHTML="Latitude: " + position.coords.latitude + 
		"<br>Longitude: " + position.coords.longitude; 
		var geocoder = new google.maps.Geocoder();
		var latLng = new google.maps.LatLng(location.latitude, location.longitude);

		$('#google_latitude').val(location.latitude);
		$('#google_longitude').val(location.longitude);


		if (geocoder) {
			geocoder.geocode({ 'latLng': latLng}, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					console.log(results); 
					$('#google_address').val(results[0].formatted_address);
				}
				else {
					$('#google_address').html('Geocoding failed: '+status);
					console.log("Geocoding failed: " + status);
				}
			}); //geocoder.geocode()
		}      
	} //showPosition
});

function getlistsgghtate(country_name) {
 
	 $.ajax({
		url: '<?=url("admin/listing/getstate")?>',
		type: "POST",
		dataType: 'html',
		data: {country_name: country_name, "_token": "{{ csrf_token() }}"},
	   
		success: function(response) {
		   $('#statelist').html(response);
		}
	})
}

function getlistcity(state_name) {
 
	 $.ajax({
		url: '<?=url("admin/listing/getcity")?>',
		type: "POST",
		dataType: 'html',
		data: {state_name: state_name, "_token": "{{ csrf_token() }}"},
	   
		success: function(response) {
		   $('#citylist').html(response);
		}
	})
}$(document).ready(function(){	$('#sel1').chosen({disable_search_threshold: 10,width:'200px'});	$('#sel2').chosen({width:'200px'});	$('#sel3').chosen({no_results_text:"Not found",width:'200px'});	$('#age').chosen({max_selected_options:10,width:'100%'});	$('#sel5').chosen({allow_single_deselect:true,width:'200px'});});
</script>
@include('admin.footer');