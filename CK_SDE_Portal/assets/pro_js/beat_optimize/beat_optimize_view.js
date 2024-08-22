
$(document).ready(function () {
    get_uploaded_beat_optimize_details();
    get_beat_pending_user();
});

function open_beat(cityName) {

	var i;
	var x = document.getElementsByClassName("city");

	$("#active_tab").val(cityName);
	if (cityName == "sde_beat_uploaded") {
		$("#tab_title").html("SDE Beat Uploaded");

	}

	if (cityName == "sde_beat_pending") {
		$("#tab_title").html("SDE Beat Pending");


	}

	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	document.getElementById(cityName).style.display = "block";


}


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

function get_uploaded_beat_optimize_details() {
    var example = $('#beat_uploaded_report_view').DataTable({
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



function get_beat_pending_user() {
    var example = $('#beat_pending_sde_view').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
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
            {
                "extend": 'print',
                "text": '<i class="fa fa-print" ></i>  Print',
                "titleAttr": 'Print',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
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
            'url': BASE_URL + 'beat_optimize/BeatOptimizationController/get_beat_pending_user',
            'data': function (d) {
               
            }
        },
        createdRow: function (row, data, dataIndex) {
            $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            $( row ).find('td:eq(1)').attr('data-label', 'SDE Emp Code');
            $( row ).find('td:eq(2)').attr('data-label', 'SDE Name');
            $( row ).find('td:eq(3)').attr('data-label', 'SDE Mobile Number');

        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "username" },
            { "data": "user_id" },
            { "data": "mobile" },
            

        ],
        "order": [
            [1, 'asc']
        ]
    });

}
