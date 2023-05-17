const singleCardPicture = document.querySelector("#singleCardPicture");
const singleCardContent = document.querySelector("#singleCardContent");
const commentBtn = document.querySelector("#commentButton");
const commentForm = document.querySelector("#commentForm");
const ratingDiv = document.querySelector("#rating");
const commentsDiv = document.querySelector("#comments");
const commentInput = document.querySelector("#commentInput");

let ratingValue = null;

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get("productId");

commentBtn?.addEventListener("click", sendComment);

async function displayOneProduct() {
  const singleProduct = await fetch(
    "../src/Routes/product_display.php?productId=" + productId
  );

  const productInfos = await singleProduct.json();

  const singleCardTitle = document.createElement("p");
  singleCardTitle.setAttribute("id", "singleCardTitle");
  singleCardTitle.innerHTML = productInfos.name;
  singleCardContent.appendChild(singleCardTitle);

  const singleCardImage = document.createElement("img");
  singleCardImage.setAttribute("src", productInfos.image);
  singleCardImage.setAttribute("width", "300px");
  singleCardImage.setAttribute("height", "300px");
  singleCardPicture.appendChild(singleCardImage);

  const ratingSection = document.createElement("a");
  ratingSection.setAttribute("href", "#comments");
  ratingSection.setAttribute("id", "ratingSection");

  const productCommentsNumber = document.createElement("p");
  productCommentsNumber.setAttribute("id", "productCommentsNumber");
  productCommentsNumber.innerHTML = productInfos.commentsNumber + " avis";

  ratingSection.appendChild(productCommentsNumber);

  const productRating = document.createElement("div");
  productRating.setAttribute("id", "productRating");

  for (let i = 1; i <= 5; i++) {
    const ratingStar = document.createElement("i");
    if (i <= productInfos.rating) {
      ratingStar.setAttribute("class", "fa-solid fa-star");
    } else if (i > productInfos.rating) {
      if (i - productInfos.rating <= 0.5) {
        ratingStar.setAttribute("class", "fa-solid fa-star-half-stroke");
      } else {
        ratingStar.setAttribute("class", "fa-regular fa-star");
      }
    }
    productRating.appendChild(ratingStar);
    ratingSection.appendChild(productRating);
  }

  singleCardContent.appendChild(ratingSection);

  const singleCardDescription = document.createElement("p");
  singleCardDescription.setAttribute("id", "singleCardDescription");
  singleCardDescription.innerHTML = productInfos.description;
  singleCardContent.appendChild(singleCardDescription);

  const singleCardPrice = document.createElement("p");
  singleCardPrice.setAttribute("id", "singleCardPrice");
  singleCardPrice.innerHTML =
    (productInfos.price /= 100).toLocaleString("fr-FR", {
      style: "currency",
      currency: "EUR",
    }) + productInfos.priceType;
  singleCardContent.appendChild(singleCardPrice);

  for (let i = 1; i <= 5; i++) {
    const fullStar = document.createElement("i");
    fullStar.setAttribute("class", "fa-solid fa-star");
    fullStar.setAttribute("id", `star${i}`);
    fullStar.addEventListener("click", () => {
      addRating(i);
    });
    ratingDiv.appendChild(fullStar);
  }

  const addQuantityInput = document.createElement("input");
  addQuantityInput.setAttribute("type", "number");
  addQuantityInput.setAttribute("id", `quantityInput`);
  addQuantityInput.setAttribute("min", "1");
  addQuantityInput.setAttribute("placeholder", "Ma quantité");
  singleCardContent.appendChild(addQuantityInput);

  const addCartButton = document.createElement("button");
  addCartButton.setAttribute("id", "addCartButton");
  addCartButton.setAttribute("value", productInfos.id);
  addCartButton.innerHTML = "Ajouter au panier";
  addCartButton.addEventListener("click", () => {
    addCart("#quantityInput", productId);
  });
  singleCardContent.appendChild(addCartButton);
}

async function displayComments() {
  // commentsDiv.textContent = "";
  commentsDiv.innerHTML = "";
  // while (commentsDiv.firstChild) {
  //     // commentsDiv.removeChild(commentsDiv.lastChild);
  //     comcommentInputmentsDiv.firstChild.remove()
  //   }

  const displayCommentsForm = new FormData();
  displayCommentsForm.append("displayComments", productId);
  // displayCommentsForm.append("productId");

  const requestdisplayCommentsOptions = {
    method: "POST",
    body: displayCommentsForm,
  };

  const displayComments = await fetch(
    "../src/Routes/comments_management.php",
    requestdisplayCommentsOptions
  );

  const result = await displayComments.json();

  console.log(result);

  for (let i in result) {
    const commentLine = document.createElement("div");
    commentLine.setAttribute("id", `commentLine${i}`);
    commentLine.setAttribute("class", `commentLine`);

    const commentInfos = document.createElement("div");
    commentInfos.setAttribute("class", `commentInfos`);

    const commentContent = document.createElement("div");
    commentContent.setAttribute("class", `commentContent`);

    const userAvatar = document.createElement("img");
    userAvatar.setAttribute("src", result[i].user_avatar);
    userAvatar.setAttribute("width", "50px");
    userAvatar.setAttribute("height", "50px");
    commentInfos.appendChild(userAvatar);

    const userName = document.createElement("p");
    userName.innerHTML = result[i].user_first_name;
    commentInfos.appendChild(userName);

    const userRating = document.createElement("p");
    userRating.innerHTML = "Note : " + result[i].rate + "/5";
    commentInfos.appendChild(userRating);

    const commentDate = document.createElement("p");
    let formatedDate = new Date(result[i].date).toLocaleString("fr-FR", {
      year: "numeric",
      month: "numeric",
      day: "numeric",
    });
    commentDate.innerHTML = "publié le " + formatedDate;
    commentInfos.appendChild(commentDate);

    commentLine.appendChild(commentInfos);

    const commentText = document.createElement("p");
    commentText.innerHTML = result[i].comment;
    commentContent.appendChild(commentText);

    commentLine.appendChild(commentContent);

    commentsDiv.appendChild(commentLine);
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
    body: sendCommentForm,
  };

  const sendComment = await fetch(
    "../src/Routes/comments_management.php",
    requestsendCommentOptions
  );

  const result = await sendComment.json();

  // if(result) commentInput.value = "";

  displayComments();
}

async function addRating(rating) {
  ratingValue = rating;

  if (
    document.querySelector(`#star${rating}`).getAttribute("class") ==
    "fa-regular fa-star"
  ) {
    for (let x = rating; x >= 1; x--) {
      document
        .querySelector(`#star${x}`)
        .setAttribute("class", "fa-solid fa-star");
    }
  }

  for (let i = rating + 1; i <= 5; i++) {
    document
      .querySelector(`#star${i}`)
      .setAttribute("class", "fa-regular fa-star");
  }
}

displayOneProduct();
displayComments();
