<?php

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

define( 'LOGIN', getenv('LOGIN') );
define( 'AESKEY', getenv('AESKEY') );

require '../vendor/autoload.php';

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$env = new Marketplace\Connection\Environment();
$auth = new Marketplace\Connection\Authentication( LOGIN, AESKEY );
$conn = new Marketplace\Connection\Connection( $env, $auth );