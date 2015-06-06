<?php

namespace CarlosIO\Geckoboard\Tests\Widgets;

use CarlosIO\Geckoboard\Data\LeaderBoard\Item;
use CarlosIO\Geckoboard\Widgets\LeaderBoard;

/**
 * Class LeaderBoardTest
 * @package CarlosIO\Geckoboard\Tests\Widgets
 */
class LeaderBoardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function getDataWithNoItems()
    {
        $widget = new LeaderBoard();

        $json = json_encode($widget->getData());
        $this->assertEquals('{"items":[]}', $json);
    }

    /**
     * @test
     */
    public function canAddSingleItem()
    {
        $widget = new LeaderBoard();
        $widget->setId(123);

        $item = new Item();
        $item->setLabel("Title text")
            ->setValue(10)
            ->setPreviousRank(2);

        $widget->addItem($item);
        $json = json_encode($widget->getData());
        $this->assertEquals('{"items":[{"label":"Title text","value":10,"previous_rank":2}]}', $json);
    }

    /**
     * @test
     */
    public function canAddThreeItemsOrderDescByDefault()
    {
        $widget = new LeaderBoard();

        $item = new Item();
        $item->setLabel("Title text");
        $item->setValue(10);

        $widget->addItem($item);

        $item = new Item();
        $item->setLabel("Title text2");
        $item->setValue(15);

        $widget->addItem($item);

        $item = new Item();
        $item->setLabel("Title text3");
        $item->setValue(7);

        $widget->addItem($item);

        $json = json_encode($widget->getData());
        $this->assertEquals('{"items":[{"label":"Title text2","value":15},{"label":"Title text","value":10},'.
            '{"label":"Title text3","value":7}]}', $json);
    }

    /**
     * @test
     */
    public function canAddThreeItemsOrderAsc()
    {
        $widget = new LeaderBoard();

        $item = new Item();
        $item->setLabel("Title text");
        $item->setValue(10);

        $widget->addItem($item);

        $item = new Item();
        $item->setLabel("Title text2");
        $item->setValue(15);

        $widget->addItem($item);

        $item = new Item();
        $item->setLabel("Title text3");
        $item->setValue(7);

        $widget->addItem($item);

        $json = json_encode($widget->getData(LeaderBoard::SORT_ASC));
        $this->assertEquals('{"items":[{"label":"Title text3","value":7},{"label":"Title text","value":10},'.
            '{"label":"Title text2","value":15}]}', $json);
    }

    /**
     * @test
     */
    public function canAddThreeItemsOrderAscDuplicatesValues()
    {
        $widget = new LeaderBoard();

        $item = new Item();
        $item->setLabel("Title text");
        $item->setValue(10);

        $widget->addItem($item);

        $item = new Item();
        $item->setLabel("Title text2");
        $item->setValue(15);

        $widget->addItem($item);

        $item = new Item();
        $item->setLabel("Title text3");
        $item->setValue(7);

        $widget->addItem($item);

        $item = new Item();
        $item->setLabel("Title text4");
        $item->setValue(15);

        $widget->addItem($item);

        $json = json_encode($widget->getData(LeaderBoard::SORT_ASC));
        $this->assertEquals('{"items":[{"label":"Title text3","value":7},{"label":"Title text","value":10},'.
            '{"label":"Title text4","value":15},{"label":"Title text2","value":15}]}', $json);
    }
}