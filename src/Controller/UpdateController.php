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
        string $firstName,
        string $lastName,
        string $email,
        string $address,
        int $CP,
        string $city,
        string $password,
        string $confpassword,
        string $oldpassword,
    ) {

        $userModel = new UserModel();

        $error = 'Certains champs sont vides';
        $isValid = true; // variable de contrôle
        $savedPassword = $userModel->getPassword($email);

        if (empty(trim($firstName)) || empty(trim($lastName)) || empty(trim($email)) || empty(trim($address)) || empty(trim($CP)) || empty(trim($city)) || empty(trim($password))) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $error]);
            $isValid = false;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'L\'adresse email est invalide.']);
            $isValid = false;
        } else if ($password !== $confpassword) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Les mots de passe ne correspondent pas.']);
            $isValid = false;
        } else if (!password_verify($oldpassword, $savedPassword)) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Les modifications n\'ont pas été prises en compte']);
            $isValid = false;
        } else if ($isValid) {

            $userModel->updateUser(
                $id,
                $firstName,
                $lastName,
                $email,
                $address,
                $CP,
                $city,
                $password
            );

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