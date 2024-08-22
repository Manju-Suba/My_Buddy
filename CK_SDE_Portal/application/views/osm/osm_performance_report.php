<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Orange Salesman Performance</title>
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

    <!-- datepicker -->
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

    <style>
    .table td,
    .table th {
        color: #000000 !important;
    }

    table {
        width: 100% !important;
    }

	#loading {
		display: block;
		position: absolute;
		top: 0;
		left: 0;
		z-index: 100;
		width: 100vw;
		height: 100vh;
		background-color: rgba(192, 192, 192, 0.5);
		background-image: url("https://i.stack.imgur.com/MnyxU.gif");
		background-repeat: no-repeat;
		background-position: center;
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
                                    <li class="breadcrumb-item active" aria-current="page">Performance Report</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                    <!--end breadcrumb-->
                    <div id="loading"></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0">Performance Report</h4>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="session_role_type" id="session_role_type"
                                value="<?php echo $this->session->userdata('role_type'); ?>">
                            <input type="hidden" name="session_mobile_no" id="session_mobile_no"
                                value="<?php echo $this->session->userdata('mobile'); ?>">

                            <div class="row">
								<div class="col-md-4 form-group">
									<label>Orange Salesman Report Format </label>
									<select class="form-control" name="beat_format" id="beat_format" style="margin-top: -6px;" required>
										<option value=""><b>Select..</b></option>
										<option value="jc_wise" selected><b>JC Wise </b></option>
										<option value="weekly"><b>Weekly</b></option>
										<option value="daily"><b>Daily</b></option>
									</select>
								</div>

								<div class="col-md-4" >
									<div id="hidden_div" style="display:none;" class="jc_view">
										<label>JC Type </label>
										<select class="form-control" name="jc_type" id="jc_type" style="margin-top: -6px;">
											<option value="">View All</option>
											<option value="JC13">JC13</option>
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
								</div>

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

								<div class="col-md-3 ">
                                    <br>
									<button class="btn btn-sm btn-danger mt-1" id="filterClearbtn"><i class='bx bx-refresh'></i> Refresh</button>
                                </div>

                            </div>
                            <hr />

							<div id="jc_type_table" style="display:block;">
								<div class="table-responsive">
									<table id="osm_table" class="table table-bordered" style="width:100%">
										<thead>
											
											<tr class="table-info">
												<th>Sno</th>
												<th>Orange Salesman</th>
												<th>ECO</th>
												<th>Planned Man Days</th>
												<th>Actual Man Days</th>
												<th>% Man Days</th>
												<th>Calls Made (sum)</th>
												<th>Calls Made/Day</th>
												<th>Productive Calls (sum)</th>
												<th>Productive Calls/Day</th>
												<th>Productivity %</th>
												<th>Total Bills Cut</th>
												<th>Bills/Day</th>
												<th>Total Lines Sold</th>
												<th>Lines/Day</th>
											</tr>
											
										</thead>
									</table>
								</div>
							</div>

							<div id="weekly_type_table" style="display:none;">
								<div class="table-responsive">
									<table id="" class="table table-bordered" style="width:100%">
										<thead>
											<tr>
												<th rowspan="2" class="text-center weekly" style="padding-bottom: 32px;" >Current JC</th>
												<th class="weekly_row" colspan="1"></th>
												<th class="text-center weekly_row" colspan="4" class="tta">Mandays %</th>
												<th class="text-center weekly_row" colspan="4" class="tta">Productivity %</th>
											</tr>
											<tr class="weekly_row">
												<th>ASM Name</th>
												<th>WK1</th>
												<th>WK2</th>
												<th>WK3</th>
												<th>WK4</th>
												<th>WK1</th>
												<th>WK2</th>
												<th>WK3</th>
												<th>WK4</th>
											</tr>
										</thead>
										<tbody id= "weekly_current_jc">
										</tbody>
									</table>
								</div>
							</div>


							<div id="daily_type_table" style="display:none;">
								<div id="calendar"></div>
							</div>

                        </div>
                    </div>
                </div>
            </div>

			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary radius-30 px-5 m-3" data-toggle="modal"
                        data-target="#popbtn" style="display:none;">Card Modal</button>
                    <!-- Modal -->
                <div class="modal fade" id="popbtn" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 35%;">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">View Single OSM Report</h5>
                                <button type="button" class="btn-close" title="Close" data-dismiss="modal" aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label><b>SM Name :</b></label>
											</div>
											<div class="form-group col-md-6">
                                                <div id="sm_name" ></div>
                                            </div>

											<div class="form-group col-md-6">
												<label><b>Total Call Made/SM</b></label>
											</div>
											<div class="form-group col-md-6">
												<div id="total_calls_mkt" ></div>
                                            </div>

                                            <div class="form-group col-md-6">
												<label><b>Value/SM </b></label>
											</div>
											<div class="form-group col-md-6">
												<div id="value_mkt" ></div>
                                            </div>

											<div class="form-group col-md-6">
												<label><b>Billscut/SM </b></label>
											</div>
											<div class="form-group col-md-6">
												<div id="billut_mkt" ></div>
                                            </div>

											<div class="form-group col-md-6">
												<label><b>TLSD/SM </b></label>
											</div>
											<div class="form-group col-md-6">
												<div id="tlsd_mkt" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
                
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

    <script src="<?php echo asset_url();?>pro_js/osm/osm_performance.js"></script>

    <script>
        $(document).ready(function() {
            $(".metismenu li").removeClass('mm-active');
            var page = "osm_performance";

            if (page == "osm_performance") {
                $(".orange_salesmam_performance").addClass("mm-active");
            }
        });

		$('#beat_format').change(function(){
			$beat_format = $('#beat_format').val();

			if($beat_format == 'jc_wise'){
				$('#hidden_div').css('display','block');
				// $('#hidden_div2').css('display','none');

				$('#jc_type_table').css('display','block');
				$('#weekly_type_table').css('display','none');
				$('#daily_type_table').css('display','none');
				
				$("#jc_format").attr('required', '');
				// $("#weekly_format").removeAttr('required'); 
				$("#daily_format").removeAttr('required'); 

			}else if($beat_format == 'weekly'){
				$('#hidden_div').css('display','none');
				// $('#hidden_div2').css('display','block');

				$('#jc_type_table').css('display','none');
				$('#weekly_type_table').css('display','block');
				$('#daily_type_table').css('display','none');

				// $("#weekly_format").attr('required', '');
				$("#jc_format").removeAttr('required'); 
				$("#daily_format").removeAttr('required');

			}else if($beat_format == 'daily'){
				$('#hidden_div').css('display','none');
				// $('#hidden_div2').css('display','none');

				$('#jc_type_table').css('display','none');
				$('#weekly_type_table').css('display','none');
				$('#daily_type_table').css('display','block');
				
				$("#daily_format").attr('required', ''); 
				// $("#weekly_format").removeAttr('required'); 
				$("#jc_format").removeAttr('required'); 
			}else{
				$('#hidden_div').css('display','none');
				$('#hidden_div2').css('display','none');

				$('#weekly_type_table').css('display','none');

				$("#daily_format").removeAttr('required'); 
				$("#weekly_format").removeAttr('required'); 
				$("#jc_format").removeAttr('required'); 
			}
		})

       

    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>

    <script>
        var BASE_URL = "<?php echo base_url();?>index.php/";
    </script>
</body>

</html>
