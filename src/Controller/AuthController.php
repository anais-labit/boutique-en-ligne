<?php

// require_once '../Model/UserModel.php';
// if(session_id() == "") session_start();

namespace App\Controller;

use App\Model\UserModel;

require_once '../../vendor/autoload.php';
class AuthController {


    public function __construct()
    {
        
    }


    public function register(int $type, string $firstName, string $lastName, string $company, string $email, 
    string $adress, int $CP, string $city, string $password) {

        $applicant = new UserModel();

        $checkExistingEmail = $applicant->readOneUser($email);

        if(!empty($checkExistingEmail)) {

            return json_encode(["success" => false, "message" => "Cet email existe déjà"]);

        }

        elseif(empty($checkExistingEmail)) {

            if($type == 1) {

                $applicant->createUser($type, $firstName, $lastName, $email, $adress, $CP, $city, $password);
                
                return json_encode(["success" => true, "message" => "Compte créé avec succès"]);
            }

            elseif($type == 2) {

                $applicant->createCompany($type, $company, $email, $adress, $CP, $city, $password);
        
                return json_encode(["success" => true, "message" => "Compte créé avec succès"]);
            } 


      


        }
}


    public function login(string $email, string $password) {
        
        $user = new UserModel;

        $checkExistingUser = $user->readOneUser($email);

        if(empty($checkExistingUser)) {

            return false;

        }

        elseif(!empty($checkExistingUser)) {

            if(password_verify($password, $checkExistingUser[0][9])) {

                // return $checkExistingUser;
                // if(session_id() == "") session_start();
                // if(session_id() == "") session_start();

                $connectedUser = $user->setSession($email);

                return $connectedUser;

            }

        }

    }


}
?>