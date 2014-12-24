<?php

namespace spec\Kayue\Postmen\Result;

use Guzzle\Http\Message\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResultFactorySpec extends ObjectBehavior
{
    function let(Response $response)
    {
        $response->getStatusCode()->willReturn(200);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kayue\Postmen\Result\ResultFactory');
    }

    function it_returns_meta(Response $response)
    {
        $response->json()->shouldBeCalled()->willReturn(
            json_decode(file_get_contents('spec/Resources/fixtures/rates_response.json'), true)
        );

        $result = $this::create($response);
        $result->getMeta()->shouldReturn(["code" => 200]);
        $result->getMeta()->shouldNotReturn(["code" => 400]);
    }

    function it_returns_data(Response $response)
    {
        $response->json()->shouldBeCalled()->willReturn(
            json_decode(file_get_contents('spec/Resources/fixtures/rates_response.json'), true)
        );

        $result = $this::create($response);
        $result->getData()->shouldHaveKey("rates");
        $result->getData()['rates']->shouldBeArray();
        $result->getData()['rates'][0]->shouldHaveKey("shipper_account");
        $result->getData()['rates'][0]->shouldHaveKey("service_name");
        $result->getData()['rates'][0]->shouldContain("Fedex International First");
    }

    function it_throws_exception_response_is_not_ok(Response $response)
    {
        $response->getStatusCode()->shouldBeCalled()->willReturn(400);

        $this->shouldThrow('\Kayue\Postmen\Exception\BadResponseException')->during('create', [$response]);
    }

    function it_throws_exception_if_api_key_is_invalid(Response $response)
    {
        $response->json()->shouldBeCalled()->willReturn(
            json_decode(file_get_contents('spec/Resources/fixtures/invalid_api_key_response.json'), true)
        );

        $this->shouldThrow('\Kayue\Postmen\Exception\BadResponseException')->during('create', [$response]);
    }

    function it_throws_exception_if_shipper_account_authentication_failed(Response $response)
    {
        $response->json()->shouldBeCalled()->willReturn(
            json_decode(file_get_contents('spec/Resources/fixtures/shipper_account_authentication_failed_response.json'), true)
        );

        $this->shouldThrow('\Kayue\Postmen\Exception\BadResponseException')->during('create', [$response]);
    }
}
