<?php

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Data\LeaderBoard\Item;

/**
 * Class LeaderBoard
 * @package CarlosIO\Geckoboard\Widgets
 */
class LeaderBoard extends Widget {

    const SORT_ASC = 1;
    const SORT_DESC = -1;

    /**
     * @var array
     */
    protected $items = array();

    /**
     * @param null $order
     * @return Item[]
     */
    public function getItems($order = null)
    {
        if (null !== $order) {
            $this->sort($order);
        }

        return $this->items;
    }

    /**
     * @param $item
     * @return $this
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Get data in array format
     *
     * @param int $order
     * @return array
     */
    public function getData($order = self::SORT_DESC)
    {
        return array(
            'items' => array_map(
                function ($item) {
                    /**
                     * @var Item $item
                     */
                    return $item->toArray();
                },
                array_values($this->getItems($order))
            )
        );
    }

    /**
     * @param $order
     */
    private function sort($order)
    {
        uasort($this->items, function (Item $item1, Item $item2) use ($order) {
            if ($item1->getValue() == $item2->getValue()) {
                return 0;
            }

            return ($item1->getValue() < $item2->getValue()) ? (-1 * $order) : $order;
        });
    }
}