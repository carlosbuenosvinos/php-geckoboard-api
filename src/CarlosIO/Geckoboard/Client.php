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
     * @desc    Proxy FQDN
     * @var     string
     */
    protected $sProxyHost = null;

    /**
     * @desc    Proxy Port
     * @var     integer
     */
    protected $iProxyPort = null;

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
    	$aOptions = array();
    	if (true === $this->isProxyfied()) {

    		$aOptions['proxy'] = 'tcp://'.$this->getProxyHost().':'.$this->getProxyPort();
    	}

        $this->client->post(
            '/v1/send/'.$widget->getId(),
            null,
            json_encode(
                array(
                    'api_key' => $this->getApiKey(),
                    'data' => $widget->getData()
                )
            ),
        	$aOptions)->send();
    }

    /**
     * @desc    return true if the call to gecko should be proxyfied or false if not.
     * @return  boolean
     */
    public function isProxyfied()
    {
    	$iPort = $this->getProxyPort();
    	$sHost = $this->getProxyHost();
    	return (false === empty($iPort) && false === is_null($sHost) && $iPort > 0);
    }

    /**
     * @desc    setter for proxy hostname
     * @param    string $sProxyHost
     * @return $this
     */
    public function setProxyHost($sProxyHost)
    {
    	if (true === is_string($sProxyHost) && false === empty($sProxyHost)) {
    		$this->sProxyHost = $sProxyHost;
    	}

    	return $this;
    }

    /**
     * @desc    getter for proxy hostname
     * @return    string
     */
    public function getProxyHost()
    {
    	return $this->sProxyHost;
    }

    /**
     * @desc    setter for proxy port
     * @param    integer $iProxyPort
     */
    public function setProxyPort($iProxyPort)
    {
    	if (true === is_integer($iProxyPort) && $iProxyPort >= 0) {
    		$this->iProxyPort = intval($iProxyPort);
    	}

    	return $this;
    }

    /**
     * @desc    getter for proxy port
     * @return    integer
     */
    public function getProxyPort()
    {
    	return $this->iProxyPort;
    }
}
