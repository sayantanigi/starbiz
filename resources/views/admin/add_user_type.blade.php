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
/*crop*/

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

.preview3 {
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
.files:after {  pointer-events: none;
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
                        <form id="submitform" action="{{url('admin/save-user-type')}}" method="post" enctype="multipart/form-data" >
                             @csrf
                            <div class="form-group mb-2">
                                <label class="fw-semibold  text-black">User Type</label>
                                <input type="text" class="form-control" name="name"  id="name" required autocomplete="off">
								<span id="domainName_error" class="text-danger"></span>
                            </div>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Status</label>
                                <select class="form-control" name="status" required id="userstatus">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
								<span id="status_error" class="text-danger"></span>
                            </div>
							
							
							
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
                               
								
								 <div class="col-lg-12 mb-3">
										<div class="card rounded">
											<div class="card-body">
												<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>User Type</h6></label><p class="text-muted" id="first_name"></p></div>

												<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Status</h6></label><p class="text-muted" id="coach_status"></p></div>
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
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="profile_closeModal();">Cancel</button>
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
			<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cover_closeModal();">Cancel</button>
		</div>
	</div>
</div>
</div>


<div class="modal fade" id="modal_teamImg" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Crop Image Before Upload</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="teamimg_closeModal();">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="img-container">
				<div class="row">
					<div class="col-md-8">
						<img src="" id="teamImage" />
					</div>
					<div class="col-md-4">
						<div class="preview2"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" id="crop_team_image" class="btn btn-primary">Crop</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="teamimg_closeModal();">Cancel</button>
		</div>
	</div>
</div>
</div>


<div class="modal fade" id="modal_coverteamImg" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Crop Image Before Upload</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="coverimg_closeModal();">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="img-container">
				<div class="row">
					<div class="col-md-8">
						<img src="" id="coverteamImage" />
					</div>
					<div class="col-md-4">
						<div class="preview2"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" id="cropcover_team_image" class="btn btn-primary">Crop</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="coverimg_closeModal();">Cancel</button>
		</div>
	</div>
</div>
</div>

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


 $(document).on('keyup','#name',function(e){
        var fname = $(this).val();
        
        if(fname){
          $("#first_name").text(fname);
          $("#f-name").text(fname);
        }else{
         
          $("#first_name").text('Domain Name');
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
          $("#coach_email").text(email);
        }else{
         
          $("#coach_email").text('Email');
        }
    });
	
	$(document).on('keyup','#phone',function(e){
        var phone = $(this).val();
        
        if(phone){
          $("#coach_phone").text(phone);
        }else{
         
          $("#coach_phone").text('phone');
        }
    });
	$(document).on('change','#sport',function(e){
        var sport = $(this).val();
		
       $.ajax({
		type: 'POST',
		url: '<?php echo url('admin/users/getSport_byId'); ?>',
		data: {sportId : sport},
		success: function(data){
			$("#coach_sport").text(data);
		}
		});
        
    });
	
	$(document).on('change','#userstatus',function(e){
        var status = $(this).val();
        
        if(status == 1){
          $("#coach_status").text('Active');
        }
		if(status == 0){
          $("#coach_status").text('Inactive');
        }
    });
	
	$(document).on('keyup','#team_name',function(e){
        var team_name = $(this).val();
        
        if(team_name){
          $("#coach_team_name").text(team_name);
        }else{
         
          $("#coach_team_name").text('');
        }
    });
	
	$(document).on('keyup','#team_description',function(e){
        var team_description = $(this).val();
        
        if(team_description){
          $("#coach_team_desc").text(team_description);
        }else{
         
          $("#coach_team_desc").text('');
        }
    });

</script> 

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places"></script>
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
@include('admin.footer');