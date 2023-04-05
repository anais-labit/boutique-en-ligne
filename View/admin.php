<?php 

require_once '../src/Model/ProductModel.php';
require_once '../src/Model/UserModel.php';
// require_once '../Routes/product_management.php';
// require_once '../src/Routes/product_management.php';
require_once '../src/Routes/admin_products.php';
if(session_id() == "") session_start();
// session_destroy();

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

        <h1>Ajout de produit</h1>

        <label>Nom du produit</label>
        <input type="text" class="addProdInput" name="productName">

        <label>Description</label>
        <textarea name="productDesc"></textarea>

        <label>Catégorie</label>
        <select name="productCat">
            <?php displayCategoriesInSelect() ?>
        </select>

        <label>Sous-catégorie</label>
        <select name="productSubCat">
            <?php displaySubCategoriesInSelect() ?>
        </select>
        
        <label>Origine</label>
        <input type="text" class="addProdInput" name="productOrigin">

        <label>Poids</label>
        <input type="number" class="addProdInput" name="productWeight">

        <label>Producteur</label>
        <select></select>

        <label >Type de prix</label>
        <select name="productPriceType">
            <option value="price_kg">kg</option>
            <option value="price_unit">unitaire</option>
        </select>

        <label>Prix</label>
        <input type="number" class="addProdPrice" name="productPrice">

        <button type="submit" name="addProdButton">Ajouter</button>

    </form>

    <form method="POST" id="addCategoryForm">

        <h1>Ajout de catégorie</h1>

        <label>Nom</label>
        <input type="text" name="categoryName">

        <button type="submit" name="addCategoryButton">Ajouter</button>

    </form>

    <form method="POST" id="addSubCategoryForm">

        <h1>Ajout de sous-catégorie</h1>

        <label>Nom</label>
        <input type="text" name="subCategoryName">

        <label>Catégorie</label>
        <select name="subcatCat">
            <?php displayCategoriesinSelect() ?>
        </select>

        <button type="submit" name="addSubCategoryButton">Ajouter</button>

    </form>
    
</body>
</html>