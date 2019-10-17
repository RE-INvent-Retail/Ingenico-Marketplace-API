<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Objects;


use asdfklgash\IngenicoMarketplaceAPI\Objects\Movements\MovementsOperation;

class Movement
{

    private $_wallet_id = null;
    private $_counterpart_wallet_id = null;
    private $_transaction_id = null;
    private $_amount = null;
    private $_currency = null;
    private $_operation = null;
    private $_transaction_type = null;
    private $_reference = null;
    private $_communication = null;
    private $_created = null;
    private $_gateway_reference = null;
    private $_gateway_merchant_id = null;
    private $_status = null;
    private $_date = null;
    private $_operation_done = null;


    /*
{
   "wallet": 321000486463,
   "counterpartWallet": 321000484645,
   "transactionId": 7745262,
   "amount": 1.5,
   "currency": "EUR",
   "operation": "credit",
   "transactionType": "bankfunding",
   "reference": "XX11XXM11XX1XAQZ",
   "communication": "First bankfunding",
   "created": "2017-01-31 17:12:23"
},
    transfer:
  {
      "wallet": 321000484645,
      "counterpartWallet": 321000486463,
      "transactionId": 7745263,
      "amount": 2.5,
      "currency": "EUR",
      "operation": "debit",
      "transactionType": "transfer",
      "reference": "YZVYZVYZYEVYZE",
      "communication": "Second transfer",
      "created": "2017-01-31 17:12:25",
      "gatewayReference":"1616511",
      "gatewayMerchantId":"mycompany"
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
    public function getCounterpartWalletId()
    {
        return $this->_counterpart_wallet_id;
    }

    /**
     * @param null $counterpart_wallet_id
     */
    public function setCounterpartWalletId( $counterpart_wallet_id ): void
    {
        $this->_counterpart_wallet_id = $counterpart_wallet_id;
    }

    /**
     * @return null
     */
    public function getTransactionId()
    {
        return $this->_transaction_id;
    }

    /**
     * @param null $transaction_id
     */
    public function setTransactionId( $transaction_id ): void
    {
        $this->_transaction_id = $transaction_id;
    }

    /**
     * @return null
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * @param null $amount
     */
    public function setAmount( $amount ): void
    {
        $this->_amount = $amount;
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
        if( !is_object( $currency ) && $currency instanceof Currency )
            $this->_currency = Currency::getFromString( $currency );
        else
            $this->_currency = $currency;
    }

    /**
     * @return null
     */
    public function getOperation()
    {
        return $this->_operation;
    }

    /**
     * @param null $operation
     */
    public function setOperation( $operation ): void
    {
        if( !is_object( $operation ) && $operation instanceof MovementsOperation )
            $this->_operation = MovementsOperation::getFromString( $operation );
        else
            $this->_operation = $operation;
    }

    /**
     * @return null
     */
    public function getTransactionType()
    {
        return $this->_transaction_type;
    }

    /**
     * @param null $transaction_type
     */
    public function setTransactionType( $transaction_type ): void
    {
        $this->_transaction_type = $transaction_type;
    }

    /**
     * @return null
     */
    public function getReference()
    {
        return $this->_reference;
    }

    /**
     * @param null $reference
     */
    public function setReference( $reference ): void
    {
        $this->_reference = $reference;
    }

    /**
     * @return null
     */
    public function getCommunication()
    {
        return $this->_communication;
    }

    /**
     * @param null $communication
     */
    public function setCommunication( $communication ): void
    {
        $this->_communication = $communication;
    }

    /**
     * @return null
     */
    public function getCreated()
    {
        return $this->_created;
    }

    /**
     * @param null $created
     */
    public function setCreated( $created ): void
    {
        $this->_created = $created;
    }

    /**
     * @return null
     */
    public function getGatewayReference()
    {
        return $this->_gateway_reference;
    }

    /**
     * @param null $gateway_reference
     */
    public function setGatewayReference( $gateway_reference ): void
    {
        $this->_gateway_reference = $gateway_reference;
    }

    /**
     * @return null
     */
    public function getGatewayMerchantId()
    {
        return $this->_gateway_merchant_id;
    }

    /**
     * @param null $gateway_merchant_id
     */
    public function setGatewayMerchantId( $gateway_merchant_id ): void
    {
        $this->_gateway_merchant_id = $gateway_merchant_id;
    }

    /**
     * @return null
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param null $status
     */
    public function setStatus( $status ): void
    {
        $this->_status = $status;
    }

    /**
     * @return null
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param null $date
     */
    public function setDate( $date ): void
    {
        $this->_date = $date;
    }

    /**
     * @return null
     */
    public function getOperationDone()
    {
        return $this->_operation_done;
    }

    /**
     * @param null $operation_done
     */
    public function setOperationDone( $operation_done ): void
    {
        $this->_operation_done = $operation_done;
    }

    public function asArray() : array
    {
        return [
            'wallet' => $this->getWalletId(),
            'counterpartWallet' => $this->getCounterpartWalletId(),
            'transactionId' => $this->getTransactionId(),
            'amount' => $this->getAmount(),
            'currency' => (string)$this->getCurrency(),
            'operation' => $this->getOperation(),
            'transactionType' => $this->getTransactionType(),
            'reference' => $this->getReference(),
            'communication' => $this->getCommunication(),
            'created' => $this->getCreated(),
            /*
            'gatewayReference' => $this->getGatewayReference(),
            'gatewayMerchantId' => $this->getGatewayMerchantId()
            */
        ];
    }

}