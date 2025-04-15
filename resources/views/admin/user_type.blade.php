@include('admin.header');
@include('admin.sidebar');

<style>
.form-check {
    display: flex;
    align-items: center;
}
.form-check label {
    margin-left: 10px;
    font-size: 18px;
    font-weight: 500;
}
.form-switch .form-check-input[type=checkbox] {
    border-radius: 2em;
    height: 50px;
    width: 100px;
}
small>p {
    color: red;
}
p strong {
    font-weight: 600 !important;
    color: black !important;
}
.sa-confirm-button-container button {
    background-color: #146c43 !important;
    border-color: #146c43 !important;
}
</style>
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
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-shadow rounded-lg border">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h4 class="card-title mb-4"><?=@$title?></h4>
                                </div>
                                <div class="col-sm-2 text-end" style="padding-left: 54px;">
                                    <a href="<?=url('admin/add-user-type')?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;Add</a>
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
                                            <th>User Type</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (is_array($result) || is_object($result)) { ?>
                                        <?php foreach ($result as $key => $v): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= @$v->name?></td>
                                            <td>
                                            <?php
                                            if (@$v->status == 1) {
                                                echo $status = '<span style="background: green;color: #fff;padding: 3px 13px;font-size: 14px;font-weight: 700;border-radius: 4px;">Active</span>';

                                            } elseif (@$v->status == 0) {
                                                echo $status = '<span style="background: red;color: #fff;padding: 3px 13px;font-size: 14px;font-weight: 700;border-radius: 4px;">Inactive</span>';
                                            }
                                            ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?=url('admin/edit-user-type/' . @$v->id . '')?>" class="btn btn-outline-success btn-sm" data-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- <a href="javascript:void(0)" class="btn btn-outline-warning btn-sm" data-toggle="tooltip" title="Delete" onclick="deleteDeals(<?= @$v->id ?>)">
                                                    <i class="fa fa-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
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
                data: {
                    dealId: dealId
                },
                beforeSend: function () {
                    $.blockUI({

                        // blockUI code with custom
                        // message and styling
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
                    window.location.href = '<?= url('admin/delete-user-type/') ?>/' + dealId
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
                url: '<?php echo url('admin/domain/changestatus'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    domainId: String(id),
                    status: String(newStatus)
                },
            })
                .done(function (data) {
                    // if(subpage == 'deallist'){
                    // var redirectURL = adminUrl+'deals';
                    // }
                    // else if(subpage == 'hotdeallist'){
                    // var redirectURL = adminUrl+'hotdeals';
                    // }else{
                    // var redirectURL = adminUrl+'unapproved-deals';
                    // }

                    // alert_response(data,redirectURL);
                    if (newStatus == 1) {
                        swal({ title: "Sucess!", text: "<strong>status is Activate</strong>", type: "success", showConfirmButton: true, html: true }, function () { window.location.href = " " });
                    } else if (newStatus == 0) {
                        swal({ title: "Sucess!", text: "<strong>status is Inctivate</strong>", type: "success", showConfirmButton: true, html: true }, function () { window.location.href = " " });
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