<?php
is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';
// require_once ROOT_DIR .'/src/Routes/product_display.php';
require_once ROOT_DIR . '/vendor/autoload.php';

if (session_id() == "") session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <script defer src="../Controller/register_login.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="global.css">
</head>

<body>
    <?php require_once '../View/header.php'; ?>

    <!-- HOME SECTION START -->
    <section class="home" id="">
        <div class="banner-content">
            <span>Fresh Market</span>
            <h3>Des produits Frais et Locaux</h3>
            <a href="#" class="banner-btn">Découvrez nos produits</a>
        </div>
        <div class="banner-image">
        </div>
    </section>
    <!-- HOME SECTION END -->
    <!-- BASKET SECTION START -->
    <section class="basket-category" id="basketCategory">
        <h1 class="heading">Choisissez votre <span>panier</span> :</h1>

        <div class="box-container">
            <div class="box">
                <h3>Le Petit Panier</h3>
                <p>Le panier pour les célibataires ou les couples.</p>
                <img src="../View/assets/images/baskets/panier.jpg" alt="Panier de fruits et légumes">
                <a href="#" class="basket-btn">Acheter Maintenant</a>
            </div>
            <div class="box">
                <h3>Le Panier Moyen</h3>
                <p>Le panier pour les familles de 3 à 4 personnes.</p>
                <img src="../View/assets/images/baskets/panier.jpg" alt="Panier de fruits et légumes">
                <a href="#" class="basket-btn">Acheter Maintenant</a>
            </div>
            <div class="box">
                <h3>Le Grand Panier</h3>
                <p>Le panier pour les familles nombreuses.</p>
                <img src="../View/assets/images/baskets/panier.jpg" alt="Panier de fruits et légumes">
                <a href="#" class="basket-btn">Acheter Maintenant</a>
            </div>
            <div class="box">
                <h3>Le Panier Maison</h3>
                <p>Le panier à composer soi même</p>
                <img src="../View/assets/images/baskets/panier.jpg" alt="Panier de fruits et légumes">
                <a href="#" class="basket-btn">Acheter Maintenant</a>
            </div>
        </div>
    </section>

    <!-- BASKET SECTION END -->
    <!-- CATEGROY SECTION START -->
    <section class="category" id="category">
        <h1 class="heading">Sélectionner par <span>catégories</span></h1>

        <div class="box-container">
            <div class="box"></div>
        </div>
    </section>
    <!-- CATEGORY SECTION END -->






</body>

</html>