<?php

namespace App\Controller;

// require_once '../Model/UserModel.php';
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


        


        $update = new UserModel();
        $reqUpdate = $update->updateUser(
            $id,
            $firstName,
            $lastName,
            $email,
            $address,
            $CP,
            $city,
            $password
        );

        return $reqUpdate;
    }
}
