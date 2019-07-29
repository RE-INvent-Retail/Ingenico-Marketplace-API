<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Objects\Movements;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Movements\MovementsOperation\Credit;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Movements\MovementsOperation\Debit;

class MovementsOperation
{

    const MOVMENTS_OPERATION = '';

    public function __toString()
    {
        return static::MOVMENTS_OPERATION;
    }

    public static function getFromString( $movementsOperation = null )
    {
        switch( strtolower( $movementsOperation ) )
        {
            case 'credit':
                return new Credit();
                break;
            case 'debit':
                return new Debit();
                break;
            default:
                throw new \Exception( 'MovementsOperation ' . $movementsOperation . ' not implemented yet' ); // TODO - own exception!
        }
    }

}