<!DOCTYPE html>
<html lang="en">

 <!-- for bootstrap css  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<style>
  body{
    /* background-image: url("https://images.pexels.com/photos/48604/pexels-photo-48604.jpeg?cs=srgb&dl=pexels-negative-space-48604.jpg&fm=jpg"); */
    background-image: url("https://wallpaper-mania.com/wp-content/uploads/2018/09/High_resolution_wallpaper_background_ID_77701388996.jpg" );
    background-size: cover;
    background-repeat: no-repeat;
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
  body{
    background-image: url("https://wallpaper-mania.com/wp-content/uploads/2018/09/High_resolution_wallpaper_background_ID_77701388996.jpg" );
    background-size: cover;
    height:100vh;
    background-repeat: no-repeat;
  }
}
</style>

<?php include("templates/header.php") ?>

  <!-- <div class="header-img"> -->
    <div class="nav-container">
      <?php include("templates/navBar.php") ?>
    </div>
  <!-- </div> -->


  <?php include("include/footer.inc.php") ?>