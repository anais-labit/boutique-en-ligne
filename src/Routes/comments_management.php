<?php

use App\Model\CommentModel;

is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

require_once ROOT_DIR . '/vendor/autoload.php';

if (session_id() == "") session_start();


if(isset($_POST["sendComment"])) {

    $comment = new CommentModel();

    $comment->createOne([       
        ':date' => date('Y-m-d H:i:s'),
        ':comment' => $_POST['comment'],
        ':id_user' => (int)$_SESSION['user']->getId(),
        ':user_first_name' => $_SESSION['user']->getFirstName(),
        ':user_avatar' => $_SESSION['user']->getAvatar(),
        ':id_product' => (int)$_POST['productId'],
        ':rate' => (int)$_POST['addRating']
    ]);

echo json_encode($_POST);
}

if(isset($_POST['displayComments'])) {

    $comments = new CommentModel();

    $commentsList = $comments->readOnebyForeignKey("id_product", (int)$_POST['displayComments']);
    // var_dump($commentsList);

    echo json_encode($commentsList);
}

?>