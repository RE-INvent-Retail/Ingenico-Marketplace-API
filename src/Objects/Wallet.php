<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Objects;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet\Balance;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet\BankAccount;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet\WalletOwnerType;

class Wallet
{

    private $_wallet_id = null;
    private $_wallet_owner_type = null;
    private $_alias = null;
    private $_balances = [];
    private $_bank_accounts = [];

    /**
     * @return null
     */
    public function getWalletId()
    {
        return $this->_wallet_id;
    }

    /**
     * @param null $wallet_id
     */
    public function setWalletId( $wallet_id ): void
    {
        $this->_wallet_id = $wallet_id;
    }

    /**
     * @return null
     */
    public function getWalletOwnerType()
    {
        return (string)$this->_wallet_owner_type;
    }

    /**
     * @param null $wallet_owner_type
     */
    public function setWalletOwnerType( WalletOwnerType $wallet_owner_type ): void
    {
        $this->_wallet_owner_type = $wallet_owner_type;
    }

    /**
     * @return null
     */
    public function getAlias()
    {
        return $this->_alias;
    }

    /**
     * @param null $alias
     */
    public function setAlias( $alias ): void
    {
        $this->_alias = $alias;
    }

    /**
     * @return array
     */
    public function getBalances(): array
    {
        return $this->_balances;
    }

    /**
     * @return Balance
     */
    public function getBalanceForCurrency( Currency $currency ): Balance
    {
        foreach( $this->_balances as $balance )
        {
            if( $balance->getCurrency() == $currency )
                return $balance;
        }
        return new Balance();
    }

    /**
     * @param array $balances
     */
    public function setBalances( array $balances ): void
    {
        $this->_balances = $balances;
    }

    /**
     * @param array $balances
     */
    public function addBalance( Balance $balance ): void
    {
        $this->_balances[] = $balance;
    }

    /**
     * @return array
     */
    public function getBankAccounts(): array
    {
        return $this->_bank_accounts;
    }

    /**
     * @param array $bank_accounts
     */
    public function setBankAccounts( array $bank_accounts ): void
    {
        $this->_bank_accounts = $bank_accounts;
    }

    /**
     * @param array $bank_accounts
     */
    public function addBankAccount( BankAccount $bank_account ): void
    {
        $this->_bank_accounts[] = $bank_account;
    }

}