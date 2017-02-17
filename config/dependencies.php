<?php

use App\Command\{
    UpdateRatesCommand,
    ConvertCommand,
    ConvertCollectionCommand
};
use App\Service\CurrencyConversion\Client;
use App\Service\CurrencyConversion\Service;
use App\Database\Adapter;
use Pimple\Container;

$container['Client'] = function (Container $c) {
    $location = $c['params']['rate_api_url'];
    return new Client($location);
};

$container['DbAdapter'] = function (Container $c) {
    $dbConfig = $c['params']['db'];
    $PDOConnection = new \PDO($dbConfig['dsn'], $dbConfig['user'], $dbConfig['password']);
    return new Adapter($PDOConnection);
};

$container['Service'] = function (Container $c) {
    return new Service($c['DbAdapter'], $c['Client']);
};

$container['UpdateRatesCommand'] = function (Container $c) {
    $CurrencyService = $c['Service'];
    $UpdateRatesCommand = new UpdateRatesCommand($CurrencyService);
    return $UpdateRatesCommand;
};

$container['ConvertCommand'] = function (Container $c) {
    $CurrencyService = $c['Service'];
    $ConvertCommand = new ConvertCommand($CurrencyService);
    return $ConvertCommand;
};

return $container;