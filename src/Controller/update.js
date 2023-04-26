const updateForm = document.querySelector("#updateForm");
const updateType = document.querySelector("#updateType");
const updateLabelFirstName = document.querySelector("#updateLabelFirstName");
// const updateLabelAvatar = document.querySelector("#updateLabelAvatar");
const updateFirstName = document.querySelector("#updateFirstName");
const updateLabelLastName = document.querySelector("#updateLabelLastName");
const updateLastName = document.querySelector("#updateLastName");
const updateAddress = document.querySelector("#updateAddress");
const updateZipCode = document.querySelector("#updateZipCode");
const updateCity = document.querySelector("#updateCity");

const updateLabelCompany = document.querySelector("#updateLabelCompany");
const updateCompany = document.querySelector("#updateCompany");
const updateEmail = document.querySelector("#updateEmail");
const updatePassword = document.querySelector("#updatePassword");
const updateConfirmPassword = document.querySelector("#updateConfirmPassword");
const updateButton = document.querySelector("#updateButton");
const updateMessage = document.createElement("p");


async function update() {
  const reqUpdate = new FormData(updateForm);
  reqUpdate.append("updateProfile", "updateProfile");

  const options = {
    method: "POST",
    body: reqUpdate,
  };

  const update = await fetch("../src/Routes/user_management.php", options);
  // const results = await update.json();
}

console.log(updateForm);

updateButton.addEventListener("click", async (event) => {
  event.preventDefault();
  update();
});
