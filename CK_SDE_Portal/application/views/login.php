<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>SDE Portal</title>
    <?php include('application/views/layouts/common_css_links.php'); ?>
	
</head>

<body class="bg-login">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="section-authentication-login d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-8 mx-auto">
					<div class="card radius-15">
						<div class="row no-gutters">
							<div class="col-lg-6">
                                <form id="loginForm" action="javascript:void(0)" method="post" autocomplete="off">
                                    <div class="card-body p-md-5">
                                        <br><br><br>
                                        <div class="text-center">
                                            <img src="<?php echo asset_url();?>images/logo-img.png" alt="">
                                        </div>
                                        
                                        <div class="form-group mt-4">
                                            <label>Mobile No</label>
                                            <input type="text" name="login_mob_no" id="login_mob_no" class="form-control" placeholder="Enter your mobile no" required/>
                                            <!-- <input type="text" name="login_mob_no" id="login_mob_no" onkeypress="return isNumber(event)" class="form-control" placeholder="Enter your mobile no" required/> -->
                                            <!-- <input type="text" name="login_mob_no" id="login_mob_no" class="form-control" placeholder="Enter your mobile no" pattern="[0-9]*" inputmode="numeric" required/> -->
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="login_pass" id="login_pass" class="form-control" placeholder="Enter your password" required/>
                                        </div>
                                        
                                        <div class="btn-group mt-3 w-100">
                                            <button type="submit" class="btn btn-primary btn-block" style="background-color: #123285d1;" id="btnSignin">Log In</button>
                                            <button type="button" class="btn btn-primary" style="background-color: #123285d1;"><i class="lni lni-arrow-right"></i>
                                            </button>
                                        </div>
                                        <br>
                                        <hr>
                                        
                                    </div>
                                </form>

							</div>
							<div class="col-lg-6" style="padding:20px 20px 20px 20px;background-color: #0011ff2b !important;">
								<img src="<?php echo asset_url();?>images/login-images/mybuddy_logo.png" class="card-img login-img h-100" alt="...">
								<!-- <img src="<?php echo asset_url();?>images/login-images/login-frent-img.jpg" class="card-img login-img h-100" alt="..."> -->
							</div>
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->

    <?php include('application/views/layouts/common_script_links.php'); ?>

    <script src="<?php echo asset_url();?>pro_js/login.js"></script>

    

</body>

</html>
