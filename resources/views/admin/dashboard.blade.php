@include('admin.header');
@include('admin.sidebar');

<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0"></h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <!--<li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>-->
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <!-- end page title -->
         <div class="row">
            <div class="col-xl-12">
               <div class="row h-100">
			   <?php
			   $userCount = DB::table('users')->count();
			   ?>
			   <!-- end col-->
                  <div class="col-md-6 col-xl-3">
                    <a href="<?=url('admin/users')?>">
					
                     <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                        <div class="card-body">
                           <div class="d-flex justify-content-between">
                              <h5 class="font-size-15 text-uppercase mb-0">Users </h5>
                              <div class="avatar-xs">
                                 <span class="avatar-title rounded bg-soft-primary font-size-20 mini-stat-icon">
                                 <i class="fa fa-users text-primary"></i>
                                 </span>
                              </div>
                           </div>
                           <h3 class="font-size-24"><?=@$userCount?></h3>
                           <!-- <p class="text-muted mb-0">Recent Customers</p> -->
                        </div>
                        <!-- end card-body -->
                        <!-- user chart -->
                        <div id="ongoing-chart"></div>
                     </div>
                   </a>
                     <!-- end card -->
                  </div>
				   <?php
						$subCount = DB::table('sub_plan')->count();
				   ?>
                  <div class="col-md-6 col-xl-3">
                     <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                      <a href="<?=url('admin/subscription')?>">
					 
                        <div class="card-body">
                           <div class="d-flex justify-content-between">
                              <h5 class="font-size-15 text-uppercase mb-0">Subcription Plan</h5>
                              <div class="avatar-xs">
                                 <span class="avatar-title rounded bg-soft-primary font-size-20 mini-stat-icon">
                                 <i class="fa fa-bookmark text-primary"></i>
                                 </span>
                              </div>
                           </div>
                           <h3 class="font-size-24"><?=@$subCount?></h3>
                           <!-- <p class="text-muted mb-0">Recent Deals</p> -->
                        </div>
                      </a>
                        <!-- end card-body -->
                        <!-- Project chart -->
                        <div id="project-chart"></div>
                     </div>
                     <!-- end card -->
                  </div>
				  
                  
				  
                  <!-- end col-->
				  <?php
						$events = DB::table('events')->count();
				   ?>
                  <div class="col-xl-3">
                    <a href="<?=url('admin/event')?>">
					
                     <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                        <div class="card-body">
                           <div class="d-flex justify-content-between">
                              <h5 class="font-size-15 text-uppercase mb-0">Events</h5>
                              <div class="avatar-xs">
                                 <span class="avatar-title rounded bg-soft-primary font-size-20 mini-stat-icon">
                                 <i class="fa fa-link text-primary"></i>
                                 </span>
                              </div>
                           </div>
                           <h3 class="font-size-24"><?=@$events?></h3>
                           <!-- <p class="text-muted mb-0">Recently added vendor</p> -->
                        </div>
                        <!-- end card-body -->
                        <!-- order chart -->
                        <div id="completed-chart"></div>
                     </div>
                   </a>
                     <!-- end card -->
                  </div>
				  
				    <?php
						$listing = DB::table('listing')->count();
				    ?>
                  <div class="col-xl-3">
                    <a href="<?=url('admin/listing')?>">
					
                     <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                        <div class="card-body">
                           <div class="d-flex justify-content-between">
                              <h5 class="font-size-15 text-uppercase mb-0">Listing</h5>
                              <div class="avatar-xs">
                                 <span class="avatar-title rounded bg-soft-primary font-size-20 mini-stat-icon">
                                 <i class="fa fa-link text-primary"></i>
                                 </span>
                              </div>
                           </div>
                           <h3 class="font-size-24"><?=@$listing?></h3>
                           <!-- <p class="text-muted mb-0">Recently added vendor</p> -->
                        </div>
                        <!-- end card-body -->
                        <!-- order chart -->
                        <div id="completed-chart"></div>
                     </div>
                   </a>
                     <!-- end card -->
                  </div>
				  
				  <!--<div class="col-xl-3">
                    <a href="">
					
                     <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                        <div class="card-body">
                           <div class="d-flex justify-content-between">
                              <h5 class="font-size-15 text-uppercase mb-0">Discount</h5>
                              <div class="avatar-xs">
                                 <span class="avatar-title rounded bg-soft-primary font-size-20 mini-stat-icon">
                                 <i class="fa fa-tag text-primary"></i>
                                 </span>
                              </div>
                           </div>
                           <h3 class="font-size-24"></h3>
                          
                        </div>
                        
                        <div id="completed-chart"></div>
                     </div>
                   </a>
                    
                  </div>-->
				  
                  <!-- end col -->
               </div>
               <!-- end row -->
            </div>
            <!-- end col -->
            
         </div>
         <!-- end row-->
         
        
         <!-- end row -->
         <div class="row">
            <div class="col-xl-12">
               
               <!-- end card -->
            </div>
            <!-- end col -->
            
         </div>
         <!-- end col -->
      </div>
   </div>
   <!-- End Page-content -->
   @include('admin.footer');