<?php

namespace CarlosIO\Geckoboard\Tests\Widgets;

use CarlosIO\Geckoboard\Data\Point;
use CarlosIO\Geckoboard\Widgets\Map;

class MapTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyMapPoints()
    {
        $myMap = new Map();

        $this->assertSame(array(), $myMap->getPoints());
    }

    public function testGetDataWithOneEmptyPoint()
    {
        $myMap = new Map();

        $point1 = new Point();

        $myMap->addPoint($point1);

        $expectedResult = array('points' => array('point' => array(array())));

        $this->assertSame($expectedResult, $myMap->getData());
    }

    public function testGetDataWithSomePoints()
    {
        $myMap = new Map();

        $point1 = new Point();
        $point1->setCityName('city 1');
        $point1->setColor('color 1');
        $point1->setCountryCode('ES');
        $point1->setSize(1);

        $point2 = new Point();
        $point2->setCityName('city 2');
        $point2->setColor('color 2');
        $point2->setCountryCode('ES');
        $point2->setSize(2);

        $myMap->addPoint($point1);
        $myMap->addPoint($point2);

        $expectedResult = array(
            'points' => array(
                'point' => array(
                    array(
                        'city' => array(
                            'city_name' => $point1->getCityName(),
                            'country_code' => $point1->getCountryCode()
                        ),
                        'size' => $point1->getSize(),
                        'color' => $point1->getColor(),
                    ),
                    array(
                        'city' => array(
                            'city_name' => $point2->getCityName(),
                            'country_code' => $point2->getCountryCode()
                        ),
                        'size' => $point2->getSize(),
                        'color' => $point2->getColor(),
                    ),
                )
            )
        );

        $this->assertSame($expectedResult, $myMap->getData());
    }
}
