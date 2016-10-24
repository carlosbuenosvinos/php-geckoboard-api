<?php
/**
 * Created by PhpStorm.
 * User: Mischa <mischa@webaction.com.au>
 * Date: 24/10/2016
 * Time: 9:55 AM
 */

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Data\LineChartV2\Series;

/**
 * Class LineChartV2
 *
 * @package CarlosIO\Geckoboard\Widgets
 */
class LineChartV2 extends Widget
{

    CONST DIMENSION_X = 'x';
    CONST DIMENSION_Y = 'y';
    CONST DEFAULT_COLOUR = "ff9900";

    /**
     * @var string $name Line Chart Name
     */
    protected $name;

    /**
     * @var array $data Line Chart Data
     */
    protected $data;


    /**
     * @var array
     */
    protected $series = array();

    /**
     * @var array
     */
    protected $axis;

    public function addSeries($series) {
        $this->series[] = $series;
    }


    /**
     * Set the elements to appear evenly spread along dimension
     *
     * @param string $dimension The dimension where labels will be displayed
     * @param array $labels Labels displayed in this axis
     * @return $this
     */
    public function setAxis($dimension, $axis) {
        $this->axis[$dimension] = $axis;

        return $this;
    }

    /**
     * Add a new label to an specific axis
     *
     * @param string $dimension The dimension where labels will be displayed
     * @param mix    $label     Label displayed in this axis
     */
    protected function addLabel($dimension, $label) {
        if (!in_array($dimension, array(self::DIMENSION_X, self::DIMENSION_Y))) {
            throw new \InvalidArgumentException(sprintf("Value '%s' is not a valid dimension", $dimension));
        }

        $this->axis[$dimension][] = $label;
    }

    /**
     * Return axises in a 2D array
     */
    public function getAxis() {
        if (null === $this->axis) {
            $this->axis[self::DIMENSION_X] = new Axis(self::DIMENSION_X);
            $this->axis[self::DIMENSION_Y] = new Axis(self::DIMENSION_Y);
        }

        return $this->axis;
    }

    /**
     * Get data in array format.
     *
     * @return array
     */
    public function getData() {
        $result = array();

        if (!empty($this->axis[self::DIMENSION_X])) {
            $result['x_axis'] = $this->axis[self::DIMENSION_X]->toArray();
        }

        if (!empty($this->axis[self::DIMENSION_Y])) {
            $result['y_axis'] = $this->axis[self::DIMENSION_Y]->toArray();
        }

        foreach ($this->series as $series) {
            $result['series'][] = $series;
        }
        return $result;
    }


    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
