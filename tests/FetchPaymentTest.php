<?php

namespace Omnipay\RentMoola;

use Omnipay\Tests\TestCase;

class FetchPaymentTest extends TestCase
{
    public function unsuccessfulSetUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setTestMode(true);
        $this->gateway->setUserName('32b53506-d3b2-405a-8c83-9b5c82b67575');
        $this->gateway->setPassword('test');
        $this->response = $this->gateway->purchase(
            [
                "userId" => "24a58d3c-4774-48bb-803a-b0ccc6b2d8d5",
                "paymentMethodId" => "c4ec7ad4-5b20-456a-8ab5-5ad5c2300a17",
                "destinationAccountId" => "23535718-e3a9-4b13-a28c-85f0838083b1",
                "code" => "not a code",
                "amount" => '10.00',
            ]
        )->send();
    }

    public function successfulSetUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setTestMode(true);
        $this->gateway->setUserName('32b53506-d3b2-405a-8c83-9b5c82b67575');
        $this->gateway->setPassword('test');
        $this->response = $this->gateway->purchase(
            [
                "userId" => "24a58d3c-4774-48bb-803a-b0ccc6b2d8d5",
                "paymentMethodId" => "c4ec7ad4-5b20-456a-8ab5-5ad5c2300a17",
                "destinationAccountId" => "23535718-e3a9-4b13-a28c-85f0838083b1",
                "code" => "global.payments.other",
                "amount" => '10.00',
            ]
        )->send();
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testFetchingWithoutTransactionId()
    {
        $this->unsuccessfulSetUp();
        $payment = $this->gateway->fetchPayment()->send();
    }

    public function testFetchingWithBadTransactionId()
    {
        $this->unsuccessfulSetUp();
        $response = $this->gateway->fetchPayment(
            [
                "transactionReference" => "garbage-value",
            ]
        )->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotNull($response->getErrorCode());
        $this->assertContains('Payment not found', $response->getErrorMessage());
    }

    public function testFetchingSuccess()
    {
        $this->successfulSetUp();
        $response = $this->gateway->fetchPayment(
            [
                "transactionReference" => $this->response->getTransactionReference()
            ]
        )->send();

        $this->assertEquals($response->getAmount(), "10.00");
        $this->assertSame($response->getUserId(), "24a58d3c-4774-48bb-803a-b0ccc6b2d8d5");
        $this->assertSame($response->getPaymentMethodId(), "c4ec7ad4-5b20-456a-8ab5-5ad5c2300a17");
        $this->assertSame($response->getDestinationAccountId(), "23535718-e3a9-4b13-a28c-85f0838083b1");

    }
}
