<style>
body{
  background-image: url("https://wallpaper-mania.com/wp-content/uploads/2018/09/High_resolution_wallpaper_background_ID_77701389136.jpg");
  background-repeat: no-repeat;
  background-size: cover;
} 

form {
  background: rgb(0, 0, 0, 0.5);
  width: 40%;
  /* height: 86%; */
  margin: auto;
  margin-top: 30px;
  padding: 15px 20px;
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
  margin: 5px;
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

</style>

<?php include("../../partials/header.php"); ?>

	<div class="nav-container">
<<<<<<< HEAD:pages/signup.php
      <?php include("../templates/navBar.php") ?>
=======
      <?php include("../../partials/pagesNavBar.php") ?>
>>>>>>> 7b03d44a58a02c8674e9bf06d098f3ec0aa6598a:pages/signup/signup.php
  </div>

	<form action="include/signup.inc.php" method="POST" id=signupForm>

    <div class="form-elements">
      <h3>SIGN UP</h3>
    </div>

    <div class="form-elements">
        <img src="../../images/red-avatar.png" alt="Avatar" class="avatar">
        
        <!-- Display error messages -->
        <?php require_once("include/errorMsg.inc.php"); ?>
    </div>

    <div class="form-elements">
      <input type="text" name="uname" placeholder="Username" class="requiredField">
      <input type="text" name="email" placeholder="Email" class="requiredField">
      <input type="number" name="hosp_id" placeholder="Hospital ID" class="requiredField">
      <input type="password" name="pswd" placeholder="Password" id="pswd" class="requiredField">
      <input type="password" name="re_pswd" placeholder="Re-enter Password" class="requiredField">
      <button type="submit" name="submit" value="submit" id="submitBtn">Sign Up</button>
    </div>
      	
  </form>
  
<!-- include the footer -->
<?php 
  $path = $_SERVER['DOCUMENT_ROOT'] . '/kidney_exchange';
  $path .= "/partials/footer.php";
  include_once($path);
?>