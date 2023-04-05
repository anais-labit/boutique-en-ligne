<?php

    // require_once '../Model/ProductModel.php';

use App\Model\ProductModel;

is_file("../config.php") == true ?
require_once '../config.php':
require_once '../../config.php';

// require_once '../../vendor/autoload.php';
require_once ROOT_DIR .'/vendor/autoload.php';
    
    if(session_id() == "") session_start();

    if(isset($_POST['displayHeaderCart'])) {

        $productListForJs = [];

        foreach($_SESSION['cart'] as $index => $product) {

            array_push($productListForJs, $product->getName());
        }

        echo json_encode(["result" => $productListForJs, "count" => count($productListForJs)]);

        // echo json_encode($_SESSION['cart']);
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
            array_push($_SESSION['cart'], $productObject);
        }
    
        echo json_encode(["success" => "true", "message" => "Produit ajouté avec succès"]);
    }

?>