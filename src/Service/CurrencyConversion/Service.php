<?php

namespace App\Service\CurrencyConversion;


use App\Exception\ConsoleApplicationException;
use App\Database\Adapter;

class Service
{
    /**
     * @var \PDO
     */
    protected $dbAdapter;

    /**
     * @var Client
     */
    protected $Client;

    /**
     * Service constructor.
     * @param Adapter $dbAdapter
     * @param Client $Client
     */
    public function __construct(Adapter $dbAdapter, Client $Client)
    {
        $this->dbAdapter = $dbAdapter;
        $this->Client = $Client;
    }

    /**
     * @param string $currency
     * @return float
     * @throws ConsoleApplicationException
     */
    public function getCurrentExchangeRate(string $currency)
    {
        $result = $this->dbAdapter->fetchCurrencyRate($currency);
        if ($result === false) {
            throw new ConsoleApplicationException("Unable to locate currency conversion rate using currency code: " . $currency);
        } else {
            return (float)$result;
        }

    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getUpdatedRatesFromAPI()
    {
        $currencyRateCollection = $this->Client->fetchLatestRatesAsObjects();
        $this->saveLatestCurrencyRates($currencyRateCollection);
        return $currencyRateCollection;
    }

    /**
     * @param $currencyRateCollection
     * @return bool
     * @throws \Exception
     */
    protected function saveLatestCurrencyRates($currencyRateCollection)
    {
        try {
            foreach ($currencyRateCollection as $currencyRate) {
                $this->dbAdapter->persistCurrencyRate($currencyRate->currency, $currencyRate->rate);
            }
        } catch (\Exception $e) {
            throw $e;
        }
        return true;

    }

}