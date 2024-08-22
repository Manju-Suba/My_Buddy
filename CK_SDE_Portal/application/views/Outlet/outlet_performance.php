<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Program Outlets Performance</title>
	
    <?php include('application/views/layouts/common_css_links.php'); ?>
    <link href="<?php echo asset_url();?>plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="<?php echo asset_url();?>plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

    <style>
        .table th {
            padding: 0.45rem !important;
        }
        hr {
            margin-top: 0.5rem;
        }
        .card-body {
            padding: 0.75rem;
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
					
                    <div class="row">
						<div class="col-12 col-lg-8 col-md-12 ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="mb-0">Outlets Performance</h4>
                                                <input type="hidden" name="mobile_no" id="mobile_no" value="<?php echo $this->session->userdata('mobile'); ?>">
                                                <input type="hidden" name="role" id="role" value="<?php echo $this->session->userdata('role_type'); ?>">

                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <?php if($this->session->userdata('role_type') == 'LEADER' || $this->session->userdata('role_type')== 'MLEADER' || $this->session->userdata('role_type')== 'VA' || $this->session->userdata('role_type')== 'ZSM'){?>
                                            <div class="col-md-2 col-sm-6 mb-2" >
                                                <label for=""><b>Business</b></label>
                                                <select class="form-control single-select" name="business" id="business" >
                                                    <option value="" selected disabled>Select...</option>
                                                    <!-- <option value="AB Urban">AB Urban</option>
                                                    <option value="FMCG Rural">FMCG Rural</option>
                                                    <option value="PC URBAN">PC URBAN</option> -->
                                                    <option value="FMCG URBAN">FMCG URBAN</option>
                                                    <option value="FMCG RURAL">FMCG RURAL</option>
                                                    <option value="AB EXCLUSIVE">AB EXCLUSIVE</option>
                                                    <option value="SNACKS">SNACKS</option>
                                                    <option value="FMCG MT">FMCG MT</option>
                                                </select>
                                            </div>
                                        <?php } ?>
                                        <?php if($this->session->userdata('role_type')== 'LEADER' || $this->session->userdata('role_type')== 'MLEADER' || $this->session->userdata('role_type')== 'VA' || $this->session->userdata('role_type')== 'Division Head'){?>
                                            
                                            <div class="col-md-3 mb-2" >
                                                <label for=""><b>ZSM</b></label>
                                                <select class="form-control single-select" name="zsm_mobile" id="zsm_mobile" >
                                                    <option value="">Select...</option>
                                                    <!-- <option value="R1 - Rising Star">Rising Star</option>
                                                    <option value="R2 - Smart Outlets">Smart Outlets</option> -->
                                                </select>
                                            </div>
                                        <?php 
                                        } ?>
                                        <?php if($this->session->userdata('role_type')== 'ZSM' || $this->session->userdata('role_type')== 'LEADER' || $this->session->userdata('role_type')== 'MLEADER' ||$this->session->userdata('role_type')== 'VA' || $this->session->userdata('role_type')== 'Division Head'){?>
                                            <div class="col-md-3 " >
                                                <label for=""><b>ASM</b></label>
                                                <select class="form-control single-select" name="asm_mobile" id="asm_mobile" >
                                                    <option value="">Select...</option>
                                                    <!-- <option value="R1 - Rising Star">Rising Star</option>
                                                    <option value="R2 - Smart Outlets">Smart Outlets</option> -->
                                                </select>
                                            </div>
                                        <?php 
                                        } ?>
                                        <?php if($this->session->userdata('role_type')   == 'ASM' || $this->session->userdata('role_type')== 'ZSM'||$this->session->userdata('role_type')== 'LEADER' || $this->session->userdata('role_type')== 'MLEADER' || $this->session->userdata('role_type')== 'VA' || $this->session->userdata('role_type')== 'Division Head'){?>
                                            <div class="col-md-3 " >
                                                <label for=""><b>TSO</b></label>
                                                <select class="form-control single-select" name="tso_mobile" id="tso_mobile" >
                                                    <option value="">Select...</option>
                                                    <!-- <option value="R1 - Rising Star">Rising Star</option>
                                                    <option value="R2 - Smart Outlets">Smart Outlets</option> -->
                                                </select>
                                            </div>
                                        <?php 
                                        } ?>
                                    
                                        <div class="col-md-6">
                                            <label for=""><b>Choose Outlet</b></label>
                                            <select class="form-control single-select" name="outlet" id="outlet" >
                                                <option value="">Select...</option>
                                                <!-- <option value="R1 - Rising Star">Rising Star</option>
                                                <option value="R2 - Smart Outlets">Smart Outlets</option> -->
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <hr />
                                    <div>
                                        <div class="row d-none" id="tables" >
                                            
                                            <div class="col-md-6">
                                                <table class="table table-bordered" id="retailer_table">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2" class="text-center">Retailer Dashboard</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="retailer_data">
                                                    
                                                        <tr>
                                                            <th>3 JC AVG</th>
                                                            <td id="jc_avg"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>JC Target</th>
                                                            <td id="jc_tar"></td>
                                                        </tr> <tr>
                                                            <th>JTD Ach</th>
                                                            <td id="jtd_ach"></td>
                                                        </tr> 
                                                        <tr>
                                                            <th>% Ach</th>
                                                            <td id="ach_per"></td>
                                                        </tr> 
                                                        <tr>
                                                            <th>Balance to be done</th>
                                                            <td id="balance"></td>
                                                        </tr> 
                                                        <tr>
                                                            <th>No of times Billed in JC</th>
                                                            <td id="billed_jc"></td>
                                                        </tr>
                                                    </tbody>

                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table  class="table table-bordered " id="outlet">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="3" class="text-center">Trade Program</th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="3" class="text-center">Line Graph on Last 3 JC Performance (Value)</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Program Name</th>
                                                            <th class="rs">Rising Star</th>
                                                            <th class="so">Smart Outlets</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody id="outlet_table">
                                                        <tr>
                                                            <th>Count</th>
                                                            <td  class="rs" id= "r1count"></td>
                                                            <td class="so" id= "r2count"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Billed</th>
                                                            <td  class="rs" id= "r1billed"></td>
                                                            <td class="so" id= "r2billed"></td>
                                                        </tr> 
                                                        <tr>
                                                            <th>% Billed</th>
                                                            <td  class="rs" id= "r1billed_per"></td>
                                                            <td class="so" id= "r2billed_per"></td>
                                                        </tr> 
                                                        <tr>
                                                            <th>LJC Billed Count</th>
                                                            <td  class="rs" id="r1billed_count"></td>
                                                            <td class="so" id= "r2billed_count"></td>
                                                        </tr> 
                                                        <tr>
                                                            <th>Value Target</th>
                                                            <td  class="rs" id="r1val_tar"></td>
                                                            <td class="so" id="r2val_tar"></td>
                                                        </tr> 
                                                        <tr>
                                                            <th>Value Ach JTD</th>
                                                            <td  class="rs" id="r1value_ach"></td>
                                                            <td class="so" id="r2value_ach"></td>
                                                        </tr> 
                                                        <tr>
                                                            <th>% Value Ach</th>
                                                            <td  class="rs" id="r1value_ach_per"></td>
                                                            <td class="so" id="r2value_ach_per"></td>
                                                        </tr> 
                                                        <tr>
                                                            <th>Balance</th>
                                                            <td  class="rs" id="r1balance"></td>
                                                            <td class="so" id="r2balance"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Value Ach LMTD</th>
                                                            <td  class="rs" id="r1val_ach_lmtd"></td>
                                                            <td class="so" id="r2val_ach_lmtd"></td>
                                                        </tr><tr>
                                                            <th>Growth Over LMTD</th>
                                                            <td class="rs" id="r1growth_over_lmtd"></td>
                                                            <td class="so" id="r2growth_over_lmtd"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
    <script src="<?php echo asset_url();?>pro_js/outlets/outlet_performance.js"></script>

	<script>
        $(document).ready(function () {
           
                $(".eform_m").addClass("mm-active");

			
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