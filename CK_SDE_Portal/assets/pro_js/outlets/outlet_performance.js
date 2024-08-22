var role = $('#role').val();
if(role == 'TSO'){
    $(document).ready(function(){
        var sde_number = $('#mobile_no').val();
        view_dropdown(sde_number);
        // get_tso_list();
    })
}else if(role == 'ASM'){
    $(document).ready(function(){
        var asm_num = $('#mobile_no').val();
        
        get_tso_list(asm_num);
    })
}else if(role == 'ZSM'){
    $(document).ready(function(){
        var zsm_num = $('#mobile_no').val();
        
        // get_asm_list(zsm_num);
    })
}else if(role == 'LEADER'|| role =='VA' || role=='Division Head'){
    $(document).ready(function(){
        
        // get_zsm_list();
    })
}

function view_dropdown(sde_number){
   
console.log(sde_number);
    $.ajax({
        type: "POST",
        url: BASE_URL + 'outlet_performance/OutletController/get_outlet',
        data: {
            "sde_number": sde_number
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var option ="<option id='select'>Select...</option>";
            if(data != ''){
                for(var i = 0 ; i < data.length ; i++ ){
                    option +='<option value ="'+data[i].outlet_code+'">'+data[i].outlet_name+'</option>';
                }
            }
            $('#outlet').html(option) ;

        }
    });
    
}

function get_tso_list(asm_num){
    $.ajax({
		type: "POST",
		url: BASE_URL + 'outlet_performance/OutletController/get_tso_list',
		data: {
			// "zsm_number": zsm_number,
			"asm_number": asm_num,
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].tso_number + '">' + data[index].tso + '</option>';
				}

				$('#tso_mobile').html(html);

			}
		}
	});
    
}

function get_asm_list(zsm_num,business){
    $.ajax({
		type: "POST",
		url: BASE_URL + 'outlet_performance/OutletController/get_asm_list',
		data: {
			"business": business,
			"zsm_number": zsm_num,
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].asm_number + '">' + data[index].asm + '</option>';
				}

				$('#asm_mobile').html(html);

			}
		}
	});
    
}
$('#business').on('change',function(){
    var html = '<option value="" selected disabled>Select.. </option>';
    $('#role_sm').html(html);
    $('#tso_mobile').html(html);
    $('#asm_mobile').html(html);
	var role = $('#session_role_type').val();
    var business = $('#business').val();
	if(role == 'ZSM' ){
        var zsm_num = $('#session_mobile_no').val();
		get_asm_list(zsm_num,business);
	}else{
		get_zsm_list(business);

	}

})
function get_zsm_list(business){
    $.ajax({
		type: "POST",
		url: BASE_URL + 'outlet_performance/OutletController/get_zsm_list',
		data: {
			"business": business,
			
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].zsm_number + '">' + data[index].zsm + '</option>';
				}

				$('#zsm_mobile').html(html);

			}
		}
	});
    
}

$('#tso_mobile').on('change',function(){
    var sde_number = $('#tso_mobile').val();

    view_dropdown(sde_number);
})

$('#asm_mobile').on('change',function(){
    var asm_number = $('#asm_mobile').val();

    get_tso_list(asm_number);
})

$('#zsm_mobile').on('change',function(){
    var zsm_number = $('#zsm_mobile').val();
    var business = $('#business').val();

    get_asm_list(zsm_number,business);
})



$('#outlet').on('change',function(){
    $('#select').attr('disabled','')
    $('#tables').removeClass('d-none');
    var outlet =$('#outlet').val();
    view_table(outlet);
    $('#r1count').text('');
    $('#r1billed').text('');
    $('#r1billed_per').text('');
    $('#r1billed_count').text('');
    $('#r1val_tar').text('');
    $('#r1value_ach').text('');
    $('#r1value_ach_per').text('');
    $('#r2count').text('');
    $('#r2billed').text('');
    $('#r2billed_per').text('');
    $('#r2val_tar').text('');
    $('#r2billed_count').text('');
    $('#r2val_tar').text('');
    $('#r2value_ach').text('');
    $('#r2value_ach_per').text('');

    $('#jc_avg').text('');
    $('#jc_tar').text('');
    $('#jtd_ach').text('');
    $('#ach_per').text('');
    $('#balance').text('');
    $('#billed_jc').text('');


  
    // view_outlet(outlet);
});

function view_table(outlet){
    var sde_number = $('#tso_mobile').val();
    $.ajax({
        type: "POST",
        url: BASE_URL + 'outlet_performance/OutletController/get_details',
        data: {
            "outlet": outlet,
            "sde_number": sde_number
        },
        dataType: "json",
        success: function (data) {
            console.log(data.length);
            console.log(data[0]['3_jc_average']);
            // console.log(data.outlet_name);
//'+data[0].outlet_name+'

            if(data != ''){
                for( var i=0; i<data.length ; i++ ){
                    if(data[i].retailer_program =="R1 - Rising Star" ){
                        $('.so').addClass('d-none');
                        $('.rs').removeClass('d-none');

                        $('#r1count').text(data[i].count);
                        $('#r1billed').text(data[i].billed);
                        $('#r1billed_per').text(data[i].billed_percentage);
                        $('#r1billed_count').text(data[i].ljc_billed_count);
                        $('#r1val_tar').text(data[i].value_target);
                        $('#r1value_ach').text(data[i].value_ach_jtd);
                        $('#r1value_ach_per').text(data[i].value_ach_percentage);
                        // $('#r1balance').text(data[i].count);
                        // $('#r1val_ach_lmtd').text(data[i].count);
                        // $('#r1growth_over_lmtd').text(data[i].count);
                    }
                    if(data[i].retailer_program =="R2 - Smart Outlets" ){
                        $('.rs').addClass('d-none');
                        $('.so').removeClass('d-none');

                        $('#r2count').text(data[i].count);
                        $('#r2billed').text(data[i].billed);
                        $('#r2billed_per').text(data[i].billed_percentage);
                        $('#r2billed_count').text(data[i].ljc_billed_count);
                        $('#r2val_tar').text(data[i].value_target);
                        $('#r2value_ach').text(data[i].value_ach_jtd);
                        $('#r2value_ach_per').text(data[i].value_ach_percentage);
                        // $('#r2balance').text(data[i].count);
                        // $('#r2val_ach_lmtd').text(data[i].count);
                        // $('#r2growth_over_lmtd').text(data[i].count);
                    }
                }
            }
           
            
            // var html1 =""

            if(data!= ''){
                $('#jc_avg').text(data[0]['3_jc_average']);
                $('#jc_tar').text(data[0].jc_target);
                $('#jtd_ach').text(data[0].jtd_ach);
                $('#ach_per').text(data[0].ach_percentage);
                $('#balance').text(data[0].balance_to_be_done);
                $('#billed_jc').text(data[0].billed_in_jc);
               
            }
             
        //    $('#outlet_table').html(html);      
        //    $('#retailer_data').html(html1);             

        }
    });
}
// function view_outlet(outlet){
//     var sde_number = $('#mobile_no').val();
//     $.ajax({
//         type: "POST",
//         url: BASE_URL + 'OutletController/OutletController',
//         data: {
//             "outlet": outlet,
//             "sde_number": sde_number
//         },
//         dataType: "json",
//         success: function (data) {
//             console.log(data);

//         }
//     });

// }