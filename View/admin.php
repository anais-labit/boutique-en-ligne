<?php

is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

require_once ROOT_DIR . '/vendor/autoload.php';
require_once '../src/Routes/admin_management.php';

if (session_id() == "") session_start();
if ($_SESSION['user']->gettype() === 1 || $_SESSION['user']->gettype() === 2) {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="global.css">
    <title>Admin Page</title>
</head>

<body>
    <?php include 'header.php' ?>
    <div class="admin-page">
        <div class="btnsContainer">
            <button id="dashboardBtn" class="modalBtn" type="submit" name="submitDashboard" value="submitDashboard">Dashboard</button>
            <button id="gestionBtn" class="modalBtn" type="submit" name="submitGestion" value="submitGestion">Gestion des produits</button>
            <button id="administrationBtn" class="modalBtn" type="submit" name="submitAdmin" value="submitAdmin">Administration des utilisateurs</button>
        </div>
        <!-- Dashboard Modal -->
        <div id="dashboard-modal" class="hiddenModal">
            <div class="modal-content">
                <h2>Dashboard</h2>
                <span id="clock"></span>
                <div id="kpi" class="container">
                    <div id="numbers">
                        <h3>Chiffres clés</h3>
                        <div id="cartsCountDiv"> </div>
                        <div id="clientsCountDiv"></div>
                        <div id="revenueCountDiv"></div>
                    </div>
                    <div id="lists">
                        <h3>Suivi des commandes</h3>
                        <h4>Tous les paniers</h4>
                        <div id="allCartsListDiv"> </div>
                        <h4>Les paniers en attente</h4>
                        <div id="pendingCartsListDiv"> </div>
                        <h4>Les paniers convertis en ventes</h4>
                        <div id="paidCartsListDiv"> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gestion Modal -->
        <div id="gestion-modal" class="hiddenModal">
            <div class="modal-content">
                <h2>Gestion des produits</h2>
                <form method="POST" id="addProductForm" enctype="multipart/form-data">
                    <h3>Ajout de produit</h3>
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
                    <h3>Ajout de catégorie</h3>
                    <label class="addProdLabel">Nom</label>
                    <input type="text" name="categoryName">
                    <button type="submit" name="addCategoryButton">Ajouter</button>
                </form>
                <form method="POST" id="addSubCategoryForm">
                    <h3>Ajout de sous-catégorie</h3>
                    <label class="addProdLabel">Nom</label>
                    <input type="text" name="subCategoryName">
                    <label class="addProdLabel">Catégorie</label>
                    <select name="subcatCat">
                        <?php displayCategoriesinSelect() ?>
                    </select>
                    <button type="submit" name="addSubCategoryButton">Ajouter</button>
                </form>
                <form method="POST" id="addProducerForm" enctype="multipart/form-data">
                    <h3>Ajout de producteur</h3>
                    <label class="addProdLabel">Nom</label>
                    <input type="text" name="producerName">
                    <label class="addProdLabel">Description</label>
                    <textarea name="producerDesc"></textarea>
                    <label class="addProdLabel">Image</label>
                    <input type="file" class="addProdInput" name="producerPhoto">
                    <button type="submit" name="addProducerButton">Ajouter</button>
                </form>
            </div>
        </div>
        <!-- Administration Modal -->
        <div id="administration-modal" class="hiddenModal">
            <div class="modal-content">
                <h2>Administration des utilisateurs</h2>
                <h3>Rôles et suppression</h3>
                <div id="usersListDiv"></div>
                <form method="POST" id="container">
                </form>
            </div>
        </div>
    </div>
    <script defer src="../src/Controller/admin.js"></script>
</body>

</html>