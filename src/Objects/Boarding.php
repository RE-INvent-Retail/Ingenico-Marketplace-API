<?php


namespace asdfklgash\IngenicoMarketplaceAPI\Objects;


class Boarding
{

    private $_boarding_id = null;
    private $_wallet = null;
    private $_url = null;
    private $_valid_until = null;
    private $_state = null;
    private $_comment = null;

    /**
     * @return null
     */
    public function getBoardingId()
    {
        return $this->_boarding_id;
    }

    /**
     * @param null $boarding_id
     */
    public function setBoardingId( $boarding_id ): void
    {
        $this->_boarding_id = $boarding_id;
    }

    /**
     * @return null
     */
    public function getWallet()
    {
        return $this->_wallet;
    }

    /**
     * @param null $wallet
     */
    public function setWallet( $wallet ): void
    {
        $this->_wallet = $wallet;
    }

    /**
     * @return null
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * @param null $url
     */
    public function setUrl( $url ): void
    {
        $this->_url = $url;
    }

    /**
     * @return null
     */
    public function getValidUntil()
    {
        return $this->_valid_until;
    }

    /**
     * @param null $valid_until
     */
    public function setValidUntil( $valid_until ): void
    {
        $this->_valid_until = $valid_until;
    }

    /**
     * @return null
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param null $state
     */
    public function setState( $state ): void
    {
        $this->_state = $state;
    }

    /**
     * @return null
     */
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * @param null $comment
     */
    public function setComment( $comment ): void
    {
        $this->_comment = $comment;
    }

}