// for show passwords
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

function showPassword(id, no) {
   $(".toggle-password" + no).toggleClass("fa-eye fa-eye-slash");
   if ($(id).attr("type") == "password") {
    $(id).attr("type", "text");
   } else {
     $(id).attr("type", "password");
   }
}
