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
    
    $productList = $products->readAll();
    
    echo json_encode($productList);

}


if(isset($_POST['displayAllFilters'])) {

    $filters = new ProductModel();
    
    $filtersList = $filters->readAllCategories();
    
    echo json_encode($filtersList);

}

if(isset($_POST['displaySingleCategory'])) {

    $singleCategoryProducts = new ProductModel();
    
    $singleCategoryProductsList = $singleCategoryProducts->readOneCategoryProducts((int)$_POST['categoryId']);
    
    echo json_encode($singleCategoryProductsList);

}

if(isset($_POST['displaySubCategoriesButtons'])) {

    $singleSubCategoryFilters = new ProductModel();
    
    $singleSubCategoryFiltersList = $singleSubCategoryFilters->readOneCategoryFilters((int)$_POST['categoryId']);
    
    echo json_encode($singleSubCategoryFiltersList);

}

if(isset($_POST['displaySingleSubCategory'])) {

    $singleSubCategoryProducts = new ProductModel();
    
    $singleSubCategoryProductsList = $singleSubCategoryProducts->readOneSubCategoryProducts((int)$_POST['subCategoryId']);
    
    echo json_encode($singleSubCategoryProductsList);

}

// function displayCategoryButtons() {

//     $categories = new ProductModel();

//     $categoriesList = $categories->readAllCategories();

//     foreach($categoriesList as $cat) {

//         echo '
//             <button value="' . $cat['id']. '">' . $cat['category']. '</button>
//         ';
//     }
// }

?>

