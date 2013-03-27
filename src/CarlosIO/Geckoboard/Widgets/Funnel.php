<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;

class Funnel extends Widget
{
    protected $type = false;
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
        $data = array();
        foreach($this->dataset as $entry) {
            $data[] = $entry->toArray();
        }

        $result = array();

        $type = $this->getType();
        if ($type) {
            $result['type'] = 'reverse';
        }

        $show = $this->getShowPercentage();
        if (!$show) {
            $result['percentage'] = 'hide';
        }

        $result['item'] = $data;
        return $result;
    }
}