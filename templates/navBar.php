<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<style>
  * {
    margin: 0%;
    padding: 0%;
    box-sizing: border-box;
  }
  .navbar
  {
    background-color: rgb(0, 0, 0, 0.2);
    font-family: "Open Sans";
  }
  .brand_logo
  {
    height:12vh;
    width:8vw;
  }
  .navbar-toggler
  {
    background:#fff;
    padding: .8rem 1.5rem;
  }
  .space 
  {
    width: 30vw;
    height:5vh;
    visibility: hidden;
  }
.navbar-brand
  {
    color: #fff;
    font-weight:600;
    font-size:1.6rem;
    text-transform: uppercase;
    letter-spacing: 3px;
  }  
.navbar-brand:hover
{
  color: red;
}
.nav-item .nav-link , .dropdown-item
{
  color:#fff;
  font-weight:400;
  background:none;
  padding:10px 20px;
  text-transform: uppercase;
  font-size:1.1rem;
  letter-spacing: 2px;
}

.nav-item .nav-link:hover , .dropdown-item:hover
{
  background-color: #a28089;
}
/* On screens that are 992px or less, set the background color to blue */
@media screen and (max-width: 992px) {
  .space {
    display:none;
  }
  .navbar-brand
  {
    color: #fff;
    font-weight:500;
    font-size:1.5rem;
    text-transform: uppercase;
    letter-spacing:1px;
    margin:0px;
  }
  .brand_logo
  {
    height:10vh;
    width:15vw;
  }  
  .nav-item .nav-link , .dropdown-item
  {
    font-size:2rem;
  }

  .dropdown-menu
  {
    margin-left:5vw;
  }
  .navbar-toggler {
    background: #fff;
    padding: .6rem .8rem;
}
}
</style>
<nav class="navbar navbar-expand-lg">
  <div class="container px-0">
    <img src="/kidney-exchange/images/logo3.png" class="brand_logo">
    <a class="navbar-brand" href="/kidney-exchange/">KIDNEY EXCHANGE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa fa-bars" aria-hidden="true"></i>
    </button>
    <div class="space"></div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav m-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/kidney-exchange/">Home</a>
        </li>
        <?php
          if (isset($_SESSION['userId'])) {
            echo '<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Register
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/kidney-exchange/pages/reg-form.php">Patient</a></li>';
              if ($_SESSION['userType'] === "Admin") {
                echo '<li><a class="dropdown-item" href="/kidney-exchange/pages/register_hospital.php">Hospital</a></li>';
              } 
            echo '</ul>
                  </li>';

              
            echo '<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  MATCH
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="/kidney-exchange/pages/pairwiseMatch.php">PAIRWISE</a></li>
                  <li><a class="dropdown-item" href="/kidney-exchange/pages/globalMatch.php">gLOBAL</a></li>
                  </ul>
                    </li>';

             
            echo '<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              DATA
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/kidney-exchange/pages/dataOverview.php">Overview</a></li>
            <li><a class="dropdown-item" href="/kidney-exchange/pages/dataSummary.php">Summary</a></li>
            <li><a class="dropdown-item" href="/kidney-exchange/pages/dataSearch.php">Search</a></li>
      
              </ul>
                </li>';
            
                if ($_SESSION['userType'] === "Admin") {
                  echo '<li class="nav-item"><a class="nav-link" href="/kidney-exchange/pages/jsonData.php">Json</a></li>';
                } 
                echo '<li class="nav-item"><a class="nav-link" href="/kidney-exchange/include/logout.inc.php">Logout</a></li>';
               }
          else {
            echo '<li class="nav-item">
                  <a class="nav-link" href="/kidney-exchange/pages/login.php">Login</a>
                  </li>';
            echo '<li class="nav-item">
                  <a class="nav-link" href="/kidney-exchange/pages/signup.php">Sign Up</a>
                  </li>';

          }
        ?>
      </ul>
      
    </div>
  </div>
</nav>

