<?php

require_once '../src/Routes/search.php';
// require_once '../src/Model/ProductModel.php';
// require_once '../src/Model/UserModel.php';

if (session_id() == "") session_start();
// session_destroy();


if (isset($_POST['disconnect'])) {

    session_destroy();

    header('Location: ../View/login.php');
}


var_dump($_SESSION['cart']);
?>

<nav>
    <ul>

        <li>
            <a href="index.php">Accueil</a>
        </li>

        <li>
            <a href="index.php">A propos</a>
        </li>

        <li>
            <a href="products.php">Nos produits</a>
        </li>

        <li>
            <a href="index.php">Nos producteurs</a>
        </li>

        <li>
            <a href="index.php">Actualités</a>
        </li>

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

        <li id="test">
            <a href="cart.php">
                <i id="cartIcon" class="fa-solid fa-cart-shopping"></i>
            </a>
            <div id="headerCartDiv">

            </div>
        </li>
    </ul>

    <div class=search id=search>
        <form id=searchForm action=header.php>
            <input type=text id="field" name="field" autocomplete=off>
            <input type=submit name="search" value="Rechercher">
        </form>
    </div>
</nav>



</body>

<script defer src="../src/Controller/header_cart.js"></script>

<script src="../src/Controller/auto_complete.js" defer></script>