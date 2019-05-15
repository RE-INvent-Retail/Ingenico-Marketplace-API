<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Connection;


class Authentication
{

    private $_login = null;
    private $_aeskey = null;

    private $_algorithm = 'sha512';

    public function __construct( $login, $aeskey )
    {
        $this->_login = $login;
        $this->_aeskey = $aeskey;
    }

    public function authenticationHandler()
    {
        return function (callable $handler) {
            return function (\Psr\Http\Message\RequestInterface $request, array $options) use ($handler) {
                $header = $this->getAuthorizationHeader( $request );
                if(!empty($header))
                    $request = $request->withHeader('Authorization', $header);
                return $handler($request, $options);
            };
        };
    }

    public function getAuthorizationHeader( $request )
    {
        $timestamp =  date(\DateTime::ISO8601 );
        $nonce = hash('sha512', rand( 0, PHP_INT_MAX ) );
        //if ($command->getRequest() instanceof EntityEnclosingRequestInterface)
            $body = $request->getBody();

        $data = [
            $timestamp,
            $nonce,
            $request->getMethod(),
            $request->getUri()->getPath(),
            $request->getUri()->getHost(),
            $request->getUri()->getPort(),
            strtoupper( hash($this->_algorithm, $body ) ),
            ''
        ];
        $data_normalized = implode( "\n", $data );
        $hmac = base64_encode( hash_hmac( $this->_algorithm, $data_normalized, $this->_aeskey, true ) );

        $authorization_string = 'Hawk id=[' . $this->_login . ']' .
                                ',ts=[' . $timestamp . ']' .
                                ',nonce=[' . $nonce . ']' .
                                ',mac=[' . $hmac . ']' .
                                ',algorithm=[' . $this->_getAlgorithmForHeader() . ']';

        return $authorization_string;
    }

    private function _getAlgorithmForHeader()
    {
        switch ( $this->_algorithm )
        {
            case 'sha512':
                return 'hmac-sha-512';
                break;
        }
    }

}