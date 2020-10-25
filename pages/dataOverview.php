<?php

include("../templates/db-connect.php");

$sql = "SELECT * FROM pd_pairs ORDER BY pair_id";
$result = mysqli_query($conn, $sql);
$result_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<?php include("../templates/header.php") ?>

<link rel="stylesheet" href="../css/data-style.css">

<div class="nav-container">
  <?php include("../templates/nav-bar.php") ?>
</div>

<div class="wrapper">
  
  <h2 class="heading">PD Pairs</h2>

  <table>
    <tr>
      <th>Pair ID</th>
      <th>Patient ID</th>
      <th>Donor ID</th>
      <th>Hospital ID</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>

    <?php foreach ($result_array as $row) { ?>
      <tr>
        <td><?php echo $row['pair_id'] ?></td>
        <td><?php echo $row['patient_id'] ?></td>
        <td><?php echo $row['donor_id'] ?></td>
        <td><?php echo $row['hosp_id'] ?></td>
        <td><?php echo $row['status'] ?></td>
        <td>
          <a class="button info" href="../pages/editPairForm.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>">Edit</a>
          <a class="button danger" href="../include/deleteData.inc.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>">Delete</a>
        </td>

      </tr>
    <?php } ?>


  </table>
</div>

</body>

</html>