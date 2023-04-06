<?php

    // require_once '../Model/ProductModel.php';

use App\Model\CartModel;
use App\Model\ProductModel;
// use App\Model\UserModel;


is_file("../config.php") == true ?
require_once '../config.php':
require_once '../../config.php';

// require_once '../../vendor/autoload.php';
require_once ROOT_DIR .'/vendor/autoload.php';
    
    if(session_id() == "") session_start();

    if(isset($_POST['displayHeaderCart'])) {

        $productListForJs = [];
        $count = 0;

        foreach($_SESSION['cart'] as $index => $product) {

            // array_push($productListForJs, $product->getName());
            $entity =
                ["name" => $product->getName(),
                "weight"=> $product->getWeight()                     
        ];

        array_push($productListForJs, $entity);
        $count++;

        }
        
        echo json_encode(["list" => $productListForJs, "count" => $count]);

    }



    if(isset($_POST['addOneProductToCart'])) {

        $productToCart = new ProductModel();
    
        $productObject = $productToCart->setObject($_POST["productID"]);
    
        // isset($_SESSION['cart']) ?
        //     array_push($_SESSION['cart'], $productObject):
        //     $_SESSION['cart'] = [] && array_push($_SESSION['cart'], $productObject);
            
        if(isset($_SESSION['cart'])) {
            array_push($_SESSION['cart'], $productObject);
        }
    
        else {

            $_SESSION['cart'] = [];
            $_SESSION['cartId'] = [];

            $newCart = new CartModel();
            
            $userId = $_SESSION['user']->getId();
            $userType = $_SESSION['user']->getType();

            $test = $newCart->createCart($userId, $userType);
            $cartId = $newCart->getLastCartId();

            array_push($_SESSION['cartId'], $cartId);
            array_push($_SESSION['cart'], $productObject);
        }
    
        echo json_encode(["success" => "true", "message" => "Produit ajouté avec succès"]);
    }

?>