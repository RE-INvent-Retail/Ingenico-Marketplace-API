<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Resources;


use asdfklgash\IngenicoMarketplaceAPI\Connection\Connection;

abstract class Resource
{

    protected $_resource = null;

    protected $_connection = null;

    public function __construct( Connection $connection )
    {
        $this->_connection = $connection;
    }

}