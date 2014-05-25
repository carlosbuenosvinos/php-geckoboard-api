<?php

namespace CarlosIO\Geckoboard\Tests\Data;

use CarlosIO\Geckoboard\Data\Entry;

class EntryTest extends \PHPUnit_Framework_TestCase
{
    public function testFullMethodsDataEntry()
        {
        $entry = new Entry();
        $entry
            ->setValue(100)
            ->setPrefix('EUR')
            ->setText('Step 1');

        $json = json_encode($entry->toArray());
        $this->assertEquals('{"text":"Step 1","value":100,"prefix":"EUR"}', $json);
    }
}
