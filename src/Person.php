<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 5:26 PM
 */

namespace Oveland\Placetopay;


use ReflectionClass;

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
     */
    function __construct()
    {
        $this->documentType = 'CC';
        $this->document = '1061743074';
        $this->firstName = 'Oscar';
        $this->lastName = 'Velasquez';
        $this->company = 'Oveland';
        $this->emailAddress = 'oscarivelan@gmail.co';
        $this->address = 'Cra 10 23 N 55';
        $this->city = 'Popayán';
        $this->province = 'Cauca';
        $this->country = 'CO';
        $this->phone = 'null';
        $this->mobile = '3145224313';
    }

    public function getTransactionData() {
        return get_object_vars($this);
    }
}