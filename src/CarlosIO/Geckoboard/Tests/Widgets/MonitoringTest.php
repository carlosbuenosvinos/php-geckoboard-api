<?php

namespace CarlosIO\Geckoboard\Tests\Widgets;

use CarlosIO\Geckoboard\Widgets\Monitoring;

/**
 * Class MonitoringTest
 * @package CarlosIO\Geckoboard\Tests\Widgets
 */
class MonitoringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \CarlosIO\Geckoboard\Widgets\Monitoring
     */
    private $myMonitoringWidget;

    protected function setUp()
    {
        $this->myMonitoringWidget = new Monitoring();
    }

    public function testJsonForFullData()
    {
        $this->myMonitoringWidget
            ->setStatus('Up')
            ->setDownTime('9 days ago')
            ->setResponseTime('593 ms');

        $json = json_encode($this->myMonitoringWidget->getData());
        $this->assertEquals('{"status":"Up","downTime":"9 days ago","responseTime":"593 ms"}', $json);
    }

    public function testWhenStatusIsWrongShouldReturnAnException()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->myMonitoringWidget
            ->setStatus('^^-^^');
    }

    protected function tearDown()
    {
        unset($this->myMonitoringWidget);
    }
}