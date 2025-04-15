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
                        <form action="{{url('admin/listing/save')}}" method="post" enctype="multipart/form-data" >
                            @csrf
							
                            <div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Business Name * </label>
                                <input type="text" class="form-control" name="listing_business_name"  id="listing_business_name"  autocomplete="off" required>
                            </div>
							<small id="pck_listing_business_name"></small>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Name </label>
								 <input type="text" class="form-control" name="listing_name"  id="listing_name"  autocomplete="off" >
                                <!--<textarea type="text" class="form-control editor summermote" name="description"  id="description"  autocomplete="off"></textarea>-->
                            </div>
							
							
							<!--<div class="form-group mb-2">
                                
								<div class="row">
								
								    <div class="col-sm-6">
									<label class="fw-semibold  text-black">Country *</label>
									    <select class="form-control" name="country" id="country" onchange="getlistsgghtate($(this).val());" required>
										
										   <?php
											    if(!empty(@$country)){
													foreach(@$country as $k => $v){
														echo '<option value="'.$v->id.'" '.((@$v->id == 231) ? 'selected' : '').'>'.$v->name.'</option>';
													}
												}
											?>
											
									    </select>
								    </div>
								    <div class="col-sm-6">
									<label class="fw-semibold  text-black">State *</label>
								        <select class="form-control" name="state" id="statelist" onchange="getlistcity($(this).val());" required>
											<option value="">Select State</option>
											<?php 
											    $statelist = DB::table('states')->where(['country_id' => 231])->select('*')->orderBy('name', 'ASC')->get();
												foreach($statelist as $k => $v){
													echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
												}
											?>
									    </select>
								    </div>
								</div>
                            </div>-->
							
							<div class="form-group mb-2">
                                
								<div class="row">
								
								   <!-- <div class="col-sm-6">
									<label class="fw-semibold  text-black">City *</label>
									    <select class="form-control" name="city" id="citylist" required>
											<option value="">Select City</option>
									    </select>
								    </div>-->
									
								    <div class="col-sm-12">
									<label class="fw-semibold  text-black">Category * </label>
								        <select class="form-control" name="category" id="category" required onchange="getlistsubcategory($(this).val());">
											 <?php
											    if(!empty(@$cat)){
													foreach(@$cat as $k => $v){
														echo '<option value="'.$v->id.'">'.$v->name.'</option>';
													}
												}
											?>
									    </select>
								    </div>
									
									<!--<div class="col-sm-6">
									    <label class="fw-semibold  text-black">Subategory * </label>
								        <select class="form-control" name="subcategory" id="subcategory" required >
											<option value="">Select Subategory</option>
									    </select>
								    </div>-->
									
								</div>
                            </div>
							<!--<br/>
							<div class="form-group mb-2">
								<div class="row">
								    <div class="col-sm-6">
										<label class="fw-semibold  text-black"> 
										<input type="radio"  value="1"  name="online_business"  style="width: 20px;height: 20px;" > &nbsp;  <span>Online Business</span></label>
								    </div>
								</div>
                            </div>
							
							<br/>
							
							<div class="form-group mb-2">
								<div class="row">
								    <div class="col-sm-6">
										<label class="fw-semibold  text-black"> 
										<input type="radio" class="chkReason" id="chkmap" value="0"  name="chk_address"  style="width: 20px;height: 20px;" checked> &nbsp;  <span>Do not have Google Map Address?</span></label>
								    </div>
									
									 <div class="col-sm-6">
										<label class="fw-semibold  text-black"> 
										<input type="radio" class="chkReason" id="chkgooglmap" value="1"  name="chk_address"  style="width: 20px;height: 20px;">&nbsp;  <span>I have Google Map Address?</span></label>
								    </div>
								</div>
                            </div>
							
							
							<div class="form-group mb-2" id="mannual_block">
								<div class="col-sm-12">
									<label class="fw-semibold  text-black">Address </label>
									<input type="text" name="address" id="address" class="form-control" >
								</div>
									
								<div class="row">
								    <div class="col-sm-6">
										<label class="fw-semibold  text-black"> Latitude</label>
										<input type="text" name="latitude" id="latitude" class="form-control" >
								    </div>
									
									 <div class="col-sm-6">
										<label class="fw-semibold  text-black">  Longitude</label>
										<input type="text" name="longitude" id="longitude" class="form-control" >
								    </div>
								</div>
                            </div>-->
							
							<div class="form-group mb-2" id="auto_block" style="">
								<div class="col-sm-12">
									<label class="fw-semibold  text-black">Address </label>
									<input type="text" name="google_address" id="google_address" class="form-control" >
									<input type="hidden" name="google_latitude" id="google_latitude" class="form-control" >
									<input type="hidden" name="google_longitude" id="google_longitude" class="form-control" >
								</div>
                            </div>
							
							
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Description * </label>
                                <textarea type="text" class="form-control editor summermote" name="description"  id="description"  autocomplete="off"  required></textarea>
                            </div>
							
							<div class="form-group mb-2">
								<label class="fw-semibold  text-black">Tags </label>
								<!--<input type="text" class="form-control" name="listing_tags"  id="listing_tags"  autocomplete="off" placeholder="Ex: #SmallBusiness, #ShopSmall">-->
								
								<select  name="listing_tags[]" id="listing_tags" autocomplete="off" multiple>
									<option disabled value="">Choose a Tags</option>
									<?php
										if(@$tags){
											foreach(@$tags as $k => $v){
												echo '<option value="'.@$v->name.'">'.@$v->name.'</option>';
											}
										}
									?>
								</select>
                            </div>
							
							
							<div class="form-group mb-2">
                                
								<div class="row">
								
								    <div class="col-sm-6">
									<label class="fw-semibold  text-black">Phone *</label>
									    <input  type="number" class="form-control" name="phone" id="phone" required>

								    </div>
								    <div class="col-sm-6">
									<label class="fw-semibold  text-black">Email *</label>
								        <input type="email" class="form-control" name="email" id="email" required>
											
									  
								    </div>
								</div>
                            </div>
							
							<div class="form-group mb-2">
                                
								<div class="row">
								
								    <div class="col-sm-12">
									<label class="fw-semibold  text-black">Webiste</label>
									    <input type="text" class="form-control" name="website" id="website">
										
								    </div>
								    
								</div>
                            </div>
							
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Upload Images</label>
								 <input type="file" class="form-control" name="listing_gallery[]"  id="listing_gallery" multiple>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places"></script> 
<link href='<?php echo url("assets/chosen/chosen.min.css"); ?>' rel='stylesheet' type='text/css'>
<script src='<?php echo url("assets/chosen/chosen.jquery.min.js"); ?>' type='text/javascript'></script> 
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
    $('#listing_tags').chosen({max_selected_options:10,width:'100%'});
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
        var places = new google.maps.places.Autocomplete(document.getElementById('google_address'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
			$('#google_latitude').val(place.geometry['location'].lat());
			$('#google_longitude').val(place.geometry['location'].lng());
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
                        // document.getElementById('country').value = country;
                        // document.getElementById('state').value = state;
                        // document.getElementById('city').value = city;
                        // document.getElementById('pincode').value = pin;
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

function getlistsubcategory(catId) {
 
	 $.ajax({
		url: '<?=url("admin/listing/getlistsubcategory")?>',
		type: "POST",
		dataType: 'html',
		data: {catId: catId, "_token": "{{ csrf_token() }}"},
	   
		success: function(response) {
		   $('#subcategory').html(response);
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
}
</script>
@include('admin.footer');