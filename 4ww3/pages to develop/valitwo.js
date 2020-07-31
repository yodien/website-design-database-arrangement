//nearly same as the code in validating.js

const form = document.getElementById('form');
const email = document.getElementById('email');
const password = document.getElementById('psw');
const errorOut = document.getElementById('error_List');
const UpperCaseChars = /[A-Z]/g;
const LowerCaseChars = /[a-z]/g;
const numbers = /[0-9]/g;
const pwLength = 8;

var errors = [];
if(form){
    form.addEventListener('submit', (e) => {
        validateEmpty();
        validateEmail();
        validatePassword();
        if (errors.length > 0){
            e.preventDefault();
            errorOut.innerText = errors.join(', ');
            errors = [];
        }
    });
}

function validateEmpty(){
    if (email.value === '' || email.value == null){
        errors.push('Email field is Empty');
    }
    if (password.value === '' || password.value == null){
        errors.push('Password field is Empty');
    }
}

function validateEmail(){
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))) {
        errors.push('email invalid');
    }
}

function validatePassword(){
    if (!(password.value.match(UpperCaseChars) 
    && password.value.match(LowerCaseChars) 
    && password.value.match(numbers) 
    && password.value.length >= pwLength)){
        errors.push('Passport need at least 8 char with A-Za-z0-9');
    }
}