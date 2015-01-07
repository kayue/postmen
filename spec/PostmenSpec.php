<?php

namespace spec\Kayue\Postmen;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use Kayue\Postmen\Object\Address;
use Kayue\Postmen\Object\Box;
use Kayue\Postmen\Object\Item;
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

    function it_returns_guzzle_client()
    {
        $this->getClient()->shouldReturnAnInstanceOf('Guzzle\Http\Client');
    }

    function it_returns_request_with_api_key()
    {
        $this->getClient()->get()->getHeader('postmen-api-key')->hasValue(self::API_KEY)->shouldReturn(true);
    }

    function it_returns_shipper_accounts()
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

    function it_returns_rates(Client $client, Request $request, Response $response)
    {
        $this->beConstructedWith(self::API_KEY, $client);

        $package = new Package([
            'box' => new Box(['weight' => 0.1, 'depth' => 38, 'width' => 4, 'height' => 1])
        ]);
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

        $client->post('/v2/rates', null, Argument::containingString('shipper_accounts'))->shouldBeCalled()->willReturn($request);
        $request->send()->shouldBeCalled()->willReturn($response);
        $response->getStatusCode()->willReturn(200);
        $response->setBody(file_get_contents('spec/Resources/fixtures/rates_response.json'));
        $response->json()->shouldBeCalled()->willReturn(json_decode(file_get_contents('spec/Resources/fixtures/rates_response.json'), true));

        $this->getRates($shipment)->shouldReturnAnInstanceOf('Kayue\Postmen\Result\Result');
    }

    function it_create_label()
    {
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

        $this->addShipperAccount(new ShipperAccount('fedex', [
            'account_number' => 'CHANGEME',
            'key' => 'CHANGEME',
            'password' => 'CHANGEME',
            'meter_number' => 'CHANGEME',
        ]));

        $this->createLabel('fedex_international_economy', $shipment);
    }

    function it_retrieve_label()
    {
        $this->getLabel('549bb537bcc1be36119a9424');
    }

    function it_throws_exception_when_no_shipper_account()
    {
        $this->shouldThrow('\RuntimeException')->during('getRates', [new Shipment()]);
    }
}
