<?php

namespace CarlosIO\Geckoboard\Tests\Widgets;

use CarlosIO\Geckoboard\Data\Entry;
use CarlosIO\Geckoboard\Widgets\GeckoMeter;

class GeckoMeterTest extends \PHPUnit_Framework_TestCase
{
    public function testRevesed()
    {
        $myGeckoMeter = new GeckoMeter();

        $this->assertFalse($myGeckoMeter->getReversed());

        $myGeckoMeter->setReversed(true);

        $this->assertTrue($myGeckoMeter->getReversed());
    }

    public function testValue()
    {
        $myGeckoMeter = new GeckoMeter();

        $this->assertNull($myGeckoMeter->getValue());

        $myGeckoMeter->setValue('value');

        $this->assertSame('value', $myGeckoMeter->getValue());
    }

    public function testMinMaxData()
    {
        $myGeckoMeter = new GeckoMeter();

        $entry = new Entry();

        $myGeckoMeter->setMinData($entry);
        $myGeckoMeter->setMaxData($entry);

        $this->assertSame($entry, $myGeckoMeter->getMinData());
        $this->assertSame($entry, $myGeckoMeter->getMaxData());
    }

    public function testEntryException()
    {
        $myGeckoMeter = new GeckoMeter();

        $this->setExpectedException('\Exception');

        $myGeckoMeter->getMinData();
    }

    public function testGetData()
    {
        $myGeckoMeter = new GeckoMeter();

        $entry = new Entry();
        $entry->setValue(10);
        $entry->setPrefix('');
        $entry->setText('text');

        $myGeckoMeter->setReversed(true);
        $myGeckoMeter->setValue(10);
        $myGeckoMeter->setMinData($entry);
        $myGeckoMeter->setMaxData($entry);

        $expectedData =array(
            'item' => $myGeckoMeter->getValue(),
            'max' => array(
                'text' => $entry->getText(),
                'value' => $entry->getValue(),
                'prefix' => $entry->getPrefix(),
            ),
            'min' => array(
                'text' => $entry->getText(),
                'value' => $entry->getValue(),
                'prefix' => $entry->getPrefix(),
            ),
            'type' => 'reversed',
        );

        $this->assertSame($expectedData, $myGeckoMeter->getData());


    }
}
