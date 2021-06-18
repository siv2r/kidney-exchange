<?php require_once "../include/findPairwiseMatch.inc.php";?>

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

  td,tr
  {
    font-size:1.5rem;
  }
  @media screen and (max-width: 992px) {
    .navbar-brand
    {
      font-size:2rem !important;
    }
    #tableHeading
    {
      font-size:2rem;
      margin:10vh auto;
    }
    .navbar , .content-table ,#footer , #tableHeading
    {
      width:195vw !important; 
    }
    #possible-match
    {
      margin-bottom: 13vh !important;;
    }
}
</style>

<?php include "../templates/header.php";?>

  <link rel="stylesheet" href="../css/button-style.css">
  <link rel="stylesheet" href="../css/greenContentTable.css">

  <div class="nav-container">
    <?php include "../templates/navBar.php";?>
  </div>



    <h2 id="tableHeading">Possible Matches</h2>

    <?php foreach ($matchResults as $index => $row): ?>
      <table class="content-table" id="possible-match">

      <caption>Match <?php echo $index + 1; ?></caption>
      <!-- table header -->
      <thead>
        <tr>
          <th colspan="2"><?php echo $givenPairData['pairId'] . '/' . $row['pairData']['pairId']; ?></th>
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
          <td><?php echo $givenPairData['pairId'] . "-p"; ?></td>
          <td><?php echo "P<sub>Input</sub>"; ?></td>
          <td><?php echo toAge($givenPairData['pDob']); ?></td>
          <td><?php echo $givenPairData['pSex']; ?></td>
          <td><?php echo $givenPairData['pBGrp']; ?></td>
          <td><?php echo $givenPairData['pHla']; ?></td>
          <td rowspan="2"><?php echo $row['pScore']; ?></td>
        </tr>

        <!-- D2 row -->
        <tr>
          <td><?php echo $row['pairData']['pairId'] . "-d"; ?></td>
          <td><?php echo "D<sub>Match " . strval($index + 1) . "</sub>"; ?></td>
          <td><?php echo toAge($row['pairData']['dDob']); ?></td>
          <td><?php echo $row['pairData']['dSex']; ?></td>
          <td><?php echo $row['pairData']['dBGrp']; ?></td>
          <td><?php echo $row['pairData']['dHla']; ?></td>
        </tr>

        <!-- one blank row -->
        <tr class="blank_row">
          <td colspan="7"></td>
        </tr>

        <!-- P2 row -->
        <tr>
          <td><?php echo $row['pairData']['pairId'] . "-p "; ?></td>
          <td><?php echo "P<sub>Match " . strval($index + 1) . "</sub>"; ?></td>
          <td><?php echo toAge($row['pairData']['pDob']); ?></td>
          <td><?php echo $row['pairData']['pSex']; ?></td>
          <td><?php echo $row['pairData']['pBGrp']; ?></td>
          <td><?php echo $row['pairData']['pHla']; ?></td>
          <td rowspan="2"><?php echo $row['dScore']; ?></td>
        </tr>

        <!-- D1 row -->
        <tr>
          <td><?php echo $givenPairData['pairId'] . "-d"; ?></td>
          <td><?php echo "D<sub>Input</sub>"; ?></td>
          <td><?php echo toAge($givenPairData['dDob']); ?></td>
          <td><?php echo $givenPairData['dSex']; ?></td>
          <td><?php echo $givenPairData['dBGrp']; ?></td>
          <td><?php echo $givenPairData['dHla']; ?></td>
        </tr>

        <!-- Composite score row -->
        <tr class="blank_row">
          <td colspan="5"></td>
          <td>Composite score</td>
          <td><?php echo $row['totalScore']; ?></td>
        </tr>

      </tbody>
    </table>
  <?php endforeach;?>

  <!-- <script src="../js/fixRowspanHover.js"></script> -->

<?php include_once "../include/footer.inc.php";?>