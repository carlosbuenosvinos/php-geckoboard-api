<?php

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Text;
use CarlosIO\Geckoboard\Data\Text\Item;

/**
 * Contains test for widget Text
 */

/**
 * Class TextTest
 *
 * @package CarlosIO\Geckoboard\Widgets
 */

class TextTest extends \PHPUnit_Framework_TestCase
{


    /**
     *
     */
    public function testJsonForAnEmptyData()
    {
        $widget = new Text();
        $json   = json_encode($widget->getData());
        $this->assertEquals('{"item":[]}', $json);

    }//end testJsonForAnEmptyData()


    /**
     *
     */
    public function testJsonForSomeData()
    {
        $widget    = new Text();
        $firstItem = new Item();
        $firstItem->setText('first text');
        $widget->addItem($firstItem);
        $json = json_encode($widget->getData());
        $this->assertEquals('{"item":[{"text":"first text","type":0}]}', $json);

    }//end testJsonForSomeData()


    /**
     *
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

    }//end testJsonForFullData()


    /**
     *
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

    }//end testJsonForMultipleItems()


}//end class
