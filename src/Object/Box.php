<?php

namespace Kayue\Postmen\Object;

class Box extends AbstractObject
{
    const WEIGHT_UNIT_KG = 'kg';
    const WEIGHT_UNIT_LB = 'lb';
    const TYPE_CUSTOM = 'custom';
    const TYPE_TUBE = 'tube';
    const TYPE_FEDEX_PAK = 'fedex_pak';
    const TYPE_BOX_SMALL = 'box_small';
    const TYPE_BOX_MEDIUM = 'box_medium';
    const TYPE_BOX_LARGE = 'box_large';
    const TYPE_BOX_XLARGE = 'box_xlarge';
    const DIMENSION_UNIT_CM = 'cm';
    const DIMENSION_UNIT_IN = 'in';

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
