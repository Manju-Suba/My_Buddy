<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Comercial Pending</title>
    <link href="<?php echo asset_url(); ?>plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo asset_url(); ?>plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css">
    <!--favicon-->
    <link rel="icon" href="<?php echo asset_url(); ?>images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?php echo asset_url(); ?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php echo asset_url(); ?>plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?php echo asset_url(); ?>plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url(); ?>plugins/smart-wizard/css/smart_wizard_all.min.css" rel="stylesheet"
        type="text/css" />
    <!-- loader-->
    <link href="<?php echo asset_url(); ?>css/pace.min.css" rel="stylesheet" />
    <script src="<?php echo asset_url(); ?>js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap.min.css" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/icons.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/app.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/dark-sidebar.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/dark-theme.css" />
    <link href="<?php echo asset_url(); ?>plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url(); ?>plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <!-- Notification -->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/notifications/css/lobibox.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        @media (min-width: 334px) and (max-width: 380px) {
            .sw-theme-dots .toolbar>.btn {
                padding: 0.375rem 0.5rem;
            }

            .lapview{
                padding-left: 0px !important;
            }
        }

        @media (min-width: 384px) {
            .lapview{
                padding-left: 20px !important;
            }
        }

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

        @media(max-width:650px) {
            .show_new {
                height: 1401px !important;
            }
        }

        @media (min-width:700px) {
            .show_new {
                height: 780px !important;
            }
            .show_new_beat{

            }
        }

        @media(max-width:650px) {
            .show_ex {
                height: 249px !important;
            }
        }

        @media (min-width:700px) {
            .show_ex {
                height: 165.938px !important;

            }
        }




        input#image_file {
            height: calc(1.2em + 1.1rem + 2px);
            line-height: 1.2;
            padding: 0.35rem 0.75rem;
        }
        input[type=file] {
            height: calc(1.2em + 1.1rem + 2px);
            line-height: 1.2;
            padding: 0.35rem 0.75rem;
        }

        .req {
            color: red;
        }

        @media (max-width: 450px) {
            .col-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 48%;
                margin-left: 5px;
            }
        }
    </style>
</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <!--sidebar-wrapper-->
        <!--sidebar-wrapper-->
        <?php include('application/views/layouts/onboarding_sidebar.php'); ?>

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
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0">RS Onboarding Pending</h4>
										<input type="hidden" name="session_user_name" id="session_user_name" value="<?php echo $this->session->userdata('username'); ?>">
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="table-responsive">
                                <table id="comercial_pending_data" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr >
                                            <th>S.No</th>
                                            <th>RS Type</th>
                                            <th>Appoinment Reason</th>
                                            <th>Firm Title</th>
                                            <th>Ownership Status</th>
                                            <th>GST No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end page-content-wrapper-->

            <input type="hidden" id="approve_id" name="approve_id" value="">
        </div>
        <?php include('application/views/rs_onboarding/Common/view_model.php'); ?>
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

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/popper.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>

    <!--notification js -->
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/notifications.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/notification-custom-script.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/datatable/js/jquery.dataTables.min.js"></script>

 
    <!--plugins-->
    <script src="<?php echo asset_url(); ?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/smart-wizard/js/jquery.smartWizard.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/select2/js/select2.min.js"></script>

    <script src="<?php echo asset_url(); ?>pro_js/rs_onboarding/Comercial/comercial.js"></script>

    <script>
        var BASE_URL = "<?php echo base_url();?>index.php/rs_onboarding/ComercialController/";
        var STATUS = "Pending";
        var TABLE_NAME = "#comercial_pending_data";
        var UPDATE_STATUS = "comercial_status";
        var url = "<?php echo base_url(); ?>";
    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url(); ?>js/app.js"></script>
</body>

</html>