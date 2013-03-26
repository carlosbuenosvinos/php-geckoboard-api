<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;

class Bullet extends Widget
{
    protected $item;
    protected $orientation = 'horizontal';

    public function __construct()
    {
        $this->dataset = array();
    }

    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function getOrientation()
    {
        return $this->orientation;
    }

    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function getData()
    {
        return array(
            'orientation' => $this->getOrientation(),
            'item' => $this->getItem()->toArray()
        );
    }
}