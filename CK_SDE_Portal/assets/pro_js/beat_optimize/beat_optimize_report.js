$(document).ready(function () {
    get_beat_optimize_details();
	beat_report_details();
	sde_beat_report_details();
});


$("#reset").on('click', function(){
	$("#sde_number").val("");
	$("#asm_number").val("");

	var role_type = $('#session_role_type').val();
	var html = '<option value="">View All</option>';

	if(role_type =='ZSM'){
        $('#sde_number').html(html);
	}
	get_beat_optimize_details();
	beat_report_details();
})

$("#sde_number").on('change', function(){
	get_beat_optimize_details();
	beat_report_details();
})

function get_beat_optimize_details() {

    var example = $('#beat_report_table').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'beat_optimize/BeatOptimizationController/get_beat_optimize_report',
            'data': function (d) {
				d.session_user_name =$('#session_user_name').val();
				d.asm_number =$('#asm_number').val();
				d.sde_number =$('#sde_number').val();
            }
        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "dist_cus_code" },
            { "data": "cmp_cus_code" },
            { "data": "outlet_name" },
            { "data": "old_route_code" },
            { "data": "new_route_code" },
            { "data": "new_suggestive_route_code" },
            { "data": "new_suggestive_route_name" },
            { "data": "outlet_must_visit" },
            { "data": "beat_frequency" },
            { "data": "outlet_score" },
            { "data": "zm" },
            { "data": "am" },
            { "data": "sde_emp_code" },
            { "data": "sde_name" },
            { "data": "salesman_name" },
            { "data": "salesman_ssfa_id" },
            { "data": "new_route_code2" },
            { "data": "new_beat_name" },
            { "data": "final_beat_frequency" },
            { "data": "visit_day" },
            { "data": "comments" },
            // { "data": "action" },
            { "data": "created_date" },
            { "data": "end_date" },
        ],
        "columnDefs": [
            { "orderable": false, "targets": "_all" } // Applies the option to all columns
        ],
        "order": [
            [1, 'asc']
        ]
    });

}


$('#uploadForm').submit(function(e) {

	var beat_upload_type =$('#beat_upload_type').val();
	var m_file =$('#m_file').val();
	// if(beat_upload_type !=="" && m_file !=="" ){

	// }
    
   
    e.preventDefault();
    
    var formData = new FormData(this);
    $.ajax({  
        url:BASE_URL + 'beat_optimize/BeatOptimizationController/beat_excel_upload', 
        method:"POST",  
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",
    
        success:function(data) {

            if(data.logstatus =='success'){

                $('#uploadForm')[0].reset();
				// $('#myModal').fadeOut();
				$('#myModal').modal('hide');
				beat_added_toast();
				sde_beat_report_details();
                get_beat_optimize_details();
            }
			if(data.logstatus =='success_'){

                $('#uploadForm')[0].reset();
				// $('#myModal').fadeOut();
				$('#myModal').modal('hide');
				beat_overwrite_toast();
				sde_beat_report_details();
                get_beat_optimize_details();
            }
			if(data.logstatus =='error'){
				excel_fields_required();
				$('#uploadForm')[0].reset();
			}
        }  
    }); 
});



function beat_report_details() {
    var example = $('#beat_report_vw').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false, 

        'ajax': {
            'url': BASE_URL + 'beat_optimize/BeatOptimizationController/get_beat_optimize_report',
            'data': function (d) {
				d.session_user_name =$('#session_user_name').val();
				d.sde_number =$('#sde_number').val();
				d.asm_number =$('#asm_number').val();
            }
        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "dist_name" },
            { "data": "dist_cus_code" },
            { "data": "tso" },
            { "data": "no_of_outlets" },
            { "data": "status" },
        ],
        "columnDefs": [
			{ "orderable": false, "targets": [0,2,4,5] },
			{ "orderable": true, "targets": [1,3] },
			{
				"targets": [4,5], // your case first column
				"className": "text-center",
			},
		],
    });
}

$("#asm_number").on('change', function(){

	var asm_number = $('#asm_number').val();

	var html = '<option value="">View All</option>';
	$('#sde_number').html(html);
	get_beat_optimize_details();
	beat_report_details();
	get_sde_list(asm_number);
})


function get_sde_list(asm_number){

    if(asm_number ==''){
        var html = '<option value="">View All</option>';
        $('#sde_number').html(html);
    }else{

        $.ajax({
            type: "POST",
            url: BASE_URL + 'beat_optimize/BeatOptimizationController/get_sde_list',
            data: { "asm_number": asm_number, },
            dataType:"json",
            success: function (data) {
                if(data.length != 0){
                    var html = '<option value="">View All</option>';
                    for (let index = 0; index < data.length; index++) {
                        html += '<option value="'+data[index].tso_number+'">'+data[index].tso+'</option>';
                    }
                    
                    $('#sde_number').html(html);

                }
            }
        });
    }

}

function sde_beat_report_details() {
    var example = $('#beat_report_vw_sde').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false, 

        'ajax': {
            'url': BASE_URL + 'beat_optimize/BeatOptimizationController/get_beat_optimize_report',
            'data': function (d) {
				d.session_user_name =$('#session_user_name').val();
				d.sde_number =$('#sde_number').val();
				d.asm_number =$('#asm_number').val();
            }
        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "dist_name" },
            { "data": "dist_cus_code" },
            { "data": "no_of_outlets" },
            { "data": "status" },
        ],
        "columnDefs": [
			{ "orderable": false, "targets": [0,2,3,4] },
			{ "orderable": true, "targets": [1] },
			{
				"targets": [3,4], // your case first column
				"className": "text-center",
			},
		],
    });
}
