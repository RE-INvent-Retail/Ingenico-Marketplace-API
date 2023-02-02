<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Connection;


use GuzzleHttp\Exception\ClientException;

class Response
{

    private $_connection = null;
    private $_request = null;

    private $_error  = null;
    private $_error_code = null;
    private $_error_message = null;
    private $_result = null;

    public function __construct( Connection $connection, Request $request )
    {
        $this->_connection = $connection;
        $this->_request = $request;
    }

    public function setError( $e )
    {
        $this->_error = $e;
        // 400 Bad Request?
        if( $e instanceof ClientException )
        {
            switch( $e->getCode() )
            {
                case 404:
                case 400:
                    $response = json_decode( $e->getResponse()->getBody() );
                    $this->_error_code = $response->errorCode;
                    $this->_error_message = $response->message;
                    break;
            }
        }
    }

    public function getError()
    {
        return $this->_error;
    }

    public function setResult( $result = null )
    {
        if( $this->_isAuthenticated() )
            $this->_result = $result;
    }

    public function getResult()
    {
        return $this->_result;
    }

    public function isSuccess() : bool
    {
        return ( empty( $this->_error ) &&
                 ( !is_null( $this->_result ) && ( $this->_result->getStatusCode() >= 200 && $this->_result->getStatusCode() < 300 ) ) );
    }

    private function _isAuthenticated() : bool
    {
        $authentication = $this->_connection->getAuthentication();
        return $authentication->checkAuthorizationHeader( $this->_result, $this->_request->getUri() );
    }

    public function getBody()
    {
        return $this->_result->getBody();
    }

    public function getErrorCode()
    {
        return $this->_error_code;
    }

    public function getErrorMessage()
    {
        return $this->_error_message;
    }

}