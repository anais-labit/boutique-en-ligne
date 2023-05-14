<?php

is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

require_once ROOT_DIR .'/vendor/autoload.php';

if(session_id() =="") session_start();


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
<main>
    <div id="singleCardDiv">
        
    </div>
    <?php  if(isset($_SESSION['user'])): ?>
        <div id="rating"></div>
        <form method="POST" id="commentForm"> 
            <label for="comment">Ajouter votre commentaire</label>
            <textarea name="comment" id="commentInput"></textarea>
            <button 
            type="submit" name="commentButton" value="<?=$_GET["productId"]?>" id="commentButton">Envoyer</button>
        </form>
    <?php  else: ?>
        <p>Connectez vous pour laisser votre avis</p>
    <?php  endif; ?>
    

    <div id="comments">

    </div>
    </main>
</body>
