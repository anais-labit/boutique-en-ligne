const singleCardDiv =  document.querySelector("#singleCardDiv");
const commentBtn = document.querySelector("#commentButton");
const commentForm = document.querySelector("#commentForm");
const commentsDiv = document.querySelector("#comments");

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('productId');


commentBtn.addEventListener("click", sendComment);


async function displayOneProduct() {
    
    

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
    
        // displayComments();
}

async function displayComments() {

    // commentsDiv.textContent = "";
    commentsDiv.innerHTML = "";
    // while (commentsDiv.firstChild) {
    //     // commentsDiv.removeChild(commentsDiv.lastChild);
    //     commentsDiv.firstChild.remove()
    //   }

    const displayCommentsForm = new FormData();
    displayCommentsForm.append("displayComments", productId);
    // displayCommentsForm.append("productId");

    const requestdisplayCommentsOptions = {

        method: "POST",
        body:displayCommentsForm

    }

    const displayComments = await fetch("../src/Routes/comments_management.php", requestdisplayCommentsOptions)

    const result = await displayComments.json()

    for(let i  in result) {

        const comment =  document.createElement("div");
        comment.innerHTML = result[i].comment;

        commentsDiv.appendChild(comment);
    }

}


async function sendComment(e) {

    e.preventDefault();

    const sendCommentForm = new FormData(commentForm);
    sendCommentForm.append("sendComment", "sendComment");
    sendCommentForm.append("productId", e.target.value);

    const requestsendCommentOptions = {

        method: "POST",
        body:sendCommentForm

    }

    const sendComment = await fetch("../src/Routes/comments_management.php", requestsendCommentOptions)

    const result = await sendComment.json()

    displayComments();

}

displayOneProduct();
displayComments();