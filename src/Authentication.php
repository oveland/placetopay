<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 4:19 PM
 */

namespace Oveland\Placetopay;

/**
 * Class Authentication
 * @package App
 */
class Authentication
{
    protected static $login = '6dd490faf9cb87a9862245da41170ff2';
    protected static $tranKey ='024h1IlD';
    protected static $seed;
    protected static $additional = [];

    /**
     * @return string
     */
    public static function getTranKey()
    {
        static::$seed = date('c');
        return sha1( static::$seed.static::$tranKey, false );
    }

    /**
     * @return array
     */
    public static function getTransactionData()
    {
        return
        [
            'auth'=>
            [
                'login' => static::$login,
                'tranKey' => static::getTranKey(),
                'seed' => static::$seed,
                'additional' => static::$additional
            ]
        ];
    }
}