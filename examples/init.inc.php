<?php

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
$dotenv->required([ 'LOGIN', 'AESKEY' ]);

define( 'LOGIN', getenv('LOGIN') );
define( 'AESKEY', getenv('AESKEY') );

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$env = new Marketplace\Connection\Environment();
$auth = new Marketplace\Connection\Authentication( LOGIN, AESKEY );
$conn = new Marketplace\Connection\Connection( $env, $auth );