<?php

is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

require_once ROOT_DIR . '/vendor/autoload.php';

use App\Model\CartModel;

if (session_id() == "") session_start();


if(isset($_POST['validateCart'])) {

    // echo json_encode(["success" => true , "message" => "Paiement validé"]);

    $paymentCard = $_POST['paymentCard'];
    $paymentMonth = $_POST['paymentMonth'];
    $paymentCVV = $_POST['paymentCVV'];

    if(empty($_POST['paymentCard']) || empty($_POST['paymentMonth']) || empty($_POST['paymentCVV'])) {

        echo json_encode(["success" => false , "message" => "Veuillez remplir tous les champs"]);
    }

    // elseif(!preg_match("/^[0-9]{16}$/", $paymentCard)) {

    //     echo json_encode(["success" => false , "message" => "Numéro de carte invalide"]);
    // }

    // elseif(!preg_match("/^[0-9]{2}$/", $paymentMonth)) {

    //     echo json_encode(["success" => false , "message" => "Mois invalide"]);
    // }

    // elseif(!preg_match("/^[0-9]{3}$/", $paymentCVV)) {

    //     echo json_encode(["success" => false , "message" => "CVV invalide"]);
    // }

    else {

        $cart = new CartModel();
        $cart->validateCart([
            ":paid" => "YES",
            ":id" => $_SESSION['cartId'][0]]);

        unset($_SESSION['cart']);

        echo json_encode(["success" => true , "message" => "Paiement validé"]);
    }
       
}

?>