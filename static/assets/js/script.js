// Ejecutando funciones
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPage);

// Declarando variables
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

// FUNCIONES
function anchoPage() {
    if (window.innerWidth > 850) {
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
    } else {
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
    }
}

anchoPage();

function iniciarSesion() {
    if (window.innerWidth > 850) {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "10px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
}

function register() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }
}

// Funci��n para mostrar/ocultar la contrase�0�9a de login
const toggleLoginPassword = document.querySelector('#pass_login + i');
const passLogin = document.getElementById('pass_login');

toggleLoginPassword.addEventListener('click', () => {
    if (passLogin.type === 'password') {
        passLogin.type = 'text';
        toggleLoginPassword.classList.remove('bx-show-alt');
        toggleLoginPassword.classList.add('bx-hide');
    } else {
        passLogin.type = 'password';
        toggleLoginPassword.classList.remove('bx-hide');
        toggleLoginPassword.classList.add('bx-show-alt');
    }
});

// Funci��n para mostrar/ocultar la contrase�0�9a de registro
const toggleRegisterPassword = document.querySelector('#pass_register + i');
const passRegister = document.getElementById('pass_register');

toggleRegisterPassword.addEventListener('click', () => {
    if (passRegister.type === 'password') {
        passRegister.type = 'text';
        toggleRegisterPassword.classList.remove('bx-show-alt');
        toggleRegisterPassword.classList.add('bx-hide');
    } else {
        passRegister.type = 'password';
        toggleRegisterPassword.classList.remove('bx-hide');
        toggleRegisterPassword.classList.add('bx-show-alt');
    }
});

