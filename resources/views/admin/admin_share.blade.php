@include('admin.header');
@include('admin.sidebar');
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
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
            <form action="{{url('admin/admin_share/saveadmin_share')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
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
                                <h4 class="card-title">Admin Share Details</h4>
                                <hr>
                                <div class="row mb-3 mt-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Admin share for Appearance (in percentage)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="appearence_share" id="appearence_share" value="<?= @$result->appearence_share ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-search-input" class="col-sm-2 col-form-label">Admin share for Product & Service (in percentage)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="product_share" id="product_share" value="<?= @$result->product_share ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <!--<div class="row mb-3">
                                    <label for="example-url-input" class="col-sm-2 col-form-label">Admin share for Service (in percentage)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="service_share" id="service_share" value="<?= @$result->service_share ?>" autocomplete="off" required="">
                                    </div>
                                </div>-->
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
</div>
@include('admin.footer');