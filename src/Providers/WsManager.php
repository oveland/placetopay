<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 25/12/2016
 * Time: 8:19 PM
 */

namespace Oveland\Placetopay\Providers;

use SoapClient;
use Symfony\Component\Yaml\Yaml;
use Oveland\Placetopay\Cache\CachesManage;
use Oveland\Placetopay\Security\AuthenticatesRequests;
use Oveland\Placetopay\Transaction\PSETransactionRequest;

/**
 * Class WsManager
 * @package Oveland\Placetopay\Providers
 */
class WsManager implements WsManagerInterface
{
    use AuthenticatesRequests, CachesManage;

    const FILE_CONFIG = __DIR__ . '/../Config/parameters.yml';
    protected static $soapClient;

    /**
     * WsManager constructor.
     */
    function __construct()
    {
        $config = Yaml::parse(file_get_contents(static::FILE_CONFIG));

        $this->authenticate($config['auth']);

        static::$soapClient = new SoapClient($config['wsdl']);
    }

    /**
     * Returns a Bank list and updates it into cache (banks.json) one time every day
     * @return array|null
     */
    public function getBankList()
    {
        $arrayListBank = static::loadCachedBanksList();
        if ($arrayListBank) return $arrayListBank;

        $wsRequest = self::$soapClient->getBankList($this->getCredentials());

        $arrayListBank = $wsRequest->getBankListResult->item;

        return static::cacheBanksList($arrayListBank);
    }

    public function createTransaction(PSETransactionRequest $pseTransactionRequest)
    {
        $wsRequest = self::$soapClient->createTransaction($pseTransactionRequest->buildTransactionData());

        return $wsRequest->createTransactionResult;
    }

    /**
     * @param $pseTransactionID
     * @return getTransactionInformationResult
     */
    public function getTransactionInformation($pseTransactionID)
    {
        $data_transaction = array_merge($this->getCredentials(), ['transactionID' => $pseTransactionID]);

        $wsRequest = self::$soapClient->getTransactionInformation($data_transaction);

        return $wsRequest->getTransactionInformationResult;
    }
}