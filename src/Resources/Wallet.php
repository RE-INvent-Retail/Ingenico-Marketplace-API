<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Resources;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet\WalletOwnerType;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallets;
use asdfklgash\IngenicoMarketplaceAPI\Resources\Wallet\OwnerType;

class Wallet extends Resource
{

    protected $_resource = 'wallets';

    public function getAll( /* TODO: enable filters/pagination/... */ )
    {

        $request = $this->createRequest( $this->_resource );

        $response = $request->GET();

        $wallets = new Wallets();
        if( $response->isSuccess() )
        {
            $json_wallets = json_decode( $response->getBody() );
            foreach ( $json_wallets as $json_wallet )
            {
                $wallet = new \asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet();
                $wallet->setWalletId( $json_wallet->walletId );
                $wallet->setWalletOwnerType( WalletOwnerType::getFromString( $json_wallet->walletOwnerType ));
                $wallet->setAlias( $json_wallet->alias );
                $wallets[] = $wallet;
            }
        }

        return $wallets;

    }

    public function create( \asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet &$wallet )
    {
        $data = [
            'alias' => $wallet->getAlias(),
            'walletOwnerType' => $wallet->getWalletOwnerType(),
            'iban' => $wallet->getIban(),
            'bic' => $wallet->getBic(),
            'bankAccountOwner' => $wallet->getBankAccountOwner()
        ];

        $request = $this->createRequest();
        $request->setData( $data );

        $response = $request->POST();

        if ( $response->isSuccess() )
        {
            $json_create = json_decode( $response->getBody() );
            $wallet->setWalletId( $json_create->walletId );
            return true;
        }
        else
        {
            $err = $response->getError();
            echo 'ERROR: ' . $err->getMessage() . "\n";
            return false;
        }

    }

}