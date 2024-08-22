<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>OSM Market Visit</title>
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
    <link rel="stylesheet" href="<?php echo asset_url();?>css/response_table.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/app.css" />
    <link rel="stylesheet" href="<?php echo asset_url();?>css/dark-sidebar.css" />
    <link rel="stylesheet" href="<?php echo asset_url();?>css/dark-theme.css" />
    
    <style>
    .table td,
    .table th {
        color: #000000 !important;
    }
    table {
        width: 100% !important;
    }

    </style>
</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <!--page-wrapper-->
        <div class="page-wrapper">
            <!--page-content-wrapper-->
            <div class="page-content-wrapper" style="margin: 35px;">
                <div class="page-content">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0">Particular OSM Details</h4>

                                    </div>
                                </div>
                            </div>
                            <hr />

                            <div class="table-responsive">
                                <table id="" class="table table-bordered zero-configuration" style="width:100%">
                                    <thead>
                                        <tr class="table-info">
                                            <th>S.No</th>
                                            <th>RS</th>
                                            <th>RSSM</th>
                                            <th>Beat</th> 
                                            <th>Total Calls Made</th>
                                            <th>Value</th>
                                            <th>Billscut</th>
                                            <th>TLSD</th>
                                            <th>RSSM Morning Img</th> 
                                            <th>RSSM Evening Img</th>
                                            <th>Created Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
									<tbody>
										<?php foreach($osm_mv_report as $row => $val) { ?> 
											
											<tr>
                                            	<td><?php echo $row+1; ?></td>
                                                <td><?php echo $val['rs_name']; ?></td>
                                                <td><?php echo $val['rssm_name']; ?></td>
                                                <td><?php echo $val['beat_mkt']; ?></td>
                                                <td><?php echo $val['total_calls_made']; ?></td>
                                                <td><?php echo $val['value']; ?></td>
                                                <td><?php echo $val['billut']; ?></td>
                                                <td><?php echo $val['tlsd']; ?></td>
                                                <td><img src= "<?= base_url(); ?>/uploads/rssm_files/<?php echo $val['rssm_morn_file']; ?>"  width="55" height="55"></td>
                                                <td><img src= "<?= base_url(); ?>/uploads/rssm_files/<?php echo $val['rssm_eve_file']; ?>"  width="55" height="55"></td>
                                                <!-- <td><?php echo $val['rssm_eve_file']; ?></td> -->
                                                <td><?php echo date("d-m-Y",strtotime($val['created_on']));  ?></td>
                                                <td><?php echo date("d-m-Y",strtotime($val['updated_on']));  ?></td>
											</tr>

										<?php } ?>
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

    </div>
    <!-- end wrapper -->

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo asset_url();?>js/jquery.min.js"></script>
    <script src="<?php echo asset_url();?>js/popper.min.js"></script>
    <script src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
    <!--Data Tables js-->
    <script src="<?php echo asset_url();?>plugins/datatable/js/jquery.dataTables.min.js"></script>

    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>
</body>

</html>
