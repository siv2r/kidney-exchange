<?php

//some php code for verifying the user

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<style>
body{
  background-image: url("https://wallpaper-mania.com/wp-content/uploads/2018/09/High_resolution_wallpaper_background_ID_77701389136.jpg");
  background-repeat: no-repeat;
  background-size: cover;
}

form {
  background: rgb(0, 0, 0, 0.5);
}

input{
  width: 100%;
  padding: 15px 20px;
  margin: 15px 0;
  display: inline-block;
	box-sizing: border-box;
	outline: none;
	font-size: 150%;
}

button {
  /* background-color: #b30d4b; */
  background-color: #ad0c4d;
  color: white;
  padding: 16px 20px;
  margin: 15px 0;
	cursor: pointer;
	border: none;
	width: 100%;
	font-size: 150%;
  outline: none;
}

button:hover {
  opacity: 0.8;
}

img.avatar {
	width: 22%;
	opacity: 0.8;
  border-radius: 60%;
}

.form-elements{
	width: 80%;
	margin: auto;
	text-align: center;
}

.form-elements h3{
	color: white;
	font-size: 30px;
}

form a{
  margin: 10%;
  font-size: 20px;
  color: white;
  text-decoration: underline;
  letter-spacing: 1px;
}

/* ---------------error messages------------------------- */
#failed{
  color: #c51244;
  font-size: 28px;
}
#success{
  color: #32cd32;
  font-size: 28px;
}
/* for show password */
#showpass
{
  width:12vw;
  color:#fff;
}
#showpass input
{
  width:auto;
}
/* On screens that are 992px or less, set the background color to blue */
@media screen and (max-width: 992px) {
  #showpass
  {
    width:38vw;
  }
}

</style>

<?php include "../templates/header.php";?>

	<div class="nav-container">
      <?php include "../templates/navBar.php"?>
  </div>

<div class="container col-lg-5 mt-0 co-sm-11">
<form action="../include/login.inc.php" method="POST">

<!-- <div class="imgcontainer">
    <img src="../images/avatar.jpg" alt="Avatar" class="avatar">
</div> -->

<div class="form-elements pt-4">
  <h3>LOGIN</h3>
</div>

<div class="form-elements">
    <img src="../images/red-avatar.png" alt="Avatar" class="avatar">
    <?php
if (isset($_GET["error"])) {
 if ($_GET["error"] == "emptyInputLogin") {
  echo "<p id='failed'>Please fill all the fields</p>";
 } else if ($_GET["error"] == "invalidUsername") {
  echo "<p id='failed'>Invalid username/email</p>";
 } else if ($_GET["error"] == "invalidPassword") {
  echo "<p id='failed'>Invalid password</p>";
 }
}
?>
</div>

<div class="form-elements">
  <input type="text" name="uid" placeholder="Username/Email">
  <input type="password" name="pswd" id="pswd" placeholder="Password">
  <div id="showpass">
      <input type="checkbox" id="box" onclick="box1()">
      <span id="notice">show password</span>
  </div>
  <button type="submit" name="submit" value="submit">Login</button>
</div>

<a href="#">Forgot Password?</a>



</form>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="../js/showpassword.js"></script>
<?php include "../include/footer.inc.php"?>



