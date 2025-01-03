
<div data-simplebar class="sidebar-menu-scroll">

    <div id="sidebar-menu">
       
       <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>
            <li class="<?= (!empty($page) && $page == 'dashboard')? 'mm-active' : ''; ?>"><a href="<?=url('admin/dashboard')?>" class="waves-effect"><i class="fas fa-home"></i> Dashboard</a></li>
			
			<li class="<?= (!empty($page) && $page == 'users')? 'mm-active' : ''; ?>">
                <a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'users')? 'mm-active' : ''; ?>">
                   <i class="fa fa-bookmark"></i>
                   <span>Users Management</span>
               </a>
               <ul class="sub-menu" aria-expanded="true">
                   <li class="<?= (!empty($subpage) && $subpage == 'user-type')? 'mm-active' : ''; ?>">
                        <a href="<?=url('admin/user-type')?>" class="<?= (!empty($subpage) && $subpage == 'user-type')? 'active' : ''; ?>">
                            <span class="hide-menu">User Type</span>
                        </a>
                   </li>
				   
				   <li class="<?= (!empty($subpage) && $subpage == 'users')? 'mm-active' : ''; ?>">
                        <a href="<?=url('admin/users')?>" class="<?= (!empty($subpage) && $subpage == 'users')? 'active' : ''; ?>">
                            <span class="hide-menu">Users</span>
                        </a>
                   </li>
				   
               </ul>
            </li>
			
			<li class="<?= (!empty($page) && $page == 'subscription')? 'mm-active' : ''; ?>">
                <a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'subscription')? 'mm-active' : ''; ?>">
                   <i class="fa fa-bookmark"></i>
                   <span>Subscription</span>
               </a>
               <ul class="sub-menu" aria-expanded="true">
                   <li class="<?= (!empty($subpage) && $subpage == 'sub')? 'mm-active' : ''; ?>">
                        <a href="<?=url('admin/subscription')?>" class="<?= (!empty($subpage) && $subpage == 'sub')? 'active' : ''; ?>">
                            <span class="hide-menu">Plan List</span>
                        </a>
                   </li>
               </ul>
            </li>
			
        </ul>
		
		
			 
    </div>
    <!-- Sidebar -->
 </div>
</div>
<!-- Left Sidebar End -->