<?php

require_once '../src/Routes/search.php';
require_once '../src/Model/ProductModel.php';


if(isset($_POST['disconnect'])) {

    session_destroy();

    header('Location: ../View/login.php');
}

if(session_id() == "") session_start();

?>

    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php">A propos</a>
        <a href="products.php">Nos produits</a>
        <a href="index.php">Nos producteurs</a>
        <a href="index.php">Actualités</a>
        <div class=search id=search>
            <form id=searchForm action=header.php>
                <input type=text id="field" name="field" autocomplete=off>
                <input type=submit name="search" value="Rechercher">
            </form>
        </div>

        <?php if(isset($_SESSION['user'])): ?>

            <?= $_SESSION['user']['type'] == 3 || $_SESSION['user']['type'] == 4  ?
             "<a href='admin.php'>Admin</a>" : "<a href='profil.php'>Profil</a>" ?>
            <form method="POST" id="decoForm">
                <button type="submit" name="disconnect" id="decoButton">Déconnexion</button>
            </form>
        
        <?php else: ?>

            <a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>

        <?php endif ?>
    </nav>

    

</body>

<script src="../src/Controller/auto_complete.js" defer></script>
