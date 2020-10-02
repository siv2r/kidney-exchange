$(document).ready(function(){
//  console.log($(".beautify"));
  $(".beautify").select2(); // enable select2


  // ---------------Add events for fields to pop up---------------------------

  $("#comorb").change(function() {
    
    if ($.inArray("Others", $(this).val()) === -1) {
      $("#comorb-others").hide();
      // $('#otherField').attr('required', '');
      // $('#otherField').attr('data-error', 'This field is required.');
    } else {
      $("#comorb-others").show();
      // $('#otherField').removeAttr('required');
      // $('#otherField').removeAttr('data-error');
    }
  });
  $("#comorb").trigger("change"); //to make others field disappear on page start


  $("#comorb2").change(function() {
    if ($.inArray("Others", $(this).val()) === -1) {
      $("#comorb-others2").hide();
      // $('#otherField').attr('required', '');
      // $('#otherField').attr('data-error', 'This field is required.');
    } else {
      $("#comorb-others2").show();
      // $('#otherField').removeAttr('required');
      // $('#otherField').removeAttr('data-error');
    }
  });
  $("#comorb2").trigger("change"); //to make others field disappear on page start


  $("#prev-transp").change(function(){

    if($(this).val() === "yes"){
      $("#date-of-transp").show();
      //write some validation condtions
    }

    else{
      $("#date-of-transp").hide();
      //remove validations
    }
  });
  $("#prev-transp").trigger("change");


  $("#mode-of-dialysis").change(function(){

    let input_value = $(this).val();

    if(input_value === "hemodialysis"){
      $("#date-of-dialysis").show();
      $("#vascular-access").show();
      //add validations
    }

    else if(input_value === "peritoneal dialysis"){
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
    if($(this).val() === "yes"){
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
    if($(this).val() === "yes"){
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

  function next_tab(){

		// let isValid = validate_form(); // check the validity of the current tab
		// console.log(isValid);
		// if(!isValid) return false;

		console.log("form valid!");

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


	function validate_form(){

    $.validator.setDefaults({
      errorClass: 'help-block error-width',
      highlight: function(element){
        if($(element).hasClass('beautify')){
          $(element).addClass('has-error');
          $(element).next().addClass('has-error');   //tweak select2 field
        }

        else if ($(element).is('input[radio]')){
          $(element.parent()).addClass('has-error');
        }
        else 
          $(element).addClass('has-error');

      },
      unhighlight: function(element){
        // remove the tweak for select2 here
        $(element).removeClass('has-error');
      },
      errorPlacement: function (error, element){
        if(element.prop('type') === 'radio' || element.prop('type') === 'select-multiple'){
          error.appendTo(element.parent());
          console.log(element.parent());
        } 
        else {
          error.insertAfter(element);
        }
      }
    });
		
		let form = $("#reg-form")
    form.validate({
      rules: {
        r_fname: "required",
        r_lname: "required",
        r_sex: "required",
        r_email: {
          email: true
        },
        r_hiv: "required",
        r_hepB: "required",
        r_hepC: "required"
      },
  
      messages: {
       
      },
      
    });

    $('.requiredField').each(function() {
      $(this).rules('add', {
        required: true,
        messages: {
          required:  "This field is required"
        }
      });
    });

    return form.valid();
	}





  
});