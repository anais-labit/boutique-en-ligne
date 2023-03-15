<?php

require_once '../Model/Model.php';

class AuthController {

    private ?int $id;

    private ?string $lastName;

    private ?string $firstName;

    private ?string $email;

    private ?string $password;

    public function __construct()
    {
        
    }


    public function register(string $lastName, string $firstName, string $email, string $password) {

        $applicant = new Model;

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
        
        $user = new Model;

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