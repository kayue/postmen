Postmen PHP library 
=======

This is an unofficial [Postmen](http://postmen.com) PHP library.

[![Build Status](https://travis-ci.org/kayue/postmen.png?branch=master)](https://travis-ci.org/kayue/postmen)

Quick Installation
-------

The recommended way to install this library is through Composer.

```
wget http://getcomposer.org/composer.phar
php composer.phar composer install
```

Example
------

Please see examples directory.

```php
$postmen = new Postmen(POSTMEN_API_KEY);

$postmen->addShipperAccount(new ShipperAccount('fedex', [
    'account_number' => FEDEX_ACCOUNT_NUMBER,
    'key' => FEDEX_KEY,
    'password' => FEDEX_PASSWORD,
    'meter_number' => FEDEX_METER_NUMBER,
]));

$shipment = new Shipment();

$shipment->setShipFrom(new Address([
    'country' => 'HKG',
]));

$shipment->setShipTo(new Address([
    'state' => 'CA',
    'postalCode' => '92612',
    'country' => 'USA',
]));

$package = new Package([
    'box' => new Box([
            'weight' => 4,
            'width' => 15,
            'height' => 15,
            'depth' => 5,
        ])
]);

$shipment->addPackage($package);

echo "<pre>";
print_r($postmen->getRates($shipment));
echo "</pre>";

```

Testing
------

```
./bin/phpspec run
```
