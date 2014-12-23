<?php

namespace Kayue\Postmen;

use Guzzle\Http\Client;

/**
 * Class Postmen
 *
 * @see https://www.postmen.com/api
 * @package Kayue\Postment
 */
class Postmen
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey;
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
        return "https://api.postmen.com/v2";
    }
}
