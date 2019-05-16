<?php

require '../vendor/autoload.php';
require 'init.inc.php';

use \asdfklgash\IngenicoMarketplaceAPI as Marketplace;

$env = new Marketplace\Connection\Environment();
$auth = new Marketplace\Connection\Authentication( 'CONRAD', '3279054D9C0C86C073417305770BA495' );
$conn = new Marketplace\Connection\Connection( $env, $auth );

$boardings = new Marketplace\Resources\Boarding( $conn );
$result = $boardings->getAll();
