<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;

class Funnel extends Widget
{
    protected $type;
    protected $showPercentage = true;
    protected $dataset = array();

    public function setShowPercentage($showPercentage)
    {
        $this->showPercentage = $showPercentage;
        return $this;
    }

    public function getShowPercentage()
    {
        return $this->showPercentage;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function addEntry($entry)
    {
        $this->dataset[] = $entry;
    }

    public function getData()
    {
        $result = array();
        foreach($this->dataset as $entry) {
            $result[] = $entry->toArray();
        }

        return array('item' => $result);
    }
}