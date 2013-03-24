CarlosIO\Geckoboard
===================

[![Build Status](https://secure.travis-ci.org/carlosbuenosvinos/php-geckoboard-api.png?branch=master)](http://travis-ci.org/carlosbuenosvinos/php-geckoboard-api)

A PHP library for dealing with Geckoboard API (http://www.geckoboard.com)

Installation
============

The best way to install the library is by using [Composer](http://getcomposer.org). Add the following to `composer.json` in the root of your project:

``` javascript
{
    "require": {
        "carlosio/geckoboard": "dev-master"
    }
}
```

Then, on the command line:

``` bash
curl -s http://getcomposer.org/installer | php
php composer.phar install
```

Use the generated `vendor/autoload.php` file to autoload the library classes.

Usage
=====

```php
<?php
    require __DIR__ . '/vendor/autoload.php';

    use CarlosIO\Geckoboard\Widgets\NumberAndSecondaryStat;
    use CarlosIO\Geckoboard\Client;

    $myWidget = new NumberAndSecondaryStat();
    $myWidget->setId('<your widget id>');
    $myWidget->setMainValue(100);
    $myWidget->setSecondaryValue(50);
    $myWidget->setMainPrefix('EUR');

    $geckoboardClient = new Client();
    $geckoboardClient->setApiKey('<your token>');
    $geckoboardClient->push($myWidget);
```

Testing
=======

In order to run the test, update ```php composer.phar update --dev```

    $ bin/phpunit --coverage-text
