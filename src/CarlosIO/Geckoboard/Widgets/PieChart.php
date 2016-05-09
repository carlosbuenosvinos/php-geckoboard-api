<?php

namespace CarlosIO\Geckoboard\Widgets;

/**
 * Class PieChart.
 */
class PieChart extends Widget
{
    protected $dataset = array();

    public function addEntry($entry)
    {
        $this->dataset[] = $entry;

        return $this;
    }

    public function getData()
    {
        $data = array();
        foreach ($this->dataset as $entry) {
            $data[] = $entry->toArray();
        }

        $result = array();

        $result['item'] = $data;

        return $result;
    }
}
