@include('admin.header');
@include('admin.sidebar');

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->	
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?=$title?></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="breadcrumb-item active"><?=$title?></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <form action="{{url('admin/setting/savelogo-setting')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
			 @csrf
	            <div class="row">
	                <div class="col-12">
	                    <div class="card">
	                        <div class="card-body">
      
	                            <h4 class="card-title"><?= $title ?></h4>
	                            <hr>
								
								@if (session('status'))
									<div class="alert alert-success" role="alert">
										{{ session('status') }}
									</div>
								@elseif (session('error'))
									<div class="alert alert-danger" role="alert">
										{{ session('error') }}
									</div>
								@endif

	                            <div class="row mb-3 mt-3">
	                                <label for="old_password" class="col-sm-2 text-right">
										Primary Logo : <span>*</span>
									</label>
									<div class="col-sm-10">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail uploadlogosize border mb-2 p-2">
												<?php if ($result->logo != '' && !is_null($result->logo) && file_exists('./public/setting/'.$result->logo)) { ?>
													<img src="<?= url('setting/'.$result->logo) ?>" alt="">
												<?php } else { ?>
													<img src="<?= url('assets/admin/dist/images/noimage.jpg') ?>" alt="">
												<?php } ?>
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail uploadlogosize p-2 mb-2 border"></div>
											<div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="logo" accept="images/*" >
													<input type="hidden" name="oldLogo" value="" required="">
												</span>
												<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
											</div>
										</div>
										<div class="clearfix margin-top-10 m-b-20" style="display: block;">
											<span class="label label-main">Format</span> 
											jpg, jpeg, png&nbsp;&nbsp;
											<span class="label label-main">Max Size</span> 
											10 MB
										</div>
									</div>
	                            </div>
                                
                                <hr>
	                            <div class="row mb-3 mt-3">
	                                <label for="old_password" class="col-sm-2 text-right">
										Retina Logo : <span>*</span>
									</label>
									<div class="col-sm-10">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail uploadlogosize border mb-2 p-2">
												<?php if ($result->sec_logo != '' && !is_null($result->sec_logo) && file_exists('./public/setting/'.$result->sec_logo)) { ?>
													<img src="<?= url('setting/'.$result->sec_logo) ?>" alt="">
												<?php } else { ?>
													<img src="<?= url('assets/admin/dist/images/noimage.jpg') ?>" alt="">
												<?php } ?>
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail uploadlogosize p-2 mb-2 border"></div>
											<div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="sec_logo" accept="images/*" >
													<input type="hidden" name="oldSecLogo" value="">
												</span>
												<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
											</div>
										</div>
										<div class="clearfix margin-top-10 m-b-20" style="display: block;">
											<span class="label label-main">Format</span> 
											jpg, jpeg, png&nbsp;&nbsp;
											<span class="label label-main">Max Size</span> 
											10 MB
										</div>
									</div>
	                            </div>

                                <hr>
	                            <div class="row mb-3 mt-4">
									<label for="old_password" class="col-sm-2 text-right">
										Favicon : <span>*</span>
									</label>
									<div class="col-sm-10">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail uploadlogosize border mb-2 p-2">
												<?php if ($result->favicon != '' && !is_null($result->favicon) && file_exists('./public/setting/'.$result->favicon)) { ?>
													<img src="<?= url('setting/'.$result->favicon) ?>" alt="">
												<?php } else { ?>
													<img src="<?= url('assets/admin/dist/images/noimage.jpg') ?>" alt="">
												<?php } ?>
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail uploadlogosize border mb-2 p-2"></div>
											<div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="favicon" accept="images/*" >
													<input type="hidden" name="oldFavicon" value="" required="">
												</span>
												<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
											</div>
										</div>
										<div class="clearfix margin-top-10 m-b-20" style="display: block;">
											<span class="label label-main">Format</span> 
											jpg, jpeg, png, ico&nbsp;&nbsp;
											<span class="label label-main">Max Size</span> 
											10 MB
										</div>
									</div>
								</div>
                                
                                <hr> 
								<div class="row mb-3 mt-4">
									<label for="logo_title" class="col-sm-2 text-right">
										Site Title: <span>*</span>
									</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="title" id="logo_title" autocomplete="off" value="<?=@$result->title?>" required>
									</div>
								</div>
                                
                                <div class="row mb-3 pt-3">
								  <div class="col-sm-4 col-sm-offset-4">
									<div class="form-group">
										<input type="submit" class="btn btn-success" name="logo_settings" id="logo_settings" value="Save"/>
									</div>
								  </div>
								</div>  
	                        </div>

	                    </div>
	                </div> <!-- end col -->
	            </div>
            	<!-- end row -->
		 	</form>    

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Medroc.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://1.envato.market/themesdesign" target="_blank">Themesdesign</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</div>
<!-- end main content-->
   @include('admin.footer');