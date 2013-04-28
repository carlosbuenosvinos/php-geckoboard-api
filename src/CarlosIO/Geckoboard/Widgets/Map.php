<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;
use CarlosIO\Geckoboard\Data\Point;

/**
 * Class Map
 * @package CarlosIO\Geckoboard\Widgets
 */
class Map extends Widget
{
    /**
     * @var array
     */
    protected $dataset;

    /**
     *
     */
    public function __construct()
    {
        $this->dataset = array();
    }

    /**
     * @return array
     */
    public function getPoints()
    {
        return $this->dataset;
    }

    /**
     * @param Point $point
     * @return $this
     */
    public function addPoint(Point $point)
    {
        $this->dataset[] = $point;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $result = array();
        foreach($this->dataset as $point) {
            $result[] = $point->toArray();
        }

        return array('points' => array('point' => $result));
    }
}