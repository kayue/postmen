<?php

namespace spec\Kayue\Postmen\Object;

use Kayue\Postmen\Object\Address;
use Kayue\Postmen\Object\Package;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ShipmentSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kayue\Postmen\Object\Shipment');
    }

    function it_should_return_addresses()
    {
        $from = new Address();
        $to = new Address();

        $this->setShipFrom($from);
        $this->getShipFrom()->shouldReturn($from);

        $this->setShipTo($to);
        $this->getShipTo()->shouldReturn($to);
    }

    function it_should_return_package()
    {
        $package = new Package();
        $this->addPackage($package);
        $this->getPackages()->shouldBeArray();
        $this->getPackages()->shouldContain($package);
    }
}
