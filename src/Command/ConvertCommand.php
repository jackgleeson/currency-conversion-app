<?php

namespace App\Command;

use App\Service\CurrencyConversion\Service;

class ConvertCommand
{
    /**
     * @var Service
     */
    protected $Service;

    /**
     * ConvertCommand constructor.
     * @param Service $Service
     */
    public function __construct(Service $Service)
    {
        $this->Service = $Service;
    }


    /**
     * @param $input
     * @throws \App\Exception\ConsoleApplicationException
     */
    public function run($input)
    {
        if ($input !== null) {
            if (count(explode(",", $input)) > 0) {
                $output = '';
                foreach (explode(",", $input) as $currencyItem) {
                    list($currency, $amount) = explode(" ", $currencyItem);
                    $rate = $this->Service->getCurrentExchangeRate($currency);
                    $output .= "USD '" . ($amount * $rate) . "', ";
                }
                echo substr($output, 0, -2) . PHP_EOL;

            } else {
                list($currency, $amount) = explode(" ", $input);
                $rate = $this->Service->getCurrentExchangeRate($currency);
                echo "USD '" . ($amount * $rate) . "" . PHP_EOL;
            }

        } else {
            echo 'usage: convert \'$currency $amount\'' . PHP_EOL;
            echo 'usage: convert \'$currency $amount\',\'$currency $amount\'' . PHP_EOL;
        }

    }
}
