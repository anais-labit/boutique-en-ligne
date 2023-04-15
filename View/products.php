<?php

// require_once '../src/Routes/product_management.php';
// is_file("../config.php") == true ?
//     require_once '../config.php' :
//     require_once 'config.php';
    
require_once ROOT_DIR .'/src/Routes/product_display.php';
require_once ROOT_DIR .'/vendor/autoload.php';
// require_once '../src/Model/UserModel.php';
// require_once '../src/Model/ProductModel.php';




if(session_id() =="") session_start();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="/boutique-en-ligne/View/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<body>

    <?php require_once 'View/header.php'; ?>
    <div id="filterDiv">

        <div id="categoriesFiltersDiv">

        </div>

        <div id="subCategoriesFiltersDiv">

        </div>


    </div>
    <div id="productsDiv">

        <?php //displayProducts() ?> 

    </div>
 

</body>

</html>