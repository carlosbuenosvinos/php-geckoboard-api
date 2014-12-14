<?php

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Data\ItemList\Label;
use CarlosIO\Geckoboard\Data\ItemList\Title;

/**
 * Class ItemList
 * @package CarlosIO\Geckoboard\Widgets
 */
class ItemList extends Widget
{
    protected $items = array();

    public function addItem(Title $title, $label, $description)
    {
        $count = count($this->items);
        $this->items[$count]['title'] = $title->toArray();

        if ($label instanceof Label) {
            $this->items[$count]['label'] = $label->toArray();
        }

        $this->items[$count]['description'] = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->items;
    }
}
