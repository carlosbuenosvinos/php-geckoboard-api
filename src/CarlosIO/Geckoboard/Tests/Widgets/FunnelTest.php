<?php

namespace CarlosIO\Geckoboard\Tests\Widgets;

use CarlosIO\Geckoboard\Data\Funnel\Entry;
use CarlosIO\Geckoboard\Widgets\Funnel;

class FunnelTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonForFullData()
    {
        $myWidget = new Funnel();
        $myWidget->setId('29473-d7ae87e3-ac3f-4911-95ce-ec91439a4170');
        $myWidget->setType('reversed');
        $myWidget->setShowPercentage(false);

        $error = new Entry();
        $error->setLabel('Step 1')->setValue(87809);
        $myWidget->addEntry($error);

        $error = new Entry();
        $error->setLabel('Step 2')->setValue(70022);
        $myWidget->addEntry($error);

        $error = new Entry();
        $error->setLabel('Step 3')->setValue(63232);
        $myWidget->addEntry($error);

        $error = new Entry();
        $error->setLabel('Step 4')->setValue(53232);
        $myWidget->addEntry($error);

        $error = new Entry();
        $error->setLabel('Step 5')->setValue(32123);
        $myWidget->addEntry($error);

        $error = new Entry();
        $error->setLabel('Step 6')->setValue(23232);
        $myWidget->addEntry($error);

        $error = new Entry();
        $error->setLabel('Step 7')->setValue(12232);
        $myWidget->addEntry($error);

        $error = new Entry();
        $error->setLabel('Step 8')->setValue(2323);
        $myWidget->addEntry($error);

        $json = json_encode($myWidget->getData());
        $this->assertEquals('{"type":"reverse","percentage":"hide","item":[{"value":"87809","label":"Step 1"},{"value":"70022","label":"Step 2"},{"value":"63232","label":"Step 3"},{"value":"53232","label":"Step 4"},{"value":"32123","label":"Step 5"},{"value":"23232","label":"Step 6"},{"value":"12232","label":"Step 7"},{"value":"2323","label":"Step 8"}]}', $json);
    }
}
