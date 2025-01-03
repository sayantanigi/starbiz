<!DOCTYPE html>
<html lang="en">

<head>
  <title>StarBiz</title>
  <meta charset="UTF-8">
   <link rel="shortcut icon" href="https://techb.igiapp.com/starbiz/setting/2019685580.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=url('assets/home/style/style.css')?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <style>
  
	.showSweetAlert > h2{
	    font-size: 20px !important;
	}
	
    body {
      width: 100vw;
      height: 100vh;
      margin: 0;
    }

    .Active {
      background-color: rgb(255 255 255);
      color: #b38a41;
      font-weight: 600;
      box-shadow: 0 10px 10px #f1f1f1;
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
  </style>
</head>

<body>
  <nav class="sidebar">
    <div class="nav-header">
      <div class="logo-wrap">
        <a class="logo-text" href="">StarBiz</a>
      </div>
    </div>
    <ul class="nav-categories ul-base">
      <li><a href="" id="Promotion" class="Active">Promotion Management</a></li>
      <li><a href="" id="Appearance">Appearance Management</a></li>
      <li><a href="" id="Event">Event Management</a></li>
      <li><a href="" id="Business">Business Management</a></li>
      <li><a href="" id="Network">Network Management</a></li>
      <li><a href="" id="Subscription">Subscription Management</a></li>
    </ul>
  </nav>

  <header>
    <div class="header-inner">
      <div class="header-first-inner">
        <div class="nav-btn nav-slider">
          <i class="material-icons">menu</i>
        </div>
        <div class="header-logo">
          <a href=""> <img src="<?=url('assets/home/Logo/Logo.png')?>" alt="Logo"></a>
        </div>
        <div class="header-search">
          <div class="search">
            <i class="material-icons">search</i>
            <input type="search" name="search" placeholder="Search">
          </div>
        </div>
      </div>
      <div class="header-menu">
        <ul class="ul-base">
          <li><a href="">Profile</a></li>
           <li><a href="<?=url('logout')?>">Logout</a></li>
        </ul>
      </div>
    </div>
  </header>

  <main role="main">
    <div class="container-fluid m-0 Section Promotion">
      <!-- Add Promotion Button -->
      <button type="button" class="AddButton" data-bs-toggle="modal" data-bs-target="#AddPromotionModal">
        <i class="fa fa-plus" aria-hidden="true"></i>
        <p>Add Promotion</p>
      </button>

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
					    <button type="submit" class="btn btn-primary">Submit</button>
					</div>
				    </form>
				</div>
            
			
			
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
           <!-- <div class="modal-footer">
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
              <button type="button" promotion-delete-relid="" class="btn btn-primary">Delete</button>
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
        <div class="TabContainer">
          <div class="Tab active" onclick="openTab(event, 'AllPromotion')">All Promotion</div>
          <div class="Tab" onclick="openTab(event, 'MyPromotion')">My Promotion</div>
        </div>
      </div>

      <div id="AllPromotion" class="row m-0 TabContent active">
        <?php
		    if(@$adsList){
				foreach(@$adsList as $k => $v){
		?>
        <div class="Card col-lg-3 col-md-3 col-sm-6">
          <div class="CardInner promotion-detail"   relid="<?=@$v->id?>" data-bs-toggle="modal" data-bs-target="#DetailsPromotionModal">
            <div class="Cover"></div>
            <p class="Heading"><?=@$v->ads_name?></p>
            <p class="SubHeading"><?=strip_tags(@$v->description)?></p>
          </div>
        </div>
		<?php } }else{
			echo 'Not found any promotion.';
		} ?>
      </div>

      <div id="MyPromotion" class="row m-0 TabContent">
        <?php
		    if(@$myadsList){
				foreach(@$myadsList as $k => $v){
		?>
	   
        <div class="Card col-lg-3 col-md-3 col-sm-6">
          <div class="CardInner promotion-detail-1"  relid="<?=@$v->id?>" data-bs-toggle="modal" data-bs-target="#DetailsPromotionModal">
            <div class="Cover"></div>
            <p class="Heading"><?=@$v->ads_name?></p>
            <p class="SubHeading"><?=strip_tags(@$v->description)?></p>
			
            <div class="IconContainer">
            
			  <a href="javascript::voide(0);" class="edit-info" relid="<?=$v->id?>" data-bs-toggle="modal" data-bs-target="#EditPromotionModal">
                <i class="fa fa-pencil-square" aria-hidden="true"></i>
              </a>
			  
              <a href="javascript::voide(0);" onclick="deletePromotion(<?= @$v->id ?>)" data-bs-toggle="modal" data-bs-target="#DeletePromotionModal1">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
		<?php } }else{
			echo 'Not found any promotion.';
		} ?>
      </div>
    </div>

    <div class="container-fluid m-0 Section Appearance" style="display: none;">
      <!-- Send Invitation Button -->
      <button type="button" class="AddButton" data-bs-toggle="modal" data-bs-target="#AddAppearanceModal">
        <i class="fa fa-plus" aria-hidden="true"></i>
        <p>Send Invitation</p>
      </button>

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
              <form class="row g-3">
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Select Event</label>
                  <select>
                    <option selected disabled value="">Select Event</option>
                    <option>...</option>
                  </select>
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Select Athletics/Entertainer</label>
                  <select>
                    <option selected disabled value="">Selct</option>
                    <option>...</option>
                  </select>
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Price</label>
                  <input type="text" placeholder="Enter price">
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">Start Time</label>
                  <input type="time" placeholder="Time">
                </div>
                <div class="col-md-4 col-sm-12">
                  <label class="form-label">End Time</label>
                  <input type="time" placeholder="Time">
                </div>
                <div class="col-md-12 col-sm-12">
                  <label class="form-label">Instructions</label>
                  <textarea type="text" placeholder="Description"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>

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
                  <img src="../assets/images/QRCode.png" alt="">
                </div>
                <div class="col-md-6 col-sm-12 BtnContainer">
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="../assets/images/Icon1.png" alt="">
                    </span>
                    <p>Appearance Initiated</p>
                  </button>
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="../assets/images/Icon1.png" alt="">
                    </span>
                    <p>Appearance not attended</p>
                  </button>
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="../assets/images/Icon2.png" alt="">
                    </span>
                    <p>Appearance ended</p>
                  </button>
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="../assets/images/Icon3.png" alt="">
                    </span>
                    <p>Contact invitee</p>
                  </button>
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="../assets/images/Icon4.png" alt="">
                    </span>
                    <p>Contact admin</p>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Send Appearance Modal 2 -->
      <div class="modal fade CustomModal" id="AppearanceModal2" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Counter Offer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body AppearanceData">
              <form class="row g-3">
                <div class="col-md-6 col-sm-12 SmallDataBlock">
                  <p class="Heading">Send new offer</p>
                  <div class="BlockData1">
                    <div class="BlockDataInner1">
                      <span>
                        <img src="../assets/images/Icon5.png" alt="">
                      </span>
                      <p>Original offer</p>
                    </div>
                    <p class="Price1">$100</p>
                  </div>
                  <div class="BlockData2">
                    <div class="BlockDataInner2">
                      <span>
                        <img src="../assets/images/Icon5.png" alt="">
                      </span>
                      <p>Counter offer</p>
                    </div>
                    <p class="Price2">$150</p>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <label class="form-label">Enter Offer</label>
                    <input type="text" placeholder="Enter amount">
                  </div>
                  <button type="button" class="btn btn-primary">Send</button>
                </div>
                <div class="col-md-6 col-sm-12 BtnContainer">
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="../assets/images/Icon5.png" alt="">
                    </span>
                    <p>Accept counter offer</p>
                  </button>
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="../assets/images/Icon2.png" alt="">
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Pending</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body AppearanceData">
              <form class="row g-3">
                <div class="col-md-6 col-sm-12 SmallDataBlock">
                  <p class="Heading">Send new offer</p>
                  <div class="BlockData1">
                    <div class="BlockDataInner1">
                      <span>
                        <img src="../assets/images/Icon5.png" alt="">
                      </span>
                      <p>Original offer</p>
                    </div>
                    <p class="Price1">$100</p>
                  </div>
                  <div class="BlockData2">
                    <div class="BlockDataInner2">
                      <span>
                        <img src="../assets/images/Icon5.png" alt="">
                      </span>
                      <p>Counter offer</p>
                    </div>
                    <p class="Price2">$150</p>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <label class="form-label">Enter Offer</label>
                    <input type="text" placeholder="Enter amount">
                  </div>
                  <button type="button" class="btn btn-primary">Send</button>
                </div>
                <div class="col-md-6 col-sm-12 BtnContainer">
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="../assets/images/Icon2.png" alt="">
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
                      <img src="../assets/images/Icon2.png" alt="">
                    </span>
                    <p>Clear from list</p>
                  </button>
                  <button type="button" class="btn btn-primary">
                    <span>
                      <img src="../assets/images/Icon2.png" alt="">
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
        <div class="TabContainer">
          <div class="Tab active" onclick="openTab(event, 'AcceptedAppearance')">Accepted</div>
          <div class="Tab" onclick="openTab(event, 'SentAppearance')">Sent</div>
          <div class="Tab" onclick="openTab(event, 'CompletedAppearance')">Completed</div>
        </div>
      </div>

      <div id="AcceptedAppearance" class="row m-0 TabContent active">
        
		
		<?php
			if(@$accept){
				foreach(@$accept as $k => $v){
					
				$userInfo = DB::select("select first_name, last_name from users where (id = '".$v->sender_id."' OR id = '".$v->receiver_id."') LIMIT 1");
				
						
				$eventInfo = DB::select("select event_name, location from events where id = '".$v->event_id."' LIMIT 1");	
				
			$startDate  = @$eventInfo[0]->start_date;
			$start_date = date('Y-m-d', strtotime($startDate));
			$start_time = date('H:i:s', strtotime($startDate));
		?>
			<div class="Card col-lg-3 col-md-3 col-sm-6">
				<div class="CardInner">
					<div class="Cover"></div>
					<p class="Heading"><?=@$userInfo[0]->first_name.' '.@$userInfo[0]->last_name?></p>
					<p class="SubHeading"><?=@$eventInfo[0]->event_name?></p>
					<p class="SubHeading">Location: <?=substr(@$eventInfo[0]->location,0,20)?></p>
					<p class="SubHeading">Date: <?=@$start_date?></p>
					<p class="SubHeading">Time: <?=@$start_time?></p>
					<p class="SubHeading">Price: <?=@$v->amount?></p>
					<div class="IconContainer">
						<a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal1">
						    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>
		
        <?php			
				}
			}else{
				echo 'Not found any request.';
			}
		
		?>
      </div>

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
						$eventInfo = DB::select("select event_name, location from events where id = '".$v->event_id."' LIMIT 1");	
						$startDate  = @$eventInfo[0]->start_date;
						$start_date = date('Y-m-d', strtotime($startDate));
						$start_time = date('H:i:s', strtotime($startDate));
						
						echo '
							<div class="Card col-lg-3 col-md-3 col-sm-6">
								<div class="CardInner">
								  <div class="Cover"></div>
								  <p class="Heading">'.@$userInfo[0]->first_name.' '.@$userInfo[0]->last_name.'</p>
								  <p class="SubHeading">'.@$eventInfo[0]->event_name.'</p>
								  <p class="SubHeading">Location: '.substr(@$eventInfo[0]->location,0,20).'</p>
								  <p class="SubHeading">Date: '.@$start_date.'</p>
								  <p class="SubHeading">Time: '.@$start_time.'</p>
								  <p class="SubHeading">Price: '.@$v->amount.'</p>
								  <div class="IconContainer">
									<a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal2">
									  <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
									</a>
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
				if(count(@$counter)){
					foreach(@$counter as $k => $v){
						
						$userInfo = DB::select("select first_name, last_name from users where (id = '".$v->sender_id."' OR id = '".$v->receiver_id."') LIMIT 1");
						$eventInfo = DB::select("select event_name, location from events where id = '".$v->event_id."' LIMIT 1");	
						$startDate  = @$eventInfo[0]->start_date;
						$start_date = date('Y-m-d', strtotime($startDate));
						$start_time = date('H:i:s', strtotime($startDate));
						
						echo '
							<div class="Card col-lg-3 col-md-3 col-sm-6">
								<div class="CardInner">
								  <div class="Cover"></div>
								  <p class="Heading">'.@$userInfo[0]->first_name.' '.@$userInfo[0]->last_name.'</p>
								  <p class="SubHeading">'.@$eventInfo[0]->event_name.'</p>
								  <p class="SubHeading">Location: '.substr(@$eventInfo[0]->location,0,20).'</p>
								  <p class="SubHeading">Date: '.@$start_date.'</p>
								  <p class="SubHeading">Time: '.@$start_time.'</p>
								  <p class="SubHeading">Price: '.@$v->amount.'</p>
									<div class="IconContainer">
										<a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal3">
										    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
										</a>
									</div>
								</div>
							</div>
						';
					}
				}else{
				    echo 'Not found any request.';
			    }
			?>
			
              <!--<div class="Card col-lg-3 col-md-3 col-sm-6">
                <div class="CardInner">
                  <div class="Cover"></div>
                  <p class="Heading">Name of Athlete</p>
                  <p class="SubHeading">Event Name (Event Category)</p>
                  <p class="SubHeading">Location: </p>
                  <p class="SubHeading">Date: </p>
                  <p class="SubHeading">Time: </p>
                  <p class="SubHeading">Price: </p>
                  <div class="IconContainer">
                    <a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal3">
                      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>-->
			  
			  
			  
            </div>
          </div>
          <div class="tab-pane" id="Rejected" role="tabpanel">
            <div class="row">
			
			<?php
				if(count(@$rejectIn)){
					foreach(@$rejectIn as $k => $v){
						
						$userInfo = DB::select("select first_name, last_name from users where (id = '".$v->sender_id."' OR id = '".$v->receiver_id."') LIMIT 1");
						$eventInfo = DB::select("select event_name, location from events where id = '".$v->event_id."' LIMIT 1");	
						$startDate  = @$eventInfo[0]->start_date;
						$start_date = date('Y-m-d', strtotime($startDate));
						$start_time = date('H:i:s', strtotime($startDate));
						
						echo '
							<div class="Card col-lg-3 col-md-3 col-sm-6">
								<div class="CardInner">
								  <div class="Cover"></div>
								  <p class="Heading">'.@$userInfo[0]->first_name.' '.@$userInfo[0]->last_name.'</p>
								  <p class="SubHeading">'.@$eventInfo[0]->event_name.'</p>
								  <p class="SubHeading">Location: '.substr(@$eventInfo[0]->location,0,20).'</p>
								  <p class="SubHeading">Date: '.@$start_date.'</p>
								  <p class="SubHeading">Time: '.@$start_time.'</p>
								  <p class="SubHeading">Price: '.@$v->amount.'</p>
									<div class="IconContainer">
										<a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal4">
										    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
										</a>
									</div>
								</div>
							</div>
						';
					}
				}else{
				    echo 'Not found any request.';
			    }
			?>
			
              <!--<div class="Card col-lg-3 col-md-3 col-sm-6">
                <div class="CardInner">
                  <div class="Cover"></div>
                  <p class="Heading">Name of Athlete</p>
                  <p class="SubHeading">Event Name (Event Category)</p>
                  <p class="SubHeading">Location: </p>
                  <p class="SubHeading">Date: </p>
                  <p class="SubHeading">Time: </p>
                  <p class="SubHeading">Price: </p>
                  <div class="IconContainer">
                    <a href="" data-bs-toggle="modal" data-bs-target="#AppearanceModal4">
                      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>-->
			  
            </div>
          </div>
        </div>
      </div>

      <div id="CompletedAppearance" class="row m-0 TabContent">
        <div class="Card col-lg-3 col-md-3 col-sm-6">
          <div class="CardInner">
            <div class="Cover"></div>
            <p class="Heading">Name of Athlete</p>
            <p class="SubHeading">Event Name (Event Category)</p>
            <p class="SubHeading">Location: </p>
            <p class="SubHeading">Date: </p>
            <p class="SubHeading">Time: </p>
            <p class="SubHeading">Price: </p>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid m-0 Section Event" style="display: none;">
      <!-- Add Event Button -->
      <button type="button" class="AddButton" data-bs-toggle="modal" data-bs-target="#AddEventModal">
        <i class="fa fa-plus" aria-hidden="true"></i>
        <p>Add Event</p>
      </button>

      <!-- Add Event Modal -->
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
                    <input type="text" placeholder="Enter location" name="edit_event_address" id="edit_event_address" required>
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
	  
	   <!-- Details Promotion Modal -->
      <div class="modal fade CustomModal" id="DetailsEventModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Event Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			
            <div class="modal-body event-block-detail" id="">
              
			  
            </div>
			
			
          </div>
        </div>
      </div>

      <div class="row m-0 TabBar">
        <div class="TabContainer">
          <div class="Tab active" onclick="openTab(event, 'MyEvents')">All Events</div>
          <div class="Tab" onclick="openTab(event, 'FavoriteEvents')">My Events</div>
        </div>
      </div>

      <div id="MyEvents" class="row m-0 TabContent active">
        <!--<div class="Card col-lg-3 col-md-3 col-sm-6">
          <div class="CardInner">
            <div class="Cover"></div>
            <img class="UserImage"
              src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt="">
            <p class="Heading">Event Name</p>
            <p class="SubHeading">Event Organizer Name</p>
            <p class="SubHeading">Location: </p>
            <p class="SubHeading">Date: </p>
            <p class="SubHeading">Time: </p>
            <div class="IconContainer">
              <a href="">
                <i class="fa fa-heart-o" aria-hidden="true"></i>
              </a>
              <a href="" data-bs-toggle="modal" data-bs-target="#EditEventModal">
                <i class="fa fa-pencil-square" aria-hidden="true"></i>
              </a>
              <a href="" data-bs-toggle="modal" data-bs-target="#DeleteEventModal">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>-->
		
		
		<?php
		if(@$eventList){
			foreach(@$eventList as $k => $v){
				
			$category = DB::table('event_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
			$image    = DB::table('event_image')->where(['event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
			
			if(@$v->user_id == 0){
				$userName = 'Admin';
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

		?>
		
			<div class="Card col-lg-3 col-md-3 col-sm-6">
			  <div class="CardInner event-detail"   relid="<?=@$v->id?>" data-bs-toggle="modal" data-bs-target="#DetailsEventModal">
				<div class="Cover"></div>
				<img class="UserImage"
				  src="<?=@$galleryImg?>"
				  alt="">
				<p class="Heading"><?=@$v->event_name?></p>
				<p class="SubHeading"><?=@$userName?></p>
				<p class="SubHeading">Location: <?=substr(@$v->location,0,20)?></p>
				<p class="SubHeading">Date: <?=@$start_date?></p>
				<p class="SubHeading">Time: <?=@$start_time?></p>
				<div class="IconContainer" >
					<a href="javascript:void(0);" class="bookmarkEvent" id="allbookmarkEvent_<?=@$v->id?>" relid="<?=@$v->id?>">
					    <?=@$fav?>
					</a>
					<!--<a href="" data-bs-toggle="modal" data-bs-target="#EditEventModal">
					<i class="fa fa-pencil-square" aria-hidden="true"></i>
					</a>
					<a href="" data-bs-toggle="modal" data-bs-target="#DeleteEventModal">
					<i class="fa fa-trash" aria-hidden="true"></i>
					</a>-->
                </div>
			  </div>
			</div>
		
        <?php		
			}
		}else{
			echo 'Not found any event list.';
		}
		
		?>
      </div>

      <div id="FavoriteEvents" class="row m-0 TabContent">
        <?php
		if(@$myeventList){
			foreach(@$myeventList as $k => $v){
				
			$category = DB::table('event_category')->where(['id' => @$v->category])->select('name')->orderBy('id', 'DESC')->first();
			$image    = DB::table('event_image')->where(['event_id' => @$v->id])->select('*')->orderBy('id', 'DESC')->first();
			
			if(@$v->user_id == 0){
				$userName = 'Admin';
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


		?>
		
			<div class="Card col-lg-3 col-md-3 col-sm-6">
			  <div class="CardInner event-detail-1"   relid="<?=@$v->id?>" data-bs-toggle="modal" data-bs-target="#DetailsEventModal">
				<div class="Cover"></div>
				<img class="UserImage"
				  src="<?=@$galleryImg?>"
				  alt="">
				<p class="Heading"><?=@$v->event_name?></p>
				<p class="SubHeading"><?=@$userName?></p>
				<p class="SubHeading">Location: <?=substr(@$v->location,0,20)?></p>
				<p class="SubHeading">Date: <?=@$start_date?></p>
				<p class="SubHeading">Time: <?=@$start_time?></p>
				<div class="IconContainer">
					<a href="javascript:void(0);" class="bookmarkEvent" id="bookmarkEvent_<?=@$v->id?>" relid="<?=@$v->id?>">
					     <?=@$fav?>
					</a>
					
					<a href="javascript::void(0);" class="edit-event-detail" relid="<?=@$v->id?>" data-bs-toggle="modal" data-bs-target="#EditEventModal">
					    <i class="fa fa-pencil-square" aria-hidden="true"></i>
					</a>
					
					<a href="javascript::void(0);" onclick="deleteEvent(<?= @$v->id ?>)" data-bs-toggle="modal" data-bs-target="#DeleteEventModal-1">
					    <i class="fa fa-trash" aria-hidden="true"></i>
					</a>
				</div>
			  </div>
			</div>
		
        <?php		
			}
		}else{
			echo 'Not found any event list.';
		}
		
		?>
      </div>
    </div>
  </main>

  <div class="overlay"></div>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places"></script>
<link href='<?php echo url("assets/chosen/chosen.min.css"); ?>' rel='stylesheet' type='text/css'>
<script src='<?php echo url("assets/chosen/chosen.jquery.min.js"); ?>' type='text/javascript'></script> 
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
      $('.overlay').show();
      $('nav').toggleClass("open");
    });

    $('.overlay').on('click', function () {
      if ($('nav').hasClass('open')) {
        $('nav').removeClass('open');
      }
      $(this).hide();
    });
  </script>
  <script>
    $(document).ready(function () {
      $('#Promotion').click(function (e) {
        e.preventDefault();
        $('.Section.Promotion').toggle();
        $('.Section.Appearance').hide();
        $('.Section.Event').hide();
        $('.Section.Business').hide();
        $('.Section.Network').hide();
        $('.Section.Subscription').hide();
      });

      $('#Appearance').click(function (e) {
        e.preventDefault();
        $('.Section.Promotion').hide();
        $('.Section.Appearance').toggle();
        $('.Section.Event').hide();
        $('.Section.Business').hide();
        $('.Section.Network').hide();
        $('.Section.Subscription').hide();
      });

      $('#Event').click(function (e) {
        e.preventDefault();
        $('.Section.Promotion').hide();
        $('.Section.Appearance').hide();
        $('.Section.Event').toggle();
        $('.Section.Business').hide();
        $('.Section.Network').hide();
        $('.Section.Subscription').hide();
      });

      $('#Business').click(function (e) {
        e.preventDefault();
        $('.Section.Promotion').hide();
        $('.Section.Appearance').hide();
        $('.Section.Event').hide();
        $('.Section.Business').toggle();
        $('.Section.Network').hide();
        $('.Section.Subscription').hide();
      });

      $('#Network').click(function (e) {
        e.preventDefault();
        $('.Section.Promotion').hide();
        $('.Section.Appearance').hide();
        $('.Section.Event').hide();
        $('.Section.Business').hide();
        $('.Section.Network').toggle();
        $('.Section.Subscription').hide();
      });

      $('#Subscription').click(function (e) {
        e.preventDefault();
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
      document.querySelector('.Promotion').style.display = 'block';
      document.getElementById('Promotion').classList.add('Active');

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
	
	
	
	google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('event_location'));
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
					swal({title: "Sucess!", text: "<strong>"+data.msg+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = "<?=url('dashboard')?>"});
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