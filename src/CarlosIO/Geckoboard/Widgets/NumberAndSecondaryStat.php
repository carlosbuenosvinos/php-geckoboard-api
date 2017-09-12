<?php

namespace CarlosIO\Geckoboard\Widgets;

/**
 * Class NumberAndSecondaryStat.
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
     * @var bool
     */
    private $absolute = false;

    /**
     * @var boolean
     */
    private $displayAsTimeDuration = false;

    /**
     * Set data main prefix (€, $, etc.).
     *
     * @param string $mainPrefix
     *
     * @return $this
     */
    public function setMainPrefix($mainPrefix)
    {
        $this->mainPrefix = $mainPrefix;

        return $this;
    }

    /**
     * Get data main prefix (€, $, etc.).
     *
     * @return string
     */
    public function getMainPrefix()
    {
        return $this->mainPrefix;
    }

    /**
     * Set main value.
     *
     * @param int $mainValue
     *
     * @return $this
     */
    public function setMainValue($mainValue)
    {
        $this->mainValue = $mainValue;

        return $this;
    }

    /**
     * Get main value.
     *
     * @return int
     */
    public function getMainValue()
    {
        return $this->mainValue;
    }

    /**
     * Set the primary text value. (Visible if widget is 2x2
     * or 1x1 without a secondary value).
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
     * Set secondary value.
     *
     * @param int $secondaryValue
     *
     * @return $this
     */
    public function setSecondaryValue($secondaryValue)
    {
        $this->secondaryValue = $secondaryValue;

        return $this;
    }

    /**
     * Get secondary value.
     *
     * @return string
     */
    public function getSecondaryValue()
    {
        return $this->secondaryValue;
    }

    /**
     * Set the secondary text value. (Visible if widget is 2x2).
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
     *
     * @return $this
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
     * @param bool $absolute The absolute value
     *
     * @return NumberAndSecondaryStat
     */
    public function setAbsolute($absolute)
    {
        $this->absolute = $absolute;

        return $this;
    }

    /**
     * Mark this widget for display main value as time duration (from milliseconds).
     *
     * @param boolean $displayAsTimeDuration
     *
     * @return NumberAndSecondaryStat
     */
    public function setDisplayAsTimeDuration($displayAsTimeDuration)
    {
        $this->displayAsTimeDuration = $displayAsTimeDuration;

        return $this;
    }
    
    /**
     * Sets the precision for decimal values.
     *
     * @param int $precision The precision value, from 0 to 6
     *
     * @return NumberAndSecondaryStat
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;

        return $this;
    }

    /**
     * Sets the abbreviation (suffix) for values.
     *
     * @param string $abbreviation The abbreviation suffix, Possible values K, M, B, T and none
     *
     * @return NumberAndSecondaryStat
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

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

        if ($this->displayAsTimeDuration) {
            $data['type'] = 'time_duration';
        }

        $result = array(
            'item' => array($data),
            'type' => $this->getType(),
        );

        if ($this->absolute) {
            $result['absolute'] = $this->absolute;
        }
        
        if ($this->precision !== false) {
            $result['precision'] = $this->precision;
        }

        if ($this->abbreviation) {
            $result['abbreviation'] = $this->abbreviation;
        }

        $secondaryValue = $this->getSecondaryValue();
        if (is_array($secondaryValue)) {
            $result['item'][] = $secondaryValue;
        } elseif (null !== $secondaryValue) {
            $result['item'][] = array(
                'text' => $this->secondaryText,
                'value' => (float) $secondaryValue,
            );
        }

        return $result;
    }
}
