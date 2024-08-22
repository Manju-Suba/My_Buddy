$(document).ready(function () {
	get_key_name_list();
	get_additional_details();
});
function get_key_name_list(){
		$.ajax({
		type: "POST",
		url: BASE_URL + 'ss_recruitment/SSController/get_key_name_list',
		data: {}, 
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {

				var html ='<option value="">Select</option>';

				for (let index = 0; index < data.length; index++) {
						html += '<option value="' + data[index].id + '">' + data[index].rs_key_name + '</option>';
				}

				$('#key_name').html(html);
			}
		}
	});
}


function get_additional_details(){
	//alert('test');
	$.ajax({
		type: "POST",
		url: BASE_URL + 'ss_recruitment/SSController/get_additional_details_key_list',
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
					else if(data[index].parameters =='Absenteeism (HoW & Total calls condition)'){
						pt_html +='<option value="' + data[index].slab + ' | ' + data[index].points + '">' + data[index].slab + '</option>';
					}
                    else if(data[index].parameters =='Absenteeism (Actual Absent)'){
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
				$('#key_absenteeism').html(pt_html);
                $('#key_absenteeism_actual').html(in_html);
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

$('#ssKeyForm').submit(function(e) {
    
        var formData = new FormData(this);
        $.ajax({  
            url:BASE_URL + 'ss_recruitment/SSController/addssKeyForm', 
            method:"POST",  
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType:"json",
        
            success:function(data) {

                if(data.response =='success'){

                    $('#ssKeyForm')[0].reset();
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
    
});

/*datepicker*/
		var weekpicker, start_date, end_date;

		function set_week_picker(date) {
		    start_date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
		    end_date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
		    // weekpicker.datepicker('update', start_date);
		    weekpicker.val((start_date.getMonth() + 1) + '/' + start_date.getDate() + '/' + start_date.getFullYear() + ' - ' + (end_date.getMonth() + 1) + '/' + end_date.getDate() + '/' + end_date.getFullYear());
		}
		$(document).ready(function() {
		  weekpicker = $('.week-picker');
		  // console.log(weekpicker);
		  weekpicker.datepicker({
		  	// defaultDate: "+1w",
		  	// startDate : new Date(),
		  	// dateFormat: 'yyyy-mm-dd',
		  	todayHighlight : true,
		    autoclose: true,
		    forceParse: false,
		    container: '#week-picker-wrapper',
		  }).on("changeDate", function(e) {
		    set_week_picker(e.date);
		  });
		  $('.week-prev').on('click', function() {
		    var prev = new Date(start_date.getTime());
		    prev.setDate(prev.getDate() - 1);
		    set_week_picker(prev);
		  });
		  $('.week-next').on('click', function() {
		    var next = new Date(end_date.getTime());
		    next.setDate(next.getDate() + 1);
		    set_week_picker(next);
		  });
		  set_week_picker(new Date);
		});
		/*alert for excisting data*/
 $(function() {
            $("#key_date,#key_name").on("change",function(key_date,key_name){
            var key_date = $('#key_date').val().split('-');
            var startDate = moment(key_date[0]).format("YYYY/MM/DD");
            var key_name = $('#key_name').val();
             // console.log(startDate);
                $.ajax({  
		            url:BASE_URL + 'ss_recruitment/SSController/checkKeyDate', 
		            method:"POST",  
		             data: {"startDate": startDate, 
		         			"key_name": key_name,},
		            dataType:"json",
		        
		            success:function(data) {

		                if(data.response =='success'){

		                    // $('#rsKeyForm')[0].reset();
		                    $('.single-select').select2({
		                        theme: 'bootstrap4',
		                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
		                        placeholder: $(this).data('placeholder'),
		                        allowClear: Boolean($(this).data('allow-clear')),
		                    });
		                   
		    				$("#save_status").val("1");
		                    
		                    $('#hiddenbtm').attr("disabled", false);
		                    $('#reset-btn').click();
		                    // added_toast();
		                    
		                }
		                else{
		                    // request_failed();
		                    $('#hiddenbtm').attr("disabled", true);
		                    date_failed();
		                }
		                        
		            }  
		        });
            });
        });
