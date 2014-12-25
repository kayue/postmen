<?php

namespace Kayue\Postmen\Object;

use Doctrine\Common\Inflector\Inflector;
use JsonSerializable;

abstract class AbstractObject implements JsonSerializable
{
    function __construct(array $options = [])
    {
        foreach ($options as $key => $value) {
            $this->$key = $value;
        }
    }

    public function jsonSerialize()
    {
        $result = [];

        foreach(get_class_methods($this) as $method) {
            if (strpos($method, 'get') !== 0) {
                continue;
            }

            $value = $this->$method();

            if (is_null($value)) {
                continue;
            }

            if ($value instanceof JsonSerializable) {
                $value = $value->jsonSerialize();
            }

            $key = Inflector::tableize(substr($method, 3));
            $result[$key] = $value;
        }

        return $result;
    }
}
