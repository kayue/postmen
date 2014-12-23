<?php

namespace Kayue\Postmen\Object;

use JsonSerializable;

abstract class AbstractObject implements JsonSerializable
{
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

            $key = $this->convertCamelcaseToUnderscore(substr($method, 3));
            $result[$key] = $value;
        }

        return $result;
    }

    private function convertCamelcaseToUnderscore($string)
    {
        $string = preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", $string);
        return strtolower($string);
    }
}
