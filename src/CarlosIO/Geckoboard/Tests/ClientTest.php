<?php
namespace CarlosIO\Geckoboard\Tests;

use CarlosIO\Geckoboard\Client;
use CarlosIO\Geckoboard\Widgets\Text;

class ClientTest extends \Guzzle\Tests\GuzzleTestCase
{
    /**
     * Providers
     */
    public function invalidUrlsProvider()
    {
        return array(
            array(array()),
            array(null),
            array(new \stdClass()),
            array(1),
            array(1.1)
        );
    }

    public function invalidAPIKeyProvider()
    {
        return array(
            array(array()),
            array(null),
            array(new \stdClass()),
            array(1),
            array(1.1)
        );
    }

    public function invalidProxyHostProvider()
    {
        return array(
            array(array()),
            array(null),
            array(new \stdClass()),
            array(1),
            array(1.1)
        );
    }

    public function invalidProxyPortProvider()
    {
        return array(
            array(array()),
            array(null),
            array(new \stdClass()),
            array('12345'),
            array(1.1),
            array(-256)
        );
    }

    public function invalidTimeoutProvider()
    {
        return array(
            array(array()),
            array(null),
            array(new \stdClass()),
            array('12345'),
            array(1.1),
            array(-256)
        );
    }

    protected function getPushDataProvider($aMockedResponse)
    {
        $aProvider = array();
        foreach($aMockedResponse as $iIndex => $oResponse) {

            $oPlugin    = new \Guzzle\Plugin\Mock\MockPlugin();
            $oPlugin->addResponse($oResponse);

            $aProvider[$iIndex] = array(new \Guzzle\Http\Client());
            $aProvider[$iIndex][0]->addSubscriber($oPlugin);
        }

        return $aProvider;
    }

    public function pushDataProviderCommsDownGuzzle()
    {
        $aMockedResponse = array(
            new \Guzzle\Http\Message\Response(204),
            new \Guzzle\Http\Message\Response(400),
            new \Guzzle\Http\Message\Response(401),
            new \Guzzle\Http\Message\Response(403),
            new \Guzzle\Http\Message\Response(404),
            new \Guzzle\Http\Message\Response(414),
            new \Guzzle\Http\Message\Response(429),
            new \Guzzle\Http\Message\Response(499),
            new \Guzzle\Http\Message\Response(500),
            new \Guzzle\Http\Message\Response(502),
            new \Guzzle\Http\Message\Response(503),
            new \Guzzle\Http\Message\Response(520)
        );

        return $this->getPushDataProvider($aMockedResponse);
    }

    public function pushDataProviderGeckoErrorGuzzle()
    {
        $aMockedResponse = array(
            new \Guzzle\Http\Message\Response(200, array(), '{"success" : false, "error": "Rate limit was exceeded."}'),
            new \Guzzle\Http\Message\Response(200, array(), '{"message" : "Informative error message"}'),
            new \Guzzle\Http\Message\Response(200, array(), 'blablahbla'),
            new \Guzzle\Http\Message\Response(200)
        );

        return $this->getPushDataProvider($aMockedResponse);
    }

    public function pushDataProviderSuccessGuzzle()
    {
        $aMockedResponse = array(
            new \Guzzle\Http\Message\Response(200, array(), '{"success" : true}')
        );

        return $this->getPushDataProvider($aMockedResponse);
    }

    public function validHttpClientProvider()
    {
    	return array(
            array(new \Guzzle\Http\Client()),
        );
    }

    public function invalidHttpClientProvider()
    {
    	return array(
            array(array()),
            array(null),
            array(new \stdClass()),
            array('12345'),
            array(1.1),
            array(-256)
        );
    }

    /**
     * Tests
     */
    public function testConstructor()
    {
        $oClient = new Client('https://test.foobar.net', '00000000000000');
        $this->assertInstanceOf('\CarlosIO\Geckoboard\Client', $oClient);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testConstructorEmptyCall()
    {
        new Client();
    }

    /**
     * @expectedException        \CarlosIO\Geckoboard\Exceptions\InvalidDataException
     * @expectedExceptionMessage Invalid data provided for Url
     * @dataProvider        invalidUrlsProvider
     */
    public function testConstructorInvalidUrlType($mUrl)
    {
        new Client($mUrl, '00000000000000');
    }

    /**
     * @dataProvider        validHttpClientProvider
     */
    public function testHttpClient($oHttpClient)
    {
    	$oClient = new Client('https://test.foobar.net', '00000000000000');
    	$oClient->setHTTPClient($oHttpClient);
    	$this->assertEquals($oHttpClient, $oClient->getHTTPClient());
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider        invalidHttpClientProvider
     */
    public function testInvalidHttpClient($oHttpClient)
    {
    	$oClient = new Client('https://test.foobar.net', '00000000000000');
    	$oClient->setHTTPClient($oHttpClient);
    }

    /**
     * @expectedException        \CarlosIO\Geckoboard\Exceptions\InvalidDataException
     * @expectedExceptionMessage Invalid data provided for API Key
     * @dataProvider        invalidAPIKeyProvider
     */
    public function testConstructorInvalidAPIKeyType($mAPIKey)
    {
        new Client('https://test.foobar.net', $mAPIKey);
    }

    public function testAPIKey()
    {
        $oClient = new Client('https://test.foobar.net', '00000000000000');
        $this->assertEquals('00000000000000', $oClient->getApiKey());
        $oClient->setAPIKey('1234567890');
        $this->assertEquals('1234567890', $oClient->getApiKey());
    }

    /**
     * @expectedException        \CarlosIO\Geckoboard\Exceptions\InvalidDataException
     * @expectedExceptionMessage Invalid data provided for API Key
     * @dataProvider        invalidAPIKeyProvider
     */
    public function testInvalidAPIKey($mAPIKey)
    {
        $oClient = new Client('https://test.foobar.net', '00000000000000');
        $oClient->setAPIKey($mAPIKey);
    }

    public function testUrl()
    {
        $oClient = new Client('https://test.foobar.net', '00000000000000');
        $this->assertEquals('https://test.foobar.net', $oClient->getUrl());
        $oClient->setUrl('https://test2.foobar.net');
        $this->assertEquals('https://test2.foobar.net', $oClient->getUrl());
    }

    /**
     * @expectedException        \CarlosIO\Geckoboard\Exceptions\InvalidDataException
     * @expectedExceptionMessage Invalid data provided for Url
     * @dataProvider        invalidUrlsProvider
     */
    public function testInvalidUrl($mUrl)
    {
        $oClient = new Client('https://test.foobar.net', '00000000000000');
        $oClient->setUrl($mUrl);
    }

    public function testProxyHost()
    {
        $oClient = new Client('https://test.foobar.net', '00000000000000');
        $this->assertNull($oClient->getProxyHost());
        $oClient->setProxyHost('prox.foobar.net');
        $this->assertEquals('prox.foobar.net', $oClient->getProxyHost());
    }

    /**
     * @expectedException        \CarlosIO\Geckoboard\Exceptions\InvalidDataException
     * @expectedExceptionMessage Invalid data provided for Proxy host
     * @dataProvider        invalidProxyHostProvider
     */
    public function testInvalidProxyHost($mHost)
    {
        $oClient = new Client('https://test.foobar.net', '00000000000000');
        $oClient->setProxyHost($mHost);
    }

    public function testProxyPort()
    {
        $oClient = new Client('https://test.foobar.net', '00000000000000');
        $this->assertNull($oClient->getProxyPort());
        $oClient->setProxyPort(3525);
        $this->assertEquals(3525, $oClient->getProxyPort());
    }

    /**
     * @expectedException        \CarlosIO\Geckoboard\Exceptions\InvalidDataException
     * @expectedExceptionMessage Invalid data provided for Proxy port
     * @dataProvider        invalidProxyPortProvider
     */
    public function testInvalidProxyPort($mPort)
    {
        $oClient = new Client('https://test.foobar.net', '00000000000000');
        $oClient->setProxyPort($mPort);
    }

    public function testIsProxyfied()
    {
        $oClient = new Client('https://test.foobar.net', '00000000000000');
        $this->assertNull($oClient->getProxyPort());
        $this->assertNull($oClient->getProxyHost());
        $this->assertFalse($oClient->isProxyfied());

        $oClient->setProxyHost('prox.foobar.net');
        $this->assertEquals('prox.foobar.net', $oClient->getProxyHost());
        $this->assertFalse($oClient->isProxyfied());

        $oClient->setProxyPort(3525);
        $this->assertEquals(3525, $oClient->getProxyPort());
        $this->assertTrue($oClient->isProxyfied());
    }

    public function testRequestTimeout()
    {
        $oClient = new Client('test.foobar.net', '00000000000000');
        $this->assertNull($oClient->getRequestTimeout());
        $oClient->setRequestTimeout(30);
        $this->assertEquals(30, $oClient->getRequestTimeout());
    }

    /**
     * @expectedException        \CarlosIO\Geckoboard\Exceptions\InvalidDataException
     * @expectedExceptionMessage Invalid data provided for Timeout
     * @dataProvider        invalidTimeoutProvider
     */
    public function testInvalidRequestTimeout($mTimeout)
    {
        $oClient = new Client('https://test.foobar.net', '00000000000000');
        $oClient->setRequestTimeout($mTimeout);
    }

    /**
     * @dataProvider        pushDataProviderSuccessGuzzle
     */
    public function testPushDataSuccess($oHttpClient)
    {
        $oClient    = new Client('https://test.foobar.net', '00000000000000');
        $oClient->setHTTPClient($oHttpClient);
        $oClient->setProxyHost('prox.foobar.net');
        $oClient->setProxyPort(3535);
        $oClient->setRequestTimeout(5);

        $oText        = new Text('000000000');

        $oClient->push($oText);
    }

    /**
     * @expectedException    \CarlosIO\Geckoboard\Exceptions\ClientCommException
     * @dataProvider        pushDataProviderCommsDownGuzzle
     */
    public function testPushDataCommsDown($oHttpClient)
    {
        $oClient    = new Client('https://test.foobar.net', '00000000000000');
        $oClient->setHTTPClient($oHttpClient);
        $oClient->setProxyHost('prox.foobar.net');
        $oClient->setProxyPort(3535);
        $oClient->setRequestTimeout(5);
        $oText        = new Text('000000000');
        $oClient->push($oText);
    }

    /**
     * @expectedException    \CarlosIO\Geckoboard\Exceptions\ClientGeckoException
     * @dataProvider        pushDataProviderGeckoErrorGuzzle
     */
    public function testPushDataGeckoError($oHttpClient)
    {
        $oClient    = new Client('https://test.foobar.net', '00000000000000');
        $oClient->setHTTPClient($oHttpClient);
        $oClient->setProxyHost('prox.foobar.net');
        $oClient->setProxyPort(3535);
        $oClient->setRequestTimeout(5);
        $oWidget        = new Text();
        $oClient->push($oWidget);
    }
}
