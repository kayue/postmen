<?php

namespace spec\Kayue\Postmen;

use Kayue\Postmen\Object\Address;
use Kayue\Postmen\Object\Box;
use Kayue\Postmen\Object\Package;
use Kayue\Postmen\Object\Shipment;
use Kayue\Postmen\Object\ShipperAccount;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostmenSpec extends ObjectBehavior
{
    const API_KEY = 'CHANGEME';

    function let()
    {
        $this->beConstructedWith(self::API_KEY);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kayue\Postmen\Postmen');
    }

    function it_should_return_guzzle_client()
    {
        $this->getClient()->shouldReturnAnInstanceOf('Guzzle\Http\Client');
    }

    function it_should_return_request_with_api_key()
    {
        $this->getClient()->get()->getHeader('postmen-api-key')->hasValue(self::API_KEY)->shouldReturn(true);
    }

    function it_return_shipper_accounts()
    {
        $fedexAccount = new ShipperAccount('fedex', [
            'account_number' => 'FEDEX_ACCOUNT_NUMBER',
            'key' => 'FEDEX_KEY',
            'password' => 'FEDEX_PASSWORD',
            'meter_number' => 'FEDEX_METER_NUMBER',
        ]);

        $dhlAccount = new ShipperAccount('dhl', [
            'account_number' => 'DHL_ACCOUNT_NUMBER',
            'region' => 'AP',
            'password' => 'DHL_PASSWORD',
            'site_id' => 'DHL_SITE_ID',
        ]);

        $this->addShipperAccount($fedexAccount);
        $this->addShipperAccount($dhlAccount);

        $this->getShipperAccounts()->shouldHaveCount(2);
        $this->getShipperAccounts()->shouldContain($fedexAccount);
        $this->getShipperAccounts()->shouldContain($dhlAccount);
        $this->getShipperAccounts()->shouldNotContain(new ShipperAccount('sf_express'));
    }

    function it_should_return_rates()
    {
        $box = new Box();
        $box->setWeight(0.1);
        $box->setDepth(38);
        $box->setWidth(4);
        $box->setHeight(1);
        $package = new Package();
        $package->setBox($box);
        $shipment = new Shipment();
        $shipment->setShipFrom(new Address(['country'=>'HKG']));
        $shipment->setShipTo(new Address(['country'=>'USA']));
        $shipment->addPackage($package);

        $this->addShipperAccount(new ShipperAccount('fedex', [
            'account_number' => 'CHANGEME',
            'key' => 'CHANGEME',
            'password' => 'CHANGEME',
            'meter_number' => 'CHANGEME',
        ]));

        $this->getRates($shipment);
    }

    function it_throw_exception_when_no_shipper_account()
    {
        $this->shouldThrow('\RuntimeException')->during('getRates', [new Shipment()]);
    }
}
