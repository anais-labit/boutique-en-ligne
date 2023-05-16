const allCarts = document.querySelector("#allCarts");

async function displayAllCarts() {

    const displayAllCartForm = new FormData();

     displayAllCartForm.append("displayHistory", "displayHistory");

     const requestDisplayHistory = {

        method:"POST",
        body: displayAllCartForm
     }

     const searchHistory = await fetch("../src/Routes/cart_management.php", requestDisplayHistory);

     const result = await searchHistory.json();

     console.log(result);

     for(let i in result) {

        const cartPill = document.createElement("div");
        cartPill.setAttribute("class", "cartPill");
        cartPill.setAttribute("id", `cartPill${result[i].id}`);

        const cartPillTitle = document.createElement("p");
        cartPillTitle.setAttribute("class", "cartPillTitle");
        let formatedDate = new Date(result[i].date).toLocaleString("fr-FR", {year:"numeric", month:"numeric", day:"numeric"});
        

        if(result[i].paid == "YES") {
            cartPill.style.backgroundColor = "green";
            cartPillTitle.innerHTML = "Panier validé le " + formatedDate + " - " + result[i].total_amount + "€";
            cartPill.appendChild(cartPillTitle);
        }
        else {
            cartPill.style.backgroundColor = "sienna";
            cartPillTitle.innerHTML = "Panier en cours datant du " + formatedDate + " - " + result[i].total_amount + "€";
            cartPill.appendChild(cartPillTitle);
        };

        const cartPillButton = document.createElement("button");
        cartPillButton.setAttribute("class", "cartPillButton");
        cartPillButton.setAttribute("id", `cartPillButton${result[i].id}`);
        cartPillButton.innerHTML = "Voir le détail";
        cartPillButton.value = result[i].id;
        cartPill.appendChild(cartPillButton);

        cartPillButton.addEventListener("click", () => showCartContent(result[i].id));
        allCarts.appendChild(cartPill);

        readCart(result[i].id);
     }

}

async function readCart(id) {

    const getOneCartForm = new FormData();

    getOneCartForm.append("readOneCart", id);

    const requestDisplayOneCart = {

    method:"POST",
    body: getOneCartForm
    }

    const searchOneCart = await fetch("../src/Routes/cart_management.php", requestDisplayOneCart);

    const result = await searchOneCart.json();

    const cardContent = document.createElement("div");
    cardContent.setAttribute("class", "cardContent");
    cardContent.setAttribute("id", `cardContent${id}`);

    const divToAppend = document.querySelector(`#cartPill${id}`);

    for(let i in result) {

        const productInfo = document.createElement("div");
        productInfo.setAttribute("class", "productInfo");

        const productName = document.createElement("p");
        productName.innerHTML = result[i].name;
        productInfo.appendChild(productName);

        const productQuantity = document.createElement("p");
        productQuantity.innerHTML = "X " + result[i].quantity;
        productInfo.appendChild(productQuantity);

        cardContent.appendChild(productInfo);
        divToAppend.appendChild(cardContent);
    }

    const resetCartButton = document.createElement("button");
    resetCartButton.setAttribute("class", "resetCartButton");
    resetCartButton.setAttribute("id", `resetCartButton${id}`);
    resetCartButton.innerHTML = "Refaire mon panier";
    resetCartButton.value = id;
    resetCartButton.addEventListener("click", () => resetCart(id));
    cardContent.appendChild(resetCartButton);
}

function showCartContent(id) {

    const contentToDisplay = document.querySelector(`#cardContent${id}`);
    contentToDisplay.classList.toggle("showCartContent");

    const buttonToChange = document.querySelector(`#cartPillButton${id}`);
    if(buttonToChange.innerHTML == "Voir le détail") {
        buttonToChange.innerHTML = "Masquer";
    }
    else {
        buttonToChange.innerHTML = "Voir le détail";
    }
}

async function resetCart(id) {
    
        const resetCartForm = new FormData();
    
        resetCartForm.append("resetCart", id);
    
        const requestResetCart = {
    
            method:"POST",
            body: resetCartForm
        }
    
        const setCart = await fetch("../src/Routes/cart_management.php", requestResetCart)
        const response = await setCart.json();
        if(response.success == true) {

            displayHeaderCart();
            showCartNumber();
            alert(response.message);
            
            // window.location.reload();
        }
}

displayAllCarts();