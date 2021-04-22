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

  nav {
    background-color: rgb(0, 0, 0, 0.2);
    font-family: "Open Sans";
    line-height: 1em;
    display: flex;
    justify-content: space-around;
    align-items: center;
    min-height: 7vh;
  }


  .logo {
    text-decoration: none;
    text-transform: uppercase;
    color: #fff;
    letter-spacing: 4px;
    /* padding: 26px; */
    font-size: 24px;
    font-weight: 600;
    padding: 0px;
  }

  .brand_logo
  {
    float:left;
  }

  .brand_title
  {
    float:left;
    margin-top:30px;
    margin-left:20px;
  }

  .nav-links {
    display: flex;
    font-size: 18px;
  }

  .nav-links li {
    list-style: none;
  }

  .nav-links li a {
    display: block;
    text-decoration: none;
    text-transform: uppercase;
    color: #fff;
    letter-spacing: 3px;
    padding: 26px;
    transition: all ease 0.5s;
  }

  .nav-links li ul {
    display: none;
    position: absolute;
    border-radius: 0px 0px 4px 4px;
    background-color: rgb(0, 0, 0, 0.2);
  }

  .nav-links li:hover ul {
    display: block;
  }

  .nav-links li ul li {
    display: block;
    width: 180px;
  }

  .nav-links li a:hover {
    background-color: #a28089;
  }

  .burger {
    display: none;
  }

  .burger div{
    height: 3px;
    width: 25px;
    background-color: #fff;
    margin: 5px;
  }

  @media screen and (max-width: 992px) {
    .nav-links
    {
       display: flex;
      font-size: 10px;
      padding-left:1px !important;
    }
    .nav-links li a {
    display: block;
    text-decoration: none;
    text-transform: uppercase;
    color: #fff;
    letter-spacing: 3px;
    padding: 0px;
    transition: all ease 0.5s;
    width:17vw;
  }

.brand_title
{
  font-size:1rem;
  margin-top:3px;
    margin-left:15px;
}
.logo
{
  width:35vw;
}

  }

</style>

<nav>
  <div class="logo">
    <img src="/kidney-exchange/images/logo3.png" class="brand_logo" width="100px" hight="100px">
    <p class="brand_title">Kidney Exchange</p>
  </div>
  <ul class="nav-links">
    <li><a href="/kidney-exchange/index.php">Home</a></li>
    <!-- <li><a href="#">About</a></li>
    <li><a href="#">Contact</a></li> -->
    <?php
if (isset($_SESSION['userId'])) {
  // echo '<ul>';
  echo '<li><a href="#">Register</a>';
  echo '<ul>';
  echo '<li><a href="/kidney-exchange/pages/reg-form.php">Patient</a></li>';
  if ($_SESSION['userType'] === "Admin") {
    echo '<li><a href="/kidney-exchange/pages/register_hospital.php">Hospital</a></li>';
  }
  echo '</ul>';
  echo '</li>';
  echo '<li><a href="#">Match</a>';
  echo '<ul>';
  echo '<li><a href="/kidney-exchange/pages/pairwiseMatch.php">Pairwise</a></li>';
  echo '<li><a href="/kidney-exchange/pages/globalMatch.php">Global</a></li>';
  echo '</ul>';
  echo '</li>';
  echo '<li><a href="#">Data</a>';
  echo '<ul>';
  echo '<li><a href="/kidney-exchange/pages/dataOverview.php">Overview</a></li>';
  echo '<li><a href="/kidney-exchange/pages/dataSummary.php">Summary</a></li>';
  echo '<li><a href="/kidney-exchange/pages/dataSearch.php">Search</a></li>';
  echo '</ul>';
  echo '</li>';
  // echo '</ul>';
  // echo '<ul>';
  if ($_SESSION['userType'] === "Admin") {
    echo '<li><a href="/kidney-exchange/pages/jsonData.php">Json</a></li>';
  }
  echo '<li><a href="/kidney-exchange/include/logout.inc.php">Logout</a></li>';
  // echo '</ul>';
} else {
  // echo '<ul>';
  echo '<li><a href="/kidney-exchange/pages/login.php">Login</a></li>';
  echo '<li><a href="/kidney-exchange/pages/signup.php">Sign Up</a></li>';
  // echo '</ul>';
}
?>
  </ul>
  <div class="burger">
    <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3"></div>
  </div>
</nav>