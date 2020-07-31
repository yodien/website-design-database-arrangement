// Most of these part are similar to the material in the workshop five.
// document.get ElementById assotiate the input with different if with different constant

const form = document.getElementById('form');
const name = document.getElementById('user');
const email = document.getElementById('email');
const password = document.getElementById('psw');
const pass = document.getElementById('psw-repeat');
const errorOut = document.getElementById('error_List');
const UpperCaseChars = /[A-Z]/g;
const LowerCaseChars = /[a-z]/g;
const numbers = /[0-9]/g;
const pwLength = 8;

// if form means the statements in quote will only be execute when the form is runnning successfully.
// addEventListener will wait its first argument (here is submit the form <-> click the buttom. then run the functions mentions in another argument.
// the set of functions are gathered and the set is rename to "e"
//if errors exist, preventDefault stop the submiting process and continues do the codes below this command.
//in the html file , there will be a empty block with id error_list, the error message will be print if the function end in error by innertext command.

var errors = [];
if(form){
    form.addEventListener('submit', (e) => {
        validateEmpty();
        validateEmail();
        validatePassword();
        validatePass();
        cursewordban();
        if (errors.length > 0){
            e.preventDefault();
            errorOut.innerText = errors.join(', ');
            errors = [];
        }
    });
}


// ==='' and == null for empty input

function validateEmpty(){
    if (name.value === '' || name.value == null){
        errors.push('Name field is Empty');
    }
    if (email.value === '' || email.value == null){
        errors.push('Email field is Empty');
    }
    if (password.value === '' || password.value == null){
        errors.push('Password field is Empty');
    }
}

//from the tut code, begin with word character, may followed by dot some thing, then a "@", dot something with lastly dot two word character as end
function validateEmail(){
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))) {
        errors.push('email invalid');
    }
}

//from the tut code, the password need at least a captital letter ,a lower letter a number and at leat 8 characters.

function validatePassword(){
    if (!(password.value.match(UpperCaseChars) 
    && password.value.match(LowerCaseChars) 
    && password.value.match(numbers) 
    && password.value.length >= pwLength)){
        errors.push('Passport need at least 8 char with A-Za-z0-9');
    }
}

function validatePass(){
    if (!(pass.value.match(UpperCaseChars) 
    && pass.value.match(LowerCaseChars) 
    && pass.value.match(numbers) 
    && pass.value.length >= pwLength)){
        errors.push('Passport need at least 8 char with A-Za-z0-9');
    }
}

//make sure there is no curse words in the username

function cursewordban(){
    if (/^\w*(fuck|shit|asshole|idiot|\s)+\w*$/.test(name.value)) {
        errors.push('NO CURSE NAME ALLOWED');
    }
    if (!(/^\w{8,}$/.test(password.value))) {////////////////
        errors.push('valid pass plz');////////////////
    }////////////////
}