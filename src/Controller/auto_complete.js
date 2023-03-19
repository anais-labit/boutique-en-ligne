const field = document.querySelector("#field");
const searchForm = document.querySelector("#searchForm");
// Tableau pour stocker les résultats affichés sous forme de balises "p"
const suggestionsArray = [];

field.addEventListener("keyup", async (event) => {
  event.preventDefault();
  let filledField = field.value;

  if (filledField.length != 0) {
    // Envoi d'une requête fetch pour récupérer les résultats de recherche correspondants au texte entré
    fetch("../src/Routes/search.php?field=" + filledField)
      .then((response) => response.json())
      .then((response) => {
        // Suppression des résultats précédemment affichés si le champ de recherche a été vidé
        suggestionsArray.forEach((p) => searchForm.removeChild(p));
        suggestionsArray.length = 0;

        // Création de nouveaux éléments "p" pour afficher les nouveaux résultats de recherche
        response.forEach((result) => {
          const p = document.createElement("p");
          p.textContent = result.nom;
          searchForm.appendChild(p);
          // Ajout de chaque élément "p" créé dans le tableau "suggestionsArray"
          suggestionsArray.push(p);
        });
      });
  } else {
    // Suppression des résultats affichés si le champ de recherche a été vidé
    suggestionsArray.forEach((p) => searchForm.removeChild(p));
    suggestionsArray.length = 0;
  }
});
