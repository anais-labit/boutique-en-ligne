<?php 

require_once '../src/Model/ProductModel.php';


function displayCategoriesInSelect() {

    $categories = new ProductModel;
    $displayCategories = $categories->readAllCategories();

    foreach($displayCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] .">" . $value["categorie"] . "</option>";
    }
}

function displaySubCategoriesInSelect() {

    $subCategories = new ProductModel;

    $displaySubCategories = $subCategories->readAllSubCategories();
    var_dump($displaySubCategories);

    foreach($displaySubCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] .">" . $value["sous_categorie"] . "</option>";
    }
}


function displayProducts() {

    $products = new ProductModel;

    $productList = $products->readAllProducts();

    foreach($productList as $value) {

        $value['prix_kg'] !== null ? $price = $value['prix_kg'] : $price = $value['prix_unit'];

        echo '
            <div class="productCard">
                <h2>' . $value['nom'] . '</h2>
                <p>' . $value['description'] . '</p>
                <p>' . $price . '€' . '</p>
            </div>
        ';
    }
}

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

?>