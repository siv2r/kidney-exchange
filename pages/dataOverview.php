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

      /* On screens that are 992px or less, set the background color to blue */
  @media screen and (max-width: 992px) {
    .smallhide
    {
      display:none;
    }
    th,td
    {
      width:25vw !important;
    }
    th
    {
      font-size:17px;
    }
    td
    {
      font-size:16px;
      color:#fff !important;
    }
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
        <th class="smallhide">Status</th>
        <th class="smallhide">Edit</th>
        <th class="smallhide">Delete</th>
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
          <td class="smallhide">
            <input type="hidden" value="../include/toggleStatus.inc.php?pair_id=<?php echo $row['pair_id']?>&hosp_id=<?php echo $row['hosp_id']?>" id="statusinput">
            <a href="#" class="checkDisable button success confirmStatus"><?php echo $row['status'] ?></a>
          </td>
          <td class="smallhide">
          <input type="hidden" value="../pages/editPairForm.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>" id="editinput">
            <a class="button info confirmEdit" href="#">Edit</a>
          </td>
          <td class="smallhide">
          <input type="hidden" value="../include/deleteData.inc.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>" id="deleteinput">
            <a class="button danger confirmDelete" href="#">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>


    </table>
  </div>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
  $( document ).ready(function() {

    $('.confirmDelete').on('click', function () {
      var href = $(this).attr('href');
      var inputval = document.getElementById("deleteinput").value;
      console.log(href,inputval)
      swal({
      title: "Are you sure?",
      text: "You Want Delete!!",
      icon: "warning",
      buttons: true,
      buttons: ['cancel','Yes'],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = inputval;
      } else {
        
      }
    });
    });

    $('.confirmEdit').on('click', function () {
      var href = $(this).attr('href');
      var inputval = document.getElementById("editinput").value;
      console.log(href,inputval)
      swal({
      title: "Are you sure?",
      text: "You Want Edit!!",
      icon: "warning",
      buttons: true,
      buttons: ['cancel','Yes'],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = inputval;
      } else {
        
      }
    });
    });

    $('.confirmStatus').on('click', function () {
      var href = $(this).attr('href');
      var inputval = document.getElementById("statusinput").value;
      console.log(href,inputval)
      swal({
      title: "Are you sure?",
      text: "You Want Change Status!!",
      icon: "warning",
      buttons: true,
      buttons: ['cancel','Yes'],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = inputval;
      } else {
        
      }
    });
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