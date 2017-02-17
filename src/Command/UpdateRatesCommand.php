<?php

namespace App\Command;

use App\Service\CurrencyConversion\Service;

class UpdateRatesCommand
{
    /**
     * @var Service
     */
    protected $Service;

    /**
     * UpdateRatesCommand constructor.
     * @param Service $Service
     */
    public function __construct(Service $Service)
    {
        $this->Service = $Service;
    }


    public function run()
    {
        $result = $this->Service->getUpdatedRatesFromAPI();
        if (count($result) > 0) {
            echo "--- Rates have been updated from API! ---" . PHP_EOL;
            foreach ($result as $currency) {
                echo "--- " . $currency->currency . " = " . $currency->rate . " ---" . PHP_EOL;
            }
        } else {
            echo "--- Unable to pull down rates from API ---" . PHP_EOL;
        }
    }
}

