<?php

require 'init.inc.php';

$boardings = new Marketplace\Resources\Boarding( $conn );
$result = $boardings->getAll();
