<?php

// require_once '../Model/ProductModel.php';

use App\Model\CartModel;
use App\Model\ProductModel;
// use App\Model\UserModel;


// is_file("../config.php") == true ?
//     require_once '../config.php' :
//     require_once '../../config.php';

// require_once '../../vendor/autoload.php';
// require_once '/vendor/autoload.php';

if (session_id() == "") session_start();

if (isset($_POST['displayHeaderCart'])) {

    $productListForJs = [];
    $count = 0;

    foreach ($_SESSION['cart'] as $index => $product) {

        // array_push($productListForJs, $product->getName());
        $product = [
            "name" => $product->getName(),
            "quantity" => $product->getQuantity()
        ];
        
        array_push($productListForJs, $product);
        $count++;
    }

    echo json_encode(["list" => $productListForJs, "count" => $count]);

    // echo json_encode($_SESSION['cart']);
}



if (isset($_POST['addOneProductToCart'])) {

    $userId = $_SESSION['user']->getId();
    $userType = $_SESSION['user']->getType();


    $productToCart = new ProductModel();

    $productObject = $productToCart->setObject($_POST["productID"]);
    $productObject->setQuantity((int)$_POST['quantity']);

    // isset($_SESSION['cart']) ?
    //     array_push($_SESSION['cart'], $productObject):
    //     $_SESSION['cart'] = [] && array_push($_SESSION['cart'], $productObject);

    if (isset($_SESSION['cart'])) {
        array_push($_SESSION['cart'], $productObject);
        $productObject->insertProduct($userId, ($_POST['productID']), ($_SESSION['cartId'][0]));
    } else {

        $_SESSION['cart'] = [];
        $_SESSION['cartId'] = [];

        $newCart = new CartModel();



        $test = $newCart->createCart($userId, $userType);
        $cartId = $newCart->getLastCartId();

        array_push($_SESSION['cartId'], $cartId);
        array_push($_SESSION['cart'], $productObject);
        $productObject->insertProduct($userId, ($_POST['productID']), ($_SESSION['cartId'][0]));
    }

    echo json_encode(["success" => "true", "message" => "Produit ajouté avec succès"]);
}
