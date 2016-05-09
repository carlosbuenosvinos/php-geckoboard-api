<?php

namespace CarlosIO\Geckoboard;

use Guzzle\Http\Client as Guzzle;
use CarlosIO\Geckoboard\Widgets\Widget;

/**
 * Class Client.
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
     * Construct a new Geckoboard Client.
     */
    public function __construct()
    {
        $this->api = '';
        $this->client = new Guzzle(self::URI);
    }

    /**
     * @param array|\Guzzle\Common\Collection $config
     *
     * @return Client $this
     */
    public function setGuzzleConfig($config)
    {
        $this->client->setConfig($config);

        return $this;
    }

    /**
     * @param string|bool $key
     *
     * @return \Guzzle\Common\Collection|mixed
     */
    public function getGuzzleConfig($key = false)
    {
        return $this->client->getConfig($key);
    }

    /**
     * Set Geckoboard API key.
     *
     * @param $apiKey
     *
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->api = $apiKey;

        return $this;
    }

    /**
     * Get Geckoboard API key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->api;
    }

    /**
     * Send the widget info to Geckboard.
     *
     * @param $widget
     *
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
     *
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
    private function pushWidget(Widget $widget)
    {
        $this->client->post(
            '/v1/send/'.$widget->getId(),
            null,
            json_encode(
                array(
                    'api_key' => $this->getApiKey(),
                    'data' => $widget->getData(),
                )
            ))->send();
    }
}
