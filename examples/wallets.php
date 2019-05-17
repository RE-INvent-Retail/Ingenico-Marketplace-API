<?php

require 'init.inc.php';

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$wallets = new Marketplace\Resources\Wallet( $conn );

echo 'getAll:' . "\n";
$result = $wallets->getAll();
echo " -> wallet count " . count( $result ) . "\n";

echo "\n\n";

echo 'create:' . "\n";
$wallet = new Marketplace\Objects\Wallet();
$wallet->setAlias( 'mirakl_' . '2015' );
$wallet->setWalletOwnerType( new Marketplace\Objects\Wallet\WalletOwnerType\Merchant() );
$wallet->setIban('DE12123456781234567890');
$wallet->setBic('');
$wallet->setBankAccountOwner('Peter Beitzel' );
$result = $wallets->create( $wallet );
if( $result === true )
    echo ' -> new ID: ' . $wallet->getWalletId() . "\n";
else
    echo 'error occured';