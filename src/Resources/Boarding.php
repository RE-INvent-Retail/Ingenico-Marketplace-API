<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Resources;


use GuzzleHttp\Exception\ServerException;

class Boarding extends Resource
{

    protected $_resource = 'boardings';

    public function getAll()
    {
        try
        {
            $this->_connection->get( $this->_resource );
        }
        catch( ServerException $e )
        {
            echo $e->getCode() . ': ' . $e->getMessage();
            return false;
        }
    }

    public function create( $wallet )
    {

    }

}