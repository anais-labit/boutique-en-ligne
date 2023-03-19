<?php

class Product
{
    private $PDO;
    private ?string $name;
    private ?string $id_producteur;

    public function __construct() {
        $DB_DSN = 'mysql:host=localhost; dbname=eShop';
        $DB_USER = 'root';
        $DB_PASS = '';

        try {
            $this->PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS);
            // echo 'Connexion établie';
            // return TRUE;
        } catch (PDOException $e) {
            die('ERREUR :' . $e->getMessage());
        }
    }

    public function catchProductInfos($word)
    {
        $this->PDO;
        $req = "SELECT * FROM produits WHERE nom LIKE '$word%'";
        
        $catchProduct = $this->PDO->prepare($req);
        $catchProduct->execute();
        $results = $catchProduct->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
    }
}

?>
