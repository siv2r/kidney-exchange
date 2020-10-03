$(document).ready(function(){

	$('#a').on('click', function(){
  alert('test pass');
});
	

	$('#next-btn').on('click', function(){

		  if(!$("input:radio[name='r_sex']").is(":checked")) {
	      
	         $('#radio-sex').css('background','rgba(197, 18, 68, 0.18) ');
	      }else{
	      		$('#radio-sex').css('background','rgba(255, 255, 255, 0.18) ');
	      }

	});
	$('#radio-sex').on('click', function(){

		  if(!$("input:radio[name='r_sex']").is(":checked")) {
	   
	         $('#radio-sex').css('background','rgba(197, 18, 68, 0.18) ');
	      }else{
	      		$('#radio-sex').css('background','rgba(255, 255, 255, 0.18) ');
	      }

	});
	
	$('#next-btn').on('click', function(){

		  if(!$("input:radio[name='r_hiv']").is(":checked")) {
	       
	         $('#radio-hiv').css('background','rgba(197, 18, 68, 0.18) ');
	      }else{
	      		$('#radio-hiv').css('background','rgba(255, 255, 255, 0.18) ');
	      }

	});
	$('#radio-hiv').on('click', function(){

		  if(!$("input:radio[name='r_hiv']").is(":checked")) {
	        
	         $('#radio-hiv').css('background','rgba(197, 18, 68, 0.18) ');
	      }else{
	      		$('#radio-hiv').css('background','rgba(255, 255, 255, 0.18) ');
	      }

	});

	$('#next-btn').on('click', function(){

		  if(!$("input:radio[name='r_hepB']").is(":checked")) {
	      
	         $('#radio-hep').css('background','rgba(197, 18, 68, 0.18) ');
	      }else{
	      		$('#radio-hep').css('background','rgba(255, 255, 255, 0.18) ');
	      }

	});

	$('#radio-hep').on('click', function(){

		  if(!$("input:radio[name='r_hepB']").is(":checked")) {
	        
	         $('#radio-hep').css('background','rgba(197, 18, 68, 0.18) ');
	      }else{
	      		$('#radio-hep').css('background','rgba(255, 255, 255, 0.18) ');
	      }

	});

	$('#next-btn').on('click', function(){

		  if(!$("input:radio[name='r_hepC']").is(":checked")) {
	      
	         $('#radio-hepc').css('background','rgba(197, 18, 68, 0.18) ');
	      }else{
	      		$('#radio-hepc').css('background','rgba(255, 255, 255, 0.18) ');
	      }

	});
	
	$('#radio-hepc').on('click', function(){

		  if(!$("input:radio[name='r_hepC']").is(":checked")) {
	        
	         $('#radio-hepc').css('background','rgba(197, 18, 68, 0.18) ');
	      }else{
	      		$('#radio-hepc').css('background','rgba(255, 255, 255, 0.18) ');
	      }

	});

$('#nextBtn').on('click', function(){
	
		  if(!$("input:radio[name='r_gender']").is(":checked")) {
	      
	         $('#radio-gender').css('background','rgba(197, 18, 68, 0.18) ');
	      }else{
	      		$('#radio-gender').css('background','rgba(255, 255, 255, 0.18) ');
	      }

	});
	
	$('#radio-gender').on('click', function(){

		  if(!$("input:radio[name='r_gender']").is(":checked")) {
	        
	         $('#radio-gender').css('background','rgba(197, 18, 68, 0.18) ');
	      }else{
	      		$('#radio-gender').css('background','rgba(255, 255, 255, 0.18) ');
	      }

	});


	

});
