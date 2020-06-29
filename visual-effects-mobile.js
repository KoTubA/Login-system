document.addEventListener('DOMContentLoaded',function(){

    document.querySelector('#toggle-nav-items-login').addEventListener('click',function(){
        document.querySelector('#toggle-nav-items-register').classList.remove('toggle-nav-items-focus');
        this.classList.add('toggle-nav-items-focus');
        document.querySelector('#toggle-register-form').classList.add("hidden-el");
        document.querySelector('#register-wrapper').classList.add("hidden-el");
        document.querySelector('#toggle-login-form').classList.remove("hidden-el");
        document.querySelector('#login-wrapper').classList.remove("hidden-el");
    });

    document.querySelector('#toggle-nav-items-register').addEventListener('click',function(){
        document.querySelector('#toggle-nav-items-login').classList.remove('toggle-nav-items-focus');
        this.classList.add('toggle-nav-items-focus');
        document.querySelector('#toggle-register-form').classList.remove("hidden-el");
        document.querySelector('#register-wrapper').classList.remove("hidden-el");
        document.querySelector('#toggle-login-form').classList.add("hidden-el");
        document.querySelector('#login-wrapper').classList.add("hidden-el");
    });

});