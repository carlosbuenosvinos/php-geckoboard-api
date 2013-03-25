<?php
namespace CarlosIO\Geckoboard\Data;

/**
 * Class Point
 * @package CarlosIO\Geckoboard\Data
 */
class Point
{
    protected $cityName = null;
    protected $countryCode = null;
    protected $size = null;
    protected $color = null;
    protected $cssClass = null;
    protected $latitude = null;
    protected $longitude = null;

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
        return $this;
    }

    public function getCityName()
    {
        return $this->cityName;
    }

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function setCssClass($cssClass)
    {
        $this->cssClass = $cssClass;
        return $this;
    }

    public function getCssClass()
    {
        return $this->cssClass;
    }

    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    public function getSize()
    {
        return $this->size;
    }

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