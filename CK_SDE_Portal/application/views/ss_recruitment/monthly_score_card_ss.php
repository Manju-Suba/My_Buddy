<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SS Recruitment</title>
    <!--favicon-->
    <link rel="icon" href="<?php echo asset_url();?>images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?php echo asset_url();?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <!--Data Tables -->
    <link href="<?php echo asset_url();?>plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo asset_url();?>plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
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
    <!-- <link rel="stylesheet" href="<?php echo asset_url();?>css/response_table.css"> -->
    <link href="<?php echo asset_url();?>plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo asset_url();?>plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <!-- Notification -->
    <link rel="stylesheet" href="<?php echo asset_url();?>plugins/notifications/css/lobibox.min.css" />
    <!-- datepicker -->
    <link href="<?php echo asset_url();?>css/datepicker/jquery-ui.css" rel="stylesheet"/>

    <style>
        .btn-sm{
            padding: 0.15rem 0.2rem !important;
        }
        .badge{
        padding: 0.45em 0.7em !important;
    }
    @media only screen and (max-width: 600px) {

    .hide_td_title {
            display: none;
        }
    }
    .modal_trigger_btn{
        display: none;

    }
    .ui-datepicker-calendar {
      display: none;
    }   
    .table td,

    .table th {

        vertical-align: middle;

        color: #000000;

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
                    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary modal_trigger_btn" data-toggle="modal" data-target="#adt_details_modal" id="adt_details_modal_btn">Basic
                        Modal</button>
                    <!-- Modal -->
                    <div class="modal fade" id="adt_details_modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Weekly Score Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                            aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4 class="mb-0">Weekly ScoreCard</h4>
                            </div>
                            <hr/>
                            <br><div class="row">
                                <div class="form-group col-md-4">
                                    <label>Name</label>
                                    <select name="key_name_list" id="key_name_list" class="form-control single-select">
                                    <option value="">Select</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group col-md-3">
                                   <label for="start_Date">Your Date :</label>
                                    <input name="start_Date" id="start_Date" type="month" min="2018-01" class="form-control " />
                                </div> -->
                                <div class="col-md-3">
                                    <label for="">Action</label>
                                    <br>
                                    <button class="btn btn-warning" type="button" id="btnClear">Clear</button>
                                </div>
                            </div><br>
                            <div class="table-responsive">
                                <table  id="scoreForm_tb" width="100%" border="1" class="table table-striped table-bordered" cellpadding="5" cellspacing="5">
                                    <?php //echo"<pre>";print($data[0]);?>
                                     <tr>
                                        <th colspan="6" >Weekly ScoreCard</th>
                                     </tr>
                                     <!-- <tr id="hidden_static">
                                     </tr> -->
                                      <tbody id="adt_tb_body">

                                     <tr>
                                         <td>STOCKS AS PER NORM (both EPDs & NPDs)</td>
                                         <td>5</td>
                                    
                                     </tr>
                                     <tr>
                                         <td>Infra RSSM vs Actual</td>
                                         <td>5</td>
                                        
                                     </tr>
                                     <tr>
                                         <td>Infra Delivery Vehicle vs Actual</td>
                                         <td>5</td>
                                     </tr>
                                     <tr>
                                         <td>Number of RED RSSM</td>
                                         <td>5</td>
                                     </tr>
                                     <tr>
                                         <td>Order Vs Delivery</td>
                                         <td>5</td>
                                     </tr>
                                     <tr>
                                         <td>Absenteeism (HoW & Total calls condition)</td>
                                         <td>5</td>
                                     </tr>
                                     <tr>
                                         <td>Absenteeism (Actual Absent)</td>
                                         <td>5</td>
                                     </tr>
                                     <tr>
                                         <td>NPD Investment</td>
                                         <td>5</td>
                                     </tr>
                                     <tr>
                                         <td>Financials</td>
                                         <td>5</td>
                                     </tr>
                                     <tr>
                                         <td>INFRASTRUCTURE - Warehouse</td>
                                         <td>5</td>
                                     </tr>
                                     <tr>
                                         <td>SSFA = XDM</td>
                                         <td>5</td>
                                     </tr>
                                     <tr>
                                         <td>XDM regular usage (daily usage)</td>
                                         <td>5</td>
                                     </tr>
                                      <tr>
                                         <td>Issues Raised with SDE</td>
                                         <td>5</td>
                                     </tr>

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
    <!--start switcher-->
    
    <!--end switcher-->
    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="<?php echo asset_url();?>js/popper.min.js"></script>
    <script src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
    <!--plugins-->
    <script src="<?php echo asset_url();?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Data Tables js-->
    <script src="<?php echo asset_url();?>plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url();?>pro_js/ss_recruitment/ss_score_rep.js"></script>
    <!--notification js -->
    <script src="<?php echo asset_url();?>plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/notifications/js/notifications.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/notifications/js/notification-custom-script.js"></script>
    <script src="<?php echo asset_url();?>plugins/select2/js/select2.min.js"></script>
    <!-- date formate js  -->
    <script src="<?php echo asset_url();?>js/datepicker/moment.min.js"></script>
    <!-- datepicker -->
    <!-- <script src="<?php echo asset_url();?>js/datepicker/jquery.js"></script> -->
    <script src="<?php echo asset_url();?>js/datepicker/jquery-ui.min.js"></script>
    
    <script>
        var BASE_URL = "<?php echo base_url();?>index.php/";
        $(document).ready(function () {
            $(".scoreform_m").addClass("mm-active");
        });

    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>
</body>

</html>