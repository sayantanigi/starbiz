@include('admin.header');
@include('admin.sidebar');

<style>
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	/* Firefox */
	input[type=number] {
	  -moz-appearance: textfield;
	}
</style>
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
                        <h4 class="mb-0"><?= $title ?></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <form action="{{url('admin/referral-setting/saveSetting')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
			@csrf
	            <div class="row">
	                <div class="col-12">
	                    <div class="card">
	                        <div class="card-body">
								 @if (session('status'))
									<div class="alert alert-success" role="alert">
										{{ session('status') }}
									</div>
								@elseif (session('error'))
									<div class="alert alert-danger" role="alert">
										{{ session('error') }}
									</div>
								@endif
							
	                            <h4 class="card-title">Referral Comission Setting</h4>
	                            <hr>
	                           
	                            <div class="row mb-3 mt-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Spend Money</label>
	                                <div class="col-sm-10">
	                                   <span style="position: absolute;margin: 1px 2px;background: #d1c3c3;padding: 6px 5px;font-size: 16px;height: 36px;">$</span><input type="number" class="form-control" name="spend_money" id="spend_money" value="<?=@$result->spend_money?>" autocomplete="off" required style="padding: 6px 30px;">
									   
									   <input type="hidden" class="form-control" name="id" id="id" value="<?=@$result->id?>" required>
	                                </div>
	                            </div>
	                           
	                            <div class="row mb-3">
	                                <label for="example-search-input" class="col-sm-2 col-form-label">Earn Points</label>
	                                <div class="col-sm-10">
	                                    <input type="number" class="form-control" name="reward_points" id="reward_points" value="<?=@$result->reward_points?>" autocomplete="off" required>
	                                </div>
	                            </div>
	                            
	                            <div class="row mb-3">
	                                <label for="example-url-input" class="col-sm-2 col-form-label">Referred By Points</label>
	                                <div class="col-sm-10">
	                                   <input type="number" class="form-control" name="referred_by_points" id="referred_by_points" value="<?=@$result->referred_by_points?>" autocomplete="off" required="">
	                                </div>   
	                            </div>
								
								<div class="row mb-3">
	                               <div class="col-sm-4 col-sm-offset-4">
									 <div class="form-group">
										<input type="submit" class="btn btn-success" name="settings" id="settings" value="Update"/>
									 </div>
								  </div>
								</div>

	                        </div>
	                    </div>
	                </div> <!-- end col -->
	            </div>
            	<!-- end row -->

	            <!--<div class="row">
	                <div class="col-12">
	                    <div class="card">
	                        <div class="card-body">

	                            <h4 class="card-title">Social Media Settings</h4>
	                            <hr>

	                            <div class="row mb-3 mt-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Facebook :</label>
	                                <div class="col-sm-10">
	                                   <input type="text" class="form-control" name="facebook" id="facebook" value="<?= @$result->facebook ?>" autocomplete="off">
	                                </div>
	                            </div>
	                           
	                            <div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Twitter :</label>
	                                <div class="col-sm-10">
	                                  <input type="text" class="form-control" name="twitter" id="twitter" value="<?= @$result->twitter ?>" autocomplete="off">
	                                </div>
	                            </div>
	                            
	                            <div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Linkedin :</label>
	                                <div class="col-sm-10">
	                                   <input type="text" class="form-control" name="linkedin" id="linkedin" value="<?= @$result->linkedin ?>" autocomplete="off">
	                                </div>
	                            </div>

	                            <div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Instagram :</label>
	                                <div class="col-sm-10">
	                                   <input type="text" class="form-control" name="instagram" id="instagram" value="<?= @$result->instagram ?>" autocomplete="off">
	                                </div>
	                            </div>

	                            <div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Youtube :</label>
	                                <div class="col-sm-10">
	                                  <input type="text" class="form-control" name="youtube" id="youtube" value="<?= @$result->youtube ?>" autocomplete="off">
	                                </div>
	                            </div>
                                <hr>
								
								<div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Admin Share (in percentage)</label>
	                                <div class="col-sm-10">
	                                  <input type="text" class="form-control" name="adminshare" id="adminshare" value="<?= @$result->admin_percentage ?>" autocomplete="off" >
	                                </div>
	                            </div>
								
								<div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Search Radius</label>
	                                <div class="col-sm-10">
	                                  <input type="text" class="form-control" name="radius" id="radius" value="<?= @$result->kilometer ?>" autocomplete="off" >
	                                </div>
	                            </div>
								
                                <div class="row mb-3">
	                               <div class="col-sm-4 col-sm-offset-4">
									 <div class="form-group">
										<input type="submit" class="btn btn-success" name="settings" id="settings" value="Update"/>
									 </div>
								  </div>
								</div>  
	                        </div>
	                    </div>
	                </div> 
	            </div>--->
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