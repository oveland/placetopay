<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 6:50 PM
 */

namespace Oveland\Placetopay;


/**
 * Class Transaction
 * @package App
 */
class Transaction
{
    protected $bank;
    protected $payer;
    protected $buyer;
    protected $shipping;
    protected $ipAddress;
    protected $userAgent;
    protected $additionalData;

    /**
     * Transaction constructor.
     * @param Bank $bank
     * @param Person $payer
     * @param Person $buyer
     * @param Person $shiping
     */
    function __construct(Bank $bank, Person $payer, Person $buyer, Person $shiping)
    {
        $this->bank = $bank;
        $this->payer = $payer;
        $this->buyer = $buyer;
        $this->shipping = $shiping;
        $this->ipAddress = $this->getClientIp();
        $this->userAgent = $this->ExactBrowserName();
        $this->additionalData = [];
    }

    /**
     * @param array $data
     */
    public function setAdditionalData(array $data){
        $this->additionalData = $data;
    }

    /**
     * @return array
     */
    public function getAdditionalData(){
        return $this->additionalData;
    }

    /**
     * @return array
     */
    public function getTransactionData(){

        $bank = $this->bank->getTransactionData();
        $data = [
            'payer' => $this->payer->getTransactionData(),
            'buyer' => $this->buyer->getTransactionData(),
            'shipping' => $this->shipping->getTransactionData(),
            'ipAddress' => $this->ipAddress,
            'userAgent' => $this->userAgent,
            'additionalData' => $this->additionalData
        ];

        return ['transaction'=>array_merge($bank,$data)];
    }

    /**
     * @return array|false|string
     */
    function getClientIp(){
        return  getenv('HTTP_CLIENT_IP')?:
                getenv('HTTP_X_FORWARDED_FOR')?:
                getenv('HTTP_X_FORWARDED')?:
                getenv('HTTP_FORWARDED_FOR')?:
                getenv('HTTP_FORWARDED')?:
                getenv('REMOTE_ADDR');
    }

    /**
     * @return string
     */
    function ExactBrowserName()
    {
        $ExactBrowserNameUA=$_SERVER['HTTP_USER_AGENT'];

        if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")) {
            // OPERA
            $ExactBrowserNameBR="Opera";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "chrome/")) {
            // CHROME
            $ExactBrowserNameBR="Google Chrome";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "msie")) {
            // INTERNET EXPLORER
            $ExactBrowserNameBR="Internet Explorer";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "firefox/")) {
            // FIREFOX
            $ExactBrowserNameBR="Firefox";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")==false and strpos(strtolower($ExactBrowserNameUA), "chrome/")==false) {
            // SAFARI
            $ExactBrowserNameBR="Safari";
        } else {
            // OUT OF DATA
            $ExactBrowserNameBR="OUT OF DATA";
        };

        return $ExactBrowserNameBR;
    }
}