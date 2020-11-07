<?php

include("../templates/db-connect.php");

$sql = "SELECT * FROM pd_pairs ORDER BY pair_id";
$result = mysqli_query($conn, $sql);
$result_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<?php include("../templates/header.php") ?>

<!-- <link rel="stylesheet" href="../css/data-style.css"> -->
<style>
  .button {
    background-color: #dcdcdc;
    color: black;
    padding: 10px 20px;
    display: inline-block;
    margin: 5px;
    cursor: pointer;
    font-size: 19px;
    border-radius: 5%;
    outline: none;
    border: none;
    text-decoration: none;
  }

  .info{
    background-color: #008CBA;
    color: white;
    border-radius: 8px;
    margin: 5px;
  }

  .danger{
    background-color:#f44336;
    color: white;
    border-radius: 8px;
    margin: 5px;
  }

  .success{
    background-color:#3CB371;
    color: white;
    border-radius: 8px;
    margin: 5px;
  }

  body {
    background: #105469;
  }

  table {
    background: #012B39;
    border-radius: 0.25em;
    border-collapse: collapse;
    margin: 13% auto;
    width: 80%;
  }
  th {
    border-bottom: 1px solid #364043;
    color: #E2B842;
    font-size: 1.5em;
    font-weight: 600;
    padding: 0.5em 1em;
    text-align: center;
  }
  td {
    color: #fff;
    font-weight: 400;
    font-size: 1.35em;
    padding: 0.65em 1em;
    text-align: center;
  }
  .disabled td {
    color: #4F5F64;
  }
  .disabled td a {
    opacity: 0.5;
  }
  tbody tr {
    transition: "background 0.25s ease";
  }
  tbody tr:hover {
    background: #014055;
  }
</style>

<div class="nav-container">
  <?php include("../templates/nav-bar.php") ?>
</div>

<div class="wrapper">
  
  <table>
    <tr>
      <th>Pair ID</th>
      <th>Patient ID</th>
      <th>Donor ID</th>
      <th>Hosp ID</th>
      <th>Status</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>

    <?php foreach ($result_array as $row) : ?>
      <?php 
        if ($_SESSION['userType'] === "Transplant coordinator" && $_SESSION['hospId'] != $row['hosp_id']) {
          continue;
        }   
      ?>
      <tr>
        <td><?php echo $row['pair_id'] ?></td>
        <td><?php echo $row['patient_id'] ?></td>
        <td><?php echo $row['donor_id'] ?></td>
        <td><?php echo $row['hosp_id'] ?></td>
        <td>
          <a href="../include/toggleStatus.inc.php?pair_id=<?php echo $row['pair_id']?>&hosp_id=<?php echo $row['hosp_id']?>" class="checkDisable button success confirmation"><?php echo $row['status'] ?></a>
        </td>
        <td>
          <a class="button info confirmation" href="../pages/editPairForm.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>">Edit</a>
        </td>
        <td>
          <a class="button danger confirmation" href="../include/deleteData.inc.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>


  </table>
</div>

<script>
$( document ).ready(function() {
  $('.confirmation').on('click', function () {
    return confirm('Are you sure?');
  });

  var statusArray = $('.checkDisable');

  statusArray.each(function(){
    if($(this).text() != 'Active') {
      $(this).parent().parent().addClass('disabled');
      $(this).removeClass('success');
      $(this).addClass('danger');
    }
    else {
      $(this).parent().removeClass('disabled');
      $(this).addClass('success');
      $(this).removeClass('danger');
    }
  });
});
  
</script>

</body>

</html>