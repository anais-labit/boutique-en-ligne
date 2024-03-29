<?php

use App\Controller\UpdateController;
use App\Model\ProductModel;
use App\Model\UserModel;
use App\Model\CartModel;



is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

// require_once '../../vendor/autoload.php';
require_once ROOT_DIR . '/vendor/autoload.php';

// DASHBOARD //

if (isset($_GET['countCarts'])) {
    $cartModel = new CartModel();
    $totalPaidCarts = $cartModel->countCartsByCriteria('paid', 'YES');
    $totalPendingCarts = $cartModel->countCartsByCriteria('paid', 'NO');

    $totalCarts = [
        'totalCount' => $totalPaidCarts + $totalPendingCarts,
        'paidCount' => $totalPaidCarts,
        'pendingCount' => $totalPendingCarts
    ];

    echo json_encode($totalCarts);
}


if (isset($_GET['countClients'])) {
    $userModel = new UserModel();
    $totalIndividualClients = $userModel->countUsersByCriteria('type', '1');
    $totalBusinessClients = $userModel->countUsersByCriteria('type', '2');

    $clientCounts = [
        'totalCount' => $totalIndividualClients + $totalBusinessClients,
        'type1Count' => $totalIndividualClients,
        'type2Count' => $totalBusinessClients
    ];

    echo json_encode($clientCounts);
}

if (isset($_GET['countTotalRevenue'])) {
    $cartModel = new CartModel();
    $totalRevenue = $cartModel->addPaidCartsAmounts('paid', 'YES');
    $ca = $totalRevenue / 100;
    echo json_encode($ca);
}


// GESTION DES PRODUITS // 

function displayCategoriesInSelect()
{

    $categories = new ProductModel();
    $displayCategories = $categories->readAllCategories();

    foreach ($displayCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] . ">" . $value["category"] . "</option>";
    }
}


function displaySubCategoriesInSelect()
{

    $subCategories = new ProductModel();

    $displaySubCategories = $subCategories->readAllSubCategories();
    var_dump($displaySubCategories);

    foreach ($displaySubCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] . ">" . $value["sub_category"] . "</option>";
    }
}

function displayProducersInSelect()
{

    $subCategories = new ProductModel();

    $displaySubCategories = $subCategories->readAllProducers();
    var_dump($displaySubCategories);

    foreach ($displaySubCategories as $key => $value) {

        echo "
        <option value=" . $value['id'] . ">" . $value["producer"] . "</option>";
    }
}

if (isset($_POST['displayAllCarts'])) {
    $productModel = new CartModel();
    $carts = $productModel->readAllCarts();
    echo json_encode($carts);
}

if (isset($_POST['countAllcarts'])) {
    $cartModel = new CartModel();
    $totalCarts = $cartModel->countAllCarts();
    echo $totalCarts;
}

if (isset($_POST['addProdButton'])) {

    $newproduct = new ProductModel();

    // $productPriceType = $_POST['productPriceType'];

    $targetDir = "../View/assets/images/products/";
    $targetFile = $targetDir . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
    $path = $targetDir . ($_FILES['photo']['name']);

    $newproduct->createOne([
        ':product' => $_POST['productName'],
        ':id_cat' => (int)$_POST['productCat'],
        ':id_sub_cat' => (int)$_POST['productSubCat'],
        ':description' => $_POST['productDesc'],
        ':image' => $path,
        ':origin' => $_POST['productOrigin'],
        ':weight_gr' => (int)$_POST['productWeight'],
        ':id_producer' => (int)$_POST['productProducer'],
        ':' . $_POST['productPriceType'] => (int)$_POST['productPrice']
    ]);
}

if (isset($_POST['addCategoryButton'])) {

    $newproduct = new ProductModel();

    $newproduct->createCategory([':category' => $_POST['categoryName']]);
}

if (isset($_POST['addSubCategoryButton'])) {

    $newproduct = new ProductModel();

    $newproduct->createSubCategory([
        ':sub_category' => $_POST['subCategoryName'],
        ':id_category' => $_POST['subcatCat']
    ]);
}

if (isset($_POST['addProducerButton'])) {

    $newproducer = new ProductModel();

    $targetDir = "../View/assets/images/producers/";
    $targetFile = $targetDir . basename($_FILES['producerPhoto']['name']);
    move_uploaded_file($_FILES['producerPhoto']['tmp_name'], $targetFile);
    $path = $targetDir . ($_FILES['producerPhoto']['name']);

    $newproducer->createProducer([
        ':producer' => $_POST['producerName'],
        ':description' => $_POST['producerDesc'],
        ':image' => $path
    ]);

    // var_dump($_FILES);
}


// GESTION DES UTILISATEURS // 


if (isset($_POST['displayAllUsers'])) {
    $userModel = new UserModel();
    $users = $userModel->readAllUsersByType();
    echo json_encode($users);
}

if (isset($_POST['deleteUser'])) {
    $usertoDelete = new UserModel();
    $usertoDelete->deleteOne([':id' => $_POST['deleteUser']]);
    echo (json_encode(['success' => 'Le compte a bien été supprimé.']));
}

// Vérifier si la clé "updateUserRole" existe dans les données envoyées
if (isset($_POST['updateUserRole'])) {
    // Récupérer les paramètres envoyés depuis le formulaire
    $userId = $_POST['userId'];
    $newRole = $_POST['newRole'];

    // Appeler la méthode updateOne pour mettre à jour le rôle de l'utilisateur
    $userModel = new UserModel();
    $userModel->updateOne(array(
        ':type' => $newRole,
        ':id' => $userId,
    ));

    $response = array('success' => 'Le rôle a été mis à jour avec succès.');
    echo json_encode($response);
    exit;
}
