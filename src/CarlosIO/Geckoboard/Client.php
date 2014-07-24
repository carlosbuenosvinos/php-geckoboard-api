<?php

namespace CarlosIO\Geckoboard;

use Guzzle\Http\Client as Guzzle;
use CarlosIO\Geckoboard\Widgets\Widget;

/**
 * Class Client
 * @package CarlosIO\Geckoboard
 */
class Client
{
    const URI = 'https://push.geckoboard.com';

    /**
     * @var \Guzzle\Http\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $api;

    /**
     * Construct a new Geckoboard Client
     */
    public function __construct()
    {
        $this->api = '';
        $this->client = new Guzzle(self::URI);
    }

    /**
     * Set Geckoboard API key
     *
     * @param $apiKey
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->api = $apiKey;

        return $this;
    }

    /**
     * Get Geckoboard API key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->api;
    }

    /**
     * Send the widget info to Geckboard
     *
     * @param Widget $widget
     * @return $this
     */
    public function push($widget)
    {
        $this->pushWidgets(
            $this->getWidgetsArray($widget)
        );

        return $this;
    }

    /**
     * @param $widget
     * @return array
     */
    private function getWidgetsArray($widget)
    {
        $widgets = $widget;
        if (!is_array($widget)) {
            $widgets = array($widget);
        }

        return $widgets;
    }

    /**
     * @param $widgets
     */
    private function pushWidgets($widgets)
    {
        foreach ($widgets as $widget) {
            $this->pushWidget($widget);
        }
    }

    /**
     * @param $widget
     */
    private function pushWidget($widget)
    {
        $this->client->post(
            '/v1/send/'.$widget->getId(),
            null,
            json_encode(
                array(
                    'api_key' => $this->getApiKey(),
                    'data' => $widget->getData()
                )
            ))->send();
    }
}
