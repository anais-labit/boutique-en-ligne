<?php
use App\Model\ProductModel;

is_file("../config.php") == true ?
    require_once '../config.php':
    require_once '../../config.php';

// require_once '../../vendor/autoload.php';
require_once ROOT_DIR .'/vendor/autoload.php';


// require_once '../Model/ProductModel.php';

if(isset($_POST['displayAllProducts'])) {

    $products = new ProductModel();
    
    $productList = $products->readAllProducts();
    
    echo json_encode($productList);

}

?>

