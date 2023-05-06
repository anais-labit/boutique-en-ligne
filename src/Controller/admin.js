// const updateForm = document.querySelector("#updateForm");
// const updateButton = document.querySelector("#updateButton");
// const deleteForm = document.querySelector("#deleteForm");
// const deleteButton = document.querySelector("#deleteButton");

// const deleteButtons = document.querySelectorAll(".delete-user-button");

// deleteButtons.forEach((button) => {
//   button.addEventListener("click", async (event) => {
//     event.preventDefault();

//     const formData = new FormData();
//     let userId = button.value;
//     formData.append("delete-user-button", userId);
//     console.log(userId);
//     const response = await fetch(`../src/Routes/admin_management.php`, {
//       method: "POST",
//       body: formData,
//     });
//     const responseBody = await response.json();
//   });
// });

// function catchAllUsers() {
//   fetch("../src/Routes/admin_management.php", {
//     headers: {
//       "Content-Type": "application/json",
//     },
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       // Traiter les données de $displayUsers ici
//       console.log(data);
//     });

// }

// catchAllUsers();

// Définition de l'URL de la requête
const url = "../src/Routes/admin_management.php";

// Récupération de l'élément container
const container = document.querySelector("#container");

// Création de l'élément h1 pour afficher les données
const user = document.createElement("h1");

fetch(url)
  .then((response) => response.json())
  .then((data) => {
    const container = document.querySelector("#container");
    const table = document.createElement("table");
    const thead = document.createElement("thead");
    const tbody = document.createElement("tbody");

    // Création de la ligne d'en-tête
    const headerRow = document.createElement("tr");
    const idHeader = document.createElement("th");
    idHeader.textContent = "ID";
    const emailHeader = document.createElement("th");
    emailHeader.textContent = "Email";
    const typeHeader = document.createElement("th");
    typeHeader.textContent = "Type";
    const buttonHeader = document.createElement("th");
    buttonHeader.textContent = "Actions";
    headerRow.appendChild(idHeader);
    headerRow.appendChild(emailHeader);
    headerRow.appendChild(typeHeader);
    headerRow.appendChild(buttonHeader);
    thead.appendChild(headerRow);

    // Boucle pour créer les lignes du tableau
    for (let i = 0; i < data.length; i++) {
      const user = data[i];
      const row = document.createElement("tr");
      const idCell = document.createElement("td");
      idCell.textContent = user.id;
      const emailCell = document.createElement("td");
      emailCell.textContent = user.email;
      const typeCell = document.createElement("td");
      typeCell.textContent = user.type;
      const buttonCell = document.createElement("td");
      const button = document.createElement("button");
      button.setAttribute("id", user.id);
      button.textContent = "Supprimer";
      button.addEventListener("click", () => {
        // Ici, vous pouvez ajouter la logique pour supprimer l'utilisateur correspondant à l'id
        console.log(`Supprimer l'utilisateur avec l'id ${user.id}`);
      });
      buttonCell.appendChild(button);
      row.appendChild(idCell);
      row.appendChild(emailCell);
      row.appendChild(typeCell);
      row.appendChild(buttonCell);
      tbody.appendChild(row);
    }

    // Ajout des éléments au DOM
    table.appendChild(thead);
    table.appendChild(tbody);
    container.appendChild(table);
  })
  .catch((error) => console.error(error));






  const usersListDiv = document.querySelector("#usersListDiv");

  async function displayAllUsers() {

    const displayUsersForm = new FormData();

     displayUsersForm.append("displayAllUsers", "displayAllUsers");

     const requestDisplayAllUsers = {

         method:"POST",
         body: displayUsersForm
     }

    const getUsers = await fetch("../src/Routes/admin_management.php", requestDisplayAllUsers);

    const result = await getUsers.json();

    for(let i in result) {

      const userDiv = document.createElement("div");
      userDiv.setAttribute("class", "userDiv");
      userDiv.style.display = "flex";
      userDiv.style.justifyContent = "space-around";

      const userId = document.createElement("p");
      userId.innerHTML = 'id:' + result[i].id + ' ';
      userDiv.appendChild(userId);

      const userEmail = document.createElement("p");
      userEmail.innerHTML = 'email:' + result[i].email;
      userDiv.appendChild(userEmail);

      const userRole = document.createElement("p");
      userRole.innerHTML = ' role:' + result[i].type;
      userDiv.appendChild(userRole);

      const deleteUserButton = document.createElement("button");
      deleteUserButton.setAttribute("class", "deleteUserButton");
      deleteUserButton.setAttribute("value", result[i].id);
      deleteUserButton.innerHTML = 'Supprimer';
      deleteUserButton.addEventListener("click", deleteUser(result[i].id));
      userDiv.appendChild(deleteUserButton);

      usersListDiv.appendChild(userDiv);

    }
  }

  function deleteUser(id) {
      
      return async function() {
  
        const deleteUserForm = new FormData();
  
        deleteUserForm.append("deleteUser", id);
  
        const requestDeleteUser = {
  
          method:"POST",
          body: deleteUserForm
        }
  
        const deleteUser = await fetch("../src/Routes/admin_management.php", requestDeleteUser);
  
        const result = await deleteUser.json();
    
        usersListDiv.innerHTML = "";
  
        displayAllUsers();
  
      }
  }


  displayAllUsers();
