<?php
use App\Model\ProductModel;
use App\Model\CommentModel;

is_file("../config.php") == true ?
    require_once '../config.php':
    require_once '../../config.php';

// require_once '../../vendor/autoload.php';
require_once ROOT_DIR .'/vendor/autoload.php';


// require_once '../Model/ProductModel.php';

if(isset($_POST['displayAllProducts'])) {

    $products = new ProductModel();
    
    $productList = $products->readAll();

    // var_dump($productList);
    
    echo json_encode($productList);

}


if(isset($_POST['displayAllFilters'])) {

    $filters = new ProductModel();
    
    $filtersList = $filters->readAllCategories();
    
    echo json_encode($filtersList);

}

if(isset($_POST['displaySingleCategory'])) {

    $singleCategoryProducts = new ProductModel();
    
    $singleCategoryProductsList = $singleCategoryProducts->readOnebyForeignKey('id_cat', (int)$_POST['categoryId']);
    
    echo json_encode($singleCategoryProductsList);

}

if(isset($_POST['displaySubCategoriesButtons'])) {

    $singleSubCategoryFilters = new ProductModel();
    
    $singleSubCategoryFiltersList = $singleSubCategoryFilters->readOneCategoryFilters((int)$_POST['categoryId']);
    
    echo json_encode($singleSubCategoryFiltersList);

}

if(isset($_POST['displaySingleSubCategory'])) {

    $singleSubCategoryProducts = new ProductModel();
    
    $singleSubCategoryProductsList = $singleSubCategoryProducts->readOnebyForeignKey('id_sub_cat', (int)$_POST['subCategoryId']);
    
    echo json_encode($singleSubCategoryProductsList);

}

// Single Card Page

if(isset($_GET['productId'])) {

    $singleProduct = new ProductModel();

    $fetchProduct = $singleProduct->readOnebyId((int)$_GET['productId']);

    $rating = new CommentModel();
    $productRating = $rating->getAverageRating((int)$_GET['productId']);

    $productComments = $rating->getCommentsNumber((int)$_GET['productId']);

    if($fetchProduct[0][9] !== null) {

        $price = $fetchProduct[0][9];
        $priceType = "kg";
    }

    elseif($fetchProduct[0][10] !== null) {

        $price = $fetchProduct[0][10];
        $priceType = "pièces";
    }

    $productInfos = [
        "name" => $fetchProduct[0][1],
        "description" => $fetchProduct[0][4],
        "image" => $fetchProduct[0][5],
        "origin" => $fetchProduct[0][6],
        // "producer" => $product->getProducer(),
        "weight" => $fetchProduct[0][7],
        "price" => $price,
        "priceType" => $priceType,
        "commentsNumber" => $productComments,
        "rating" => $productRating
    ];
        
    echo json_encode($productInfos);
    }

   


?>

