<?php

namespace CarlosIO\Geckoboard\Data\Text;

/**
 * Contains Item class
 */


/**
 * Class Item
 *
 * @package CarlosIO\Geckoboard\Data\Text
 */

class Item
{
    const TYPE_NONE  = 0;
    const TYPE_ALERT = 1;
    const TYPE_INFO  = 2;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var int
     */
    protected $type;


    /**
     * Sets the text attribute
     *
     * @param string $text Text of the item
     *
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;

    }


    /**
     * Returns text attribute
     *
     * @return string
     */
    public function getText()
    {
        if (null === $this->text) {
            $this->text = '';
        }

        return $this->text;

    }


    /**
     * Sets type attribute
     *
     * @param int $type Type of the item, can be 0, 1 or 2
     *
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;

    }


    /**
     * Returns type attribute
     *
     * @return int
     */
    public function getType()
    {
        if (null === $this->type) {
            $this->type = 0;
        }

        return $this->type;

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
        $result['type'] = $this->getType();

        return $result;

    }


}
