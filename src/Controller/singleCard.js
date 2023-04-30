const singleCardDiv =  document.querySelector("#singleCardDiv");


async function displayOneProduct() {
    
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('productId');

    // const singleProductForm = new FormData();

    // singleProductForm.append("displaySingleCard", "displaySingleCard");

    const singleProduct = await fetch("../src/Routes/product_display.php?productId=" + productId);

    const productInfos = await singleProduct.json()

        const singleCard = document.createElement("div");
        singleCard.setAttribute("class", "SingleProductCard");

        const singleCardImage = document.createElement("img");
        singleCardImage.setAttribute("src", productInfos.image);
        singleCardImage.setAttribute("width", "300px");
        singleCardImage.setAttribute("height", "300px");
        singleCardDiv.appendChild(singleCardImage);

        const singleCardTitle = document.createElement("p");
        singleCardTitle.innerHTML = productInfos.name;
        singleCardDiv.appendChild(singleCardTitle);

        const singleCardDescription = document.createElement("p");
        singleCardDescription.innerHTML = productInfos.description;
        singleCardDiv.appendChild(singleCardDescription);

        const singleCardPrice =  document.createElement("p");
        singleCardPrice.innerHTML = (productInfos.price/=100).toLocaleString("fr-FR", {style:"currency", currency:"EUR"}) + productInfos.priceType;
        singleCardDiv.appendChild(singleCardPrice)

        // const addQuantityButton = document.createElement("input");
        // addQuantityButton.setAttribute("type", "number");
        // addQuantityButton.setAttribute("id", `quantity${productInfos.id}`)
        // singleCardDiv.appendChild(addQuantityButton);

        // const addCartButton =  document.createElement("button");
        // addCartButton.setAttribute("value", productInfos.id);
        // addCartButton.innerHTML = "Ajouter";
        // addCartButton.addEventListener("click", addCart)
        // singleCardDiv.appendChild(addCartButton);

        // singleCardDiv.appendChild(singleCard);
    
    
}

displayOneProduct();