$(document).ready(function () {

    get_key_forms();
    
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

function get_key_forms() {
    var example = $('#rskeyForm_tb').DataTable({
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
            'url': BASE_URL + 'RSController/get_key_rsforms',
            'data': function (data) {

            }
        },
        createdRow: function (row, data, dataIndex) {
            // $( row ).find('td:eq(0)').attr('data-label', '#');
            // $( row ).find('td:eq(1)').attr('data-label', 'Sno');
            $( row ).find('td:eq(0)').attr('data-label', 'S.No');
            $( row ).find('td:eq(1)').attr('data-label', 'Name');
            $( row ).find('td:eq(2)').attr('data-label', 'Created BY');
            $( row ).find('td:eq(3)').attr('data-label', 'created ON ');
            /*$( row ).find('td:eq(5)').attr('data-label', 'RED RSSM');
            $( row ).find('td:eq(5)').attr('data-label', 'Order Vs Delivery');
            $( row ).find('td:eq(6)').attr('data-label', 'Created On');*/
            $( row ).find('td:eq(4)').attr('data-label', 'Score');
            $( row ).find('td:eq(5)').attr('data-label', 'Action');

        },
        "columns": [
   /*         {
                //"className": 'details-control',for +button
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },*/
            {
                //title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
             { "data": "rs_key_name" },
            { "data": "created_by" },
            { "data": "start_key_date" },
            { "data": "score" },
            { "data": "action" },

        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
    $('#rskeyForm_tb tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = example.row( tr );
        var nester_tbl_id = row.data().auto_id;

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

/*function format(d) {

    // `d` is the original data object for the row
    return '<table class="table" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" id="child_view">' +
        
        '<tr>' +
        '<td class="hide table-info"><strong>State</strong></td>' +
        '<td>' + d.key_stocks + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>District</strong></td>' +
        '<td>' + d.key_infra + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Town</strong></td>' +
        '<td>' + d.key_infra_delivery + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Alt.Mobile</strong></td>' +
        '<td>' + d.key_number + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>creat on</strong></td>' +
        '<td>' + d.created_on + '</td>' +
        '</tr>' +
        
        
        '</table>';
}*/

function get_adtkeydetails_pop(table_row_id){

    $.ajax({
        type: "POST",
        url: BASE_URL + 'RSController/get_adtkeydetails_rs',
        data: {
            "table_row_id": table_row_id,
        },
        dataType: "json",
        success: function (data) {
            if (data.length != 0) {

                var total_points = Number(data[0].key_stocks_point) + Number(data[0].key_infra_point) + Number(data[0].key_infra_delivery_point) +  Number(data[0].key_number_point) + Number(data[0].key_order_point) + Number(data[0].key_ffabsenteeism_point)  + 
                    Number(data[0].key_ffabsenteeism_actual_point) + Number(data[0].key_npd_point) + Number(data[0].key_financials_point)  +  Number(data[0].key_infrastructure_point) + Number(data[0].key_ssfa_point)+ Number(data[0].key_xdm_point)+ Number(data[0].key_issues_raised_point);

                var html = '';

                html +='<tr>';
                html +='<td data-label="Parameter">STOCKS AS PER NORM (both EPDs & NPDs)</td>';
                html +='<td data-label="Slab">'+data[0].key_stocks+'</td>';
                html +='<td data-label="Points">'+data[0].key_stocks_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Infra RSSM vs Actual</td>';
                html +='<td data-label="Slab">'+data[0].key_infra+'</td>';
                html +='<td data-label="Points">'+data[0].key_infra_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Infra Delivery Vehicle vs Actual</td>';
                html +='<td data-label="Slab">'+data[0].key_infra_delivery+'</td>';
                html +='<td data-label="Points">'+data[0].key_infra_delivery_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Number of RED RSSM</td>';
                html +='<td data-label="Slab">'+data[0].key_number+'</td>';
                html +='<td data-label="Points">'+data[0].key_number_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Order Vs Delivery</td>';
                html +='<td data-label="Slab">'+data[0].key_order+'</td>';
                html +='<td data-label="Points">'+data[0].key_order_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">FF Absenteeism (HoW & Total calls condition)</td>';
                html +='<td data-label="Slab">'+data[0].key_ffabsenteeism+'</td>';
                html +='<td data-label="Points">'+data[0].key_ffabsenteeism_point+'</td>';
                html +='</tr>';
                
                html +='<tr>';
                html +='<td data-label="Parameter">FF Absenteeism (Actual Absent)</td>';
                html +='<td data-label="Slab">'+data[0].key_ffabsenteeism_actual+'</td>';
                html +='<td data-label="Points">'+data[0].key_ffabsenteeism_actual_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">NPD Investment</td>';
                html +='<td data-label="Slab">'+data[0].key_npd+'</td>';
                html +='<td data-label="Points">'+data[0].key_npd_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Financials</td>';
                html +='<td data-label="Slab">'+data[0].key_financials+'</td>';
                html +='<td data-label="Points">'+data[0].key_financials_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">INFRASTRUCTURE - Warehouse</td>';
                html +='<td data-label="Slab">'+data[0].key_infrastructure+'</td>';
                html +='<td data-label="Points">'+data[0].key_infrastructure_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">SSFA = XDM</td>';
                html +='<td data-label="Slab">'+data[0].key_ssfa+'</td>';
                html +='<td data-label="Points">'+data[0].key_ssfa_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">XDM regular usage (daily usage)</td>';
                html +='<td data-label="Slab">'+data[0].key_xdm+'</td>';
                html +='<td data-label="Points">'+data[0].key_xdm_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Issues Raised with SDE</td>';
                html +='<td data-label="Slab">'+data[0].key_issues_raised+'</td>';
                html +='<td data-label="Points">'+data[0].key_issues_raised_point+'</td>';
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