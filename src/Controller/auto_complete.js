const field = document.querySelector("#field");
const searchForm = document.querySelector("#searchForm");
// Tableau pour stocker les résultats affichés sous forme de balises "p"
const suggestionsArray = [];
const container = document.querySelector("#searchResult");

field.addEventListener("keyup", async (event) => {
  event.preventDefault();
  let filledField = field.value;

  if (filledField.length != 0) {
    // Envoi d'une requête fetch pour récupérer les résultats de recherche correspondants au texte entré
    fetch("../src/Routes/search.php?field=" + filledField)
      .then((response) => response.json())
      .then((response) => {
        // Suppression des résultats précédemment affichés si le champ de recherche a été vidé
        suggestionsArray.forEach((link) => container.removeChild(link));
        suggestionsArray.length = 0;

        // Création de nouveaux éléments "a" pour afficher les nouveaux résultats de recherche
        response.forEach((result) => {
          const p = document.createElement("p");
          const link = document.createElement("a");
          link.setAttribute("href", "singleCard.php?productId=" + result.id);
          p.textContent = result.product;
          link.appendChild(p);
          container.appendChild(link);
          // Ajout de chaque élément "p" créé dans le tableau "suggestionsArray"
          suggestionsArray.push(link);
        });
      });
  } else {
    // Suppression des résultats affichés si le champ de recherche a été vidé
    suggestionsArray.forEach((link) => container.removeChild(link));
    suggestionsArray.length = 0;
  }
});
