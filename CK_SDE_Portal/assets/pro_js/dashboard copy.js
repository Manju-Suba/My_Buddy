
$(document).ready(function () {
    get_project_list();
});

function get_project_list(){
 
    $.ajax({  
        url:BASE_URL + 'Tsocontroller/get_project_list', 
        method:"POST",  
        data:{},
        dataType:"json",

        success:function(data) {
            if(data.pro_details.length !=0){
                if(data.logstatus =='success'){

                    var pd_html = '';
                    for (let index = 0; index < data.pro_details.length; index++) {
                        // alert(data.pro_details[index].project_url);
                        var img_url = ASSET_URL+'images/logo-icon.png';
                        pd_html +='<div class="col-lg-3">';
                            pd_html +='<div class="card radius-15 '+data.pro_details[index].bootstrap_class+'">';
                                pd_html +='<div class="card-body" style="padding: 0.5rem;">';
                                    pd_html +='<div class="media align-items-center">';
                                        pd_html +='<img src="'+img_url+'" width="60" height="60" class="rounded-circle p-1 border bg-white" alt="" />';
                                        pd_html +='<div class="media-body ml-3">';
                                            pd_html +='<a href="#" onclick="get_project_type('+"'"+data.pro_details[index].project_url+"'"+','+"'"+data.pro_details[index].project_id+"'"+');"><h6 class="mb-0 text-white">'+data.pro_details[index].project_name+'</h6></a>';
                                             // alert(pd_html);
                                        pd_html +='<span class="text-light display_none load_show_'+data.pro_details[index].project_id+'" style="margin-top:4px;"><i class="lni lni-spinner"></i> Please Wait..!</span></div>';
                                    pd_html +='</div>';
                                pd_html +='</div>';
                            pd_html +='</div>';
                        pd_html +='</div>';

                    }

                    $('#show_pd_list').html(pd_html);
                    $('#session_role_type').val(data.role_type);
                    $('#session_mobile_no').val(data.login_mob_no);
                    $('#session_password').val(data.login_pass);
                }
                else{

                }
            }
        }
    })
}


function get_project_type(pro_base_url,pro_id){
    
    if(pro_id =='PRO10'){
        window.location = pro_base_url + "settings";

    }else{

    var login_mob_no = $('#session_mobile_no').val();
    var login_pass =  $('#session_password').val();
    $('.load_show_'+pro_id).css({"display":"block"});
    
    $.ajax({  
        url:pro_base_url + 'LoginController/doLogin', 
        method:"POST",  
        data:{"mobile":login_mob_no,"pass":login_pass,"pro_id":pro_id,},
        dataType:"json",

        success:function(data) {
            if(data.logstatus =='success'){

                setTimeout(
                    function() {
                        // window.open(pro_base_url + data.url, "_blank" );
                        window.location = pro_base_url + data.url;

                        $('.load_show_'+pro_id).css({"display":"none"});

                    }, 2000);

            }
            else{
                
               
            }
            
        }  
    }); 
    }

}


function get_change_pass_pop(){
    $('#show_pass_pop').click();
}
