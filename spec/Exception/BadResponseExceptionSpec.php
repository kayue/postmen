<?php

namespace spec\Kayue\Postmen\Exception;

use Guzzle\Http\Message\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BadResponseExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kayue\Postmen\Exception\BadResponseException');
    }

    function it_creates_exception_from_response(Response $response)
    {
        $response->getStatusCode()->shouldBeCalled()->willReturn(200);
        $response->json()->shouldBeCalled()->willReturn(
            json_decode(file_get_contents('spec/Resources/fixtures/invalid_api_key_response.json'), true)
        );

        $this->factory($response)->shouldReturnAnInstanceOf('Kayue\Postmen\Exception\BadResponseException');
    }

    function it_creates_exception_with_message(Response $response)
    {
        $response->getStatusCode()->shouldBeCalled()->willReturn(200);
        $response->json()->shouldBeCalled()->willReturn(
            json_decode(file_get_contents('spec/Resources/fixtures/invalid_api_key_response.json'), true)
        );

        $exception = $this->factory($response);
        $exception->getMessage()->shouldReturn('Invalid API key.');
    }
}
