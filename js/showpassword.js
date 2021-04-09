// for login
function box2()
{
 
  var password=document.getElementById("pswd");
  var x=document.getElementById("box").checked;
  if(x==true)
  {
    password.type="text";
  }
  else
  {
    password.type="password";
    
  }
}


// for sign up
function box1()
{
  
  var password=document.getElementById("pswd");
  var password2=document.getElementById("pswd2");
  var x=document.getElementById("box").checked;
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