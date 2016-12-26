<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 26/12/2016
 * Time: 11:03 PM
 */

include __DIR__ . '/../vendor/autoload.php';

use Oveland\Placetopay\PlaceToPay;

/**
 * Class Example
 */
class Example
{
    public static function pay()
    {
        $params = [
            'payer' => [
                'documentType' => 'CCs',
                'document' => '1061743074',
                'firstName' => 'Oscar',
                'lastName' => 'Velásquez Andrade',
                'company' => 'Oveland',
                'emailAddress' => 'oscarivelan@gmail.co',
                'address' => 'Cra 10 23 N 55',
                'city' => 'Popayán',
                'province' => 'Cauca',
                'country' => 'CO',
                'phone' => 'null',
                'mobile' => '3145224313'
            ],
            'buyer' => null,
            'shipping' => null,
            'bank' => [
                'bankCode' => 1022,
                'bankInterface' => 0,
                'returnURL' => 'http://oveland.placetopay/',
                'reference' => uniqid(rand(), true),
                'description' => 'Pago Básico Oveland',
                'language' => 'ES',
                'currency' => 'COP',
                'totalAmount' => 10,
                'taxAmount' => 0,
                'devolutionBase' => 0,
                'tipAmount' => 0
            ]
        ];

        $placetopay = new PlaceToPay();

        try{
            $transaction = $placetopay->createTransaction($params);
            $status = $placetopay->getTransactionInformation($transaction->getTransactionID());

            dump($transaction);
            dump($status);
        }
        catch (Exception $ex){
            dump($ex);
        }
    }
}

Example::pay();