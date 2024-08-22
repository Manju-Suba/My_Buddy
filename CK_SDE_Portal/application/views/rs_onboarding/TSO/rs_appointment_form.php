<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RS Appointment</title>
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
		.invalid-feedback{font-size:12px!important;margin:0px!important;}
        .nav-link {
            z-index: 9;
        }

        .sw-theme-dots .toolbar>.btn-info {
            display: none;
        }

        @media(max-width:690px) {
            .show_new {
                height: 1401px !important;
            }

            .show_ex {
                height: 249px !important;
            }

            .show_birep {
                height: 279px !important;
            }
        }

        @media (min-width:700px) {
            .show_new {
                height: 780px !important;
            }
            .show_ex {
                height: 170.938px !important;
            }
            .show_birep {
                height: 250.938px !important;
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

        /* //only for radio button css */
        .some-class {
            float: left;
            clear: none;
        }
        
        .some-class label {
            float: left;
            clear: none;
            display: block;
            padding: 5px 1em 0px 8px;
        }
        
        input[type=radio],
        input.radio {
            float: left;
            clear: none;
            margin: 9px 0 0 21px;
        }

        /* //multi select style */
        .select2-selection.select2-selection--multiple{
            max-height: 38px;
            overflow-y: scroll;
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
                    <!--breadcrumb-->
                    <!-- <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                        <div class="breadcrumb-title pr-3">Forms</div>
                        <div class="pl-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Wizard</li>
                                </ol>
                            </nav>
                        </div>
                        
                    </div> -->
                    <!--end breadcrumb-->
                    <div class="card">
                        <div class="card-header">RS Appointment Form</div>
                        <div class="card-body">
                            <button class="btn btn-danger" id="reset-btn" type="button">Reset Wizard</button>
                            <!-- SmartWizard html -->
                            <div id="smartwizard">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link li_step_1 active" id="li_step_1" href="#step-1"><strong>Basic Details</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link li_step_2" id="li_step_2" href="#step-2"> <strong>Additional Details</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link li_step_3" id="li_step_3" href="#step-3"> <strong>Bank Details</strong> </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link li_step_4" id="li_step_4" href="#step-4"> <strong>Financial Details</strong> </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link li_step_5" id="li_step_5" href="#step-5"> <strong>Current Infrastructure</strong> </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link li_step_6" id="li_step_6" href="#step-6"> <strong>Proposed CavinKare Infrastructure </strong> </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <form action="javascript:void(0)" method="POST" id="rs_appointment_form" class="needs-validation">
                                        <div id="step-1" class="tab-pane " role="tabpanel" aria-labelledby="step-1"
                                            style="width: unset !important;">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Distributor type <span class="req">*</span> </label>
                                                        <select name="distri_type" id="distri_type" class="form-control single-select" required="true">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                    <!-- <div class="form-group col-md-6"></div> -->
                                                    <div class="form-group col-md-6">
                                                        <label>Reason For Apointment <span class="req">*</span></label>
                                                        <select name="reason_appoint" id="reason_appoint" class="rssm_select form-control single-select" required="true">
                                                            <option value="" selected disabled>Select</option>
                                                            <option value="Expansion">Expansion</option>
                                                            <option value="Bifurcation">Bifurcation</option>
                                                            <option value="Replacement">Replacement</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="bifu_replace" style="display:none">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Existing Party's SAP RS / SS Code <span class="req">*</span></label>
                                                            <input type="text" class="form-control" name="sap_sscode"id="sap_sscode" placeholder="Enter code" required="true">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Collected all the Claims <span class="req">*</span></label><br>
                                                            <div class="some-class">
                                                                <input type="radio" id="yes" class="radio" name="claims_collected" value="yes">
                                                                <label for="yes">Yes</label>
                                                                <input type="radio" id="no" class="radio" name="claims_collected" value="no" checked="true">
                                                                <label for="no">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>NOC with Pending Claims Details <span class="req">*</span></label>
                                                            <input type="file" name="noc_pending_claims" id="noc_pending_claims"class="form-control" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf,image/*" required="true">
															<span class="invalid-feedback">Please select a file.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-2" class="tab-pane" role="tabpanel2" aria-labelledby="step-2">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Name of the Firm <span class="req">*</span></label>
                                                        <input type="text" class="form-control" name="firm_name" id="firm_name" placeholder="Firm Name" required="true" onkeypress="return blockSpecialChar(event)">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Ownership status <span class="req">*</span></label>
                                                        <select name="ownership_status" id="ownership_status" class="form-control single-select" required="true">
                                                            <option value="" selected disabled >Select</option>
                                                            <option value="Sole Proprietor">Sole Proprietor</option>
                                                            <option value="Partnership">Partnership</option>
                                                            <option value="Pvt Ltd Company">Pvt Ltd Company</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>GST Number <span class="req">*</span></label>
                                                        <input type="text" class="form-control" name="gst_number" id="gst_number" placeholder="GST Number" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>GST Registration Certificate <span class="req">*</span></label>
                                                        <input type="file" class="form-control" name="gst_reg_file" id="gst_reg_file" required="true" accept=".pdf,image/*">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>FSSAI Number <span class="req">*</span></label>
                                                        <input type="text" class="form-control" name="fssai_number" id="fssai_number" placeholder="FSSAI Number" required="true">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>FSSAI Copy <span class="req">*</span></label>
                                                        <input type="file" class="form-control" name="fssai_copy" id="fssai_copy" accept="image/*" required="true">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Name of the Contact Person <span class="req">*</span></label>
                                                        <input type="text" class="form-control" name="contact_person_name" id="contact_person_name" placeholder="Enter Name" required="true" onkeypress="return blockSpecialChar(event)">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Mobile Number <span class="req">*</span></label>
                                                        <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile No." required="true">
														<span class="invalid-feedback">Please valid mail id.</span>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Email Id <span class="req">*</span></label>
                                                        <input type="email" class="form-control" name="email_id" id="email_id" placeholder="Enter Email Id" required="true">
														<span class="invalid-feedback">Please valid mail id.</span>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label for="income">Aadhar Number <span class="req">*</span></label>
                                                        <input type="text" name="aadhar_num" onkeypress="return /[0-9.]/i.test(event.key)" class="form-control" id="aadhar_num" placeholder="Enter Aadhar No." required="true">
                                                        <span class="em" id='aadhar_num_er'></span>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Aadhar Card Front <span class="req">*</span></label>
                                                        <input type="file" class="form-control" name="aadhar_copy" id="aadhar_copy" accept="image/*" required="true">
														<span class="invalid-feedback">Please select a file.</span>
                                                        <span class="em" id='aadhar_num_er' ></span>

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Aadhar Card Back <span class="req">*</span></label>
                                                        <input type="file" class="form-control" name="aadhar_copy2" id="aadhar_copy2" accept="image/*" required="true">
														<span class="invalid-feedback">Please select a file.</span>
                                                        <span class="em" id='aadhar_num_er' ></span>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>PAN Card Number <span class="req">*</span></label>
                                                        <input type="text" class="form-control" name="pan_number" id="pan_number" placeholder="Enter Pan No." required="true">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>PAN Card Copy <span class="req">*</span></label>
                                                        <input type="file" class="form-control" name="pan_copy" id="pan_copy" accept="image/*" required="true">
														<span class="invalid-feedback">Please select a file.</span>
                                                        <span class="em" id="pan_num_er"></span>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Address <span class="req">*</span></label>
                                                        <textarea type="text" class="form-control" name="address" id="address" placeholder="Enter Address" required="true"></textarea>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Alternative Address </label>
                                                        <textarea type="text" class="form-control" name="alternative_address" id="alternative_address" placeholder="Enter Address"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-3" class="tab-pane" role="tabpanel3" aria-labelledby="step-3">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="income">IFSC Code <span class="req">*</span></label>
                                                        <input type="text" name="ifsc_code" class="form-control" maxlength="12" id="ifsc_code" placeholder="Enter IFSC Code" required="true">
                                                        <span class="em" id="ifsc_code_er"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Bank Name <span class="req">*</span></label>
                                                        <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Enter Bank Name" required="true" onkeypress="return blockSpecialChar(event)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Name of the Branch <span class="req">*</span></label>
                                                        <input type="text" name="branch_name" class="form-control" id="branch_name" placeholder="Enter Branch Name" required="true" onkeypress="return blockSpecialChar(event)">
                                                        <span class="em"></span>
                                                    </div>
                                                 
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Name of the Account Holder <span class="req">*</span></label>
                                                        <input type="text" name="ac_owner_name" class="form-control" id="ac_owner_name" placeholder="Enter Account Owner Name" required="true" onkeypress="return blockSpecialChar(event)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Account Number <span class="req">*</span></label>
                                                        <input type="text" name="ac_num" class="form-control"maxlength="18" id="ac_num" placeholder="Enter Account no." required="true" onkeypress="return blockSpecialChar(event)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Account Type <span class="req">*</span></label>
                                                        <select name="ac_type" class="form-control single-select" id="ac_type" required="true">
                                                            <option value="">Select</option>
                                                            <option value="Savings" selected>Savings</option>
                                                            <option value="Savings">Current</option>
                                                        </select>
                                                        <span class="em"></span>
                                                    </div>
                                                  
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Authosrised Signatory Name  <span class="req">*</span></label>
                                                        <input type="text" name="signatory_name" class="form-control" id="signatory_name" placeholder="Enter Signatory Name" required="true" onkeypress="return blockSpecialChar(event)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">NACH limit <span class="req">*</span></label>
                                                        <input type="text" name="nach_limit" class="form-control" id="nach_limit" placeholder="0" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Cancelled Cheque <span class="req">*</span></label>
                                                        <input type="file" name="cheque_copy" class="form-control" id="cheque_copy" accept="image/*" required="true">
														<span class="invalid-feedback">Please select a file.</span>
                                                        <span class="em"></span>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div id="step-4" class="tab-pane" role="tabpanel4" aria-labelledby="step-4">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Average Monthly Turnover <span class="req">*</span></label>
                                                        <input type="text" name="monthly_turnover" class="form-control" id="monthly_turnover" placeholder="----" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Total investment in Business <span class="req">*</span></label>
                                                        <input type="text" name="total_investment" class="form-control" id="total_investment" placeholder="----" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Own Investment funds <span class="req">*</span></label>
                                                        <input type="text" name="own_investment" class="form-control" id="own_investment" placeholder="----" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Total Borrowed Funds <span class="req">*</span></label>
                                                        <input type="text" name="borrowed_funds" class="form-control" id="borrowed_funds" placeholder="----" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Required Working Capital for CKPL <span class="req">*</span></label>
                                                        <input type="text" name="working_capital" class="form-control" id="working_capital" placeholder="----" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-5" class="tab-pane" role="tabpanel5" aria-labelledby="step-5">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Current Company Handled <span class="req">*</span></label>
                                                        <select name="handled_company[]" multiple id="handled_company" class="form-control single-select" required="true">
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">No. of Outlets Covered <span class="req">*</span></label>
                                                        <input type="text" name="outlets_covered" class="form-control" id="outlets_covered" placeholder="Enter Number" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">No. of Company Paid Salesman <span class="req">*</span></label>
                                                        <input type="text" name="paid_salesman" class="form-control" id="paid_salesman" placeholder="Enter Number" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">No. of Distributor's Salesman <span class="req">*</span></label>
                                                        <input type="text" name="dist_salesman" class="form-control" id="dist_salesman" placeholder="Enter Number" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">No. Of Delivery Units <span class="req">*</span></label>
                                                        <input type="text" name="delivery_units" class="form-control" id="delivery_units" placeholder="Enter Number" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                   
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Total Godown Size <span class="req">*</span></label>
                                                        <input type="text" name="godown_size" class="form-control" id="godown_size" placeholder="0" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Godown Pic-1 </label>
                                                        <input type="file" name="godown_pic" class="form-control" id="godown_pic" accept="image/*" >
														<span class="invalid-feedback">Please select a file.</span>
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Godown Pic-2 </label>
                                                        <input type="file" name="godown_pic2" class="form-control" id="godown_pic2" accept="image/*" >
														<span class="invalid-feedback">Please select a file.</span>
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Office Main Gate </label>
                                                        <input type="file" name="office_main_gate" class="form-control" id="office_main_gate" accept="image/*" >
														<span class="invalid-feedback">Please select a file.</span>
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Owner Picture</label>
                                                        <input type="file" name="owner_picture" class="form-control" id="owner_picture" accept="image/*" >
														<span class="invalid-feedback">Please select a file.</span>
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Computer Billing <span class="req">*</span></label><br>
                                                        <div class="some-class">
                                                            <input type="radio" id="cb_yes" class="radio" name="computer_billing" value="yes">
                                                            <label for="yes">Yes</label>
                                                            <input type="radio" id="cb_no" class="radio" name="computer_billing" value="no" checked="true">
                                                            <label for="no">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Printer Compatible for CSNG Billing <span class="req">*</span></label><br>
                                                        <div class="some-class">
                                                            <input type="radio" id="csng_yes" class="radio" name="csng_billing" value="yes">
                                                            <label for="yes">Yes</label>
                                                            <input type="radio" id="csng_no" class="radio" name="csng_billing" value="no" checked="true">
                                                            <label for="no">No</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="income">Unit Type <span class="req">*</span></label>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="unit_type[]" id="customCheck1" value="bike" required="true">
                                                            <label class="custom-control-label" for="customCheck1">Bike</label>
                                                            <input type="text" class="form-control" name="bike" id="bike" placeholder="Total Number of Bike" onkeypress="return /[0-9.]/i.test(event.key)">

                                                        </div>
                                                        <br>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="unit_type[]" id="customCheck2" value="three_wheeler">
                                                            <label class="custom-control-label" for="customCheck2">3 Wheeler</label>
                                                            <input type="text" class="form-control" name="3wheeler" id="3wheeler" placeholder="Total Number of 3 Wheeler" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        </div>
                                                        <br>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="unit_type[]" id="customCheck3" value="four_wheeler">
                                                            <label class="custom-control-label" for="customCheck3">4 Wheeler</label>
                                                            <input type="text" class="form-control" name="4wheeler" id="4wheeler" placeholder="Total Number of 4Wheeler" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="income">Delivery Van Picture </label>
                                                        <input type="file" name="delivery_van_pic" class="form-control" id="delivery_van_pic" accept="image/*" >
														<span class="invalid-feedback">Please select a file.</span>
                                                        <span class="em"></span>
                                                        <br>
                                                        <label for="income">Delivery Van RC </label>
                                                        <input type="file" name="delivery_van_rc" class="form-control" id="delivery_van_rc" accept="image/*" >
														<span class="invalid-feedback">Please select a file.</span>
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Invoice Copy of Existing Company </label>
                                                        <input type="file" name="invoice_copy" class="form-control" id="invoice_copy" accept="image/*" >
														<span class="invalid-feedback">Please select a file.</span>
                                                        <span class="em"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-6" class="tab-pane" role="tabpanel6" aria-labelledby="step-6">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Proposed Outlets to be Covered for CKPL <span class="req">*</span></label>
                                                        <input type="text" name="proposed_outlets_coverd" class="form-control" id="proposed_outlets_coverd" placeholder="Enter Number" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">No. of Approved Field Force Count <span class="req">*</span></label>
                                                        <input type="text" name="ff_count" class="form-control" id="ff_count" placeholder="Enter Number" required="true" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span class="em"></span>
                                                    </div>
                                                   
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Expected Yearly Turnover from CavinKare <span class="req">*</span></label>
                                                        <input type="text" name="yearly_turnover" class="form-control" id="yearly_turnover" placeholder="0" onkeypress="return /[0-9.]/i.test(event.key)" required="true">
                                                        <span class="em"></span>
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-10">
                                                    <h5>Are you sure that you want to submit the form?</h5>
                                                </div>
                                                <div class="col-md-3"></div>
                                                <div class="col-md-5" style="margin-left: 4%;">
                                                    <input type="hidden" id="save_status" name="save_status" value="1">
                                                    <button class="btn btn-success m-1" type="submit" id="SubmitBtn">Submit</button>
                                                </div>
                                                </div>
                               
                                                <br>
                                                <br>
                                                <br>
                                                <br>
           
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>

                            <div class="modal fade" id="confirm_approval" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog  modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><b>Confirm</b></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="pb-2 pt-2 message" ></div>
                                            <div class="th" style="padding-left: 5px; ">
                                                This exceptional request will be forwarded to the division head for approval, Do you want to continue?
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-info save_btn m-1" type="button" id="send_approval">Yes</button>
                                            <button class="btn btn-success m-1" type="button" id="edit_fee">No</button>
                                        </div>
                                        
                                    </div>
                                </div>
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
    <script src="<?php echo asset_url(); ?>js/popper.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>

    <!--notification js -->
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/notifications.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/notifications/js/notification-custom-script.js"></script>


    <!--plugins-->
    <script src="<?php echo asset_url(); ?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/smart-wizard/js/jquery.smartWizard.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/select2/js/select2.min.js"></script>

    <script src="<?php echo asset_url(); ?>pro_js/rs_onboarding/TSO/rs_appointment_form.js"></script>

    <script>
        $(".rform_m").addClass("mm-active");
        
        $('.cancel').click(function(){
            alert(43);
        })

        
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        $(document).ready(function () {

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish').addClass('btn btn-info').on('click', function () {
                alert('Finish Clicked');
            });
            var btnCancel = $('<button></button>').text('Cancel').addClass('btn btn-danger cancel').on('click',
                function () {
                    $('#smartwizard').smartWizard("reset");
                });

            // Step show event
            $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
                if (stepPosition === 'first') {
                    $("#prev-btn").addClass('disabled');
                } else if (stepPosition === 'last') {
                    $("#next-btn").addClass('disabled');
                } else {
                    $("#prev-btn").removeClass('disabled');
                    $("#next-btn").removeClass('disabled');
                }
            });
            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                transition: {
                    animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                },
                toolbarSettings: {
                    toolbarPosition: 'both', // both bottom
                    toolbarExtraButtons: [btnFinish, btnCancel]
                },
				autoAdjustHeight: true,
              
            });
            //how to change the height of active tab in onchange
			$("#smartwizard").on("leaveStep", function (e, anchorObject, currentStepIdx, nextStepIdx) {
				
				
	// Validate only on forward movement 
	if (nextStepIdx === 'forward') {
		// Validate form
		if ((currentStepIdx + 1) == 1) {
			var areason = $('#reason_appoint').val();
		if (areason != 'Expansion' && areason != null) {
			$('#smartwizard .tab-content').prop('style', 'height: 250.938px');
		}
			
		}
		let form = $('#rs_appointment_form');
		if (form.length) {
			let stepFields = form.find('#step-' + (currentStepIdx + 1)).find('input');
			let isValid = true;

			stepFields.each(function () {
				if (!$(this)[0].checkValidity()) {
					isValid = false;
					return false; // Exit each loop early
				}
			});

			if (!isValid) {
				form.addClass('was-validated');
				return false; // Prevent navigation
			}
			form.removeClass('was-validated');
		}
		$('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
	}

});

			// External Button Events
            $("#reset-btn").on("click", function () {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");
                return true;
            });
            $("#prev-btn").on("click", function () {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                return true;
            });
            $("#next-btn").on("click", function () {
                // Navigate next
                $('#smartwizard').smartWizard("next");
                return true;
            });
            // Demo Button Events
            $("#got_to_step").on("change", function () {
                // Go to step
                var step_index = $(this).val() - 1;
                $('#smartwizard').smartWizard("goToStep", step_index);
                return true;
            });
            $("#is_justified").on("click", function () {
                // Change Justify
                var options = {
                    justified: $(this).prop("checked")
                };
                $('#smartwizard').smartWizard("setOptions", options);
                return true;
            });
            $("#animation").on("change", function () {
                // Change theme
                var options = {
                    transition: {
                        animation: $(this).val()
                    },
                };
                $('#smartwizard').smartWizard("setOptions", options);
                return true;
            });
            $("#theme_selector").on("change", function () {
                // Change theme
                var options = {
                    theme: $(this).val()
                };
                $('#smartwizard').smartWizard("setOptions", options);
                return true;
            });


            $("#li_step_1").trigger("click");
        });
		function blockSpecialChar(e) {
            var k = e.keyCode;
            return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || (k >= 48 && k <= 57) || k == 32);
        }
		// 
		$(document).ready(function() { 
            
            // Disables ctrl+v, ctrl+x, ctrl+c.
            $('textarea').on("cut", function(e) {
                e.preventDefault()
            })
            $('textarea').on("copy", function(e) {
                e.preventDefault();
            })
			$('input').on("cut", function(e) {
                e.preventDefault()
            })
            $('input').on("copy", function(e) {
                e.preventDefault();
            })
            $('textarea').on("paste", function(e) {
                e.preventDefault();
            });
			$('input').on("paste", function(e) {
                e.preventDefault();
            });
            
            // Disables right-click. 
            $('textarea','input').mousedown(function(e) {
                if (e.button == 2) {
                    e.preventDefault()
                }
            })
        });
	
        var BASE_URL = "<?php echo base_url();?>index.php/rs_onboarding/";
    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url(); ?>js/app.js"></script>



    <script type="text/javascript">
        $(document).ready(function () {
            $('.sw-btn-next').click(function () {
                $('.tab-content').removeClass('show_new');
                $('.tab-content').removeClass('show_ex');
                $('.tab-content').removeClass('show_birep');
            })
            $('.sw-btn-prev').click(function () {
                $('.tab-content').removeClass('show_new');
                $('.tab-content').removeClass('show_ex');
                $('.tab-content').removeClass('show_birep');
            })
        });

        $("#ifsc_code").keyup(function(){
            $('#branch_name').val('');
            $('#bank_name').val('');

            var ifsc_code = $(this).val(); // You can use $(this) to refer to the current input field
            $.ajax({
                url: BASE_URL + 'RSController/get_bank_details',
                method: "POST",
                data: { ifsc_code: ifsc_code },
                dataType: "json",

                success: function (data) {
                    // console.log(data.response.BANK);
                    // console.log(data.response.BRANCH);
                    if (data.response && data.response.BANK !== undefined) {
                        $('#branch_name').val(data.response.BANK);
                    }
                    if (data.response && data.response.BRANCH !== undefined) {
                        $('#bank_name').val(data.response.BRANCH);
                    }
                },
            })

        });


     
    </script>
</body>

</html>
