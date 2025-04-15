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

.fa-times{
	padding: 6px !important;
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
                        <form action="{{url('admin/product/save')}}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Product Name *</label>
                                <input type="text" class="form-control" name="product_name"  id="product_name"  autocomplete="off" required >
                            </div>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Category *</label>
								<select  class="form-control" name="product_category"  id="product_category"  autocomplete="off" required>
								    <option value="">Select Category</option>
									<?php
										if(@$category){
											foreach(@$category as $k => $v){
												echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
											}
										}
									?>
								</select>
                            </div>
							
							<!--<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Subcategory *</label>
								<select  class="form-control" name="product_subcategory"  id="product_subcategory"  autocomplete="off" >
								    <option value="">Select Subcategory</option>
									
								</select>
                            </div>-->
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Listing *</label>
                               
								<select  class="form-control" name="product_listing"  id="product_listing"  autocomplete="off" required>
								    <option value="">Select Listing</option>
									<?php
										if(@$listing){
											foreach(@$listing as $k => $v){
												echo '<option value="'.@$v->id.'">'.@$v->business_name.'</option>';
											}
										}
									?>
								</select>
                            </div>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Price *</label>
                                <input type="number" class="form-control" name="product_price"  id="product_price"  autocomplete="off" required >
                            </div>
							
							<!--<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Special Price *</label>
                                <input type="number" class="form-control" name="product_special"  id="product_special"  autocomplete="off" required >
                            </div>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Quantity On Stock *</label>
                                <input type="number" class="form-control" name="product_quantity"  id="product_quantity"  autocomplete="off" required >
                            </div>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Availability *</label>
                                <select class="form-control" name="product_availability"  id="product_availability" required>
                                    <option value="1">In Stock</option>
									<option value="0">Out of Stock</option>
                                </select>
                            </div>-->
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Tags </label>
                                <!--<input type="number" class="form-control" name="tags"  id="tags"  autocomplete="off" required >-->								<select  name="tags[]" id="tags" autocomplete="off" multiple required>									<option disabled value="">Choose a Tags</option>									<?php										if(@$tags){											foreach(@$tags as $k => $v){												echo '<option value="'.@$v->name.'">'.@$v->name.'</option>';											}										}									?>								</select>
                            </div>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Description * </label>
                                <textarea type="text" class="form-control editor summermote" name="product_description"  id="product_description"  autocomplete="off"  required></textarea>
                            </div>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Product Image </label>
                                <input type="file" class="form-control" name="product_image[]"  id="product_image"  autocomplete="off" multiple>
                            </div>
							<div class="eventphoto my-3 specific_preview">
							
							</div>
							
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Status</label>
                                <select class="form-control" name="product_status"  id="product_status" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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
                
                <!--<div class="col-lg-6 mb-3">
                    <div class="card shadow rounded">
                       <div class="card-body">
                            <div class="row">
								<div class="col-lg-12 mb-3">
									<div class="card rounded">
										<div class="card-body">
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Category Name</h6></label><p class="text-muted" id="package-name"></p></div>

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
 </div><link href='<?php echo url("assets/chosen/chosen.min.css"); ?>' rel='stylesheet' type='text/css'><script src='<?php echo url("assets/chosen/chosen.jquery.min.js"); ?>' type='text/javascript'></script> 
<script>
var num = 0;
var dataTransfer = new DataTransfer();
const input = document.querySelector('#product_image');
$(document).ready(function(e){
	$(document).on('change','#product_image',function(e){
		//$("#sortable").css('opacity','0.05');
		var output = $(".specific_preview");
		var totalfiles = document.getElementById('product_image').files.length;
		
				var match = ['image/jpeg', 'image/png', 'image/jpg', 'image/jpg', 'image/gif'];
				for (var index = 0; index < totalfiles; index++) {
					dataTransfer.items.add(document.getElementById('product_image').files[index]);
					var fileType = document.getElementById('product_image').files[index].type;
					if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]))){
						swal({title: "Fail", text: "<strong>Sorry only JPG, JPEG, GIF, PNG files are allowed to upload.</strong>", type: "error", showConfirmButton: true, html:true});
						return false;
					}else{
						var fileName = document.getElementById('product_image').files[index].name;
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
	});	$('#tags').chosen({max_selected_options:10,width:'100%'});
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
</script> 
<script>
$(document).ready(function() {
	$('.editor').summernote({
		placeholder: '',
		height: 200
	});
});

$(document.body).on('click', '#product_category' ,function(){ 
		var category = $(this).val();
		
		$.ajax({      
		url: '<?=url('admin/product/getSub')?>',       
		type: 'POST',            
		data:{category:category, "_token": "{{ csrf_token() }}"},
		success: function(data){
			// if(data == 1){
				// $('#preview'+item+'').remove();
			// }
			$('#product_subcategory').html(data);
		}
		});
	});
</script>
@include('admin.footer');