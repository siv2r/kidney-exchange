$(document).ready(function(){
//  console.log($(".beautify"));
  $(".beautify").select2(); // enable select2


  // ---------------Add events for fields to pop up---------------------------

  $("#comorb").change(function() {
    
    if ($.inArray("Others", $(this).val()) === -1) {
      $("#comorb-others").hide();
    } else {
      $("#comorb-others").show();
    }
  });
  $("#comorb").trigger("change"); //to make others field disappear on page start


  $("#comorb2").change(function() {
    if ($.inArray("Others", $(this).val()) === -1) {
      $("#comorb-others2").hide();
    } else {
      $("#comorb-others2").show();
    }
  });
  $("#comorb2").trigger("change"); //to make others field disappear on page start


  $("#prev-transp").change(function(){

    if($(this).val() === "Yes"){
      $("#dot").show();  //show date of transplant field
      //write some validation condtions
    }

    else{
      $("#dot").hide();
      //remove validations
    }
  });
  $("#prev-transp").trigger("change");


  $("#mode-of-dialysis").change(function(){

    let input_value = $(this).val();

    if(input_value === "Hemodialysis"){
      $("#date-of-dialysis").show();
      $("#vascular-access").show();
      //add validations
    }

    else if(input_value === "Peritoneal dialysis"){
      $("#date-of-dialysis").show();
      $("#vascular-access").hide();
      //add validaitons for date of dialysis
      //remove validations vascualar access
    }

    else{
      $("#date-of-dialysis").hide();
      $("#vascular-access").hide();
      //remove validations of dialysis
    }
  });
  $("#mode-of-dialysis").trigger("change");


  $("#ddp").change(function(){
    if($(this).val() === "Yes"){
      $("#ddp-regno").show();
      //write some validation condtions
    }

    else{
      $("#ddp-regno").hide();
      //remove validations
    }
  });
  $("#ddp").trigger("change");


  $("#pre-transp").change(function(){
    if($(this).val() === "Yes"){
      $("#pre-transp-specify").show();
      //write some validation condtions
    }

    else{
      $("#pre-transp-specify").hide();
      //remove validations
    }
  });
  $("#pre-transp").trigger("change");

  //--------------------------------BMI Calculator----------------------------------------

  $("#r_height, #r_weight").on("input", function(){

    let height = $("#r_height").val(); // in cms
    let weight = $("#r_weight").val();  //in kgs

    if(!$("#r_height").val() || !$("#r_weight").val()){
      $("#r_bmi").val("");
      return false;
    }

    let bmi = weight/((height/100)*(height/100));
    $("#r_bmi").val(bmi.toFixed(2));
  });

  $("#d_height, #d_weight").on("input", function(){

    let height = $("#d_height").val(); // in cms
    let weight = $("#d_weight").val();  //in kgs

    if(!$("#d_height").val() || !$("#d_weight").val()){
      $("#d_bmi").val("");
      return false;
    }

    let bmi = weight/((height/100)*(height/100));
    $("#d_bmi").val(bmi.toFixed(2));
  });

  // ------------------------Making the form as multi-step-------------------------------

  var tabs = $(".tab");
  var curr_tab = 0;
  var total_tabs = tabs.length;

  $("#prev-btn").click(prev_tab);
  $("#next-btn").click(next_tab);

  tabs.hide();
  $("#msg_tab").hide();

  show_curr_tab();

  function show_curr_tab(){
    window.scrollTo(0, 0);
    $(tabs[curr_tab]).show();

    //modify next and prev buttons
    if(curr_tab == 0){
      $("#prev-btn").hide();
    }
    else{
      $("#prev-btn").show();
    }

    if(curr_tab == (total_tabs-1)){
      $("#next-btn").text("Submit");
    }
    else{
      $("#next-btn").text("Next");
    }

    if(curr_tab == total_tabs){
      $("#next-btn").hide();
      $("#prev-btn").hide();
    }

  }
  /**
   * 
   * @returns Boolean
   */
  function next_tab(){

    let isValid = validate_form(); // check the validity of the current tab
    if (!isValid) {
      window.scrollTo(0, 0); // maye be change this to first error occurence???
      return false;
    }

    $(tabs[curr_tab]).hide();
    curr_tab++;

    if(curr_tab >= total_tabs){ // this happens after submitting the form
      $("#reg-form").submit();   
      $("#msg_tab").show();
      $("#prev-btn").hide();
      $("#next-btn").hide();
      return false;
    }

    show_curr_tab();
  } 

  function prev_tab(){
    $(tabs[curr_tab]).hide();
    curr_tab--;

    show_curr_tab();
  }

  //-----------------------------------------Form validation------------------------------------

  /**
   * 
   * @returns string
   */
	function validate_form(){

    // Custom error messages
    $.validator.setDefaults({
      errorClass: 'help-block error-width',
      highlight: function(element){
        if($(element).hasClass('beautify')){
          $(element).addClass('has-error');
          $(element).next().addClass('has-error');   //tweak select2 field
        }

        else if ($(element).attr('type')==='radio') {
          $(element).parent().addClass('has-error');
        }
        else 
          $(element).addClass('has-error');

      },
      unhighlight: function(element){
        // remove the tweak for select2 here
        if ($(element).attr('type')==='radio') {
          $(element).parent().removeClass('has-error');
        }
        $(element).removeClass('has-error');
      },
      errorPlacement: function (error, element){
        if(element.prop('type') === 'radio' || element.prop('type') === 'select-multiple'){
          error.appendTo(element.parent());
        } 
        else {
          error.insertAfter(element);
        }
      }
    });

    // Custom validation methods
    $.validator.addMethod( "supernumeric", function( value, element ) {
      return this.optional( element ) || /^[A-Za-z0-9_,-.' ]+$/.test( value );
    }, "alphanumeric, comma, undersocre, dots, hyphen only please" );

    $.validator.addMethod( "alphanumeric", function( value, element ) {
      return this.optional( element ) || /^[A-Za-z0-9]+$/.test( value );
    }, "Letters and numbers only please" );

    $.validator.addMethod( "lettersonly", function( value, element ) {
      return this.optional( element ) || /^[A-Za-z]+$/.test( value );
    }, "Letters only please" );

    $.validator.addMethod( "nowhitespace", function( value, element ) {
      return this.optional( element ) || /^\S+$/i.test( value );
    }, "Please do not enter any whitespaces" );

    $.validator.addMethod( "startsCapital", function( value, element ) {
      return this.optional( element ) || /^[A-Z]/.test( value );
    }, "Please start your name with a capital letter" );

    $.validator.addMethod( "mobileIndia", function( value, element ) {
      return this.optional( element ) || /^[6-9]\d{9}$/.test( value );
    }, "Please enter a valid 10 digit mobile number" );

    $.validator.addMethod( "pincodeIndia", function( value, element ) {
      return this.optional( element ) || /^[1-9]{1}[0-9]{5}$/.test( value );
    }, "Please enter a valid pincode for your region" );

    $.validator.addMethod( "twoDecimal", function( value, element ) {
      return this.optional( element ) || /^[0-9]+\.[0-9][0-9]$/.test( value ) || /^[0-9]+$/.test( value );
    }, "Please round off to two decimal places" );

    $.validator.addMethod( "positiveOnly", function( value, element ) {
      return this.optional( element ) || (value > 1);
    }, "Please enter a positive number greater than 1" );

    $.validator.addMethod("hlaRestrict", function(value, element) {
      return value.length == 2;
    }, "Please select exactly two anitgens");

    $.validator.addMethod('fileSize', function (value, element, param) {
      let paramBytes = param*1024*1024;
      return this.optional(element) || (element.files[0].size <= paramBytes)
    }, "File size must be less than {0} MB");

    $.validator.addMethod("minAge", function(value, element, min) {
      let today = new Date();
      let birthDate = new Date(value);
      let age = today.getFullYear() - birthDate.getFullYear();
   
      if (age > min+1) { 
        return true; 
      }
   
      let m = today.getMonth() - birthDate.getMonth();
   
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { 
        age--; 
      }
      return age >= min;

    }, "Donor must be atleast {0} years old!");

    //file fields name
    // "r_img, r_b-report, r_ua-report, r_hla-report"
    //applying validation
		let form = $("#reg-form")
    form.validate({
      rules: {
        // name validations
        r_fname: {
          required: true,
          nowhitespace: true,
          lettersonly: true,
        },
        r_lname: {
          required: true,
          nowhitespace: true,
          lettersonly: true,
        },
        d_fname: {
          required: true,
          nowhitespace: true,
          lettersonly: true,
        },
        d_lname: {
          required: true,
          nowhitespace: true,
          lettersonly: true,
        },

        //donor age restriction
        d_dob: {
          minAge: 18
        },

        //bmi validations
        r_height: {
          positiveOnly: true,
          twoDecimal: true
        },
        r_weight: {
          positiveOnly: true,
          twoDecimal: true
        },
        d_height: {
          positiveOnly: true,
          twoDecimal: true
        },
        d_weight: {
          positiveOnly: true,
          twoDecimal: true
        },

        //address validations
        r_addr1: {
          //supernumeric: true
        },
        r_addr2: {
          supernumeric: true
        },
        r_city: {
          supernumeric:true
        },
        r_state: {
          lettersonly: true,
        },
        r_pincode: {
          nowhitespace: true,
          pincodeIndia: true
        },
        r_country: {
          nowhitespace: true,
          lettersonly: true,
        },
        d_addr1: {
          //supernumeric: true
        },
        d_addr2: {
          supernumeric: true
        },
        d_city: {
          supernumeric:true
        },
        d_state: {
          lettersonly: true,
        },
        d_pincode: {
          nowhitespace: true,
          pincodeIndia: true
        },
        d_country: {
          nowhitespace: true,
          lettersonly: true,
        },

        //mobile number validations
        r_cno: {
          mobileIndia: true
        },
        d_cno: {
          mobileIndia: true
        },
        //email id validations 
        r_email: {
          email: true
        },
        d_email: {
          email: true
        },

        //antigen count restrict
        "r_hla_a[]": {
          hlaRestrict: true
        },
        "r_hla_b[]": {
          hlaRestrict: true
        },
        "r_hla_dr[]": {
          hlaRestrict: true
        },
        "d_hla_a[]": {
          hlaRestrict: true
        },
        "d_hla_b[]": {
          hlaRestrict: true
        },
        "d_hla_dr[]": {
          hlaRestrict: true
        },

        // radio buttons validation
        //gender validations
        r_sex: "required",
        d_sex: "required",
        //serology validations
        r_hiv: "required",
        r_hepB: "required",
        r_hepC: "required",
        d_hiv: "required",
        d_hepB: "required",
        d_hepC: "required",

        //file validation
        r_img: {
          extension: "png,jpg,jpeg",
          fileSize: 1
        },
        d_img: {
          extension: "png,jpg,jpeg",
          fileSize: 1
        },
        "r_b-report": {
          extension: "pdf",
          fileSize: 1
        },
        "r_hla-report": {
          extension: "pdf",
          fileSize: 1
        },
        "r_ua-report": {
          extension: "pdf",
          fileSize: 1
        },
        "d_b-report": {
          extension: "pdf",
          fileSize: 1
        },
        "d_hla-report": {
          extension: "pdf",
          fileSize: 1
        }
      },
  
      messages: {
        r_sex: "Please fill this field",
        d_sex: "Please fill this field",
        //serology validations
        r_hiv: "Please fill this field",
        r_hepB: "Please fill this field",
        r_hepC: "Please fill this field",
        d_hiv: "Please fill this field",
        d_hepB: "Please fill this field",
        d_hepC: "Please fill this field",
        r_img: {
          extension: "Only jpg, jpeg, png are allowed"
        },
        d_img: {
          extension: "Only jpg, jpeg, png are allowed"
        },
        "r_b-report": {
          extension: "Only pdf is allowed"
        },
        "r_hla-report": {
          extension: "Only pdf is allowed"
        },
        "r_ua-report": {
          extension: "Only pdf is allowed"
        },
        "d_b-report": {
          extension: "Only pdf is allowed"
        },
        "d_hla-report": {
          extension: "Only pdf is allowed"
        }
      },
      
    });

    $('.requiredField').each(function() {
      $(this).rules('add', {
        required: true,
        messages: {
          required:  "Please fill this field"
        }
      });
    });

    return form.valid();
	}
});