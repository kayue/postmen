<?php

namespace Kayue\Postmen\Result;

use Guzzle\Http\Message\Response;
use Kayue\Postmen\Exception\BadResponseException;

class ResultFactory
{
    static function create(Response $response)
    {
        if ($response->getStatusCode() >= 300) {
            throw BadResponseException::factory($response);
        }

        $json = $response->json();

        if (!isset($json['meta']['code']) || $json['meta']['code'] >= 300) {
            throw BadResponseException::factory($response);
        }

        $result = new Result();
        $result->setMeta($json['meta']);
        $result->setData($json['data']);

        return $result;
    }
} 
