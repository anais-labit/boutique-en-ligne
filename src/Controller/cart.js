const productsDiv =  document.querySelector("#productsDiv");
const cartIcon = document.querySelector("#cartIcon");
const headerCartDiv = document.querySelector("#headerCartDiv");
const cartContainer = document.querySelector("#cartContainer");
const filterDiv = document.querySelector("#filterDiv");
const categoriesFiltersDiv = document.querySelector("#categoriesFiltersDiv")
const subCategoriesFiltersDiv = document.querySelector("#subCategoriesFiltersDiv")

headerCartDiv.style.display = "none";

cartContainer.addEventListener("mouseover", showHeaderCart);
cartContainer.addEventListener("mouseout", hideHeaderCart);

async function displayAllProducts() {
    const allProductsForm = new FormData();

    allProductsForm.append("displayAllProducts", "displayAllProducts");

    const requestAllProductsOptions = {

        method: "POST",
        body:allProductsForm

    }

    const allProducts = await fetch("../src/Routes/product_display.php", requestAllProductsOptions)

    const productList = await allProducts.json()

    for(let i in productList) {

        const card = document.createElement("div");
        card.setAttribute("class", "productCards");
        card.setAttribute("id", `card${productList[i].id}`);

        const cardImage = document.createElement("img");
        cardImage.setAttribute("src", productList[i].image);
        cardImage.setAttribute("width", "300px");
        cardImage.setAttribute("height", "300px");
        card.appendChild(cardImage);

        const cardTitle = document.createElement("p");
        cardTitle.innerHTML = productList[i].product;
        card.appendChild(cardTitle);

        const cardDescription = document.createElement("p");
        cardDescription.innerHTML = productList[i].description;
        card.appendChild(cardDescription);

        const cardPrice =  document.createElement("p");
        productList[i].price_kg !== null ?
            cardPrice.innerHTML = (productList[i].price_kg/=100).toLocaleString("fr-FR", {style:"currency", currency:"EUR"}) + "/kg":
            cardPrice.innerHTML = (productList[i].price_unit/=100).toLocaleString("fr-FR", {style:"currency", currency:"EUR"}) + "/unité";
        card.appendChild(cardPrice)

        const addQuantityButton = document.createElement("input");
        addQuantityButton.setAttribute("type", "number");
        addQuantityButton.setAttribute("id", `quantity${productList[i].id}`)
        card.appendChild(addQuantityButton);

        const addCartButton =  document.createElement("button");
        addCartButton.setAttribute("value", productList[i].id);
        addCartButton.innerHTML = "Ajouter";
        addCartButton.addEventListener("click", addCart)
        card.appendChild(addCartButton);

        productsDiv.appendChild(card);
      
    }
    
}

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

async function displaySingleCategory() {

    // ev.preventDefault();
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
    
    for(let x in singleCategory) {

        const card = document.createElement("div");
        card.setAttribute("class", "productCards");
        card.setAttribute("id", `card${singleCategory[x].id}`);

        const cardImage = document.createElement("img");
        cardImage.setAttribute("src", singleCategory[x].image);
        cardImage.setAttribute("width", "300px");
        cardImage.setAttribute("height", "300px");
        card.appendChild(cardImage);

        const cardTitle = document.createElement("p");
        cardTitle.innerHTML = singleCategory[x].product;
        card.appendChild(cardTitle);

        const cardDescription = document.createElement("p");
        cardDescription.innerHTML = singleCategory[x].description;
        card.appendChild(cardDescription);

        const cardPrice =  document.createElement("p");
        singleCategory[x].price_kg !== null ?
            cardPrice.innerHTML = (singleCategory[x].price_kg/=100).toLocaleString("fr-FR", {style:"currency", currency:"EUR"}) + "/kg":
            cardPrice.innerHTML = (singleCategory[x].price_unit/=100).toLocaleString("fr-FR", {style:"currency", currency:"EUR"}) + "/unité";
        card.appendChild(cardPrice)

        const addQuantityButton = document.createElement("input");
        addQuantityButton.setAttribute("type", "number");
        addQuantityButton.setAttribute("id", `quantity${singleCategory[x].id}`)
        card.appendChild(addQuantityButton);

        const addCartButton =  document.createElement("button");
        addCartButton.setAttribute("value", singleCategory[x].id);
        addCartButton.innerHTML = "Ajouter";
        addCartButton.addEventListener("click", addCart)
        card.appendChild(addCartButton);

        productsDiv.appendChild(card);
      
    }

    displaySingleSubCategoriesButtons(this.value);

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



async function displaySingleSubCategoryProducts() {

    // ev.preventDefault();
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
    
    for(let x in singleSubCategory) {

        const card = document.createElement("div");
        card.setAttribute("class", "productCards");
        card.setAttribute("id", `card${singleSubCategory[x].id}`);

        const cardImage = document.createElement("img");
        cardImage.setAttribute("src", singleSubCategory[x].image);
        cardImage.setAttribute("width", "300px");
        cardImage.setAttribute("height", "300px");
        card.appendChild(cardImage);

        const cardTitle = document.createElement("p");
        cardTitle.innerHTML = singleSubCategory[x].product;
        card.appendChild(cardTitle);

        const cardDescription = document.createElement("p");
        cardDescription.innerHTML = singleSubCategory[x].description;
        card.appendChild(cardDescription);

        const cardPrice =  document.createElement("p");
        singleSubCategory[x].price_kg !== null ?
            cardPrice.innerHTML = (singleSubCategory[x].price_kg/=100).toLocaleString("fr-FR", {style:"currency", currency:"EUR"}) + "/kg":
            cardPrice.innerHTML = (singleSubCategory[x].price_unit/=100).toLocaleString("fr-FR", {style:"currency", currency:"EUR"}) + "/unité";
        card.appendChild(cardPrice)

        const addQuantityButton = document.createElement("input");
        addQuantityButton.setAttribute("type", "number");
        addQuantityButton.setAttribute("id", `quantity${singleSubCategory[x].id}`)
        card.appendChild(addQuantityButton);

        const addCartButton =  document.createElement("button");
        addCartButton.setAttribute("value", singleSubCategory[x].id);
        addCartButton.innerHTML = "Ajouter";
        addCartButton.addEventListener("click", addCart)
        card.appendChild(addCartButton);

        productsDiv.appendChild(card);
      
    }

}

async function addCart() {

    const addCartForm = new FormData();
    const quantityToAdd = document.querySelector(`#quantity${this.value}`);


    addCartForm.append("addOneProductToCart", "addOneProductToCart");
    addCartForm.append("productID", this.value);
    addCartForm.append("quantity", quantityToAdd.value);

    addCartrequest = {
        method:"POST",
        body: addCartForm
    }
    
    const productToAdd = await fetch("../src/Routes/cart_management.php", addCartrequest)

    const cartUpdate = await productToAdd.json();

    if(cartUpdate.success == "true") {

        displayHeaderCart();
        showCartNumber();
    }
}


async function fetchHeaderCart() {

   const fetchHeaderCartForm = new FormData();

   fetchHeaderCartForm.append("displayHeaderCart", "displayHeaderCart");

   const requestfetchHeaderCart = {

        method:"POST",
        body: fetchHeaderCartForm
   }

   const searchHeaderCart = await fetch("/boutique-en-ligne/src/Routes/cart_management.php", requestfetchHeaderCart);

   const result = await searchHeaderCart.json();

//    console.log(result);

   return result

}

async function displayHeaderCart() {

    const cartList = await fetchHeaderCart();

    if(cartList !== null) {

        headerCartDiv.innerHTML = "";
    
        for(let i in cartList.list) {
    
            const cartLine = document.createElement("p");
    
            cartLine.innerHTML= cartList.list[i].name + " " + cartList.list[i].quantity;
    
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


function showHeaderCart() {

    headerCartDiv.style.display = "block";
    // headerCartDiv.style.position = "fixed"

}

function hideHeaderCart() {
    headerCartDiv.style.display = "none";

}

async function showCartNumber() {

    const cartNumber = await fetchHeaderCart();
    cartIcon.innerHTML = "";
    cartIcon.innerHTML = cartIcon.innerHTML + " " + cartNumber.count;

}


if(location.pathname == "/View/products.php") displayAllProducts() && displayCategoriesFilters();
showCartNumber();
displayHeaderCart();

