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

                <div class="col-lg-8 mb-3">
                  <div class="card shadow rounded">
                     <div class="card-body">    
                        <div class="row">
								<div class="container">
									<div class="col-md-12">
										<div class="profile clearfix"> 
											<?php
												$bgimage = DB::table('event_image')->where(['event_id' => @$result->id])->select('*')->orderBy('id', 'ASC')->first();
											?>										
											<div class="image item" id="Cover-Image">
											    <img src="<?= ((!empty(@$bgimage->image) && file_exists('public/events/'.@$bgimage->image.'')) ? url('events/'.@$bgimage->image.'') : url('events/bnr.jpg')); ?>" class="img-cover">
											</div>                            
											<!--<div class="user clearfix">
												<div class="avatar item" id="itemImage">
													<img src="<?= ((!empty(@$result->front_image) && file_exists('public/events/'.@$result->front_image.'')) ? url('events/'.@$result->front_image.'') : url('events/bnr.jpg')); ?>" class="img-thumbnail img-profile">
												</div>                                
												<h2><span id="f-name"></span> <span id="l-name"></span></h2>                                                                                     
											</div> -->                       
											                             
										</div>
									</div>
								</div>
                                <div class="col-lg-12 mb-3">
									<div class="card rounded">
										<div class="card-body">
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Event Name</h6></label><p class="text-muted" id="game_name"><?=@$result->event_name; ?></p></div>
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Description</h6></label><p class="text-muted" id="game_description"><?=strip_tags(@$result->description); ?></p></div>
											
											<?php
											    //$category = $this->db->query("select * from event_category where id = ".@$result->category."")->row(); 
												$category = DB::table('event_category')->where(['id' => @$result->category])->select('*')->orderBy('id', 'DESC')->first();
											?>
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Category</h6></label><p class="text-muted" id="game_description"><?=@$category->name ?></p></div>
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Date</h6></label><p class="text-muted" id="game_description"><?=date('M d, Y h:i A', strtotime(@$result->start_date));?></p></div>
											
											
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Email</h6></label><p class="text-muted" id="game_description"><?=@$result->email;?></p></div>
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Phone</h6></label><p class="text-muted" id="game_description"><?=@$result->phone;?></p></div>
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Website</h6></label><p class="text-muted" id="game_description"><?=@$result->website;?></p></div>
											
											<?php 
												if(!empty($result->tags)){
													$selected_tags = array();
													$explodeTags = explode(',', $result->tags);
													foreach($explodeTags as $k => $v){
														//$selected_tags[] = $v;
														$tags = DB::table('tags')->where(['id' => @$v])->select('name')->first();
														$tagsName[] = $tags->name;
													}
												}
											?>
											<div class="col-md-6">
												<label class="tx-11 font-weight-bold mb-0 "><h6>Tags</h6></label><p class="text-muted" id="game_description"><?=implode(', ', $tagsName) ?></p>
											</div>
										</div>
									</div>
                                </div>
								
								<!--<h4>Ticket</h4>-->
								
								<div class="col-lg-12 mb-3">
									
									
										<?php
											$ticket = DB::table('event_ticket')->where(['event_id' => @$result->id])->select('*')->orderBy('id', 'ASC')->get();
										?>
										
										<?php
										    if(!empty($ticket)){
												foreach($ticket as $k => $v){
										?>
										<div class="card rounded">
											<div class="card-body">
												<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Ticket Name</h6></label><p class="text-muted" id="game_name"><?=@$v->ticket_name; ?></p></div>
												
												<div class="row">
													<div class="col-md-6">
														<label class="tx-11 font-weight-bold mb-0 "><h6>Price (In USD)</h6></label><p class="text-muted" id="game_description">$<?=@$v->ticket_price; ?></p>
													</div>
													
													<div class="col-md-6">
														<label class="tx-11 font-weight-bold mb-0 "><h6>Offer Price (In USD)</h6></label><p class="text-muted" id="game_description">$<?=@$v->ticket_offer_price; ?></p>
													</div>
												</div>
												<div class="mt-3"> 
													<label class="tx-11 font-weight-bold mb-0 "><h6>Feature</h6></label>
													<ul>
														<?=@$v->feature; ?>
													</ul>
												</div>
											</div>
											</div>
										
                                        <?php										
													
												}
											}
										?>
										
										
										
									
                                </div>
								
								
								<h4>Location</h4>
								 <div class="col-lg-12 mb-3">
									<div class="card rounded">
										<div class="card-body">
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Location</h6></label><p class="text-muted" id="game_name"><?=@$result->location; ?></p></div>
											
											<div class="row">
												<div class="col-md-6">
													<label class="tx-11 font-weight-bold mb-0 "><h6>Country</h6></label><p class="text-muted" id="game_description"><?=@$result->country; ?></p>
												</div>
												
												<div class="col-md-6">
													<label class="tx-11 font-weight-bold mb-0 "><h6>State</h6></label><p class="text-muted" id="game_description"><?=@$result->state; ?></p>
												</div>
												
												<div class="col-md-6">
													<label class="tx-11 font-weight-bold mb-0 "><h6>City</h6></label><p class="text-muted" id="game_description"><?=@$result->city; ?></p>
												</div>
												
												<div class="col-md-6">
													<label class="tx-11 font-weight-bold mb-0 "><h6>Zipcode</h6></label><p class="text-muted" id="game_description"><?=@$result->zipcode; ?></p>
												</div>
											</div>
										</div>
									</div>
                                </div>
								
								
								<h4>Images</h4>
								 <div class="col-lg-12 mb-3">
									<div class="card rounded">
										<div class="card-body">
											
											
											<div class="row">
												<div class="eventphoto my-3 specific_preview">
												
										<?php
											$image = DB::table('event_image')->where(['event_id' => @$result->id])->select('*')->orderBy('id', 'ASC')->get();
										?>
										
										<?php
											  if(!empty(@$image)){
												  foreach($image as $k => $v){
										?>
											<div class="uploadedimg preview-show-13" id="preview13">
												<img src="<?=url('events/'.@$v->image.'')?>">
												
											</div>
                                        <?php										
												  }
											  }
										?>
														    
										
													
																																
													</div>
											</div>
										</div>
									</div>
                                </div>
								
								
                            </div>
                     </div>
                  </div>      
                </div>
                
                <!--<div class="col-lg-6 mb-3">
                    <div class="card shadow rounded">
                       <div class="card-body">
                            <div class="row">
                                <div class="col-lg-7 mb-3">
                                    <h2 class="fs-5 fw-semibold mb-0" id="ven_name">Player Name : <?=ucfirst(@$user->first_name); ?> &nbsp; <?=ucfirst(@$user->last_name); ?></h2>
                                   
                                    <p class="mb-2 mt-2"><strong>Email :</strong> <span class="text-success fw-semibold"><?=@$user->email; ?></span></p>
                                    <p class="mb-2 mt-2"><strong>Phone :</strong> <span class="text-success fw-semibold"><?=@$user->phone; ?></span></p>
                                    <p class="mb-2 mt-2"><strong>Address :</strong> <span class="text-success fw-semibold"><?=@$user->address; ?></span></p>
                                    <p class="mb-2 mt-2"><strong>Status :</strong> <span class="text-success fw-semibold"><?php echo (@$user->status == 1) ? 'Active' : 'Inactive'?></span></p>
                                    
                                   
                                </div>
                                <div class="col-lg-5">
                                    <div class="owl-carousel owl-theme" id="dealslide">
                                        <div class="item">
                                            <img src="<?= !empty(@$user->profile_image) ? url('uploads/profile_image/'.@$user->profile_image.'') : url('uploads/unnamed.jpg'); ?>" class="owl-img-fluid">
                                            <a href="javascript:void(0);" class="closeimg"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                    <p class="fs-6 text-center mb-2"><span ></span><span class="fw-bold text-success ms-1" >  </span> <span class="percentoff fw-bold ms-1 text-orange"><?=ucfirst(@$user->first_name); ?> &nbsp; <?=ucfirst(@$user->last_name); ?></span></p>

                                </div>
                               
                                <hr>
                                <!--<div class="col-lg-12 col-md-12 col-sm-12">
                                    <p><span class="fw-semibold"><strong>About Us:</strong></span> <span id="ven_desc"></span></p>
                                    <div>      
                                        <p><span class="fw-semibold"><strong>Business Phone:</strong></span> <span id="business_phone"></span></p>
                                        <p><span class="fw-semibold"><strong>Business URL:</strong></span> <span id="business_url"></span></p>
                                    </div>    
                                </div>  -->  
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div id="image_preview"></div> 
                                </div> 
                            </div>
                        </div>
                    </div>

                     <div class="col-lg-12 col-md-12 d-none" id="form_error">
                        <div class="alert alert-danger fade show" role="alert">
                            <i class="mdi mdi-block-helper me-2"></i>
                            <span id="form_error_txt">A simple danger alert—check it out!</span>
                        </div>
                    </div>    
                </div>-->


            </div>
        </div>
     </section>
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
 </script> 
@include('admin.footer');