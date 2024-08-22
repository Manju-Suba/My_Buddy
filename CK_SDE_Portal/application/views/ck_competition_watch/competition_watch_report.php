<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>CK Competition Watch</title>
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
                    <!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                        <div class="breadcrumb-title pr-3">Form Details</div>
                        <div class="pl-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i
                                                class='bx bx-home-alt'></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Entered Forms</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                    <!--end breadcrumb-->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary radius-30 px-5 m-3" data-toggle="modal"
                        data-target="#popimgbtn" style="display:none;">Card Modal</button>
                    <!-- Modal -->
                    <div class="modal fade" id="popimgbtn" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">
                                <div class="">
                                    <div class="card mb-0">
                                        <img src="" id="pop_img_show" class="card-img-top" alt="...">
                                        <div class="card-body">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="popadtbtn" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Comment</h5>
                                    <button type="button" class="close" id="comment_model_close" data-dismiss="modal"
                                        aria-label="Close"> <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="commentForm">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Supervisor Comment</label>
                                            <input type="hidden" name="edit_row_id" id="edit_row_id">
                                            <textarea name="supervisor_comment" id="supervisor_comment"
                                                class="form-control" required></textarea>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Weightage</label>
                                            <select name="weightage" id="weightage" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="10g">10g</option>
                                                <option value="100g">100g</option>
                                                <option value="1000g">1000g</option>
                                            </select>
                                        </div> -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="popadtviewbtn" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">View Comment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                            aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="card-title">Supervisor Comment</h6>
                                    <p class="card-text" id="view_supervisor_comment"></p>
                                    <!-- <h6 class="card-title">Weightage</h6>
										<p class="card-text" id="view_weightage"></p>
                                     -->
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0">Entered Forms</h4>

                                    </div>
                                    <div class="col-md-6">
                                        <?php 

                                            if($this->session->userdata('role_type') == 'SM' || $this->session->userdata('role_type') == 'TSO'){
                                            ?>
                                                <a href="<?php echo base_url();?>index.php/Competition/add_competition_watch"><button
                                                type="button" class="btn btn-primary add_form_btn" style="float:right;">Add
                                                Form</button></a>
                                        <?php
                                        }
                                    ?>
                                    </div>
                                </div>

                            </div>
                            <hr />

                            <input type="hidden" name="session_role_type" id="session_role_type"
                                value="<?php echo $this->session->userdata('role_type'); ?>">
                            <input type="hidden" name="session_mobile_no" id="session_mobile_no"
                                value="<?php echo $this->session->userdata('mobile'); ?>">

                            <div class="row">
                                <?php if($this->session->userdata('role_type') == 'LEADER' || $this->session->userdata('role_type')== 'MLEADER' || $this->session->userdata('role_type')== 'VA' || $this->session->userdata('role_type')== 'ZSM'){?>
                                    <div class="col-md-2 col-sm-6 mb-2" >
                                        <label for=""><b>Business</b></label>
                                        <select class="form-control form-control-sm" name="business" id="business" >
                                            <option value="" selected disabled>Select...</option>
                                            <!-- <option value="AB Urban">AB Urban</option>
                                            <option value="FMCG Rural">FMCG Rural</option>
                                            <option value="PC URBAN">PC URBAN</option> -->
                                            <option value="FMCG URBAN">FMCG URBAN</option>
                                            <option value="FMCG RURAL">FMCG RURAL</option>
                                            <option value="AB EXCLUSIVE">AB EXCLUSIVE</option>
                                            <option value="SNACKS">SNACKS</option>
                                            <option value="FMCG MT">FMCG MT</option>
                                        </select>
                                    </div>
                                <?php } ?>

                                <div class="col-md-3 lead_view" style="display:none;">
                                    <label for="">ZSM List</label>
                                    <select name="af_zsm_list" id="af_zsm_list" class="form-control form-control-sm">

                                    </select>
                                </div>

                                <div class="col-md-3 lead_view zsm_view" style="display:none;">
                                    <label for="">ASM List</label>
                                    <select name="af_asm_list" id="af_asm_list" class="form-control form-control-sm">

                                    </select>
                                </div>

                                <div class="col-md-3 lead_view zsm_view asm_view" style="display:none;">
                                    <label for="">TSO List</label>
                                    <select name="af_tso_list" id="af_tso_list" class="form-control form-control-sm">

                                    </select>
                                </div>

                                <div class="col-md-3 lead_view zsm_view asm_view tso_view" style="display:none;">
                                    <label for="">SM List</label>
                                    <select name="af_sm_list" id="af_sm_list" class="form-control form-control-sm">

                                    </select>
                                </div>

                                <div class="col-md-3 lead_view zsm_view asm_view tso_view">
                                    <br>

                                    <button class="brn btn-sm btn-warning" id="filterClearbtn">Clear</button>
                                </div>
                            </div>
                            <hr />

                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Date</th>
                                            <th>Source</th>
                                            <th>Insight Category</th>
                                            <th>Comment</th>
                                            <th>Images</th>
                                            <th>Created By</th>
                                            <th>Created On</th>
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


    <script src="<?php echo asset_url();?>pro_js/ck_competition_watch/cw_asm_report.js"></script>

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