<?php

namespace App\Controller;

if (session_id() == "") session_start();

use App\Model\UserModel;

require_once '../../vendor/autoload.php';
class UpdateController
{
    public function __construct()
    {
    }

    public function updateUserProfile(
        int $id,
        array $values
    ) {

        $userModel = new UserModel();

        if ($_SESSION['user']->getType() === 2 && $_SESSION['user']->getCompany() !== $_POST['updateCompany']) {
            $valuesToSend[':company'] = htmlspecialchars(trim($values['updateCompany']));
        }
        if ($_SESSION['user']->getFirstName() !== $_POST['updateFirstName']) {
            $valuesToSend[':firstname'] = htmlspecialchars(trim($values['updateFirstName']));
        }
        if ($_SESSION['user']->getLastName() !== $_POST['updateLastName']) {
            $valuesToSend[':lastname'] = htmlspecialchars(trim($values['updateLastName']));
        }
        if ($_SESSION['user']->getEmail() !== $_POST['updateEmail']) {
            $valuesToSend[':email'] = htmlspecialchars(trim($values['updateEmail']));
        }
        if ($_SESSION['user']->getAddress() !== $_POST['updateAddress']) {
            $valuesToSend[':address'] = htmlspecialchars(trim($values['updateAddress']));
        }
        if ($_SESSION['user']->getZipCode() !== $_POST['updateZipCode']) {
            $valuesToSend[':zip_code'] = (int)($values['updateZipCode']);
        }
        if ($_SESSION['user']->getCity() !== $_POST['updateCity']) {
            $valuesToSend[':city'] = htmlspecialchars(trim($values['updateCity']));
        }
        if (($values['updatePassword']) !== '' && ($values['updateConfirmPassword']) !== '') {
            $valuesToSend[':password'] = htmlspecialchars(trim(password_hash($values['updatePassword'], PASSWORD_DEFAULT)));
        }

        $error = 'Certains champs sont vides';
        $isValid = true; // variable de contrôle
        $savedPassword = $userModel->getPassword($_SESSION['user']->getEmail());

        // Vérification des champs obligatoires
        $error = 'Certains champs sont vides';
        $isValid = true; // variable de contrôle

        if (empty(trim($_POST['updateFirstName'])) || empty(trim($_POST['updateLastName'])) || empty(trim($_POST['updateEmail'])) || empty(trim($_POST['updateAddress'])) || empty(trim($_POST['updateZipCode'])) || empty(trim($_POST['updateCity']))) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $error]);
            $isValid = false;
        } else if (!filter_var($_POST['updateEmail'], FILTER_VALIDATE_EMAIL)) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'L\'adresse email est invalide.']);
            $isValid = false;
        } else if (!password_verify($_POST['confirmOldPassword'], $savedPassword)) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Les modifications n\'ont pas été prises en compte']);
            $isValid = false;
        } else if ($isValid) {
            // Ajout de l'id à envoyer à la base de données
            $valuesToSend[':id'] = $id;

            // Envoi des valeurs modifiées à la base de données
            $userModel->updateOne($valuesToSend);

            // Mise à jour de la session utilisateur avec les nouvelles valeurs
            $_SESSION['user']->setFirstName($_POST['updateFirstName']);
            $_SESSION['user']->setLastName($_POST['updateLastName']);
            $_SESSION['user']->setEmail($_POST['updateEmail']);
            $_SESSION['user']->setAddress($_POST['updateAddress']);
            $_SESSION['user']->setZipCode($_POST['updateZipCode']);
            $_SESSION['user']->setCity($_POST['updateCity']);

            header('Content-Type: application/json');
            echo (json_encode(['success' => 'Les mises à jour ont bien été prises en compte.']));
        }
    }
}


// TODO : display les messages côté client 