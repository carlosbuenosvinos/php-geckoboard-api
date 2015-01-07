<?php
namespace CarlosIO\Geckoboard\Tests;

use CarlosIO\Geckoboard\Factory;
use CarlosIO\Geckoboard\Client;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Providers
	 */
	public function validWidgetProvider()
	{
		return array(
			array(Factory::WIDGET_BULLET, '00001', '\CarlosIO\Geckoboard\Widgets\Bullet'),
			array(Factory::WIDGET_FUNNEL, '00002', '\CarlosIO\Geckoboard\Widgets\Funnel'),
			array(Factory::WIDGET_GECKOMETER, '00003', '\CarlosIO\Geckoboard\Widgets\GeckoMeter'),
			array(Factory::WIDGET_HIGHCHARTS, '00004', '\CarlosIO\Geckoboard\Widgets\HighchartsChart'),
			array(Factory::WIDGET_RAG, '00007', '\CarlosIO\Geckoboard\Widgets\RagColumnAndNumbers'),
			array(Factory::WIDGET_TEXT, '00008', '\CarlosIO\Geckoboard\Widgets\Text')
		);
	}
	public function invalidWidgetTypeIdProvider()
	{
		return array(
			array(array()),
			array(null),
			array(new \stdClass()),
			array(-150),
			array(1.1)
		);
	}

	/**
	 * Tests
	 */
    public function testCreateGeckoClient()
    {
        $oClient = Factory::createGeckoClient('000000000000');

        $this->assertInstanceOf('\CarlosIO\Geckoboard\Client', $oClient);
        $this->assertEquals('000000000000', $oClient->getApiKey());
        $this->assertEquals(Factory::DEFAULT_GECKO_URL, $oClient->getUrl());
        $this->assertEquals(Client::DEFAULT_REQUEST_TIMEOUT, $oClient->getRequestTimeout());

        $this->assertNull($oClient->getProxyHost());
        $this->assertNull($oClient->getProxyPort());
    }

    /**
     * @dataProvider        validWidgetProvider
     */
    public function testCreateValidWidget($iWidgetTypeId, $sWidgetId, $sExpectedClass)
    {
        $oWidget = Factory::createGeckoWidget($iWidgetTypeId, $sWidgetId);

        $this->assertInstanceOf($sExpectedClass, $oWidget);
        $this->assertEquals($sWidgetId, $oWidget->getId());
    }

    /**
     * @expectedException        \CarlosIO\Geckoboard\Exceptions\InvalidDataException
     * @expectedExceptionMessage Invalid widget type id
     * @dataProvider        invalidWidgetTypeIdProvider
     */
    public function testCreateInvalidWidgetType($mWidgetTypeId)
    {
		Factory::createGeckoWidget($mWidgetTypeId, '000000000008');
    }

    public function testCreateFunnelWidget()
    {
    	$oWidget = Factory::createFunnelWidget('000000001');
    	$this->assertInstanceOf('\CarlosIO\Geckoboard\Widgets\Funnel', $oWidget);
    	$this->assertEquals('000000001', $oWidget->getId());
    }

    public function testCreateGeekOMeterWidget()
    {
    	$oWidget = Factory::createGeckOMeterWidget('000000002');
    	$this->assertInstanceOf('\CarlosIO\Geckoboard\Widgets\GeckOMeter', $oWidget);
    	$this->assertEquals('000000002', $oWidget->getId());
    }

    public function testCreateHighChartsWidget()
    {
    	$oWidget = Factory::createHighChartsWidget('000000003');
    	$this->assertInstanceOf('\CarlosIO\Geckoboard\Widgets\HighchartsChart', $oWidget);
    	$this->assertEquals('000000003', $oWidget->getId());
    }

    public function testCreateRAGWidget()
    {
    	$oWidget = Factory::createRAGWidget('000000006');
    	$this->assertInstanceOf('\CarlosIO\Geckoboard\Widgets\RagColumnAndNumbers', $oWidget);
    	$this->assertEquals('000000006', $oWidget->getId());
    }

    public function testCreateTextWidget()
    {
    	$oWidget = Factory::createTextWidget('000000007');
    	$this->assertInstanceOf('\CarlosIO\Geckoboard\Widgets\Text', $oWidget);
    	$this->assertEquals('000000007', $oWidget->getId());
    }
}
