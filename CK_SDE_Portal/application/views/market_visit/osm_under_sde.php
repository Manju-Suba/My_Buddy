<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>OSM Market Visit</title>
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

    <!-- sweet alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">

    <style>
    .table td,
    .table th {
        color: #000000 !important;
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
                        <div class="breadcrumb-title pr-3">Orange Salesman</div>
                        <div class="pl-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i
                                                class='bx bx-home-alt'></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Market Visit Report</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--end breadcrumb-->
                    
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">OSM Name</label>
									<select class="form-control" name="osm_name" id="osm_name" style="margin-top: -6px;">
										<option value="">View All..</option>
										<?php 
											foreach($get_sde_under_osm__ as $k =>$row){ ?>
											<option  value="<?= $row['ssfa_id']; ?>" > 
												<?= $row['osm_name'] ?>
											</option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-3">
									<label>Financial Year </label>
									<select class="form-control" id="jc_type_year" name="jc_type_year" style="margin-top: -6px;"></select>
								</div>
								<div class="col-md-3">
                                    <label for="">JC</label>
                                    <select class="form-control" name="jc_type" id="jc_type" style="margin-top: -6px;">
										<?php 
											$month = date('m');
										?>
										<!-- <option value="">View All</option> -->
										<!-- <option value="JC13" disabled>JC13</option> -->
										<option value="JC12" <?php if($month == '3'){ ?> selected <?php } ?>>JC12</option>
										<option value="JC11" <?php if($month == '2'){ ?> selected <?php } ?>>JC11</option>
										<option value="JC10" <?php if($month == '1'){ ?> selected <?php } ?> >JC10</option>
										<option value="JC09" <?php if($month == '12'){ ?> selected <?php } ?>>JC09</option>
										<option value="JC08" <?php if($month == '11'){ ?> selected <?php } ?>>JC08</option>
										<option value="JC07" <?php if($month == '10'){ ?> selected <?php } ?>>JC07</option>
										<option value="JC06" <?php if($month == '9'){ ?> selected <?php } ?>>JC06</option>
										<option value="JC05" <?php if($month == '8'){ ?> selected <?php } ?>>JC05</option>
										<option value="JC04" <?php if($month == '7'){ ?> selected <?php } ?>>JC04</option>
										<option value="JC03" <?php if($month == '6'){ ?> selected <?php } ?>>JC03</option>
										<option value="JC02" <?php if($month == '5'){ ?> selected <?php } ?>>JC02</option>
										<option value="JC01" <?php if($month == '4'){ ?> selected <?php } ?>>JC01</option>
									</select>
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <button class="brn btn-sm btn-warning" id="filterClearbtn" style="margin-top: 5px;">Reset</button>
                                </div>
                            </div>
                            <hr />

                            <input type="hidden" name="session_role_type" id="session_role_type"
                                value="<?php echo $this->session->userdata('role_type'); ?>">
                            <input type="hidden" name="session_mobile_no" id="session_mobile_no"
                                value="<?php echo $this->session->userdata('mobile'); ?>">


                            <div class="table-responsive">
                                <table id="osm_report_view_under_sde" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr class="table-info">
                                            <th>S.No</th>
                                            <th>OSM</th>
                                            <th>JC</th>
                                            <th>Market Visited</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
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
        <!--Start Back To Top Button--> 
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
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

    <script src="<?php echo asset_url();?>pro_js/market_visit/osm_under_sde_report.js"></script>

    <script>
        $(document).ready(function() {
            $(".metismenu li").removeClass('mm-active');
            var page = "osm_under_sde";

            if (page == "osm_under_sde") {
                $(".eform_osm").addClass("mm-active");
            }

			var yearsLength = 10;
			var currentYear = new Date().getFullYear();
			for(var i = 0; i < 10; i++){
				var d = new Date(),
				n = d.getMonth();
				if( (n+1) <= 3){
					var next = currentYear-1;
					var year = next + '-' + currentYear.toString().slice(-2);
				}else{
					var next = currentYear+1;
					var year = currentYear + '-' + next.toString().slice(-2);
				}
			
				$('#jc_type_year').append(new Option(year, year));
				currentYear--;
			}

        });

    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>

    <script>
        var BASE_URL = "<?php echo base_url();?>index.php/";
    </script>
</body>

</html>
