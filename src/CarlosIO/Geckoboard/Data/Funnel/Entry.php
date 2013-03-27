<?php
namespace CarlosIO\Geckoboard\Data\Funnel;

/**
 * Class Entry
 * @package CarlosIO\Geckoboard\Data\Funnel
 */
class Entry
{
    /**
     * @var
     */
    protected $value = null;

    /**
     * @var
     */
    protected $label = null;

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
     * @return
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

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

        return $result;
    }
}