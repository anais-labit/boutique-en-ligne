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
            <a href="#" class="home-btn">Commencer maintenant</a>
        </div>
        <div class="banner-image">
        </div>
    </section>
    <!-- HOME SECTION END -->
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