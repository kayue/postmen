<?php

namespace Kayue\Postmen\Object;

class Box extends AbstractObject
{
    protected $name;
    protected $type = 'custom';
    protected $acceptCustom;
    protected $default;
    protected $weight;
    protected $depth;
    protected $height;
    protected $width;
    protected $weightUnit = 'kg';
    protected $dimensionUnit = 'cm';

    public function getAcceptCustom()
    {
        return $this->acceptCustom;
    }

    public function setAcceptCustom($acceptCustom)
    {
        $this->acceptCustom = $acceptCustom;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function setDefault($default)
    {
        $this->default = $default;
    }

    public function getDepth()
    {
        return $this->depth;
    }

    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    public function getDimensionUnit()
    {
        return $this->dimensionUnit;
    }

    public function setDimensionUnit($dimensionUnit)
    {
        $this->dimensionUnit = $dimensionUnit;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
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

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }
}
