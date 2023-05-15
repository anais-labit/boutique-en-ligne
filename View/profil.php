<?php

is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

require_once ROOT_DIR . '/vendor/autoload.php';

if (session_id() == "") session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="../src/Controller/update.js"></script>
    <link rel="stylesheet" href="global.css">


    <title>Profil Page</title>
</head>

<body>
    <?php require_once 'header.php';
    ?>
    <div class="profil-page">
        <h2>Gestion de profil</h2>
        <form action="profil.php" method="POST" id="updateForm" enctype="multipart/form-data">
            <label class="updateLabels" id="updateLabelAvatar" for="updateAvatar">Avatar</label>
              <div id="avatars">
                <?php
                for ($x = 1; $x <= 5; $x++) {
                    // CHANGER ICI LE CHEMIN DES IMAGES POUR HEBERGEMENT DIFFÉRENT
                    if ("http://localhost/boutique-en-ligne/View/assets/images/avatars/avatar" . $x . ".png" == $_SESSION['user']->getAvatar()) {

                        echo '
                        <img src="./assets/images/avatars/avatar' . $x . '.png" id="selectedAvatar">
                ';
                    } else {
                        echo '
                        <img src="./assets/images/avatars/avatar' . $x . '.png" class="unselectedAvatars" id="'. $x . '">
                        ';
                    }
                }
                ?>
            </div>
            <?php if ($_SESSION['user']->getType() == 1) : ?>
                <label>Particulier</label>
            <?php elseif ($_SESSION['user']->getType() == 2) : ?>
                <label>Entreprise</label>
            <?php endif ?>
            <?php if ($_SESSION['user']->getType() == 1) : ?>
                <label class="updateLabels" id="updateLabelFirstName" for="updateFirstName">Prénom</label>
                <input type="text" name="updateFirstName" class="loginInputs" id="updateFirstName" value="<?= $_SESSION['user']->getFirstName() ?>">

                <label class="updateLabels" id="updateLabelLastName" for="updateLastName">Nom</label>
                <input type="text" name="updateLastName" class="loginInputs" id="updateLastName" value="<?= $_SESSION['user']->getLastName() ?>">
            <?php elseif ($_SESSION['user']->getType() == 2) : ?>
                <label class="updateLabels" id="updateLabelCompany" for="updateCompany">Raison Sociale</label>
                <input type="text" name="updateCompany" class="loginInputs" id="updateCompany" value="<?= $_SESSION['user']->getCompany() ?>">
            <?php endif ?>

            <label class="updateLabels" for="updateEmail">Email</label>
            <input type="text" name="updateEmail" class="loginInputs" id="updateEmail" value="<?= $_SESSION['user']->getEmail() ?>">
            <label class="updateLabels" for="updateAddress">Adresse</label>
            <input type="text" name="updateAddress" class="loginInputs" id="updateAddress" value="<?= $_SESSION['user']->getAddress() ?>">
            <label class="updateLabels" for="updateZipCode">Code Postal</label>
            <input type="number" name="updateZipCode" class="loginInputs" id="updateZipCode" value="<?= $_SESSION['user']->getZipCode() ?>">
            <label class="updateLabels" for="updateCity">Ville</label>
            <input type="text" name="updateCity" class="loginInputs" id="updateCity" value="<?= $_SESSION['user']->getCity() ?>">
            <label class="updateLabels" for="updatePassword">Mot de Passe</label>
            <input type="password" name="updatePassword" class="loginInputs" id="updatePassword">
            <label class="updateLabels" for="updateConfirmPassword">Confirmez votre mot de passe</label>
            <input type="password" name="updateConfirmPassword" class="loginInputs" id="updateConfirmPassword">
            <label for="confirmOldPassword">Saisissez votre ancien ancien mot de passe pour valider</label>
            <input type="password" name="confirmOldPassword" class="loginInputs" id="confirmOldPassword">

            <div class="profilBtnContainer">
                <button type="submit" class="profileBtn" id="updateButton">Mettre à jour</button>
                <button type="submit" class="profileBtn" id="deleteButton">Supprimer votre compte</button>
            </div>
        </form>
    </div>

</body>

</html>