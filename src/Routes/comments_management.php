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
        ':id_product' => (int)$_POST['productId'],
        ':rate' => (int)$_POST['addRating']
    ]);

echo json_encode($_POST);
}

if(isset($_POST['displayComments'])) {

    $comments = new CommentModel();

    $commentsList = $comments->readOnebyForeignKey("id_product", (int)$_POST['displayComments']);

    $ratings = $comments->getAverageRating((int)$_POST['displayComments']);

    // echo $ratings;
    // var_dump($ratings, $commentsList);

    // echo json_encode(["commentList" => $commentsList, "ratings" => $ratings]);
    // echo json_encode(["commentList" => $commentsList]);
    echo json_encode($commentsList);
}

// if(isset($_POST['addRating'])) {
    
//         $rating = new CommentModel();
    
//         $rating->createOne([
//             ':date' => date('Y-m-d H:i:s'),
//             ':rating' => (int)$_POST['addRating'],
//             ':id_user' => (int)$_SESSION['user']->getId(),
//             ':id_product' => (int)$_POST['productId'],
//         ]);
    
//         echo json_encode($_POST);
// }
?>