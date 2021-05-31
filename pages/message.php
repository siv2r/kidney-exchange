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
    <?php include("../templates/navBar.php") ?>
  </div>

  <?php 
    $status = $_SESSION['status'];
    $statusMsg = $_SESSION['msg'];

    if(isset($_SESSION['form']) && $_SESSION['form'] == 'pd-form' && isset($_SESSION['r_id'])){ //change 'form' to 'type'
      $r_id = $_SESSION['r_id'];
      $d_id = $_SESSION['d_id'];
    }
    else if(isset($_SESSION['form']) && $_SESSION['form'] == 'hospital-form' && isset($_SESSION['h_id'])){
      $h_id = $_SESSION['h_id'];
    } 
    else if(isset($_SESSION['form']) && $_SESSION['form'] == 'delete' && isset($_SESSION['del_r_id'])) { 
      $del_r_id = $_SESSION['del_r_id'];
      $del_d_id = $_SESSION['del_d_id'];
    }
    else if(isset($_SESSION['form']) && $_SESSION['form'] == 'edit' && isset($_SESSION['edit_r_id'])) { 
      $edit_r_id = $_SESSION['edit_r_id'];
      $edit_d_id = $_SESSION['edit_d_id'];
    }

  ?>

  <div class="wrapper">

    <div id="msg-box">
      <div class="success">
        <?php  
          if($status == 1 && $_SESSION['form'] == 'pd-form'){
            echo "<p>$statusMsg</p>";
            echo "<p>Your patient id : $r_id</p>";
            echo "<p>Your donor id : $d_id</p>";
            // unset($_SESSION['form']);
            // unset($_SESSION['r_id']);
            // unset($_SESSION['d_id']);
          }
          else if($status == 1 && $_SESSION['form'] == 'hospital-form'){
            echo "<p>$statusMsg</p>";
            echo "<p>Your hospital id : $h_id</p>";
            // unset($_SESSION['form']);
            // unset($_SESSION['h_id']);
          }
          else if($status == 1 && $_SESSION['form'] == 'delete'){
            echo "<p>$statusMsg</p>";
            echo "<p>Patient id : $del_r_id</p>";
            echo "<p>Donor id : $del_d_id</p>";
            // unset($_SESSION['form']);
            // unset($_SESSION['del_r_id']);
            // unset($_SESSION['del_d_id']);
          }
          else if($status == 1 && $_SESSION['form'] == 'edit'){
            echo "<p>$statusMsg</p>";
            echo "<p>Patient id : $edit_r_id</p>";
            echo "<p>Donor id : $edit_d_id</p>";
            // unset($_SESSION['form']);
            // unset($_SESSION['del_r_id']);
            // unset($_SESSION['del_d_id']);
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

<?php
require_once "../include/footer.inc.php";
?>