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

        // Sélectionnez l'option actuelle
        if (option.value === result[i].type) {
          roleOption.selected = true;
        }
        userRoleSelect.appendChild(roleOption);
      });

      userRoleSelect.addEventListener("change", function () {
        console.log("hello");
        const newRole = parseInt(this.value); // Obtenez la nouvelle valeur de rôle sélectionnée (convertie en entier)
        const userId = result[i].id; // Obtenez l'ID de l'utilisateur correspondant

        updateUserRole(userId, newRole);
      });

      // Ajoutez le select à userDiv
      userDiv.appendChild(userRoleSelect);
    }

    if (roleText) {
      const userRole = document.createElement("p");
      userRole.innerHTML = roleText;
      userDiv.appendChild(userRole);
    }

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
      // Gérez la réponse du serveur et effectuez toute autre action requise
      Swal.fire(
        "Mise à jour du rôle",
        "Le rôle de l'utilisateur a été mis à jour avec succès.",
        "success"
      );
      // Vous pouvez également mettre à jour le tableau d'utilisateurs ici si nécessaire
    });
}

displayAllUsers();
