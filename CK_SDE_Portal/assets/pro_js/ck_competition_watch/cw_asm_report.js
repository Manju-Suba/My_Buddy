$(document).ready(function () {

    
    var role_type = $('#session_role_type').val();
    show_filter_div(role_type);
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
$('#business').on('change',function(){
    var html = '<option value="" selected disabled>Select.. </option>';
    $('#role_sm').html(html);
    $('#tso_mobile').html(html);
    $('#asm_mobile').html(html);
	var role = $('#session_role_type').val();
    var business = $('#business').val();
	if(role == 'ZSM' ){
        var zsm_num = $('#session_mobile_no').val();
		get_asm_list(zsm_num,business);
	}else{
		get_zsm_list(business);

	}

})
function show_filter_div(role_type){
    var session_mobile = $('#session_mobile_no').val();
    var business = $('#business').val();

    if(role_type =='LEADER' || role_type =='Division Head'){
        $('.asm_view').css({"display":"none"});
        $('.zsm_view').css({"display":"none"});
        $('.lead_view').css({"display":"block"});
        // get_zsm_list();

    }
    else if(role_type =='ZSM'){
        $('.lead_view').css({"display":"none"});
        $('.asm_view').css({"display":"none"});
        $('.zsm_view').css({"display":"block"});

        get_asm_list(session_mobile,business);

    }
    else if(role_type =='ASM'){
        $('.lead_view').css({"display":"none"});
        $('.zsm_view').css({"display":"none"});
        $('.asm_view').css({"display":"block"});
        get_tso_list(session_mobile);

    }
    else if(role_type =='TSO'){
        $('.lead_view').css({"display":"none"});
        $('.zsm_view').css({"display":"none"});
        $('.asm_view').css({"display":"none"});
        $('.tso_view').css({"display":"block"});

        get_sm_list(session_mobile);


    }
    else{
        $('.lead_view').css({"display":"none"});
        $('.zsm_view').css({"display":"none"});
        $('.asm_view').css({"display":"none"});
        get_entered_forms();

    }
    
}

function get_zsm_list(business){
    $.ajax({
        type: "POST",
        url: BASE_URL + 'Competition/get_zsm_list',
        data: { "business":business},
        dataType:"json",
        success: function (data) {
            if(data.length != 0){
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += '<option value="'+data[index].zsm_number+'">'+data[index].zsm+'</option>';
                }
                
                $('#af_zsm_list').html(html);
                get_entered_forms();

            }
        }
    });
}

$("#af_zsm_list").on('change', function () {

    var zsm_number = $('#af_zsm_list').val();
    var business = $('#business').val();
    var html = '<option value="">Select</option>';
    $('#af_tso_list').html(html);
    $('#af_sm_list').html(html);
    get_asm_list(zsm_number,business);
    get_entered_forms();
});

function get_asm_list(zsm_number,business){
    
    if(zsm_number ==''){
        var html = '<option value="">Select</option>';
        $('#af_asm_list').html(html);
        $('#af_tso_list').html(html);
        $('#af_sm_list').html(html);
    }else{

        $.ajax({
            type: "POST",
            url: BASE_URL + 'Competition/get_asm_list',
            data: { "zsm_number": zsm_number,"business": business },
            dataType:"json",
            success: function (data) {
                if(data.length != 0){
                    var html = '<option value="">Select</option>';
                    for (let index = 0; index < data.length; index++) {
                        html += '<option value="'+data[index].asm_number+'">'+data[index].asm+'</option>';
                    }
                    
                    $('#af_asm_list').html(html);
                    get_entered_forms();

                }
            }
        });
    }

}

function get_business_list(){

    $.ajax({
        type: "POST",
        url: BASE_URL + 'Competition/get_business_list',
        // data: { "business_value": business_value, },
        dataType:"json",
        success: function (data) {
            if(data.length != 0){
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    if(data[index].business != 'BPO - Operations'){
                        html += '<option value="'+data[index].division+'">'+data[index].division+'</option>';
                    }
                }
                
                $('#business').html(html);
              
            }
        }
    });
}

$("#af_asm_list").on('change', function () {

    var asm_number = $('#af_asm_list').val();
    var html = '<option value="">Select</option>';
    $('#af_sm_list').html(html);

    get_tso_list(asm_number);
    get_entered_forms();

});

function get_tso_list(asm_number){
    if(asm_number ==''){
        var html = '<option value="">Select</option>';
        $('#af_tso_list').html(html);
        $('#af_sm_list').html(html);
    }else{

        $.ajax({
            type: "POST",
            url: BASE_URL + 'Competition/get_tso_list',
            data: { "asm_number": asm_number, },
            dataType:"json",
            success: function (data) {
                if(data.length != 0){
                    var html = '<option value="">Select</option>';
                    for (let index = 0; index < data.length; index++) {
                        html += '<option value="'+data[index].tso_number+'">'+data[index].tso+'</option>';
                    }
                    
                    $('#af_tso_list').html(html);
                    get_entered_forms();

                }
            }
        });
    }

}

$("#af_tso_list").on('change', function () {

    var tso_number = $('#af_tso_list').val();
    
    get_sm_list(tso_number);
    get_entered_forms();

});

function get_sm_list(tso_number){
    if(tso_number ==''){
        var html = '<option value="">Select</option>';
        $('#af_sm_list').html(html);
        
    }else{

        $.ajax({
            type: "POST",
            url: BASE_URL + 'Competition/get_sm_list',
            data: { "tso_number": tso_number, },
            dataType:"json",
            success: function (data) {
                if(data.length != 0){
                    var html = '<option value="">Select</option>';
                    for (let index = 0; index < data.length; index++) {
                        html += '<option value="'+data[index].sm_number+'">'+data[index].sm+'</option>';
                    }
                    
                    $('#af_sm_list').html(html);
                    get_entered_forms();

                }
            }
        });
    }

}


$("#af_sm_list").on('change', function () {

    get_entered_forms();

});

function get_entered_forms() {
    var example = $('#example2').DataTable({
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
            'url': BASE_URL + 'Competition/get_entered_cwforms_report',
            'data': function (d) {
                d.zsm_number =$('#af_zsm_list').val();
                d.asm_number =$('#af_asm_list').val();
                d.tso_number =$('#af_tso_list').val();
                d.sm_number =$('#af_sm_list').val();
            }
        },
        createdRow: function (row, data, dataIndex) {
            $( row ).find('td:eq(0)').attr('data-label', '#');
            $( row ).find('td:eq(1)').attr('data-label', 'Date');
            $( row ).find('td:eq(2)').attr('data-label', 'Source');
            $( row ).find('td:eq(3)').attr('data-label', 'Insight Category');
            $( row ).find('td:eq(4)').attr('data-label', 'Comment');
            $( row ).find('td:eq(5)').attr('data-label', 'Images');
            $( row ).find('td:eq(6)').attr('data-label', 'Created By');
            $( row ).find('td:eq(7)').attr('data-label', 'Created On');
            $( row ).find('td:eq(8)').attr('data-label', 'Action');

        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "cw_date" },
            { "data": "cw_source" },
            { "data": "cw_insight_category" },
            { "data": "cw_comment" },
            { "data": "cw_filename" },
            { "data": "created_by" },
            { "data": "created_on" },
            { "data": "action" },
            

        ],
        "order": [
            [1, 'asc']
        ]
    });

}

function show_pop_img(){
    var imgTag = event.target;
    var mySrc = imgTag.getAttribute('src');
    var modalImg = document.getElementById("pop_img_show");
    modalImg.src = mySrc;

    $('#popimgbtn').modal('show');

}

function get_adtdetails_pop (edit_row_id){

    $('#edit_row_id').val(edit_row_id);
    $('#popadtbtn').modal('show');

}
$("#filterClearbtn").on('click', function () {
    $('#af_zsm_list').val("");
    $('#af_asm_list').val("");
    $('#af_tso_list').val("");
    $('#af_sm_list').val("");
    get_entered_forms();

});

$('#commentForm').submit(function(e) {
    
        $('#saveBtn').attr("disabled", true);
        $("#saveBtn").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
        e.preventDefault();
        
        var formData = new FormData(this);
        $.ajax({  
            url:BASE_URL + 'Competition/addSupervisorcomment', 
            method:"POST",  
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType:"json",
        
            success:function(data) {

                if(data.logstatus =='success'){

                    $('#comment_model_close').click();
                    $('#commentForm')[0].reset();
                    
                    $('#saveBtn').attr("disabled", false);
                    $('#saveBtn').html('Save');
                    
                    added_toast();

                    setTimeout(function(){
                        get_entered_forms();

                    },2000);

                }
                else{
                    request_failed();
                    $('#saveBtn').attr("disabled", false);
                    $('#saveBtn').html('Save');
                    
                }
                        
            }  
        }); 
    
});


function get_adtdetails_viewpop(auto_id){

    var get_scomment = $('#history_'+auto_id).attr("data-supervisor_comment");
    var get_weightage = $('#history_'+auto_id).attr("data-weightage");


    if(get_scomment != ''){
        $('#view_supervisor_comment').html(get_scomment);

    }else{
    $('#view_supervisor_comment').html('-');

    }

    // $('#view_supervisor_comment').html(get_scomment);
    // $('#view_weightage').html(get_weightage);

    $('#popadtviewbtn').modal('show');

}