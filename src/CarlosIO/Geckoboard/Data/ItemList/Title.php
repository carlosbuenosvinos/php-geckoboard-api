<?php

namespace CarlosIO\Geckoboard\Data\ItemList;

class Title
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var boolean
     */
    protected $highlight;

    /**
     * @return mixed
     */
    public function getHighlight()
    {
        return $this->highlight;
    }

    /**
     * @param mixed $highlight
     * @return $this
     */
    public function setHighlight($highlight)
    {
        $this->highlight = $highlight;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Returns an array representation of this object
     *
     * @return array
     */
    public function toArray()
    {
        $result = array();
        $result['text'] = $this->getText();
        $result['highlight'] = $this->getHighlight();

        return $result;
    }
}
