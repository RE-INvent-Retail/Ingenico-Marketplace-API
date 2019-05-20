<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Currency;
use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet;

class Balance
{

    private $_currency = null;
    private $_amount   = null;

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
    public function setCurrency( Currency $currency )
    {
        $this->_currency = $currency;
    }

    /**
     * @return null
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * @param null $balance
     */
    public function setAmount( $balance )
    {
        $this->_amount = $balance;
    }

}