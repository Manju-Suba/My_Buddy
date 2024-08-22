<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Syndash - Bootstrap4 Admin Template</title>
	<!--favicon-->
	<link rel="icon" href="<?php echo asset_url();?>images/favicon-32x32.png" type="image/png" />
	<!-- Vector CSS -->
	<link href="<?php echo asset_url();?>plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
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
		.page-content-wrapper{
			margin-left:unset !important;
		}
		.footer{
			margin-left:unset !important;

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
					<div class="container">
						<div class="row" id="show_pd_list">
							
							<div class="col-lg-3">
								<div class="card radius-15 bg-secondary">
									<div class="card-body" style="padding: 0.5rem;">
										<div class="media align-items-center">
											<img src="https://via.placeholder.com/110x110" width="80" height="80" class="rounded-circle p-1 border bg-white" alt="" />
											<div class="media-body ml-3">
												<h6 class="mb-0 text-white">CK SubD Input</h6>
												<p class="mb-0 text-white">Login</p>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="card radius-15 bg-light-primary">
									<!-- <a href="http://localhost/CK_Competition_watch/" target="_blank"> -->
									<div class="card-body" style="padding: 0.5rem;">
										<div class="media align-items-center">
											<img src="https://via.placeholder.com/110x110" width="80" height="80" class="rounded-circle p-1 border bg-white" alt="" />
											<div class="media-body ml-3">
												<h6 class="mb-0 text-primary">CK Competition Watch</h6>
												<a href="#" onclick="get_project_type();"><p class="mb-0 text-secondary">Login</p></a>
												
											</div>
										</div>
									</div>
									<!-- </a> -->
								</div>
							</div>
							<div class="col-lg-3">
								<div class="card radius-15 bg-light-info">
									<div class="card-body" style="padding: 0.5rem;">
										<div class="media align-items-center">
											<img src="https://via.placeholder.com/110x110" width="80" height="80" class="rounded-circle p-1 border bg-white" alt="" />
											<div class="media-body ml-3">
												<h6 class="mb-0 text-info">RS Score Card</h6>
												<p class="mb-0 text-secondary">Login</p>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="card radius-15 bg-light-danger">
									<div class="card-body" style="padding: 0.5rem;">
										<div class="media align-items-center">
											<img src="https://via.placeholder.com/110x110" width="80" height="80" class="rounded-circle p-1 border bg-white" alt="" />
											<div class="media-body ml-3">
												<h6 class="mb-0 text-danger">RS Appoinment</h6>
												<p class="mb-0 text-secondary">Login</p>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<!-- end row -->
					<div class="row">
						<div class="col-12 col-lg-3">
							<div class="card radius-15 bg-voilet">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h5 class="mb-0 text-white">CK SubD Input  </h5>
										</div>
										<div class="ml-auto font-35 text-white"><i class="bx bx-cart-alt"></i>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-white">Login</p>
										</div>
										<div class="ml-auto font-14 text-white"></div>

									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card radius-15 bg-primary-blue">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h5 class="mb-0 text-white">CK Competition Watch</h5>
										</div>
										<div class="ml-auto font-35 text-white"><i class="bx bx-support"></i>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-white">Login</p>
										</div>
										<div class="ml-auto font-14 text-white"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card radius-15 bg-rose">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h5 class="mb-0 text-white">RS Score Card</h5>
										</div>
										<div class="ml-auto font-35 text-white"><i class="bx bx-tachometer"></i>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-white">Login</p>
										</div>
										<div class="ml-auto font-14 text-white"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card radius-15 bg-sunset">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h5 class="mb-0 text-white">RS Appoinment</h5>
										</div>
										<div class="ml-auto font-35 text-white"><i class="bx bx-user"></i>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-white">Login</p>
										</div>
										<div class="ml-auto font-14 text-white"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end row-->
					<div class="row">
						<div class="col-lg-3">
							<div class="card radius-15 bg-primary">
								<div class="card-body text-center">
									<img src="https://via.placeholder.com/110x110" width="100" height="100" class="rounded-circle p-1 border bg-white" alt="" />
									<h5 class="mb-0 mt-4 text-white">CK SubD Input</h5>
									<p class="mb-0 text-white">Login</p>
									
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="card radius-15">
								<div class="card-body text-center">
									<img src="https://via.placeholder.com/110x110" width="100" height="100" class="rounded-circle p-1 border" alt="" />
									<h5 class="mb-0 mt-4">CK Competition Watch</h5>
									<p class="mb-0 text-secondary">Login</p>
									
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="card radius-15 bg-danger">
								<div class="card-body text-center">
									<img src="https://via.placeholder.com/110x110" width="100" height="100" class="rounded-circle p-1 border bg-white" alt="" />
									<h5 class="mb-0 mt-4 text-white">RS Score Card</h5>
									<p class="mb-0 text-white">Login</p>
									
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="card radius-15">
								<div class="card-body text-center">
									<img src="https://via.placeholder.com/110x110" width="100" height="100" class="rounded-circle p-1 border bg-white" alt="" />
									<h5 class="mb-0 mt-4">RS Appoinment</h5>
									<p class="mb-0 text-secondary">Login</p>
									
								</div>
							</div>
						</div>
					</div>
					<!--end row-->
					
					<div class="row">
						<div class="col-12 col-lg-2">
							<div class="card radius-15 bg-info">
								<div class="card-body text-center">
									<div class="widgets-icons mx-auto rounded-circle bg-white"><i class='bx bx-bookmark-alt'></i>
									</div>
									<h4 class="mb-0 font-weight-bold mt-3 text-white">574</h4>
									<p class="mb-0 text-white">Bookmarks</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-2">
							<div class="card radius-15 bg-wall">
								<div class="card-body text-center">
									<div class="widgets-icons mx-auto bg-white rounded-circle"><i class='bx bx-user'></i>
									</div>
									<h4 class="mb-0 font-weight-bold mt-3 text-white">574</h4>
									<p class="mb-0 text-white">New Users</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-2">
							<div class="card radius-15 bg-rose">
								<div class="card-body text-center">
									<div class="widgets-icons mx-auto bg-white rounded-circle"><i class='bx bx-cloud-download'></i>
									</div>
									<h4 class="mb-0 font-weight-bold mt-3 text-white">574</h4>
									<p class="mb-0 text-white">Downloads</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-2">
							<div class="card radius-15">
								<div class="card-body text-center">
									<div class="widgets-icons mx-auto bg-light-primary text-primary rounded-circle"><i class='bx bx-upload'></i>
									</div>
									<h4 class="mb-0 font-weight-bold mt-3">574</h4>
									<p class="mb-0">Uploads</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-2">
							<div class="card radius-15">
								<div class="card-body text-center">
									<div class="widgets-icons mx-auto bg-light-success text-success rounded-circle"><i class='bx bx-comment-detail'></i>
									</div>
									<h4 class="mb-0 font-weight-bold mt-3">$984</h4>
									<p class="mb-0">Income</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-2">
							<div class="card radius-15">
								<div class="card-body text-center">
									<div class="widgets-icons mx-auto bg-light-warning text-warning rounded-circle"><i class='bx bx-comment-detail'></i>
									</div>
									<h4 class="mb-0 font-weight-bold mt-3">12.5%</h4>
									<p class="mb-0">Server Load</p>
								</div>
							</div>
						</div>
					</div>
					</div>

					<!--end row-->
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
			<hr/>
			<h6 class="mb-0">Theme Styles</h6>
			<hr/>
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
			<hr/>
			<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" id="DarkSidebar">
				<label class="custom-control-label" for="DarkSidebar">Dark Sidebar</label>
			</div>
			<hr/>
			<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" id="ColorLessIcons">
				<label class="custom-control-label" for="ColorLessIcons">Color Less Icons</label>
			</div>
		</div>
	</div>
	<!--end switcher-->
	<!-- JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?php echo asset_url();?>js/jquery.min.js"></script>
	<script src="<?php echo asset_url();?>js/popper.min.js"></script>
	<script src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="<?php echo asset_url();?>plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?php echo asset_url();?>plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="<?php echo asset_url();?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!-- Vector map JavaScript -->
	
	<!-- <script src="<?php echo asset_url();?>js/index2.js"></script> -->
	<!-- App JS -->
	<script src="<?php echo asset_url();?>js/app.js"></script>

    <script src="<?php echo asset_url();?>pro_js/dashboard.js"></script>
	<script>
		var BASE_URL = "<?php echo base_url();?>index.php/";

    </script>
</body>

</html>