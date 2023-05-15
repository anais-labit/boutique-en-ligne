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
    $currentAvatar = $_SESSION['user']->getAvatar(); ?>

    <div class="profil-page">
        <h2>Gestion de profil</h2>
        <form action="profil.php" method="POST" id="updateForm" enctype="multipart/form-data">

            <?php if ($_SESSION['user']->getType() == 1) : ?>
                <label>Particulier</label>
            <?php elseif ($_SESSION['user']->getType() == 2) : ?>
                <label>Entreprise</label>
            <?php endif ?>

            <!-- <label class="updateLabels" id="updateLabelAvatar" for="updateLabelAvatar">Avatar</label> -->
            <div class="avatar" id="avatarContainer"><img src="<?= './assets/images/avatars/avatar' . $currentAvatar . '.png' ?>" width="60" height="60" alt="avatar"></div>
            <!-- <input type=" radio" class="updateLabels" name="avatar" id="avatar1" value="1">
            <img class="avatar" alt="avatar" src="./images/avatar1.png" width="60" height="60" />
            <input type="radio" class="updateLabels" name="avatar" id="avatar2" value="2">
            <img class="avatar" alt="avatar" src="./images/avatar2.png" width="60" height="60" />
            <input type="radio" class="updateLabels" name="avatar" id="avatar3" value="3">
            <img class="avatar" alt="avatar" src="./images/avatar3.png" width="60" height="60" />
            <input type="radio" class="updateLabels" name="avatar" id="avatar4" value="4">
            <img class="avatar" alt="avatar" src="./images/avatar4.png" width="60" height="60" />
            <input type="radio" class="updateLabels" name="avatar" id="avatar5" value="5">
            <img class="avatar" alt="avatar" src="./images/avatar5.png" width="60" height="60" /> -->
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