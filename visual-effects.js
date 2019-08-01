$(document).ready(function(){
    $('#toggle-login, #toggle-register').on('click',function(){
        $('#toggle-register-form').toggleClass("hidden-el");
        $('#register-wrapper').toggleClass("hidden-el");
        $('#toggle-login-form').toggleClass("hidden-el");
        $('#login-wrapper').toggleClass("hidden-el");
        $('#toggle-form').toggleClass("move-el");
    });
});