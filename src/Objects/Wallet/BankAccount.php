<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Currency;

class BankAccount
{

    private $_currency = null;
    private $_iban = null;
    private $_bic = null;
    private $_bank_account_owner = null;

    /**
     * @return null
     */
    public function getCurrency() : Currency
    {
        return $this->_currency;
    }

    /**
     * @param null $currency
     */
    public function setCurrency( Currency $currency ): void
    {
        $this->_currency = $currency;
    }

    /**
     * @return null
     */
    public function getIban()
    {
        return $this->_iban;
    }

    /**
     * @param null $iban
     */
    public function setIban( $iban ): void
    {
        $this->_iban = $iban;
    }

    /**
     * @return null
     */
    public function getBic()
    {
        return $this->_bic;
    }

    /**
     * @param null $bic
     */
    public function setBic( $bic ): void
    {
        $this->_bic = $bic;
    }

    /**
     * @return null
     */
    public function getBankAccountOwner()
    {
        return $this->_bank_account_owner;
    }

    /**
     * @param null $bank_account_owner
     */
    public function setBankAccountOwner( $bank_account_owner ): void
    {
        $this->_bank_account_owner = $bank_account_owner;
    }

}