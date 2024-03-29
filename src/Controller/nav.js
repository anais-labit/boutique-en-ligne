const searchButton = document.getElementById("search-button");
const btnRegister = document.getElementById("nav-register-section");
const wrapper = document.querySelector(".wrapper");
const authenticationContainer = document.getElementById(
  "authentication-container"
);
const loginForm = document.querySelector("#loginForm");
const loginEmail = document.querySelector("#loginEmail");
const loginPassword = document.querySelector("#loginPassword");
const loginButton = document.querySelector("#loginButton");
const closeIcon = document.querySelector(".icon-close");
const loginMessage = document.createElement("p");
const connexionHeader = document.querySelector(".login header");
const registerHeader = document.querySelector(".register header");
const registerForm = document.querySelector("#registerForm");
const registerType = document.querySelector("#registerType");
const registerLabelFirstName = document.querySelector(
  "#registerLabelFirstName"
);
const registerFirstName = document.querySelector("#registerFirstName");
const registerLabelLastName = document.querySelector("#registerLabelLastName");
const registerLastName = document.querySelector("#registerLastName");
const registerLabelCompany = document.querySelector("#registerLabelCompany");
const registerCompany = document.querySelector("#registerCompany");
const registerEmail = document.querySelector("#registerEmail");
const registerPassword = document.querySelector("#registerPassword");
const registerConfirmPassword = document.querySelector(
  "#registerConfirmPassword"
);
const registerButton = document.querySelector("#registerButton");
const registerMessage = document.createElement("p");

// SWITCH CONNEXION/INSCRIPTION
registerHeader.addEventListener("click", () => {
  wrapper.classList.add("register-active");
});

connexionHeader.addEventListener("click", () => {
  wrapper.classList.remove("register-active");
});

// Open Modal CONNEXION/REGISTER
btnRegister.addEventListener("click", () => {
  authenticationContainer.classList.toggle("active-popup");
  document
    .querySelector(".header .header-top .search-form")
    .classList.remove("active");
});

// Close Modal CONNEXION/REGISTER
closeIcon.addEventListener("click", () => {
  authenticationContainer.classList.remove("active-popup");
});

searchButton.onclick = () => {
  wrapper.classList.remove("active-popup");
  document
    .querySelector(".header .header-top .search-form")
    .classList.toggle("active");
};

let avatarLink = "";
const avatars = document.querySelectorAll(".avatarIMG");

for (const avatar of avatars) {
  avatar.onclick = () => {
    avatarLink = avatar.src;

    avatar.style.border = "2px solid #FFC107";
    avatar.classList.add("selected");

    for (const i of avatars) {
      if (i != avatar) {
        if ((i.className = "selected")) {
          i.style.removeProperty("border");
          i.classList.remove("selected");
        }
      }
    }
  };
}

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

loginButton.addEventListener("click", login);

async function login(ev) {
  ev.preventDefault();

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
    loginMessage.classList.add("message");
    loginMessage.innerHTML = loginUser.message;
    loginForm.appendChild(loginMessage);
  } else if (loginUser.success == true) {
    location.reload();
  }
}

// Register function

registerLabelCompany.style.display = "none";
registerCompany.style.display = "none";

registerType.addEventListener("change", function () {
  if (registerType.value == 1) {
    registerLabelCompany.style.display = "none";
    registerCompany.style.display = "none";

    registerLabelFirstName.style.display = "flex";
    registerFirstName.style.display = "flex";

    registerLabelLastName.style.display = "flex";
    registerLastName.style.display = "flex";
  } else {
    registerLabelFirstName.style.display = "none";
    registerFirstName.style.display = "none";

    registerLabelLastName.style.display = "none";
    registerLastName.style.display = "none";

    registerLabelCompany.style.display = "flex";
    registerCompany.style.display = "flex";
  }
});

registerButton.addEventListener("click", register);

async function register(ev) {
  ev.preventDefault();

  const lastName = registerLastName.value;
  const firstName = registerFirstName.value;
  const companyName = registerCompany.value;
  const email = registerEmail.value;
  const password = registerPassword.value;
  const confirmPassword = registerConfirmPassword.value;

  if (registerType.value == "1") {
    if (
      (await checkEmptyFields(
        lastName,
        firstName,
        email,
        password,
        confirmPassword
      )) &&
      (await checkPasswords(password, confirmPassword))
    ) {
      const reqRegister = new FormData(registerForm);
      reqRegister.append("avatar", avatarLink);

      const requestOptions = {
        method: "POST",
        body: reqRegister,
      };

      let createUser = await fetch(
        "../src/Routes/user_management.php",
        requestOptions
      );

      createUser = await createUser.json();

      registerMessage.classList.add("message");
      registerMessage.innerHTML = createUser.message;

      registerForm.appendChild(registerMessage);
      if (createUser.success == true) {
        setTimeout(function () {
          window.location.href = "index.php";
        }, 3000);
      }
    }
  } else if (registerType.value == "2") {
    if (
      (await checkEmptyFields(companyName, email, password, confirmPassword)) &&
      (await checkPasswords(password, confirmPassword))
    ) {
      const reqRegister = new FormData(registerForm);
      reqRegister.append("avatar", avatarLink);

      const requestOptions = {
        method: "POST",
        body: reqRegister,
      };

      let createUser = await fetch(
        "../src/Routes/user_management.php",
        requestOptions
      );

      createUser = await createUser.json();

      registerMessage.classList.add("message");
      registerMessage.innerHTML = createUser.message;

      registerForm.appendChild(registerMessage);
      if (createUser.success == true) {
      setTimeout(function () {
        window.location.href = "index.php";
      }, 3000);
    }
  }
  }
}

async function checkEmptyFields(...fields) {
  for (let i in fields) {
    if (!fields[i].trim()) {
      registerMessage.classList.add("message");
      registerMessage.innerHTML = "Veuillez remplir tous les champs";

      registerForm.appendChild(registerMessage);

      return false;
    }
  }

  return true;
}

async function checkPasswordSecurity(password) {
  if (password.length < 8) {
    registerMessage.classList.add("message");
    registerMessage.innerHTML =
      "Votre mot de passe doit contenir au moins 8 caractères";

    return false;
  }

  return true;
}

async function checkPasswords(password, confirmPassword) {
  if (password !== confirmPassword) {
    registerMessage.classList.add("message");
    registerMessage.innerHTML = "Les mots de passe ne correspondent pas";

    registerForm.appendChild(registerMessage);

    return false;
  }

  return true;
}
