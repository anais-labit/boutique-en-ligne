//---------------------------------------------------- GLOBAL PAGE ----------------------------------------------------//

// Variables pour les boutons de navigation
const dashboardBtn = document.querySelector("#dashboardBtn");
const gestionBtn = document.querySelector("#gestionBtn");
const administrationBtn = document.querySelector("#administrationBtn");

// Variables pour les formulaires
const dashboardForm = document.querySelector("#dashboard-modal");
const gestionForm = document.querySelector("#gestion-modal");
const administrationForm = document.querySelector("#administration-modal");

// Fonction pour masquer un formulaire
function hideForm(form) {
  form.style.display = "none";
}

// Masquer tous les formulaires par défaut
hideForm(dashboardForm);
hideForm(gestionForm);
hideForm(administrationForm);

// Fonction pour afficher un formulaire
function showForm(form) {
  form.style.display = "flex";
}

// Fonction pour configurer un bouton et le formulaire associé
function setModal(button, form) {
  button.addEventListener("click", (event) => {
    event.preventDefault();
    hideForm(dashboardForm);
    hideForm(gestionForm);
    hideForm(administrationForm);
    showForm(form);
  });
}

// Configuration des boutons et des formulaires associés
setModal(dashboardBtn, dashboardForm);
setModal(gestionBtn, gestionForm);
setModal(administrationBtn, administrationForm);

// Fonction pour rafraîchir les données collectées
function refresh() {
  // Supprimer les anciennes listes
  allCartsListDiv.innerHTML = "";
  pendingCartsListDiv.innerHTML = "";
  paidCartsListDiv.innerHTML = "";
  usersListDiv.innerHTML = ""; // administration-modal

  // Appeler les fonctions pour mettre à jour les données
  clock();
  fetchCartCount();
  fetchClientCount();
  fetchTotalRevenue();
  displayAllCarts();
  displayAllUsers();

  // Afficher une pop-up de confirmation
  Swal.fire({
    title: "Mise à jour des données",
    text: "Les données ont bien été actualisées.",
    icon: "success",
    timer: 2000,
  });
}

//---------------------------------------------------- DASHBOARD MODAL ----------------------------------------------------//

// Fonction pour afficher l'horloge
function clock() {
  const clockElement = document.querySelector("#clock");
  let currentTime = new Date();
  const timeString = formatDateTime(currentTime);
  clockElement.textContent = "Informations relevées le : " + timeString;

  // Créer un bouton pour actualiser la page
  const refreshBtn = document.createElement("button");
  refreshBtn.setAttribute("id", "refreshBtn");
  refreshBtn.innerHTML = "Actualiser";
  clockElement.appendChild(refreshBtn);

  // Ajouter un gestionnaire d'événements pour le bouton d'actualisation
  refreshBtn.addEventListener("click", async (event) => {
    event.preventDefault();
    refresh();
  });
}

// Fonction pour récupérer le nombre de paniers
async function fetchCartCount() {
  const response = await fetch("../src/Routes/admin_management.php?countCarts");
  const cartCounts = await response.json();

  // Afficher les résultats
  const totalCartsDiv = document.querySelector("#cartsCountDiv");
  totalCartsDiv.innerHTML =
    "<p> Paniers créés : " +
    cartCounts.totalCount +
    "</p>" +
    "<p> Paniers en attente : " +
    cartCounts.pendingCount +
    "</p>" +
    "<p> Paniers convertis en ventes : " +
    cartCounts.paidCount +
    "</p>";
}

// Fonction pour récupérer le nombre de clients
async function fetchClientCount() {
  const response = await fetch(
    "../src/Routes/admin_management.php?countClients"
  );
  const clientCounts = await response.json();

  // Afficher les résultats
  const totalClientsDiv = document.querySelector("#clientsCountDiv");
  totalClientsDiv.innerHTML =
    "<p>Clients inscrits : " +
    clientCounts.totalCount +
    "</p>" +
    "<p>Clients particuliers : " +
    clientCounts.type1Count +
    "</p>" +
    "<p>Clients entreprises : " +
    clientCounts.type2Count +
    "</p>";
}

// Fonction pour récupérer le chiffre d'affaire total
async function fetchTotalRevenue() {
  const response = await fetch(
    "../src/Routes/admin_management.php?countTotalRevenue"
  );
  const totalRevenue = await response.text();

  // Afficher les résultats
  const revenueCountDiv = document.querySelector("#revenueCountDiv");
  revenueCountDiv.innerHTML = "Chiffre d'affaire : " + totalRevenue + "€";
}

// Fonction pour récupérer et afficher tous les paniers
async function displayAllCarts() {
  const displayAllCartsForm = new FormData();

  // via une requête POST
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

  // et une boucle qui parcourt chaque panier et crée des éléments HTML correspondants aux données voulues
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

    // Créer le statut de paiement du panier
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

    const allCartsListDiv = document.querySelector("#allCartsListDiv");
    allCartsListDiv.appendChild(allCartsDiv);

    // Séparer les paniers en attente
    if (cart.paid === "NO") {
      const pendingCartsDiv = document.createElement("div");
      pendingCartsDiv.setAttribute("class", "pendingCartsDiv");
      pendingCartsDiv.style.display = "flex";

      const cartId = document.createElement("p");
      cartId.innerHTML = "Id: " + cart.id;

      const cartDate = document.createElement("p");
      const formattedDate = formatDateTime(cart.date);
      cartDate.innerHTML = "Date: " + formattedDate;

      const cartAmount = document.createElement("p");
      cartAmount.innerHTML = "Montant total : " + cart.total_amount + "€";

      pendingCartsDiv.appendChild(cartId);
      pendingCartsDiv.appendChild(cartDate);
      pendingCartsDiv.appendChild(cartAmount);

      const pendingCartsListDiv = document.querySelector(
        "#pendingCartsListDiv"
      );
      pendingCartsListDiv.appendChild(pendingCartsDiv);
    }

    // Séparer les paniers vendus
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

// Fonction pour formater la date et l'heure
function formatDateTime(dateString) {
  const date = new Date(dateString);

  const day = date.getDate();
  const month = (date.getMonth() + 1).toString().padStart(2, "0");
  const year = date.getFullYear();
  const hours = date.getHours();
  const minutes = date.getMinutes().toString().padStart(2, "0");

  // return `${day}/${month}/${year} à ${hours}h${minutes}`;
  return day + "/" + month + "/" + year + " à " + hours + "h" + minutes;
}

//---------------------------------------------------- ADMINISTRATION MODAL ----------------------------------------------------//

// Fonction pour afficher tous les utilisateurs
async function displayAllUsers() {
  const displayUsersForm = new FormData();
  displayUsersForm.append("displayAllUsers", "displayAllUsers");

  // via une requête POST
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

    // Afficher le type entreprise
    if (result[i].type === 2) {
      const roleText = "Entreprise";
      const userRole = document.createElement("p");
      userRole.innerHTML = roleText;
      userDiv.appendChild(userRole);

      // ou Créer un select pour les autres types
    } else {
      const userRoleSelect = document.createElement("select");

      // Correspondances entre les valeurs et les libellés des rôles
      const roleOptions = [
        { value: 1, label: "Particulier" },
        { value: 3, label: "Collaborateur" },
        { value: 4, label: "Admin" },
      ];

      // Créer une option pour chaque rôle et l'ajouter au select
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

      userDiv.appendChild(userRoleSelect);

      // Ajouter un écouteur d'événement pour le changement de rôle
      userRoleSelect.addEventListener("change", function () {
        const newRole = parseInt(this.value);
        const userId = result[i].id;
        updateUserRole(userId, newRole);
      });
    }

    // Associer les données voulues et les afficher
    const userId = document.createElement("p");
    userId.innerHTML = " id: " + result[i].id + " ";
    userDiv.appendChild(userId);

    const userEmail = document.createElement("p");
    userEmail.innerHTML = "email: " + result[i].email;
    userDiv.appendChild(userEmail);

    // Ajouter un bouton de suppression
    const deleteUserButton = document.createElement("button");
    deleteUserButton.setAttribute("name", "deleteUser");
    deleteUserButton.setAttribute("value", result[i].id);
    deleteUserButton.innerHTML = "Supprimer";

    userDiv.appendChild(deleteUserButton);

    // Ajouter un écouteur d'événement pour la suppression de l'utilisateur
    deleteUserButton.addEventListener("click", function () {
      const userId = this.getAttribute("value");
      showDeleteConfirmation(userId);
    });

    const usersListDiv = document.querySelector("#usersListDiv");
    usersListDiv.appendChild(userDiv);
  }
}

// Fonction pour supprimer un utilisateur
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

// Fonction pour afficher la confirmation de suppression
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
      deleteUser(userId); // Appel de la fonction deleteUser(id)
    }
  });
}

// Fonction pour mettre à jour le rôle de l'utilisateur
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
        timer: 2000,
      });
    });
  // (Optionnel) Retrier les users par type après updateUserRole()
  refresh();
}

//---------------------------------------------------- ON LOAD ----------------------------------------------------//

window.addEventListener("DOMContentLoaded", () => {
  clock();
  fetchCartCount();
  fetchClientCount();
  fetchTotalRevenue();
  displayAllCarts();
  displayAllUsers();
});
