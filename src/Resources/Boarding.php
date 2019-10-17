<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Resources;


use asdfklgash\IngenicoMarketplaceAPI\Connection\Environment;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Boardings;
use GuzzleHttp\Exception\ServerException;

class Boarding extends Resource
{

    protected $_resource = 'boardings';

    public function getAll( $offset = null, $limit = null, $wallet = null ) : Boardings
    {

        $data = [
            'offset' => $offset,
            'limit' => $limit,
            'wallet' => $wallet
        ];

        $request = $this->createRequest();
        $request->setData( $data );

        $response = $request->GET();

        $boardings = new Boardings();
        if( $response->isSuccess() )
        {
            $json_boardings = json_decode( $response->getBody() );
            foreach ( $json_boardings as $json_boarding )
            {
                $boarding = new \asdfklgash\IngenicoMarketplaceAPI\Objects\Boarding();
                $boarding->setBoardingId( $json_boarding->boardingId );
                $boarding->setWallet( $json_boarding->wallet );
                $boarding->setUrl( $json_boarding->url );
                $boarding->setValidUntil( $json_boarding->validUntil );
                $boarding->setState( $json_boarding->state );
                $boarding->setComment( $json_boarding->comment );
                $boardings[] = $boarding;
            }
        }

        return $boardings;

    }

    public function find( $wallet = null ) : Boardings
    {
        return $this->getAll( null, null, $wallet );
    }

    public function create( \asdfklgash\IngenicoMarketplaceAPI\Objects\Boarding &$boarding )
    {

        $data = [
            'wallet' => $boarding->getWallet()
        ];

        $request = $this->createRequest();
        $request->setData( $data );

        $response = $request->POST();

        if ( $response->isSuccess() )
        {
            $json_create = json_decode( $response->getBody() );
            $boarding->setBoardingId( $json_create->boardingId );
            $boarding->setUrl( $json_create->url );
            $boarding->setState( $json_create->state );
            $boarding->setComment( $json_create->comment );
            return true;
        }
        else
        {
            $err = $response->getError();
            if( $this->_exceptions )
                throw $err;
            else
            {
                echo 'ERROR: ' . $err->getMessage() . "\n";
                return false;
            }
        }


    }

    public function getId( $id )
    {

        $request = $this->createRequest( '/' . $id );

        $response = $request->GET();

        $boarding = new \asdfklgash\IngenicoMarketplaceAPI\Objects\Boarding();
        if( $response->isSuccess() )
        {
            $json_boarding = json_decode( $response->getBody() );
            $boarding->setBoardingId( $json_boarding->boardingId );
            $boarding->setWallet( $json_boarding->wallet );
            $boarding->setUrl( $json_boarding->url );
            $boarding->setValidUntil( $json_boarding->validUntil );
            $boarding->setState( $json_boarding->state );
            $boarding->setComment( $json_boarding->comment );
        }

        return $boarding;

    }

    public function simulate( $id )
    {

        if( !$this->_connection->getEnvironment()->isSandbox() )
            throw new \Exception( 'Simulation is only available in Sandbox' );   // TODO specific Exception

        $request = $this->createRequest( '/' . $id );

        $response = $request->PUT();

        $boarding = new \asdfklgash\IngenicoMarketplaceAPI\Objects\Boarding();
        if( $response->isSuccess() )
        {
            $json_boarding = json_decode( $response->getBody() );
            $boarding->setBoardingId( $json_boarding->boardingId );
            $boarding->setState( $json_boarding->state );
        }

        return $boarding;

    }

}