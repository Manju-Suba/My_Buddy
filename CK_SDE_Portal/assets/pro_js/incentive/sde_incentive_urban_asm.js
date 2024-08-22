$(document).ready(function () {
    get_sde_incentive_urban_asm();

});



$("#jc_type").on('change', function(){
	get_sde_incentive_urban_asm();
})


$("#sde_number").on('change', function(){
	get_sde_incentive_urban_asm();
})

$("#reset").on('click', function(){
	$("#jc_type").val("");
	// $("#jc_type").val("jc_07");
	$("#sde_number").val("");
	get_sde_incentive_urban_asm();
	
})

	



function get_sde_incentive_urban_asm() {
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
          
            { "data": "sde_name" },
            { "data": "market" },
            { "data": "incen_py_details" },
       
        ],
        "order": [
            [1, 'asc']
        ],
		
        "columnDefs": [
            { "orderable": false, "targets": "_all" } // Applies the option to all columns
        ],
		
		createdRow: function( row, data, dataIndex ) {
			if( data['bg_color_value'] ==  'green'){
				$(row).css('background-color', data.highest_percentage);
			}
			if( data['bg_color_value'] ==  'red'){
				$(row).css('background-color', data.lowest_percentage);
			}
           
        },

       
    });
	

}
