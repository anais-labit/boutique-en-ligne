<?php

require_once '../Model/UserModel.php';

class AuthController {


    public function __construct()
    {
        
    }


    public function register(string $lastName, string $firstName, string $email, string $password) {

        $applicant = new UserModel;

        $checkExistingEmail = $applicant->readOneUser($email);

        if(!empty($checkExistingEmail)) {

            return json_encode(["success" => false, "message" => "Cet email existe déjà"]);

        }

        elseif(empty($checkExistingEmail)) {

            $applicant->createUser($lastName, $firstName, $email, $password);

            return json_encode(["success" => true, "message" => "Compte créé avec succès"]);

        }
}


    public function login(string $email, string $password) {
        
        $user = new UserModel;

        $checkExistingUser = $user->readOneUser($email);

        if(empty($checkExistingUser)) {

            return false;

        }

        elseif(!empty($checkExistingUser)) {

            if(password_verify($password, $checkExistingUser[0][4])) {

                return $checkExistingUser;

            }

        }

    }


}
?>