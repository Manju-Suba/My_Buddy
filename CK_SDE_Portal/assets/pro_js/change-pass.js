$('#passSubmit').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({  
        url:BASE_URL + 'Tsocontroller/updatePassword', 
        method:"POST",  
        data: formData,
        cache:false, 
        contentType: false,
        processData: false,
        dataType:"json",

        success:function(data) {
            if(data.message =='success'){

                $('#passSubmit')[0].reset();
                $('#pop_close').click();

                updated_toast();

                window.location.href = data.url;

            }
            else{
                request_failed();
            }
            
        }  
    });  
});