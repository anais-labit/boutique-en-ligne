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
}

function showConfirmation() {
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
  const ca = await response.text();

  // Afficher les résultats
  const revenueCountDiv = document.querySelector("#revenueCountDiv");
  const revenue = document.createElement("p");
  revenueCountDiv.appendChild(revenue);

  revenue.innerHTML = "Chiffre d'affaire : " + ca + "€";
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

  // Création du tableau pour tous les paniers
  const allCartsTable = createCartTable(result);

  // Ajout du tableau à la div allCartsListDiv
  const allCartsListDiv = document.querySelector("#allCartsListDiv");
  allCartsListDiv.appendChild(allCartsTable);

  // Création des tableaux pour les paniers payés et en attente
  const pendingCartsTable = createCartTable(result, "NO");
  const paidCartsTable = createCartTable(result, "YES");

  // Ajout des tableaux à leurs div respectives
  const pendingCartsListDiv = document.querySelector("#pendingCartsListDiv");
  pendingCartsListDiv.appendChild(pendingCartsTable);

  const paidCartsListDiv = document.querySelector("#paidCartsListDiv");
  paidCartsListDiv.appendChild(paidCartsTable);
}

// Fonction pour créer un tableau avec les paniers correspondant au statut donné (ou tous les paniers si aucun statut n'est spécifié)
function createCartTable(carts, status = null) {
  // Création du tableau
  const table = document.createElement("table");
  table.setAttribute("class", "cartTable");

  // En-tête du tableau
  const headerRow = document.createElement("tr");
  const headers = ["Id", "Date", "Montant"];
  headers.forEach((headerText) => {
    const headerCell = document.createElement("th");
    headerCell.textContent = headerText;
    headerRow.appendChild(headerCell);
  });
  table.appendChild(headerRow);

  // Filtrage des paniers selon le statut donné
  const filteredCarts = status
    ? carts.filter((cart) => cart.paid === status)
    : carts;

  // Remplissage du tableau avec les données des paniers filtrés
  filteredCarts.forEach((cart) => {
    const row = document.createElement("tr");
    const fields = [
      cart.id,
      formatDateTime(cart.date),
      cart.total_amount / 100 + "€",
    ];
    fields.forEach((fieldText) => {
      const cell = document.createElement("td");
      cell.textContent = fieldText;
      row.appendChild(cell);
    });
    table.appendChild(row);
  });

  return table;
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

  const table = document.createElement("table");
  table.classList.add("userTable");

  // En-tête du tableau
  const headerRow = document.createElement("tr");
  const headers = ["Role", "Id", "Email"];
  headers.forEach((headerText) => {
    const headerCell = document.createElement("th");
    headerCell.textContent = headerText;
    headerRow.appendChild(headerCell);
  });
  table.appendChild(headerRow);

  for (let i in result) {
    const row = document.createElement("tr");

    // Afficher le type entreprise
    if (result[i].type === 2) {
      const roleText = "Entreprise";
      const userRoleCell = document.createElement("td");
      userRoleCell.innerHTML = roleText;
      row.appendChild(userRoleCell);
    } else {
      const userRoleCell = document.createElement("td");
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

      userRoleCell.appendChild(userRoleSelect);

      // Ajouter un écouteur d'événement pour le changement de rôle
      userRoleSelect.addEventListener("change", function () {
        const newRole = parseInt(this.value);
        const userId = result[i].id;
        updateUserRole(userId, newRole);
      });

      row.appendChild(userRoleCell);
    }

    // Associer les données voulues et les afficher
    const userIdCell = document.createElement("td");
    userIdCell.innerHTML = result[i].id;
    row.appendChild(userIdCell);

    const userEmailCell = document.createElement("td");
    userEmailCell.innerHTML = result[i].email;
    row.appendChild(userEmailCell);

    // Ajouter un bouton de suppression
    const deleteUserButton = document.createElement("button");
    deleteUserButton.setAttribute("name", "deleteUser");
    deleteUserButton.setAttribute("value", result[i].id);
    deleteUserButton.innerHTML = "Supprimer";

    const deleteButtonCell = document.createElement("td");
    deleteButtonCell.appendChild(deleteUserButton);
    row.appendChild(deleteButtonCell);

    // Ajouter un écouteur d'événement pour la suppression de l'utilisateur
    deleteUserButton.addEventListener("click", function () {
      const userId = this.getAttribute("value");
      showDeleteConfirmation(userId);
    });

    table.appendChild(row);
  }

  const usersListDiv = document.querySelector("#usersListDiv");
  usersListDiv.appendChild(table);
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
