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
    .price-sec-wrap {
        width: 100%;
        float: left;
        padding: 60px 0;
        font-family: 'Lato', sans-serif;
    }
    .main-heading {
        text-align: center;
        font-weight: 600;
        padding-bottom: 15px;
        position: relative;
        text-transform: capitalize;
        font-size: 24px;
        margin-bottom: 25px;
    }
    .price-box {
        box-shadow: 0 0 35px rgba(0, 0, 0, 0.10);
        padding: 20px;
        background: #fff;
        border-radius: 4px;
    }
    .price-box ul {
        margin: 17px 0 0 0;
        list-style: initial;
        border-top: solid 1px #e9e9e9;
    }
    .price-box ul li {
        padding: 7px 0;
        font-size: 14px;
        color: #808080;
    }
    .price-box ul li .fas {
        color: #68AE4A;
        margin-right: 7px;
        font-size: 12px;
    }
    .price-label {
        font-size: 16px;
        font-weight: 600;
        line-height: 1.34;
        margin-bottom: 0;
        padding: 6px 15px;
        display: inline-block;
        border-radius: 3px;
    }
    .price-label.basic {
        background: #E8EAF6;
        color: #3F51B5;
    }
    .price-label.value {
        background: #E8F5E9;
        color: #4CAF50;
    }
    .price-label.premium {
        background: #FBE9E7;
        color: #FF5722;
    }
    .price {
        font-size: 44px;
        line-height: 44px;
        margin: 15px 0 6px;
        font-weight: 900;
    }
    .price-info {
        font-size: 14px;
        font-weight: 400;
        line-height: 1.67;
        color: inherit;
        width: 100%;
        margin: 0;
        color: #989898;
    }
    .plan-btn {
        text-transform: uppercase;
        font-weight: 600;
        display: block;
        padding: 11px 30px;
        border: 2px solid #b3b3b3;
        color: #000;
        margin-top: 5px;
        overflow: hidden;
        position: relative;
        z-index: 1;
        margin: 0;
        border-radius: 5px;
        text-decoration: none;
        width: 100%;
        text-align: center;
        font-size: 14px;
    }
    .plan-btn::after {
        position: absolute;
        left: -100%;
        top: 0;
        content: "";
        height: 100%;
        width: 100%;
        background: #000;
        z-index: -1;
        transition: all 0.35s ease-in-out;
    }
    .plan-btn:hover::after {
        left: 0;
    }
    .plan-btn:hover,
    .plan-btn:focus {
        text-decoration: none;
        color: #fff;
        border: 2px solid #000;
    }
    @media (max-width: 991px) {
        .price-box {
            margin-bottom: 20px;
        }
    }
    @media (max-width: 575px) {
        .main-heading {
            font-size: 21px;
        }
        .price-box {
            margin-bottom: 20px;
        }
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
                                <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Dashboard</a></li>
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
                                    <h4 class="card-title mb-4"><?=$title?></h4>
                                </div>
                                <div class="col-sm-2 text-end" style="padding-left: 54px;">
                                    <a href="<?=url('admin/listing/add')?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;Add</a>
                                </div>
                            </div>
                            <div class="">
                                <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap"
                                    rel="stylesheet">
                                <link rel="stylesheet" type="text/css"
                                    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
                                <div class="price-sec-wrap">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-8 offset-md-2">
                                                <div class="main-heading">PRICING TABLE</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <?php
                                        if (!empty(@$result)) {
                                            foreach (@$result as $k => $v) {
                                                $type = '';
                                                if ($v->type == 1) {
                                                    $type = 'Month';
                                                } else if ($v->type == 2) {
                                                    $type = 'Year';
                                                }
                                                ?>
                                            <div class="col-lg-4">
                                                <div class="price-box">
                                                    <div class="">
                                                        <div class="price-label basic"><?= @$v->name; ?></div>
                                                        <div class="price">$<?= @$v->amount; ?></div>
                                                        <div class="price-info">For <?= @$v->duration. ' ' . @$type; ?></div>
                                                    </div>
                                                    <div class="info"><?= @$v->description; ?>
                                                        <?php
                                                        $checksubscription = DB::table('transaction')->where('user_id', @$userId)->where('payment_type', '1')->where('status', 'succeeded')->first();
                                                        if(!empty($checksubscription) && $checksubscription->sub_id == @$v->id) { ?>
                                                        <a href="javascript:void(0)" class="plan-btn">Plan Activated</a>
                                                        <?php } else { ?>
                                                        <a href="<?=  url('admin/users/payment?uid=' . @$userId . '&sid=' . @$v->id . ''); ?>" class="plan-btn">Join Basic Plan</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                </div>
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
                    window.location.href = '<?= url('admin/listing/delete-listing/') ?>/' + dealId
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
                url: '<?php echo url('admin/listing/changestatus'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    "_token": "{{ csrf_token() }}"
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