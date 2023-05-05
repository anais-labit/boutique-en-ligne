const searchButton = document.getElementById("search-button");
const loginFormContainer = document.querySelector(".login-form-container");
const loginForm = document.querySelector("#loginForm");
const loginEmail = document.querySelector("#loginEmail");
const loginPassword = document.querySelector("#loginPassword");
const loginButton = document.querySelector("#loginButton");
const loginMessage = document.createElement("p");


// Open Login Form
document.querySelector("#login-btn").onclick = () => {
  loginFormContainer.classList.toggle("active");
};

// Close Login Form
document.querySelector("#close-login-btn").onclick = () => {
  loginFormContainer.classList.remove("active");
};

searchButton.onclick = () => {
  document
    .querySelector(".header .header-top .search-form")
    .classList.toggle("active");
};

window.onscroll = () => {
  document
    .querySelector(".header .header-top .search-form")
    .classList.remove("active");

  if (window.scrollY > 125) {
    document.querySelector(".header .header-bot").classList.add("active");
  } else {
    document.querySelector(".header .header-bot").classList.remove("active");
  }
};

// Login Function

// loginButton.addEventListener("click", login);

async function login(ev) {
  ev.preventDefault();

  const email = loginEmail.value;
  const password = loginPassword.value;

  const reqLogin = new FormData(loginForm);

  const requestOptions = {
    method: "POST",
    body: reqLogin,
  };

  let loginUser = await fetch(
    "../src/Routes/user_management.php",
    requestOptions
  );

  loginUser = await loginUser.json();
  console.log("test", loginUser);
  if (loginUser.success == false) {
    loginMessage.innerHTML = loginUser.message;

    loginForm.appendChild(loginMessage);
  } else if (loginUser.success == true) {
    location.reload();
  }
}
