<?php

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Data\ItemList\Label;
use CarlosIO\Geckoboard\Data\ItemList\Title;

class ItemList extends Widget
{
    protected $items;

    public function addItem(Title $title, Label $label, $description)
    {
        $count = count($this->items);
        $this->items[$count]['title'] = $title->toArray();
        $this->items[$count]['label'] = $label->toArray();
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
