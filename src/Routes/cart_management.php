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


if(isset($_POST['displayCart']) 
// && $_SERVER['REQUEST_URI'] == 'cart.php')
)
 {


 
    
}



if (isset($_POST['displayHeaderCart']) || isset($_POST['displayCart'])) {

    $productListForJs = [];
    $count = 0;

    foreach ($_SESSION['cart'] as $index => $product) {

        // array_push($productListForJs, $product->getName());
        $product = [
            "name" => $product->getName(),
            "quantity" => $product->getQuantity(),
            "productId" => $product->getId()
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
        $productObject->addToCart($userId, ($_POST['productID']), ($_SESSION['cartId'][0]), $productObject->getQuantity());
    } else {

        $_SESSION['cart'] = [];
        $_SESSION['cartId'] = [];

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
        $productObject->addToCart($userId, ($_POST['productID']), ($_SESSION['cartId'][0]), $productObject->getQuantity());
    }

    echo json_encode(["success" => "true", "message" => "Produit ajouté avec succès"]);
}

if(isset($_POST['deleteFromCart'])) {

    foreach($_SESSION['cart'] as $key => $product) {

        if($product->getId() == $_POST['deleteFromCart']) {

            $product->deleteFromCart((int)$_POST['deleteFromCart'], (int)$_SESSION['cartId'][0]);

            unset($_SESSION['cart'][$key]);
        }
    }
    echo json_encode(["success" => "true", "message" => "Produit supprimé avec succès"]);


}
