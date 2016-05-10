<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;

class FetchPaymentRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchPaymentRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setTransactionReference('c8677f0a-4e0f-429f-9b44-30e136088a46');
    }

    public function testFetchPaymentSuccess()
    {
        $this->setMockHttpResponse('FetchPaymentSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getErrorCode());
        $this->assertNull($response->getErrorMessage());
        $this->assertSame('COMPLETE', $response->getStatus());
        $this->assertSame('23535718-e3a9-4b13-a28c-85f0838083b1', $response->getDestinationAccountId());
        $this->assertEquals('500.50', $response->getAmount());
        $this->assertSame('c8677f0a-4e0f-429f-9b44-30e136088a46', $response->getTransactionReference());
    }
}
