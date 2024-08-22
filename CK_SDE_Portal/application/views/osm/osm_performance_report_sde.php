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
    
	<!-- calendar -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <!-- Notification -->
    <link rel="stylesheet" href="<?php echo asset_url();?>plugins/notifications/css/lobibox.min.css" />

    <style>

		@media (min-width: 334px) and (max-width: 380px) {
			
            /* .fc-day-grid-event {
                padding: 0px 17px !important;
            } */

			.fc-day-grid-event {
				padding: 0px 2px !important;
			}

			.fc-event .fc-content {
				position: relative;
				z-index: 2;
			}

            .fc-scroller.fc-day-grid-container{
                height: auto !important;
            }

            .fc-event {
                font-size: .65em;
            }

            .modal {
                width: 254%;
                padding: 18px;
                line-height: 1.2;
            }

            .modal .row{
                margin-bottom: -10px;
            }

            .modal img{
                width: 200px;
                height: 100px;
            }

            .fc-event-container{
                overflow: hidden;
                /* overflow-x: scroll; */
            }

        }

		.table td,
		.table th {
			color: #000000 !important;
		}

		table {
			width: 100% !important;
		}

		.weekly{
			/* background-color: #ff8000; */
			background-color: #d78d42;
		}
		.weekly_row{
			/* background-color: #ffc107; */
			/* background-color: #d7e921e8; */
			background-color:#ebf507e8;
		}

		.tta{
			text-align:center;
		}

		.fc-event {
			background-color: #e5580673;
			border: 1px solid #ad0a0a;
			color: black;
		}

		.fc-day-grid-event.fc-h-event.fc-event.fc-start.fc-end.fc-draggable.fc-resizable .fc-content:hover{
			color: #e10a0a;
		}

		.fc-content-skeleton table thead .fc-day-top.fc-past{
			position: sticky; 
			top: -1px; 
			z-index: 1;
		}

		.fc-month-button.fc-button.fc-state-default.fc-corner-left.fc-corner-right.fc-state-active{
			display: none;
		}

		table.dataTable thead th#sn.sorting_asc:before,table.dataTable thead th#sn.sorting_asc:after{
			display: none;
		}

		.datepicker.datepicker-dropdown{
			top: 274.797px !important;
			left: 565.25px;
			display: block;
			width: 220px !important;
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
                    <div class="card" >
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
								<div class="col-md-3 form-group">
									<label>Orange Salesman Report Format </label>
									<select class="form-control" name="beat_format" id="beat_format" style="margin-top: -6px;background-color: #5fc3e942;" required>
										<option value="" disabled><b>Select..</b></option>
										<option value="jc_wise" selected><b>JC Wise </b></option>
										<option value="weekly"><b>Weekly</b></option>
										<option value="daily"><b>Daily</b></option>
									</select>
								</div>
								<div id="hidden_div1" style="display:block;" class="col-md-3 form-group jc_view">
									<label>Financial Year </label>
									<select class="form-control" id="_year" name="_year" style="margin-top: -6px;"></select>
									<!-- <input class="date-own form-control" style="margin-top: -6px;" id="_year" name="_year" type="text" autocomplete="off" placeholder="2023"> -->
								</div>
								<div id="hidden_div" style="display:block;" class="col-md-3 form-group jc_view">
									<label>JC </label>
									<select class="form-control" name="jc_type" id="jc_type" style="margin-top: -6px;">
										<?php 
											$month = date('m');
										?>
										<!-- <option value="">View All</option> -->
										<option value="JC13">JC13</option>
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
								<div class="col-md-3 form-group lead_view zsm_view asm_view tso_view" style="display:none;">
									<label for="">OSM Name</label>
									<select name="af_sm_list" id="af_sm_list" class="form-control" style="margin-top: -6px;">
										<option value="">View All</option>
									</select>
								</div>
								<div class="col-md-2" style="margin-top: 21px;">
									<button class="btn btn-sm btn-danger mt-1" id="filterClearbtn" style="padding-block: 6px;"><i class='bx bx-refresh'></i> Reset</button>
								</div>	

                            </div>
                            <hr />
							<div id="loading_card" class="text-center"></div>

							<div id="jc_type_table" style="display:block;">
								<div class="table-responsive">
									<table id="osm_table" class="table table-bordered" style="width:100%">
										<thead>
											<tr class="table-info">
												<th>Sno</th>
												<th id='sn'>Orange Salesman Name</th>
												<th>ECO</th>
												<th>Planned Man Days</th>
												<th>Actual Man Days</th>
												<th>Man Days %</th>
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
								<div class="table-responsive" style="height:auto;max-height:300px;">
									<table id="" class="table table-bordered" style="width:100%;" >
										<thead>
											<tr style="position: sticky; top: -1px; z-index: 1; ">
												<th rowspan="2" class="text-center weekly" style="padding-bottom: 32px;" >Current JC</th>
												<th class="weekly_row" colspan="1"></th>
												<th class="text-center weekly_row" colspan="4" class="tta">Mandays %</th>
												<th class="text-center weekly_row" colspan="4" class="tta">Productivity %</th>
											</tr>
											<tr class="weekly_row" style="position: sticky; top: 45px; z-index: 1; ">
												<th>OSM Name</th>
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
										<!-- <tbody style="height: 250px;" id= "weekly_current_jc"> -->
										<!-- <tbody id= "weekly_current_jc"> -->
										</tbody>
									</table>
								</div>

								<br><br>
								<div id="weekly_current_jc1"></div>

								<br><br>
								<div id="weekly_current_jc2"></div>
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
                                            <div class="form-group col-md-6 col-6">
                                                <label><b>SM Name :</b></label>
											</div>
											<div class="form-group col-md-6 col-6">
                                                <div id="sm_name" ></div>
                                            </div>

											<div class="form-group col-md-6 col-6">
												<label><b>Total Call Made :</b></label>
											</div>
											<div class="form-group col-md-6 col-6">
												<div id="total_calls_mkt" ></div>
                                            </div>

                                            <div class="form-group col-md-6 col-6">
												<label><b>Value :</b></label>
											</div>
											<div class="form-group col-md-6 col-6">
												<div id="value_mkt" ></div>
                                            </div>

											<div class="form-group col-md-6 col-6">
												<label><b>Billscut : </b></label>
											</div>
											<div class="form-group col-md-6 col-6">
												<div id="billut_mkt" ></div>
                                            </div>

											<div class="form-group col-md-6 col-6">
												<label><b>TLSD :</b></label>
											</div>
											<div class="form-group col-md-6 col-6">
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
	
	<!-- calendar-js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

	<script src="<?php echo asset_url();?>pro_js/osm/calender_report.js"></script>
    <script src="<?php echo asset_url();?>pro_js/osm/osm_performance.js"></script>
    <script>
        $(document).ready(function() {
            $(".metismenu li").removeClass('mm-active');
            var page = "osm_performance";

            if (page == "osm_performance") {
                $(".orange_salesmam_performance").addClass("mm-active");
            }

			var yearsLength = 10;
			var currentYear = new Date().getFullYear();
			for(var i = 0; i < 10; i++){
				var d = new Date(),
				n = new Date().getMonth();

				if((n+1) <= 3){
					var next = currentYear-1;
					var year = next + '-' + currentYear.toString().slice(-2);
				}else{
					var next = currentYear+1;
					var year = currentYear + '-' + next.toString().slice(-2);
				}
			
				$('#_year').append(new Option(year, year));
				currentYear--;
			}

        });

		$('#beat_format').change(function(){
			$beat_format = $('#beat_format').val();

			if($beat_format == 'jc_wise'){
				$('#hidden_div').css('display','block');
				$('#hidden_div1').css('display','block');

				$('#jc_type_table').css('display','block');
				$('#weekly_type_table').css('display','none');
				$('#daily_type_table').css('display','none');
				
				$('#af_sm_list').val('');
				$('#loading_card').html('');
				// get_weekly_current_jc(); 

			}else if($beat_format == 'weekly'){
				$('#hidden_div').css('display','none');
				$('#hidden_div1').css('display','none');

				$('#jc_type_table').css('display','none');
				$('#weekly_type_table').css('display','block');
				$('#daily_type_table').css('display','none');

				$('#af_sm_list').val('');
				// get_weekly_current_jc();

			}else if($beat_format == 'daily'){ 
				$('#hidden_div').css('display','none');
				$('#hidden_div1').css('display','none');

				$('#jc_type_table').css('display','none');
				$('#weekly_type_table').css('display','none');
				$('#daily_type_table').css('display','block');
				
				$('#af_sm_list').val('');
				$('.fc-month-button').click(); 
				$('#loading_card').html('');

				// $('.fc-month-button').css('display','none');
			}
			else{
				$('#hidden_div').css('display','none');
				$('#hidden_div1').css('display','none');
				$('#weekly_type_table').css('display','none');
			}
		})
		
		$('.date-own').datepicker({
			
			minViewMode: 2,
			format: 'yyyy',
		   	autoclose: true,
	  	});

		$("#_year").on('change', function () {
			get_osm_per_details();
		});


    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>

    <script>
        var BASE_URL = "<?php echo base_url();?>index.php/";
    </script>
</body>

</html>
