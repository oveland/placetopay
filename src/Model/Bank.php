<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 6:48 PM
 */

namespace Oveland\Placetopay\Model;


/**
 * Class Bank
 * @package Oveland\Placetopay\Model
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
     * @param $params
     */
    function __construct(array $params = null)
    {
        foreach (get_object_vars($this) as $field => $value) {
            $this->$field = isset($params[$field]) ? $params[$field] : $value;
        }
    }

    /**
     * @return array
     */
    public function getTransactionData()
    {
        return get_object_vars($this);
    }
}