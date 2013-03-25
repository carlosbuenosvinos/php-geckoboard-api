<?php
namespace CarlosIO\Geckoboard;

use Guzzle\Http\Client as Guzzle;
use CarlosIO\Geckoboard\Widgets\Widget;

class Client
{
    protected $client;
    protected $api;

    public function __construct()
    {
        $this->client = new Guzzle('https://push.geckoboard.com');
        $this->api = '';
    }

    public function setApiKey($apiKey)
    {
        $this->api = $apiKey;

        return $this;
    }

    public function getApiKey()
    {
        return $this->api;
    }

    public function push(Widget $widget)
    {
        $data = array(
            'api_key' => $this->getApiKey(),
            'data' => $widget->getData()
        );

        $this->client->post('/v1/send/' . $widget->getId(), null, json_encode($data))->send();
    }
}