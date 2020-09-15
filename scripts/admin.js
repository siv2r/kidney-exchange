// dom of class tabs
var personal = document.querySelector('.personal_tab');
var med = document.querySelector('.med_tab');
var hosp = document.querySelector('.hosp_tab');

//add event for buttons
document.querySelector('#personalBtn').addEventListener('click', displayPersonal);
document.querySelector('#medBtn').addEventListener('click', displayMed);
document.querySelector('#hospBtn').addEventListener('click', displayHosp);

displayPersonal();


function displayPersonal(){
  personal.style.display = 'block';
  med.style.display = 'none';
  hosp.style.display = 'none';
}

function displayMed(){
  personal.style.display = 'none';
  med.style.display = 'block';
  hosp.style.display = 'none';
}

function displayHosp(){
  personal.style.display = 'none';
  med.style.display = 'none';
  hosp.style.display = 'block';
}