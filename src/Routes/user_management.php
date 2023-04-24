<?php

use App\Controller\AuthController;
use App\Controller\UpdateController;

// is_file("../config.php") == true ?
//     require_once '../config.php':
//     require_once '../../config.php';

require_once ROOT_DIR .'/vendor/autoload.php';

// if(session_id() == "") session_start();

if(isset($_POST['registerEmail'])
&& isset($_POST['registerAdress']) && isset($_POST['registerZipCode']) && isset($_POST['registerCity'])
&& isset($_POST['registerPassword']) && isset($_POST['registerConfirmPassword'])) {

    if(isset($_POST['registerLastName']) && isset($_POST['registerFirstName']) && $_POST['registerCompany'] == null && $_POST['registerType'] == 1) {

        $applicant = new AuthController();

        echo $applicant->register(1, $_POST['registerFirstName'], $_POST['registerLastName'], $_POST['registerCompany'], $_POST['registerEmail'], $_POST['registerAdress'], $_POST['registerZipCode'], $_POST['registerCity'], $_POST['registerPassword']);
    }

    if(isset($_POST['registerCompany']) && $_POST['registerFirstName'] == null && $_POST['registerLastName'] == null && $_POST['registerType'] == 2) {
        
        $applicant = new AuthController();

        echo $applicant->register(2, $_POST['registerFirstName'], $_POST['registerLastName'], $_POST['registerCompany'], $_POST['registerEmail'], $_POST['registerAdress'], $_POST['registerZipCode'], $_POST['registerCity'], $_POST['registerPassword']);
    }
}


if(isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {

    $newAuth = new AuthController();

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


// MAJ DU PROFIL 
if (isset($_POST['updateProfile'])) {
    $update = new UpdateController();
    $reqUpdate = $update->updateUserProfile((int)$_SESSION['user']->getId(), $_POST['updateFirstName'], $_POST['updateLastName'], $_POST['updateEmail'], $_POST['updateAddress'], (int)$_POST['updateZipCode'], $_POST['updateCity'], $_POST['updatePassword'], $_POST['updateConfirmPassword']);
} 
