<?php

namespace spec\App;

use App\ConsoleApplication;
use App\Command\CommandInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Pimple\Container;

class ConsoleApplicationSpec extends ObjectBehavior
{

    function let(Container $Container)
    {
        $this->beConstructedWith($Container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ConsoleApplication::class);
    }


}
