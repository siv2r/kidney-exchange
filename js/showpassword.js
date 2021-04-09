// for show passwords
function box1()
{
  
  var password=document.getElementById("pswd");
  var password2=document.getElementById("pswd2");
  var x=document.getElementById("box").checked;
  if (password2 == null)
  {
  //for login
    if(x==true)
    {
      password.type="text";
    }
    else
    {
      password.type="password";
      
    }
  }
  else
  {
    // for sign up
    if(x==true)
    {
      password.type="text";
      password2.type="text";
      
    }
    else
    {
      password.type="password";
      password2.type="password";
      
    }
  }

}