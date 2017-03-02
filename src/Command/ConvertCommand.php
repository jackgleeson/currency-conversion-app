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
                    $output .= "'USD " . ($amount * $rate) . "',";
                }
                return substr($output, 0, -1);

            } else {
                list($currency, $amount) = explode(" ", $input);
                $rate = $this->Service->getCurrentExchangeRate($currency);
                return "'USD " . ($amount * $rate) . "";
            }

        } else {
            return <<<EOL
usage: convert '\$currency \$amount' 
usage: convert '\$currency \$amount','\$currency \$amount'

EOL;

        }

    }
}
