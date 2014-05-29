<?php

namespace CarlosIO\Geckoboard\Data\Text;

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
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
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
     * @param int $type Type of the item, can be 0, 1 or 2
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
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
