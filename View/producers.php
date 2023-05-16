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
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <?php require_once '../View/header.php'; ?>

    <section class="producers-page-container">
        <h1 class="producers-page-container-heading">Nos <span>Producteurs</span></h1>
        <div class="producers-page-card">
            <div class="producers-page-title">
                <h3>Guillaume</h3>
            </div>
            <div class="producers-img">
                <img src="../View/assets/images/producers/producteur1.jpg" alt="">
            </div>
            <div class="producers description">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis vel repellendus libero suscipit beatae quasi nesciunt, corrupti reiciendis laboriosam ut praesentium distinctio natus provident corporis? Corrupti, quos! Nesciunt at quidem a dolores inventore molestias excepturi, voluptatum voluptates, molestiae porro facere numquam consequuntur minus. Non doloribus, eius sunt minus corrupti iusto?</p>
            </div>

            <div class="divider"></div>

            <div class="producers-page-title">
                <h3>José</h3>
            </div>
            <div class="producers-img">
                <img src="../View/assets/images/producers/producteur2.jpg" alt="">
            </div>
            <div class="producers description">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis vel repellendus libero suscipit beatae quasi nesciunt, corrupti reiciendis laboriosam ut praesentium distinctio natus provident corporis? Corrupti, quos! Nesciunt at quidem a dolores inventore molestias excepturi, voluptatum voluptates, molestiae porro facere numquam consequuntur minus. Non doloribus, eius sunt minus corrupti iusto?</p>
            </div>
    </section>

</body>

</html>