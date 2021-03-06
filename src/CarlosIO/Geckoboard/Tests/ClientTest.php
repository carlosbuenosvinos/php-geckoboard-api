<?php

namespace CarlosIO\Geckoboard\Tests;

use CarlosIO\Geckoboard\Client as Geckoboard;
use Guzzle\Common\Collection;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testFullMethodsDataEntry()
    {
        $client = new Geckoboard();
        $this->assertSame('foo', $client->setApiKey('foo')->getApiKey());
        $config = new Collection(array('timeout' => 10, 'connect_timeout' => 1));
        $this->assertSame($config, $client->setGuzzleConfig($config)->getGuzzleConfig());
        $this->assertSame(10, $client->getGuzzleConfig('timeout'));
    }

    public function testClient()
    {
        $widget = \Mockery::mock('CarlosIO\Geckoboard\Widgets\Widget');
        $widget->shouldReceive('getId')->andReturn('1');
        $widget->shouldReceive('getData')->andReturn(array(1, 2, 3));

        $client = new DummyClient();
        $client->push($widget);
    }

    protected function tearDown()
    {
        \Mockery::close();
    }
}
