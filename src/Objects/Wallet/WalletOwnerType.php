<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet\WalletOwnerType\Merchant;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet\WalletOwnerType\Person;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet\WalletOwnerType\System;

class WalletOwnerType
{

    const WALLET_OWNER_TYPE = '';

    public function __toString()
    {
        return static::WALLET_OWNER_TYPE;
    }

    public static function getFromString( $walletOwnerType = null )
    {
        switch( strtolower( $walletOwnerType ) )
        {
            case 'merchant':
                return new Merchant();
                break;
            case 'person':
                return new Person();
                break;
            case 'system':
                return new System();
                break;
            default:
                throw new \Exception( 'WalletOwnerType ' . $walletOwnerType . ' not implemented yet' ); // TODO - own exception!
        }
    }

}