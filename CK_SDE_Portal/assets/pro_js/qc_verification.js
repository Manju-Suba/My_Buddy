$(document).ready(function () {
    get_qc_verification_forms();
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

function view_adddetails(rscode) {
    $('#view_images').modal('show');
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
            $('#division').text(data.get_adtdetails_rssm_sde_result[0].division);
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
            // if (data.get_adtdetails_rssm_sde_result[0].aadhar_copy != "") {
            //     var check_img = url + 'uploads/sales/aadhar/' + data.get_adtdetails_rssm_sde_result[0].aadhar_copy;
            //     $("#aadhar_copy").html(`
            // <a target="_blank" href="${check_img}" ><i class="fa fa-eye"> Aadhar view(Front Side)</i></a>
            // `);
            // }

            var aadharimg = "";
            if(data.get_adtdetails_rssm_sde_result[0].aadhar_copy != "") {
                var check_img = url + 'uploads/aadhar/' + data.get_adtdetails_rssm_sde_result[0].aadhar_copy;
                aadharimg += '<div class="col-md-10">';
                aadharimg += '<div class="card">';
                aadharimg += `<a href="${check_img}" target="_blank"><img src="${check_img}" width="261" height="176" style="margin-left: 10px;margin-top: 10px; "></a>`;
                aadharimg += '</div>';
                aadharimg += '</div>';

                $("#aadhar_copy").html(aadharimg);
            }
          
            // if (data.get_adtdetails_rssm_sde_result[0].aadhar_backview != "") {
            //     var check_img =url + 'uploads/sales/aadhar_backview/' + data.get_adtdetails_rssm_sde_result[0].aadhar_backview;
            //     $("#aadhar_backview_copy").html(`
            // <a target="_blank" href="${check_img}" ><i class="fa fa-eye"> Aadhar view(Back Side)</i></a>
            // `);
            // }

            var aadharimgback = "";
            if(data.get_adtdetails_rssm_sde_result[0].aadhar_copy != "") {
                var check_bimg =url + 'uploads/aadhar_backview/' + data.get_adtdetails_rssm_sde_result[0].aadhar_backview;
                aadharimgback += '<div class="col-md-10">';
                aadharimgback += '<div class="card">';
                aadharimgback += `<a href="${check_bimg}" target="_blank"><img src="${check_bimg}" width="261" height="176" style="margin-left: 10px;margin-top: 10px; "></a>`;
                aadharimgback += '</div>';
                aadharimgback += '</div>';

                $("#aadhar_backview_copy").html(aadharimgback);
            }

            // $('#aadhar_copy').text(view);
            $('#pan').text(data.get_adtdetails_rssm_sde_result[0].pan);

            // if (data.get_adtdetails_rssm_sde_result[0].pan_copy != "") {
            //     var pan_img = url + 'uploads/sales/pan/' + data.get_adtdetails_rssm_sde_result[0].pan_copy;
            //     $("#pan_copy").html(`
            // <a target="_blank" href="${pan_img}" title="View Pan " ><i class="fa fa-eye" > Pan view</i> </a>
            // `);
            // }
            var panimage = "";
            if(data.get_adtdetails_rssm_sde_result[0].pan_copy != ""){
                var pan_img = url + 'uploads/pan/' + data.get_adtdetails_rssm_sde_result[0].pan_copy;
                panimage += '<div class="col-md-10">';
                panimage += '<div class="card">';
                panimage += `<a href="${pan_img}" target="_blank"><img src="${pan_img}" width="261" height="176" style="margin-left: 10px;margin-top: 10px; "></a>`;
                panimage += '</div>';
                panimage += '</div>';
            }
          
            $('#pan_copy').html(panimage);


            // $('#cheque').text(data.get_adtdetails_rssm_sde_result[0].cheque);
            // if (data.get_adtdetails_rssm_sde_result[0].cheque != "") {
            //     var cheque_img = url + 'uploads/sales/cheque/' + data.get_adtdetails_rssm_sde_result[0].cheque;
            //     $("#cheque").html(`
            // <a target="_blank" href="${cheque_img}" title="View Cheque"><i class="fa fa-eye" > Cheque</i> </a>
            // `);
            // }
            var chequeimage = "";
            if (data.get_adtdetails_rssm_sde_result[0].cheque != "") {
                var cheque_img = url + 'uploads/cheque/' + data.get_adtdetails_rssm_sde_result[0].cheque;
                chequeimage += '<div class="col-md-10">';
                chequeimage += '<div class="card">';
                chequeimage += `<a href="${cheque_img}" target="_blank"><img src="${cheque_img}" width="261" height="176" style="margin-left: 10px;margin-top: 10px; "></a>`;
                chequeimage += '</div>';
                chequeimage += '</div>';

                $("#cheque").html(chequeimage);
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
                var ff_img = url + 'uploads/sales/image/' + data.get_adtdetails_rssm_sde_result[0].img_file;
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

        }
    });
    
}



function getrowid(){
   $('#rowid').val($('#table_row_id').text());
}

function get_qc_verification_forms() {
    var tso_number = $('#get_tso_num').val();
    var example = $('#qc_verification').DataTable({
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        'lengthChange': true,
        columnDefs: [
            {
                targets: [], 
                visible: false // Set visible to false to hide the specified columns
            }
        ],
        // 'dom': 'LBfrtip',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': {
            'url': BASE_URL + 'Salesmanonboarding/get_qc_verification_forms',
            'data': {
                'tso_number': tso_number,
            }
        },
        "columns": [
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            // { "data": "business_division" },
            // { "data": "location" },
            // { "data": "state" },
            // { "data": "region" },
            { "data": "name" },
            { "data": "mobile_no" },
            { "data": "asm_status" },
            { "data": "created_on" },
            // { "data": "dob" },
            // { "data": "father_name" },
            // { "data": "doj" },
            // { "data": "pan" },
            // { "data": "aadhar" },
            // { "data": "account_no" },
            // { "data": "ifsc_code" },
            // { "data": "branch_name" },
            // { "data": "request_received_date" },
            // { "data": "emp_id" },
            // { "data": "ssfa_id" },
            { "data": "action" },

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
 


// $('.get_id').on('hidden.bs.modal', function() {
//     $('#view_images').css('z-index', '1050');
//     $('#view_images').css('overflow','auto');
// });


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
