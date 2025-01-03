<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
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
                        <form  id="formsAssignmentValidate" method="post" enctype="multipart/form-data" >
                            @csrf
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">User Type</label>
                                <select class="form-control" name="user_type" id="user_type" required >
                                    <option value="">Choose UserType</option>
									<?php
									    if(!empty($userType)){
									        foreach($userType as $k => $v){
									            echo '<option value="'.$v->id.'" '.((@$result->user_type == @$v->id) ? 'selected' : '').'>'.$v->name.'</option>';
									        }
									    }
									?>
								</select>
                            </div>
                            
                            <div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Subscription Name</label>
                                <input type="text" class="form-control" name="name"  id="name"  value="<?=@$result->name?>" autocomplete="off">
                                <input type="hidden" class="form-control" name="id"  id="id"  value="<?=@$result->id?>">
                            </div>
							<small id="pck_name_error"></small>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Subscription Description</label>
                                <textarea type="text" class="form-control editor summermote" name="description"   id="description"  autocomplete="off"><?=@$result->description?></textarea>
                            </div>
							<small id="pck_desc_error"></small>
							
							<?php
							    $access = [];
							    if($result->access){
									$exAccess = explode(',', $result->access);
									foreach($exAccess as $k => $v){
										$access[] = $v;
									}
								}
							?>
							<div class="form-group mb-2">
							    <label class="fw-semibold  text-black">Choose Features </label>
							    <!--<ul style="list-style: none;">
								    <li><input type="checkbox" name="access[]" id="access" class="event_category" value="Business" style="width: 15px;height: 15px;" <?=(in_array('Business',$access) ? 'checked' : '')?>> &nbsp; <label class="fw-semibold1  text-black" style="font-weight: 400;">Business Management</label></li>
									
								    <li><input type="checkbox" name="access[]" id="access" class="event_category" value="Event" style="width: 15px;height: 15px;" <?=(in_array('Event',$access) ? 'checked' : '')?>> <label class="fw-semibold1  text-black" style="font-weight: 400;"> &nbsp; Event Management</label></li>
									
								    <li><input type="checkbox" name="access[]" id="access" class="event_category" value="Invitation" style="width: 15px;height: 15px;" <?=(in_array('Invitation',$access) ? 'checked' : '')?>> <label class="fw-semibold1  text-black" style="font-weight: 400;"> &nbsp; Invitation Management</label></li>
									
								    <li><input type="checkbox" name="access[]" id="access" class="event_category" value="Promotion" style="width: 15px;height: 15px;" <?=(in_array('Promotion',$access) ? 'checked' : '')?>> <label class="fw-semibold1  text-black" style="font-weight: 400;"> &nbsp; Promotion Management</label></li>
								</ul>-->
								
								<div class="col-lg-12 mb-3">
										<table id="datatable_2" class="table table-bordered dt-responsive nowrap w-100">
											<thead class="thead-light text-center">
												<tr>
													<th width="30"><input type="checkbox" id="checkAll"/></th>
													<th width="200" style="text-align: left;">Name</th>
													<th width="150">Has Read Access</th>
													<th width="150">Has Write Access</th>
													<th width="150">Number Of</th>
												</tr>
											</thead>
											<tbody id="menu-list">
												<?php
												
												if(!empty($menus)){
													$i = 1;
													foreach ($menus as $key => $row){
														?>
														<tr data-menu-id="<?=$row->id?>">
														    <?php
															   $check =  DB::table('sub_permision_menu')->where(['sub_id' => $result->id, 'menu_id' => $row->id])->select('*')->first();
															   
															    if(@$check->read_access == 1 || @$check->write_access == 1 || @$check->full_access == 1){
																    $percolumn =   'checked';
															    }else{
																	$percolumn =   '';
																}
															?>
															
															<td><input type="checkbox" class="menu-checkbox" name="menu_check" id="menu_check_<?=$row->id?>"  relid="<?=$row->id?>" <?=@$percolumn?>/></td>
															<td style="text-align: left;">
															   <?php
																	if (@$row->menu){
																		echo $row->menu;
																	}else{
																		echo '&#8212';
																	}
																?>
																
															</td>
															
															<td>
																<input type="checkbox" name="has_read_access" relid-1="<?=$row->id?>" class="access-checkbox classMenu_<?=$row->id?>" <?=((@$check->read_access == 1) ? 'checked' : '')?>/>
															</td>
															<td>
																<input type="checkbox" name="has_write_access" relid-1="<?=$row->id?>" class="access-checkbox classMenu_<?=$row->id?>" <?=((@$check->write_access == 1) ? 'checked' : '')?>/>
															</td>
															<td>
																<input type="checkbox" name="has_full_access" relid-1="<?=$row->id?>" class="access-checkbox classMenu_<?=$row->id?>" <?=((@$check->full_access == 1) ? 'checked' : '')?>/>
																
																<input type="text" name="number_count_<?=$row->id?>" relid-1="<?=$row->id?>" class="access-checkbox classMenu_<?=$row->id?> form-control_1" style="width: 50%;margin-left: 20px;color: #212529;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;" value="<?=@$check->number_of?>"/>
															</td>
														</tr>
													<?php } } ?>
												
											</tbody>
										</table>
									</div>
							</div>
							
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Subscription Plan</label>
                                <select class="form-control" name="plan" id="plan">
									<option value="1" <?=((@$result->plan == 1) ? 'selected' : '')?>>Free</option>
									<option value="2" <?=((@$result->plan == 2) ? 'selected' : '')?>>Paid</option>
								</select>
                            </div>
							<small id="pck_type_error"></small>
							
							
							<div id="amount_type" style="display:<?=((@$result->plan == 2) ? 'block' : 'none')?>;">
								<div class="form-group mb-2" >
									<label class="fw-semibold  text-black">Subscription Amount</label>
									<input type="text" class="form-control" name="amount"  id="amount"  value="<?=@$result->amount?>" autocomplete="off">
								</div>
								<small id="pck_amount_error"></small>
							</div>
							
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Subscription Duration</label>
								<div class="row">
								    <div class="col-sm-6">
								      <!--<input type="number" class="form-control" name="pck_name"  id="pck_name"  autocomplete="off">-->
									    <select class="form-control" name="duration" id="duration">
											<option value="">Select Duration</option>
											<?php for($i = 1; $i<=12; $i++){ ?>
											    <option value="<?php echo $i; ?>" <?=((@$result->duration == $i) ? 'selected' : '')?>><?php echo $i; ?></option>
											<?php } ?>
									    </select>
								    </div>
								    <div class="col-sm-6">
								        <select class="form-control" name="type" id="type">
											<option value="1" <?=((@$result->type == 1) ? 'selected' : '')?>>Month</option>
											<option value="2" <?=((@$result->type == 2) ? 'selected' : '')?>>Year</option>
									    </select>
								    </div>
								</div>
                            </div>
							
							<small id="pck_duration_1_error"></small>
							<small id="pck_duration_2_error"></small>
							
							<div class="form-group mb-2">
                                <label class="fw-semibold  text-black">Status</label>
                                <select class="form-control" name="pckstatus"  id="pckstatus">
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
									
									<!--<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>User Type</h6></label><p class="text-muted" id="user-type"></p></div>-->
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Subscription Name</h6></label><p class="text-muted" id="package-name"><?=@$result->name?></p></div>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Subscription Description</h6></label><p class="text-muted" id="package-description"><?=strip_tags(@$result->description)?></p></div>
									
									 <?php
										if(@$result->plan == 1){
											$plan = 'Free';
										}else{
											$plan = 'Paid';
										}
									?>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Subscription Plan</h6></label><p class="text-muted" id="package-type"><?=@$plan?></p></div>
									
									<div class="mt-3" id="pac-amount" style="display:<?=((@$result->plan == 2) ? 'block' : 'none')?>;"> <label class="tx-11 font-weight-bold mb-0 "><h6>Subscription Amount</h6></label><p class="text-muted" id="package-amount"><?=@$result->amount?></p></div>
									
										<?php
											if(@$result->type == 1){
												$type = 'Month';
											}else{
												$type = 'Year';
											}
										?>
										
										<?php
											if(@$result->status == 1){
												$status = 'Active';
											}elseif(@$v->status == 0){
												$status = 'Inactive';
											}
										?>
									
									<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Subscription Duration</h6> </label><br/><span class="text-muted" id="package-duraction_1"><?=@$result->duration?></span> <span class="text-muted" id="package-duraction_2"><?=@$type?></span></div>
									
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
	
	$("#productMng").change(function() {
        if (this.checked) {
            $(".productMng_menu").each(function() {
                this.checked=true;
            });
        } else {
            $(".productMng_menu").each(function() {
                this.checked=false;
            });
        }
    });
	
	$(".productMng_menu").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".productMng_menu").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#productMng").prop("checked", true);
            }     
        }
        else {
            $("#productMng").prop("checked", false);
        }
    });
	
    });
	
	
	
	$(document).ready(function() {
            // Automatically check read and write access if full access is checked
            $(document).on('change', 'input[name="has_full_access"]', function() {
                if ($(this).is(':checked')) {
                    $(this).closest('tr').find(
                        'input[name="has_read_access"], input[name="has_write_access"]').prop('checked',
                        true);
                }
            });

            // Check/uncheck all checkboxes when the master checkbox is changed
            $('#checkAll').change(function() {
                $('input[type="checkbox"]').prop('checked', $(this).is(':checked'));
				
				if($(this).is(':checked')){
					$('.form-control_1').val(1);
				}else{
					$('.form-control_1').val(0);
				}
				
            });

            // Check/uncheck read, write, and full access when a menu checkbox is changed
            $(document).on('change', '.menu-checkbox', function() {
                const isChecked = $(this).is(':checked');
                $(this).closest('tr').find('input[type="checkbox"]').prop('checked', isChecked);

                // Update master checkbox state
                updateMasterCheckbox();
				
				if($(this).is(':checked')){
					//$('.form-control_1').val(1);
					$(this).closest('tr').find('.form-control_1').val(1);
				}else{
					$(this).closest('tr').find('.form-control_1').val(0);
				}
				
            });

            // Uncheck menu checkbox if all access checkboxes are unchecked
            $(document).on('change',
                'input[name="has_read_access"], input[name="has_write_access"], input[name="has_full_access"]',
                function() {
                    const $row = $(this).closest('tr');
                    const allUnchecked = !$row.find('input[name="has_read_access"]').is(':checked') &&
                        !$row.find('input[name="has_write_access"]').is(':checked') &&
                        !$row.find('input[name="has_full_access"]').is(':checked');
                    $row.find('.menu-checkbox').prop('checked', !allUnchecked);

                    // Update master checkbox state
                    updateMasterCheckbox();
                });
            
			
			$(document).on('change',
                'input[name="has_write_access"]',
                function() {
					const isChecked = $(this).is(':checked');
                    const $row = $(this).closest('tr');
					
                    // const allUnchecked = !$row.find('input[name="has_read_access"]').is(':checked') &&
                        // !$row.find('input[name="has_write_access"]').is(':checked') &&
                        // !$row.find('input[name="has_full_access"]').is(':checked');
                    // $row.find('.menu-checkbox').prop('checked', !allUnchecked);

                    // Update master checkbox state
					$(this).closest('tr').find('input[name="has_full_access"]').prop('checked', isChecked);
					if(isChecked){
						//$('.form-control_1').val(1);
						$(this).closest('tr').find('.form-control_1').val(1);
					}else{
						$(this).closest('tr').find('.form-control_1').val(0);
					}
                updateMasterCheckbox();
            });
            

            $('#formsAssignmentValidate').on('submit', function(event) {
                event.preventDefault();

                let formData = {
                    //_token: $('input[name=_token]').val(),
                    //role_id: $('#role_id').val(),
                    user_type: $('#user_type').val(),
                    name: $('#name').val(),
                    
                    description: $('#description').val(),
                    plan: $('#plan').val(),
                    amount: $('#amount').val(),
                    duration: $('#duration').val(),
                    type: $('#type').val(),
                    pckstatus: $('#pckstatus').val(),
                    id: $('#id').val(),
                    menus: [],
					"_token": "{{ csrf_token() }}"
                };

                // Check if a role is selected
                // if (!formData.role_id) {
                    // showAlert("Please select a role.", 'danger');
                    // return;
                // }

                let menuSelected = false;
                $('table tbody tr').each(function() {
                    if ($(this).find('.menu-checkbox').is(':checked')) {
                        menuSelected = true;
                        let menu_id = $(this).data('menu-id');
                        let has_read_access = $(this).find('input[name="has_read_access"]').is(
                            ':checked') ? 1 : 0;
                        let has_write_access = $(this).find('input[name="has_write_access"]').is(
                            ':checked') ? 1 : 0;
                        let has_full_access = $(this).find('input[name="has_full_access"]').is(
                            ':checked') ? 1 : 0;
							
						let number_count = 	$('input[name="number_count_'+menu_id+'"]').val();

                        let menuData = {
                            menu_id: menu_id,
                            has_read_access: has_read_access,
                            has_write_access: has_write_access,
                            has_full_access: has_full_access,
							number_count: number_count,
                            status: (has_read_access || has_write_access || has_full_access) ?
                                1 : 0
                        };

                        formData.menus.push(menuData);
                    }
                });

                // Check if at least one menu is selected
                // if (!menuSelected) {
                    // showAlert("Please select at least one menu.", 'danger');
                    // //return;
                // }

                $.ajax({
                    url: "<?=url('admin/subscription/update')?>",
                    method: "POST",
                    data: formData,
                    dataType: 'JSON',
                    success: function(response) {
						if(response.status == 1){
						    swal({title: "Sucess!", text: "<strong>"+response.message+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('admin/subscription')?>"});
						}
						if(response.status == 0){
						    swal({title: "Fail!", text: "<strong>"+response.message+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = ""});
						}
                    },
                    error: function(response) {
                        showAlert('Error updating role assignments.', 'danger');
                    }
                });
            });

            function showAlert(message, type) {
                $('#alert-message').text(message);
                $('#alert-box').removeClass('alert-success alert-danger').addClass('alert-' + type).show();
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");
            }

            function updateMasterCheckbox() {
                const allChecked = $('table tbody tr').length === $('table tbody tr .menu-checkbox:checked').length;
                $('#checkAll').prop('checked', allChecked);
            }
        });
	
</script>
@include('admin.footer');