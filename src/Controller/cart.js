const cartDisplay = document.querySelector('#cart-display');

async function displayCart() {

    const displayCartForm = new FormData();

   displayCartForm.append("displayCart", "displayCart");

   const requestDisplayCart = {

        method:"POST",
        body: displayCartForm
   }

   const searchCart = await fetch("../src/Routes/cart_management.php", requestDisplayCart);

   const result = await searchCart.json();
   
}

displayCart();