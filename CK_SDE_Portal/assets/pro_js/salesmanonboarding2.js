$(document).ready(function () {
    get_asm_verified_forms();
    get_rssm_verified_forms();
    get_rssm_rejected_forms();
    get_rssm_pending_forms();
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


function get_asm_verified_forms() {
    var tso_number = $('#get_tso_num').val();
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
                    // 'columns': [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40]
                    'columns': [0,7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 

                },
                "action": newexportaction,
                "customizeData": function(data) {
                    for(var i = 0; i < data.body.length; i++) {
                      for(var j = 0; j < data.body[i].length; j++) {
                        data.body[i][j] = '\u200C' + data.body[i][j];
                      }
                    }
                  }
            },
            {
                "extend": 'csv',
                "text": '<i class="fa fa-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    // 'columns': [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,41]
                    'columns': [0,7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 

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
                // "action": newexportaction
            },

        ],
        columnDefs: [
            {
                targets: [7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 
                visible: false // Set visible to false to hide the specified columns
            }
        ],

         'dom': 'LBfrtip',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'Salesmanonboarding/get_asm_verified_forms',
            'data': {
                'tso_number': tso_number,
            }
        },
        createdRow: function (row, data, dataIndex) {
            $(row).find('td:eq(0)').attr('data-label', 'Sno');
            $(row).find('td:eq(1)').attr('data-label', 'Name');
            $(row).find('td:eq(2)').attr('data-label', 'Mobile No');
            $(row).find('td:eq(3)').attr('data-label', 'ASM Status');
            $(row).find('td:eq(4)').attr('data-label', 'Created On');
            $(row).find('td:eq(5)').attr('data-label', 'Created By');
            $(row).find('td:eq(6)').attr('data-label', 'Action');
            $(row).find('td:eq(7)').attr('data-label', 'Score');
            $(row).find('td:eq(8)').attr('data-label', 'Created By');
            $(row).find('td:eq(9)').attr('data-label', 'Action');

        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "name" },
            { "data": "mobile_no" },
            { "data": "asm_status" },
            { "data": "created_on" },
            { "data": "created_by" },
            { "data": "action" },
            // { "data": "score" },
            // { "data": "bank_name" },
            // { "data": "account_no" },
            // { "data": "branch_name" },
            // { "data": "ifsc_code" },
            // { "data": "account_type" },
            // { "data": "business" },
            // { "data": "name" },
            // { "data": "mobile_no" },
            // { "data": "whatsapp_no" },
            // { "data": "dob" },
            // { "data": "doj" },
            // { "data": "father_name" },
            // { "data": "address" },
            // { "data": "email" },
            // { "data": "asm_status" },
            // { "data": "score" },
            // { "data": "experience" },
            // { "data": "education" },
            // { "data": "age" },

            // { "data": "terrain_knowledge" },
            // { "data": "tech_adoption" },

            // { "data": "family_bg" },
            // { "data": "sales_cat" },
            // { "data": "sales_type" },
            // { "data": "ex_rssm_name" },

            // { "data": "ex_rssm_number" },
            // { "data": "region" },
            // { "data": "rs_name" },
            // { "data": "rs_code" },
            // { "data": "created_by" },
            // { "data": "sde_mobile" },
            // { "data": "asm_name" },
            // { "data": "asm_mobile" },
            // { "data": "asm_email" },
            // { "data": "zsm" },
            // { "data": "zsm_mobile" },
            // { "data": "zsm_email" },
            // { "data": "asm_name" },
            // { "data": "state" },
            // { "data": "division" },

            // { "data": "city" },
            // { "data": "town" },
            // { "data": "town_code" },
            // { "data": "bank_name" },
            // { "data": "branch_name" },
            // { "data": "aadhar" },
            // { "data": "pan" },
            // { "data": "ac_number" },
            // { "data": "account_type" },
            // { "data": "ifsc_s_number" },
            // { "data": "service_fee" },
            // { "data": "created_by" },

            // { "data": "created_on" },
            // { "data": "created_on" },
            
            // { "data": "action" },

            // { "data": "state" },
            // { "data": "division" },
            { "data": "business_division" },
            { "data": "division" },
            { "data": "state" },
            { "data": "region" },
            { "data": "created_by" },
            { "data": "sde_mobile" },
            { "data": "role" },
            { "data": "sde" },
            { "data": "sde_mobile" },
            { "data": "asm_name" },
            { "data": "asm_mobile" },
            { "data": "asm_email" },
            { "data": "zsm" },
            { "data": "zsm_mobile" },
            { "data": "zsm_email" },
            { "data": "sales_type" },
            { "data": "sales_cat" },
            { "data": "rs_code" },
            { "data": "rs_name" },
            { "data": "rstype" },
            { "data": "fftype" },
            { "data": "name" },
            { "data": "mobile_no" },
            { "data": "whatsapp_no" },
            { "data": "dob" },
            { "data": "email" },
            { "data": "father_name" },
            { "data": "service_fee" },
            { "data": "doj" },
            { "data": "pan" },
            { "data": "aadhar" },
            { "data": "ac_number" },
            { "data": "ifsc_code" },
            { "data": "bank_name"},
            { "data": "branch_name" },
            { "data": "created_on" },
            { "data": "emp_code" },
            { "data": "ssfa_id" },
        ],
        "order": [
            [1, 'asc']
        ]
    });

    $('#enteredForm_tb tbody').unbind('click');

    // Add event listener for opening and closing details
    $('#enteredForm_tb tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = example.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(format(row.data())).show();
            // format_new(row.child,nester_tbl_id);
            tr.addClass('shown');
        }
    });
}

function format(d) {
    // `d` is the original data object for the row
    return '<table class="table" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;" id="child_view">' +
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
        '<td class="hide table-info"><strong>WhatsApp No.</strong></td>' +
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

$('.submit-btn').click(function () {
    var formData = new FormData($('#add_det')[0]);

    var aaa = $('#select_rs_name').val();
    var region_name = $('#region_name').val();
    if (ValiditeState()) {
        $.ajax({
            url: BASE_URL + 'Salesmanonboarding/insert_details',
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,
            success: function (data) {
                updated_toast();
                $('#add_additional_details').modal('hide');
                var example = $('#enteredForm_tb').DataTable();
                example.ajax.reload();
            }
        });
    } else {
        alert('fail');
    }

})

function view_adddetails(rscode) {
    $('#view_additional_details').modal('show');
    $("#edit_currentStepInput").val("1");
    $('#edit_rscode').val(rscode);
    
    
    $.ajax({
        type: "POST",
        url: BASE_URL + 'Salesmanonboarding/get_add_details',
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
            $('#sde_name').text(data.get_adtdetails_rssm_sde_result[0].tso);
            $('#business').text(data.get_adtdetails_rssm_sde_result[0].business_division);
            $('#ex_sales_category').text(data.get_adtdetails_rssm_sde_result[0].ex_sales_category);

            if (data.get_adtdetails_rssm_sde_result[0].sales_type == 'New SalesMan') {
                $('.new_details').css('display', 'flex');
                $('.ex_details').css('display', 'none');

            } else {
                $('.new_details').css('display', 'none');
                $('.ex_details').css('display', 'flex');
            }

            // var check_img = url+'uploads/aadhar/'+data.get_adtdetails_rssm_sde_result[0].aadhar_copy;
            // var view = '<a href='+check_img+' >view</a>';
 
            $('#aadhar').text(data.get_adtdetails_rssm_sde_result[0].aadhar);
            if (data.get_adtdetails_rssm_sde_result[0].aadhar_copy != "") {
                var check_img = url + 'uploads/aadhar/' + data.get_adtdetails_rssm_sde_result[0].aadhar_copy;
                $("#aadhar_copy").html(`
            <a target="_blank" href="${check_img}" ><i class="fa fa-eye"> Aadhar view(Front Side)</i></a>
            `);
            }
            if (data.get_adtdetails_rssm_sde_result[0].aadhar_backview != "") {
                var check_img =url + 'uploads/aadhar_backview/' + data.get_adtdetails_rssm_sde_result[0].aadhar_backview;
                $("#aadhar_backview_copy").html(`
            <a target="_blank" href="${check_img}" ><i class="fa fa-eye"> Aadhar view(Back Side)</i></a>
            `);
            }
            // $('#aadhar_copy').text(view);
            $('#pan').text(data.get_adtdetails_rssm_sde_result[0].pan);

            if (data.get_adtdetails_rssm_sde_result[0].pan_copy != "") {
                var pan_img = url + 'uploads/pan/' + data.get_adtdetails_rssm_sde_result[0].pan_copy;
                $("#pan_copy").html(`
            <a target="_blank" href="${pan_img}" title="View Pan " ><i class="fa fa-eye" > Pan view</i> </a>
            `);
            }

            // $('#cheque').text(data.get_adtdetails_rssm_sde_result[0].cheque);
            if (data.get_adtdetails_rssm_sde_result[0].cheque != "") {
                var cheque_img = url + 'uploads/cheque/' + data.get_adtdetails_rssm_sde_result[0].cheque;
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

            $('#ac_number').text(data.get_adtdetails_rssm_sde_result[0].ac_number);
            $('#ac_type').text(data.get_adtdetails_rssm_sde_result[0].ac_type);

            $('#ifsc_s_number').text(data.get_adtdetails_rssm_sde_result[0].ifsc_s_number);

            if (data.get_adtdetails_rssm_sde_result[0].img_file != "") {
                var ff_img = url + 'uploads/image/' + data.get_adtdetails_rssm_sde_result[0].img_file;
                $("#img_file").html(`
            <a target="_blank" href="${ff_img}" title="view rssm image" ><i class="fa fa-eye" > Image</i> </a> 
            `);
            }

            if(data.get_adtdetails_rssm_sde_result[0].ssfa_id == ''){
                $('.verified').addClass('d-none');
                $('#reject_form').addClass('d-none');
            }else{
                $('.verified').removeClass('d-none');
                $('#reject_form').removeClass('d-none');
            }

            if (data.history.length != 0) {
                $('#view_service_fee_his').attr("onClick",'view('+'"'+rscode+'"'+')');
                $('#view_service_fee_his').removeClass('d-none');
                // $('#service_fee').css('color',"");
                // $('#service_fee').css('box-shadow',"");
                $('#view_service_fee_his').css('color','#30787a');
            }else{
                $('#view_service_fee_his').addClass('d-none');
                // $('#service_fee').css('color',"#ff2f00");
                // $('#service_fee').css('box-shadow',"0px 2px red");

            }

            $('#business_division').text(data.get_adtdetails_rssm_sde_result[0].division);
            $('#creator_name').text(data.get_adtdetails_rssm_sde_result[0].created_by_name);
            $('#creator_mobile').text(data.get_adtdetails_rssm_sde_result[0].created_by);
            if(data.get_adtdetails_rssm_sde_result[0].created_by_role != '' && data.get_adtdetails_rssm_sde_result[0].created_by_role =='TSO'){
                var role = 'SDE';
            }else{
                var role = data.get_adtdetails_rssm_sde_result[0].created_by_role;
            }
            $('#created_by_role').text(role);
            $('#sde_name_cd').text(data.get_adtdetails_rssm_sde_result[0].tso);
            $('#asm_name_cd').text(data.get_adtdetails_rssm_sde_result[0].asm);
            $('#asm_number_cd').text(data.get_adtdetails_rssm_sde_result[0].asm_number);
            if(data.get_adtdetails_rssm_sde_result[0].asm_email != '' && data.get_adtdetails_rssm_sde_result[0].asm_email != null){
                var asm_email = data.get_adtdetails_rssm_sde_result[0].asm_email;
            }else{
                var asm_email = '-';
            }
            $('#asm_mail_cd').text(asm_email);
            $('#zsm_name_cd').text(data.get_adtdetails_rssm_sde_result[0].zsm);
            $('#zsm_number_cd').text(data.get_adtdetails_rssm_sde_result[0].zsm_number);
            if(data.get_adtdetails_rssm_sde_result[0].zsm_email != '' && data.get_adtdetails_rssm_sde_result[0].zsm_email != null){
                var zsm_email = data.get_adtdetails_rssm_sde_result[0].zsm_email;
            }else{
                var zsm_email = '-';
            }
            $('#zsm_mail_cd').text(zsm_email);
            // $('#zsm_mail_cd').text(data.get_adtdetails_rssm_sde_result[0].zsm_email);
            var datetime = new Date(data.get_adtdetails_rssm_sde_result[0].created_on);
            var date = datetime.toLocaleDateString();
            $('#received_date').text(date);

        }
    });
    
}
$('#ssfa_id').keyup(function(){
    
    if($('#ssfa_id').val() != ''){
        $('#save_id').removeAttr('disabled','');
    }else{
        $('#save_id').attr('disabled','');
    }
})

function add_ssfa_id(rscode) {
    $('.get_id').modal('show');
    $("#edit_currentStepInput").val("1");
    $('#rowid').val(rscode);
    
    
    $.ajax({
        type: "POST",
        url: BASE_URL + 'Salesmanonboarding/get_add_details',
        data: {
            "rscode": rscode,

        },
        dataType: "json",
        success: function (data) {
            $('#emp_code').val(data.get_adtdetails_rssm_sde_result[0].emp_code);
            $('#emp_code').attr('readonly','');
            $('#save_id').attr('disabled','');

        }
            
    });
    
}

$('.verified').on('click',function(){
    $('.get_id').modal('show');
    $('#view_additional_details').css('z-index', '1000');
});

function getrowid(){
   $('#rowid').val($('#table_row_id').text());
}
$('#save_id').on('click', function () {
    if($('#emp_code').val() == ''){
        fields_required();
    }else{
        $.ajax({
            type: "POST",
            url: BASE_URL + 'Salesmanonboarding/process_rssm_action',
            data: $('#get_ssfaid').serialize(),
            dataType: "json",
            success: function (data) {
                $('#action_close').click();
    
                if (data.response == 'success') {
                    $('#view_additional_details').modal('hide');
                    $('.get_id').modal('hide');
                    var example = $('#enteredForm_tb').DataTable();
                    example.ajax.reload();
                    var example = $('#pending_forms_tb').DataTable();
                    example.ajax.reload();
                    updated_toast();
                }
                else {
                    request_failed();
                }
            }
        });
    }
    
});

function get_rssm_verified_forms() {
    var tso_number = $('#get_tso_num').val();
    // console.log(tso_number);
    var example = $('#rssm_verified').DataTable({
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
                    // 'columns': [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40]
                    'columns': [7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 

                },
                "action": newexportaction,
                "customizeData": function(data) {
                    for(var i = 0; i < data.body.length; i++) {
                      for(var j = 0; j < data.body[i].length; j++) {
                        data.body[i][j] = '\u200C' + data.body[i][j];
                      }
                    }
                  }
            },
            {
                "extend": 'csv',
                "text": '<i class="fa fa-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    // 'columns': [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40]
                    'columns': [7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 

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
        columnDefs: [
            {
                // targets: [3,4,5,6,7,8,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38], 
                targets: [7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 

                visible: false // Set visible to false to hide the specified columns
            }
        ],
         'dom': 'LBfrtip',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'Salesmanonboarding/get_rssm_verified_forms',
            'data': {
                'tso_number': tso_number,
            }
        },
        createdRow: function (row, data, dataIndex) {
            $(row).find('td:eq(0)').attr('data-label', '#');
            $(row).find('td:eq(1)').attr('data-label', 'Sno');
            $(row).find('td:eq(2)').attr('data-label', 'Name');
            $(row).find('td:eq(3)').attr('data-label', 'Mobile No');
            $(row).find('td:eq(4)').attr('data-label', 'WhatsApp Number');
            $(row).find('td:eq(5)').attr('data-label', 'Date of Birth');
            $(row).find('td:eq(6)').attr('data-label', 'Date of Joining');
            $(row).find('td:eq(7)').attr('data-label', 'Father`s Name');
            $(row).find('td:eq(8)').attr('data-label', 'Address');
            $(row).find('td:eq(9)').attr('data-label', 'Email ID');
            $(row).find('td:eq(10)').attr('data-label', 'ASM Status');
            $(row).find('td:eq(11)').attr('data-label', 'Score');

            $(row).find('td:eq(12)').attr('data-label', 'Experience');
            $(row).find('td:eq(13)').attr('data-label', 'Education');
            $(row).find('td:eq(14)').attr('data-label', 'Terrain Knowledge');
            $(row).find('td:eq(15)').attr('data-label', 'Technology Adaption');
            $(row).find('td:eq(16)').attr('data-label', 'Family Background');
            $(row).find('td:eq(17)').attr('data-label', 'Sales Category');
            $(row).find('td:eq(18)').attr('data-label', 'Sales Type');
            $(row).find('td:eq(19)').attr('data-label', 'Existing RSSM Name');
            $(row).find('td:eq(20)').attr('data-label', 'Existing RSSM Number');
            $(row).find('td:eq(21)').attr('data-label', 'Region');
            $(row).find('td:eq(22)').attr('data-label', 'RS Name');
            $(row).find('td:eq(23)').attr('data-label', 'RS Code');


            $(row).find('td:eq(24)').attr('data-label', 'State Name');
            $(row).find('td:eq(25)').attr('data-label', 'District Name');
            $(row).find('td:eq(26)').attr('data-label', 'City Name');
            $(row).find('td:eq(27)').attr('data-label', 'Town Name');
            $(row).find('td:eq(28)').attr('data-label', 'Bank Name');
            $(row).find('td:eq(29)').attr('data-label', 'Aadhar Number');
            $(row).find('td:eq(30)').attr('data-label', 'Sales Type');
            $(row).find('td:eq(31)').attr('data-label', 'PAN Number');
            $(row).find('td:eq(32)').attr('data-label', 'A/C Number');
            $(row).find('td:eq(33)').attr('data-label', 'A/C Type');
            $(row).find('td:eq(34)').attr('data-label', 'IFSC Code');
            $(row).find('td:eq(35)').attr('data-label', 'Branch Name');


            $(row).find('td:eq(36)').attr('data-label', 'Created On');
            // $(row).find('td:eq(5)').attr('data-label', 'VA Status');
            // $(row).find('td:eq(6)').attr('data-label', 'ASM Status');
            // $(row).find('td:eq(7)').attr('data-label', 'Score');
            // $(row).find('td:eq(8)').attr('data-label', 'Created By');
            $(row).find('td:eq(37)').attr('data-label', 'Action');
            // $(row).find('td:eq(9)').attr('data-label', 'SDE Name');
            // $(row).find('td:eq(9)').attr('data-label', 'Action');

// Family Background

        },
        "columns": [
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "name" },
            { "data": "mobile_no" },
            { "data": "asm_status" },
            { "data": "created_on" },
            { "data": "created_by" },
            { "data": "action" },
            // { "data": "score" },
            // { "data": "bank_name" },
            // { "data": "account_no" },
            // { "data": "branch_name" },
            // { "data": "ifsc_code" },
            // { "data": "account_type" },

            // { "data": "business" },
            // { "data": "name" },
            // { "data": "mobile_no" },
            // { "data": "whatsapp_no" },
            // { "data": "dob" },
            // { "data": "doj" },
            // { "data": "father_name" },
            // { "data": "address" },
            // { "data": "email" },
            // { "data": "asm_status" },
            // { "data": "score" },
            // { "data": "experience" },
            // { "data": "education" },
            // { "data": "age" },

            // { "data": "terrain_knowledge" },
            // { "data": "tech_adoption" },

            // { "data": "family_bg" },
            // { "data": "sales_cat" },
            // { "data": "sales_type" },
            // { "data": "ex_rssm_name" },

            // { "data": "ex_rssm_number" },
            // { "data": "region" },
            // { "data": "rs_name" },
            // { "data": "rs_code" },
            // { "data": "created_by" },
            // { "data": "sde_mobile" },
            // { "data": "asm_name" },
            // { "data": "asm_mobile" },
            // { "data": "asm_email" },
            // { "data": "zsm" },
            // { "data": "zsm_mobile" },
            // { "data": "zsm_email" },
            // { "data": "state" },
            // { "data": "division" },

            // { "data": "city" },
            // { "data": "town" },
            // { "data": "town_code" },
            // { "data": "bank_name" },
            // { "data": "branch_name" },
            // { "data": "aadhar" },
            // { "data": "pan" },
            // { "data": "ac_number" },
            // { "data": "account_type" },
            // { "data": "ifsc_s_number" },
            // { "data": "service_fee" },

            // { "data": "created_by" },

            // { "data": "created_on" },
            
            // { "data": "action" },

            { "data": "business_division" },
            { "data": "division" },
            { "data": "state" },
            { "data": "region" },
            { "data": "created_by" },
            { "data": "sde_mobile" },
            { "data": "role" },
            { "data": "sde" },
            { "data": "sde_mobile" },
            { "data": "asm_name" },
            { "data": "asm_mobile" },
            { "data": "asm_email" },
            { "data": "zsm" },
            { "data": "zsm_mobile" },
            { "data": "zsm_email" },
            { "data": "sales_type" },
            { "data": "sales_cat" },
            { "data": "rs_code" },
            { "data": "rs_name" },
            { "data": "rstype" },
            { "data": "fftype" },
            { "data": "name" },
            { "data": "mobile_no" },
            { "data": "whatsapp_no" },
            { "data": "dob" },
            { "data": "email" },
            { "data": "father_name" },
            { "data": "service_fee" },
            { "data": "doj" },
            { "data": "pan" },
            { "data": "aadhar" },
            { "data": "ac_number" },
            { "data": "ifsc_code" },
            { "data" : "bank_name"},
            { "data": "branch_name" },
            { "data": "created_on" },
            { "data": "emp_code" },
            { "data": "ssfa_id" },


        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
    $('#enteredForm_tb tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = example.row(tr);
        // var nester_tbl_id = row.data().auto_id;

        if (row.child.isShown()) {
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
    });
}
 
function get_rssm_pending_forms() {
    var tso_number = $('#get_tso_num').val();
    // console.log(tso_number);
    var example = $('#pending_forms_tb').DataTable({
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
                    'columns': [7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 

                },
                "action": newexportaction,
                "customizeData": function(data) {
                    for(var i = 0; i < data.body.length; i++) {
                      for(var j = 0; j < data.body[i].length; j++) {
                        data.body[i][j] = '\u200C' + data.body[i][j];
                      }
                    }
                  }
            },
            {
                "extend": 'csv',
                "text": '<i class="fa fa-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    'columns': [7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 

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
        columnDefs: [
            {
                targets: [7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 
                visible: false 
            }
        ],
        'dom': 'LBfrtip',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,
        'ajax': {
            'url': BASE_URL + 'Salesmanonboarding/get_verified_forms',
            'data': {
                'tso_number': tso_number,
            }
        },
        createdRow: function (row, data, dataIndex) {
            $(row).find('td:eq(0)').attr('data-label', '#');
            $(row).find('td:eq(1)').attr('data-label', 'Sno');
            $(row).find('td:eq(2)').attr('data-label', 'Name');
            $(row).find('td:eq(3)').attr('data-label', 'Mobile No');
            $(row).find('td:eq(4)').attr('data-label', 'WhatsApp Number');
            $(row).find('td:eq(5)').attr('data-label', 'Date of Birth');
            $(row).find('td:eq(6)').attr('data-label', 'Date of Joining');
            $(row).find('td:eq(7)').attr('data-label', 'Father`s Name');
            $(row).find('td:eq(8)').attr('data-label', 'Address');
            $(row).find('td:eq(9)').attr('data-label', 'Email ID');
            $(row).find('td:eq(10)').attr('data-label', 'ASM Status');
            $(row).find('td:eq(11)').attr('data-label', 'Score');

            $(row).find('td:eq(12)').attr('data-label', 'Experience');
            $(row).find('td:eq(13)').attr('data-label', 'Education');
            $(row).find('td:eq(14)').attr('data-label', 'Terrain Knowledge');
            $(row).find('td:eq(15)').attr('data-label', 'Technology Adaption');
            $(row).find('td:eq(16)').attr('data-label', 'Family Background');
            $(row).find('td:eq(17)').attr('data-label', 'Sales Category');
            $(row).find('td:eq(18)').attr('data-label', 'Sales Type');
            $(row).find('td:eq(19)').attr('data-label', 'Existing RSSM Name');
            $(row).find('td:eq(20)').attr('data-label', 'Existing RSSM Number');
            $(row).find('td:eq(21)').attr('data-label', 'Region');
            $(row).find('td:eq(22)').attr('data-label', 'RS Name');
            $(row).find('td:eq(23)').attr('data-label', 'RS Code');

            $(row).find('td:eq(24)').attr('data-label', 'State Name');
            $(row).find('td:eq(25)').attr('data-label', 'District Name');
            $(row).find('td:eq(26)').attr('data-label', 'City Name');
            $(row).find('td:eq(27)').attr('data-label', 'Town Name');
            $(row).find('td:eq(28)').attr('data-label', 'Bank Name');
            $(row).find('td:eq(29)').attr('data-label', 'Aadhar Number');
            $(row).find('td:eq(30)').attr('data-label', 'Sales Type');
            $(row).find('td:eq(31)').attr('data-label', 'PAN Number');
            $(row).find('td:eq(32)').attr('data-label', 'A/C Number');
            $(row).find('td:eq(33)').attr('data-label', 'A/C Type');
            $(row).find('td:eq(34)').attr('data-label', 'IFSC Code');
            $(row).find('td:eq(35)').attr('data-label', 'Branch Name');

            $(row).find('td:eq(36)').attr('data-label', 'Created On');
            $(row).find('td:eq(37)').attr('data-label', 'Action');

        },
        "columns": [
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "name" },
            { "data": "mobile_no" },
            { "data": "asm_status" },
            { "data": "created_on" },
            { "data": "created_by" },
            { "data": "action" },
            { "data": "business_division" },
            { "data": "division" },
            { "data": "state" },
            { "data": "region" },
            { "data": "created_by" },
            { "data": "sde_mobile" },
            { "data": "role" },
            { "data": "sde" },
            { "data": "sde_mobile" },
            { "data": "asm_name" },
            { "data": "asm_mobile" },
            { "data": "asm_email" },
            { "data": "zsm" },
            { "data": "zsm_mobile" },
            { "data": "zsm_email" },
            { "data": "sales_type" },
            { "data": "sales_cat" },
            { "data": "rs_code" },
            { "data": "rs_name" },
            { "data": "rstype" },
            { "data": "fftype" },
            { "data": "name" },
            { "data": "mobile_no" },
            { "data": "whatsapp_no" },
            { "data": "dob" },
            { "data": "email" },
            { "data": "father_name" },
            { "data": "service_fee" },
            { "data": "doj" },
            { "data": "pan" },
            { "data": "aadhar" },
            { "data": "ac_number" },
            { "data": "ifsc_code" },
            { "data" : "bank_name"},
            { "data": "branch_name" },
            { "data": "created_on" },
            { "data": "emp_code" },
            { "data": "ssfa_id" },


        ],
        "order": [
            [1, 'asc']
        ]
    });

    $('#enteredForm_tb tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = example.row(tr);
        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
}

$('#reject_form').on('click' , function(){
    $('#view_additional_details').css('z-index', '1000');
    $('.reject_reason').modal('show');
    $('#rej_reason').val('');
});



$('.rejected').on('click', function () {
    var auto_id = $('#table_row_id').text();
    var reason = $('#rej_reason').val();
    if(reason == ''){
        fields_required();
    }else{
    $('#reject_form').attr("disabled");
    $.ajax({
        type: "POST",
        url: BASE_URL + 'Salesmanonboarding/reject_rssm_action',
        data: {
            "auto_id": auto_id,
            "reason": reason
        },
        dataType: "json",
        success: function (data) {
            $('#action_close').click();

            if (data.response == 'success') {
                $('#view_additional_details').modal('hide');
                $('.reject_reason').modal('hide');
                // rejected_toast();
                updated_toast();

                var example = $('#enteredForm_tb').DataTable();
                example.ajax.reload();
                $('#reject_form').removeAttr("disabled");

            }
            else {
                request_failed();
                $('#reject_form').removeAttr("disabled");

            }
        }
    });
}
});

function get_rssm_rejected_forms() {
    var tso_number = $('#get_tso_num').val();
    var example = $('#rssm_rejected').DataTable({
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
                    // 'columns': [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40]
                    'columns': [7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 

                },
                "action": newexportaction,
                "customizeData": function(data) {
                    for(var i = 0; i < data.body.length; i++) {
                      for(var j = 0; j < data.body[i].length; j++) {
                        data.body[i][j] = '\u200C' + data.body[i][j];
                      }
                    }
                  }
            },
            {
                "extend": 'csv',
                "text": '<i class="fa fa-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    // 'columns': [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40]
                    'columns': [7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 

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
        columnDefs: [
            {
                targets: [7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 
                // targets: [1,3,4,5,6,7,8,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38], // Specify the columns to be initially hidden (columns 1 and 3)
                visible: false // Set visible to false to hide the specified columns
            }
        ],
        'dom': 'LBfrtip',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,
        'ajax': {
            'url': BASE_URL + 'Salesmanonboarding/get_rssm_rejected_forms',
            'data': {
                'tso_number': tso_number,
            }
        },
        createdRow: function (row, data, dataIndex) {
            // $(row).find('td:eq(0)').attr('data-label', '#');
            $(row).find('td:eq(0)').attr('data-label', 'Sno');
            $(row).find('td:eq(1)').attr('data-label', 'Name');
            $(row).find('td:eq(2)').attr('data-label', 'Mobile No');
            $(row).find('td:eq(3)').attr('data-label', 'Created On');
            $(row).find('td:eq(4)').attr('data-label', 'ASM Status');
            $(row).find('td:eq(5)').attr('data-label', 'Created By');
            $(row).find('td:eq(6)').attr('data-label', 'Action');
            $(row).find('td:eq(7)').attr('data-label', 'Score');
            $(row).find('td:eq(8)').attr('data-label', 'Bank Name');
            $(row).find('td:eq(9)').attr('data-label', 'Account No');
            $(row).find('td:eq(10)').attr('data-label', 'Branch Name');
            $(row).find('td:eq(11)').attr('data-label', 'IFSC Code');
            $(row).find('td:eq(12)').attr('data-label', 'Account Type');

        },
        "columns": [
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "name" },
            { "data": "mobile_no" },
            { "data": "asm_status" },
            { "data": "created_on" },
            { "data": "created_by" },
            { "data": "action" },
            // { "data": "score" },
            // { "data": "bank_name" },
            // { "data": "account_no" },
            // { "data": "branch_name" },
            // { "data": "ifsc_code" },
            // { "data": "account_type" },
            // { "data": "business" },
            // { "data": "name" },
            // { "data": "mobile_no" },
            // { "data": "whatsapp_no" },
            // { "data": "dob" },
            // { "data": "doj" },
            // { "data": "father_name" },
            // { "data": "address" },
            // { "data": "email" },
            // { "data": "asm_status" },
            // { "data": "score" },
            // { "data": "experience" },

            // { "data": "education" },
            // { "data": "age" },

            // { "data": "terrain_knowledge" },
            // { "data": "tech_adoption" },
            // { "data": "family_bg" },
            // { "data": "sales_cat" },
            // { "data": "sales_type" },
            // { "data": "ex_rssm_name" },

            // { "data": "ex_rssm_number" },
            // { "data": "region" },
            // { "data": "rs_name" },

            // { "data": "rs_code" },
            // { "data": "created_by" },
            // { "data": "sde_mobile" },
            // { "data": "asm_name" },
            // { "data": "asm_mobile" },
            // { "data": "asm_email" },
            // { "data": "zsm" },
            // { "data": "zsm_mobile" },
            // { "data": "zsm_email" },
            // { "data": "asm_name" },
            // { "data": "state" },
            // { "data": "division" },
            // { "data": "city" },
            // { "data": "town" },
            // { "data": "town_code" },
            // { "data": "bank_name" },
            // { "data": "branch_name" },

            // { "data": "aadhar" },
            // { "data": "pan" },
            // { "data": "ac_number" },
            // { "data": "account_type" },
            // { "data": "ifsc_s_number" },
            // { "data": "service_fee" },

            // { "data": "created_by" },

            // { "data": "created_on" },
            // { "data": "action" },

            { "data": "business_division" },
            { "data": "division" },
            { "data": "state" },
            { "data": "region" },
            { "data": "created_by" },
            { "data": "sde_mobile" },
            { "data": "role" },
            { "data": "sde" },
            { "data": "sde_mobile" },
            { "data": "asm_name" },
            { "data": "asm_mobile" },
            { "data": "asm_email" },
            { "data": "zsm" },
            { "data": "zsm_mobile" },
            { "data": "zsm_email" },
            { "data": "sales_type" },
            { "data": "sales_cat" },
            { "data": "rs_code" },
            { "data": "rs_name" },
            { "data": "rstype" },
            { "data": "fftype" },
            { "data": "name" },
            { "data": "mobile_no" },
            { "data": "whatsapp_no" },
            { "data": "dob" },
            { "data": "email" },
            { "data": "father_name" },
            { "data": "service_fee" },
            { "data": "doj" },
            { "data": "pan" },
            { "data": "aadhar" },
            { "data": "ac_number" },
            { "data": "ifsc_code" },
            { "data" : "bank_name"},
            { "data": "branch_name" },
            { "data": "created_on" },
            { "data": "emp_code" },
            { "data": "ssfa_id" },

        ],
        "order": [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
    $('#enteredForm_tb tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = example.row(tr);
        // var nester_tbl_id = row.data().auto_id;

        if (row.child.isShown()) {
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
    });
}

function download_excel(rowid){

    $.ajax({
        type: "POST",
        url: BASE_URL + 'Salesmanonboarding/download_beat_excel',
        data:{
            rowid:rowid
        },
        dataType: "json",
        success: function (data) {

            if (data.file_url) {
                // Trigger file download in the browser
                var link = document.createElement('a');
                link.href = data.file_url;
                link.download = 'Beat_Excel.xlsx';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Other actions after successful download
                $('#view_additional_details').modal('hide');
                $('.get_id').modal('hide');
                var example = $('#enteredForm_tb').DataTable();
                example.ajax.reload();
                // updated_toast();
            } else {
                request_failed();
            }
        }
    });
}

$('.reject_reason').on('hidden.bs.modal', function() {
    $('#view_additional_details').css('z-index', '1050');
    $('#view_additional_details').css('overflow','auto');
});

$('.get_id').on('hidden.bs.modal', function() {
    $('#view_additional_details').css('z-index', '1050');
    $('#view_additional_details').css('overflow','auto');


});

$('#view_fee').on('hidden.bs.modal', function() {
    $('#view_additional_details').css('z-index', '1050');
    $('#view_additional_details').css('overflow','auto');

});

function view(rscode){
    $('#view_additional_details').css('z-index', '1000');
    $('#view_fee').modal('show');
    $.ajax({
        type: "POST",
        url: BASE_URL + 'Salesmanonboarding/get_servicefee_his',
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
