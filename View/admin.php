<?php 

require_once '../src/Model/ProductModel.php';
require_once '../src/Routes/product_management.php';


function displayCategories() {

    $categories = new ProductModel;
    $displayCategories = $categories->readAllCategories();

    foreach($displayCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] .">" . $value["categorie"] . "</option>";
    }
}

function displaySubCategories() {

    $subCategories = new ProductModel;

    $displaySubCategories = $subCategories->readAllSubCategories();
    var_dump($displaySubCategories);

    foreach($displaySubCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] .">" . $value["sous_categorie"] . "</option>";
    }
}

// if(isset($_POST['addProdButton'])) {

//     $newproduct = new ProductModel;

//     $newproduct->createProduct($_POST['productName'], $_POST['productCat'], $_POST['productSubCat'], $_POST['productDesc'], $_POST['productOrigin'], $_POST['productWeight'], $_POST['productPrice']);
// }




?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global.css">
    <title>Admin Page</title>
</head>
<body>

<?php include 'header.php'?>

    <form method="POST" id="addProductForm">

        <label>Nom du produit</label>
        <input type="text" class="addProdInput" name="productName">

        <label>Description</label>
        <textarea name="productDesc"></textarea>

        <label>Catégorie</label>
        <select name="productCat">
            <?php displayCategories() ?>
        </select>

        <label>Sous-catégorie</label>
        <select name="productSubCat">
            <?php displaySubCategories() ?>
        </select>
        
        <label>Origine</label>
        <input type="text" class="addProdInput" name="productOrigin">

        <label>Poids</label>
        <input type="number" class="addProdInput" name="productWeight">

        <label>Producteur</label>
        <select></select>

        <label >Type de prix</label>
        <select name="productPriceType">
            <option value="prix_kg">kg</option>
            <option value="prix_unit">unitaire</option>
        </select>

        <label>Prix</label>
        <input type="number" class="addProdPrice" name="productPrice">

        <button type="submit" name="addProdButton" id="addProdButton">Ajouter</button>

    </form>
    
</body>
</html>