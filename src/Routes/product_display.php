<?php
use App\Model\ProductModel;
require_once '../../vendor/autoload.php';

// require_once '../Model/ProductModel.php';

if(isset($_POST['displayAllProducts'])) {

    $products = new ProductModel();
    
    $productList = $products->readAllProducts();
    
    echo json_encode($productList);

}

?>

