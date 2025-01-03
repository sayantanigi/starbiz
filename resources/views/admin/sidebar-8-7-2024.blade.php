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
						
						<li class="<?= (!empty($subpage) && $subpage == 'listing-sub-sub')? 'mm-active' : ''; ?>">
							<a href="<?=url('admin/listing/subcategory-sub')?>" class="<?= (!empty($subpage) && $subpage == 'listing-sub-sub')? 'active' : ''; ?>">
								<span class="hide-menu">Listing Subcategory Sub</span>
							</a>
						</li>
						
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
			
			
			<li class="<?= (!empty($page) && $page == 'tags')? 'mm-active' : ''; ?>">
				<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'tags')? 'mm-active' : ''; ?>">
				   <i class="fa fa-bookmark"></i>
				   <span>Tags Management </span>
				</a>
				<ul class="sub-menu" aria-expanded="true">
					<li class="<?= (!empty($subpage) && $subpage == 'tags')? 'mm-active' : ''; ?>">
						<a href="<?=url('admin/tags')?>" class="<?= (!empty($subpage) && $subpage == 'tags')? 'active' : ''; ?>">
							<span class="hide-menu">Tags</span>
						</a>
					</li>
				</ul>
			</li>
			
			<li class="<?= (!empty($page) && $page == 'interest')? 'mm-active' : ''; ?>">
				<a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'interest')? 'mm-active' : ''; ?>">
				   <i class="fa fa-bookmark"></i>
				   <span>Interest Management </span>
				</a>
				<ul class="sub-menu" aria-expanded="true">
					<li class="<?= (!empty($subpage) && $subpage == 'interest')? 'mm-active' : ''; ?>">
						<a href="<?=url('admin/interest')?>" class="<?= (!empty($subpage) && $subpage == 'interest')? 'active' : ''; ?>">
							<span class="hide-menu">Interest</span>
						</a>
					</li>
				</ul>
			</li>
			
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
			
        </ul>
		
		
			 
    </div>
    <!-- Sidebar -->
 </div>
</div>
<!-- Left Sidebar End -->