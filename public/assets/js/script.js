$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.parallax').parallax();
    $('.modal').modal();
});

$("#alert_close").click(function () {
    $("#alert_box").fadeOut("slow", function () {});
});