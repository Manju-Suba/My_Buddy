$(document).ready(function () {
    get_sde_incentive_urban_val();
});

$("#zsm_name").on('change', function(){
	var zsm_name = $('#zsm_name').val();
	get_sde_incentive_urban_val();
	get_asm_list(zsm_name);

})

$("#asm_name").on('change', function(){
	var zsm_name = $('#zsm_name').val();
    var asm_name = $('#asm_name').val();
	get_sde_incentive_urban_val();
    get_sde_list(zsm_name,asm_name);


})

$("#sde_name").on('change', function(){
	get_sde_incentive_urban_val();
})


$("#jc_type").on('change', function(){
	get_sde_incentive_urban_val();
})

function get_asm_list(zsm_name){
    if(zsm_name ==''){
        var html = '<option value="">Select</option>';
        $('#asm_name').html(html);
    }else{

        $.ajax({
            type: "POST",
            url: BASE_URL + 'incentive/SdeIncentive/get_asm_list',
            data: { "zsm_name": zsm_name, },
            dataType:"json",
            success: function (data) {
                if(data.length != 0){
                    var html = '<option value="">Select</option>';
                    for (let index = 0; index < data.length; index++) {
                        html += '<option value="'+data[index].asm+'">'+data[index].asm+'</option>';
                    }
                    
                    $('#asm_name').html(html);

                }
            }
        });
    }

}

function get_sde_list(zsm_name,asm_name){
    if(asm_name ==''){
        var html = '<option value="">Select</option>';
        $('#sde_name').html(html);
    }else{

        $.ajax({
            type: "POST",
            url: BASE_URL + 'incentive/SdeIncentive/get_sde_list',
            data: { "zsm_name": zsm_name,"asm_name": asm_name, },
            dataType:"json",
            success: function (data) {
                if(data.length != 0){
                    var html = '<option value="">Select</option>';
                    for (let index = 0; index < data.length; index++) {
                        html += '<option value="'+data[index].tso+'">'+data[index].tso+'</option>';
                    }
                    
                    $('#sde_name').html(html);

                }
            }
        });
    }

}



$("#reset").on('click', function(){
	$("#jc_type").val("");
	// $("#jc_type").val("jc_07");
	$("#zsm_name").val("");
	$("#asm_name").val("");
	$("#sde_name").val("");

	get_sde_incentive_urban_val();
	
})




function get_sde_incentive_urban_val() {
    var example = $('#sde_incentive_urban_table').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,
        'ajax': {
            'url': BASE_URL + 'incentive/SdeIncentive/get_sde_incentive_report',
            'data': function (d) {
				d.jc_type =$('#jc_type').val();
				d.session_user_name =$('#session_user_name').val();
				d.zsm_name =$('#zsm_name').val();
				d.asm_name =$('#asm_name').val();
				d.sde_name =$('#sde_name').val();
				
            }
        },
        
       
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
           	{ "data": "zm_name" },
            { "data": "asm_name" },
            { "data": "sde_name" },
            // { "data": "sde_id" },
            { "data": "market" },
            { "data": "mandays_target" },
            { "data": "mandays_ach" },
            { "data": "mandays_percentage" },
            { "data": "mandays_amount" },
            // { "data": "mandays_exception_days" },
            { "data": "orange_salesman_target" },
            { "data": "orange_salesman_ach" },
            { "data": "orange_salesman_percentage" },
            { "data": "orange_salesman_amount" },
            { "data": "ck_super_star_target" },
            { "data": "ck_super_star_ach" },
            { "data": "ck_super_star_percentage" },
            { "data": "ck_super_star_amount" },
            { "data": "ck_elite_target" },
            { "data": "ck_elite_ach" },
            { "data": "ck_elite_percentage" },
            { "data": "ck_elite_amount" },
            { "data": "sec_value_target" },
            { "data": "sec_value_ach" },
            { "data": "sec_value_percentage" },
            { "data": "sec_value_amount" },
            { "data": "rising_star_outlet_target" },
            { "data": "rising_star_outlet_ach" },
            { "data": "rising_star_outlet_percentage" },
            { "data": "rising_star_outlet_amount" },
            { "data": "total_amount" },
            { "data": "pending_last_month" },
            { "data": "final_amount" },
            { "data": "remarks" },
        ],
        "order": [
            [1, 'asc']
        ],
        "columnDefs": [
            { "orderable": false, "targets": "_all" } // Applies the option to all columns
        ],
        createdRow: (row, data, dataIndex, cells) => {
            $(cells[7]).css('background-color', data.mandays_per_color);
            $(cells[11]).css('background-color', data.orange_salesman_per_color);
            $(cells[15]).css('background-color', data.ck_super_star_per_color);
            $(cells[19]).css('background-color', data.ck_elite_per_color);
            $(cells[23]).css('background-color', data.sec_value_per_color);
            $(cells[27]).css('background-color', data.rising_star_outlet_per_color);
            // orange_salesman_per_color
        }

       
    });

}
