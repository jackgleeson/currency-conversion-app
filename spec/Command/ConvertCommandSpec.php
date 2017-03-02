<?php

namespace spec\App\Command;

use App\Command\ConvertCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class ConvertCommandSpec extends ObjectBehavior
{

    function let($Service)
    {
        $Service->beADoubleOf('App\Service\CurrencyConversion\Service');
        $Service->getCurrentExchangeRate("CHF")->willReturn(1.1154);
        $Service->getCurrentExchangeRate("JPY")->willReturn(0.013125);
        $this->beConstructedWith($Service);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ConvertCommand::class);
    }

    function it_should_return_command_usage_text_if_no_input_provided()
    {
        $input = null;
        $this->run($input)->shouldMatch("/^usage: convert.*/");
    }

    function it_should_return_usd_amount_if_currency_amount_provided()
    {
        $input = "CHF 100";
        $this->run($input)->shouldMatch("/'USD.*/");
    }

    function it_should_convert_input_currency_amount_to_usd_equivalent()
    {
        $input = "CHF 100";
        $this->run($input)->shouldEqual("'USD 111.54'");
    }

    function it_should_convert_multiple_currency_elements_to_usd_equivalent()
    {
        $input = "CHF 100,JPY 5000";
        $this->run($input)->shouldEqual("'USD 111.54','USD 65.625'");
    }

}
