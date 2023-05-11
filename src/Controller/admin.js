// GLOBAL PAGE

const dashboardBtn = document.querySelector("#dashboardBtn");
const gestionBtn = document.querySelector("#gestionBtn");
const administrationBtn = document.querySelector("#administrationBtn");

const dashboardForm = document.querySelector("#dashboard-modal");
const gestionForm = document.querySelector("#gestion-modal");
const administrationForm = document.querySelector("#administration-modal");

function hideForm(form) {
  form.style.display = "none";
}

// Masquer tous les formulaires par défaut
hideForm(dashboardForm);
hideForm(gestionForm);
hideForm(administrationForm);

function showForm(form) {
  form.style.display = "flex";
}

function setModal(button, form) {
  button.addEventListener("click", (event) => {
    event.preventDefault();
    hideForm(dashboardForm);
    hideForm(gestionForm);
    hideForm(administrationForm);
    showForm(form);
  });
}

// Set les boutons et les formulaires associés
setModal(dashboardBtn, dashboardForm);
setModal(gestionBtn, gestionForm);
setModal(administrationBtn, administrationForm);

// DASHBOARD MODAL //

function updateClock() {
  const clockElement = document.querySelector("#clock");
  let currentTime = new Date();
  const timeString = formatDateTime(currentTime);
  clockElement.textContent = "Informations relevées en direct : le " + timeString;
}

async function fetchCartCount() {
  const requestCountAllCarts = {
    method: "GET",
  };

  const responseAllCarts = await fetch(
    "../src/Routes/admin_management.php?countAllCarts",
    requestCountAllCarts
  );
  const totalCarts = await responseAllCarts.text();

  const requestCountPaidCarts = {
    method: "GET",
  };

  const responsePaidCarts = await fetch(
    "../src/Routes/admin_management.php?countPaidCarts",
    requestCountPaidCarts
  );
  const totalPaidCarts = await responsePaidCarts.text();

  document.querySelector("#allCartsCountDiv").innerText =
    "Nombre de paniers créés : " + totalCarts;
  document.querySelector("#paidCartsCountDiv").innerText =
    "Nombre de paniers créés convertis en vente : " + totalPaidCarts;
}

const allCartsListDiv = document.querySelector("#allCartsListDiv");

async function displayAllCarts() {
  const displayAllCartsForm = new FormData();
  displayAllCartsForm.append("displayAllCarts", "displayAllCarts");
  const requestDisplayAllCarts = {
    method: "POST",
    body: displayAllCartsForm,
  };
  const getCarts = await fetch(
    "../src/Routes/admin_management.php",
    requestDisplayAllCarts
  );
  const result = await getCarts.json();

  result.forEach((cart) => {
    const allCartsDiv = document.createElement("div");
    allCartsDiv.setAttribute("class", "allCartsDiv");
    allCartsDiv.style.display = "flex";

    const cartId = document.createElement("p");
    cartId.innerHTML = "Id: " + cart.id;

    const cartDate = document.createElement("p");
    const formattedDate = formatDateTime(cart.date);
    cartDate.innerHTML = "Date: " + formattedDate;

    const cartAmount = document.createElement("p");
    cartAmount.innerHTML = "Montant total : " + cart.total_amount + "€";

    const cartStatus = document.createElement("p");
    if (cart.paid === "NO") {
      cartStatus.innerHTML = " Payé: non";
    } else {
      cartStatus.innerHTML = " Payé: oui";
    }

    allCartsDiv.appendChild(cartId);
    allCartsDiv.appendChild(cartDate);
    allCartsDiv.appendChild(cartAmount);
    allCartsDiv.appendChild(cartStatus);
    allCartsListDiv.appendChild(allCartsDiv);

    if (cart.paid === "YES") {
      const paidCartsDiv = document.createElement("div");
      paidCartsDiv.setAttribute("class", "paidCartsDiv");
      paidCartsDiv.style.display = "flex";

      const cartId = document.createElement("p");
      cartId.innerHTML = "Id: " + cart.id;

      const cartDate = document.createElement("p");
      const formattedDate = formatDateTime(cart.date);
      cartDate.innerHTML = "Date: " + formattedDate;

      const cartAmount = document.createElement("p");
      cartAmount.innerHTML = "Montant total : " + cart.total_amount + "€";

      paidCartsDiv.appendChild(cartId);
      paidCartsDiv.appendChild(cartDate);
      paidCartsDiv.appendChild(cartAmount);

      const paidCartsListDiv = document.querySelector("#paidCartsListDiv");
      paidCartsListDiv.appendChild(paidCartsDiv);
    }
  });
}

function formatDateTime(dateString) {
  const date = new Date(dateString);

  const day = date.getDate();
  const month = (date.getMonth() + 1).toString().padStart(2, "0");
  const year = date.getFullYear();
  const hours = date.getHours();
  const minutes = date.getMinutes().toString().padStart(2, "0");

  return `${day}/${month}/${year} à ${hours}h${minutes}`;
}

// ADMINISTRATION MODAL //

const usersListDiv = document.querySelector("#usersListDiv");

async function displayAllUsers() {
  const displayUsersForm = new FormData();
  displayUsersForm.append("displayAllUsers", "displayAllUsers");
  const requestDisplayAllUsers = {
    method: "POST",
    body: displayUsersForm,
  };
  const getUsers = await fetch(
    "../src/Routes/admin_management.php",
    requestDisplayAllUsers
  );
  const result = await getUsers.json();

  for (let i in result) {
    const userDiv = document.createElement("div");
    userDiv.setAttribute("class", "userDiv");
    userDiv.style.display = "flex";
    userDiv.style.justifyContent = "space-around";

    let roleText;
    if (result[i].type === 2) {
      roleText = "Entreprise";
    } else {
      const userRoleSelect = document.createElement("select");

      // Correspondances entre les valeurs et les libellés des rôles
      const roleOptions = [
        { value: 1, label: "Particulier" },
        { value: 3, label: "Collaborateur" },
        { value: 4, label: "Admin" },
      ];

      roleOptions.forEach((option) => {
        const roleOption = document.createElement("option");
        roleOption.value = option.value;
        roleOption.text = option.label;

        // Sélectionner l'option actuelle
        if (option.value === result[i].type) {
          roleOption.selected = true;
        }
        userRoleSelect.appendChild(roleOption);
      });

      userRoleSelect.addEventListener("change", function () {
        const newRole = parseInt(this.value); // Set la nouvelle valeur de rôle sélectionnée (convertie en entier)
        const userId = result[i].id; // Get l'ID de l'utilisateur correspondant

        updateUserRole(userId, newRole);
      });

      // Ajouter le select à userDiv
      userDiv.appendChild(userRoleSelect);
    }

    if (roleText) {
      const userRole = document.createElement("p");
      userRole.innerHTML = roleText;
      userDiv.appendChild(userRole);
    }

    const userId = document.createElement("p");
    userId.innerHTML = " id: " + result[i].id + " ";
    userDiv.appendChild(userId);

    const userEmail = document.createElement("p");
    userEmail.innerHTML = "email: " + result[i].email;
    userDiv.appendChild(userEmail);

    const deleteUserButton = document.createElement("button");
    deleteUserButton.setAttribute("name", "deleteUser");
    deleteUserButton.setAttribute("value", result[i].id);
    deleteUserButton.innerHTML = "Supprimer";

    deleteUserButton.addEventListener("click", function () {
      const userId = this.getAttribute("value");
      showDeleteConfirmation(userId);
    });

    userDiv.appendChild(deleteUserButton);
    usersListDiv.appendChild(userDiv);
  }
}

function deleteUser(id) {
  const deleteUserForm = new FormData();
  deleteUserForm.append("deleteUser", id);
  const requestDeleteUser = {
    method: "POST",
    body: deleteUserForm,
  };
  const deleteUser = fetch(
    "../src/Routes/admin_management.php",
    requestDeleteUser
  );
  usersListDiv.innerHTML = "";
  displayAllUsers();
}

function showDeleteConfirmation(userId) {
  Swal.fire({
    title: "Êtes-vous sûr(e) ?",
    text: "Cette action est irréversible !",
    icon: "warning",
    showCancelButton: "true",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Annuler",
    confirmButtonText: "Oui, supprimer !",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Supprimé !", "Le compte a été supprimé.", "success");
      console.log(userId);
      deleteUser(userId);
    }
  });
}

function updateUserRole(userId, newRole) {
  const updateUserForm = new FormData();
  updateUserForm.append("updateUserRole", "true");
  updateUserForm.append("userId", userId);
  updateUserForm.append("newRole", newRole);
  const requestUpdateUserRole = {
    method: "POST",
    body: updateUserForm,
  };
  fetch("../src/Routes/admin_management.php", requestUpdateUserRole)
    .then((response) => response.json())
    .then((result) => {
      Swal.fire({
        title: "Mise à jour du rôle",
        text: "Le rôle de l'utilisateur a été mis à jour avec succès.",
        icon: "success",
        // showConfirmButton: false, // Supprime le bouton "OK"
        timer: 2000, // Affiche la pop-up pendant 3 secondes
      });
    });
}

// ON LOAD //

window.addEventListener("DOMContentLoaded", () => {
  displayAllCarts();
  fetchCartCount();
  displayAllUsers();
  setInterval(updateClock, 1000);
});
