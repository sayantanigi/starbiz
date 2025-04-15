<!DOCTYPE html>
<html lang="en">

<head>
<title>StarBiz</title>
<meta charset="UTF-8">
<link rel="shortcut icon" href="<?=url('setting/2019685580.png')?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?=url('assets/home/style/style.css')?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

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
        <a href="" id="Home" class="Active">
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
	  
      <!--<li>
        <a href="" id="Wallet">
          <img src="<?=url('assets/home/images/NavIcon7.png')?>" alt="">
          <p>Wallet</p>
        </a>
      </li>-->
	  
      <li>
        <a href="" id="TransactionsPayment">
          <img src="<?=url('assets/home/images/NavIcon7.png')?>" alt="">
          <p>Transactions & Payment</p>
        </a>
      </li>
	  
      <li>
        <a href="javascript:void(0);" id="Rewards">
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
		
        <!--<div class="header-search">
          <div class="search">
            <i class="material-icons">search</i>
            <input type="search" name="search" placeholder="Search" id="search-box">
			<div id="suggesstion-box"></div>
          </div>
        </div>-->
		
		<div class="header-search">
          <div class="search" data-bs-toggle="modal" data-bs-target="#SearchModal">
            <i class="material-icons">search</i>
            <input type="search" name="search" placeholder="Search">
          </div>
        </div>
		
      </div>
      <div class="header-menu">
        <ul class="ul-base">
          <li><a href="<?=url('dashboard/profile')?>" id="ProfileTab" class="HeaderProfileBtn">Profile</a></li>
		  
           <li><a href="<?=url('logout')?>">Logout</a></li>
        </ul>
      </div>
    </div>
  </header>
  
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
		
		
		$("#Home").click(function () {
			window.location.href = '<?=url('dashboard');?>'; 
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
		
		
	</script>