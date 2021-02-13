<?php include("../templates/header.php") ?>

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
  margin-top: 50px;
  display: grid;
  grid-template-columns: auto auto auto;
  padding: 30px;
  background-color: rgba(239, 225, 220, 0.8);
}

.grid-item {
  padding: 20px;
  font-size: 30px;
  text-align: left;
  font-family: "Open Sans"
}

.left {
  text-align: left;
}

.doubleSpan {
  grid-column-end: span 2;
}

</style>

<div class="nav-container">
  <?php include("../templates/navBar.php") ?>
</div>

<div class="wrapper">

  <div class="grid-container">
    <div class="grid-item">Database Dump</div>
    <div class="grid-item doubleSpan">
      <form method="post" action="/kidney-exchange/generate_json/jsonDump.php" class="search">
        <input type="submit" class="button searchBtn" name="submit" value="Download">
      </form>
    </div>
    <div class="grid-item">Compatibility Graph </div>
    <div class="grid-item doubleSpan">
      <form method="post" action="/kidney-exchange/generate_json/cmpGraph.php" class="search">
        <input type="submit" class="button searchBtn" name="submit" value="Download">
      </form>
    </div>
    <div class="grid-item">Data upload (Json)</div>
    <div class="grid-item">
      <form method="post" action="#" class="search">
        <input type="file" class="custom-file-input" name="json" id="json">
        <input type="submit" class="button searchBtn" name="submit" value="Upload">
      </form>
    </div>
  </div>

  <?php 
    if(isset($_GET['error'])) {
      if ($_GET['error'] == "notSameHosp") {
        echo "<p id='failed'>This pair does not belong to your hospital</p>";
      }
      elseif ($_GET['error'] == "invalidPairId") {
        echo "<p id='failed'>Please enter a valid pair id</p>";
      }
      elseif ($_GET['error'] == "noPairIdExists") {
        echo "<p id='failed'>No such pair id exists</p>";
      }
    }
  ?>

</div>

<?php include_once("../include/footer.inc.php") ?>