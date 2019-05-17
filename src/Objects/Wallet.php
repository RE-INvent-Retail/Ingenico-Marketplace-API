<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Objects;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Wallet\WalletOwnerType;

class Wallet
{

    private $_wallet_id = null;
    private $_wallet_owner_type = null;
    private $_alias = null;
    private $_currency = null;
    private $_iban = null;
    private $_bic = null;
    private $_bankAccountOwner = null;

    /*
 * create:
{
"type": "object",
"$schema": "http://json-schema.org/draft-03/schema",
"properties": {
"alias": {"required": false,"type": "string"},
"walletOwnerType":{"required": true,"enum":["merchant","person"]},
"iban": {"required": true,"type": "string"},
"bic": {"required": true,"type": "string"},
"bankAccountOwner": {"required": true,"type": "string"}
},
"required": true
}
 */

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
        $this->_iban = str_replace( ' ', '', $iban );
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
        return $this->_bankAccountOwner;
    }

    /**
     * @param null $bankAccountOwner
     */
    public function setBankAccountOwner( $bankAccountOwner ): void
    {
        $this->_bankAccountOwner = $bankAccountOwner;
    }

    /**
     * @return null
     */
    public function getCurrency()
    {
        return $this->_currency;
    }

    /**
     * @param null $currency
     */
    public function setCurrency( $currency ): void
    {
        $this->_currency = $currency;
    }

}