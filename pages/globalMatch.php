<?php include "../templates/header.php";?>

<link rel="stylesheet" href="../css/searchBar.css">
<link rel="stylesheet" href="../css/button-style.css">
<link rel="stylesheet" href="../css/customFileInput.css">

<style>

/* -----------------------Background Images----------------------- */
body{
  background-image: url("https://wallpapercave.com/wp/wp2088513.png");
  background-repeat: no-repeat;
  background-size: cover;
}

/* -------------------Styling the error messages----------------- */
#failed{
  color: #c51244;
  font-size: 28px;
  text-align: center;
  margin: 15px auto;
}

#success{
  color: #32cd32;
  font-size: 28px;
  text-align: center;
}
/* -------------------------CSS Grids-----------------------------*/

.grid-container {
  display: grid;
  grid-template-columns: auto auto;
  padding: 15px;

}

.grid-item {
  padding: 20px 0px 20px 50px;
  font-size: 25px;
  text-align: left;
  font-family: "Open Sans"
}

/* -------------------------Additional Styling-----------------------------*/

form {
  background-color: rgba(239, 225, 220, 0.8);
}

select {
  font-size: 20px;
  outline: none;
}

.small-select {
  min-width: 20%;
}
.very-large-select {
  min-width: 85%;
}

.left {
  text-align: left;
}

.center {
  text-align: center;
}

.doubleSpan {
  grid-column-end: span 2;
}
@media screen and (max-width: 992px) {
  .grid-container {
  display:flex;
  flex-direction: column;
  padding:1px;
  align-items: center;

}
  .grid-item {
  padding:10px 0px 6px 6px;
  font-size: 1.5rem;
  text-align: left;
  font-family: "Open Sans";
  width:fit-content;
}
.very-large-select
{
  width:100%;
}
select
{
  font-size:15px;
}
}
#outer
{
  height:75vh;
}
</style>

<div class="nav-container">
  <?php include "../templates/navBar.php";?>
</div>

<div class="container col-lg-8 mt-5 pt-5 mb-5 pb-4" id="outer">
  <form method="post" action="/kidney-exchange/global_match/findGlobalMatch.php" class="search">
    <div class="grid-container">
      <div class="grid-item">Maximum cycle size</div>
      <div class="grid-item">
        <select name="max-cycle" class="small-select" id="">
          <option value="2">2</option>
          <option value="3">3</option>
          <option disabled value="4">4</option>
        </select>
      </div>
      <!-- <div class="grid-item">Altruistic chain length </div>
      <div class="grid-item">
        <select name="max-chain" class="small-select" id="">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div> -->
      <div class="grid-item">Optimality criteria</div>
      <div class="grid-item">
        <select name="optimality" class="very-large-select" id="">
          <!-- <option value="1">maximise the number of effective pairwise exchanges</option> -->
          <option value="1">maximise the total number of transplants</option>
          <option value="4">maximise the total weight</option>
        </select>
      </div>
      <div class="grid-item doubleSpan center">
        <input type="submit" class="button searchBtn" name="submit" value="Find Match">
      </div>
    </div>
  </form>
</div>

<?php include_once "../include/footer.inc.php";?>