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

        <form action="" class="search-form">
            <input type="search" name="search" placeholder="Rechercher un produit" id="search-box">
            <label for="search-box" class="fas fa-search"></label>
        </form>

        <div class="icons">
            <div id="search-button" class="fas fa-search"></div>
            <a href="" class="fas fa-shopping-cart"></a>
            <div id="login-btn" class="fas fa-user"></div>
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

<!-- Login Form -->
<div class="login-form-container">


    <div id="close-login-btn" class="fas fa-times"></div>
    <form action="" method="post" id="loginForm">
        <h3>Se connecter</h3>
        <span>email</span>
        <input type="text" name="loginEmail" id="loginEmail" class="box" placeholder="Email">
        <span>mot de passe</span>
        <input type="password" name="loginPassword" class="box loginInputs" id="loginPassword" placeholder="Mot de passe">
        <div class="checkbox">
            <input type="checkbox" name="" id="remember-me">
            <label for="remember-me">Se souvenir de moi</label>
        </div>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']->getType() == 4) : ?>
            <a href="admin.php">Admin</a>
        <?php elseif(isset($_SESSION['user'])) : ?>
            <a href="profil.php">profil</a>
            <?php endif ?>

        <?php if(isset($_SESSION['user'])) :?>
                <button type="submit" name="disconnect" id="decoButton" class="btn">Déconnexion</button>
               
            <?php else :?>
        <button type="submit" id="loginButton" class="btn">Connexion</button>
        <?php endif ?>
        <p>Mot de passe oublié ? <a href="#"> Cliquez-ici</a></p>
        <p>Pas encore de compte? <a href="#"> S'inscrire</a></p>

    </form>
</div>




<?php if ($_SERVER['REQUEST_URI'] !== 'cart.php') : ?>
    <script defer src="../src/Controller/products.js"></script>
<?php endif ?>
<script src="../src/Controller/nav.js" defer></script>

<script src="../src/Controller/auto_complete.js" defer></script>