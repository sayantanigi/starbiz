<!DOCTYPE html>
<html lang="en">

<head>
  <title>StarBiz</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="<?=url('assets/home/style/style.css')?>">
  <style>
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
          <img src="<?=url('assets/home/Logo/Logo.png')?>" alt="Logo">
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
          <div class="CardInner">
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
          <div class="CardInner">
            <div class="Cover"></div>
            <p class="Heading"><?=@$v->ads_name?></p>
            <p class="SubHeading"><?=strip_tags(@$v->description)?></p>
            <div class="IconContainer">
             <!-- <a href="">
                <i class="fa fa-pencil-square" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>-->
            </div>
          </div>
        </div>
		<?php } }else{
			echo 'Not found any promotion.';
		} ?>
        
		
		
      </div>
    </div>

    <div class="container-fluid m-0 Section Appearance" style="display: none;">
      <div class="row m-0 TabBar">
        <div class="TabContainer">
          <div class="Tab active" onclick="openTab(event, 'AcceptedAppearance')">Accepted</div>
          <div class="Tab" onclick="openTab(event, 'SentAppearance')">Sent</div>
          <div class="Tab" onclick="openTab(event, 'CompletedAppearance')">Rejected</div>
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
				  <a href="">
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
        <?php
			if(@$sent){
				foreach(@$sent as $k => $v){
					
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
				  <a href="">
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

      <div id="CompletedAppearance" class="row m-0 TabContent">
	  
          <?php
			if(@$reject){
				foreach(@$reject as $k => $v){
					
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
				  <a href="">
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
    </div>

    <div class="container-fluid m-0 Section Event" style="display: none;">
      <div class="row m-0 TabBar">
        <div class="TabContainer">
          <div class="Tab active" onclick="openTab(event, 'MyEvents')">All Events</div>
          <div class="Tab" onclick="openTab(event, 'FavoriteEvents')">My Events</div>
        </div>
      </div>

      <div id="MyEvents" class="row m-0 TabContent active">
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

		?>
		
			<div class="Card col-lg-3 col-md-3 col-sm-6">
			  <div class="CardInner">
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
				  <!--<a href="">
					<i class="fa fa-pencil-square" aria-hidden="true"></i>
				  </a>
				  <a href="">
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

		?>
		
			<div class="Card col-lg-3 col-md-3 col-sm-6">
			  <div class="CardInner">
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
				  <!--<a href="">
					<i class="fa fa-pencil-square" aria-hidden="true"></i>
				  </a>
				  <a href="">
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
    </div>
  </main>

  <div class="overlay"></div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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
  </script>
</body>

</html>