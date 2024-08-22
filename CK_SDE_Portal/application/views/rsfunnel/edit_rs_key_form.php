<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RS Recruitment</title>
    <!--favicon-->
    <link rel="icon" href="<?php echo asset_url();?>images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?php echo asset_url();?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>plugins/smart-wizard/css/smart_wizard_all.min.css" rel="stylesheet"
        type="text/css" />
    <!-- loader-->
    <link href="<?php echo asset_url();?>css/pace.min.css" rel="stylesheet" />
    <script src="<?php echo asset_url();?>js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap.min.css" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="<?php echo asset_url();?>css/icons.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="<?php echo asset_url();?>css/app.css" />
    <link rel="stylesheet" href="<?php echo asset_url();?>css/dark-sidebar.css" />
    <link rel="stylesheet" href="<?php echo asset_url();?>css/dark-theme.css" />
    <link href="<?php echo asset_url();?>plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <!-- Notification -->
    <link rel="stylesheet" href="<?php echo asset_url();?>plugins/notifications/css/lobibox.min.css" />
    
    <style>
        .toolbar-top {
            display: none;
        }

        #reset-btn {
            display: none;
        }

        .nav-link {
            z-index: 9;
        }

        .sw-theme-dots .toolbar>.btn-info {
            display: none;
        }
    </style>
</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <!--sidebar-wrapper-->
        <!--sidebar-wrapper-->
        <?php include('application/views/layouts/sidebar.php'); ?>

        <!--end sidebar-wrapper-->
        <!--header-->
        <?php include('application/views/layouts/topbar.php'); ?>

        <!--end header-->
        <!--page-wrapper-->
        <div class="page-wrapper">
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="card">
                        <div class="card-header">Edit Key Performance</div>
                        <div class="card-body">
                            <button class="btn btn-danger" id="reset-btn" type="button">Reset Wizard</button>
                                <div class="tab-content">
                                    <form action="javascript:void(0)" method="POST" id="rsKeyForm">

                                    <div class="tab-pane" role="tabpanel">
                                    
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>STOCKS AS PER NORM (both EPDs & NPDs)</label>
                                                    <input type="hidden" name="edit_row_id" id="edit_row_id">

                                                    <select name="key_stocks" id="key_stocks" class="form-control single-select">
                                                    <option value="">Select</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Infra RSSM vs Actual</label>
                                                    <select name="key_infra" id="key_infra" class="form-control single-select">
                                                    <option value="">Select</option>

                                                    </select>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Infra Delivery Vehicle vs Actual</label>

                                                    <select name="key_infra_delivery" id="key_infra_delivery" class="form-control single-select">
                                                    <option value="">Select</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Number of RED RSSM</label>
                                                    <select name="key_number" id="key_number" class="form-control single-select">
                                                    <option value="">Select</option>

                                                    </select>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Order Vs Delivery</label>

                                                    <select name="key_order" id="key_order"
                                                        class="form-control">
                                                        <option value="">Select</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>FF Absenteeism (HoW & Total calls condition)</label>
                                                    <select name="key_ffabsenteeism" id="key_ffabsenteeism" class="form-control single-select">
                                                    <option value="">Select</option>

                                                    </select>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>FF Absenteeism (Actual Absent)</label>

                                                    <select name="key_ffabsenteeism_actual" id="key_ffabsenteeism_actual"
                                                        class="form-control single-select">
                                                        <option value="">Select</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>NPD Investment</label>
                                                    <select name="key_npd" id="key_npd" class="form-control single-select">
                                                    <option value="">Select</option>

                                                    </select>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Financials</label>

                                                    <select name="key_financials" id="key_financials"
                                                        class="form-control single-select">
                                                        <option value="">Select</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>INFRASTRUCTURE - Warehouse</label>
                                                    <select name="key_infrastructure" id="key_infrastructure" class="form-control single-select">
                                                    <option value="">Select</option>

                                                    </select>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>SSFA = XDM</label>

                                                    <select name="key_ssfa" id="key_ssfa"
                                                        class="form-control single-select">
                                                        <option value="">Select</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>XDM regular usage (daily usage)</label>
                                                    <select name="key_xdm" id="key_xdm" class="form-control single-select">
                                                    <option value="">Select</option>

                                                    </select>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Issues Raised with SDE</label>

                                                    <select name="key_issues_raised" id="key_issues_raised"
                                                        class="form-control single-select">
                                                        <option value="">Select</option>

                                                    </select>
                                                </div>
                                                

                                            </div>
                                        </div>
                                    <div class="tab-pane" role="tabpanel" >
                                        <div class="container">
                                            <button class="btn btn-success" type="submit" value="submit" >Update</button>
                                            <button class="btn btn-info"  onclick="location.href='<?php echo base_url();?>index.php/rsfunnel/RSController/list_rs_key_form'" type="button">Cancel</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end page-content-wrapper-->
        </div>
        <!--end page-wrapper-->
        <!--start overlay-->
        <div class="overlay toggle-btn-mobile"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <!--footer -->
        <?php include('application/views/layouts/footer.php'); ?>

        <!-- end footer -->
    </div>
    <!-- end wrapper -->
    <!--start switcher-->

    <!--end switcher-->
    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="<?php echo asset_url();?>js/popper.min.js"></script>
    <script src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
    <!--plugins-->
    <script src="<?php echo asset_url();?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?php echo asset_url();?>plugins/smart-wizard/js/jquery.smartWizard.min.js"></script>

    <script src="<?php echo asset_url();?>plugins/select2/js/select2.min.js"></script>
    <!--notification js -->
    <script src="<?php echo asset_url();?>plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/notifications/js/notifications.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/notifications/js/notification-custom-script.js"></script>
    
    <script src="<?php echo asset_url();?>pro_js/rsfunnel/edit_rs_key.js"></script>

    <script>
        var BASE_URL = "<?php echo base_url();?>index.php/rsfunnel/";
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
    <script>
            var BASE_URL1 = "<?php echo base_url();?>index.php/";

        $(document).ready(function () {
            $(".keyform_m").addClass("mm-active");

            
        });
    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>
</body>

</html>

