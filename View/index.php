<?php
    is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';
// require_once ROOT_DIR .'/src/Routes/product_display.php';
require_once ROOT_DIR .'/vendor/autoload.php';

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="global.css">
</head>

<body>
    <?php require_once '../View/header.php'; ?>
    <!-- <form method="post" class="loginForms" id="registerForm">

        <input type="text" name="registerLastName" class="loginInputs" id="registerLastName" placeholder="Nom">
        <input type="text" name="registerFirstName" class="loginInputs" id="registerFirstName" placeholder="Nom">

        <input type="email" name="registerEmail" class="loginInputs" id="registerEmail" placeholder="Email">

        <input type="password" name="registerPassword" class="loginInputs" id="registerPassword" placeholder="Mot de passe">


        <input type="password" name="registerConfirmPassword" class="loginInputs" id="registerConfirmPassword" placeholder="Confirmez votre mot de passe">

        <button type="submit" id="registerButton">S'inscrire</button> -->

    <!-- </form> -->

</body>

</html>