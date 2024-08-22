$(document).ready(function () {
    get_individual_rsp_data();

});

function get_individual_rsp_data(){
	var session_user_name =$('#session_user_name').val();

	$.ajax({
		type: "POST",
		url: BASE_URL + 'fivesec_scorecard/FivesecScorecard/get_individual_rsp_data',
		data: {"session_user_name": session_user_name, },
		dataType:"json",
		success: function (data) {
            $('#rsp_number').html(data.ssfa_id);
            // $('#mandays_norms').html(data.man_days_norms_6hrs_25outlet);
			$('#mandays_norms').html(data.man_days_norms);
            $('#net_salary').html(data.approved_salary);
            $('#salary_cycle').html(data.month);
            $('#to_days_fr_month').html(data.total_days);
            $('#app_usage').html(data.app_usage);
            $('#exception_days').html(data.exception_days);
            $('#total_days_worked').html(data.total_days_worked);
            $('#conveyance').html(data.conveyance);
            $('#incentive').html(data.incentive);
            $('#pending_salary').html(data.pending_salary);
            // $('#final_amount').html(data.final_amount);
            $('#final_amount').html(data.final_amount);
		}
	});

}
