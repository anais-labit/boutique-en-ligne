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

function displayProducersInSelect()
{

    $subCategories = new ProductModel();

    $displaySubCategories = $subCategories->readAllProducers();
    var_dump($displaySubCategories);

    foreach ($displaySubCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] . ">" . $value["producer"] . "</option>";
    }
}



if (isset($_POST['addProdButton'])) {

    $newproduct = new ProductModel();

    // $productPriceType = $_POST['productPriceType'];

    $targetDir = "../View/images/products/";
    $targetFile = $targetDir . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
    $path = $targetDir . ($_FILES['photo']['name']);

    $newproduct->createOne([
        ':product' => $_POST['productName'],
        ':id_cat' => (int)$_POST['productCat'],
        ':id_sub_cat' => (int)$_POST['productSubCat'],
        ':description' => $_POST['productDesc'],
        ':image' => $path,
        ':origin' => $_POST['productOrigin'],
        ':weight_gr' => (int)$_POST['productWeight'],
        ':id_producer' => (int)$_POST['productProducer'],
        ':' . $_POST['productPriceType'] => (int)$_POST['productPrice']
    ]);
}

if (isset($_POST['addCategoryButton'])) {

    $newproduct = new ProductModel();

    $newproduct->createCategory([':category' => $_POST['categoryName']]);
}

if (isset($_POST['addSubCategoryButton'])) {

    $newproduct = new ProductModel();

    $newproduct->createSubCategory([
        ':sub_category' => $_POST['subCategoryName'],
        ':id_category' => $_POST['subcatCat']
    ]);
            
}

if (isset($_POST['addProducerButton'])) {

    $newproducer = new ProductModel();

    $targetDir = "../View/images/producers/";
    $targetFile = $targetDir . basename($_FILES['producerPhoto']['name']);
    move_uploaded_file($_FILES['producerPhoto']['tmp_name'], $targetFile);
    $path = $targetDir . ($_FILES['producerPhoto']['name']);

    $newproducer->createProducer([
        ':producer' => $_POST['producerName'],
        ':description' => $_POST['producerDesc'],
        ':image' => $path
    ]);
            
    // var_dump($_FILES);
}
