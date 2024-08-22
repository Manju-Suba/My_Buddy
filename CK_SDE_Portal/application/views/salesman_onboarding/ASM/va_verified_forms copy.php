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

    /* .modal-xl {
    max-width: 1300px;
} */
#adt_details_modal{
    font-size:16px
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
                    <div class="modal fade" id="adt_details_modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Details</h5>
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
                                    <div class="col-md-12 mb-2" style="display: flex">
                                        <div class="col-md-2 ">
                                            <td>Name</td>
                                        </div>
                                        <div class="col-md-2">
                                            <td><span id="name"></span></td>
                                        </div>
                                        <div class="col-md-2">
                                            <td>Mobile</td>

                                        </div>
                                        <div class="col-md-2  mr-2">
                                            <td><span id="mobile"></span></td>

                                        </div>
                                        <div class="col-md-2">
                                            <td>WhatsApp Number</td>

                                        </div>
                                        <div class="col-md-2">
                                            <td><span id="w_num"></span></td>

                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2" style="display: flex">
                                        <div class="col-md-2">
                                            <td class="col-md-3">Date of Birth</td>
                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3"><span id="dob"></span></td>
                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3">Email ID</td>

                                        </div>
                                        <div class="col-md-2 mr-2">
                                            <td class="col-md-3 "><span id="email"></span></td>

                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3">Father's Name </td>

                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3"><span id="f_name"></span></td>
                                        </div>
                                    </div>



                                    <div class="col-md-12 mb-2" style="display:flex">
                                        <div class="col-md-2">
                                            <td class="col-md-3">Address</td>
                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3"><span id="address"></span></td>
                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3">Date of Joining </td>

                                        </div> 
                                        <div class="col-md-2  mr-2">
                                            <td class="col-md-3"><span id="doj"></span></td>

                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3">Experience </td>

                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3"><span id="experience"></span></td>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2" style="display:flex">
                                        <div class="col-md-2">
                                            <td class="col-md-3">Education </td>
                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3 "><span id="education"></span></td>
                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3">Age </td>

                                        </div>
                                        <div class="col-md-2  mr-2">
                                            <td class="col-md-3"><span id="age"></span></td>

                                        </div>
                                        <div class="col-md-2 ">
                                            <td class="col-md-3">Terrain Knowledge</td>

                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3"><span id="terrain_knowledge"></span></td>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2" style="display:flex">
                                        <div class="col-md-2">
                                            <td class="col-md-3">Technology Adaption </td>
                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3"><span id="tech_adoption"></span></td>
                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3">Family Background </td>

                                        </div>
                                        <div class="col-md-2  mr-2">
                                            <td class="col-md-3"><span id="family_bg"></span></td>

                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3">Sales Category </td>

                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3"><span id="sales_cat"></span></td>
                                        </div>
                                    </div>

                                    
                                    <div class="pb-2 pt-2 ml-2">
                                        <h5>Additional Details</h5>
                                    </div>
                                    <div class="col-md-12 mb-2" style="display:flex">
                                        <div class="col-md-2">
                                            <th class="col-md-6">Sales Type </th>
                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-6"><span id="sales_type"></span></td>
                                        </div>
                                    </div>


                                    <div class="col-md-12 mb-2 ex_details" id="ex_details" style="display:none">

                                        <div class="col-md-2">
                                            <th class="col-md-3">Existing RSSM Name</th>

                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3"><span id="ex_rssm_name"></span></td>

                                        </div>
                                        <div class="col-md-2">
                                            <th class="col-md-3">Existing RSSM Number </th>

                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-3"><span id="ex_rssm_number"></span></td>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2 new_details" id="ex_details" style="display:none">
                                        <div class="col-md-2">
                                        <td class="col-md-3">Region</td>
                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-3"><span id="region"></span></td>
                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6">RS Name</td>

                                        </div>
                                        <div class="col-md-2  mr-2">
                                        <td class="col-md-6"><span id="rs_name"></span></td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-3">RS Code </td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-3"><span id="rs_code"></span></td>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2 new_details" id="ex_details" style="display:none">
                                        <div class="col-md-2">
                                        <td class="col-md-3">SDE Name </td>
                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-3"><span id="name"></span></td>
                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-3">ASM Name </td>

                                        </div>
                                        <div class="col-md-2  mr-2">
                                        <td class="col-md-3"><span id="name"></span></td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-3">State Name </td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="rs_state"></span></td>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2 new_details" id="ex_details" style="display:none">
                                        <div class="col-md-2">
                                        <td class="col-md-3">District Name </td>
                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="rs_dist"></span></td>
                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6">City Name </td>

                                        </div>
                                        <div class="col-md-2  mr-2">
                                        <td class="col-md-6"><span id="rs_city"></span></td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6">Town Name</td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="rs_town"></span></td>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2 new_details" id="ex_details" style="display:none">
                                        <div class="col-md-2">
                                        <td class="col-md-6">Town Code</td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="rs_town_code"></span></td>
                                        </div>

                                    </div>
                                  

                                    <div class="pb-2 pt-2 ml-2">
                                        <h5>Bank Details</h5>
                                    </div>

                                    <div class="col-md-12 mb-2 " id="ex_details" style="display:flex">
                                        <div class="col-md-2">
                                        <td class="col-md-6">Bank Name </td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="bank_name"></span></td>
                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6">Aadhar Number </td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="aadhar"></span></td>
                                        </div>

                                        <div class="col-md-2">
                                        <td class="col-md-6"> Aadhar copy </td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="aadhar_copy"></span></td>
                                        </div>

                                        

                                    </div>   
                                    
                                    <div class="col-md-12 mb-2 " id="ex_details" style="display:flex">
                                        <div class="col-md-2">
                                            <td class="col-md-6">Cheque Copy </td>

                                        </div>
                                        <div class="col-md-2">
                                            <td class="col-md-6"><span id="cheque"></span></td>
                                        </div>

                                        <div class="col-md-2">
                                        <td class="col-md-6">PAN Number </td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="pan"></span></td>
                                        </div>

                                        <div class="col-md-2">
                                        <td class="col-md-6"> PAN Copy </td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="pan_copy"></span></td>
                                        </div>

                                        

                                    </div>   

                                    <div class="col-md-12 mb-2 " id="ex_details" style="display:flex">
                                        <div class="col-md-2">
                                        <td class="col-md-6">A/C Number </td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="ac_number"></span></td>
                                        </div>

                                        <div class="col-md-2">
                                        <td class="col-md-6">A/C Type </td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="ac_type"></span></td>
                                        </div>

                                        <div class="col-md-2">
                                        <td class="col-md-6">IFSC Code </td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="ifsc_s_number"></span></td>
                                        </div>

                                        

                                    </div>   

                                    <div class="col-md-12 mb-2 " id="ex_details" style="display:flex">
                                        <div class="col-md-2">
                                        <td class="col-md-6">Branch Name :</td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="branch_name"></span></td>
                                        </div>

                                        <div class="col-md-2">
                                        <td class="col-md-6">Image Captured</td>

                                        </div>
                                        <div class="col-md-2">
                                        <td class="col-md-6"><span id="img_file"></span></td>
                                        </div>

                                      
                                        

                                    
                                    
                                </div>
                                <div class="modal-footer">
                                <!-- <input type="hidden" name="table_row_id" id="table_row_id"> -->

                                <!-- <button type="button" class="btn btn-info" id="approved">Approved</button>
                                <button type="button" class="btn btn-info" id=" future_prospect">Future Prospect</button> -->
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="action_pop_modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ASM Action</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                            aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group col-md-6">
                                        <label>Status*</label>
                                        <select name="f_asm_status" id="f_asm_status"
                                            class="form-control single-select">
                                            <option value="">Select</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Future Prospect">Future Prospect</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" id="asm_action_btn">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        id="action_close">Close</button>
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
                                    <label for="">SDE List</label>
                                    <select name="af_tso_list" id="af_tso_list"
                                        class="form-control form-control-sm single-select">

                                    </select>
                                </div>
                                <!-- <div class="col-md-3">
                                    <label for="">VA Status</label>
                                    <select name="af_va_status" id="af_va_status"
                                        class="form-control form-control-sm single-select">
                                        <option value="">Select</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Verified">Verified</option>
                                        <option value="Not Verified">Not Verified</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">ASM Status</label>
                                    <select name="af_asm_status" id="af_asm_status"
                                        class="form-control form-control-sm single-select">
                                        <option value="">Select</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Future Prospect">Future Prospect</option>
                                    </select>
                                </div> -->
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
                                            <th>ASM Status</th>
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
    <script src="<?php echo asset_url();?>pro_js/sales/ASM/va_verified_forms.js"></script>
    <!--notification js -->
    <script src="<?php echo asset_url();?>plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/notifications/js/notifications.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/notifications/js/notification-custom-script.js"></script>
    <script src="<?php echo asset_url();?>plugins/select2/js/select2.min.js"></script>

    <script>
    var BASE_URL = "<?php echo base_url();?>index.php/salesman_onboarding/";

    $(".va_vform_m").addClass("mm-active");
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