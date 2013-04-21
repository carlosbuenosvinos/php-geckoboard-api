<?php

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Text;
use CarlosIO\Geckoboard\Data\Text\Item;

class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test with an empty dataset
     */
    public function testJsonForAnEmptyData()
    {
        $widget = new Text();
        $json   = json_encode($widget->getData());
        $this->assertEquals('{"item":[]}', $json);
    }

    /**
     * Test with an incomplete dataset
     */
    public function testJsonForSomeData()
    {
        $widget    = new Text();
        $firstItem = new Item();
        $firstItem->setText('first text');
        $widget->addItem($firstItem);
        $json = json_encode($widget->getData());
        $this->assertEquals('{"item":[{"text":"first text","type":0}]}', $json);
    }

    /**
     * Test with one full dataset
     */
    public function testJsonForFullData()
    {
        $widget    = new Text();
        $firstItem = new Item();
        $firstItem->setText('first text');
        $firstItem->setType(Item::TYPE_INFO);
        $widget->addItem($firstItem);
        $json = json_encode($widget->getData());
        $this->assertEquals('{"item":[{"text":"first text","type":2}]}', $json);
    }

    /**
     * Test with more than one dataset
     */
    public function testJsonForMultipleItems()
    {
        $widget     = new Text();
        $firstItem  = new Item();
        $secondItem = new Item();
        $firstItem->setText('first text');
        $secondItem->setType(Item::TYPE_ALERT);
        $widget->addItem($firstItem);
        $widget->addItem($secondItem);
        $json = json_encode($widget->getData());
        $this->assertEquals('{"item":[{"text":"first text","type":0},{"text":"","type":1}]}', $json);
    }
}
