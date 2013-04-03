<?php

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;
use CarlosIO\Geckoboard\Data\Text\Item;

/**
 * Contains Text class
 */


/**
 * Class Text
 *
 * @package CarlosIO\Geckoboard\Widgets
 */

class Text extends Widget
{

    /** @var array */
    protected $items;


    /**
     * Sets the items property
     *
     * @param array $items Set of items to add to the widget
     *
     * @return void
     */
    public function setItems($items)
    {
        $this->items = $items;

    }//end setItems()


    /**
     * Returns the items attribute
     *
     * @return array
     */
    public function getItems()
    {
        if (null === $this->items) {
            $this->items = array();
        }

        return $this->items;

    }//end getItems()


    /**
     * Adds an item to the item list
     *
     * @param \CarlosIO\Geckoboard\Data\Text\Item $item Item to be added
     *
     * @return void
     */
    public function addItem(Item $item)
    {
        $this->items[] = $item;

    }//end addItem()


    /**
     * Returns an array of data used to fill the widget
     *
     * @return array
     */
    public function getData()
    {
        return array(
                'item' => array_map(
                    function ($item) {
                        return $item->toArray();
                    },
                    $this->getItems()
                ),
               );

    }//end getData()


}//end class
