<?php

/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 25/12/2016
 * Time: 3:04 PM
 */

use Oveland\Placetopay\PlaceToPay;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Class PlaceToPay
 */
class PlaceToPayTest extends TestCase
{
    public function testArrayBankList()
    {
        $placetopay = new PlaceToPay();

        $bankList = $placetopay->getBankList();

        $this->assertNotEmpty($bankList);

        $this->assertInternalType('array', $bankList);
    }

    public function testSUCCESSStatusRequestTransaction()
    {
        $params = [
            'payer' => [
                'documentType' => 'CC',
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
            ],
            'additionalData' => [
                [
                    'name' => 'foo',
                    'value' => 'bar'
                ],
                [
                    'name' => 'foo_1',
                    'value' => 'bar_1'
                ]
            ]
        ];

        $placetopay = new PlaceToPay();

        $transaction = $placetopay->createTransaction($params);

        $this->assertEquals('SUCCESS', $transaction->getReturnCode());
    }
}