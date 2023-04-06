<?php

use App\Model\ProductModel;

is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

// require_once '../../vendor/autoload.php';
require_once ROOT_DIR . '/vendor/autoload.php';


function displayCategoriesInSelect()
{

    $categories = new ProductModel();
    $displayCategories = $categories->readAllCategories();

    foreach ($displayCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] . ">" . $value["category"] . "</option>";
    }
}

function displaySubCategoriesInSelect()
{

    $subCategories = new ProductModel();

    $displaySubCategories = $subCategories->readAllSubCategories();
    var_dump($displaySubCategories);

    foreach ($displaySubCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] . ">" . $value["sub_category"] . "</option>";
    }
}



if (isset($_POST['addProdButton'])) {

    $newproduct = new ProductModel();

    $productPriceType = $_POST['productPriceType'];

    $targetDir = "../View/images/";
    $targetFile = $targetDir . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
    $path = $targetDir . ($_FILES['photo']['name']);

    $newproduct->createProduct($_POST['productPriceType'], $_POST['productName'], $_POST['productCat'], $_POST['productSubCat'], $_POST['productDesc'], $_POST['productOrigin'], $_POST['productWeight'], $_POST['productPrice'], $path);
}

if (isset($_POST['addCategoryButton'])) {

    $newproduct = new ProductModel();

    $newproduct->createCategory($_POST['categoryName']);
}

if (isset($_POST['addSubCategoryButton'])) {

    $newproduct = new ProductModel();

    $newproduct->createSubCategory($_POST['subCategoryName'], $_POST['subcatCat']);
}
