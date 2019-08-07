$(document).ready(function(){
    $('#toggle-login, #toggle-register').on('click',function(){
        $('#toggle-register-form').toggleClass("hidden-el");
        $('#register-wrapper').toggleClass("hidden-el");
        $('#toggle-login-form').toggleClass("hidden-el");
        $('#login-wrapper').toggleClass("hidden-el");
        $('#toggle-form').toggleClass("move-el");
    });

    $('.icon-input-second').on('click', function() {
        $('.icon-input-second i').toggleClass("icon-eye icon-eye-off");
        $('.pr-input').attr('type', function(index, attr){
            return attr == 'text' ? 'password' : 'text';
        });
    });

    $('.form-control').on('focus', function() {
        $(this).removeClass('is-invalid');
        $(this).parent().removeClass('alert-validate');
    })

    $('#toggle-nav-items-login').on('click',function(){
        $('#toggle-nav-items-register').removeClass('toggle-nav-items-focus');
        $(this).addClass('toggle-nav-items-focus');
        $('#toggle-register-form').addClass("hidden-el");
        $('#register-wrapper').addClass("hidden-el");
        $('#toggle-login-form').removeClass("hidden-el");
        $('#login-wrapper').removeClass("hidden-el");
    });

    $('#toggle-nav-items-register').on('click',function(){
        $('#toggle-nav-items-login').removeClass('toggle-nav-items-focus');
        $(this).addClass('toggle-nav-items-focus');
        $('#toggle-register-form').removeClass("hidden-el");
        $('#register-wrapper').removeClass("hidden-el");
        $('#toggle-login-form').addClass("hidden-el");
        $('#login-wrapper').addClass("hidden-el");
    });
});
