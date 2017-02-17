<?php

namespace App\Database;


class Adapter
{

    /**
     * @var \PDO
     */
    protected $connection;

    /**
     * Adapter constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param $currency
     * @return string
     */
    public function fetchCurrencyRate($currency)
    {
        $statement = $this->connection->prepare("SELECT exchange_rate FROM currency_rates WHERE currency_code = :currency_code");
        $statement->execute([':currency_code' => $currency]);
        $result = $statement->fetchColumn();
        return $result;
    }

    /**
     * @param $currency
     * @param $rate
     * @return bool
     */
    public function persistCurrencyRate($currency, $rate)
    {
        if ($this->currencyAlreadyExists($currency)) {
            return $this->updateCurrencyRate($currency, $rate);
        } else {
            return $this->insertCurrencyRate($currency, $rate);
        }

    }

    /**
     * @param $currency
     * @return bool
     */
    protected function currencyAlreadyExists($currency)
    {
        $statement = $this->connection->prepare("SELECT count(*) FROM currency_rates WHERE currency_code = :currency_code");
        $statement->execute([':currency_code' => $currency]);
        $result = $statement->fetchColumn();
        return (bool)$result;
    }

    /**
     * @param $currency
     * @param $rate
     * @return bool
     */
    protected function insertCurrencyRate($currency, $rate)
    {
        $statement = $this->connection
            ->prepare("INSERT INTO currency_rates (currency_code, exchange_rate, update_date) VALUES (:currency_code, :exchange_rate, NOW())");

        $statement->bindParam(':currency_code', $currency);
        $statement->bindParam(':exchange_rate', $rate);
        return $statement->execute();
    }

    /**
     * @param $currency
     * @param $rate
     * @return bool
     */
    protected function updateCurrencyRate($currency, $rate)
    {
        $statement = $this->connection
            ->prepare("UPDATE currency_rates SET exchange_rate = :exchange_rate, update_date  = NOW() WHERE currency_code = :currency_code");

        $statement->bindParam(':currency_code', $currency);
        $statement->bindParam(':exchange_rate', $rate);
        return $statement->execute();
    }


}