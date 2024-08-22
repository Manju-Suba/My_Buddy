$(document).ready(function () {
    get_asm_list();

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

function get_asm_list() {

	var zsm_number = $('#session_mobile_no').val();

	$.ajax({
		type: "POST",
		url: BASE_URL + 'ZSMController/get_asm_list',
		data: {
			"zsm_number": zsm_number,
		},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].asm_number + '">' + data[index].asm + '</option>';
				}

				$('#af_asm_list').html(html);

			}
		}
	});
}

function get_tso_list() {

	var zsm_number = $('#session_mobile_no').val();
	var asm_number = $('#af_asm_list').val();

	$.ajax({
		type: "POST",
		url: BASE_URL + 'ZSMController/get_tso_list',
		data: {
			"zsm_number": zsm_number,
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

$('#af_asm_list').on('change',function(){
    get_tso_list();
    revised_fee_approved();
    revised_fee_rejected();
    revised_fee();
});

$('#af_tso_list').on('change',function(){
    revised_fee();
    revised_fee_approved();
    revised_fee_rejected();

});

$('#btnClear').on('click',function(){
    $('#af_tso_list').val('').trigger('change');
    $('#af_asm_list').val('').trigger('change');
    get_asm_verified_forms();

});

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


function revised_fee() {
    var example = $('#revised_fee_table').DataTable({
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
            'url': BASE_URL + 'ZSMController/get_salary_approval_forms',
            'data': function (data) {
                data.zsm_number = $('#session_mobile_no').val();
                data.tso_number = $('#af_tso_list').val();
                data.asm_number = $('#af_asm_list').val();
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
    $('#revised_fee_table tbody').unbind('click');

    // Add event listener for opening and closing details
    $('#revised_fee_table tbody').on('click', 'td.details-control', function () {
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

$('#approve_fee').click(function(){
    $('#approve_fee').attr('disabled','');
    $.ajax({
        type: "POST",
        url: BASE_URL + 'ZSMController/approve_fee',
        data: {
            rowid:$('#table_row_id').text(),
            divheadStatus:'Approved'
        },
        dataType: "json",
        success: function (data) {
            $('#action_close').click();

            if (data.response == 'success') {
                $('#view_additional_details').modal('hide');
                var example = $('#revised_fee_table').DataTable();
                example.ajax.reload();
                updated_toast();
                $('#approve_fee').removeAttr('disabled','');
                
            }
            else {
                request_failed();
            }
        }
    });

});

$('#reject_fee').click(function(){
    $('.reject_reason').modal('show');
})
$('#submit_reason').click(function(){
    $('#submit_reason').attr('disabled','');
    
    $.ajax({
        type: "POST",
        url: BASE_URL + 'ZSMController/approve_fee',
        data: {
            rowid:$('#table_row_id').text(),
            divhead_remarks:$('#rej_reason').val(),
            divheadStatus:'Rejected'
        },
        dataType: "json",
        success: function (data) {
            $('#action_close').click();

            if (data.response == 'success') {
                $('#view_additional_details').modal('hide');
                $('.reject_reason').modal('hide');
                $('#submit_reason').removeAttr('disabled','');

                var example = $('#revised_fee_table').DataTable();
                example.ajax.reload();
                // rejected_toast();
                updated_toast();
            }
            else {
                $('#submit_reason').removeAttr('disabled','');
                request_failed();
            }
        }
    });

})

function revised_fee_approved() {
    var example = $('#revised_fee_approved').DataTable({
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
            'url': BASE_URL + 'ZSMController/get_divhead_approved_forms',
            'data': function (data) {
                data.zsm_number = $('#session_mobile_no').val();
                data.tso_number = $('#af_tso_list').val();
                data.asm_number = $('#af_asm_list').val();
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
            { "data": "asm_status" },
            { "data": "score" },
            { "data": "created_by" },
            { "data": "action" },
            

        ],
        "order": [
            [1, 'asc']
        ]
    });
    $('#revised_fee_approved tbody').unbind('click');

    $('#revised_fee_approved tbody').on('click', 'td.details-control', function () {
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


function revised_fee_rejected() {
    var example = $('#revised_fee_rejected').DataTable({
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
            'url': BASE_URL + 'ZSMController/get_divhead_rejected_forms',
            'data': function (data) {
                data.zsm_number = $('#session_mobile_no').val();
                data.tso_number = $('#af_tso_list').val();
                data.asm_number = $('#af_asm_list').val();

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
            { "data": "asm_status" },
            { "data": "score" },
            { "data": "created_by" },
            { "data": "action" },
            

        ],
        "order": [
            [1, 'asc']
        ]
    });
    $('#revised_fee_rejected tbody').unbind('click');

    $('#revised_fee_rejected tbody').on('click', 'td.details-control', function () {
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

function get_action_pop(table_row_id){
    $('#table_row_id').val(table_row_id);
    $('#action_pop_modal').modal('show');
}

function view_adddetails(rscode) {
    $('#view_additional_details').modal('show');
    $("#edit_currentStepInput").val("1");
    $('#edit_rscode').val(rscode);
    
    
    $.ajax({
        type: "POST",
        url: BASE_URL + 'LeaderController/get_add_details',
        data: {
            "rscode": rscode,

        },
        dataType: "json",
        success: function (data) {
            


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
            $('#table_row_id').text(rscode);
            $('#asm_name').text(data.get_adtdetails_rssm_sde_result[0].asm);
            $('#tso_name').text(data.get_adtdetails_rssm_sde_result[0].tso);
            $('#business').text(data.get_adtdetails_rssm_sde_result[0].business_division);
            $('#ex_sales_category').text(data.get_adtdetails_rssm_sde_result[0].ex_sales_category);

            if (data.get_adtdetails_rssm_sde_result[0].sales_type == 'New SalesMan') {
                $('.new_details').css('display', 'flex');
                $('.ex_details').css('display', 'none');

            } else {
                $('.new_details').css('display', 'none');
                $('.ex_details').css('display', 'flex');
            }

            $('#aadhar').text(data.get_adtdetails_rssm_sde_result[0].aadhar);
            if (data.get_adtdetails_rssm_sde_result[0].aadhar_copy != "") {
                var check_img = url + 'uploads/sales/aadhar/' + data.get_adtdetails_rssm_sde_result[0].aadhar_copy;
                $("#aadhar_copy").html(`
            <a target="_blank" href="${check_img}" ><i class="fa fa-eye"> Aadhar view(Front Side)</i></a>
            `);
            }

            $('#pan').text(data.get_adtdetails_rssm_sde_result[0].pan);

            if (data.get_adtdetails_rssm_sde_result[0].pan_copy != "") {
                var pan_img = url + 'uploads/sales/pan/' + data.get_adtdetails_rssm_sde_result[0].pan_copy;
                $("#pan_copy").html(`
            <a target="_blank" href="${pan_img}" title="View Pan " ><i class="fa fa-eye" > Pan view</i> </a>
            `);
            }
            if (data.get_adtdetails_rssm_sde_result[0].aadhar_backview != "" ) {
                var check_img =url + 'uploads/sales/aadhar_backview/' + data.get_adtdetails_rssm_sde_result[0].aadhar_backview;
                    $("#aadhar_backview_copy").html(`
                        <a target="_blank" href="${check_img}" ><i class="fa fa-eye"> Aadhar view(Back Side)</i></a>
                    `);
            }

            if (data.get_adtdetails_rssm_sde_result[0].cheque != "") {
                var cheque_img = url + 'uploads/sales/cheque/' + data.get_adtdetails_rssm_sde_result[0].cheque;
                $("#cheque").html(`
                <a target="_blank" href="${cheque_img}" title="View Cheque"><i class="fa fa-eye" > Cheque</i> </a>
                `);
            }

            $('#bank_name').text(data.get_adtdetails_rssm_sde_result[0].bank_name);
            $('#branch_name').text(data.get_adtdetails_rssm_sde_result[0].branch_name);
            if(data.get_adtdetails_rssm_sde_result[0].service_fee != ''){
                $('#service_fee').text(data.get_adtdetails_rssm_sde_result[0].service_fee);
            
            }else{
                var ser_fee = '-';
                $('#service_fee').text(ser_fee);
            }

            if (data.history.length != 0) {
                $('#view_service_fee_his').attr("onClick",'view('+'"'+rscode+'"'+')');
                $('#view_service_fee_his').removeClass('d-none');
                $('#service_fee').css('color',"");
                $('#service_fee').css('box-shadow',"");
                $('#view_service_fee_his').css('color','#30787a');
            }else{
                $('#view_service_fee_his').addClass('d-none');
                $('#service_fee').css('color',"#ff2f00");
                $('#service_fee').css('box-shadow',"0px 2px red");

            }

            // if(data.get_adtdetails_rssm_sde_result[0].service_fee != '' && data.get_adtdetails_rssm_sde_result[0].service_fee > 20000 && data.get_adtdetails_rssm_sde_result[0].sales_cat =='DSE - Metro'){

            //     if(data.get_adtdetails_rssm_sde_result[0].service_fee != ''){
            //     $('#service_fee').text(data.get_adtdetails_rssm_sde_result[0].service_fee);
            //      $('#service_fee').css('color',"#ff2f00");
            //     $('#service_fee').css('box-shadow',"0px 2px red");

            //     }else{
            //         var ser_fee = '-';
            //         $('#service_fee').text(ser_fee);
            //     }
            // }
            // if(data.get_adtdetails_rssm_sde_result[0].service_fee != '' && data.get_adtdetails_rssm_sde_result[0].service_fee >= 14000 && data.get_adtdetails_rssm_sde_result[0].sales_cat =='DSE - Urban'){
                
            //     if(data.get_adtdetails_rssm_sde_result[0].service_fee != ''){
            //     $('#service_fee').text(data.get_adtdetails_rssm_sde_result[0].service_fee);
            //      $('#service_fee').css('color',"#ff2f00");
            //     $('#service_fee').css('box-shadow',"0px 2px red");
            // }else{
            //     var ser_fee = '-';
            //     $('#service_fee').text(ser_fee);
            // }
            // }
            // if(data.get_adtdetails_rssm_sde_result[0].service_fee != '' && data.get_adtdetails_rssm_sde_result[0].service_fee >= 10000 && data.get_adtdetails_rssm_sde_result[0].sales_cat =='DSE - LPS'){
               
            //     if(data.get_adtdetails_rssm_sde_result[0].service_fee != ''){
            //     $('#service_fee').text(data.get_adtdetails_rssm_sde_result[0].service_fee);
            //      $('#service_fee').css('color',"#ff2f00");
            //         $('#service_fee').css('box-shadow',"0px 2px red");
            // }else{
            //     var ser_fee = '-';
            //     $('#service_fee').text(ser_fee);
            // }
            // }
            // if(data.get_adtdetails_rssm_sde_result[0].service_fee != '' && data.get_adtdetails_rssm_sde_result[0].service_fee >= 12000 && data.get_adtdetails_rssm_sde_result[0].sales_cat =='Rural - RDSE' ||data.get_adtdetails_rssm_sde_result[0].sales_cat =='Rural - TRDSE'||data.get_adtdetails_rssm_sde_result[0].sales_cat =='Rural - DSE DAO'){
                
            //     if(data.get_adtdetails_rssm_sde_result[0].service_fee != ''){
            //     $('#service_fee').text(data.get_adtdetails_rssm_sde_result[0].service_fee);
            //      $('#service_fee').css('color',"#ff2f00");
            //     $('#service_fee').css('box-shadow',"0px 2px red");
            //     }else{
            //         var ser_fee = '-';
            //         $('#service_fee').text(ser_fee);
            //     }
            // }

            $('#ac_number').text(data.get_adtdetails_rssm_sde_result[0].ac_number);
            $('#ac_type').text(data.get_adtdetails_rssm_sde_result[0].ac_type);

            $('#ifsc_s_number').text(data.get_adtdetails_rssm_sde_result[0].ifsc_s_number);

            
            $('#edit_service_fee').attr("onClick",'edit('+'"'+rscode+'"'+')');




            if (data.get_adtdetails_rssm_sde_result[0].img_file != "") {
                var ff_img = url + 'uploads/sales/image/' + data.get_adtdetails_rssm_sde_result[0].img_file;
                $("#img_file").html(`
                <a target="_blank" href="${ff_img}" title="view rssm image" ><i class="fa fa-eye" > Image</i> </a> 
                `);
            }

        }
    });
    
}

function edit(rscode){
    // alert(rscode);
    $('#approve_fee').attr('disabled','');
    $('#view_additional_details').css('z-index', '1000');
    $('#edit_fee').modal('show');
    $.ajax({
        type: "POST",
        url: BASE_URL + 'LeaderController/get_add_details',
        data: {
            "rscode": rscode,
        },
        dataType: "json",
        success: function (data) {
            $('#sales_category').val(data.get_adtdetails_rssm_sde_result[0].sales_cat);
            $('#fee_limit').val(data.get_adtdetails_rssm_sde_result[0].limit);
            $('#given_fee').val(data.get_adtdetails_rssm_sde_result[0].service_fee);
            $('#rs_id').val(rscode);

        }
    });
}

function view(rscode){
    $('#view_additional_details').css('z-index', '1000');
    $('#view_fee').modal('show');
    $.ajax({
        type: "POST",
        url: BASE_URL + 'LeaderController/get_servicefee_his',
        data: {
            "rscode": rscode,
        },
        dataType: "json",
        success: function (data) {
            $('#sales_category').text(data[0].sales_cat);
            $('#fee_limit').text(data[0].limit);
            $('#sde_fee').text(data[0].sde_service_fee);
            $('#new_fee').text(data[0].revised_fee);

        }
    });
}

$('#approve_revised_fee').click(function(){
    $('#approve_revised_fee').attr('disabled','');
    
    var formdata = $('#update_fee').serialize();
    console.log(formdata);
    $.ajax({
        type: "POST",
        url: BASE_URL + 'LeaderController/update_service_fee',
        data: formdata,
        dataType: "json",
        success: function (data) {
            if (data.response == 'success') {
                $('#view_additional_details').modal('hide');
                $('#edit_fee').modal('hide');
                $('#approve_revised_fee').removeAttr('disabled','');

                var example = $('#revised_fee_table').DataTable();
                example.ajax.reload();
                // verification_toast();
                updated_toast();
            }
            else {
                request_failed();
                $('#approve_revised_fee').removeAttr('disabled','');

            }
        }
    });
});

$('#new_fee').keyup(function(){
    
    if($('#new_fee').val() != ''){
        $('#approve_revised_fee').removeAttr('disabled','');
    }else{
        $('#approve_revised_fee').attr('disabled','');
    }
});

$('#edit_fee').on('hidden.bs.modal', function() {
    $('#approve_fee').removeAttr('disabled','');
    $('#view_additional_details').css('z-index', '1050');
    $('#view_additional_details').css('overflow','auto');

});

$('#view_fee').on('hidden.bs.modal', function() {
    $('#view_additional_details').css('z-index', '1050');
    $('#view_additional_details').css('overflow','auto');

});


function verification_toast() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Verified Successfully..!'
	});
}

function rejected_toast() {
	Lobibox.notify('danger', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: 'Rejected Successfully..!'
	});
}

