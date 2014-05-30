<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;

/**
 * Class LineChart 
 * @package CarlosIO\Geckoboard\Widgets
 */
class HighchartsChart extends Widget
{

    protected $type;

    protected $title;

    protected $subtitle;

    protected $series = array();

    protected $xAxisTitle;

    protected $xAxisLabels = array();

    protected $yAxisTitle;

    protected $yAxisLabels = array();

    /**
     * @return array
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param array $series
     * @return $this
     */
    public function setSeries($series)
    {
        $this->series = $series;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param mixed $subtitle
     * @return $this
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array
     */
    public function getXAxisLabels()
    {
        return $this->xAxisLabels;
    }

    /**
     * @param array $xAxisLabels
     * @return $this
     */
    public function setXAxisLabels($xAxisLabels)
    {
        $this->xAxisLabels = $xAxisLabels;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getXAxisTitle()
    {
        return $this->xAxisTitle;
    }

    /**
     * @param mixed $xAxisTitle
     * @return $this
     */
    public function setXAxisTitle($xAxisTitle)
    {
        $this->xAxisTitle = $xAxisTitle;
        return $this;
    }

    /**
     * @return array
     */
    public function getYAxisLabels()
    {
        return $this->yAxisLabels;
    }

    /**
     * @param array $yAxisLabels
     * @return $this
     */
    public function setYAxisLabels($yAxisLabels)
    {
        $this->yAxisLabels = $yAxisLabels;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYAxisTitle()
    {
        return $this->yAxisTitle;
    }

    /**
     * @param mixed $yAxisTitle
     * @return $this
     */
    public function setYAxisTitle($yAxisTitle)
    {
        $this->yAxisTitle = $yAxisTitle;
        return $this;
    }


    public function setSingleSerie($serieName, $serie)
    {
        $this->series[$serieName] = $serie;
    }

    public function addItemSerie($serieName, $item)
    {
        if (!isset($this->series[$serieName])) {
            $this->setSingleSerie($serieName, array());
        }
        $this->series[$serieName][] = $item;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {

        $returnValues = array(
            'chart' => array(
                'type' => $this->getType()
            ),
            'title' => array(
                'text' => $this->getTitle()
            ),
            'subtitle' => array(
                'text' => $this->getSubtitle()
            ),
        );

        if ($this->getXAxisLabels()) {
            $returnValues['xAxis']['categories'] = $this->getXAxisLabels();
        }
        if ($this->getYAxisLabels()) {
            $returnValues['yAxis']['categories'] = $this->getYAxisLabels();
        }

        if ($this->getXAxisTitle()) {
            $returnValues['xAxis']['title']['text'] = $this->getXAxisTitle();
        }
        if ($this->getYAxisTitle()) {
            $returnValues['yAxis']['title']['text'] = $this->getYAxisTitle();
        }

        $returnValues['plotOptions'] = array(
            'line' => array(
                'dataLabels' => array (
                    'enabled' => true
                ),
                'enableMouseTracking' => false
            )
        );

        foreach($this->getSeries() as $serieName => $serieValues) {
            $serieData = array (
                'name' => $serieName,
                'data' => $serieValues
            );

            $returnValues['series'][] = $serieData;
        }

        return array('highchart' => $returnValues);
    }
}
