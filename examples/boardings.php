<?php

require 'init.inc.php';

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$boardings = new Marketplace\Resources\Boarding( $conn );

echo 'getAll:' . "\n";
$result = $boardings->getAll();
echo " -> boarding count " . count( $result ) . "\n";

echo "\n\n";

/*
echo 'create:' . "\n";
$boarding = new Marketplace\Objects\Boarding();
$boarding->setWallet( 321103814806 );
$result = $boardings->create( $boarding );
if( $result === true )
    echo ' -> new ID: ' . $boarding->getBoardingId() . "\n";
else
    echo 'error occured';

echo "\n\n";
*/

echo 'getId: ' . "\n";
$boarding_id = 1551231;
$result = $boardings->getId( $boarding_id );
echo ' -> ID: ' . $result->getBoardingId() . "\n";
echo ' -> URL: ' . $result->getUrl() . "\n";
echo ' -> gültig bis: ' . $result->getValidUntil() . "\n";


echo "\n\n";

//echo 'put: ' . "\n";
//$boarding_id = 1548233;
//$result = $boardings->simulate( $boarding_id );
//    echo ' -> new ID: ' . $result->getBoardingId() . "\n";

echo "\n\n";