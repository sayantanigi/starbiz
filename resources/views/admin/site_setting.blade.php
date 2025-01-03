@include('admin.header');
@include('admin.sidebar');
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
            <form action="{{url('admin/setting/savesite-setting')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
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
	                            <h4 class="card-title">Site Basic Details</h4>
	                            <hr>
	                            <div class="row mb-3 mt-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
	                                <div class="col-sm-10">
	                                   <input type="text" class="form-control" name="address" id="address" value="<?= @$result->address ?>" autocomplete="off" required>
	                                </div>
	                            </div>
	                            <div class="row mb-3">
	                                <label for="example-search-input" class="col-sm-2 col-form-label">Email</label>
	                                <div class="col-sm-10">
	                                    <input type="email" class="form-control" name="email" id="email" value="<?= @$result->email ?>" autocomplete="off" required>
	                                </div>
	                            </div>
	                            <div class="row mb-3">
	                                <label for="example-url-input" class="col-sm-2 col-form-label">Telephone</label>
	                                <div class="col-sm-10">
	                                   <input type="text" class="form-control" name="phone" id="phone" value="<?= @$result->phone ?>" autocomplete="off" required="">
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="row">
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
                            </div>
	                    </div>
	                </div>
	            </div>
                <div class="row">
	                <div class="col-12">
	                    <div class="card">
	                        <div class="card-body">
	                            <h4 class="card-title">Stripe Settings</h4>
	                            <hr>
	                            <div class="row mb-3 mt-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Stripe Publishable Key:</label>
	                                <div class="col-sm-10">
	                                   <input type="text" class="form-control" name="stripe_publishable_key" id="stripe_publishable_key" value="<?= @$result->stripe_publishable_key ?>" autocomplete="off" style="font-size: 15px;">
	                                </div>
	                            </div>
	                            <div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Stripe Secret Key:</label>
	                                <div class="col-sm-10">
	                                  <input type="text" class="form-control" name="stripe_secret_key" id="stripe_secret_key" value="<?= @$result->stripe_secret_key ?>" autocomplete="off" style="font-size: 15px;">
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
	            </div>
	        </form>
        </div>
    </div>
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
@include('admin.footer');