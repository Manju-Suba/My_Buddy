$(document).ready(function () {
	get_entered_forms();
    user_name_list();
    business_list();
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

$("#from_date_filter,#to_date_filter,#user_name_filter,#business_filter").on('change', function(){
    get_entered_forms();

})

$("#clear").on('click', function(){
// alert("Dai");
$("#from_date_filter").val("");
$("#to_date_filter").val("");
$("#user_name_filter").val("");
$("#business_filter").val("");
get_entered_forms();
})

function get_entered_forms() {

    var example = $('#example').DataTable({
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
            'url': BASE_URL + 'Settings/get_entered_users_report',
            'data': function (d) {
                d.from_date_filter =$('#from_date_filter').val();
                d.to_date_filter =$('#to_date_filter').val();
                d.user_name_filter =$('#user_name_filter').val();
                d.business_filter =$('#business_filter').val();
            }
        },
        createdRow: function (row, data, dataIndex) {
            $( row ).find('td:eq(0)').attr('data-label', '#');
            $( row ).find('td:eq(1)').attr('data-label', 'User name');
            $( row ).find('td:eq(2)').attr('data-label', 'Mobile');
            $( row ).find('td:eq(3)').attr('data-label', 'Role');
            $( row ).find('td:eq(4)').attr('data-label', 'Business');
            $( row ).find('td:eq(5)').attr('data-label', 'Login time');
            

        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "username" },
            { "data": "mobile" },
            { "data": "role" },
            { "data": "business" },
            { "data": "login_time" },

        ],
        "order": [
            [1, 'asc']
        ]
    });

}

function user_name_list() {
    // var division = $('#division_list').val();
    $.ajax({
        url: BASE_URL + 'Settings/get_user_name_list',
        // data:{"division":division,},
        method: "POST",
        dataType: "JSON",
        success: function(data) {

            // console.log(data[0].username);

            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {

                html += "<option value='"  + data[index].username + "'>" + data[index].username + "</option>";

                
            }
            $('#user_name_filter').html(html);

        }

    });
}

function business_list() {
    // var division = $('#division_list').val();
    $.ajax({
        url: BASE_URL + 'Settings/get_business_list',
        // data:{"division":division,},
        method: "POST",
        dataType: "JSON",
        success: function(data) {

            // console.log(data[0].username);

            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {

                html += "<option value='"  + data[index].division + "'>" + data[index].division + "</option>";

                
            }
            html += "<option value='BPO - Operations'>BPO - Operations</option>";
            $('#business_filter').html(html);

        }

    });
}
