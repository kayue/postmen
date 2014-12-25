<?php

namespace Kayue\Postmen\Exception;

use Exception;
use Guzzle\Http\Message\Response;

class BadResponseException extends Exception
{
    protected $code;
    protected $type;
    protected $message;

    public static function factory(Response $response)
    {
        if ($response->getStatusCode() >= 300) {
            return new BadResponseException("Postmen server return error {$response->getStatusCode()}");
        }

        $json = $response->json();

        if ($json['meta']['code'] >= 300) {
            if (isset($json['meta']['message'])) {
                return new BadResponseException($json['meta']['message']);
            }

            return new BadResponseException('Postmen server error '.$json["meta"]["code"]);
        }

        return new BadResponseException('Unknown Postmen exception');
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
}
