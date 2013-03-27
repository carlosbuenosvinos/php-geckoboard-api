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
        $this->client = new Guzzle('https://push.geckoboard.com');
        $this->api = '';
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
    public function push(Widget $widget)
    {
        $data = array(
            'api_key' => $this->getApiKey(),
            'data' => $widget->getData()
        );

        $response = $this->client->post('/v1/send/' . $widget->getId(), null, json_encode($data))->send();
        // echo json_encode($data) . PHP_EOL;
        // echo $response->getBody() . PHP_EOL;
        return $this;
    }
}