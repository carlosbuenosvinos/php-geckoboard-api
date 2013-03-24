CarlosIO\Geckoboard
===================

[![Build Status](https://secure.travis-ci.org/carlosbuenosvinos/php-geckoboard-api.png?branch=master)](http://travis-ci.org/carlosbuenosvinos/php-geckoboard-api)

A PHP library for dealing with Geckoboard API (http://www.geckoboard.com)

Requiring in another project
============================
Using composer:

```
    "require": {
        "carlosio/geckoboard": "dev-master"
    }
```

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




