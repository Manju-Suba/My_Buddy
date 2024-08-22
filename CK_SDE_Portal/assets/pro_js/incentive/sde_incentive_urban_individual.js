$(document).ready(function () {
    get_sde_incentive_urban_individual();
});

$("#jc_type").on('change', function(){
    get_sde_incentive_urban_individual();
})

$("#reset").on('click', function(){
	$("#jc_type").val("");
	
	get_sde_incentive_urban_individual();
	
})

function get_sde_incentive_urban_individual(){
	var session_user_name =$('#session_user_name').val();
	var jc_type =$('#jc_type').val();

	$.ajax({
		type: "POST",
		url: BASE_URL + 'incentive/SdeIncentive/get_sde_individual_details',
		data: { "session_user_name": session_user_name,"jc_type": jc_type, },
		dataType:"json",
		success: function (data) {

			//mandays_target //parseFloat(data.ck_elite_target).toFixed(3)
			$('#mdys_target').html( parseFloat(data.mandays_target).toFixed(3) );
			$('#mdys_ach').html(parseFloat(data.mandays_ach).toFixed(3) );
			$('#mdys_per').html(data.mandays_percentage);

			const mandays = data.mandays_percentage ;
			const newValue = mandays.replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
			if( parseFloat(newValue) <= "99.00" && parseFloat(newValue) >="90.00"){
				$('#mdys_per').css('background','rgb(237 139 16 / 52%)');
			}
			if(parseFloat(newValue) >= "100.00" ){
				$('#mdys_per').css('background','rgb(0 128 0 / 32%)');
			}
            if(parseFloat(newValue) < "90.00"){
                $('#mdys_per').css('background','');
            }
			$('#mdys_amount').html(data.mandays_amount);

			//orange_salesman_target//
			$('#orgsm_target').html( parseFloat(data.orange_salesman_target).toFixed(3) );
			$('#orgsm_ach').html( parseFloat(data.orange_salesman_ach).toFixed(3) );
			$('#orgsm_per').html(data.orange_salesman_percentage);

			const orange = data.orange_salesman_percentage ;
			const newValue2 = orange.replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
			if( parseFloat(newValue2) <= "99.00" && parseFloat(newValue2) >="90.00"){
				$('#orgsm_per').css('background','rgb(237 139 16 / 52%)');
			}
			if(parseFloat(newValue2) >= "100.00" ){
				$('#orgsm_per').css('background','rgb(0 128 0 / 32%)');
			}
            if(parseFloat(newValue2) < "90.00"){
                $('#orgsm_per').css('background','');
            }
            $('#orgsm_amount').html(data.orange_salesman_amount);

			//ck_super_star_target//
			$('#ckss_target').html( parseFloat(data.ck_super_star_target).toFixed(3) );
			$('#ckss_ach').html( parseFloat(data.ck_super_star_ach).toFixed(3) );
			$('#ckss_per').html(data.ck_super_star_percentage);

			const super_star = data.ck_super_star_percentage ;
			const newValue3 = super_star.replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
			if( parseFloat(newValue3) <= "99.00" && parseFloat(newValue3) >="90.00"){
				$('#ckss_per').css('background','rgb(237 139 16 / 52%)');
			}
			if(parseFloat(newValue3) >= "100.00" ){
				$('#ckss_per').css('background','rgb(0 128 0 / 32%)');
			}
            if(parseFloat(newValue3) < "90.00"){
                $('#ckss_per').css('background','');
            }
			$('#ckss_amount').html(data.ck_super_star_amount);

			//ck_elite_target//
			$('#ckekp_target').html( parseFloat(data.ck_elite_target).toFixed(3) );
			$('#ckekp_ach').html( parseFloat(data.ck_elite_ach).toFixed(3) );
			$('#ckekp_per').html(data.ck_elite_percentage);

			const elite = data.ck_elite_percentage ;
			const newValue4 = elite.replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
			if( parseFloat(newValue4) <= "99.00" && parseFloat(newValue4) >="90.00"){
				$('#ckekp_per').css('background','rgb(237 139 16 / 52%)');
			}
			if(parseFloat(newValue4) >= "100.00" ){
				$('#ckekp_per').css('background','rgb(0 128 0 / 32%)');
			}
            if(parseFloat(newValue4) < "90.00"){
                $('#ckekp_per').css('background','');
            }
			$('#ckekp_amount').html(data.ck_elite_amount);

			//sec_value_target//
			$('#sv_target').html(parseFloat(data.sec_value_target).toFixed(3) );
			$('#sv_ach').html( parseFloat(data.sec_value_ach).toFixed(3) );
			$('#sv_per').html(data.sec_value_percentage);

			const sec_value = data.sec_value_percentage ;
			const newValue5 = sec_value.replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
			if( parseFloat(newValue5) <= "99.00" && parseFloat(newValue5) >="90.00"){
				$('#sv_per').css('background','rgb(237 139 16 / 52%)');
			}
			if(parseFloat(newValue5) >= "100.00" ){
				$('#sv_per').css('background','rgb(0 128 0 / 32%)');
			}
            if(parseFloat(newValue5) < "90.00"){
                $('#sv_per').css('background','');
            }
			$('#sv_amount').html(data.sec_value_amount);

			//rising_star_outlet_target//
			$('#rso_target').html( parseFloat(data.rising_star_outlet_target).toFixed(3) );
			$('#rso_ach').html( parseFloat(data.rising_star_outlet_ach).toFixed(3) );
			$('#rso_per').html(data.rising_star_outlet_percentage);

			const rising_star = data.rising_star_outlet_percentage ;
			const newValue6 = rising_star.replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
			if( parseFloat(newValue6) <= "99.00" && parseFloat(newValue6) >="90.00"){
				$('#rso_per').css('background','rgb(237 139 16 / 52%)');
			}
			if(parseFloat(newValue6) >= "100.00" ){
				$('#rso_per').css('background','rgb(0 128 0 / 32%)');
			}
            if(parseFloat(newValue6) < "90.00"){
                $('#rso_per').css('background','');
            }
            $('#rso_amount').html(data.rising_star_outlet_amount);
	
			
			
		}
	});

}
