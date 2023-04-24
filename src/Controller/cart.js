const cartDisplay = document.querySelector('#cartDisplay');

async function displayCart() {

    const displayCartForm = new FormData();

   displayCartForm.append("displayCart", "displayCart");

   const requestDisplayCart = {

        method:"POST",
        body: displayCartForm
   }

   const searchCart = await fetch("../src/Routes/cart_management.php", requestDisplayCart);

   const result = await searchCart.json();
   console.log(result.list);
   for(let i in result.list) {

     productLine = document.createElement('p');
     productLine.innerHTML = result.list[i].name + " " + result.list[i].quantity;
     cartDisplay.appendChild(productLine);
     }
   
}

displayCart();