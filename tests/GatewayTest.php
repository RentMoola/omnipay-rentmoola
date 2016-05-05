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
            "userId" => "24a58d3c-4774-48bb-803a-b0ccc6b2d8d5",
            "paymentMethodId" => "c4ec7ad4-5b20-456a-8ab5-5ad5c2300a17",
            "destinationAccountId" => "23535718-e3a9-4b13-a28c-85f0838083b1",
            "code" => "global.payments.other",
            "amount" => '10.00',
            "username" => '32b53506-d3b2-405a-8c83-9b5c82b67575',
            "password" => 'test',
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

        $this->assertSame($request->getAmount(), '10.00');

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertContains('status=COMPLETE', $response->getRedirectUrl());
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
