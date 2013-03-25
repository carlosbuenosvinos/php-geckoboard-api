<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;
use CarlosIO\Geckoboard\Data\Point;

class Map extends Widget
{
    protected $dataset;

    public function __construct()
    {
        $this->dataset = array();
    }

    public function getPoints()
    {
        return $this->dataset;
    }

    public function addPoint(Point $point)
    {
        $this->dataset[] = $point;

        return $this;
    }

    public function getData()
    {
        $result = array();
        foreach($this->dataset as $point) {
            $result[] = $point->toArray();
        }

        return array('points' => array('point' => $result));
    }
}