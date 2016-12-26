<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 25/12/2016
 * Time: 9:10 PM
 */

namespace Oveland\Placetopay\Transaction;

/**
 * Class PSETransactionResponse
 * @package Oveland\Placetopay\Transaction
 */
class PSETransactionResponse
{
    private $returnCode;
    private $bankURL;
    private $trazabilityCode;
    private $transactionCycle;
    private $transactionID;
    private $sessionID;
    private $bankCurrency;
    private $bankFactor;
    private $responseCode;
    private $responseReasonCode;
    private $responseReasonText;

    /**
     * PSETransactionResponse constructor.
     * @param array|null $params
     */
    function __construct($params = null)
    {
        foreach (get_object_vars($this) as $field => $value) {
            $this->$field = isset($params->$field) ? $params->$field : $value;
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getReturnCode()
    {
        return $this->returnCode;
    }

    /**
     * @return mixed
     */
    public function getBankURL()
    {
        return $this->bankURL;
    }

    /**
     * @return mixed
     */
    public function getTrazabilityCode()
    {
        return $this->trazabilityCode;
    }

    /**
     * @return mixed
     */
    public function getTransactionCycle()
    {
        return $this->transactionCycle;
    }

    /**
     * @return mixed
     */
    public function getTransactionID()
    {
        return $this->transactionID;
    }

    /**
     * @return mixed
     */
    public function getSessionID()
    {
        return $this->sessionID;
    }

    /**
     * @return mixed
     */
    public function getBankCurrency()
    {
        return $this->bankCurrency;
    }

    /**
     * @return mixed
     */
    public function getBankFactor()
    {
        return $this->bankFactor;
    }

    /**
     * @return mixed
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @return mixed
     */
    public function getResponseReasonCode()
    {
        return $this->responseReasonCode;
    }

    /**
     * @return mixed
     */
    public function getResponseReasonText()
    {
        return $this->responseReasonText;
    }
}