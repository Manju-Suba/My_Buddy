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
								
								<?php if( $this->session->userdata('role_type') !== 'TSO'){ ?>
									<div class="col-md-4">
										<label>ASM Name </label>
										<select class="form-control" name="asm_number" id="asm_number" style="margin-top: -6px;" required>
											<option value=""><b>View All</b></option>
											<?php 
											foreach($asm_details as $row){ ?>
												<option  value="<?= $row->asm_number; ?>" > 
													<?= $row->asm ?>
												</option>
											<?php } ?>
										</select> 
									</div>

									<div class="col-md-4">
										<label>SDE Name</label>
										<select class="form-control" name="sde_number" id="sde_number" style="margin-top: -6px;">
											<option value="">View All</option>
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
                                    <!-- <button class="btn" style="color:#fff;background-color: #f02769c4;border-color: #f02769" id="reset"><i class='bx bx-refresh'></i> Refresh</button> -->
								</div>
							</div>
							
							<br>

                            <input type="hidden" name="session_role_type" id="session_role_type"
                                value="<?php echo $this->session->userdata('role_type'); ?>">
                            <input type="hidden" name="session_mobile_no" id="session_mobile_no"
                                value="<?php echo $this->session->userdata('mobile'); ?>">
							
							<!-- table div start -->
							
							<div id="table_div">
								<div class="table-responsive">
									<table id="sde_incentive_urban_table" class="table table-striped" style="width:100%">
										<thead>
											<!-- <tr style="background:#078bb336;"> -->
											<tr class="table-info">
												<th>#</th>
												<th>ASM Name</th>
												<th>SDE Name</th>
												<th>Market</th>
												<th>Mandays Target</th>
												<th>Mandays ACH</th>
												<th>Mandays %</th>
												<th>Mandays Amount</th>
												<th>Orange Salesman Target</th>
												<th>Orange Salesman ACH</th>
												<th>Orange Salesman %</th>
												<th>Orange Salesman Amount</th>
												<th>CK Super Star Target</th>
												<th>CK Super Star ACH</th>
												<th>CK Super Star %</th>
												<th>CK Super Star Amount</th>
												<th>CK Elite| Kudumbam| Parivar Target</th>
												<th>CK Elite| Kudumbam| Parivar ACH</th>
												<th>CK Elite| Kudumbam| Parivar %</th>
												<th>CK Elite| Kudumbam| Parivar Amount</th>
												<th>Sec. Value Target</th>
												<th>Sec. Value ACH</th>
												<th>Sec. Value %</th>
												<th>Sec. Value Amount</th>
												<th>Rising Star Outlet Target</th>
												<th>Rising Star Outlet ACH</th>
												<th>Rising Star Outlet %</th>
												<th>Rising Star Outlet Amount</th>
												<th>Total Amount</th>
												<th>Pending Last Month</th>
												<th>Final Amount</th>
												<th>Remarks</th>
												<!-- <th>Action</th> -->
											</tr>
										</thead>
									</table>
								</div>
							</div>


							<!-- table div end -->

							<!-- sde table div start -->
							<div id="sde_table_div">
								<!-- sde_table_div -->

								<table class="table table-bordered">
									<tr>
										<th scope="col" style="background:#078bb387;">Key Performance Indices</th>
										<th scope="col" style="background:#078bb336;">Target</th>
										<th scope="col" style="background:#078bb336;">Achieve</th>
										<th scope="col" style="background:#078bb336;">%</th>
										<th scope="col" style="background:#078bb336;">Amount</th>
									</tr>
									<tr>
										<th scope="row">Mandays</th>
										<td id="mdys_target"></td>
										<td id="mdys_ach"></td>
										<td id="mdys_per"></td>
										<td id="mdys_amount"></td>
									</tr>
									<tr>
										<th scope="row">Orange SalesMan</th>
										<td id="orgsm_target"></td>
										<td id="orgsm_ach"></td>
										<td id="orgsm_per"></td>
										<td id="orgsm_amount"></td>
									</tr>
									<tr>
										<th scope="row">CK Super Star</th>
										<td id="ckss_target"></td>
										<td id="ckss_ach"></td>
										<td id="ckss_per"></td>
										<td id="ckss_amount"></td>
									</tr>
									<tr>
										<th scope="row">CK Elite | Kudumbam | Parivar</th>
										<td id="ckekp_target"></td>
										<td id="ckekp_ach"></td>
										<td id="ckekp_per"></td>
										<td id="ckekp_amount"></td>
									</tr>
									<tr>
										<th scope="row">Sec. Value Target</th>
										<td id="sv_target"></td>
										<td id="sv_ach"></td>
										<td id="sv_per"></td>
										<td id="sv_amount"></td>
									</tr>
									<tr>
										<th scope="row">Rising Stars Outlet tgt vs ach count</th>
										<td id="rso_target"></td>
										<td id="rso_ach"></td>
										<td id="rso_per"></td>
										<td id="rso_amount"></td>
									</tr>
								</table>
								
							</div>
							<!-- sde table div end -->

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

    <script src="<?php echo asset_url();?>pro_js/incentive/sde_incentive_urban.js"></script>

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
