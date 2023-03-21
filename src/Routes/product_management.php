<?php 

require_once '../src/Model/ProductModel.php';


// function displayCategories() {

//     $categories = new ProductModel;
//     $displayCategories = $categories->readAllCategories();

//     foreach($displayCategories as $key => $value) {

//         echo "
//         <option value=" . $value['id'] .">" . $value["categorie"] . "</option>";
//     }
// }

// function displaySubCategories() {

//     $subCategories = new ProductModel;

//     $displaySubCategories = $subCategories->readAllSubCategories();
//     var_dump($displaySubCategories);

//     foreach($displaySubCategories as $key => $value) {

//         echo "
//         <option value=" . $value['id'] .">" . $value["sous_categorie"] . "</option>";
//     }
// }

if(isset($_POST['addProdButton'])) {

    $newproduct = new ProductModel;

    $productPriceType = $_POST['productPriceType'];

    $newproduct->createProduct($_POST['productPriceType'], $_POST['productName'], $_POST['productCat'], $_POST['productSubCat'], $_POST['productDesc'], $_POST['productOrigin'], $_POST['productWeight'], $_POST['productPrice']);
}

?>