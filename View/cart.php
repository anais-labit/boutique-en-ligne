<?php

is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

require_once ROOT_DIR . '/vendor/autoload.php';

use App\Model\CartModel;

if (session_id() == "") session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <script defer src="../src/Controller/cart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="global.css">
</head>

<body>
    <?php require_once '../View/header.php';
    $cart = new CartModel();
    ?>

    <div id="cartDisplay">


    </div>

    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) : ?>
        <div id="cartTotal">
            <p>Total : <?= $cart->getTotalPrice() ?> €</p>
            <button id="cartSubmit" type="submit" name="submitCart" value="submitCart">Valider le panier</button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['user'])) : ?>

        <form method="POST" id="paymentForm">

            <!-- <label for="paymentCompany">Société</label> -->
            <?php if ($_SESSION['user']->getType() == 2) : ?>

                <section class="paymentDivs">

                    <input readonly type="text" class="paymentInput" name="paymentCompany" value="<?= $_SESSION['user']->getCompany() ?>">
                    <i class="fa-regular fa-user" id="paymentIcons"></i>
                </section>
            <?php else : ?>
                <section class="paymentDivs">

                    <input readonly type="text" class="paymentInput" name="paymentFirstName" value="<?= $_SESSION['user']->getFirstName() ?>">
                    <i class="fa-regular fa-user" id="paymentIcons"></i>
                </section>

                <section class="paymentDivs">

                    <input readonly type="text" class="paymentInput" name="paymentLastName" value="<?= $_SESSION['user']->getLastName() ?>">
                    <i class="fa-regular fa-user" id="paymentIcons"></i>
                </section>
                <!-- <label for="paymentEmail">Email</label> -->
            <?php endif; ?>
            <section class="paymentDivs">

                <input readonly type="text" class="paymentInput" name="paymentEmail" value="<?= $_SESSION['user']->getEmail() ?>">
                <i class="fa-regular fa-envelope" id="paymentIcons"></i>
            </section>

            <!-- <label for="paymentAdress">Adresse</label> -->
            <section class="paymentDivs">

                <input readonly type="text" class="paymentInput" name="paymentAdress" value="<?= $_SESSION['user']->getAddress() ?>">
                <i class="fa-regular fa-map" id="paymentIcons"></i>
            </section>
            <!-- <label for="paymentZip">Code postal</label> -->
            <section class="paymentDivs">

                <input readonly type="text" class="paymentInput" name="paymentZip" value="<?= $_SESSION['user']->getZipCode() ?>">
                <i class="fa-solid fa-location-dot" id="paymentIcons"></i>
            </section>

            <!-- <label for="paymentCity">Ville</label> -->
            <section class="paymentDivs">

                <input readonly type="text" class="paymentInput" name="paymentCity" value="<?= $_SESSION['user']->getCity() ?>">
                <i class="fa-solid fa-city" id="paymentIcons"></i>
            </section>

            <section class="paymentDivs">

                <input type="text" class="paymentInput" name="paymentCard" placeholder="Numéro de carte">
                <i class="fa-regular fa-credit-card" id="paymentIcons"></i>
            </section>
            <section class="paymentDivs">

                <input type="month" class="paymentInput" name="paymentMonth" placeholder="MM//YY">
                <i class="fa-regular fa-calendar-days" id="paymentIcons"></i>
            </section>

            <section class="paymentDivs">
                <input type="number" class="paymentInput" name="paymentCVV" maxlength="3" placeholder="CVV">
                <i class="fa-solid fa-lock" id="paymentIcons"></i>
            </section>

            <button type="submit" id="paymentSubmit" name="submitPayment" value="submitPayment">Valider le paiement</button>
        </form>
    <?php else : ?>
        <p>Vous devez être connecté pour valider votre panier</p>

    <?php endif; ?>
    </div>


</body>

</html>