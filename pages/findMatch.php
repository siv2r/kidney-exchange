<?php 

session_start();

if (isset($_POST['id'])) {
  
  //connection to database and custom functions
  include("../templates/db-connect.php");
  require_once("../include/functions.inc.php");
  require_once("../include/getMatches.inc.php");

  $pair_id = $_POST['id'];

  // check if pair id is valid or not
  if (isValidPairId($pair_id) == false) {
    header("location: ../pages/dataSearch.php?error=invalidPairId");
    exit();
  }

  // check if pair id is present in database
  if (getPairById($conn, $pair_id) == false) {
    header("location: ../pages/dataSearch.php?error=noPairIdExists");
    exit();
  }

  //check if the transplant coordinator is searching in the same hospital
  $checkHospid = explode('-', $pair_id);
  if ($_SESSION['userType'] === "Transplant coordinator" && $_SESSION['hospId'] != $checkHospid[0]) {
    header("location: ../pages/dataSearch.php?error=notSameHosp");
    exit();
  } 

  $matchResults = getMatches($pair_id);

}

else {
  header("location: ../pages/match.php");
}

?>

<?php include("../templates/header.php") ?>

  <link rel="stylesheet" href="../css/table-style.css">
  <link rel="stylesheet" href="../css/button-style.css">

  <style>
    #resultTable{
      width: 85%;
      text-align: center;
    }

    h2.heading {
      text-align: center;
      color: #E2B842;
      font-size: 30px;
      margin: 50px auto 10px auto;
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