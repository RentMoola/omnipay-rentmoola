<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;

class RefundRequestTests extends TestCase
{
    public function setUp()
    {
        $this->request = new RefundRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setTransactionReference('abc123');
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('RefundSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getErrorCode());
        $this->assertNull($response->getErrorMessage());
        $this->assertSame('abc123', $response->getTransactionReference());
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('abc123', $data['transactionReference']);
    }
}
