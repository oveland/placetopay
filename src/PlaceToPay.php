<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 5:08 PM
 */

namespace Oveland\Placetopay;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Oveland\Placetopay\Providers\WsManager;
use Oveland\Placetopay\Transaction\PSETransactionRequest;
use Oveland\Placetopay\Transaction\TransactionInformation;
use Oveland\Placetopay\Transaction\PSETransactionResponse;

/**
 * Class PlaceToPay
 * @package Oveland\Placetopay
 */
class PlaceToPay
{
    /**
     * @var WsManager
     */
    protected $wsm;

    /**
     * PlaceToPay constructor.
     * @param null $debug
     */
    function __construct($debug = null)
    {
        if($debug){
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());
            $whoops->register();
        }

        $this->wsm = new WsManager();
    }

    /**
     * @return array|null
     */
    public function getBankList()
    {
        return $this->wsm->getBanksList();
    }

    /**
     * @param $params
     * @return PSETransactionResponse
     */
    public function createTransaction($params)
    {
        $pseTransactionRequest = new PSETransactionRequest($params);

        $wsRequest = $this->wsm->createTransaction($pseTransactionRequest);

        return new PSETransactionResponse($wsRequest);
    }

    /**
     * @param $pseTransactionID
     * @return TransactionInformation
     */
    public function getTransactionInformation($pseTransactionID)
    {
        $wsRequest = $this->wsm->getTransactionInformation($pseTransactionID);

        return new TransactionInformation($wsRequest);
    }
}