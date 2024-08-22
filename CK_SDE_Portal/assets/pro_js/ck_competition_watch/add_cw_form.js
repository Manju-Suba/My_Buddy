

$('#cwForm').submit(function(e) {
    var checkedNum = $('input[name="cw_insight_category[]"]:checked').length;
    if (!checkedNum) {
        fields_required();
    }else{
        $('#saveBtn').attr("disabled", true);
        $("#saveBtn").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
        e.preventDefault();
        
        var formData = new FormData(this);
        $.ajax({  
            url:BASE_URL + 'Competition/addcwForm', 
            method:"POST",  
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType:"json",
        
            success:function(data) {

                if(data.logstatus =='success'){

                    $('#cwForm')[0].reset();
                    $('.single-select').select2({
                        theme: 'bootstrap4',
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                        placeholder: $(this).data('placeholder'),
                        allowClear: Boolean($(this).data('allow-clear')),
                    });
                   
                    
                    $('#saveBtn').attr("disabled", false);
                    $('#saveBtn').html('Save');
                    
                    added_toast();
                    
                }
                else{
                    request_failed();
                    $('#saveBtn').attr("disabled", false);
                    $('#saveBtn').html('Save');
                    
                }
                        
            }  
        }); 
    
    }
});