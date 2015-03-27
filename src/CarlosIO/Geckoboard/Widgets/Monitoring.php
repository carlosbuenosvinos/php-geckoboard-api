<?php

namespace CarlosIO\Geckoboard\Widgets;

/**
 * Class Monitoring
 * @package CarlosIO\Geckoboard\Widgets
 */
class Monitoring extends Widget
{
    const STATUS_UP     = 'Up';
    const STATUS_DOWN   = 'Down';

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $downTime;

    /**
     * @var string
     */
    protected $responseTime;

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        if ($status !== self::STATUS_UP && $status !== self::STATUS_DOWN) {
            $message = "Value '%s' must be " . self::STATUS_UP . " or " . self::STATUS_DOWN;
            throw new \InvalidArgumentException(sprintf($message, $status));
        }

        $this->status = $status;

        return $this;
    }

    /**
     * @param $downtime
     * @return $this
     */
    public function setDownTime($downtime)
    {
        $this->downTime = $downtime;

        return $this;
    }

    /**
     * @param $responseTime
     * @return $this
     */
    public function setResponseTime($responseTime)
    {
        $this->responseTime = $responseTime;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getDownTime()
    {
        return $this->downTime;
    }

    /**
     * @return string
     */
    public function getResponseTime()
    {
        return $this->responseTime;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array(
            'status'  => $this->getStatus(),
            'downTime'  => $this->getDownTime(),
            'responseTime' => $this->getResponseTime()
        );
    }
}