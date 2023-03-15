<?php

require_once '../src/Controller/search.php';

if(isset($_POST['disconnect'])) {

    session_destroy();

    header('Location: ../View/login.php');
}

if(session_id() == "") session_start();

?>

    <nav>
        <div class=search id=search>
            <form id=searchform action=header.php>
                <input type=text id="field" name="field" autocomplete=off>
                <input type=submit name="search" value="Rechercher">
            </form>
        </div>

        <?php if(isset($_SESSION['user'])): ?>

            <a href="profil.php">Profil</a>
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
