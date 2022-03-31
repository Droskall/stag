// menu : responsive
const menuSpan = document.querySelector('span.menu');
const menuDiv = document.querySelector('div.menu');

let a = 0;

menuSpan.addEventListener('click', () => {

    if (a === 0) {
        menuDiv.style.display = 'block';
        a++
    } else if (a === 1) {
        menuDiv.style.display = 'none';
        a--
    }

})

// background
let body = document.body;
body.style.height = innerHeight + "px";


// close php error message
const close = document.querySelector('#close');
const errorDiv = document.querySelector('div.error');

if (close) {
    close.addEventListener('click', () => {
        errorDiv.remove();
        close.remove();
    })
}

 //bubbles effect
const sport = document.querySelector('#band div:nth-child(1)');
const cultural = document.querySelector('#band div:nth-child(2)');
const numerical = document.querySelector('#band div:nth-child(3)');
const utile = document.querySelector('#band div:nth-child(4)');

if (sport) {
    document.body.style.overflow = 'hidden';
    animation(sport, 'c=category&a=get-category&name=sport&type');
    animation(cultural, 'c=category&a=get-category&name=cultural&type');
    animation(numerical, 'c=category&a=get-category&name=numerical&type');
    animation(utile, 'c=toolbox');
}

function animation(div, url) {
    div.addEventListener('click', function () {
        div.classList.add('loader');
        setTimeout(function () {
            window.location.href = '/index.php?' + url;
        }, 1100)
    })
}

// FormConnexion/Inscription verif

let container = document.getElementById('contains');

//Login form
let email = document.getElementById('email');
let password = document.getElementById('pswd');
let btnConnexion = document.getElementById('buttonC');

//Registration Form
let pseudoI = document.getElementById('pseudoInscript');
let emailI = document.getElementById('emailInscript');
let passwordI = document.getElementById('passwordInscript');
let passwordConfirmI = document.getElementById('passwordConfirmInscript');
let btnInscriptionI = document.getElementById('buttonValidateI');

let pattern = /^[^ ]+@[^ ]+.[a-z]{2,3}$/;

/**
 * Event when the login button is clicked and verification of the login form fields
 */
btnConnexion.addEventListener("click", function(e){
    if(email.value === "" || password.value === ""){
        e.preventDefault();
        message("Merci de remplir les champs requis");
    }
    else if(email.value.length < 2 || email.value.length > 50 || password.value.length < 4 ||
        password.value.length > 60){
        e.preventDefault();
        message("Votre email ou mot de passe est incorrect");
    }
});

/**
 * Event when clicking on the registration button and verification of the fields of the registration form
 */
btnInscriptionI.addEventListener('click', function (e){
        if(pseudoI.value === "" || passwordI.value === "" || passwordConfirmI.value === "" ||
            emailI.value === ""){
            e.preventDefault();
            message("Merci de remplir les champs requis !");
        }
        else{
            if(passwordI.value !== passwordConfirmI.value){
                e.preventDefault();
                message("Les mots de passe ne correspondent pas !");
            }
            else if(!emailI.value.match(pattern)){
                e.preventDefault();
                message("Merci de renseigner une adresse e-mail valide !");
            }
            else if (pseudoI.value.length < 5 || pseudoI.value.length > 50 || passwordI.value.length < 6
                || passwordI.value.length > 60 || passwordConfirmI.value.length < 6 ||
                passwordConfirmI.value.length > 60){
                e.preventDefault();
                message("Votre pseudo ou votre mot de passe ne comporte pas le nombre de caractères requis !");
            }
        }
});

/**
 * Function which allows you to create error or success messages!
 * @param message = Message content to display
 * @param type = success or error
 */

function message(message, type ="error"){
    let div = document.createElement("div");
    let span = document.createElement("span");
    span.innerHTML = message;
    div.append(span);
    div.className = type;
    div.id = "errorOrSuccess";
    container.prepend(div);
    slideUp(div.id, type)
}

//We add the slideUp animation to the div element that contains the message.
function slideUp(id, type){
    let timeout = setTimeout(function (){
        let div = document.getElementById(id);
        div.classList = (type + " remove");
        deleteMessage("errorOrSuccess");
        clearTimeout(timeout);

    }, 4500);
}

//Function that deletes the message after 4 seconds
function deleteMessage(id){
    let timeout = setTimeout(function (){
        let div = document.getElementById(id);
        div.remove();
        clearTimeout(timeout);
    }, 400);
}