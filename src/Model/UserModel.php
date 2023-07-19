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

    private ?string $avatar;

    private ?string $verified;

    private ?string $email;

    public function __construct()
    {
        parent::connect();
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

    public function setAvatar(string $avatar)
    {

        $this->avatar = $avatar;
    }

    public function getAvatar(): ?string
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


        $request_create_user = "INSERT INTO users
        (type, firstname, lastname, email, address, zip_code, city, password, verified) 
        VALUES (:type, :firstname, :lastname, :email, :address, :zip_code, :city, :password, :verified)";

        $query_create_user = self::getPdo()->prepare($request_create_user);

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


        $request_create_company = "INSERT INTO users
        (type, company, email, address, zip_code, city, password, verified) 
        VALUES (:type, :company, :email, :address, :zip_code, :city, :password, :verified)";

        $query_create_company = self::getPdo()->prepare($request_create_company);

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

    public function getPassword(string $email): string
    {
        $queryUserPassword = self::getPdo()->prepare('SELECT password FROM users WHERE email = :email');
        $queryUserPassword->execute(['email' => $email]);
        $userPassword = $queryUserPassword->fetch();
        if ($queryUserPassword) return $userPassword['password'];
    }


    public function setSession(string $email): object
    {


        $requestUserInfo = "SELECT * FROM users WHERE email = :email";

        $queryUserInfo = self::getPdo()->prepare($requestUserInfo);

        $queryUserInfo->execute(['email' => $email]);

        $resultUserInfo = $queryUserInfo->fetchAll();

        $this->id = $resultUserInfo[0]['id'];

        $this->type = $resultUserInfo[0]['type'];

        if ($resultUserInfo[0]['type'] == 2) {

            $this->company = $resultUserInfo[0]['company'];
        } else {

            $this->firstName = $resultUserInfo[0]['firstname'];

            $this->lastName = $resultUserInfo[0]['lastname'];
        }

        $this->email = $resultUserInfo[0]['email'];

        $this->address = $resultUserInfo[0]['address'];

        $this->zipCode = $resultUserInfo[0]['zip_code'];

        $this->city = $resultUserInfo[0]['city'];

        $this->avatar = $resultUserInfo[0]['avatar'];

        $this->verified = $resultUserInfo[0]['verified'];


        return $this;
    }

    public function readAllUsers(): array
    {

        $this->tableName = "users";

        return $this->readAll();
    }

    public function readAllUsersByType(): array
    {
        
        $requestReadAll = "SELECT * FROM users ORDER BY 
        CASE 
        WHEN type = '4' THEN 1
        WHEN type = '3' THEN 2
        WHEN type = '1' THEN 3
        WHEN type = '2' THEN 4
        END";

        $queryReadAll = self::getPdo()->prepare($requestReadAll);
        $queryReadAll->execute();
        $resultReadAll = $queryReadAll->fetchAll();

        return $resultReadAll;
    }


    public function countUsersByCriteria(string $fieldName, string $fieldValue): int
    {
        $this->tableName = "users";
        return $this->countByCriteria($fieldName, $fieldValue);
    }
}
