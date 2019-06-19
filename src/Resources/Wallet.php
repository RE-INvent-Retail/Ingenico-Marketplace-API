<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Resources;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Currency;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet\Balance;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet\BankAccount;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet\WalletOwnerType;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallets;
use asdfklgash\IngenicoMarketplaceAPI\Resources\Wallet\OwnerType;

class Wallet extends Resource
{

    protected $_resource = 'wallets';

    public function getAll( /* TODO: enable filters/pagination/... */ ) : Wallets
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
        elseif( $this->_exceptions )
        {
            throw $response->getError();
        }

        return $wallets;

    }

    public function create( \asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet &$wallet ) : bool
    {

        // todo: check needed parameters

        $data = [
            'alias' => $wallet->getAlias(),
            'walletOwnerType' => $wallet->getWalletOwnerType(),
            'iban' => $wallet->getBankAccounts()[0]->getIban(),
            'bic' => $wallet->getBankAccounts()[0]->getBic(),
            'bankAccountOwner' => $wallet->getBankAccounts()[0]->getBankAccountOwner()
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
            if( $this->_exceptions )
                throw $err;
            else
            {
                echo 'ERROR: ' . $err->getMessage() . "\n";
                return false;
            }
        }

    }


    public function get( $id ) : \asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet
    {

        $request = $this->createRequest( '/' . $id );

        $response = $request->GET();

        $wallet = new \asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet();
        if( $response->isSuccess() )
        {
            $json_wallet = json_decode( $response->getBody() );
            $wallet->setWalletId( $json_wallet->walletId );
            $wallet->setWalletOwnerType( WalletOwnerType::getFromString( $json_wallet->walletOwnerType ));
            $wallet->setAlias( $json_wallet->alias );
        }
        elseif( $this->_exceptions )
        {
            throw $response->getError();
        }

        return $wallet;

    }

    public function addCurrency( \asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet &$wallet, BankAccount $bankAccount ) : \asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet
    {

        // todo: check needed parameters

        $data = [
            'currency' => $bankAccount->getCurrency(),
            'iban' => $bankAccount->getIban(),
            'bic' => $bankAccount->getBic(),
            'bankAccountOwner' => $bankAccount->getBankAccountOwner()
        ];

        $request = $this->createRequest( '/' . $wallet->getWalletId() );

        $response = $request->PUT();

        // TODO!
        $wallet = new \asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet();
        if( $response->isSuccess() )
        {
            return true;
        }
        else
        {
            $err = $response->getError();
            if( $this->_exceptions )
                throw $err;
            else
            {
                echo 'ERROR: ' . $err->getMessage() . "\n";
                return false;
            }
        }

        return $wallet;

    }

    public function delete( \asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet $wallet ) : bool
    {

        $request = $this->createRequest( '/' . $wallet->getWalletId() );

        $response = $request->DELETE();

        if( $response->isSuccess() )
        {
            return true;
        }
        else
        {
            $err = $response->getError();
            if( $this->_exceptions )
                throw $err;
            else
            {
                echo 'ERROR: ' . $err->getMessage() . "\n";
                return false;
            }
        }

    }


    public function getBalances( \asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet &$wallet, string $currency = null )
    {

        if( !empty( $currency ) )
            $data = [
                'currency' => $currency
            ];

        $request = $this->createRequest( '/' . $wallet->getWalletId() . '/' . 'balances' );

        if( !empty( $data ) )
            $request->setData( $data );

        $response = $request->GET();

        if( $response->isSuccess() )
        {
            $json_balances = json_decode( $response->getBody() );
            foreach( $json_balances as $json_balance )
            {
                $balance = new Balance();
                $balance->setCurrency( Currency::getFromString( $json_balance->currency ) );
                $balance->setAmount( $json_balance->amount );
                $wallet->addBalance( $balance );
            }
            return true;
        }
        else
        {
            $err = $response->getError();
            if( $this->_exceptions )
                throw $err;
            else
            {
                echo 'ERROR: ' . $err->getMessage() . "\n";
                return false;
            }
        }

    }

    public function getBankAccounts( \asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet &$wallet, string $currency = null )
    {

        if( !empty( $currency ) )
            $data = [
                'currency' => $currency
            ];

        $request = $this->createRequest( '/' . $wallet->getWalletId() . '/' . 'bankaccounts' );

        if( !empty( $data ) )
            $request->setData( $data );

        $response = $request->GET();

        if( $response->isSuccess() )
        {
            $json_bank_accounts = json_decode( $response->getBody() );
            foreach( $json_bank_accounts as $json_bank_account )
            {
                $bank_account = new BankAccount();
                $bank_account->setCurrency( Currency::getFromString( $json_bank_account->currency ) );
                $bank_account->setIban( $json_bank_account->iban );
                $bank_account->setBic( $json_bank_account->bic );
                $bank_account->setBankAccountOwner( $json_bank_account->bankAccountOwner );
                $wallet->addBankAccount( $bank_account );
            }
            return true;
        }
        else
        {
            $err = $response->getError();
            if( $this->_exceptions )
                throw $err;
            else
            {
                echo 'ERROR: ' . $err->getMessage() . "\n";
                return false;
            }
        }

    }



}