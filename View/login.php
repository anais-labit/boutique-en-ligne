<!-- <?php
// require_once '../src/Controller/AuthController.php';
// require_once '../src/Model/UserModel.php';
is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';
// require_once ROOT_DIR .'/src/Routes/product_display.php';
require_once ROOT_DIR . '/vendor/autoload.php';

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

</head>

<body>

    <?php include 'header.php' ?>

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
        <?php elseif (isset($_SESSION['user'])) : ?>
            <a href="profil.php">profil</a>
        <?php endif ?>

        <?php if (isset($_SESSION['user'])) : ?>
            <button type="submit" name="disconnect" id="decoButton" class="btn">Déconnexion</button>

        <?php else : ?>
            <button type="submit" id="loginButton" class="btn">Connexion</button>
        <?php endif ?>
        <p>Mot de passe oublié ? <a href="#"> Cliquez-ici</a></p>
        <p>Pas encore de compte? <a href="register.php"> S'inscrire</a></p>

    </form>

</body>

<script defer src="../src/Controller/login.js"></script>

</html> -->