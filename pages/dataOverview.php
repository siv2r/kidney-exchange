<?php

include("../templates/db-connect.php");

$sql = "SELECT * FROM pd_pairs ORDER BY pair_id";
$result = mysqli_query($conn, $sql);
$result_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<?php include("../templates/header.php") ?>

<link rel="stylesheet" href="../css/data-style.css">
<style>
  td {
    text-align: center;
  }
</style>

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
      <th>Status</th>
      <th colspan="2">Actions</th>
    </tr>

    <?php foreach ($result_array as $row) : ?>
      <?php 
        if ($_SESSION['userType'] === "Transplant coordinator" && $_SESSION['hospId'] != $row['hosp_id']) {
          continue;
        }   
      ?>
      <tr>
        <td><?php echo $row['hosp_id'] . '-' .$row['pair_id'] ?></td>
        <td><?php echo $row['patient_id'] ?></td>
        <td><?php echo $row['donor_id'] ?></td>
        <td><?php echo $row['status'] ?></td>
        <td>
          <a class="button info confirmation" href="../pages/editPairForm.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>">Edit</a>
          <a class="button danger confirmation" href="../include/deleteData.inc.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>


  </table>
</div>

<script>
  $('.confirmation').on('click', function () {
    return confirm('Are you sure?');
  });
</script>

</body>

</html>