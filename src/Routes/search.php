<?php

define('ANAIS_ROOT_DIR', '/var/www/html/boutique-en-ligne/src');

require_once ANAIS_ROOT_DIR . '/Model/ProductModel.php';

if (isset($_GET['field'])) {
    $word = $_GET['field'];
    $search = new ProductModel();
    $search->catchProductInfos($word);
    // var_dump($word);
}
