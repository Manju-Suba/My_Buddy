$(document).ready(function () {

    // var tso_number = $('#session_mobile_no').val();
    // get_sm_list(tso_number);
   


    var role = $('#session_role_type').val();
    if(role == 'TSO'){
        var tso_number = $('#session_mobile_no').val();
        get_sm_list(tso_number);

    }else if(role == 'ASM'){
        var asm_num = $('#session_mobile_no').val();
        get_tso_list(asm_num);

    }else if(role == 'ZSM' ){
        var zsm_num = $('#session_mobile_no').val();
		var business = $('#business').val();
        get_asm_list(zsm_num,business);

    // }else if(role == 'LEADER'){
    //     get_business_list();
        // get_zsm_list();
    }

});


$('#tso_mobile').on('change',function(){
    var tso_number = $('#tso_mobile').val();
    sm_data();
    get_sm_list(tso_number);
})

$('#asm_mobile').on('change',function(){
    var html = '<option value="" selected disabled>Select.. </option>';
    $('#role_sm').html(html);

    sm_data();
    var asm_number = $('#asm_mobile').val();
    get_tso_list(asm_number);
})

$('#zsm_mobile').on('change',function(){
    var html = '<option value="" selected disabled>Select.. </option>';
    $('#role_sm').html(html);
    $('#tso_mobile').html(html);

    sm_data();
    var zsm_number = $('#zsm_mobile').val();
    var business = $('#business').val();

    get_asm_list(zsm_number,business);

})

$('#business').on('change',function(){
    var html = '<option value="" selected disabled>Select.. </option>';
    $('#role_sm').html(html);
    $('#tso_mobile').html(html);
    $('#asm_mobile').html(html);
	var role = $('#session_role_type').val();
    sm_data();
    var business = $('#business').val();
	if(role == 'ZSM' ){
        var zsm_num = $('#session_mobile_no').val();
		get_asm_list(zsm_num,business);
	}else{
		get_zsm_list(business);

	}

})

function get_sm_list(tso_number){
    $.ajax({
        type: "POST",
        url: BASE_URL + 'fivesec_scorecard/FivesecScorecard/get_sm',
        data: { "tso_number": tso_number, },
        dataType:"json",
        success: function (data) {
            if(data.length != 0){
                var html = '<option value="" selected disabled>Select SM</option>';
                for (let index = 0; index < data.length; index++) {
                    html += '<option data-id="'+data[index].division+'" data-sm="'+data[index].sm+'" value="'+data[index].sm_number+'">'+data[index].sm+' / '+data[index].sm_number+' / '+data[index].division+' </option>';
                }
                
                $('#role_sm').html(html);
            }
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
				var html = '<option value="" selected disabled>Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].tso_number + '">' + data[index].tso + '</option>';
				}

				$('#tso_mobile').html(html);

			}
		}
	});
    
}

function get_asm_list(zsm_num,business){
	// alert(business);
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
				var html = '<option value="" selected disabled>Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].asm_number + '">' + data[index].asm + '</option>';
				}

				$('#asm_mobile').html(html);

			}
		}
	});
    
}

function get_zsm_list(business){
    $.ajax({
		type: "POST",
		url: BASE_URL + 'fivesec_scorecard/FivesecScorecard/get_zsm_list',
		data: {
			// "zsm_number": zsm_number,
			"business": business,
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="" selected disabled>Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].zsm_number + '">' + data[index].zsm + '</option>';
				}

				$('#zsm_mobile').html(html);

			}
		}
	});
    
}

function get_business_list(){
    $.ajax({
		type: "POST",
		url: BASE_URL + 'fivesec_scorecard/FivesecScorecard/get_business_list',
		data: {
			
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="" selected disabled>Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].business + '">' + data[index].business + '</option>';
				}

				$('#business').html(html);

			}
		}
	});
    
}


function sm_data(){
    var sm_val = $('#role_sm').val();
    if (sm_val === "" || sm_val === null) {
        $('.container').css('display','none');
        $('#title_div').css('display','none');
    }else{
        $('.container').css('display','block');
        $('#title_div').css('display','block');
    }
}