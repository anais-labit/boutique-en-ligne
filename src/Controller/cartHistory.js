const allCarts = document.querySelector("#allCarts");
const paidCarts = document.querySelector("#paidCarts");
const unpaidCarts = document.querySelector("#unpaidCarts");

async function displayAllCarts() {

    const displayAllCartForm = new FormData();

     displayAllCartForm.append("displayHistory", "displayHistory");

     const requestDisplayHistory = {

        method:"POST",
        body: displayAllCartForm
     }

     const searchHistory = await fetch("../src/Routes/cart_management.php", requestDisplayHistory);

     const result = await searchHistory.json();

     for(let i in result) {

        const cartPill = document.createElement("button");
        cartPill.setAttribute("class", "cartPill");
        cartPill.setAttribute("id", `cartPill${result[i].id}`);
        cartPill.value = result[i].id;
        let formatedDate = new Date(result[i].date).toLocaleString("fr-FR", {year:"numeric", month:"numeric", day:"numeric"}) ;
        

        if(result[i].paid == "YES") {
            cartPill.innerHTML = "Commande du " + formatedDate + " - " + result[i].total_amount + "€";
            paidCarts.appendChild(cartPill);
        }
        else {
            cartPill.innerHTML = "Panier du " + formatedDate + " - " + result[i].total_amount + "€";

            unpaidCarts.appendChild(cartPill)
        };

        cartPill.addEventListener("click", () => {readCart(result[i].id)});
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

    const divToAppend = document.querySelector(`#cartPill${id}`);
    divToAppend.innerHTML = "";
    // divToAppend.style.flexDirection = "column"; 
    for(let i in result) {

        const productName = document.createElement("p");
        productName.innerHTML = result[i].name;
        const productQuantity = document.createElement("p");
        productQuantity.innerHTML = result[i].quantity;
        // const productPrice = document.createElement("p");
        // productPrice.innerHTML = result[i].price;
        // const productTotal = document.createElement("p");
        // productTotal.innerHTML = result[i].total;

        divToAppend.appendChild(productName);
        divToAppend.appendChild(productQuantity);



    
    }

}

displayAllCarts();