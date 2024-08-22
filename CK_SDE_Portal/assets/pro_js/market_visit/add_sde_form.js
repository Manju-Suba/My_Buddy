$(document).ready(function () {
    var role_type = $('#session_role_type').val();
    // show_filter_div(role_type);
});
 
// function show_filter_div(role_type){
   
//     if(role_type =='TSO'){
//         get_sm_list();
//     }else{
//         get_sm_list();
//     }
// }

$('#mForm').submit(function(e) {
    
    $('#saveBtn').attr("disabled", true);
    $("#saveBtn").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
    e.preventDefault();
    
    var formData = new FormData(this);
    $.ajax({  
        url:BASE_URL + 'market_visit/SdeMarket/addsdeForm', 
        method:"POST",  
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",
    
        success:function(data) {

            if(data.logstatus =='success'){

                $('#mForm')[0].reset();
                $('.single-select').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                
                
                $('#saveBtn').attr("disabled", true);
                $('#saveBtn').html('Saved');
                
                added_toast();

				setTimeout(
					function() {
						window.location = BASE_URL + 'sde_market_report';
						// window.location = BASE_URL + 'SdeMarket/sde_market_report';

					}, 2000);

                
            }
            else{
                request_failed();
                $('#saveBtn').attr("disabled", false);
                $('#saveBtn').html('Save');
                
            }
                    
        }  
    }); 
    
    
});


$("#rs_mkt").on('change', function() {
	var selection = $(this).find('option:selected');
	var rs_val = $(this).val();
	get_sm_list(rs_val);

});

function get_sm_list(rs_val){
   
	$.ajax({
		type: "POST",
		url: BASE_URL + 'market_visit/SdeMarket/get_sm_rssm_list',
		data: { "rs_val": rs_val, },
		dataType:"json", 
		success: function (data) {
			var html = '<option value="">Select..</option>';

			if(data.get_osm_list.length != 0){
				for (let j = 0; j < data.get_osm_list.length; j++) {
					html += '<option data-data1="#ff8000" value="'+data.get_osm_list[j].ssfa_id+'" style="color:#ff5e00fa;">ORG /'+data.get_osm_list[j].osm_name+'</option>';
				}
			}
			if(data.get_without_OSM.length != 0){
				for (let i = 0; i < data.get_without_OSM.length; i++) {
			        html += '<option data-data1="#87e787b0" value="'+data.get_without_OSM[i].sm_number+'" style="color:green;">NON /'+data.get_without_OSM[i].sm+'</option>';
			    }
			}
			$('#rssm_mkt').html(html);
		}
	});
}


function get_beat_list(rssm_number){
	$.ajax({
		type: "POST",
		url: BASE_URL + 'market_visit/SdeMarket/get_rssm_beatlist',
		data: { "rssm_number": rssm_number, },
		dataType:"json", 
		success: function (data) {
			var html = '<option value="">Select..</option>';

			if(data.beat_mkt.length != 0){
				for (let i = 0; i < data.beat_mkt.length; i++) {
					html += '<option value="'+data.beat_mkt[i].beat_name+'">'+data.beat_mkt[i].beat_name+'</option>';
				}
			}
			$('#beat_mkt').html(html);
		}
	});
}
