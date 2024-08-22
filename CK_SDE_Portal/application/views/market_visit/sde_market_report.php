<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SDE Market Visit</title>
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


    <!-- datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>

        @media (min-width: 334px) and (max-width: 380px) {
            h4{
                font-size: 1.1rem !important;
            }

            /* img.rssm_img_cls_morn {
                max-width: 100%;
                height: auto;
            } */

        }

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

        input#edit_rssm_file ,input#edit_m_file ,input#edit_rssm_eve_file{
            height: calc(1.2em + 1.1rem + 2px);
            line-height: 1.2;
            padding: 0.35rem 0.75rem;
        }

        .box {
            height: 20px;
            width: 20px;
            margin-bottom: 15px;
            border: 1px solid black;
        }

        .file-required{
            border-block-color: red;
        }

        #rssm_style .select2.select2-container.select2-container--bootstrap4{
            margin-top: -6px;
        }

    /* .buttons-html5 ,.buttons-print{
        display: none;
    } */

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

					<?php if( $this->session->userdata('role_type') === 'TSO'){ ?>

						<div class="row">
							<div class="col-md-3">
								<div class="card" style="background-color: #ff81003b; border-radius: 10px; border-color: #ff5e00;">
									<!-- <div class="col-md-6">
										<div class="text-center">
											<img width="42" src="http://hub1.cavinkare.in/Asset_Management_HEPL/public/images/icon-asset.png">
										</div>
									</div> -->
									<div class="text-center">
										<div style="padding: 8px 8px 8px 24px;">
											<div class="row">
												<p style="margin-bottom: 0rem;"><b>Total Orange Salesman  &nbsp;:</b> &nbsp;&nbsp;</p> 
												<span><b><?php echo($get_sde_under_osm_count) ?></b></span>
											</div>
										</div>
									</div>
									<!-- <div class="footer">
										<hr>
										<div class="stats">
											<i class="fa fa-angle-double-right color-white"></i> <span class="color-white"><a class="color-white" href="http://hub1.cavinkare.in/Asset_Management_HEPL/public/index.php/assetlist">More info</a> <span></span></span>
										</div>
									</div> -->
								</div>
							</div>
							<div class="col-md-3">
								<div class="card" style="background-color: #24db543b; border-radius: 10px; border-color: #1a6407;">
									<div class="text-center">
										<div style="padding: 8px 8px 8px 24px;">
											<div class="row">
												<p style="margin-bottom: 0rem;"><b>OSM -Market Visited &nbsp;:</b> &nbsp;&nbsp;</p> 
												<span><b><?php echo($get_sde_under_osm_count_mv) ?></b></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
                    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary radius-30 px-5 m-3" data-toggle="modal"
                        data-target="#popimgbtn" style="display:none;">Card Modal</button>

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
                    <!-- Button trigger modal --> 

                    <!-- Modal -->
                    <div class="modal fade" id="popadtviewbtn" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"> Details View</h5>
                                    <button type="button" class="close" data-dismiss="modal" id="updateModel" aria-label="Close"> <span
                                            aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="javascript:void(0)" method="POST" id="updateForm">
                                        <input type="hidden" class="form-control" name="edit_id" id="edit_id" />

                                        <div class="form-row">
                                            <div class="form-group col-md-4" style="pointer-events: none;">
                                                <label>RS <span style="color:red;">*</span></label>
                                                <input class="form-control" type="text" name="edit_rs_mkt" id="edit_rs_mkt" readonly required />
                                                <!-- <select class="single-select" name="edit_rs_mkt" id="edit_rs_mkt" readonly required>
                                                    <option value="">Select...</option>
                                                </select> -->
                                            </div>
                                            <div class="form-group col-md-4" id="rssm_style"  style="pointer-events: none;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>RSSM <span style="color:red;">*</span></label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div id="color_code" class="box"></div>
                                                    </div>
                                                </div>
                                                <!-- <input class="form-control" type="text" name="edit_rssm_mkt" id="edit_rssm_mkt" readonly required /> -->
                                                <select class="single-select" name="edit_rssm_mkt" id="edit_rssm_mkt" disabled readonly required>
                                                    <option value="">Select...</option>
                                                   
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4" style="pointer-events: none;">
                                                <label>Beat <span style="color:red;">*</span></label>
                                                <input class="form-control" type="text" name="edit_beat_mkt" id="edit_beat_mkt" readonly required />
                                                <!-- <select class="single-select" name="edit_beat_mkt" id="edit_beat_mkt" readonly required>
                                                    <option value="">Select...</option>
                                                </select> -->
                                            </div>
                                            
                                            <div class="form-group col-md-3">
                                                <label>Total Calls Made <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="edit_total_calls" id="edit_total_calls" required >
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Value <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="edit_value" id="edit_value" required >
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Billscut <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="edit_billut" id="edit_billut" required >
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>TLSD <span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="edit_tlsd" id="edit_tlsd" required >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Feedback/Comment </label>
                                            <textarea type="text" class="form-control" name="edit_feedback" id="edit_feedback" ></textarea>
                                        </div> 
                                        <div class="form-row">
                                            <!-- <div class="form-group col-md-6"></div> -->
                                            <div class="form-group col-md-6">
                                                <label>RSSM Image ( morning ) <span style="color:red;">*</span></label>
                                                <div id="rssm_mrg_img" ></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>RSSM Image ( evening ) <span style="color:red;">*</span></label>
                                                <div id="rssm_eve_img" ></div>
                                                <span id="image-required"></span>
                                            </div>
                                        </div>
                                        
                                        
                                        <!-- <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Upload <span style="color:red;">*</span></label>
                                                <input type="file" class="form-control" name="m_file[]" multiple id="m_file"  accept=".png, .jpg, .jpeg, .PNG, .JPG, .JPEG" required/>
                                            </div>
                                        </div> -->
                                    </form>
                                </div>

                                <div class="modal-footer">
									<span id="all-required"></span>
                                    <!-- <button type="submit" class="btn btn-primary px-5" id="updateBtn">Update</button> -->
                                    <div id="updat_smt_btn">
                                        <button type="submit" class="btn btn-primary px-5" id="updateBtn">End Market</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                



                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0">Entered Forms</h4>
                                    </div>
                                    <div class="col-md-6 btn-market-style">
                                        <?php 

                                            if($this->session->userdata('role_type') == 'SM' || $this->session->userdata('role_type') == 'TSO'){
                                            ?>
                                                <!-- <a href="<?php echo base_url();?>index.php/add_sde_market"> -->
                                                    <button type="button" class="btn btn-primary add_form_btn" id="go_to_market_btn" style="float:right;">Go To Market</button>
                                                <!-- </a> -->
                                        <?php
                                        }
                                    ?>
                                    </div>
                                </div>

                            </div>
                            <hr />

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Date</label>
                                    <input type="text" name="from_date"  placeholder="yyyy-mm-dd" id="from_date" style="width: 237px;" class="form-control form-control-sm" autocomplete="off">
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
                                <table id="example2" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr class="table-info">
                                            <th>Sno</th>
                                            <th>RS</th>
                                            <th>RSSM</th>
                                            <th>Beat</th>
                                            <th>Total Calls Made</th>
                                            <th>Value</th>
                                            <th>Billscut</th>
                                            <th>TLSD</th>
                                            <!-- <th>Feedback</th> -->
                                            <!-- <th>RSSM Morning Img</th> -->
                                            <!-- <th>RSSM Evening Img</th> -->
                                            <!-- <th>Market Images</th> -->
                                            <!-- <th>Created By</th> -->
                                            <th>Created Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- // warning pop start -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary radius-30 px-5 m-3" data-toggle="modal" data-target="#popaltbtn" style="display:none;">Card Modal</button>
				<!-- Modal -->

                <div class="modal fade" id="popaltbtn" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="color:red;">Alert Warning !</h5>
                                <button type="button" class="close" data-dismiss="modal" id="updateModel" aria-label="Close"> <span
                                        aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="javascript:void(0)" method="POST" id="updateForm">
                                    <input type="hidden" class="form-control" name="edit_id" id="edit_id" />

                                    <div class="form-row">
                                        <div class="form-group col-md-12" style="pointer-events: none;">
                                           <div>
                                            <b>Yesterday Details are not Completed , pls fill/Update that </b>
                                            <p>And Go Further Proccess...</p>
                                            <br>
                                            <p><b>Check ID : </b> <span id="auto_id_s"></span></p>
                                            <div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // warning pop end -->

                
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
    <!-- <script src="<?php echo asset_url();?>js/jquery.min.js"></script> -->
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

    <script src="<?php echo asset_url();?>pro_js/market_visit/market_visit_report.js"></script>
 
    <script>
        $(document).ready(function() {
            $(".metismenu li").removeClass('mm-active');
            var page = "sde_market_report";

            if (page == "sde_market_report") {
                $(".eform_m").addClass("mm-active");
            }

        });

        $('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});

        $("#edit_rssm_mkt").on('change', function() {
            var selection = $(this).find('option:selected');
            var data1 = selection.data('data1');

            document.getElementById('color_code').setAttribute( "class", 'box ' +data1 );

            document.getElementById('color_code').style.backgroundColor = data1;
        });

           
        $(function() {
            $( "#from_date" ).datepicker({  
                // dateFormat: 'dd/mm/yy',
                dateFormat: "yy-mm-dd",
                maxDate: new Date 
            });
        });

        $('#go_to_market_btn').click(function(){
            // var user_mobile = $('#session_mobile_no').val();
            // var yesterday = new Date(Date.now() - 864e5); // 864e5 == 86400000 == 24*60*60*1000
            // var s = yesterday.toLocaleDateString(undefined, {timeZone: 'Asia/Kolkata'});

            $.ajax({  
                url:BASE_URL + 'market_visit/SdeMarket/get_pending_form', 
                method:"POST",  
                // data: {'s':s},
                cache:false,
                dataType:"json",
            
                success: function (data) {

                    if( data.response == 'error' ){

                        var id = data.id ;

                        Swal.fire({
                            title: "Warning Alert!",
                            text: "Some Details are not completed, Please Fill that & Go further Proccess..",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#34c38f",
                            cancelButtonColor: "#f46a6a",
                            confirmButtonText: "Update now"
                        }).then(function(result) {
                            if (result.value) {
                                get_adtdetails_viewpop(id);
                            } else {
                                $('#upload').modal('hide');
                            }
                        });

                        // $('#popaltbtn').modal('show');
                        // $('#auto_id_s').html(data.auto);

                        // alert(data.auto);
                    }

                    if( data.response == 'success'){
                        
                        url = BASE_URL +'add_sde_market';
                        window.location.href = url; 
                    }

                }
            }); 
        })

    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>

    <script>
        var BASE_URL = "<?php echo base_url();?>index.php/";
    </script>
</body>

</html>
