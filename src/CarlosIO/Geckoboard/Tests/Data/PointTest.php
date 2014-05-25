<?php

namespace CarlosIO\Geckoboard\Tests\Data;

use CarlosIO\Geckoboard\Data\Point;

class PointTest extends \PHPUnit_Framework_TestCase
{
    public function testFullMethodsDataEntry()
    {
        $point = new Point();
        $point
            ->setCityName('Barcelona')
            ->setColor('ffffff')
            ->setCssClass('mycss')
            ->setCountryCode('ES')
            ->setSize(8)
            ->setLatitude('1.1')
            ->setLongitude('2.2')
        ;

        $json = json_encode($point->toArray());
        $this->assertEquals('{"city":{"city_name":"Barcelona","country_code":"ES"},"latitude":"1.1","longitude":"2.2","size":8,"color":"ffffff","cssclass":"mycss"}', $json);
    }

    /**
     * @test
     * @expectedException \CarlosIO\Geckoboard\Data\Point\SizeOutOfBoundsException
     */
    public function whenSettingSizeOverTenAnExceptionShouldBeThrown()
    {
        $point = new Point();
        $point
            ->setSize(11);
    }
}
