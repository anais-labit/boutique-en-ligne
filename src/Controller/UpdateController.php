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
        string $confpassword
    ) {

        $error = 'Certains champs sont vides';
        $isValid = true; // variable de contrôle

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
        }
        






        if ($isValid) {
            $update = new UserModel();
            $update->updateUser(
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
            $_SESSION['user']->setFirstName($_POST['updateLastName']);
            $_SESSION['user']->setFirstName($_POST['updateEmail']);
            $_SESSION['user']->setFirstName($_POST['updateAddress']);
            $_SESSION['user']->setFirstName($_POST['updateZipCode']);
            $_SESSION['user']->setFirstName($_POST['updateCity']);

            header('Content-Type: application/json');
            echo (json_encode(['success' => 'Les mises à jour ont bien été prises en compte.']));
        }
    }
}


// TODO : redemander l'ancien password si maj du password
// TODO : rehacher le mdp si changement
// TODO : display les message côté client 