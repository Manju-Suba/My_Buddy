var $registrationForm = $('#ssForm');
if($registrationForm.length){
  $registrationForm.validate({
      rules:{
          //username is the name of the textbox
          c_name: {
              required: true,
          }
      },
      messages:{
          c_name: {
              required: 'Please enter username!'
          }
      },
      errorPlacement: function(error, element) 
      {
        if (element.is(":radio")) 
        {
            error.appendTo(element.parents('.gender'));
        }
        else if(element.is(":checkbox")){
            error.appendTo(element.parents('.hobbies'));
        }
        else 
        { 
            error.insertAfter( element );
        }
        
       }
  });
}