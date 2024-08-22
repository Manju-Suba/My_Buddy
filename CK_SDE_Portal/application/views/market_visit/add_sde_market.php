<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>SDE Market Visit</title>
	
    <?php include('application/views/layouts/common_css_links.php'); ?>
    <link href="<?php echo asset_url();?>plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="<?php echo asset_url();?>plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet"/> -->

     
    <style>
        input#rssm_file ,input#m_file ,input#rssm_eve_file{
            height: calc(1.2em + 1.1rem + 2px);
            line-height: 1.2;
            padding: 0.35rem 0.75rem;
        }

        .box {
            height: 15px;
            width: 20px;
            margin-bottom: 13px;
            border: 1px solid black;
        }

        /* #rssm_style .select2.select2-container.select2-container--bootstrap4{
            margin-top: -6px;
        } */

        .ck-editor__editable_inline {
            min-height: 150px;
        }

        /* .form_disable .form-group{
            pointer-events: none;
        } */

        /* .select2-results__option.green{
            background-color: #0080002b;
        }

        #select2-rssm_mkt-results{
            color: rgb(237 74 11 / 95%);
        }

        #select2-rssm_mkt-results .select2-results__option.select2-results__option--highlighted{
            color: white;
        }

        #select2-rssm_mkt-results .select2-container--bootstrap4 .select2-results__option--highlighted, .select2-container--bootstrap4 .select2-results__option--highlighted.select2-results__option[aria-selected=true] {
            color: white;
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
					

                    <div class="row">
						<div class="col-12 col-lg-8">
							<div class="card border-lg-top-primary">
								<div class="card-body p-3">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user mr-1 font-24 text-primary"></i>
										</div>
										<h4 class="mb-0 text-primary">Start Market</h4>
									</div>

                                    <input type="hidden" name="session_role_type" id="session_role_type"
                                        value="<?php echo $this->session->userdata('role_type'); ?>">
                                    <input type="hidden" name="session_mobile_no" id="session_mobile_no"
                                        value="<?php echo $this->session->userdata('mobile'); ?>">

									<hr> 
									<div class="form-body">
                                        <form action="javascript:void(0)" method="POSt" id="mForm" class="">
                                        
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label>RS <span style="color:red;">*</span></label>
                                                    <select class="single-select" name="rs_mkt" id="rs_mkt" required>
                                                        <option value="">Select...</option>
                                                        <?php 
                                                        foreach($rs_mkt as $rs){ ?>
                                                            <option value="<?= $rs->rs_code; ?>"> 
                                                                <?= $rs->rs_name ?>
                                                            </option> 
                                                        <?php } ?>
                                                    </select>
                                                </div> 
                                                <div class="form-group col-md-4" id="rssm_style">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>RSSM<span style="color:red;">*</span></label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div id="color_code" class="box"></div>
                                                        </div>
                                                    </div>
                                                    <select class="single-select mt-6px" name="rssm_mkt" id="rssm_mkt" style="margin-top: 0px;" required>
                                                        <option value=""><b>Select...</b></option>
													</select>

                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Beat <span style="color:red;">*</span></label>
                                                    <select class="single-select" name="beat_mkt" id="beat_mkt" required>
                                                        <option value="">Select...</option>
                                                        <!-- <!?php 
                                                        foreach($beat_mkt as $beat){ ?>
                                                            <option value="<!?= $beat->beat_name; ?>"> 
                                                                <!?= $beat->beat_name ?>
                                                            </option>
                                                        <!?php } ?> -->
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group col-md-3">
                                                    <label>Total Calls Made </label>
                                                    <input type="text" class="form-control" name="total_calls" id="total_calls" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="0.00" />
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Value </label>
                                                    <input type="text" class="form-control" name="value" id="value" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="0.00" />
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Billscut</label>
                                                    <input type="text" class="form-control" name="billut" id="billut" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="0.00" />
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>TLSD </label>
                                                    <input type="text" class="form-control" name="tlsd" id="tlsd" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="0.00" />
                                                </div>
                                                <!-- <div class="form-group col-md-6"></div> -->
                                                <div class="form-group col-md-6">
                                                    <label>RSSM Image ( morning ) <span style="color:red;">*</span></label>
                                                    <input type="file" class="form-control" name="rssm_file" id="rssm_file" accept="image/*" capture=camera required/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>RSSM Image ( evening ) </label>
                                                    <input type="file" class="form-control" name="rssm_eve_file" id="rssm_eve_file" accept="image/*" capture=camera />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Feedback/Comment </label>
                                                <textarea type="text" class="form-control" rows="2" cols="3" name="m_fdb" id="m_fdb" placeholder="Write your feedback here....." ></textarea>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6" style="display: none;">
                                                    <label>Upload <span style="color:red;"></span></label>
                                                    <input type="file" class="form-control" name="m_file[]" multiple id="m_file"  accept=".png, .jpg, .jpeg, .PNG, .JPG, .JPEG"/>
                                                </div>
                                            </div>
                                            <button type="submit" class="form-group btn btn-primary px-5" id="saveBtn">Start Market</button>
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
    <script src="<?php echo asset_url();?>pro_js/market_visit/add_sde_form.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

	<script>
        $(document).ready(function () {
            $(".metismenu li").removeClass('mm-active');
            var page = "sde_market";

            if (page == "sde_market") {
                $(".eform_m").addClass("mm-active");
            }

            // if( div.classList.contains('orange') ){
            //     $('.select2-results__option').addclass('green');
            //     $('.select2-results__option').removeclass('orange');
            // }else{
            //     $('.select2-results__option').addclass('orange');
            //     $('.select2-results__option').removeclass('green');
            // }

		});



        $('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});

        $("#rssm_mkt").on('change', function() {
            var selection = $(this).find('option:selected');

            var data1 = selection.data('data1');

            document.getElementById('color_code').setAttribute( "class", 'box ' +data1 );

            document.getElementById('color_code').style.backgroundColor = data1;

			var rssm_val = $(this).val();

			get_beat_list(rssm_val);

        });

            
        // ClassicEditor
        // .create( document.querySelector( '#m_comment' ) )
        // .catch( error => {
        //     console.error( error );
        // } );


    </script>
</body>

</html>
