$(document).ready(function () {

    get_key_name_list();
    
});
$('#key_name_list').on('change',function(){
});

$('#btnClear').on('click',function(){
    $('#key_name_list').val('').trigger('change');
    $('#start_Date').val('').trigger('change');
    window.location.reload();
});

function get_key_name_list(){
        $.ajax({
        type: "POST",
        url: BASE_URL + 'RSController/get_key_name_list',
        data: {},
        dataType: "json",
        success: function (data) {
            if (data.length != 0) {

                var html ='<option value="">Select</option>';

                for (let index = 0; index < data.length; index++) {
                        html += '<option value="' + data[index].id + '">' + data[index].rs_key_name + '</option>';
                }

                $('#key_name_list').html(html);
            }
        }
    });
}


$("#key_name_list").on("change",function(){
  var urlmenu = $('#key_name_list').val();
  // var startDate = moment($('#start_Date').val()).format("YYYY-MM") ;
  // console.log(startDate);
        $.ajax({
          type: "POST",
          url: BASE_URL + 'RSController/get_title_list',
          data: {
            kay_name: urlmenu,
            // startDate: startDate,
          },
          dataType:'json',
          success: function (data) {
                        
                var html = '';
                var i=1;
                var total_points = 0;
                var lengthOfArr = data.length;

                    html +='<tr>'; 
                    html +='<td>Date</td>';
                    html +='<td>Target Points</td>';
                    $.each(data, function (key, val) {

                        var startDate = moment(val.start_key_date).format("DD-MM-YYYY");
                        var endDate =moment(val.end_key_date).format("DD-MM-YYYY");
                        // console.log(startDate);
                    html +='<td >'+startDate+ ' to ' +endDate+ '</td>';
                    });
                     html +='</tr>';
                    html +='<tr>';
                    html +='<td data-label="Parameter">STOCKS AS PER NORM (both EPDs & NPDs)</td>';
                    html +='<td data-label="Point">5</td>';
                    $.each(data, function (key, val) {
                        var values= val.key_stocks_point;
                        if (values==5) {
                        html +='<td data-label="Points" style="background-color: #90EE90;" >'+val.key_stocks_point+'</td>'; }
                        else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_stocks_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_stocks_point+'</td>';} 
                        else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_stocks_point+'</td>';}
                    values="";
                    });             
                    html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">Infra RSSM vs Actual</td>';
                    html +='<td data-label="Point">5</td>';
                     $.each(data, function (key, val) {
                        var values= val.key_infra_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_infra_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_infra_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_infra_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_infra_point+'</td>';
                        }
                    values="";
                    });  
                     html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">Infra Delivery Vehicle vs Actual</td>';
                    html +='<td data-label="Point">5</td>';
                     $.each(data, function (key, val) {
                        var values= val.key_infra_delivery_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_infra_delivery_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_infra_delivery_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_infra_delivery_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_infra_delivery_point+'</td>';
                        }
                    values="";
                    // html +='<td data-label="Points">'+val.key_infra_delivery_point+'</td>';
                    });  
                     html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">Number of RED RSSM</td>';
                    html +='<td data-label="Point">5</td>';
                    $.each(data, function (key, val) {
                         var values= val.key_number_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_number_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_number_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_number_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_number_point+'</td>';
                        }
                    values="";
                    });             
                    html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">Order Vs Delivery</td>';
                    html +='<td data-label="Point">5</td>';
                    $.each(data, function (key, val) {
                        var values= val.key_order_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_order_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_order_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_order_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_order_point+'</td>';
                        }
                    values="";
                    });             
                    html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">FF Absenteeism (HoW & Total calls condition)</td>';
                    html +='<td data-label="Point">5</td>';
                    $.each(data, function (key, val) {
                        var values= val.key_ffabsenteeism_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_ffabsenteeism_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_ffabsenteeism_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_ffabsenteeism_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_ffabsenteeism_point+'</td>';
                        }
                    values="";
                     // html +='<td data-label="Points">'+val.key_ffabsenteeism_point+'</td>';
                    });             
                    html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">FF Absenteeism (Actual Absent)</td>';
                    html +='<td data-label="Point">5</td>';
                    $.each(data, function (key, val) {
                         var values= val.key_ffabsenteeism_actual_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_ffabsenteeism_actual_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_ffabsenteeism_actual_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_ffabsenteeism_actual_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_ffabsenteeism_actual_point+'</td>';
                        }
                    values="";
                     // html +='<td data-label="Points">'+val.key_ffabsenteeism_actual_point+'</td>';
                    });             
                    html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">NPD Investment</td>';
                    html +='<td data-label="Point">5</td>';
                    $.each(data, function (key, val) {
                        var values= val.key_npd_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_npd_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_npd_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_npd_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_npd_point+'</td>';
                        }
                    values="";
                     // html +='<td data-label="Points">'+val.key_npd_point+'</td>';
                    });             
                    html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">Financials</td>';
                    html +='<td data-label="Point">5</td>';
                    $.each(data, function (key, val) {
                        var values= val.key_financials_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_financials_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_financials_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_financials_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_financials_point+'</td>';
                        }
                    values="";
                     // html +='<td data-label="Points">'+val.key_financials_point+'</td>';
                    });             
                    html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">INFRASTRUCTURE - Warehouse</td>';
                    html +='<td data-label="Point">5</td>';
                    $.each(data, function (key, val) {
                         var values= val.key_infrastructure_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_infrastructure_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_infrastructure_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_infrastructure_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_infrastructure_point+'</td>';
                        }
                    values="";
                     // html +='<td data-label="Points">'+val.key_infrastructure_point+'</td>';
                    });             
                    html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">SSFA = XDM</td>';
                    html +='<td data-label="Point">5</td>';
                    $.each(data, function (key, val) {
                        var values= val.key_ssfa_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_ssfa_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_ssfa_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_ssfa_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_ssfa_point+'</td>';
                        }
                    values="";
                     // html +='<td data-label="Points">'+val.key_ssfa_point+'</td>';
                    });             
                    html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">XDM regular usage (daily usage)</td>';
                    html +='<td data-label="Point">5</td>';
                    $.each(data, function (key, val) {
                        var values= val.key_xdm_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_xdm_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_xdm_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_xdm_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_xdm_point+'</td>';
                        }
                    values="";
                     // html +='<td data-label="Points">'+val.key_xdm_point+'</td>';
                    });             
                    html +='</tr>';

                    html +='<tr>';
                    html +='<td data-label="Parameter">Issues Raised with SDE</td>';
                    html +='<td data-label="Point">5</td>';
                    $.each(data, function (key, val) {
                        var values= val.key_issues_raised_point;
                        if (values==5) {
                    html +='<td data-label="Points" style="background-color: #90EE90;">'+val.key_issues_raised_point+'</td>'; }
                    else if (values ==3) { 
                        html +='<td data-label="Points" style="background-color: orange;">'+val.key_issues_raised_point+'</td>'; }
                        else if (values ==2){
                         html +='<td data-label="Points" style="background-color: red;">'+val.key_issues_raised_point+'</td>';
                        } else{
                            html +='<td data-label="Points" style="background-color: red;">'+val.key_issues_raised_point+'</td>';
                        }
                    values="";
                     // html +='<td data-label="Points">'+val.key_issues_raised_point+'</td>';
                    });             
                    html +='</tr>';

                html +='<tr>';
                html +='<td></td>';
                html +='<td><strong>Total Points</strong></td>';
                $.each(data, function (key, val) {
                        // console.log(val.key_stocks_point);
                         total_points = Number(val.key_stocks_point) + Number(val.key_infra_point) + Number(val.key_infra_delivery_point) +  Number(val.key_number_point) + Number(val.key_order_point) + Number(val.key_ffabsenteeism_point)  + 
                    Number(val.key_ffabsenteeism_actual_point) + Number(val.key_npd_point) + Number(val.key_financials_point)  +  Number(val.key_infrastructure_point) + Number(val.key_ssfa_point)+ Number(val.key_xdm_point)+ Number(val.key_issues_raised_point);

                html +='<td data-label="Total Points" ><strong>'+total_points+'</strong></td>';
                total_points = 0;
                    });
                html +='</tr>';
                $('#adt_tb_body').html(html);
                // $('#adt_details_modal_btn').click();

         }
    });
});


