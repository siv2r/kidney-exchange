<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="../css/data-style.css">

<?php include("../templates/header.php") ?>

<div class="nav-container">
  <?php include("../templates/nav-bar.php") ?>
</div>

<div class="wrapper">

  <form method="post" action="patient-data.php" class="search">
    <input type="text" name="id" id="id" placeholder="Enter the patient id here">
    <button type="submit" id="searchBtn" class="button" name='submit' value="submit">Search</button>
  </form>

</div>

</body>

</html>