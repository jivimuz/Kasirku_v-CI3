function show() {
  document.getElementById("hide").hidden = false;
  document.getElementById("show").hidden = true;
  document.getElementById("password").type = "text";
}
function hide() {
  document.getElementById("hide").hidden = true;
  document.getElementById("show").hidden = false;
  document.getElementById("password").type = "password";
}

$('.login-content [data-toggle="flip"]').click(function () {
  $(".login-box").toggleClass("flipped");
  return false;
});
