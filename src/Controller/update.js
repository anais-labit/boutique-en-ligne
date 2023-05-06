const updateForm = document.querySelector("#updateForm");
const updateButton = document.querySelector("#updateButton");
const deleteForm = document.querySelector("#deleteForm");
const deleteButton = document.querySelector("#deleteButton");

async function updateSelf() {
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
  updateSelf();
});

async function deleteSelf() {
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
  deleteSelf();
});
