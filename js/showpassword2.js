function showPassword(id, no) {
   $(".toggle-password" + no).toggleClass("fa-eye fa-eye-slash");
   if ($(id).attr("type") == "password") {
    $(id).attr("type", "text");
   } else {
     $(id).attr("type", "password");
   }
}
