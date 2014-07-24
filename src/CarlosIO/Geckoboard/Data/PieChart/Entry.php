<?php
namespace CarlosIO\Geckoboard\Data\PieChart;

/**
 * Class Entry
 * @package CarlosIO\Geckoboard\Data\PieChart
 */
class Entry
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $color = null;

    /**
     * @var string
     */
    protected $label;

    public function __construct()
    {
        $this->value = null;
        $this->label = null;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param  $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = array();

        $value = $this->getValue();
        if (null !== $value) {
            $result['value'] = (string) $value;
        }

        $label = $this->getLabel();
        if (null !== $label) {
            $result['label'] = $label;
        }

        $color = $this->getColor();
        if (null !== $color) {
            $result['color'] = $color;
        }

        return $result;
    }
}
