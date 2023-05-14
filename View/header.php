<!-- <script src="global.css"></script> -->

<?php

is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';
// require_once ROOT_DIR .'/src/Routes/product_display.php';
require_once ROOT_DIR . '/vendor/autoload.php';
// require_once '../src/Model/ProductModel.php';
// require_once '../src/Model/UserModel.php';

if (session_id() == "") session_start();
// session_destroy();


if (isset($_POST['disconnect'])) {

    session_destroy();

    header('Location: ../View/index.php');
}

// var_dump($_SESSION['cart']);
// var_dump($_SESSION['user']);
// var_dump($_SESSION['cartId']);  

// var_dump($_SERVER['HTTP_SEC_CH_UA_PLATFORM']);
// var_dump(PHP_OS);
?>

<!-- Debut du Header -->
<header class="header">
    <div class="header-top">
        <a href="#" class="logo"><img src="./assets/images/logos/FreshMarket-Logo.png" alt=""></a>

        <form action="" class="search-form" id ="searchForm">
            <input type="search" name="search" placeholder="Rechercher un produit" id="field">
            <label for="search-box" class="fas fa-search"></label>
        </form>

        <div class="icons">
            <div id="search-button" class="fas fa-search"></div>
            <a href="" class="fas fa-shopping-cart" id="cartIcon"></a>
            <div id="headerCartDiv"></div>
            <div id="nav-register-section" class="fas fa-user nav-register-section"></div>
        </div>
    </div>
    <div class="header-bot">
        <nav class="navbar">
            <a href="index.php">Accueil</a>
            <a href="#">À Propos</a>
            <a href="products.php">Nos produits</a>
            <a href="#">Nos Producteurs</a>
            <a href="#">Actualités</a>
        </nav>
    </div>
</header>
<!-- Fin du Header -->

<!-- Mobile Navbar -->
<nav class="mobile-navbar">
    <a href="index.php" class="fas fa-home"></a>
    <a href="#" class="fas fa-list"></a>
    <a href="products.php" class="fas fa-tags"></a>
    <a href="#" class="fas fa-comments"></a>
    <a href="#" class="fas fa-blogs"></a>
</nav>
<!-- Fin Mobile Navbar -->

    <?php require_once '../View/authentication.php'; ?>



<?php if ($_SERVER['REQUEST_URI'] !== 'cart.php') : ?>
    <script defer src="../src/Controller/products.js"></script>
<?php endif ?>
<script src="../src/Controller/nav.js" defer></script>

<script src="../src/Controller/auto_complete.js" defer></script>