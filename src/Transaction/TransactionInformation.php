<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 25/12/2016
 * Time: 9:10 PM
 */

namespace Oveland\Placetopay\Transaction;

/**
 * Class TransactionInformation
 * @package Oveland\Placetopay\Transaction
 */
class TransactionInformation
{
    private $transactionID;
    private $sessionID;
    private $reference;
    private $requestDate;
    private $bankProcessDate;
    private $onTest;
    private $returnCode;
    private $trazabilityCode;
    private $transactionCycle;
    private $transactionState;
    private $responseCode;
    private $responseReasonCode;
    private $responseReasonText;

    /**
     * TransactionInformation constructor.
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
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return mixed
     */
    public function getRequestDate()
    {
        return $this->requestDate;
    }

    /**
     * @return mixed
     */
    public function getBankProcessDate()
    {
        return $this->bankProcessDate;
    }

    /**
     * @return mixed
     */
    public function getOnTest()
    {
        return $this->onTest;
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
    public function getTransactionState()
    {
        return $this->transactionState;
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