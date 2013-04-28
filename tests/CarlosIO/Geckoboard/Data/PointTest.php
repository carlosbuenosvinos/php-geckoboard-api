<?php

namespace CarlosIO\Geckoboard\Widgets;

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
            ->setCountryCode('ES');

        $json = json_encode($point->toArray());
        $this->assertEquals('{"city":{"city_name":"Barcelona","country_code":"ES"},"color":"ffffff","cssclass":"mycss"}', $json);
    }
}
