<?php

namespace asdfklgash\IngenicoMarketplaceAPI\Connection\Exceptions;

class BadRequestException extends \Exception
{

    private $_http_status_code = null;
    private $_http_reason_phrase = null;
    private $_response = null;

    public function __construct( $httpStatusCode, $httpReasonPhrase, $response )
    {
        $this->_http_status_code = $httpStatusCode;
        $this->_http_reason_phrase = $httpReasonPhrase;
        $this->_response = $response;

        $this->_getErrorFromResponse( $response );

        parent::__construct();
    }

    private function _getErrorFromResponse( $response )
    {
        $json = json_decode( $response );
        $this->code = $json->errorCode;
        $this->message = $json->message;
    }

    /**
     * @return null
     */
    public function getHttpStatusCode()
    {
        return $this->_http_status_code;
    }

    /**
     * @param null $http_status_code
     */
    public function setHttpStatusCode( $http_status_code ): void
    {
        $this->_http_status_code = $http_status_code;
    }

    /**
     * @return null
     */
    public function getHttpReasonPhrase()
    {
        return $this->_http_reason_phrase;
    }

    /**
     * @param null $http_reason_phrase
     */
    public function setHttpReasonPhrase( $http_reason_phrase ): void
    {
        $this->_http_reason_phrase = $http_reason_phrase;
    }

}