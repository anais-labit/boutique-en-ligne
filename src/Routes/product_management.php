<?php 

use App\Model\ProductModel;
// var_dump(is_file("../config.php"));
// var_dump(is_file("../../config.php"));

// if(is_file("../config.php") == true) {
//     require_once '../config.php';
//     echo ROOT_DIR;


// }    

is_file("../config.php") == true ?
    require_once '../config.php':
    require_once '../../config.php';



// require_once '../vendor/autoload.php';
// if(session_id() == "") session_start();
require_once ROOT_DIR .'/vendor/autoload.php';



function displayCategoriesInSelect() {

    $categories = new ProductModel();
    $displayCategories = $categories->readAllCategories();

    foreach($displayCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] .">" . $value["category"] . "</option>";
    }
}

function displaySubCategoriesInSelect() {

    $subCategories = new ProductModel();

    $displaySubCategories = $subCategories->readAllSubCategories();
    var_dump($displaySubCategories);

    foreach($displaySubCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] .">" . $value["sub_category"] . "</option>";
    }
}


// function displayProducts() {

//     $products = new ProductModel;

//     $productList = $products->readAllProducts();

//     // foreach($productList as $value) {

//     //     $value['price_kg'] !== null ? $price = $value['price_kg'] . '€/kg' : $price = $value['price_unit'] . '€/unité';

//     //     echo '
//     //         <div class="productCard">
//     //             <h2>' . $value['product'] . '</h2>
//     //             <p>' . $value['description'] . '</p>
//     //             <p>' . $price . '</p>
//     //             <button class="addCartButton" value="' . $value['id'] . '"> Ajouter</button>
//     //         </div>
//     //     ';
//     // }
//     echo json_encode($productList);
// }

if(isset($_POST['addProdButton'])) {

    $newproduct = new ProductModel;

    $productPriceType = $_POST['productPriceType'];

    $newproduct->createProduct($_POST['productPriceType'], $_POST['productName'], $_POST['productCat'], $_POST['productSubCat'], $_POST['productDesc'], $_POST['productOrigin'], $_POST['productWeight'], $_POST['productPrice']);
}

if(isset($_POST['addCategoryButton'])) {

    $newproduct = new ProductModel;

    $newproduct->createCategory($_POST['categoryName']);
}

if(isset($_POST['addSubCategoryButton'])) {

    $newproduct = new ProductModel;

    $newproduct->createSubCategory($_POST['subCategoryName'], $_POST['subcatCat']);
}

if(isset($_POST['addOneProductToCart'])) {

    $productToCart = new ProductModel;

    $productObject = $productToCart->setObject($_POST["productID"]);
if(session_id() == "") session_start();

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
}

?>