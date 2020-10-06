<?php

$invalid = "";

if(isset($_POST['submit'])){

  $entered_username = $_POST['uname'];
  $entered_password = $_POST['pswd'];

  include("../templates/db-connect.php");

  //Create query
  $query = "SELECT * FROM admin_accounts WHERE username = '". $entered_username ."' AND passwrd = '" . $entered_password . "' LIMIT 1";

  //Fectch the results
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) == 1){
    header("Location: admin.php");
  } 

  else {
    $invalid = "Invalid credentials!";
  }

}

?>

<!DOCTYPE html>

<html lang="en">

<link rel="stylesheet" href="../css/login_styles.css">

<style>

form, button, a{
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}

#invalid{
  color: red;
  text-align: center;
}

</style>

<?php include("../templates/header.php"); ?>
    
    <section id="loginBackground">
        <form action="#" method="POST">
            <div class="imgcontainer">
                <img src="../images/avatar.jpg" alt="Avatar" class="avatar">
            </div>

            <div class="container2">
                <label for="uname"><strong>Username</strong></label>
                <br>
                <input type="text" placeholder="Enter Username" name="uname" required><br>

                <label for="psw"><strong>Password</strong></label>
                <br>
                <input type="password" placeholder="Enter Password" name="pswd" required>
                
                <button type="submit" name="submit" value="submit">Login</button> <br>

                <a href="#">Forgot password?</a>
                
                <?php if(!empty($invalid)){?>

                  <p id="invalid"><?php echo $invalid; ?></p>

                <?php } ?>

            </div>
        </form>
    </section>

</body>

</html>