<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 26/12/2016
 * Time: 1:20 AM
 */

namespace Oveland\Placetopay\Model;

/**
 * Class Attribute
 * @package Oveland\Placetopay\Model
 */
class Attribute
{
    private $name;
    private $value;

    /**
     * Attribute constructor.
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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}