<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 6:48 PM
 */

namespace Oveland\Placetopay;


/**
 * Class Bank
 * @package App
 */
class Bank
{
    private $bankCode;
    private $bankInterface;
    private $returnURL;
    private $reference;
    private $description;
    private $language;
    private $currency;
    private $totalAmount;
    private $taxAmount;
    private $devolutionBase;
    private $tipAmount;

    /**
     * Bank constructor.
     */
    function __construct()
    {
        $this->bankCode = 1022;
        $this->bankInterface = 0;
        $this->returnURL = 'http://oveland.app/';
        $this->reference = uniqid(rand(), true);
        $this->description = 'Pago de prueba Oveland';
        $this->language = 'ES';
        $this->currency = 'COP';
        $this->totalAmount = 10;
        $this->taxAmount = 0;
        $this->devolutionBase = 0;
        $this->tipAmount = 0;
    }

    /**
     * @return array
     */
    public function getTransactionData() {
        return get_object_vars($this);
    }
}