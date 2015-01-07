<?php
namespace CarlosIO\Geckoboard;

use CarlosIO\Geckoboard\Exceptions\InvalidDataException;
use CarlosIO\Geckoboard\Exceptions\ClientGeckoException;
use CarlosIO\Geckoboard\Exceptions\ClientCommException;

class Client
{
	/**
	 * @desc    default value for request timeout.
	 * @var     integer
	 */
	const DEFAULT_REQUEST_TIMEOUT = 30;

	/**
	 * @desc    HTTP client for request
	 * @var        object
	 */
	private $oHTTPClient = null;
	/**
	 * @desc    the Gecko API Key
	 * @var     string
	 */
	protected $sAPIKey = null;

	/**
	 * @desc    the url to push on.
	 * @var     string
	 */
	protected $sUrl = null;

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
	 * @desc    the TimeOut value for gecko request.
	 * @var     integer
	 */
	protected $iRequestTimeOut = null;

	/**
	 * @desc    constructor for GeckoAPI object
	 * @param   string $sUrl
	 * @param   string $sAPIKey
	 */
	public function __construct($sUrl, $sAPIKey)
	{
		$this->setUrl($sUrl);
		$this->setApiKey($sAPIKey);
	}

	/**
	 * @desc    setter for API key
	 * @param    string $sAPIKey
	 * @throws    InvalidDataException
	 */
	public function setApiKey($sAPIKey)
	{
		if (true === is_string($sAPIKey) && false === empty($sAPIKey)) {
			$this->sAPIKey = $sAPIKey;
		} else {
			throw new InvalidDataException('Invalid data provided for API Key');
		}

		return $this;
	}

	/**
	 * @desc    getter API key
	 * @return    string
	 */
	public function getApiKey()
	{
		return $this->sAPIKey;
	}

	/**
	 * @desc    setter for Gecko SAS service url
	 * @param    string $sUrl
	 * @throws    InvalidDataException
	 */
	public function setUrl($sUrl)
	{
		if (true === is_string($sUrl) && false === empty($sUrl)) {
			$this->sUrl = $sUrl;
		} else {
			throw new InvalidDataException('Invalid data provided for Url');
		}

		return $this;
	}

	/**
	 * @desc    getter for Gecko SAS service url
	 * @return    string
	 */
	public function getUrl()
	{
		return $this->sUrl;
	}

	/**
	 * @desc    setter for request timeout
	 * @param    integer $iTimeout
	 * @throws    InvalidDataException
	 */
	public function setRequestTimeout($iTimeout)
	{
		if (true === is_integer($iTimeout) && $iTimeout >= 0) {
			$this->iRequestTimeOut = intval($iTimeout);
		} else {
			throw new InvalidDataException('Invalid data provided for Timeout');
		}

		return $this;
	}

	/**
	 * @desc    getter for request timeout
	 * @return    integer
	 */
	public function getRequestTimeout()
	{
		return $this->iRequestTimeOut;
	}

	/**
	 * @desc    setter for proxy hostname
	 * @param    string $sProxyHost
	 * @throws    InvalidDataException
	 */
	public function setProxyHost($sProxyHost)
	{
		if (true === is_string($sProxyHost) && false === empty($sProxyHost)) {
			$this->sProxyHost = $sProxyHost;
		} else {
			throw new InvalidDataException('Invalid data provided for Proxy host');
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
	 * @throws    InvalidDataException
	 */
	public function setProxyPort($iProxyPort)
	{
		if (true === is_integer($iProxyPort) && $iProxyPort >= 0) {
			$this->iProxyPort = intval($iProxyPort);
		} else {
			throw new InvalidDataException('Invalid data provided for Proxy port');
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

	/**
	 * @desc    getter for HTTP client object
	 * @return    \Guzzle\Http\ClientInterface
	 */
	public function &getHTTPClient()
	{
		return $this->oHTTPClient;
	}

	/**
	 * @desc    setter for HTTP client object
	 * @param	\Guzzle\Http\ClientInterface $oClient
	 */
	public function setHTTPClient(\Guzzle\Http\ClientInterface $oClient)
	{
		$this->oHTTPClient = $oClient;

		return $this;
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
	 * @desc    push widget data to Gecko SAS Service
	 * @param    \CarlosIO\Geckoboard\Widgets\Widget $oWidget
	 * @throws    ClientGeckoException
	 * @throws    ClientCommException
	 * @return    boolean
	 */
	protected function pushWidget(\CarlosIO\Geckoboard\Widgets\Widget $oWidget)
	{
		$sPostUrl = $this->getUrl().'/'.$oWidget->getId();

		$oJson  = new \stdClass();
		$oJson->api_key = $this->getApiKey();
		$oJson->data    = $oWidget->getData();

		$aOptions = array();
		if (true === $this->isProxyfied()) {

			$aOptions['proxy'] = 'tcp://'.$this->getProxyHost().':'.$this->getProxyPort();
		}
		if (false === is_null($this->getRequestTimeout())) {
			$aOptions['timeout']    = $this->getRequestTimeout();
		}

		try {

			$oResponse    = $this->getHTTPClient()->post($sPostUrl, array(), json_encode($oJson), $aOptions)->send();
		} catch (\Exception $oExcept) {
			throw new ClientCommException($oExcept->getMessage(), $oExcept->getCode(), $oExcept);
		}

		$oGeckoResponse    = json_decode($oResponse->getBody(true));
		if (200 === $oResponse->getStatusCode()) {
			if (true === isset($oGeckoResponse->success) && true === $oGeckoResponse->success) {
				return true;
			} elseif (true === isset($oGeckoResponse->success) && false === $oGeckoResponse->success) {
				throw new ClientGeckoException(
					'An error occurs on widget : '.
					$oWidget->getId().
					' ('.get_class($oWidget).') - message : '.$oGeckoResponse->error
				);
			} elseif (true === isset($oGeckoResponse->message)) {
				throw new ClientGeckoException(
					'An error occurs on widget : '.
					$oWidget->getId().
					' ('.get_class($oWidget).') - message : '.$oGeckoResponse->message
				);
			} else {
				throw new ClientGeckoException(
					'An error occurs on widget : '.
					$oWidget->getId().
					' ('.get_class($oWidget).') - message : '.$oResponse->getBody(true)
				);
			}
		} else {
			throw new ClientCommException('HTTP '.$oResponse->getStatusCode().' received from Gecko ('.$sPostUrl.')');
		}
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
	protected function getWidgetsArray($widget)
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
	protected function pushWidgets($widgets)
	{
		foreach ($widgets as $widget) {
			$this->pushWidget($widget);
		}
	}
}