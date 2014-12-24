<?php

namespace Kayue\Postmen;

use Guzzle\Http\Client;
use Kayue\Postmen\Object\Shipment;
use Kayue\Postmen\Object\ShipperAccount;
use Kayue\Postmen\Result\ResultFactory;
use RuntimeException;

/**
 * @see https://www.postmen.com/api
 */
class Postmen
{
    protected $apiKey;
    protected $client = null;
    protected $shipperAccounts = [];

    public function __construct($apiKey, Client $client = null)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
    }

    public function getClient()
    {
        if (null === $this->client) {
            $client = new Client($this->getApiEndpoint());
            $client->setDefaultOption('headers', [
                'postmen-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ]);

            $this->client = $client;
        }

        return $this->client;
    }

    private function getApiEndpoint()
    {
        return "https://api.postmen.com";
    }

    public function addShipperAccount(ShipperAccount $account)
    {
        $this->shipperAccounts[] = $account;
    }

    public function getShipperAccounts()
    {
        return $this->shipperAccounts;
    }

    public function getRates(Shipment $shipment)
    {
        if (empty($this->shipperAccounts)) {
            throw new RuntimeException('No shipper account is specified.');
        }

        $body = [
            'shipper_accounts' => $this->getShipperAccounts(),
            'shipment' => $shipment,
        ];

        $request = $this->getClient()->post('/v2/rates', null, json_encode($body));
        $response = ResultFactory::create($request->send());

        return $response;
    }
}
