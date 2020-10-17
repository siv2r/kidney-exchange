<?php

//some php code for verifying the user

?>

<style>
body{
  background-image: url("https://wallpaper-mania.com/wp-content/uploads/2018/09/High_resolution_wallpaper_background_ID_77701389136.jpg");
  background-repeat: no-repeat;
  background-size: cover;
} 

form {
  background: rgb(0, 0, 0, 0.5);
  width: 40%;
  margin: auto;
  margin-top: 100px;
  padding: 20px;
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

</style>

<?php include("../templates/header.php"); ?>

	<div class="nav-container">
      <?php include("../templates/nav-bar.php") ?>
  </div>

	<form action="../include/login.inc.php" method="POST">

			<!-- <div class="imgcontainer">
					<img src="../images/avatar.jpg" alt="Avatar" class="avatar">
			</div> -->

			<div class="form-elements">
				<h3>LOGIN</h3>
			</div>

			<div class="form-elements">
          <img src="../images/red-avatar.png" alt="Avatar" class="avatar">
          <?php 
            if(isset($_GET["error"])) {
              if ($_GET["error"] == "emptyInputLogin") {
                echo "<p id='failed'>Please fill all the fields</p>";
              }
              else if ($_GET["error"] == "invalidUsername") {
                echo "<p id='failed'>Invalid username/email</p>";
              }
              else if ($_GET["error"] == "invalidPassword") {
                echo "<p id='failed'>Invalid password</p>";
              }            
            }
          ?>
			</div>

			<div class="form-elements">
				<input type="text" name="uid" placeholder="Username/Email">
				<input type="password" name="pswd" placeholder="Password">
				<button type="submit" name="submit" value="submit">Login</button>
      </div>

      <a href="#">Forgot Password?</a>


			
	</form>


<?php include("../include/footer.inc.php") ?>