<?php

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
$dotenv->required([ 'CLIENT_ID', 'CLIENT_KEY' ]);

define( 'CLIENT_ID', getenv('CLIENT_ID') );
define( 'CLIENT_KEY', getenv('CLIENT_KEY') );
define( 'SERVER_ID', getenv('SERVER_ID') );
define( 'SERVER_KEY', getenv('SERVER_KEY') );

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$auth_client = new Marketplace\Connection\Authentication\Credentials( CLIENT_ID, CLIENT_KEY );
if( !empty( SERVER_ID ) && !empty( SERVER_KEY ) )
    $auth_server = new Marketplace\Connection\Authentication\Credentials( SERVER_ID, SERVER_KEY );
else
    $auth_server = null;

$env = new Marketplace\Connection\Environment();
$auth = new Marketplace\Connection\Authentication( $auth_client, $auth_server );
$conn = new Marketplace\Connection\Connection( $env, $auth );