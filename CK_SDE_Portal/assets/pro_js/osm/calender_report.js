var BASE_URL = "<?php echo base_url();?>index.php/";

$(document).ready(function(){

    var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month'
        },
        events:BASE_URL + "osm/fullcalendar/load",
        selectable:true,
        selectHelper:true,

		eventClick:function(event)
        {
            var id = event.id;
			// alert(id);

            $.ajax({
                url:BASE_URL + "osm/fullcalendar/view",
                type:"POST",
                data:{id:id},
                dataType:"json",
                success:function(data)
                {
					var value = data['get_data'][0]['OVERALL_VALUE_Actual_FTD_'] ;
					var total_v = value * 100000;
					var total_val = parseFloat(total_v).toFixed(2);

                    $('#sm_name').html(data['get_data'][0]['SM_NAME']);
                    $('#total_calls_mkt').html(data['get_data'][0]['Outlet_Visit_Actual_FTD']);
                    $('#value_mkt').html(total_val);
                    $('#billut_mkt').html(data['get_data'][0]['Billcuts_D__1']);
                    $('#tlsd_mkt').html(data['get_data'][0]['TLSD_D__1']);

                    $('#popbtn').modal('show');
                }
            }) 
        }
    });
});



