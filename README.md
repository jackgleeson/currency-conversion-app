# Currency Conversion App
PHP 7 Currency Conversion App

## Requirements
1. PHP 7.0
1. SimpleXML, PHP mysqlnd, PDO_mysql

## Install
1. clone the repository
2. cd /in/to/project/
3. install composer (https://getcomposer.org/download/)
4. run ```php composer.phar install```

## Setup MySQL Database
1. create mysql dastabase ```demo```
2. create user ```CREATE USER 'demo_user'@'localhost' IDENTIFIED BY 'demo_password';```
3. grant privileges ```GRANT ALL PRIVILEGES ON demo.* TO 'demo_user'@'localhost';```
3. run ```mysql -u demo_user -p demo < table.sql```

## Running application
2. chmod +x console.php
3. ./console.php help

## Tests
1. run tests with: ```php bin/phpspec run```


## Example Currency Conversion Commands
#### updateRates:
```
./console.php updateRates
```

#### Result:
```
--- Rates have been updated from API! ---
--- JPY = 0.013125 ---
--- BGN = 0.6707 ---
--- CZK = 0.05190 ---
--- ARS = 0.2294 ---
--- AUD = 1.0689 ---

```

#### convert (single):
```
./console.php convert 'BGN 1000'
```

#### Result:
```
'USD 670.7'

```

#### convert (multiple):
```
./console.php convert 'BGN 1000','ARS 1000'
```

#### Result:
```
'USD 670.7','USD 229.4'

```

## Things I would add with more time
1. Setup tests sooner, ran out of time at the end. Put together using Pimple DI so should be straight forward for to test (with more time).
2. Use a framework. (see other github projects for example). The brief states PHP script which I interpreted as native script. I hope I was not wrong :(
3. Add interfaces for command classes
4. Tidy up CurrencyConversion Service
5. Add PHP 7.1 Return Type Declarations and Argument Type Declarations (see other github projects for example).
6. TDD. Difficult to do in 3 hours.
7. Check for typos, was in a rush at the end.
8. Add more comments around usage and class packages

