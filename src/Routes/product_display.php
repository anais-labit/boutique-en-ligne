<?php

require_once '../Model/ProductModel.php';

$products = new ProductModel;

    $productList = $products->readAllProducts();

    echo json_encode($productList);

?>

