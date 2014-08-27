<?php

namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;

/**
 * Class NumberAndSecondaryStat
 * @package CarlosIO\Geckoboard\Widgets
 */
class NumberAndSecondaryStat extends Widget
{
    const TYPE_REGULAR = null;
    const TYPE_REVERSE = 'reverse';

    /**
     * @var null Main value
     */
    private $mainValue = null;
    /**
     * @var null Secondary value
     */
    private $secondaryValue = null;
    /**
     * @var null Main value prefix
     */
    private $mainPrefix = null;
    /**
     * @var null Main value prefix
     */
    private $type = null;

    /**
     * @var string
     */
    private $mainText = '';

    /**
     * @var string
     */
    private $secondaryText = '';

    /**
     * @var boolean
     */
    private $absolute = false;

    /**
     * Set data main prefix (€, $, etc.)
     *
     * @param string $mainPrefix
     * @return $this
     */
    public function setMainPrefix($mainPrefix)
    {
        $this->mainPrefix = $mainPrefix;

        return $this;
    }

    /**
     * Get data main prefix (€, $, etc.)
     *
     * @return string
     */
    public function getMainPrefix()
    {
        return $this->mainPrefix;
    }

    /**
     * Set main value
     *
     * @param int $mainValue
     * @return $this
     */
    public function setMainValue($mainValue)
    {
        $this->mainValue = $mainValue;

        return $this;
    }

    /**
     * Get main value
     *
     * @return int
     */
    public function getMainValue()
    {
        return $this->mainValue;
    }

    /**
     * Set the primary text value. (Visible if widget is 2x2
     * or 1x1 without a secondary value)
     *
     * @param string $mainText The text body
     *
     * @return NumberAndSecondaryStat
     */
    public function setMainText($mainText)
    {
        $this->mainText = $mainText;
        return $this;
    }

    /**
     * Return the main text body.
     *
     * @return string
     */
    public function getMainText()
    {
        return $this->mainText;
    }

    /**
     * Set secondary value
     *
     * @param int $secondaryValue
     * @return $this
     */
    public function setSecondaryValue($secondaryValue)
    {
        $this->secondaryValue = $secondaryValue;

        return $this;
    }

    /**
     * Get secondary value
     *
     * @return string
     */
    public function getSecondaryValue()
    {
        return $this->secondaryValue;
    }

    /**
     * Set the secondary text value. (Visible if widget is 2x2)
     *
     * @param string $secondaryText The text body
     *
     * @return NumberAndSecondaryStat
     */
    public function setSecondaryText($secondaryText)
    {
        $this->secondaryText = $secondaryText;
        return $this;
    }

    /**
     * Return the secondary text body.
     *
     * @return string
     */
    public function getSecondaryText()
    {
        return $this->secondaryText;
    }

    /**
     * @param string|null $prefix
     */
    public function setType($prefix)
    {
        $this->type = $prefix;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Mark this widget as absolute.
     *
     * @param boolean $absolute The absolute value
     *
     * @return NumberAndSecondaryStat
     */
    public function setAbsolute($absolute)
    {
        $this->absolute = $absolute;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $data = array(
            'text' => $this->mainText,
            'value' => (float) $this->getMainValue(),
        );

        $prefix = $this->getMainPrefix();
        if (null !== $prefix) {
            $data['prefix'] = (string) $prefix;
        }

        $result = array(
            'item' => array($data),
            'type' => $this->getType(),
        );

        if ($this->absolute) {
            $result['absolute'] = $this->absolute;
        }

        $secondaryValue = $this->getSecondaryValue();
        if (null !== $secondaryValue) {
            $result['item'][] = array(
                'text' => $this->secondaryText,
                'value' => (float) $secondaryValue
            );
        }

        return $result;
    }
}
