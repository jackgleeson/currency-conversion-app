<?php

namespace spec\App\Command;

use App\Command\UpdateRatesCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateRatesCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateRatesCommand::class);
    }

}
