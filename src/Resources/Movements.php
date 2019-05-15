<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Resources;


use GuzzleHttp\Exception\ServerException;

class Movements extends Resource
{

    protected $_resource = 'movements';

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

    public function get( $id )
    {
        $data = [
            'id' => $id
        ];
        try
        {
            $this->_connection->get( $this->_resource, [ 'query' => $data ] );
        }
        catch( ServerException $e )
        {
            echo $e->getCode() . ': ' . $e->getMessage();
            return false;
        }
    }

}