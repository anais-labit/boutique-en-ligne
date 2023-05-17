<?php

is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

require_once ROOT_DIR . '/vendor/autoload.php';

if (session_id() == "") session_start();


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="../src/Controller/singleCard.js"></script>
    <link rel="stylesheet" href="global.css">
    <title>Product page</title>
</head>

<body>

    <?php include 'header.php' ?>

    <div id="SinglePageContent">

        <div id="singleCardDiv">
            <div id="singleCardPicture"> </div>
            <div id="singleCardContent"> </div>
        </div>

        <?php if (isset($_SESSION['user'])) : ?>
            <div id="rating"></div>
            <form method="POST" id="commentForm">
                <!-- <label for="comment">Ajouter votre commentaire</label> -->
                <textarea name="comment" id="commentInput" placeholder="Votre avis compte!"></textarea>
                <button type="submit" name="commentButton" value="<?= $_GET["productId"] ?>" id="commentButton">Envoyer</button>
            </form>
        <?php else : ?>
            <h2>Connectez vous pour laisser votre avis</h2>
        <?php endif; ?>

        <div id="comments">
            <h2>Commentaires</h2>

        </div>
    </div>

    </div>
</body>