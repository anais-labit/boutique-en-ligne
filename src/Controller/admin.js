// const usersListDiv = document.querySelector("#usersListDiv");

// async function displayAllUsers() {
//   const displayUsersForm = new FormData();
//   displayUsersForm.append("displayAllUsers", "displayAllUsers");

//   const requestDisplayAllUsers = {
//     method: "POST",
//     body: displayUsersForm,
//   };

//   const getUsers = await fetch(
//     "../src/Routes/admin_management.php",
//     requestDisplayAllUsers
//   );

//   const result = await getUsers.json();

//   for (let i in result) {
//     const userDiv = document.createElement("div");
//     userDiv.setAttribute("class", "userDiv");
//     userDiv.style.display = "flex";
//     userDiv.style.justifyContent = "space-around";

//     const userId = document.createElement("p");
//     userId.innerHTML = "id:" + result[i].id + " ";
//     userDiv.appendChild(userId);

//     const userEmail = document.createElement("p");
//     userEmail.innerHTML = "email:" + result[i].email;
//     userDiv.appendChild(userEmail);

//     // CODE D'ALEXANDRE
//     // const userRole = document.createElement("p");
//     // userRole.innerHTML = " role:" + result[i].type;
//     // userDiv.appendChild(userRole);

//     // Créez un élément select
//     const userRoleSelect = document.createElement("select");

//     // Définissez les correspondances entre les valeurs et les libellés des rôles
//     const roleOptions = [
//       { value: 1, label: "Particulier" },
//       { value: 2, label: "Entreprise" },
//       { value: 3, label: "Collaborateur" },
//       { value: 4, label: "Admin" },
//     ];

//     roleOptions.forEach((option) => {
//       const roleOption = document.createElement("option");
//       roleOption.value = option.value;
//       roleOption.text = option.label;

//       // Vérifiez si la valeur correspond à la valeur actuelle du rôle
//       if (option.value === result[i].type) {
//         roleOption.selected = true; // Sélectionnez l'option
//       }

//       userRoleSelect.appendChild(roleOption);
//     });

//     // Ajoutez un événement pour mettre à jour le rôle
//     userRoleSelect.addEventListener("change", function () {
//       const newRole = parseInt(userRoleSelect.value);

//       // Mettez à jour le rôle dans votre logique de traitement des données
//       // ...

//       console.log("hello");
//       userRoleSelect.value = newRole;
//       console.log(newRole);
//       console.log(userRoleSelect.value);

//       async function updateUser() {
//         const reqUpdate = new FormData(updateForm);
//         reqUpdate.append("updateProfile", "updateProfile");

//         const options = {
//           method: "POST",
//           body: reqUpdate,
//         };

//         const updateUser = await fetch(
//           "../src/Routes/user_management.php",
//           options
//         );
//       }
//         updateUser();
//       });
//     };

//     // Ajoutez le select à userDiv
//     userDiv.appendChild(userRoleSelect);

//     const deleteUserButton = document.createElement("button");
//     deleteUserButton.setAttribute("class", "deleteUserButton");
//     deleteUserButton.setAttribute("value", result[i].id);
//     deleteUserButton.innerHTML = "Supprimer";
//     deleteUserButton.addEventListener("click", deleteUser(result[i].id));
//     userDiv.appendChild(deleteUserButton);

//     usersListDiv.appendChild(userDiv);
//   }

// function deleteUser(id) {
//   return async function () {
//     const deleteUserForm = new FormData();

//     deleteUserForm.append("deleteUser", id);

//     const requestDeleteUser = {
//       method: "POST",
//       body: deleteUserForm,
//     };

//     const deleteUser = await fetch(
//       "../src/Routes/admin_management.php",
//       requestDeleteUser
//     );

//     const result = await deleteUser.json();

//     usersListDiv.innerHTML = "";

//     displayAllUsers();
//   };
// }

// displayAllUsers();

// // Ajoutez un événement pour mettre à jour le rôle
// userRoleSelect.addEventListener("change", function () {
//   const newRole = parseInt(userRoleSelect.value);

//   // Envoie des données mises à jour au serveur
//   const updateUserForm = new FormData();
//   updateUserForm.append("updateUser", result[i].id);
//   updateUserForm.append("newRole", newRole);

//   const requestUpdateUser = {
//     method: "POST",
//     body: updateUserForm,
//   };

//   fetch("../src/Routes/admin_management.php", requestUpdateUser)
//     .then((response) => response.json())
//     .then((result) => {
//       // Gérer la réponse du serveur
//       console.log(result);
//     })
//     .catch((error) => {
//       // Gérer les erreurs
//       console.error(error);
//     });
// });

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

    // Créez un élément select
    const userRoleSelect = document.createElement("select");

    // Définissez les correspondances entre les valeurs et les libellés des rôles
    const roleOptions = [
      { value: 1, label: "Particulier" },
      { value: 2, label: "Entreprise" },
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

    // Ajoutez le select à userDiv
    userDiv.appendChild(userRoleSelect);

    const deleteUserButton = document.createElement("button");
    deleteUserButton.setAttribute("class", "deleteUserButton");
    deleteUserButton.setAttribute("value", result[i].id);
    deleteUserButton.innerHTML = "Supprimer";
    deleteUserButton.addEventListener("click", deleteUser(result[i].id));
    userDiv.appendChild(deleteUserButton);

    usersListDiv.appendChild(userDiv);
  }
}

function deleteUser(id) {
  return async function () {
    const deleteUserForm = new FormData();

    deleteUserForm.append("deleteUser", id);

    const requestDeleteUser = {
      method: "POST",
      body: deleteUserForm,
    };

    const deleteUser = await fetch(
      "../src/Routes/admin_management.php",
      requestDeleteUser
    );

    const result = await deleteUser.json();

    usersListDiv.innerHTML = "";

    displayAllUsers();
  };
}

displayAllUsers();
