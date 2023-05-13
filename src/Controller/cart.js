const cartDisplay = document.querySelector("#cartDisplay");
const cartSubmit = document.querySelector("#cartSubmit");
const paymentForm = document.querySelector("#paymentForm");

cartSubmit.addEventListener("click", submitCart);

async function submitCart() {
     paymentForm.style.display = "flex";
     cartDisplay.style.display = "none";
}

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

          const productLine = document.createElement("div");

          const productImg = document.createElement("img");
          productImg.setAttribute("src", result.list[i].image);
          productImg.style.width = "80px";
          productLine.appendChild(productImg);

          const productName = document.createElement("p");
          productName.innerHTML = result.list[i].name;
          productLine.appendChild(productName);

          const productQuantity = document.createElement("p");
          productQuantity.innerHTML = result.list[i].quantity;
          productLine.appendChild(productQuantity);

          const productPrice = document.createElement("p");
          productPrice.innerHTML = parseInt((result.list[i].price / 100) * result.list[i].quantity) + "€";
          productLine.appendChild(productPrice)

          minusButton = document.createElement("i");
          minusButton.setAttribute("class", "fa-solid fa-minus");
          minusButton.addEventListener("click", () => {removeQuantity(result.list[i].productId)})
          productLine.appendChild(minusButton);

          plusButton = document.createElement("i");
          plusButton.setAttribute("class", "fa-solid fa-plus");
          plusButton.addEventListener("click", () => {addQuantity(result.list[i].productId)});
          productLine.appendChild(plusButton);

          const trashCan = document.createElement("i");
          trashCan.setAttribute("class","fa-regular fa-trash-can");
          trashCan.addEventListener("click", () => {deleteFromCart(result.list[i].productId)})
          productLine.appendChild(trashCan);

          productLine.style.width = "100%";
          productLine.style.display = "flex";
          productLine.style.justifyContent = "space-around";

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


async function deleteFromCart(productId) {

     const deleteFromCartForm = new FormData();

     deleteFromCartForm.append("deleteFromCart", productId);

     const requestDeleteFromCart = {

         method:"POST",
         body: deleteFromCartForm
     }

    const refreshCart = await fetch("../src/Routes/cart_management.php", requestDeleteFromCart);

    const result = await refreshCart.json();

//     if(result.success == true) {
     // cartDisplay.removeChild(all);
          console.log("ok");
          displayCart()
//     }
//     return result
 }

displayCart();