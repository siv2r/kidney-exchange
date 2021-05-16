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
#overview
{
  background:black;
  opacity: 0.6;
}
#overview p
{
  font-size:1.3rem;
}
#overview h1
{
  font-size:4rem;
}
/* On screens that are 992px or less, set the background color to blue */
@media screen and (max-width: 992px) {
  body{
    background-image: url("https://wallpaper-mania.com/wp-content/uploads/2018/09/High_resolution_wallpaper_background_ID_77701388996.jpg" );
    background-size: cover;
    height:100%;
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

  <div class="container-fluid px-0 text-center text-white mt-0 py-5" id="overview">
  <div class="container px-3">
  <h1>Overview</h1>
  <p>
  Let's say a person wants to donate his/her kidney to a loved one but cannot do so because they have some medical incompatibility. This problem can be solved by curating similar patients and swapping the kidney within themselves. This problem is called the living donor kidney exchange problem. Only one donated kidney is needed to replace the two failed kidneys, which makes living-donor kidney transplant an alternative to deceased-donor kidney transplant.In India, this is often done manually and there's a need to automate the process.</p>

  <p>
  This platform allows interested hospitals to register. The doctors from the registered hospitals can create their accounts and add their patients' (having kidney problems) medical details to this platform.

After a doctor completes this process, this platform provides two main features.

The first feature is an option to view only the essential details of a patient required for a kidney transplant.
Secondly, for a given patient, all suitable matches from all the registered hospitals are displayed. These suitable matches are ranked from best to worst.</p>
  </div>
  </div>
  <?php include("include/footer.inc.php") ?>