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
  margin-top: 80px;
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

</style>

<div class="nav-container">
  <?php include "../templates/navBar.php";?>
</div>

<div class="wrapper">

  <form method="post" action="/kidney-exchange/generate_json/jsonDump.php" class="search">
    <div class="grid-container">
      <div class="grid-item">Maximum cycle size</div>
      <div class="grid-item">
        <select name="max-cycle" class="small-select" id="">
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
      </div>
      <div class="grid-item">Altruistic chain length </div>
      <div class="grid-item">
        <select name="max-chain" class="small-select" id="">
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>
      <div class="grid-item">Optimality criteria</div>
      <div class="grid-item">
        <select name="constraint" class="very-large-select" id="">
          <option value="0">maximise the number of effective pairwise exchanges</option>
          <option value="0">maximise the number of pairwise exchanges</option>
          <option value="0">maximise the total number of transplants</option>
          <option value="0">maximise the total number of backarcs</option>
          <option value="0">maximise the total weight</option>
          <option value="0">minmise the number of 3-way exchanges</option>
          <option value="0">max transplants in 2-ways plus unused altruists</option>
        </select>
      </div>
      <div class="grid-item doubleSpan center">
        <input type="submit" class="button searchBtn" name="submit" value="Find Match">
      </div>
    </div>
  </form>

  <?php

if (isset($_GET['error'])) {
  if ($_GET['error'] == "notSameHosp") {
    echo "<p id='failed'>This pair does not belong to your hospital</p>";
  } elseif ($_GET['error'] == "invalidPairId") {
    echo "<p id='failed'>Please enter a valid pair id</p>";
  } elseif ($_GET['error'] == "noPairIdExists") {
    echo "<p id='failed'>No such pair id exists</p>";
  }
}
?>

</div>

<?php include_once "../include/footer.inc.php";?>