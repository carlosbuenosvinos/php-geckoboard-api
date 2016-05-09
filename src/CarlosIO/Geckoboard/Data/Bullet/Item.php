<?php

namespace CarlosIO\Geckoboard\Data\Bullet;

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
     * @var string
     */
    protected $sublabel;

    /**
     * @var array
     */
    protected $axisPoint;

    /**
     * @var string
     */
    protected $range;

    /**
     * @var string
     */
    protected $measure;

    /**
     * @var string
     */
    protected $comparative;

    public function __construct()
    {
        $this->axisPoint = array();
        $this->label = null;
        $this->sublabel = null;
    }

    /**
     * @param $comparative
     *
     * @return $this
     */
    public function setComparative($comparative)
    {
        $this->comparative = $comparative;

        return $this;
    }

    /**
     * @return string
     */
    public function getComparative()
    {
        return $this->comparative;
    }

    /**
     * @param $axisPoint
     *
     * @return $this
     */
    public function setAxisPoint($axisPoint)
    {
        $this->axisPoint = $axisPoint;

        return $this;
    }

    /**
     * @return array
     */
    public function getAxisPoint()
    {
        return $this->axisPoint;
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
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param $measure
     *
     * @return $this
     */
    public function setMeasure($measure)
    {
        $this->measure = $measure;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMeasure()
    {
        return $this->measure;
    }

    /**
     * @param $range
     *
     * @return $this
     */
    public function setRange($range)
    {
        $this->range = $range;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * @param $sublabel
     *
     * @return $this
     */
    public function setSublabel($sublabel)
    {
        $this->sublabel = $sublabel;

        return $this;
    }

    /**
     */
    public function getSublabel()
    {
        return $this->sublabel;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = array();
        $label = $this->getLabel();
        if (null !== $label) {
            $result['label'] = $label;
        }

        $sublabel = $this->getSublabel();
        if (null !== $sublabel) {
            $result['sublabel'] = $sublabel;
        }

        $result['axis']['point'] = $this->getAxisPoint();
        $result['range'] = $this->getRange();
        $result['measure'] = $this->getMeasure();
        $result['comparative']['point'] = $this->getComparative();

        return $result;
    }
}
