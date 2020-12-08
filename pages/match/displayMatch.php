<!-- get the match results for the given pair -->
<?php require_once("include/getMatch.inc.php") ?>

<style>

/* --------------------Background--------------------------- */
  body{
    background-color: seashell;
    background-repeat: no-repeat;
    background-size: cover;
  } 

/* ------------------------Table styles and alignment------------------------- */
  #possible-match {
    width: 70%;
    background-color: white;
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

  .content-table caption {
    color: #009879;
    padding: 5px 10px;
    text-align: left;
    margin-top: 15px;
    font-weight: bolder;
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

      <!-- table body -->
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
        
        <!-- Composite score row -->
        <tr class="blank_row">
          <td colspan="5"></td>
          <td>Composite score</td>
          <td><?php echo $row['pairScore'][2] ?></td>
        </tr>

      </tbody>
    </table>
  <?php endforeach; ?>

  <!-- <script src="../scripts/fixRowspanHover.js"></script> -->

<?php include_once("../include/footer.inc.php") ?>