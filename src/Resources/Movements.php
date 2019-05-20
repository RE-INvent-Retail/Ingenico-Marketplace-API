<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Resources;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Currency;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Movement;
use GuzzleHttp\Exception\ServerException;

class Movements extends Resource
{

    protected $_resource = 'movements';

    public function getAll(  /* TODO: enable filters/pagination/... */  )
    {

        $request = $this->createRequest( $this->_resource );

        $response = $request->GET();

        $movements = new \asdfklgash\IngenicoMarketplaceAPI\Objects\Movements();
        if( $response->isSuccess() )
        {
            $json_movements = json_decode( $response->getBody() );
            foreach ( $json_movements as $json_movement )
            {
                $movement = new Movement();
                $movement->setWalletId( $json_movement->wallet );
                $movement->setCounterpartWalletId( $json_movement->counterpartWallet );
                $movement->setTransactionId( $json_movement->transactionId );
                $movement->setAmount( $json_movement->amount );
                $movement->setCurrency( Currency::getFromString( $json_movement->currency ) );
                $movement->setOperation( $json_movement->operation );
                $movement->setTransactionType( $json_movement->transactionType );
                $movement->setReference( $json_movement->reference );
                $movement->setCommunication( $json_movement->communication );
                $movement->setCreated( $json_movement->created );
                $movements[] = $movement;
            }
        }

        return $movements;

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