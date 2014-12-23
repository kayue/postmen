<?php

namespace Kayue\Postmen\Object;

class Shipment extends AbstractObject
{
    protected $shipFrom;
    protected $shipTo;
    protected $packages = [];

    public function setShipTo(Address $address)
    {
        $this->shipTo = $address;
    }

    public function getShipTo()
    {
        return $this->shipTo;
    }

    public function setShipFrom(Address $address)
    {
        $this->shipFrom = $address;
    }

    public function getShipFrom()
    {
        return $this->shipFrom;
    }

    public function addPackage(Package $package)
    {
        $this->packages[] = $package;
    }

    public function setPackages(array $packages)
    {
        $this->packages = $packages;
    }

    public function getPackages()
    {
        return $this->packages;
    }
}
