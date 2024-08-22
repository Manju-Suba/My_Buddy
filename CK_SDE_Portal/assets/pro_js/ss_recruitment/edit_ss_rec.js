$(document).ready(function () {

	var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var current_rowid = last_segment;
    get_additional_details();

    get_ss_edit_form(current_rowid);
});

function get_state_list(selected_value) {

	$.ajax({
		type: "POST",
		url: BASE_URL + 'ss_recruitment/SSController/get_state_list',
		data: {},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {

                    if(data[index].state_name == selected_value){
                        html += '<option value="' + data[index].state_name + '" selected>' + data[index].state_name + '</option>';

                    }else{
                        html += '<option value="' + data[index].state_name + '">' + data[index].state_name + '</option>';

                    }
				}

				$('#c_state').html(html);

			}
		}
	});

}
$("#c_state").on('change', function () {

	var state = $('#c_state').val();
	var division = $('#c_division').val();
	get_division_list(state);
	get_town_list(division);

});
function get_division_list(state,selected_value) {
	if (state == '') {
		var html = '<option value="">Select</option>';
		$('#c_division').html(html);

	} else {

		$.ajax({
			type: "POST",
			url: BASE_URL + 'ss_recruitment/SSController/get_division_list',
			data: {
				"state": state,
			},
			dataType: "json",
			success: function (data) {
				if (data.length != 0) {
					var html = '<option value="">Select</option>';
					for (let index = 0; index < data.length; index++) {

                        if(data[index].district_name == selected_value){
                            html += '<option value="' + data[index].district_name + '" selected>' + data[index].district_name + '</option>';

                        }else{
                            html += '<option value="' + data[index].district_name + '">' + data[index].district_name + '</option>';

                        }
					}

					$('#c_division').html(html);

				}
			}
		});
	}

}
$("#c_division").on('change', function () {

	var division = $('#c_division').val();

	get_town_list(division);

});
function get_town_list(division,selected_value) {
	if (division == '') {
		var html = '<option value="">Select</option>';
		$('#c_town').html(html);

	} else {

		$.ajax({
			type: "POST",
			url: BASE_URL + 'ss_recruitment/SSController/get_town_list',
			data: {
				"division": division,
			},
			dataType: "json",
			success: function (data) {
				if (data.length != 0) {
					var html = '<option value="">Select</option>';
					for (let index = 0; index < data.length; index++) {

                        if(selected_value == data[index].town_name){
                            html += '<option value="' + data[index].town_name + '" selected>' + data[index].town_name + '</option>';

                        }else{
                            html += '<option value="' + data[index].town_name + '">' + data[index].town_name + '</option>';

                        }
					}

					$('#c_town').html(html);

				}
			}
		});
	}

}

function get_additional_details(){
	var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var current_rowid = last_segment;
	$.ajax({
		type: "POST",
		url: BASE_URL + 'ss_recruitment/SSController/get_additional_details_list_new',
		data: {"current_rowid":current_rowid,},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {

				var ao_html ='<option value="">Select</option>';
				var ch_html ='<option value="">Select</option>';
				var ts_html ='<option value="">Select</option>';
				var gd_html ='<option value="">Select</option>';
				var cp_html ='<option value="">Select</option>';
				var pt_html ='<option value="">Select</option>';
				var in_html ='<option value="">Select</option>';
				var dv_html ='<option value="">Select</option>';
				var fi_html ='<option value="">Select</option>';
				var pi_html ='<option value="">Select</option>';
				var mfb_html ='<option value="">Select</option>';

				for (let index = 0; index < data.length; index++) {
					
					if (data[index].parameters =='Age of Organisation') {
						ao_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Companies Handled'){
						ch_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Towns Serviced'){
						ts_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Godown'){
						gd_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Computer'){
						cp_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Printer'){
						pt_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
                    else if(data[index].parameters =='Internet'){
						in_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Delivery Vehicle'){
						dv_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Future investment'){
						fi_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Proprietary Involvement'){
						pi_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Market Feed Back'){
						mfb_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}


				}

				$('#c_age_of_org').html(ao_html);
				$('#c_comp_handled').html(ch_html);
				$('#c_towns_serviced').html(ts_html);
				$('#c_godown').html(gd_html);
				$('#c_computer').html(cp_html);
				$('#c_printer').html(pt_html);
                $('#c_internet').html(in_html);
				$('#c_delivery_vehicle').html(dv_html);
				$('#c_fut_inverstment').html(fi_html);
				$('#c_prop_invol').html(pi_html);
				$('#c_market_fb').html(mfb_html);

			}
		}
	});
}

function get_ss_edit_form(current_rowid){
    $.ajax({
        type: "POST",
        url: BASE_URL + 'ss_recruitment/SSController/get_ss_edit_form',
        data: {
            "current_rowid": current_rowid,
        },
        dataType: "json",
        success: function (data) {
            if (data.length != 0) {
                
                $('#edit_row_id').val(current_rowid);
                $('#c_name').val(data[0].c_name);
                $('#c_ex_ss_name').val(data[0].c_ex_ss_name);
                $('#c_mobile_no').val(data[0].c_mobile_no);
                $('#c_sname').val(data[0].c_sname);
                $('#c_gst_no').val(data[0].c_gst_no);
                $('#c_altmobile_no').val(data[0].c_altmobile_no);
                $('#c_address').val(data[0].c_address);
               
                $("#c_age_of_org").val(data[0].c_age_of_org+' | '+data[0].c_age_of_org_point).trigger('change');

                $("#c_comp_handled").val(data[0].c_comp_handled+' | '+data[0].c_comp_handled_point).trigger('change');
                $("#c_towns_serviced").val(data[0].c_towns_serviced+' | '+data[0].c_towns_serviced_point).trigger('change');
                $("#c_godown").val(data[0].c_godown+' | '+data[0].c_godown_point).trigger('change');
                $("#c_computer").val(data[0].c_computer+' | '+data[0].c_computer_point).trigger('change');
                $("#c_printer").val(data[0].c_printer+' | '+data[0].c_printer_point).trigger('change');
                $("#c_internet").val(data[0].c_internet+' | '+data[0].c_internet_point).trigger('change');
                $("#c_delivery_vehicle").val(data[0].c_delivery_vehicle+' | '+data[0].c_delivery_vehicle_point).trigger('change');
                $("#c_fut_inverstment").val(data[0].c_fut_inverstment+' | '+data[0].c_fut_inverstment_point).trigger('change');
                $("#c_prop_invol").val(data[0].c_prop_invol+' | '+data[0].c_prop_invol_point).trigger('change');
                $("#c_market_fb").val(data[0].c_market_fb+' | '+data[0].c_market_fb_point).trigger('change');

                setTimeout(
                    function() {
                        get_state_list(data[0].c_state);
                        get_division_list(data[0].c_state,data[0].c_division);
                        get_town_list(data[0].c_division,data[0].c_town);
                    }, 1000);

                

            }
        }
    });
}

$("#SaveBtn").click(function(){
    $("#save_status").val("0");
    $("#SubmitBtn").click();
});

$('#ssForm').submit(function(e) {
    var c_name = $('#c_name').val();
	var c_sname = $('#c_sname').val();
	var c_mobile_no = $('#c_mobile_no').val();
	var c_state = $('#c_state').val();
	var c_division = $('#c_division').val();
	var c_town = $('#c_town').val();
	var c_address = $('#c_address').val();
	
	if(c_name =='' || c_sname =='' || c_mobile_no =='' || c_state =='' || c_division =='' || c_town =='' || c_address ==''){
		$('.li_step_1').click();
		fields_required();

		return false;

	}else{

		$('.save_btn').attr("disabled", true);
		e.preventDefault();
		
		var formData = new FormData(this);
		$.ajax({  
			url:BASE_URL + 'ss_recruitment/SSController/editSsForm', 
			method:"POST",  
			data: formData,
			cache:false,
			contentType: false,
			processData: false,
			dataType:"json",
		
			success:function(data) {

				if(data.response =='success'){
					
					$('.save_btn').attr("disabled", false);
					$('#reset-btn').click();
					updated_toast();

					setTimeout(
						function() {
							window.location = BASE_URL + data.url;
					}, 2000);

					
				}
				else{
					request_failed();
					$('.save_btn').attr("disabled", false);
					
				}
						
			}  
		}); 
	}
});
