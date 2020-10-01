
<style>
  nav{
    width: 100%;
    background-color: rgb(0, 0, 0, 0.2);
    font-family: "Verdana, Geneva, Tahoma, sans-serif";
    font-size: 20px;
    line-height: 1.6em;
  }

  nav ul{
    text-align: center;
  }

  nav ul li{
    list-style: none;
    display: inline-block;
  }

  nav ul li a{
    display: block;
    text-decoration: none;
    text-transform: uppercase;
    color: #fff;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    letter-spacing: 2px;
    font-weight: 600;
    padding: 25px;
    transition: all ease 0.5s;
  }

  nav ul li a:hover{
    background-color: #221b4385;
  }
</style>

<nav>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Contact</a></li>
    <li><a href="reg-form.php">Register (Patient)</a></li>
    <li><a href="register_hospital.php">Register (Hospital)</a></li>
    <li id="login"><a href="login.php">Login</a></li>
  </ul>
</nav>