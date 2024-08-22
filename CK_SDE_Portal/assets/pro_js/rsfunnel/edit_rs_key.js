$(document).ready(function () {

	var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
	var segment_array = segment_str.split('/');
	var last_segment = segment_array.pop();
	var current_rowid = last_segment;
    get_additional_details();

    get_rs_key_edit_form(current_rowid);
});

function get_additional_details(){
	$.ajax({
		type: "POST",
		url: BASE_URL + 'RSController/get_additional_details_key_list',
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
				var xm_html ='<option value="">Select</option>';
				var ie_html ='<option value="">Select</option>';

				for (let index = 0; index < data.length; index++) {
					if (data[index].parameters =='STOCKS AS PER NORM (both EPDs & NPDs)') {
						ao_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Infra RSSM vs Actual'){
						ch_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Infra Delivery Vehicle vs Actual'){
						ts_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Number of RED RSSM'){
						gd_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Order Vs Delivery'){
						cp_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='FF Absenteeism (HoW & Total calls condition)'){
						pt_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
                    else if(data[index].parameters =='FF Absenteeism (Actual Absent)'){
						in_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='NPD Investment'){
						dv_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Financials'){
						fi_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='INFRASTRUCTURE - Warehouse'){
						pi_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='SSFA = XDM'){
						mfb_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='XDM regular usage (daily usage)'){
						xm_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
					else if(data[index].parameters =='Issues Raised with SDE'){
						ie_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}


				}

				$('#key_stocks').html(ao_html);
				$('#key_infra').html(ch_html);
				$('#key_infra_delivery').html(ts_html);
				$('#key_number').html(gd_html);
				$('#key_order').html(cp_html);
				$('#key_ffabsenteeism').html(pt_html);
                $('#key_ffabsenteeism_actual').html(in_html);
				$('#key_npd').html(dv_html);
				$('#key_financials').html(fi_html);
				$('#key_infrastructure').html(pi_html);
				$('#key_ssfa').html(mfb_html);
				$('#key_xdm').html(xm_html);
				$('#key_issues_raised').html(ie_html);

			}
		}
	});
}

function get_rs_key_edit_form(current_rowid){
    $.ajax({
        type: "POST",
        url: BASE_URL + 'RSController/get_rs_key_edit_form',
        data: {
            "current_rowid": current_rowid,
        },
        dataType: "json",
        success: function (data) {
            if (data.length != 0) {
               $('#edit_row_id').val(current_rowid);
                $("#key_stocks").val(data[0].key_stocks+' | '+data[0].key_stocks_point).trigger('change');
                $("#key_infra").val(data[0].key_infra+' | '+data[0].key_infra_point).trigger('change');
                $("#key_infra_delivery").val(data[0].key_infra_delivery+' | '+data[0].key_infra_delivery_point).trigger('change');
                $("#key_number").val(data[0].key_number+' | '+data[0].key_number_point).trigger('change');
                $("#key_order").val(data[0].key_order+' | '+data[0].key_order_point).trigger('change');
                $("#key_ffabsenteeism").val(data[0].key_ffabsenteeism+' | '+data[0].key_ffabsenteeism_point).trigger('change');
                $("#key_ffabsenteeism_actual").val(data[0].key_ffabsenteeism_actual+' | '+data[0].key_ffabsenteeism_actual_point).trigger('change');
                $("#key_npd").val(data[0].key_npd+' | '+data[0].key_npd_point).trigger('change');
                $("#key_financials").val(data[0].key_financials+' | '+data[0].key_financials_point).trigger('change');
                $("#key_infrastructure").val(data[0].key_infrastructure+' | '+data[0].key_infrastructure_point).trigger('change');
                $("#key_ssfa").val(data[0].key_ssfa+' | '+data[0].key_ssfa_point).trigger('change');
                $("#key_xdm").val(data[0].key_xdm+' | '+data[0].key_xdm_point).trigger('change');
                $("#key_issues_raised").val(data[0].key_issues_raised+' | '+data[0].key_issues_raised_point).trigger('change');

            }
        }
    });
}
$('#rsKeyForm').submit(function(e) {
    var formData = new FormData(this);
    $.ajax({  
        url:BASE_URL + 'RSController/editKeyRsForm', 
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
                        window.location = BASE_URL1 + data.url;
                }, 1000);

                
            }
            else{
                request_failed();
                $('.save_btn').attr("disabled", false);
                
            }
                    
        }  
    }); 

});
