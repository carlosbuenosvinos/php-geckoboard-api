<?php
namespace CarlosIO\Geckoboard\Data;

/**
 * Class Entry
 * @package CarlosIO\Geckoboard\Data
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
    protected $text = null;
    /**
     * @var
     */
    protected $prefix = null;

    /**
     * @param $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param $text
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
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
        $text = $this->getText();
        if (null !== $text) {
            $result['text'] = $text;
        }

        $value = $this->getValue();
        if (null !== $value) {
            $result['value'] = $value;
        }

        $prefix = $this->getPrefix();
        if (null !== $prefix) {
            $result['prefix'] = $prefix;
        }

        return $result;
    }
}