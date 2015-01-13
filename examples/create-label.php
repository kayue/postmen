<?php

use Kayue\Postmen\Object\Address;
use Kayue\Postmen\Object\Box;
use Kayue\Postmen\Object\Item;
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

$box = new Box(['weight' => 0.1, 'depth' => 38, 'width' => 4, 'height' => 1]);
$package = new Package();
$package->setBox($box);
$package->addItem(new Item([
    'name' => 'iPad air wifi 3G 32 GB silver',
    'originCountry' => 'CHN',
    'quantity' => 2,
    'value' => 200,
    'currency' => 'USD',
    'weight' => 2,
    'weightUnit' => 'kg'
]));
$shipment = new Shipment();
$shipment->setShipFrom(new Address([
    'contactName' => 'Buyer Name',
    'contactPhone' => '+85221234568',
    'faxNumber' => '+85221234567',
    'email' => 'support@seller.com',
    'companyName' => 'Testing company',
    'addressLine1' => '330-340 W 34th St',
    'addressLine2' => 'Super smart building',
    'addressLine3' => 'Hong Kong',
    'city' => 'Hong Kong',
    'country' => 'HKG',
]));
$shipment->setShipTo(new Address([
    'contactName' => 'Buyer Name',
    'contactPhone' => '302-0123-1234',
    'faxNumber' => '302-0123-1231',
    'email' => 'buyer@gmail.com',
    'companyName' => 'Testing company',
    'addressLine1' => '330-340 W 34th St',
    'addressLine2' => 'Super smart building',
    'addressLine3' => 'Buyer address line 3',
    'city' => 'New York',
    'state' => 'NY',
    'postalCode' => '10001',
    'country' => 'USA',
]));
$shipment->addPackage($package);

echo "<pre>";
print_r($postmen->createLabel('fedex_international_economy', $shipment));
echo "</pre>";
