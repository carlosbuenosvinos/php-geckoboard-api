<?php
namespace CarlosIO\Geckoboard\Data;

/**
 * Class Point
 * @package CarlosIO\Geckoboard\Data
 */
class Point
{
    /**
     * @var null
     */
    protected $cityName = null;

    /**
     * @var null
     */
    protected $countryCode = null;

    /**
     * @var null
     */
    protected $size = null;

    /**
     * @var null
     */
    protected $color = null;

    /**
     * @var null
     */
    protected $cssClass = null;

    /**
     * @var null
     */
    protected $latitude = null;

    /**
     * @var null
     */
    protected $longitude = null;

    /**
     * @param $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param $longitude
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param $cityName
     * @return $this
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;

        return $this;
    }

    /**
     * @return null
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * @param $color
     * @return $this
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return null
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param $countryCode
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @return null
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param $cssClass
     * @return $this
     */
    public function setCssClass($cssClass)
    {
        $this->cssClass = $cssClass;

        return $this;
    }

    /**
     * @return null
     */
    public function getCssClass()
    {
        return $this->cssClass;
    }

    /**
     * @param $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return null
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = array();

        $cityData = array();

        $cityName = $this->getCityName();
        if (null !== $cityName) {
            $cityData['city_name'] = $cityName;
        }

        $countryCode = $this->getCountryCode();
        if (null !== $countryCode) {
            $cityData['country_code'] = $countryCode;
        }

        if ($cityData) {
            $result['city'] = $cityData;
        }

        $latitude = $this->getLatitude();
        if (null !== $latitude) {
            $result['latitude'] = $latitude;
        }

        $longitude = $this->getLongitude();
        if (null !== $longitude) {
            $result['longitude'] = $longitude;
        }

        $size = $this->getSize();
        if (null !== $size) {
            $result['size'] = $size;
        }

        $color = $this->getColor();
        if (null !== $color) {
            $result['color'] = $color;
        }

        $cssClass = $this->getCssClass();
        if (null !== $cssClass) {
            $result['cssclass'] = $cssClass;
        }

        return $result;
    }
}