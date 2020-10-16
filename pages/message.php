
<?php 

  session_start();

  $status = $_SESSION['status'];
  $statusMsg = $_SESSION['msg'];

  if($_SESSION['form'] == 'patient-form' && isset($_SESSION['r_id'])){
    $r_id = $_SESSION['r_id'];
    $d_id = $_SESSION['d_id'];
  }
  else if($_SESSION['form'] == 'hospital-form' && isset($_SESSION['h_id'])){
    $h_id = $_SESSION['h_id'];
  }

?>


<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="../css/form-style.css">
<link rel="stylesheet" href="../css/data-style.css">

<style>
  .nav-container{
    position: static;
  }

  .success p{
    font-size: 24px;
    line-height: 1.6em;
    color: green;
    font-weight: bold;
  }

  .failure p{
    font-size: 24px;
    line-height: 1.6em;
    color: red;
    font-weight: bold;
  }

  #msg-box{
    border: 2px solid silver;
    background-color: whitesmoke;
    text-align: center;
    width: 70%;
    margin: 20% auto 0% auto;
    padding: 5%;
  }

</style>

<?php include("../templates/header.php") ?>

  <div class="nav-container">
    <?php include("../templates/nav-bar.php") ?>
  </div>

  <div class="wrapper">

    <div id="msg-box">
      <div class="success">
        <?php  
          if($status == 1 && $_SESSION['form'] == 'patient-form'){
            echo "<p>$statusMsg</p>";
            echo "<p>Your patient id is $r_id</p>";
            echo "<p>Your donor id is $d_id</p>";
          }
          else if($status == 1 && $_SESSION['form'] == 'hospital-form'){
            echo "<p>$statusMsg</p>";
            echo "<p>Your hospital id is $h_id</p>";
          }
        ?>
      </div>
      
      <div class="failure">
        <?php  
          if($status == 0){
            echo "<p>Your registration failed....</p>";
            echo "<p>$statusMsg</p>";
          }
        ?>
      </div>
      
    </div>

  </div>

