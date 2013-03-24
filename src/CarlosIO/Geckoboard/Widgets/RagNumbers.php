<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;
use CarlosIO\Geckoboard\Data\Entry;

class RagNumbers extends Widget
{
    protected $dataset;

    public function __construct()
    {
        $this->dataset = array();
    }

    public function getRedData()
    {
        return $this->getEntry('red');
    }

    public function setRedData(Entry $entry)
    {
        $this->setEntry('red', $entry);

        return $this;
    }

    public function getAmberData()
    {
        return $this->getEntry('amber');
    }

    public function setAmberData(Entry $entry)
    {
        $this->setEntry('amber', $entry);

        return $this;
    }

    public function getGreenData()
    {
        return $this->getEntry('green');
    }

    public function setGreenData(Entry $entry)
    {
        $this->setEntry('green', $entry);

        return $this;
    }

    public function getData()
    {
        return array(
            'item' => array(
                $this->getRedData()->toArray(),
                $this->getAmberData()->toArray(),
                $this->getGreenData()->toArray()
            )
        );
    }

    protected function setEntry($color, $entry)
    {
        $this->dataset[$color] = $entry;
    }

    protected function getEntry($color)
    {
        if (!isset($this->dataset[$color])) {
            throw new \Exception('Color entry does not exist');
        }

        return $this->dataset[$color];
    }
}