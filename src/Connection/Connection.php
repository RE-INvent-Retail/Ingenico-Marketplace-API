<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class Connection
{

    private $_environment = null;
    private $_authentication = null;
    private $_client = null;

    private $_debug = false;

    public function __construct( Environment $environment, Authentication $authentication )
    {
        $this->_environment = $environment;
        $this->_authentication = $authentication;
        $this->_client = $this->_createClient();
    }

    private function _createClient() : ?Client
    {

        // general options
        $options = [
            'base_uri' => $this->_environment->getBaseUrl(),
            'headers' => [
                'Accept' => 'application/json'
            ]
        ];

        // handler for authentication
        $handler = HandlerStack::create();
        $handler->push( $this->_authentication->authenticationHandler() );
        $options[ 'handler' ] = $handler;

        $client = new Client( $options );

        return $client;

    }

    public function __call( $name, $arguments )
    {
        return call_user_func_array( [ $this->_client, $name ], $arguments );
    }

    public function getEnvironment()
    {
        return $this->_environment;
    }

    public function getAuthentication()
    {
        return $this->_authentication;
    }

    public function isDebug()
    {
        return $this->_debug;
    }

    public function setDebug( $debug = true )
    {
        $this->_debug = $debug;
    }

}