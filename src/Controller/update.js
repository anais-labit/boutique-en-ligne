const updateForm = document.querySelector("#updateForm");
const updateButton = document.querySelector("#updateButton");
const deleteButton = document.querySelector("#deleteButton");

async function updateUser() {
  const reqUpdate = new FormData(updateForm);
  reqUpdate.append("updateProfile", "updateProfile");

  const options = {
    method: "POST",
    body: reqUpdate,
  };

  const updateUser = await fetch("../src/Routes/user_management.php", options);
}

updateButton.addEventListener("click", async (event) => {
  event.preventDefault();
  updateUser();
});

async function deleteUser() {
  const reqDelete = new FormData(updateForm);
  reqDelete.append("deleteButton", "deleteButton");

  const options = {
    method: "POST",
    body: reqDelete,
  };

  const deleteUser = await fetch("../src/Routes/user_management.php", options);
}

deleteButton.addEventListener("click", async (event) => {
  event.preventDefault();
  deleteUser();
});
