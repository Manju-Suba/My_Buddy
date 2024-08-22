$(document).ready(function () {
	get_sales_cat_list();
	get_state_list();
	get_additional_details();
	get_region_list();
});

function get_sales_cat_list() {

	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_sales_cat_list',
		data: {},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].sales_category + '">' + data[index].sales_category + '</option>';
				}

				$('#rssm_select').html(html);

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

function get_state_list() {

	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_state_list',
		data: {},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].state_name + '">' + data[index].state_name + '</option>';
				}

				$('#c_state').html(html);

			}
		}
	});

}

// $("#c_state").on('change', function () {
// 	var state = $('#c_state').val();
// 	get_division_list(state);
// });



// $("#c_division").on('change', function () {

// 	var division = $('#c_division').val();

// 	get_town_list(division);

// });

// function get_town_list(division) {
// 	if (division == '') {
// 		var html = '<option value="">Select</option>';
// 		$('#c_town').html(html);

// 	} else {

// 		$.ajax({
// 			type: "POST",
// 			url: BASE_URL + 'RSSMController/get_town_list',
// 			data: {
// 				"division": division,
// 			},
// 			dataType: "json",
// 			success: function (data) {
// 				if (data.length != 0) {
// 					var html = '<option value="">Select</option>';
// 					for (let index = 0; index < data.length; index++) {
// 						html += '<option value="' + data[index].town_name + '">' + data[index].town_name + '</option>';
// 					}

// 					$('#c_town').html(html);

// 				}
// 			}
// 		});
// 	}

// }

function get_additional_details() {
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_additional_details_list',
		data: {},
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
						exp_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if (data[index].parameters == 'Education') {
						edu_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if (data[index].parameters == 'Age') {
						age_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if (data[index].parameters == 'Terrain Knowledge') {
						terkg_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if (data[index].parameters == 'Technology Adaption') {
						techad_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if (data[index].parameters == 'Family Background') {
						fambg_html += '<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
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
		$("#SubmitBtn").attr("disabled",true);

		// e.preventDefault();

		var formData = new FormData($('#rssmForm')[0]);
		$.ajax({
			url: BASE_URL + 'RSSMController/addRssmForm',
			method: "POST",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",

			success: function (data) {

				if (data.response == 'success') {

					$('#rssmForm')[0].reset();
					$('.single-select').select2({
						theme: 'bootstrap4',
						width: $('#rssmForm').data('width') ? $('#rssmForm').data('width') : $('#rssmForm').hasClass('w-100') ? '100%' : 'style',
						placeholder: $('#rssmForm').data('placeholder'),
						allowClear: Boolean($('#rssmForm').data('allow-clear')),
					});

					$("#save_status").val("1");
					$("#div_head_status").val("");
					$("#service_fee_msg").text("");
					$('.save_btn').attr("disabled", false);
					$("#SubmitBtn").attr("disabled",false);

					$('#reset-btn').click();
					added_toast();

				}
				else {
					if (Validateform()) {
						request_failed();

					}
					$('.save_btn').attr("disabled", false);

				}

			}
		});

	}
}

// });
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
	// var rssm_select_existing = $('#rssm_select_existing').val();
	var c_familybg = $('#c_familybg').val();
	var c_altmobile_no = $('#c_altmobile_no').val();
	var region_name = $('#region_name').val();
	var select_rs_name = $('#select_rs_name').val();
	var state_name = $('#state_name').val();
	var c_division = $('#c_division').val();
	var c_city = $('#c_city').val();
	var c_town = $('#c_town').val();
	var ex_rssm_number = $('#ex_rssm_number').val();
	var c_ex_rssm_name = $('#c_ex_rssm_name').val();

	var aadhar_num = $('#aadhar_num').val();
	var aadhar_copy = $('#aadhar_copy').val();
	var aadhar_copy_b = $('#aadhar_copy_b').val();
	var pan_num = $('#pan_num').val();
	var pan_copy = $('#pan_copy').val();
	var cheque_copy = $('#cheque_copy').val();
	var b_name = $('#b_name').val();
	var ac_num = $('#ac_num').val();
	var ac_type = $('#ac_type').val();
	var ifsc_code = $('#ifsc_code').val();
	var branch_name = $('#branch_name').val();
	var image_file = $('#image_file').val();
	var service_fee = $('#service_fee').val();
	var ifsc_code = $('#ifsc_code').val();
	var mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
	// alert(mail);
	
	if (c_name == '' || c_mobile_no == '' || c_address == '' || dob == '' || f_name == '' || doj == '' || rssm_select == '' || email == ''||c_altmobile_no == ''  ) {
		$('.li_step_1').click();
		fields_required();
		return false;

	}
	if(mail == false){
		$('.li_step_1').click();
		valid_email();
		return false;

	}

	if(c_altmobile_no.length !=10 || c_mobile_no.length != 10){
		$('.li_step_1').click();
		valid_phone_number();
		return false;

	}
	if (image_file == "" || service_fee =="") {
		// alert(2);
		$('.li_step_1').click();
		fields_required();
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
		for( var i= beat_count; i< beat_count; i++){
			if($('#beat_name_'+i).val() == '' || $('#beat_name_'+i).val() == null || $('#beat_name_'+i).val() == undefined){
				$('.li_step_3').click();
				fields_required();
				return false;
			}
		}
	}


	if (rssm_type_select == 'Existing SalesMan') {
		// alert(c_ex_rssm_name);
		// alert(ex_rssm_number);
		// alert(ex_rssm_number.length != 10);
		
		if (ex_rssm_number == "" || c_ex_rssm_name == "" ) {
			$('.li_step_3').click();
			fields_required();
			return false;

		}
		if (ex_rssm_number.length != 10 ) {
			$('.li_step_3').click();
			valid_phone_number();
			return false;

		}
	}
	if (aadhar_num == '' || aadhar_copy == '' ||aadhar_copy_b == ''|| pan_num == '' || pan_copy == '' || cheque_copy == '' || b_name == '' || ac_num == '' || ac_type == '' || ifsc_code == '' || branch_name == '') {
		// else if(aadhar_num == null){
		// alert(1);
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

	// alert(1);
	// 	alert(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
	// if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
	// {
	// 	return (true)
	// }
	// 	alert("You have entered an invalid email address!")
	// 	return (false)
}

$('#rssm_type_select').on('change', function () {
	var rssm = $('#rssm_type_select').val();
	if (rssm == 'New SalesMan') {
		$('.tab-content').addClass('show_new');
		$('.tab-content').removeClass('show_ex');


		$('#new_rssm').show();
		$('#ex_rssm').hide();
		$('#region_name').val("").trigger('change');
		$('#select_rs_name').val("").trigger('change');
		$('#state_name').val("").trigger('change');
		$('#c_division').val("").trigger('change');
		$('#c_city').val("").trigger('change');
		$('#c_town').val("").trigger('change');
	



	} else if (rssm == 'Existing SalesMan') {
		$('.tab-content').addClass('show_ex');
		$('.tab-content').removeClass('show_new');
		$('#new_rssm').hide();

		$('#ex_rssm').show();
		
		$('#ex_rssm_number').val("");
		$('#c_ex_rssm_name').val("");

	} else {
		$('#ex_rssm').hide();
		$('#new_rssm').hide();
		$('.tab-content').removeClass('show_new');
		$('.tab-content').removeClass('show_ex');

		$('#region_name').val("").trigger('change');
		$('#select_rs_name').val("").trigger('change');
		$('#state_name').val("").trigger('change');
		$('#c_division').val("").trigger('change');
		$('#c_city').val("").trigger('change');
		$('#c_town').val("").trigger('change');
		$('#ex_rssm_number').val("");
		$('#c_ex_rssm_name').val("");

	}

});


function get_state_list() {
	var mob_num =$('#tso_num').val();
	// alert(mob_num)
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_state_list',
		data: {
			// "mob_num":mob_num,
		},
		dataType: "json",
		success: function (data) {
			// console.log(data.length);
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].state_name + '">' + data[index].state_name + '</option>';
				}
				// console.log(html);

				$('#state_name').html(html);

			}
		}
	});

}


$('#state_name').on('change', function () {
	var state = $('#state_name').val();
	var dist ="";
	var city ="";
	var town_name ="";
	get_division_list(state);
	get_city_list(dist);
	get_town_list(city);
	get_town_code(town_name);
})

function get_division_list(state) {
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
						html += '<option value="' + data[index].district_name + '">' + data[index].district_name + '</option>';
					}

					$('#c_division').html(html);
				}
			}
		});
	}
}

$('#c_division').on('change', function () {
	var dist = $('#c_division').val();
	var city = "";
	var town_name = "";
	get_city_list(dist);
	get_town_list(city);
	get_town_code(town_name);
})

function get_city_list(dist) {
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
				console.log(data);
				if (data.length != 0) {
					var html = '<option value="">Select</option>';
					for (let index = 0; index < data.length; index++) {
						html += '<option value="' + data[index].city_name + '">' + data[index].city_name + '</option>';
					}
					$('#c_city').html(html);
				}
			}
		});
	}
}



$('#c_city').on('change', function () {
	var city = $('#c_city').val();
	var town_name = "";
	get_town_list(city);
	get_town_code(town_name);
})
function get_town_list(city) {
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
						html += '<option value="' + data[index].town_name + '">' + data[index].town_name + '</option>';
					}
					$('#c_town').html(html);
				}
			}
		});
	}
}

$('#c_town').on('change', function () {
	town_name = $('#c_town').val();
	get_town_code(town_name);
});

function get_town_code(town_name) {
	if(town_name == ""){
		$('#town_code').val('');
	}else{
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
}

function get_rs_list() {
	var mob_num = $('#region_name').val();
	// console.log(mob_num);
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSSMController/get_rs_list',
		data: {
			"mob_num": mob_num
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="" selected>Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].rs_name + '">' + data[index].rs_name + '</option>';
				}
				$('#select_rs_name').html(html);
			}
		}
	});

}
$('#region_name').on('change', function () {
	get_rs_list();
	$('#rs_code').val('');
	$('#sde_name').val('');
	$('#sde_name').val('');
	$('#asm_name').val('');
});


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
				// get_state_list();
				$('#rs_code').val(rscode);
				$('#sde_name').val(data[0].tso_name);
				sde_det();
			}
		}
	});
})

// function get_division_list(state) {
// 	// if (state == '') {
// 	// 	var html = '<option value="">Select</option>';
// 	// 	$('#c_division').html(html);

// 	// } else {
// 	var state = $('#state_name').val();

// 	$.ajax({
// 		type: "POST",
// 		url: BASE_URL + 'RSSMController/get_division_list',
// 		data: {
// 			"state": state,
// 		},
// 		dataType: "json",
// 		success: function (data) {
// 			if (data.length != 0) {
// 				var html = '<option value="">Select</option>';
// 				for (let index = 0; index < data.length; index++) {
// 					html += '<option value="' + data[index].district_name + '">' + data[index].district_name + '</option>';
// 				}

// 				$('#c_division').html(html);

// 			}
// 		}
// 	});
// }

function get_region_list(division) {
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
					html += '<option value="' + data[index].region + '">' + data[index].region + '</option>';
				}
				// console.log(html);

				$('#region_name').html(html);

			}
		}
	});

}

function sde_det() {
	mob_num = $('#select_rs_name').val();
	// alert(mob_num);
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


