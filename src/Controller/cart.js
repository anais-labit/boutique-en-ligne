
const productsDiv =  document.querySelector("#productsDiv");
const cartIcon = document.querySelector("#cartIcon");
const headerCartDiv = document.querySelector("#headerCartDiv");
const cartContainer = document.querySelector("#cartContainer");

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

        const cardTitle = document.createElement("p");
        cardTitle.innerHTML = productList[i].product;
        card.appendChild(cardTitle);

        const cardDescription = document.createElement("p");
        cardDescription.innerHTML = productList[i].description;
        card.appendChild(cardDescription);

        const cardPrice =  document.createElement("p");
        productList[i].price_kg !== null ?
            cardPrice.innerHTML = productList[i].price_kg + " €/kg":
            cardPrice.innerHTML = productList[i].price_unit + " €/unité";
        card.appendChild(cardPrice)

        const addCartButton =  document.createElement("button");
        addCartButton.setAttribute("value", productList[i].id);
        addCartButton.innerHTML = "Ajouter";
        addCartButton.addEventListener("click", addCart)
        card.appendChild(addCartButton);

        productsDiv.appendChild(card);
      
    }
    
}


async function addCart() {

    const addCartForm = new FormData();

    addCartForm.append("addOneProductToCart", "addOneProductToCart");
    addCartForm.append("productID", this.value);

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

   const searchHeaderCart = await fetch("../src/Routes/cart_management.php", requestfetchHeaderCart);

   const result = await searchHeaderCart.json();

   console.log(result[0]);

   return result

}

async function displayHeaderCart() {

    const cartList = await fetchHeaderCart();

    headerCartDiv.innerHTML = "";

    for(let i in cartList.result) {

        const cartLine = document.createElement("p");

        cartLine.innerHTML= cartList.result[i];

        headerCartDiv.appendChild(cartLine);

       

   }

   const goToCart = document.createElement("a");
   goToCart.setAttribute("href", "cart.php");
   
   const goToCartButton = document.createElement("button");
   goToCartButton.innerHTML = "Voir mon panier";

   goToCart.appendChild(goToCartButton);
   headerCartDiv.appendChild(goToCart);
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

displayAllProducts();
showCartNumber();
displayHeaderCart();


// cartIcon.innerHTML = cartIcon.innerHTML + 1