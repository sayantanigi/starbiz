
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
#progressbar li {
    width: 16% !important;
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
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center p-20 mt-3 mb-2">
                            <div class="card p-4">
                                <h2 id="heading">Profile</h2>
                                <p>Fill all form field to go to next step</p>
                                <form id="msform" action="" method="POST" enctype="multipart/form-data" >
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active " id="account">
                                            <a href="#" id="account1"> <div class="progressIcon"><i class="fa fa-user"></i></div>
                                            <strong>Profile</strong></a>
                                        </li>
										
                                        <li id="academics" class="<?php echo !empty($academics) ? 'active' : ''; ?>">
                                           <a href="#" id="academics1"> <div class="progressIcon"><i class="fa fa-graduation-cap"></i></div>
                                            <strong>Academics</strong></a>
                                        </li>
										
                                        <li id="athletics" class="<?php echo !empty($athletics) ? 'active' : ''; ?>">
                                          <a href="#">  <div class="progressIcon"><i class="fa fa-futbol"></i></div>
                                            <strong>Athletics</strong></a>
                                        </li>
										
                                        <li id="exprience" class="<?php echo !empty($exprience) ? 'active' : ''; ?>">
                                           <a href="#"> <div class="progressIcon"><i class="fa fa-briefcase"></i></div>
                                            <strong>Exprience</strong></a>
                                        </li>
										
                                        <li id="reference" class="<?php echo !empty($reference) ? 'active' : ''; ?>">
                                            <a href="#"><div class="progressIcon"><i class="fa fa-bullhorn"></i></div>
                                            <strong>Reference</strong></a>
                                        </li>
										
										<li id="guardian" class="<?php echo !empty($guardian) ? 'active' : ''; ?>">
                                            <a href="#"><div class="progressIcon"><i class="fa fa-users"></i></div>
                                            <strong>Guardian</strong></a>
                                        </li>
                                    </ul>
                                    
                                    <fieldset id="step_1" class="<?php echo !empty($profile) ? 'pro-Info' : 'pro-Info'; ?>">
                                        <div class="form-card">
                                            <div class=" pt-3">
                                                <h3 class="text-uppercase text-center h4 fw-bold mb-3">Player Profile Info</h3>
                                                <div class="row">
                                                    <div class="mb-2 col-lg-6">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="fname" id="fname" value="<?php echo !empty($profile->first_name) ? $profile->first_name : ''; ?>"> 
														<span id="error_fname" class="text-danger"></span>
                                                    </div> 
													
                                                    <div class="mb-2 col-lg-6">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="lname" id="lname" value="<?php echo !empty($profile->last_name) ? $profile->last_name : ''; ?>">
														<span id="error_lname" class="text-danger"></span>
                                                    </div> 
													
													
                                                    <div class="mb-2 col-lg-6">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo !empty($profile->email) ? $profile->email : ''; ?>">		
														<span id="error_email" class="text-danger"></span>
                                                    </div> 
													
                                                    <div class="mb-2 col-lg-6">
                                                        <label>Phone</label>
                                                        <input type="text" class="form-control" name="phone"  id="phone" value="<?php echo !empty($profile->phone) ? $profile->phone : ''; ?>">
														<span id="error_phone" class="text-danger"></span>
                                                    </div> 
													
                                                    <div class="mb-2 col-lg-12">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control" name="address" id="autocomplete" value="<?php echo !empty($profile->address) ? $profile->address : ''; ?>">
														<div  style=""id="map" style="display:none;"></div>
														<input type="hidden" placeholder="Near"  name="latitude" id="latitude" value="<?php echo !empty($profile->latitude) ? $profile->latitude : ''; ?>">
														<input type="hidden" placeholder="Near" name="longitude" id="longitude" value="<?php echo !empty($profile->longitude) ? $profile->longitude : ''; ?>">
														<span id="error_address" class="text-danger"></span>
                                                    </div> 
													
													 <div class="mb-2 col-lg-6">
                                                        <label>Country</label>
                                                        <input type="text" class="form-control" name="country" id="country" value="<?php echo !empty($profile->country) ? $profile->country : ''; ?>">
														
														<span id="error_country" class="text-danger"></span>
                                                    </div> 
													
													<div class="mb-2 col-lg-6">
                                                        <label>State</label>
                                                        <input type="text" class="form-control" name="state" id="state" value="<?php echo !empty($profile->state) ? $profile->state : ''; ?>">
														<span id="error_state" class="text-danger"></span>
                                                    </div>
													
                                                    <div class="mb-2 col-lg-6">
                                                        <label>City</label>
                                                        <input type="text" class="form-control" name="city" id="city" value="<?php echo !empty($profile->city) ? $profile->city : ''; ?>">
														<span id="error_city" class="text-danger"></span>
                                                    </div> 
                                                     
                                                   
                                                    <div class="mb-2 col-lg-6">
                                                        <label>Zip Code</label>
                                                        <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo !empty($profile->zipcode) ? $profile->zipcode : ''; ?>">
														<span id="error_pincode" class="text-danger"></span>
                                                    </div> 
													
                                                    <div class="mb-2 col-lg-12">
                                                        <label>Profile Bio</label>
                                                        <textarea class="form-control editor summermote" name="profile_bio" id="profile_bio"><?php echo !empty($profile->bio) ? $profile->bio : ''; ?></textarea>
														<span id="error_profile_bio" class="text-danger"></span>
                                                    </div> 
													
													
													<!--<div class="mb-2 col-lg-12">        
														<label>Areas Of Interest</label>   
														<textarea class="form-control editor summermote" name="area_interest" id="area_interest"><?php echo !empty($profile->area_interest) ? $profile->area_interest : ''; ?></textarea>
														<span id="error_area_interest" class="text-danger"></span>
													</div>-->
													
													<?php
													    $selected_interest = [];
													    if(!empty($profile->area_interest)){
															$selected_tags = array();
															$explodearea_interest = explode(',', $profile->area_interest);
															foreach($explodearea_interest as $k => $v){
																$selected_interest[] = $v;
															}
														}
													?>
													<div class="mb-2 col-lg-12">        
														<label>Interest</label>   
														<select class="form-control" name="area_interest[]" id="area_interest" multiple data-placeholder="Select Interest">
														    <option value="">Select Interest</option>
														    <?php
															    if(!empty(@$interest)){
																	foreach(@$interest as $k => $v){
																		echo '<option value="'.@$v->id.'" '.(in_array(@$v->id,$selected_interest) ? 'selected' : '').'>'.@$v->name.'</option>';
																	}
																}
															?>
														</select>
														<span id="error_tags" class="text-danger"></span>
													</div>

                                                    <?php
													    $selected_tags = [];
													    if(!empty($profile->tags)){
															$selected_tags = array();
															$explodeTags = explode(',', $profile->tags);
															foreach($explodeTags as $k => $v){
																$selected_tags[] = $v;
															}
														}
													?>
													<div class="mb-2 col-lg-12">        
														<label>Tags</label>   
														<select class="form-control" name="tags[]" id="tags" multiple data-placeholder="Select Tags">
														    <option value="">Select Tags</option>
														    <?php
															    if(!empty(@$tags)){
																	foreach(@$tags as $k => $v){
																		echo '<option value="'.@$v->id.'" '.(in_array(@$v->id,$selected_tags) ? 'selected' : '').'>'.@$v->name.'</option>';
																	}
																}
															?>
														</select>
														<span id="error_tags" class="text-danger"></span>
													</div>
													
                                                </div>
                                                
                                            </div>
                                        </div> 
                                        <input type="button" name="next" class="next action-button" value="Next" id="first-next-button" />
										<br/><br/>
										<p id="userinfo_err"></p>
                                    </fieldset>
                                    <fieldset id="step_2" class="<?php echo !empty($academics) ? 'academic-Info' : 'academic-Info'; ?>">
                                        <div class="form-card">
                                           <div class="pt-3 field_wrapper">
                                                <h3 class="text-uppercase text-center h4 fw-bold mb-3">Academics Info</h3>
												<?php 
												if (count($academics) > 0) {
												  foreach($academics as $academic) { 
												?>
                                                <div class="row academicUserinfo_<?php echo @$academic->id; ?>">
                                                    <div class="mb-2 col-lg-6">
                                                        <label>School / College Name</label>
                                                        <input type="text" class="form-control" name="college[]" id="college" value="<?php echo !empty($academic->school_name) ? $academic->school_name : ''; ?>">
														<span id="error_college" class="text-danger"></span>
                                                    </div> 
                                                    <div class="mb-2 col-lg-6">
                                                        <label>Course Name</label>
                                                        <input type="text" class="form-control" name="course[]" id="course" value="<?php echo !empty($academic->course_name) ? $academic->course_name : ''; ?>">
														<span id="error_course" class="text-danger"></span>
                                                    </div> 
                                                    <div class="mb-2 col-lg-6">
                                                        <label>Class Rank</label>
                                                        <input type="text" class="form-control" name="rank[]" id="rank" value="<?php echo !empty($academic->rank) ? $academic->rank : ''; ?>">
														<span id="error_rank" class="text-danger"></span>
                                                    </div>
													
													<div class="mb-2 col-lg-6">
														<label>Graduation Year</label>  
														<input type="text" class="form-control" name="graduation_year[]" id="graduation_year" value="<?php echo !empty($academic->graduation_year) ? $academic->graduation_year : ''; ?>">	
														<span id="error_graduation_year" class="text-danger"></span>  
													</div>	

													<div class="mb-2 col-lg-6">             
														<label>GPA</label>  
														<input type="text" class="form-control" name="gpa[]" id="gpa" value="<?php echo !empty($academic->gpa) ? $academic->gpa : ''; ?>">		
														<span id="error_gpa" class="text-danger"></span>      
													</div>	

													<div class="mb-2 col-lg-6">
														<label>ACT / SAT Score</label>    
														<input type="text" class="form-control" name="act_score[]" id="act_score" value="<?php echo !empty($academic->act_score) ? $academic->act_score : ''; ?>">
														<span id="error_act_score" class="text-danger"></span> 
													</div>
                                                </div>
												<a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold " style="width: 100px;" onclick="confirmDelete(<?php echo @$academic->id; ?>);"  data-value="<?php echo @$profile->id; ?>" id="hiddenuserid_<?php echo @$academic->id; ?>">Remove</a><br/><br/>
												<?php } } else{ ?>
													<div class="row">
                                                    <div class="mb-2 col-lg-6">
                                                        <label>School / College Name</label>
                                                        <input type="text" class="form-control" name="college[]" id="college" value="">
														<span id="error_college" class="text-danger"></span>
                                                    </div> 
                                                    <div class="mb-2 col-lg-6">
                                                        <label>Course Name</label>
                                                        <input type="text" class="form-control" name="course[]" id="course" value="">
														<span id="error_course" class="text-danger"></span>
                                                    </div> 
                                                    <div class="mb-2 col-lg-6">
                                                        <label>Class  Rank</label>
                                                        <input type="text" class="form-control" name="rank[]" id="rank" value="">
														<span id="error_rank" class="text-danger"></span>
                                                    </div>
													
													<div class="mb-2 col-lg-6">  
														<label>Graduation Year</label> 
														<input type="text" class="form-control" name="graduation_year[]" id="graduation_year" value="">		
														<span id="error_graduation_year" class="text-danger"></span> 
													</div>

													<div class="mb-2 col-lg-6">    
														<label>GPA</label>  
														<input type="text" class="form-control" name="gpa[]" id="gpa" value="">	
														<span id="error_gpa" class="text-danger"></span> 
													</div>

													<div class="mb-2 col-lg-6">
														<label>ACT / SAT Score</label>                                                        
														<input type="text" class="form-control" name="act_score[]" id="act_score" value="">
														<span id="error_act_score" class="text-danger"></span>
													</div>
													
                                                </div>
												<?php } ?>
                                                <div class="my-3 text-center">
                                                    <a href="javascript:void(0);" title="Add field" class="btn btn-secondary rounded-0 fw-bold add_button">Add More </a>
                                                </div>
                                            </div>
                                        </div> 
                                        <input type="button" name="next" class="next action-button" value="Next" id="second-next-button"/> 
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
										<br/><br/>
										<p id="academicinfo_err"></p>
                                    </fieldset>
                                    <fieldset id="step_3" class="<?php echo !empty($athletics) ? 'athletics-Info' : 'athletics-Info'; ?>">
                                        <div class="form-card">
                                            <div class=" pt-3">
                                                <h3 class="text-uppercase text-center h4 fw-bold mb-3">Athletics Info</h3>
                                                <div class="row">
                                                    <div class="mb-2 col-lg-6">

														<div class="row">
														   <div class="mb-2 col-lg-6">
																<label>(Height) Feet</label>
																<input type="text" class="form-control" name="feet" id="feet" value="<?php echo !empty($athletics->feet) ? $athletics->feet."'" : ''; ?>">
																<span id="error_feet" class="text-danger"></span>
														   </div>
														   
														    <div class="mb-2 col-lg-6">
																<label>Inches</label>
																<input type="text" class="form-control" name="inches" id="inches" value='<?php echo !empty($athletics->inches) ? $athletics->inches.'"' : ''; ?>'>
														   </div>
															
														</div>
														
                                                    </div> 
                                                    <div class="mb-2 col-lg-6">
                                                        <label>Weight &nbsp; (in Lbs)</label>
                                                        <input type="text" class="form-control" name="weight" id="weight" value="<?php echo !empty($athletics->weight) ? $athletics->weight : ''; ?>">
														<span id="error_weight" class="text-danger"></span>
                                                    </div> 
													
                                                    <!--<div class="mb-2 col-lg-4">
                                                        <label>Footed</label>
                                                        <select class="form-control form-select" name="footed" id="footed">
                                                            <option value="">Select</option>
                                                            <option value="Left" <?php echo (@$athletics->Footed == 'Left') ? 'selected' : ''; ?>>Left</option>
                                                            <option value="Right" <?php echo (@$athletics->Footed == 'Right') ? 'selected' : ''; ?>>Right</option>
                                                            <option value="Both" <?php echo (@$athletics->Footed == 'Both') ? 'selected' : ''; ?>>Both</option>
                                                        </select>
														<span id="error_footed" class="text-danger"></span>
                                                    </div>-->
													
                                                    <div class="mb-2 col-lg-12">
                                                        <label>Strength</label>
                                                        <textarea class="form-control editor summermote" name="strength" id="strength"><?php echo !empty($athletics->strength) ? $athletics->strength : ''; ?></textarea>
														<span id="error_strength" class="text-danger"></span>
                                                    </div>
													
													<!--<div class="mb-2 col-lg-6">
                                                        <label>Position</label>
                                                        <input type="text" class="form-control" name="position" id="position" value="<?php echo !empty($athletics->position) ? $athletics->position : ''; ?>">
														<span id="error_position" class="text-danger"></span>
                                                    </div>
													<?php
													$selected_sportId= array();
													$exsportId = explode(',', @$profile->sport_id);
													foreach ($exsportId as $sport_Id){
													$selected_sportId[]= $sport_Id;
													}
													?>
                                                    <div class="mb-2 col-lg-6">
                                                        <label>Sport</label>
                                                         <select class="form-control form-select" name="sport" id="sport">
                                                            <option value="">Select</option>
																
                                                        </select>
														<span id="error_sport" class="text-danger"></span>
                                                    </div>-->
													
                                                    <!--<div class="mb-2 col-lg-6">
                                                        <label>High School Team</label>
                                                        <input type="text" class="form-control" name="school_team" id="school_team" value="<?php echo !empty($athletics->school_team) ? $athletics->school_team : ''; ?>">
														<span id="error_school_team" class="text-danger"></span>
                                                    </div>
                                                    <div class="mb-2 col-lg-6">
                                                        <label>Club Team</label>
                                                        <input type="text" class="form-control" name="club_team" id="club_team" value="<?php echo !empty($athletics->club_team) ? $athletics->club_team : ''; ?>">
														<span id="error_club_team" class="text-danger"></span>
                                                    </div>-->
													
                                                </div>
                                            </div>
                                        </div> 
                                        <input type="button" name="next" class="next action-button" value="Next" id="third-next-button"/> 
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
										<br><br/>
										<p id="athleticsinfo_err"></p>
                                    </fieldset>
                                    <fieldset id="step_4" class="step_4 <?php echo !empty($exprience) ? 'expriences-Info' : 'expriences-Info'; ?>">
                                        <div class="form-card">
                                            <div class="pt-3 field_wrapper1">
                                                <h3 class="text-uppercase text-center h4 fw-bold mb-3">Exprience Info</h3>
												<?php 
												if (count($exprience) > 0) {
												  foreach($exprience as $expriences) { 
												?>
													<div class="row experienceUserinfo_<?php echo @$expriences->id; ?>">
														<div class="mb-2 col-lg-6">
															<label>Club Name</label>
															<input type="text" class="form-control" name="club_name[]" id="club_name" value="<?php echo !empty($expriences->club_name) ? $expriences->club_name : ''; ?>">
															<span id="error_club_name" class="text-danger"></span>
														</div> 
														<div class="mb-2 col-lg-6">
															<label>Designation</label>
															<input type="text" class="form-control" name="club_designation[]" id="club_designation" value="<?php echo !empty($expriences->designation) ? $expriences->designation : ''; ?>">
															<span id="error_club_designation" class="text-danger"></span>
														</div> 
														<div class="mb-2 col-lg-6">
															<label>Start Date</label>
															<input type="date" class="form-control" name="start_date[]" id="start_date" value="<?php echo !empty($expriences->start_date) ? strftime('%Y-%m-%d',strtotime($expriences->start_date)) : ''; ?>">
															<span id="error_start_date" class="text-danger"></span>
														</div> 
														<div class="mb-2 col-lg-6">
															<label>End Date</label>
															<input type="date" class="form-control" name="end_date[]" id="end_date" value="<?php echo !empty($expriences->end_date) ? strftime('%Y-%m-%d',strtotime($expriences->end_date)) : ''; ?>">
															<span id="error_end_date" class="text-danger"></span>
														</div>
														<div class="mb-2 col-lg-12">
															<label>Information</label>
															<textarea class="form-control editor summermote information" name="information[]" id="information"><?php echo !empty($expriences->information) ? $expriences->information : ''; ?></textarea>
															<span id="error_information" class="text-danger"></span>
														</div>
													</div>
													
													<a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold " style="width: 100px;" onclick="expDelete(<?php echo @$expriences->id; ?>);"  data-value="<?php echo @$profile->id; ?>" id="expuserid_<?php echo @$expriences->id; ?>">Remove</a><br/><br/>
													
												<?php } }else{ ?>
												    <div class="row experienceUserinfo_<?php echo @$expriences->id; ?>">
														<div class="mb-2 col-lg-6">
															<label>Club Name</label>
															<input type="text" class="form-control" name="club_name[]" id="club_name" value="">
															<span id="error_club_name" class="text-danger"></span>
														</div> 
														<div class="mb-2 col-lg-6">
															<label>Designation</label>
															<input type="text" class="form-control" name="club_designation[]" id="club_designation" value="">
															<span id="error_club_designation" class="text-danger"></span>
														</div> 
														<div class="mb-2 col-lg-6">
															<label>Start Date</label>
															<input type="date" class="form-control" name="start_date[]" id="start_date" value="">
															<span id="error_start_date" class="text-danger"></span>
														</div> 
														<div class="mb-2 col-lg-6">
															<label>End Date</label>
															<input type="date" class="form-control" name="end_date[]" id="end_date" value="">
															<span id="error_end_date" class="text-danger"></span>
														</div>
														<div class="mb-2 col-lg-12">
															<label>Information</label>
															<textarea class="form-control editor summermote information" name="information[]" id="information"></textarea>
															<span id="error_information" class="text-danger"></span>
														</div>
													</div>
												<?php } ?>
												 <div class="my-3 text-center">
                                                    <a href="javascript:void(0);" title="Add field" class="btn btn-secondary rounded-0 fw-bold add_button1">Add More </a>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" id="four-next-button"/> 
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
										<br><br/>
										<p id="experienceinfo_err"></p>
                                    </fieldset>
                                    <fieldset id="step_5" class="<?php echo !empty($reference) ? 'references-Info' : 'references-Info'; ?>">
                                        <div class="form-card">
                                            <div class="pt-3 field_wrapper2">
                                                <h3 class="text-uppercase text-center h4 fw-bold mb-3">Reference Info</h3>
												<?php 
												if (count($reference) > 0) {
												  foreach($reference as $references) { 
												?>
													<div class="row referenceUserinfo_<?php echo @$references->id; ?>">
														<div class="mb-2 col-lg-6">
															<label>Coach Name</label>
															<input type="text" class="form-control" name="coach_name[]" id="coach_name" value="<?php echo !empty($references->coach_name) ? $references->coach_name : ''; ?>">
															<span id="error_coach_name" class="text-danger"></span>
														</div> 
														<div class="mb-2 col-lg-6">
															<label>Coach Email</label>
															<input type="email" class="form-control" name="coach_email[]" id="coach_email" value="<?php echo !empty($references->coach_email) ? $references->coach_email : ''; ?>">
															<span id="error_coach_email" class="text-danger"></span>
														</div> 
													</div>
													<a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold " style="width:100px" onclick="refDelete(<?php echo @$references->id; ?>);"  data-value="<?php echo @$profile->id; ?>" id="refuserid_<?php echo @$references->id; ?>">Remove</a><br/><br/>
												<?php } }else{ ?>
												    <div class="row">
														<div class="mb-2 col-lg-6">
															<label>Coach Name</label>
															<input type="text" class="form-control" name="coach_name[]" id="coach_name" value="<?php echo !empty($references->coach_name) ? $references->coach_name : ''; ?>">
															<span id="error_coach_name" class="text-danger"></span>
														</div> 
														<div class="mb-2 col-lg-6">
															<label>Coach Email</label>
															<input type="email" class="form-control" name="coach_email[]" id="coach_email" value="<?php echo !empty($references->coach_email) ? $references->coach_email : ''; ?>">
																<span id="error_coach_email" class="text-danger"></span>
														</div> 
													</div>
												<?php } ?>
												<div class="my-3 text-center">
                                                    <a href="javascript:void(0);" title="Add field" class="btn btn-secondary rounded-0 fw-bold add_button2">Add More </a>
                                                </div>
                                            </div>
                                        </div>
										<input type="button" name="next" class="next action-button" value="Next" id="five-next-button"/> 
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
										<br><br/>
										<p id="referenceinfo_err"></p>
                                    </fieldset>
									
									
									<fieldset id="step_6" class="<?php echo !empty($guardian) ? 'guardian-Info' : 'guardian-Info'; ?>">
                                        <div class="form-card">
                                            <div class="pt-3 field_wrapper3">
                                                <h3 class="text-uppercase text-center h4 fw-bold mb-3">Guardian Info</h3>
												<?php 
												if (count($guardian) > 0) {
												  foreach($guardian as $guardians) { 
												?>
													<div class="row guardianUserinfo_<?php echo @$guardians->id; ?>">
														<div class="mb-2 col-lg-6">
															<label>Guardian Name</label>
															<input type="text" class="form-control" name="guardian_name[]" id="guardian_name" value="<?=!empty($guardians->guardian_name) ? $guardians->guardian_name : ''; ?>">
															<span id="error_guardian_name" class="text-danger"></span>
														</div> 
														
														<div class="mb-2 col-lg-6">
															<label>Guardian Email</label>
															<input type="email" class="form-control" name="guardian_email[]" id="guardian_email" value="<?=!empty($guardians->guardian_email) ? $guardians->guardian_email : ''; ?>">
															<span id="error_guardian_email" class="text-danger"></span>
														</div> 
														
														<div class="mb-2 col-lg-6">
															<label>Guardian Phone</label>
															<input type="text" class="form-control" name="guardian_phone[]" id="guardian_phone" value="<?=!empty($guardians->guardian_phone) ? $guardians->guardian_phone : ''; ?>">
															<span id="error_guardian_phone" class="text-danger"></span>
														</div>

                                                        <div class="mb-2 col-lg-6">
															<label>Guardian Relation</label>
															<input type="text" class="form-control" name="guardian_relation[]" id="guardian_relation" value="<?=!empty($guardians->guardian_relation) ? $guardians->guardian_relation : ''; ?>">
															<span id="error_guardian_relation" class="text-danger"></span>
														</div> 														
														
													</div>
													<a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold " style="width: 100px;" onclick="guarDelete(<?php echo @$guardians->id; ?>);"  data-value="<?php echo @$profile->id; ?>" id="guaruserid_<?php echo @$guardians->id; ?>">Remove</a><br/><br/>
												<?php } }else{ ?>
												    <div class="row">
													
														<div class="mb-2 col-lg-6">
															<label>Guardian Name</label>
															<input type="text" class="form-control" name="guardian_name[]" id="guardian_name" value="">
															<span id="error_guardian_name" class="text-danger"></span>
														</div> 
														
														<div class="mb-2 col-lg-6">
															<label>Guardian Email</label>
															<input type="email" class="form-control" name="guardian_email[]" id="guardian_email" value="">
															<span id="error_guardian_email" class="text-danger"></span>
														</div> 
														
														<div class="mb-2 col-lg-6">
															<label>Guardian Phone</label>
															<input type="text" class="form-control" name="guardian_phone[]" id="guardian_phone" value="">
															<span id="error_guardian_phone" class="text-danger"></span>
														</div>

                                                        <div class="mb-2 col-lg-6">
															<label>Guardian Relation</label>
															<input type="text" class="form-control" name="guardian_relation[]" id="guardian_relation" value="">
															<span id="error_guardian_relation" class="text-danger"></span>
														</div> 		
														
													</div>
												<?php } ?>
												<div class="my-3 text-center">
                                                    <a href="javascript:void(0);" title="Add field" class="btn btn-secondary rounded-0 fw-bold add_button3">Add More </a>
                                                </div>
                                            </div>
                                        </div>
										<input type="hidden" name="userId" id="userId" value="<?php echo !empty($profile->id) ? $profile->id : ''; ?>" /> 
										<input type="hidden" name="user_type" id="user_type" value="Player" /> 
                                        <input type="submit" name="next" class="next action-button" value="Submit" /> 
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
										<br><br/>
										<p id="guardianinfo_err"></p>
                                    </fieldset>
									
									
                                </form>
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
	// var editstart_date = "<?php echo !empty($exprience->start_date) ? date('m/d/Y', strtotime($exprience->start_date)) : ''; ?>";
	// $(".step_4 #start_date").val(editstart_date);
	$('#first-next-button').click(function(){
		var mobile_validation = /^\d{10}$/;
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var error_fname = '';
		var error_lname = '';
		var error_designation = '';
		var error_email = '';
		var error_phone = '';
		var error_address = '';
		var error_city = '';
		var error_country = '';
		var error_state = '';
		var error_profile_bio = '';				
		var error_area_interest = '';
		var error_pincode = '';
		var error_tags = '';
		
		if($.trim($('#fname').val()).length == 0){
			error_fname = 'Please enter first name';
			$('#error_fname').text(error_fname);
			$('#fname').addClass('has-error');
		}
		else
		{
			error_fname = '';
			$('#error_fname').text(error_fname);
			$('#fname').removeClass('has-error');
		}
		
		if($.trim($('#lname').val()).length == 0){
			error_lname = 'Please enter last name';
			$('#error_lname').text(error_lname);
			$('#lname').addClass('has-error');
		}
		else
		{
			error_lname = '';
			$('#error_lname').text(error_lname);
			$('#lname').removeClass('has-error');
		}
		
		// if($.trim($('#pro_designation').val()).length == 0){
			// error_designation = 'Please enter your designation';
			// $('#error_designation').text(error_designation);
			// $('#pro_designation').addClass('has-error');
		// }
		// else
		// {
			// error_designation = '';
			// $('#error_designation').text(error_designation);
			// $('#pro_designation').removeClass('has-error');
		// }
		
		if($.trim($('#email').val()).length == 0)
		{
			error_email = 'please enter email';
			$('#error_email').text(error_email);
			$('#email').addClass('has-error');
		}
		else
		{
			if (!filter.test($('#email').val()))
			{
				error_email = 'Invalid email';
				$('#error_email').text(error_email);
				$('#email').addClass('has-error');
			}
			else
			{
				error_email = '';
				$('#error_email').text(error_email);
				$('#email').removeClass('has-error');
			}
		}
		
		if($.trim($('#phone').val()).length == 0)
		{
			error_phone = 'Please enter phone number';
			$('#error_phone').text(error_phone);
			$('#phone').addClass('has-error');
		}
		else
		{
			if (!mobile_validation.test($('#phone').val()))
			{
				error_phone = 'Invalid phone number';
				$('#error_phone').text(error_phone);
				$('#phone').addClass('has-error');
			}
			else
			{
				error_phone = '';
				$('#error_phone').text(error_phone);
				$('#phone').removeClass('has-error');
			}
		}
		
		if($.trim($('#autocomplete').val()).length == 0){
			error_address = 'Please enter your address';
			$('#error_address').text(error_address);
			$('#autocomplete').addClass('has-error');
		}
		else
		{
			error_address = '';
			$('#error_address').text(error_address);
			$('#autocomplete').removeClass('has-error');
		}
		
		if($.trim($('#city').val()).length == 0){
			error_city = 'Please enter your city';
			$('#error_city').text(error_city);
			$('#city').addClass('has-error');
		}
		else
		{
			error_city = '';
			$('#error_city').text(error_city);
			$('#city').removeClass('has-error');
		}
		
		if($.trim($('#country').val()).length == 0){
			error_country = 'Please enter your country';
			$('#error_country').text(error_country);
			$('#country').addClass('has-error');
		}
		else
		{
			error_country = '';
			$('#error_country').text(error_country);
			$('#country').removeClass('has-error');
		}
		
		if($.trim($('#state').val()).length == 0){
			error_state = 'Please enter your state';
			$('#error_state').text(error_state);
			$('#state').addClass('has-error');
		}
		else
		{
			error_state = '';
			$('#error_state').text(error_state);
			$('#state').removeClass('has-error');
		}
		
		if($.trim($('#profile_bio').val()).length == 0){
			error_profile_bio = 'Please enter your bio';
			$('#error_profile_bio').text(error_profile_bio);
			$('#profile_bio').addClass('has-error');
		}
		else
		{
			error_profile_bio = '';
			$('#error_profile_bio').text(error_profile_bio);
			$('#profile_bio').removeClass('has-error');
		}
		
		if($.trim($('#area_interest').val()).length == 0){	
			error_area_interest = 'Please enter areas of interest';		
			$('#error_area_interest').text(error_area_interest);			
			$('#area_interest').addClass('has-error');	
		}else{		
			error_area_interest = '';			
			$('#error_area_interest').text(error_area_interest);	
			$('#area_interest').removeClass('has-error');	
		}		
		
		if($.trim($('#pincode').val()).length == 0){
			error_pincode = 'Please enter your pin code';
			$('#error_pincode').text(error_pincode);
			$('#pincode').addClass('has-error');
		}
		else
		{
			error_pincode = '';
			$('#error_pincode').text(error_pincode);
			$('#pincode').removeClass('has-error');
		}
		
		if($.trim($('#tags').val()).length == 0){
			error_tags = 'Please select your tags';
			$('#error_tags').text(error_tags);
			$('#tags').addClass('has-error');
		}
		else
		{
			error_tags = '';
			$('#error_tags').text(error_tags);
			$('#tags').removeClass('has-error');
		}
		
		if(error_fname != '' || error_lname != '' || error_email != '' || error_phone != '' || error_address != '' || error_city != '' || error_state !='' || error_country != '' || error_pincode != '' || error_profile_bio != '' || error_area_interest != '' || error_tags != ''){
			$('#step_1').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#userinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">One or more mandatory fields have not been populated. Please check and resubmit.</small></div>');
			return false;
		}else{
			var fname = $('#fname').val();	
			var lname = $('#lname').val();	
			var email = $('#email').val();	
			var phone = $('#phone').val();	
			var autocomplete = $('#autocomplete').val();	
			var country = $('#country').val();	
			var state= $('#state').val();	
			var city = $('#city').val();	
			var pincode = $('#pincode').val();	
			var profile_bio = $('#profile_bio').val();	
			var area_interest = $('#area_interest').val();
			var latitude = $('#latitude').val();
			var longitude = $('#longitude').val();
			var userId = $('#userId').val();
			var tags = $('#tags').val();
			
			$.ajax({
			type: 'POST',
			url: '<?php echo url('admin/users/updateProfile');?>',
			data: {fname : fname, lname : lname, email : email, phone : phone, address : autocomplete, country : country, state : state, city : city, latitude : latitude, longitude : longitude, pincode : pincode, profile_bio : profile_bio, area_interest : area_interest, userId : userId, tags : tags, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(data){
				
			}
			});
			
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_2').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$("#academics").addClass("active"); 
			$('#userinfo_err').html('<small style="color:red;"></small>');
		}
	});
	$('#second-next-button').click(function(){
		var error_college = '';
		var error_course = '';
		//var error_passing_year = '';		//var error_achievement = '';		var error_graduation_year = '';		var error_gpa = '';		var error_act_score = '';
		
		if($.trim($('#college').val()).length == 0){
			error_college = 'Please enter college name';
			$('#error_college').text(error_college);
			$('#college').addClass('has-error');
		}
		else
		{
			error_college = '';
			$('#error_college').text(error_college);
			$('#college').removeClass('has-error');
		}
		
		if($.trim($('#course').val()).length == 0){
			error_course = 'Please enter course name';
			$('#error_course').text(error_course);
			$('#course').addClass('has-error');
		}
		else
		{
			error_course = '';
			$('#error_course').text(error_course);
			$('#course').removeClass('has-error');
		}
		
		if($.trim($('#rank').val()).length == 0){
			error_rank = 'Please enter rank name';
			$('#error_rank').text(error_rank);
			$('#rank').addClass('has-error');
		}
		else
		{
			error_rank = '';
			$('#error_rank').text(error_rank);
			$('#rank').removeClass('has-error');
		}
		
		if($.trim($('#graduation_year').val()).length == 0){
			error_graduation_year = 'Please enter graduation year';		
			$('#error_graduation_year').text(error_graduation_year);		
			$('#graduation_year').addClass('has-error');		
		}else{	
			error_graduation_year = '';		
			$('#error_graduation_year').text(error_graduation_year);		
			$('#graduation_year').removeClass('has-error');	
		}
			
		
		if($.trim($('#gpa').val()).length == 0){	
			error_gpa = 'Please enter GPA';		
			$('#error_gpa').text(error_gpa);	
			$('#gpa').addClass('has-error');	
		}else{		
			error_gpa = '';		
			$('#error_gpa').text(error_gpa);	
			$('#gpa').removeClass('has-error');	
		}
		
		if($.trim($('#act_score').val()).length == 0){	
			error_act_score = 'Please enter ACT Score';		
			$('#error_act_score').text(error_act_score);	
			$('#act_score').addClass('has-error');		
		}else{	
			error_act_score = '';	
			$('#error_act_score').text(error_act_score);
			$('#act_score').removeClass('has-error');	
		}
		
		
		if(error_college != '' || error_course != '' || error_rank != '' || error_graduation_year != '' || error_gpa != '' || error_act_score != ''){
			$('#step_2').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$("#academics").addClass("active");
			 $('#academicinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">One or more mandatory fields have not been populated. Please check and resubmit.</small></div>');
			return false;
		}else{
				college = [];
				$("input[name='college[]']").each(function() {
				college.push($(this).val());
				});

				course = [];
				$("input[name='course[]']").each(function() {
				course.push($(this).val());
				});

				rank = [];
				$("input[name='rank[]']").each(function() {
				rank.push($(this).val());
				});

				graduation_year = [];
				$("input[name='graduation_year[]']").each(function() {
				graduation_year.push($(this).val());
				});

				gpa = [];
				$("input[name='gpa[]']").each(function() {
				gpa.push($(this).val());
				});

				act_score = [];
				$("input[name='act_score[]']").each(function() {
				act_score.push($(this).val());
				});

				var userId = $('#userId').val();

				$.ajax({
				type: 'POST',
				url: '<?php echo url('admin/users/updateProfile');?>',
				data: {college : college, course : course, rank : rank, graduation_year : graduation_year, gpa : gpa, act_score : act_score, userId : userId, "_token": "{{ csrf_token() }}"},
				dataType: 'text',
				success: function(data){
				}
				});
				$('#step_3').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
				$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
				$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
				$("#athletics").addClass("active");
				$('#academicinfo_err').html('<small style="color:red;"></small>');
		}
		
	});
	
	$('#third-next-button').click(function(){
		var error_feet = '';
		var error_weight = '';
		var error_footed = '';
		var error_strength = '';
		var error_school_team = '';
		var error_club_team = '';
		var error_position = '';
		var error_sport = '';
		
		if($.trim($('#feet').val()).length == 0){
			error_height = 'Please enter feet';
			$('#error_feet').text(error_height);
			$('#feet').addClass('has-error');
		}
		else
		{
			error_feet = '';
			$('#error_feet').text(error_feet);
			$('#feet').removeClass('has-error');
		}
		
		if($.trim($('#weight').val()).length == 0){
			error_weight = 'Please enter your weight';
			$('#error_weight').text(error_weight);
			$('#weight').addClass('has-error');
		}
		else
		{
			error_weight = '';
			$('#error_weight').text(error_weight);
			$('#weight').removeClass('has-error');
		}
		
		
		// if($.trim($('#footed').val()).length == 0){
			// error_footed = 'Please enter your footed';
			// $('#error_footed').text(error_footed);
			// $('#footed').addClass('has-error');
		// }
		// else
		// {
			// error_footed = '';
			// $('#error_footed').text(error_footed);
			// $('#footed').removeClass('has-error');
		// }
		
		if($.trim($('#strength').val()).length == 0){
			error_strength = 'Please enter your strength';
			$('#error_strength').text(error_strength);
			$('#strength').addClass('has-error');
		}
		else
		{
			error_strength = '';
			$('#error_strength').text(error_strength);
			$('#strength').removeClass('has-error');
		}
		
		
		// if($.trim($('#position').val()).length == 0){
			// error_position = 'Please enter position';
			// $('#error_position').text(error_position);
			// $('#position').addClass('has-error');
		// }
		// else
		// {
			// error_position = '';
			// $('#error_position').text(error_position);
			// $('#position').removeClass('has-error');
		// }
		
		// if($.trim($('#sport').val()).length == 0){
			// error_sport = 'Please select sport';
			// $('#error_sport').text(error_sport);
			// $('#sport').addClass('has-error');
		// }
		// else
		// {
			// error_sport = '';
			// $('#error_sport').text(error_sport);
			// $('#sport').removeClass('has-error');
		// }
		
		if(error_feet != '' || error_weight != '' || error_footed != '' || error_strength != ''){
			$('#step_3').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$("#athletics").addClass("active");
            $('#athleticsinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">One or more mandatory fields have not been populated. Please check and resubmit.</small></div>');
			return false;
		}else{
				var feet = $('#feet').val();	
				var inches = $('#inches').val();	
				var weight = $('#weight').val();	
				//var footed = $('#footed').val();	
				//var position = $('#position').val();	
				//var sport = $('#sport').val();	
				var strength = $('#strength').val();	
				//var school_team = $('#school_team').val();
				//var club_team = $('#club_team').val();
				var userId = $('#userId').val();

				$.ajax({
				type: 'POST',
				url: '<?php echo url('admin/users/updateProfile');?>',
				data: {feet : feet, inches : inches, weight : weight, strength : strength, userId : userId, "_token": "{{ csrf_token() }}"},
				dataType: 'text',
				success: function(data){

				}
				});
			$('#step_4').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_3').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$("#exprience").addClass("active");
			$('#athleticsinfo_err').html('<small style="color:red;"></small>');
		}
		
	});
	
	$('#four-next-button').click(function(){
		var error_club_name = '';
		var error_club_designation = '';
		var error_start_date = '';
		var error_end_date = '';
		
		if($.trim($('#club_name').val()).length == 0){
			error_club_name = 'Please enter your club name';
			$('#error_club_name').text(error_club_name);
			$('#club_name').addClass('has-error');
		}
		else
		{
			error_club_name = '';
			$('#error_club_name').text(error_club_name);
			$('#club_name').removeClass('has-error');
		}
		
		if($.trim($('#club_designation').val()).length == 0){
			error_club_designation = 'Please enter your designation';
			$('#error_club_designation').text(error_club_designation);
			$('#club_designation').addClass('has-error');
		}
		else
		{
			error_club_designation = '';
			$('#error_club_designation').text(error_club_designation);
			$('#club_designation').removeClass('has-error');
		}
		
		
		if($.trim($('#start_date').val()).length == 0){
			error_start_date = 'Please enter start date';
			$('#error_start_date').text(error_start_date);
			$('#start_date').addClass('has-error');
		}
		else
		{
			error_start_date = '';
			$('#error_start_date').text(error_start_date);
			$('#start_date').removeClass('has-error');
		}
		
		if($.trim($('#end_date').val()).length == 0){
			error_end_date = 'Please enter end date';
			$('#error_end_date').text(error_end_date);
			$('#end_date').addClass('has-error');
		}
		else
		{
			error_end_date = '';
			$('#error_end_date').text(error_end_date);
			$('#end_date').removeClass('has-error');
		}
		
		
		
		if(error_club_name != '' || error_club_designation != '' || error_start_date != '' || error_end_date != '' ){
			$('#step_4').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_3').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#experienceinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">One or more mandatory fields have not been populated. Please check and resubmit.</small></div>');
			return false;
		}else{
			club_name = [];
			$("input[name='club_name[]']").each(function() {
			club_name.push($(this).val());
			});

			club_designation = [];
			$("input[name='club_designation[]']").each(function() {
			club_designation.push($(this).val());
			});

			start_date = [];
			$("input[name='start_date[]']").each(function() {
			start_date.push($(this).val());
			});

			end_date = [];
			$("input[name='end_date[]']").each(function() {
			end_date.push($(this).val());
			});

			information = [];
			$(".information").each(function() {
			information.push($(this).val());
			});
			console.log(information)
			var userId = $('#userId').val();

			$.ajax({
			type: 'POST',
			url: '<?php echo url('admin/users/updateProfile');?>',
			data: {club_name : club_name, club_designation : club_designation, start_date : start_date, end_date : end_date, information : information, userId : userId,  "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(data){
			}
			});
			$('#step_5').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_4').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_3').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$("#reference").addClass("active");
			$('#experienceinfo_err').html('<small style="color:red;"></small>');
		}
		
	});
	
	
	$('#five-next-button').click(function(){
		var error_coach_name = '';
		var error_coach_email = '';
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		if($.trim($('#coach_name').val()).length == 0){
			error_coach_name = 'Please enter coach name';
			$('#error_coach_name').text(error_coach_name);
			$('#coach_name').addClass('has-error');
		}
		else
		{
			error_coach_name = '';
			$('#error_coach_name').text(error_coach_name);
			$('#coach_name').removeClass('has-error');
		}
		
		if($.trim($('#coach_email').val()).length == 0){
			error_coach_email = 'Please enter coach email';
			$('#error_coach_email').text(error_coach_email);
			$('#coach_email').addClass('has-error');
		}
		else
		{
			if (!filter.test($('#coach_email').val()))
			{
				error_coach_email = 'Invalid email';
				$('#error_coach_email').text(error_coach_email);
				$('#coach_email').addClass('has-error');
			}
			else
			{
				error_coach_email = '';
				$('#error_coach_email').text(error_coach_email);
				$('#coach_email').removeClass('has-error');
			}
		}
		
		
		
		if(error_coach_email != '' || error_coach_name != '' ){
			$('#step_5').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_4').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_3').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
            $('#referenceinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">One or more mandatory fields have not been populated. Please check and resubmit.</small></div>');
			return false;
		}else{
			
			coach_name = [];
			$("input[name='coach_name[]']").each(function() {
			coach_name.push($(this).val());
			});
			
			coach_email = [];
			$("input[name='coach_email[]']").each(function() {
			coach_email.push($(this).val());
			});
			
			var userId = $('#userId').val();
			
			$.ajax({
			type: 'POST',
			url: '<?php echo url('admin/users/updateProfile');?>',
			data: {coach_email : coach_email, coach_name : coach_name, userId : userId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(data){
			}
			});
			
			$('#step_6').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
			$('#step_5').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_4').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_1').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_2').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$('#step_3').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
			$("#guardian").addClass("active");
			$('#referenceinfo_err').html('<small style="color:red;"></small>');
		}
		
	});
	
	$("#msform").submit(function (event) {
        var  guardian_name  = $('#guardian_name').val(); 
		var  guardian_email  = $('#guardian_email').val(); 
		var  guardian_phone  = $('#guardian_phone').val(); 
		var  guardian_relation  = $('#guardian_relation').val(); 
		
	    var error_guardian_name = '';
	    var error_guardian_email = '';
	    var error_guardian_phone = '';
	    var error_guardian_relation = '';
		
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		if($.trim($('#guardian_name').val()).length == 0){
			error_guardian_name = 'Please enter guardian name';
			$('#error_guardian_name').text(error_guardian_name);
			$('#guardian_name').addClass('has-error');
		}
		else
		{
			error_guardian_name = '';
			$('#error_guardian_name').text(error_guardian_name);
			$('#guardian_name').removeClass('has-error');
		}
		
		
		if($.trim($('#guardian_email').val()).length == 0)
		{
			error_guardian_email = 'please enter guardian email';
			$('#error_guardian_email').text(error_guardian_email);
			$('#guardian_email').addClass('has-error');
		}
		else
		{
			if (!filter.test($('#guardian_email').val()))
			{
				error_guardian_email = 'Invalid email';
				$('#error_guardian_email').text(error_guardian_email);
				$('#guardian_email').addClass('has-error');
			}
			else
			{
				error_guardian_email = '';
				$('#error_guardian_email').text(error_guardian_email);
				$('#guardian_email').removeClass('has-error');
			}
		}
		
		
		if($.trim($('#guardian_phone').val()).length == 0){
			error_guardian_phone = 'Please enter guardian phone';
			$('#error_guardian_phone').text(error_guardian_phone);
			$('#guardian_phone').addClass('has-error');
		}
		else
		{
			error_guardian_phone = '';
			$('#error_guardian_phone').text(error_guardian_phone);
			$('#guardian_phone').removeClass('has-error');
		}
		
		if($.trim($('#guardian_relation').val()).length == 0){
			error_guardian_relation = 'Please enter guardian relation';
			$('#error_guardian_relation').text(error_guardian_relation);
			$('#guardian_relation').addClass('has-error');
		}
		else
		{
			error_guardian_relation = '';
			$('#error_guardian_relation').text(error_guardian_relation);
			$('#guardian_relation').removeClass('has-error');
		}
		
		if(error_guardian_name != '' || error_guardian_email != '' || error_guardian_phone != '' || error_guardian_relation != ''){
			$('#guardianinfo_err').html('<div style="background: #972424;width: 66%;color: white;padding: 8px 67px;margin: 4px 152px;border-radius: 5px;"><small style="color: white;">One or more mandatory fields have not been populated. Please check and resubmit.</small></div>');
			return false;
		}else{
			$('#guardianinfo_err').html('<small style="color:red;"></small>');
		}


		event.preventDefault();
		$.ajax({
		headers: {
		'X-CSRF-TOKEN': "{{ csrf_token() }}"
		},	
		type: 'POST',
		url: '<?php echo url('admin/users/updateProfile');?>',
		data: new FormData(this),
		dataType: 'json', 
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){ 
			if(data.status == 1){
				swal({title: "Sucess!", text: "<strong>"+data.message+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				
			}
			if(data.status == 0){
				swal({title: "Fail!", text: "<strong>"+data.message+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
		}
		});

		});

});
 </script>
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
/*$(document).on('keyup','#feet',function(e){
        var feet = $(this).val();
        
        if(feet){
			//console.log(feet)
          $("#feet").val(feet+"'");
        }
    });	
$(document).on('change','#inches',function(e){
        var inches = $(this).val();
        
        if(inches){

          $("#inches").val(inches+'"');
        }
    });	*/	
$(document).ready(function(){
	$("#submitform").on('submit', function(e){
		e.preventDefault();
		var form_data = new FormData(); 	
		var profile_image = $("#upload_image").prop("files")[0]; 
		
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
		
		form_data.append("profile_image", profile_image);
		form_data.append("fname", fname);
		form_data.append("lname", lname);
		form_data.append("email", email);
		form_data.append("status", status);
		form_data.append("phone", phone);
		form_data.append("address", address);
		form_data.append("latitude", latitude);
		form_data.append("longitude", longitude);
		form_data.append("longitude", longitude);
		form_data.append("password", password);
		form_data.append("confirm_password", confirm_password);
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
				swal({title: "Sucess!", text: "<strong>"+data.message+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
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
   
 
 </script> 
 <script src="<?= url('assets/admin/plugins/smt-img-upld/js/singleimage-uploader.js')?>"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places"></script>
 <link href='<?php echo url("assets/chosen/chosen.min.css"); ?>' rel='stylesheet' type='text/css'>
<script src='<?php echo url("assets/chosen/chosen.jquery.min.js"); ?>' type='text/javascript'></script>   
  <!--<script>
	$(document).ready(function() {
	$("#lat_area").addClass("d-none");
	$("#long_area").addClass("d-none");
	});
	google.maps.event.addDomListener(window, 'load', initialize);
	function initialize() {
	var input = document.getElementById('autocomplete');
	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.addListener('place_changed', function() {
	var place = autocomplete.getPlace();
	$('#latitude').val(place.geometry['location'].lat());
	$('#longitude').val(place.geometry['location'].lng());
	// --------- show lat and long ---------------
	$("#lat_area").removeClass("d-none");
	$("#long_area").removeClass("d-none");
	});
	}
</script>-->
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
    $(document).ready(function(){
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;
    setProgressBar(current);
    // $(".next").click(function(){
    // current_fs = $(this).parent();
    // next_fs = $(this).parent().next();
    // //Add Class Active
    // $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    // //show the next fieldset
    // next_fs.show();
    // //hide the current fieldset with style
    // current_fs.animate({opacity: 0}, {
    // step: function(now) {
    // // for making fielset appear animation
    // opacity = 1 - now;
    // current_fs.css({
   // // 'display': 'none',
    // 'position': 'relative'
    // });
    // next_fs.css({'opacity': opacity});
    // },
    // duration: 500
    // });
    // setProgressBar(++current);
    // });
    $(".previous").click(function(){
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    //show the previous fieldset
    previous_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    previous_fs.css({'opacity': opacity});
    },
    duration: 500
    });
    setProgressBar(--current);
    });
    function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
    .css("width",percent+"%")
    }
    $(".submit").click(function(){
    return false;
    })
    });
</script>
<script>
$(document).ready(function(){
	
$('#country').change(function(){
	var country_id = $('#country').val();
	if(country_id != '')
	{
		$.ajax({
			url:"<?php echo url('admin/users/state'); ?>",
			method:"POST",
			data:{country_id:country_id},
			success:function(data)
			{
				$('#state').html(data);
				$('#city').html('<option value="">Select City</option>');
			}
		});
	}
	else
	{
		$('#state').html('<option value="">Select State</option>');
		$('#city').html('<option value="">Select City</option>');
	}
});

$('#state').change(function(){
	var state_id = $('#state').val();
	if(state_id != '')
	{
		$.ajax({
			url:"<?php echo url('admin/users/city'); ?>",
			method:"POST",
			data:{state_id:state_id},
			success:function(data)
			{
			  $('#city').html(data);
			}
		});
	}
	else
	{
	    $('#city').html('<option value="">Select City</option>');
	}
});

//document.getElementById("resquestion").innerHTML  = ""+question+"";
});
	
</script>	

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
	
    var fieldHTML = '<div class="row"><div class="mb-2 col-lg-6"> <label>School / College Name</label><input type="text"  name="college[]" class="form-control"></div> <div class="mb-2 col-lg-6"><label>Course Name</label> <input type="text"  name="course[]" class="form-control" ></div> <div class="mb-2 col-lg-6"><label>Class Rank</label><input type="text" class="form-control"  name="rank[]"></div><div class="mb-2 col-lg-6"><label>Graduation Year</label><input type="text" class="form-control" name="graduation_year[]"></div><div class="mb-2 col-lg-6"><label>GPA</label><input type="text" class="form-control" name="gpa[]" ></div><div class="mb-2 col-lg-6"><label>ACT / SAT Score</label><input type="text" class="form-control" name="act_score[]"></div><a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold remove_button" style="width: 100px;">Remove</a> </div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
			$(wrapper).find('.textarea').summernote();
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button1'); //Add button selector
    var wrapper = $('.field_wrapper1'); //Input field wrapper
	
    var fieldHTML = '<div class="row"><div class="mb-2 col-lg-6"> <label>Club Name</label><input type="text"  name="club_name[]" class="form-control"></div> <div class="mb-2 col-lg-6"><label>Designation</label> <input type="text"  name="club_designation[]" class="form-control" ></div> <div class="mb-2 col-lg-6"><label>Start Date</label><input type="date" class="form-control"  name="start_date[]"></div><div class="mb-2 col-lg-6"> <label>End Date</label><input type="date" class="form-control"  name="end_date[]"></div><div class="mb-2 col-lg-12"><label>Information</label><textarea type="text" class="form-control textarea information" name="information[]" ></textarea> </div> <a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold remove_button1" style="width: 100px;">Remove</a> </div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
			$(wrapper).find('.textarea').summernote();
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button1', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button2'); //Add button selector
    var wrapper = $('.field_wrapper2'); //Input field wrapper
	
    var fieldHTML = '<div class="row"><div class="mb-2 col-lg-6"> <label>Coach Name</label><input type="text"  name="coach_name[]" class="form-control"></div> <div class="mb-2 col-lg-6"><label>Coach Email</label> <input type="text"  name="coach_email[]" class="form-control" ></div>  <a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold remove_button2" style="width: 100px;">Remove</a> </div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button2', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});


$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button3'); //Add button selector
    var wrapper = $('.field_wrapper3'); //Input field wrapper
	
    var fieldHTML = '<div class="row"><div class="mb-2 col-lg-6"> <label>Guardian Name</label><input type="text"  name="guardian_name[]" class="form-control"></div> <div class="mb-2 col-lg-6"><label>Guardian Email</label> <input type="email"  name="guardian_email[]" class="form-control" ></div>  <div class="mb-2 col-lg-6"><label>Guardian Phone</label> <input type="text"  name="guardian_phone[]" class="form-control" ></div><div class="mb-2 col-lg-6"><label>Guardian Relation</label> <input type="text"  name="guardian_relation[]" class="form-control" ></div><a href="javascript:void(0);" class="btn btn-secondary rounded-0 fw-bold remove_button3" style="width: 100px;">Remove</a> </div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button3', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

<script type="text/javascript">
		
	$(document).ready(function() {
		$('.editor').summernote({
			placeholder: '',
			height: 200
		});
	});
	
function confirmDelete(id) {
var userId = $("a#hiddenuserid_"+id).data().value; 
    swal({
        title: "Are you sure you want to hide this data?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "<?php echo url('admin/users/delete-academic'); ?>",
            type: "POST",
            data: {
                academic: id, userId:userId, "_token": "{{ csrf_token() }}"
            },
            dataType: "html",
            success: function (data) {
				if(data == 1){
					swal({title: "Sucess!", text: "<strong>You have successfully deleted this data.</strong>", type: "success", showConfirmButton: true, html:true});
					$('.academicUserinfo_'+id).remove();
				}else{
					swal({title: "Fail!", text: "<strong>Some error occure, Please try again.</strong>", type: "error", showConfirmButton: true, html:true});
				}
               
            }
			
            
        });
    });
}

function guarDelete(id) {
var userId = $("a#guaruserid_"+id).data().value; 
    swal({
        title: "Are you sure you want to hide this data?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "<?php echo url('admin/users/delete-guardian'); ?>",
            type: "POST",
            data: {
                guardian: id, userId:userId,  "_token": "{{ csrf_token() }}"
            },
            dataType: "html",
            success: function (data) {
				
                if(data == 1){
					swal({title: "Sucess!", text: "<strong>You have successfully deleted this data.</strong>", type: "success", showConfirmButton: true, html:true});
					$('.guardianUserinfo_'+id).remove();
				}else{
					swal({title: "Fail!", text: "<strong>Some error occure, Please try again.</strong>", type: "error", showConfirmButton: true, html:true});
				}
            }
			
            
        });
    });
}


function expDelete(id) {
var userId = $("a#expuserid_"+id).data().value; 
    swal({
        title: "Are you sure you want to hide this data?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "<?php echo url('admin/users/delete-experience'); ?>",
            type: "POST",
            data: {
                experience: id, userId:userId,  "_token": "{{ csrf_token() }}"
            },
            dataType: "html",
            success: function (data) {
				if(data == 1){
					swal({title: "Sucess!", text: "<strong>You have successfully deleted this data.</strong>", type: "success", showConfirmButton: true, html:true});
					$('.experienceUserinfo_'+id).remove();
				}else{
					swal({title: "Fail!", text: "<strong>Some error occure, Please try again.</strong>", type: "error", showConfirmButton: true, html:true});
					//$('.experienceUserinfo_'+id).remove();
				}
                
            }
			
            
        });
    });
}

function refDelete(id) {
var userId = $("a#refuserid_"+id).data().value; 
    swal({
        title: "Are you sure you want to hide this data?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "<?php echo url('admin/users/delete-reference'); ?>",
            type: "POST",
            data: {
                reference: id, userId:userId, "_token": "{{ csrf_token() }}"
            },
            dataType: "html",
            success: function (data) {
				if(data == 1){
					swal({title: "Sucess!", text: "<strong>You have successfully deleted this data.</strong>", type: "success", showConfirmButton: true, html:true});
					$('.referenceUserinfo_'+id).remove();
				}else{
					swal({title: "Fail!", text: "<strong>Some error occure, Please try again.</strong>", type: "error", showConfirmButton: true, html:true});
				}
            }
			
            
        });
    });
}
$("#progressbar").on("click", "#account", function(event){
	$('.pro-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.academic-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.athletics-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.expriences-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.references-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.guardian-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#account").addClass("active");
	$("#academics").removeClass("active");
	$("#athletics").removeClass("active");
	$("#exprience").removeClass("active");
	$("#reference").removeClass("active");
	$("#guardian").removeClass("active");
	 
});
 $("#progressbar").on("click", "#academics", function(event){
	// console.log('clicked');
	$('.academic-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.pro-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.athletics-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.expriences-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.references-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.guardian-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#academics").addClass("active");
	$("#athletics").removeClass("active");
	$("#exprience").removeClass("active");
	$("#reference").removeClass("active");
	$("#guardian").removeClass("active");
	$("#account").removeClass("active");
 });
 
  $("#progressbar").on("click", "#athletics", function(event){
	// console.log('clicked');
	$('.athletics-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.academic-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.pro-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.expriences-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.references-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.guardian-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#athletics").addClass("active");
	$("#exprience").removeClass("active");
	$("#reference").removeClass("active");
	$("#guardian").removeClass("active");
	$("#academics").removeClass("active");
	$("#account").removeClass("active");
 });
 
  $("#progressbar").on("click", "#exprience", function(event){
	// console.log('clicked');
	$('.expriences-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.athletics-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.academic-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.pro-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.references-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.guardian-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#exprience").addClass("active");
	$("#reference").removeClass("active");
	$("#guardian").removeClass("active");
	$("#athletics").removeClass("active");
	$("#academics").removeClass("active");
	$("#account").removeClass("active");
 });
 
  $("#progressbar").on("click", "#reference", function(event){
	// console.log('clicked');
	$('.references-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.guardian-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.expriences-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.athletics-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.academic-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.pro-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#reference").addClass("active");
	$("#guardian").removeClass("active");
	$("#exprience").removeClass("active");
	$("#athletics").removeClass("active");
	$("#academics").removeClass("active");
	$("#account").removeClass("active");
});

 $("#progressbar").on("click", "#guardian", function(event){
	// console.log('clicked');
	$('.guardian-Info').css({'display':'block', 'position' : 'relative', 'opacity' : '1'});
	$('.references-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.expriences-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.athletics-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.academic-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$('.pro-Info').css({'display':'none', 'position' : 'relative', 'opacity' : '0'});
	$("#guardian").addClass("active");
	$("#reference").removeClass("active");
	$("#exprience").removeClass("active");
	$("#athletics").removeClass("active");
	$("#academics").removeClass("active");
	$("#account").removeClass("active");
});
 
 $(document).ready(function(){
		$('#sel1').chosen({disable_search_threshold: 10,width:'200px'});
		$('#sel2').chosen({width:'200px'});
		$('#sel3').chosen({no_results_text:"Not found",width:'200px'});
		$('#tags').chosen({max_selected_options:10,width:'100%'});
		$('#area_interest').chosen({max_selected_options:10,width:'100%'});
		$('#sel5').chosen({allow_single_deselect:true,width:'200px'});
	}); 
</script>
@include('admin.footer');	