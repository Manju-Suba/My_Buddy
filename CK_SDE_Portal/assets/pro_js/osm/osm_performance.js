$(document).ready(function () {

    var role_type = $('#session_role_type').val();
    show_filter_div(role_type);

    get_osm_per_details();
	get_weekly_current_jc();
});


function get_osm_per_details() {

    var example = $('#osm_table').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': { 
            'url': BASE_URL + 'osm/OsmPerformance/get_osm_per_report',
            'data': function (d) {
                d.sm_number =$('#af_sm_list').val();
                d.jc_year_filter =$('#_year').val();
                d.jc_type =$('#jc_type').val();

            }
        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "osm_name" },
            { "data": "eco" },
            { "data": "planned_man_days" },
            { "data": "actual_man_days" },
            { "data": "per_man_days" },
            { "data": "calls_made_sum" },
            { "data": "calls_made_per_day" },
            { "data": "productive_calls_sum" },
            { "data": "productive_calls_per_day" },
            { "data": "productivity_percentage" },
            { "data": "total_bills_cut" },
            { "data": "bills_per_day" },
            { "data": "total_lines_sold" },
            { "data": "lines_sm_per_day" },
            // { "data": "created_date" },
            // { "data": "end_date" },
        ],
		"columnDefs": [
			{ "orderable": false, "targets": [0,1,2,3, 4, 5, 6,7 ,8,9,10,11,12,13,14] },
			{ "orderable": true, "targets": [] },
			{
				"targets": [0,2,3, 4, 5, 6,7 ,8,9,10,11,12,13,14], // your case first column
				"className": "text-center",
			},
		],
		"order": [
            [1, 'asc']
        ]
    });
}

function show_filter_div(role_type){
    var session_mobile = $('#session_mobile_no').val();

   	if(role_type =='TSO'){
        $('.lead_view').css({"display":"none"});
        $('.zsm_view').css({"display":"none"});
        $('.asm_view').css({"display":"none"});
        $('.tso_view').css({"display":"block"});
		$('.jc_view').css({"display":"block"});
        get_sm_list(session_mobile);
    }
    else{
        $('.lead_view').css({"display":"none"});
        $('.zsm_view').css({"display":"none"});
        $('.asm_view').css({"display":"none"});
		$('.jc_view').css({"display":"block"});
        get_osm_per_details();

    }
    
}

function get_sm_list(tso_number){
    if(tso_number ==''){
        var html = '<option value="">View All</option>';
        $('#af_sm_list').html(html);
        
    }else{
        $.ajax({
            type: "POST",
            url: BASE_URL + 'osm/OsmPerformance/get_sm_list',
            data: { "tso_number": tso_number, },
            dataType:"json",
            success: function (data) {

				var html = '<option value="">View All</option>';

				if(data.get_osm_list.length != 0){
					for (let j = 0; j < data.get_osm_list.length; j++) {
                        html += '<option value="'+data.get_osm_list[j].ssfa_id+'" style="color:#ff5e00fa;">'+data.get_osm_list[j].osm_name+'</option>';
                    }
				}

                // if(data.get_without_OSM.length != 0){
				// 	for (let i = 0; i < data.get_without_OSM.length; i++) {
                //         html += '<option value="'+data.get_without_OSM[i].sm_number+'" style="color:green;">'+data.get_without_OSM[i].sm+'</option>';
                //     }
				// }
                $('#af_sm_list').html(html);

                
            }
        });
    }
}


$("#af_sm_list").on('change', function () {

	var report_format = $('#beat_format').val();
	if(report_format == "weekly"){
		get_weekly_current_jc();
	}else if(report_format == "daily"){
		com_calen_filter();
	}else{
		get_osm_per_details();
	}
});

$("#jc_type").on('change', function () {
	get_osm_per_details();
});


$("#filterClearbtn").on('click', function () {
    $('#af_sm_list').val("");

	var currentYear = new Date().getFullYear();
	n = new Date().getMonth();
	if( (n+1) <= 3){
		var next = currentYear-1;
		var year = next + '-' + currentYear.toString().slice(-2);
	}else{
		var next = currentYear+1;
		var year = currentYear + '-' + next.toString().slice(-2);
	}

    $('#_year').val(year);

	var month_numeric = ['01','02','03','04','05','06','07','08','09','10','11','12'];
	var jc_s = ['JC10','JC11','JC12','JC01','JC02','JC03','JC04','JC05','JC06','JC07','JC08','JC09'];
	var obj = Object.assign({}, ...month_numeric.map((e, i) => ({[e]: jc_s[i]})));

	let date = new Date();
	var jc_month = ("0" + (date.getMonth() + 1)).slice(-2);
	var jc_typ = obj[jc_month];

    $('#jc_type').val(jc_typ);

	var report_format = $('#beat_format').val();
	if(report_format == "weekly"){
		get_weekly_current_jc();
	}else if(report_format == "daily"){
		com_calen_filter();
	}else{
		get_osm_per_details();
	}
});

function get_weekly_current_jc() {

	var div ='<button class="btn" style="background-color: #424c4bf2;color: white;" disabled><span class="spinner-border spinner-border-sm"></span> processing...</button>';

	$('#loading_card').html(div);

    $.ajax({
        type: "POST",
        url: BASE_URL + 'osm/OsmPerformance/get_sde_weekly_current_jc',
        data: {
			"sm_number" :$('#af_sm_list').val(),
		},
        dataType: "json",
        success: function (data) {
			$('#weekly_current_jc').html(data.htmlcurr_jc);
			$('#weekly_current_jc1').html(data.htmlcurr_jc1);
			$('#weekly_current_jc2').html(data.htmlcurr_jc2);

			$('#loading_card').html('');
        }
    });
}


/// Calender part start///
function com_calen_filter(){

    var events = {
        url:BASE_URL + "osm/fullcalendar/load",
        type: 'POST',
        data: {
            asm_filter :$('#af_asm_list').val(),
            tso_filter :$('#af_tso_list').val(),
            sm_filter :$('#af_sm_list').val(),
        }
    }

    $('#calendar').fullCalendar('removeEventSources');
    $('#calendar').fullCalendar('refetchEvents');
    $('#calendar').fullCalendar('addEventSource', events);
	
}
/// Calender part end///


