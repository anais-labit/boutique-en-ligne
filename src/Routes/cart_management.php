<?php

// require_once '../Model/ProductModel.php';

use App\Model\CartModel;
use App\Model\ProductModel;
// use App\Model\UserModel;


is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

// require_once '../../vendor/autoload.php';
require_once ROOT_DIR . '/vendor/autoload.php';

if (session_id() == "") session_start();


if (isset($_POST['displayHeaderCart']) || isset($_POST['displayCart'])) {

    if(!empty($_SESSION['cart'])) {

        $cart = new CartModel();
        $productListForJs = [];
        $count = 0;
    
        foreach ($_SESSION['cart'] as $index => $product) {
    
            $infos = [
                "name" => $product->getName(),
                "quantity" => $product->getQuantity(),
                "productId" => $product->getId(),
                "priceType" => $product->getPriceType(),
                "image" => $product->getImage(),
                "price" => $product->getPriceType() == "kg" ? $product->getPriceKg() : $product->getPriceUnit(),
            ];
            
            array_push($productListForJs, $infos);
            $count++;
        }
    
        // $_SESSION['cartTotalPrice'] = $cart->getTotalPrice();
        echo json_encode(["list" => $productListForJs, "count" => $count, "totalPrice" => $cart->getTotalPrice()]);
    }
    else {

        if(isset($_SESSION['cart']) && empty($_SESSION['cart'])) {

            unset($_SESSION['cart']);
        }

        echo json_encode(["empty" => true]);
    }

}



if (isset($_POST['addOneProductToCart'])) {

    if(!isset($_SESSION['user'])) {

        if (session_id() == "") session_start();
        $userId = null;
        $userType = null;
    }

    else {
        
        $userId = $_SESSION['user']->getId();
        $userType = $_SESSION['user']->getType();
    }

    $productToCart = new ProductModel();

    $productObject = $productToCart->setObject($_POST["productID"]);
    $productObject->setQuantity((int)$_POST['quantity']);

    // isset($_SESSION['cart']) ?
    //     array_push($_SESSION['cart'], $productObject):
    //     $_SESSION['cart'] = [] && array_push($_SESSION['cart'], $productObject);

    if (isset($_SESSION['cart'])) {

        foreach($_SESSION['cart'] as $key => $product) {

            if($product->getId() == $_POST['productID']) {

                $newQuantity = (int)($_POST['quantity'] + $product->getQuantity());

                $product->updateCartQuantity((int)$product->getId(), (int)$_SESSION['cartId'][0], $newQuantity);
    
                $product->setQuantity($newQuantity);

                echo json_encode(["success" => true, "message" => "Produit ajouté avec succès"]);

                return;
            }
        }

        array_push($_SESSION['cart'], $productObject);

        $productObject->addToCart([
            ':id_user' => $userId,
            ':id_product' => ($_POST['productID']),
            ':id_cart' => ($_SESSION['cartId'][0]),
            ':quantity' => $productObject->getQuantity()
        ]);

    // $_SESSION['cartTotalPrice'] = $cart->getTotalPrice();

    } 
    
    else {

        $_SESSION['cart'] = [];
        $_SESSION['cartId'] = [];
        $_SESSION['cartTotalPrice'] = new CartModel();

        $newCart = new CartModel();

        $date = new DateTime();

        $newSqlCart = $newCart->createOne([
            ':id_user' => $userId,  
            ':type_client' => $userType,
            ':date' => $date->format('Y-m-d H:i:s'),
            ':paid' => "NO"
        ]);
        
        $cartId = $newCart->getLastCartId();

        array_push($_SESSION['cartId'], $cartId);
        array_push($_SESSION['cart'], $productObject);

        $productObject->addToCart([
            ':id_user' => $userId,
            ':id_product' => ($_POST['productID']),
            ':id_cart' => ($_SESSION['cartId'][0]),
            ':quantity' => $productObject->getQuantity()
        ]);
    }
    $cartTotalPrice = new CartModel();
    $cartTotalPrice->updateOne([
        ':total_amount' => $cartTotalPrice->getTotalPrice(),
        ':id' => $_SESSION['cartId'][0]
    ]);
    echo json_encode(["success" => true, "message" => "Produit ajouté avec succès"]);
}

if(isset($_POST['deleteFromCart'])) {

    foreach($_SESSION['cart'] as $key => $product) {

        if($product->getId() == $_POST['deleteFromCart']) {

            $product->deleteFromCart([
                ":id_product" => (int)$_POST['deleteFromCart'], 
                ":id_cart" => (int)$_SESSION['cartId'][0]
            ]);

            unset($_SESSION['cart'][$key]);
        }
    }

    if(!empty($_SESSION['cart'])) {

        $cartTotalPrice = new CartModel();
        $cartTotalPrice->updateOne([
        ':total_amount' => $cartTotalPrice->getTotalPrice(),
        ':id' => $_SESSION['cartId'][0]
    ]);
    }
    
    echo json_encode(["success" => true, "message" => "Produit supprimé avec succès"]);

}

if(isset($_POST['addQuantity'])) {

    foreach($_SESSION['cart'] as $key => $product) {

        if($product->getId() == $_POST['addQuantity']) {

            $newQuantity = (int)($product->getQuantity() + 1);

            $product->updateCartQuantity((int)$product->getId(), (int)$_SESSION['cartId'][0], $newQuantity);

            $product->setQuantity($newQuantity);
        }
    }
    $cartTotalPrice = new CartModel();
    $cartTotalPrice->updateOne([
        ':total_amount' => $cartTotalPrice->getTotalPrice(),
        ':id' => $_SESSION['cartId'][0]
    ]);
    // $_SESSION['cartTotalPrice'] = $cart->getTotalPrice();
}

if(isset($_POST['removeQuantity'])) {

    foreach($_SESSION['cart'] as $key => $product) {

        if($product->getId() == $_POST['removeQuantity']) {

            $newQuantity = (int)($product->getQuantity() - 1);

            $product->updateCartQuantity((int)$product->getId(), (int)$_SESSION['cartId'][0], $newQuantity);

            $product->setQuantity($newQuantity);
        }
    }
    $cartTotalPrice = new CartModel();
    $cartTotalPrice->updateOne([
        ':total_amount' => $cartTotalPrice->getTotalPrice(),
        ':id' => $_SESSION['cartId'][0]
    ]);
    // $_SESSION['cartTotalPrice'] = $cart->getTotalPrice();
}

if(isset($_POST['displayHistory'])) {
    
        $cart = new CartModel();
    
        $cartHistory = $cart->readAllUserPaidCarts("id_user", $_SESSION['user']->getId());
    
        echo json_encode($cartHistory);
}

if(isset($_POST['readOneCart'])){
    
        $cart = new CartModel();
    
        $cartHistory = $cart->getCartProducts($_POST['readOneCart']);

        $cartProducts = [];

        foreach($cartHistory as $product) {

            $cartProduct = new ProductModel();
            $cartProducts[] = ["name" => $cartProduct->readOneSingleInfo("product", "id", $product['id_product']), "quantity" => $product['quantity']];
        }
    
        echo json_encode($cartProducts);
}

if(isset($_POST['resetCart'])) {

        $cart = new CartModel();
    
        $cartHistory = $cart->getCartProducts($_POST['resetCart']);

        $cartProducts = [];

        foreach($cartHistory as $product) {

            $cartProduct = new ProductModel();
            $cartProduct->setObject($product['id_product']);
            $cartProduct->setQuantity($product['quantity']);
            $_SESSION['cart'][] = $cartProduct;
        }

        echo json_encode(["success" => true, "message" => "Panier recréé"]);


}
