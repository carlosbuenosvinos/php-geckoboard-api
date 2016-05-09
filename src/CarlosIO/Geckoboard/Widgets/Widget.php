<?php

namespace CarlosIO\Geckoboard\Widgets;

/**
 * Class Widget.
 */
abstract class Widget
{
    /**
     * @var string Widget id
     */
    protected $id;

    /**
     * Set widget id.
     *
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get widget id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get data in array format.
     *
     * @return array
     */
    abstract public function getData();
}
