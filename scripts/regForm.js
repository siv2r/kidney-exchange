
//global variables
var prevBtn = document.querySelector('#prevBtn');
var nextBtn = document.querySelector('#nextBtn');
var currTab = 0;
var tabs = document.querySelectorAll('.tab');
var steps = document.querySelectorAll('.step');
var totalTabs = tabs.length;

//adding event listener for the buttons
prevBtn.addEventListener('click', prevTab);
nextBtn.addEventListener('click', nextTab);

showCurrTab();

function showCurrTab(){

  tabs[currTab].style.display = 'block';

  //modify next and prev buttons
  if(currTab == 0){
    prevBtn.style.display = 'none';
  }
  else{
    prevBtn.style.display = 'inline-block';
  }

  if(currTab == (totalTabs-1)){
    nextBtn.innerHTML = 'Submit';
  }
  else{
    nextBtn.innerHTML = 'Next';
  }

  if(currTab == totalTabs){
    prevBtn.style.display = 'none';
    nextBtn.style.display = 'none';
  }

  //fix the steps
  fixStepIndicator();

}

function nextTab(){

  if(!validateForm()){
    window.scrollTo(0, 0);
    return false;
  }
  
  tabs[currTab].style.display = 'none';
  currTab++;
  
  if(currTab >= totalTabs){
    document.querySelector('#regForm').submit();
    return false;
  }

  showCurrTab();
  window.scrollTo(0, 0);
} 

function prevTab(){
  tabs[currTab].style.display = 'none';
  currTab--;

  showCurrTab();
}

function validateForm(){

  var valid = true;

  const text_fields = tabs[currTab].querySelectorAll('input[type=text]');
  const num_fields = tabs[currTab].querySelectorAll('input[type=number]');
  
  for(let i=0; i<text_fields.length; i++){
    if(text_fields[i].value == ''){
      text_fields[i].className += ' invalid';
      valid = false;
    }
  }

  for(let i=0; i<num_fields.length; i++){
    if(num_fields[i].value == ''){
      num_fields[i].className += ' invalid';
      valid = false;
    }
  }

  if(valid){
    steps[currTab].className += ' finish';
  }

  return valid;
}

function fixStepIndicator() {
  // This function removes the "active" class of all steps...
  for (let i = 0; i < steps.length; i++) {
    steps[i].className = steps[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  steps[currTab].className += " active";
}



