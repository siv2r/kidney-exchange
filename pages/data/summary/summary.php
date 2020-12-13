<?php
include_once("../templates/db-connect.php");
include_once("../include/functions.inc.php");

$pArray = getPatients($conn);
$dArray = getDonors($conn);

?>

<?php include("../../../partials/header.php") ?>

  <link rel="stylesheet" href="../css/button-style.css">
  <link rel="stylesheet" href="../css/blueContentTable.css">

  <style>
    /* --------------------Background--------------------------- */

    body{
      background-color: seashell;
      background-repeat: no-repeat;
      background-size: cover;
    } 

    /* ------------------------Table styles------------------------- */
    #patientTable {
      min-width: 85%;
      background-color: white;
    }

    #donorTable {
      min-width: 80%;
      background-color: white;
    }

    .heading {
      text-align: center;
      font-size: 30px;
      margin: 50px auto 10px auto;
    }

  </style>

  <div class="nav-container">
    <?php include("../../../partials/subpagesNavBar.php") ?>
  </div>

  <h2 class="heading">Patients</h2>
  <table class="content-table" id="patientTable">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Age</th>
      <th>BMI</th>
      <th>Blood Group</th>
      <th>HLA Antigens</th>
      <th>DSA</th>
      <th>Serology</th>
      <th>Clearance</th>
      <th>Dialysis</th>
    </tr>

    <?php foreach ($pArray as $row) : ?>
      <?php 
        $checkHospid = explode('-', $row['id']);

        if ($_SESSION['userType'] === "Transplant coordinator" && $_SESSION['hospId'] != $checkHospid[0]) {
          continue;
        } 
        //get the row values
        $pAge = date_diff(date_create($row['dob']), date_create('today'))->y;
        $pBMI = bmiVal($row['height'], $row['weight']);
        $pUa = (!empty($row['ua_antigens'])) ? "Yes": "No";
        $pSerology = ($row['hiv'] == "Positive" 
        || $row['hep_b'] == "Positive" 
        || $row['hep_c'] == "Positive") ? "Positive" : "Negative";
        $pDialysisArray = explode(", ", $row['dialysis']);
        $pDialysis = $pDialysisArray[0];

      ?>
      <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $pAge ?></td>
        <td><?php echo $pBMI?></td>
        <td><?php echo $row['blood_group'] ?></td>
        <td><?php echo $row['hla_antigens'] ?></td>
        <td><?php echo $pUa ?></td>
        <td><?php echo $pSerology ?></td>
        <td><?php echo $row['prov_clearance'] ?></td>
        <td><?php echo $pDialysis ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <h2 class="heading">Donors</h2>
  <table class="content-table" id="donorTable">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Age</th>
      <th>BMI</th>
      <th>Blood Group</th>
      <th>HLA Antigens</th>
      <th>Clearance</th>
    </tr>

    <?php foreach ($dArray as $row) : ?>
      <?php 

        $checkHospid = explode('-', $row['id']);

        if ($_SESSION['userType'] === "Transplant coordinator" && $_SESSION['hospId'] != $checkHospid[0]) {
          continue;
        } 
        //get the row values
        $dAge = date_diff(date_create($row['dob']), date_create('today'))->y;
        $dBMI = bmiVal($row['height'], $row['weight']);

      ?>
      <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $dAge ?></td>
        <td><?php echo $dBMI?></td>
        <td><?php echo $row['blood_group'] ?></td>
        <td><?php echo $row['hla_antigens'] ?></td>
        <td><?php echo $row['prov_clearance'] ?></td>
      </tr>
    <?php endforeach; ?>

  </table>

<?php include_once("../include/footer.inc.php") ?>