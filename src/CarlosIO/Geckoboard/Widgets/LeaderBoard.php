<?php

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Data\LeaderBoard\Item;

/**
 * Class LeaderBoard.
 */
class LeaderBoard extends Widget
{
    const SORT_ASC = 1;
    const SORT_DESC = -1;

    /**
     * @var array
     */
    protected $items = array();

    /**
     * @param null $order
     *
     * @return Item[]
     */
    public function getItems($order = null)
    {
        if (null === $order) {
            return $this->items;
        }

        return $this->sort($this->items, $order);
    }

    /**
     * @param $item
     *
     * @return $this
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Get data in array format.
     *
     * @param int $order
     *
     * @return array
     */
    public function getData($order = self::SORT_DESC)
    {
        return array(
            'items' => array_map(
                function ($item) {
                    /*
                     * @var Item $item
                     */
                    return $item->toArray();
                },
                array_values($this->getItems($order))
            ),
        );
    }

    /**
     * @param $items
     * @param $order
     *
     * @return array
     */
    private function sort($items, $order)
    {
        uasort($items, function (Item $item1, Item $item2) use ($order) {
            return ($item1->getValue() < $item2->getValue()) ? (-1 * $order) : $order;
        });

        return $items;
    }
}
