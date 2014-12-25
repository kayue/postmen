<?php

namespace Kayue\Postmen\Object;

class Item extends AbstractObject
{
    protected $name;
    protected $originCountry;
    protected $quantity;
    protected $value;
    protected $currency;
    protected $weight;
    protected $weightUnit;

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getOriginCountry()
    {
        return $this->originCountry;
    }

    public function setOriginCountry($originCountry)
    {
        $this->originCountry = $originCountry;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWeightUnit()
    {
        return $this->weightUnit;
    }

    public function setWeightUnit($weightUnit)
    {
        $this->weightUnit = $weightUnit;
    }
}
