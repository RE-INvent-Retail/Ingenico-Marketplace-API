<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Resources;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Currency;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Movement;
use asdfklgash\IngenicoMarketplaceAPI\Resources\Exceptions\ParamMissingException;
use GuzzleHttp\Exception\ServerException;

class Movements extends Resource
{

    protected $_resource = 'movements';

    public function getAll( $offset = null, $limit = null, $fromDate = null, $toDate = null, $reference = null, $operation = null, $wallet = null )
    {

        if( empty( $fromDate ) || empty( $toDate ) )
            throw new ParamMissingException('fromDate and toDate are required');

        $data = [
            'offset' => $offset,
            'limit' => $limit,
            'fromDate' => $fromDate->format('YmdHmi'),
            'toDate' => $toDate->format('YmdHmi'),
            'reference' => $reference,
            'operation' => $operation,
            'wallet' => $wallet
        ];

        $request = $this->createRequest();
        $request->setData( $data );

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

    public function getId( $id )
    {

        $request = $this->createRequest( '/' . $id );

        $response = $request->GET();

        if ( $response->isSuccess() )
        {
            $json_movement = json_decode( $response->getBody() );
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
            return $movement;
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

    public function getGatewayFundingAll( $offset = null, $limit = null, $fromDate = null, $toDate = null  )
    {

        if( empty( $fromDate ) || empty( $toDate ) )
            throw new ParamMissingException('fromDate and toDate are required');

        $data = [
            'offset' => $offset,
            'limit' => $limit,
            'fromDate' => $fromDate->format('YmdHmi'),
            'toDate' => $toDate->format('YmdHmi')
        ];

        $request = $this->createRequest( '/' . 'gatewayfunding' );
        $request->setData( $data );

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
        else
        {
            $err = $response->getError();
            if( $this->_exceptions )
                throw $err;
            else
            {
                echo 'ERROR: ' . $err->getMessage() . "\n";
            }
        }

        return $movements;

    }

    public function getGatewayFundingId( $id )
    {

        $request = $this->createRequest( '/' . 'gatewayfunding' . '/' . $id );

        $response = $request->GET();

        if ( $response->isSuccess() )
        {
            $movements = new \asdfklgash\IngenicoMarketplaceAPI\Objects\Movements();
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
            return $movements;
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

    public function getBankFundingAll( $offset = null, $limit = null, $fromDate = null, $toDate = null, $wallet = null  )
    {

        if( empty( $fromDate ) || empty( $toDate ) )
            throw new ParamMissingException('fromDate and toDate are required');

        $data = [
            'offset' => $offset,
            'limit' => $limit,
            'fromDate' => $fromDate->format('YmdHmi'),
            'toDate' => $toDate->format('YmdHmi'),
            'wallet' => $wallet
        ];

        $request = $this->createRequest( '/' . 'bankfunding' );
        $request->setData( $data );

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
        else
        {
            $err = $response->getError();
            if( $this->_exceptions )
                throw $err;
            else
            {
                echo 'ERROR: ' . $err->getMessage() . "\n";
            }
        }

        return $movements;

    }

    public function getBankFundingId( $id )
    {

        $request = $this->createRequest( '/' . 'bankfunding' . '/' . $id );

        $response = $request->GET();

        if ( $response->isSuccess() )
        {
            $movements = new \asdfklgash\IngenicoMarketplaceAPI\Objects\Movements();
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
            return $movements;
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

    public function getTransfers( $offset = null, $limit = null, $fromDate = null, $toDate = null, $gatewayReference = null, $operation = null, $wallet = null )
    {

        if( empty( $fromDate ) || empty( $toDate ) )
            throw new ParamMissingException('fromDate and toDate are required');

        $data = [
            'offset' => $offset,
            'limit' => $limit,
            'fromDate' => $fromDate->format('YmdHmi'),
            'toDate' => $toDate->format('YmdHmi'),
            'gatewayReference' => $gatewayReference,
            'operation' => $operation,
            'wallet' => $wallet
        ];

        $request = $this->createRequest( '/' . 'transfer' );
        $request->setData( $data );

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
                $movement->setGatewayReference( $json_movement->gatewayReference );
                $movement->setGatewayMerchantId( $json_movement->gatewayMerchantId );
                $movements[] = $movement;
            }
        }
        else
        {
            $err = $response->getError();
            if( $this->_exceptions )
                throw $err;
            else
            {
                echo 'ERROR: ' . $err->getMessage() . "\n";
            }
        }

        return $movements;

    }

    public function getTransferId( $id )
    {

        if( empty( $id ) )
            throw new ParamMissingException('id is required');

        $request = $this->createRequest( '/' . 'transfer' . '/' . $id );

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
                $movement->setGatewayReference( $json_movement->gatewayReference );
                $movement->setGatewayMerchantId( $json_movement->gatewayMerchantId );
                $movements[] = $movement;
            }
        }
        else
        {
            $err = $response->getError();
            if( $this->_exceptions )
                throw $err;
            else
            {
                echo 'ERROR: ' . $err->getMessage() . "\n";
            }
        }

        return $movements;

    }

    public function transfer( Movement &$movement )
    {

        if( empty( $movement ) )
            throw new ParamMissingException('movement is required');

        $data = [
            'gatewayReference' => $movement->getGatewayReference(),
            'gatewayMerchantId' => $movement->getGatewayMerchantId(),
            'wallet' => $movement->getWalletId(),
            'amount' => $movement->getAmount(),
            'currency' => (string)$movement->getCurrency(),
            'communication' => $movement->getCommunication(),
            'reference' => $movement->getReference()
        ];

        $request = $this->createRequest( '/' . 'transfer' );
        $request->setData( $data );

        $response = $request->POST();

        if( $response->isSuccess() )
        {
            $json_transfer = json_decode( $response->getBody() );
            $movement->setTransactionId( $json_transfer->transactionId );
            $movement->setStatus( $json_transfer->status );
            $movement->setDate( $json_transfer->date );
            $movement->setOperationDone( $json_transfer->operationDone );
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
            }
            return false;
        }

    }

    public function adjustment( Movement &$movement )
    {

        if( empty( $movement ) )
            throw new ParamMissingException('movement is required');

        $data = [
            'wallet' => $movement->getWalletId(),
            'counterPartWallet' => $movement->getCounterpartWalletId(),
            'amount' => $movement->getAmount(),
            'currency' => (string)$movement->getCurrency(),
            'communication' => $movement->getCommunication(),
            'reference' => $movement->getReference()
        ];

        $request = $this->createRequest( '/' . 'adjustment' );
        $request->setData( $data );

        $response = $request->POST();

        if( $response->isSuccess() )
        {
            $json_transfer = json_decode( $response->getBody() );
            $movement->setTransactionId( $json_transfer->transactionId );
            $movement->setStatus( $json_transfer->status );
            $movement->setDate( $json_transfer->date );
            $movement->setOperationDone( $json_transfer->operationDone );
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
            }
            return false;
        }

    }

    public function refund( Movement &$movement )
    {

        if( empty( $movement ) )
            throw new ParamMissingException('movement is required');

        $data = [
            'gatewayReference' => $movement->getGatewayReference(),
            'gatewayMerchantId' => $movement->getGatewayMerchantId(),
            'wallet' => $movement->getWalletId(),
            'amount' => $movement->getAmount(),
            'currency' => (string)$movement->getCurrency(),
            'communication' => $movement->getCommunication(),
            'reference' => $movement->getReference()
        ];

        $request = $this->createRequest( '/' . 'refund' );
        $request->setData( $data );

        $response = $request->POST();

        if( $response->isSuccess() )
        {
            $json_transfer = json_decode( $response->getBody() );
            $movement->setTransactionId( $json_transfer->transactionId );
            $movement->setStatus( $json_transfer->status );
            $movement->setDate( $json_transfer->date );
            $movement->setOperationDone( $json_transfer->operationDone );
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
            }
            return false;
        }

    }


}