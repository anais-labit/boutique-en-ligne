<?php
require_once 'config.php';
require_once ROOT_DIR . '/vendor/autoload.php';
$router = new AltoRouter();

$router->setBasePath('/boutique-en-ligne');

$router->map( 'GET', '/index', function() {
    require __DIR__ . '/View/homepage.php';
    // echo 'test';
});

$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}





$router->map( 'GET', '/produits', function() {
    require __DIR__ . '/View/products.php';
    // require __DIR__ . '/src/Controller/cart.js';
    // echo 'test';
});

$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

?>