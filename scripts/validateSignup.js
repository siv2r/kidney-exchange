$("#submitBtn").click(function(event){
  event.preventDefault();
  if(!validate_form()){
    console.log("Form is not valid");
    return false;
  }

  console.log("Form is valid");
  $("#hospForm").submit();
});


function validate_form(){
  
  // Custom error messages
  $.validator.setDefaults({
    errorClass: 'help-block error-width',
    
    highlight: function(element){
        $(element).addClass('has-error');
    },

    unhighlight: function(element){
      $(element).removeClass('has-error');
    },

    errorPlacement: function (error, element){
      error.insertAfter(element); 
    }
  });

  // Custom validation methods
  $.validator.addMethod( "supernumeric", function( value, element ) {
    return this.optional( element ) || /^[A-Za-z0-9_,-.'# ]+$/i.test( value );
  }, "alphanumerics, commas, underscores, dots, hyphens, apostophes and hashes only please" );

  $.validator.addMethod( "alphanumeric", function( value, element ) {
    return this.optional( element ) || /^[A-Za-z0-9]+$/i.test( value );
  }, "Letters and numbers only please" );

  $.validator.addMethod( "nowhitespace", function( value, element ) {
    return this.optional( element ) || /^\S+$/i.test( value );
  }, "Please do not enter any whitespaces" );

  $.validator.addMethod( "numbersonly", function( value, element ) {
    return this.optional( element ) || /^[0-9]+$/i.test( value );
  }, "numbers only please" );
  
  //applying validation
  let form = $("#hospForm")
  form.validate({
    rules: {
      // name validations
      uname: {
        nowhitespace: true,
      },

      email: {
        email: true
      },

      hosp_id: {
        nowhitespace: true,
        numbersonly: true
      },

      pswd: {
        nowhitespace: true,
      },

      re_pswd: {
        nowhitespace: true,
        equalTo: "#pswd"
      }
    }

    // messages: {

    // }
    
  });

  $('.requiredField').each(function() {
    $(this).rules('add', {
      required: true,
      messages: {
        required:  "Please fill this field"
      }
    });
  });

  console.log("decision of the validate function",form.valid());
  return form.valid();
}	