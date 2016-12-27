<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 5:26 PM
 */

namespace Oveland\Placetopay\Model;


use ReflectionClass;

/**
 * Class Person
 * @package Oveland\Placetopay\Model
 */
class Person
{
    private $documentType;
    private $document;
    private $firstName;
    private $lastName;
    private $company;
    private $emailAddress;
    private $address;
    private $city;
    private $province;
    private $country;
    private $phone;
    private $mobile;

    /**
     * Person constructor.
     * @param array|null $params
     */
    function __construct(array $params = null)
    {
        $params = (object) $params;
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
}