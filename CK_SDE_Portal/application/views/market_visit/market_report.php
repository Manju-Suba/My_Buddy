<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SDE Market Visit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <!--plugins-->
    <link href="<?php echo asset_url();?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?php echo asset_url();?>css/pace.min.css" rel="stylesheet" />
    <!-- <script src="<?php echo asset_url();?>js/pace.min.js"></script> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap.min.css" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="<?php echo asset_url();?>css/icons.css" />
    <!-- App CSS -->
    <!-- <link rel="stylesheet" href="<?php echo asset_url();?>css/app.css" /> -->
    <!-- <link rel="stylesheet" href="<?php echo asset_url();?>css/dark-sidebar.css" /> -->
    <!-- <link rel="stylesheet" href="<?php echo asset_url();?>css/dark-theme.css" /> -->

    <?php include('application/views/layouts/common_css_links.php'); ?>

    <style>

        @media (min-width: 334px) and (max-width: 380px) {
            .fc-scroller.fc-day-grid-container{
                /* height: 311.385px !important; */
                height: auto !important;
            }

                /* margin-top: 41px;
                margin-right: 149px;
            } */

            .fc-event {
                font-size: .65em;
            }

            .modal {
                width: 200%;
                padding: 18px;
                line-height: 1.2;
                font-size: 11px;
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

            .fc-day-grid-event {
                padding: 0px 17px !important;
            }

            .row{
                max-height: calc(100vh - 200px);
                overflow-y: auto;
            }
         

        }




        .form-group.pointer{
            pointer-events: none;
        }

        .fc-day-grid-event {
            margin: 1px 2px 0;
            padding: 2px 27px;
        }

        /* .fc-time{
            display: none;
        } */

		.fc-day-grid-event .fc-content {
			margin-left: -18px;
    		margin-right: -19px;
			text-align: center;
		}

        .fc-event, .fc-event-dot {
            background-color: #3ab11c40;
            border: 1px solid #2ea90f;
        }

        .modal-body .card.green_card {
            box-shadow: 0 0.1rem 0.7rem rgb(47 219 26 / 93%);
        }

        .modal-body .card.orange_card {
            box-shadow: 0 0.1rem 0.7rem rgb(237 113 6);
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
                            <div class="breadcrumb-title pr-3">Market Visit </div>
                            <div class="pl-3">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0 p-0">
                                        <li class="breadcrumb-item"><a href="javascript:;"><i
                                                    class='bx bx-home-alt'></i></a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Report View</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!--end breadcrumb-->

                        
                        <input type="hidden" name="session_role_type" id="session_role_type" value="<?php echo $this->session->userdata('role_type'); ?>">
                        <input type="hidden" name="session_mobile_no" id="session_mobile_no" value="<?php echo $this->session->userdata('mobile'); ?>">
                        <input type="hidden" name="session_business" id="session_business" value="<?php echo $this->session->userdata('business'); ?>">

                        <div class=" card">
                            <div class="card-body" style="height: auto;">
                                <div>
                                    <div class="row">
                                        <div class="col-md-3 busi_view" style="display:none;">
                                            <label for="">Business List</label>
                                            <select name="af_busi_list" id="af_business_list" class="form-control form-control-sm">
                                            <option value="" selected disabled>Select</option>
                                            <!-- <option value="">View All</option> -->
											</select>
                                        </div>

                                        <div class="col-md-3 lead_view dh_view" style="display:none;">
                                            <label for="">ZSM Name</label>
                                            <select name="af_zsm_list" id="af_zsm_list" class="form-control form-control-sm">
                                            <option value="">View All</option>
											</select>
                                        </div>

                                        <div class="col-md-3 lead_view zsm_view" style="display:none;">
                                            <label for="">ASM Name</label>
                                           

                                            <select name="af_asm_list" id="af_asm_list" class="form-control form-control-sm">
											<option value="">View All</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 lead_view zsm_view asm_view" style="display:none;">
                                            <label for="">SDE Name</label>
                                            <select name="af_tso_list" id="af_tso_list" class="form-control form-control-sm">
											<option value="">View All</option>
                                            </select>
                                        </div>
										<p class="lead_view zsm_view asm_view tso_view">(OR)</p>
                                        <div class="col-md-3 lead_view zsm_view asm_view tso_view" style="display:none;">
                                            <label for="">SM Name</label>
                                            <select name="af_sm_list" id="af_sm_list" class="form-control form-control-sm">
											<option value="">View All</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 lead_view zsm_view asm_view tso_view">
                                            <br>

                                            <button class="btn btn-sm btn-danger" id="filterClearbtn"><i class='bx bx-refresh'></i> Reset</button>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary radius-30 px-5 m-3" data-toggle="modal"
                        data-target="#popbtn" style="display:none;">Card Modal</button>
                    <!-- Modal -->
                <div class="modal fade" id="popbtn" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 45%; height:auto;">

                        <div class="modal-content" >
                            <div class="modal-header">
                                <pre><h5 class="modal-title">View Single Report</h5>
<span id="cret_time"></span></pre>
                                <button type="button" class="btn-close" title="Close" data-dismiss="modal" aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body" >
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group pointer col-md-6 col-12">
                                                <div class="row" id="scroll">
                                                    <div class="col-md-5 col-4">
                                                        <label><b>Auto ID </b></label>
                                                    </div>
                                                    <div class="col-md-7 col-8">
                                                        <div id="auto_id" ></div>
                                                        <!-- <input type="text" class="form-control" id="auto_id" /> -->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group pointer col-md-6 col-12">
                                                <div class="row">
                                                    <div class="col-md-4 col-4">
                                                        <label><b>RSSM  </b></label>
                                                    </div>
                                                    <div class="col-md-8 col-8">
                                                        <div id="rssm_mkt" ></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group pointer col-md-6 col-12">
                                                <div class="row">
                                                    <div class="col-md-5 col-4">
                                                        <label><b>Beat </b></label>
                                                    </div>
                                                    <div class="col-md-7 col-8">
                                                        <div id="beat_mkt" ></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group pointer col-md-6 col-12">
                                                <div class="row">
                                                    <div class="col-md-4 col-4">
                                                        <label><b>RS  </b></label>
                                                    </div>
                                                    <div class="col-md-7 col-8">
                                                        <div id="rs_mkt" ></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group pointer col-md-6 col-12">
                                                <div class="row">
                                                    <div class="col-md-5 col-6">
                                                        <label><b>Total Call Made </b></label>
                                                    </div>
                                                    <div class="col-md-7 col-6">
                                                        <div id="total_calls_mkt" ></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group pointer col-md-6 col-12">
                                                <div class="row">
                                                    <div class="col-md-4 col-6">
                                                        <label><b>Value  </b></label>
                                                    </div>
                                                    <div class="col-md-8 col-6">
                                                        <div id="value_mkt" ></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group pointer col-md-6 col-12">
                                                <div class="row">
                                                    <div class="col-md-5 col-6">
                                                        <label><b>Billscut  </b></label>
                                                    </div>
                                                    <div class="col-md-7 col-6">
                                                        <div id="billut_mkt" ></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group pointer col-md-6 col-12">
                                                <div class="row">
                                                    <div class="col-md-4 col-6">
                                                        <label><b>TLSD  </b></label>
                                                    </div>
                                                    <div class="col-md-8 col-6">
                                                        <div id="tlsd_mkt" ></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-md-6 col-12">
                                                <label><b>RSSM Image ( morning ) </b></label>
                                                <div id="rssm_mrg_img" ></div>
                                                <span id="image-required"></span>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label><b>RSSM Image ( evening ) </b></label>
                                                <div id="rssm_eve_img" ></div>
                                            </div>
                                        <div class="form-group pointer">
                                            <label><b>Feedback </b></label>
                                            <textarea type="text" class="form-control" name="edit_feedback" id="edit_feedback" required ></textarea>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label><b>Comment </b></label>
                                            <textarea class="form-control" name="edit_comment" id="edit_comment" ></textarea>
                                        </div> -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
            </div>

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
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo asset_url();?>js/popper.min.js"></script>
    <script src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
    <!--plugins-->
    <script src="<?php echo asset_url();?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?php echo asset_url();?>js/app.js"></script>

    <script src="<?php echo asset_url();?>pro_js/market_visit/calender_report.js"></script>

    <script>

        // if( orange_man == 's'){ 
        //     .css('background', '#e16812;');
        // }else{
        //     .css('background', '#368b0b;');
        // }
             
    </script>
    <script>
        var BASE_URL = "<?php echo base_url();?>index.php/";
    </script>

</html>
