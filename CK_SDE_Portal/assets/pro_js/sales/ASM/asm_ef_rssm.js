$(document).ready(function () {

	get_tso_list();
    get_entered_forms();

})

function get_tso_list() {

	var asm_number = $('#session_mobile_no').val();

	$.ajax({
		type: "POST",
		url: BASE_URL + 'ASMController/get_tso_list',
		data: {
			"asm_number": asm_number,
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].tso_number + '">' + data[index].tso + '</option>';
				}

				$('#af_tso_list').html(html);

			}
		}
	});


}

$('#af_tso_list,#af_va_status,#af_asm_status').on('change',function(){
    get_entered_forms();

});

$('#btnClear').on('click',function(){
    
    $('#af_tso_list').val('').trigger('change');
    $('#af_va_status').val('').trigger('change');
    $('#af_asm_status').val('').trigger('change');
    get_entered_forms();

});
// for export all data
function newexportaction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one('preXhr', function (e, s, data) {
        data.start = 0;
        data.length = 2147483647;
        dt.one('preDraw', function (e, settings) {
            if (button[0].className.indexOf('buttons-copy') >= 0) {
                $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
            dt.one('preXhr', function (e, s, data) {
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            setTimeout(dt.ajax.reload, 0);
            return false;
        });
    });
    dt.ajax.reload();
}

function get_entered_forms() {
    var example = $('#enteredForm_tb').DataTable({
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        'lengthChange': true,
        "buttons": [
            {
                "extend": 'copy',
                "text": '<i class="fa fa-clipboard" ></i>  Copy',
                "titleAttr": 'Copy',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'excel',
                "text": '<i class="fa fa-file-excel-o" ></i>  Excel',
                "titleAttr": 'Excel',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'csv',
                "text": '<i class="fa fa-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'pdf',
                "text": '<i class="fa fa-file-pdf-o" ></i>  PDF',
                "titleAttr": 'PDF',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            // {
            //     "extend": 'print',
            //     "text": '<i class="fa fa-print" ></i>  Print',
            //     "titleAttr": 'Print',
            //     "exportOptions": {
            //         'columns': ':visible'
            //     },
            //     "action": newexportaction
            // },
            {
                "extend": 'colvis',
                "text": '<i class="fa fa-eye" ></i>  Colvis',
                "titleAttr": 'Colvis',
                // "action": newexportaction
            },

        ],
        'dom': 'LBfrtip',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'ASMController/get_entered_rssmforms',
            'data': function (data) {
                data.asm_number = $('#session_mobile_no').val();
                data.tso_number = $('#af_tso_list').val();
                data.af_va_status = $('#af_va_status').val();
                data.af_asm_status = $('#af_asm_status').val();

            }
        },
        createdRow: function (row, data, dataIndex) {
            $( row ).find('td:eq(0)').attr('data-label', '#');
            $( row ).find('td:eq(1)').attr('data-label', 'Sno');
            $( row ).find('td:eq(2)').attr('data-label', 'Name');
            $( row ).find('td:eq(3)').attr('data-label', 'Mobile No');
            $( row ).find('td:eq(4)').attr('data-label', 'Created On');
            $( row ).find('td:eq(5)').attr('data-label', 'VSO Status');
            $( row ).find('td:eq(6)').attr('data-label', 'ASM Status');
            $( row ).find('td:eq(7)').attr('data-label', 'SDE Score');
            $( row ).find('td:eq(8)').attr('data-label', 'VSO Score');
            $( row ).find('td:eq(9)').attr('data-label', 'Created By');
            $( row ).find('td:eq(10)').attr('data-label', 'Action');

        },
        "columns": [
            {
                "className": 'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "name" },
            { "data": "mobile_no" },
            { "data": "created_on" },
            // { "data": "va_status" },
            { "data": "asm_status" },
            { "data": "score" },
            // { "data": "vso_score" },
            { "data": "created_by" },
            { "data": "action" },
            

        ],
        "order": [
            [1, 'asc']
        ]
    });
    $('#enteredForm_tb tbody').unbind('click');

    // Add event listener for opening and closing details
    $('#enteredForm_tb tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = example.row( tr );
        // var nester_tbl_id = row.data().auto_id;

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(format(row.data())).show();
            // format_new(row.child,nester_tbl_id);
            tr.addClass('shown');
        }
    } );
}

function format(d) {


    // `d` is the original data object for the row
    return '<table class="table" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" id="child_view">' +
        '<tr>' +
        '<td class="hide table-info"><strong>Existing RSSM Name</strong></td>' +
        '<td>' + d.ex_rssm_name + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>State</strong></td>' +
        '<td>' + d.state + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>District</strong></td>' +
        '<td>' + d.division + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Town</strong></td>' +
        '<td>' + d.town + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Whatsapp no.</strong></td>' +
        '<td>' + d.alt_mobile_no + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Address</strong></td>' +
        '<td>' + d.address + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Resume</strong></td>' +
        '<td>' + d.resume + '</td>' +
        '</tr>' +
        
        
        '</table>';
}

function get_adtdetails_pop(table_row_id){

    $.ajax({
        type: "POST",
        url: BASE_URL + 'RSSMController/get_adtdetails_rssm',
        data: {
            "table_row_id": table_row_id,
        },
        dataType: "json",
        success: function (data) {
            if (data.get_adtdetails_rssm_sde_result.length != 0) {

                var sde_total_points = Number(data.get_adtdetails_rssm_sde_result[0].exp_point) + Number(data.get_adtdetails_rssm_sde_result[0].edu_point) + Number(data.get_adtdetails_rssm_sde_result[0].age_point) + Number(data.get_adtdetails_rssm_sde_result[0].tk_point) + 
                    Number(data.get_adtdetails_rssm_sde_result[0].ta_point) + Number(data.get_adtdetails_rssm_sde_result[0].fb_point);
                
                var vso_total_points = Number(data.get_adtdetails_rssm_vso_result[0].exp_point) + Number(data.get_adtdetails_rssm_vso_result[0].edu_point) + Number(data.get_adtdetails_rssm_vso_result[0].age_point) + Number(data.get_adtdetails_rssm_vso_result[0].tk_point) + 
                    Number(data.get_adtdetails_rssm_vso_result[0].ta_point) + Number(data.get_adtdetails_rssm_vso_result[0].fb_point);
                
                var html = '';

                html +='<tr>';
                html +='<td data-label="Parameter">Experience</td>';
                html +='<td data-label="SDE Slab">'+data.get_adtdetails_rssm_sde_result[0].experience+'</td>';
                html +='<td data-label="SDE Points">'+data.get_adtdetails_rssm_sde_result[0].exp_point+'</td>';
                html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].experience+'</td>';
                html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].exp_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Education</td>';
                html +='<td data-label="SDE Slab">'+data.get_adtdetails_rssm_sde_result[0].education+'</td>';
                html +='<td data-label="SDE Points">'+data.get_adtdetails_rssm_sde_result[0].edu_point+'</td>';
                html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].education+'</td>';
                html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].edu_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Age</td>';
                html +='<td data-label="SDE Slab">'+data.get_adtdetails_rssm_sde_result[0].age+'</td>';
                html +='<td data-label="SDE Points">'+data.get_adtdetails_rssm_sde_result[0].age_point+'</td>';
                html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].age+'</td>';
                html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].age_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Terrain Knowledge</td>';
                html +='<td data-label="SDE Slab">'+data.get_adtdetails_rssm_sde_result[0].terrain_knowledge+'</td>';
                html +='<td data-label="SDE Points">'+data.get_adtdetails_rssm_sde_result[0].tk_point+'</td>';
                html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].terrain_knowledge+'</td>';
                html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].tk_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Technology Adaption</td>';
                html +='<td data-label="SDE Slab">'+data.get_adtdetails_rssm_sde_result[0].tech_adoption+'</td>';
                html +='<td data-label="SDE Points">'+data.get_adtdetails_rssm_sde_result[0].ta_point+'</td>';
                html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].tech_adoption+'</td>';
                html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].ta_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Family Background</td>';
                html +='<td data-label="SDE Slab">'+data.get_adtdetails_rssm_sde_result[0].family_bg+'</td>';
                html +='<td data-label="SDE Points">'+data.get_adtdetails_rssm_sde_result[0].fb_point+'</td>';
                html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].family_bg+'</td>';
                html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].fb_point+'</td>';
                html +='</tr>';
                
                html +='<tr>';
                html +='<td class="hide_td_title"></td>';
                html +='<td class="hide_td_title"><strong>SDE Total Points</strong></td>';
                html +='<td data-label="SDE Total Points"><strong>'+sde_total_points+'</strong></td>';
                html +='<td class="hide_td_title"><strong>VSO Total Points</strong></td>';
                html +='<td data-label="VSO Total Points"><strong>'+vso_total_points+'</strong></td>';
                html +='</tr>';

                $('#adt_tb_body').html(html);
                $('#adt_details_modal_btn').click();

            }
        }
    });

}


function get_action_pop(table_row_id){
    $('#table_row_id').val(table_row_id);
    $('#action_pop_modal').modal('show');
}

$('#asm_action_btn').on('click',function(){
    var get_f_asm_status = $('#f_asm_status').val();
    var auto_id = $('#table_row_id').val();

    if(get_f_asm_status !=''){
        $.ajax({
            type: "POST",
            url: BASE_URL + 'ASMController/process_asm_action',
            data: {
                "asm_status": get_f_asm_status,
                "auto_id": auto_id,
            },
            dataType: "json",
            success: function (data) {
                $('#action_close').click();

                if(data.response =='success'){
    
                    $('.single-select').val('').trigger('change');

                   
                    updated_toast();
                }
                else{
                    request_failed();
                    
                }
                get_entered_forms();

            }
        });
    
    }else{
        fields_required();
    }
    
});
