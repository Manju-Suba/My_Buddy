$(document).ready(function () {

    get_tso_list();
    get_va_verified_forms();

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

$('#af_tso_list').on('change', function () {
    get_va_verified_forms();

});

$('#btnClear').on('click', function () {

    $('#af_tso_list').val('').trigger('change');
    // $('#af_va_status').val('').trigger('change');
    // $('#af_asm_status').val('').trigger('change');
    get_va_verified_forms();

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

function get_va_verified_forms() {
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
            'url': BASE_URL + 'ASMController/get_va_verified_forms',
            'data': function (data) {
                data.asm_number = $('#session_mobile_no').val();
                data.tso_number = $('#af_tso_list').val();
                // data.af_va_status = $('#af_va_status').val();
                // data.af_asm_status = $('#af_asm_status').val();

            }
        },
        createdRow: function (row, data, dataIndex) {
            $(row).find('td:eq(0)').attr('data-label', '#');
            $(row).find('td:eq(1)').attr('data-label', 'Sno');
            $(row).find('td:eq(2)').attr('data-label', 'Name');
            $(row).find('td:eq(3)').attr('data-label', 'Mobile No');
            $(row).find('td:eq(4)').attr('data-label', 'Created On');
            $(row).find('td:eq(5)').attr('data-label', 'VSO Status');
            $(row).find('td:eq(6)').attr('data-label', 'ASM Status');
            $(row).find('td:eq(7)').attr('data-label', 'SDE Score');
            $(row).find('td:eq(8)').attr('data-label', 'VSO Score');
            $(row).find('td:eq(9)').attr('data-label', 'Created By');
            $(row).find('td:eq(10)').attr('data-label', 'Action');

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
        "rowCallback": function(row, data, index) {
            // var valueToCheck = data[2]; // Change '2' to your actual column index
            // if(data['service_fee'] != '' && data['service_fee'] >= 8500 && data['sales_cat'] =='DSE'){
            //     $(row).addClass('above_avr_salary');
            //     $('#enteredForm_tb').removeClass("table-striped")
            // }
            if(data['service_fee'] > data['limit']){
                $(row).addClass('above_avr_salary');
                $('#enteredForm_tb').removeClass("table-striped")
            }
            // console.log(data);
            // if(data['service_fee'] != '' && data['service_fee'] > 20000 && data['sales_cat'] =='DSE - Metro'){
            //     $(row).addClass('above_avr_salary');
            //     $('#enteredForm_tb').removeClass("table-striped")
            // }
            // if(data['service_fee'] != '' && data['service_fee'] >= 14000 && data['sales_cat'] =='DSE - Urban'){
            //     $(row).addClass('above_avr_salary');
            //     $('#enteredForm_tb').removeClass("table-striped")
            // }
            // if(data['service_fee'] != '' && data['service_fee'] >= 10000 && data['sales_cat'] =='DSE - LPS'){
            //     $(row).addClass('above_avr_salary');
            //     $('#enteredForm_tb').removeClass("table-striped")
            // }
            // if(data['service_fee'] != '' && data['service_fee'] >= 12000 && data['sales_cat'] =='Rural - RDSE' ||data['sales_cat'] =='Rural - TRDSE'||data['sales_cat'] =='Rural - DSE DAO'){
            //     $(row).addClass('above_avr_salary');
            //     $('#enteredForm_tb').removeClass("table-striped")
            // }
        },
        "order": [
            [1, 'asc']
        ]
    });
    $('#enteredForm_tb tbody').unbind('click');

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

function format(d) {
    if(d.alt_mobile_no == ''){
        $w_number ="-";
    }else{
        $w_number =d.alt_mobile_no;

    }
    if(d.resume == ''){
        $resume ="-";
    }else{
        $resume =d.resume;

    }


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
        '<td>' + $w_number + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Address</strong></td>' +
        '<td>' + d.address + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td class="hide table-info"><strong>Resume</strong></td>' +
        '<td>' + $resume + '</td>' +
        '</tr>' +


        '</table>';
}

function view_adddetails(table_row_id) {
    // var BASE_URL = 

    $.ajax({
        type: "POST",
        url: BASE_URL + 'RSSMController/get_adtdetails_rssm',
        data: {
            "table_row_id": table_row_id,
        },
        dataType: "json",
        success: function (data) {
            console.log(data);

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
                $('#tso_name').text(data.get_adtdetails_rssm_sde_result[0].tso);
                if (data.get_adtdetails_rssm_sde_result[0].sales_type == 'New SalesMan') {
                    $('.new_details').css('display', 'flex');
                    $('.ex_details').css('display', 'none');

                } else {
                    $('.new_details').css('display', 'none');
                    $('.ex_details').css('display', 'flex');
                }

                $('#aadhar').text(data.get_adtdetails_rssm_sde_result[0].aadhar);
                if (data.get_adtdetails_rssm_sde_result[0].pan_copy != "") {
                    var check_img = url + 'uploads/sales/aadhar/' + data.get_adtdetails_rssm_sde_result[0].aadhar_copy;
                    $("#aadhar_copy").html(`
                    <a target="_blank" href="${check_img}" ><i class="fa fa-eye"> Aadhar view(Front Side)</i></a> 
                    `);
                }

                $('#pan').text(data.get_adtdetails_rssm_sde_result[0].pan);
                if (data.get_adtdetails_rssm_sde_result[0].pan_copy != "") {
                    var pan_img = url + 'uploads/sales/pan/' + data.get_adtdetails_rssm_sde_result[0].pan_copy;
                    $("#pan_copy").html(`
                    <a target="_blank" href="${pan_img}" ><i class="fa fa-eye"> Pan view</i> </a>
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
                    <a target="_blank" href="${cheque_img}" ><i class="fa fa-eye"> Cheque</i></a> 
                    `);
                }

                $('#table_row_id').text(data.get_adtdetails_rssm_sde_result[0].auto_id);
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
                    var ff_img = url + 'uploads/sales/image/' + data.get_adtdetails_rssm_sde_result[0].img_file;
                    $("#img_file").html(`
                    <a target="_blank" href="${ff_img}" ><i class="fa fa-eye"> Image</i></a> 
                    `);
                }

                if(data.get_adtdetails_rssm_sde_result[0].service_fee != ''){
                    $('#service_fee').text(data.get_adtdetails_rssm_sde_result[0].service_fee);
                }else{
                    var ser_fee = '-';
                    $('#service_fee').text(ser_fee);
                }
    
                if(data.get_adtdetails_rssm_sde_result[0].service_fee != '' && data.get_adtdetails_rssm_sde_result[0].service_fee > 20000 && data.get_adtdetails_rssm_sde_result[0].sales_cat =='DSE - Metro'){
    
                    if(data.get_adtdetails_rssm_sde_result[0].service_fee != ''){
                    $('#service_fee').text(data.get_adtdetails_rssm_sde_result[0].service_fee);
                     $('#service_fee').css('color',"#ff2f00");
$('#service_fee').css('box-shadow',"0px 2px red");
    
                }else{
                    var ser_fee = '-';
                    $('#service_fee').text(ser_fee);
                }
                }
                if(data.get_adtdetails_rssm_sde_result[0].service_fee != '' && data.get_adtdetails_rssm_sde_result[0].service_fee >= 14000 && data.get_adtdetails_rssm_sde_result[0].sales_cat =='DSE - Urban'){
                    
                    if(data.get_adtdetails_rssm_sde_result[0].service_fee != ''){
                    $('#service_fee').text(data.get_adtdetails_rssm_sde_result[0].service_fee);
                     $('#service_fee').css('color',"#ff2f00");
$('#service_fee').css('box-shadow',"0px 2px red");
                }else{
                    var ser_fee = '-';
                    $('#service_fee').text(ser_fee);
                }
                }
                if(data.get_adtdetails_rssm_sde_result[0].service_fee != '' && data.get_adtdetails_rssm_sde_result[0].service_fee >= 10000 && data.get_adtdetails_rssm_sde_result[0].sales_cat =='DSE - LPS'){
                   
                    if(data.get_adtdetails_rssm_sde_result[0].service_fee != ''){
                    $('#service_fee').text(data.get_adtdetails_rssm_sde_result[0].service_fee);
                     $('#service_fee').css('color',"#ff2f00");
$('#service_fee').css('box-shadow',"0px 2px red");
                }else{
                    var ser_fee = '-';
                    $('#service_fee').text(ser_fee);
                }
                }
                if(data.get_adtdetails_rssm_sde_result[0].service_fee != '' && data.get_adtdetails_rssm_sde_result[0].service_fee >= 12000 && data.get_adtdetails_rssm_sde_result[0].sales_cat =='Rural - RDSE' ||data.get_adtdetails_rssm_sde_result[0].sales_cat =='Rural - TRDSE'||data.get_adtdetails_rssm_sde_result[0].sales_cat =='Rural - DSE DAO'){
                    
                    if(data.get_adtdetails_rssm_sde_result[0].service_fee != ''){
                    $('#service_fee').text(data.get_adtdetails_rssm_sde_result[0].service_fee);
                     $('#service_fee').css('color',"#ff2f00");
$('#service_fee').css('box-shadow',"0px 2px red");
                    }else{
                        var ser_fee = '-';
                        $('#service_fee').text(ser_fee);
                    }
                }
                // $('#img_file').text(data.get_adtdetails_rssm_sde_result[0].img_file);




                var sde_total_points = Number(data.get_adtdetails_rssm_sde_result[0].exp_point) + Number(data.get_adtdetails_rssm_sde_result[0].edu_point) + Number(data.get_adtdetails_rssm_sde_result[0].age_point) + Number(data.get_adtdetails_rssm_sde_result[0].tk_point) +
                    Number(data.get_adtdetails_rssm_sde_result[0].ta_point) + Number(data.get_adtdetails_rssm_sde_result[0].fb_point);

                var vso_total_points = Number(data.get_adtdetails_rssm_vso_result[0].exp_point) + Number(data.get_adtdetails_rssm_vso_result[0].edu_point) + Number(data.get_adtdetails_rssm_vso_result[0].age_point) + Number(data.get_adtdetails_rssm_vso_result[0].tk_point) +
                    Number(data.get_adtdetails_rssm_vso_result[0].ta_point) + Number(data.get_adtdetails_rssm_vso_result[0].fb_point);

                var html = '';

                html += '<tr>';
                html += '<td data-label="Parameter">Experience</td>';
                html += '<td data-label="SDE Slab">' + data.get_adtdetails_rssm_sde_result[0].experience + '</td>';
                html += '<td data-label="SDE Points">' + data.get_adtdetails_rssm_sde_result[0].exp_point + '</td>';
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].experience+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].exp_point+'</td>';
                html += '</tr>';

                html += '<tr>';
                html += '<td data-label="Parameter">Education</td>';
                html += '<td data-label="SDE Slab">' + data.get_adtdetails_rssm_sde_result[0].education + '</td>';
                html += '<td data-label="SDE Points">' + data.get_adtdetails_rssm_sde_result[0].edu_point + '</td>';
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].education+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].edu_point+'</td>';
                html += '</tr>';

                html += '<tr>';
                html += '<td data-label="Parameter">Age</td>';
                html += '<td data-label="SDE Slab">' + data.get_adtdetails_rssm_sde_result[0].age + '</td>';
                html += '<td data-label="SDE Points">' + data.get_adtdetails_rssm_sde_result[0].age_point + '</td>';
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].age+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].age_point+'</td>';
                html += '</tr>';

                html += '<tr>';
                html += '<td data-label="Parameter">Terrain Knowledge</td>';
                html += '<td data-label="SDE Slab">' + data.get_adtdetails_rssm_sde_result[0].terrain_knowledge + '</td>';
                html += '<td data-label="SDE Points">' + data.get_adtdetails_rssm_sde_result[0].tk_point + '</td>';
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].terrain_knowledge+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].tk_point+'</td>';
                html += '</tr>';

                html += '<tr>';
                html += '<td data-label="Parameter">Technology Adaption</td>';
                html += '<td data-label="SDE Slab">' + data.get_adtdetails_rssm_sde_result[0].tech_adoption + '</td>';
                html += '<td data-label="SDE Points">' + data.get_adtdetails_rssm_sde_result[0].ta_point + '</td>';
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].tech_adoption+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].ta_point+'</td>';
                html += '</tr>';

                html += '<tr>';
                html += '<td data-label="Parameter">Family Background</td>';
                html += '<td data-label="SDE Slab">' + data.get_adtdetails_rssm_sde_result[0].family_bg + '</td>';
                html += '<td data-label="SDE Points">' + data.get_adtdetails_rssm_sde_result[0].fb_point + '</td>';
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].family_bg+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].fb_point+'</td>';
                html += '</tr>';

                html += '<tr>';
                html += '<td class="hide_td_title"></td>';
                html += '<td class="hide_td_title"><strong>SDE Total Points</strong></td>';
                html += '<td data-label="SDE Total Points"><strong>' + sde_total_points + '</strong></td>';
                // html +='<td class="hide_td_title"><strong>VSO Total Points</strong></td>';
                // html +='<td data-label="VSO Total Points"><strong>'+vso_total_points+'</strong></td>';
                html += '</tr>';

                // $('#adt_tb_body').html(html);
                $('#adt_details_modal_btn').click();

            }
        }
    });

}


function get_action_pop(table_row_id) {
    $('#table_row_id').val(table_row_id);
    $('#action_pop_modal').modal('show');
}

$('#asm_action_btn').on('click', function () {
    var get_f_asm_status = $('#f_asm_status').val();
    var auto_id = $('#table_row_id').val();

    if (get_f_asm_status != '') {
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

                if (data.response == 'success') {

                    $('.single-select').val('').trigger('change');


                    updated_toast();
                }
                else {
                    request_failed();

                }
                get_va_verified_forms();

            }
        });

    } else {
        fields_required();
    }

});
$('#approved').on('click', function () {
    $('#approved').attr('disabled','');
    var auto_id = $('#table_row_id').text();
    // if(get_f_asm_status !=''){
    $.ajax({
        type: "POST",
        url: BASE_URL + 'ASMController/process_asm_action',
        data: {
            "asm_status": 'Approved',
            "auto_id": auto_id,
        },
        dataType: "json",
        success: function (data) {
            $('#action_close').click();
            if (data.response == 'success') {
                // $('.single-select').val('').trigger('change');
                updated_toast();
                $('#adt_details_modal').modal('hide');

                var example = $('#enteredForm_tb').DataTable();
                example.ajax.reload();
                $('#approved').removeAttr('disabled','');


                // setTimeout( function(){
                //     window.location.reload();
                // },2000);
            }
            else {
                request_failed();
            }
            get_va_verified_forms();
        }
    });
});


$('#future_prospect').click(function () {
    $('#future_prospect').attr('disabled','');

    var auto_id = $('#table_row_id').text();
    $.ajax({
        type: "POST",
        url: BASE_URL + 'ASMController/process_asm_action',
        data: {
            "asm_status": 'Future Prospect',
            "auto_id": auto_id,
        },
        dataType: "json",
        success: function (data) {
            $('#action_close').click();

            if (data.response == 'success') {
                updated_toast();
                $('#adt_details_modal').modal('hide');

                var example = $('#enteredForm_tb').DataTable();
                example.ajax.reload();
                $('#future_prospect').removeAttr('disabled','');

                // setTimeout( function(){
                //     window.location.reload();
                // },2000);
            }
            else {
                request_failed();
            }
            get_va_verified_forms();

        }
    });
});
