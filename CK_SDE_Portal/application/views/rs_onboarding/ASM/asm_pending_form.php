<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>RS Appointment</title>
    <!--favicon-->
    <link rel="icon" href="<?php echo asset_url(); ?>images/favicon-32x32.png" type="image/png" />
    <!--Data Tables -->
    <link href="<?php echo asset_url(); ?>plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo asset_url(); ?>plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css">
    <!--plugins-->
    <link href="<?php echo asset_url(); ?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php echo asset_url(); ?>plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?php echo asset_url(); ?>plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
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

    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/response_table.css">
    <link href="<?php echo asset_url(); ?>plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url(); ?>plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <!-- Notification -->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/notifications/css/lobibox.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .btn-sm {
            padding: 0.15rem 0.2rem !important;
        }

        .badge {
            padding: 0.45em 0.7em !important;
        }

        @media only screen and (max-width: 600px) {

            .hide_td_title {
                display: none;
            }
        }

        /* .modal_trigger_btn {
            display: none;

        } */

        @media (max-width: 450px) {
            .col-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 48%;
                margin-left: 5px;
            }
        }

        /* .modal {
            padding: 10px !important;
        } */

        .td {
            word-wrap: break-word;
        }

        .th {
            word-wrap: break-word;
            margin-bottom: 8px;
        }
        .td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .td:hover {
            white-space: normal;
            overflow: visible;
            text-overflow: clip;
        }
    </style>
</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
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
                                <h4 class="mb-0">RS Onboarding Details</h4>
                            </div>
                            <hr />
                            <div class="">
                                <div class="table-responsive">
                                    <table id="pendingForm_tb" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Distributor Type</th>
                                                <th>Appoinment Reason</th>
                                                <th>Firm Name</th>
                                                <th>Ownership Status</th>
                                                <th>Progress Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end page-content-wrapper-->
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
    <!--start switcher-->

    <!--end switcher-->
    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="<?php echo asset_url(); ?>js/popper.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
    <!--plugins-->
    <script src="<?php echo asset_url(); ?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Data Tables js-->
    <script src="<?php echo asset_url(); ?>plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url(); ?>pro_js/rs_onboarding/onboarding_form.js"></script>

    <!--notification js --> 
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/notifications.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/notification-custom-script.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/select2/js/select2.min.js"></script>

    <script>
        $(".asm_form").addClass("mm-active");
        var BASE_URL = "<?php echo base_url();?>index.php/rs_onboarding/";
        var UPDATE_STATUS = "asm_status";
        var STATUS = "Pending";
        var TABLE_NAME = "#pendingForm_tb";
    </script>
</body>

</html>