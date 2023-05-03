const singleCardDiv =  document.querySelector("#singleCardDiv");
const commentBtn = document.querySelector("#commentButton");
const commentForm = document.querySelector("#commentForm");
const commentsDiv = document.querySelector("#comments");
const ratingDiv = document.querySelector("#rating");


const fullStar = document.createElement("i");
fullStar.setAttribute("class", "fa-solid fa-star");
const emptyStar = document.createElement("i");
emptyStar.setAttribute("class", "fa-regular fa-star");
const halfStar = document.createElement("i");
halfStar.setAttribute("class", "fa-solid fa-star-half-stroke");
let ratingValue = null;

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('productId');


commentBtn.addEventListener("click", sendComment);


async function displayOneProduct() {
    
    

    // const singleProductForm = new FormData();

    // singleProductForm.append("displaySingleCard", "displaySingleCard");

    const singleProduct = await fetch("../src/Routes/product_display.php?productId=" + productId);

    const productInfos = await singleProduct.json()
    // console.log(productInfos);

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

        // const singleCardRate = document.createElement("i");
        const singleCardRate = document.createElement("p");
        for(let i = 1; i <= 5; i++) {    
            const ratingStar = document.createElement("i");
            if(i <= productInfos.rating) {
                ratingStar.setAttribute("class", "fa-solid fa-star");
            }
            else if(i > productInfos.rating) {
                if(i - productInfos.rating <= 0.5) {          
                    ratingStar.setAttribute("class", "fa-solid fa-star-half-stroke");
                    console.log(i - productInfos.rating)
                }
                else {
                    ratingStar.setAttribute("class", "fa-regular fa-star");
                }
            }
            singleCardDiv.appendChild(ratingStar);
        }
        singleCardDiv.appendChild(singleCardRate);
        // console.log(parseInt(productInfos.ratings));

        const singleCardDescription = document.createElement("p");
        singleCardDescription.innerHTML = productInfos.description;
        singleCardDiv.appendChild(singleCardDescription);

        const singleCardPrice =  document.createElement("p");
        singleCardPrice.innerHTML = (productInfos.price/=100).toLocaleString("fr-FR", {style:"currency", currency:"EUR"}) + productInfos.priceType;
        singleCardDiv.appendChild(singleCardPrice)

        for(let i = 1; i <= 5; i++) {

            const fullStar = document.createElement("i");
            fullStar.setAttribute("class", "fa-solid fa-star");
            fullStar.setAttribute("id", `star${i}`)
            fullStar.addEventListener("click", () => {addRating(i)});
            ratingDiv.appendChild(fullStar);
        }
        

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

        const commentText =  document.createElement("p");
        commentText.innerHTML = result[i].comment;

        commentsDiv.appendChild(commentText);
    }

}


async function sendComment(e) {

    e.preventDefault();

    const sendCommentForm = new FormData(commentForm);
    sendCommentForm.append("sendComment", "sendComment");
    sendCommentForm.append("productId", e.target.value);
    sendCommentForm.append("addRating", ratingValue);

    const requestsendCommentOptions = {

        method: "POST",
        body:sendCommentForm

    }

    const sendComment = await fetch("../src/Routes/comments_management.php", requestsendCommentOptions)

    const result = await sendComment.json()

    displayComments();

}

async function addRating(rating) {

    ratingValue = rating;

    if(document.querySelector(`#star${rating}`).getAttribute("class") == "fa-regular fa-star") {
        for(let x = (rating); x >= 1; x--) {
                        
            document.querySelector(`#star${x}`).setAttribute("class", "fa-solid fa-star");
        }
    }

    for(let i = (rating + 1); i <= 5; i++) {
            
            // document.querySelector(`#star${i}`).replaceWith(emptyStar.cloneNode(true));
            
            document.querySelector(`#star${i}`).setAttribute("class", "fa-regular fa-star");
        }
}

displayOneProduct();
displayComments();