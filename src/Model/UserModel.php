<?php

namespace App\Model;

use App\Model\Abstract\AbstractModel;

class UserModel extends AbstractModel
{

    private ?int $id;

    private ?int $type;

    private ?string $firstName;

    private ?string $lastName;

    private ?string $company;

    private ?string $address;

    private ?int $zipCode;

    private ?string $city;

    private ?int $avatar;

    private ?string $verified;

    private ?string $email;


    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'users';
    }


    public function setId(int $id)
    {

        $this->id = $id;
    }

    public function getId(): int
    {

        return $this->id;
    }

    public function setType(int $type)
    {

        $this->type = $type;
    }

    public function getType(): int
    {

        return $this->type;
    }


    public function setFirstName(string $firstName)
    {

        $this->firstName = $firstName;
    }


    public function getFirstName(): string
    {

        return $this->firstName;
    }



    public function setLastName(string $lastName)
    {

        $this->lastName = $lastName;
    }

    public function getLastName(): string
    {

        return $this->lastName;
    }


    public function setCompany(string $company)
    {

        $this->company = $company;
    }

    public function getCompany(): string
    {

        return $this->company;
    }



    public function setEmail(string $email)
    {

        $this->email = $email;
    }

    public function getEmail(): string
    {

        return $this->email;
    }

    public function setAddress(string $address)
    {

        $this->address = $address;
    }

    public function getAddress(): string
    {

        return $this->address;
    }

    public function setZipCode(int $zipCode)
    {

        $this->zipCode = $zipCode;
    }

    public function getZipCode(): int
    {

        return $this->zipCode;
    }

    public function setCity(string $city)
    {

        $this->city = $city;
    }

    public function getCity(): string
    {

        return $this->city;
    }

    public function setAvatar(int $avatar)
    {

        $this->avatar = $avatar;
    }

    public function getAvatar(): ?int
    {

        return $this->avatar;
    }

    public function setVerified(string $verified)
    {

        $this->verified = $verified;
    }

    public function getVerified(): string
    {

        return $this->verified;
    }



    public function createUser(
        int $type,
        string $firstName,
        string $lastName,
        string $email,
        string $address,
        string $CP,
        string $city,
        string $password
    ) {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        //$SQL = new \PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $request_create_user = "INSERT INTO users
        (type, firstname, lastname, email, address, zip_code, city, password, verified) 
        VALUES (:type, :firstname, :lastname, :email, :address, :zip_code, :city, :password, :verified)";

        $query_create_user = $SQL->prepare($request_create_user);

        $query_create_user->execute(array(
            'type' => $type,
            ':firstname' => $firstName,
            ':lastname' => $lastName,
            ':email' => $email,
            ':address' => $address,
            ':zip_code' => $CP,
            ':city' => $city,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            'verified' => "NON"
        ));
    }

    public function createCompany(
        int $type,
        string $company,
        string $email,
        string $address,
        string $CP,
        string $city,
        string $password
    ) {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        //$SQL = new \PDO('mysql:host=localhost;dbname=alexandre-aloesode_todolistjs;charset=utf8', 'Namrod','azertyAZERTY123!');

        $request_create_company = "INSERT INTO users
        (type, company, email, address, zip_code, city, password, verified) 
        VALUES (:type, :company, :email, :address, :zip_code, :city, :password, :verified)";

        $query_create_company = $SQL->prepare($request_create_company);

        $query_create_company->execute([
            'type' => $type,
            ':company' => $company,
            ':email' => $email,
            ':address' => $address,
            ':zip_code' => $CP,
            ':city' => $city,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            'verified' => "NON"
        ]);
    }







    public function updateUser(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $address,
        int $CP,
        string $city,
        string $password
    ) {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        $request_update_user = "UPDATE users SET 
        firstname = :firstname, lastname = :lastname, email = :email, address = :address, zip_code = :zip_code, city = :city, password = :password
        WHERE id = :id";

        $query_update_user = $SQL->prepare($request_update_user);

        $query_update_user->execute(array(
            ':firstname' => $firstName,
            ':lastname' => $lastName,
            ':email' => $email,
            ':address' => $address,
            ':zip_code' => $CP,
            ':city' => $city,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            'id' => $id
        ));

        if ($query_update_user) return 'Les mises à jour ont bien été prises en compte';
    }


    public function deleteUser()
    {
    }


    public function setSession(string $email): object
    {

        $SQL = new \PDO('mysql:host=localhost;dbname=eShop;charset=utf8', 'root', $this->password);

        $requestUserInfo = "SELECT * FROM users WHERE email = :email";

        $queryUserInfo = $SQL->prepare($requestUserInfo);

        $queryUserInfo->execute(['email' => $email]);

        $resultUserInfo = $queryUserInfo->fetchAll();

        $this->id = $resultUserInfo[0][0];

        $this->type = $resultUserInfo[0][1];

        if ($resultUserInfo[0][1] == 2) {

            $this->company = $resultUserInfo[0][4];
        } else {

            $this->firstName = $resultUserInfo[0][2];

            $this->lastName = $resultUserInfo[0][3];
        }

        $this->email = $resultUserInfo[0][5];

        $this->address = $resultUserInfo[0][6];

        $this->zipCode = $resultUserInfo[0][7];

        $this->city = $resultUserInfo[0][8];

        $this->avatar = $resultUserInfo[0][10];

        $this->verified = $resultUserInfo[0][11];


        return $this;
    }
}
