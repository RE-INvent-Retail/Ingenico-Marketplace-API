<?php

require 'init.inc.php';

$movements = new Marketplace\Resources\Movements( $conn );

$result = $movements->getAll();
print_r($result);

$result = $movements->get( '1234' );
print_r($result);