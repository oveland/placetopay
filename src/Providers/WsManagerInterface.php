<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 25/12/2016
 * Time: 8:44 PM
 */

namespace Oveland\Placetopay\Providers;

use Oveland\Placetopay\Transaction\PSETransactionRequest;

/**
 * Interface WsManagerInterface
 * @package Oveland\Placetopay\Providers
 */
interface WsManagerInterface
{
    public function getBankList();

    public function createTransaction(PSETransactionRequest $pseTransactionRequest);

    public function getTransactionInformation($pseTransactionID);
}