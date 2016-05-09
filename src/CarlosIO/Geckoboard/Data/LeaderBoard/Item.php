<?php

namespace CarlosIO\Geckoboard\Data\LeaderBoard;

/**
 * Class Item.
 */
class Item
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var
     */
    protected $value;

    /**
     * @var int
     */
    protected $previousRank;

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int
     */
    public function getPreviousRank()
    {
        return $this->previousRank;
    }

    /**
     * @param $previousRank
     *
     * @return $this
     */
    public function setPreviousRank($previousRank)
    {
        $this->previousRank = $previousRank;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = array();
        $result['label'] = $this->getLabel();
        $result['value'] = $this->getValue();

        $previousRank = $this->getPreviousRank();
        if (null !== $previousRank) {
            $result['previous_rank'] = $previousRank;
        }

        return $result;
    }
}
