<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;

class NumberAndSecondaryStat extends Widget
{
    private $mainValue = null;
    private $secondaryValue = null;
    private $mainPrefix = null;

    public function setMainPrefix($mainPrefix)
    {
        $this->mainPrefix = $mainPrefix;

        return $this;
    }

    public function getMainPrefix()
    {
        return $this->mainPrefix;
    }

    public function setMainValue($mainValue)
    {
        $this->mainValue = $mainValue;

        return $this;
    }

    public function getMainValue()
    {
        return $this->mainValue;
    }

    public function setSecondaryValue($secondaryValue)
    {
        $this->secondaryValue = $secondaryValue;

        return $this;
    }

    public function getSecondaryValue()
    {
        return $this->secondaryValue;
    }

    public function getJson()
    {
        $data = array(
            'item' => array(
                array(
                    'text' => '',
                    'value' => (int) $this->getMainValue(),
                    'prefix' => (string) $this->getMainPrefix()
                ),
                array(
                    'text' => '',
                    'value' => (int) $this->getSecondaryValue()
                )
            )
        );

        return json_encode($data);
    }
}