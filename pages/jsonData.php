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



.left {
  text-align: left;
}
.row,.col{
  padding: 3%;
}

.head{
  font-size: 3.5vh;
}
.doubleSpan {
  grid-column-end: span 2;
}

.wrapper{
  height: 90vh;
}



</style>

<div class="nav-container">
  <?php include("../templates/navBar.php") ?>
</div>

<div class="wrapper d-flex justify-content-center align-items-center">

  <div class="container">
  <div class="row">
  <div class="col head">Database Dump</div>
    <div class="col doubleSpan">
      <form method="post" action="/kidney-exchange/generate_json/jsonDump.php" class="search">
        <input type="submit" class="button searchBtn" name="submit" value="Download">
      </form>
    </div>
  </div>
  <div class="row">
  <div class="col head">Compatibility Graph </div>
    <div class="col doubleSpan">
      <form method="post" action="/kidney-exchange/generate_json/cmpGraph.php" class="search">
        <input type="submit" class="button searchBtn" name="submit" value="Download">
      </form>
    </div>  
  </div>

  <div class="row">
  <div class="col head">Data upload (Yet to be implemented...)</div>
    <div class="col">
      <form method="post" action="#" class="row search">
        <input type="file" class="col custom-file-input" name="json" id="json">
        <input type="submit" style="width: auto;" class=" colbutton searchBtn" name="submit" value="Upload">
      </form>
    </div>
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