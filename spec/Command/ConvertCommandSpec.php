<?php

namespace spec\App\Command;

use App\Command\ConvertCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConvertCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ConvertCommand::class);
    }
}
