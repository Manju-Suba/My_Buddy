<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RSSM Recruitment</title>
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

        .show_new {
            height: 497.812px !important;
        }

        .show_ex {
            height: 165.938px !important;
        }

        .req {
            color: red;
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
        input[type=file] {
            height: calc(1.2em + 1.1rem + 2px);
            line-height: 1.2;
            padding: 0.35rem 0.75rem;
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
                        <div class="card-header">Edit Recruitment Form</div>
                        <div class="card-body">
                            <button class="btn btn-danger" id="reset-btn" type="button">Reset Wizard</button>
                            <!-- SmartWizard html -->
                            <div id="smartwizard">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link li_step_1" id="li_step_1" href="#step-1"> <strong>Basic Details</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link li_step_2" href="#step-2"> <strong>Additional
                                                Details</strong></a>
                                    </li>
                                    <li class="nav-item li_step_3">
                                        <a class="nav-link " href="#step-3"> <strong>Other
                                                Details</strong> </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link li_step_4" href="#step-4"> <strong>Bank
                                                Details</strong> </a>
                                    </li>
                                    <!-- <li class="nav-item li_step_5">
                                        <a class="nav-link" href="#step-5"> <strong>Confirmation</strong> </a>
                                    </li> -->

                                </ul>


                                <div class="tab-content">
                                    <form action="javascript:void(0)" method="POST" id="rssmForm">
                                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1"
                                            style="width: unset !important;">
                                            <div class="container">
                                                <div class="form-row">
                                                    <!-- <div class="form-group col-md-6">
                                                        <label for="division"> Division <span class="req">*</span></label>
                                                        <select name="division" id="division"
                                                            class="form-control single-select">
                                                            <option value="">Select </option>
                                                            <option value="AB">AB</option>
                                                            <option value="PC">PC</option>
                                                            <option value="SN">SN</option>
                                                            <option value="RAAGA">RAAGA</option>
                                                        </select>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label>Name <span class="req">*</span></label>
                                                        <input type="hidden" name="edit_row_id" id="edit_row_id">
                                                        <input type="text" name="c_name" id="c_name" class="form-control" placeholder="Name">
                                                    </div>
                                                   
                                                    <!-- </div>
                                                    <div class="form-row"> -->
                                                    <div class="form-group col-md-6">
                                                        <label>Mobile No. <span class="req">*</span></label>
                                                        <input type="text" class="form-control" name="c_mobile_no" id="c_mobile_no" placeholder="Mobile No" pattern="[0-9]*" inputmode="numeric">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>WhatsApp No. <span class="req">*</span></label>
                                                        <input type="text" name="c_altmobile_no" id="c_altmobile_no" class="form-control" placeholder="Alt Mobile No." pattern="[0-9]*" inputmode="numeric">
                                                    </div>
                                                    

                                                    <!-- </div>
                                                    <div class="form-row"> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="bank">Date of Birth <span class="req">*</span></label>
                                                        <input type="date" name="dob" class="form-control" id="dob">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Address <span class="req">*</span></label>
                                                        <textarea name="c_address" id="c_address" class="form-control" placeholder="Address"></textarea>
                                                    </div>

                                                    

                                                    <!-- </div>
                                                    <div class="form-row"> -->
                                                    <div class="form-group col-md-4">
                                                        <label>Upload Resume</label>
                                                        <input type="file" class="form-control" name="c_resume" id="c_resume" accept=".doc, .docx,.ppt, .pptx,.txt,.pdf" />
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <span id="resume_view"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="bank">Email ID <span class="req">*</span></label>
                                                        <input type="text" name="email" class="form-control" id="email">
                                                        <span class="em"></span>
                                                    </div>
                                                    
                                                    <!-- </div>
                                                    <div class="form-row"> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="bank">Father's Name <span class="req">*</span></label>
                                                        <input type="text" name="f_name" class="form-control" id="f_name">
                                                        <span class="em"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="bank">Date of Joining <span class="req">*</span></label>
                                                        <input type="date" name="doj" class="form-control" id="doj">
                                                        <span class="em"></span>
                                                    </div>
                                                    <!-- </div>
                                                    <div class="form-row"> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="rssm_type"> Sales Category <span class="req">*</span></label>
                                                        <select name="rssm_select" id="rssm_select" class="rssm_select form-control single-select">
                                                            <!-- <option value="">Select </option>
                                                            <option value="DSE - Metro">DSE - Metro</option>
                                                            <option value="DSE - Urban">DSE - Urban</option>
                                                            <option value="DSE - LPS">DSE - LPS</option>
                                                            <option value="Rural - RDSE">Rural - RDSE</option>
                                                            <option value="Rural - TRDSE">Rural - TRDSE</option>
                                                            <option value="DSE DAO">DSE DAO</option> -->
                                                            <!-- <option value="DSE">DSE</option>
                                                            <option value="RSSM">RSSM</option>
                                                            <option value="T-RDSE">T - RDSE</option>
                                                            <option value="RDSE">RDSE</option>
                                                            <option value="DAO">DAO</option> -->
                                                           
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="service_fee">Service Fee<span class="req">*</span></label>
                                                        <input type="text" name="service_fee"  class="form-control" id="service_fee" onkeypress="return /[0-9.]/i.test(event.key)">
                                                        <span id="service_fee_msg" class="text-danger"></span>

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Salesman Live Image Capture Copy</label>
                                                        <div style="padding-left: 20px;">
                                                            <span id="salesmanImg_view"></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Experience <span class="req">*</span></label>
                                                        <select name="c_experience" id="c_experience" class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Education <span class="req">*</span></label>
                                                        <select name="c_education" id="c_education" class="form-control single-select">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Age <span class="req">*</span></label>
                                                        <select name="c_age" id="c_age" class="form-control single-select">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Terrain Knowledge <span class="req">*</span></label>
                                                        <select name="c_tknowledge" id="c_tknowledge" class="form-control single-select">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Technology Adaption <span class="req">*</span> </label>
                                                        <select name="c_tech_adaption" id="c_tech_adaption" class="form-control single-select">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Family Background <span class="req">*</span></label>
                                                        <select name="c_familybg" id="c_familybg" class="form-control single-select">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="rssm_type">Sales Type <span class="req">*</span></label>
                                                        <select name="rssm_type_select" id="rssm_type_select" class="rssm_select form-control single-select">
                                                            <option value="">Select</option>
                                                            <option value="New SalesMan">New SalesMan</option>
                                                            <option value="Existing SalesMan">Existing SalesMan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="new_rssm" style="display:none">
                                                    <!-- <form id="town_details"> -->
                                                    <!-- Address fields -->
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Region <span class="req">*</span></label>
                                                            <select name="region_name" id="region_name" class="form-control single-select">
                                                                <option value="">Select</option>
                                                            </select>
                                                            <span class="em" style="display:none">This</span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>RS Name <span class="req">*</span></label>
                                                            <select class="form-control single-select" name="select_rs_name" id="select_rs_name" placeholder="RS Name">
                                                                <option value="">select</option>
                                                            </select>
                                                            <span class="em"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>RS Code</label>
                                                            <input type="text" name="rs_code" id="rs_code" class="form-control" placeholder="RS Code" readonly>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>SDE Name </label>
                                                            <input type="text" class="form-control" name="sde_name" id="sde_name" placeholder="SDE Name" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>ASM Name </label>
                                                            <input type="text" name="asm_name" id="asm_name" class="form-control" placeholder="ASM Name" readonly>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-6">
                                                            <label>State Name <span class="req">*</span></label>
                                                            <select name="state_name" id="state_name" class="form-control single-select">
                                                                <option value="">Select</option>
                                                            </select>
                                                            <span class="em"></span>

                                                        </div>
                                                    </div>
                                                    <div class="form-row">

                                                        <div class="form-group col-md-6">
                                                            <label>District Name <span class="req">*</span></label>
                                                            <select type="text" name="c_division" id="c_division" class="form-control single-select">
                                                                <option value="">Select</option>
                                                            </select>
                                                            <span class="em"></span>

                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>City Name <span class="req">*</span></label>
                                                            <select name="c_city" id="c_city" class="form-control single-select">
                                                                <option value="">Select</option>
                                                            </select>
                                                            <span class="em"></span>

                                                        </div>

                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Town Name <span class="req">*</span></label>
                                                            <select name="c_town" id="c_town" class="form-control single-select">
                                                                <option value="">Select</option>
                                                            </select>
                                                            <span class="em"></span>

                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label>Town Code</label>
                                                            <input type="text" class="form-control" name="town_code" id="town_code" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="beat_group" >
                                                        <div class="form-row ">
                                                            <div class="form-group beats col-md-6">
                                                                <label>Beat 1<span class="req">*</span></label>
                                                                <input type="text" class="form-control" name="beat[]" id="beat_name_1" >
                                                                <span class="em"></span>
                                                            </div>
                                                            <div class="form-group beats col-md-6">
                                                                <label>Beat 2<span class="req">*</span></label>
                                                                <input type="text" class="form-control" name="beat[]" id="beat_name_2" >
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group beats col-md-6">
                                                                <label>Beat 3<span class="req">*</span></label>
                                                                <input type="text" class="form-control" name="beat[]" id="beat_name_3" >
                                                                <span class="em"></span>
                                                            </div>
                                                            <div class="form-group beats col-md-6">
                                                                <label>Beat 4<span class="req">*</span></label>
                                                                <input type="text" class="form-control" name="beat[]" id="beat_name_4" >
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group beats col-md-6">
                                                                <label>Beat 5<span class="req">*</span></label>
                                                                <input type="text" class="form-control" name="beat[]" id="beat_name_5" >
                                                                <span class="em"></span>
                                                            </div>
                                                            <div class="form-group beats col-md-6">
                                                                <label>Beat 6<span class="req">*</span></label>
                                                                <input type="text" class="form-control" name="beat[]" id="beat_name_6" >
                                                            </div>
                                                        </div>

                                                        
                                                    </div>
                                                    <div class="form-row" style="display:flex; align-items:center">
                                                        <button type="button" class = "btn btn-sm   mb-3  ml-1 btn-info" id="add_beat" title="Add Beat" style=""><i class="fa fa-plus" style="font-size:12px; "></i> ADD </button>
                                                        <span class="ml-3">Click to add extra beats</span>
                                                    </div>
                                                    <div class="form-row" id="additional_beats">

                                                    </div>
                                                <!-- </div> -->
                                                    <!-- Other address fields -->
                                                    <!-- </form> -->
                                                </div>
                                                <div id="ex_rssm" style="display:none">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Existing RSSM Name <span class="req">*</span></label>

                                                            <input type="text" class="form-control" name="c_ex_rssm_name" id="c_ex_rssm_name" placeholder="Existing RSSM Name">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="ex_rssm_number">Existing RSSM Number <span class="req">*</span></label>
                                                            <input type="text" name="ex_rssm_number" id="ex_rssm_number" onkeypress="return /[0-9.]/i.test(event.key)" class="form-control">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="rssm_select_existing"> Sales Category <span class="req">*</span></label>
                                                            <select name="rssm_select_existing" id="rssm_select_existing" class="form-control single-select">
                                                                <option value="">Select </option>
                                                                <option value="DSE">DSE</option>
                                                                <option value="RSSM">RSSM</option>
                                                                <option value="T-RDSE">T - RDSE</option>
                                                                <option value="RDSE">RDSE</option>
                                                                <option value="DAO">DAO</option>
                                                                <option value="M-DSE">M - DSE</option>
                                                                <option value="RSP">RSP</option>
                                                            </select>
                                                        </div>
                                                    </div> -->

                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <div class="form-row">
                                                            <div class="col-md-6"
                                                                style="display: inline-block; padding: 0px">
                                                                <label for="income">Aadhar Number <span
                                                                        class="req">*</span></label>
                                                                <input type="text" name="aadhar_num"
                                                                    onkeypress="return /[0-9.]/i.test(event.key)"
                                                                    class="form-control" id="aadhar_num">
                                                                <span class="em" id='aadhar_num_er'></span>
                                                            </div>
                                                            <!-- <div class="col-md-6"
                                                                style="display: inline-block; padding: 0px">
                                                                <label for="income">Aadhar copy </label>
                                                                <input type="file" name="aadhar_copy" class="form-control"
                                                                    id="aadhar_copy" accept="image/*">
                                                                <span class="em" id='aadhar_num_er'></span>
                                                            </div> -->
                                                            <div class="col-md-3" style="display: inline-block;padding: 0px">
                                                                <label for="income">Aadhar FrontView </label>
                                                                <div style="padding-left: 20px;">
                                                                    <span id="aadhar_view"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3" style="display: inline-block;padding: 0px">
                                                                <label for="income">Aadhar BackView </label>
                                                                <div style="padding-left: 20px;">
                                                                    <span id="aadhar_backview"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <div class="form-row">

                                                            <div class="form-group col-md-6"
                                                                style="display: inline-block; padding: 0px">
                                                                <label for="income">PAN Number <span
                                                                        class="req">*</span></label>
                                                                <input type="text" name="pan_num" class="form-control"
                                                                    id="pan_num" >
                                                                <span class="em" id="pan_num_er"></span>

                                                            </div>
                                                            <!-- <div class="form-group col-md-4"
                                                                style="display: inline-block; padding: 0px">
                                                                <label for="income">PAN Copy </label>
                                                                <input type="file" name="pan_copy" class="form-control"
                                                                    id="pan_copy" accept="image/*">
                                                                <span class="em" id="pan_num_er"></span>
                                                            </div> -->
                                                            <div class="col-md-6" style="display: inline-block;">
                                                                <label for="income">PAN Copy </label>
                                                                <div style="padding-left: 20px;">
                                                                    <span id="pan_view"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <!-- <div class="form-group col-md-6">
                                                        <label for="income">Cheque Copy </label>
                                                        <input type="file" name="cheque_copy" class="form-control"
                                                            id="cheque_copy" accept="image/*">
                                                        <span class="em"></span>

                                                    </div> -->
                                                    <div class="col-md-6" style="display: inline-block;">
                                                        <label for="income">Cheque Copy </label>
                                                        <div style="padding-left: 20px;">
                                                            <span id="cheque_view"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="income">Bank Name <span class="req">*</span></label>
                                                        <input type="text" name="b_name" class="form-control"
                                                            id="b_name">
                                                        <span class="em"></span>

                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="income">A/C Number <span
                                                                class="req">*</span></label>
                                                        <input type="text" name="ac_num" class="form-control"
                                                            id="ac_num">
                                                        <span class="em"></span>

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">A/C Type <span class="req">*</span></label>
                                                        <select name="ac_type" class="form-control" id="ac_type">
                                                            <option value="">Select</option>
                                                            <option value="Savings" selected>Savings</option>
                                                            <option value="Savings">Current</option>

                                                        </select>
                                                        <span class="em"></span>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="income">IFSC Code <span class="req">*</span></label>
                                                        <input type="text" name="ifsc_code" class="form-control"
                                                            id="ifsc_code">
                                                        <span class="em" id="ifsc_code_er"></span>

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="income">Branch Name <span
                                                                class="req">*</span></label>
                                                        <input type="text" name="branch_name" class="form-control"
                                                            id="branch_name">
                                                        <span class="em"></span>

                                                    </div>
                                                </div>
                                                <!-- <div class="form-row">
                                                <h5>Are you sure that you want to submit the form ?</h5>
                                                <input type="hidden" id="save_status" name="save_status" value="1">
                                                
                                                

                                                <?php
                                                if ($this->session->userdata('role') == 'TSO') {
                                                    ?>
                                                        <button class="btn btn-info save_btn ml-1" type="button" id="SaveBtn">Save</button>
                                                    <?php
                                                }
                                                ?>
                                                    <button class="btn btn-success ml-1" type="submit" id="SubmitBtn">Submit</button>
                                                </div> -->
                                                <div class="row mt-4">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-10">
                                                    <h5>Are you sure that you want to submit the form?</h5>
                                                </div>
                                                <div class="col-md-3"></div>
                                                <div class="col-md-5" style="margin-left: 4%;">
                                                    <input type="hidden" id="save_status" name="save_status" value="1">
                                                    <button class="btn btn-info save_btn m-1" type="button" id="SaveBtn">Save</button>
                                                    <button class="btn btn-success m-1" type="submit" id="SubmitBtn">Submit</button>
                                                </div>
                                                </div>
                               
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                            </div>

                                        </div>
                                        <!-- <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                            <div class="container">
                                                
                                            </div>
                                        </div> -->
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

    <script src="<?php echo asset_url(); ?>pro_js/sales/TSO/edit_rssm_rec.js"></script>

    <script>
        $(".rfform_m").addClass("mm-active");

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
            var btnCancel = $('<button></button>').text('Cancel').addClass('btn btn-danger').on('click',
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

        $(document).ready(function () {
            $('.sw-btn-next').click(function () {
                $('.tab-content').removeClass('show_new');
                $('.tab-content').removeClass('show_ex');

            })
            $('.sw-btn-prev').click(function () {
                $('.tab-content').removeClass('show_new');
                $('.tab-content').removeClass('show_ex');

            })
        });

        // $('#add_beat').click(function () {
        //     beat_count++;
        //     $('#additional_beats').append(`<div class="form-group col-md-6">
        //                                     <label>Beat `+beat_count+`<span class="req">*</span></label>
        //                                     <input type="text" class="form-control" name="beat[]" id="beat_name_`+beat_count+`" >
        //                                     </div>`);
        //     tabheight = beat_count%2;
        //     if(tabheight){
        //         var currentHeight = $('.tab-content').height();
        //         $('.tab-content').removeClass('show_new');
        //         $('.tab-content').height(currentHeight + 83);

        //     }
        // });
        $('#add_beat').click(function () {
            if(beat_count < 12){

                beat_count++;

                $('#additional_beats').append(`<div class="form-group beats col-md-6">
                                                <label>Beat `+beat_count+`<span class="req">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="beat[]" id="beat_name_`+beat_count+`" >
                                                    <button type="button" class = "btn btn-sm float-right deletebeat btn-danger"  title="delete Beat" style="width : 35px ;   background-color:#f02769cc !important; border:1px solid #f02769cc  !important"><i class="fa fa-trash" style="font-size:15px; "></i></button>
                                                </div>
                                                </div>`);
                tabheight = beat_count%2;
                if(tabheight){
                    var currentHeight = $('.tab-content').height();
                    $('.tab-content').removeClass('show_new');
                    $('.tab-content').height(currentHeight + 82);

                }
            }else{
                    exceed_beat_limit();
            }

        });
        $(document).on('click',".deletebeat",function(e){
            // $(this).parent('div').remove();
            $(this).parent('div').parent('.form-group').remove();
            updateBeatLabels();
            beat_count--;
            tabheight = beat_count%2;
            if(!tabheight){
                var currentHeight = $('.tab-content').height();
                $('.tab-content').removeClass('show_new');
                $('.tab-content').height(currentHeight - 82);

            }

        });
        function updateBeatLabels() {
            $('.beats').each(function (index) {
                var labelID = 'beat_label_' + (index + 1);
                var labelText = 'Beat ' + (index + 1) + '<span class="req">*</span>';
                $(this).find('label').attr('id', labelID).html(labelText);
                $(this).find('input').attr('id', 'beat_name_' + (index + 1));
            });
        }

        var BASE_URL = "<?php echo base_url();?>index.php/salesman_onboarding/";
    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url(); ?>js/app.js"></script>
</body>

</html>