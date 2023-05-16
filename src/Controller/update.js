const updateForm = document.querySelector("#updateForm");
const updateButton = document.querySelector("#updateButton");
const deleteForm = document.querySelector("#deleteForm");
const deleteButton = document.querySelector("#deleteButton");

async function updateSelf() {
  const reqUpdate = new FormData(updateForm);

  console.log(updateForm);
  reqUpdate.append("updateProfile", "updateProfile");

  console.log(reqUpdate);

  const options = {
    method: "POST",
    body: reqUpdate,
  };

  const updateUser = await fetch("../src/Routes/user_management.php", options);
  const msg = await updateUser.json();
  console.log(msg.errors);

  document.querySelector("#msgContainer");
  // let msg = document.createElement('p');
  if (msg.errors) {
    msgContainer.innerHTML = msg.errors;
  } else {
    msgContainer.innerHTML = msg.success;
  }
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

  const msg = await deleteUser.json();
  document.querySelector("#msgContainer");
  if (msg.error) {
    msgContainer.innerHTML = msg.error;
  } else {
    msgContainer.innerHTML = msg.success;
  }
}

deleteButton.addEventListener("click", async (event) => {
  event.preventDefault();
  deleteSelf();
});
