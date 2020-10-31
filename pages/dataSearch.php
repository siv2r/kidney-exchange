<?php include("../templates/header.php") ?>

<link rel="stylesheet" href="../css/data-style.css">

<div class="nav-container">
  <?php include("../templates/nav-bar.php") ?>
</div>

<div class="wrapper">

  <form method="post" action="../pages/pairData.php" class="search">
    <input type="text" name="id" id="id" placeholder="Enter pair id only">
    <button type="submit" id="searchBtn" class="button" name='submit' value="submit">Search</button>
  </form>

</div>

<?php include_once("../include/footer.inc.php") ?>