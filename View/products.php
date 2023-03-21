<?php

if(session_id() =="") session_start();

require_once '../src/Routes/product_management.php';



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <script defer src="../Controller/register_login.js"></script>
    <link rel="stylesheet" href="global.css">
</head>

<body>

    <?php require_once '../View/header.php'; ?>

    <div id="productsDiv">

        <?php displayProducts() ?> 

    </div>
 

</body>

</html>