<?php include("../templates/header.php") ?>
<?php
session_start();
if(!isset($_SESSION['userType'])||$_SESSION['userType']!='Admin')
{
echo $_SESSION['userType'];
include './404.php';
exit();
}
?>
<link rel="stylesheet" href="../css/searchBar.css">
<link rel="stylesheet" href="../css/button-style.css">
<link rel="stylesheet" href="../css/customFileInput.css">


<style>
body {
    height: 100vh;
    background-image: linear-gradient(to right bottom, #0c1138, #131c45, #192752, #20335f, #273f6c, #274b76, #28567f, #2b6287, #316f8b, #3d7b8e, #4e8690, #619193);
}



th,td{
  padding: 3vh 0!important;
}

tr:hover
{
  background-color:#273f6c
}
</style>

<div class="nav-container">
    <?php include("../templates/navBar.php") ?>
</div>

<div class="container  px-1 d-flex justify-content-center align-items-center" style="height: 90%; width:100%">
    <table class="table caption-top  text-light table-bordered" id="hosp_table">
    <caption class="text-light  display-6 my-4">List of Registered Hopitals</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Hospital Id</th>
                <th scope="col">Hospital Name</th>
                <th scope="col">Type</th>
            </tr>
        </thead>
        <tbody>

        <?php
        include '../db-connect.php';
        $sql="SELECT * FROM `hospitals`";
        $results=mysqli_query($conn,$sql);
        if(!$results)
        {
          include './404.php';
          exit();
        }
        else
        {$i=0;
          while($row=mysqli_fetch_assoc($results))
          {
              $i+=1;
              $hosp_id=$row['id'];
              $hosp_name=$row['name'];
              $hosp_type=$row['type'];

              echo '
              <tr class="text-center">
              <th scope="row">'.$i.'</th>
              <td>'.$hosp_id.'</td>
              <td>'.$hosp_name.'</td>
              <td>'.$hosp_type.'</td>
          </tr>
              ';
          }
        }


        ?>


        </tbody>
    </table>
</div>

<?php include_once("../include/footer.inc.php") ?>