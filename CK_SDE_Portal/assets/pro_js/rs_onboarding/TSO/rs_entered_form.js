$(document).ready(function() {
    getRsOnBoardingData();
});

function getRsOnBoardingData(){
    var url = BASE_URL + '/RSController/get_rs_onboarding_data';
    $('#enteredForm_tb').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,

        'ajax': {
            'url': url,
        },
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "rs_type" },
            { "data": "appointment_reason" },
            { "data": "firm_title" },
            { "data": "ownership_status" },
            { "data": "asm_status" },
            { "data": "action" },
        ],
        "columnDefs": [
            { "orderable": false, "targets": "_all" } 
        ],
        "order": [
            [1, 'asc']
        ]
    });
}


function openApproveModel(id){
    // Get Value from url
    var params = new window.URLSearchParams(window.location.search);
    var type=params.get('type');
    $("#approve_rs_appoinment").attr('hidden', true);
    $("#reject_rs_appoinment").attr('hidden', true);
    appoinmentView(id)
    $('#rs_appoinment_modal').modal('show');
    $('#approve_id').val(id);
}


function appoinmentView(id){
    $.ajax({
        url:  BASE_URL + 'SapController/viewRsOnboardingData',
        type: 'POST',
        data: {id: id},
        success: function(data){
            data = JSON.parse(data);
            data = data[0];

            if(data.appointment_reason != 'Expansion'){
                $(".appointmentReason").show();
                $('#saprssscode').html(data.existing_sap_rssscode);
                $('#collected_claims').html(data.claims_collected);
                $('#noc_pending_claims').html(data.noc_pending_claims);
            } else {
                $(".appointmentReason").hide();
            }
            $('#rs_type').html(data.rs_type);
            $('#reason_for_appoinment').html(data.appointment_reason);
            $('#firm_title').html(data.firm_title);
            $('#ownership_status').html(data.ownership_status);
            $('#gst_no').html(data.gst_no);
            var common_url = imgUrl + 'uploads/rs_appointment/';
                $("#gst_copy").html(`
            <a target="_blank" href="${common_url+"documents/" + data.gst_copy}" ><i class="fa fa-eye"> GST Copy</i></a>
            `);

            $("#fssai_number").html(data.fssai_no);
            $("#fssai_copy").html(`
            <a target="_blank" href="${common_url+"fssai/" + data.fssai_copy}" ><i class="fa fa-eye"> FSSAI Copy</i></a>
            `);

            $("#contact_person").html(data.contact_person_name);
            $("#mobile_no").html(data.mobile_no);
            $("#email_id").html(data.email_id);
            $("#pan_number").html(data.pan_no);
            $("#pan_copy").html(`
            <a target="_blank" href="${common_url+"pan/" + data.pancard_copy}" ><i class="fa fa-eye"> PAN Copy</i></a>
            `);
            
            $("#aadhar_number").html(data.aadhar_no);
            $("#aadhar_copy_front").html(`
            <a target="_blank" href="${common_url+"aadhar/" + data.aadhar_front_page}" ><i class="fa fa-eye"> Aadhar Front Copy</i></a>
            `);
            $("#aadhar_copy_back").html(`
            <a target="_blank" href="${common_url+"aadhar/" + data.aadhar_back_page}" ><i class="fa fa-eye"> Aadhar Back Copy</i></a>
            `);
            $("#address_1").html(data.address);
            $("#address_2").html(data.alternate_address);

            $("#bank_name").html(data.bank_name);
            $("#account_owner").html(data.ac_holder_name);
            $("#account_number").html(data.ac_number);
            $("#account_type").html(data.ac_type);
            $("#branch_name").html(data.branch_name);
            $("#ifsc_code").html(data.ifsc_code);
            $("#signatory_name").html(data.signatory_name);
            $("#natch_limit").html(data.nach_limit);
            $("#cancelled_cheque").html(`
            <a target="_blank" href="${common_url+"cheque/" + data.cancelled_cheque}" ><i class="fa fa-eye"> Cancelled Cheque</i></a>
            `);

            $("#avg_monthly").html(data.monthly_firm_turnover);
            $("#investment_business").html(data.total_investment);
            $("#investment_funds").html(data.own_investment_funds);
            $("#borrowed_funds").html(data.borrowed_funds);
            $("#capital_for_ckpl").html(data.working_capital_ckpl);

            $("#company_handled").html(data.company_handled);
            $("#outlets_covered").html(data.outlets_covered);
            $("#company_paid").html(data.no_of_salesman_company_paid);
            $("#distributor_salesman").html(data.no_of_salesman_self);
            $("#total_godown_size").html(data.godown_size);
            
            $("#computer_billing").html(data.computer_billing);
            $("#csng_billing").html(data.printer_compatible_csng_billing);
            $("#owner_picture").html(`
            <a target="_blank" href="${common_url+"ownerpic/" + data.owner_pic}" ><i class="fa fa-eye"> Owner Pic</i></a>
            `);

            $("#office_main_gate").html(`
            <a target="_blank" href="${common_url+"officegate/" + data.office_main_gate}" ><i class="fa fa-eye"> Office Main Gate</i></a>
            `);

            $("#godown_picture_1").html(`
            <a target="_blank" href="${common_url+"godownpic/" + data.godown_pic1}" ><i class="fa fa-eye"> Godown Pic 1</i></a>
            `);

            $("#godown_picture_2").html(`
            <a target="_blank" href="${common_url+"godownpic/" + data.godown_pic2}" ><i class="fa fa-eye"> Godown Pic 2</i></a>
            `);

            // Convert string to array
            var unitType = JSON.parse(data.unit_type_with_count);
            $("#unit_type").html(
                (unitType.bike ? "<strong>Bike : </strong>" +  unitType.bike : "") + 
                (unitType.four_wheeler ? ",  <strong>4 Wheeler</strong> : " + unitType.four_wheeler : "") +
                (unitType.three_wheeler ? ",  <strong>3 Wheeler</strong> : " + unitType.three_wheeler : "")
            );

            $("#delievery_van_pic").html(`
            <a target="_blank" href="${common_url+"delivery_vanpic/" + data.delivery_van_pic}" ><i class="fa fa-eye"> Delivery Van Pic</i></a>
            `);

            $("#rc_copy").html(`
            <a target="_blank" href="${common_url+"delivery_van_rc/" + data.delivery_van_rc}" ><i class="fa fa-eye"> RC Copy</i></a>
            `);

            $("#invoice_copy").html(`
            <a target="_blank" href="${common_url+"invoice_copy/" + data.invoice_copy_exist_company}" ><i class="fa fa-eye"> Invoice Copy</i></a>
            `);

            $("#proposed_outlets").html(data.outlets_covered_for_cavinkare);
            $("#force_count").html(data.approved_ff_count);
            $("#expected_turnover").html(data.expected_turnover_from_cavinkare_pyear);
        }
    });

}