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

// ADMINISTRATION MODAL

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

    const userId = document.createElement("p");
    userId.innerHTML = "id:" + result[i].id + " ";
    userDiv.appendChild(userId);

    const userEmail = document.createElement("p");
    userEmail.innerHTML = "email:" + result[i].email;
    userDiv.appendChild(userEmail);

    const userRoleSelect = document.createElement("select");

    // Correspondances entre les valeurs et les libellés des rôles
    const roleOptions = [
      { value: 1, label: "Particulier" },
      { value: 2, label: "Entreprise" },
      { value: 3, label: "Collaborateur" },
      { value: 4, label: "Admin" },
    ];

    roleOptions.forEach((option) => {
      const roleOption = document.createElement("option");
      roleOption.setAttribute("userType", option.value);
      roleOption.value = option.value;
      roleOption.text = option.label;

      // Sélectionnez l'option actuelle
      if (option.value === result[i].type) {
        roleOption.selected = true;
      }
      userRoleSelect.appendChild(roleOption);
    });

    // Ajoutez le select à userDiv
    userDiv.appendChild(userRoleSelect);

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
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Oui, supprimer !",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Supprimé !", "Le compte a été supprimé.", "success");
      console.log(userId);
      deleteUser(userId);
    }
  });
}

displayAllUsers();
