<?php
/**
 * Created by PhpStorm.
 * User: Mischa <mischa@webaction.com.au>
 * Date: 24/10/2016
 * Time: 9:49 AM
 */

namespace CarlosIO\Geckoboard\Data\LineChartV2;

/**
 * Class Series
 *
 * @package CarlosIO\Geckoboard\Data\LineChartV2
 */
class Series
{

    /**
     * @var string
     */
    protected $label;

    /**
     * @var
     */
    protected $value;

    /**
     * @var array
     */
    public $data;

    /**
     * @var string
     */
    public $name;

    /**
     * @var
     */
    public $incompleteFrom = null;

    /**
     * @var
     * Can be either "main", or "secondary"
     *  defaults to "main" if not specified.
     */
    protected $type = "main";
    private $yRequired = false;
    private $size = 0;

    public function setName($name) {
        $this->name = $name;
    }

    public function setIncompleteFrom($incompleteFrom) {
        $this->incompleteFrom = $incompleteFrom;
    }

    public function addData($x, $y = null) {
        if ($y !== null) {
            $this->yRequired = true;
            $data = array($x, (float) $y);
        } else if ($this->yRequired === true) {
            throw new Exception("Y Data is required for this series of data as it has been used before");
        } else {
            $data = $x;
        }
        $this->data[] = $data;
        $this->size++;
        return $this;
    }

    public function length() {
        return $this->size;
    }

    public function getData() {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }
    /**
     * @param $label
     * @return $this
     */
    public function setLabel($label) {
        $this->label = $label;

        return $this;
    }

    /**
     * @return float
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int
     */
    public function getPreviousRank() {
        return $this->previousRank;
    }

    /**
     * @param $previousRank
     * @return $this
     */
    public function setPreviousRank($previousRank) {
        $this->previousRank = $previousRank;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray() {
        $result = array();
        $result['name'] = $this->getName();
        $result['data'] = $this->getData();
        if($this->incompleteFrom !== null) {
            $result['incomplete_from'] = $this->incompleteFrom;
        }

        return $result;
    }

}