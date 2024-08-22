<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>CK SDE Report</title>
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

    <style>
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

	body {
	font-family: 'Open Sans', sans-serif;
	font-weight: 300;
	}
	.tabs {
	max-width: 1000px;
	max-height: 500px;
	margin: 0 auto;
	padding: 0 20px;
	}
	#tab-button {
	display: table;
	table-layout: fixed;
	width: 100%;
	margin: 0;
	padding: 0;
	list-style: none;
	}
	#tab-button li {
	display: table-cell;
	width: 20%;
	}
	#tab-button li a {
	display: block;
	padding: .5em;
	background: #eee;
	border: 1px solid #ddd;
	text-align: center;
	color: #000;
	text-decoration: none;
	}
	#tab-button li:not(:first-child) a {
	border-left: none;
	}
	#tab-button li a:hover,
	#tab-button .is-active a {
	border-bottom-color: transparent;
	background: #fff;
	}
	.tab-contents {
	padding: .5em 2em 1em;
	/* border: 1px solid #ddd; */
	}

	/* .select2-container .select2-selection--multiple .select2-selection__rendered {
		max-height: 30px;
		overflow: auto; 
	}
	.select2-container .select2-selection--multiple .select2-selection__rendered {
		display: inline-block; 
		white-space: nowrap; 
	} */
	.tab-button-outer {
	display: none;
	}
	.tab-contents {
	margin-top: 20px;
	}
	@media screen and (min-width: 767px) {
	.tab-button-outer {
		position: relative;
		z-index: 2;
		display: block;
	}
	.tab-select-outer {
		display: none;
	}
	.tab-contents {
		position: relative;
		top: -1px;
		margin-top: 0;
	}
	}
	/* Medium devices (desktops, 992px and up) */
	@media (min-width: 820px) and (max-width:912px) {
		#tab-button li a {
			font-size: 11px !important;
		}
	}
	/* .lobibox-notify-msg{
		max-height: 328px !important;
	} */
	#update_form label{
		font-weight:bold
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

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0">Masters Uploads</h4>
                                    </div>
                                </div>
								<div class="row mt-5">
									<div class="col-md-8">
										<div class="tabs">
											<div class="tab-button-outer">
												<ul id="tab-button" class="nav nav-tabs">
												<li class="nav-item"><a href=".tab01">Beat optimization</a></li>
												<li class="nav-item"><a href="#tab02">Masters</a></li>
												<li class="nav-item"><a href="#tab03">OSM Performance</a></li>
												<li class="nav-item"><a href="#tab04">RS Masters</a></li>
												</ul>
											</div>
											<div class="tab-select-outer form-group">
												<select id="tab-select" class="form-control">
												<option class="form-select" value=".tab01">Beat optimization</option>
												<option class="form-select" value="#tab02">Masters</option>
												<option class="form-select" value="#tab03">OSM Performance</option>
												<option class="form-select" value="#tab03">RS Masters</option>
												</select>
											</div>
											<div class="tab-contents tab01" style="border: 1px solid #ddd;">
												<div class="row mt-3">
													<form action="javascript:void(0)" method="POSt" id="beatuploadForm" class="">
														<div class="form-group">
															<p>&nbsp;Sample Excel <a href="<?php echo asset_url();?>sample_excel/Sample_Excel.xlsx">DOWNLOAD</a> &nbsp;&nbsp;&nbsp;<b style="color:red;">*Note - Supported File Format(.xlsx, .csv, .xls).</b></p>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-8">
																	<label>Beat Upload Type<span style="color:red;">*</span></label>
																</div>
															</div>
															<select class="form-control" name="beat_upload_type" id="beat_upload_type" style="margin-top: -6px;" required>
																<option value=""><b>Select</b></option>
																<option value="add"><b>Add </b></option>
																<option value="over_write"><b>Over Write</b></option>
															</select>
														</div>
														<div class="form-group">
															<label>Beat Upload <span style="color:red;">*</span></label>
															<input type="file" class="form-control" name="b_file"  id="b_file"  accept=".xlsx,.xls,.csv" required/>
														</div>
														<div class="form-group float-right ">
															<button type="submit" class="form-group btn btn-primary" id="saveBtn">Import</button>&nbsp;&nbsp;
															<button type="reset" class="form-group btn btn-danger">Reset</button>
														</div>
													
													</form>

													
												</div>
												
												
											</div>
											<div id="tab02" class="tab-contents" style="border: 1px solid #ddd;">
												<div class="row">
													<ul class="nav nav-tabs" role="tablist">
														<li class="nav-item">
															<a class="nav-link active" data-toggle="tab" href="#tabs-1,#tab-3" role="tab">Masters</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Users</a>
														</li>
													</ul><!-- Tab panes -->
												</div>
											    <div class="row mt-3">
													<form action="javascript:void(0)" method="POSt" id="masterForm" class="">
														<div class="form-group">
															<p>&nbsp;Sample Excel <a href="<?php echo asset_url();?>sample_excel/Sample_Master.csv">DOWNLOAD</a> &nbsp;&nbsp;&nbsp;<b style="color:red;">*Note - Supported File Format(.xlsx, .csv, .xls).</b></p>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-8">
																	<label>Master Upload Type<span style="color:red;">*</span></label>
																</div>
															</div>
															<select class="form-control" name="m_upload_type" id="m_upload_type" style="margin-top: -6px;" required>
																<option value=""><b>Select</b></option>
																<option value="add"><b>Add </b></option>
																<option value="over_write"><b>Over Write</b></option>
															</select>
														</div>
														<div class="form-group">
															<label>Master Upload <span style="color:red;">*</span></label>
															<input type="file" class="form-control" name="m_file"  id="m_file"  accept=".xlsx,.xls,.csv" required/>
														</div>
														<div class="form-group float-right ">
															<button type="submit" class="form-group btn btn-primary" id="saveBtn">Import</button>&nbsp;&nbsp;
															<button type="reset" class="form-group btn btn-danger">Reset</button>
														</div>
													
													</form>
												</div>
											</div>
											<div id="tab03" class="tab-contents" style="border: 1px solid #ddd;">
											    <div class="row mt-3">
													<form action="javascript:void(0)" method="POSt" id="osmuploadForm" class="">
														<div class="form-group">
															<p>&nbsp;Sample Excel <a href="<?php echo asset_url();?>sample_excel/Sample_Osm_Excel.csv">DOWNLOAD</a> &nbsp;&nbsp;&nbsp;<b style="color:red;">*Note - Supported File Format(.xlsx, .csv, .xls).</b></p>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-8">
																	<label>OSM Upload Type<span style="color:red;">*</span></label>
																</div>
															</div>
															<select class="form-control" name="osm_upload_type" id="osm_upload_type" style="margin-top: -6px;" required>
																<option value=""><b>Select</b></option>
																<option value="add"><b>Add </b></option>
																<option value="over_write"><b>Over Write</b></option>
															</select>
														</div>
														<div class="form-group">
															<label>OSM Upload <span style="color:red;">*</span></label>
															<input type="file" class="form-control" name="osm_file"  id="osm_file"  accept=".xlsx,.xls,.csv" required/>
														</div>
														<div class="form-group float-right ">
															<button type="submit" class="form-group btn btn-primary" id="saveBtn">Import</button>&nbsp;&nbsp;
															<button type="reset" class="form-group btn btn-danger">Reset</button>
														</div>
													
													</form>
												</div>
											</div>
											<div id="tab04" class="tab-contents" style="border: 1px solid #ddd;">
											    <div class="row mt-3">
													<form action="javascript:void(0)" method="POSt" id="rsuploadForm" class="">
														<div class="form-group">
															<p>&nbsp;Sample Excel <a href="<?php echo asset_url();?>sample_excel/Sample_Rsdetails_Excel.csv">DOWNLOAD</a> &nbsp;&nbsp;&nbsp;<b style="color:red;">*Note - Supported File Format(.xlsx, .csv, .xls).</b></p>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-md-8">
																	<label>RS Upload Type<span style="color:red;">*</span></label>
																</div>
															</div>
															<select class="form-control" name="rs_upload_type" id="rs_upload_type" style="margin-top: -6px;" required>
																<option value=""><b>Select</b></option>
																<option value="add"><b>Add </b></option>
																<option value="over_write"><b>Over Write</b></option>
															</select>
														</div>
														<div class="form-group">
															<label>RS Upload <span style="color:red;">*</span></label>
															<input type="file" class="form-control" name="rs_file"  id="rs_file"  accept=".xlsx,.xls,.csv" required/>
														</div>
														<div class="form-group float-right ">
															<button type="submit" class="form-group btn btn-primary" id="saveBtn">Import</button>&nbsp;&nbsp;
															<button type="reset" class="form-group btn btn-danger">Reset</button>
														</div>
													
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4 table-responive">
										<div style="color:red;" id="errors_show">
										</div>
									</div>

								</div>
								
								<div style="display:block" class=" mt-3 show_beat  float-right">
									<form action="javascript:void(0)" id="beatdelete" class="">
										<input type="text" hidden name="beat_delete" id="beat_delete">
										<button type="button" style="padding: 5px; padding-left: 8px; padding-right: 8px;" class="btn-danger btn-md d-none " id="delete_beat" data-toggle="modal"data-target = '#confirm_del_beat'> <i class="bx bx-trash "></i> Delete</button>
									</form>
								</div>
								<div style="display:block" class=" mt-3 show_osm float-right">
									<form action="javascript:void(0)" id="osmdelete" class="">
										<input type="text" hidden name="osm_delete" id="osm_delete">
										<button type="button" style="padding: 5px; padding-left: 8px; padding-right: 8px;" class="btn-danger btn-md d-none " id="delete_osm" data-toggle="modal"data-target = '#confirm_del_osm'> <i class="bx bx-trash "></i> Delete</button>
									</form>
								</div>
								<div style="display:block" class=" mt-3  show_rs float-right">
									<form action="javascript:void(0)" id="rsdelete" class="">
										<input type="text" hidden name="rs_delete" id="rs_delete">
										<button type="button" style="padding: 5px; padding-left: 8px; padding-right: 8px;" class="btn-danger btn-md d-none " data-toggle="modal"data-target = '#confirm_del_rs' id="delete_rs"> <i class="bx bx-trash "></i> Delete</button>
									</form>
								</div>
								<!-- <div style="display:block" class=" mt-3  show_master">
									<div class="tab-content">
										<div class="tab-pane active" id="tabs-1" role="tabpanel">
											<form action="javascript:void(0)" id="mastersdelete" >
												<div >
													<label for="business" class=""><h6>Select to Delete</h6></label></br>
													
													<select style="display: initial" class="form-control col-md-2" name="business" id="business">
														<option id="sel"value="">Select</option>
														<option value="All">All</option>
														<option value="AB Urban">AB Urban</option>
														<option value="PC Urban">PC Urban</option>
														<option value="FMCG Rural">FMCG Rural</option>
													</select>

													<button type="button" style="padding: 5px; padding-left: 8px; padding-right: 8px; " data-toggle="modal"data-target = '#confirm_del_masters'class="btn-danger btn-md d-none ml-3" id="delete_masters"> <i class="bx bx-trash "></i> Delete</button>

												</div>
											</form>
										</div>
										
									</div>

									
									
								</div> -->
								<br><br>
								<div class="row ml-2">
									
									<div class="table-responsive" id="show_beat">
									<h6 style="display: flex; margin-bottom:5px" class="mb-3 mr-2"> Select All :  <input  style=" margin-left:5px"type="checkbox" name="select_all1" id="ckbCheckAll" /></h6>
                                        <table class="table table-hover" id="beat_tb" >
											<thead>
												<tr>
													<th style="width:10%" > 
													<span style="display: flex"><input type="checkbox" name="select_all" id="CheckAll" /> </span></th>

													<th>Sno</th>
													<th>Business</th>
													<th>Beat Name</th>
													<th>Beat Code</th>
													<th>Sm Number</th>
													<th>Created Date</th>
												</tr>
											</thead>
											<tbody id="example_new">

											</tbody>
                                       </table>
									</div>
									<div class="table-responsive" id="show_master">
										<div class="tab-content">
											<div class="tab-pane tabs-1 active" id="tabs-1" role="tabpanel">
												<div class="col-md-12">

													<label><b>Change assign person</b></label></br>
													<div class="mb-1 row">
														
														<div class="col-md-2">
															<label><h6>Role *</h6></label></br>
															<select class="form-control single-select" name="role" id="role">
																<option value="">Select</option>
																<option value="ZSM">ZSM</option>
																<option value="ASM">ASM</option>
																<option value="TSO">TSO</option>
																<!-- <option value="SM">SM</option> -->
															</select>
														</div>
														
														<div class="col-md-3">
															<label><h6>From person *</h6></label></br>
															<select class="form-control single-select" name="from_person" id="from_person">
																<option value="">Select...</option>
															</select>
														</div>
														<div class="col-md-2 d-none" id="zsm_filter">
															<label><h6>Business *</h6></label></br>
															<select style="display: initial" class="form-control single-select" name="division" id="division" multiple>
																<option value="" disabled>Select</option>
																<option value="FMCG URBAN">FMCG URBAN</option>
																<option value="FMCG RURAL">FMCG RURAL</option>
																<option value="AB EXCLUSIVE">AB EXCLUSIVE</option>
																<option value="SNACKS">SNACKS</option>
																<option value="FMCG MT">FMCG MT</option>
															</select>
														</div>
														<div class="col-md-4">
															<label><h6>To person *</h6></label></br>
															<div class="input-group">
																<select class="form-control single-select" name="to_person" id="to_person" >
																	<option value="">Select...</option>
																</select>

																<button type="button"  title="Click before fill role & from person!" class="btn btn-md btn-secondary" id="add_user"><i class="bx bx-plus"></i></button>
															</div>
														</div>
														<div class="col-md-1" style="padding-top: 35px;">
															<button type="button" class="btn btn-success btn-md" id="replacement_action" style="font-size: 13px;"> <i class="bx bx-check "></i> Replacement</button>
														</div>
													</div>
												</div>
												<form action="javascript:void(0)" id="mastersdelete" >
													<div class="mt-4 mb-5  col-md-2">
														<label for="business" class=""><h6>Select to Delete</h6></label></br>
														<select style="display: initial" class="form-control single-select" name="business" id="business">
															<option id="sel"value="">Select</option>
															<option value="All">All</option>
															<!-- <option value="AB Urban">AB Urban</option>
															<option value="PC Urban">PC Urban</option> -->
															<option value="FMCG URBAN">FMCG URBAN</option>
															<option value="FMCG RURAL">FMCG RURAL</option>
															<option value="AB EXCLUSIVE">AB EXCLUSIVE</option>
															<option value="SNACKS">SNACKS</option>
															<option value="FMCG MT">FMCG MT</option>
														</select>
														<button type="button" style="padding:3px; padding-left: 8px; padding-right: 8px; " data-toggle="modal" data-target ='#confirm_del_masters'class="btn-danger btn btn-md d-none ml-3" id="delete_masters"> <i class="bx bx-trash "></i> Delete</button>
													</div>
												</form>
												<table class="table table-hover" id="master_tb" >
													<thead>
														<tr>
															<th>Sno</th>
															<th>Division</th>
															<th>Region</th>
															<th>ZSM</th>
															<th>ZSM Number</th>
															<th>ZSM Email</th>
															<th>ASM</th>
															<th>ASM Number</th>
															<th>ASM Email</th>
															<th>TSO</th>
															<th>TSO Number</th>
															<th>TSO Email</th>
															<th>SM</th>
															<th>SM Number</th>
															<th>Created Date</th>
															<th>Action</th>

														</tr>
													</thead>
													<tbody id="example_new">

													</tbody>
											    </table>
											</div>
											<div class="tab-pane tabs-2" id="tabs-2" role="tabpanel">
											<table class="table table-hover" id="user_tb" >
													<thead>
														<tr>
															<th>Sno</th>
															<th>Username</th>
															<th>Mobile Number</th>
															<th>Email</th>
															<th>Role Type</th>
															<th>Created Date</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody id="example_new">

													</tbody>
											    </table>
											</div>
										</div>
									</div>
									<div class="table-responsive" id="show_osm">
									<h6 style="display: flex; margin-bottom:5px"> Select All  :<input style=" margin-left:5px" type="checkbox"  name="select_all_osm" id="CheckAllOsm" /> </h6>
                                        <table class="table table-hover" id="osm_tb" >
											<thead>
												<tr>
												<th style="width:10%">
												<span style="display: flex; ">  <input  type="checkbox" name="select_osm" id="CheckOsm" /> </span></th>
													<th>Sno</th>
													<th>OSm Name</th>
													<th>SSFA_Id</th>
													<th>SM Type</th>
													<th>ZSM</th>
													<th>ASM</th>
													<th>SDE</th>
													<th>SDE Id</th>
													<th>JC Type</th>
													<th>BC Target</th>
													<th>TSLD Target</th>
													<th>ECO Target</th>
													<th>BC Achivement</th>
													<th>TSLD Achivement</th>
													<th>ECO Achivement</th>
													<th>BC percentage</th>
													<th>TSLD percentage</th>
													<th>ECO percentage</th>
													<th>Created Date</th>
												</tr>
											</thead>
											<tbody id="example_new">

											</tbody>
                                       </table>
									</div>
									<div class="table-responsive" id="show_rs">
										<form action="javascript:void(0)" id="rsmastersdelete" >
											<div class="mb-5  col-md-2">
												<label for="business" class=""><h6>Select to Delete</h6></label></br>
												
												<select style="display: initial" class="form-control col-md-2 single-select" name="rsbusiness" id="rsbusiness">
													<option id="sel_rs"value="">Select</option>
													<option value="All">All</option>
													<!-- <option value="AB Urban">AB Urban</option>
													<option value="PC Urban">PC Urban</option>
													<option value="FMCG Rural">FMCG Rural</option> -->
													<option value="FMCG URBAN">FMCG URBAN</option>
													<option value="FMCG RURAL">FMCG RURAL</option>
													<option value="AB EXCLUSIVE">AB EXCLUSIVE</option>
													<option value="SNACKS">SNACKS</option>
													<option value="FMCG MT">FMCG MT</option>
												</select>

												<button type="button" style="padding: 5px; padding-left: 8px; padding-right: 8px; " data-toggle="modal"data-target = '#confirm_del_rsmasters'class="btn-danger btn-md d-none ml-3" id="delete_rsmasters"> <i class="bx bx-trash "></i> Delete</button>

											</div>
										</form>
										<h6 style="display: flex; margin-bottom:5px"> Select All  :<input type="checkbox" style=" margin-left:5px" name="select_all_osm" id="CheckAllRs" /> </h6>
										<table class="table table-hover" id="rs_tb" >
											<thead>
												<tr>
												<th style="width:10%">
												<span style="display: flex; "> Select : <input type="checkbox" name="select_rs" id="CheckRs" /></span> </th>
													<th>Sno</th>
													<th>Business</th>
													<th>RS Name</th>
													<th>RS Code</th>
													<th>State</th>
													<th>District </th>
													<th>City </th>
													<th>Town </th>
													<th>Town </th>
													<th>SM Number</th>
													<th>TSO Name</th>
													<th>TSO Number</th>
													<th>Created Date</th>
												</tr>
											</thead>
											<tbody id="example_new">

											</tbody>
										</table>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
					
					<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update user</h5>
                                    <button type="button" class="close" id="updateclose" data-dismiss="modal"
                                        aria-label="Close"> <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="update_form">
                                    <div class="modal-body">
                                        <div class="form-group col-sm-12">
											<label for="username">User Name</label>
											<input class=" form-control" type="text" id="username" name="username">
											<span id="un_err" class="text-danger d-none">Enter the valid User name</span>

                                        </div>
										<div class="form-group col-sm-12">
											<label for="mobile">Mobile Number</label>
											<input class="col-sm-12 form-control " type="text" id="mobile" name="mobile">
											<span id="mob_err" class="text-danger d-none">Enter the valid Mobile Number</span>
											<input type="hidden" id="or_mobile" name="or_mobile">
                                        </div>
										<!-- <div class="form-group col-sm-12">
											<label for="mobile">Role Type</label>
											<input class="col-sm-12 form-control " readonly type="text" id="role" name="role">
                                        </div> -->
                                    </div>
                                    <div class="modal-footer">
										<input type="hidden" name="id" id="id">
                                        <button type="submit" class="btn btn-primary" id="update_user">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="modal fade" id="confirm_del" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete data</h5>
                                    <button type="button" class="close" id="close" data-dismiss="modal"
                                        aria-label="Close"> <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="del_masters_data">
                                    <div class="modal-body">
                                        <h5>Do you want to delete this record?</h5>
										<input type="hidden" name="del_id" id="del_id">
                                    </div>
                                    <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
                                        <button type="submit" onclick=deleteMaster() class="btn btn-primary" id="delete_md">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="modal fade" id="confirm_del_masters" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Masters data</h5>
                                    <button type="button" class="close" id="close" data-dismiss="modal"
                                        aria-label="Close"> <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="del_masters">
                                    <div class="modal-body">
                                        <h5>Do you want to delete the selected records?</h5>
                                    </div>
                                    <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_delete">Cancel</button>
                                        <button type="submit" class="btn btn-primary" id="delete_data">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="modal fade" id="confirm_del_rsmasters" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete RS Masters</h5>
                                    <button type="button" class="close" id="close" data-dismiss="modal"
                                        aria-label="Close"> <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="del_rsmasters">
                                    <div class="modal-body">
                                        <h5>Do you want to delete the selected records?</h5>
                                    </div>
                                    <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_rsmasters">Cancel</button>
                                        <button type="submit" class="btn btn-primary" id="delete_rs_masters">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="modal fade" id="confirm_del_user" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Users</h5>
                                    <button type="button" class="close" id="close" data-dismiss="modal"
                                        aria-label="Close"> <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="del_users">
                                    <div class="modal-body">
                                        <h5>Do you want to delete this record?</h5>
										<input type="hidden" name="del_id" id="user_id">
										<input type="hidden" name="user_mobile" id="user_mobile">


                                    </div>
                                    <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_user">Cancel</button>
                                        <button type="submit" class="btn btn-primary" id="delete_user">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="modal fade" id="confirm_del_rs" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete RS Masters </h5>
                                    <button type="button" class="close" id="close" data-dismiss="modal"
                                        aria-label="Close"> <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="del_rs">
                                    <div class="modal-body">
                                        <h5>Do you want to delete the selected records?</h5>
                                    </div>
                                    <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" id="delete_rs_data">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="modal fade" id="confirm_del_osm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete OSM Performance</h5>
                                    <button type="button" class="close" id="close" data-dismiss="modal"
                                        aria-label="Close"> <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="del_osm">
                                    <div class="modal-body">
                                        <h5>Do you want to delete the selected records?</h5>
                                    </div>
                                    <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" id="Delete_md">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="modal fade" id="confirm_del_beat" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Beat optimization</h5>
                                    <button type="button" class="close" id="close" data-dismiss="modal"
                                        aria-label="Close"> <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="javascript:void(0)" method="POST" id="del_beat">
                                    <div class="modal-body">
                                        <h5>Do you want to delete the selected records?</h5>
                                    </div>
                                    <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" id="Delete_md">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end page-content-wrapper-->
        </div>

        <!-- Modal ..............    // -->
		<div class="modal fade" id="adduserpop" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<form action="javascript:void(0)" method="POST" id="userAddForm">
						<div class="modal-header">
							<h5 class="modal-title">Add New User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-6" style="pointer-events: none;">
									<label>Business <span style="color:red;">*</span></label>
									<input type="text" class="form-control" name="newbusiness" id="newbusiness" style="background-color: #cccccc5e;" required >
								</div>

								<div class="form-group col-md-6" style="pointer-events: none;">
									<label>Role <span style="color:red;">*</span></label>
									<input type="text" class="form-control" name="newrole" id="newrole" style="background-color: #cccccc5e;" required >
								</div>

								<div class="form-group col-md-8">
									<label>Username <span style="color:red;">*</span></label>
									<input class="form-control" type="text" name="newusername" id="newusername" placeholder="Enter username" required />
								</div>
								
								<div class="form-group col-md-8">
									<label>Mobile No. <span style="color:red;">*</span></label>
									<input type="text" class="form-control" name="newmobile" id="newmobile" placeholder="Enter mobile number" required >
								</div>
								<div class="form-group col-md-8">
									<label>Email Id <span style="color:red;">*</span></label>
									<input type="email" class="form-control" name="newemail" id="newemail" placeholder="Enter email id" required >
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<span id="all-required"></span>
							<div id="updat_smt_btn">
								<button type="submit" class="btn btn-primary px-5" id="useradded">Add User </button>
							</div>
						</div>
					</form>

				</div>
			</div>
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
    <script src="<?php echo asset_url();?>js/jquery.min.js"></script>
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
    <script src="<?php echo asset_url();?>pro_js/masters_upload.js"></script>
    <script src="<?php echo asset_url();?>plugins/select2/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        $(".metismenu li").removeClass('mm-active');
        var page = "competition_watch";
		$('.show_master').hide();

        if (page == "competition_watch") {
            $(".mform_m").addClass("mm-active");
        }
		$('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            // placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
			placeholder: "Select...",
    		// allowClear: true
        });
		//tabs
		var $tabButtonItem = $('#tab-button li'),
		$tabSelect = $('#tab-select'),
		$tabContents = $('.tab-contents'),
		activeClass = 'is-active';

		$tabButtonItem.first().addClass(activeClass);
		$tabContents.not(':first').hide();

		$tabButtonItem.find('a').on('click', function(e) {
			var target = $(this).attr('href');
			show_table(target);
			$tabButtonItem.removeClass(activeClass);
			$(this).parent().addClass(activeClass);
			$tabSelect.val(target);
			$tabContents.hide();
			$(target).show();
			e.preventDefault();
		});

		$tabSelect.on('change', function() {
			var target = $(this).val(),
				targetSelectNum = $(this).prop('selectedIndex');

			$tabButtonItem.removeClass(activeClass);
			$tabButtonItem.eq(targetSelectNum).addClass(activeClass);
			$tabContents.hide();
			$(target).show();
		});

        //Default data table
        // $('#example').DataTable();
        // var table = $('#example2').DataTable({
        // 	lengthChange: false,
        // 	buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        // });
        // table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
	function show_table(target){
		var tar=target;
		if(tar==".tab01"){
			$('#show_beat').show();
            $('#show_master').hide();
            $('#show_osm').hide();
			$('#show_rs').hide();
			$('.show_beat').show();
			$('.show_master').hide();
			$('.show_osm').hide();
			$('.show_rs').hide();
		}
		else if(tar=="#tab02"){
            $('#show_master').show();
            $('#show_beat').hide();
            $('#show_osm').hide();
			$('#show_rs').hide();
			$('.show_master').show();
			$('.show_beat').hide();
			$('.show_osm').hide();
			$('.show_rs').hide();
			var division ="";
			get_masters(division);
			get_users();
		}
		else if(tar=="#tab03"){
            $('#show_osm').show();
            $('#show_beat').hide(); 
			$('#show_rs').hide();
			$('#show_master').hide(); 
			$('.show_osm').show();
			$('.show_master').hide();
			$('.show_beat').hide();
			$('.show_rs').hide();
			get_osm();
        }
		else{
			$('#show_beat').hide(); 
			$('#show_osm').hide();
			$('#show_master').hide();
			$('#show_rs').show();
			$('.show_rs').show();
			$('.show_osm').hide();
			$('.show_master').hide();
			$('.show_beat').hide();
			get_rs();
		}
	}
    </script>
    <!-- App JS -->
    <script src="<?php echo asset_url();?>js/app.js"></script>

    <script>
    var BASE_URL = "<?php echo base_url();?>index.php/";
    </script>
</body>

</html>
