<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Connection;


class Environment
{

    const SANDBOX = 'https://sandbox-marketplace.api-ingenico.com/MarketplaceAPIService/v1/';
    const PRODUCTION = 'https://marketplace.api-ingenico.com/MarketplaceAPIService/v1/';

    private $_base_url = null;

    public function __construct()
    {
        $this->setSandbox();
    }

    public function setSandbox()
    {
        $this->_base_url = self::SANDBOX;
    }

    public function isSandbox()
    {
        return $this->_base_url === self::SANDBOX;
    }

    public function setProduction()
    {
        $this->_base_url = self::PRODUCTION;
    }

    public function isProduction()
    {
        return $this->_base_url === self::PRODUCTION;
    }

    public function getBaseUrl()
    {
        return $this->_base_url;
    }

}