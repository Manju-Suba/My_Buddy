<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Beat Optimization</title>
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

    <!-- Notification -->
    <link rel="stylesheet" href="<?php echo asset_url();?>plugins/notifications/css/lobibox.min.css" />

    <style>
    .table td,
    .table th {
        color: #000000 !important;
    }

    .btn.disabled,
    .btn:disabled {
        cursor: not-allowed ! important;
    }

    table {
        width: 100% !important;
    }

    @media only screen and (max-width: 600px) {

        .add_form_btn{
            margin-top:-26px;
        }
    }

	table.dataTable thead th#sort.sorting_asc:before,table.dataTable thead th#sort.sorting_asc:after{
		display: none;
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
                        <div class="breadcrumb-title pr-3">Beat Optimization</div>
                        <div class="pl-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i
                                                class='bx bx-home-alt'></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Beat Report</li>
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
                                        <h4 class="mb-0">Beat Optimization Details</h4>
										<input type="hidden" name="session_user_name" id="session_user_name" value="<?php echo $this->session->userdata('username'); ?>">
                                    </div>
                                    <!-- <div class="col-md-6 text-right">
										<?php if( $this->session->userdata('role_type') === 'TSO'){ ?>
											<button class="btn btn-info" data-toggle="modal" data-target="#myModal" >Upload</button>  
										<?php } ?>
                                    </div> -->
                                </div>
                            </div>
                            <hr />


							<!-- Modal -->
							<div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog">
								
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Beat Upload</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<form action="javascript:void(0)" method="POSt" id="uploadForm" class="">
												<div class="form-group">
													<p>&nbsp;Sample Excel <a href="<?php echo asset_url();?>sample_excel/beat_excel/Sample_Excel.xlsx">DOWNLOAD</a> &nbsp;&nbsp;&nbsp;<b style="color:red;">*Note - Supported File Format(.xlsx,.xls).</b></p>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-8">
															<label>Beat Upload Type<span style="color:red;">*</span></label>
														</div>
													</div>
													<select class="form-control" name="beat_upload_type" id="beat_upload_type" style="margin-top: -6px;" required>

														<option value=""><b>Select</b></option>
														<option value="add"><b>Add </b></option>
														<option value="over_write"><b>Over Write</b></option>
														
													</select>
                                                </div>
												<div class="form-group">
													<label>Upload <span style="color:red;">*</span></label>
													<input type="file" class="form-control" name="m_file"  id="m_file"  accept=".xlsx,.xls" required/>
												</div>
												<div class="form-group float-right ">
													<button type="submit" class="form-group btn btn-primary" id="saveBtn">Import</button>&nbsp;&nbsp;
													<button type="button" class="form-group btn btn-danger" data-dismiss="modal">Close</button>
												</div>
												
											</form>
										</div>
										<!-- <div class="modal-footer">
											<button type="submit" class="form-group btn btn-primary" id="saveBtn">Import</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
										</div> -->
									</div>
									
								</div>
							</div>

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

									<div class="form-group col-md-4">
										<br>
										<button class="btn btn-danger" id="reset"><i class='bx bx-refresh'></i> Refresh</button>
									</div>
									
								<?php } ?>
								<?php if( $this->session->userdata('role_type') === 'ZSM'){ ?>
									<div class="col-md-4">
										<label>ASM Name</label>
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
										<select class="form-control" name="sde_number" id="sde_number" style="margin-top: -6px;" required>
											<option value=""><b>View All</b></option>
										</select>
									</div>

									<div class="form-group col-md-4">
										<br>
										<button class="btn btn-danger" id="reset"><i class='bx bx-refresh'></i> Refresh</button>
									</div>
								<?php } ?>
							</div>
							
							<!-- <br> -->

                            <div class="table-responsive">
                                <table id="beat_report_table" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr class="table-info">
                                            <th>Sno</th>
                                            <th id="sort">Dist Cus Code</th>
                                            <th>Cmp Cus Code</th>
                                            <th>Outlet Name</th>
                                            <th>Old Route Code</th>
                                            <th>New Route Code</th>
                                            <th>New Suggestive Route Code</th>
                                            <th>New Suggestive Route Name</th>
                                            <th>Outlet Must Visit</th>
                                            <th>Beat Frequency</th>
                                            <th>Outlet Score</th>
                                            <th>ZM</th>
                                            <th>AM</th>
                                            <th>SDE Emp Code</th>
                                            <th>SDE Name</th>
                                            <th>Salesman Name</th>
                                            <th>Salesman SSFA ID</th>
                                            <th>New Route Code2</th>
                                            <th>New Beat Name</th>
                                            <th>Final Beat Frequency</th>
                                            <th>Visit Day(Monday/Saturday)</th>
                                            <th>Comments</th>
                                            <th>Created Date</th>
                                            <th>End Date</th>
                                            <!-- <th>Action</th> -->
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

    <script src="<?php echo asset_url();?>pro_js/beat_optimize/beat_optimize_report.js"></script>

    <script>
        $(document).ready(function() {
            $(".metismenu li").removeClass('mm-active');
            var page = "beat_optimize_report";

            if (page == "beat_optimize_report") {
                $(".eform_m").addClass("mm-active");
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
