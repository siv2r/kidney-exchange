<!DOCTYPE html>
<html lang="en">


<style>

  body{
    /* background-image: url("https://images.pexels.com/photos/48604/pexels-photo-48604.jpeg?cs=srgb&dl=pexels-negative-space-48604.jpg&fm=jpg"); */
    background-image: url("https://images.pexels.com/photos/3882464/pexels-photo-3882464.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" );
    background-size: cover; 
       
  }

  .content{
    text-align: center;
    color: white;
    font-size: 20px;  
    margin: 100px;
  }

  .content h1{
    text-align:center;    
  }

  /* .header-img{
    background-image: url("https://images.pexels.com/photos/48604/pexels-photo-48604.jpeg?cs=srgb&dl=pexels-negative-space-48604.jpg&fm=jpg");
    background-size: cover;
    background-position: top center;
    position: relative;
    min-height: 480px;
  } */


</style>

<?php include "templates/header.php"?>

  <!-- <div class="header-img"> -->
    <div class="nav-container">
      <?php include "templates/navBar.php"?>
    </div>
  <!-- </div> -->

<div class="content">
  <h1> <b><u>Project Overview</u></b></h1><br>
  <h3><b> Due to some medical incompatibility many people cannot donate their kidney to their loved ones.
    This problem is called the living donor kidney exchange problem, and in most places of India, doctors solve it manually.<br>This project aims to automate a part of this process
    by providing a platform to facilitate automized inter-hospital kidney transplants.This platform allows interested hospitals to register.
    The doctors from the registered hospitals can create their account and add their patients' (having kidney problems) medical details to this platform.
    After a doctor completes this process, this platform provides two main features: <br><br>
    1) An option to view only the essential details of a patient required for a kidney transplant. <br>
    2) For a given patient, all suitable matches ranked from worst to best from all the registered hospitals are displayed.</b><br> 
  </h3>
</div>

</body>
</html>