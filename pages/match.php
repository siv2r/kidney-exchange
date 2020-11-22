<?php include("../templates/header.php") ?>

<link rel="stylesheet" href="../css/data-style.css">
<link rel="stylesheet" href="../css/button-style.css">

<style>
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
  <?php include("../templates/nav-bar.php") ?>
</div>

<div class="wrapper">

  <form method="post" action="../pages/findMatch.php" class="search">
    <input type="text" name="id" id="id" placeholder="Enter pair id only">
    <button type="submit" id="searchBtn" class="button" name='submit' value="submit">Search</button>
  </form>

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