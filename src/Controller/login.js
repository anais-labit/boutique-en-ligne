const loginForm = document.querySelector("#loginForm");
const loginEmail = document.querySelector("#loginEmail");
const loginPassword =  document.querySelector("#loginPassword");
const loginButton = document.querySelector("#loginButton");
const loginMessage = document.createElement("p");

loginButton.addEventListener("click", login)

async function login(ev) {

    ev.preventDefault();

    const email = loginEmail.value;
    const password = loginPassword.value;

    const reqLogin = new FormData(loginForm)

        const requestOptions = {
            method: 'POST',
            body: reqLogin,
        };

        let loginUser = await fetch("../src/Controller/user_management.php", requestOptions);

        loginUser = await loginUser.json()

        if(loginUser.success == false) {

            loginMessage.innerHTML = loginUser.message

            loginForm.appendChild(loginMessage);
        }

        else if(loginUser.success == true) {

            location.reload();
        }
}