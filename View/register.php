<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription</title>
    <!-- <script defer src="../Controller/register.js"></script> -->
    <script defer src="../src/Controller/register.js"></script>
    <link rel="stylesheet" href="global.css">


</head>

<body>

    <?php include 'header.php' ?>

    <form method="post" class="loginForms" id="registerForm">

        <input type="text" name="registerLastName" class="loginInputs" id="registerFirstName" placeholder="Prénom">
        <input type="text" name="registerFirstName" class="loginInputs" id="registerLastName" placeholder="Nom">

        <input type="email" name="registerEmail" class="loginInputs" id="registerEmail" placeholder="Email">

        <input type="text" name="registerAdress" class="loginInputs" id="registerAdress" placeholder="Adresse">
        <input type="number" name="registerZipCode" class="loginInputs" id="registerZipCode" placeholder="Code Postal">
        <input type="text" name="registerCity" class="loginInputs" id="registerCity" placeholder="Ville">

        <input type="password" name="registerPassword" class="loginInputs" id="registerPassword" placeholder="Mot de passe">
        
        
        <input type="password" name="registerConfirmPassword" class="loginInputs" id="registerConfirmPassword" placeholder="Confirmez votre mot de passe">
        
        <button type="submit" id="registerButton">S'inscrire</button>

    </form>
    
</body>
</html>