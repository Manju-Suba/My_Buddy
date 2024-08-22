$(document).ready(function () {
   
    get_sde_incentive_urban();
	document.getElementById("sde_table_div").style.display = "none";

});

$("#jc_type").on('change', function(){
    var jc_type = $('#jc_type').val();
    var asm_number = $('#asm_number').val();
    var sde_number = $('#sde_number').val();

	if(jc_type =="" && asm_number =="" && sde_number ==""){
		document.getElementById("sde_table_div").style.display = "none";
		document.getElementById("table_div").style.display = "block";
		get_sde_incentive_urban();
		
	}

	if(jc_type !="" && asm_number =="" && sde_number ==""){
		document.getElementById("sde_table_div").style.display = "none";
		document.getElementById("table_div").style.display = "block";
		get_sde_incentive_urban();
		
	}
	if(jc_type !="" && asm_number !="" && sde_number ==""){

		document.getElementById("sde_table_div").style.display = "none";
		document.getElementById("table_div").style.display = "block";
		get_sde_incentive_urban();

	}
	if(jc_type !="" && asm_number !="" && sde_number !=""){

		document.getElementById("table_div").style.display = "none";
		document.getElementById("sde_table_div").style.display = "block";
		get_sde_details_view(asm_number,sde_number,jc_type);
	}
	
})

$("#asm_number").on('change', function(){
    var asm_number = $('#asm_number').val();
	var html = '<option value="">View All</option>';
	$('#sde_number').html(html);
    get_sde_incentive_urban();

    get_sde_list(asm_number);
	document.getElementById("sde_table_div").style.display = "none";
	document.getElementById("table_div").style.display = "block";
})

$("#sde_number").on('change', function(){
    var asm_number = $('#asm_number').val();
    var sde_number = $('#sde_number').val();
    var jc_type = $('#jc_type').val();
	

	if(sde_number ==''){

    	get_sde_incentive_urban();
		document.getElementById("sde_table_div").style.display = "none";
		document.getElementById("table_div").style.display = "block";
	}else{

		document.getElementById("table_div").style.display = "none";
		document.getElementById("sde_table_div").style.display = "block";
		get_sde_details_view(asm_number,sde_number,jc_type);
	}

})

$("#reset").on('click', function(){
	$("#jc_type").val("");
	// $("#jc_type").val("jc_07");
	$("#asm_number").val("");
	$("#sde_number").val("");

	var role_type = $('#session_role_type').val();
	var html = '<option value="">View All</option>';

	if(role_type =='ZSM'){
        $('#sde_number').html(html);
	}
	
	document.getElementById("sde_table_div").style.display = "none";
	document.getElementById("table_div").style.display = "block";
	get_sde_incentive_urban();
	
})


function get_sde_list(asm_number){
    if(asm_number ==''){
        var html = '<option value="">View All</option>';
        $('#sde_number').html(html);
    }else{

        $.ajax({
            type: "POST",
            url: BASE_URL + 'incentive/SdeIncentive/get_sde_list',
            data: { "asm_number": asm_number, },
            dataType:"json",
            success: function (data) {
                if(data.length != 0){
                    var html = '<option value="" selected disabled>View All</option>';
                    for (let index = 0; index < data.length; index++) {
                        html += '<option value="'+data[index].tso_number+'">'+data[index].tso+'</option>';
                    }
                    
                    $('#sde_number').html(html);

                }
            }
        });
    }

}

function get_sde_details_view(asm_number,sde_number,jc_type){
	var session_user_name =$('#session_user_name').val();

	$.ajax({
		type: "POST",
		url: BASE_URL + 'incentive/SdeIncentive/get_sde_details_view',
		data: { "asm_number": asm_number,"sde_number": sde_number,"jc_type": jc_type,"session_user_name": session_user_name, },
		dataType:"json",
		success: function (data) {

            //mandays_target //
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


function get_sde_incentive_urban() {
    var example = $('#sde_incentive_urban_table').DataTable({
        'lengthMenu': [[10, 25, 50, 100], [10, 25, 50, 100]],
        'lengthChange': true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "autoWidth": false,
        'ajax': {
            'url': BASE_URL + 'incentive/SdeIncentive/get_sde_incentive_report',
            'data': function (d) {
				d.jc_type =$('#jc_type').val();
				d.session_user_name =$('#session_user_name').val();
				d.asm_number =$('#asm_number').val();
				
            }
        },
        
        "columns": [
            
            {
                title: 'S.No',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "asm_name" },
            { "data": "sde_name" },
            { "data": "market" },
            { "data": "mandays_target" },
            { "data": "mandays_ach" },
            { "data": "mandays_percentage" },
            { "data": "mandays_amount" },
            { "data": "orange_salesman_target" },
            { "data": "orange_salesman_ach" },
            { "data": "orange_salesman_percentage" },
            { "data": "orange_salesman_amount" },
            { "data": "ck_super_star_target" },
            { "data": "ck_super_star_ach" },
            { "data": "ck_super_star_percentage" },
            { "data": "ck_super_star_amount" },
            { "data": "ck_elite_target" },
            { "data": "ck_elite_ach" },
            { "data": "ck_elite_percentage" },
            { "data": "ck_elite_amount" },
            { "data": "sec_value_target" },
            { "data": "sec_value_ach" },
            { "data": "sec_value_percentage" },
            { "data": "sec_value_amount" },
            { "data": "rising_star_outlet_target" },
            { "data": "rising_star_outlet_ach" },
            { "data": "rising_star_outlet_percentage" },
            { "data": "rising_star_outlet_amount" },
            { "data": "total_amount" },
            { "data": "pending_last_month" },
            { "data": "final_amount" },
            { "data": "remarks" },
        ],
        "order": [
            [1, 'asc']
        ],
        "columnDefs": [
            { "orderable": false, "targets": "_all" } // Applies the option to all columns
        ],
        createdRow: (row, data, dataIndex, cells) => {
            $(cells[6]).css('background-color', data.mandays_per_color);
            $(cells[10]).css('background-color', data.orange_salesman_per_color);
            $(cells[14]).css('background-color', data.ck_super_star_per_color);
            $(cells[18]).css('background-color', data.ck_elite_per_color);
            $(cells[22]).css('background-color', data.sec_value_per_color);
            $(cells[26]).css('background-color', data.rising_star_outlet_per_color);
            // orange_salesman_per_color
        }

       
    });

}
