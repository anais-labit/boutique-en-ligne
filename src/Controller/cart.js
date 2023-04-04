
const productsDiv =  document.querySelector("#productsDiv");

async function displayAllProducts() {

    const requestOptions = {

        method: "GET"

    }

    const allProducts = await fetch("../src/Routes/product_display.php", requestOptions)

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

    addrequest = {
        method:"POST",
        body:addCartForm
    }
    
    const productToAdd = await fetch("../src/Routes/product_management.php", addrequest)

    const cartUpdate = await productToAdd.json();

    // alert(cartUpdate.message);

    // addCartForm.append("")
}

displayAllProducts();