<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scorecard Deployment</title>
    <!--favicon-->
    <link rel="icon" href="<?php echo asset_url();?>images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?php echo asset_url();?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <!--Data Tables -->
    <link href="<?php echo asset_url();?>plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo asset_url();?>plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css">
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
    

    <!-- sweet alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">

    <!-- datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>

    /* lap / system view */
    @media (min-width: 1200px) and (max-width: 1350px){
        .container {
            max-width: 1264px;
        }
    }

    /* tab view */
    @media (min-width: 535px) and (max-width: 900px){
        .container {
            height: 650px !important;
        }

        .rowset{
            margin-top: 15% !important;
        }
    }

    /* mobile view */
    @media (min-width: 120px) and (max-width: 530px){
        .container {
            height: 650px !important;
        }

        .rowset{
            margin-top: 25% !important;
        }
    }

     /* lap / system view */
    @media (min-width: 910px) and (max-width: 1200px){
        .container {
            height: 1033px !important;
        }
        .rowset{
            margin-top: 15% !important;
        }
    }
    

    .container {
        position: relative;
        width: 100%;
        overflow: hidden;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
    }

    .responsive-iframe {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    </style>
</head>

<body>
    <!-- wrapper -->
    <!-- <div class="wrapper"> -->
        <?php include('application/views/layouts/topbar.php'); ?>

        <div class='row rowset' style="margin-top: 7%;margin-left: 3%;">
            <div class='col-md-12 col-12'>

                <div class="row">
                    <?php if($this->session->userdata('role_type')== 'LEADER' || $this->session->userdata('role_type')== 'MLEADER' || $this->session->userdata('role_type')== 'SI' || $this->session->userdata('role_type')== 'ZSM'){?>
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
                    <?php  if( $this->session->userdata('role_type')!= 'ZSM'){?>
                        <div class="col-md-3 col-sm-6 mb-2" >
                            <label for=""><b>ZSM</b></label>
                            <select class="form-control single-select" name="zsm_mobile" id="zsm_mobile" >
                                <option value="">Select...</option>
                            </select>
                        </div>
                    <?php 
                    } }?>
                    <?php if($this->session->userdata('role_type')== 'ZSM' || $this->session->userdata('role_type')== 'LEADER' || $this->session->userdata('role_type')== 'MLEADER' || $this->session->userdata('role_type')== 'SI'){?>
                        <div class="col-md-3 col-sm-6 " >
                            <label for=""><b>ASM</b></label>
                            <select class="form-control single-select" name="asm_mobile" id="asm_mobile" >
                                <option value="">Select...</option>
                            </select>
                        </div>
                    <?php 
                    } ?>
                    <?php if($this->session->userdata('role_type')   == 'ASM' || $this->session->userdata('role_type')== 'ZSM'||$this->session->userdata('role_type')== 'LEADER' || $this->session->userdata('role_type')== 'MLEADER' || $this->session->userdata('role_type')== 'SI'){?>
                        <div class="col-md-3 col-sm-6" >
                            <label for=""><b>SDE</b></label>
                            <select class="form-control single-select" name="tso_mobile" id="tso_mobile" >
                                <option value="">Select...</option>
                            </select>
                        </div>
                    <?php 
                    } ?>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <label for=""><b>SM</b></label>
                        <select class="form-control" name="role_sm" id="role_sm">
                            <option value="">Select...</option>
                        </select>
                    </div>
                
                </div>
                <!-- <div class="row">
                    <div class="col-md-3 col-sm-6 mb-2">
                        <label for=""><b>SM</b></label>
                        <select class="form-control" name="role_sm" id="role_sm">
                            <option value="">Select...</option>
                        </select>
                    </div>
                </div> -->

                <input type="hidden" name="session_role_type" id="session_role_type"
                        value="<?php echo $this->session->userdata('role_type'); ?>">
                <input type="hidden" name="session_mobile_no" id="session_mobile_no"
                        value="<?php echo $this->session->userdata('mobile'); ?>">

                <br>
                <div id="title_div" class="text-center"></div>

                <div class="row">
                    <div class="col-md-5"></div>
                    <div id="spinner" style="display:none;">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden"></span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="container container-sm container-md container-lg container-xl" > </div>
       
        <!-- <!?php include('application/views/layouts/footer.php'); ?> -->
    <!-- </div> -->
    <!-- end wrapper -->

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo asset_url();?>js/popper.min.js"></script>
    <script src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
    <!--plugins-->
    <script src="<?php echo asset_url();?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/metismenu/js/metisMenu.min.js"></script>

    <!--notification js -->
    <script src="<?php echo asset_url();?>plugins/select2/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
 
    <script src="<?php echo asset_url();?>pro_js/fivesec_scorecard/scorecard_report.js"></script>
    <!-- <!?php $iframeUrl = 'https://testing_demo.cavinkare.in/five_sec_sc_FE/#/report/' ; ?> -->
    <?php $iframeUrl = 'https://magicportal.cavinkare.in/five_sec_sc_FE/#/report/' ; ?>
        
    <script>

        $('#role_sm').on('change',function(){
            sm_data();
            
            var smnumber = $('#role_sm').val();
            var iframeUrl = <?php echo json_encode($iframeUrl); ?>;

            var selectElement = document.getElementById("role_sm");
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var dataIdValue = selectedOption.getAttribute("data-id");
            var smName = selectedOption.getAttribute("data-sm");

            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1; // Months are 0-indexed, so add 1
            var year = currentDate.getFullYear();

            // Format the date components as "d-m-y"
            var formattedDate = day + '-' + (month < 10 ? '0' : '') + month + '-' + year;

            // alert(formattedDate)

            var content = '<h5>DAILY SCORECARD OF '+smName+' AS ON '+formattedDate +'</h5>';

            $('#title_div').html(content);

            if(dataIdValue == 'PC URBAN'){
                var business = "1";
            }
            else if(dataIdValue == 'AB Urban'){
                var business = "2";
            }
            else if(dataIdValue == 'FMCG RURAL'){
                var business = "3";
            }
            $('#spinner').css('display','block');

            setTimeout(function(){
                $('#spinner').css('display','none');
            },5000);

            $('.container').html('<iframe class="responsive-iframe" src="' + iframeUrl + business + '/'+ smnumber + '" ></iframe>');

            // https://testing_demo.cavinkare.in/fsbackend/api/pc/get/sm/business/smNumber
        
        })


    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>

    <script>
        var BASE_URL = "<?php echo base_url();?>index.php/";
    </script>
</body>

</html>
