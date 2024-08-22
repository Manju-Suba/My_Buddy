$(document).ready(function () {

    get_rejected_servicefee();
    get_asm_fp();
    
});

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

function get_rejected_servicefee() {
    var example = $('#rejectedfee_tb').DataTable({
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
                "extend": 'colvis',
                "text": '<i class="fa fa-eye" ></i>  Colvis',
                "titleAttr": 'Colvis',
            },

        ],
        'dom': 'LBfrtip',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'RSSMController/get_divhead_rejected',
            'data': function (data) {

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
            $( row ).find('td:eq(8)').attr('data-label', 'Action');

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
            { "data": "action" },
        ],
        "order": [
            [1, 'asc']
        ]
    });
    $('#rejectedfee_tb tbody').unbind('click');

    $('#rejectedfee_tb tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = example.row( tr );

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    } );
}

function format(d) {

    return '<table class="table" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" id="child_view">' +
        '<tr>' +
        '<td class="hide table-info"><strong>Existing RSSM Name</strong></td>' +
        '<td>' + d.ex_rssm_name + '</td>' +
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

function get_asm_fp() {
    var example = $('#asm_fp').DataTable({
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
                "extend": 'colvis',
                "text": '<i class="fa fa-eye" ></i>  Colvis',
                "titleAttr": 'Colvis',
            },

        ],
        'dom': 'LBfrtip',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'RSSMController/get_asm_future_prospect',
            'data': function (data) {

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
            $( row ).find('td:eq(8)').attr('data-label', 'Action');

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
            { "data": "action" },
        ],
        "order": [
            [1, 'asc']
        ]
    });
    $('#rejectedfee_tb tbody').unbind('click');

    $('#rejectedfee_tb tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = example.row( tr );

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    } );
}

function format(d) {

    return '<table class="table" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" id="child_view">' +
        '<tr>' +
        '<td class="hide table-info"><strong>Existing RSSM Name</strong></td>' +
        '<td>' + d.ex_rssm_name + '</td>' +
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
                $('#name').text(data.get_adtdetails_rssm_sde_result[0].name);
                $('#mobile').text(data.get_adtdetails_rssm_sde_result[0].mobile_no);
                $('#w_num').text(data.get_adtdetails_rssm_sde_result[0].alt_mobile_no);
                $('#dob').text(data.get_adtdetails_rssm_sde_result[0].dob);
                $('#email').text(data.get_adtdetails_rssm_sde_result[0].email);
                $('#f_name').text(data.get_adtdetails_rssm_sde_result[0].father_name);
                $('#address').text(data.get_adtdetails_rssm_sde_result[0].address);
                $('#doj').text(data.get_adtdetails_rssm_sde_result[0].doj);
                $('#experience').text(data.get_adtdetails_rssm_sde_result[0].experience);
                $('#family_bg').text(data.get_adtdetails_rssm_sde_result[0].family_bg);
                $('#education').text(data.get_adtdetails_rssm_sde_result[0].education);
                $('#age').text(data.get_adtdetails_rssm_sde_result[0].age);
                $('#terrain_knowledge').text(data.get_adtdetails_rssm_sde_result[0].terrain_knowledge);
                $('#tech_adoption').text(data.get_adtdetails_rssm_sde_result[0].tech_adoption);
                $('#sales_cat').text(data.get_adtdetails_rssm_sde_result[0].sales_cat);
                $('#sales_type').text(data.get_adtdetails_rssm_sde_result[0].sales_type);
                $('#ex_rssm_name').text(data.get_adtdetails_rssm_sde_result[0].ex_rssm_name);
                $('#ex_rssm_number').text(data.get_adtdetails_rssm_sde_result[0].ex_rssm_number);
                $('#region').text(data.get_adtdetails_rssm_sde_result[0].region);
                $('#rs_name').text(data.get_adtdetails_rssm_sde_result[0].rs_name);
                $('#rs_code').text(data.get_adtdetails_rssm_sde_result[0].rs_code);
                $('#rs_state').text(data.get_adtdetails_rssm_sde_result[0].rs_state);
                $('#rs_city').text(data.get_adtdetails_rssm_sde_result[0].rs_city);
                $('#rs_dist').text(data.get_adtdetails_rssm_sde_result[0].rs_dist);
                $('#rs_town').text(data.get_adtdetails_rssm_sde_result[0].rs_town);
                $('#rs_town_code').text(data.get_adtdetails_rssm_sde_result[0].rs_town_code);
                $('#asm_name').text(data.get_adtdetails_rssm_sde_result[0].asm);
                $('#sde_name').text(data.get_adtdetails_rssm_sde_result[0].tso);
                $('#business').text(data.get_adtdetails_rssm_sde_result[0].business_division);
                $('#ex_sales_category').text(data.get_adtdetails_rssm_sde_result[0].ex_sales_category);
                if(data.get_adtdetails_rssm_sde_result[0].service_fee != ''){
                    $('#service_fee').text(data.get_adtdetails_rssm_sde_result[0].service_fee);
                }else{
                    var ser_fee = '-';
                    $('#service_fee').text(ser_fee);
                }
                
                if(data.get_adtdetails_rssm_sde_result[0].sales_type == 'New SalesMan'){
                    $('.new_details').css('display','flex');
                    $('.ex_details').css('display','none');

                }else{
                    $('.new_details').css('display','none');
                    $('.ex_details').css('display','flex');
                }

                $('#aadhar').text(data.get_adtdetails_rssm_sde_result[0].aadhar);
                if(data.get_adtdetails_rssm_sde_result[0].aadhar_copy !=""){
                    var check_img = url+'uploads/sales/aadhar/'+data.get_adtdetails_rssm_sde_result[0].aadhar_copy;
                    $("#aadhar_copy").html(`
                    <a target="_blank" href="${check_img}" ><i class="fa fa-eye"> Aadhar view(Front Side)</i></a>
                    `);
                }

                if (data.get_adtdetails_rssm_sde_result[0].aadhar_backview != "" ) {
                    var check_img =url + 'uploads/sales/aadhar_backview/' + data.get_adtdetails_rssm_sde_result[0].aadhar_backview;
                        $("#aadhar_backview_copy").html(`
                            <a target="_blank" href="${check_img}" ><i class="fa fa-eye"> Aadhar view(Back Side)</i></a>
                        `);
                }

                $('#pan').text(data.get_adtdetails_rssm_sde_result[0].pan);
                if(data.get_adtdetails_rssm_sde_result[0].pan_copy !=""){
                    var pan_img = url+'uploads/sales/pan/'+data.get_adtdetails_rssm_sde_result[0].pan_copy;
                    $("#pan_copy").html(`
                    <a target="_blank" href="${pan_img}" title="View Pan " ><i class="fa fa-eye" > Pan view</i> </a>
                    `);
                }

                if(data.get_adtdetails_rssm_sde_result[0].cheque !=""){
                    var cheque_img = url+'uploads/sales/cheque/'+data.get_adtdetails_rssm_sde_result[0].cheque;
                    $("#cheque").html(`
                    <a target="_blank" href="${cheque_img}" title="View Cheque"><i class="fa fa-eye" > Cheque</i> </a>
                    `);
                }

                $('#table_row_id').text(data.get_adtdetails_rssm_sde_result[0].auto_id);
                $('#bank_name').text(data.get_adtdetails_rssm_sde_result[0].bank_name);
                $('#branch_name').text(data.get_adtdetails_rssm_sde_result[0].branch_name);

                $('#ac_number').text(data.get_adtdetails_rssm_sde_result[0].ac_number);
                $('#ac_type').text(data.get_adtdetails_rssm_sde_result[0].ac_type);

                $('#ifsc_s_number').text(data.get_adtdetails_rssm_sde_result[0].ifsc_s_number);

                if(data.get_adtdetails_rssm_sde_result[0].img_file !=""){
                    var ff_img = url+'uploads/sales/image/'+data.get_adtdetails_rssm_sde_result[0].img_file;
                    $("#img_file").html(`
                    <a target="_blank" href="${ff_img}" title="view rssm image" ><i class="fa fa-eye" > Image</i> </a>
                    `);
                }
                console.log(data.get_adtdetails_rssm_sde_result[0].sales_type);
                $('#adt_details_modal_btn').click();
            }
        }
    });

}

function editServiceFee(row_id){

    $.ajax({
        type: "POST",
        url: BASE_URL + 'RSSMController/get_adtdetails_rssm',
        data: {
            "table_row_id": row_id,
        },
        dataType: "json",
        success: function (data) {
            if (data.get_adtdetails_rssm_sde_result.length != 0) {
                $('#update_service_fee').val(data.get_adtdetails_rssm_sde_result[0].service_fee);
                if(data.get_adtdetails_rssm_sde_result[0].divhead_remarks != '' && data.get_adtdetails_rssm_sde_result[0].divhead_remarks != null){
                    $('#divhead_comment').css('display','block');
                    $('#divhead_remark').text(data.get_adtdetails_rssm_sde_result[0].divhead_remarks);

                }
                $('#row_id').val(row_id);
                $('.update_sevicefee').modal('show')
            }
        }
    });

}


$('.update_fee').click(function(){
    var auto_id = $('#row_id').val();
    var service_fee = $('#update_service_fee').val();
    // $('.update_fee').addAttr("disabled");

    if(service_fee == ''){

        fields_required();
    }else{
        // alert(1);

        $('.update_fee').attr("disabled");
        $.ajax({
            type: "POST",
            url: BASE_URL + 'RSSMController/update_service_fee',
            data: {
                "auto_id": auto_id,
                "service_fee": service_fee
            },
            dataType: "json",
            success: function (data) {
                $('#action_close').click();

                if (data.response == 'success') {
                    $('.update_sevicefee').modal('hide');
                    var table_reload = $('#rejectedfee_tb').DataTable();
                    table_reload.ajax.reload();
                    updated_toast();
                    $('.update_fee').removeAttr("disabled");

                }
                else {
                    request_failed();
                    $('.update_fee').removeAttr("disabled");

                }
            }
        });
    }
});