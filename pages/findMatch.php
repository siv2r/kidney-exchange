<?php 

session_start();

if (isset($_POST['id'])) {
  
  //connection to database and custom functions
  require_once("../templates/db-connect.php");
  require_once("../include/functions.inc.php");
  require_once("../include/matchFunctions.inc.php");

  $pair_id = $_POST['id'];

  // check if pair id is valid or not
  if (isValidPairId($pair_id) == false) {
    header("location: ../pages/match.php?error=invalidPairId");
    exit();
  }

  // check if pair id is present in database
  if (getPairById($conn, $pair_id) == false) {
    header("location: ../pages/match.php?error=noPairIdExists");
    exit();
  }

  //check if the transplant coordinator is searching in the same hospital
  $checkHospid = explode('-', $pair_id);
  if ($_SESSION['userType'] === "Transplant coordinator" && $_SESSION['hospId'] != $checkHospid[0]) {
    header("location: ../pages/match.php?error=notSameHosp");
    exit();
  } 

  $givenPairData = getPairDataById($conn, $pair_id);
  $matchResults = getMatches($conn, $pair_id);

}

else {
  header("location: ../pages/match.php");
}

?>

<style>

/* --------------------Background--------------------------- */
  body{
    background-color: seashell;
    background-repeat: no-repeat;
    background-size: cover;
  } 

/* ------------------------Table styles------------------------- */
  #possible-match {
    /* margin-top: 50px; */
    width: 70%;
    background-color: white;
  }

  #possible-match caption {
    margin: 10px 20px;
    text-align: left;
  }

  .content-table tbody tr td:first-child,
  .content-table tbody tr td:nth-child(2) {
    border-right: 1px solid #dddddd;
  }

  .content-table thead tr th:first-child {
    border-right: 1px solid #dddddd;
  }

  #tableHeading {
    text-align: center;
    margin: 30px 0 10px 0;
  }
</style>

<?php include("../templates/header.php") ?>

  <link rel="stylesheet" href="../css/button-style.css">
  <link rel="stylesheet" href="../css/greenContentTable.css">

  <div class="nav-container">
    <?php include("../templates/nav-bar.php") ?>
  </div>
  
  

    <h2 id="tableHeading">Possible Matches</h2>

    <?php foreach ($matchResults as $index => $row) : ?>
      <table class="content-table" id="possible-match">

      <caption>Match <?php echo $index+1 ?></caption>
      <!-- table header -->
      <thead>
        <tr>
          <th colspan="2"><?php echo $givenPairData['pairId'] . '/' . $row['pairId'] ?></th>
          <th>Age</th>
          <th>Sex</th>
          <th>Blood group</th>
          <th>HLA</th>
          <th>Pair Score</th>
        </tr>
      </thead>

      <!-- P1 row -->
      <tbody>
        <tr>
          <td><?php echo $givenPairData['pairId'] . "-p"?></td>
          <td><?php echo "P<sub>Input</sub>"?></td>
          <td><?php echo toAge($givenPairData['patientDOB']) ?></td>
          <td><?php echo $givenPairData['patientSex'] ?></td>
          <td><?php echo $givenPairData['patientBloodGroup'] ?></td>
          <td><?php echo $givenPairData['patientHLA'] ?></td>
          <td rowspan="2"><?php echo $row['pairScore'][0] ?></td>
        </tr>
        
        <!-- D2 row -->
        <tr>
          <td><?php echo $row['pairId'] . "-d"?></td>
          <td><?php echo "D<sub>Match " . strval($index+1) . "</sub>" ?></td>
          <td><?php echo toAge($row['donorDOB']) ?></td>
          <td><?php echo $row['donorSex'] ?></td>
          <td><?php echo $row['donorBloodGroup'] ?></td>
          <td><?php echo $row['donorHLA'] ?></td>
        </tr>
        
        <!-- one blank row -->
        <tr class="blank_row">
          <td colspan="7"></td>
        </tr>
        
        <!-- P2 row -->
        <tr>
          <td><?php echo $row['pairId'] . "-p " ?></td>
          <td><?php echo "P<sub>Match " . strval($index+1) . "</sub>" ?></td>
          <td><?php echo toAge($row['patientDOB']) ?></td>
          <td><?php echo $row['patientSex'] ?></td>
          <td><?php echo $row['patientBloodGroup'] ?></td>
          <td><?php echo $row['patientHLA'] ?></td>
          <td rowspan="2"><?php echo $row['pairScore'][1] ?></td>
        </tr>
        
        <!-- D1 row -->
        <tr>
          <td><?php echo $givenPairData['pairId'] . "-d"?></td>
          <td><?php echo "D<sub>Input</sub>" ?></td>
          <td><?php echo toAge($givenPairData['donorDOB']) ?></td>
          <td><?php echo $givenPairData['donorSex'] ?></td>
          <td><?php echo $givenPairData['donorBloodGroup'] ?></td>
          <td><?php echo $givenPairData['donorHLA'] ?></td>
        </tr>
        
        <!--one blank row -->
        <!-- <tr class="blank_row">
          <td colspan="6"></td>
        </tr> -->
      </tbody>
    </table>
  <?php endforeach; ?>


<?php include_once("../include/footer.inc.php") ?>