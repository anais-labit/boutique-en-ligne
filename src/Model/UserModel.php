<?php

// namespace App//Usermodel;

class UserModel {

    private ?int $id;

    private ?string $firstName;

    private ?string $lastName;

    private ?string $email;

    private ?string $password;

    public function __construct()
    {
        
    }


    public function setId(int $id) {

        $this ->id = $id;
    }

    public function getId():int {
        
        return $this->id;
    }


    public function setFirstName(string $firstName) {

        $this ->firstName = $firstName;
    }

    public function getFirstName():string {
        
        return $this->firstName;
    }



    public function setLastName(string $lastName) {

        $this ->lastName = $lastName;
    }

    public function getLastName():string {
        
        return $this->lastName;
    }



    public function setEmail(string $email) {

        $this->email = $email;
    }

    public function getEmail():string {
        
        return $this->email;
    }


    public function getPassword():string {
        
        return $this->password;
    }



    public function createUser(int $type, string $firstName, string $lastName, string $email, 
    string $adress, string $CP, string $city,string $password) {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root','');

        //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $request_create_user = "INSERT INTO utilisateurs
        (type, prenom, nom, email, adresse, code_postal, ville, password, verifie) 
        VALUES (:type, :prenom, :nom, :email, :adresse, :code_postal, :ville, :password, :verifie)";

        $query_create_user = $SQL->prepare($request_create_user);

        $query_create_user->execute(array(
            'type' => $type,
            ':prenom' => $firstName,
            ':nom' => $lastName,
            ':email' => $email,
            ':adresse' => $adress,
            ':code_postal' => $CP,
            ':ville' => $city,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            'verifie' => "NON"
        ));
    }

    public function createCompany(int $type, string $company, string $email, 
    string $adress, string $CP, string $city,string $password) {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root','');

        //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $request_create_user = "INSERT INTO utilisateurs
        (type, raison_sociale, email, adresse, code_postal, ville, password, verifie) 
        VALUES (:type, :raison_sociale, :email, :adresse, :code_postal, :ville, :password, :verifie)";

        $query_create_user = $SQL->prepare($request_create_user);

        $query_create_user->execute([
            'type' => $type,
            ':raison_sociale' => $company,
            ':email' => $email,
            ':adresse' => $adress,
            ':code_postal' => $CP,
            ':ville' => $city,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            'verifie' => "NON"
        ]);
    }



    public function readAllUsers():array {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root','');

        $requestUsersInfos = "SELECT * FROM utilisateurs";

        $queryUsersInfos = $SQL->prepare($requestUsersInfos);

        $queryUsersInfos->execute();

        $resultUsersInfos = $queryUsersInfos->fetchAll();

        return $resultUsersInfos;
        
    }



    public function readOneUser(string $email):array {

        $SQL = new PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root','');

        $requestCheckEmail = "SELECT * FROM utilisateurs WHERE email = :email";

        $queryCheckEmail = $SQL->prepare($requestCheckEmail);

        $queryCheckEmail->execute(['email' => $email]);

        $resultCheckEmail = $queryCheckEmail->fetchAll();

        return $resultCheckEmail;
    }



    public function updateUser() {


    }


    public function deleteUser() {

    }
}

?>