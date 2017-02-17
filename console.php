#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use App\ConsoleApplication;
use Pimple\Container;

$dependencies = require __DIR__ . '/config/dependencies.php';
$params = require __DIR__ . '/config/params.php';
$commands = require __DIR__ . '/config/commands.php';
$Container = new Container(array_merge($dependencies, $params, $commands));

$app = new ConsoleApplication($Container);
$app->run($argv);
