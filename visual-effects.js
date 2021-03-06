document.addEventListener('DOMContentLoaded',function(){

    const box = document.querySelectorAll('#toggle-login, #toggle-register');

    box.forEach(function(ele){
        ele.addEventListener('click',function(){
            document.querySelector('#toggle-register-form').classList.toggle("hidden-el");
            document.querySelector('#register-wrapper').classList.toggle("hidden-el");
            document.querySelector('#toggle-login-form').classList.toggle("hidden-el");
            document.querySelector('#login-wrapper').classList.toggle("hidden-el");
            document.querySelector('#toggle-form').classList.toggle("move-el");
        });
    });

    document.querySelector('.icon-input-second').addEventListener('click', function() {
        document.querySelector('.icon-input-second i').classList.toggle("icon-eye-off");
        const input = document.querySelector('.pr-input');
        input.type = (input.type==='text') ? 'password' : 'text';
    });

    document.querySelectorAll('.form-control').forEach(function(ele){
        ele.addEventListener('focus', function() {
            this.classList.remove('is-invalid');
            this.parentElement.parentElement.classList.remove('alert-validate');
        })
    });

    document.addEventListener("change", function(event) {
        let element = event.target;
        if (element && element.matches(".form-control")) {
            element.classList[element.value ? "add" : "remove"]("hasvalue");
        }
    });

    document.querySelectorAll('.form-control').forEach(function(ele){
        if(ele.value) {
            ele.classList.add("hasvalue-notransition");
            ele.classList.add("hasvalue");
            setTimeout(function(){ele.classList.remove("hasvalue-notransition")},150);
        }
    });

    document.querySelectorAll('.invalid-feedback .icon-cancel').forEach(function(ele){
        ele.addEventListener('click', function() {
            this.parentElement.classList.remove('invalid-visible');
        });
    });

});