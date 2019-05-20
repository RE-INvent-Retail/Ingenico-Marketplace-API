<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Objects;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Currencies\EUR;

class Currency
{

    const CURRENCY = '';

    public function __toString()
    {
        return static::CURRENCY;
    }

    public static function getFromString( $currency = null )
    {
        switch( strtoupper( $currency ) )
        {
            case 'EUR':
                return new EUR();
                break;
            default:
                throw new \Exception( 'Currency ' . $currency . ' not implemented yet' ); // TODO - own exception!
        }
    }

}