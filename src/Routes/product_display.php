<?php

require_once '../Model/ProductModel.php';

if(isset($_POST['displayAllProducts'])) {

    $products = new ProductModel;
    
    $productList = $products->readAllProducts();
    
    echo json_encode($productList);

}

?>

