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
            "userId" => "5b7246ed-b144-4517-a575-36df31bcdd47",
            "paymentMethodId" => "961a44b1-8ee5-4ca9-9184-d8deaa5bf88c",
            "destinationAccountId" => "41fcd0ff-7c57-403a-9bd5-e850056fdc2a",
            "code" => "global.payments.other",
            "amount" => 10.00,
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
        $this->assertContains('https://sandbox.rentmoola.com/api/v2/payments?', $response->getRedirectUrl());

        $this->assertSame($request->getAmount(), 10.00);
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