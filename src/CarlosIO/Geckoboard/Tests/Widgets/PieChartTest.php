<?php

namespace CarlosIO\Geckoboard\Tests\Widgets;

use CarlosIO\Geckoboard\Data\PieChart\Entry;
use CarlosIO\Geckoboard\Widgets\PieChart;

class PieChartTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonForFullData()
    {
        $myWidget = new PieChart();
        $myWidget->setId('29473-d7ae87e3-ac3f-4911-95ce-ec91439a4170');

        $entry = new Entry();
        $entry->setLabel('Portion 1')->setValue(87809)->setColor('ffffff');
        $myWidget->addEntry($entry);

        $entry = new Entry();
        $entry->setLabel('Portion 2')->setValue(70022)->setColor('dddddd');
        $myWidget->addEntry($entry);

        $entry = new Entry();
        $entry->setLabel('Portion 3')->setValue(63232)->setColor('eaeaea');
        $myWidget->addEntry($entry);

        $json = json_encode($myWidget->getData());
        $this->assertEquals('{"item":[{"value":"87809","label":"Portion 1","color":"ffffff"},{"value":"70022","label":"Portion 2","color":"dddddd"},{"value":"63232","label":"Portion 3","color":"eaeaea"}]}', $json);
    }
}
