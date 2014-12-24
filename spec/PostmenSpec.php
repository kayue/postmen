<?php

namespace spec\Kayue\Postmen;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
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

    function it_throws_exception_when_no_shipper_account()
    {
        $this->shouldThrow('\RuntimeException')->during('getRates', [new Shipment()]);
    }
}
