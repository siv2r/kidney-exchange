<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.gstatic.com">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;500&display=swap" rel="stylesheet">
<!-- for bootstrap css  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<style>
body {
    height: 100vh;
    /* background-image: url("https://images.pexels.com/photos/48604/pexels-photo-48604.jpeg?cs=srgb&dl=pexels-negative-space-48604.jpg&fm=jpg"); */
    background-image: radial-gradient(circle, #121d31, #181c30, #1d1c2e, #211b2d, #241b2b, #2f2034, #3c243b, #4a2842, #683152, #89395e, #ab4266, #cd4c6a);
}

p{
  text-align: justify;
}

.intro{
  font-family: 'Domine', serif;
}

/* On screens that are 992px or less, set the background color to blue */
</style>

<?php

// require('vendor/autoload.php');

// use Symfony\Component\Dotenv\Dotenv;

// $dotenv = new Dotenv();
// $dotenv->load(__DIR__.'/.env');

// var_dump($_ENV);


include("templates/header.php") ?>

<!-- <div class="header-img"> -->
<div class="nav-container">
    <?php include("templates/navBar.php") ?>
</div>

<div class="container-fluid py-3 mx-0 d-flex row" >
    <div class="kid-img col-md-6 d-flex justify-content-center align-items-center">
        <img src="./images/kidney.png" alt="" width="90%">
    </div>
    <div class="intro row col-md-6 d-flex justify-content-center align-items-center" style="color: white;">
        <div class="aim row">
            <h1>Aim</h1>
            <p class="text-left">Primary focus of <strong>kidney-exchange</strong> focus is to provide a platform to
                facilitate automized inter-hospital kidney transplants.</p>
        </div>
        <div class="feat row">
            <h1>Features</h1>
            <p>
                This platform allows interested hospitals to register. The doctors from the registered hospitals can
                create their accounts and add their patients' (having kidney problems) medical details to this platform.
                <br>
                <br>
            <h5><p>After a doctor completes this process, this platform provides two main features:-</p></h5>
            <ol>
                <li><p>The first feature is an option to view only the essential details of a patient required for a kidney
                    transplant.</p></li>
                <li><p>Secondly, for a given patient, all suitable matches from all the registered hospitals are displayed.
                    These suitable matches are ranked from best to worst.</p>
                </li>
            </ol>
            </p>
        </div>
        <div class="sign">
        <h1>How To Signup..?</h1>
        <ol>
        <li><p>Go to <strong><a href="/kidney-exchange/pages/signup.php" class="text-light">Signup Page</a></strong>.</p></li>
        <li><p>Doctor Should fill his/her respective details and Hospital Id is the Id provided only to doctors of same Hospital.</p></li>
        </ol>
        </div>
    </div>
</div>
<!-- </div> -->


<?php include("include/footer.inc.php") ?>