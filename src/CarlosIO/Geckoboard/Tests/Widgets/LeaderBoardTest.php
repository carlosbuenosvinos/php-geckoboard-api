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
     * @var LeaderBoard $widget
     */
    protected $widget;

    protected function setUp()
    {
        $this->widget = new LeaderBoard();
    }
    /**
     * @test
     */
    public function getDataWithNoItems()
    {
        $json = json_encode($this->widget->getData());
        $this->assertEquals('{"items":[]}', $json);
    }

    /**
     * @test
     */
    public function canAddSingleItem()
    {
        $this->widget->setId(123);
        $this->addItem( "Title text", 10, 2);

        $json = json_encode($this->widget->getData());
        $this->assertEquals('{"items":[{"label":"Title text","value":10,"previous_rank":2}]}', $json);
    }

    /**
     * @test
     */
    public function canAddThreeItemsOrderDescByDefault()
    {
        $this->addItem("Title text", 10);
        $this->addItem("Title text2", 15);
        $this->addItem("Title text3", 7);

        $json = json_encode($this->widget->getData());
        $this->assertEquals('{"items":[{"label":"Title text2","value":15},{"label":"Title text","value":10},'.
            '{"label":"Title text3","value":7}]}', $json);
    }

    /**
     * @test
     */
    public function canAddThreeItemsOrderAsc()
    {
        $this->addItem("Title text", 10);
        $this->addItem( "Title text2", 15);
        $this->addItem("Title text3", 7);

        $json = json_encode($this->widget->getData(LeaderBoard::SORT_ASC));
        $this->assertEquals('{"items":[{"label":"Title text3","value":7},{"label":"Title text","value":10},'.
            '{"label":"Title text2","value":15}]}', $json);
    }

    /**
     * @test
     */
    public function canAddThreeItemsOrderAscDuplicatesValues()
    {
        $this->addItem("Title text", 10);
        $this->addItem("Title text2", 15);
        $this->addItem("Title text3", 7);
        $this->addItem("Title text4", 15);

        $json = json_encode($this->widget->getData(LeaderBoard::SORT_ASC));
        $this->assertEquals('{"items":[{"label":"Title text3","value":7},{"label":"Title text","value":10},'.
            '{"label":"Title text4","value":15},{"label":"Title text2","value":15}]}', $json);
    }

    /**
     * @param $label
     * @param $value
     * @param null $previousRanking
     */
    private function addItem($label, $value, $previousRanking = null)
    {
        $item = new Item();
        $item->setLabel($label)
            ->setValue($value)
            ->setPreviousRank($previousRanking);
        $this->widget->addItem($item);
    }
}