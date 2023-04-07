<?php

require_once '../src/Model/ProductModel.php';
require_once '../src/Model/UserModel.php';
// require_once '../Routes/product_management.php';
// require_once '../src/Routes/product_management.php';
require_once '../src/Routes/admin_products.php';
if (session_id() == "") session_start();
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

    <?php include 'header.php' ?>

    <form method="POST" id="addProductForm" enctype="multipart/form-data">

        <h1>Ajout de produit</h1>

        <label class="addProdLabel">Nom du produit</label>
        <input type="text" class="addProdInput" name="productName">

        <label class="addProdLabel">Description</label>
        <textarea name="productDesc"></textarea>

        <label class="addProdLabel">Catégorie</label>
        <select name="productCat">
            <?php displayCategoriesInSelect() ?>
        </select>

        <label class="addProdLabel">Sous-catégorie</label>
        <select name="productSubCat">
            <?php displaySubCategoriesInSelect() ?>
        </select>

        <label class="addProdLabel">Producteur</label>
        <select name="productProducer">
            <?php displayProducersInSelect() ?>
        </select>

        <label class="addProdLabel">Image</label>
        <input type="file" class="addProdInput" name="photo">

        <label class="addProdLabel">Origine</label>
        <input type="text" class="addProdInput" name="productOrigin">

        <label class="addProdLabel">Poids</label>
        <input type="number" class="addProdInput" name="productWeight">

        <label class="addProdLabel">Type de prix</label>
        <select name="productPriceType">
            <option value="price_kg">kg</option>
            <option value="price_unit">unitaire</option>
        </select>

        <label class="addProdLabel">Prix</label>
        <input type="number" class="addProdPrice" name="productPrice">

        <button type="submit" name="addProdButton">Ajouter</button>

    </form>

    <form method="POST" id="addCategoryForm">

        <h1>Ajout de catégorie</h1>

        <label class="addProdLabel">Nom</label>
        <input type="text" name="categoryName">

        <button type="submit" name="addCategoryButton">Ajouter</button>

    </form>

    <form method="POST" id="addSubCategoryForm">

        <h1>Ajout de sous-catégorie</h1>

        <label class="addProdLabel">Nom</label>
        <input type="text" name="subCategoryName">

        <label class="addProdLabel">Catégorie</label>
        <select name="subcatCat">
            <?php displayCategoriesinSelect() ?>
        </select>

        <button type="submit" name="addSubCategoryButton">Ajouter</button>

    </form>

    <form method="POST" id="addProducerForm" enctype="multipart/form-data">

        <h1>Ajout de producteur</h1>

        <label class="addProdLabel">Nom</label>
        <input type="text" name="producerName">

        <label class="addProdLabel">Description</label>
        <textarea name="producerDesc"></textarea>

        <label class="addProdLabel">Image</label>
        <input type="file" class="addProdInput" name="producerPhoto">

        <button type="submit" name="addProducerButton">Ajouter</button>

    </form>

</body>

</html>