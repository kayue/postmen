<?php

namespace spec\Kayue\Postmen\Object;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ItemSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kayue\Postmen\Object\Item');
    }
}
