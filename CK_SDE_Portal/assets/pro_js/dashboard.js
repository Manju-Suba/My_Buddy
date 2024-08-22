
$(document).ready(function () {
    get_project_list();
});

function get_project_list(){
 
    $.ajax({  
        url:BASE_URL + 'Tsocontroller/get_project_list', 
        method:"POST",  
        data:{}, 
        dataType:"json",

        success:function(data) {
            if(data.pro_details.length !=0){
                if(data.logstatus =='success'){

                    var pd_html = '';
						var i=0;
						var j;
						let count = 0;
						// alert(data.pro_details.length);


						// mobile view
						if (window.matchMedia('(max-width: 599px)').matches) {

							pd_html +='<div class="col-12">';

							for(let i=1; i<=data.pro_details.length; i++)
							{
								pd_html +='<div class="row">';
								// pd_html +='<div style="text-align: center;">';
								var img_url = ASSET_URL+'images/logo-icon.png';
								console.log(count);
								if(count < data.pro_details.length){
									pd_html +='<div class="" style="width:240px;">';
										pd_html +='<div class="card radius-15 '+data.pro_details[count].bootstrap_class+'">';
											pd_html +='<div class="card-body" style="padding: 0.5rem;">';
												pd_html +='<div class="media align-items-center">';
													pd_html +='<img src="'+img_url+'" width="60" height="60" class="rounded-circle p-1 border bg-white" alt="" />';
													pd_html +='<div class="media-body ml-3">';
														pd_html +='<a href="#" onclick="get_project_type('+"'"+data.pro_details[count].project_url+"'"+
														','+"'"+data.pro_details[count].project_id+"'"+');"><h6 class="mb-0 text-white">'+data.pro_details[count].project_name+'</h6></a>';
														// alert(pd_html);
													pd_html +='<span class="text-light display_none load_show_'+data.pro_details[count].project_id+
													'" style="margin-top:4px;"><i class="lni lni-spinner"></i> Please Wait..!</span></div>';
												pd_html +='</div>';
											pd_html +='</div>';
										pd_html +='</div>';
									pd_html +='</div>';
								}
								// string += count;
								// pd_html +='</div>';
								pd_html +='</div>';
								count++;
							}
							pd_html +='</div>';
						}

						// tab view
						if (window.matchMedia('(min-width: 600px)').matches && window.matchMedia('(max-width: 1000px)').matches) {

							pd_html +='<div class="col-12">';
							pd_html +='<div class="row">';

							for(let i=1; i<=data.pro_details.length; i++)
							{
								var img_url = ASSET_URL+'images/logo-icon.png';
								
								if(count < data.pro_details.length){
									pd_html +='<div class="col-6" style="width:240px;">';
										// pd_html +='<div class="text-center" style="width:240px;">';
											pd_html +='<div class="card radius-15 '+data.pro_details[count].bootstrap_class+'">';
												pd_html +='<div class="card-body" style="padding: 0.5rem;">';
													pd_html +='<div class="media align-items-center">';
														pd_html +='<img src="'+img_url+'" width="60" height="60" class="rounded-circle p-1 border bg-white" alt="" />';
														pd_html +='<div class="media-body ml-3 text-start">';
															pd_html +='<a href="#" onclick="get_project_type('+"'"+data.pro_details[count].project_url+"'"+','+"'"+data.pro_details[count].project_id+"'"+');"><h6 class="mb-0 text-white">'+data.pro_details[count].project_name+'</h6></a>';
															// alert(pd_html);
														pd_html +='<span class="text-light display_none load_show_'+data.pro_details[count].project_id+'" style="margin-top:4px;"><i class="lni lni-spinner"></i> Please Wait..!</span></div>';
													pd_html +='</div>';
												pd_html +='</div>';
											pd_html +='</div>';
										// pd_html +='</div>';
									pd_html +='</div>';
								}
								// string += count;
								count++;
							}
								pd_html +='</div>';
							pd_html +='</div>';

						} 

						// lap & desktop view
						if (window.matchMedia('(min-width: 1051px)').matches) {
							for(let i=1; i<=data.pro_details.length; i++)
							{
								pd_html +='<div class="col-lg-12">';
									pd_html +='<div class="row">';
										var n = i;

										if(i <= '4'){
											for (let j = 1; j <= data.pro_details.length-(n+n+1); j++) {
												pd_html +='<div style="width:60px"></div>';
											}
										}else{
											pd_html +='<div style="width:40px"></div>';
										}
										

										for( index=1 ;index<=i ;index++)
										{
											var img_url = ASSET_URL+'images/logo-icon.png';
											
											if(count < data.pro_details.length){
												pd_html +='<div class="" style="width:240px;">';
													pd_html +='<div class="card radius-15 '+data.pro_details[count].bootstrap_class+'">';
														pd_html +='<div class="card-body" style="padding: 0.5rem;">';
															pd_html +='<div class="media align-items-center">';
																pd_html +='<img src="'+img_url+'" width="60" height="60" class="rounded-circle p-1 border bg-white" alt="" />';
																pd_html +='<div class="media-body ml-3">';
																	pd_html +='<a href="#" onclick="get_project_type('+"'"+data.pro_details[count].project_url+"'"+','+"'"+data.pro_details[count].project_id+"'"+');"><h6 class="mb-0 text-white">'+data.pro_details[count].project_name+'</h6></a>';
																	// alert(pd_html);
																pd_html +='<span class="text-light display_none load_show_'+data.pro_details[count].project_id+'" style="margin-top:4px;"><i class="lni lni-spinner"></i> Please Wait..!</span></div>';
															pd_html +='</div>';
														pd_html +='</div>';
													pd_html +='</div>';
												pd_html +='</div>&nbsp;&nbsp;';
											}else{
												break;
											}
											// string += count;
											count++;
										}
									pd_html +='</div>';
								pd_html +='</div>';
								// pd_html+="<hr>";
							}
						}

						if (window.matchMedia('(min-width: 1001px)').matches) {
							for(let i=1; i<=data.pro_details.length; i++)
							{
								pd_html +='<div class="col-lg-12">';
									pd_html +='<div class="row">';
										var n = i;

										if(i <= '4'){
											for (let j = 1; j <= data.pro_details.length-(n+n+1); j++) {
												pd_html +='<div style="width:50px"></div>';
											}
										}else{
											pd_html +='<div style="width:35px"></div>';
										}
										

										for( index=1 ;index<=i ;index++)
										{
											var img_url = ASSET_URL+'images/logo-icon.png';
											
											if(count < data.pro_details.length){
												pd_html +='<div class="" style="width:200px;">';
													pd_html +='<div class="card radius-15 '+data.pro_details[count].bootstrap_class+'">';
														pd_html +='<div class="card-body" style="padding: 0.5rem;">';
															pd_html +='<div class="media align-items-center">';
																pd_html +='<img src="'+img_url+'" width="60" height="60" class="rounded-circle p-1 border bg-white" alt="" />';
																pd_html +='<div class="media-body ml-3">';
																	pd_html +='<a href="#" onclick="get_project_type('+"'"+data.pro_details[count].project_url+"'"+','+"'"+data.pro_details[count].project_id+"'"+');"><h6 class="mb-0 text-white">'+data.pro_details[count].project_name+'</h6></a>';
																pd_html +='<span class="text-light display_none load_show_'+data.pro_details[count].project_id+'" style="margin-top:4px;"><i class="lni lni-spinner"></i> Please Wait..!</span></div>';
															pd_html +='</div>';
														pd_html +='</div>';
													pd_html +='</div>';
												pd_html +='</div>&nbsp;&nbsp;';
											}else{
												break;
											}
											count++;
										}
									pd_html +='</div>';
								pd_html +='</div>';
							}
						}

						

                    // for (let index = 0; index < data.pro_details.length; index++) {
                    //     // alert(data.pro_details[index].project_url);
                    //     var img_url = ASSET_URL+'images/logo-icon.png';

					// 	if(index == '0'){

					// 		pd_html +='<div class="col-lg-12 row">';
					// 			pd_html +='<div class="col-lg-4"></div>';
					// 			pd_html +='<div class="col-lg-3">';
					// 				pd_html +='<div class="card radius-15 '+data.pro_details[index].bootstrap_class+'">';
					// 					pd_html +='<div class="card-body" style="padding: 0.5rem;">';
					// 						pd_html +='<div class="media align-items-center">';
					// 							pd_html +='<img src="'+img_url+'" width="60" height="60" class="rounded-circle p-1 border bg-white" alt="" />';
					// 							pd_html +='<div class="media-body ml-3">';
					// 								pd_html +='<a href="#" onclick="get_project_type('+"'"+data.pro_details[index].project_url+"'"+','+"'"+data.pro_details[index].project_id+"'"+');"><h6 class="mb-0 text-white">'+data.pro_details[index].project_name+'</h6></a>';
					// 								// alert(pd_html);
					// 							pd_html +='<span class="text-light display_none load_show_'+data.pro_details[index].project_id+'" style="margin-top:4px;"><i class="lni lni-spinner"></i> Please Wait..!</span></div>';
					// 						pd_html +='</div>';
					// 					pd_html +='</div>';
					// 				pd_html +='</div>';
					// 			pd_html +='</div>';
					// 		pd_html +='</div>';
					// 	}else if(index !='0'){

					// 		pd_html +='<div class="col-lg-12 row">';
					// 			// pd_html +='<div class="col-lg-4"></div>';
					// 			pd_html +='<div class="col-lg-3">';
					// 				pd_html +='<div class="card radius-15 '+data.pro_details[index].bootstrap_class+'">';
					// 					pd_html +='<div class="card-body" style="padding: 0.5rem;">';
					// 						pd_html +='<div class="media align-items-center">';
					// 							pd_html +='<img src="'+img_url+'" width="60" height="60" class="rounded-circle p-1 border bg-white" alt="" />';
					// 							pd_html +='<div class="media-body ml-3">';
					// 								pd_html +='<a href="#" onclick="get_project_type('+"'"+data.pro_details[index].project_url+"'"+','+"'"+data.pro_details[index].project_id+"'"+');"><h6 class="mb-0 text-white">'+data.pro_details[index].project_name+'</h6></a>';
					// 								// alert(pd_html);
					// 							pd_html +='<span class="text-light display_none load_show_'+data.pro_details[index].project_id+'" style="margin-top:4px;"><i class="lni lni-spinner"></i> Please Wait..!</span></div>';
					// 						pd_html +='</div>';
					// 					pd_html +='</div>';
					// 				pd_html +='</div>';
					// 			pd_html +='</div>';
					// 		pd_html +='</div>';
					// 	}
                        

                    // }

                    $('#show_pd_list').html(pd_html);
                    $('#session_role_type').val(data.role_type);
                    $('#session_mobile_no').val(data.login_mob_no);
                    $('#session_password').val(data.login_pass);
                }
                else{

                }
            }
        }
    })
}


function get_project_type(pro_base_url,pro_id){

	$role = $('#session_role_type').val();
	$.ajax({  
		url:pro_base_url + 'LoginController/setsession', 
		method:"POST",  
		data:{"pro_id":pro_id,},
		dataType:"json",
		success:function(data) {
			
			if(pro_id =='PRO10'){
				window.location = pro_base_url + "settings";
			}else if(pro_id =='PRO11'){

				if($role == 'TSO' || $role == 'SM'){
					window.location = pro_base_url + "sde_market_report";
				}else{
					window.location = pro_base_url + "market_report";
				}
			}else if(pro_id =='PRO12'){
				window.location = pro_base_url + "sde_incentive";

			}else if(pro_id =='PRO13'){
				window.location = pro_base_url + "beat_report";

			}else if(pro_id =='PRO14'){
				window.location = pro_base_url + "five_sec_scorecard";
			
			}else if(pro_id =='PRO15'){
				window.location = pro_base_url + "osm_performance_report";
				
			}else if(pro_id =='PRO17'){
				window.location = pro_base_url + "scorecard_report";
				
			}else if(pro_id == 'PRO08'){
				if($role =='TSO'){
					window.location = pro_base_url + "list_rs_key_form";
				}else{
					window.location = pro_base_url + "monthly_score_card";
				}  

			}else if(pro_id == 'PRO06'){

                if($role =='TSO'){
                    window.location = pro_base_url + "add_rs_rec_form";

                }else if($role=='ASM'){
                    window.location = pro_base_url + "va_verified_forms_rs";

                }else if($role =='ZSM'){
                    window.location = pro_base_url + "va_verified_forms_zsm_rs";

                }else if($role =='LEADER' || $role=='Division Head'){
                    window.location = pro_base_url + "va_verified_forms_ldr_rs";

                }else if ($role == 'VA') {
                    window.location = pro_base_url + "rs_eform_va";

                }else{
                    window.location = pro_base_url + "add_rs_rec_form";
                }

			}else if (pro_id == 'PRO09'){

				if($role == 'TSO'){
					window.location = pro_base_url + "list_ss_key_form";
				}else{
					window.location = pro_base_url + "monthly_score_card_ss";
				}

			}else if (pro_id == 'PRO07'){

				if($role == 'TSO'){
					window.location = pro_base_url + "add_ss_rec_form";

				}else if($role =='VA'){
					window.location = pro_base_url + "ss_eform_va";
	
				}else if($role =='ASM'){
					window.location = pro_base_url + "ss_va_verified_forms";
				
				}else if($role =='ZSM' ){
					window.location = pro_base_url + "ss_va_verified_forms_zsm";
	
				}else if($role =='LEADER' || $role=='Division Head'){
					window.location = pro_base_url + "ss_va_verified_forms_ldr";

				}else{
					window.location = pro_base_url + "view_ss_rec_form";
				}

			}else if (pro_id == 'PRO02'){
				if($role=='SM'){
					window.location = pro_base_url + "competition_watch";
				}else{
					window.location = pro_base_url + "competition_watch_report";
				}

			}else if (pro_id == 'PRO05'){
				if($role=='SM'){
					window.location = pro_base_url + "competition_watch";
				}else{
					window.location = pro_base_url + "competition_watch_report";
				}
				if($role =='TSO'){
					window.location = pro_base_url + "add_rssm_rec_form";
				}
				else if($role =='ASM'){
					window.location = pro_base_url + "va_verified_forms";
				}
				else if($role =='ZSM' ){
					window.location = pro_base_url + "va_verified_forms_zsm";
				}
			   
				else if($role =='VA'){
					window.location = pro_base_url + "rssm_eform_va";
				}
				else if($role =='LEADER'){
					window.location = pro_base_url + "sde_submitted_forms_ldr";
				}
				else if($role =='Division Head'){
					window.location = pro_base_url + "revised_salary_approval";
				}
			}else if(pro_id =='PRO16'){
				window.location = pro_base_url + "outlet_performance";
				
			}else if(pro_id =='PRO18'){

				if($role =='TSO'){
					window.location = pro_base_url + "rs_appointment_form";
				}
				else if($role =='ASM'){
					window.location = pro_base_url + "asm_pending_form";
				}
				else if($role =='ZSM' ){
					window.location = pro_base_url + "zsm_pending_form";
				}
				// window.location = pro_base_url + "rs_appointment_form";
				
			// }else if(pro_id =='PRO18'){

			// 	var login_mob_no = $('#session_mobile_no').val();
			// 	var login_pass =  $('#session_password').val();
			// 	$('.load_show_'+pro_id).css({"display":"block"});
			// 	var fragmentIdentifier = '#/login/' + login_mob_no;
			// 	// alert(fragmentIdentifier);
			// 	// window.location ='http://localhost:3000/'+ fragmentIdentifier;
			// 	window.location ='http://localhost:3000/'+ fragmentIdentifier;

			// 	// $.ajax({  
			// 	// 	url:url,
			// 	// 	method:"POST",  
			// 	// 	dataType:"json",
			// 	// 	success:function(data) {
						
			// 	// 	}  
			// 	// })
				
			}else{

				var login_mob_no = $('#session_mobile_no').val();
				var login_pass =  $('#session_password').val();
				$('.load_show_'+pro_id).css({"display":"block"});
				
				$.ajax({  
					url:pro_base_url + 'LoginController/doLogin', 
					method:"POST",  
					data:{"mobile":login_mob_no,"pass":login_pass,"pro_id":pro_id,},
					dataType:"json",

					success:function(data) {
						if(data.logstatus =='success'){
							setTimeout(function() {
								window.location = pro_base_url + data.url;
								$('.load_show_'+pro_id).css({"display":"none"});
							}, 2000);
						}
					}  
				})
			}
		}  
	})

   
}


function get_change_pass_pop(){
    $('#show_pass_pop').click();
}

