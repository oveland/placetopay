<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 25/12/2016
 * Time: 11:17 PM
 */

namespace Oveland\Placetopay\Security;

/**
 * Class Authentication
 * @package Oveland\Placetopay\Security
 */
class Authentication
{
    public static $login;
    public static $tranKey;
    public static $seed;
    public static $additional;

    /**
     * @param $credentials
     */
    public static function authenticate($credentials)
    {
        static::$login = isset($credentials['login']) ? $credentials['login'] : null;
        static::$tranKey = isset($credentials['tranKey']) ? $credentials['tranKey'] : null;
        static::$additional = isset($credentials['tranKey']) ? $credentials['tranKey'] : null;
    }

    /**
     * @return array
     */
    public static function getData()
    {
        return get_object_vars(Authentication::class);
    }
}