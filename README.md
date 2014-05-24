CarlosIO\Geckoboard
===================

[![Build Status](https://secure.travis-ci.org/carlosbuenosvinos/php-geckoboard-api.png?branch=master)](http://travis-ci.org/carlosbuenosvinos/php-geckoboard-api)
[![Latest Stable Version](https://poser.pugx.org/carlosio/geckoboard/v/stable.svg)](https://packagist.org/packages/carlosio/geckoboard) [![Total Downloads](https://poser.pugx.org/carlosio/geckoboard/downloads.svg)](https://packagist.org/packages/carlosio/geckoboard) [![Latest Unstable Version](https://poser.pugx.org/carlosio/geckoboard/v/unstable.svg)](https://packagist.org/packages/carlosio/geckoboard) [![License](https://poser.pugx.org/carlosio/geckoboard/license.svg)](https://packagist.org/packages/carlosio/geckoboard)

A PHP library for pushing data into Geckoboard custom widgets (http://www.geckoboard.com)

Installation
============

The best way to install the library is by using [Composer](http://getcomposer.org). Add the following to `composer.json` in the root of your project:

``` javascript
{
    "require": {
        "carlosio/geckoboard": "~1.0.0"
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
require __DIR__ . '/vendor/autoload.php';

use CarlosIO\Geckoboard\Widgets\NumberAndSecondaryStat;
use CarlosIO\Geckoboard\Client;

$widget = new NumberAndSecondaryStat();
$widget->setId('<your widget id>');
$widget->setMainValue(123);
$widget->setSecondaryValue(238);
$widget->setMainPrefix('EUR');

$geckoboardClient = new Client();
$geckoboardClient->setApiKey('<your token>');
$geckoboardClient->push($widget);
```

Widget: Number and optional secondary stat
==========================================
[![Number and optional secondary stat](http://cdn2.hubspot.net/hub/326854/file-376188200-png/images/Number2ndstat-1.png)](http://www.geckoboard.com/developers/custom-widgets/widget-types/number-and-optional-secondary-stat/)

```php
use CarlosIO\Geckoboard\Widgets\NumberAndSecondaryStat;
use CarlosIO\Geckoboard\Client;

$widget = new NumberAndSecondaryStat();
$widget->setId('<your widget id>');
$widget->setMainValue(123);
$widget->setSecondaryValue(238);
$widget->setMainPrefix('EUR');

$geckoboardClient = new Client();
$geckoboardClient->setApiKey('<your token>');
$geckoboardClient->push($widget);
```

Widget: RAG numbers only
========================
[![RAG numbers only](http://cdn2.hubspot.net/hub/326854/file-376184420-png/images/RAGNumbers-1.png)](http://www.geckoboard.com/developers/custom-widgets/widget-types/rag-numbers-only/)

```php
use CarlosIO\Geckoboard\Data\Entry;
use CarlosIO\Geckoboard\Widgets\RagNumbers;
use CarlosIO\Geckoboard\Client;

$widget = new RagNumbers();
$widget->setId('<your widget id>');

$redData = new Entry();
$redData->setValue(132)->setText('This is the red description');
$widget->setRedData($redData);

$amberData = new Entry();
$amberData->setValue(134)->setText('This is the amber description');
$widget->setAmberData($amberData);

$greenData = new Entry();
$greenData->setValue(34)->setText('This is the green description');
$widget->setGreenData($greenData);

$geckoboardClient->push($widget);
```

Widget: RAG column and numbers
==============================
[![RAG column and numbers](http://cdn2.hubspot.net/hub/326854/file-377705499-png/images/RAGColNum-1-1.png)](http://www.geckoboard.com/developers/custom-widgets/widget-types/rag-column-and-numbers/)

```php
use CarlosIO\Geckoboard\Data\Entry;
use CarlosIO\Geckoboard\Widgets\RagColumnAndNumbers;
use CarlosIO\Geckoboard\Client;

$widget = new RagColumnAndNumbers();
$widget->setId('<your widget id>');

$redData = new Entry();
$redData->setValue(132)->setText('This is the red description');
$widget->setRedData($redData);

$amberData = new Entry();
$amberData->setValue(13)->setText('This is the amber description');
$widget->setAmberData($amberData);

$greenData = new Entry();
$greenData->setValue(3)->setText('This is the green description');
$widget->setGreenData($greenData);

$geckoboardClient->push($widget);
```

Widget: Text
============
[![Text](http://cdn2.hubspot.net/hub/326854/file-371241154-png/images/Text-1.png)](http://www.geckoboard.com/developers/custom-widgets/widget-types/text/)

```php
use CarlosIO\Geckoboard\Widgets\Text;
use CarlosIO\Geckoboard\Data\Text\Item;
use CarlosIO\Geckoboard\Client;

$widget = new Text();
$widget->setId('<your widget id>');

$firstItem = new Item();
$secondItem = new Item();

$firstItem->setText('Test message 1');

$secondItem->setText('Test message 2');
$secondItem->setType(Item::TYPE_ALERT);

$widget->addItem($firstItem);
$widget->addItem($secondItem);

$geckoboardClient->push($widget);
```

Widget: Funnel
==============
[![Funnel](http://cdn2.hubspot.net/hub/326854/file-373981786-png/images/Funnel-1.png)](http://www.geckoboard.com/developers/custom-widgets/widget-types/funnel/)

```php
use CarlosIO\Geckoboard\Data\Funnel\Entry;
use CarlosIO\Geckoboard\Widgets\Funnel;

$widget = new Funnel();
$widget->setId('<your widget id>');
$widget->setType('reversed');
$widget->setShowPercentage(false);

$error = new Entry();
$error->setLabel('Step 1')->setValue(87809);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 2')->setValue(70022);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 3')->setValue(63232);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 4')->setValue(53232);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 5')->setValue(32123);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 6')->setValue(23232);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 7')->setValue(12232);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 8')->setValue(2323);
$widget->addEntry($error);

$geckoboardClient->push($widget);
```

Widget: Map
===========
[![Map](http://cdn2.hubspot.net/hub/326854/file-371190739-png/images/Map-1.png)](http://www.geckoboard.com/developers/custom-widgets/widget-types/map/)

```php
use CarlosIO\Geckoboard\Data\Point;
use CarlosIO\Geckoboard\Widgets\Map;

$widget = new Map();
$widget->setId('<your widget id>');

$point = new Point();
$point->setSize(10)->setColor('FF0000')->setLatitude('40.416775')->setLongitude('-3.70379');
$widget->addPoint($point);

$geckoboardClient->push($widget);
```

Widget: LineChart
=================
[![Line Chart](http://cdn2.hubspot.net/hub/326854/file-373977296-png/images/Line-1.png)](http://www.geckoboard.com/developers/custom-widgets/widget-types/line-chart)

```php
use CarlosIO\Geckoboard\Widgets\LineChart;

$widget = new LineChart();
$widget->setId('<your widget id>');
$widget->setItems(array(1, 1.23));
$widget->setColour("ff0000");
$widget->setAxis(LineChart::DIMENSION_X, array("min", "max"));
$widget->setAxis(LineChart::DIMENSION_Y, array("bottom", "top"));

$geckoboardClient->push($widget);
```

Testing
=======

In order to run the test, install all dependencies: ```php composer.phar install```

    $ bin/phpunit --coverage-text
