<?php include "../templates/header.php";?>

<link rel="stylesheet" href="../css/searchBar.css">
<link rel="stylesheet" href="../css/button-style.css">

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
#outer{
  height:75vh;
}
</style>

<div class="nav-container">
  <?php include "../templates/navBar.php";?>
</div>

<div class="container col-lg-8 my-5 py-5" id="outer">

  <form method="post" action="../pages/pairData.php" class="search">
    <input type="text" name="id" id="id" placeholder="Search the pair id..">
    <input type="submit" id="searchBtn" class="button" name="submit" value="Search Pair">
  </form>

  <?php

    if ( isset( $_GET['error'] ) ) {
      if ( $_GET['error'] == "notSameHosp" ) {
        echo "<p id='failed'>This pair does not belong to your hospital</p>";
      } elseif ( $_GET['error'] == "invalidPairId" ) {
        echo "<p id='failed'>Please enter a valid pair id</p>";
      } elseif ( $_GET['error'] == "noPairIdExists" ) {
        echo "<p id='failed'>No such pair id exists</p>";
      }
    }

  ?>

</div>

<?php include_once "../include/footer.inc.php";?>