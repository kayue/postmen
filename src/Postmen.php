<?php

namespace Kayue\Postmen;

use Guzzle\Http\Client;
use Kayue\Postmen\Object\Shipment;
use Kayue\Postmen\Object\ShipperAccount;
use RuntimeException;

/**
 * Class Postmen
 *
 * @see https://www.postmen.com/api
 */
class Postmen
{
    protected $apiKey;
    protected $shipperAccounts = [];

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getClient()
    {
        $client = new Client($this->getApiEndpoint());
        $client->setDefaultOption('headers', [
            'postmen-api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ]);

        return $client;
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
            'shipment' => $shipment
        ];

        $request = $this->getClient()->post('/v2/rates', null, json_encode($body));

        print_r($request->send()->json());
    }
}
