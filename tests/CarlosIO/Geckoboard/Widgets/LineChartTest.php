<?php

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\LineChart;

class LineChartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test with an empty dataset
     */
    public function testJsonForAnEmptyData()
    {
        $widget = new LineChart();
        $json   = json_encode($widget->getData());
        $this->assertJsonStringEqualsJsonString('{"item":[], "settings": {"axisx": [], "axisy": [], "colour": "ff9900"} }', $json);
    }

    /**
     * Test with a full dataset
     */
    public function testJsonWithValidData()
    {
        $widget = new LineChart();
        $widget->setItems(array(1, 1.23));
        $widget->setColour("ff0000");
        $widget->setAxis(LineChart::DIMENSION_X, array("min", "max"));
        $widget->setAxis(LineChart::DIMENSION_Y, array("bottom", "top"));

        $current = json_encode($widget->getData());
        $expected = <<<EOF
{ "item": [ "1", "1.23"],
  "settings" : {
    "axisx" : [ "min", "max" ],
    "axisy" : [ "bottom", "top" ],
    "colour": "ff0000"
  }
}
EOF;
        $this->assertJsonStringEqualsJsonString($expected, $current);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionOnInvalidColour()
    {
        $widget = new LineChart();
        $widget->setColour("invalid");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionOnInvalidItems()
    {
        $widget = new LineChart();
        $widget->setItems(array("foo", "bar"));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionOnInvalidAxisDimension()
    {
        $widget = new LineChart();
        $widget->setAxis('z', array("foo", "bar"));
    }

}
