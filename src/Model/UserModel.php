<?php


class UserModel {

    // public ?PDO $SQL; 

    // = new PDO('mysql:host=localhost;dbname=EshopPACA;charset=utf8', 'root','');

    private ?string $firstName;

    private ?string $lastName;

    private ?string $email;

    private ?string $password;

    public function __construct()
    {
        
    }



    public function getFirstName():string {
        
        return $this->firstName;
    }


    public function getLastName():string {
        
        return $this->lastName;
    }


    public function getEmail():string {
        
        return $this->email;
    }


    public function getPassword():string {
        
        return $this->password;
    }



    public function createUser(string $lastName, string $firstName, string $email, string $password) {

        $SQL = new PDO('mysql:host=localhost;dbname=EshopPACA;charset=utf8', 'root','');

        //$SQL = new PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $request_create_user = "INSERT INTO utilisateurs(prenom, nom, email, password) VALUES (:prenom, :nom, :email, :password)";

        $query_create_user = $SQL->prepare($request_create_user);

        $query_create_user->execute(array(
            ':prenom' => $lastName,
            ':nom' => $firstName,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        ));
    }



    public function readAllUsers():array {

        $SQL = new PDO('mysql:host=localhost;dbname=EshopPACA;charset=utf8', 'root','');

        $requestUsersInfos = "SELECT * FROM utilisateurs";

        $queryUsersInfos = $SQL->prepare($requestUsersInfos);

        $queryUsersInfos->execute();

        $resultUsersInfos = $queryUsersInfos->fetchAll();

        return $resultUsersInfos;
        
    }



    public function readOneUser(string $email):array {

        $SQL = new PDO('mysql:host=localhost;dbname=EshopPACA;charset=utf8', 'root','');

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