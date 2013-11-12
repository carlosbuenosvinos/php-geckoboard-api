<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;
use CarlosIO\Geckoboard\Data\Entry;

class GeckoMeter extends Widget
{
    protected $dataset;
    protected $value;
    protected $reversed = false;

    public function setReversed($reversed)
    {
        $this->reversed = $reversed;

        return $this;
    }

    public function getReversed()
    {
        return $this->reversed;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __construct()
    {
        $this->dataset = array();
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
    }

    protected function getEntry($level)
    {
        if (!isset($this->dataset[$level])) {
            throw new \Exception('Type entry does not exist');
        }

        return $this->dataset[$level];
    }
}
