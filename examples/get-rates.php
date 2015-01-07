<?php

use Kayue\Postmen\Object\Address;
use Kayue\Postmen\Object\Box;
use Kayue\Postmen\Object\Package;
use Kayue\Postmen\Object\Shipment;
use Kayue\Postmen\Object\ShipperAccount;
use Kayue\Postmen\Postmen;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once 'config.php';

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
            'type' => BOX::TYPE_CUSTOM,
            'dimensionUnit' => BOX::DIMENSION_UNIT_IN,
        ])
]);

$shipment->addPackage($package);

echo "<pre>";
print_r($postmen->getRates($shipment));
echo "</pre>";
