<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>CK Competition Watch</title>
	<!--favicon-->
	<link rel="icon" href="<?php echo asset_url();?>images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="<?php echo asset_url();?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<!--Data Tables -->
	<link href="<?php echo asset_url();?>plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo asset_url();?>plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
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
    <style>
        .table td, .table th {
    color: #000000 !important;
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
						<div class="breadcrumb-title pr-3">Form Details</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Entered Forms</li>
								</ol>
							</nav>
						</div>
						<div class="ml-auto">
							<div class="btn-group">
								<a href="<?php echo base_url();?>index.php/Competition/add_competition_watch"><button type="button" class="btn btn-primary">Add Form</button></a>
							</div>
						</div>
					</div>
					<!--end breadcrumb-->
					<!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary radius-30 px-5 m-3" data-toggle="modal" data-target="#popimgbtn" style="display:none;">Card Modal</button>
							<!-- Modal -->
							<div class="modal fade" id="popimgbtn" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
                                
									<div class="modal-content">
										<div class="">
											<div class="card mb-0">
												<img src="" id="pop_img_show" class="card-img-top" alt="...">
												<div class="card-body">
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
					<div class="card">
						<div class="card-body">
							<div class="card-title">
								<h4 class="mb-0">Entered Forms</h4>
							</div>
							<hr/>
							<div class="table-responsive">
								<table id="example2" class="table table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>Sno</th>
											<th>Date</th>
											<th>Source</th>
											<th>Insight Category</th>
											<th>Comment</th>
											<th>Images</th>
											<th>Created By</th>
											<th>Created On</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
									
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
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
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

    <script src="<?php echo asset_url();?>pro_js/cw_form.js"></script>

	<script>
		$(document).ready(function () {
            $(".metismenu li").removeClass('mm-active');
            var page = "competition_watch";

            if (page == "competition_watch") {
                $(".eform_m").addClass("mm-active");
            }

			//Default data table
			// $('#example').DataTable();
			// var table = $('#example2').DataTable({
			// 	lengthChange: false,
			// 	buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
			// });
			// table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
		});
	</script>
	<!-- App JS -->
	<script src="<?php echo asset_url();?>js/app.js"></script>

    <script>
		var BASE_URL = "<?php echo base_url();?>index.php/";

    </script>
</body>

</html>