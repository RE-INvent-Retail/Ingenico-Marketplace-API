<?php

require '../vendor/autoload.php';
require 'init.inc.php';

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$env = new Marketplace\Connection\Environment();
$auth = new Marketplace\Connection\Authentication( 'CONRAD', '3279054D9C0C86C073417305770BA495' );
$conn = new Marketplace\Connection\Connection( $env, $auth );

$wallets = new Marketplace\Resources\Wallet( $conn );

$result = $wallets->getAll();
print_r($result);

$result = $wallets->create( '2004', new Marketplace\Resources\Wallet\OwnerType\Merchant(), 'DE87123456781234567890', 'TESTDE111', 'Markus Zierhut' );

print_r($result);