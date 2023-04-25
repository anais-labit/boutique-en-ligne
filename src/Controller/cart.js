const cartDisplay = document.querySelector('#cartDisplay');

async function displayCart() {

     cartDisplay.innerHTML = "";

     const displayCartForm = new FormData();

     displayCartForm.append("displayCart", "displayCart");

     const requestDisplayCart = {

        method:"POST",
        body: displayCartForm
     }

     const searchCart = await fetch("../src/Routes/cart_management.php", requestDisplayCart);

     const result = await searchCart.json();

     for(let i in result.list) {

          productLine = document.createElement('p');
          productLine.innerHTML = result.list[i].name + " " + result.list[i].quantity + result.list[i].priceType;

          minusButton = document.createElement("i");
          minusButton.setAttribute("class", "fa-solid fa-minus");
          minusButton.addEventListener("click", () => {removeQuantity(result.list[i].productId)})
          productLine.appendChild(minusButton);

          plusButton = document.createElement("i");
          plusButton.setAttribute("class", "fa-solid fa-plus");
          plusButton.addEventListener("click", () => {addQuantity(result.list[i].productId)});
          productLine.appendChild(plusButton);

          cartDisplay.appendChild(productLine);
     }
   
}

async function addQuantity(id) {

     const addQuantityForm = new FormData();

     addQuantityForm.append("addQuantity", id);

     const requestAddQuantity = {

        method:"POST",
        body: addQuantityForm
     }

     const updateQuantity = await fetch("../src/Routes/cart_management.php", requestAddQuantity);

     displayCart();
}

async function removeQuantity(id) {

     const removeQuantityForm = new FormData();

     removeQuantityForm.append("removeQuantity", id);

     const requestRemoveQuantity = {

        method:"POST",
        body: removeQuantityForm
     }

     const updateQuantity = await fetch("../src/Routes/cart_management.php", requestRemoveQuantity);

     displayCart();
}

displayCart();