<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Resources;


use GuzzleHttp\Exception\ServerException;

class Wallet extends Resource
{

    protected $_resource = 'wallets';

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
        catch( \Exception $e )
        {
            return false;
        }
    }

    public function create( $alias, $ownerType, $iban, $bic, $bankAccountOwner )
    {
        $data = [
            'alias' => $alias,
            'walletOwnerType' => $ownerType,
            'iban' => $iban,
            'bic' => $bic,
            'bankAccountOwner' => $bankAccountOwner
        ];
        try
        {
            $this->_connection->post( $this->_resource, [ 'json' => $data ] );
        }
        catch( ServerException $e )
        {
            echo $e->getCode() . ': ' . $e->getMessage();
            return false;
        }
        catch( \Exception $e )
        {
            return false;
        }
    }

}