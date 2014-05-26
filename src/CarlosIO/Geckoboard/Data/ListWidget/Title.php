<?php
/**
 * Created by PhpStorm.
 * User: visti
 * Date: 24/5/14
 * Time: 6:06 PM
 */

namespace CarlosIO\Geckoboard\Data\ListWidget;


class Title {

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
     */
    public function setHighlight($highlight)
    {
        $this->highlight = $highlight;
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
     */
    public function setText($text)
    {
        $this->text = $text;
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