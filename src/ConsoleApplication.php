<?php

namespace App;

use App\Exception\ConsoleApplicationException;
use Pimple\Container;

class ConsoleApplication
{


    /**
     * @var Container
     */
    protected $container;

    /**
     * ConsoleApplication constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }


    /**
     * @param array $input
     * @throws ConsoleApplicationException
     * @throws \Throwable
     */
    public function run(array $input)
    {

        try {

            list($cmd, $argument) = $this->getConsoleArguments($input);
            if ($cmd == null || $cmd == "help") {
                return $this->displayConsoleCommandsHelp();
            }

            if ($this->checkSAPI() && $this->commandExists($cmd)) {
                $ConsoleCommand = $this->container['commands'][$cmd];
                $cmdClass = $ConsoleCommand['commandClass'];
                return $this->container[$cmdClass]->run($argument);
            }

        } catch (ConsoleApplicationException $e) {
            echo "(Application Exception) " . $e->getMessage() . PHP_EOL;
        } catch (\Throwable $e) {
            echo "(System Error)" . $e->getMessage() . PHP_EOL;
        }
    }


    /**
     * @param array $input
     * @return array
     */
    protected function getConsoleArguments(array $input)
    {
        $command = $input[1] ?? null;
        $argument = $input[2] ?? null;
        return [$command, $argument];
    }


    protected function displayConsoleCommandsHelp()
    {
        echo <<<EOT
Currency Conversion Console App

Available Functions:
- updateRates
- convert '\$currency \$amount'

EOT;
    }

    /**
     * @param string $cmd
     * @return bool
     * @throws ConsoleApplicationException
     */
    protected function commandExists(string $cmd)
    {
        if (array_key_exists($cmd, $this->container['commands']) === false) {
            throw new ConsoleApplicationException('Unable to locate command: ' . $cmd);
        }
        return true;
    }

    /**
     * @return bool
     * @throws ConsoleApplicationException
     */
    protected function checkSAPI()
    {
        if (php_sapi_name() != 'cli') {
            throw new ConsoleApplicationException('This application must be run on the command line.');
        }
        return true;
    }


}
