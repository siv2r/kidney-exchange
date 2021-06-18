<?php

include("../db-connect.php");

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
            <a href="#../include/toggleStatus.inc.php?pair_id=<?php echo $row['pair_id']?>&hosp_id=<?php echo $row['hosp_id']?>" class="checkDisable button success confirmStatus"><?php echo $row['status'] ?></a>
          </td>
          <td class="smallhide">
            <a class="button info confirmEdit" href="#../pages/editPairForm.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>">Edit</a>
          </td>
          <td class="smallhide">
            <a class="button danger confirmDelete" href="#../include/deleteData.inc.php?pair_id=<?php echo $row['pair_id'] ?>&hosp_id=<?php echo $row['hosp_id'] ?>">Delete</a>
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
      href = href.substring(1);
      console.log(href,typeof(href))
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
        window.location = href;
      } else {
        
      }
    });
    });

    $('.confirmEdit').on('click', function () {
      var href = $(this).attr('href');
      href = href.substring(1);
      console.log(href,typeof(href))
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
        window.location = href;
      } else {
        
      }
    });
    });

    $('.confirmStatus').on('click', function () {
      var href = $(this).attr('href');
      href = href.substring(1);
      console.log(href,typeof(href))
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
        window.location = href;
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
<?php
require_once "../include/footer.inc.php";
