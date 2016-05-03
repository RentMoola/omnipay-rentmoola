<?php

namespace Omnipay\RentMoola;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testGetNameNotEmpty()
    {
        $name = $this->gateway->getName();
        $this->assertNotEmpty($name, 'RentMoola');
    }
    
}