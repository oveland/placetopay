Oveland PlaceToPay Library
=============================
___________________________________
#### <i class="icon-download"></i> **Installation**

Install via composer

>	*$ composer require oveland/placetopay*

Or include on composer.json file:

```
"require": {
	"oveland/placetopay": "^1.0"
}
```

#### <i class="icon-file"></i> **How to use**


```
use Oveland\Placetopay\PlaceToPay;

...

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
$status = $placetopay->getTransactionInformation($transaction->getTransactionID());


```

#### <i class="icon-file"></i> **Methods**

>**Bank List**:

> Get array of bank list:
`$placetopay->getBankList(); ` 

________________________

>**Transaction**:

> Get return code:
`$transaction->getReturnCode(); ` 

> Get bank url redirect:
`$transaction->getBankURL(); ` 

> Get trazability code:
	`$transaction->getTrazabilityCode(); ` 

> Get transaction cycle:
`$transaction->getTransactionCycle(); ` 

> Get transaction ID:
`$transaction->getTransactionID(); ` 

> Get session ID:
`$transaction->getSessionID(); ` 	

> Get bank currency:
`$transaction->getBankCurrency(); ` 

> Get bank factor:
`$transaction->getBankFactor(); ` 

> Get response code:
`$transaction->getResponseCode(); ` 

> Get response reason code:
`$transaction->getResponseReasonCode(); ` 

> Get response reason text:
`$transaction->getResponseReasonText(); ` 

> Get array of all data:
`$transaction->getData(); ` 

___________________

>**Status**:

> Get transaction ID:
`$transaction->getTransactionID(); ` 

> Get session ID:
`$transaction->getSessionID(); ` 	

> Get reference:
`$transaction->getReference(); ` 

> Get request date:
`$transaction->getRequestDate(); ` 

> Get trazability code:
	`$transaction->getTrazabilityCode(); ` 

> Get bank process date:
`$transaction->getBankProcessDate(); ` 

> Get bank on test:
`$transaction->getOnTest(); ` 

> Get return code:
`$transaction->getReturnCode(); ` 

> Get trazability code:
`$transaction->getTrazabilityCode(); ` 

> Get transaction cycle:
`$transaction->getTransactionCycle(); ` 

> Get transaction state:
`$transaction->getTransactionState(); ` 

> Get response code:
`$transaction->getResponseCode(); ` 

> Get response reason code:
`$transaction->getResponseReasonCode(); ` 

> Get response reason text:
`$transaction->getResponseReasonText(); ` 

> Get array of all data:
`$transaction->getData(); ` 

#### <i class="icon-file"></i> **Example**

>See [Laravel project that implements the PlaceToPay Library](https://github.com/oveland/clientPlaceToPay).

>Please try the [Live demo](http://oveland.herokuapp.com/)
