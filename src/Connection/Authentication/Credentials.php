<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Connection\Authentication;


class Credentials
{

    private $_id = null;
    private $_key = null;

    public function __construct( $id, $key )
    {
        $this->_id = $id;
        $this->_key = $key;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getKey()
    {
        return $this->_key;
    }

}