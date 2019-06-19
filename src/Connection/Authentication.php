<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Connection;


use asdfklgash\IngenicoMarketplaceAPI\Connection\Authentication\Credentials;

class Authentication
{

    private $_client = null;
    private $_server = null;

    private $_algorithm = 'sha512';

    // TODO: do Server and Client auth...
    public function __construct( Credentials $client, Credentials $server = null )
    {
        if( $client->isValid() )
            $this->_client = $client;
        if( $server->isValid() )
            $this->_server = $server;
    }

    public function authenticationHandler()
    {
        return function (callable $handler) {
            return function (\Psr\Http\Message\RequestInterface $request, array $options) use ($handler) {
                $header = $this->createAuthorizationHeader( $request );
                if(!empty($header))
                {
                    // TODO: Logging
                    $request = $request->withHeader('Authorization', $header);
                }
                return $handler($request, $options);
            };
        };
    }

    public function createAuthorizationHeader( $request )
    {

        $algorithm = $this->_algorithm;
        $timestamp =  date(\DateTime::ISO8601 );
        $nonce = hash('sha512', random_int( PHP_INT_MIN, PHP_INT_MAX ) );
        $method = $request->getMethod();
        $uri = $request->getUri();
        $body = $request->getBody()->getContents();

        $hmac = $this->_buildHash( $this->_client->getKey(), $algorithm, $timestamp, $nonce, $method, $uri, $body );

        $authorization_string = 'Hawk id=[' . $this->_client->getId() . ']' .
                                ',ts=[' . $timestamp . ']' .
                                ',nonce=[' . $nonce . ']' .
                                ',mac=[' . $hmac . ']' .
                                ',algorithm=[' . $this->_getAlgorithmForHeader( $algorithm ) . ']';

        return $authorization_string;
    }

    private function _getAlgorithmForHeader( $algorithm )
    {
        switch ( $algorithm )
        {
            case 'sha512':
                return 'hmac-sha-512';
                break;
        }
    }

    private function _getAlgorithmFromHeader( $algorithm )
    {
        switch ( $algorithm )
        {
            case 'hmac-sha-512':
                return 'sha512';
                break;
        }
    }

    public function checkAuthorizationHeader( $response, $uri )
    {

        // no check if no credentials set
        if( empty( $this->_server ) )
            return true;

        $header = $response->getHeader( 'Authorization' );
        if( !empty( $header ) )
            $authorization = $header[ 0 ];
        $hawk = [];
        preg_match_all( '/(\w+)=\[(.+?)\]/i', $authorization, $matches );
        for( $i = 0; $i < count( $matches[ 0 ] ); $i++ )
        {
            $key = $matches[ 1 ][ $i ]; // Key
            $value = $matches[ 2 ][ $i ]; // Value
            $hawk[ $key ] = $value;
        }

        $algorithm = $hawk[ 'algorithm' ];
        $timestamp = $hawk[ 'ts' ];
        $nonce = $hawk[ 'nonce' ];
        $body = $response->getBody()->getContents();

        $hmac = $this->_buildHash( $this->_server->getKey(), $this->_getAlgorithmFromHeader( $algorithm ), $timestamp, $nonce, null, $uri, $body );

        return ( $this->_server->getId() === $hawk[ 'id' ] && $hmac === $hawk[ 'mac' ] );

    }

    private function _buildHash( $aeskey, $algorithm, $timestamp, $nonce, $method, $uri, $body )
    {
        $data = [
            $timestamp,
            $nonce,
            $method,
            $uri->getPath(),
            $uri->getHost(),
            ( !empty( $uri->getPort() ) ? $uri->getPort() : ( $uri->getScheme() == 'http' ? '80' : '443' ) ),
            strtoupper( hash( $this->_algorithm, $body ) ),
            ''
        ];
        if( is_null( $method ) )
            array_splice($data, 2, 1 );

        $data_normalized = implode( "\n", $data );

        $hmac = base64_encode( hash_hmac( $algorithm, $data_normalized, $aeskey, true ) );

        return $hmac;
    }

}