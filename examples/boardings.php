<?php

require 'init.inc.php';

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$boardings = new Marketplace\Resources\Boarding( $conn );
$result = $boardings->getAll();
