<?php

require_once '../Controller/AuthController.php';

// if(session_id() == "") session_start();

// if(isset($_POST['disconnect'])) {

//     session_destroy();

//     header('Location: ../View/login.php');
// }


if(isset($_POST['registerEmail'])
&& isset($_POST['registerAdress']) && isset($_POST['registerZipCode']) && isset($_POST['registerCity'])
&& isset($_POST['registerPassword']) && isset($_POST['registerConfirmPassword'])) {

    if(isset($_POST['registerLastName']) && isset($_POST['registerFirstName']) && $_POST['registerCompany'] == null && $_POST['registerType'] == 1) {

        $applicant = new AuthController;

        echo $applicant->register(1, $_POST['registerFirstName'], $_POST['registerLastName'], $_POST['registerCompany'], $_POST['registerEmail'], $_POST['registerAdress'], $_POST['registerZipCode'], $_POST['registerCity'], $_POST['registerPassword']);
    }

    if(isset($_POST['registerCompany']) && $_POST['registerFirstName'] == null && $_POST['registerLastName'] == null && $_POST['registerType'] == 2) {
        
        $applicant = new AuthController;

        echo $applicant->register(2, $_POST['registerFirstName'], $_POST['registerLastName'], $_POST['registerCompany'], $_POST['registerEmail'], $_POST['registerAdress'], $_POST['registerZipCode'], $_POST['registerCity'], $_POST['registerPassword']);
    }
}


if(isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {

    $newAuth = new AuthController;

    $connect = $newAuth->login($_POST['loginEmail'], $_POST['loginPassword']);

    if($connect == false) {

        echo json_encode(["success" => false, "message" => "Informations incorrectes"]);
    }

    else {

        if(session_id() == "") session_start();

        // $_SESSION['user'] = $connect[0];

        $_SESSION['user'] = $connect;

        echo json_encode(["success" => true, "message" => "Connexion réussie"]);

    }
}

?>