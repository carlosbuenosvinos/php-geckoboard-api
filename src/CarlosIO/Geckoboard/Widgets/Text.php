<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;
use CarlosIO\Geckoboard\Data\Text\Item;

/**
 * Class Text
 * @package CarlosIO\Geckoboard\Widgets
 */
class Text extends Widget
{
    /**
     * @var array Messages
     */
    protected $items;

    /**
     * Set the items property
     *
     * @param array $items Set of items to add to the widget
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Return the items attribute
     *
     * @return array
     */
    public function getItems()
    {
        if (null === $this->items) {
            $this->items = array();
        }

        return $this->items;
    }

    /**
     * Add an item to the item list
     *
     * @param \CarlosIO\Geckoboard\Data\Text\Item $item Item to be added
     * @return $this
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return array(
            'item' => array_map(
                function ($item) {
                    return $item->toArray();
                },
                $this->getItems()
            )
        );
    }
}
