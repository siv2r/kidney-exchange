<style>
body{
 background-image: url("https://wallpaper-mania.com/wp-content/uploads/2018/09/High_resolution_wallpaper_background_ID_77701389136.jpg");
  background-repeat: no-repeat;
  background-size: cover;
}

form {
  background: rgb(0, 0, 0, 0.5);
  border-radius: 25px;

}
form a{
  margin:5px;
  font-size: 20px;
  color: white;
  text-decoration: underline;
  letter-spacing: 1px;
}
input{
  width: 100%;
  padding: 10px 20px;
  margin: 15px 0;
  display: inline-block;
	box-sizing: border-box;
	outline: none;
	font-size: 150%;
  border-radius: 50px;
}
.form-elements{
  margin-top: -5px;
}

.form-elements button {
  /* background-color: #b30d4b; */
  background-color: #ad0c4d;
    color: white;
    margin: 15px 0;
    cursor: pointer;
    border: none;
    width: 100%;
    font-size: 26px;
    outline: none;
    height: 10%;
    border-radius: 30px;
    background-size: 200% 100%;
    transition: background-position 0.5s, color 0.5s;
    background-image: linear-gradient(to right, #dc3545 50%, #ad0c4d 50%);
}

.form-elements button:hover {
  opacity: 0.8;
  background-position: right bottom;
  color: #fff;
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
  margin: 5px;
}
form{
  width: 88%;
    height: 100%;
    backdrop-filter:blur(12px);
}

/* -------------------Styling the error messages----------------- */

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
  width:15vw;
  color:#fff;
  font-size: 22px;
  font-family: Arial;
}
#showpass input
{
  width: 20px;
  height: 20px;
}
/* On screens that are 992px or less, set the background color to blue */
@media screen and (max-width: 992px) {
  #showpass
  {
    width:55vw;
  }
}
p{
  color: white;
  text-align: center;
}
#showpass span{
  font-size: 18px;
  margin-left: 4px;
  font-family: Arial;
}
#showpass{
  margin-left: -25px;
}
.field-icon{
position: absolute;
margin-left: -30px;
margin-top: 25px;
}
</style>

<?php include("../templates/header.php"); ?>

	<div class="nav-container">
      <?php include("../templates/navBar.php") ?>
  </div>

  <div class="container col-lg-4 co-sm-11 px-1 d-flex justify-content-center align-items-center" style="height: 90%;">
	<form action="../include/signup.inc.php" class="py-5 px-4" method="POST" id=signupForm>

    <div class="form-elements">
      <h3>SIGN UP</h3>
    </div>

    <div class="form-elements">
        <img src="../images/red-avatar.png" alt="Avatar" class="avatar">
        <?php
          if(isset($_GET["error"])) {
            if ($_GET["error"] == "emptyInputSignup") {
              echo "<p id='failed'>Please fill all the fields</p>";
            }
            else if ($_GET["error"] == "invalidUname") {
              echo "<p id='failed'>Username must contain letters, numbers and underscores only</p>";
            }
            else if ($_GET["error"] == "invalidHospId") {
              echo "<p id='failed'>Invalid hospital id</p>";
            }
            else if ($_GET["error"] == "invalidEmail") {
              echo "<p id='failed'>Invalid email id</p>";
            }
            else if ($_GET["error"] == "noPswdMatch") {
              echo "<p id='failed'>The passwords do not match</p>";
            }
            else if ($_GET["error"] == "unameExists") {
              echo "<p id='failed'>This username is already taken</p>";
            }
            else if ($_GET["error"] == "noHospIdExists") {
              echo "<p id='failed'>Your hospital is not registered with us</p>";
            }
            else if ($_GET["error"] == "hospstmtfailed") {
              echo "<p id='failed'>Something went wrong while checking hospital id</p>";
            }
            else if ($_GET["error"] == "userstmtfailed") {
              echo "<p id='failed'>Something went wrong while creating user</p>";
            }
            else if ($_GET["error"] == "none") {
              echo "<p id='success'>Registration successful!!!</p>";
            }

          }
        ?>
    </div>

    <div class="form-elements px-1">
      <input type="text" class="my-2" name="uname" placeholder="Username" class="requiredField">
      <input type="text" class="my-2" name="email" placeholder="Email" class="requiredField">
      <input type="number" class="my-2" name="hosp_id" placeholder="Hospital ID" class="requiredField">
      <!-- <p class="text-start text-light m-0 p-0">Enter hospital Id given by hospital</p> -->
      <input type="password" class="my-2" name="pswd" placeholder="Password" id="pswd" class="requiredField"><i class="fa fa-fw fa-eye-slash field-icon toggle-password1" id="togglePassword" onclick="showPassword(pswd,1);" ></i>
      <input type="password" class="my-2" name="re_pswd" placeholder="Re-enter Password" id="pswd2" class="requiredField"><i class="fa fa-fw fa-eye-slash field-icon toggle-password2" id="togglePassword" onclick="showPassword(pswd2,2);"></i>
      <div id="showpass">
          <input type="checkbox" id="box" onclick="box1()">
          <span id="notice">Show Password</span>
      </div>
      <button type="submit" name="submit" value="submit" id="submitBtn">Sign Up</button>
    <p>Already Have an Account? <a href="login.php">Log In</a></p>
    </div>

  </form>
  </div>
  <script src="../js/showpassword.js"></script>

<?php include("../include/footer.inc.php") ?>
