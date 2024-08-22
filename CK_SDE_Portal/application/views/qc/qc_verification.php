<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Salesman Onboarding</title>
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



        .nav-tabs .nav-link {
            border: none
        }

        .border {
            padding: 2px;
            border: solid 1px black;
        }

        .em {
            color: red;
        }

        .modal-xl {
            max-width: 1350px !important;
        }

        @media (max-width: 450px) {
            .col-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 48%;
                margin-left: 5px;
            }
        }

        .modal {
            padding: 10px !important;
        }


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
        .btn-primary {
    color: #fff;
    background-color: #3a4fb7;
    border-color: #3a4fb7;
}
    </style>

</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <!--sidebar-wrapper-->
        <!--sidebar-wrapper-->
        <!-- <!?php include('application/views/layouts/sales.php'); ?> -->

        <!--end sidebar-wrapper-->
        <!--header-->
        <?php include('application/views/layouts/topbar.php'); ?>

        <!--end header-->
        <!--page-wrapper-->
        <div class="page-wrapper">
            <!--page-content-wrapper-->
            <!-- <div class="page-content-wrapper"> -->
                <div class="page-content">
                    <div class="card p-4">
                        <h4 class="mb-0">QC Verification</h4>
                        <hr />
                        <div class="table-responsive ml-1">
                            <!-- <input type="hidden" name="tso" id="get_tso_num"
                                                    value="<?php echo $this->session->userdata('mobile'); ?>"> -->
                            <table id="qc_verification" class="table table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Name</th>
                                        <th>Mobile No</th>
                                        <th>ASM Status</th>
                                        <th>Created On</th>
                                          <!-- <th>Business Division</th> -->
                                        <!-- <th>Location</th> -->
                                        <!-- <th>State</th> -->
                                        <!-- <th>Region / Zone</th> -->
                                        <!-- <th>DOB</th>
                                        <th>Father's Name</th>
                                        <th>DOJ</th>
                                        <th>Pan No.</th>
                                        <th>Aadhar No.</th>
                                        <th>Bank Account No.</th>
                                        <th>IFSC Code</th>
                                        <th>Branch Name</th>
                                        <th>Request Received Date</th>
                                        <th>Employee ID</th>
                                        <th>SSFA ID</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="modal fade" id="view_images" tabindex="-1"
                        aria-labelledby="add_additional_detailslabel" aria-hidden="true" data-backdrop="static"
                        data-keyboard="false">

                        <!-- closes on outside click -->
                        <div class="modal-dialog modal-lg modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel">SalesMan Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                    
                                        <div class="col-md-3 th">
                                            <b>Business Division</b>
                                        </div>
                                        <div class="col-md-3">
                                            <span id="division"></span>
                                        </div>

                                        <div class="col-md-3 th">
                                            <b>Location</b>
                                        </div>
                                        <div class="col-md-3">
                                            <span id="rs_town"></span>
                                        </div>

                                        <div class="col-md-3 th">
                                            <b>Region / Zone</b>
                                        </div>
                                        <div class="col-md-3">
                                            <span id="region"></span>
                                        </div>

                                        <div class="col-md-3 th">
                                            <b>State</b>
                                        </div>
                                        <div class="col-md-3">
                                            <span id="rs_state"></span>
                                        </div>

                                      
                                        <div class="col-md-3 th">
                                            <b>Name of the Candidate</b>
                                        </div>
                                        <div class="col-md-3">
                                            <span id="name"></span>
                                        </div>

                                        <div class="col-md-3 th">
                                            <b>Date of Birth</b>
                                        </div>
                                        <div class="col-md-3">
                                            <span id="dob"></span>
                                        </div>

                                        <div class="col-md-3 th">
                                            <b>Father's Name</b>
                                        </div>
                                        <div class="col-md-3">
                                            <span id="f_name"></span>
                                        </div>
                                        <hr>

                                        <div class="col-md-3 th">
                                            <b>DOJ</b>
                                        </div>
                                        <div class="col-md-3">
                                            <span id="doj"></span>
                                        </div>

                                        <div class="col-md-3 th">
                                            <b>Aadhar Card No.</b>
                                        </div>
                                        <div class="col-md-6">
                                            <span id="aadhar"></span>
                                        </div>
                                        
                                        <div class="col-md-6 th">
                                            <b>Aadhar Front Side</b>
                                            <div class="col-md-12">
                                                <span id="aadhar_copy"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 th">
                                            <b>Aadhar Back Side</b>
                                            <div class="col-md-12">
                                                <span id="aadhar_backview_copy"></span>
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-6 th mt-2">
                                            <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <b>Bank Account No</b>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span id="ac_number"></span>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <b>IFSC Code</b>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span id="ifsc_s_number"></span>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <b>Branch Name</b>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span id="branch_name"></span>
                                                </div>
                                            </div>
                                        </div>
                                       
                                      
                                        <div class="col-md-6 th">
                                            <b>Cheque Copy</b>
                                            <div class="col-md-12">
                                                <span id="cheque"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-3 th">
                                            <b>Pan card No.</b>
                                        </div>
                                        <div class="col-md-3">
                                            <span id="pan"></span>
                                        </div>

                                        <div class="col-md-6 th">
                                            <b>PAN Copy</b>
                                            <div class="col-md-12">
                                                <span id="pan_copy"></span>
                                            </div>
                                        </div>
                                        
                                       
                                      
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade image-preview" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-header" style="border-bottom: 0;">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">x</button>
                            </div>
                            <div class="modal-body">
                                <img id="image_view" style="width: 65%; margin-left: 124px;">
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
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
    <script src="<?php echo asset_url(); ?>js/popper.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
    <!--plugins-->
    <script src="<?php echo asset_url(); ?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/smart-wizard/js/jquery.smartWizard.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/select2/js/select2.min.js"></script>
    <!--notification js -->
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/notifications.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/notification-custom-script.js"></script>

    <script src="<?php echo asset_url(); ?>plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url(); ?>pro_js/qc_verification.js"></script>

    <script>
        var BASE_URL = "<?php echo base_url(); ?>index.php/";
        var url = "https://magicportal.cavinkare.in/CK_RSSM_Recruitment/";
        // var url = "https://testing_demo.cavinkare.in/SDE/CK_RSSM_Recruitment/";

        // var url = "http://localhost/CKLive/CK_RSSM_Recruitment/";
        $(document).ready(function () {
            $(".qc_verification").addClass("mm-active");
        });

    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url(); ?>js/app.js"></script>
</body>
</html>