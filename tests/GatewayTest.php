<?php

namespace Omnipay\RentMoola;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();
        
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setTestMode(true);
        $this->options = array(
            'amount' => '10.00'
        );
    }

    public function testGetNameNotEmpty()
    {
        $name = $this->gateway->getName();
        $this->assertNotEmpty($name, 'RentMoola');
    }
    
    public function testPurchase()
    {
        $request = $this->gateway->purchase($this->options);
        $response = $request->send();
        
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertContains('https://test.example.com?', $response->getRedirectUrl());

//        echo "\n";
//        echo $response->getRedirectUrl();
//        echo "\n";
//        echo "\n";
        
        $this->assertEquals($request->getAmount(), '10.00');
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testPurchaseInvalidAmount()
    {
        $this->options['amount'] = '';
        
        $request = $this->gateway->purchase($this->options);
        $this->assertEmpty($request->getAmount());
    }
}