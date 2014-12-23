<?php

namespace Kayue\Postmen\Object;

class Package extends AbstractObject
{
    protected $type;
    protected $description;
    protected $box;
    protected $items = [];

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function addItem(Item $item)
    {
        $this->items[] = $item;
    }

    public function getBox()
    {
        return $this->box;
    }

    public function setBox(Box $box)
    {
        $this->box = $box;
    }

    public function getItems()
    {
        return $this->items;
    }
}
