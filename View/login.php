<?php
// require_once '../src/Controller/AuthController.php';
require_once '../src/Model/UserModel.php';

if (session_id() == "") session_start();
// session_destroy();

// var_dump($_SESSION['user']['email']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="../src/Controller/login.js"></script>

</head>

<body>

    <?php include 'header.php' ?>

    <form method="post" class="loginForms" id="loginForm">

        <input type="email" name="loginEmail" class="loginInputs" id="loginEmail" placeholder="Email">

        <input type="password" name="loginPassword" class="loginInputs" id="loginPassword" placeholder="Mot de passe">

        <button type="submit" id="loginButton">Connexion</button>

    </form>

</body>

</html>