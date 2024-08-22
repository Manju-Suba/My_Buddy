<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>CK Competition Watch</title>
	
    <?php include('application/views/layouts/common_css_links.php'); ?>
    <link href="<?php echo asset_url();?>plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="<?php echo asset_url();?>plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
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
					
                    <div class="row">
						<div class="col-12 col-lg-6">
							<div class="card border-lg-top-primary">
								<div class="card-body p-3">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user mr-1 font-24 text-primary"></i>
										</div>
										<h4 class="mb-0 text-primary">Add Form</h4>
									</div>
									<hr>
									<div class="form-body">
                                        <form action="javascript:void(0)" method="POSt" id="cwForm">
                                        
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Date*</label>
                                                    <input type="date" class="form-control" name="cw_date" id="cw_date" required/>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Source*</label>
                                                    <select class="single-select" name="cw_source" id="cw_source" required>
                                                        <option value="Market Visit">Market Visit</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Insight Category*</label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="cw_insight_category[]" id="customCheck1" value="Consumer">
                                                        <label class="custom-control-label" for="customCheck1">Consumer</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="cw_insight_category[]" id="customCheck2" value="Competition">
                                                        <label class="custom-control-label" for="customCheck2">Competition</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="cw_insight_category[]" id="customCheck3" value="Trade">
                                                        <label class="custom-control-label" for="customCheck3">Trade</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="cw_insight_category[]" id="customCheck4" value="Product">
                                                        <label class="custom-control-label" for="customCheck4">Product</label>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label style="visibility: hidden;">Insight Category</label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="cw_insight_category[]" id="customCheck5" value="New Trends">
                                                        <label class="custom-control-label" for="customCheck5">New Trends</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="cw_insight_category[]" id="customCheck6" value="Packaging">
                                                        <label class="custom-control-label" for="customCheck6">Packaging</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="cw_insight_category[]" id="customCheck7" value="Process-BestPractice">
                                                        <label class="custom-control-label" for="customCheck7">Process-BestPractice</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="cw_insight_category[]" id="customCheck8" value="Others">
                                                        <label class="custom-control-label" for="customCheck8">Others</label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Comment</label>
                                                <textarea class="form-control" rows="3" cols="3" name="cw_comment" name="cw_comment"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Input File</label>
                                                <input type="file" class="form-control" name="cw_file[]" id="cw_file" multiple>
                                            </div>
                                            <button type="submit" class="btn btn-primary px-5" id="saveBtn">Save</button>
                                        </form>
                                    </div>
								</div>
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
	
    <?php include('application/views/layouts/common_script_links.php'); ?>
	<script src="<?php echo asset_url();?>plugins/select2/js/select2.min.js"></script>
    <script src="<?php echo asset_url();?>pro_js/add_cw_form.js"></script>

	<script>
        $(document).ready(function () {
            $(".metismenu li").removeClass('mm-active');
            var page = "competition_watch";

            if (page == "competition_watch") {
                $(".eform_m").addClass("mm-active");
            }

			
		});
        $('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
    </script>
</body>

</html>