<?php 

    if(session_id() == "") session_start();
    var_dump($_SESSION['user']);
    // session_destroy();

    var_dump($_SESSION['user']['email']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <!-- <script defer src="./src/Controller/login.js"></script> -->
    <script defer src="../src/Controller/login.js"></script>
</head>

<body>

    <form method="post" class="loginForms" id="loginForm">

        <input type="email" name="loginEmail" class="loginInputs" id="loginEmail" placeholder="Email">

        <input type="password" name="loginPassword" class="loginInputs" id="loginPassword" placeholder="Mot de passe">
                
        <button type="submit" id="loginButton">Connexion</button>

    </form>
    
</body>
</html>