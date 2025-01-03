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
    .price-sec-wrap {
			width: 100%;
			float: left;
			padding: 200px 0;
			font-family: 'Lato', sans-serif;
		}
		.main-heading {
			text-align: center;
		    font-weight: 600;
		    padding-bottom: 15px;
		    position: relative;
		    text-transform: capitalize;
		    font-size: 24px;
		    margin-bottom: 25px;
		}
		.price-box {
			box-shadow: 0 0 35px rgba(0, 0, 0, 0.10);
			padding: 20px;
			background: #fff;
    		border-radius: 4px;
		}
		.price-box ul {
    		padding: 10px 0px 30px;
		    margin: 17px 0 0 0;
		    list-style: none;
		    border-top: solid 1px #e9e9e9;
		}
		.price-box ul li {
			padding: 7px 0;
		    font-size: 14px;
		    color: #808080;
		}
		.price-box ul li .fas {
			color: #68AE4A;
			margin-right: 7px; 
			font-size: 12px;
		}
		.price-label {
			font-size: 16px;
		    font-weight: 600;
		    line-height: 1.34;
		    margin-bottom: 0;
		    padding: 6px 15px;
		    display: inline-block;
		    border-radius: 3px; 
		}
		.price-label.basic {
		    background: #E8EAF6;
		    color: #3F51B5;
		}
		.price-label.value {
		    background: #E8F5E9;
		    color: #4CAF50;
		}
		.price-label.premium {
		    background: #FBE9E7;
		    color: #FF5722;
		}
		.price {
			font-size: 44px;
		    line-height: 44px;
		    margin: 15px 0 6px;
		    font-weight: 900;
		}
		.price-info {
			font-size: 14px;
		    font-weight: 400;
		    line-height: 1.67;
		    color: inherit;
		    width: 100%;
		    margin: 0;
		    color: #989898;
		}
		.plan-btn {
		  text-transform: uppercase;
		  font-weight: 600;
		  display: block;
		  padding: 11px 30px;
		  border: 2px solid #b3b3b3;
		  color: #000;
		  margin-top: 5px;
		  overflow: hidden;
		  position: relative;
		  z-index: 1;
		  margin: 0;
		  border-radius: 5px;
		  text-decoration: none;
		  width: 100%;
		  text-align: center;
		  font-size: 14px;
		}
		.plan-btn::after {
		  position: absolute;
		  left: -100%;
		  top: 0;
		  content: "";
		  height: 100%;
		  width: 100%;
		  background: #b58b42;
		  z-index: -1;
		  transition: all 0.35s ease-in-out;
		}
		.plan-btn:hover::after {
		  left: 0;
		}
		.plan-btn:hover, 
		.plan-btn:focus {
			text-decoration: none;
			color: #fff;
		  border: 2px solid #b58b42;
		}
		@media (max-width: 991px) {
			.price-box {
				margin-bottom: 20px;
			}
		}
		@media (max-width: 575px) {
			.main-heading {
				font-size: 21px;
			}
			.price-box {
				margin-bottom: 20px;
			}
		}
  </style>
</head>

<body>
  <!--<nav class="sidebar">
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
  </nav>-->

  <header>
    <div class="header-inner">
      <div class="header-first-inner">
        <div class="nav-btn nav-slider">
          <!--<i class="material-icons">menu</i>-->
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
    

<div class="price-sec-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="main-heading">Subscription Plan</div>
                </div>
            </div>
            <div class="row">
			    <?php
				    if(count(@$plan) > 0){
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
							foreach($nav as $k1 => $v1){
							//$eventImg[] = ['image' => url('events/'.$v->image.'')];
							//$nav1[] = [$k1 => $v1];
							  $out.= '<li> <i class="fa fa-check"></i> '.@$v1.' </li>';
							}
					
					       
						   $output = '';
						    $perMenu = DB::table('sub_permision_menu')->where(['sub_id' => $v->id])->select('*')->get();
						    if(count($perMenu) > 0){
							    foreach($perMenu as $perKey => $perey){
									$menu = DB::table('sub_access_menu')->where(['id' => $perey->menu_id])->select('*')->first();
									
									if($perey->read_access){
										$read = '<i class="fa fa-check" aria-hidden="true"></i>';
									}else{
										$read = '<i class="fa fa-close" aria-hidden="true"></i>';
									}
									
									if($perey->write_access){
										$write = '<i class="fa fa-check" aria-hidden="true"></i>';
									}else{
										$write = '<i class="fa fa-close" aria-hidden="true"></i>';
									}
									
									if($perey->full_access){
										$full = '<i class="fa fa-check" aria-hidden="true"></i>';
									}else{
										$full = '<i class="fa fa-close" aria-hidden="true"></i>';
									}
									
									
									$output.='
									    <tr>
											<td style="color: #808080;font-size: 13px;">'.@$menu->menu.'</td>
											<td style="color: #808080;font-size: 13px;">'.@$read.'</td>
											<td style="color: #808080;font-size: 13px;">'.@$write.'</td>
											<td style="color: #808080;font-size: 13px;">'.@$full.'</td>
										</tr>
									';
								}
						    }
						   
							echo '
								<div class="col-lg-4">
									<div class="price-box">
										<div class="">
											<div class="price-label basic">'.@$v->name.'</div>
											<div class="price">$ '.@$v->amount.'</div>
											<div class="price-info">Per '.$v->duration.' '.$type.'.</div>
										</div>
										<div class="info">
											<ul>
												'.@$out.'
												
											</ul>
											
											<table class="table" cellspacing="0">
												<thead>
													<tr>
														<th></th>
														<th style="color: #808080;font-size: 13px;">Read</th>
														<th style="color: #808080;font-size: 13px;">Write</th>
														<th style="color: #808080;font-size: 13px;">Full</th>
													</tr>
												</thead>
												<tbody>
												
													'.@$output.'
													
												</tbody>
											</table>
								
											<a href="'.url('subscription/payment?amt='.@$v->amount.'&subId='.@$v->id.'').'" class="plan-btn">Join Basic Plan</a>
										</div>
									</div>
								</div>
							';
						}
					}
				?>
                
				
                <!--<div class="col-lg-4">
                    <div class="price-box">
                        <div class="">
                        	<div class="price-label value">Value Plan</div>
                        	<div class="price">$ 10.99</div>
                        	<div class="price-info">Per Month, Inlc GST.</div>
                        </div>
                        <div class="info">
                            <ul>
                                <li><i class="fas fa-check"></i>5k Searchable messages</li>
								<li><i class="fas fa-check"></i>10 custom Apps/services</li>
								<li><i class="fas fa-check"></i>Minimum 3 users, max 10 users</li>
								<li><i class="fas fa-check"></i>1 Voice and video call</li>
                            </ul>
                            <a href="#" class="plan-btn">Join Value Plan</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="price-box">
                        <div class="">
                        	<div class="price-label premium">Premium Plan</div>
                        	<div class="price">$ 15.99</div>
                        	<div class="price-info">Per Month, Inlc GST.</div>
                        </div>
                        <div class="info">
                            <ul>
                                <li><i class="fas fa-check"></i>5k Searchable messages</li>
								<li><i class="fas fa-check"></i>10 custom Apps/services</li>
								<li><i class="fas fa-check"></i>Minimum 3 users, max 10 users</li>
								<li><i class="fas fa-check"></i>1 Voice and video call</li>
                            </ul>
                            <a href="#" class="plan-btn">Join Premium Plan</a>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</main>

</body>

</html>	