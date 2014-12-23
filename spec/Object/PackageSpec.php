<?php

namespace spec\Kayue\Postmen\Object;

use Kayue\Postmen\Object\Box;
use Kayue\Postmen\Object\Item;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PackageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kayue\Postmen\Object\Package');
    }

    function it_return_description()
    {
        $this->setDescription('The description of the package.');
        $this->getDescription()->shouldReturn('The description of the package.');
    }

    function it_return_type()
    {
        $this->setType('liquid');
        $this->getType()->shouldReturn('liquid');
    }

    function it_throw_exception_if_type_is_not_allowed()
    {
        $this->setType('bomb')->shouldThrow('\InvalidArgumentException');
    }

    function it_return_box()
    {
        $box = new Box();
        $this->setBox($box);
        $this->getBox()->shouldReturn($box);
    }

    function it_return_items()
    {
        $item1 = new Item();
        $item2 = new Item();

        $this->addItem($item1);
        $this->getItems()->shouldHaveCount(1);
        $this->addItem($item2);
        $this->getItems()->shouldHaveCount(2);
        $this->getItems()->shouldContain($item1);
        $this->getItems()->shouldContain($item2);
    }
}
