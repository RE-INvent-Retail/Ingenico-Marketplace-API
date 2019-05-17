<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Resources;


use asdfklgash\IngenicoMarketplaceAPI\Connection\Connection;
use asdfklgash\IngenicoMarketplaceAPI\Connection\Request;

abstract class Resource
{

    protected $_resource = null;

    protected $_connection = null;

    public function __construct( Connection $connection )
    {
        $this->_connection = $connection;
    }

    protected function createRequest( $uri = null ) : Request
    {
        if( empty( $uri ) )
            $uri = $this->_resource;
        elseif( substr( $uri, 0, 1 ) == '/' )
            $uri = $this->_resource . $uri;
        return new Request( $this->_connection, $uri );
    }

}