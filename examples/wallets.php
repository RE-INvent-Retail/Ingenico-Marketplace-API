<?php

require 'init.inc.php';

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$wallets = new Marketplace\Resources\Wallet( $conn );

$result = $wallets->getAll();
print_r($result);

$result = $wallets->create( '2004', new Marketplace\Resources\Wallet\OwnerType\Merchant(), 'DE87123456781234567890', 'TESTDE111', 'Markus Zierhut' );

print_r($result);