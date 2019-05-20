<?php

require 'init.inc.php';

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$movements = new Marketplace\Resources\Movements( $conn );

echo 'getAll:' . "\n";
$result = $movements->getAll();
echo " -> movement count " . count( $result ) . "\n";

echo "\n\n";
