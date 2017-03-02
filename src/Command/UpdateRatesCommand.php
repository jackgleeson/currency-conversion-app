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
        $output = '';
        if (count($result) > 0) {
            $output .= "--- Rates have been updated from API! ---" . PHP_EOL;
            foreach ($result as $currency) {
                $output .= "--- " . $currency->currency . " = " . $currency->rate . " ---" . PHP_EOL;
            }
        } else {
            $output .= "--- Unable to pull down rates from API ---" . PHP_EOL;
        }
        return $output;
    }
}

