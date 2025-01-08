@include('account.header');
<style>
	.showSweetAlert > h2{
	    font-size: 20px !important;
	}
	
	body {
		width: 100vw;
		height: 100vh;
		margin: 0;
	}

	.nav-categories .Active {
		background-color: rgb(255 255 255);
		box-shadow: 0 10px 10px #f1f1f1;
	}

	.nav-categories .Active p {
		color: #b38a41;
		font-weight: 600;
	}

	.TabContainer {
		display: flex;
		cursor: pointer;
		border-bottom: 2px solid #8d6a30;
		padding: 0;
		background: #ffffff;
		padding-top: 15px;
		padding-left: 20px;
		padding-right: 20px;
	}

	.Tab {
		border-radius: 15px 15px 0 0;
		padding: 10px 20px;
		background: #ffffff;
		font-size: 15px;
		color: #000000;
		box-shadow: 0 0 10px #ddd;
		min-width: 150px;
		text-align: center;
	}

	.Tab.active {
		color: #fff;
		border-radius: 15px 15px 0 0;
		background: linear-gradient(90deg, #b58b42, #7a5a28);
		font-size: 15px;
		font-weight: 600;
	}

	.TabContent {
		display: none;
		padding-left: 10px;
		padding-right: 10px;
	}

	.TabContent.active {
	    display: flex;
	}

	.TabBar {
		position: sticky;
		top: -20px;
		z-index: 100;
		padding-bottom: 10px;
	}

	.pac-container {
	    z-index: 10000 !important;
	}
	body{
		height:700px;
		overflow-x: hidden;
	}

	#country-list {
		float: left;
		list-style: none;
		margin-top: 20px;
		padding: 0;
		width: 99.7%;
		position: absolute;
		z-index: 1;
		margin-left: -500px;
	}

	#country-list li {
		padding: 10px;
		/*background: #f0f0f0;*/
		border-bottom: #bbb9b9 1px solid;
		/*border-radius: 8px;*/
		background: linear-gradient(90deg, #b58b42, #7a5a28)
	}

	#country-list li:hover {
		background: #ece3d2;
		cursor: pointer;
	} 
</style>


  <main role="main" class="Main">
    <div class="container-fluid m-0 Section Home">
      <div class="row m-0 HomeTab">
	    
		<?php
		    $proMng = DB::table('sub_permision_menu')->where(['sub_id' => @$usersubInfo->sub_id, 'menu_id' => 4])->select('*')->first();
			//print_r($proMng);
			
			if(@$proMng->read_access == 1 || @$proMng->write_access == 1 || @$proMng->full_access == 1){
				echo '
					<div class="col-lg-2 col-md-2 col-sm-6">
					  <a href="" id="Promotion">
						<img class="InActiveImg" src="'.url('assets/home/images/Icon9.png').'" alt="">
						<img class="ActiveImg" src="'.url('assets/home/images/Icon15.png').'" alt="">
						<p>Promotion Management</p>
					  </a>
					</div>
				';
			}
			
		?>
        
		<?php
		    $appMng = DB::table('sub_permision_menu')->where(['sub_id' => @$usersubInfo->sub_id, 'menu_id' => 3])->select('*')->first();
			if(@$appMng->read_access == 1 || @$appMng->write_access == 1 || @$appMng->full_access == 1){
				echo '
					<div class="col-lg-2 col-md-2 col-sm-6">
					  <a href="" id="Appearance">
						<img class="InActiveImg" src="'.url('assets/home/images/Icon11.png').'" alt="">
						<img class="ActiveImg" src="'.url('assets/home/images/Icon16.png').'" alt="">
						<p>Appearance Management</p>
					  </a>
					</div>
				';
			}
		?>
        
		<?php
		    $eventMng = DB::table('sub_permision_menu')->where(['sub_id' => @$usersubInfo->sub_id, 'menu_id' => 2])->select('*')->first();
			if(@$eventMng->read_access == 1 || @$eventMng->write_access == 1 || @$eventMng->full_access == 1){
				echo '
					<div class="col-lg-2 col-md-2 col-sm-6">
					  <a href="" id="Event">
						<img class="InActiveImg" src="'.url('assets/home/images/Icon12.png').'" alt="">
						<img class="ActiveImg" src="'.url('assets/home/images/Icon17.png').'" alt="">
						<p>Event Management</p>
					  </a>
					</div>
				';
			}
		?>
        
		<?php
		    $businessMng = DB::table('sub_permision_menu')->where(['sub_id' => @$usersubInfo->sub_id, 'menu_id' => 1])->select('*')->first();
			if(@$businessMng->read_access == 1 || @$businessMng->write_access == 1 || @$businessMng->full_access == 1){
				echo '
					<div class="col-lg-2 col-md-2 col-sm-6">
					  <a href="" id="Business">
						<img class="InActiveImg" src="'.url('assets/home/images/Icon13.png').'" alt="">
						<img class="ActiveImg" src="'.url('assets/home/images/Icon18.png').'" alt="">
						<p>Business Management</p>
					  </a>
					</div>
				';
			}
		?>
        
		<?php
		    $networkMng = DB::table('sub_permision_menu')->where(['sub_id' => @$usersubInfo->sub_id, 'menu_id' => 6])->select('*')->first();
			if(@$networkMng->read_access == 1 || @$networkMng->write_access == 1 || @$networkMng->full_access == 1){
				echo '
				<div class="col-lg-2 col-md-2 col-sm-6">
				  <a href="'.url('dashboard/network').'" id="Network-1">
					<img class="InActiveImg" src="'.url('assets/home/images/Icon14.png').'" alt="">
					<img class="ActiveImg" src="'.url('assets/home/images/Icon19.png').'" alt="">
					<p>Network Management</p>
				  </a>
				</div>
				';
			}	
		?>
        <div class="col-lg-2 col-md-2 col-sm-6">
          <a href="" id="Subscription">
            <img class="InActiveImg" src="<?=url('assets/home/images/Icon10.png')?>" alt="">
            <img class="ActiveImg" src="<?=url('assets/home/images/Icon20.png')?>" alt="">
            <p>Subscription Management</p>
          </a>
        </div>
		
      </div>
    </div>

    <div class="container-fluid m-0 Section Promotion" style="display: none;">
	
	<?php if(@$proMng->write_access == 1 || @$proMng->full_access == 1){ ?>  
	  <!-- Add Promotion Button -->
      <button type="button" class="AddButton" data-bs-toggle="modal" data-bs-target="#AddPromotionModal">
        <i class="fa fa-plus" aria-hidden="true"></i>
        <p>Add Promotion</p>
      </button>
	<?php } ?>

      <!-- Add Promotion Modal -->
      <div class="modal fade CustomModal" id="select-promotion-model" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Select Promotion Plan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
              <form class="row g-3" id="adsSub" method="post" enctype="multipart/form-data">
					
					
					<div class="col-md-6 col-sm-12">
					  <label class="form-label">Preferred Listing</label>
					    <select name="preferredListing" id="preferredListing" required>
							<option value="">Choose a type</option>
							<option value="1">Yes</option>
							<option value="0">No</option>
					    </select>
					</div>
					
					<div class="col-md-6 col-sm-12" style="display:none;" id="promotionPrefered">
					  <label class="form-label">Duration</label>
					  <input type="text" placeholder="Enter Duration Number of Days" name="duration"  id="duration"  autocomplete="off" >
					  <input type="hidden"  name="adsId"  id="adsId"  autocomplete="off" >
					</div>
					
					<!--<div class="col-md-12 col-sm-12">
					  <label class="form-label">Select Subscription</label>
					    <select name="subId" id="subId" required>
						    <option disabled value="">Choose a Subscription</option>
						    <?php
							    if(count(@$adsPlan) > 0){
									foreach($adsPlan as $k => $v){
										echo '<option value="'.@$v->id.'">'.@$v->name.' / $'.@$v->price.' / '.@$v->plan_duration.'-'.@$v->plan_type.'</option>';
									}
								}
							?>
					    </select>
					</div>-->
					
					
					<div class="AddAdvertisementPlan">
								<div class="col-lg-12 col-md-12 col-sm-12 AddAdvertisementPlanContainer">
					<?php
						if(count(@$adsPlan) > 0){
							foreach($adsPlan as $k => $v){
								
								$nav = @$v->description;
								$nav = str_replace(array('<li>', '</li>'),'&&',$nav);

								$nav = str_replace(array('<ul>', '</ul>'),'',$nav);
								//$n = explode('11', $nav);die;
								$nav = array_filter(explode('&&', $nav));
								$nav1 = [];
								// foreach($nav as $k => $v){
								// $nav1[] = $v;
								// }
								$out = '';
								$learnMore = '';
								foreach($nav as $k1 => $v1){
                                    @$out.='<li>'.@$v1.'</li>';
								}
							echo '
									<div class="col-md-6 col-sm-12 pe-2">
									<div class="SubscriptionBlock">
									  <div class="SubscriptionHeadingBlock">
										<h2>'.@$v->name.'</h2>
										<p class="m-0">$'.@$v->price.'/'.@$v->plan_duration.'-'.@$v->plan_type.'</p>
									  </div>
									  <ul>
										'.@$out.'
									  </ul>
									  <div class="SubscriptionBtnContainer">
										<a href="javascript:void(0)" class="SubscriptionBtn ChooseBtn">
										  <input type="radio" name="subId" id="subId" value="'.@$v->id.'" style="width: 20px;">
										</a>
										<!--<a href="" class="AdvertisementLearnMoreBtn">Learn More</a>-->
									  </div>
									</div>
								  </div>
							  ';
						} 
						}
						?>
					</div>
						  </div>
					
					
					<div class="modal-footer">
					    <button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			  
            </div>
            
			
          </div>
        </div>
      </div>
	  
		<?php if(@$proMng->write_access == 1 || @$proMng->full_access == 1){ ?>
			<!-- Add Promotion Button -->
			<button type="button" class="AddButton" data-bs-toggle="modal" data-bs-target="#AddPromotionModal">
				<i class="fa fa-plus" aria-hidden="true"></i>
				<p>Add Promotion</p>
			</button>
		<?php } ?>

      <!-- Add Promotion Modal -->
      <div class="modal fade CustomModal" id="AddPromotionModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Promotion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
              <form class="row g-3" id="adssubmitform" method="post" enctype="multipart/form-data">
					<div class="col-md-4 col-sm-12">
					  <label class="form-label">Category</label>
					  <select name="ads_category" id="ads_category" required>
						<option selected disabled value="">Choose a category</option>
						<?php
							if($category){
								foreach($category as $k => $v){
									echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
								}
							}
						?>
					  </select>
					</div>
					<div class="col-md-4 col-sm-12">
					  <label class="form-label">Type</label>
					  <select name="file_type" id="file_type" required>
						<option selected disabled value="">Choose a type</option>
						<option value="1">Image</option>
						<option value="2">Video</option>
					  </select>
					</div>
					<div class="col-md-4 col-sm-12">
					  <label class="form-label">Title</label>
					  <input type="text" placeholder="Enter title" name="ads_name"  id="ads_name"  autocomplete="off" required>
					</div>
					<div class="col-md-4 col-sm-12">
					  <label class="form-label">Upload File</label>
					  <input type="file" class="form-control"  name="ads_image"  id="ads_image">
					</div>
					<div class="row m-0 pt-4 pb-2">
					  <div class="row m-0 InnerData g-3">
						<p class="Heading">Target Audience</p>
						<div class="col-md-4 col-sm-12">
						  <label class="form-label">Gender</label>
						  <select name="gender" id="gender" required>
							<option selected disabled value="">Select gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						  </select>
						</div>
						<div class="col-md-4 col-sm-12">
						  <label class="form-label">Age</label>
						  <select name="age" id="age" required>
							<option selected disabled value="">Select age range</option>
							<?php
								if(@$age){
									foreach(@$age as $k => $v){
										echo '<option value="'.@$v->id.'">'.@$v->age.'</option>';
									}
								}
							?>
						  </select>
						</div>
						<div class="col-md-4 col-sm-12">
						  <label class="form-label">Parental Status</label>
						  <select name="parental_status" id="parental_status" required>
							<option selected disabled value="">Select parental status</option>
							<option value="Parent">Parent</option>
							<option value="Not a Parent">Not a Parent</option>
						  </select>
						</div>
						<div class="col-md-4 col-sm-12">
						  <label class="form-label">Household Income</label>
						  <select name="income" id="income" required>
							<option selected disabled value="">Select household income</option>
							<?php
								if(@$income){
									foreach(@$income as $k => $v){
										echo '<option value="'.@$v->id.'">'.@$v->income.'</option>';
									}
								}
							?>
						  </select>
						</div>
						<div class="col-md-4 col-sm-12">
						  <label class="form-label">Location</label>
						<input type="text" class="form-control" name="location"  id="autocomplete_1" placeholder="Select location">
						<input type="hidden" class="form-control" name="latitude"  id="latitude" >
						<input type="hidden" class="form-control" name="longitude"  id="longitude" >
						</div>
					  </div>
					</div>
					<div class="modal-footer">
					    <button type="submit" class="btn btn-primary">Select Promotion Plan</button>
					</div>
				</form>
			  
            </div>
            <!--<div class="modal-footer">
              <button type="button" class="btn btn-primary">Select Promotion Plan</button>
            </div>-->
			
          </div>
        </div>
      </div>

      <!-- Edit Promotion Modal -->
      <div class="modal fade CustomModal" id="EditPromotionModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Promotion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
              <form class="row g-3" id="editadssubmitform" method="post" enctype="multipart/form-data">
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Category</label>
						<select name="edit_ads_category" id="edit_ads_category" required>
						<option  disabled value="">Choose a category</option>
						<?php
							if($category){
								foreach($category as $k => $v){
								    echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
								}
							}
						?>
						</select>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Type</label>
						<select name="edit_file_type" id="edit_file_type" required>
							<option  disabled value="">Choose a type</option>
							<option value="1">Image</option>
							<option value="2">Video</option>
						</select>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Title</label>
						<input type="text" placeholder="Enter title" name="edit_ads_name"  id="edit_ads_name"  autocomplete="off" required>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Upload File</label>
						<input type="file" class="form-control"  name="edit_ads_image"  id="edit_ads_image">
					</div>
					
					<div class="row m-0 pt-4 pb-2">
					  <div class="row m-0 InnerData g-3">
						<p class="Heading">Target Audience</p>
						<div class="col-md-4 col-sm-12">
							<label class="form-label">Gender</label>
							<select name="edit_gender" id="edit_gender" required>
								<option  disabled value="">Select gender</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						
						<div class="col-md-4 col-sm-12">
							<label class="form-label">Age</label>
							<select name="edit_age" id="edit_age" required>
								<option  disabled value="">Select age range</option>
								<?php
								if(@$age){
									foreach(@$age as $k => $v){
									    echo '<option value="'.@$v->id.'">'.@$v->age.'</option>';
									}
								}
								?>
							</select>
						</div>
						
						<div class="col-md-4 col-sm-12">
							<label class="form-label">Parental Status</label>
							<select name="edit_parental_status" id="edit_parental_status" required>
								<option  disabled value="">Select parental status</option>
								<option value="Parent">Parent</option>
								<option value="Not a Parent">Not a Parent</option>
							</select>
						</div>
						
						<div class="col-md-4 col-sm-12">
							<label class="form-label">Household Income</label>
							<select name="edit_income" id="edit_income" required>
								<option  disabled value="">Select household income</option>
								<?php
								if(@$income){
									foreach(@$income as $k => $v){
									    echo '<option value="'.@$v->id.'">'.@$v->income.'</option>';
									}
								}
								?>
							</select>
						</div>
						
						<div class="col-md-4 col-sm-12">
							<label class="form-label">Location</label>
							<input type="text" class="form-control" name="edit_location"  id="edit_autocomplete_1" placeholder="Select location">
							<input type="hidden" class="form-control" name="edit_latitude"  id="edit_latitude" >
							<input type="hidden" class="form-control" name="edit_longitude"  id="edit_longitude" >
							<input type="hidden" class="form-control" name="edit_id"  id="edit_id" >
						</div>
					  </div>
					</div>
					<div class="modal-footer">
					    <button type="submit" class="btn btn-primary">Submit</button>
					</div>
					
				    </form>
			  
            </div>
            <!--<div class="modal-footer">
              <button type="button" class="btn btn-primary">Select Promotion Plan</button>
            </div>-->
          </div>
        </div>
      </div>

      <!-- Delete Promotion Modal -->
      <div class="modal fade CustomModal" id="DeletePromotionModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Promotion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="InfoText">Do you really want your promotion to be deleted? It cannot be undone once deleted.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Delete</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Details Promotion Modal -->
      <div class="modal fade CustomModal" id="DetailsPromotionModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Promotion Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			
            <div class="modal-body promotion-block-detail" id="">
              
			  
            </div>
			
			
          </div>
        </div>
      </div>

      <div class="row m-0 TabBar">
        <div class="Pagination">
          <a href="" id="Home"><i class="fa fa-angle-left" aria-hidden="true"></i> Home / Promotion Management</a>
        </div>
		<?php if(@$proMng->read_access == 1 || @$proMng->full_access == 1){ ?>
			<div class="TabContainer">
			  <div class="Tab active" onclick="openTab(event, 'AllPromotion')">All Promotion</div>
			  <div class="Tab" onclick="openTab(event, 'MyPromotion')">My Promotion</div>
			</div>
		<?php } ?>
		
      </div>
       <?php if(@$proMng->read_access == 1 || @$proMng->full_access == 1){ ?>
			<div id="AllPromotion" class="row m-0 TabContent active">
				<?php
					if(@$adsList){
						foreach(@$adsList as $k => $v){
							
							echo '<div class="Card col-lg-3 col-md-3 col-sm-6">
								<div class="CardInner promotion-detail" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#DetailsPromotionModal">
								<div class="Cover"></div>
								<p class="Heading">'.@$v->ads_name.'</p>
								<p class="SubHeading">'.strip_tags(@$v->description).'</p>
								</div>
							</div>';
						}
					}else{
						echo 'Not found any promotion.';
					} 
				?>
			</div>
        <?php } ?>
		
      <div id="MyPromotion" class="row m-0 TabContent">
		<?php
		    if(@$myadsList){
			foreach(@$myadsList as $k => $v){
				
		        if(@$proMng->write_access == 1 || @$proMng->full_access){
					
					$editDelete='
						<a href="javascript::voide(0);" class="edit-info" relid="'.$v->id.'" data-bs-toggle="modal" data-bs-target="#EditPromotionModal">
							<i class="fa fa-pencil-square" aria-hidden="true"></i>
						</a>

						<a href="javascript::voide(0);" onclick="deletePromotion('.@$v->id.')" data-bs-toggle="modal" data-bs-target="#DeletePromotionModal1">
							<i class="fa fa-trash" aria-hidden="true"></i>
						</a>
					';
					
				}else{
					$editDelete = '';
				}
			
				echo '
				<div class="Card col-lg-3 col-md-3 col-sm-6">
					<div class="CardInner promotion-detail-1"  relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#DetailsPromotionModal">
						<div class="Cover"></div>
						<p class="Heading">'.@$v->ads_name.'</p>
						<p class="SubHeading">'.strip_tags(@$v->description).'</p>

						<div class="IconContainer">

							'.@$editDelete.'
							
						</div>
					</div>
				</div>
				';
		}
		}else{
			echo 'Not found any promotion.';
		} 
		?>
		
		
      </div>
    </div>

    <div class="container-fluid m-0 Section Appearance" style="display: none;">
	
		<?php if(@$appMng->write_access == 1 || @$appMng->full_access == 1){ ?>
			<!-- Send Invitation Button -->
			<button type="button" class="AddButton" data-bs-toggle="modal" data-bs-target="#AddAppearanceModal">
				<i class="fa fa-plus" aria-hidden="true"></i>
				<p>Send Invitation</p>
			</button>
		<?php } ?>

      <!-- Send Invitation Modal -->
      <div class="modal fade CustomModal" id="AddAppearanceModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Send Invitation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="row g-3" id="invisubmitform" method="post" enctype="multipart/form-data">
			  
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Select Event</label>
                  <select name="invi_event_name" id="invi_event_name" required>
                    <option disabled value="">Select Event</option>
                        <?php
						    if(count(@$upcomingEventList)){
								foreach(@$upcomingEventList as $k => $v){
									echo '<option value="'.@$v->id.'">'.@$v->event_name.'</option>';
								}
							}
						?>
                  </select>
                </div>
				
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Select Athletics/Entertainer</label>
                  <select name="invi_event_user" id="invi_event_user" required>
                    <option disabled value="">Selct</option>
                    <?php
					    if(count(@$athletic)){
							foreach(@$athletic as $k => $v){
								echo '<option value="'.@$v->id.'">'.@$v->first_name.' '.@$v->last_name.'</option>';
							}
						}
					?>
                  </select>
                </div>
				
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Price</label>
                  <input type="text" placeholder="Enter price" name="invi_price" id="invi_price" required>
                </div>
				
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Start Time</label>
                  <input type="time" placeholder="Time" name="invi_start_time" id="invi_start_time" required>
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">End Time</label>
                  <input type="time" placeholder="Time" name="invi_end_time" id="invi_end_time" required>
                </div>
                <div class="col-md-12 col-sm-12">
                  <label class="form-label">Instructions</label>
                  <textarea type="text" placeholder="Description" name="invi_description" id="invi_description"></textarea>
                </div>
				
				<div class="modal-footer">
				  <button type="submit" class="btn btn-primary">Submit</button>
				</div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <?php if(@$appMng->full_access == 1){ ?>
		  <!-- Send Appearance Modal 1 -->
		  <div class="modal fade CustomModal" id="AppearanceModal1" data-bs-backdrop="static" data-bs-keyboard="false"
			tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title">Accepted</h5>
				  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body AppearanceData">
				  <form class="row g-3">
					<div class="col-md-6 col-sm-12 QRBlock">
					  <p>Scan QR code</p>
					  <img src="<?=url('assets/home/images/QRCode.png')?>" alt="">
					</div>
					<div class="col-md-6 col-sm-12 BtnContainer" style="width:50%;">
					  <button type="button" class="btn btn-primary">
						<span>
						  <img src="<?=url('assets/home/images/Icon1.png')?>" alt="">
						</span>
						<p>Appearance Initiated</p>
					  </button>
					  <button type="button" class="btn btn-primary">
						<span>
						  <img src="<?=url('assets/home/images/Icon1.png')?>" alt="">
						</span>
						<p>Appearance not attended</p>
					  </button>
					  <button type="button" class="btn btn-primary">
						<span>
						  <img src="<?=url('assets/home/images/Icon2.png')?>" alt="">
						</span>
						<p>Appearance ended</p>
					  </button>
					  <button type="button" class="btn btn-primary">
						<span>
						  <img src="<?=url('assets/home/images/Icon3.png')?>" alt="">
						</span>
						<p>Contact invitee</p>
					  </button>
					  <button type="button" class="btn btn-primary">
						<span>
						  <img src="<?=url('assets/home/images/Icon4.png')?>" alt="">
						</span>
						<p>Contact admin</p>
					  </button>
					</div>
				  </form>
				</div>
			  </div>
			</div>
		  </div>
	  <?php } ?>

      <!-- Send Appearance Modal 2 -->
      <div class="modal fade CustomModal" id="AppearanceModal2" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Final Offer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body AppearanceData">
			
              <form class="row g-3" id="sentCountorOffer" >
                <div class="col-md-6 col-sm-12 SmallDataBlock">
                  <p class="Heading">Send final offer</p>
				        <div class="counter-offer-block">
						    
						</div>
						<div class="BlockData1">
							
						</div>
						
						<div class="BlockData21">
							
						</div>

                  <div class="col-md-12 col-sm-12">
                    <label class="form-label">Enter final Offer</label>
                    <input type="text" placeholder="Enter amount" id="counter_offer" name="counter_offer">
                    <input type="hidden"  id="invi_id" name="invi_id">
                  </div>
				  
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
				
                <div class="col-md-6 col-sm-12 BtnContainer" style="width:50%;">
                  <button type="button" class="btn btn-primary accept-offer" >
                    <span>
                      <img src="<?=url('assets/home/images/Icon5.png')?>" alt="">
                    </span>
                    <p>Accept counter offer</p>
                  </button>
				  
                  <button type="button" class="btn btn-primary reject-offer">
                    <span>
                      <img src="<?=url('assets/home/images/Icon2.png')?>" alt="">
                    </span>
                    <p>Withdraw invitation</p>
                  </button>
				  
                </div>
				
              </form>
			  
            </div>
          </div>
        </div>
      </div>

      <!-- Send Appearance Modal 3 -->
      <div class="modal fade CustomModal" id="AppearanceModal3" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Pending</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body AppearanceData">
              <form class="row">
                <div class="col-md-12 col-sm-12 BtnContainer">
                  <button type="button" class="btn btn-primary pending-reject-offer" >
                    <span>
                      <img src="<?=url('assets/home/images/Icon2.png')?>" alt="">
                    </span>
                    <p>Withdraw invitation</p>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Send Appearance Modal 4 -->
      <div class="modal fade CustomModal" id="AppearanceModal4" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Rejected</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body AppearanceData">
              <form class="row g-3">
                <div class="col-md-12 col-sm-12 BtnContainer flex-row">
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="<?=url('assets/home/images/Icon2.png')?>" alt="">
                    </span>
                    <p>Clear from list</p>
                  </button>
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="<?=url('assets/home/images/Icon2.png')?>" alt="">
                    </span>
                    <p>Clear all</p>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row m-0 TabBar">
        <div class="Pagination">
          <a href="" id="Home"><i class="fa fa-angle-left" aria-hidden="true"></i> Home / Appearance Management</a>
        </div>
        <?php if(@$appMng->read_access == 1 || @$appMng->write_access == 1 || @$appMng->full_access == 1){ ?>
			<div class="TabContainer">
				<div class="Tab active" onclick="openTab(event, 'AcceptedAppearance')">Accepted</div>
				<div class="Tab" onclick="openTab(event, 'SentAppearance')">Sent</div>
				<div class="Tab" onclick="openTab(event, 'CompletedAppearance')">Completed</div>
			</div>
		<?php } ?>
		
      </div>
      <?php if(@$appMng->read_access == 1 || @$appMng->write_access == 1 || @$appMng->full_access == 1){ ?>
		  <div id="AcceptedAppearance" class="row m-0 TabContent active">
			<?php
				if(count(@$accept)){
					foreach($accept as $k => $v){
						
						$userInfo = DB::select("select first_name, last_name from users where (id = '".$v->sender_id."' OR id = '".$v->receiver_id."') LIMIT 1");
						$eventInfo = DB::select("select event_name, location, category, start_date from events where id = '".$v->event_id."' LIMIT 1");	
						$cate = DB::select("select * from event_category where id = '".@$eventInfo[0]->category."' LIMIT 1");
									

						$startDate  = @$eventInfo[0]->start_date;
						$start_date = date('Y-m-d', strtotime($startDate));
						$start_time = date('H:i:s', strtotime($startDate));
						
						if(@$appMng->full_access == 1){ 
							$model = '
								<a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal1">
									<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
								</a>
							';
						}else{
							$model = '';
						}
				
						echo '
							<div class="Card col-lg-3 col-md-3 col-sm-6">
							  <div class="CardInner">
								<div class="Cover"></div>
								<p class="Heading">'.@$userInfo[0]->first_name.' '.@$userInfo[0]->last_name.'</p>
								<p class="SubHeading">'.@$eventInfo[0]->event_name.' ('.@$cate[0]->name.')</p>
								<p class="SubHeading">Location: '.substr(@$eventInfo[0]->location,0,20).'</p>
								<p class="SubHeading">Date: '.@$start_date.'</p>
								<p class="SubHeading">Time: '.@$start_time.'</p>
								<p class="SubHeading">Price: $'.@$v->amount.'</p>
								<div class="IconContainer">
								
								  '.@$model.'
								  
								</div>
							  </div>
							</div>
						';
					}
				}else{
					echo 'Not found any request.';
				}
			?>
		  </div>
      <?php } ?>
      <div id="SentAppearance" class="row m-0 TabContent">
        <ul class="nav nav-tabs InnerTabContainer" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" data-bs-toggle="tab" href="#CounterOffer" role="tab" aria-controls="CounterOffer"
              aria-selected="true">Counter Offer</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#Pending" role="tab" aria-controls="Pending"
              aria-selected="false">Pending</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#Rejected" role="tab" aria-controls="Rejected"
              aria-selected="false">Rejected</a>
          </li>
        </ul>
        <div class="tab-content InnerTabData" id="tab-content">
          <div class="tab-pane active" id="CounterOffer" role="tabpanel">
            <div class="row">
			
			    <?php
				    if(count(@$counter)){
						foreach(@$counter as $k => $v){
							
							$userInfo = DB::select("select first_name, last_name from users where (id = '".$v->sender_id."' OR id = '".$v->receiver_id."') LIMIT 1");
							$eventInfo = DB::select("select event_name, location, category, start_date from events where id = '".$v->event_id."' LIMIT 1");	
							$cate = DB::select("select * from event_category where id = '".@$eventInfo[0]->category."' LIMIT 1");
										

							$startDate  = @$eventInfo[0]->start_date;
							$start_date = date('Y-m-d', strtotime($startDate));
							$start_time = date('H:i:s', strtotime($startDate));
					        
							if(@$appMng->full_access == 1){ 
								$counter='
									<a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal2" class="repeat-invitation" relid="'.@$v->invId.'">
										<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
									</a>
								';
							}else{
								$counter='';
							}
							
							echo '
								<div class="Card col-lg-3 col-md-3 col-sm-6">
									<div class="CardInner">
										<div class="Cover"></div>
										<p class="Heading">'.@$userInfo[0]->first_name.' '.@$userInfo[0]->last_name.'</p>
										<p class="SubHeading">'.@$eventInfo[0]->event_name.' ('.@$cate[0]->name.')</p>
										<p class="SubHeading">Location: '.substr(@$eventInfo[0]->location,0,20).'</p>
										<p class="SubHeading">Date: '.@$start_date.'</p>
										<p class="SubHeading">Time: '.@$start_time.'</p>
										<p class="SubHeading">Price: $'.@$v->amount.'</p>
										<div class="IconContainer">
											'.@$counter.'
										</div>
									</div>
								</div>
							';
						}
					}else{
						echo 'Not found any request.';
					}
				?>
            </div>
          </div>
		  
          <div class="tab-pane" id="Pending" role="tabpanel">
            <div class="row">
			    <?php
			        if(@$pending){
						foreach(@$pending as $k => $v){
							$userInfo = DB::select("select first_name, last_name from users where user_type = '10' AND (id = '".$v->sender_id."' OR id = '".$v->receiver_id."') LIMIT 1");
							$eventInfo = DB::select("select event_name, location, category, start_date from events where id = '".$v->event_id."' LIMIT 1");	
							$cate = DB::select("select * from event_category where id = '".@$eventInfo[0]->category."' LIMIT 1");
										

							$startDate  = @$eventInfo[0]->start_date;
							$start_date = date('Y-m-d', strtotime($startDate));
							$start_time = date('H:i:s', strtotime($startDate));
							
							if(@$appMng->full_access == 1){ 
								$pending = '
									<a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal3" class="withdraw-invitation" relid="'.@$v->invId.'">
										<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
									</a>
								';
							}else{
								$pending = '';
							}
							
							echo '
								<div class="Card col-lg-3 col-md-3 col-sm-6">
									<div class="CardInner">
										<div class="Cover"></div>
										<p class="Heading">'.@$userInfo[0]->first_name.' '.@$userInfo[0]->last_name.'</p>
										<p class="SubHeading">'.@$eventInfo[0]->event_name.' ('.@$cate[0]->name.')</p>
										<p class="SubHeading">Location: '.substr(@$eventInfo[0]->location,0,20).'</p>
										<p class="SubHeading">Date: '.@$start_date.'</p>
										<p class="SubHeading">Time: '.@$start_time.'</p>
										<p class="SubHeading">Price: $'.@$v->amount.'</p>
										<div class="IconContainer">
											'.@$pending.'
										</div>
									</div>
								</div>
							';
						}
					}
			    ?>
				
			  
            </div>
          </div>
		  
          <div class="tab-pane" id="Rejected" role="tabpanel">
            <div class="row">
			    <?php
				    if(@$rejectIn){
						foreach(@$rejectIn as $k => $v){
							
							$userInfo = DB::select("select first_name, last_name from users where user_type = '10' AND (id = '".$v->sender_id."' OR id = '".$v->receiver_id."') LIMIT 1");
							$eventInfo = DB::select("select event_name, location, category, start_date from events where id = '".$v->event_id."' LIMIT 1");	
							$cate = DB::select("select * from event_category where id = '".@$eventInfo[0]->category."' LIMIT 1");
										

							$startDate  = @$eventInfo[0]->start_date;
							$start_date = date('Y-m-d', strtotime($startDate));
							$start_time = date('H:i:s', strtotime($startDate));
							
							if(@$appMng->full_access == 1){ 
								$reject='
									<a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal4">
										<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
									</a>
								';
							}else{
								$reject='';
							}
							
							echo '
								<div class="Card col-lg-3 col-md-3 col-sm-6">
									<div class="CardInner">
										<div class="Cover"></div>
										<p class="Heading">'.@$userInfo[0]->first_name.' '.@$userInfo[0]->last_name.'</p>
										<p class="SubHeading">'.@$eventInfo[0]->event_name.' ('.@$cate[0]->name.')</p>
										<p class="SubHeading">Location: '.substr(@$eventInfo[0]->location,0,20).'</p>
										<p class="SubHeading">Date: '.@$start_date.'</p>
										<p class="SubHeading">Time: '.@$start_time.'</p>
										<p class="SubHeading">Price: $'.@$v->amount.'</p>
										<div class="IconContainer">
											'.@$reject.'
										</div>
									</div>
								</div>
							';
						}
					}
				?>
				
			  
            </div>
          </div>
        </div>
      </div>

      <div id="CompletedAppearance" class="row m-0 TabContent">
		<?php
		    if(count(@$complete)){
				foreach($complete as $k => $v){
					
					$eventInfo = DB::select("select event_name, location, category, start_date from events where id = '".$v->event_id."' AND DATE(start_date) < '".date('Y-m-d')."' LIMIT 1");
					
					if(count($eventInfo) > 0){
						$userInfo = DB::select("select first_name, last_name from users where user_type = '10' AND (id = '".$v->sender_id."' OR id = '".$v->receiver_id."') LIMIT 1");
						//$eventInfo = DB::select("select event_name, location, category, start_date from events where id = '".$v->event_id."' LIMIT 1");	
						$cate = DB::select("select * from event_category where id = '".@$eventInfo[0]->category."' LIMIT 1");
									

						$startDate  = @$eventInfo[0]->start_date;
						$start_date = date('Y-m-d', strtotime($startDate));
						$start_time = date('H:i:s', strtotime($startDate));
				
						echo '
							<div class="Card col-lg-3 col-md-3 col-sm-6">
							  <div class="CardInner">
								<div class="Cover"></div>
								<p class="Heading">'.@$userInfo[0]->first_name.' '.@$userInfo[0]->last_name.'</p>
								<p class="SubHeading">'.@$eventInfo[0]->event_name.' ('.@$cate[0]->name.')</p>
								<p class="SubHeading">Location: '.substr(@$eventInfo[0]->location,0,20).'</p>
								<p class="SubHeading">Date: '.@$start_date.'</p>
								<p class="SubHeading">Time: '.@$start_time.'</p>
								<p class="SubHeading">Price: $'.@$v->amount.'</p>
								<div class="IconContainer">
								  <!--<a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal1">
									<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
								  </a>--> 
								</div>
							  </div>
							</div>
						';
					}
				}
			}else{
				echo 'Not found any request.';
			}
		?>
      </div>
    </div>

    <div class="container-fluid m-0 Section Event" style="display: none;">
		<?php if(@$eventMng->write_access == 1 || @$eventMng->full_access == 1){	?>
			<!-- Add Event Button -->
			<button type="button" class="AddButton" data-bs-toggle="modal" data-bs-target="#AddEventModal">
				<i class="fa fa-plus" aria-hidden="true"></i>
				<p>Add Event</p>
			</button>
		<?php } ?>  

      <!-- Add Event Modal -->
      <div class="modal fade CustomModal" id="AddEventModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Event</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
              <form class="row g-3" id="submitform" method="post" enctype="multipart/form-data">
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Event Name *</label>
                  <input type="text" placeholder="Enter event name" name="event_name" id="event_name" required>
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Location *</label>
                  <input type="text" placeholder="Enter location" name="event_address" id="event_address" required>
					<input type="hidden" placeholder="Near"  name="event_latitude" id="event_latitude" >
					<input type="hidden" placeholder="Near" name="event_longitude" id="event_longitude" >
					<input type="hidden" placeholder="Near" name="event_country" id="event_country" >
					<input type="hidden" placeholder="Near" name="event_state" id="event_state" >
					<input type="hidden" placeholder="Near" name="event_city" id="event_city" >
					<input type="hidden" placeholder="Near" name="event_zipcode" id="event_zipcode" >
					<input type="hidden" placeholder="Near" name="userId" id="userId" value="<?=session()->get('USERLOGINID')?>">
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Tags</label>
                  <!--<input type="text" placeholder="#Tags" name="event_tags" id="event_tags">-->
				  
				  <select  name="event_tags" id="event_tags" multiple>
                        <option disabled value="">Choose a Tags</option>
                        <?php
						    if(@$tags){
								foreach(@$tags as $k => $v){
									echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
								}
							}
						?>
                    </select>
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Date *</label>
                  <input type="date" placeholder="Date" name="event_date" id="event_date" required>
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Time *</label>
                  <input type="time" placeholder="Time" name="event_time" id="event_time" required>
                </div>
                <div class="col-md-12 col-sm-12">
                  <label class="form-label">Description</label>
                  <textarea type="text" placeholder="Description" name="event_description" id="event_description"></textarea>
                </div>
                <div class="row m-0 pt-3">
                  <div class="row m-0 InnerData g-3" style="padding: 10px;">
				  
                    <div class="col-md-4 col-sm-12 m-0">
                      <label class="form-label">Category *</label>
                      <select name="event_category" id="event_category" required>
                        <option selected disabled value="">Choose a category</option>
                        <?php
						    if(@$eventCat){
								foreach(@$eventCat as $k => $v){
									echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
								}
							}
						?>
                      </select>
                    </div>
					
                    <!--<div class="col-md-4 col-sm-12 m-0 d-flex align-items-center justify-content-center">
                      <p class="ORText">OR</p>
                    </div>
                    <div class="col-md-4 col-sm-12 m-0">
                      <label class="form-label">Add Category *</label>
                      <input type="text" placeholder="Add a category">
                    </div>-->
					
                  </div>
                </div>
                <div class="row m-0 pt-4 pb-2">
                  <div class="row m-0 InnerData g-3">
                    <p class="Heading">Event Information</p>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Phone *</label>
                      <input type="text" placeholder="Enter phone number" name="event_phone" id="event_phone" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Email *</label>
                      <input type="email" placeholder="Enter email address" name="event_email" id="event_email" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Website</label>
                      <input type="text" placeholder="Enter website URL" name="event_website" id="event_website">
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Upload Images</label>
                      <input type="file" class="form-control" id="event_image" name="event_image" autocomplete="off" multiple >
                    </div>
                  </div>
                </div>
				
				<div class="modal-footer">
				  <button type="submit" class="btn btn-primary">Submit</button>
				</div>
              </form>
			  
            </div>
            <!--<div class="modal-footer">
              <button type="button" class="btn btn-primary">Submit</button>
            </div>-->
          </div>
        </div>
      </div>

      <!-- Edit Event Modal -->
      <div class="modal fade CustomModal" id="EditEventModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Event</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
              <form class="row g-3" id="edit_event_submitform" method="post" enctype="multipart/form-data">
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Event Name *</label>
                  <input type="text" placeholder="Enter event name" name="edit_event_name" id="edit_event_name" required>
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Location *</label>
                    <input type="text"   placeholder="Enter location" name="edit_event_address" id="edit_event_address" required>
					<input type="hidden" placeholder="Near"  name="edit_event_latitude" id="edit_event_latitude" >
					<input type="hidden" placeholder="Near" name="edit_event_longitude" id="edit_event_longitude" >
					<input type="hidden" placeholder="Near" name="edit_event_country" id="edit_event_country" >
					<input type="hidden" placeholder="Near" name="edit_event_state" id="edit_event_state" >
					<input type="hidden" placeholder="Near" name="edit_event_city" id="edit_event_city" >
					<input type="hidden" placeholder="Near" name="edit_event_zipcode" id="edit_event_zipcode" >
					<input type="hidden" placeholder="Near" name="edit_event_id" id="edit_event_id" >
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Tags</label>
                  
				  
				    <select name="edit_event_tags" id="edit_event_tags" multiple>
                        <option disabled value="">Choose a Tags</option>
                        <?php
						    if(@$tags){
								foreach(@$tags as $k => $v){
									echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
								}
							}
						?>
                    </select>
				  
				  
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Date *</label>
                  <input type="date" placeholder="Date" name="edit_event_date" id="edit_event_date" required>
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Time *</label>
                  <input type="time" placeholder="Time" name="edit_event_time" id="edit_event_time" required>
                </div>
                <div class="col-md-12 col-sm-12">
                  <label class="form-label">Description</label>
                  <textarea type="text" placeholder="Description" name="edit_event_description" id="edit_event_description"></textarea>
                </div>
                <div class="row m-0 pt-3">
                  <div class="row m-0 InnerData g-3" style="padding: 10px;">
				  
                    <div class="col-md-4 col-sm-12 m-0">
                      <label class="form-label">Category *</label>
                      <select name="edit_event_category" id="edit_event_category" required>
                        <option selected disabled value="">Choose a category</option>
                        <?php
						    if(@$eventCat){
								foreach(@$eventCat as $k => $v){
									echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
								}
							}
						?>
                      </select>
                    </div>
					
                    <!--<div class="col-md-4 col-sm-12 m-0 d-flex align-items-center justify-content-center">
                      <p class="ORText">OR</p>
                    </div>
                    <div class="col-md-4 col-sm-12 m-0">
                      <label class="form-label">Add Category *</label>
                      <input type="text" placeholder="Add a category">
                    </div>-->
					
                  </div>
                </div>
                <div class="row m-0 pt-4 pb-2">
                  <div class="row m-0 InnerData g-3">
                    <p class="Heading">Event Information</p>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Phone *</label>
                      <input type="text" placeholder="Enter phone number" name="edit_event_phone" id="edit_event_phone" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Email *</label>
                      <input type="email" placeholder="Enter email address" name="edit_event_email" id="edit_event_email" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Website</label>
                      <input type="text" placeholder="Enter website URL" name="edit_event_website" id="edit_event_website">
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Upload Images</label>
                      <input type="file" class="form-control" id="edit_event_image" name="edit_event_image" autocomplete="off" multiple >
                    </div>
                  </div>
                </div>
				
				<div class="modal-footer">
				  <button type="submit" class="btn btn-primary">Submit</button>
				</div>
              </form>
			  
            </div>
            <!--<div class="modal-footer">
              <button type="button" class="btn btn-primary">Submit</button>
            </div>-->
          </div>
        </div>
      </div>

      <!-- Delete Event Modal -->
      <div class="modal fade CustomModal" id="DeleteEventModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Event</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="InfoText">Do you really want your event to be deleted? It cannot be undone once deleted.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Delete</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Details My Event Modal -->
      <div class="modal fade CustomModal" id="DetailsMyEventModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Event Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body event-block-detail" id="">
			
			
			
              <!--<div class="row PromotionDetail">
                <div class="col-md-8 col-sm-12 PromotionImg">
                  <img class="w-100"
                    src="https://img.freepik.com/free-photo/people-concert_1160-737.jpg?t=st=1730050734~exp=1730054334~hmac=4785251%E2%80%A6&w=900"
                    alt="">
                </div>
                <div class="col-md-4 col-sm-12 PromotionData">
                  <img class="OwnerImg"
                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&amp;w=1887&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="">
                  <p class="TitleText">Event Name</p>
                  <p class="OwnerText">Event Organizer Name</p>
                  <p class="OwnerText"><b>Location:</b></p>
                  <p class="OwnerText"><b>Date:</b></p>
                  <p class="OwnerText"><b>Time:</b></p>
                  <ul>
                    <li>Tag Item</li>
                    <li>Tag Item</li>
                    <li>Tag</li>
                    <li>Tag Item</li>
                    <li>Tag Item</li>
                  </ul>
                  <div class="PeopleContainer">
                    <div class="TopSection">
                      <p>Invited People</p>
                      <div class="d-flex flex-row gap-3">
                        <a href="" data-bs-toggle="modal" data-bs-target="#EventInvitedModal">
                          <img src="../assets/images/Icon7.png" alt="">
                        </a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#EventInvitedModal">
                          <img src="../assets/images/Icon6.png" alt="">
                        </a>
                      </div>
                    </div>
                    <div class="PhotoSection">
                      <img
                        src="https://images.unsplash.com/photo-1541271696563-3be2f555fc4e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/pleasant-looking-teenage-girl-wears-comfortable-hoodie-had-combed-dark-hair-looks-camera-with-little-smile_273609-38963.jpg?t=st=1731403649~exp=1731407249~hmac=963e1e2f465e3a549ade5f6d2b1a1c76cd808d814e09a26492d113f093c98df9&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/happy-ethnic-teenager-with-afro-hair-smiles-positively-wears-purple-hoodie-being-good-mood_273609-46758.jpg?t=st=1731403690~exp=1731407290~hmac=897578c7d33f1e3ec028b597051e6fd4d50f34983a8216b006cbe6470479bcc6&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/view-female-soccer-player_23-2150888397.jpg?t=st=1731403756~exp=1731407356~hmac=4056b8a1fc9e97b53ad916d89700567781e74de02d93a20828a84245bcc2b240&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/close-up-woman-portrait-new-york_23-2150868218.jpg?t=st=1731403874~exp=1731407474~hmac=4b89bc31aa4d76a4a7861e2904825b05b0c42a47cccfa13bfe5ea4be52198ecf&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/international-day-education-celebration_23-2150931022.jpg?t=st=1731403870~exp=1731407470~hmac=286b5917d5d08c0f5291a305bf2ea8abda079436000dcaa1fdb7b536cb1bbf2c&w=826"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/portrait-elegant-professional-businesswoman_23-2150917246.jpg?t=st=1731403456~exp=1731407056~hmac=709ab44fb2fe8a9c29b06e38c60ffa2dade979f272ab9821233ddfc73a4481a0&w=826"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/confident-young-businesswoman-smiling-looking-camera-indoors-generated-by-artificial-intelligence_188544-125559.jpg?t=st=1731403789~exp=1731407389~hmac=63d2f919b22ce1bc0a1ebbf081b67b0120c62ddc96a22e20802a9dcb22ec9f5d&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/female-freelancer-portrait_1409-7005.jpg?t=st=1731403923~exp=1731407523~hmac=cac4092395d9d3bed18406c8be637fd00d88f7cccb769cf62cc6ea24c68bcc3b&w=1380"
                        alt="">
                      <span class="PhotoCount">
                        <p>+5</p>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 PromotionData">
                  <p class="BodyText">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod molestias nihil vero
                    quisquam
                    assumenda. Consequuntur fuga veritatis quasi voluptates eum soluta ea quos eaque, hic possimus
                    ipsum? Dicta, quisquam natus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque iusto
                    autem rerum quibusdam pariatur saepe earum, laboriosam quam ab illo quod ad ut voluptatem.
                    Consectetur, unde. Odit, beatae? Fugiat, magni. Lorem ipsum dolor sit, amet consectetur adipisicing
                    elit. Nemo tempora delectus, officiis corrupti perspiciatis quam temporibus! Placeat, consectetur
                    possimus ab accusantium itaque numquam ea. Dicta deserunt quae blanditiis eaque fuga. Lorem ipsum
                    dolor sit amet, consectetur adipisicing elit. Voluptates perferendis illum earum tempore, voluptas,
                    facilis ullam illo sed provident tenetur quod accusantium harum, numquam nam consectetur aut
                    consequuntur sunt quaerat? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque aperiam
                    in similique quibusdam, ex veniam. Ullam, minus! Sapiente suscipit pariatur eum aspernatur
                    laudantium earum! Quaerat, molestias ullam! Dolorum, sit similique. Lorem ipsum dolor sit amet,
                    consectetur adipisicing elit. Exercitationem odio iure corporis deleniti unde quo ab atque soluta
                    quam porro commodi quae ut natus, in voluptates quia quod fugit sint.</p>
                </div>
                <div class="col-md-12 col-sm-12 PeopleContainer mt-2">
                  <div class="TopSection">
                    <p>Photos</p>
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img src="../assets/images/Icon6.png" alt="">
                    </a>
                  </div>
                  <div class="EventPhotoContainer">
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img
                        src="https://img.freepik.com/free-photo/blue-holi-color-explosion-young-woman-dancing_23-2148129343.jpg?t=st=1731406746~exp=1731410346~hmac=aac3004aa5f9db23dd6c266f0c5351a065f18d551f3da09872c50dc1851d2c1f&w=1380"
                        alt="">
                    </a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img
                        src="https://img.freepik.com/free-photo/close-up-people-dancing-yellow-explosion-holi-color_23-2148129155.jpg?t=st=1731406654~exp=1731410254~hmac=e14e090ddbf68f2d9247a7ccfa46a4342c248a318fa4268954954fcbed03faea&w=740"
                        alt="">
                    </a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img
                        src="https://img.freepik.com/free-photo/green-holi-color-powder-crowd_23-2148129312.jpg?t=st=1731406659~exp=1731410259~hmac=bbd9797f2b5a6ab957dc738298432651e61989de3a9a3dac15534dc439224e36&w=1380"
                        alt="">
                    </a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img
                        src="https://img.freepik.com/free-photo/group-people-enjoying-holi-color_23-2148129319.jpg?t=st=1731406297~exp=1731409897~hmac=acd19fe86608034c5d2c2cddd5ba441729d9c046cfd629ff77eec2bc60c8b980&w=1380"
                        alt="">
                    </a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img
                        src="https://img.freepik.com/free-photo/black-man-surrounded-by-orange-smoke_410324-20.jpg?t=st=1731406716~exp=1731410316~hmac=793484971ee67895250accc8aa03bf8873cdb16f98f451ed9751c18de6dee65d&w=740"
                        alt="">
                    </a>
                    <a href="" class="BlurrCover" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <div class="BlurrCoverData">
                        <p>+ 10</p>
                      </div>
                      <img
                        src="https://img.freepik.com/free-photo/green-blue-holi-color-powder-crowd_23-2148129315.jpg?t=st=1731407223~exp=1731410823~hmac=38dd34eb6b370798b180a31014e9d25d2e438d6d5b09c4b82e79e3d79448f403&w=1380"
                        alt="">
                    </a>
                  </div>
                </div>
              </div>-->
			  
            </div>
          </div>
        </div>
      </div>

      <!-- Details Fav Event Modal -->
      <div class="modal fade CustomModal" id="FavEventModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Event Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
              <!--<div class="row PromotionDetail">
                <div class="col-md-8 col-sm-12 PromotionImg position-relative">
                  <div class="IconContainer" data-bs-toggle="modal" data-bs-target="#EventMoreModal">
                    <a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal1">
                      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </a>
                  </div>
                  <img class="w-100"
                    src="https://img.freepik.com/free-photo/people-concert_1160-737.jpg?t=st=1730050734~exp=1730054334~hmac=4785251%E2%80%A6&w=900"
                    alt="">
                </div>
                <div class="col-md-4 col-sm-12 PromotionData">
                  <img class="OwnerImg"
                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&amp;w=1887&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="">
                  <p class="TitleText">Event Name</p>
                  <p class="OwnerText">Event Organizer Name</p>
                  <p class="OwnerText"><b>Location:</b></p>
                  <p class="OwnerText"><b>Date:</b></p>
                  <p class="OwnerText"><b>Time:</b></p>
                  <ul>
                    <li>Tag Item</li>
                    <li>Tag Item</li>
                    <li>Tag</li>
                    <li>Tag Item</li>
                    <li>Tag Item</li>
                  </ul>
                  <div class="PeopleContainer">
                    <div class="TopSection">
                      <p>Invited People</p>
                      <div class="d-flex flex-row gap-3">
                        <a href="" data-bs-toggle="modal" data-bs-target="#EventInvitePeopleModal">
                          <img src="../assets/images/Icon6.png" alt="">
                        </a>
                      </div>
                    </div>
                    <div class="PhotoSection">
                      <img
                        src="https://images.unsplash.com/photo-1541271696563-3be2f555fc4e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/pleasant-looking-teenage-girl-wears-comfortable-hoodie-had-combed-dark-hair-looks-camera-with-little-smile_273609-38963.jpg?t=st=1731403649~exp=1731407249~hmac=963e1e2f465e3a549ade5f6d2b1a1c76cd808d814e09a26492d113f093c98df9&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/happy-ethnic-teenager-with-afro-hair-smiles-positively-wears-purple-hoodie-being-good-mood_273609-46758.jpg?t=st=1731403690~exp=1731407290~hmac=897578c7d33f1e3ec028b597051e6fd4d50f34983a8216b006cbe6470479bcc6&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/view-female-soccer-player_23-2150888397.jpg?t=st=1731403756~exp=1731407356~hmac=4056b8a1fc9e97b53ad916d89700567781e74de02d93a20828a84245bcc2b240&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/close-up-woman-portrait-new-york_23-2150868218.jpg?t=st=1731403874~exp=1731407474~hmac=4b89bc31aa4d76a4a7861e2904825b05b0c42a47cccfa13bfe5ea4be52198ecf&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/international-day-education-celebration_23-2150931022.jpg?t=st=1731403870~exp=1731407470~hmac=286b5917d5d08c0f5291a305bf2ea8abda079436000dcaa1fdb7b536cb1bbf2c&w=826"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/portrait-elegant-professional-businesswoman_23-2150917246.jpg?t=st=1731403456~exp=1731407056~hmac=709ab44fb2fe8a9c29b06e38c60ffa2dade979f272ab9821233ddfc73a4481a0&w=826"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/confident-young-businesswoman-smiling-looking-camera-indoors-generated-by-artificial-intelligence_188544-125559.jpg?t=st=1731403789~exp=1731407389~hmac=63d2f919b22ce1bc0a1ebbf081b67b0120c62ddc96a22e20802a9dcb22ec9f5d&w=1380"
                        alt="">
                      <img class="position-absolute z-1"
                        src="https://img.freepik.com/free-photo/female-freelancer-portrait_1409-7005.jpg?t=st=1731403923~exp=1731407523~hmac=cac4092395d9d3bed18406c8be637fd00d88f7cccb769cf62cc6ea24c68bcc3b&w=1380"
                        alt="">
                      <span class="PhotoCount">
                        <p>+5</p>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 PromotionData">
                  <p class="BodyText">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod molestias nihil vero
                    quisquam
                    assumenda. Consequuntur fuga veritatis quasi voluptates eum soluta ea quos eaque, hic possimus
                    ipsum? Dicta, quisquam natus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque iusto
                    autem rerum quibusdam pariatur saepe earum, laboriosam quam ab illo quod ad ut voluptatem.
                    Consectetur, unde. Odit, beatae? Fugiat, magni. Lorem ipsum dolor sit, amet consectetur adipisicing
                    elit. Nemo tempora delectus, officiis corrupti perspiciatis quam temporibus! Placeat, consectetur
                    possimus ab accusantium itaque numquam ea. Dicta deserunt quae blanditiis eaque fuga. Lorem ipsum
                    dolor sit amet, consectetur adipisicing elit. Voluptates perferendis illum earum tempore, voluptas,
                    facilis ullam illo sed provident tenetur quod accusantium harum, numquam nam consectetur aut
                    consequuntur sunt quaerat? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque aperiam
                    in similique quibusdam, ex veniam. Ullam, minus! Sapiente suscipit pariatur eum aspernatur
                    laudantium earum! Quaerat, molestias ullam! Dolorum, sit similique. Lorem ipsum dolor sit amet,
                    consectetur adipisicing elit. Exercitationem odio iure corporis deleniti unde quo ab atque soluta
                    quam porro commodi quae ut natus, in voluptates quia quod fugit sint.</p>
                </div>
                <div class="col-md-12 col-sm-12 PeopleContainer mt-2">
                  <div class="TopSection">
                    <p>Photos</p>
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img src="../assets/images/Icon6.png" alt="">
                    </a>
                  </div>
                  <div class="EventPhotoContainer">
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img
                        src="https://img.freepik.com/free-photo/blue-holi-color-explosion-young-woman-dancing_23-2148129343.jpg?t=st=1731406746~exp=1731410346~hmac=aac3004aa5f9db23dd6c266f0c5351a065f18d551f3da09872c50dc1851d2c1f&w=1380"
                        alt="">
                    </a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img
                        src="https://img.freepik.com/free-photo/close-up-people-dancing-yellow-explosion-holi-color_23-2148129155.jpg?t=st=1731406654~exp=1731410254~hmac=e14e090ddbf68f2d9247a7ccfa46a4342c248a318fa4268954954fcbed03faea&w=740"
                        alt="">
                    </a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img
                        src="https://img.freepik.com/free-photo/green-holi-color-powder-crowd_23-2148129312.jpg?t=st=1731406659~exp=1731410259~hmac=bbd9797f2b5a6ab957dc738298432651e61989de3a9a3dac15534dc439224e36&w=1380"
                        alt="">
                    </a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img
                        src="https://img.freepik.com/free-photo/group-people-enjoying-holi-color_23-2148129319.jpg?t=st=1731406297~exp=1731409897~hmac=acd19fe86608034c5d2c2cddd5ba441729d9c046cfd629ff77eec2bc60c8b980&w=1380"
                        alt="">
                    </a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <img
                        src="https://img.freepik.com/free-photo/black-man-surrounded-by-orange-smoke_410324-20.jpg?t=st=1731406716~exp=1731410316~hmac=793484971ee67895250accc8aa03bf8873cdb16f98f451ed9751c18de6dee65d&w=740"
                        alt="">
                    </a>
                    <a href="" class="BlurrCover" data-bs-toggle="modal" data-bs-target="#EventPhotosModal">
                      <div class="BlurrCoverData">
                        <p>+ 10</p>
                      </div>
                      <img
                        src="https://img.freepik.com/free-photo/green-blue-holi-color-powder-crowd_23-2148129315.jpg?t=st=1731407223~exp=1731410823~hmac=38dd34eb6b370798b180a31014e9d25d2e438d6d5b09c4b82e79e3d79448f403&w=1380"
                        alt="">
                    </a>
                  </div>
                </div>
              </div>-->
			  
            </div>
          </div>
        </div>
      </div>

      <!-- Event More Modal -->
      <div class="modal fade CustomModal" id="EventMoreModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Event Option</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body AppearanceData">
              <form class="row g-3">
                <div class="col-md-12 col-sm-12 BtnContainer flex-row">
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="../assets/images/Icon21.png" alt="">
                    </span>
                    <p>Request to join the event</p>
                  </button>
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="../assets/images/Icon22.png" alt="">
                    </span>
                    <p>Show Interest</p>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Event Photos Modal -->
      <div class="modal fade CustomModal" id="EventPhotosModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Photos</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="events-gallery-model">
			
              
			  
			  
            </div>
          </div>
        </div>
      </div>
	  

      <!-- Event Invited Modal -->
      <div class="modal fade CustomModal" id="EventInvitedModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Invitations</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row m-0 InvitedPeopleTab">
                <div class="col-md-12 col-sm-12">
                  <!-- Tabs Navigation -->
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="All-Tab" data-bs-toggle="tab" data-bs-target="#AllTab"
                        type="button" role="tab" aria-controls="AllTab" aria-selected="true">All</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="InvitedPeople-Tab" data-bs-toggle="tab"
                        data-bs-target="#InvitedPeopleTab" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Invited People</button>
                    </li>
                  </ul>

                  

                  <!-- Tabs Content -->
                    <div class="tab-content" >
					<input class="form-control mt-4 mb-4 SearchBarInner" type="search" placeholder="Search" aria-label="Search" id="searchInvitee" >
				        <div id="myTabContent"></div>
				    
					
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Event Invite People Modal -->
      <div class="modal fade CustomModal" id="EventInvitePeopleModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Invitations</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input class="form-control mb-4 SearchBarInner" type="search" placeholder="Search" aria-label="Search">

              <div class="row m-0 InvitedContain">
                <div class="col-lg-4 col-md-4 ps-0 mb-4">
                  <div class="InvitedContainBlock">
                    <div class="Data">
                      <img
                        src="https://img.freepik.com/free-photo/lifestyle-people-emotions-casual-concept-confident-nice-smiling-asian-woman-cross-arms-chest-confident-ready-help-listening-coworkers-taking-part-conversation_1258-59335.jpg?t=st=1732007716~exp=1732011316~hmac=527a23b0f4c953638aee7ed04c9d6e999ac4850c1076314be0e59f980fb455ed&w=1380"
                        alt="">
                      <p>User Name</p>
                    </div>
                    <a href="">
                      Invited
                    </a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                  <div class="InvitedContainBlock">
                    <div class="Data">
                      <img
                        src="https://img.freepik.com/free-photo/lifestyle-people-emotions-casual-concept-confident-nice-smiling-asian-woman-cross-arms-chest-confident-ready-help-listening-coworkers-taking-part-conversation_1258-59335.jpg?t=st=1732007716~exp=1732011316~hmac=527a23b0f4c953638aee7ed04c9d6e999ac4850c1076314be0e59f980fb455ed&w=1380"
                        alt="">
                      <p>User Name</p>
                    </div>
                    <a href="">
                      Invited
                    </a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 pe-0 mb-4">
                  <div class="InvitedContainBlock">
                    <div class="Data">
                      <img
                        src="https://img.freepik.com/free-photo/lifestyle-people-emotions-casual-concept-confident-nice-smiling-asian-woman-cross-arms-chest-confident-ready-help-listening-coworkers-taking-part-conversation_1258-59335.jpg?t=st=1732007716~exp=1732011316~hmac=527a23b0f4c953638aee7ed04c9d6e999ac4850c1076314be0e59f980fb455ed&w=1380"
                        alt="">
                      <p>User Name</p>
                    </div>
                    <a href="">
                      Invited
                    </a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 ps-0">
                  <div class="InvitedContainBlock">
                    <div class="Data">
                      <img
                        src="https://img.freepik.com/free-photo/lifestyle-people-emotions-casual-concept-confident-nice-smiling-asian-woman-cross-arms-chest-confident-ready-help-listening-coworkers-taking-part-conversation_1258-59335.jpg?t=st=1732007716~exp=1732011316~hmac=527a23b0f4c953638aee7ed04c9d6e999ac4850c1076314be0e59f980fb455ed&w=1380"
                        alt="">
                      <p>User Name</p>
                    </div>
                    <a href="">
                      Invited
                    </a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="InvitedContainBlock">
                    <div class="Data">
                      <img
                        src="https://img.freepik.com/free-photo/lifestyle-people-emotions-casual-concept-confident-nice-smiling-asian-woman-cross-arms-chest-confident-ready-help-listening-coworkers-taking-part-conversation_1258-59335.jpg?t=st=1732007716~exp=1732011316~hmac=527a23b0f4c953638aee7ed04c9d6e999ac4850c1076314be0e59f980fb455ed&w=1380"
                        alt="">
                      <p>User Name</p>
                    </div>
                    <a href="">
                      Invited
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row m-0 TabBar">
        <div class="Pagination">
          <a href="" id="Home"><i class="fa fa-angle-left" aria-hidden="true"></i> Home / Event Management</a>
        </div>
        
		<?php if(@$eventMng->read_access == 1 || @$eventMng->write_access == 1 || @$eventMng->full_access == 1){ ?>
			<div class="TabContainer">
				<div class="Tab active" onclick="openTab(event, 'AllEvents')">All Events</div>
				<div class="Tab" onclick="openTab(event, 'MyEvents')">My Events</div>
				<div class="Tab" onclick="openTab(event, 'FavoriteEvents')">Favorite Events</div>
			</div>
		<?php } ?>
		
      </div>
      <?php if(@$eventMng->read_access == 1 || @$eventMng->write_access == 1 || @$eventMng->full_access == 1){ ?>
		  <div id="AllEvents" class="row m-0 TabContent active">
			<?php
			if(@$eventList){
				foreach(@$eventList as $k => $v){
					
				$category = DB::table('event_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
				$image    = DB::table('event_image')->where(['event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
				
				if(@$v->user_id == 0){
					$userName = 'Admin';
					$userProfile = url('profile/unnamed.jpg');
				}else{
					$checkUser = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
					if($checkUser){
						$userName = $checkUser->first_name.' '.$checkUser->last_name;
					}else{
						$userName = '';
					}
					
					if(!empty($checkUser->profile_image) && file_exists('public/profile/'.$checkUser->profile_image.'')){
						$userProfile = url('profile/'.$checkUser->profile_image.'');
					}else{
						$userProfile = url('profile/unnamed.jpg');
					}
				}
				if(!empty($image->image) && file_exists('public/events/'.$image->image.'')){
					$galleryImg = url('events/'.$image->image.'');
				}else{
					$galleryImg = url('noimage.jpg');
				}
				
				$startDate  = $v->start_date;
				$start_date = date('Y-m-d', strtotime($startDate));
				$start_time = date('H:i:s', strtotime($startDate));
				
				$numRows = DB::table('favouriteevent')->where(['user_id' => session()->get('USERLOGINID'), 'event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->count();
				
				if($numRows > 0){
					$fav = '<i class="fa fa-heart" aria-hidden="true"></i>';
				}else{
					$fav = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
				}

                
				if(@$eventMng->write_access == 1 || @$eventMng->full_access == 1){		
					$edit = '<a href="javascript::void(0);" class="edit-event-detail" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#EditEventModal">
						<i class="fa fa-pencil-square" aria-hidden="true"></i>
					</a>';
				}else{
					$edit = '';
				}
				
				if(@$eventMng->full_access == 1){	
					$delete = '<a href="javascript::void(0);" onclick="deleteEvent('. @$v->id .')" data-bs-toggle="modal" data-bs-target="#DeleteEventModal-1">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</a>';
			    }else{
					$delete = '';
				}
			
				echo '
				<div class="Card col-lg-3 col-md-3 col-sm-6">
				  <div class="CardInner event-detail-1"   style="background:url('.@$galleryImg.') no-repeat center center / cover;" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#DetailsMyEventModal" block="one">
					<div class="Cover"></div>
					<img class="UserImage"
					  src="'.@$userProfile.'"
					  alt="">
					<p class="Heading">'.@$v->event_name.'</p>
					<p class="SubHeading">'.@$userName.'</p>
					<p class="SubHeading">Location: '.substr(@$v->location,0,20).'</p>
					<p class="SubHeading">Date: '.@$start_date.'</p>
					<p class="SubHeading">Time: '.@$start_time.'</p>
					<div class="IconContainer">
						<a href="javascript:void(0);" class="bookmarkEvent" id="bookmarkEvent_'.@$v->id.'" relid="'.@$v->id.'">
						    '.@$fav.'
						</a>
						
					</div>
				  </div>
				</div>';
			
					
				}
			}else{
				echo 'Not found any event list.';
			}
			?>
		  </div>
	  <?php } ?>
	  
	  
	  <div id="MyEvents" class="row m-0 TabContent">
			<?php
			if(@$myeventList){
				foreach(@$myeventList as $k => $v){
					
				$category = DB::table('event_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
				$image    = DB::table('event_image')->where(['event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
				
				if(@$v->user_id == 0){
					$userName = 'Admin';
					$userProfile = url('profile/unnamed.jpg');
				}else{
					$checkUser = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
					if($checkUser){
						$userName = $checkUser->first_name.' '.$checkUser->last_name;
					}else{
						$userName = '';
					}
					
					if(!empty($checkUser->profile_image) && file_exists('public/profile/'.$checkUser->profile_image.'')){
						$userProfile = url('profile/'.$checkUser->profile_image.'');
					}else{
						$userProfile = url('profile/unnamed.jpg');
					}
				}
				if(!empty($image->image) && file_exists('public/events/'.$image->image.'')){
					$galleryImg = url('events/'.$image->image.'');
				}else{
					$galleryImg = url('noimage.jpg');
				}
				
				$startDate  = $v->start_date;
				$start_date = date('Y-m-d', strtotime($startDate));
				$start_time = date('H:i:s', strtotime($startDate));
				
				$numRows = DB::table('favouriteevent')->where(['user_id' => session()->get('USERLOGINID'), 'event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->count();
				
				if($numRows > 0){
					$fav = '<i class="fa fa-heart" aria-hidden="true"></i>';
				}else{
					$fav = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
				}

                
				if(@$eventMng->write_access == 1 || @$eventMng->full_access == 1){		
					$edit = '<a href="javascript::void(0);" class="edit-event-detail" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#EditEventModal">
						<i class="fa fa-pencil-square" aria-hidden="true"></i>
					</a>';
				}else{
					$edit = '';
				}
				
				if(@$eventMng->full_access == 1){	
					$delete = '<a href="javascript::void(0);" onclick="deleteEvent('. @$v->id .')" data-bs-toggle="modal" data-bs-target="#DeleteEventModal-1">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</a>';
			    }else{
					$delete = '';
				}
			
				echo '
				<div class="Card col-lg-3 col-md-3 col-sm-6">
				  <div class="CardInner event-detail-1"   style="background:url('.@$galleryImg.') no-repeat center center / cover;" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#DetailsMyEventModal">
					<div class="Cover"></div>
					<img class="UserImage"
					  src="'.@$userProfile.'"
					  alt="">
					<p class="Heading">'.@$v->event_name.'</p>
					<p class="SubHeading">'.@$userName.'</p>
					<p class="SubHeading">Location: '.substr(@$v->location,0,20).'</p>
					<p class="SubHeading">Date: '.@$start_date.'</p>
					<p class="SubHeading">Time: '.@$start_time.'</p>
					<div class="IconContainer">
						<a href="javascript:void(0);" class="bookmarkEvent" id="bookmarkEvent_'.@$v->id.'" relid="'.@$v->id.'">
						    '.@$fav.'
						</a>
						'.$edit.'
						'.$delete.'
					</div>
				  </div>
				</div>';
			
					
				}
			}else{
				echo 'Not found any event list.';
			}
			?>
		  </div>
	  

      <div id="FavoriteEvents" class="row m-0 TabContent">
	  
        <?php
		if(@$eventList){
			foreach(@$eventList as $k => $v){
				
			$category = DB::table('event_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
			$image    = DB::table('event_image')->where(['event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
			
			if(@$v->user_id == 0){
				$userName = 'Admin';
				$userProfile = url('profile/unnamed.jpg');
			}else{
			    $checkUser = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
				if($checkUser){
					$userName = $checkUser->first_name.' '.$checkUser->last_name;
				}else{
					$userName = '';
				}
				
				if(!empty($checkUser->profile_image) && file_exists('public/profile/'.$checkUser->profile_image.'')){
					$userProfile = url('profile/'.$checkUser->profile_image.'');
				}else{
					$userProfile = url('profile/unnamed.jpg');
				}
			}
			if(!empty($image->image) && file_exists('public/events/'.$image->image.'')){
				$galleryImg = url('events/'.$image->image.'');
			}else{
				$galleryImg = url('noimage.jpg');
			}
			
			$startDate  = $v->start_date;
			$start_date = date('Y-m-d', strtotime($startDate));
			$start_time = date('H:i:s', strtotime($startDate));
			
			$numRows = DB::table('favouriteevent')->where(['user_id' => session()->get('USERLOGINID'), 'event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->count();
			
			if($numRows > 0){
				$fav = '<i class="fa fa-heart" aria-hidden="true"></i>';
				
				
				echo '
			<div class="Card col-lg-3 col-md-3 col-sm-6">
			  <div class="CardInner event-detail-1"   style="background:url('.@$galleryImg.') no-repeat center center / cover;" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#DetailsMyEventModal" block="one">
				<div class="Cover"></div>
				<img class="UserImage"
				  src="'.@$userProfile.'"
				  alt="">
				<p class="Heading">'.@$v->event_name.'</p>
				<p class="SubHeading">'.@$userName.'</p>
				<p class="SubHeading">Location: '.substr(@$v->location,0,20).'</p>
				<p class="SubHeading">Date: '.@$start_date.'</p>
				<p class="SubHeading">Time: '.@$start_time.'</p>
				<div class="IconContainer">
					<a href="javascript:void(0);" class="bookmarkEvent" id="allbookmarkEvent_'.@$v->id.'" relid="'.@$v->id.'">
					    '.@$fav.'
					</a>
					
					<!--<a href="javascript::void(0);" class="edit-event-detail" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#EditEventModal">
					    <i class="fa fa-pencil-square" aria-hidden="true"></i>
					</a>
					
					<a href="javascript::void(0);" onclick="deleteEvent('. @$v->id .')" data-bs-toggle="modal" data-bs-target="#DeleteEventModal-1">
					    <i class="fa fa-trash" aria-hidden="true"></i>
					</a>-->
				</div>
			  </div>
			</div>';
				
			}else{
				//$fav = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
				
			}
        		
			}
		}else{
			echo 'Not found any event list.';
		}
		
		?>
		
		
      </div>
	  
	  

    </div>
	
    <div class="container-fluid m-0 Section Business" style="display: none;">
	
	<!-- Service Details Modal -->
      <div class="modal fade CustomModal" id="ServiceDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Service Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="service-details-block">
              
            </div>
          </div>
        </div>
      </div>
	
	 <!-- My Product Details Modal -->
      <div class="modal fade CustomModal" id="ProductDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Product Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="product-details-block">
			
              
			  
            </div>
          </div>
        </div>
      </div>
	
	<!-- Add Business Modal -->
      <div class="modal fade CustomModal" id="chooseModel" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Product / Service</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
              <form class="row g-3 AddProductData">
                <div class="col-lg-12 col-md-12 ProductService"
                  style="border-bottom: 1.5px solid #ddd; border-style: dashed; border-top: 0; border-left: 0; border-right: 0;">
                  <div class="DataBlock">
                    <img src="<?=url('assets/home/images/Icon23.png')?>" alt="">
                    <p class="m-0">Here, include your products</p>
                  </div>

                  <!-- Product Container -->
                  <div class="ProductContainer d-none">
                    <div class="ProductBlock">
                      <a href="" class="RemoveIcon">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                      <img src="<?=url('assets/home/images/ImageBack1.jpg')?>" alt="">
                      <div class="ProductTextBlock">
                        <p class="m-0 Heading">Product Name</p>
                        <p class="m-0 Price">Price</p>
                      </div>
                    </div>
                  </div>

                  <a class="AddAProduct">
                    <p class="m-0">Add Product</p>
                  </a>
                </div>

                <div class="col-lg-12 col-md-12 ProductService">
                  <div class="DataBlock">
                    <img src="<?=url('assets/home/images/Icon24.png')?>" alt="">
                    <p class="m-0">Here, include your services</p>
                  </div>

                  <!-- Service Container -->
                  <div class="ProductContainer d-none">
                    <div class="ProductBlock">
                      <a href="" class="RemoveIcon">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                      <img src="<?=url('assets/home/images/ImageBack2.jpg')?>" alt="">
                      <div class="ProductTextBlock">
                        <p class="m-0 Heading">Service Name</p>
                        <p class="m-0 Price">Price</p>
                      </div>
                    </div>
                  </div>

                  <a class="AddAService">
                    <p class="m-0">Add Service</p>
                  </a>
                </div>
              </form>
			  
            </div>
          </div>
        </div>
      </div>
	  
	  
	  
	  <!-- Add Product Modal -->
    <div class="modal fade CustomModal" id="AddProductModel" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Product </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
				<form class="row g-3 AddProduct" id="addProductForm" method="post" enctype="multipart/form-data">
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Choose Category *</label>
						<select name="product_category" id="product_category" required>
							<option disabled value="">Choose a category</option>
						</select>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Product Name *</label>
						<input type="text" placeholder="Enter product name" name="product_name" id="product_name" required>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Price *</label>
						<input type="text" placeholder="Enter price" name="product_price" id="product_price" required>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Tags *</label>
						<input type="text" placeholder="#Tags" name="product_tags" id="product_tags">
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Upload Images</label>
						<input type="file" class="form-control" id="product_image" name="product_image"  multiple>
						<input type="hidden" class="form-control" id="listing_id" name="listing_id" >
					</div>
					
					<div class="col-md-12 col-sm-12">
						<label class="form-label">Description</label>
						<textarea type="text" placeholder="Description" name="product_description" id="product_description"></textarea>
					</div>
					
					<div class="modal-footer">
					    <button type="submit" class="btn btn-primary">Save</button>
					</div>
					
				</form>
            </div>
          </div>
        </div>
    </div>
	
	
	
	 <!-- Add Service Modal -->
    <div class="modal fade CustomModal" id="AddServiceModel" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Service </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			
            <div class="modal-body">
			
				<form class="row g-3 AddService" id="addServiceForm" method="post" enctype="multipart/form-data">
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Choose Category *</label>
						<select name="service_category" id="service_category" required>
							<option disabled value="">Choose a category</option>
							
						</select>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Service Name *</label>
						<input type="text" placeholder="Enter service name" name="service_name" id="service_name" required>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Price *</label>
						<input type="text" placeholder="Enter price" name="service_price" id="service_price" required>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Tags *</label>
						<input type="text" placeholder="#Tags" name="service_tags" id="service_tags">
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Upload Images</label>
						<input type="file" class="form-control" name="service_image" id="service_image" multiple>
						<input type="hidden" class="form-control" id="service_listing_id" name="service_listing_id" >
					</div>
					
					<div class="col-md-12 col-sm-12">
						<label class="form-label">Description</label>
						<textarea type="text" placeholder="Description" name="service_description" id="service_description"></textarea>
					</div>
					
					<div class="modal-footer">
					    <button type="submit" class="btn btn-primary">Save</button>
					</div>
					
				</form>
            </div>
          </div>
        </div>
    </div>
	
     <div class="modal fade CustomModal" id="EditProductModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Product </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
				<form class="row g-3 AddProduct" id="editProductForm" method="post" enctype="multipart/form-data">
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Choose Category *</label>
						<select name="edit_product_category" id="edit_product_category" required>
							<option disabled value="">Choose a category</option>
							<?php
								if(@$product_category){
									foreach(@$product_category as $k => $v){
										echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
									}
								}
							?>
						</select>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Product Name *</label>
						<input type="text" placeholder="Enter product name" name="edit_product_name" id="edit_product_name" required>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Price *</label>
						<input type="text" placeholder="Enter price" name="edit_product_price" id="edit_product_price" required>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Tags *</label>
						<input type="text" placeholder="#Tags" name="edit_product_tags" id="edit_product_tags">
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Upload Images</label>
						<input type="file" class="form-control" id="edit_product_image" name="edit_product_image"  multiple>
						<input type="hidden" class="form-control" id="edit_service_listing_id" name="edit_service_listing_id" >
						<input type="hidden" class="form-control" id="edit_product_id" name="edit_product_id" >
					</div>
					
					<div class="col-md-12 col-sm-12">
						<label class="form-label">Description</label>
						<textarea type="text" placeholder="Description" name="edit_product_description" id="edit_product_description"></textarea>
					</div>
					
					<div class="modal-footer">
					    <button type="submit" class="btn btn-primary">Save</button>
					</div>
					
				</form>
            </div>
          </div>
        </div>
    </div>	
	  
	  
	   <!-- Add Service Modal -->
    <div class="modal fade CustomModal" id="editServiceModel" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Service </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			
            <div class="modal-body">
			
				<form class="row g-3 AddService" id="editServiceForm" method="post" enctype="multipart/form-data">
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Choose Category *</label>
						<select name="edit_service_category" id="edit_service_category" required>
							<option disabled value="">Choose a category</option>
							
							<?php
								if(@$product_category){
									foreach(@$product_category as $k => $v){
										echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
									}
								}
							?>
						</select>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Service Name *</label>
						<input type="text" placeholder="Enter service name" name="edit_service_name" id="edit_service_name" required>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Price *</label>
						<input type="text" placeholder="Enter price" name="edit_service_price" id="edit_service_price" required>
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Tags *</label>
						<input type="text" placeholder="#Tags" name="edit_service_tags" id="edit_service_tags">
					</div>
					
					<div class="col-md-4 col-sm-12">
						<label class="form-label">Upload Images</label>
						<input type="file" class="form-control" name="edit_service_image" id="edit_service_image" multiple>
						<input type="hidden" class="form-control" id="edit_service_listing_id" name="edit_service_listing_id" >
						<input type="hidden" class="form-control" id="edit_service_id" name="edit_service_id" >
					</div>
					
					<div class="col-md-12 col-sm-12">
						<label class="form-label">Description</label>
						<textarea type="text" placeholder="Description" name="edit_service_description" id="edit_service_description"></textarea>
					</div>
					
					<div class="modal-footer">
					    <button type="submit" class="btn btn-primary">Save</button>
					</div>
					
				</form>
            </div>
          </div>
        </div>
    </div>
	  
	  
	  
	  
	  
	  
<!-- Add Category Modal -->
      <div class="modal fade CustomModal" id="AddCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
               <form class="row g-3 AddCategoryData" id="Addcat" method="post" enctype="multipart/form-data">
                <div class="col-md-4 col-sm-12">
                  <div class="col-md-12 col-sm-12">
                    <label class="form-label">Category</label>
                    <input type="text" placeholder="Enter category name" name="cat_name" id="cat_name">
                  </div>
                  <!--<div class="col-md-12 col-sm-12 mt-3">
                    <a href="" class="AddBtn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                      <p class="m-0">Add Category</p>
                    </a>
                  </div>-->
                </div>

                <div class="col-md-8 col-sm-12">
                  <div class="row m-0">
                    <label class="form-label">Category Name List</label>
					
					<div id="append-category"></div>
                    <!--<div class="col-md-6 col-sm-12 position-relative">
                      <p class="CategoryNameList">Category Name</p>
                      <a href="" class="CategoryDeleteBtn">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                    </div>-->
					
                    <!--<div class="col-md-6 col-sm-12 position-relative">
                      <p class="CategoryNameList">Category Name</p>
                      <a href="" class="CategoryDeleteBtn">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                    </div>
					
                    <div class="col-md-6 col-sm-12 position-relative">
                      <p class="CategoryNameList">Category Name</p>
                      <a href="" class="CategoryDeleteBtn">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                    </div>-->
					
                  </div>
                </div>
				
				<div class="modal-footer">
				  <button type="submit" class="btn btn-primary">Save & Continue</button>
				  <button type="button" class="btn btn-primary" id="skipAddCat">Skip</button>
				</div>
              </form>
			  
            </div>
			
			
            <!--<div class="modal-footer">
              <button type="button" class="btn btn-primary">Submit</button>
            </div>-->
          </div>
        </div>
      </div>
	  
	<!-- Edit Event Modal -->
      <div class="modal fade CustomModal" id="EditBusinessModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Business</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
              <form class="row g-3" id="EditBusinesssubmitform" method="post" enctype="multipart/form-data">
			  
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Business Name *</label>
                  <input type="text" placeholder="Enter business name" name="edit_business_name" id="edit_business_name" required>
                </div>
				
				<div class="col-md-4 col-sm-12">
                  <label class="form-label">Name *</label>
                  <input type="text" placeholder="Enter name" name="edit_name" id="edit_name" required>
                </div>
				
				<div class="col-md-4 col-sm-12">
					<label class="form-label">Category *</label>
					<select  name="edit_business_category" id="edit_business_category" required>
					<option disabled value="">Choose a Category</option>
					<?php
					if(@$listing_category){
						foreach(@$listing_category as $k => $v){
						    echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
						}
					}
					?>
					</select>
                </div>
				
                <div class="col-md-6 col-sm-12">
                  <label class="form-label">Location *</label>
                  <input type="text" placeholder="Enter location" name="edit_business_address" id="edit_business_address" required>
					<input type="hidden" placeholder="Near"  name="edit_business_latitude" id="edit_business_latitude" >
					<input type="hidden" placeholder="Near" name="edit_business_longitude" id="edit_business_longitude" >
					<input type="hidden" placeholder="Near" name="edit_business_country" id="edit_business_country" >
					<input type="hidden" placeholder="Near" name="edit_business_state" id="edit_business_state" >
					<input type="hidden" placeholder="Near" name="edit_business_city" id="edit_business_city" >
					<input type="hidden" placeholder="Near" name="edit_business_zipcode" id="edit_business_zipcode" >
                </div>
                
                <div class="col-md-6 col-sm-12">
                  <label class="form-label">Tags </label>
                  <input type="text" placeholder="Ex: #SmallBusiness, #ShopSmall" name="edit_business_tags" id="edit_business_tags">
                </div>
				
               
				
                <div class="col-md-12 col-sm-12">
                  <label class="form-label">Description</label>
                  <textarea type="text" placeholder="Description" name="edit_business_description" id="edit_business_description"></textarea>
                </div>
				
                
				
                <div class="row m-0 pt-4 pb-2">
                  <div class="row m-0 InnerData g-3">
                    <p class="Heading">Business Information</p>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Phone *</label>
                      <input type="text" placeholder="Enter phone number" name="edit_business_phone" id="edit_business_phone" required>
                      
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Email *</label>
                      <input type="email" placeholder="Enter email address" name="edit_business_email" id="edit_business_email" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Website</label>
                      <input type="text" placeholder="Enter website URL" name="edit_business_website" id="edit_business_website">
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Upload Images</label>
                      <input type="file" class="form-control" id="edit_business_image" name="edit_business_image" autocomplete="off" multiple >
					  <input type="hidden" name="edit_business_id" id="edit_business_id" required>
                    </div>
                  </div>
                </div>
				
				<div class="modal-footer">
				  <button type="submit" class="btn btn-primary">Submit</button>
				</div>
              </form>
			  
            </div>
            <!--<div class="modal-footer">
              <button type="button" class="btn btn-primary">Submit</button>
            </div>-->
          </div>
        </div>
      </div>
	  
	  <?php if(@$businessMng->write_access == 1 || @$businessMng->full_access == 1){ ?>
		  <!-- Add Business Button -->
		    <button type="button" class="AddButton" data-bs-toggle="modal" data-bs-target="#AddBusinessModal">
				<i class="fa fa-plus" aria-hidden="true"></i>
				<p>Add Business</p>
		    </button>
	  <?php } ?>

      <!-- Add Business Modal -->
      <div class="modal fade CustomModal" id="AddBusinessModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Business</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
			
              <form class="row g-3" id="Businesssubmitform" method="post" enctype="multipart/form-data">
			  
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Business Name *</label>
                  <input type="text" placeholder="Enter business name" name="business_name" id="business_name" required>
                </div>
				
				<div class="col-md-4 col-sm-12">
                  <label class="form-label">Name *</label>
                  <input type="text" placeholder="Enter name" name="name" id="name" required>
                </div>
				
				<div class="col-md-4 col-sm-12">
					<label class="form-label">Category *</label>
					<select  name="business_category" id="business_category" required>
					<option disabled value="">Choose a Category</option>
					<?php
					if(@$listing_category){
						foreach(@$listing_category as $k => $v){
						    echo '<option value="'.@$v->id.'">'.@$v->name.'</option>';
						}
					}
					?>
					</select>
                </div>
				
                <div class="col-md-6 col-sm-12">
                  <label class="form-label">Location *</label>
                  <input type="text" placeholder="Enter location" name="business_address" id="business_address" required>
					<input type="hidden" placeholder="Near"  name="business_latitude" id="business_latitude" >
					<input type="hidden" placeholder="Near" name="business_longitude" id="business_longitude" >
					<input type="hidden" placeholder="Near" name="business_country" id="business_country" >
					<input type="hidden" placeholder="Near" name="business_state" id="business_state" >
					<input type="hidden" placeholder="Near" name="business_city" id="business_city" >
					<input type="hidden" placeholder="Near" name="business_zipcode" id="business_zipcode" >
					<input type="hidden" placeholder="Near" name="business_userId" id="business_userId" value="<?=session()->get('USERLOGINID')?>">
                </div>
                
                <div class="col-md-6 col-sm-12">
                  <label class="form-label">Tags </label>
                  <input type="text" placeholder="Ex: #SmallBusiness, #ShopSmall" name="business_tags" id="business_tags">
                </div>
				
               
				
                <div class="col-md-12 col-sm-12">
                  <label class="form-label">Description</label>
                  <textarea type="text" placeholder="Description" name="business_description" id="business_description"></textarea>
                </div>
				
                
				
                <div class="row m-0 pt-4 pb-2">
                  <div class="row m-0 InnerData g-3">
                    <p class="Heading">Business Information</p>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Phone *</label>
                      <input type="text" placeholder="Enter phone number" name="business_phone" id="business_phone" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Email *</label>
                      <input type="email" placeholder="Enter email address" name="business_email" id="business_email" required>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Website</label>
                      <input type="text" placeholder="Enter website URL" name="business_website" id="business_website">
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <label class="form-label">Upload Images</label>
                      <input type="file" class="form-control" id="business_image" name="business_image" autocomplete="off" multiple >
                    </div>
                  </div>
                </div>
				
				<div class="modal-footer">
				    <div class="BusinessAddFooter" style="display: flex;">
						<div class="AddProduct">
						  <input type="checkbox" style="width:3%;" name="add_product_or_not" id="add_product_or_not">
						  <p>Would you be interested in adding any products or services?</p>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
				    </div>
				</div>
              </form>
			  
            </div>
			
			
            <!--<div class="modal-footer">
              <button type="button" class="btn btn-primary">Submit</button>
            </div>-->
          </div>
        </div>
      </div>
	  
		<div class="row m-0 TabBar" id="business-block">
			<div class="Pagination">
			  <a href="" id="Home"><i class="fa fa-angle-left" aria-hidden="true"></i> Home / Business Management</a>
			</div>
            <?php if(@$businessMng->read_access == 1 || @$businessMng->write_access == 1 || @$businessMng->full_access == 1){ ?>
				<div class="TabContainer">
				    <div class="Tab active" onclick="openTab(event, 'MyAllBusiness')">All Business</div>
				    <div class="Tab" onclick="openTab(event, 'AllBusiness')">My Business</div>
				    <div class="Tab" onclick="openTab(event, 'MyBusiness')">Favorite Business</div>
				</div>
			<?php } ?>
			
		</div>
		
		
		<!-- Details My Business Modal -->
      <div class="modal fade CustomModal" id="DetailsMyBusinessModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Business Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body business-block-detail" id="">
			
			
			
             
			  
            </div>
          </div>
        </div>
      </div>
	  
	  
	  <!-- Event Business Modal -->
      <div class="modal fade CustomModal" id="BusinessPhotosModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Photos</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="business-gallery-model">
			
              
			  
			  
            </div> 
          </div>
        </div>
      </div>
	  
	  <!-- Product images Modal -->
      <div class="modal fade CustomModal" id="ProductPhotosModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Photos</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="product-gallery-model">
			
              
			  
			  
            </div> 
          </div>
        </div>
      </div>
	  
	  <!-- Service images Modal -->
      <div class="modal fade CustomModal" id="ServicePhotosModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Photos</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="service-gallery-model">
			
              
			  
			  
            </div> 
          </div>
        </div>
      </div>
		  
		  
		<?php if(@$businessMng->read_access == 1 || @$businessMng->write_access == 1 || @$businessMng->full_access == 1){ ?>
		    <div id="MyAllBusiness" class="row m-0 TabContent active">
			    <input type="hidden" name="total_count" id="total_count" value="<?php echo !empty($allBusinessCount) ? $allBusinessCount : ''; ?>" />
				<?php
					if(@$allBusiness){
						foreach(@$allBusiness as $k => $v){
							
						$category = DB::table('listing_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
						$image    = DB::table('listing_image')->where(['listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
						
						if(@$v->user_id == 0){
							$userName = 'Admin';
							$userProfile = url('profile/unnamed.jpg');
						}else{
							$checkUser = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
							if($checkUser){
								$userName = $checkUser->first_name.' '.$checkUser->last_name;
							}else{
								$userName = '';
							}
							
							if(!empty($checkUser->profile_image) && file_exists('public/profile/'.$checkUser->profile_image.'')){
								$userProfile = url('profile/'.$checkUser->profile_image.'');
							}else{
								$userProfile = url('profile/unnamed.jpg');
							}
						}
						if(!empty($image->image) && file_exists('public/listing/'.$image->image.'')){
							$galleryImg = url('listing/'.$image->image.'');
						}else{
							$galleryImg = url('noimage.jpg');
						}
						
						// $startDate  = $v->start_date;
						// $start_date = date('Y-m-d', strtotime($startDate));
						// $start_time = date('H:i:s', strtotime($startDate));
						
						$numRows = DB::table('favouritebusiness')->where(['user_id' => session()->get('USERLOGINID'), 'listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->count();
						
						if($numRows > 0){
							$fav = '<i class="fa fa-heart" aria-hidden="true"></i>';
						}else{
							$fav = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
						}
                        
						if(@$businessMng->write_access == 1 || @$businessMng->full_access == 1){
							$edit = '<a  href="javascript::void(0);" class="edit-business-detail" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#EditBusinessModal">
								<i class="fa fa-pencil-square" aria-hidden="true"></i>
							</a>';
						}else{
							$edit = '';
						}
						
                        if(@$businessMng->full_access == 1){						
							$delete = '<a href="javascript:void(0)" onclick="deleteBusiness('. @$v->id .')" data-bs-toggle="modal" data-bs-target="#DeleteEventModal-1">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</a>';
					    }else{
							$delete = '';
						}
						
						echo '
						<div class="Card col-lg-3 col-md-3 col-sm-6 post-item" relid-1="'.@$v->id.'">
						  <div class="CardInner business-detail-1"   style="background:url('.@$galleryImg.') no-repeat center center / cover;" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#DetailsMyBusinessModal">
							<div class="Cover" ></div>
							<img class="UserImage"
							  src="'.@$userProfile.'"
							  alt="">
							<p class="Heading">'.@$v->business_name.'</p>
							<p class="SubHeading">'.@$userName.'</p>
							<p class="SubHeading">Location: '.substr(@$v->address,0,40).'</p>
							<!--<p class="SubHeading">Date: '.@$start_date.'</p>
							<p class="SubHeading">Time: '.@$start_time.'</p>-->
							<div class="IconContainer" >
							
								<a href="javascript:void(0);" class="bookmarkBusiness" id="allbookmarkBusiness_'.@$v->id.'" relid="'.@$v->id.'">
									'.@$fav.'
								</a>
								
								
								
							</div>
						  </div>
						</div>
						';
					
						
						}
					}else{
						echo 'Not found any business list.';
					}
					
				?>
			</div>
		<?php } ?>
		
		
		<div id="AllBusiness" class="row m-0 TabContent">
				<?php
					if(@$myBusiness){
						foreach(@$myBusiness as $k => $v){
							
						$category = DB::table('listing_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
						$image    = DB::table('listing_image')->where(['listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
						
						if(@$v->user_id == 0){
							$userName = 'Admin';
							$userProfile = url('profile/unnamed.jpg');
						}else{
							$checkUser = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
							if($checkUser){
								$userName = $checkUser->first_name.' '.$checkUser->last_name;
							}else{
								$userName = '';
							}
							
							if(!empty($checkUser->profile_image) && file_exists('public/profile/'.$checkUser->profile_image.'')){
								$userProfile = url('profile/'.$checkUser->profile_image.'');
							}else{
								$userProfile = url('profile/unnamed.jpg');
							}
						}
						
						if(!empty($image->image) && file_exists('public/listing/'.$image->image.'')){
							$galleryImg = url('listing/'.$image->image.'');
						}else{
							$galleryImg = url('noimage.jpg');
						}
						
						// $startDate  = $v->start_date;
						// $start_date = date('Y-m-d', strtotime($startDate));
						// $start_time = date('H:i:s', strtotime($startDate));
						
						$numRows = DB::table('favouritebusiness')->where(['user_id' => session()->get('USERLOGINID'), 'listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->count();
						
						if($numRows > 0){
							$fav = '<i class="fa fa-heart" aria-hidden="true"></i>';
						}else{
							$fav = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
						}
                        
						if(@$businessMng->write_access == 1 || @$businessMng->full_access == 1){
							$edit = '<a  href="javascript::void(0);" class="edit-business-detail" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#EditBusinessModal">
								<i class="fa fa-pencil-square" aria-hidden="true"></i>
							</a>';
						}else{
							$edit = '';
						}
						
                        if(@$businessMng->full_access == 1){						
							$delete = '<a href="javascript:void(0)" onclick="deleteBusiness('. @$v->id .')" data-bs-toggle="modal" data-bs-target="#DeleteEventModal-1">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</a>';
					    }else{
							$delete = '';
						}
						
						echo '
						<div class="Card col-lg-3 col-md-3 col-sm-6">
						  <div class="CardInner business-detail-1"   style="background:url('.@$galleryImg.') no-repeat center center / cover;" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#DetailsMyBusinessModal">
							<div class="Cover" ></div>
							<img class="UserImage"
							  src="'.@$userProfile.'"
							  alt="">
							<p class="Heading">'.@$v->business_name.'</p>
							<p class="SubHeading">'.@$userName.'</p>
							<p class="SubHeading">Location: '.substr(@$v->address,0,40).'</p>
							<!--<p class="SubHeading">Date: '.@$start_date.'</p>
							<p class="SubHeading">Time: '.@$start_time.'</p>-->
							<div class="IconContainer" >
							
								<a href="javascript:void(0);" class="bookmarkBusiness" id="allbookmarkBusiness_'.@$v->id.'" relid="'.@$v->id.'">
									'.@$fav.'
								</a>
								'.@$edit.'
								'.@$delete.'
								
								
							</div>
						  </div>
						</div>
						';
					
						
						}
					}else{
						echo 'Not found any business list.';
					}
					
				?>
			</div>
			
		<div id="MyBusiness" class="row m-0 TabContent">
			<?php
				if(@$allBusiness){
					foreach(@$allBusiness as $k => $v){
						
					$category = DB::table('listing_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
					$image    = DB::table('listing_image')->where(['listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
					
					if(@$v->user_id == 0){
						$userName = 'Admin';
						$userProfile = url('profile/unnamed.jpg');
					}else{
						$checkUser = DB::table('users')->where(['id' => @$v->user_id])->select('*')->orderBy('id', 'DESC')->first();
						if($checkUser){
							$userName = $checkUser->first_name.' '.$checkUser->last_name;
						}else{
							$userName = '';
						}
						
						if(!empty($checkUser->profile_image) && file_exists('public/profile/'.$checkUser->profile_image.'')){
							$userProfile = url('profile/'.$checkUser->profile_image.'');
						}else{
							$userProfile = url('profile/unnamed.jpg');
						}
					}
					
					if(!empty($image->image) && file_exists('public/listing/'.$image->image.'')){
						$galleryImg = url('listing/'.$image->image.'');
					}else{
						$galleryImg = url('noimage.jpg');
					}
					
					// $startDate  = $v->start_date;
					// $start_date = date('Y-m-d', strtotime($startDate));
					// $start_time = date('H:i:s', strtotime($startDate));
					
					$numRows = DB::table('favouritebusiness')->where(['user_id' => session()->get('USERLOGINID'), 'listing_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->count();
					
					if($numRows > 0){
						$fav = '<i class="fa fa-heart" aria-hidden="true"></i>';
						
						echo '
					<div class="Card col-lg-3 col-md-3 col-sm-6">
					  <div class="CardInner business-detail-1"   style="background:url('.@$galleryImg.') no-repeat center center / cover;" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#DetailsMyBusinessModal">
						<div class="Cover"></div>
						<img class="UserImage"
						  src="'.@$userProfile.'"
						  alt="">
						<p class="Heading">'.@$v->business_name.'</p>
						<p class="SubHeading">'.@$userName.'</p>
						<p class="SubHeading">Location: '.substr(@$v->address,0,40).'</p>
						<!--<p class="SubHeading">Date: '.@$start_date.'</p>
						<p class="SubHeading">Time: '.@$start_time.'</p>-->
						<div class="IconContainer" >
							<a href="javascript:void(0);" class="bookmarkBusiness" id="bookmarkBusiness_'.@$v->id.'" relid="'.@$v->id.'">
								'.@$fav.'
							</a>
							
							<!--<a  href="javascript::void(0);" class="edit-business-detail" relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#EditBusinessModal">
							<i class="fa fa-pencil-square" aria-hidden="true"></i>
							</a>
							
							<a href="javascript:void(0)" onclick="deleteBusiness('. @$v->id .')" data-bs-toggle="modal" data-bs-target="#DeleteEventModal-1">
							<i class="fa fa-trash" aria-hidden="true"></i>
							</a>-->
							
						</div>
					  </div>
					</div>
					';
					
					}else{
						//$fav = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
					}
					}
				}else{
					echo 'Not found any business list.';
				}
				
			?>
        </div>
		  
		  
      </div>
	  
    <div class="container-fluid m-0 Section Subscription" style="display: none;">
      <!-- Subscription History Button -->
      <button type="button" class="AddButton get-payment-list" relid="<?=session()->get('USERLOGINID')?>" data-bs-toggle="modal" data-bs-target="#SubscriptionHistoryModal">
        <p>Subscription History</p>
      </button>

      <!-- Subscription History Modal -->
      <div class="modal fade CustomModal" id="SubscriptionHistoryModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Subscription History</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="sub-payment-list">
			
              
			  
            </div>
          </div>
        </div>
      </div>

      <div class="row m-0 TabBar">
        <div class="Pagination">
          <a href="" id="Home"><i class="fa fa-angle-left" aria-hidden="true"></i> Home / Subscription Management</a>
        </div>

        <div class="row m-0 mt-3">
		
		    <?php
		        if(count(@$plan)){
					$i = 1;
					foreach(@$plan as $k => $v){
						
						if($v->type == 1){
						  $type = 'Month';
						}elseif($v->type == 2){
						  $type = 'Year';
						}

						$nav = @$v->description;
						$nav = str_replace(array('<li>', '</li>'),'&&',$nav);

						$nav = str_replace(array('<ul>', '</ul>'),'',$nav);
						//$n = explode('11', $nav);die;
						$nav = array_filter(explode('&&', $nav));
						$nav1 = [];
						// foreach($nav as $k => $v){
						// $nav1[] = $v;
						// }
						$out = '';
						$learnMore = '';
						foreach($nav as $k1 => $v1){
							//$eventImg[] = ['image' => url('events/'.$v->image.'')];
							$out.= '<li>'.@$v1.'</li>';
							//$nav1[] = [$k1 => $v1];
							
							$learnMore.='
							    <div class="col-lg-12 col-md-12 p-0">
								  <div class="TransactionBlock">
									<div class="TransactionData">
									  <img src="'.url('assets/home/images/CompleteIcon.png').'" alt="">
									  <p class="m-0 TransactionTextdata">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
									</div>
									<div class="TransactionAmount">
									  <p class="m-0">Yes</p>
									</div>
								  </div>
								</div>
							';
						}
						
						$subInfo = DB::table('transaction')->whereRaw("user_id = '".session()->get('USERLOGINID')."' AND sub_id = '".@$v->id."' AND payment_type = 1 AND status = 'succeeded'")->limit(1)->select('*')->orderBy('id', 'DESC')->first();
						
						/*$subInfo = @$usersubInfo;
						
						if(!empty(@$subInfo)){
							if(@$subInfo->expiry_date >= date('Y-m-d')){
								$status = 'Activated';
								
								$sub = '<a href="'.url('subscription/payment?amt='.@$v->amount.'&subId='.@$v->id.'').'" class="SubscriptionBtn">
								  <p>Choose ('.@$status.')</p>
								</a>';
							}elseif(@$subInfo->expiry_date < date('Y-m-d')){
								
								$status = 'Expired';
								$sub = '<a href="javascript:void(0)" class="SubscriptionBtn">
								  <p>'.@$status.'</p>
								</a>';
								
							}else{ 
								
								$status = '';
								$sub = '<a href="'.url('subscription/payment?amt='.@$v->amount.'&subId='.@$v->id.'').'" class="SubscriptionBtn">
								  <p>Choose</p>
								</a>';
							}
						}else{
							$status = '';
							$sub = '<a href="'.url('subscription/payment?amt='.@$v->amount.'&subId='.@$v->id.'').'" class="SubscriptionBtn">
							  <p>Choose</p>
							</a>';
						}*/
						
						if(!empty(@$usersubInfo)){
							
							if($usersubInfo->sub_id == @$v->id){
								if(@$usersubInfo->expiry_date >= date('Y-m-d')){
									$status = 'Activated';
									
									$sub = '<a href="'.url('subscription/payment?amt='.@$v->amount.'&subId='.@$v->id.'').'" class="SubscriptionBtn">
									  <p>Choose ('.@$status.')</p>
									</a>';
								}elseif(@$usersubInfo->expiry_date < date('Y-m-d')){
									
									$status = 'Expired';
									$sub = '<a href="javascript:void(0)" class="SubscriptionBtn">
									  <p>'.@$status.'</p>
									</a>';
									
								}
							}else{
								
								$status = '';
								$sub = '<a href="'.url('subscription/payment?amt='.@$v->amount.'&subId='.@$v->id.'').'" class="SubscriptionBtn">
								  <p>Choose</p>
								</a>';
							
							}
							
						}else{
							$status = '';
							$sub = '<a href="'.url('subscription/payment?amt='.@$v->amount.'&subId='.@$v->id.'').'" class="SubscriptionBtn">
							  <p>Choose</p>
							</a>';
							
						}
						
						echo '
						    <div class="col-lg-3 col-md-3">
								<div class="SubscriptionBlock">
								  <div class="SubscriptionHeadingBlock">
									<h2>'.@$v->name.'</h2>
									<p class="m-0">$ '.@$v->amount.'/'.@$v->duration.'-'.@$type.'</p>
								  </div>
								  <ul>
									'.@$out.'
								  </ul>
								  <div class="m-0 row w-100 LearnMoreData" data-content="'.@$i.'">
									'.@$learnMore.'
								  </div>
								  <div class="SubscriptionBtnContainer">
								  
									'.@$sub.'
									
									<!--<a href="" class="LearnMoreBtn" data-target="'.@$i.'">Learn More</a>-->
								  </div>
								</div>
							  </div>
						';
						$i++;
					}
				}
		    ?>
          
		  
        </div>
      </div>
    </div>
	
	
	
	
	
	
	
	

	
	


	
	
  </main>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places"></script>
<link href='<?php echo url("assets/chosen/chosen.min.css"); ?>' rel='stylesheet' type='text/css'>
<script src='<?php echo url("assets/chosen/chosen.jquery.min.js"); ?>' type='text/javascript'></script> 
<script>
	window.onbeforeunload = function () {
		window.scrollTo(0,0);
	};
	$(document).ready(function(){
		windowOnScroll();
	});
	function windowOnScroll() {
		   $(window).on("scroll", function(e){
			if (($(window).scrollTop() >= ($(document).height() - $(window).height())*0.7)){
				
				//alert($("#total_count").val());
				if($(".post-item").length < $("#total_count").val()) {
					var lastId = $(".post-item:last").attr("relid-1");
					getMoreData(lastId);
				}
			}
		});
	}
	function getMoreData(lastId) {
		$(window).off("scroll");
		//alert(lastId);
		$.ajax({
			url: '<?php echo url('dashboard/load_allbusiness_data?lastId='); ?>'+ lastId+'&subId=<?=@$usersubInfo->sub_id?>',
			type: "get",
			beforeSend: function ()
			{
				$('.ajax-loader').show();
			},
			success: function (data) {
				setTimeout(function() {
				$('.ajax-loader').hide();
					$("#MyAllBusiness").append(data);
					windowOnScroll();
				}, 1000);
			}
	   });
	}
</script>
  <script>
    $('.dropdown-toggle').on('click', function (e) {
      e.stopPropagation();
      e.preventDefault();

      var self = $(this);
      if (self.is('.disabled, :disabled')) {
        return false;
      }
      self.parent().toggleClass("open");
    });

    $(document).on('click', function (e) {
      if ($('.dropdown').hasClass('open')) {
        $('.dropdown').removeClass('open');
      }
    });

    $('.nav-btn.nav-slider').on('click', function () {
      $('nav').toggleClass("open");
    });

    $('.NavHeaderCloseIcon').on('click', function () {
      if ($('.sidebar').hasClass('open')) {
        $('.sidebar').removeClass('open');
      }
    });
  </script>
  <script>
    $(document).ready(function () {
      $('#Home').click(function (e) {
        e.preventDefault();
        $('.Section.Home').toggle();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
      });

      $('#UpcomingEvents').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').toggle();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
      });

      $('#ReferralLink').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').toggle();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
      });

      $('#ManageSubscription').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').toggle();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
      });

      $('#SaleList').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').toggle();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
      });

      $('#PurchaseHistory').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').toggle();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
      });

      $('#Wallet').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').toggle();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
      });

      $('#TransactionsPayment').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').toggle();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
      });

      $('#Rewards').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').toggle();
        $('.Section.TermsConditions').hide();
      });

      $('#UpcomingEvents').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').toggle();
      });

      $('#Promotion').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
        $('.Section.Promotion').toggle();
        $('.Section.Appearance').hide();
        $('.Section.Event').hide();
        $('.Section.Business').hide();
        $('.Section.Network').hide();
        $('.Section.Subscription').hide();
      });

      $('#Appearance').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
        $('.Section.Promotion').hide();
        $('.Section.Appearance').toggle();
        $('.Section.Event').hide();
        $('.Section.Business').hide();
        $('.Section.Network').hide();
        $('.Section.Subscription').hide();
      });

      $('#Event').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
        $('.Section.Promotion').hide();
        $('.Section.Appearance').hide();
        $('.Section.Event').toggle();
        $('.Section.Business').hide();
        $('.Section.Network').hide();
        $('.Section.Subscription').hide();
      });

      $('#Business').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
        $('.Section.Promotion').hide();
        $('.Section.Appearance').hide();
        $('.Section.Event').hide();
        $('.Section.Business').toggle();
        $('.Section.Network').hide();
        $('.Section.Subscription').hide();
        //$('#business-block').css('display', 'block');
      });

      $('#Network').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
        $('.Section.Promotion').hide();
        $('.Section.Appearance').hide();
        $('.Section.Event').hide();
        $('.Section.Business').hide();
        $('.Section.Network').toggle();
        $('.Section.Subscription').hide();
      });

      $('#Subscription').click(function (e) {
        e.preventDefault();
        $('.Section.Home').hide();
        $('.Section.UpcomingEvents').hide();
        $('.Section.ReferralLink').hide();
        $('.Section.ManageSubscription').hide();
        $('.Section.SaleList').hide();
        $('.Section.PurchaseHistory').hide();
        $('.Section.Wallet').hide();
        $('.Section.TransactionsPayment').hide();
        $('.Section.Rewards').hide();
        $('.Section.TermsConditions').hide();
        $('.Section.Promotion').hide();
        $('.Section.Appearance').hide();
        $('.Section.Event').hide();
        $('.Section.Business').hide();
        $('.Section.Network').hide();
        $('.Section.Subscription').toggle();
      });
    });
  </script>
  <script>
    function openTab(event, tabName) {
      const contents = document.querySelectorAll(".TabContent");
      contents.forEach(content => content.classList.remove("active"));

      const tabs = document.querySelectorAll(".Tab");
      tabs.forEach(tab => tab.classList.remove("active"));

      document.getElementById(tabName).classList.add("active");
      event.currentTarget.classList.add("active");
    }
  </script>
  <script>
    window.onload = function () {
      document.querySelector('.Home').style.display = 'block';
      document.getElementById('Home').classList.add('Active');

      const menuItems = document.querySelectorAll('ul.nav-categories li a');
      menuItems.forEach(item => {
        item.addEventListener('click', function (event) {
          event.preventDefault();
          menuItems.forEach(link => link.classList.remove('Active'));
          item.classList.add('Active');
          document.querySelectorAll('.container-fluid.m-0.Section').forEach(section => {
            section.style.display = 'none';
          });
          const sectionClass = `.container-fluid.m-0.Section.${item.id}`;
          const targetSection = document.querySelector(sectionClass);
          if (targetSection) {
            targetSection.style.display = 'block';
          }
        });
      });
    };    
  </script>
  <script>
    document.querySelectorAll(".LearnMoreBtn").forEach(button => {
      button.addEventListener("click", function (event) {
        event.preventDefault();
        const targetId = this.getAttribute("data-target");
        const content = document.querySelector(`.LearnMoreData[data-content="${targetId}"]`);

        document.querySelectorAll(".LearnMoreData").forEach(item => {
          if (item !== content) item.style.display = "none";
        });
        document.querySelectorAll(".LearnMoreBtn").forEach(btn => {
          if (btn !== this) btn.textContent = "Learn More";
        });

        if (content.style.display === "none" || content.style.display === "") {
          content.style.display = "block";
          this.textContent = "Close";
        } else {
          content.style.display = "none";
          this.textContent = "Learn More";
        }
      });
    });
	
	
	
	google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('autocomplete_1'));
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
                        // document.getElementById('event_country').value = country;
                        // document.getElementById('event_state').value = state;
                        // document.getElementById('event_city').value = city;
                        // document.getElementById('event_zipcode').value = pin;
                    }
                }
            });
        });
    });
	
	google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('edit_autocomplete_1'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
			$('#edit_latitude').val(place.geometry['location'].lat());
			$('#edit_longitude').val(place.geometry['location'].lng());
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
                        // document.getElementById('event_country').value = country;
                        // document.getElementById('event_state').value = state;
                        // document.getElementById('event_city').value = city;
                        // document.getElementById('event_zipcode').value = pin;
                    }
                }
            });
        });
    });
	
	
	google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('event_address'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
			$('#event_latitude').val(place.geometry['location'].lat());
			$('#event_longitude').val(place.geometry['location'].lng());
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
                        document.getElementById('event_country').value = country;
                        document.getElementById('event_state').value = state;
                        document.getElementById('event_city').value = city;
                        document.getElementById('event_zipcode').value = pin;
                    }
                }
            });
        });
    });
	
	
	google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('edit_event_address'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
			$('#edit_event_latitude').val(place.geometry['location'].lat());
			$('#edit_event_longitude').val(place.geometry['location'].lng());
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
                        document.getElementById('edit_event_country').value = country;
                        document.getElementById('edit_event_state').value = state;
                        document.getElementById('edit_event_city').value = city;
                        document.getElementById('edit_event_zipcode').value = pin;
                    }
                }
            });
        });
    });
	
	google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('business_address'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
			$('#business_latitude').val(place.geometry['location'].lat());
			$('#business_longitude').val(place.geometry['location'].lng());
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
                        document.getElementById('business_country').value = country;
                        document.getElementById('business_state').value = state;
                        document.getElementById('business_city').value = city;
                        document.getElementById('business_zipcode').value = pin;
                    }
                }
            });
        });
    });
	
	google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('edit_business_address'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
			$('#edit_business_latitude').val(place.geometry['location'].lat());
			$('#edit_business_longitude').val(place.geometry['location'].lng());
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
                        document.getElementById('edit_business_country').value = country;
                        document.getElementById('edit_business_state').value = state;
                        document.getElementById('edit_business_city').value = city;
                        document.getElementById('edit_business_zipcode').value = pin;
                    }
                }
            });
        });
    });
	
	$(document).ready(function(){
	$("#submitform").on('submit', function(e){
		e.preventDefault();
		//var form_data = new FormData(); 	
		var form_data = new FormData(); 
		
		var totalfiles = document.getElementById('event_image').files.length;
		for (var index = 0; index < totalfiles; index++) {
		   form_data.append("event_image[]",  document.getElementById('event_image').files[index]);
		}
		
		var event_name = $('#event_name').val(); 
		var event_description = $('#event_description').val(); 
		var event_address = $('#event_address').val();
        var event_country = $('#event_country').val(); 
		var event_state = $('#event_state').val(); 
		var event_city = $('#event_city').val(); 
		var event_zipcode = $('#event_zipcode').val();
		var event_latitude = $('#event_latitude').val();
		var event_longitude = $('#event_longitude').val();
		var event_date = $('#event_date').val();
		var event_time = $('#event_time').val();
		var event_tags = $('#event_tags').val();
		var event_phone = $('#event_phone').val();
		var event_email = $('#event_email').val();
		var event_website = $('#event_website').val();
		var event_category = $('#event_category').val();
		var userId = $('#userId').val();

		

		form_data.append("event_name", event_name);
		form_data.append("event_description", event_description);
		form_data.append("event_address", event_address);
		form_data.append("event_country", event_country);
		form_data.append("event_state", event_state);
		form_data.append("event_city", event_city);
		form_data.append("event_zipcode", event_zipcode);
		form_data.append("event_latitude", event_latitude);
		form_data.append("event_longitude", event_longitude);
		form_data.append("event_date", event_date);
		form_data.append("event_time", event_time);
		form_data.append("event_tags", event_tags);
		form_data.append("event_phone", event_phone);
		form_data.append("event_email", event_email);
		form_data.append("event_website", event_website);
		form_data.append("event_category", event_category);
		form_data.append("userId", userId);


		$.ajax({
		headers: {
		'X-CSRF-TOKEN': "{{ csrf_token() }}"
		},	
		type: 'POST',
		url: '<?php echo url('dashboard/addEvent'); ?>',
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
				swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
			}
			if(data.status == 0){
				swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
			
		}
		});
	});

});


$(document).ready(function(){
	$("#adssubmitform").on('submit', function(e){
		e.preventDefault();
		//var form_data = new FormData(); 	
		var form_data = new FormData(); 
		
		// var totalfiles = document.getElementById('ads_image').files.length;
		// for (var index = 0; index < totalfiles; index++) {
		   // form_data.append("ads_image[]",  document.getElementById('ads_image').files[index]);
		// }
		
		// var fileToUpload = $('#ads_image').prop('files')[0];
		// $('#sortpicture').prop('files')[0];   
		var fileToUpload = document.getElementById('ads_image').files[0];

		
		var ads_category = $('#ads_category').val(); 
		var file_type = $('#file_type').val(); 
		var ads_name = $('#ads_name').val();
        var gender = $('#gender').val(); 
		var age = $('#age').val(); 
		var parental_status = $('#parental_status').val(); 
		var income = $('#income').val();
		var location = $('#autocomplete_1').val();
		var latitude = $('#latitude').val();
		var longitude = $('#longitude').val();
		

		

		form_data.append("category", ads_category);
		form_data.append("file_type", file_type);
		form_data.append("ads_name", ads_name);
		form_data.append("gender", gender);
		form_data.append("age", age);
		form_data.append("parental_status", parental_status);
		form_data.append("income", income);
		form_data.append("location", location);
		form_data.append("latitude", latitude);
		form_data.append("longitude", longitude);
		form_data.append("ads_image", fileToUpload);



		$.ajax({
			headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},	
			type: 'POST',
			url: '<?php echo url('dashboard/saveAds'); ?>',
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
					
					//swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
					$("#adsId").val(data.adsId);
					$("#select-promotion-model").modal("show");
					$("#AddPromotionModal").modal("hide");
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				}
				
			}
		});
	});

});
$(document).ready(function() {
	$(".promotion-detail").click(function () {
		var promotionId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_promotion_detail')?>",
			method: "POST",
			data:{promotionId : promotionId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
				$('.promotion-block-detail').html(response);
			}
			
		});	
	});
	
	$(".promotion-detail-1").click(function () {
		var promotionId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_promotion_detail')?>",
			method: "POST",
			data:{promotionId : promotionId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
				$('.promotion-block-detail').html(response);
			}
			
		});	
	});
	
	$(".event-detail").click(function () {
		var eventId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_event_detail')?>",
			method: "POST",
			data:{eventId : eventId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
				$('.event-block-detail').html(response);
			}
			
		});	
	});
	
	$(".event-detail-1").click(function () {
		var eventId = $(this).attr('relid');
		var block = $(this).attr('block');
		
		$.ajax({
			url: "<?=url('dashboard/get_event_detail')?>",
			method: "POST",
			data:{eventId : eventId, block : block, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
				$('.event-block-detail').html(response);
			}
			
		});	
	});
	
	
	
	$(".edit-info").click(function () {
		var promotionId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_promotion_edit_detail')?>",
			method: "POST",
			data:{promotionId : promotionId, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(response) {
				$('#edit_ads_name').val(response.ads_name);
				$('#edit_file_type option:selected').val(response.file_type);
				$('#edit_ads_category option:selected').val(response.category);
				$('#edit_gender option:selected').val(response.gender);
				$('#edit_age option:selected').val(response.age_range);
				$('#edit_parental_status option:selected').val(response.parental_status);
				$('#edit_income option:selected').val(response.income);
				$('#edit_autocomplete_1').val(response.location);
				$('#edit_latitude').val(response.latitude);
				$('#edit_longitude').val(response.longitude);
				$('#edit_id').val(response.id);
			}
			
		});	
	});
	
	
	$("#editadssubmitform").on('submit', function(e){
		e.preventDefault();
		//var form_data = new FormData(); 	
		var form_data = new FormData(); 
		
		// var totalfiles = document.getElementById('ads_image').files.length;
		// for (var index = 0; index < totalfiles; index++) {
		   // form_data.append("ads_image[]",  document.getElementById('ads_image').files[index]);
		// }
		
		// var fileToUpload = $('#ads_image').prop('files')[0];
		// $('#sortpicture').prop('files')[0];   
		var fileToUpload = document.getElementById('edit_ads_image').files[0];

		
		var ads_category = $('#edit_ads_category').val(); 
		var file_type = $('#edit_file_type').val(); 
		var ads_name = $('#edit_ads_name').val();
        var gender = $('#edit_gender').val(); 
		var age = $('#edit_age').val(); 
		var parental_status = $('#parental_status').val(); 
		var income = $('#edit_income').val();
		var location = $('#edit_autocomplete_1').val();
		var latitude = $('#edit_latitude').val();
		var longitude = $('#edit_longitude').val();
		var edit_id = $('#edit_id').val();
		

		

		form_data.append("category", ads_category);
		form_data.append("file_type", file_type);
		form_data.append("ads_name", ads_name);
		form_data.append("gender", gender);
		form_data.append("age", age);
		form_data.append("parental_status", parental_status);
		form_data.append("income", income);
		form_data.append("location", location);
		form_data.append("latitude", latitude);
		form_data.append("longitude", longitude);
		form_data.append("ads_image", fileToUpload);
		form_data.append("id", edit_id);



		$.ajax({
		headers: {
		'X-CSRF-TOKEN': "{{ csrf_token() }}"
		},	
		type: 'POST',
		url: '<?php echo url('dashboard/updateAds'); ?>',
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
				swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
			}
			if(data.status == 0){
				swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
			
		}
		});
	});
	
	$('#edit_event_tags').chosen({max_selected_options:10,width:'100%'});
	$('#event_tags').chosen({max_selected_options:10,width:'100%'});
	
	$(".edit-event-detail").click(function () {
		var eventId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_event_edit_detail')?>",
			method: "POST",
			data:{eventId : eventId, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(response) {
				$('#edit_event_name').val(response.event_name);
				$('#edit_event_address').val(response.location);
				$('#edit_event_latitude').val(response.latitude);
				$('#edit_event_longitude').val(response.longitude);
				$('#edit_event_country').val(response.country);
				$('#edit_event_state').val(response.state);
				$('#edit_event_city').val(response.city);
				$('#edit_event_zipcode').val(response.zipcode);
				$('#edit_event_date').val(response.date);
				$('#edit_event_time').val(response.time);
				$('#edit_event_category').val(response.category);
				$('#edit_event_email').val(response.email);
				$('#edit_event_website').val(response.website);
				$('#edit_event_phone').val(response.phone);
				$('#edit_event_id').val(response.id);
				$('#edit_event_description').val(response.description);
				//$('#edit_event_tags').val(response.zipcode);
				//$('#edit_event_tags option:selected').val(["23", "22"]);
				$('#edit_event_tags').chosen('destroy').val(response.tags).chosen();
				
				
			}
			
		});	
	});
	
});

function deletePromotion(dealId) 
	{
		swal({
			title: 'Do you really want your promotion to be deleted? It cannot be undone once deleted.',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#A5DC86',
			cancelButtonColor: '#DD6B55',
			confirmButtonText: 'Yes',
			cancelButtonText: 'No',
			closeOnConfirm: true,
			closeOnCancel: true
		}, function(isConfirm){
			if (isConfirm) {
				window.location.href = '<?= url('dashboard/delete-promotion/') ?>/'+dealId
			}
		});
	}

	
	$(document).ready(function(){
	$("#edit_event_submitform").on('submit', function(e){
		e.preventDefault();
		//var form_data = new FormData(); 	
		var form_data = new FormData(); 
		
		var totalfiles = document.getElementById('event_image').files.length;
		for (var index = 0; index < totalfiles; index++) {
		   form_data.append("event_image[]",  document.getElementById('event_image').files[index]);
		}
		
		var event_name = $('#edit_event_name').val(); 
		var event_description = $('#edit_event_description').val(); 
		var event_address = $('#edit_event_address').val();
        var event_country = $('#edit_event_country').val(); 
		var event_state = $('#edit_event_state').val(); 
		var event_city = $('#edit_event_city').val(); 
		var event_zipcode = $('#edit_event_zipcode').val();
		var event_latitude = $('#edit_event_latitude').val();
		var event_longitude = $('#edit_event_longitude').val();
		var event_date = $('#edit_event_date').val();
		var event_time = $('#edit_event_time').val();
		var event_phone = $('#edit_event_phone').val();
		var event_email = $('#edit_event_email').val();
		var event_website = $('#edit_event_website').val();
		var event_category = $('#edit_event_category').val();
		var event_tags = $('#edit_event_tags').val();
		var eventId = $('#edit_event_id').val();

		

		form_data.append("event_name", event_name);
		form_data.append("event_description", event_description);
		form_data.append("event_address", event_address);
		form_data.append("event_country", event_country);
		form_data.append("event_state", event_state);
		form_data.append("event_city", event_city);
		form_data.append("event_zipcode", event_zipcode);
		form_data.append("event_latitude", event_latitude);
		form_data.append("event_longitude", event_longitude);
		form_data.append("event_date", event_date);
		form_data.append("event_time", event_time);
		form_data.append("event_tags", event_tags);
		form_data.append("event_phone", event_phone);
		form_data.append("event_email", event_email);
		form_data.append("event_website", event_website);
		form_data.append("event_category", event_category);
		form_data.append("eventId", eventId);


		$.ajax({
		headers: {
		'X-CSRF-TOKEN': "{{ csrf_token() }}"
		},	
		type: 'POST',
		url: '<?php echo url('dashboard/updateEvent'); ?>',
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
				swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
			}
			if(data.status == 0){
				swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
			
		}
		});
	});

});

function deleteEvent(dealId) 
	{
		swal({
			title: 'Do you really want your event to be deleted? It cannot be undone once deleted.',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#A5DC86',
			cancelButtonColor: '#DD6B55',
			confirmButtonText: 'Yes',
			cancelButtonText: 'No',
			closeOnConfirm: true,
			closeOnCancel: true
		}, function(isConfirm){
			if (isConfirm) {
				window.location.href = '<?= url('dashboard/delete-event/') ?>/'+dealId
			}
		});
	}


    $(".bookmarkEvent").click(function () {
		var eventId = $(this).attr('relid');
		//console.log(eventId);
		$.ajax({
			url: "<?=url('dashboard/addRemoveBookmarkEvent')?>",
			method: "POST",
			data:{eventId : eventId, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(response) {
				
				if(response.status == 1){
					$('#bookmarkEvent_'+eventId+'').html('<i class="fa fa-heart" aria-hidden="true"></i>');
					$('#allbookmarkEvent_'+eventId+'').html('<i class="fa fa-heart" aria-hidden="true"></i>');
				}else if(response.status == 2){
					$('#bookmarkEvent_'+eventId+'').html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
					$('#allbookmarkEvent_'+eventId+'').html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
				}
				
			}
			
		});
			
	});

	$(document).ready(function(){
		$(document.body).on('click', '.eventsPhotos' ,function(){ 
		    //alert("success");
			var eventId = $(this).attr('relid');
			$.ajax({
				url: "<?=url('dashboard/get_event_image_gallery')?>",
				method: "POST",
				data:{eventId : eventId, "_token": "{{ csrf_token() }}"},
				dataType: 'text',
				success: function(response) {
					$('#events-gallery-model').html(response);
				}
				
			});	
		});
		
		$(document.body).on('click', '.get-payment-list' ,function(){ 
		    //alert("success");
			var userId = $(this).attr('relid');
			$.ajax({
				url: "<?=url('dashboard/get_payment_list')?>",
				method: "POST",
				data:{userId : userId, "_token": "{{ csrf_token() }}"},
				dataType: 'text',
				success: function(response) {
					$('#sub-payment-list').html(response); 
				}
				
			});	
		});
	});	
	
	$(".bookmarkBusiness").click(function () {
		var businessId = $(this).attr('relid');
		//console.log(businessId);
		$.ajax({
			url: "<?=url('dashboard/addRemoveBookmarkBusiness')?>",
			method: "POST",
			data:{businessId : businessId, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(response) {
				
				if(response.status == 1){
					$('#bookmarkBusiness_'+businessId+'').html('<i class="fa fa-heart" aria-hidden="true"></i>');
					$('#allbookmarkBusiness_'+businessId+'').html('<i class="fa fa-heart" aria-hidden="true"></i>');
				}else if(response.status == 2){
					$('#bookmarkBusiness_'+businessId+'').html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
					$('#allbookmarkBusiness_'+businessId+'').html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
				}
				
			}
			
		});
			
	});
	
	$(document).ready(function(){
		$(".business-detail").click(function () {
			var businessId = $(this).attr('relid');
			$.ajax({
				url: "<?=url('dashboard/get_business_detail')?>",
				method: "POST",
				data:{businessId : businessId, "_token": "{{ csrf_token() }}"},
				dataType: 'text',
				success: function(response) {
					$('.business-block-detail').html(response);
				}
				
			});	
		});
	
		$(".business-detail-1").click(function () {
			var businessId = $(this).attr('relid');
			$.ajax({
				url: "<?=url('dashboard/get_business_detail')?>",
				method: "POST",
				data:{businessId : businessId, "_token": "{{ csrf_token() }}"},
				dataType: 'text',
				success: function(response) {
					$('.business-block-detail').html(response);
				}
				
			});	
		});
		
		
	});
	
	$(document.body).on('click', '.businessPhotos' ,function(){ 
		//alert("success");
		var businessId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_business_image_gallery')?>",
			method: "POST",
			data:{businessId : businessId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
				$('#business-gallery-model').html(response);
			}
			
		});	
	});
	
$(document).ready(function(){
	$("#Businesssubmitform").on('submit', function(e){
		e.preventDefault();
		//var form_data = new FormData(); 	
		var form_data = new FormData(); 
		
		var totalfiles = document.getElementById('business_image').files.length;
		for (var index = 0; index < totalfiles; index++) {
		   form_data.append("business_image[]",  document.getElementById('business_image').files[index]);
		}
		
		var business_name = $('#business_name').val(); 
		var name = $('#name').val(); 
		var business_description = $('#business_description').val(); 
		var business_address = $('#business_address').val();
        var business_country = $('#business_country').val(); 
		var business_state = $('#business_state').val(); 
		var business_city = $('#business_city').val(); 
		var business_zipcode = $('#business_zipcode').val();
		var business_latitude = $('#business_latitude').val();
		var business_longitude = $('#business_longitude').val();
		var business_tags = $('#business_tags').val();
		var business_phone = $('#business_phone').val();
		var business_email = $('#business_email').val();
		var business_website = $('#business_website').val();
		var business_category = $('#business_category').val();
		var business_userId = $('#business_userId').val();

		

		form_data.append("business_name", business_name);
		form_data.append("name", name);
		form_data.append("business_description", business_description);
		form_data.append("business_address", business_address);
		form_data.append("business_country", business_country);
		form_data.append("business_state", business_state);
		form_data.append("business_city", business_city);
		form_data.append("business_zipcode", business_zipcode);
		form_data.append("business_latitude", business_latitude);
		form_data.append("business_longitude", business_longitude);
		form_data.append("business_tags", business_tags);
		form_data.append("business_phone", business_phone);
		form_data.append("business_email", business_email);
		form_data.append("business_website", business_website);
		form_data.append("business_category", business_category);
		form_data.append("business_userId", business_userId);


		$.ajax({
		headers: {
		'X-CSRF-TOKEN': "{{ csrf_token() }}"
		},	
		type: 'POST',
		url: '<?php echo url('dashboard/addBusiness'); ?>',
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
				//swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
				if($("#add_product_or_not").prop('checked') == true){
					//$("#AddCategoryModal").show();
					$("#AddBusinessModal").modal("hide");
					$("#AddCategoryModal").modal("show");
					$("#listing_id").val(data.businessId);
					$("#service_listing_id").val(data.businessId);
				}else{
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
				}
			}
			if(data.status == 0){
				swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
			
		}
		});
	});
	
	
	$(".edit-business-detail").click(function () {
		var businessId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_business_edit_detail')?>",
			method: "POST",
			data:{businessId : businessId, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(response) {
				$('#edit_business_name').val(response.business_name);
				$('#edit_name').val(response.name);
				$('#edit_business_address').val(response.address);
				$('#edit_business_latitude').val(response.latitude);
				$('#edit_business_longitude').val(response.longitude);
				$('#edit_business_country').val(response.country);
				$('#edit_business_state').val(response.state);
				$('#edit_business_city').val(response.city);
				$('#edit_business_zipcode').val(response.zipcode);
				//$('#edit_business_category').val(response.category);
				$('#edit_business_email').val(response.email);
				$('#edit_business_website').val(response.website);
				$('#edit_business_phone').val(response.phone);
				$('#edit_business_id').val(response.id);
				$('#edit_business_description').val(response.description);
				$('#edit_business_tags').val(response.tags);
				$('#edit_business_category').val(response.category);
				//$('#edit_event_tags').chosen('destroy').val(response.tags).chosen();
				
				
			}
			
		});	
	});
	
	
	
	$("#EditBusinesssubmitform").on('submit', function(e){
		e.preventDefault();
		//var form_data = new FormData(); 	
		var form_data = new FormData(); 
		
		var totalfiles = document.getElementById('edit_business_image').files.length;
		for (var index = 0; index < totalfiles; index++) {
		   form_data.append("business_image[]",  document.getElementById('edit_business_image').files[index]);
		}
		
		var business_name = $('#edit_business_name').val(); 
		var name = $('#edit_name').val(); 
		var business_description = $('#edit_business_description').val(); 
		var business_address = $('#edit_business_address').val();
        var business_country = $('#edit_business_country').val(); 
		var business_state = $('#edit_business_state').val(); 
		var business_city = $('#edit_business_city').val(); 
		var business_zipcode = $('#edit_business_zipcode').val();
		var business_latitude = $('#edit_business_latitude').val();
		var business_longitude = $('#edit_business_longitude').val();
		var business_tags = $('#edit_business_tags').val();
		var business_phone = $('#edit_business_phone').val();
		var business_email = $('#edit_business_email').val();
		var business_website = $('#edit_business_website').val();
		var business_category = $('#edit_business_category').val();
		var edit_business_id = $('#edit_business_id').val();


		

		form_data.append("business_name", business_name);
		form_data.append("name", name);
		form_data.append("business_description", business_description);
		form_data.append("business_address", business_address);
		form_data.append("business_country", business_country);
		form_data.append("business_state", business_state);
		form_data.append("business_city", business_city);
		form_data.append("business_zipcode", business_zipcode);
		form_data.append("business_latitude", business_latitude);
		form_data.append("business_longitude", business_longitude);
		form_data.append("business_tags", business_tags);
		form_data.append("business_phone", business_phone);
		form_data.append("business_email", business_email);
		form_data.append("business_website", business_website);
		form_data.append("business_category", business_category);
		form_data.append("businessId", edit_business_id);



		$.ajax({
		headers: {
		'X-CSRF-TOKEN': "{{ csrf_token() }}"
		},	
		type: 'POST',
		url: '<?php echo url('dashboard/updateBusiness'); ?>',
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
				swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
			}
			if(data.status == 0){
				swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
			
		}
		});
	});
	
	
	$("#Addcat").on('submit', function(e){
		e.preventDefault();	
		var form_data = new FormData(); 
		
		var cat_name = $('#cat_name').val(); 
		form_data.append("cat_name", cat_name);

		$.ajax({
			headers: {
			    'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},	
			type: 'POST',
			url: '<?php echo url('dashboard/addProductCat'); ?>',
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
					
					
				   $("#cat_name").val("");
				   var output = $("#append-category");
				   var html = '<div class="col-md-6 col-sm-12 position-relative"><p class="CategoryNameList">'+cat_name+'</p><a href="" class="CategoryDeleteBtn"></a></div>';
				   output.append(html);
				   
				   $("#AddCategoryModal").modal("hide");
				   $("#chooseModel").modal("show");
				   return false;
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true});
				}
				
				/*if(data.status == 1){
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				}*/
				
			}
		});
	});
	
	$("#skipAddCat").click(function () {
		$("#AddCategoryModal").modal("hide");
		$("#chooseModel").modal("show");
	});
	
	$(".AddAProduct").click(function () {
		$("#chooseModel").modal("hide");
		$("#AddProductModel").modal("show");
		$("#AddServiceModel").modal("hide");
		
		
		$.ajax({
			url: "<?=url('dashboard/get_product_category')?>",
			method: "POST",
			data:{"_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
                $('#product_category').html(response);
			}
		});	
		
	});

	$(".AddAService").click(function () {
		$("#chooseModel").modal("hide");
		$("#AddServiceModel").modal("show");
		$("#AddProductModel").modal("hide");
		
		$.ajax({
			url: "<?=url('dashboard/get_product_category')?>",
			method: "POST",
			data:{"_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
                $('#service_category').html(response);
			}
		});	
	});
	
	
	$("#addProductForm").on('submit', function(e){
		e.preventDefault();	
		var form_data = new FormData();

        var totalfiles = document.getElementById('product_image').files.length;
		for (var index = 0; index < totalfiles; index++) {
		   form_data.append("product_image[]",  document.getElementById('product_image').files[index]);
		}		
		
		var product_category = $('#product_category').val(); 
		var product_name     = $('#product_name').val(); 
		var product_price    = $('#product_price').val(); 
		var product_tags     = $('#product_tags').val(); 
		var product_description  = $('#product_description').val(); 
		var listing_id  = $('#listing_id').val(); 
		
		form_data.append("product_category", product_category);
		form_data.append("product_name", product_name);
		form_data.append("product_price", product_price);
		form_data.append("product_tags", product_tags);
		form_data.append("product_description", product_description);
		form_data.append("product_listing", listing_id);

		$.ajax({
			headers: {
			    'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},	
			type: 'POST',
			url: '<?php echo url('dashboard/addProduct'); ?>',
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
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true});
				}
				
				/*if(data.status == 1){
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				}*/
				
			}
		});
	});
	
	
	
	$("#addServiceForm").on('submit', function(e){
		e.preventDefault();	
		var form_data = new FormData();

        var totalfiles = document.getElementById('service_image').files.length;
		for (var index = 0; index < totalfiles; index++) {
		   form_data.append("service_image[]",  document.getElementById('service_image').files[index]);
		}		
		
		var service_category = $('#service_category').val(); 
		var service_name     = $('#service_name').val(); 
		var service_price    = $('#service_price').val(); 
		var service_tags     = $('#service_tags').val(); 
		var service_description  = $('#service_description').val(); 
		var service_listing_id  = $('#service_listing_id').val(); 

		form_data.append("service_category", service_category);
		form_data.append("service_name", service_name);
		form_data.append("service_price", service_price);
		form_data.append("service_tags", service_tags);
		form_data.append("service_description", service_description);
		form_data.append("service_listing_id", service_listing_id);

		$.ajax({
			headers: {
			    'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},	
			type: 'POST',
			url: '<?php echo url('dashboard/addService'); ?>',
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
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true});
				}
				
				/*if(data.status == 1){
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				}*/
				
			}
		});
	});
	
	
	
	
	$("#editServiceForm").on('submit', function(e){
		e.preventDefault();	
		var form_data = new FormData();

        var totalfiles = document.getElementById('edit_service_image').files.length;
		for (var index = 0; index < totalfiles; index++) {
		   form_data.append("service_image[]",  document.getElementById('edit_service_image').files[index]);
		}		
		
		var service_category = $('#edit_service_category').val(); 
		var service_name     = $('#edit_service_name').val(); 
		var service_price    = $('#edit_service_price').val(); 
		var service_tags     = $('#edit_service_tags').val(); 
		var service_description  = $('#edit_service_description').val(); 
		var service_listing_id  = $('#edit_service_listing_id').val(); 
		var edit_service_id  = $('#edit_service_id').val(); 

		form_data.append("service_category", service_category);
		form_data.append("service_name", service_name);
		form_data.append("service_price", service_price);
		form_data.append("service_tags", service_tags);
		form_data.append("service_description", service_description);
		form_data.append("service_listing_id", service_listing_id);
		form_data.append("edit_service_id", edit_service_id);

		$.ajax({
			headers: {
			    'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},	
			type: 'POST',
			url: '<?php echo url('dashboard/editService'); ?>',
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
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true});
				}
				
				/*if(data.status == 1){
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				}*/
				
			}
		});
	});
	
	$("#editProductForm").on('submit', function(e){
		e.preventDefault();	
		var form_data = new FormData();

        var totalfiles = document.getElementById('edit_product_image').files.length;
		for (var index = 0; index < totalfiles; index++) {
		   form_data.append("product_image[]",  document.getElementById('edit_product_image').files[index]);
		}		
		
		var product_category = $('#edit_product_category').val(); 
		var product_name     = $('#edit_product_name').val(); 
		var product_price    = $('#edit_product_price').val(); 
		var product_tags     = $('#edit_product_tags').val(); 
		var product_description  = $('#edit_product_description').val(); 
		var listing_id  = $('#edit_service_listing_id').val(); 
		var edit_product_id  = $('#edit_product_id').val(); 
		
		form_data.append("product_category", product_category);
		form_data.append("product_name", product_name);
		form_data.append("product_price", product_price);
		form_data.append("product_tags", product_tags);
		form_data.append("product_description", product_description);
		form_data.append("edit_product_id", edit_product_id);

		$.ajax({
			headers: {
			    'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},	
			type: 'POST',
			url: '<?php echo url('dashboard/editProduct'); ?>',
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
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true});
				}
				
				/*if(data.status == 1){
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				}*/
				
			}
		});
	});
	
});

function deleteBusiness(dealId) 
{
	swal({
		title: 'Do you really want your business to be deleted? It cannot be undone once deleted.',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#A5DC86',
		cancelButtonColor: '#DD6B55',
		confirmButtonText: 'Yes',
		cancelButtonText: 'No',
		closeOnConfirm: true,
		closeOnCancel: true
	}, function(isConfirm){
		if (isConfirm) {
			window.location.href = '<?= url('dashboard/delete-business/') ?>/'+dealId
		}
	});
}

$(document).ready(function(){
	
	$("#invisubmitform").on('submit', function(e){
		e.preventDefault();	
		var form_data = new FormData();

		var invi_event_name   = $('#invi_event_name').val(); 
		var invi_event_user   = $('#invi_event_user').val(); 
		var invi_price        = $('#invi_price').val(); 
		var invi_start_time   = $('#invi_start_time').val(); 
		var invi_end_time     = $('#invi_end_time').val(); 
		var invi_description     = $('#invi_description').val(); 
		
		form_data.append("invi_event_name", invi_event_name);
		form_data.append("invi_event_user", invi_event_user);
		form_data.append("invi_price", invi_price);
		form_data.append("invi_start_time", invi_start_time);
		form_data.append("invi_end_time", invi_end_time);
		form_data.append("invi_description", invi_description);
		


		$.ajax({
			headers: {
			    'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},	
			type: 'POST',
			url: '<?php echo url('dashboard/sendInvitation'); ?>',
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
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				}
			}
		});
	});
	
	
	$(".repeat-invitation").click(function () {
		var inviTd = $(this).attr('relid');
		$('#invi_id').val(inviTd);

		$.ajax({
			url: "<?=url('dashboard/get_counter_offer')?>",
			method: "POST",
			data:{inviTd : inviTd, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(response) {
                $('.BlockData1').html(response.output1);
                $('.BlockData21').html(response.output2);
			}
		});	
	});
	
	
	$("#sentCountorOffer").on('submit', function(e){
		e.preventDefault();	
		var form_data = new FormData();

		var counter_offer   = $('#counter_offer').val(); 
		var invi_id   = $('#invi_id').val(); 

		form_data.append("counter_offer", counter_offer);
		form_data.append("invi_id", invi_id);
		


		$.ajax({
			headers: {
			    'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},	
			type: 'POST',
			url: '<?php echo url('dashboard/sendCounterInvitation'); ?>',
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
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = ""});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				}
			}
		});
	});
	
	$(".accept-offer").click(function () {
		var invi_id = $('#invi_id').val();
		//console.log(invi_id);
		
		$.ajax({
			url: "<?=url('dashboard/accept_invitation')?>",
			method: "POST",
			data:{invi_id : invi_id, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(data) {
                if(data.status == 1){
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true});
				}
			}
		});	
	
	});
	
	$(".reject-offer").click(function () {
		var invi_id = $('#invi_id').val();
		//console.log(invi_id);
		
		$.ajax({
			url: "<?=url('dashboard/reject_invitation')?>",
			method: "POST",
			data:{invi_id : invi_id, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(data) {
                if(data.status == 1){
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true});
				}
			}
		});	
	
	});
	
	$(".withdraw-invitation").click(function () {
		var inviTd = $(this).attr('relid');
		$('.pending-reject-offer').attr('pendingreject-offer', inviTd);
	});
	
	
	$(".pending-reject-offer").click(function () {
		var invi_id = $(this).attr('pendingreject-offer');
		$.ajax({
			url: "<?=url('dashboard/reject_invitation')?>",
			method: "POST",
			data:{invi_id : invi_id, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(data) {
                if(data.status == 1){
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true});
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true});
				}
			}
		});	
	});
	
	
	$("#adsSub").on('submit', function(e){
		e.preventDefault();	
		var form_data = new FormData();

		var preferredListing   = $('#preferredListing').val(); 
		var duration   = $('#duration').val(); 
		var subId   = $('#subId').val(); 
		var adsId   = $('#adsId').val(); 
		var userId   = '<?=session()->get('USERLOGINID')?>';

        window.location.href = "<?=url('dashboard/adspayment/?')?>userId="+userId+"&planId="+subId+"&adsId="+adsId+"&preferredListing="+preferredListing+"&duration="+duration+"";
	});

});

$(document.body).on('click', '.product-details' ,function(){ 
		//alert("success");
	var productId = $(this).attr('relid');
	$.ajax({
		url: "<?=url('dashboard/get_product_details')?>",
		method: "POST",
		data:{productId : productId, "_token": "{{ csrf_token() }}"},
		dataType: 'text',
		success: function(response) {
			$('#product-details-block').html(response);
		}
		
	});	
});

$(document.body).on('click', '.productPhotos' ,function(){ 
		//alert("success");
		var productId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_product_image_gallery')?>",
			method: "POST",
			data:{productId : productId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
				$('#product-gallery-model').html(response);
			}
			
		});	
	});
	
$(document.body).on('click', '.service-details' ,function(){ 
		//alert("success");
	var serviceId = $(this).attr('relid');
	$.ajax({
		url: "<?=url('dashboard/get_service_details')?>",
		method: "POST",
		data:{serviceId : serviceId, "_token": "{{ csrf_token() }}"},
		dataType: 'text',
		success: function(response) {
			$('#service-details-block').html(response);
		}
		
	});	
});



$(document.body).on('click', '.edit-services' ,function(){ 	
		var serviceId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_service_edit_detail')?>",
			method: "POST",
			data:{serviceId : serviceId, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(response) {
				$('#edit_service_name').val(response.name);
				$('#edit_service_category').val(response.category);
				$('#edit_service_listing_id').val(response.listing_id);
				$('#edit_service_price').val(response.price);
				$('#edit_service_description').val(response.description);
				$('#edit_service_tags').val(response.tags);
				$('#edit_service_id').val(response.id);

				
				
			}
			
		});	
	});
	
	$(document.body).on('click', '.edit-product' ,function(){ 	
		var productId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_product_edit_detail')?>",
			method: "POST",
			data:{productId : productId, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(response) {
				$('#edit_product_name').val(response.name);
				$('#edit_product_category').val(response.category);
				$('#edit_product_listing_id').val(response.listing_id);
				$('#edit_product_price').val(response.price);
				$('#edit_product_description').val(response.description);
				$('#edit_product_tags').val(response.tags);
				$('#edit_product_id').val(response.id);

				
				
			}
			
		});	
	});

$(document.body).on('click', '.servicePhotos' ,function(){ 
		//alert("success");
		var serviceId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_service_image_gallery')?>",
			method: "POST",
			data:{serviceId : serviceId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
				$('#service-gallery-model').html(response);
			}
			
		});	
	});
  </script>
  
  <script>
  // $(document.body).on('click', ".counter" ,function(){ 
    // const counterElement = document.getElementsByClassName("counter")[0];
    // const incrementButton = document.getElementsByClassName("increment")[0];
    // const decrementButton = document.getElementsByClassName("decrement")[0];
    // let counterValue = 0;
    // function updateCounter() {
      // counterElement.textContent = counterValue;
    // }
    // incrementButton.addEventListener("click", () => {
      // counterValue++;
      // updateCounter();
    // });
    // decrementButton.addEventListener("click", () => {
      // if (counterValue > 0) {
        // counterValue--;
        // updateCounter();
      // }
    // });
    // updateCounter();
	// });
	
	var x = 1;
	document.getElementsByClassName('counter').innerHTML = x;
	$(document.body).on('click', ".increment" ,function(){
	   // document.getElementsByClassName('counter').innerHTML = ++x;
	   $('#counterId').html(++x);
	});
	$(document.body).on('click', ".decrement" ,function(){ 
	    $('#counterId').html(--x);
		
	});
  </script>
  <script>
    /*$(document).ready(function () {
      $('.AddToCartNotify').click(function () {
        $.notify("Hooray! 1 item added to your cart", {
          className: "success",
          position: "bottom right",
          autoHide: true,
          autoHideDelay: 3000,
        });
      });
    });*/
	$(document.body).on('click', ".AddToCartNotify" ,function(){
		var productId = $(this).attr('relid');
		var quantity = $('#counterId').text();
		
		$.ajax({
			url: "<?=url('dashboard/add_to_cart')?>",
			method: "POST",
			data:{quantity : quantity, productId : productId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
				//$('#service-gallery-model').html(response);
			}
			
		});	

	});
	
	$(document.body).on('click', "#BuyNowSection" ,function(){
		var productId = $(this).attr('relid');
		var quantity = $('#counterId').text();
		
		$.ajax({
			url: "<?=url('dashboard/add_to_cart')?>",
			method: "POST",
			data:{quantity : quantity, productId : productId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
				//$('#service-gallery-model').html(response);
				window.location.href = "<?=url('dashboard/addtoCart')?>";
			}
			
		});	

	});
	
	
	$(document.body).on('click', ".inviteeUserModel" ,function(){
		var eventId = $(this).attr('relid-event');
		//var quantity = $('#counterId').text();
		
		$.ajax({
			url: "<?=url('dashboard/get_invitee_user_model')?>",
			method: "POST",
			data:{eventId : eventId, "_token": "{{ csrf_token() }}"},
			dataType: 'text', 
			success: function(response) {
				$('#myTabContent').html(response);
				//$('#searchInvitee').val(eventId);
				$('#searchInvitee').attr('relid-event', eventId);
				//window.location.href = "<?=url('dashboard/addtoCart')?>";
			}
		});	
	});
	
	
	$(document.body).on('keyup', "#searchInvitee" ,function(){
		var searchText = $(this).val();
		//console.log(searchText);
		var eventId = $('#searchInvitee').attr('relid-event');
		$.ajax({
			url: "<?=url('dashboard/searchInvitePeople')?>",
			method: "POST",
			data:{searchText : searchText, eventId : eventId, "_token": "{{ csrf_token() }}"},
			dataType: 'text', 
			success: function(response) {
				$('#myTabContent').html(response);
			}
		});
	});
	
	
	$(document.body).on('click', ".deleteProduct" ,function(){
		var productId = $(this).attr('relid');
		//var quantity = $('#counterId').text();
		
		
		    swal({
				title: 'Do you really want your product to be deleted? It cannot be undone once deleted.',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#A5DC86',
				cancelButtonColor: '#DD6B55',
				confirmButtonText: 'Yes',
				cancelButtonText: 'No',
				closeOnConfirm: true,
				closeOnCancel: true
			}, function(isConfirm){
				if (isConfirm) {
					$.ajax({
						url: "<?=url('dashboard/delete_product')?>",
						method: "POST",
						data:{productId : productId, "_token": "{{ csrf_token() }}"},
						dataType: 'json',
						success: function(data) {
							console.log(data);
							if(data.status == 1){
								swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true});
							}
							if(data.status == 0){
								swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true});
							}
						}
					});	
				}
			});
	});
	
	
	$(document.body).on('click', ".deleteService" ,function(){
		var productId = $(this).attr('relid');
		//var quantity = $('#counterId').text();
		
		
		    swal({
				title: 'Do you really want your service to be deleted? It cannot be undone once deleted.',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#A5DC86',
				cancelButtonColor: '#DD6B55',
				confirmButtonText: 'Yes',
				cancelButtonText: 'No',
				closeOnConfirm: true,
				closeOnCancel: true
			}, function(isConfirm){
				if (isConfirm) {
					$.ajax({
						url: "<?=url('dashboard/delete_service')?>",
						method: "POST",
						data:{serviceId : serviceId, "_token": "{{ csrf_token() }}"},
						dataType: 'json',
						success: function(data) {
							//console.log(data);
							if(data.status == 1){
								swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true});
							}
							if(data.status == 0){
								swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true});
							}
						}
					});	
				}
			});
	});
	
	
	
	
	$("#ManageSubscription").click(function () {
	    window.location.href = '<?=url('dashboard/stripe-connect');?>'; 
	});
	
	$("#UpcomingEvents").click(function () {
	    window.location.href = '<?=url('dashboard/upcoming-event');?>'; 
	});
	
	$("#ReferralLink").click(function () {
	    window.location.href = '<?=url('dashboard/refferalLink');?>'; 
	});
	
	$("#Wallet").click(function () {
	    window.location.href = '<?=url('dashboard/wallet');?>'; 
	});
	
	$("#TransactionsPayment").click(function () {
	    window.location.href = '<?=url('dashboard/transaction');?>'; 
	});
	
	$("#Rewards").click(function () {
	    window.location.href = '<?=url('dashboard/reward');?>'; 
	});
	
	$("#TermsConditions").click(function () {
	    window.location.href = '<?=url('dashboard/term-and-condition');?>'; 
	});
	
	$("#PurchaseHistory").click(function () {
	    window.location.href = '<?=url('dashboard/purchase-history');?>'; 
	});
	
	$("#SaleList").click(function () {
	    window.location.href = '<?=url('dashboard/sale-list');?>'; 
	});
	
	
	$(document).ready(function() {
		$("#search-box").keyup(function() {
			$.ajax({
				type: "POST",
				url: "<?=url('dashboard/autoSuggestion')?>",
				data: {keyword : $(this).val(), "_token": "{{ csrf_token() }}"},
				beforeSend: function() {
				   // $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
				},
				success: function(data) {
					$("#suggesstion-box").show();
					$("#suggesstion-box").html(data);
					//$("#search-box").css("background", "#FFF");
				}
			});
		});
	});
	
	$(document).on("click", ".selectCountry", function () {
		var search  = $(this).attr("search");
		var keywork = $(this).attr("keywork");
		
		window.location.href = '<?=url('dashboard/search?');?>search='+search+'&keyword='+keywork+''; 
		
	});
	
	<!-- New Script -->
  
    document.querySelector('.search').addEventListener('click', function () {
      const modal = document.getElementById('SearchModal');
      if (modal) {
        modal.classList.add('SearchModalStyle');
      }
    });
	
	$(document).on('change','#preferredListing',function(e){
        var preferred_listing = $(this).val();
        if(preferred_listing == 1){
			$("#promotionPrefered").css('display', 'block');
		}else if(preferred_listing == 0){
			$("#promotionPrefered").css('display', 'none');
		}else if(plan_type == 'Yearly'){
			$("#promotionPrefered").css('display', 'none');
		}
    });
  
  </script>
  

</body>

</html>

<?php
	if(!empty(session('status'))) {
		$msg = session('status');
		echo '<script>swal({
			title: "Success!",
			text: "<strong>'.$msg.'</strong>",
			type: "success",
			html:true,
			showConfirmButton: true
		});</script>';
	}
	
	if(!empty(session('error'))) {
		$msg = session('error');
		echo '<script>swal({
			title: "Fail!",
			text: "<strong>'.$msg.'</strong>",
			type: "error",
			html:true,
			button: "ok",
		});</script>';
	}
 ?>