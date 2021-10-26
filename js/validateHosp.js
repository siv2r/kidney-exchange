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

  $.validator.addMethod( "lettersonly", function( value, element ) {
    return this.optional( element ) || /^[A-Za-z]+$/i.test( value );
  }, "Letters only please" );

  $.validator.addMethod( "nowhitespace", function( value, element ) {
    return this.optional( element ) || /^\S+$/i.test( value );
  }, "Please do not enter any whitespaces" );

  $.validator.addMethod( "startsCapital", function( value, element ) {
    return this.optional( element ) || /^[A-Z]/.test( value );
  }, "Please start with a capital letter" );

  $.validator.addMethod( "mobileIndia", function( value, element ) {
    return this.optional( element ) || /^[6-9]\d{9}$/i.test( value );
  }, "Please enter a valid 10 digit mobile number" );

  $.validator.addMethod( "pincodeIndia", function( value, element ) {
    return this.optional( element ) || /^[1-9]{1}[0-9]{5}$/i.test( value );
  }, "Please enter a valid pincode for your region" );
  
  //applying validation
  let form = $("#hospForm")
  form.validate({
    rules: {
      // name validations
      nephro_fname: {
        required: true,
        nowhitespace: true,
        lettersonly: true,
        startsCapital: true
      },

      h_name: {
        required: true,
        startsCapital: true,

      },
      nephro_lname: {
        required: true,
        nowhitespace: true,
        lettersonly: true,
        startsCapital: true
      },
      surg_fname: {
        required: true,
        nowhitespace: true,
        lettersonly: true,
        startsCapital: true
      },
      surg_lname: {
        required: true,
        nowhitespace: true,
        lettersonly: true,
        startsCapital: true
      },

      //address validations
      h_addr1: {
        supernumeric: true
      },
      h_addr2: {
        supernumeric: true
      },
      h_city: {
        nowhitespace: true,
        lettersonly: true,
      },
      h_state: {
        lettersonly: true,
      },
      h_pincode: {
        nowhitespace: true,
        pincodeIndia: true
      },
      h_country: {
        nowhitespace: true,
        lettersonly: true,
      },

      //Id vaidations
      h_license: {
        supernumeric: true,
        nowhitespace: true
      },
      nephro_id: {
        supernumeric: true,
        nowhitespace: true
      },
      surg_id: {
        supernumeric: true,
        nowhitespace: true
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