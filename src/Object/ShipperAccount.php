<?php

namespace Kayue\Postmen\Object;

use InvalidArgumentException;

class ShipperAccount extends AbstractObject
{
    protected $slug;
    protected $accountOptions;

    public function __construct($slug, $options = null)
    {
        $this->slug = $slug;

        if($options && !is_array($options)) {
            throw new InvalidArgumentException('Account options must be an array');
        }

        $this->accountOptions = $options;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getAccountOptions()
    {
        return $this->accountOptions;
    }

    public function setAccountOptions(array $options)
    {
        $this->accountOptions = $options;
    }
}
