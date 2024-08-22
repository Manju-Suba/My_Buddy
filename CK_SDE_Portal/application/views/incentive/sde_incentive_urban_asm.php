<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SDE Incentive</title>
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

    <link href="<?php echo asset_url();?>plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="<?php echo asset_url();?>plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    
    <!-- Notification -->
    <link rel="stylesheet" href="<?php echo asset_url();?>plugins/notifications/css/lobibox.min.css" />

    <style>
    .table td,
    .table th {
        color: #000000 !important;
    }

    table {
        width: 100% !important;
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
                        <div class="breadcrumb-title pr-3">SDE</div>
                        <div class="pl-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i
                                                class='bx bx-home-alt'></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">SDE Incentive Urban</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                    <!--end breadcrumb-->

                    <div class="card">
                        <div class="card-body">

                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0">SDE Incentive Report</h4>
										<input type="hidden" name="session_user_name" id="session_user_name" value="<?php echo $this->session->userdata('username'); ?>">
                                    </div>
                                </div>
                            </div>
                            <hr />

							<div class="form-row">

								<?php if( $this->session->userdata('role_type') === 'ASM'){ ?>
									<div class="col-md-4">
										<label>SDE Name</label>
										<select class="form-control" name="sde_number" id="sde_number" style="margin-top: -6px;" required>
											<option value=""><b>View All</b></option>
											<?php 
											foreach($sde_details as $row){ ?>
												<option  value="<?= $row->tso_number; ?>" > 
													<?= $row->tso ?>
												</option>
											<?php } ?>
										</select>
									</div>

									
									
								<?php } ?>
								<div class="form-group col-md-4" >
									<label>JC Type </label>
									<select class="form-control" name="jc_type" id="jc_type"  style="margin-top: -6px;"  required>
										<option value="">View All</option>
										<option value="JC12">JC12</option>
										<option value="JC11">JC11</option>
										<option value="JC10">JC10</option>
										<option value="JC09">JC09</option>
										<option value="JC08">JC08</option>
										<option value="JC07">JC07</option>
										<option value="JC06">JC06</option>
										<option value="JC05">JC05</option>
										<option value="JC04">JC04</option>
										<option value="JC03">JC03</option>
										<option value="JC02">JC02</option>
										<option value="JC01">JC01</option>
													
									</select>
								</div>
								
								<div class="form-group col-md-4">
									<br>
                                    <button class="btn btn-danger" id="reset"><i class='bx bx-refresh'></i> Reset</button>
								</div>
							</div>
							
							<br>

                            <input type="hidden" name="session_role_type" id="session_role_type"
                                value="<?php echo $this->session->userdata('role_type'); ?>">
                            <input type="hidden" name="session_mobile_no" id="session_mobile_no"
                                value="<?php echo $this->session->userdata('mobile'); ?>">
							
							<!-- table div start -->
							
							<div class="table-responsive">
								<table id="sde_incentive_urban_table" class="table table-striped" style="width:100%">
									<thead>
										<!-- <tr style="background:#078bb336;"> -->
										<tr class="table-info">
											<th>#</th>
											<th>SDE Name</th>
											<th>Market</th>
											<th>Incentive Details</th>
										</tr>
									</thead>
								</table>
							</div>


							<!-- table div end -->

							

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
    <script src="<?php echo asset_url();?>plugins/select2/js/select2.min.js"></script>

    <script src="<?php echo asset_url();?>pro_js/incentive/sde_incentive_urban_asm.js"></script>

    <script>
       
            

    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>

    <script>
    var BASE_URL = "<?php echo base_url();?>index.php/";
	$(document).ready(function(){

		$(".metismenu li").removeClass('mm-active');
		var page = "sde_incentive";

		if (page == "sde_incentive") {
			$(".eform_m").addClass("mm-active");
		}

	});
    </script>
</body>

</html>
