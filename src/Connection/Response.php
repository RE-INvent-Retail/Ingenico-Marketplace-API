<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Connection;


class Response
{

    private $_connection = null;
    private $_request = null;

    private $_error  = null;
    private $_result = null;

    public function __construct( Connection $connection, Request $request )
    {
        $this->_connection = $connection;
        $this->_request = $request;
    }

    public function setError( $e )
    {
        $this->_error = $e;
    }

    public function getError()
    {
        return $this->_error;
    }

    public function setResult( $result )
    {
        $this->_result = $result;

        $this->_isAuthenticated();
    }

    public function getResult()
    {
        return $this->_result;
    }

    public function isSuccess() : bool
    {
        return ( empty( $this->_error ) && ( $this->_result->getStatusCode() >= 200 && $this->_result->getStatusCode() < 300 ) );
    }

    private function _isAuthenticated() : bool
    {
        $authentication = $this->_connection->getAuthentication();
        $authentication->checkAuthorizationHeader( $this->_result, $this->_request->getUri() );
        return false;
    }

    public function getBody()
    {
        return $this->_result->getBody();
    }

}