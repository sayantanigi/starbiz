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

                <div class="col-lg-6 mb-3">
                  <div class="card shadow rounded">
                     <div class="card-body">    
                        <form action="{{url('admin/tags/update')}}" method="post" enctype="multipart/form-data" >
                            @csrf

							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Tags Name</label>
                                <input type="text" class="form-control" name="name"  id="name" required value="<?=@$result->name?>">
                                <input type="hidden" class="form-control" name="id"  id="id" value="<?=@$result->id?>">
                            </div>

							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Status</label>
                                <select class="form-control" name="pckstatus"  id="pckstatus" required>
                                    <option value="">Select Status</option>
                                    <option value="1" <?=((@$result->status == 1) ? 'selected' : '')?>>Active</option>
                                    <option value="0" <?=((@$result->status == 0) ? 'selected' : '')?>>Inactive</option>
                                </select>
                            </div>
							<small id="status_error"></small>
							
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
											<!--<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Category Name</h6></label><p class="text-muted" id="package-name"></p></div>-->
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Tags Name</h6></label><p class="text-muted" id="subcategory-name"><?=@$result->name?></p></div>
                                            <?php
											    $status = '';
											    if(@$result->status == 1){
													$status = 'Active';
												}elseif(@$result->status == 0){
													$status = 'Inactive';
												}
											?>
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Status</h6></label><p class="text-muted" id="package-status"><?=@$status?></p></div>
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

$(document).on('change','#category',function(e){
	var pck_name = $(this).val();
	
	if(pck_name){ 
	  $("#package-name").text(pck_name);
	}else{
	 
	  $("#package-name").text('Category Name');
	}
});

$(document).on('keyup','#name',function(e){
	var pck_name = $(this).val();
	
	if(pck_name){ 
	  $("#subcategory-name").text(pck_name);
	}else{
	  $("#subcategory-name").text('Tags Name');
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
</script> 
<script>
$(document).ready(function() {
	$('.editor').summernote({
		placeholder: '',
		height: 200
	});
});
</script>
@include('admin.footer');