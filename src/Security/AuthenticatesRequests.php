<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 4:19 PM
 */

namespace Oveland\Placetopay\Security;

/**
 * Class AuthenticatesRequests
 * @package Oveland\Placetopay\Security
 */
trait AuthenticatesRequests
{
    /**
     * @param $credentials
     */
    public function authenticate($credentials)
    {
        Authentication::authenticate($credentials);
    }

    /**
     * @return string
     */
    public function getTranKey()
    {
        Authentication::$seed = date('c');
        return sha1(Authentication::$seed . Authentication::$tranKey, false);
    }

    /**
     * @return array
     */
    public function getCredentials()
    {
        return
            [
                'auth' =>
                    [
                        'login' => Authentication::$login,
                        'tranKey' => $this->getTranKey(),
                        'seed' => Authentication::$seed,
                        'additional' => Authentication::$additional
                    ]
            ];
    }
}