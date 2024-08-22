var BASE_URL = "<?php echo base_url();?>index.php/";


$(document).ready(function(){

    var role_type = $('#session_role_type').val();
    show_filter_div(role_type);

    $(".metismenu li").removeClass('mm-active');
    var page = "market_report";

    if (page == "market_report") {
        $(".eform_report").addClass("mm-active");
    }

    var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:''
        },
        events:BASE_URL + "market_visit/fullcalendar/load",
        selectable:true,
        selectHelper:true,
		// displayEventTime : false,
        timeFormat: '(h:mm)A',
        eventClick:function(event)
        {
            
            var id = event.id; 
            $.ajax({
                url:BASE_URL + "market_visit/fullcalendar/view",
                type:"POST",
                data:{id:id},
                dataType:"json",
                success:function(data)
                {
                    if( data['rssm_name'].length != '0'){
                        $('.card').addClass('orange_card');
                        $('.card').removeClass('green_card');
						$('#rssm_mkt').html(data['rssm_name'][0]['osm_name']);

                    }else{
                        $('.card').addClass('green_card');
                        $('.card').removeClass('orange_card');
						$('#rssm_mkt').html(data['out_rssm_name'][0]['username']);
                    }

                    $('#cret_time').html(data['cret_time']);
                    // var dddd = data['cret_time'];

                    $('#auto_id').html(data['get_data'][0]['auto_id']);
                    $('#beat_mkt').html(data['get_data'][0]['beat_mkt']);
                    $('#rs_mkt').html(data['rs_name'][0]['rs_name']);
                    $('#total_calls_mkt').html(data['get_data'][0]['total_calls_made']);
                    $('#value_mkt').html(data['get_data'][0]['value']);
                    $('#billut_mkt').html(data['get_data'][0]['billut']);
                    $('#tlsd_mkt').html(data['get_data'][0]['tlsd']);
                    $("#edit_feedback").val(data["get_data"][0]['feedback']);

                    var rssm_morn = "";
                    if(data["get_data"][0]['rssm_morn_file'] !=""){

                        rssm_morn += '<div class="col-md-12">';
                        // rssm_morn += '<div class="card">';
                        rssm_morn += `<a href="../uploads/market_visit/rssm_files/${data["get_data"][0]['rssm_morn_file']}" target="_blank"><img src="../uploads/market_visit/rssm_files/${data["get_data"][0]['rssm_morn_file']}" width="200" height="150" style="margin-left: -15px;margin-top: 6px; "></a>`;
                        // rssm_morn += '</div>';
                        rssm_morn += '</div>';
                    }
  
                    $('#rssm_mrg_img').html(rssm_morn);

                    var rssm_even = "";
                    if(data["get_data"][0]['rssm_eve_file'] !=""){

                        rssm_even += '<div class="col-md-12">';
                        // rssm_even += '<div class="card">';
                        rssm_even += `<a href="../uploads/market_visit/rssm_eve_files/${data["get_data"][0]['rssm_eve_file']}" target="_blank"><img src="../uploads/market_visit/rssm_eve_files/${data["get_data"][0]['rssm_eve_file']}" width="200" height="150" style="margin-left: -15px;margin-top: 6px; "></a>`;
                        // rssm_even += '</div>';
                        rssm_even += '</div>';
                    }
                
                    $('#rssm_eve_img').html(rssm_even);
 
                    $('#popbtn').modal('show');
                }
            }) 
        }
    });
});

$("#af_tso_list").on('change', function () {
    var tso_number = $('#af_tso_list').val();
    var sm_number = $('#af_sm_list').val('');

    com_calen_filter();
});



$("#af_asm_list").on('change', function () {
    var asm_number = $('#af_asm_list').val();
    var zsm_number = $('#af_zsm_list').val();

    get_tso_list(asm_number,zsm_number);
    get_sm_list(asm_number);

    com_calen_filter();
});

$("#af_zsm_list").on('change', function () {
    var zsm_number = $('#af_zsm_list').val();
    var business_value = $('#af_business_list').val();

    var html = '<option value="">Select</option>';
    $('#af_tso_list').html(html);
    $('#af_sm_list').html(html);
    get_asm_list(business_value,zsm_number);

    com_calen_filter();
});

$("#af_sm_list").on('change', function () {
    var tso_number = $('#af_tso_list').val('');
    com_calen_filter();
});


function com_calen_filter(){
    var events = {
        url:BASE_URL + "market_visit/fullcalendar/load2",
        type: 'POST',
        data: {
            zsm_filter :$('#af_zsm_list').val(),
            asm_filter :$('#af_asm_list').val(),
            tso_filter :$('#af_tso_list').val(),
            sm_filter :$('#af_sm_list').val(),
        }
    }

	$('#calendar').fullCalendar('removeEventSources');
    $('#calendar').fullCalendar('refetchEvents');
    $('#calendar').fullCalendar('addEventSource', events);
}


$("#filterClearbtn").on('click', function () {

    $('#af_zsm_list').val("");
    $('#af_asm_list').val("");
    $('#af_tso_list').val("");
    $('#af_sm_list').val("");

	var role_type = $('#session_role_type').val();
	var html = '<option value="">Select</option>';

	if(role_type =='ZSM'){
        $('#af_tso_list').html(html);
        $('#af_sm_list').html(html);
	}

    events = BASE_URL + "market_visit/fullcalendar/load",
    $('#calendar').fullCalendar('removeEventSources');
    $('#calendar').fullCalendar('refetchEvents');
    $('#calendar').fullCalendar('addEventSource', events);
});

function show_filter_div(role_type){
    var session_mobile = $('#session_mobile_no').val();
    var business = $('#session_business').val();


    if(role_type =='LEADER' || role_type =='admin' ){
        $('.busi_view').css({"display":"block"});
        $('.asm_view').css({"display":"block"});
        $('.zsm_view').css({"display":"block"});
        $('.lead_view').css({"display":"block"});
        $('.tso_view').css({"display":"block"});
        // get_zsm_list();
        get_business_list();

    }
    else if(role_type =='ZSM' ){
        $('.busi_view').css({"display":"block"});
        $('.lead_view').css({"display":"none"});
        $('.asm_view').css({"display":"none"});
        $('.zsm_view').css({"display":"block"});
        get_business_list();

        // get_asm_list(session_mobile);

    }
    else if(role_type =='Division_Head' ){
        $('.dh_view').css({"display":"block"});
        // $('.lead_view').css({"display":"none"});
        $('.asm_view').css({"display":"none"});
        $('.zsm_view').css({"display":"block"});

        get_zsm_list(business);

    }
    else if(role_type =='ASM'){
        $('.busi_view').css({"display":"block"});
        $('.lead_view').css({"display":"none"});
        $('.zsm_view').css({"display":"none"});
        $('.asm_view').css({"display":"block"});
        get_tso_list(session_mobile);

    }
    else if(role_type =='TSO' || role_type =='SM' ){
        $('.lead_view').css({"display":"none"});
        $('.zsm_view').css({"display":"none"});
        $('.asm_view').css({"display":"none"});
        $('.tso_view').css({"display":"none"});
        $('.busi_view').css({"display":"none"});

        get_sm_list(session_mobile);

    }
    else{
        $('.lead_view').css({"display":"none"});
        $('.zsm_view').css({"display":"none"});
        $('.asm_view').css({"display":"none"});
        $('#calendar').fullCalendar('refetchEvents');
    }
} 

function get_zsm_list(business_value){
alert(business_value);

    $.ajax({
        type: "POST",
        url: BASE_URL + 'market_visit/SdeMarket/get_zsm_list',
        data: { "business_value": business_value, },
        dataType:"json",
        success: function (data) {
            if(data.length != 0){
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += '<option value="'+data[index].zsm_number+'">'+data[index].zsm+'</option>';
                }
                
                $('#af_zsm_list').html(html);
              
            }
        }
    });
}

$("#af_business_list").on('change', function () {
    var role_type = $('#session_role_type').val();
    var business_value = $('#af_business_list').val();
    if(role_type == "LEADER" ||role_type == "Leader" || role_type == 'admin'){
        get_zsm_list(business_value);
    }else if(role_type == "ZSM"){
        var session_mobile = $('#session_mobile_no').val();
        get_asm_list(business_value,session_mobile);
    }
});

function get_business_list(){

    $.ajax({
        type: "POST",
        url: BASE_URL + 'market_visit/SdeMarket/get_business_list',
        // data: { "business_value": business_value, },
        dataType:"json",
        success: function (data) {
            if(data.length != 0){
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    if(data[index].business != 'BPO - Operations'){
                        html += '<option value="'+data[index].division+'">'+data[index].division+'</option>';
                    }
                }
                
                $('#af_business_list').html(html);
              
            }
        }
    });
}


function get_asm_list(business,zsm_number){
    
    if(zsm_number ==''){
        var html = '<option value="">Select</option>';
        $('#af_asm_list').html(html);
        $('#af_tso_list').html(html);
        $('#af_sm_list').html(html);
    }else{

        $.ajax({
            type: "POST",
            url: BASE_URL + 'market_visit/SdeMarket/get_asm_list',
            data: { 
                "zsm_number": zsm_number,
                "business": business,
             },
            dataType:"json",
            success: function (data) {
                if(data.length != 0){
                    var html = '<option value="" selected disabled>Select</option>';
                    for (let index = 0; index < data.length; index++) {
                        html += '<option value="'+data[index].asm_number+'">'+data[index].asm+'</option>';
                    }
                    
                    $('#af_asm_list').html(html);
                }
            }
        });
    }

}


function get_tso_list(asm_number,zsm_number){
    if(asm_number ==''){
        var html = '<option value="">Select</option>';
        $('#af_tso_list').html(html);
        $('#af_sm_list').html(html);
    }else{

        $.ajax({
            type: "POST",
            url: BASE_URL + 'market_visit/SdeMarket/get_tso_list',
            data: {
                 "asm_number": asm_number,
                 "zsm_number": zsm_number
                 },
            dataType:"json",
            success: function (data) {
                if(data.length != 0){
                    var html = '<option value="" selected disabled>Select</option>';
                    for (let index = 0; index < data.length; index++) {
                        html += '<option value="'+data[index].tso_number+'">'+data[index].tso+'</option>';
                    }
                    
                    $('#af_tso_list').html(html);
                }
            }
        });

        get_sm_list(asm_number);

    }

}


function get_sm_list(asm_number){
    if(asm_number ==''){
        var html = '<option value="">Select</option>';
        $('#af_sm_list').html(html);
        
    }else{

        $.ajax({
            type: "POST",
            url: BASE_URL + 'market_visit/SdeMarket/get_sm_list',
            data: { "asm_number": asm_number, },
            dataType:"json",
            success: function (data) {
                if(data.length != 0){
                    var html = '<option value="" selected disabled>Select</option>';
                    for (let index = 0; index < data.length; index++) {

						if(data[index].sm_number !=""){
							html += '<option value="'+data[index].sm_number+'">'+data[index].sm+'</option>';
						}
                    }
                    
                    $('#af_sm_list').html(html);
                }
            }
        });
    }

}
