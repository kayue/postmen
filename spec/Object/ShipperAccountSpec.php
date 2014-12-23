<?php

namespace spec\Kayue\Postmen\Object;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ShipperAccountSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('fedex', [
            'account_number' => 'FEDEX_ACCOUNT_NUMBER',
            'key' => 'FEDEX_KEY',
            'password' => 'FEDEX_PASSWORD',
            'meter_number' => 'FEDEX_METER_NUMBER',
        ]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kayue\Postmen\Object\ShipperAccount');
    }

    function it_does_not_require_account_options()
    {
        $this->beConstructedWith('fedex');
    }

    function it_requires_account_options_to_be_an_array()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('__construct', ['fedex', 'invalid']);
    }
}
