// dom of class tabs
var overview = document.querySelector('.overview');
var search = document.querySelector('.search');


//add event for buttons
document.querySelector('#overviewBtn').addEventListener('click', displayOverview);
document.querySelector('#searchBtn').addEventListener('click', displaySearch);

displayOverview();

function displayOverview(){
  overview.style.display = 'block';
  search.style.display = 'none';
}

function displaySearch(){
  overview.style.display = 'none';
  search.style.display = 'block';
}
