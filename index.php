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

  footer{
	position: fixed;
	bottom: 0;
}

@media (max-height:800px){
	footer { position: static; }
	header { padding-top:40px; }
}


.footer-distributed{
	background-color: #2c292f;
	box-sizing: border-box;
	width: 100%;
	text-align: left;
	font: bold 16px sans-serif;
	padding: 50px 50px 60px 50px;
	margin-top: 80px;
}

.footer-distributed .footer-left,
.footer-distributed .footer-center,
.footer-distributed .footer-right{
	display: inline-block;
	vertical-align: top;
}

/* Footer left */

.footer-distributed .footer-left{
	width: 30%;
}

.footer-distributed h3{
	color:  #ffffff;
	font: normal 36px 'Cookie', cursive;
	margin: 0;
}

/* The company logo */

.footer-distributed .footer-left img{
	width: 30%;
}

.footer-distributed h3 span{
	color:  #e0ac1c;
}

/* Footer links */

.footer-distributed .footer-links{
	color:  #ffffff;
	margin: 20px 0 12px;
}

.footer-distributed .footer-links a{
	display:inline-block;
	line-height: 1.8;
	text-decoration: none;
	color:  inherit;
}

.footer-distributed .footer-company-name{
	color:  #8f9296;
	font-size: 14px;
	font-weight: normal;
	margin: 0;
}

/* Footer Center */

.footer-distributed .footer-center{
	width: 35%;
}


.footer-distributed .footer-center i{
	background-color:  #33383b;
	color: #ffffff;
	font-size: 25px;
	width: 38px;
	height: 38px;
	border-radius: 50%;
	text-align: center;
	line-height: 42px;
	margin: 10px 15px;
	vertical-align: middle;
}

.footer-distributed .footer-center i.fa-envelope{
	font-size: 17px;
	line-height: 38px;
}

.footer-distributed .footer-center p{
	display: inline-block;
	color: #ffffff;
	vertical-align: middle;
	margin:0;
}

.footer-distributed .footer-center p span{
	display:block;
	font-weight: normal;
	font-size:14px;
	line-height:2;
}

.footer-distributed .footer-center p a{
	color:  #e0ac1c;
	text-decoration: none;;
}


/* Footer Right */

.footer-distributed .footer-right{
	width: 30%;
}

.footer-distributed .footer-company-about{
	line-height: 20px;
	color:  #92999f;
	font-size: 13px;
	font-weight: normal;
	margin: 0;
}

.footer-distributed .footer-company-about span{
	display: block;
	color:  #ffffff;
	font-size: 18px;
	font-weight: bold;
	margin-bottom: 20px;
}

.footer-distributed .footer-icons{
	margin-top: 25px;
}

.footer-distributed .footer-icons a{
	display: inline-block;
	width: 35px;
	height: 35px;
	cursor: pointer;
	background-color:  #33383b;
	border-radius: 2px;

	font-size: 20px;
	color: #ffffff;
	text-align: center;
	line-height: 35px;

	margin-right: 3px;
	margin-bottom: 5px;
}

/* Here is the code for Responsive Footer */
/* You can remove below code if you don't want Footer to be responsive */


@media (max-width: 880px) {

	.footer-distributed .footer-left,
	.footer-distributed .footer-center,
	.footer-distributed .footer-right{
		display: block;
		width: 100%;
		margin-bottom: 40px;
		text-align: center;
	}

	.footer-distributed .footer-center i{
		margin-left: 0;
	}

}
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
<footer class="footer-distributed">

<div class="footer-left">
    <img src="images/logo3.png">
  <h3>About<span>Eduonix</span></h3>

  <p class="footer-links">
    <a href="#">Home</a>
    |
    <a href="#">Blog</a>
    |
    <a href="#">About</a>
    |
    <a href="#">Contact</a>
  </p>

  <p class="footer-company-name">© 2019 Eduonix Learning Solutions Pvt. Ltd.</p>
</div>

<div class="footer-center">
  <div>
    <i class="fa fa-map-marker"></i>
      <p><span>309 - Rupa Solitaire,
       Bldg. No. A - 1, Sector - 1</span>
      Mahape, Navi Mumbai - 400710</p>
  </div>

  <div>
    <i class="fa fa-phone"></i>
    <p>+91 22-27782183</p>
  </div>
  <div>
    <i class="fa fa-envelope"></i>
    <p><a href="mailto:support@eduonix.com">support@eduonix.com</a></p>
  </div>
</div>
<div class="footer-right">
  <p class="footer-company-about">
    <span>About the company</span>
    We offer training and skill building courses across Technology, Design, Management, Science and Humanities.</p>
  <div class="footer-icons">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-twitter"></i></a>
    <a href="#"><i class="fa fa-instagram"></i></a>
    <a href="#"><i class="fa fa-linkedin"></i></a>
    <a href="#"><i class="fa fa-youtube"></i></a>
  </div>
</div>
</footer>

</body>
</html>