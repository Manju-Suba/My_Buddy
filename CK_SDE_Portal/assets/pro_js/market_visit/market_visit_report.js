$(document).ready(function () {
    // var role_type = $('#session_role_type').val();
    // show_filter_div(role_type);
    // get_business_list();
    get_entered_forms();
});

$("#from_date").on('change', function () {
    get_entered_forms();
});

function get_entered_forms() {
    var example = $('#example2').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'market_visit/SdeMarket/get_entered_market_visit_report',
            'data': function (d) {
                d.from_date =$('#from_date').val();
            }
        },
        "columns": [ 
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "m_rs" },
            { "data": "m_rssm" },
            { "data": "m_beat" },
            { "data": "total_calls_made" },
            { "data": "value" },
            { "data": "billut" },
            { "data": "tlsd" },
            // { "data": "m_feedback" },
            // { "data": "rssm_morn_image" },
            // { "data": "rssm_eve_image" },
            // { "data": "m_image" },
            // { "data": "created_by" },
            { "data": "created_on" },
            { "data": "end_date" },
            { "data": "action" },
        ],
        "columnDefs": [
            { "orderable": false, "targets": "_all" } // Applies the option to all columns
        ],
        "order": [
            [1, 'asc']
        ]
    });

}

$("#filterClearbtn").on('click', function () {
    $('#from_date').val("");
    get_entered_forms();

});

function show_pop_img(){
    var imgTag = event.target;
    var mySrc = imgTag.getAttribute('src');
    var modalImg = document.getElementById("pop_img_show");
    modalImg.src = mySrc;

    $('#popimgbtn').modal('show');
}

function get_adtdetails_viewpop(id){
   
    $.ajax({
        type: "POST",
        url: BASE_URL + 'market_visit/SdeMarket/get_sde_report_edit',
        data: { "id": id, },
        dataType:"json",
        success: function (data) {
            // alert(1);
            $("#edit_id").val(id);
            $("#edit_rssm").val(data["row"][0]['rssm_mkt']); 
            $("#edit_beat_mkt").val(data["row"][0]['beat_mkt']); 
			// $('#edit_rs_mkt').val(data["row"][0]['rs_mkt']);
			$('#edit_rs_mkt').val(data["smlist_result"][0]['rs_name']);

            $("#edit_total_calls").val(data["row"][0]['total_calls_made']);
            $("#edit_value").val(data["row"][0]['value']);
            $("#edit_billut").val(data["row"][0]['billut']);
            $("#edit_tlsd").val(data["row"][0]['tlsd']);
            // $("#edit_rssm_morn").val(data["row"][0]['rssm_file']);
            // $("#edit_rssm_eve").val(data["row"][0]['rssm_eve_file']);
            $("#edit_feedback").val(data["row"][0]['feedback']);
			
            var options = '';
			options +='<option value="">Select.. </option>';
			if(data.get_osm_list.length != 0){
				for (let j = 0; j < data.get_osm_list.length; j++) {

					if(data["row"][0]['rssm_mkt']== data.get_osm_list[j].ssfa_id){
						options += '<option data-data1="#ff8000" value="'+data.get_osm_list[j].ssfa_id+'" selected >ORG /'+data.get_osm_list[j].osm_name+'</option>';
					}else{
						options += '<option data-data1="#ff8000" value="'+data.get_osm_list[j].ssfa_id+'">ORG /'+data.get_osm_list[j].osm_name+'</option>';
					}
				}
			}
			if(data.get_without_OSM.length != 0){
				for (let i = 0; i < data.get_without_OSM.length; i++) {
					if(data["row"][0]['rssm_mkt']== data.get_without_OSM[i].sm_number){
			        	options += '<option data-data1="#87e787b0" value="'+data.get_without_OSM[i].sm_number+'" selected>NON /'+data.get_without_OSM[i].sm+'</option>';
					}else{
			        	options += '<option data-data1="#87e787b0" value="'+data.get_without_OSM[i].sm_number+'">NON /'+data.get_without_OSM[i].sm+'</option>';
					}
				}
			}
			$("#edit_rssm_mkt").html(options);

			var selection = $('#edit_rssm_mkt').find('option:selected');
			var data1 = selection.data('data1');
			document.getElementById('color_code').setAttribute( "class", 'box ' +data1 );
			document.getElementById('color_code').style.backgroundColor = data1;


            // var options1 = '';
			// options1 +='<option value="">Select..</option>';
			// for (var i = 0; i < data["beat_"].length; i++) {
            //     if(data["row"][0]['beat_mkt']==data["beat_"][i].beat_name){
            //         options1 += '<option value="' + data["beat_"][i].beat_name + '" selected>' + data["beat_"][i].beat_name + '</option>';
            //     }
            //     else{
            //         options1 += '<option value="' + data["beat_"][i].beat_name + '">' + data["beat_"][i].beat_name + '</option>';
            //     }
			// }
			// $("#edit_beat_mkt").html(options1);

            // var options2 = '';
			// options2 +='<option value="">Select..</option>';
			// for (var i = 0; i < data["rs_"].length; i++) {
            //     if(data["row"][0]['rs_mkt']==data["rs_"][i].rs_name){
            //         options2 += '<option value="' + data["rs_"][i].rs_name + '" selected>' + data["rs_"][i].rs_name + '</option>';
            //     }
            //     else{
            //         options2 += '<option value="' + data["rs_"][i].rs_name + '">' + data["rs_"][i].rs_name + '</option>';
            //     }
			// }
			// $("#edit_rs_mkt").html(options2);


            var rssm_morn = "";
            if(data["row"][0]['rssm_morn_file'] !=""){

                rssm_morn += '<div class="col-md-10">';
                rssm_morn += '<div class="card">';
                rssm_morn += `<a href="../uploads/market_visit/rssm_files/${data["row"][0]['rssm_morn_file']}" target="_blank"><img src="../uploads/market_visit/rssm_files/${data["row"][0]['rssm_morn_file']}" width="261" height="176" style="margin-left: 10px;margin-top: 10px; "></a>`;
                // rssm_morn += `<input type="button" data-data1 ="morn_img" onclick="myDelete(${data["row"][0]['id']})" id='delete_img' name="delete_img" class="btn-sm" style="background:red; float:right;margin-top: 8px; width:72px; margin-left: 198px; margin-bottom: 7px; " value="Remove" >`;
                rssm_morn += '</div>';
                rssm_morn += '</div>';
            }
          
            $('#rssm_mrg_img').html(rssm_morn);

            var rssm_even = "";
            if(data["row"][0]['rssm_eve_file'] !=""){

                rssm_even += '<div class="col-md-10">';
                rssm_even += '<div class="card">';
                rssm_even += `<a href="../uploads/market_visit/rssm_eve_files/${data["row"][0]['rssm_eve_file']}" target="_blank"><img src="../uploads/market_visit/rssm_eve_files/${data["row"][0]['rssm_eve_file']}" width="261" height="176" style="margin-left: 10px;margin-top: 10px; "></a>`;
                rssm_even +='<input type="hidden" class="form-control" name="edit_rssm_eve_file" id="edit_rssm_eve_file" value="0" />';
                
                // rssm_even += `<input type="button" data-data1 ="even_img" onclick="myDelete2(${data["row"][0]['id']})" id='delete_img2' name="delete_img2" class="btn-sm" style="background:red; float:right;margin-top: 8px; width:72px; margin-left: 198px; margin-bottom: 7px; " value="Remove" >`;
                rssm_even += '</div>';
                rssm_even += '</div>';
            }else{
                rssm_even ='<input type="file" class="form-control" name="edit_rssm_eve_file" id="edit_rssm_eve_file"  accept=".png, .jpg, .jpeg, .PNG, .JPG, .JPEG" />';
            }
          
            $('#rssm_eve_img').html(rssm_even);

            if( data["row"][0]['rssm_eve_file'] =="" || data["row"][0]['total_calls_made'] == "" || data["row"][0]['value'] == "" || data["row"][0]['billut'] == "" || data["row"][0]['tlsd'] == ""){
               $('#updat_smt_btn').css('display','block');

               $('#edit_feedback').css('pointer-events','auto');
               $('#edit_total_calls').css('pointer-events','auto');
               $('#edit_value').css('pointer-events','auto');
               $('#edit_billut').css('pointer-events','auto');
               $('#edit_tlsd').css('pointer-events','auto');

            }else{
               $('#edit_feedback').css('pointer-events','none');
               $('#edit_total_calls').css('pointer-events','none');
               $('#edit_value').css('pointer-events','none');
               $('#edit_billut').css('pointer-events','none');
               $('#edit_tlsd').css('pointer-events','none');
               $('#updat_smt_btn').css('display','none');
            }
            
        }
    });

    // $('#view_supervisor_comment').html(get_scomment);

    $('#popadtviewbtn').modal('show');

}

// function myDelete(id){
//     var pass = $('#delete_img').data("data1");
 
//     $.ajax({
//         url: BASE_URL+'market_visit/SdeMarket/delete_image',
//         type: "post",
//         dataType: 'json',
//         data:{id:id ,"pass":pass},
//         success: function(data) {
//             if(data.res=="success"){
//                 deleted_toast();
//                 get_adtdetails_viewpop(id);

//             }
            
//         }
//     })

// }

// function myDelete2(id){
//     var pass = $('#delete_img2').data("data1");
//     $.ajax({
//         url: BASE_URL+'market_visit/SdeMarket/delete_image',
//         type: "post",
//         dataType: 'json',
//         data:{id:id ,"pass":pass},
//         success: function(data) {
//             if(data.res=="success"){
//                 deleted_toast();
//                 get_adtdetails_viewpop(id);
//             }
//         }
//     })
// }


$('#updateBtn').click(function(e) {
    
    $('#updateBtn').attr("disabled", true);
    $("#updateBtn").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
    e.preventDefault();

    // edit_rssm_file1 = $("#edit_rssm_file").val();
    edit_rssm_eve_file1 = $("#edit_rssm_eve_file").val();

	var total_calls = $('#edit_total_calls').val();
	var edit_value = $('#edit_value').val();
	var edit_billut = $('#edit_billut').val();
	var edit_tlsd = $('#edit_tlsd').val();

    if( $("#edit_rssm_eve_file").val() != "" && total_calls !="" && edit_value !="" && edit_billut !="" && edit_tlsd !=""){

        if( $("#edit_rssm_eve_file").val() != "0" ){
            var edit_rssm_eve_file = $("#edit_rssm_eve_file")[0].files[0];
        }else{
            var edit_rssm_eve_file = '';
        }
        
        edit_id = $("#edit_id").val();
        edit_feedback = $("#edit_feedback").val();

        edit_total_calls = $("#edit_total_calls").val();
        edit_value       = $("#edit_value").val();
        edit_billut      = $("#edit_billut").val();
        edit_tlsd        = $("#edit_tlsd").val();

        var fd = new FormData();
        fd.append("edit_rssm_eve_file", edit_rssm_eve_file);
        fd.append("edit_id", edit_id);
        fd.append("edit_feedback", edit_feedback);

        fd.append("edit_total_calls", edit_total_calls);
        fd.append("edit_value", edit_value);
        fd.append("edit_billut", edit_billut);
        fd.append("edit_tlsd", edit_tlsd);
        
        $.ajax({  
            url:BASE_URL + 'market_visit/SdeMarket/update_sdeform', 
            method:"POST",  
            data: fd, 
            dataType:"json",
            processData: false,
            contentType: false, 

            success:function(data) {
                $('#image-required').html('');

                if(data.logstatus =='success'){
                    $('#updateBtn').html('End Market');
                    
                    updated_toast();
                    setTimeout(function(){
						$('#updateBtn').attr("disabled", false);
                        $('#updateModel').click();
                        get_entered_forms();
                    },2000);
                }
                else{
                    request_failed();
                    $('#updateBtn').attr("disabled", false);
                    $('#updateBtn').html('End Market');
                    
                }
            }  
        }); 

    }else{

		if($("#edit_rssm_eve_file").val() == ""){
        	$('#image-required').html('Please Fill this field!');
		}else{
			$('#all-required').html('All the field are required!');
		}

        setTimeout(function(){
            $('#all-required').html('');
            $('#image-required').html('');
        },3000);
        $('#all-required').css('color','red');
        $('#image-required').css('color','red');
        $('#updateBtn').attr("disabled", false);
        $('#updateBtn').html('End Market');
    }
});


