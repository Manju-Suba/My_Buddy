<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>CK SDE Settings</title>
    <!--favicon-->
    <link rel="icon" href="<?php echo asset_url();?>images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?php echo asset_url();?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <!--Data Tables -->
    <link href="<?php echo asset_url();?>plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo asset_url();?>plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css">
    <!--plugins-->
    <link href="<?php echo asset_url();?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
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

    <!-- Notification -->
    <link rel="stylesheet" href="<?php echo asset_url();?>plugins/notifications/css/lobibox.min.css" />

    <style>
    .table td,
    .table th {
        color: #000000 !important;
    }

    .btn.disabled,
    .btn:disabled {
        cursor: not-allowed ! important;
    }

    table {
        width: 100% !important;
    }

    @media only screen and (max-width: 600px) {

        .add_form_btn{
            margin-top:-26px;
        }
    }

    </style>
</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
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
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0">Log Details</h4>

                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="session_role_type" id="session_role_type"
                                value="<?php echo $this->session->userdata('role_type'); ?>">
                            <input type="hidden" name="session_mobile_no" id="session_mobile_no"
                                value="<?php echo $this->session->userdata('mobile'); ?>">

                            <div class="date_filter" style="margin-bottom: 20px;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>From Date</label>
                                        <input type="date" class="form-control" style="width: 200px;" name="date" id="from_date_filter">
                                    </div>
                                    <div class="col-md-3">
                                        <label>To Date</label>
                                        <input type="date" class="form-control" style="width: 200px;" name="date" id="to_date_filter">
                                    </div>
                                    <div class="col-md-3">
                                        <label>User Name</label>
                                        <select class="form-control" id="user_name_filter">
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Business</label>
                                        <select class="form-control" id="business_filter">
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary" id="clear" style="margin-top: 28px;">Clear</button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>User Name</th>
                                            <th>Mobile</th>
                                            <th>Role</th>
                                            <th>Business</th>
                                            <th>Login Time</th>
                                        </tr>
                                    </thead>
                                    <tbody id="example_new">

                                    </tbody>

                                </table>
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

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo asset_url();?>js/jquery.min.js"></script>
    <script src="<?php echo asset_url();?>js/popper.min.js"></script>
    <script src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
    <!--plugins-->
    <script src="<?php echo asset_url();?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Data Tables js-->
    <script src="<?php echo asset_url();?>plugins/datatable/js/jquery.dataTables.min.js"></script>

    <!--notification js -->
    <script src="<?php echo asset_url();?>plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/notifications/js/notifications.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/notifications/js/notification-custom-script.js"></script>


    <script src="<?php echo asset_url();?>pro_js/view_details.js"></script>

    <script>
    $(document).ready(function() {
        $(".metismenu li").removeClass('mm-active');
        var page = "competition_watch";

        if (page == "competition_watch") {
            $(".eform_m").addClass("mm-active");
        }

        //Default data table
        // $('#example').DataTable();
        // var table = $('#example2').DataTable({
        // 	lengthChange: false,
        // 	buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        // });
        // table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>

    <script>
    var BASE_URL = "<?php echo base_url();?>index.php/";
    </script>
</body>

</html>
