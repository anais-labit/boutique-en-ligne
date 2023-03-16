const field = document.querySelector("#field");


field.addEventListener("keyup", async (event) => {
  event.preventDefault();
  let filledField = field.value;
//   console.log(filledField);

  if (filledField.length != 0) {
    fetch("../src/Controller/search.php?field=" + filledField)
      .then((response) => response.json())
      .then((response) => {
        console.log(response)
      }); 
  } 
});
