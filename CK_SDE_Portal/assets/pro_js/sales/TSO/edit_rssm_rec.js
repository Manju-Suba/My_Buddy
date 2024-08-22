$(document).ready(function () {

	var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var current_rowid = last_segment;
	// get_additional_details();

	$('.tab-content').removeClass('show_new');
	$('.tab-content').removeClass('show_ex');
	get_sales_cat_list();
	get_rssm_edit_form(current_rowid);
	get_region_list();
});

function get_sales_cat_list(selected_value) {

	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_sales_cat_list',
		data: {},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {
					// html += '<option value="' + data[index].sales_category + '">' + data[index].sales_category + '</option>';
				// }

				if (data[index].sales_category == selected_value) {
					html += '<option value="' + data[index].sales_category + '" selected>' + data[index].sales_category + '</option>';
				} else {
					html += '<option value="' + data[index].sales_category + '">' + data[index].sales_category + '</option>';
				}
			}

				$('#rssm_select').html(html);
				check_service_fee_limit();
			}
		}
	});

}

$('#service_fee').keyup(function(){
	check_service_fee_limit();
});

$('#rssm_select').on('change',function(){
	check_service_fee_limit();
});

function check_service_fee_limit(){
	var sales_cat =$('#rssm_select').val();
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_sales_cat_limit',
		data: { 'sales_cat' : sales_cat },
		dataType: "json",
		success: function (data) {
			var serviceFee = parseFloat($('#service_fee').val());
			var limit = parseFloat(data[0].limit);
			if(serviceFee > limit){
				$('#service_fee_msg').text('The allowed service fee for '+sales_cat+'  is upto '+data[0].limit +'.');
			}else{
				$('#service_fee_msg').text('');
			}
		}
	});
}

function get_state_list(selected_value) {
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_state_list',
		data: {},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {
					if (data[index].state_name == selected_value) {
						html += '<option value="' + data[index].state_name + '" selected>' + data[index].state_name + '</option>';
					} else {
						html += '<option value="' + data[index].state_name + '">' + data[index].state_name + '</option>';
					}
				}
				$('#state_name').html(html);
			}
		}
	});
}

function get_division_list(state, selected_value) {
	if (state == '') {
		var html = '<option value="">Select</option>';
		$('#c_division').html(html);
	} else {

		$.ajax({
			type: "POST",
			url: BASE_URL + 'RSSMController/get_division_list',
			data: {
				"state": state,
			},
			dataType: "json",
			success: function (data) {
				if (data.length != 0) {
					var html = '<option value="">Select</option>';
					for (let index = 0; index < data.length; index++) {
						if (data[index].district_name == selected_value) {
							html += '<option value="' + data[index].district_name + '" selected>' + data[index].district_name + '</option>';
						} else {
							html += '<option value="' + data[index].district_name + '">' + data[index].district_name + '</option>';
						}
					}
					$('#c_division').html(html);
				}
			}
		});
	}
}

function get_city_list(dist, selected_value) {
	if (dist == '') {
		var html = '<option value="">Select</option>';
		$('#c_city').html(html);
	} else {
		$.ajax({
			type: "POST",
			url: BASE_URL + 'RSSMController/get_city_list',
			data: {
				"dist": dist,
			},
			dataType: "json",
			success: function (data) {
				if (data.length != 0) {
					var html = '<option value="">Select</option>';
					for (let index = 0; index < data.length; index++) {
						if (selected_value == data[index].city_name) {
							html += '<option value="' + data[index].city_name + '" selected>' + data[index].city_name + '</option>';
						} else {
							html += '<option value="' + data[index].city_name + '">' + data[index].city_name + '</option>';
						}
					}
					$('#c_city').html(html);
				}
			}
		});
	}
}

function get_town_list(city, selected_value) {
	if (city == '') {
		var html = '<option value="">Select</option>';
		$('#c_town').html(html);
	} else {
		$.ajax({
			type: "POST",
			url: BASE_URL + 'RSSMController/get_town_list',
			data: {
				"city": city,
			},
			dataType: "json",
			success: function (data) {
				if (data.length != 0) {
					var html = '<option value="">Select</option>';
					for (let index = 0; index < data.length; index++) {

						if (data[index].town_name == selected_value) {
							html += '<option value="' + data[index].town_name + '" selected>' + data[index].town_name + '</option>';
						} else {
							html += '<option value="' + data[index].town_name + '">' + data[index].town_name + '</option>';
						}
					}
					$('#c_town').html(html);
				}
			}
		});
	}

}

function get_additional_details(editdta) {
	var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var current_rowid = last_segment;

	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_additional_details_list_new',
		data: { "current_rowid": current_rowid, },
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var exp_html = '<option value="">Select</option>';
				var edu_html = '<option value="">Select</option>';
				var age_html = '<option value="">Select</option>';
				var terkg_html = '<option value="">Select</option>';
				var techad_html = '<option value="">Select</option>';
				var fambg_html = '<option value="">Select</option>';

				for (let index = 0; index < data.length; index++) {

					if (data[index].parameters == 'Experience') {
						if (editdta.experience == data[index].slab && editdta.exp_point == data[index].points) {
							exp_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '" selected >' + data[index].slab + '</option>';
						} else {
							exp_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
						}
					}
					else if (data[index].parameters == 'Education') {
						if (editdta.education == data[index].slab && editdta.edu_point == data[index].points) {
							edu_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '" selected>' + data[index].slab + '</option>';
						} else {
							edu_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
						}
					}
					else if (data[index].parameters == 'Age') {
						if (editdta.age == data[index].slab && editdta.age_point == data[index].points) {
							age_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '" selected>' + data[index].slab + '</option>';
						} else {
							age_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
						}
					}
					else if (data[index].parameters == 'Terrain Knowledge') {
						if (editdta.terrain_knowledge == data[index].slab && editdta.tk_point == data[index].points) {
							terkg_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '" selected>' + data[index].slab + '</option>';
						} else {
							terkg_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
						}
					}
					else if (data[index].parameters == 'Technology Adaption') {
						if (editdta.tech_adoption == data[index].slab && editdta.ta_point == data[index].points) {
							techad_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '" selected>' + data[index].slab + '</option>';
						} else {
							techad_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
						}
					}
					else if (data[index].parameters == 'Family Background') {
						if (editdta.family_bg == data[index].slab && editdta.fb_point == data[index].points) {
							fambg_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '" selected>' + data[index].slab + '</option>';
						} else {
							fambg_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
						}
					}
				}

				$('#c_experience').html(exp_html);
				$('#c_education').html(edu_html);
				$('#c_age').html(age_html);
				$('#c_tknowledge').html(terkg_html);
				$('#c_tech_adaption').html(techad_html);
				$('#c_familybg').html(fambg_html);

			}
		}
	});
}

function get_rssm_edit_form(current_rowid) {
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_rssm_edit_form',
		data: {
			"current_rowid": current_rowid,
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {

				$('#edit_row_id').val(current_rowid);
				$('#c_name').val(data[0].name);
				$('#service_fee').val(data[0].service_fee);
				// $('#division').val(data[0].business_division).trigger('change');


				$('#c_ex_rssm_name').val(data[0].ex_rssm_name);
				$('#ex_rssm_number').val(data[0].ex_rssm_number);

				$('#c_mobile_no').val(data[0].mobile_no);
				$('#c_altmobile_no').val(data[0].alt_mobile_no);
				$('#c_address').val(data[0].address);

				if(data[0].resume != ""){
					$resume_img = `<a target="_blank" href="../../../../uploads/sales/${data[0].resume}" >view</a>`;
					$('#resume_view').html($resume_img);
				}

				$('#dob').val(data[0].dob);
				$('#email').val(data[0].email);
				$('#f_name').val(data[0].father_name);
				$('#doj').val(data[0].doj);
				$('#rssm_select').val(data[0].sales_cat).trigger('change');
				// console.log(data[0].sales_cat);
				$('#rssm_type_select').val(data[0].sales_type).trigger('change');
				var rssm = $('#rssm_type_select').val();
				if (rssm == 'New SalesMan') {
					$('#new_rssm').show();
					$('#ex_rssm').hide();
				} else if (rssm == 'Existing SalesMan') {
					$('#new_rssm').hide();
					$('#ex_rssm').show();
				}


				$('#region_name').val(data[0].region).trigger('change');

				$('#aadhar_num').val(data[0].aadhar);

				if(data[0].aadhar_copy != ""){
					var check_aadhar =  data[0].aadhar_copy.split('.').pop();
					if(check_aadhar == 'pdf'){
						$aadhar_img = `<a target="_blank" href="../../../uploads/sales/aadhar/${data[0].aadhar_copy}"><i class="bx bx-download" style="font-size: 25px;"></i></a>`;
					}else{
						$aadhar_img = `<a target="_blank" href="../../../../uploads/sales/aadhar/${data[0].aadhar_copy}" ><img src="../../../../uploads/sales/aadhar/${data[0].aadhar_copy}" width="100" height="35"></a>`;
					}
					 
					$('#aadhar_view').html($aadhar_img);
				}

				if(data[0].aadhar_backview != ""){
					var check_aadhar =  data[0].aadhar_backview.split('.').pop();
					if(check_aadhar == 'pdf'){
						$aadhar_backview = `<a target="_blank" href="../../../uploads/sales/aadhar_backview/${data[0].aadhar_backview}"><i class="bx bx-download" style="font-size: 25px;"></i></a>`;
					}else{
						$aadhar_backview = `<a target="_blank" href="../../../../uploads/sales/aadhar_backview/${data[0].aadhar_backview}" ><img src="../../../../uploads/sales/aadhar/${data[0].aadhar_copy}" width="100" height="35"></a>`;
					}
					 
					$('#aadhar_backview').html($aadhar_backview);
				}

				

				$('#pan_num').val(data[0].pan);
				if(data[0].pan_copy != ""){
					var check_pan =  data[0].pan_copy.split('.').pop();
					if(check_pan == 'pdf'){
						$pan_img = `<a target="_blank" href="../../../../uploads/sales/pan/${data[0].pan_copy}"><i class="bx bx-download" style="font-size: 25px;"></i></a>`;
					}else{
						$pan_img = `<a target="_blank" href="../../../../uploads/sales/pan/${data[0].pan_copy}" ><img src="../../../../uploads/sales/pan/${data[0].pan_copy}" width="100" height="35"></a>`;
					}
					$('#pan_view').html($pan_img);

				}

				if(data[0].cheque != ""){
					var check_cheque =  data[0].cheque.split('.').pop();
					if(check_cheque == 'pdf'){
						$cheque_img = `<a target="_blank" href="../../../../uploads/sales/cheque/${data[0].cheque}"><i class="bx bx-download" style="font-size: 25px;"></i></a>`;
					}else{
						$cheque_img = `<a target="_blank" href="../../../../uploads/sales/cheque/${data[0].cheque}" ><img src="../../../../uploads/sales/cheque/${data[0].cheque}" width="100" height="35"></a>`;
					}
					$('#cheque_view').html($cheque_img);

				}

				if(data[0].img_file != ""){
					var check_img =  data[0].img_file.split('.').pop();
					if(check_img == 'pdf'){
						$salesman_img = `<a target="_blank" href="../../../../uploads/sales/image/${data[0].img_file}"><i class="bx bx-download" style="font-size: 25px;"></i></a>`;
					}else{
						$salesman_img = `<a target="_blank" href="../../../../uploads/sales/image/${data[0].img_file}" ><img src="../../../../uploads/sales/image/${data[0].img_file}" width="100" height="35"></a>`;
					}
					$('#salesmanImg_view').html($salesman_img);

				}

				$('#b_name').val(data[0].bank_name);
				$('#ac_num').val(data[0].ac_number);

				$('#ac_type').val(data[0].ac_type);
				$('#ifsc_code').val(data[0].ifsc_s_number);
				$('#branch_name').val(data[0].branch_name);

				const values = data[0].beat_name;
				const uniqueValues = values.split(','); // Split the string into an array
				const totalCountOfUniqueValues = uniqueValues.length;
				for(var k =0; k< totalCountOfUniqueValues ; k++){
					if(k<=5){
						beat_count = k+1;
						$('#beat_name_'+beat_count).val(uniqueValues[k])
					}else{
						beat_count = k+1;
						$('#additional_beats').append(`<div class="form-group col-md-6">
                                            <label>Beat `+beat_count+`<span class="req">*</span></label>
                                            <input type="text" class="form-control" name="beat[]" id="beat_name_`+beat_count+`" >
                                            </div>`);
						$('#beat_name_'+beat_count).val(uniqueValues[k])
					}
				}
				

				$('#town_code').val(data[0].rs_town_code);
				$('#rs_code').val(data[0].rs_code);
				$('#sde_name').val(data[0].rs_town_code);
				$('#asm_name').val(data[0].rs_town_code);

				get_additional_details(data[0]);
				get_rs_name(data[0].rs_name);

				setTimeout(function () {
					get_state_list(data[0].rs_state);
					get_sales_cat_list(data[0].sales_cat);
					get_division_list(data[0].rs_state, data[0].rs_dist);
					get_city_list(data[0].division, data[0].rs_city);
					get_town_list(data[0].rs_city, data[0].rs_town);
					get_region_list(data[0].region);
					get_rs_list(data[0].region, data[0].rs_name);
				}, 1000);
				setTimeout(() => {
					$('.tab-content').removeClass('show_ex');
					$('.tab-content').removeClass('show_new');


				}, 10);

			}
		}
	});
}

$("#SaveBtn").click(function (e) {
	e.preventDefault();

$("#save_status").val("0");
// $("#SubmitBtn").click();
rssmForm_submit();
})
$('#SubmitBtn').click(function () {
// alert(1);

var sales_cat =$('#rssm_select').val();
$.ajax({
	type: "POST",
	url: BASE_URL + 'RSSMController/get_sales_cat_limit',
	data: { 'sales_cat' : sales_cat },
	dataType: "json",
	success: function (data) {
		var serviceFee = parseFloat($('#service_fee').val());
		var limit = parseFloat(data[0].limit);
		if(serviceFee > limit){
			$('#confirm_approval .message').text('The allowed service fee for '+sales_cat+'  is upto '+data[0].limit +'.');
			$('#send_approval').removeAttr('disabled','');
			$('#edit_fee').removeAttr('disabled','');
			$('#confirm_approval').modal('show');
		}else{
			rssmForm_submit();
		}
	}
});

});

$('#send_approval').click(function(e){
	e.preventDefault();
$('#send_approval').attr('disabled','');
$('#edit_fee').attr('disabled','');
$("#div_head_status").val("Inprogress");
$('#confirm_approval').modal('hide');
rssmForm_submit();
});

$('#edit_fee').click(function(e){
	e.preventDefault();

$('#send_approval').attr('disabled','');
$('#edit_fee').attr('disabled','');
$('.li_step_1').click();
$('#confirm_approval').modal('hide');

});
// $('#rssmForm').submit(function (e) {
function rssmForm_submit(){

	

	if (Validateform()) {

		$('.save_btn').attr("disabled", true);
		$('#SubmitBtn').attr("disabled", true);
		// e.preventDefault();

		// var formData = new FormData(this);
		var formData = new FormData($('#rssmForm')[0]);

		$.ajax({
			url: BASE_URL + 'RSSMController/editRssmForm',
			method: "POST",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (data) {

				if (data.response == 'success') {
					$('.save_btn').attr("disabled", false);
					$('#SubmitBtn').attr("disabled", false);
					$('#reset-btn').click();
					updated_toast();
					$("#div_head_status").val("");
					setTimeout(
						function () {
							window.location = BASE_URL + data.url;
						}, 2000);
				}
				else {
					request_failed();
					$('.save_btn').attr("disabled", false);
					$('#SubmitBtn').attr("disabled", false);
				}
			}
		});
	}
// });
}

$('#rssm_type_select').on('change', function () {
	// alert(1);
	var rssm = $('#rssm_type_select').val();
	if (rssm == 'New SalesMan') {
		// alert(1);
		$('.tab-content').addClass('show_new');
		$('.tab-content').removeClass('show_ex');
		$('#new_rssm').show();
		$('#ex_rssm').hide();

	} else if (rssm == 'Existing SalesMan') {
		$('.tab-content').addClass('show_ex');
		$('.tab-content').removeClass('show_new');
		$('#new_rssm').hide();

		$('#ex_rssm').show();

	} else {
		$('#ex_rssm').hide();
		$('#new_rssm').hide();
		$('.tab-content').removeClass('show_new');
		$('.tab-content').removeClass('show_ex');
	}
});


$('#region_name').on('change', function () {
	var region = $('#region_name').val();
	var rs_val = "";
	get_rs_list(region, rs_val);
	$('#rs_code').val('');
	$('#sde_name').val('');
	$('#sde_name').val('');
	$('#asm_name').val('');
});

function get_rs_list(mob_num, rs_name) {
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_rs_list',
		data: {
			"mob_num": mob_num
		},
		dataType: "json",
		success: function (data) {
			// console.log(data.length);
			if (data.length != 0) {
				var html = '<option value="" >Select</option>';
				for (let index = 0; index < data.length; index++) {
					if (rs_name == data[index].rs_name) {
						html += '<option value="' + data[index].rs_name + '" selected>' + data[index].rs_name + '</option>';
					} else {
						html += '<option value="' + data[index].rs_name + '">' + data[index].rs_name + '</option>';
					}
				}
				$('#select_rs_name').html(html);
			}
		}
	});
}

$('#select_rs_name').on('change', function () {
	var id = $('#select_rs_name').val();
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_rs_code',
		data: {
			"id": id,
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var rscode = data[0].rs_code;
				$('#rs_code').val(rscode);
				$('#sde_name').val(data[0].tso_name);
				sde_det(id);
			}
		}
	});
})

function get_rs_name(id) {
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_rs_code',
		data: {
			"id": id,
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var rscode = data[0].rs_code;
				$('#rs_code').val(rscode);
				$('#sde_name').val(data[0].tso_name);
				sde_det(id);
			}
		}
	});
}

$('#state_name').on('change', function () {
	var state = $('#state_name').val();
	var dist_val = "";
	var city_val = "";
	var town_val = "";
	var towncode = $('#town_code').val('');
	get_division_list(state, dist_val);
	get_city_list(dist_val, city_val);
	get_town_list(city_val, town_val);
})

$('#c_division').on('change', function () {
	var dist_val = $('#c_division').val();
	var city_val = "";
	var town_val = "";
	var towncode = $('#town_code').val('');
	get_city_list(dist_val, city_val);
	get_town_list(city_val, town_val);
})

$('#c_city').on('change', function () {
	var c_city = $('#c_city').val();
	var towncode = $('#town_code').val('');
	var town_val = "";
	get_town_list(c_city, town_val);
})


function get_region_list(selected_value) {
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_region_list',
		data: {
			// 'mob_num':mob_num,
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';

				for (let index = 0; index < data.length; index++) {
					if (selected_value == data[index].region) {
						html += '<option value="' + data[index].region + '" selected>' + data[index].region + '</option>';
					} else {
						html += '<option value="' + data[index].region + '">' + data[index].region + '</option>';
					}
				}
				$('#region_name').html(html);
			}
		}
	});
}

$('#c_town').on('change', function () {
	var towncode = $('#town_code').val('');
	get_town_code();
});

function get_town_code() {
	town_name = $('#c_town').val();
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_town_code',
		data: {
			"town_name": town_name,
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				$('#town_code').val(data[0].town_code)
			}
		}
	});
}



function sde_det(mob_num) {
	if(mob_num ==""){
		$('#asm_name').val('');
	}else{
		$.ajax({
			type: "POST",
			url: BASE_URL + 'RSSMController/get_rsdetails',
			data: {
				"rscode": mob_num,
			},
			dataType: "json",
			success: function (data) {
				if (data.length != 0) {
					$('#asm_name').val(data[0].asm);
				}else{
					$('#asm_name').val('');
				}
			}
		});
	}
}

function Validateform(email) {

	var c_name = $('#c_name').val();
	// var division = $('#division').val();
	var c_mobile_no = $('#c_mobile_no').val();
	var c_address = $('#c_address').val();
	var c_state = $('#c_state').val();
	var c_division = $('#c_division').val();
	var c_town = $('#c_town').val();
	var c_experience = $('#c_experience').val();
	var c_education = $('#c_education').val();
	var c_age = $('#c_age').val();
	var c_tknowledge = $('#c_tknowledge').val();
	var c_tech_adaption = $('#c_tech_adaption').val();
	var dob = $('#dob').val();
	var email = $('#email').val();
	var f_name = $('#f_name').val();
	var doj = $('#doj').val();
	var rssm_type_select = $('#rssm_type_select').val();
	var rssm_select = $('#rssm_select').val();
	var c_familybg = $('#c_familybg').val();
	var c_altmobile_no = $('#c_altmobile_no').val();
	// var rssm_select_existing = $('#rssm_select_existing').val();

	var region_name = $('#region_name').val();
	var select_rs_name = $('#select_rs_name').val();
	var state_name = $('#state_name').val();
	var c_division = $('#c_division').val();
	var c_city = $('#c_city').val();
	var c_town = $('#c_town').val();
	var ex_rssm_number = $('#ex_rssm_number').val();
	var c_ex_rssm_name = $('#c_ex_rssm_name').val();
	var service_fee = $('#service_fee').val();
	var aadhar_num = $('#aadhar_num').val();
	var pan_num = $('#pan_num').val();
	var b_name = $('#b_name').val();
	var ac_num = $('#ac_num').val();
	var ac_type = $('#ac_type').val();
	var ifsc_code = $('#ifsc_code').val();
	var branch_name = $('#branch_name').val();
	var ifsc_code = $('#ifsc_code').val();
	var aadhar_copy_b = $('#aadhar_copy_b').val();
	var mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);

	if (c_name == '' || c_mobile_no == '' || c_address == '' || dob == '' || f_name == '' || doj == '' || rssm_select == '' || email == '' || c_altmobile_no == '' ) {
		$('.li_step_1').click();
		alert(1);
		fields_required();
		return false;
	}

	if(mail == false){
		$('.li_step_1').click();
		valid_email();
		return false;

	}
	if ( service_fee =="") {
		$('.li_step_1').click();
		fields_required();
		return false;
	}

	if(c_altmobile_no.length !=10 || c_mobile_no.length != 10){
		$('.li_step_1').click();
		valid_phone_number();
		return false;

	}

	if (c_experience == '' || c_education == '' || c_age == '' || c_tknowledge == '' || c_tech_adaption == '' || c_familybg == '') {
		$('.li_step_2').click();
		fields_required();
		return false;
	}
	if (rssm_type_select == '') {
		$('.li_step_3').click();
		fields_required();
		return false;
	}

	if (rssm_type_select == 'New SalesMan') {
		if (region_name == "" || select_rs_name == "" || state_name == "" || c_division == "" || c_city == "" || c_town == "") {
			$('.li_step_3').click();
			fields_required();
			return false;
		}
		for( var i= beat_count; i<= beat_count; i++){
			if($('#beat_name_'+i).val() == '' || $('#beat_name_'+i).val() == null || $('#beat_name_'+i).val() == undefined){
				$('.li_step_3').click();
				fields_required();
				return false;
			}
		}
	}

	if (rssm_type_select == 'Existing SalesMan') {
		if (ex_rssm_number == "" || c_ex_rssm_name == "" ) {
			$('.li_step_3').click();
			fields_required();
			return false;
		}
	}

	if (aadhar_num == '' || pan_num == '' || b_name == '' || ac_num == '' || ac_type == '' || ifsc_code == '' || branch_name == '') {
		$('.li_step_4').click();
		fields_required();
		return false;
	}
	
	if (aadhar_num.length !=12){
		$('.li_step_4').click();
		valid_aadhar_number();
		return false;

	}
	if (pan_num.length !=10){
		$('.li_step_4').click();
		valid_pan_number();
		return false;

	}

	return true;

}

$("#reedit_SaveBtn").click(function (e) {
	e.preventDefault();

$("#save_status").val("0");
// $("#SubmitBtn").click();
reeditrssmForm_submit();
})
$('#reedit_SubmitBtn').click(function () {
// alert(1);

var sales_cat =$('#rssm_select').val();
$.ajax({
	type: "POST",
	url: BASE_URL + 'RSSMController/get_sales_cat_limit',
	data: { 'sales_cat' : sales_cat },
	dataType: "json",
	success: function (data) {
		var serviceFee = parseFloat($('#service_fee').val());
		var limit = parseFloat(data[0].limit);
		if(serviceFee > limit){
			$('#confirm_approval_re .message').text('The allowed service fee for '+sales_cat+'  is upto '+data[0].limit +'.');
			$('#send_approval_re').removeAttr('disabled','');
			$('#edit_fee_re').removeAttr('disabled','');
			$('#confirm_approval_re').modal('show');
		}else{
			reeditrssmForm_submit();
		}
	}
});

});

$('#send_approval_re').click(function(e){
	e.preventDefault();
$('#send_approval_re').attr('disabled','');
$('#edit_fee_re').attr('disabled','');
$("#div_head_status").val("Inprogress");
$('#confirm_approval_re').modal('hide');
reeditrssmForm_submit();
});

$('#edit_fee').click(function(e){
	e.preventDefault();

$('#send_approval_re').attr('disabled','');
$('#edit_fee_re').attr('disabled','');
$('.li_step_1').click();
$('#confirm_approval_re').modal('hide');

});

// $('#reeditrssmForm').submit(function (e) {
function reeditrssmForm_submit(){
	

	if (Validateform()) {

		$('.save_btn').attr("disabled", true);
		$('#SubmitBtn').attr("disabled", true);

		// e.preventDefault();

		// var formData = new FormData(this);
		var formData = new FormData($('#reeditrssmForm')[0]);

		$.ajax({
			url: BASE_URL + 'RSSMController/re_editRssmForm',
			method: "POST",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (data) {

				if (data.response == 'success') {
					$('.save_btn').attr("disabled", false);
					$('#SubmitBtn').attr("disabled", false);
					$('#reset-btn').click();
					updated_toast();

					setTimeout(
						function () {
							window.location = BASE_URL + data.url;
						}, 2000);
				}
				else {
					request_failed();
					$('.save_btn').attr("disabled", false);
					$('#SubmitBtn').attr("disabled", false);
				}
			}
		});
	}
// });
}
