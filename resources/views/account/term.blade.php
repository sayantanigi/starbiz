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
      <li>
        <a href="<?=url('dashboard/stripe-connect')?>" id="ManageSubscription" >
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
          <li><a href="">Profile</a></li>
           <li><a href="<?=url('logout')?>">Logout</a></li>
        </ul>
      </div>
    </div>
  </header>

    <main role="main" class="Main">
    	<div class="container-fluid m-0 Section TermsConditions" >
      <div class="row m-0 TabBar mb-2">
        <div class="Pagination TabBar">
          <a href="<?=url('dashboard')?>"><i class="fa fa-angle-left" aria-hidden="true"></i> Home / TermsConditions</a>
        </div>
      </div>

      <div class="row m-0">
        <div class="col-lg-12 col-md-4 mb-4 TermsConditionsData">
		 
          <div class="DataBlock pt-0">
            <h1><?=@$cms->heading?> for StarBiz</h1>
            <p class="m-0"><?=@$cms->description?></p>
          </div>
          <!--<div class="DataBlock">
            <h1>1. Acceptance of Terms</h1>
            <p class="m-0">By using StarBiz, you confirm that you are at least 18 years old and capable of entering into
              a legally binding agreement. If you are using StarBiz on behalf of a company or organization, you
              represent that you have the authority to bind them to these Terms.
            </p>
          </div>
          <div class="DataBlock">
            <h1>2. Event Creation and Management</h1>
            <ul>
              <li><b>Accuracy of Information:</b> When creating events, you must provide accurate and truthful details,
                including event name, description, location, date, time, and ticket pricing (if applicable).</li>
              <li><b>Prohibited Content:</b> Events that promote illegal activities, hate speech, discrimination, or
                content deemed offensive by StarBiz are strictly prohibited. We reserve the right to remove such events
                without prior notice.</li>
              <li><b>Compliance:</b> Event creators are responsible for ensuring their events comply with local, state,
                and federal laws, including obtaining any necessary permits or licenses.</li>
              <li><b>Compliance:</b> Event creators are responsible for ensuring their events comply with local, state,
                and federal laws, including obtaining any necessary permits or licenses.</li>
              <li><b>Compliance:</b> Event creators are responsible for ensuring their events comply with local, state,
                and federal laws, including obtaining any necessary permits or licenses.</li>
              <li><b>Compliance:</b> Event creators are responsible for ensuring their events comply with local, state,
                and federal laws, including obtaining any necessary permits or licenses.</li>
            </ul>
          </div>
          <div class="DataBlock">
            <h1>3. Privacy and Data Use</h1>
            <ul>
              <li><b>User Data:</b> By using StarBiz, you consent to our collection and use of personal data as outlined
                in our Privacy Policy.</li>
              <li><b>Sharing Information:</b> Event creators may access attendee information necessary for event
                management but must use it solely for event-related purposes.</li>
            </ul>
          </div>
          <div class="DataBlock">
            <h1>4. Intellectual Property</h1>
            <ul>
              <li><b>Ownership:</b> StarBiz owns all rights, titles, and interests in the platform, including its
                design, features, and content.</li>
              <li><b>User Content:</b> By submitting content to StarBiz, you grant us a non-exclusive, worldwide,
                royalty-free license to use, reproduce, display, and distribute your content for the purposes of
                platform operation and promotion.</li>
            </ul>
          </div>
          <div class="DataBlock">
            <h1>5. Termination of Use</h1>
            <ul>
              <li><b>By StarBiz:</b> We reserve the right to terminate your account or restrict access to the platform
                for violations of these Terms or other inappropriate conduct.</li>
              <li><b>By User:</b> You may terminate your account at any time by contacting StarBiz support.</li>
            </ul>
          </div>
          <div class="DataBlock">
            <h1>6. Indemnification</h1>
            <p class="m-0">You agree to indemnify and hold StarBiz harmless from any claims, liabilities, damages, or
              expenses arising from your use of the platform, your event-related activities, or your violation of these
              Terms.</p>
          </div>
          <div class="DataBlock border-0">
            <h1>7. Contact Us</h1>
            <p class="m-0 pb-3">If you have questions or concerns regarding these Terms, please contact us:</p>
            <ul>
              <li><b>Email:</b> support@starbiz.com</li>
              <li><b>Phone:</b> +1 1234-5678-90</li>
              <li><b>Address:</b> Address Details</li>
            </ul>
          </div>-->
		  
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
			dataType: 'json',
			success: function(response) {
				//$('#userProfile').html(response);
				$('#profileUser').html(response.output);
				$('#Info').html(response.info);
				
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

