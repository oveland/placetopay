<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 6:50 PM
 */

namespace Oveland\Placetopay\Transaction;

use Oveland\Placetopay\Model\Attribute;
use Oveland\Placetopay\Model\Bank;
use Oveland\Placetopay\Model\Person;
use Oveland\Placetopay\Security\AuthenticatesRequests;

/**
 * Class PSETransactionRequest
 * @package Oveland\Placetopay\Transaction
 */
class PSETransactionRequest
{
    use AuthenticatesRequests;

    protected $bank;
    protected $payer;
    protected $buyer;
    protected $shipping;
    protected $ipAddress;
    protected $userAgent;
    protected $additionalData;

    /**
     * PSETransactionRequest constructor.
     * @param array|null $params
     */
    function __construct(array $params = null)
    {
        $this->bank = new Bank(isset($params['bank']) ? $params['bank'] : null);
        $this->payer = new Person(isset($params['payer']) ? $params['payer'] : null);
        $this->buyer = new Person(isset($params['buyer']) ? $params['buyer'] : null);
        $this->shipping = new Person(isset($params['shipping']) ? $params['shipping'] : null);
        $this->ipAddress = $this->getClientIp();
        $this->userAgent = $this->ExactBrowserName();
        $this->additionalData = isset($params['additionalData']) ? $this->setAdditionalData($params['additionalData']) : null;
    }

    public function setAdditionalData($params)
    {
        $attributes = [];

        if (is_array($params)) {
            foreach ($params as $attribute) {
                $attributes[]['item'] = (new Attribute($attribute))->getData();
            }
        }

        return $attributes;
    }

    /**
     * @return array
     */
    public function buildTransactionData()
    {
        $bank = $this->bank->getTransactionData();
        $data = [
            'payer' => $this->payer->getData(),
            'buyer' => $this->buyer->getData(),
            'shipping' => $this->shipping->getData(),
            'ipAddress' => $this->ipAddress,
            'userAgent' => $this->userAgent,
            'additionalData' => $this->additionalData
        ];

        return array_merge($this->getCredentials(), ['transaction' => array_merge($bank, $data)]);
    }

    /**
     * @return array|false|string
     */
    private function getClientIp()
    {
        return getenv('HTTP_CLIENT_IP') ?:
            getenv('HTTP_X_FORWARDED_FOR') ?:
                getenv('HTTP_X_FORWARDED') ?:
                    getenv('HTTP_FORWARDED_FOR') ?:
                        getenv('HTTP_FORWARDED') ?:
                            getenv('REMOTE_ADDR');
    }

    /**
     * @return string
     */
    private function ExactBrowserName()
    {
        $ExactBrowserNameUA = $_SERVER['HTTP_USER_AGENT'];

        if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")) {
            // OPERA
            $ExactBrowserNameBR = "Opera";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "chrome/")) {
            // CHROME
            $ExactBrowserNameBR = "Google Chrome";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "msie")) {
            // INTERNET EXPLORER
            $ExactBrowserNameBR = "Internet Explorer";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "firefox/")) {
            // FIREFOX
            $ExactBrowserNameBR = "Firefox";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/") == false and strpos(strtolower($ExactBrowserNameUA), "chrome/") == false) {
            // SAFARI
            $ExactBrowserNameBR = "Safari";
        } else {
            // OUT OF DATA
            $ExactBrowserNameBR = "OUT OF DATA";
        };

        return $ExactBrowserNameBR;
    }
}