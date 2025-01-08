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
</head>

<body>
  
<nav class="sidebar">
    <div class="nav-header">
      <div class="logo-wrap">
        <a class="logo-text" href="">StarBiz</a>
      </div>
      <a href="javascipt:void(0)" class="NavHeaderCloseIcon">
        <img src="<?=url('assets/home/images/Icon8.png')?>" alt="">
      </a>
    </div>
    <ul class="nav-categories ul-base">
      <li>
        <a href="<?=url('dashboard')?>" id="Home1" class="Active">
          <img src="<?=url('assets/home/images/NavIcon1.png')?>" alt="">
          <p>Home</p>
        </a>
      </li>
      <li>
        <a href="" id="UpcomingEvents">
          <img src="<?=url('assets/home/images/NavIcon2.png')?>" alt="">
          <p>Upcoming Events</p>
        </a>
      </li>
      <li>
        <a href="" id="ReferralLink">
          <img src="<?=url('assets/home/images/NavIcon3.png')?>" alt="">
          <p>Referral Link</p>
        </a>
      </li>
     <!-- <li>
        <a href="" id="ManageSubscription">
          <img src="<?=url('assets/home/images/NavIcon4.png')?>" alt="">
          <p>Manage Subscription</p>
        </a>
      </li>-->
	  
	  <li>
        <a href="<?=url('dashboard/stripe-connect')?>" id="ManageSubscription">
          <img src="<?=url('assets/home/images/NavIcon4.png')?>" alt="">
          <p>Manage Stripe </p>
        </a>
      </li>
      <li>
        <a href="" id="SaleList">
          <img src="<?=url('assets/home/images/NavIcon5.png')?>" alt="">
          <p>Sale List</p>
        </a>
      </li>
      <li>
        <a href="" id="PurchaseHistory">
          <img src="<?=url('assets/home/images/NavIcon6.png')?>" alt="">
          <p>Purchase History</p>
        </a>
      </li>
      <li>
        <a href="" id="Wallet">
          <img src="<?=url('assets/home/images/NavIcon7.png')?>" alt="">
          <p>Wallet</p>
        </a>
      </li>
      <li>
        <a href="" id="TransactionsPayment">
          <img src="<?=url('assets/home/images/NavIcon7.png')?>" alt="">
          <p>Transactions & Payment</p>
        </a>
      </li>
      <li>
        <a href="" id="Rewards">
          <img src="<?=url('assets/home/images/NavIcon8.png')?>" alt="">
          <p>Rewards</p>
        </a>
      </li>
      <li>
        <a href="javascript:void(0);" id="TermsConditions">
          <img src="<?=url('assets/home/images/NavIcon9.png')?>" alt="">
          <p>Terms & Conditions</p>
        </a>
      </li>
    </ul>
  </nav>
  
  <header>
    <div class="header-inner">
      <div class="header-first-inner">
        <div class="nav-btn nav-slider">
          <i class="material-icons">menu</i>
        </div>
        <div class="header-logo">
          <a href="<?=url('dashboard')?>"><img alt="logo" src="<?=url('assets/home/Logo/Logo.png')?>"></a>
        </div>
        <div class="header-search">
          <div class="search" data-bs-toggle="modal" data-bs-target="#SearchModal">
            <i class="material-icons">search</i>
            <input type="search" name="search" placeholder="Search">
          </div>
        </div> 
      </div>
      <div class="header-menu">
        <ul class="ul-base">
          <li><a href="<?=url('dashboard/profile')?>">Profile</a></li>
           <li><a href="<?=url('logout')?>">Logout</a></li>
        </ul>
      </div>
    </div>
  </header>

    <main role="main" class="Main">
    
     

    <div class="container-fluid m-0 Section NetworkProfile" >
	
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
	
	 <!-- Advertise Modal -->
      <div class="modal fade CustomModal" id="AdvertiseModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Advertisement</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="row g-3 AddAdvertisement-1" id="advsPlan" method="post" enctype="multipart/form-data">
                <div class="col-md-6 col-sm-12">
                  <label class="form-label">Title</label>
                  <input type="text" placeholder="Enter title" name="title" id="title" required>
                </div>
                <div class="col-md-6 col-sm-12">
                  <label class="form-label">Upload File</label>
                  <input type="file" class="form-control" id="inputGroupFile01" name="ads_img" required>
                </div>
              

			  
			<div class="modal-footer">
              <div class="AddAdvertisementFooter">
                <button type="submit" class="btn btn-primary SelectPlanBtn">Select Promotion Plan</button>
              </div>
          
              <!--<div class="AddAdvertisementPlanFooter">
                <button type="button" class="btn btn-primary SelectPlanDetailsBtnBack">Back</button>
                <button type="button" class="btn btn-primary SelectPlanDetailsBtn">Pay & Post Promotion</button>
              </div>

              <div class="AddAdvertisementPlanDetailsFooter">
                <button type="button" class="btn btn-primary SelectPlanWholeDetailsBtnBack">Back</button>
              </div>-->
            </div>
			</form>
            </div>
          </div>
        </div>
      </div>
      <!-- Advertise Modal -->
	  
	  
	  <!-- Advertise Modal -->
      <div class="modal fade CustomModal" id="AdvertiseSubModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Advertisement</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 AddAdvertisementPlan" id="AddAdvertisementPlan" method="post" enctype="multipart/form-data">
					<div class="col-lg-12 col-md-12 col-sm-12 AddAdvertisementPlanContainer">
						<?php
							if(count(@$AdvsPlan) > 0){
								foreach(@$AdvsPlan as $k => $v){
									
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
												<p class="m-0">$50/month</p>
											  </div>
											  <ul>
												'.@$out.'
											  </ul>
											  <div class="SubscriptionBtnContainer">
												<a href="javascript:void(0)" class="SubscriptionBtn ChooseBtn">
												  <!--<p>Choose</p>-->
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

					<div class="col-md-6 col-sm-12">
						<label class="form-label">Enter Duration</label>
						<input type="text" placeholder="Enter Duration" id="duration" name="duration">
						<input type="hidden" id="adsId" name="adsId">
					</div>
					
					<div class="col-md-6 col-sm-12">
					  <label class="form-label">Preferred Listing</label>
						<select  id="preferredListing" name="preferredListing">
							<option selected value="">Choose a category</option>
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
					</div>
					
					<div class="modal-footer">
						<!--<div class="AddAdvertisementFooter">
						<button type="submit" class="btn btn-primary SelectPlanBtn">Select Promotion Plan</button>
						</div>-->

						<div class="AddAdvertisementPlanFooter">
							<button type="button" class="btn btn-primary SelectPlanDetailsBtnBack">Back</button>
							<button type="submit" class="btn btn-primary SelectPlanDetailsBtn">Pay & Post Promotion</button>
						</div>

						<!--<div class="AddAdvertisementPlanDetailsFooter">
						<button type="button" class="btn btn-primary SelectPlanWholeDetailsBtnBack">Back</button>
						</div>-->
					</div>
              </form>
			
            </div>

           
			
          </div>
        </div>
      </div>
      <!-- Advertise Modal -->
	  
	  

      <div class="row m-0 TabBar">
        <div class="TabBar">
          <div class="Pagination">
            <a href="" id="Home"><i class="fa fa-angle-left" aria-hidden="true"></i> Home / Profile</a>
          </div>

            <div class="row m-0" style="background: #fff;" id="profileUser">
		        <?php
					if(!empty(@$userInfo->profile_image) && file_exists('public/profile/'.@$userInfo->profile_image.'')){
						$profilePic = url('profile/'.@$userInfo->profile_image.'');
					}else{
						$profilePic = url('profile/unnamed.jpg');
					}
					
					if(!empty(@$userInfo->dob) && @$userInfo->dob != '0000-00-00'){
						$dob = date('d F Y', strtotime(@$userInfo->dob));
					}else{
						$dob = '';
					}
					$interestTgas = '';
					if(@$userInfo->area_interest){
						$exInterest = explode(",", @$userInfo->area_interest);
						foreach($exInterest as $k => $v){
							$interest  = DB::table('interest')->where(['id' => @$v])->select('*')->first();
							$interestTgas.='<li>'.@$interest->name.'</li>';
						}
					}
					
					$userType = '';
					if(@$userInfo->user_type == 8){
						$userType = 'SERVICE PROVIDER';
					}elseif(@$userInfo->user_type == 10){
						$userType = 'A & E';
					}
					
					$Sql = "SELECT advertise.id as advsId, advertise.title, advertise.image, advertise.status, transaction.adv_id, transaction.adv_sub_id, transaction.adv_user_id FROM advertise INNER JOIN transaction ON advertise.id = transaction.adv_id WHERE advertise.status='1' AND transaction.adv_user_id='".@$userInfo->id."' AND transaction.expiry_date >= '".date('Y-m-d')."'";
					$bannerAdvs = DB::select($Sql);
					
					$banner_Advs = '';
					
				?>
                <div class="col-lg-9 col-md-9 col-sm-12 UserProfileDataContainer">
			
						<div id="carouselExampleControls" class="carousel slide AddBanner" data-bs-ride="carousel">
							<div class="carousel-inner">
							  
							  <?php
								if(count(@$bannerAdvs) > 0){
									$i = 1;
									foreach(@$bannerAdvs as $k => $v){
										if(!empty(@$v->image) && file_exists('public/ads/'.@$v->image.'')){
											echo $banner_Advs='
												<div class="carousel-item '.((@$i == 1) ? 'active' : '').'">
													<img style="height: 250px !important; border-radius: 20px;" src="'.url('ads/'.@$v->image.'').'"
													  class="d-block w-100 object-fit-cover" alt="">
												</div>
											';
										}else{
											echo $banner_Advs='
												<div class="carousel-item ">
													<img style="height: 250px !important; border-radius: 20px;" src="'.url('bnr.jpg').'"
													  class="d-block w-100 object-fit-cover" alt="">
												</div>
											';
										}
										$i++;
									}
								}else{
									echo $banner_Advs='<img class="AddBanner" src="'.url('bnr.jpg').'" alt="">';
								}
							  ?>
							</div>
							
							
						  </div>
					 
					  <a href="" class="LikeBtnBlock">
						<img src="<?=url('assets/home/images/Icon29.png')?>" alt="">
					  </a>
					  <img class="UserProfileImg" src="<?=@$profilePic?>" alt="">
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-12 UserDataContainer">
					  <div>
						<p class="m-0 UserName"><?=@$userInfo->first_name.' '.@$userInfo->last_name?></p>
						<p class="m-0 UserNameTag"><?=@$userType?></p>
					  </div>
					  <a href="" class="UserAddBtn" data-bs-toggle="modal" data-bs-target="#AdvertiseModal">
						<p class="m-0">Advertise</p>
					  </a>
					</div>
			
            </div>

          <div class="TabContainer">
            <div class="Tab active" onclick="openTab(event, 'Info')">Info</div>
            <div class="Tab" onclick="openTab(event, 'Photos')">Photos</div>
            <div class="Tab" onclick="openTab(event, 'Events')">Events</div>
          </div>
        </div>

        <div id="Info" class="row m-0 TabContent active">
         <div class="col-lg-12 col-md-12 col-sm-12">
			<div class="ProfileDataBlock">
			  <p class="m-0 HeadingText">About me</p>
			  <p class="m-0 SubHeadingText"><?=@$userInfo->bio?></p>
			</div>
			<div class="ProfileDataBlock">
			  <p class="m-0 HeadingText">Basic info</p>
			  <p class="m-0 SubHeadingText">Birthday: <?=@$dob?></p>
			</div>
			<div class="ProfileDataBlock">
			  <p class="m-0 HeadingText">Interest</p>
				<ul>
				    <?=@$interestTgas?>
				</ul>
			</div>
		  </div>
        </div>

        <div id="Photos" class="row m-0 TabContent">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="EventPhotoContainer">
			    <?php
			        $gallery  = DB::table('user_gallery_photo')->where(['user_id' => @$userInfo->id])->select('*')->get();
					//print_r($gallery);
				   
				    if(count($gallery) > 0){
					    foreach($gallery as $k => $v){
							
							if(!empty(@$v->image) && file_exists('public/photos/'.@$v->image.'')){
								$galleryPhoto = url('photos/'.@$v->image.'');
								echo '
									<a href="javascript:void(0);" class="usersPhotos" relid="'.@$userInfo->id.'" data-bs-toggle="modal" data-bs-target="#BusinessPhotosModal"><img src="'.@$galleryPhoto.'" alt=""></a>
						        ';
							}
						  
					    }
				    }
			    ?>
              
			  
             
            </div>
          </div>
        </div>

        <div id="Events" class="row m-0 TabContent">
		    <?php
		       $Sql = "SELECT * FROM events WHERE status='1' AND user_id='".@$userInfo->id."' ORDER BY DATE(start_date) ASC";
			   $myEvents = DB::select($Sql);
			   //print_r($myEvents);
			    if(count(@$myEvents)){
				    foreach($myEvents as $k => $v){
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
						  <div class="CardInner event-detail-1"  style="background:url('.@$galleryImg.') no-repeat center center / cover;"  relid="'.@$v->id.'" data-bs-toggle="modal" data-bs-target="#DetailsMyEventModal" block="one">
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
			    }
			   
		    ?>
          
		  
        </div>
      </div>
	  
    </div>
    </main>
	
	<!-- Search Modal -->
    <div class="modal fade CustomModal" id="SearchModal" data-bs-backdrop="static" data-bs-keyboard="false"
      tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Search</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3">
              <div class="col-md-12 col-sm-12">
                <input class="w-100" placeholder="What are you searching for?" id="search-box" name="search">
              </div>
            </form>
          </div>
          <div class="modal-footer" id="suggesstion-box">
		  
            <!--<div class="col-md-12 col-sm-12 SearchDataContainer">
              <a href="">
                <div class="SearchDataBlock">
                  <img class="ActiveImg" src="<?=url('assets/home/images/Icon17.png')?>" alt="">
                </div>
                <p>Event Name</p>
              </a>
            </div>
			
            <div class="col-md-12 col-sm-12 SearchDataContainer">
              <a href="">
                <div class="SearchDataBlock">
                  <img class="ActiveImg" src="<?=url('assets/home/images/Icon17.png')?>" alt="">
                </div>
                <p>Business Name</p>
              </a>
            </div>
			
            <div class="col-md-12 col-sm-12 SearchDataContainer">
              <a href="">
                <div class="SearchDataBlock">
                  <img class="ActiveImg" src="<?=url('assets/home/images/Icon17.png')?>" alt="">
                </div>
                <p>Network Name</p>
              </a>
            </div>-->
			
          </div>
        </div>
      </div>
    </div>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
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
	  
	  $('.NetworkProfile-1').click(function (e) {
        e.preventDefault();
        $('.Section').hide();
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
        $('.Section.Subscription').hide();
        $('.Section.BuyNowSection').hide();
        $('.Section.NetworkProfile').toggle();
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
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
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
	
	$(document.body).on('change', '.quantity' ,function(){ 
		var id = $(this).attr('relid');
		var action = 'change';
		var quantity = $(this).val();
		$.ajax({
			type: 'POST',
			url: '<?php echo url('dashboard/change'); ?>',
			data: {id : id, action : action, quantity :quantity, "_token": "{{ csrf_token() }}"} ,
			dataType:"json",
			error:function(){
			$('#uploadsuccessfully').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
			},
			success: function(data){ 
			    if(data.status = 1){
					//window.location.href = '<?=url('dashboard/addtoCart');?>';
				}
			}
		});
	});
	
	$(document.body).on('click', '.remove' ,function(){ 
		var id = $(this).attr('relid');
		var action = 'remove';
		// console.log(id);
		// return false;;
		$.ajax({
			type: 'POST',
			url: '<?php echo url('dashboard/remove_product'); ?>',
			data: {id : id, action : action, "_token": "{{ csrf_token() }}"} ,
			dataType:"json",
			error:function(){
			$('#uploadsuccessfully').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
			},
			success: function(data){ 
			    if(data.status = 1){
					//window.location.href = '<?=url('dashboard/addtoCart');?>'; 
				}
			}
		});
	});
	
	$(".bookmarkUsers").click(function () {
		var userId = $(this).attr('relid');
		//console.log(businessId);
		$.ajax({
			url: "<?=url('dashboard/addRemoveBookmarkUsers')?>",
			method: "POST",
			data:{userId : userId, "_token": "{{ csrf_token() }}"},
			dataType: 'JSON',
			success: function(response) {
				
				if(response.status == 1){
					$('#bookmarkUsers_'+userId+'').html('<i class="fa fa-heart" aria-hidden="true"></i>');
					$('#allbookmarkUsers_'+userId+'').html('<i class="fa fa-heart" aria-hidden="true"></i>');
				}else if(response.status == 2){
					$('#bookmarkUsers_'+userId+'').html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
					$('#allbookmarkUsers_'+userId+'').html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
				}
				
			}
			
		});
			
	});
	
	
	$(".NetworkProfile-1").click(function () {
		var userId = $(this).attr('relid');
		
			$.ajax({
			url: "<?=url('dashboard/get_user_profileInfo')?>",
			method: "POST",
			data:{userId : userId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
				//$('#userProfile').html(response);
				$('#profileUser').html(response);
				$('#Info').html(response.info);
				// $.scrollTo("#carouselExampleControls", 200);
			}
			
		});	
	});
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const sections = {
        advertisement: {
          data: document.querySelector(".AddAdvertisement"),
          footer: document.querySelector(".AddAdvertisementFooter"),
          title: "Add Advertisement",
        },
        plan: {
          data: document.querySelector(".AddAdvertisementPlan"),
          footer: document.querySelector(".AddAdvertisementPlanFooter"),
          title: "Select Plan",
        },
        plandetails: {
          data: document.querySelector(".AddAdvertisementPlanDetails"),
          footer: document.querySelector(".AddAdvertisementPlanDetailsFooter"),
          title: "Plan Details",
        },
      };

      const modalTitle = document.querySelector("#AdvertiseModal .modal-title");

      const selectPlanBtn = document.querySelector(".AddAdvertisementFooter .SelectPlanBtn");
      const selectPlanDetailsBtn = document.querySelector(".AddAdvertisementPlanFooter .SelectPlanDetailsBtn");
      const selectPlanDetailsBtnBack = document.querySelector(".AddAdvertisementPlanFooter .SelectPlanDetailsBtnBack");
      const selectPlanWholeDetailsBtnBack = document.querySelector(".AddAdvertisementPlanDetailsFooter .SelectPlanWholeDetailsBtnBack");

      function switchSection(target) {
        Object.values(sections).forEach((section) => {
          section.data.style.display = "none";
          section.footer.style.display = "none";
        });

        const targetSection = sections[target];
        if (targetSection) {
          targetSection.data.style.display = "flex";
          targetSection.footer.style.display = "flex";
          modalTitle.textContent = targetSection.title;
        }
      }

      switchSection("advertisement");

      selectPlanBtn.addEventListener("click", () => switchSection("plan"));
      selectPlanDetailsBtn.addEventListener("click", () => switchSection("plandetails"));
      selectPlanDetailsBtnBack.addEventListener("click", () => switchSection("advertisement"));
      selectPlanWholeDetailsBtnBack.addEventListener("click", () => switchSection("plan"));
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
	
	
$(document).ready(function(){
	$("#advsPlan").on('submit', function(e){
		e.preventDefault();	
		var form_data = new FormData(); 
		
		var fileToUpload = document.getElementById('inputGroupFile01').files[0];
		var title = $('#title').val(); 
		form_data.append("ads_image", fileToUpload);
		form_data.append("title", title);



		$.ajax({
			headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},	
			type: 'POST',
			url: '<?php echo url('dashboard/saveAdvs'); ?>',
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
					$("#AdvertiseSubModal").modal("show");
					$("#AdvertiseModal").modal("hide");
				}
				if(data.status == 0){
					swal({title: "Fail!", text: "<strong>"+data.msg+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
				}
				
			}
		});
	});
	
	$("#AddAdvertisementPlan").on('submit', function(e){
		e.preventDefault();	
		var form_data = new FormData();

		var preferredListing   = $('#preferredListing').val(); 
		var duration   = $('#duration').val(); 
		var subId   = $('#subId').val(); 
		var adsId   = $('#adsId').val(); 
		var userId   = '<?=session()->get('USERLOGINID')?>';

        window.location.href = "<?=url('dashboard/advertisement/?')?>userId="+userId+"&planId="+subId+"&adsId="+adsId+"&preferredListing="+preferredListing+"&duration="+duration+"";
	});

});


$(document.body).on('click', '.usersPhotos' ,function(){ 
		//alert("success");
		var userId = $(this).attr('relid');
		$.ajax({
			url: "<?=url('dashboard/get_user_photo')?>",
			method: "POST",
			data:{userId : userId, "_token": "{{ csrf_token() }}"},
			dataType: 'text',
			success: function(response) {
				$('#business-gallery-model').html(response);
			}
			
		});	
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
  </script>
</body>

</html>

