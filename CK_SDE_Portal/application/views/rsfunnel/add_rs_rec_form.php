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
                        <div class="card-header">Add Recruitment Form</div>
                        <div class="card-body">
                        <button class="btn btn-danger" id="reset-btn" type="button">Reset Wizard</button>

                            <!-- SmartWizard html -->
                            <div id="smartwizard">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#step-1"> <strong>Basic Details</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#step-2"> <strong>Additional Details</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#step-3"> <strong>Confirmation</strong> </a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <form action="javascript:void(0)" method="POST" id="rsForm">

                                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1"
                                            style="width: unset !important;">
                                            <div class="container">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Name*</label>

                                                        <input type="text" name="c_name" id="c_name"
                                                            class="form-control" placeholder="Name">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Mobile No.*</label>

                                                        <input type="text" class="form-control" name="c_mobile_no"
                                                            id="c_mobile_no" onkeypress="return isNumber(event)" placeholder="Mobile No">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Shop Name*</label>

                                                        <input type="text" name="c_sname" id="c_sname"
                                                            class="form-control" placeholder="Shop Name">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>GST</label>

                                                        <input type="text" class="form-control" name="c_gst_no"
                                                            id="c_gst_no" placeholder="GST">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Alt Mobile No.</label>

                                                        <input type="text" name="c_altmobile_no" id="c_altmobile_no"
                                                            class="form-control" placeholder="Alt Mobile No.">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Shop Address*</label>
                                                        <textarea name="c_address" id="c_address" class="form-control"
                                                            placeholder="Address"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label>State*</label>
                                                        <select name="c_state" id="c_state"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Division*</label>
                                                        <select name="c_division" id="c_division"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Town*</label>
                                                        <select name="c_town" id="c_town"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label>Upload Photos*</label>
                                                        <input type="file" class="form-control" name="c_resume"
                                                            id="c_resume">
                                                    </div>


                                                </div>
                                            </div>



                                        </div>
                                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                            <div class="container">

                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label>Age of Organisation </label>

                                                        <select name="c_age_of_org" id="c_age_of_org"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Companies Handled</label>
                                                        <select name="c_comp_handled" id="c_comp_handled"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Retailers Serviced </label>

                                                        <select name="c_retail_serviced" id="c_retail_serviced"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Godown</label>
                                                        <select name="c_godown" id="c_godown"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Computer</label>

                                                        <select name="c_computer" id="c_computer"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Printer</label>
                                                        <select name="c_printer" id="c_printer"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Internet</label>

                                                        <select name="c_internet" id="c_internet"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Delivery Vehicle</label>
                                                        <select name="c_delivery_vehicle" id="c_delivery_vehicle"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Future investment</label>

                                                        <select name="c_fut_inverstment" id="c_fut_inverstment"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Proprietary Involvement</label>
                                                        <select name="c_prop_invol" id="c_prop_invol"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Market Feed Back</label>

                                                        <select name="c_market_fb" id="c_market_fb"
                                                            class="form-control single-select">
                                                            <option value="">Select</option>

                                                        </select>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>
                                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                            <div class="container">
                                                <h5>Are you sure that you want to submit the form ?</h5>
                                                <input type="hidden" id="save_status" name="save_status" value="1">

                                                <button class="btn btn-info save_btn" type="button"
                                                    id="SaveBtn">Save</button>
                                                <button class="btn btn-success" type="submit"
                                                    id="SubmitBtn">Submit</button>
                                            </div>
                                        </div>
                                    </form>
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


    <script src="<?php echo asset_url();?>pro_js/rsfunnel/add_rs_rec.js"></script>

    <script>
    var BASE_URL = "<?php echo base_url();?>index.php/rsfunnel/";
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $(document).ready(function() {

        $(".rsform_m").addClass("mm-active");


        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Finish').addClass('btn btn-info').on('click', function() {
            alert('Finish Clicked');
        });
        var btnCancel = $('<button></button>').text('Cancel').addClass('btn btn-danger').on('click',
            function() {
                $('#smartwizard').smartWizard("reset");
            });
        // Step show event
        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
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
        $("#reset-btn").on("click", function() {
            // Reset wizard
            $('#smartwizard').smartWizard("reset");
            return true;
        });
        $("#prev-btn").on("click", function() {
            // Navigate previous
            $('#smartwizard').smartWizard("prev");
            return true;
        });
        $("#next-btn").on("click", function() {
            // Navigate next
            $('#smartwizard').smartWizard("next");
            return true;
        });
        // Demo Button Events
        $("#got_to_step").on("change", function() {
            // Go to step
            var step_index = $(this).val() - 1;
            $('#smartwizard').smartWizard("goToStep", step_index);
            return true;
        });
        $("#is_justified").on("click", function() {
            // Change Justify
            var options = {
                justified: $(this).prop("checked")
            };
            $('#smartwizard').smartWizard("setOptions", options);
            return true;
        });
        $("#animation").on("change", function() {
            // Change theme
            var options = {
                transition: {
                    animation: $(this).val()
                },
            };
            $('#smartwizard').smartWizard("setOptions", options);
            return true;
        });
        $("#theme_selector").on("change", function() {
            // Change theme
            var options = {
                theme: $(this).val()
            };
            $('#smartwizard').smartWizard("setOptions", options);
            return true;
        });
    });
    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
$(document).ready(function(){
    $("#c_name").keydown(function(event){
        var inputValue = event.which;
        if(!(inputValue >= 65 && inputValue <= 123) &&/*letters,white space,tab*/
         (inputValue != 32 && inputValue != 0) && 
         (inputValue != 48 && inputValue != 8)/*backspace*/
         && (inputValue != 9)/*tab*/) { 
            event.preventDefault(); 
        }
    });
});
    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>
</body>

</html>