# Currency Conversion App
PHP 7  Currency Conversion App

## Install
1. clone the repository
2. run ```php composer.phar install```

## Running application
1. cd ```/to/project/```
2. chmod +x console.php
3. ./console.php help

## Tests
1. run tests with: ```php bin/phpspec run --format=pretty``` currently failing due to running out of time.


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
USD '670.7'

```

#### convert (multiple):
```
./console.php convert 'BGN 1000','ARS 1000'
```

#### Result:
```
USD '670.7', USD '229.4'

```

## Things I would add with more time
1. Setup tests sooner, ran out of time at the end. Put together using Pimple DI so should be straight forward for to test (with more time).
2. Use a framework. (see other github projects for example). The brief states PHP script which I interpreted as native script. I hope I was not wrong :(
3. Add interfaces for command classes
4. Tidy up CurrencyConversion Service
5. TDD. Difficult to do in 3 hours.
6. Check for typos, was in a rush at the end.
7. Add more comments around usage and class packages

