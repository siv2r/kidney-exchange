// for show passwords
/**
 * reuturn @void
 */
function box1()
{
  var password=document.querySelectorAll('[id^="psw"]');
  var x=document.getElementById("box").checked;
  
    if(x==true)
    {
      for (i = 0; i < password.length; i++) {
        password[i].type="text";
      }
      
    }
    else
    {
      for (i = 0; i < password.length; i++) {
        password[i].type="password";
      } 
    }
}