const registerForm = document.querySelector("#registerForm");
const registerLastName = document.querySelector("#registerLastName");
const registerFirstName = document.querySelector("#registerFirstName");
const registerEmail = document.querySelector("#registerEmail");
const registerPassword =  document.querySelector("#registerPassword");
const registerConfirmPassword =  document.querySelector("#registerConfirmPassword");
const registerButton = document.querySelector("#registerButton");
const registerMessage = document.createElement("p");

registerButton.addEventListener("click", register)

async function register(ev) {

    ev.preventDefault();

    const lastName = registerLastName.value;
    const firstName = registerFirstName.value;
    const email = registerEmail.value;
    const password = registerPassword.value;
    const confirmPassword = registerConfirmPassword.value;

    if(await checkEmptyFields(lastName, firstName, email, password, confirmPassword)
    && await checkPasswords(password, confirmPassword)) {

        const reqRegister = new FormData(registerForm)

        const requestOptions = {
            method: 'POST',
            body: reqRegister,
        };

        let createUser = await fetch("../src/Routes/user_management.php", requestOptions);

        createUser = await createUser.json()

        registerMessage.innerHTML = createUser.message

        registerForm.appendChild(registerMessage);
    }
}


async function checkEmptyFields(...fields) {

    for(let i in fields) {
        
        if(!fields[i].trim()) {

            registerMessage.innerHTML = "Veuillez remplir tous les champs";
    
            registerForm.appendChild(registerMessage);
    
            return false;
        }        
    }

    return true;
}



async function checkPasswordSecurity(password) {

    if(password.length < 8) {
    
        registerMessage.innerHTML = "Votre mot de passe doit contenir au moins 8 caractères";

        return false;          
    }

    return true;

}



async function checkPasswords(password, confirmPassword) {

    if(password !== confirmPassword) {

        registerMessage.innerHTML = "Les mots de passe ne correspondent pas";

        registerForm.appendChild(registerMessage);

        return false;
    }

    return true;
}