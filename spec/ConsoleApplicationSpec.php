<?php

namespace spec\App;

use App\ConsoleApplication;
use App\Command\CommandInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConsoleApplicationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ConsoleApplication::class);
    }


}
