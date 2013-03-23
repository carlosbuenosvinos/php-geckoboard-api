<?php

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\NumberAndSecondaryStat;

class NumberAndSecondaryStatTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonForAnEmptyData()
    {
        $widget = new NumberAndSecondaryStat();
        $json = json_encode($widget->getData());
        $this->assertEquals('{"item":[{"text":"","value":0,"prefix":""},{"text":"","value":0}]}', $json);
    }

    public function testGetAndSetWidgetId()
    {
        $widget = new NumberAndSecondaryStat();
        $this->assertNull($widget->getId());

        $testId = 'test-id';
        $this->assertSame($testId, $widget->setId('test-id')->getId());
    }

    public function testJsonForSomeData()
    {
        $widget = new NumberAndSecondaryStat();
        $widget->setMainValue(35);
        $json = json_encode($widget->getData());
        $this->assertEquals('{"item":[{"text":"","value":35,"prefix":""},{"text":"","value":0}]}', $json);
    }

    public function testJsonForFullData()
    {
        $widget = new NumberAndSecondaryStat();
        $widget->setMainValue(100);
        $widget->setSecondaryValue(50);
        $widget->setMainPrefix('EUR');
        $json = json_encode($widget->getData());
        $this->assertEquals('{"item":[{"text":"","value":100,"prefix":"EUR"},{"text":"","value":50}]}', $json);
    }
}
