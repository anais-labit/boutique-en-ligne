const productsDiv =  document.querySelector("#productsDiv");
const cartIcon = document.querySelector("#cartIcon");
const headerCartDiv = document.querySelector("#headerCartDiv");
// const cartContainer = document.querySelector("#cartContainer");
const filterDiv = document.querySelector("#filterDiv");
const categoriesFiltersDiv = document.querySelector("#categoriesFiltersDiv")
const subCategoriesFiltersDiv = document.querySelector("#subCategoriesFiltersDiv")
const paginationDiv = document.querySelector("#pagination");
let numberToDisplay = 10;

// headerCartDiv.style.display = "none";

cartIcon.addEventListener("click", showHeaderCart);
// cartIcon.addEventListener("mouseout", hideHeaderCart);
// headerCartDiv.addEventListener("mouseover", showHeaderCart);
// headerCartDiv.addEventListener("mouseout", hideHeaderCart);


//                    Fonction de display des produits (tous les produits, une catégorie, une sous-catégorie)
async function displayAllProducts() {

    const allProductsForm = new FormData();

    allProductsForm.append("displayAllProducts", numberToDisplay);

    const requestAllProductsOptions = {

        method: "POST",
        body:allProductsForm

    }

    const allProducts = await fetch("../src/Routes/product_display.php", requestAllProductsOptions)

    const productList = await allProducts.json()

    rawDisplay(productList);

    const showMoreButton = document.createElement("button");
    showMoreButton.setAttribute("class", "cardButtons");
    showMoreButton.setAttribute("id", "showMoreButton");
    showMoreButton.style.margin = "auto";
    // showMoreButton.style.width = "100%";
    showMoreButton.innerHTML = "Voir plus";
    showMoreButton.addEventListener("click", showMoreProducts);
    paginationDiv.appendChild(showMoreButton);
    
}

async function showMoreProducts() {
    
        numberToDisplay += 10;
    
        const showMoreProductsForm = new FormData();
    
        showMoreProductsForm.append("displayAllProducts", numberToDisplay);
    
        const requestShowMoreProductsOptions = {
    
            method: "POST",
            body:showMoreProductsForm
    
        }
    
        const showMoreProducts = await fetch("../src/Routes/product_display.php", requestShowMoreProductsOptions)
    
        const showMoreProductList = await showMoreProducts.json()
    
        rawDisplay(showMoreProductList);
    
        if(showMoreProductList.length < 10) {
    
            const showMoreButton = document.querySelector("#showMoreButton");
            showMoreButton.style.display = "none";
        }
}

async function displaySingleCategory() {

    productsDiv.innerHTML = "";

    const singleCategoryForm = new FormData();

    singleCategoryForm.append("displaySingleCategory", "displaySingleCategory");
    singleCategoryForm.append("categoryId", this.value);

    const requestsingleCategoryOptions = {

        method: "POST",
        body:singleCategoryForm

    }

    const fetchSingleCategory = await fetch("../src/Routes/product_display.php", requestsingleCategoryOptions)

    const singleCategory = await fetchSingleCategory.json()

    rawDisplay(singleCategory)

    displaySingleSubCategoriesButtons(this.value);

}



async function displaySingleSubCategoryProducts() {

    productsDiv.innerHTML = "";

    const singleSubCategoryForm = new FormData();

    singleSubCategoryForm.append("displaySingleSubCategory", "displaySingleSubCategory");
    singleSubCategoryForm.append("subCategoryId", this.value);

    const requestsingleSubCategoryOptions = {

        method: "POST",
        body:singleSubCategoryForm

    }

    const fetchSingleSubCategory = await fetch("../src/Routes/product_display.php", requestsingleSubCategoryOptions)

    const singleSubCategory = await fetchSingleSubCategory.json()
    
    rawDisplay(singleSubCategory)
}



function rawDisplay(results) {
    // console.log(results);    
        
    for(let i in results) {

        const card = document.createElement("div");
        card.setAttribute("class", "productCards");
        card.setAttribute("id", `card${results[i].id}`);

        const singlePageLink = document.createElement("a");
        singlePageLink.setAttribute("href", `singleCard.php?productId=${results[i].id}`);
        
        const cardImage = document.createElement("img");
        cardImage.setAttribute("src", results[i].image);
        // cardImage.setAttribute("width", "300px");
        // cardImage.setAttribute("height", "300px");
        singlePageLink.appendChild(cardImage);    

        const cardTitle = document.createElement("p");
        cardTitle.setAttribute("class", "cardTitle");
        cardTitle.innerHTML = results[i].product;
        singlePageLink.appendChild(cardTitle);

        const cardWeight = document.createElement("p");
        cardWeight.setAttribute("class", "cardWeight");
        cardWeight.innerHTML = results[i].weight_gr + "g";
        singlePageLink.appendChild(cardWeight)

        // const cardDescription = document.createElement("p");
        // cardDescription.innerHTML = results[i].description;
        // singlePageLink.appendChild(cardDescription);

        const cardPrice =  document.createElement("p");
        cardPrice.setAttribute("class", "cardPrice");
        results[i].price_kg !== null ?
            cardPrice.innerHTML = (results[i].price_kg/=100).toLocaleString("fr-FR", {style:"currency", currency:"EUR"}) + "/kg":
            cardPrice.innerHTML = (results[i].price_unit/=100).toLocaleString("fr-FR", {style:"currency", currency:"EUR"}) + "/unité";
        singlePageLink.appendChild(cardPrice)

        card.appendChild(singlePageLink);
        const addQuantityButton = document.createElement("input");
        addQuantityButton.setAttribute("type", "number");
        addQuantityButton.setAttribute("min", "0");
        addQuantityButton.setAttribute("class", "cardInputs");
        addQuantityButton.setAttribute("placeholder", "Ma quantité");
        addQuantityButton.setAttribute("id", `quantity${results[i].id}`)
        card.appendChild(addQuantityButton);

        const addCartButton =  document.createElement("button");
        addCartButton.setAttribute("class", "cardButtons");
        addCartButton.setAttribute("value", results[i].id);
        addCartButton.innerHTML = "Ajouter";
        addCartButton.addEventListener("click", ()=>{addCart(`#quantity${results[i].id}`, results[i].id)})
        card.appendChild(addCartButton);
 
        productsDiv.appendChild(card);
      
    }
}

// --------------------------------------------------------------------------------------------------------------------------------------

//                    Fonction de display des filtres de catégories et sous-catégories


async function displayCategoriesFilters() {

    const allFiltersForm = new FormData();

    allFiltersForm.append("displayAllFilters", "displayAllFilters");

    const requestAllFiltersOptions = {

        method: "POST",
        body:allFiltersForm

    }

    const allFilters = await fetch("../src/Routes/product_display.php", requestAllFiltersOptions)

    const filtersList = await allFilters.json()

    for(let x in filtersList) {

        const filterButton = document.createElement("button");
        filterButton.setAttribute("class", "filterButtons");
        filterButton.setAttribute("value", filtersList[x].id)
        filterButton.innerHTML = filtersList[x].category
        filterButton.addEventListener("click", displaySingleCategory)

        categoriesFiltersDiv.appendChild(filterButton);

    }
}


async function displaySingleSubCategoriesButtons(id_cat) {

    subCategoriesFiltersDiv.innerHTML = "";

    const subCategoriesForm = new FormData();

    subCategoriesForm.append("displaySubCategoriesButtons", "displaySubCategoriesButtons");
    subCategoriesForm.append("categoryId", id_cat);

    const requestsubCategoriesOptions = {

        method: "POST",
        body:subCategoriesForm

    }

    const fetchsubCategories = await fetch("../src/Routes/product_display.php", requestsubCategoriesOptions)

    const subCategories = await fetchsubCategories.json()

    for(let y in subCategories) {

        const subCategoryButton = document.createElement("button");
        subCategoryButton.setAttribute("class", "subCategoriesButtons");
        subCategoryButton.setAttribute("value", subCategories[y].id);
        subCategoryButton.innerHTML = subCategories[y].sub_category;
        subCategoryButton.addEventListener("click", displaySingleSubCategoryProducts)

        subCategoriesFiltersDiv.appendChild(subCategoryButton);   
    }


}

// --------------------------------------------------------------------------------------------------------------------------------------

//                    Fonction de gestion/affichage du panier

async function addCart(input, id) {

    const addCartForm = new FormData();
    const quantityToAdd = document.querySelector(`${input}`);

    if(quantityToAdd.value == null || quantityToAdd.value == 0 || quantityToAdd.value == "") {
            
            quantityToAdd.style.border = "1px solid red";
            quantityToAdd.placeholder = "Veuillez entrer une quantité";
            // quantityToAdd.style.fontSize = "0.8rem";
    }

    else {

        addCartForm.append("addOneProductToCart", "addOneProductToCart");
        addCartForm.append("productID", id);
        addCartForm.append("quantity", quantityToAdd.value);
    
        addCartrequest = {
            method:"POST",
            body: addCartForm
        }
        
        const productToAdd = await fetch("../src/Routes/cart_management.php", addCartrequest)
    
        const cartUpdate = await productToAdd.json();
    
        if(cartUpdate.success == true) {
    
            displayHeaderCart();
            showCartNumber();
            showConfirmation();
        }

        quantityToAdd.value = "";
        
        if(quantityToAdd.style.border == "1px solid red") {
            quantityToAdd.style.border = "1px solid black";
        }
    }

}

async function fetchHeaderCart() {

   const fetchHeaderCartForm = new FormData();

   fetchHeaderCartForm.append("displayHeaderCart", "displayHeaderCart");

   const requestfetchHeaderCart = {

        method:"POST",
        body: fetchHeaderCartForm
   }

   const searchHeaderCart = await fetch("../src/Routes/cart_management.php", requestfetchHeaderCart);

   const result = await searchHeaderCart.json();

   return result

}


async function displayHeaderCart() {

    const cartList = await fetchHeaderCart();

    if(cartList.empty == true) {
        headerCartDiv.innerHTML = `Votre panier est vide`
        return;
    }
    else if(cartList !== null) {

        headerCartDiv.innerHTML = "";
    
        for(let i in cartList.list) {
    
            const cartLine = document.createElement("p");   
            cartLine.innerHTML= cartList.list[i].name + " x" + cartList.list[i].quantity;
            
            const trashCan = document.createElement("i");
            trashCan.setAttribute("class","fa-regular fa-trash-can");
            trashCan.addEventListener("click", () => {deleteFromCart(cartList.list[i].productId)})
            cartLine.appendChild(trashCan);

            headerCartDiv.appendChild(cartLine);
    
       }
    
       const goToCart = document.createElement("a");
       goToCart.setAttribute("href", "cart.php");
       
       const goToCartButton = document.createElement("button");
       goToCartButton.innerHTML = "Voir mon panier";
    
       goToCart.appendChild(goToCartButton);
       headerCartDiv.appendChild(goToCart);
    }
}

async function deleteFromCart(productId) {

    const deleteFromCartForm = new FormData();

   deleteFromCartForm.append("deleteFromCart", productId);

   const requestDeleteFromCart = {

        method:"POST",
        body: deleteFromCartForm
   }

   const refreshCart = await fetch("../src/Routes/cart_management.php", requestDeleteFromCart);

   const result = await refreshCart.json();

   if(result.success == true) {

       displayHeaderCart();
       showCartNumber();
   }


//    return result
}


function showHeaderCart() {

     headerCartDiv.classList.toggle("showHeaderCart");

}

function hideHeaderCart() {
    headerCartDiv.style.display = "none";

}

async function showCartNumber() {

    const cartNumber = await fetchHeaderCart();
    if(cartNumber.empty == true) {
        cartIcon.innerHTML = "";
        return;
    }
    else if(cartNumber !== null) {

        cartIcon.innerHTML = "";
        cartIcon.innerHTML = cartIcon.innerHTML + " " + cartNumber.count;
    }

}

// --------------------------------------------------------------------------------------------------------------------------------------

function showConfirmation() {
    // Afficher une pop-up de confirmation
    Swal.fire({
      title: "Produit ajouté!",
      icon: "success",
      timer: 2000,
    });
}


if(location.pathname == "/boutique-en-ligne/View/products.php") displayAllProducts() && displayCategoriesFilters();
if(location.pathname !== "/boutique-en-ligne/View/login.php") displayHeaderCart() && showCartNumber();

