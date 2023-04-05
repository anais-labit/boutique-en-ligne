const loginForm = document.querySelector("#loginForm");
const loginEmail = document.querySelector("#loginEmail");
const loginPassword =  document.querySelector("#loginPassword");
const loginButton = document.querySelector("#loginButton");
// const decoButton = document.querySelector("#decoButton");
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

        let loginUser = await fetch("../src/Routes/user_management.php", requestOptions);

        loginUser = await loginUser.json()

        if(loginUser.success == false) {

            loginMessage.innerHTML = loginUser.message

            loginForm.appendChild(loginMessage);
        }

        else if(loginUser.success == true) {

            location.reload();
        }
}

// decoButton.addEventListener("click", disconnectUser);

// function disconnectUser() {

//     const decoForm = new FormData();

//     decoForm.append("disconnect", "disconnect");

//     fetch("../src/Controller/user_management.php", {

//         method: "POST",
//         body: decoForm
//     })
// }