<?php

namespace Omnipay\RentMoola;

use Omnipay\Tests\TestCase;

class RefundRequest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setTestMode(true);
        $this->gateway->setUserName('32b53506-d3b2-405a-8c83-9b5c82b67575');
        $this->gateway->setPassword('test');
    }

    public function testRefund()
    {
        $purchaseResponse = $this->gateway->purchase(
            [
                "userId" => "24a58d3c-4774-48bb-803a-b0ccc6b2d8d5",
                "paymentMethodId" => "c4ec7ad4-5b20-456a-8ab5-5ad5c2300a17",
                "destinationAccountId" => "23535718-e3a9-4b13-a28c-85f0838083b1",
                "code" => "global.payments.other",
                "amount" => '10.00',
            ]
        )->send();

        $refundResponse = $this->gateway->refund(
            [
                "transactionReference" => $purchaseResponse->getTransactionReference()
            ]
        )->send();

        $this->assertInstanceOf('Omnipay\RentMoola\Message\Response', $purchaseResponse);
        $this->assertTrue($purchaseResponse->isSuccessful());
        $this->assertFalse($purchaseResponse->isRedirect());
        $this->assertNotNull($purchaseResponse->getTransactionReference());
    }
}
