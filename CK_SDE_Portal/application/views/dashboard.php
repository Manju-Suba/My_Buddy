<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SDE Portal</title>
	<?php include('application/views/layouts/common_css_links.php'); ?>


    <style>

    /* @media only screen and (max-width: 1000px) {

        .extra_width{
            width: 1px !important;
        }
    } */
   

    .page-content-wrapper {
        margin-left: unset !important;
    }
 
    .footer {
        margin-left: unset !important;

    }
    .spinner-border{
        width: 1rem !important;
        height: 1rem !important;
    }
    .display_none{
        display:none;
    }
    @media (min-width: 1200px){
        .container{
            max-width:1200px;
        }

    }
    </style>
</head>

<body>



    <!--end sidebar-wrapper-->
    <!--header-->
    <?php include('application/views/layouts/topbar.php'); ?>

    <!--end header-->
    <!--page-wrapper-->
    <div class="page-wrapper">
        <!--page-content-wrapper-->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!-- session login details -->
                <input type="hidden" name="session_role_type" id="session_role_type">
                <input type="hidden" name="session_mobile_no" id="session_mobile_no">
                <input type="hidden" name="session_password" id="session_password">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary m-2" data-toggle="modal" style="display:none;"
                    data-target="#pass_pop" id="show_pass_pop">Change Pass Popup</button>
                <!-- Modal -->
                <div class="modal fade" id="pass_pop" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="pop_close"> <span
                                        aria-hidden="true">&times;</span>
                                </button> 
                            </div>
							<form id="passSubmit" method="post" action="javascript:void(0)" autocomplete="off">
								<div class="modal-body">
									<div class="form-group">
										<label>New Password</label>
											<input type="text" name="new_password" id="new_password" class="form-control" placeholder="New Password" autocomplete="off">
									</div>
									<div class="form-group">
										<label>Confirm Password</label>
											<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" autocomplete="off">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary" id="btnSubmit">Update</button>
								</div>
							</form>

                        </div>
                    </div>
                </div>
                
                <div class="container">

                    <div class="" id="show_pd_list">


                    </div>
                    <!-- end row -->

                </div>

            </div>
        </div>
        <!--end page-content-wrapper-->
    </div>
    <!--end page-wrapper-->
    <!--start overlay-->
    <div class="overlay toggle-btn-mobile"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <!--footer -->
    <?php include('application/views/layouts/footer.php'); ?>

    <!-- end footer -->
    </div>
    <!--start switcher-->
    <div class="switcher-wrapper">
        <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
        </div>
        <div class="switcher-body">
            <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
            <hr />
            <h6 class="mb-0">Theme Styles</h6>
            <hr />
            <div class="d-flex align-items-center justify-content-between">
                <div class="custom-control custom-radio">
                    <input type="radio" id="darkmode" name="customRadio" class="custom-control-input">
                    <label class="custom-control-label" for="darkmode">Dark Mode</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="lightmode" name="customRadio" checked class="custom-control-input">
                    <label class="custom-control-label" for="lightmode">Light Mode</label>
                </div>
            </div>
            <hr />
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="DarkSidebar">
                <label class="custom-control-label" for="DarkSidebar">Dark Sidebar</label>
            </div>
            <hr />
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="ColorLessIcons">
                <label class="custom-control-label" for="ColorLessIcons">Color Less Icons</label>
            </div>
        </div>
    </div>
    <!--end switcher--> 
    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<?php include('application/views/layouts/common_script_links.php'); ?>
    <?php $url = 'https://testing_demo.cavinkare.in/five_sec_sc_FE/#/login/' ; ?>


    <script src="<?php echo asset_url();?>pro_js/dashboard.js"></script>
    <script src="<?php echo asset_url();?>pro_js/change-pass.js"></script>
    <script>
    var loginurl = <?php echo json_encode($url); ?>;
    var BASE_URL = "<?php echo base_url();?>index.php/";
    var ASSET_URL = "<?php echo base_url();?>assets/";
    </script>
</body>

</html>
