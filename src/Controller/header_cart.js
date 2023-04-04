const cartIcon = document.querySelector("#cartIcon");
const headerCartDiv = document.querySelector("#headerCartDiv");
const test = document.querySelector("#test");

cartIcon.addEventListener("mouseover", displayHeaderCart);
// cartIcon.addEventListener("mouseout", hideHeaderCart);

// cartIcon.onmouseover = displayHeaderCart
// cartIcon.onmouseout = hideHeaderCart

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

function hideHeaderCart() {
    headerCartDiv.innerHTML = "";
    // headerCartDiv.removeChild();
    // test.removeChild(headerCartDiv);

}

async function showCartNumber() {

    const cartNumber = await fetchHeaderCart();

    cartIcon.innerHTML = cartIcon.innerHTML + " " + cartNumber.count

}

showCartNumber();   


// cartIcon.innerHTML = cartIcon.innerHTML + 1