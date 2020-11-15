<?php 

if (isset($_POST['id'])) {
  require_once("../include/getMatches.inc.php");

  $pair_id = $_POST['id'];
  //check for valid id here ....
  
  $matchResults = getMatches($pair_id);

}

else {
  header("location: ../pages/match.php");
}

?>

<?php include("../templates/header.php") ?>

  <link rel="stylesheet" href="../css/data-style.css">

  <style>
    #resultTable{
      width: 85%;
      text-align: center;
    }

  </style>

  <div class="nav-container">
    <?php include("../templates/nav-bar.php") ?>
  </div>

  <h2 class="heading">Match Results</h2>
  <table id="resultTable">
    <tr>
      <th>Pair ID</th>
      <th>Patient Name</th>
      <th>Donor Name</th>
      <th>Pair Score (P1-D2, P2-D1)</th>
    </tr>

    <?php foreach ($matchResults as $row) : ?>
      <tr>
        <td><?php echo $row[0] ?></td>
        <td><?php echo $row[1] ?></td>
        <td><?php echo $row[2] ?></td>
        <td><?php echo "(". $row[3][0] . ", " . $row[3][1] . ")"; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

<?php include_once("../include/footer.inc.php") ?>