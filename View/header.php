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

    header('Location: ../View/login.php');
}

// var_dump($_SESSION['cart']);
// var_dump($_SESSION);
// var_dump($_SESSION['cartId']);  

// var_dump($_SERVER['HTTP_SEC_CH_UA_PLATFORM']);
// var_dump(PHP_OS);
?>

<header>
    <div class="top-bar">
        <a href="#" class="logo"><img src="./assets/images/logos/FreshMarket-Logo.png" alt="logo fresh market"></a>
        <div class="search-bar">
            <span class="icon">
                <i class="fa-solid fa-search"></i>
                <i class="fa-solid fa-close"></i>
            </span>
        <!-- <form action="../src/Routes/product_display.php" method="POST" class="search-bar">
            <input type="text" name="search" id="search" placeholder="Rechercher un produit">
            <button type="submit" name="submit-search"><i class="fa-solid fa-search"></i></button> -->
        </div>
        <div class="search-box"><input type="text" name="search" placeholder="Rechercher un produit" id="search">
    </div>
        
        <ul>
            <li><a href="#"><i class="fa-regular fa-user"></i></a></li>
            <!-- <div id="headerCartDiv"> -->

                <li id="headerCartDiv"><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></li>
            <!-- </div> -->
        </ul>
    </div>
    <nav>
        <div class="toggle">
            <a href="#"><i class="fa-solid fa-bars"></i></a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="#">À Propos</a></li>
            <li><a href="products.php">Nos Produits</a></li>
            <li><a href="">Nos Producteurs</a></li>
            <li><a href="#">Actualités</a></li>
            <?php if (isset($_SESSION['user'])) : ?>

<?= $_SESSION['user']->getType() == 3 || $_SESSION['user']->getType() == 4  ?
    "<li><a href='admin.php'>Admin</a></li>" : "<li><a href='profil.php'>Profil</a></li>" ?>
<form method="POST" id="decoForm">
    <button type="submit" name="disconnect" id="decoButton">Déconnexion</button>
</form>

<?php else : ?>

<li>
    <a href="login.php">Connexion</a>
</li>

<li>
    <a href="register.php">Inscription</a>
</li>

<?php endif ?>
        </ul>
    </nav>
</header>




<?php if($_SERVER['REQUEST_URI'] !== 'cart.php' || $_SERVER['REQUEST_URI'] !== 'singleCard.php'):?>
     <script defer src="../src/Controller/products.js"></script>
<?php endif ?>
<script src="../src/Controller/auto_complete.js" defer></script>

