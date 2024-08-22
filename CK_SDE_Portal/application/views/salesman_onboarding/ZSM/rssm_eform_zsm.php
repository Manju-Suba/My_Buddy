<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>RSSM Recruitment</title>
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

    <link rel="stylesheet" href="<?php echo asset_url();?>css/response_table.css">
    <link href="<?php echo asset_url();?>plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <!-- Notification -->
    <link rel="stylesheet" href="<?php echo asset_url();?>plugins/notifications/css/lobibox.min.css" />

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

    .modal_trigger_btn {
        display: none;

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

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary modal_trigger_btn" data-toggle="modal"
                        data-target="#adt_details_modal" id="adt_details_modal_btn">Basic
                        Modal</button>
                    <!-- Modal -->
                    <div class="modal fade" id="view_additional_details" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
                        data-keyboard="false">
                        <div class="modal-dialog modal-xl modal-lg modal-md modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">SalesMan Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                            aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- <table class="table" id="adt_tb"> -->
                                    <!-- <thead>
                                            <tr>
                                                <th>Parameter</th>
                                                <th>SDE Slab</th>
                                                <th>SDE Points</th> -->
                                    <!-- <th>VSO Slab</th>
                                                <th>VSO Points</th> -->
                                    <!-- </tr>
                                        </thead> -->
                                    <!-- <tbody id="adt_tb_body"> -->
                                    <div class="pb-2 pt-2" style="padding-left: 5px;">
                                        <h5><b>Basic Details :</b></h5>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Name</b>
                                        </div>
                                        <div class=" col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="name"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Mobile</b>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="mobile"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>WhatsApp Number</b>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="w_num"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Date of Birth</b>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="dob"></span>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Date of Joining </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="doj"></span>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Father's Name</b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="f_name"></span>
                                        </div>



                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Address</b>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="address"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Email ID</b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="email"></span>

                                        </div>

                                    </div>
                                    <hr>
                                    <div class="pb-2 pt-2" style="padding-left: 5px;">
                                        <h5><b>Additional Details :</b></h5>
                                    </div>
                                    <div class="row">

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Experience </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="experience"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Education</b>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <td class="col-md-3 "><span id="education"></span></td>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <td class="col-md-3"><b>Age </b></td>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <td class="col-md-3"><span id="age"></span></td>

                                        </div>
                                        <div class=" col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <td class="col-md-3"><b>Terrain Knowledge</b></td>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <td class="col-md-3"><span id="terrain_knowledge"></span></td>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <td class="col-md-3"><b>Technology Adaption </b></td>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <td class="col-md-3"><span id="tech_adoption"></span></td>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <td class="col-md-3"><b>Family Background </b></td>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <td class="col-md-3"><span id="family_bg"></span></td>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <td class="col-md-3"><b>Sales Category</b> </td>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <td class="col-md-3"><span id="sales_cat"></span></td>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Service Fee</b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="service_fee"></span>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="pb-2 pt-2" style="padding-left: 5px;">
                                        <h5><b>Other Details :</b></h5>
                                    </div>
                                    <div class="row mb-2" style="display:flex">
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <th class="col-md-6"><b>Sales Type</b> </th>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="sales_type"></span></td>
                                        </div>
                                    </div>


                                    <div class="row ex_details" id="ex_details" style="display:none">

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Existing RSSM Name </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="ex_rssm_name"></span>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Existing RSSM Number </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="ex_rssm_number"></span>
                                        </div>
                                        
                                    </div>

                                    <div class="row new_details" id="ex_details" style="display:none">
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Region</b>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="region"></span>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>RS Name</b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td ">
                                            <span id="rs_name"></span>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>RS Code </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="rs_code"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>SDE Name </b>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="tso_name"></span>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>ASM Name </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td ">
                                            <span id="asm_name"></span>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <td class="col-md-3"><b>State Name</b> </td>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="rs_state"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>District Name </b>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="rs_dist"></span></td>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>City Name </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="rs_city"></span>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Town Name</b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="rs_town"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Town Code</b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="rs_town_code"></span>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="pb-2 pt-2" style="padding-left: 5px;">
                                        <h5><b>Bank Details :</b></h5>
                                    </div>

                                    <div class=" row ">
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Bank Name </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="bank_name"></span>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Aadhar Number </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="aadhar"></span>
                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Aadhar Front Side</b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="aadhar_copy"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Aadhar Back Side</b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="aadhar_backview_copy"></span>
                                        </div>




                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Cheque Copy </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="cheque"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>PAN Number </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="pan"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>PAN Copy </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="pan_copy"></span>
                                        </div>




                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>A/C Number </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="ac_number"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>A/C Type </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="ac_type"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>IFSC Code </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="ifsc_s_number"></span>
                                        </div>




                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>Branch Name </b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="branch_name"></span>
                                        </div>

                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 th">
                                            <b>SalesMan Image</b>

                                        </div>
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 td">
                                            <span id="img_file"></span>
                                        </div>
                                         
                                        <span style="display:none" name="table_row_id" id="table_row_id"></span>

                                        <!-- "RRF00336" -->

                                    </div>


                                    </tr>
                                    <tr>
                                    </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="session_mobile_no" id="session_mobile_no"
                        value="<?php echo $this->session->userdata('mobile'); ?>">

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4 class="mb-0">Entered Forms</h4>
                            </div>
                            <hr />
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <label for="">ASM List</label>
                                    <select name="af_asm_list" id="af_asm_list" class="form-control form-control-sm single-select">

                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="">SDE List</label>
                                    <select name="af_tso_list" id="af_tso_list" class="form-control form-control-sm single-select">

                                    </select>
                                </div>
                                <!-- <div class="col-md-3">
                                    <label for="">VSO Status</label>
                                    <select name="af_va_status" id="af_va_status"
                                        class="form-control form-control-sm single-select">
                                        <option value="">Select</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Verified">Verified</option>
                                        <option value="Not Verified">Not Verified</option>
                                    </select>
                                </div> -->
                                <div class="col-md-3">
                                    <label for="">ASM Status</label>
                                    <select name="af_asm_status" id="af_asm_status"
                                        class="form-control form-control-sm single-select">
                                        <option value="">Select</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Future Prospect">Future Prospect</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Action</label>
                                    <br>
                                    <button class="btn btn-warning" type="button" id="btnClear">Clear</button>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table id="enteredForm_tb" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Sno</th>
                                            <th>Name</th>
                                            <th>Mobile No</th>
                                            <!-- <th>State</th> -->
                                            <!-- <th>District</th> -->
                                            <th>Created On</th>
                                            <!-- <th>VSO Status</th> -->
                                            <th>Status</th>
                                            <th>SDE Score</th>
                                            <!-- <th>VSO Score</th> -->
                                            <th>Created By</th>
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
    <!--start switcher-->

    <!--end switcher-->
    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="<?php echo asset_url();?>js/popper.min.js"></script>
    <script src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
    <!--plugins-->
    <script src="<?php echo asset_url();?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Data Tables js-->
    <script src="<?php echo asset_url();?>plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url();?>pro_js/sales/ZSM/zsm_ef_rssm.js"></script>
    <!--notification js -->
    <script src="<?php echo asset_url();?>plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/notifications/js/notifications.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/notifications/js/notification-custom-script.js"></script>
    <script src="<?php echo asset_url();?>plugins/select2/js/select2.min.js"></script>

    <script>
    var BASE_URL = "<?php echo base_url();?>index.php/salesman_onboarding/";
    var url = "<?php echo base_url();?>";

    $(".asm_eform_m").addClass("mm-active");
    $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    $(document).ready(function() {
       
    });
    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>
</body>

</html>