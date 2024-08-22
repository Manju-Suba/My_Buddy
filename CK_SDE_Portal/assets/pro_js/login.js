

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;


}

$('#loginForm').submit(function(e) {

    $("#btnSignin").attr("disabled", true);
    $("#btnSignin").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
    
    var formData = new FormData(this);
    e.preventDefault();

       $.ajax({  
            url:BASE_URL + 'Login/doLogin', 
            method:"POST",  
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType:"json",

            success:function(data) { 

                if(data.logstatus =='success'){
                    var mobile_no = $('#login_mob_no').val();
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + 'Login/updatelog',
                        data: { "mobile_no":mobile_no,},
                        dataType:"json",
                        success: function (result) {
                           
                            if(result.response =='success'){
                                login_success();

                                setTimeout(
                                    function() {
                                        window.location = BASE_URL + data.url;
            
                                    }, 2000);
                            }else{

                                $("#btnSignin").attr("disabled", false);
                                $("#btnSignin").text('Log In');
                                request_failed();
                            }

                        }
                    })
                    

                }
                else if(data.logstatus =='not_a_user'){
                    $("#btnSignin").attr("disabled", false);
                    $("#btnSignin").text('Log In');

                    invaild_user();
                   
                }else{
                    $("#btnSignin").attr("disabled", false);
                    $("#btnSignin").text('Log In');

                    request_failed();
                }
                
            }  
        }); 
    
    
});

