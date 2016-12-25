<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 5:08 PM
 */

namespace Oveland\Placetopay;

use SoapClient;

/**
 * Class WsManager
 * @package App
 */
class WsManager
{
    /**
     * @var string
     */
    protected static $wsdl = 'https://test.placetopay.com/soap/pse/?wsdl';

    /**
     * @return getBankListResult
     */
    public static function getListBank()
    {
        $arrayListBank = CacheManager::loadBanksList();
        if($arrayListBank){
            return $arrayListBank;
        }

        $cliente = new SoapClient(static::$wsdl);
        $wsRequest = $cliente->getBankList( Authentication::getTransactionData() );

        $arrayListBank = $wsRequest->getBankListResult->item;

        return CacheManager::cacheBanksList($arrayListBank);
    }

    /**
     * @return createTransactionResult
     */
    public static function createTransaction(){
        $cliente = new SoapClient(static::$wsdl);

        $person = new Person();
        $bank = new Bank();
        $transaction = new Transaction($bank,$person,$person,$person);

        $data_transaction = array_merge(Authentication::getTransactionData(), $transaction->getTransactionData());

        $wsRequest = $cliente->createTransaction( $data_transaction );

        dump($transaction->getTransactionData());

        dump( $wsRequest->createTransactionResult );

        dd( static::getTransactionInformation( $wsRequest->createTransactionResult->transactionID ) );
        return $wsRequest->createTransactionResult;
    }

    /**
     * @param $transactionID
     * @return getTransactionInformationResult
     */
    public static function getTransactionInformation($transactionID)
    {
        $cliente = new SoapClient(static::$wsdl);

        $data_transaction = array_merge(Authentication::getTransactionData(), ['transactionID' => $transactionID]);

        $wsRequest = $cliente->getTransactionInformation( $data_transaction );

        return $wsRequest->getTransactionInformationResult;
    }
}