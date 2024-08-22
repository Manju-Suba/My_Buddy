$(document).ready(function () {

	get_state_list();
	get_additional_details();
});


function get_state_list() {

	$.ajax({
		type: "POST",
		url: BASE_URL + 'ss_recruitment/SSController/get_state_list',
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

$("#c_state").on('change', function () {

	var state = $('#c_state').val();

	get_division_list(state);

});

function get_division_list(state) {
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
						html += '<option value="' + data[index].district_name + '">' + data[index].district_name + '</option>';
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

function get_town_list(division) {
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
						html += '<option value="' + data[index].town_name + '">' + data[index].town_name + '</option>';
					}

					$('#c_town').html(html);

				}
			}
		});
	}

}

function get_additional_details(){
	$.ajax({
		type: "POST",
		url: BASE_URL + 'ss_recruitment/SSController/get_additional_details_list',
		data: {},
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

$("#SaveBtn").click(function(){
    $("#save_status").val("0");
    $("#SubmitBtn").click();
})

$('#ssForm').submit(function(e) {
    
	var c_name = $('#c_name').val();
	var c_sname = $('#c_sname').val();
	var c_mobile_no = $('#c_mobile_no').val();
	var c_address = $('#c_address').val();
	var c_state = $('#c_state').val();
	var c_division = $('#c_division').val();
	var c_town = $('#c_town').val();
	
	if(c_name =='' || c_sname =='' || c_mobile_no =='' || c_address =='' || c_state =='' || c_division =='' || c_town ==''){
		$('.li_step_1').click();
		fields_required();

		return false;

	}else{

        $('.save_btn').attr("disabled", true);
        e.preventDefault();
        
        var formData = new FormData(this);
        $.ajax({  
            url:BASE_URL + 'ss_recruitment/SSController/addSsForm', 
            method:"POST",  
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType:"json",
        
            success:function(data) {

                if(data.response =='success'){

                    $('#ssForm')[0].reset();
                    $('.single-select').select2({
                        theme: 'bootstrap4',
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                        placeholder: $(this).data('placeholder'),
                        allowClear: Boolean($(this).data('allow-clear')),
                    });
                   
    				$("#save_status").val("1");
                    
                    $('.save_btn').attr("disabled", false);
                    $('#reset-btn').click();
                    added_toast();
                    
                }
                else{
                    request_failed();
                    $('.save_btn').attr("disabled", false);
                    
                }
                        
            }  
        }); 
	}
});