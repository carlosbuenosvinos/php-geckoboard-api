<?php

namespace CarlosIO\Geckoboard\Data\ItemList;

class Label
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $color;

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     * @return $this
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns an array representation of this object
     *
     * @return array
     */
    public function toArray()
    {
        $result = array();
        $result['name'] = $this->getName();
        $result['color'] = $this->getColor();

        return $result;
    }
}
