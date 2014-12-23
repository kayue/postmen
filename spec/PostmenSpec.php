<?php

namespace spec\Kayue\Postmen;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostmenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kayue\Postmen\Postmen');
    }
}
