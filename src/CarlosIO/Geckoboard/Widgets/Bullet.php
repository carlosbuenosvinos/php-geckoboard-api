<?php

namespace CarlosIO\Geckoboard\Widgets;

/**
 * Class Bullet.
 */
class Bullet extends Widget
{
    protected $item;
    protected $orientation;

    public function __construct()
    {
        $this->dataset = array();
        $this->orientation = 'horizontal';
    }

    /**
     * @param $orientation
     *
     * @return $this
     */
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * @param $item
     *
     * @return $this
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    public function getItem()
    {
        return $this->item;
    }

    /**
     * Get data in array format.
     *
     * @return array
     */
    public function getData()
    {
        return array(
            'orientation' => $this->getOrientation(),
            'item' => $this->getItem()->toArray(),
        );
    }
}
