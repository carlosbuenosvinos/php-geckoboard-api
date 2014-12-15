<?php

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Data\Entry;

/**
 * Class GeckoMeter
 * @package CarlosIO\Geckoboard\Widgets
 */
class GeckoMeter extends Widget
{
    protected $dataset;
    protected $value;
    protected $reversed = false;

    public function __construct()
    {
        $this->dataset = array();
    }

    public function setReversed($reversed)
    {
        $this->reversed = $reversed;

        return $this;
    }

    public function getReversed()
    {
        return $this->reversed;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getMinData()
    {
        return $this->getEntry('min');
    }

    public function setMinData(Entry $entry)
    {
        $this->setEntry('min', $entry);

        return $this;
    }

    public function getMaxData()
    {
        return $this->getEntry('max');
    }

    public function setMaxData(Entry $entry)
    {
        $this->setEntry('max', $entry);

        return $this;
    }

    public function getData()
    {
        $result = array(
            'item' => $this->getValue(),
            'max' => $this->getMaxData()->toArray(),
            'min' => $this->getMinData()->toArray()
        );

        if ($this->getReversed()) {
            $result['type'] = 'reversed';
        }

        return $result;
    }

    protected function setEntry($level, $entry)
    {
        $this->dataset[$level] = $entry;

        return $this;
    }

    protected function getEntry($level)
    {
        if (!isset($this->dataset[$level])) {
            throw new \Exception('Type entry does not exist');
        }

        return $this->dataset[$level];
    }
}
