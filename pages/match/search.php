<<<<<<< HEAD:pages/pairwiseMatch.php
<?php include "../templates/header.php";?>
=======
<?php include("../../partials/header.php") ?>
>>>>>>> 7b03d44a58a02c8674e9bf06d098f3ec0aa6598a:pages/match/search.php

<link rel="stylesheet" href="../css/searchBar.css">
<link rel="stylesheet" href="../css/button-style.css">

<style>

/* -----------------------Background Images----------------------- */
body{
  background-image: url("https://wallpapercave.com/wp/wp2088513.png");
  background-repeat: no-repeat;
  background-size: cover;
}

.search{
  margin-top: 20%;
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
</style>

<div class="nav-container">
<<<<<<< HEAD:pages/pairwiseMatch.php
  <?php include "../templates/navBar.php";?>
=======
  <?php include("../../partials/pagesNavBar.php") ?>
>>>>>>> 7b03d44a58a02c8674e9bf06d098f3ec0aa6598a:pages/match/search.php
</div>

<div class="wrapper">

<<<<<<< HEAD:pages/pairwiseMatch.php
  <form method="post" action="../pages/displayPairwiseMatch.php" class="search">
=======
  <form method="post" action="displayMatch.php" class="search">
>>>>>>> 7b03d44a58a02c8674e9bf06d098f3ec0aa6598a:pages/match/search.php
    <input type="text" name="id" id="id" placeholder="Enter the pair id..">
    <input type="submit" id="searchBtn" class="button" name='submit' value="Find Match">
  </form>

  <?php

if (isset($_GET['error'])) {
  if ($_GET['error'] == "notSameHosp") {
    echo "<p id='failed'>This pair does not belong to your hospital</p>";
  } else if ($_GET['error'] == "invalidPairId") {
    echo "<p id='failed'>Please enter a valid pair id</p>";
  } else if ($_GET['error'] == "noPairIdExists") {
    echo "<p id='failed'>No such pair id exists</p>";
  }
}
?>

</div>

<<<<<<< HEAD:pages/pairwiseMatch.php
<?php include_once "../include/footer.inc.php";?>
=======
<?php include_once("../../partials/footer.php") ?>
>>>>>>> 7b03d44a58a02c8674e9bf06d098f3ec0aa6598a:pages/match/search.php
