<?php

require 'init.inc.php';

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$movements = new Marketplace\Resources\Movements( $conn );

echo 'getAll:' . "\n";
$result = $movements->getAll();
echo " -> movement count " . count( $result ) . "\n";

print_r($result);

echo "\n\n";

echo str_repeat( '-', 80 ) . "\n";

echo 'getId:' . "\n";
$movement_id = null;
if( !empty( $movement_id ) )
{
    $result = $movements->getId( $movement_id );
    echo " -> movement: " . "\n";
    print_r($result);
}

echo "\n\n";

echo str_repeat( '-', 80 ) . "\n";

echo 'getGatewayFunding:' . "\n";
$result = $movements->getGatewayFundingAll( null, null, date_create('-1 year'), date_create());
echo " -> gateway funding count " . count( $result ) . "\n";

print_r($result);

echo "\n\n";

echo str_repeat( '-', 80 ) . "\n";

echo 'getGatewayFundingId:' . "\n";
$movement_id = 43245932;
$result = $movements->getGatewayFundingId( $movement_id );
echo " -> movement: " . "\n";
print_r($result);

echo "\n\n";

echo str_repeat( '-', 80 ) . "\n";

echo 'getBankFunding:' . "\n";
$result = $movements->getBankFundingAll( null, null, date_create('-1 year'), date_create());
echo " -> bank funding count " . count( $result ) . "\n";

print_r($result);

echo "\n\n";

echo str_repeat( '-', 80 ) . "\n";

echo 'getBankFundingId:' . "\n";
$movement_id = null;
if( !empty( $movement_id ) )
{
    $result = $movements->getBankFundingId( $movement_id );
    echo " -> movement: " . "\n";
    print_r($result);
}

echo "\n\n";

echo str_repeat( '-', 80 ) . "\n";

echo 'getTransfers:' . "\n";
$result = $movements->getTransfers( null, null, date_create('-1 year'), date_create());
echo " -> transfers count " . count( $result ) . "\n";

print_r($result);

echo "\n\n";

echo str_repeat( '-', 80 ) . "\n";

echo 'getTransfer:' . "\n";
$transaction_id = null;
if( !empty( $transaction_id ) )
{
    $result = $movements->getTransferId( $transaction_id );
    echo " -> transfers count " . count( $result ) . "\n";
    print_r($result);
}

echo "\n\n";

echo str_repeat( '-', 80 ) . "\n";

echo 'transfer:' . "\n";
$transfer = new Marketplace\Objects\Movement();
$transfer->setGatewayReference('3051016703');
$transfer->setGatewayMerchantId( 'RetailINTMKPtest' );
$transfer->setWalletId( 321103902409);
$transfer->setAmount(33.4);
$transfer->setCurrency(new Marketplace\Objects\Currencies\EUR());
$transfer->setCommunication('');
$transfer->setReference('195002770-A');
$result = $movements->transfer( $transfer );
if( $result )
    echo ' -> successful: #' . $transfer->getTransactionId() . ' -> ' . $transfer->getStatus() . ' (@ ' . $transfer->getDate() . ' = ' . $transfer->getOperationDone() . ')' . "\n";
else
    echo ' --> error!' . "\n";

echo "\n\n";

echo str_repeat( '-', 80 ) . "\n";
