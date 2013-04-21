<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;
use CarlosIO\Geckoboard\Data\Entry;

/**
 * Class RagNumbers
 * @package CarlosIO\Geckoboard\Widgets
 */
class RagNumbers extends Widget
{
    /**
     * @var array red, amber and green dataset repository
     */
    protected $dataset;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        $this->dataset = array();
    }

    /**
     * Get red data
     *
     * @return Entry
     */
    public function getRedData()
    {
        return $this->getEntry('red');
    }

    /**
     * Set red data
     *
     * @param Entry $entry
     * @return $this
     */
    public function setRedData(Entry $entry)
    {
        $this->setEntry('red', $entry);

        return $this;
    }

    /**
     * Get amber data
     *
     * @return Entry
     */
    public function getAmberData()
    {
        return $this->getEntry('amber');
    }

    /**
     * Set amber data
     *
     * @param Entry $entry
     * @return $this
     */
    public function setAmberData(Entry $entry)
    {
        $this->setEntry('amber', $entry);

        return $this;
    }

    /**
     * Get green data
     *
     * @return Entry
     */
    public function getGreenData()
    {
        return $this->getEntry('green');
    }

    /**
     * Set green data
     *
     * @param Entry $entry
     * @return $this
     */
    public function setGreenData(Entry $entry)
    {
        $this->setEntry('green', $entry);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $result = array();

        $redData = $this->getRedData();
        if (null !== $redData) {
            $result[] = $redData->toArray();
        }

        $amberData = $this->getAmberData();
        if (null !== $amberData) {
            $result[] = $amberData->toArray();
        }

        $greenData = $this->getGreenData();
        if (null !== $greenData) {
            $result[] = $greenData->toArray();
        }

        return array(
            'item' => $result
        );
    }

    /**
     * Set specific data
     *
     * @param $color
     * @param $entry
     * @return $this
     */
    protected function setEntry($color, $entry)
    {
        $this->dataset[$color] = $entry;

        return $this;
    }

    /**
     * Get specific data
     *
     * @param $color
     * @return null|Entry
     */
    protected function getEntry($color)
    {
        if (!isset($this->dataset[$color])) {
            return null;
        }

        return $this->dataset[$color];
    }
}