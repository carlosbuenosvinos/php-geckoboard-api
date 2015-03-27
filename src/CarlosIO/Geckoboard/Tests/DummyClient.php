<?php

namespace CarlosIO\Geckoboard\Tests;

use CarlosIO\Geckoboard\Client;

class DummyClient extends Client
{
    public function __construct()
    {
        parent::__construct('http://www.foo.bar', '1234567890');
        $oHTTPClient    = new \Guzzle\Http\Client();
        $this->setHTTPClient($oHTTPClient);

        $client = \Mockery::mock('stdClass');
        $client->shouldReceive('post->send')->once();
        $this->client = $client;
    }
}
