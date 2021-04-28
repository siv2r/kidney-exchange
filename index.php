<!DOCTYPE html>
<html lang="en">

 <!-- for bootstrap css  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<style>
  body{
    /* background-image: url("https://images.pexels.com/photos/48604/pexels-photo-48604.jpeg?cs=srgb&dl=pexels-negative-space-48604.jpg&fm=jpg"); */
    background-image: url("https://images.pexels.com/photos/3882464/pexels-photo-3882464.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" );
    background-size: cover; 
       
  }

  .content{
    color: white;
  }
  .content p
  {
    font-size:1.5rem;
  }
  
  /* .header-img{
    background-image: url("https://images.pexels.com/photos/48604/pexels-photo-48604.jpeg?cs=srgb&dl=pexels-negative-space-48604.jpg&fm=jpg");
    background-size: cover;
    background-position: top center;
    position: relative;
    min-height: 480px;
  } */

/* On screens that are 992px or less, set the background color to blue */
@media screen and (max-width: 992px) {
  .content p
  {
    font-size:1.2rem;
  }
  .content h1 {
    font-size:2.5rem;
  }
}
</style>

<?php include "templates/header.php"?>

  <!-- <div class="header-img"> -->
    <div class="nav-container">
      <?php include "templates/navBar.php"?>
    </div>
  <!-- </div> -->
<div class="container py-4 px-3 text-center">
<div class="content">
  <h1 class="text-center"> <b><u>Project Overview</u></b></h1><br>
  <p><b> Due to some medical incompatibility many people cannot donate their kidney to their loved ones.
    This problem is called the living donor kidney exchange problem, and in most places of India, doctors solve it manually.<br>This project aims to automate a part of this process
    by providing a platform to facilitate automized inter-hospital kidney transplants.This platform allows interested hospitals to register.
    The doctors from the registered hospitals can create their account and add their patients' (having kidney problems) medical details to this platform.
    After a doctor completes this process, this platform provides two main features: <br><br>
    1) An option to view only the essential details of a patient required for a kidney transplant. <br>
    2) For a given patient, all suitable matches ranked from worst to best from all the registered hospitals are displayed.</b><br> 
  </p>
</div>
</div>
<!-- for bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>