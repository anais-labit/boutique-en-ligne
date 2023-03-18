const registerForm = document.querySelector("#registerForm");
const registerType = document.querySelector("#registerType");
const registerLabelFirstName = document.querySelector("#registerLabelFirstName");
const registerFirstName = document.querySelector("#registerFirstName");
const registerLabelLastName = document.querySelector("#registerLabelLastName");
const registerLastName = document.querySelector("#registerLastName");
const registerLabelCompany = document.querySelector("#registerLabelCompany");
const registerCompany = document.querySelector("#registerCompany");
const registerEmail = document.querySelector("#registerEmail");
const registerPassword =  document.querySelector("#registerPassword");
const registerConfirmPassword =  document.querySelector("#registerConfirmPassword");
const registerButton = document.querySelector("#registerButton");
const registerMessage = document.createElement("p");

registerLabelCompany.style.display = "none";
registerCompany.style.display = "none";

registerType.addEventListener("change", function() {

    if(registerType.value == 1) {

        registerLabelCompany.style.display = "none";
        registerCompany.style.display = "none";

        registerLabelFirstName.style.display = "flex";
        registerFirstName.style.display = "flex";

        registerLabelLastName.style.display = "flex";
        registerLastName.style.display = "flex";
    }

    else {

        registerLabelFirstName.style.display = "none";
        registerFirstName.style.display = "none";

        registerLabelLastName.style.display = "none";
        registerLastName.style.display = "none";

        registerLabelCompany.style.display = "flex";
        registerCompany.style.display = "flex";
    }
});

registerButton.addEventListener("click", register)

async function register(ev) {

    ev.preventDefault();

    const lastName = registerLastName.value;
    const firstName = registerFirstName.value;
    const companyName = registerCompany.value;
    const email = registerEmail.value;
    const password = registerPassword.value;
    const confirmPassword = registerConfirmPassword.value;

    if(registerType.value == "1") {

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

    else if(registerType.value == "2") {
        
        if(await checkEmptyFields(companyName, email, password, confirmPassword)
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