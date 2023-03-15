<?php
session_start();
require_once '../Model/Product.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <script defer src="../Controller/register_login.js"></script>
</head>

<body>
    <?php require_once '../View/header.php'; ?>
    <form method="post" class="loginForms" id="registerForm">

        <input type="text" name="registerLastName" class="loginInputs" id="registerLastName" placeholder="Nom">
        <input type="text" name="registerFirstName" class="loginInputs" id="registerFirstName" placeholder="Nom">

        <input type="email" name="registerEmail" class="loginInputs" id="registerEmail" placeholder="Email">

        <input type="password" name="registerPassword" class="loginInputs" id="registerPassword" placeholder="Mot de passe">


        <input type="password" name="registerConfirmPassword" class="loginInputs" id="registerConfirmPassword" placeholder="Confirmez votre mot de passe">

        <button type="submit" id="registerButton">S'inscrire</button>

    </form>

</body>

</html>