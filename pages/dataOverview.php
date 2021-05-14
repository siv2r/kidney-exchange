<?php

include("../templates/db-connect.php");

$sql = "SELECT * FROM pd_pairs ORDER BY pair_id";
$result = mysqli_query($conn, $sql);
$result_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<?php include("../templates/header.php") ?>


  <link rel="stylesheet" href="../css/button-style.css">
  <link rel="stylesheet" href="../css/table-style.css">

  <style>
   
    
    table .button
    {
      padding:10px 15px;
    }
      
  </style>

  
    <?php include("../templates/navBar.php") ?>
  
  <div class="container-fluid mt-5 py-5 px-0 idtable">
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
            <a href="../include/toggleStatus.inc.php?pair_id=<?php echo $row['pair_id']?>&hosp_id=<?php echo $row['hosp_id']?>" class="checkDisable button success confirmStatus"><?php echo $row['status'] ?></a>
          </td>
          <td>
            <a class="button info confirmEdit" href="../pages/editPairForm.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>">Edit</a>
          </td>
          <td>
            <a class="button danger confirmDelete" href="../include/deleteData.inc.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>


    </table>
  </div>

  <script>
  $( document ).ready(function() {

    $('.confirmDelete').on('click', function () {
      return confirm('Do you want to delete this record?');
    });

    $('.confirmEdit').on('click', function () {
      return confirm('Do you want to edit this record?');
    });

    $('.confirmStatus').on('click', function () {
      return confirm('Do you want to change the status of this record?');
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>