$(document).ready(function () {
	get_tso_list();

    get_funnel_forms();
    
});

function get_tso_list() {

	var zsm_number = $('#session_mobile_no').val();

	$.ajax({
		type: "POST",
		url: BASE_URL + 'ZSMController/get_tso_list',
		data: {
			"zsm_number": zsm_number,
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

$('#af_tso_list').on('change',function(){
    get_funnel_forms();
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

function get_funnel_forms() {
    var example = $('#funnelForm_tb').DataTable({
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
            'url': BASE_URL + 'ZSMController/get_funnel_rsforms',
            'data': function (data) {
                data.zsm_number = $('#session_mobile_no').val();
                data.tso_number = $('#af_tso_list').val();
            }
        },
        createdRow: function (row, data, dataIndex) {
            $( row ).find('td:eq(0)').attr('data-label', '#');
            $( row ).find('td:eq(1)').attr('data-label', 'Sno');
            $( row ).find('td:eq(2)').attr('data-label', 'Name');
            $( row ).find('td:eq(3)').attr('data-label', 'Mobile No');
            $( row ).find('td:eq(4)').attr('data-label', 'State');
            $( row ).find('td:eq(5)').attr('data-label', 'District');
            $( row ).find('td:eq(6)').attr('data-label', 'Created On');
            $( row ).find('td:eq(7)').attr('data-label', 'Score');
            $( row ).find('td:eq(8)').attr('data-label', 'Created By');
            $( row ).find('td:eq(9)').attr('data-label', 'Action');

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
            { "data": "state" },
            { "data": "division" },
            { "data": "created_on" },
            { "data": "score" },
            { "data": "created_by" },
            { "data": "action" },
            

        ],
        "order": [
            [1, 'asc']
        ]
    });
    $('#funnelForm_tb tbody').unbind('click');

    // Add event listener for opening and closing details
    $('#funnelForm_tb tbody').on('click', 'td.details-control', function () {
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

function show_pop_img(){
    var imgTag = event.target;
    var mySrc = imgTag.getAttribute('src');
    var modalImg = document.getElementById("pop_img_view");
    modalImg.src = mySrc;

    $('#myModalImg').modal('show');

}

function format(d) {


    // `d` is the original data object for the row
    return '<table class="table" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" id="child_view">' +
        '<tr>' +
        '<td class="hide table-info"><strong>Existing RS Name</strong></td>' +
        '<td>' + d.ex_rs_name + '</td>' +
        '</tr>' +    
        '<tr>' +
        '<td class="hide table-info"><strong>Distributor Name</strong></td>' +
        '<td>' + d.c_sname + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>GST</strong></td>' +
        '<td>' + d.c_gst_no + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Town</strong></td>' +
        '<td>' + d.town + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Alt.Mobile</strong></td>' +
        '<td>' + d.alt_mobile_no + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Address</strong></td>' +
        '<td>' + d.address + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Uploaded office/warehouse photos</strong></td>' +
        '<td>' + d.resume + '</td>' +
        '</tr>' +
        
        
        '</table>';
}

function get_adtdetails_pop(table_row_id){

    $.ajax({
        type: "POST",
        url: BASE_URL + 'RSController/get_adtdetails_rs',
        data: {
            "table_row_id": table_row_id,
        },
        dataType: "json",
        success: function (data) {
            if (data.get_adtdetails_rs_sde_result.length != 0) {

                var total_points = Number(data.get_adtdetails_rs_sde_result[0].c_age_of_org_point) + Number(data.get_adtdetails_rs_sde_result[0].c_comp_handled_point) + Number(data.get_adtdetails_rs_sde_result[0].c_retail_serviced_point) + 
                Number(data.get_adtdetails_rs_sde_result[0].c_godown_point) + Number(data.get_adtdetails_rs_sde_result[0].c_computer_point) + Number(data.get_adtdetails_rs_sde_result[0].c_printer_point)  + 
                    Number(data.get_adtdetails_rs_sde_result[0].c_internet_point) + Number(data.get_adtdetails_rs_sde_result[0].c_delivery_vehicle_point) + Number(data.get_adtdetails_rs_sde_result[0].c_fut_inverstment_point)  + 
                        Number(data.get_adtdetails_rs_sde_result[0].c_prop_invol_point) + Number(data.get_adtdetails_rs_sde_result[0].c_market_fb_point);

                var html = '';

                html +='<tr>';
                html +='<td data-label="Parameter">Age of Organisation</td>';
                html +='<td data-label="Slab">'+data.get_adtdetails_rs_sde_result[0].c_age_of_org+'</td>';
                html +='<td data-label="Points">'+data.get_adtdetails_rs_sde_result[0].c_age_of_org_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Companies Handled</td>';
                html +='<td data-label="Slab">'+data.get_adtdetails_rs_sde_result[0].c_comp_handled+'</td>';
                html +='<td data-label="Points">'+data.get_adtdetails_rs_sde_result[0].c_comp_handled_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Retailers Serviced</td>';
                html +='<td data-label="Slab">'+data.get_adtdetails_rs_sde_result[0].c_retail_serviced+'</td>';
                html +='<td data-label="Points">'+data.get_adtdetails_rs_sde_result[0].c_retail_serviced_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Godown</td>';
                html +='<td data-label="Slab">'+data.get_adtdetails_rs_sde_result[0].c_godown+'</td>';
                html +='<td data-label="Points">'+data.get_adtdetails_rs_sde_result[0].c_godown_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Computer</td>';
                html +='<td data-label="Slab">'+data.get_adtdetails_rs_sde_result[0].c_computer+'</td>';
                html +='<td data-label="Points">'+data.get_adtdetails_rs_sde_result[0].c_computer_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Printer</td>';
                html +='<td data-label="Slab">'+data.get_adtdetails_rs_sde_result[0].c_printer+'</td>';
                html +='<td data-label="Points">'+data.get_adtdetails_rs_sde_result[0].c_printer_point+'</td>';
                html +='</tr>';
                
                html +='<tr>';
                html +='<td data-label="Parameter">Internet</td>';
                html +='<td data-label="Slab">'+data.get_adtdetails_rs_sde_result[0].c_internet+'</td>';
                html +='<td data-label="Points">'+data.get_adtdetails_rs_sde_result[0].c_internet_point	+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Delivery Vehicle</td>';
                html +='<td data-label="Slab">'+data.get_adtdetails_rs_sde_result[0].c_delivery_vehicle+'</td>';
                html +='<td data-label="Points">'+data.get_adtdetails_rs_sde_result[0].c_delivery_vehicle_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Future investment</td>';
                html +='<td data-label="Slab">'+data.get_adtdetails_rs_sde_result[0].c_fut_inverstment+'</td>';
                html +='<td data-label="Points">'+data.get_adtdetails_rs_sde_result[0].c_fut_inverstment_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Proprietary Involvement</td>';
                html +='<td data-label="Slab">'+data.get_adtdetails_rs_sde_result[0].c_prop_invol+'</td>';
                html +='<td data-label="Points">'+data.get_adtdetails_rs_sde_result[0].c_prop_invol_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Market Feed Back</td>';
                html +='<td data-label="Slab">'+data.get_adtdetails_rs_sde_result[0].c_market_fb+'</td>';
                html +='<td data-label="Points">'+data.get_adtdetails_rs_sde_result[0].c_market_fb_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td class="hide_td_title"></td>';
                html +='<td class="hide_td_title"><strong>Total Points</strong></td>';
                html +='<td data-label="Total Points"><strong>'+total_points+'</strong></td>';
                html +='</tr>';

                $('#adt_tb_body').html(html);
                $('#adt_details_modal_btn').click();

            }
        }
    });

}