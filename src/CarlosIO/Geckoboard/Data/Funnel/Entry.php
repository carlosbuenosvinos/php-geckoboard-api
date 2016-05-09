<?php

namespace CarlosIO\Geckoboard\Data\Funnel;

/**
 * Class Entry.
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
    protected $label;

    public function __construct()
    {
        $this->value = null;
        $this->label = null;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param  $label
     *
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

        return $result;
    }
}
