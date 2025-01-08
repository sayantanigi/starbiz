@include('admin.header');
@include('admin.sidebar');
<style>
.form-check{display:flex;align-items:center}
.form-check label{margin-left:10px;font-size:18px;font-weight:500}
.form-switch .form-check-input[type=checkbox]{border-radius:2em;height:50px;width:100px}
small>p{color:red}
p strong{font-weight:600!important;color:#000!important}
.sa-confirm-button-container button{background-color:#146c43!important;border-color:#146c43!important}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?=$title?></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Dashboard</a></li>
                                <li class="breadcrumb-item active"><?=$title?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-shadow rounded-lg border">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h4 class="card-title mb-4"><?=$title?></h4>
                                </div>
                                <div class="col-sm-2 text-end" style="padding-left: 54px;">
                                    <a href="<?=url('admin/users/add')?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;Add</a>
                                </div>
                            </div>
                            <div class="">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                                @endif
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>#</th>
                                            <th style="width:10%">Profile</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>UserType</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (is_array($result) || is_object($result)) {
                                        foreach ($result as $k => $v): ?>
                                        <tr>
                                            <td><?= $k + 1 ?></td>
                                            <?php
                                            if (!empty(@$v->profile_image) && file_exists('public/profile/' . @$v->profile_image . '')) {
                                                $profilePic = url('profile/' . @$v->profile_image . '');
                                            } else {
                                                $profilePic = url('profile/unnamed.jpg');
                                            }
                                            ?>
                                            <td style="width:10%"><img src="<?=@$profilePic?>" style="width: 60%;border: 3px solid #9b91917d;padding: 3px;border-radius: 10px;"></td>
                                            <td><?=ucfirst(@$v->first_name); ?> &nbsp; <?=ucfirst(@$v->last_name); ?></td>
                                            <td><?=@$v->email; ?></td>
                                            <td><?=@$v->phone; ?></td>
                                            <?php $userType = DB::table('user_type')->where(['id' => @$v->user_type])->select('name')->first(); ?>
                                            <td><?=@$userType->name; ?></td>
                                            <td>
                                                <div class="form-check mb-3 mt-3">
                                                    <input type="checkbox" class="form-check-input small" id="statusChange_<?=$k?>" switch="bool" value="<?= @$v->status ?>" <?= (@$v->status == 1) ? 'checked' : '' ?> onchange="changeDealStatus(<?=@$v->id?>, $(this))">
                                                    <label class="form-check-label" for="statusChange_<?=$k?>"></label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= url('admin/users/edit/' . $v->id) ?>" class="btn btn-outline-success btn-sm" data-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!--<a href="<?= url('admin/users/edit-profile/' . @$v->id) ?>" class="btn btn-outline-success btn-sm" data-toggle="tooltip" title="Update Profile">
                                                    <i class="fa fa-user"></i>
                                                </a>-->
                                                <a href="<?= url('admin/users/view/' . @$v->id) ?>" class="btn btn-outline-success btn-sm" data-toggle="tooltip" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="<?= url('admin/users/subscription/' . @$v->id) ?>" class="btn btn-outline-success btn-sm" data-toggle="tooltip" title="Subscription Payment">Payment</a>
                                                <a href="javascript:void(0)" class="btn btn-outline-warning btn-sm" data-toggle="tooltip" title="Delete" onclick="deleteDeals(<?= @$v->id ?>)">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php    endforeach ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
    <script type="text/javascript">
        var adminUrl = ""
        function myfunc() {
            var element = document.getElementById("savethedeal");
            html2canvas(element, {
                allowTaint: true,
                useCORS: true
            }).then(function (canvas) {
                canvas.toBlob(function (blob) {
                    window.saveAs(blob, "Deal.png");
                });
            });
        };

        function dealDetail(dealId) {
            var baseUrl = "<?=url('admin/deals/detailsDeal')?>";
            $.ajax({
                url: baseUrl,
                type: 'POST',
                data: {dealId: dealId},
                beforeSend: function () {
                    $.blockUI({
                        message: "<h4>Just a moment...<h4>",
                        css: {
                            color: '#048700',
                            borderColor: '#048700'
                        }
                    });
                },
                success: function (data) {
                    $("#dealModal .modal-body").html(data);
                    $.unblockUI();
                    $("#dealModal").modal('show');
                }
            });
        }

        function deleteDeals(dealId) {
            swal({
                title: 'Are You sure want to delete this?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = '<?= url('admin/users/delete-user/') ?>/' + dealId
                }
            });
        }

        function generateQr(userId) {
            $.ajax({
                url: '<?=url('admin/users/qrcode')?>',
                type: 'POST',
                data: { userId: userId },
                success: function (data) {
                    if (data == '1') {
                        swal({ title: "Sucess!", text: "<strong>Your qrcode is generated sucessfully.</strong>", type: "success", showConfirmButton: true, html: true }, function () { window.location.href = " " });
                    }
                }
            });
        }
        //Article status change function
        function changeDealStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: '<?php echo url('admin/users/changestatus'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    userId: String(id),
                    status: String(newStatus),
                    "_token": "{{ csrf_token() }}"
                },
            })
            .done(function (data) {
                if (newStatus == 1) {
                    swal({ title: "Sucess!", text: "<strong>Your status is Activate</strong>", type: "success", showConfirmButton: true, html: true }, function () { window.location.href = " " });
                } else if (newStatus == 0) {
                    swal({ title: "Sucess!", text: "<strong>Your status is Inctivate</strong>", type: "success", showConfirmButton: true, html: true }, function () { window.location.href = " " });
                }
            })
            .fail(function (data) {
                console.log(data);
            });
        }

        function changeDealApproval(id, thisSwitch, subpage) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: adminUrl + 'deals/approve',
                type: 'POST',
                dataType: 'json',
                data: {
                    dealId: String(id),
                    status: String(newStatus)
                },
            })
            .done(function (data) {
                if (subpage == 'deallist') {
                    var redirectURL = adminUrl + 'deals';
                }
                else if (subpage == 'hotdeallist') {
                    var redirectURL = adminUrl + 'hotdeals';
                } else {
                    var redirectURL = adminUrl + 'unapproved-deals';
                }
                alert_response(data, redirectURL);
            })
            .fail(function (data) {
                console.log(data);
            });
        }

        //Article status change function
        function changeHotDealStatus(id, currentStatus, subpage) {
            var newStatus;

            if (currentStatus == 1) {
                newStatus = '0';
                var confirmTxt = 'Remove this Deal from Hot Deals?';
            } else {
                newStatus = '1';
                var confirmTxt = 'Mark this Deal as a Hot Deal?';
            }
            swal({
                title: confirmTxt,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: adminUrl + 'deals/changehotdealstatus',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            dealId: String(id),
                            hot_deal: String(newStatus)
                        },
                    })
                    .done(function (data) {
                        if (subpage == 'deallist') {
                            var redirectURL = adminUrl + 'deals';
                        }
                        else if (subpage == 'hotdeallist') {
                            var redirectURL = adminUrl + 'hotdeals';
                        } else {
                            var redirectURL = adminUrl + 'unapproved-deals';
                        }
                        alert_response(data, redirectURL);
                    })
                    .fail(function (data) {
                        console.log(data);
                    });
                }
            });
        }

        //Article status change function
        function changeFeaturedDealStatus(id, currentStatus) {
            var newStatus;
            if (currentStatus == 1) {
                newStatus = '0';
                var confirmTxt = 'Remove this Deal from Featured Deals?';
            } else {
                newStatus = '1';
                var confirmTxt = 'Mark this Deal as a Featured Deal?';
            }
            swal({
                title: confirmTxt,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: adminUrl + 'deals/changefeatureddealstatus',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            dealId: String(id),
                            featured_deal: String(newStatus)
                        },
                    })
                    .done(function (data) {
                        var redirectURL = adminUrl + 'hotdeals';
                        alert_response(data, redirectURL);
                    })
                    .fail(function (data) {
                        console.log(data);
                    });
                }
            });
        }
    </script>
    @include('admin.footer');