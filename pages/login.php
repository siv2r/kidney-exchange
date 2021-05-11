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

.form-elements button {
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

.form-elements button:hover {
  opacity: 0.8;
}

img.avatar {
	width: 22%;
	opacity: 0.8;
  border-radius: 60%;
}

.form-elements{
	text-align: center;
}

.form-elements h3{
	color: white;
	font-size: 30px;
}

form a{
  margin:5px;
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
  width:14vw;
  color:#fff;
  font-size: 22px;
  font-family: Arial;
}
#showpass input
{
  width:20px;
  height:20px;
}
/* On screens that are 992px or less, set the background color to blue */
@media screen and (max-width: 992px) {
  #showpass
  {
    width:55vw;
  } 
}
</style>

<?php include("../templates/header.php"); ?>

	<div class="nav-container">
      <?php include("../templates/navBar.php") ?>
  </div>
<div class="container col-lg-4 co-sm-11 px-1">
	<form action="../include/login.inc.php" class="py-5 px-3" method="POST">

			<!-- <div class="imgcontainer">
					<img src="../images/avatar.jpg" alt="Avatar" class="avatar">
			</div> -->

			<div class="form-elements pt-2 pb-4">
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
				<input type="text" class="my-2" name="uid" placeholder="Username/Email">
				<input type="password" class="my-2" name="pswd" id="pswd" placeholder="Password">
        <div id="showpass">
            <input type="checkbox" id="box" onclick="box1()">
            <span id="notice">show password</span>
        </div>
				<button type="submit" name="submit" value="submit">Login</button>
      </div>

      <a href="#">Forgot Password?</a>


			
	</form>
  </div>
  <script src="../js/showpassword.js"></script>
  <?php include("../include/footer.inc.php") ?>


