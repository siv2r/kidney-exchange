// dom of class tabs
var patient = document.querySelector('.patient');
var donor = document.querySelector('.donor');


//add event for buttons
document.querySelector('#patientBtn').addEventListener('click', displayPatient);
document.querySelector('#donorBtn').addEventListener('click', displayDonor);

displayPatient();

function displayPatient(){
  patient.style.display = 'block';
  donor.style.display = 'none';
}

function displayDonor(){
  patient.style.display = 'none';
  donor.style.display = 'block';
}
