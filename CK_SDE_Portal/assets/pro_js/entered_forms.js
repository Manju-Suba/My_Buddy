$(document).ready(function () {

    // get_zsm_list();
    get_asm_list();
    get_entered_forms();

})

function get_zsm_list() {

	$.ajax({
		type: "POST",
		url: BASE_URL + 'Salesmanonboarding/get_zsm_list',
		data: {},
		dataType: "json",
		success: function (data) {
			if (data.length != 0) {
				var html = '<option value="">Select</option>';
				for (let index = 0; index < data.length; index++) {
					html += '<option value="' + data[index].zsm_number + '">' + data[index].zsm + '</option>';
				}

				$('#af_zsm_list').html(html);

			}
		}
	});


}

function get_asm_list() {

	// var zsm_number = $('#af_zsm_list').val();

	$.ajax({
		type: "POST",
		url: BASE_URL + 'Salesmanonboarding/get_asm_list',
		// data: {
		// 	"zsm_number": zsm_number,
		// },
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

$('#af_zsm_list').on('change',function(){
    get_asm_list();
    var html = '<option value="">Select</option>';
    $('#af_tso_list').html(html);
    get_entered_forms();
});

$('#af_asm_list').on('change',function(){
    get_tso_list();
    get_entered_forms();
});



function get_tso_list() {

	// var zsm_number = $('#af_zsm_list').val();
	var asm_number = $('#af_asm_list').val();

	$.ajax({
		type: "POST",
		url: BASE_URL + 'Salesmanonboarding/get_tso_list',
		data: {
			// "zsm_number": zsm_number,
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

$('#af_tso_list,#rssm_status,#af_asm_status').on('change',function(){
    get_entered_forms();

});

$('#btnClear').on('click',function(){
    
    $('#af_zsm_list').val('').trigger('change');
    $('#af_asm_list').val('').trigger('change');
    $('#af_tso_list').val('').trigger('change');
    $('#af_va_status').val('').trigger('change');
    $('#af_asm_status').val('').trigger('change');
    $('#rssm_status').val('').trigger('change');

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
                    // 'columns': [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40]
                    'columns': [7,8,9,10,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39,40,41,42,43,44], 

                },
                "action": newexportaction,
                "customizeData": function(data) {
                    for(var i = 0; i < data.body.length; i++) {
                      for(var j = 0; j < data.body[i].length; j++) {
                        if(j== 32){
                            data.body[i][j] = '\u200C' + data.body[i][j];
                        }
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
                // targets: [3,4,5,6,7,8,11,12,13,14,15,16,31,32,33,34,35,36,17,18,19,20,21,22,23,24,25,26,27,28,29,30,37,38,39], 
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
            'url': BASE_URL + 'Salesmanonboarding/get_entered_rssmforms',
            'data': function (data) {
                data.zsm_number = $('#af_zsm_list').val();
                data.tso_number = $('#af_tso_list').val();
                data.asm_number = $('#af_asm_list').val();
                // data.af_va_status = $('#af_va_status').val();
                data.af_asm_status = $('#af_asm_status').val();
                data.af_rssm_status = $('#rssm_status').val();


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
            // {
            //     "className": 'details-control',
            //     "orderable": false,
            //     "data": null,
            //     "defaultContent": ''
            // },
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

            // { "data": "name" },
            // { "data": "mobile_no" },
            // { "data": "whatsapp_no" },
            // { "data": "dob" },
            // { "data": "doj" },
            // { "data": "father_name" },
            // { "data": "address" },
            // { "data": "email" },
            // { "data": "asm_status" },
            // { "data": "rssm_status" },

            // { "data": "score" },
            // { "data": "experience" },
            // { "data": "education" },
            // { "data": "age"},
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
        '<td class="hide table-info"><strong>Alt.Mobile</strong></td>' +
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
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].experience+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].exp_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Education</td>';
                html +='<td data-label="SDE Slab">'+data.get_adtdetails_rssm_sde_result[0].education+'</td>';
                html +='<td data-label="SDE Points">'+data.get_adtdetails_rssm_sde_result[0].edu_point+'</td>';
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].education+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].edu_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Age</td>';
                html +='<td data-label="SDE Slab">'+data.get_adtdetails_rssm_sde_result[0].age+'</td>';
                html +='<td data-label="SDE Points">'+data.get_adtdetails_rssm_sde_result[0].age_point+'</td>';
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].age+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].age_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Terrain Knowledge</td>';
                html +='<td data-label="SDE Slab">'+data.get_adtdetails_rssm_sde_result[0].terrain_knowledge+'</td>';
                html +='<td data-label="SDE Points">'+data.get_adtdetails_rssm_sde_result[0].tk_point+'</td>';
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].terrain_knowledge+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].tk_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Technology Adaption</td>';
                html +='<td data-label="SDE Slab">'+data.get_adtdetails_rssm_sde_result[0].tech_adoption+'</td>';
                html +='<td data-label="SDE Points">'+data.get_adtdetails_rssm_sde_result[0].ta_point+'</td>';
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].tech_adoption+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].ta_point+'</td>';
                html +='</tr>';

                html +='<tr>';
                html +='<td data-label="Parameter">Family Background</td>';
                html +='<td data-label="SDE Slab">'+data.get_adtdetails_rssm_sde_result[0].family_bg+'</td>';
                html +='<td data-label="SDE Points">'+data.get_adtdetails_rssm_sde_result[0].fb_point+'</td>';
                // html +='<td data-label="VSO Slab">'+data.get_adtdetails_rssm_vso_result[0].family_bg+'</td>';
                // html +='<td data-label="VSO Points">'+data.get_adtdetails_rssm_vso_result[0].fb_point+'</td>';
                html +='</tr>';
                
                html +='<tr>';
                html +='<td class="hide_td_title"></td>';
                html +='<td class="hide_td_title"><strong>SDE Total Points</strong></td>';
                html +='<td data-label="SDE Total Points"><strong>'+sde_total_points+'</strong></td>';
                // html +='<td class="hide_td_title"><strong>VSO Total Points</strong></td>';
                // html +='<td data-label="VSO Total Points"><strong>'+vso_total_points+'</strong></td>';
                html +='</tr>';

                $('#adt_tb_body').html(html);
                $('#adt_details_modal_btn').click();

            }
        }
    });

}


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

            console.log(data);


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
                var check_img = url + 'uploads/aadhar_backview/' + data.get_adtdetails_rssm_sde_result[0].aadhar_backview;
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


