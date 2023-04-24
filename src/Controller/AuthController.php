<?php


namespace App\Controller;

use App\Model\UserModel;

require_once '../../vendor/autoload.php';
class AuthController {


    public function __construct()
    {

    }


    public function register(int $type, string $firstName, string $lastName, string $company, string $email, 
    string $address, int $zipCode, string $city, string $password) {

        $applicant = new UserModel();

        $checkExistingEmail = $applicant->readOnebyString($email, 'email');

        if(!empty($checkExistingEmail)) {

            return json_encode(["success" => false, "message" => "Cet email existe déjà"]);

        }

        elseif(empty($checkExistingEmail)) {

            if($type == 1) {

                // $applicant->createUser($type, $firstName, $lastName, $email, $adress, $CP, $city, $password);
                $cryptedPassword = password_hash($password, PASSWORD_DEFAULT);
                // $params = [
                //     ':type' => $type,
                //     ':firstname' => $firstName,
                //     ':lastname' => $lastName,
                //     ':email' => $email,
                //     ':address' => $address,
                //     ':zip_code' => $zipCode,
                //     ':city' => $city,
                //     ':password' => $cryptedPassword,
                //     'verified' => "NON"
                // ];
                // $applicant->createOne($params);
                $applicant->createOne([
                    ':type' => $type,
                    ':firstname' => $firstName,
                    ':lastname' => $lastName,
                    ':email' => $email,
                    ':address' => $address,
                    ':zip_code' => $zipCode,
                    ':city' => $city,
                    ':password' => $cryptedPassword,
                    ':verified' => "NON"
                ]);
                
                return json_encode(["success" => true, "message" => "Compte créé avec succès"]);
            }

            elseif($type == 2) {

                $applicant->createCompany($type, $company, $email, $address, $zipCode, $city, $password);
        
                return json_encode(["success" => true, "message" => "Compte créé avec succès"]);
            } 


      


        }
}


    public function login(string $email, string $password) {
        
        $user = new UserModel;

        $checkExistingUser = $user->readOnebyString($email, 'email');

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