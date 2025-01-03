@include('admin.header');
@include('admin.sidebar');
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
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
	.files{ 
	    position:relative
	}
	
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
	.color input{
	    background-color:#f1f1f1;
	}
	
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
	.btn-group{
		width: 100% !important;
	}
	
	.dropdown-toggle{
		width: 100% !important;
	}
	.multiselect-container{
		width: 100% !important;
	}
</style>
<div class="main-content">
  <div class="page-content">	
     <div class="container-fluid">
		 <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0"><?= $title ?></h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
                    </div>

                </div>
            </div>
         </div>

<div class="row">
<div class="col-md-12">

    @if (session('status'))
		<div class="alert alert-success" role="alert" style="width: 98%;margin: 0 auto;">
			{{ session('status') }}
		</div><br/>
	@elseif (session('error'))
		<div class="alert alert-danger" role="alert" style="width: 98%;margin: 0 auto;">
			{{ session('error') }}
		</div><br/>
	@endif
	
<div id="page-wrapper">
	<div class="container-fluid">
		
		<form action="{{url('admin/message/saveMessage')}}" method="POST" enctype="multipart/form-data" >
		    @csrf
			<div class="row">
				<div class="col-md-12">
					<div class="card">
                   <div class="card-body">
						<h3 class="box-title m-b-30 m-t-10"><?= $title ?></h3>
						<div class="row">
							<div class="col-sm-8">
							
							<!--<div class="form-group mb-2">
								<label class="fw-semibold  text-black">Select User</label>
								<select class="form-control select2" name="user[]"  id="user" multiple="multiple" required data-placeholder="Select User">
									<option value="" disabled>Select User</option>
									<?php
									    if(@$result){
											
											foreach(@$result as $k => $v){
												$userType = DB::table('user_type')->where(['id' => @$v->user_type])->select('*')->orderBy('id', 'DESC')->first();

												echo '<option value="'.@$v->id.'">'.@$v->first_name.' '.@$v->last_name.'  ('.@$userType->name.')</option>';
											}
										}
									?>
								</select>
							</div>
							<small id="status_error"></small>-->
							
							<div class="form-group mb-2" style="margin-left: 12px;">
								<label class="fw-semibold  text-black">ATHLETES & ENTERTAINERS</label>
								<select id="multiple-checkboxes" multiple="multiple" class="form-control" name="user[]">
									<?php
									    if(@$result){
											
											foreach(@$result as $k => $v){
												$userType = DB::table('user_type')->where(['id' => @$v->user_type])->select('*')->orderBy('id', 'DESC')->first();

												echo '<option value="'.@$v->id.'">'.@$v->first_name.' '.@$v->last_name.'  ('.@$userType->name.')</option>';
											}
										}
									?>
								</select>
							</div>
							<br/>
							
							<div class="form-group mb-2" style="margin-left: 12px;">
								<label class="fw-semibold  text-black">SERVICE PROVIDER</label>
								<select id="multiple-checkboxes1" multiple="multiple" class="form-control" name="otheruser[]">
									<?php
									    if(@$result1){
											
											foreach(@$result1 as $k => $v){
												$userType = DB::table('user_type')->where(['id' => @$v->user_type])->select('*')->orderBy('id', 'DESC')->first();

												echo '<option value="'.@$v->id.'">'.@$v->first_name.' '.@$v->last_name.'  ('.@$userType->name.')</option>';
											}
										}
									?>
								</select>
							</div>
							<br/>
								
							<div class="form-row mb-3 mt-3">
								<div class="form-group col-md-12">
									<label class="fw-semibold  text-black">Message</label>
									<textarea name="message" id="message" class="form-control editor1 summermote1" style="height: 120px;" required>
									</textarea>
								</div>
							</div>
							<small id="message_error"></small>
							
							
								
							<div class="col-sm-6 col-sm-offset-2 mb-3" style="margin-left: 0%;">
								<div class="form-group">
									<input type="submit" class="btn btn-success" name="submit" id="submit" value="Save"/>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</form>
	</div>
			  
			</div>
		</div>
	 </div> 	
  </div> 
<script type="text/javascript">

 $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
        });
    });
	
	 $(document).ready(function() {
        $('#multiple-checkboxes1').multiselect({
          includeSelectAllOption: true,
        });
    });
	
$(document).ready(function() {
	$('.editor').summernote({
		placeholder: 'About Us Body',
		height: 200
	});
});

document.getElementById("upload_image").onchange = function(event) {
	let file = event.target.files[0];
	var extension = file.name.split('.').pop().toLowerCase();
	if(extension == 'jpg' ||  extension == 'jpeg' || extension == 'gif' || extension == 'png'){
		let blobURL = URL.createObjectURL(file);
		document.getElementById("blahImg").src = blobURL;
		$('#blahImg').css('display', 'block');	
		$('#blahVideo').css('display', 'none');	
	}else{
		let blobURL = URL.createObjectURL(file);
		document.getElementById("blahVideo").src = blobURL;
		$('#blahImg').css('display', 'none');	
		$('#blahVideo').css('display', 'block');	
	}
}
</script>
<script>
$(document).ready(function(){
	$("#submitAboutus").on('submit', function(e){
		e.preventDefault();
		var form_data = new FormData(); 	
		$.ajax({
		type: 'POST',
		url: '<?php echo url('admin/cms/saveAboutus'); ?>',
		data: new FormData(this),
		dataType:"json",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function(){
			$(".progress-bar").width('0%');
			//$('#uploadsuccessfully').html('<img src="images/ajaxloading.gif"/>');
		},
		error:function(){
		  $('#uploadsuccessfully').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
		},
		success: function(data){
			if(data.vali_error == 1)
			{
				if(data.heading_error != '')
				{
				    $('#heading_error').html(data.heading_error);
				}else{
					$('#heading_error').html('');
				}
				
				if(data.description_error != ''){
					$('#description_error').html(data.description_error);
				}else{
					$('#description_error').html('');
				}
				
				if(data.status_error != ''){
					$('#status_error').html(data.status_error);
				}else{
					$('#status_error').html('');
				}
				
				
			}
			
			if(data.status == 1)
			{
              swal({title: "Sucess!", text: "<strong>"+data.message+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('admin/cms/about_us')?>"});
			}
			
		}
		});
	});

});

$('.select2[multiple]').select2({
    width: '100%',
    closeOnSelect: false
})
</script> 
@include('admin.footer');