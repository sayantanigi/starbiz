<?php
    $menuId = [];
    $roles = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID')])->select('*')->orderBy('id', 'DESC')->get();
	foreach($roles as $k => $v){
		$menuId[] = $v->menu_id;
		
	}
?>
<div data-simplebar class="sidebar-menu-scroll">

    <div id="sidebar-menu">
       
       <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>
            <li class="<?= (!empty($page) && $page == 'dashboard')? 'mm-active' : ''; ?>"><a href="<?=url('admin/dashboard')?>" class="waves-effect"><i class="fas fa-home"></i> Dashboard</a></li>
			<?php if(!empty(session()->get('ROLE_ID')) && session()->get('ROLE_ID') == 1111){ ?>
			<li class="<?= (!empty($page) && $page == 'cms')? 'mm-active' : ''; ?>">
                <a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'cms')? 'mm-active' : ''; ?>">
                   <i class="fa fa-bookmark"></i>
                   <span>CMS</span>
                </a>
               <ul class="sub-menu" aria-expanded="true"> 
                    
					<li class="<?= (!empty($subpage) && $subpage == 'about-us')? 'mm-active' : ''; ?>">
                        <a href="<?=url('admin/cms/about-us')?>" class="<?= (!empty($subpage) && $subpage == 'about-us')? 'active' : ''; ?>">
                            <span class="hide-menu">About Us</span>
                        </a>
                    </li>
					
				    <li class="<?= (!empty($subpage) && $subpage == 'privacy-policy')? 'mm-active' : ''; ?>">
                        <a href="<?=url('admin/cms/privacy-policy')?>" class="<?= (!empty($subpage) && $subpage == 'privacy-policy')? 'active' : ''; ?>">
                            <span class="hide-menu">Privacy Policy</span>
                        </a>
                    </li>
					
					<li class="<?= (!empty($subpage) && $subpage == 'term-condition')? 'mm-active' : ''; ?>">
                        <a href="<?=url('admin/cms/term-and-condition')?>" class="<?= (!empty($subpage) && $subpage == 'term-condition')? 'active' : ''; ?>">
                            <span class="hide-menu">Term & Condition</span>
                        </a>
                    </li>
					
					<li class="<?= (!empty($subpage) && $subpage == 'faq')? 'mm-active' : ''; ?>">
                        <a href="<?=url('admin/cms/faq')?>" class="<?= (!empty($subpage) && $subpage == 'faq')? 'active' : ''; ?>">
                            <span class="hide-menu">FAQ</span>
                        </a>
                    </li>

               </ul>
            </li>
			<?php } ?>
			
			<?php if(!empty(session()->get('ROLE_ID')) && session()->get('ROLE_ID') == 1111){ ?>
			<li class="<?= (!empty($page) && $page == 'access-mng')? 'mm-active' : ''; ?>">
                <a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'access-mng')? 'mm-active' : ''; ?>">
                   <i class="fa fa-bookmark"></i>
                   <span> Access Management</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
				
                    <li class="<?= (!empty($subpage) && $subpage == 'access-mng')? 'mm-active' : ''; ?>">
                        <a href="<?=url('admin/access-management/add')?>" class="<?= (!empty($subpage) && $subpage == 'access-mng')? 'active' : ''; ?>">
                            <span class="hide-menu">Add Access</span>
                        </a>
                    </li>
					
					<li class="<?= (!empty($subpage) && $subpage == 'access-mng1')? 'mm-active' : ''; ?>">
                        <a href="<?=url('admin/access-management/userlist')?>" class="<?= (!empty($subpage) && $subpage == 'access-mng1')? 'active' : ''; ?>">
                            <span class="hide-menu"> Admin/Subadmin List</span>
                        </a>
                    </li>
					
                </ul>
            </li>
			<?php } ?>
			
			<li class="<?= (!empty($page) && $page == 'banner')? 'mm-active' : ''; ?>">
                <a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'banner')? 'mm-active' : ''; ?>">
                   <i class="fa fa-bookmark"></i>
                   <span> Banner Management</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
				
                    <li class="<?= (!empty($subpage) && $subpage == 'banner')? 'mm-active' : ''; ?>">
                        <a href="<?=url('admin/banner')?>" class="<?= (!empty($subpage) && $subpage == 'banner')? 'active' : ''; ?>">
                            <span class="hide-menu">Banner List</span>
                        </a>
                    </li>
                </ul>
            </li>
			
			<?php if(in_array(5,$menuId) || in_array(6,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'users')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'users')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Users Management</span>
				    </a>
				    <ul class="sub-menu" aria-expanded="true">
				   
				        <?php if(in_array(5,$menuId)){ ?>
						    <?php
						        $userTypeMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 5])->select('*')->orderBy('id', 'DESC')->first();
						    ?>
							
							<?php if($userTypeMenu->view == 1){ ?>
								<li class="<?= (!empty($subpage) && $subpage == 'user-type')? 'mm-active' : ''; ?>" >
									<a href="<?=url('admin/user-type')?>" class="<?= (!empty($subpage) && $subpage == 'user-type')? 'active' : ''; ?>">
										<span class="hide-menu">User Type</span>
									</a>
								</li>
							<?php } ?>
							
							
						<?php } ?>
						
					    <?php if(in_array(6,$menuId)){ ?>
						
						    <?php
						        $usereMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 6])->select('*')->orderBy('id', 'DESC')->first();
						    ?>
							<?php if($usereMenu->view == 1){ ?>
								<li class="<?= (!empty($subpage) && $subpage == 'users')? 'mm-active' : ''; ?>">
									<a href="<?=url('admin/users')?>" class="<?= (!empty($subpage) && $subpage == 'users')? 'active' : ''; ?>">
										<span class="hide-menu">Users</span>
									</a>
								</li>
							<?php } ?>
							
						<?php } ?>
					   
				    </ul>
				</li>
			<?php } ?>
			
			
			
			<?php if(in_array(7,$menuId) || in_array(8,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'events')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'events')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Event Management</span>
				    </a>
					<ul class="sub-menu" aria-expanded="true">
					    <?php if(in_array(7,$menuId)){ ?>
						
						    <?php
						        $eventcatMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 7])->select('*')->orderBy('id', 'DESC')->first();
						    ?>
							<?php if(@$eventcatMenu->view == 1){?>
								<li class="<?= (!empty($subpage) && $subpage == 'category')? 'mm-active' : ''; ?>">
									<a href="<?=url('admin/event/category')?>" class="<?= (!empty($subpage) && $subpage == 'category')? 'active' : ''; ?>">
										<span class="hide-menu">Event Category</span>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
						
					    <?php if(in_array(8,$menuId)){ ?>
						    <?php
						        $eventMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 8])->select('*')->orderBy('id', 'DESC')->first();
						    ?>
							<?php if(@$eventMenu->view == 1){?>
								<li class="<?= (!empty($subpage) && $subpage == 'events')? 'mm-active' : ''; ?>">
									<a href="<?=url('admin/event')?>" class="<?= (!empty($subpage) && $subpage == 'events')? 'active' : ''; ?>">
										<span class="hide-menu">Events</span>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
						
					</ul>
				</li>
			<?php } ?>
			
			<?php if(in_array(9,$menuId) || in_array(10,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'listing')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'listing')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Listing Management</span>
				    </a>
				    <ul class="sub-menu" aria-expanded="true">
					
				        <?php if(in_array(9,$menuId)){ ?>
						
						    <?php
						        $listingcatMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 9])->select('*')->orderBy('id', 'DESC')->first();
						    ?>
							<?php if(@$listingcatMenu->view == 1){ ?>
								<li class="<?= (!empty($subpage) && $subpage == 'listing-category')? 'mm-active' : ''; ?>">
									<a href="<?=url('admin/listing/category')?>" class="<?= (!empty($subpage) && $subpage == 'listing-category')? 'active' : ''; ?>">
										<span class="hide-menu">Listing Category</span>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
						
						<li class="<?= (!empty($subpage) && $subpage == 'listing-sub')? 'mm-active' : ''; ?>">
							<a href="<?=url('admin/listing/subcategory')?>" class="<?= (!empty($subpage) && $subpage == 'listing-sub')? 'active' : ''; ?>">
								<span class="hide-menu">Listing Subcategory</span>
							</a>
						</li>
						
						<!--<li class="<?= (!empty($subpage) && $subpage == 'listing-sub-sub')? 'mm-active' : ''; ?>">
							<a href="<?=url('admin/listing/subcategory-sub')?>" class="<?= (!empty($subpage) && $subpage == 'listing-sub-sub')? 'active' : ''; ?>">
								<span class="hide-menu">Listing Subcategory Sub</span>
							</a>
						</li>-->
						
					    <?php if(in_array(10,$menuId)){ ?>
						    <?php
						        $listingMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 10])->select('*')->orderBy('id', 'DESC')->first();
						    ?>
							<?php if(@$listingMenu->view == 1){ ?>
								<li class="<?= (!empty($subpage) && $subpage == 'listing')? 'mm-active' : ''; ?>">
									<a href="<?=url('admin/listing')?>" class="<?= (!empty($subpage) && $subpage == 'listing')? 'active' : ''; ?>">
										<span class="hide-menu">Listing</span>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>
				</li>
			<?php } ?>
			
			<?php if(in_array(20,$menuId) || in_array(21,$menuId) || in_array(22,$menuId)){ ?>
			
				<li class="<?= (!empty($page) && $page == 'product')? 'mm-active' : ''; ?>">
				
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'transaction')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Product & Service Mgnt  </span>
					</a>
					
					<ul class="sub-menu" aria-expanded="true">
                        <?php if(in_array(20,$menuId)){ ?>
                            <?php
						        $procatMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 20])->select('*')->orderBy('id', 'DESC')->first();
						    ?>
                            <?php if(@$procatMenu->view == 1){ ?>							
								<li class="<?= (!empty($subpage) && $subpage == 'product-category')? 'mm-active' : ''; ?>">
									<a href="<?=url('admin/product/category')?>" class="<?= (!empty($subpage) && $subpage == 'product-category')? 'active' : ''; ?>">
										<span class="hide-menu">Category List</span>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
						
						<?php if(in_array(21,$menuId)){ ?>
						    <?php
						        $prosubcatMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 21])->select('*')->orderBy('id', 'DESC')->first();
						    ?>
							<?php if(@$prosubcatMenu->view == 1){ ?>
								<!--<li class="<?= (!empty($subpage) && $subpage == 'product-subcategory')? 'mm-active' : ''; ?>">
									<a href="<?=url('admin/product/subcategory')?>" class="<?= (!empty($subpage) && $subpage == 'product-subcategory')? 'active' : ''; ?>">
										<span class="hide-menu">Subcategory List</span>
									</a>
								</li>-->
							<?php } ?>
						<?php } ?>
						
						<?php if(in_array(22,$menuId)){ ?>
						    <?php
						        $proMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 22])->select('*')->orderBy('id', 'DESC')->first();
						    ?>
							<?php if(@$proMenu->view == 1){ ?>
								<li class="<?= (!empty($subpage) && $subpage == 'product')? 'mm-active' : ''; ?>">
									<a href="<?=url('admin/product')?>" class="<?= (!empty($subpage) && $subpage == 'product')? 'active' : ''; ?>">
										<span class="hide-menu">Product List</span>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
						
						
						<li class="<?= (!empty($subpage) && $subpage == 'services')? 'mm-active' : ''; ?>">
							<a href="<?=url('admin/services')?>" class="<?= (!empty($subpage) && $subpage == 'services')? 'active' : ''; ?>">
								<span class="hide-menu">Service List</span>
							</a>
						</li>
						
						<li class="<?= (!empty($subpage) && $subpage == 'product-purchaselist')? 'mm-active' : ''; ?>">
							<a href="<?=url('admin/product/purchaseList')?>" class="<?= (!empty($subpage) && $subpage == 'product-purchaselist')? 'active' : ''; ?>">
								<span class="hide-menu">Purchase List</span>
							</a>
						</li>
						
					</ul>
				</li>
			<?php } ?>
			
			<?php if(in_array(18,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'tags')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'tags')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Tags Management </span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
					    <?php
							$tagsMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 18])->select('*')->orderBy('id', 'DESC')->first();
						?>
						<?php if(@$tagsMenu->view == 1){ ?>
							<li class="<?= (!empty($subpage) && $subpage == 'tags')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/tags')?>" class="<?= (!empty($subpage) && $subpage == 'tags')? 'active' : ''; ?>">
									<span class="hide-menu">Tags</span>
								</a>
							</li>
						<?php } ?>
					</ul>
				</li>
			<?php } ?>
			
			<?php if(in_array(19,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'interest')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'interest')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Interest Management </span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
					    <?php
							$interestMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 19])->select('*')->orderBy('id', 'DESC')->first();
						?>
						<?php if(@$interestMenu->view == 1){ ?>
							<li class="<?= (!empty($subpage) && $subpage == 'interest')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/interest')?>" class="<?= (!empty($subpage) && $subpage == 'interest')? 'active' : ''; ?>">
									<span class="hide-menu">Interest</span>
								</a>
							</li>
						<?php } ?>
					</ul>
				</li>
			<?php } ?>
			
			<?php if(in_array(11,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'discount')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'discount')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Discount Management</span>
				    </a>
				    <ul class="sub-menu" aria-expanded="true">
						<?php
							$discountMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 11])->select('*')->orderBy('id', 'DESC')->first();
						?>
						<?php if(@$discountMenu->view == 1){ ?>
							<li class="<?= (!empty($subpage) && $subpage == 'discount')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/discount')?>" class="<?= (!empty($subpage) && $subpage == 'discount')? 'active' : ''; ?>">
									<span class="hide-menu">Discount</span>
								</a>
							</li>
						<?php } ?>
						
				    </ul>
				</li>
			<?php } ?>
			
			
			
			<?php if(in_array(12,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'subscription')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'subscription')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Subscription</span>
				    </a>
					
				    <ul class="sub-menu" aria-expanded="true">
					    <?php
							$planMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 12])->select('*')->orderBy('id', 'DESC')->first();
						?>
						<?php if(@$planMenu->view == 1){ ?>
							<li class="<?= (!empty($subpage) && $subpage == 'sub')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/subscription')?>" class="<?= (!empty($subpage) && $subpage == 'sub')? 'active' : ''; ?>">
									<span class="hide-menu">Plan List</span>
								</a>
							</li>
						<?php } ?>
						
						<li class="<?= (!empty($subpage) && $subpage == 'access-menu')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/subscription/access-menu')?>" class="<?= (!empty($subpage) && $subpage == 'access-menu')? 'active' : ''; ?>">
									<span class="hide-menu">Menu Access List</span>
								</a>
							</li>
						
				    </ul>
				</li>
			<?php } ?>
			
			<?php if(in_array(13,$menuId) || in_array(14,$menuId) || in_array(15,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'ads')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'ads')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Promotion </span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
						<?php
							$promotionMenu = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 13])->select('*')->orderBy('id', 'DESC')->first();
						?>
						<?php if(@$promotionMenu->view == 1){ ?>
							<li class="<?= (!empty($subpage) && $subpage == 'ads')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/promotion')?>" class="<?= (!empty($subpage) && $subpage == 'ads')? 'active' : ''; ?>">
									<span class="hide-menu">Promotion</span>
								</a>
							</li>
						<?php } ?>
						
						
						<?php
							$promotionMenu_1 = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 14])->select('*')->orderBy('id', 'DESC')->first();
						?>
						<?php if(@$promotionMenu_1->view == 1){ ?>
						    <li class="<?= (!empty($subpage) && $subpage == 'category')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/promotion/category')?>" class="<?= (!empty($subpage) && $subpage == 'category')? 'active' : ''; ?>">
									<span class="hide-menu">Category List </span>
								</a>
							</li>
						<?php } ?>
						<?php
							$promotionMenu_2 = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 15])->select('*')->orderBy('id', 'DESC')->first();
						?>
						<?php if(@$promotionMenu_2->view == 1){ ?>
						
						    <li class="<?= (!empty($subpage) && $subpage == 'plan')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/promotion/plan')?>" class="<?= (!empty($subpage) && $subpage == 'plan')? 'active' : ''; ?>">
									<span class="hide-menu">Plan List </span>
								</a>
							</li>
						<?php } ?>	
					</ul>
				</li>
			<?php } ?>
			
			<?php if(in_array(16,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'invitation')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'invitation')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Invitation Management </span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
							<?php
							    $invi = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 16])->select('*')->orderBy('id', 'DESC')->first();
							?>
							<?php if(@$invi->view == 1){ ?>
								<li class="<?= (!empty($subpage) && $subpage == 'invitation')? 'mm-active' : ''; ?>">
									<a href="<?=url('admin/invitation')?>" class="<?= (!empty($subpage) && $subpage == 'invitation')? 'active' : ''; ?>">
										<span class="hide-menu">Invitation List</span>
									</a>
								</li>
							<?php } ?>	
						
					</ul>
				</li> 
			<?php } ?>
			
			<?php if(in_array(23,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'message')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'message')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Message</span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
					    <?php
							$msg = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 23])->select('*')->orderBy('id', 'DESC')->first();
						?>
						<?php if(@$msg->view == 1){ ?>
							<li class="<?= (!empty($subpage) && $subpage == 'message')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/message')?>" class="<?= (!empty($subpage) && $subpage == 'message')? 'active' : ''; ?>">
									<span class="hide-menu">Message List</span>
								</a>
							</li>
						<?php } ?>	
					</ul>
				</li>
			<?php } ?>
			
			<?php if(in_array(24,$menuId) || in_array(25,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'template')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'template')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Email Management</span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
					    <?php
							$tem = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 24])->select('*')->orderBy('id', 'DESC')->first();
						?>
						<?php if(@$tem->view == 1){ ?>
							<li class="<?= (!empty($subpage) && $subpage == 'temp-creation')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/emailtemplate')?>" class="<?= (!empty($subpage) && $subpage == 'temp-creation')? 'active' : ''; ?>">
									<span class="hide-menu">Template Creation</span>
								</a>
							</li>
						<?php } ?>	
						
						<?php
							$mailer = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 25])->select('*')->orderBy('id', 'DESC')->first();
						?>
						<?php if(@$mailer->view == 1){ ?>
							<li class="<?= (!empty($subpage) && $subpage == 'template')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/mailer')?>" class="<?= (!empty($subpage) && $subpage == 'template')? 'active' : ''; ?>">
									<span class="hide-menu">Mailer</span>
								</a>
							</li>
						<?php } ?>	
						
					</ul>
				</li>
			<?php } ?>
			
			<?php if(in_array(26,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'payout')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'payout')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span> Payout Management</span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
					    <?php
							$payout = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 26])->select('*')->orderBy('id', 'DESC')->first();
						?>
						<?php if(@$payout->view == 1){ ?>
							<li class="<?= (!empty($subpage) && $subpage == 'payout')? 'mm-active' : ''; ?>">
								<a href="<?=url('admin/payout')?>" class="<?= (!empty($subpage) && $subpage == 'payout')? 'active' : ''; ?>">
									<span class="hide-menu">Payout List</span>
								</a>
							</li>
						<?php } ?>
						
					</ul>
				</li>
			<?php } ?>
			
			<?php if(in_array(17,$menuId)){ ?>
				<li class="<?= (!empty($page) && $page == 'transaction')? 'mm-active' : ''; ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'transaction')? 'mm-active' : ''; ?>">
					   <i class="fa fa-bookmark"></i>
					   <span>Transaction  </span>
					</a>
					<ul class="sub-menu" aria-expanded="true">
						    <?php
							    $tran = DB::table('role_permission')->where(['role_id' => session()->get('ROLE_ID'), 'menu_id' => 17])->select('*')->orderBy('id', 'DESC')->first();
							?>
							<?php if(@$tran->view == 1){ ?>
								<li class="<?= (!empty($subpage) && $subpage == 'transaction')? 'mm-active' : ''; ?>">
									<a href="<?=url('admin/transaction')?>" class="<?= (!empty($subpage) && $subpage == 'transaction')? 'active' : ''; ?>">
										<span class="hide-menu">Transaction List</span>
									</a>
								</li>
							<?php } ?>	
						
					</ul>
				</li>
			<?php } ?>
			
			    
			 
        </ul>
		
		
			 
    </div>
    <!-- Sidebar -->
 </div>
</div>
<!-- Left Sidebar End -->