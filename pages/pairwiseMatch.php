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
#inputPairWiseId
{
  height:63vh;
}
@media screen and (max-width: 992px) {
  #inputPairWiseId
  {
      margin-top:26vh;
      align-item: center;
  }
  .search input[type="text"]
  {
    width:95%;
  }
}
</style>

<div class="nav-container">
  <?php include "../templates/navBar.php";?>
</div>

<div class="container" id="inputPairWiseId">

  <form method="post" action="../pages/displayPairwiseMatch.php" class="search">
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
<?php include_once "../include/footer.inc.php";?>