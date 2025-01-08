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
                                            										
											<div class="image item" id="Cover-Image">
											    <img src="<?= url('events/bnr.jpg'); ?>" class="img-cover">
											</div>                           
											<div class="user clearfix">
												<div class="avatar item" id="itemImage">
													<img src="<?= ((!empty(@$result->profile_image) && file_exists('public/profile/'.@$result->profile_image.'')) ? url('profile/'.@$result->profile_image.'') : url('events/bnr.jpg')); ?>" class="img-thumbnail img-profile">
												</div>                               
												<h2><span id="f-name"></span> <span id="l-name"></span></h2>                                                                                     
											</div>                        
											                             
										</div>
									</div>
								</div>
                                <div class="col-lg-12 mb-3">
									<div class="card rounded">
										<div class="card-body">
										    <?php
												$user_type = DB::table('user_type')->where(['id' => @$result->user_type])->select('*')->orderBy('id', 'DESC')->first();
											?>
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>User Name</h6></label><p class="text-muted" id="game_name"><?=@$result->first_name?> <?=@$result->last_name?></p></div>
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Email</h6></label><p class="text-muted" id="game_description"><?=strip_tags(@$result->email); ?></p></div>
											
											
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Phone</h6></label><p class="text-muted" id="game_description"><?=@$result->phone ?></p></div>
											
											
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>UserType</h6></label><p class="text-muted" id="game_name"><?=@$user_type->name; ?></p></div>
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Address</h6></label><p class="text-muted" id="game_name"><?=@$result->address; ?></p></div>
											
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
												
												<?php 
												    $tagName1 = '';
												    if(!empty($result->tags)){
														$selected_tags = array();
														$explodeTags = explode(',', $result->tags);
														foreach($explodeTags as $k => $v){
															//$selected_tags[] = $v;
															$tags = DB::table('tags')->where(['id' => @$v])->select('name')->first();
															$tagsName[] = @$tags->name;
														}
														$tagName1 = implode(', ', $tagsName);
													}
												?>
												<div class="col-md-6">
													<label class="tx-11 font-weight-bold mb-0 "><h6>Tags</h6></label><p class="text-muted" id="game_description"><?= @$tagName1?></p>
												</div>
												<?php 
												    $interestName1 = '';
												    if(!empty($result->area_interest)){
														$selected_interest = array();
														$explodeInterest = explode(',', $result->area_interest);
														foreach($explodeInterest as $k => $v){
															//$selected_tags[] = $v;
															$interest = DB::table('interest')->where(['id' => @$v])->select('name')->first();
															$interestName[] = @$interest->name;
														}
														$interestName1 = implode(', ', $interestName);
													}
												?>
												<div class="col-md-6">
													<label class="tx-11 font-weight-bold mb-0 "><h6>Interest</h6></label><p class="text-muted" id="game_description"><?= @$interestName1?></p>
												</div>
												
											</div>
											<?php
											    if(@$result->bio){
													$bio = strip_tags(@$result->bio);
												}else{
													$bio = '';
												}
											?>
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Profile Bio</h6></label><p class="text-muted" id="game_name"><?=$bio; ?></p></div> 
										</div>
									</div>
                                </div>
								<?php  if(@$result->user_type == 10){ ?>
									<?php
									    $academics = DB::table('academics')->where(['user_id' => @$result->id])->select('*')->orderBy('id', 'DESC')->get();
										
										if(count($academics) > 0){
										
									?>
								    <h4>Academics</h4>	
									<div class="col-lg-12 mb-3">
										<div class="card rounded">
											<div class="card-body">
												
												<?php 
													
														foreach(@$academics as $k => $v){
												?>
												
													<div class="row">
														<div class="col-md-6">
															
															<label class="tx-11 font-weight-bold mb-0 "><h6>School / College Name</h6></label><p class="text-muted" id="game_description"><?=@$v->school_name; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Course Name</h6></label><p class="text-muted" id="game_description"><?=@$v->course_name; ?></p>
														</div>
														   
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Class Rank</h6></label><p class="text-muted" id="game_description"><?=@$v->rank; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Graduation Year</h6></label><p class="text-muted" id="game_description"><?=@$v->graduation_year; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>GPA</h6></label><p class="text-muted" id="game_description"><?=@$v->gpa; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>ACT / SAT Score</h6></label><p class="text-muted" id="game_description"><?=@$v->act_score; ?></p>
														</div>
														
													</div>
												<?php
														if(count($academics) > 1){
															echo "<hr/>";
														}
															
														}
													
												?>
													
											</div>
										</div>
                                    </div>
								<?php } ?>
								
								
								<?php
								    $athletics = DB::table('athletics')->where(['user_id' => @$result->id])->select('*')->orderBy('id', 'DESC')->get();
								?>
								<?php if(count($athletics) > 0){ ?>
									<h4>Athletics</h4>	
									<div class="col-lg-12 mb-3">
										<div class="card rounded">
											<div class="card-body">
												
												<?php 
													if(!empty(@$athletics)){
														foreach(@$athletics as $k => $v){
												?>
												
													<div class="row">
														<div class="col-md-6">
															
															<label class="tx-11 font-weight-bold mb-0 "><h6>Height</h6></label><p class="text-muted" id="game_description"><?=@$v->feet."'".@$v->inches.'"'; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Weight</h6></label><p class="text-muted" id="game_description"><?=@$v->weight; ?></p>
														</div>
														   
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Strength</h6></label><p class="text-muted" id="game_description"><?=@$v->strength; ?></p>
														</div>
														
													</div>
												<?php
															
														}
													}
												?>	
											</div>
										</div>
									</div>
								<?php } ?>
								
								
								<?php
								    $experience = DB::table('experience')->where(['user_id' => @$result->id])->select('*')->orderBy('id', 'DESC')->get();
								?>
								<?php if(count($experience) > 0){ ?>
									<h4>Experience</h4>	
									<div class="col-lg-12 mb-3">
										<div class="card rounded">
											<div class="card-body">
												
												<?php 
													if(!empty(@$experience)){
														foreach(@$experience as $k => $v){
												?>
												
													<div class="row">
														<div class="col-md-6">
															
															<label class="tx-11 font-weight-bold mb-0 "><h6>Club Name</h6></label><p class="text-muted" id="game_description"><?=@$v->club_name; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Designation</h6></label><p class="text-muted" id="game_description"><?=@$v->designation; ?></p>
														</div>
														   
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Start Date</h6></label><p class="text-muted" id="game_description"><?=@$v->start_date; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>End Date</h6></label><p class="text-muted" id="game_description"><?=@$v->end_date; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Information</h6></label><p class="text-muted" id="game_description"><?=@$v->information; ?></p>
														</div>
														
														
													</div>
												<?php
														if(count($experience) > 1){
															echo "<hr/>";
														}
															
														}
													}
												?>
											</div>
										</div>
									</div>
								<?php } ?>	
								
								
								<?php
								    $reference = DB::table('reference')->where(['user_id' => @$result->id])->select('*')->orderBy('id', 'DESC')->get();
								?>
								<?php if(count($reference) > 0){ ?>
									<h4>Reference</h4>	
									<div class="col-lg-12 mb-3">
										<div class="card rounded">
											<div class="card-body">
												
												<?php 
													if(!empty(@$reference)){
														foreach(@$reference as $k => $v){
												?>
												
													<div class="row">
														<div class="col-md-6">
															
															<label class="tx-11 font-weight-bold mb-0 "><h6>Coach Name</h6></label><p class="text-muted" id="game_description"><?=@$v->coach_name; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Coach Email</h6></label><p class="text-muted" id="game_description"><?=@$v->coach_email; ?></p>
														</div>
														
													</div>
													
												<?php
												if(count($reference) > 1){
													echo "<hr/>";
												}
															
														}
													}
												?>	
											</div>
										</div>
									</div>
								<?php } ?>
								
								
								<?php
								    $guardian = DB::table('guardian')->where(['user_id' => @$result->id])->select('*')->orderBy('id', 'DESC')->get();
								?>
								<?php if(count($guardian) > 0){ ?>
									<h4>Guardian</h4>	
									<div class="col-lg-12 mb-3">
										<div class="card rounded">
											<div class="card-body">
												<?php 
													if(!empty(@$guardian)){
														foreach(@$guardian as $k => $v){
												?>
												
													<div class="row">
														<div class="col-md-6">
															
															<label class="tx-11 font-weight-bold mb-0 "><h6>Guardian Name</h6></label><p class="text-muted" id="game_description"><?=@$v->guardian_name; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Guardian Email</h6></label><p class="text-muted" id="game_description"><?=@$v->guardian_email; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Guardian Phone</h6></label><p class="text-muted" id="game_description"><?=@$v->guardian_phone; ?></p>
														</div>
														
														<div class="col-md-6">
															<label class="tx-11 font-weight-bold mb-0 "><h6>Guardian Relation</h6></label><p class="text-muted" id="game_description"><?=@$v->guardian_relation; ?></p>
														</div>
														
													</div>
												<?php
														if(count($guardian) > 1){
															echo "<hr/>";
														}
												
														}
													}
												?>
											</div>
										</div>
									</div>
									
								<?php } ?>
								<?php } ?>
								
								<?php
								    $document = DB::table('user_document')->where(['user_id' => @$result->id])->select('*')->orderBy('id', 'DESC')->first();
								?>
								<?php if($document){ ?>
									<h4>User Document</h4>
									<div class="col-lg-12 mb-3">
										<div class="card rounded">
											<div class="card-body">
												
												<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Document Type</h6></label><p class="text-muted" id="game_name"><?=@$document->document_type?></p></div>
												
												
												<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Document Number</h6></label><p class="text-muted" id="game_description"><?=@$document->document_number?></p></div>
												
												
												<?php
												    if(!empty(@$document->document_photo)){
														$docPhoto = explode(',', @$document->document_photo);
														foreach($docPhoto as $keyPhoto => $valuePhoto){
															
															if(!empty(@$valuePhoto) && file_exists('public/document/'.@$valuePhoto.'')){
																$document_1 = url('public/document/'.@$valuePhoto.'');
															}else{
																$document_1 = url('public/noimage.jpg');
															}
															
															echo '<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Document Photo</h6></label><p class="text-muted" id="game_name"><img src="'.@$document_1.'" style="width: 20%;object-fit: cover;border: 4px solid #d4dbd0;"></p> <a href="'.@$document_1.'" download><i class="fa fa-download"></i></a></div>';
															
														}
													}
												    
												?>
												
												
												
												
												<?php
												    
													if(empty(@$document->dob) || @$document->dob == '0000-00-00'){
														$dob_date = '';
													}else{
														$dob_date = date('M d, Y', strtotime(@$document->dob));
													}
											    ?>
												<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Date Of Birth</h6></label><p class="text-muted" id="game_description"><?=@$dob_date?></p></div>
												
												<!--<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>User Photo</h6></label><p class="text-muted" id="game_name"></p></div>-->
											</div>
										</div>
									</div>
								<?php } ?>
								
								
								<h4>Subscription</h4>
								<div class="col-lg-12 mb-3">
									<div class="card rounded">
										<div class="card-body">
											<?php
												$transaction = DB::table('transaction')->where(['user_id' => @$result->id])->select('*')->orderBy('id', 'DESC')->first();
												
												$userInfo = DB::table('users')->where(['id' => @$transaction->user_id])->select('*')->orderBy('id', 'DESC')->first();
												
												$sub_plan = DB::table('sub_plan')->where(['id' => @$transaction->sub_id])->select('*')->orderBy('id', 'DESC')->first();
											?>
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>User Name</h6></label><p class="text-muted" id="game_name"><?=@$userInfo->first_name?> <?=@$userInfo->last_name?></p></div>
											
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>TransactionId</h6></label><p class="text-muted" id="game_description"><?=@$transaction->txn_id; ?></p></div>
											
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Currency</h6></label><p class="text-muted" id="game_name"><?=@$transaction->currency; ?></p></div>
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Amount</h6></label><p class="text-muted" id="game_description"><?=@$transaction->amount ?></p></div>
											
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Plan</h6></label><p class="text-muted" id="game_name"><?=@$sub_plan->name; ?></p></div>
											
											<?php
											    if(empty(@$transaction->expiry_date) || @$transaction->expiry_date == '0000-00-00'){
													$expiry_date = '';
												}else{
													$expiry_date = date('M d, Y', strtotime(@$transaction->expiry_date));
												}
											?>
											<div class="mt-3"> <label class="tx-11 font-weight-bold mb-0 "><h6>Expiry Date</h6></label><p class="text-muted" id="game_name"><?=@$expiry_date; ?></p></div>
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