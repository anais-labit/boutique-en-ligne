const updateForm = document.querySelector("#updateForm");
const updateButton = document.querySelector("#updateButton");
const deleteForm = document.querySelector("#deleteForm");
const deleteButton = document.querySelector("#deleteButton");

// async function updateUser() {
//   const reqUpdate = new FormData(updateForm);
//   reqUpdate.append("updateProfile", "updateProfile");

//   const options = {
//     method: "POST",
//     body: reqUpdate,
//   };

//   const updateUser = await fetch("../src/Routes/user_management.php", options);
// }

// updateButton.addEventListener("click", async (event) => {
//   event.preventDefault();
//   updateUser();
// });

// async function deleteUser() {test
//   const reqDelete = new FormData(updateForm);
//   reqDelete.append("deleteButton", "deleteButton");

//   const options = {
//     method: "POST",
//     body: reqDelete,
//   };

//   const deleteUser = await fetch("../src/Routes/user_management.php", options);
// }

// deleteButton.addEventListener("click", async (event) => {
//   event.preventDefault();
//   deleteUser();
// });

const deleteButtons = document.querySelectorAll(".delete-user-button");

deleteButtons.forEach((button) => {
  button.addEventListener("click", async (event) => {
    event.preventDefault();

    const formData = new FormData(); // récupère les données du formulaire
    let userId = button.value;
    formData.append("delete-user-button", userId);
    console.log(userId);
    const test = await fetch(
      `../src/Routes/admin_management.php`,
      {
        method: "POST",
        body: formData, // envoie les données du formulaire avec la requête
      }
    );
    // .then((response) => {
    //   if (response.ok) {
    //     console.log("réussi");
    //     console.log(response);
    //     // location.reload();
    //   }
    // });
    const test2 = await test.json();
    console.log(test2.test);
  });
});
