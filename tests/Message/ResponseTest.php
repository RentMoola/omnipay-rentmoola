<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testPurchaseSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->json());

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getErrorCode());
        $this->assertNull($response->getErrorMessage());
        $this->assertSame('COMPLETE', $response->getStatus());
        $this->assertSame("4ff053de-55d3-4930-82bf-154b0063208a", $response->getTransactionReference());
    }

    public function testPurchaseFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->json());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getStatus());
        $this->assertNull($response->getAmount());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame(616, $response->getErrorCode());
        $this->assertSame(
            'The payment method was not found.  Check the paymentMethodId provided.',
            $response->getErrorMessage()
        );
    }

    public function testRefundSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('RefundSuccess.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->json());

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getErrorCode());
        $this->assertNull($response->getErrorMessage());
        $this->assertSame('abc123', $response->getTransactionReference());
    }

    public function testFetchPaymentSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('FetchPaymentSuccess.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->json());

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getErrorCode());
        $this->assertNull($response->getErrorMessage());
        $this->assertSame('COMPLETE', $response->getStatus());
        $this->assertEquals('500.50', $response->getAmount());
        $this->assertSame('24a58d3c-4774-48bb-803a-b0ccc6b2d8d5', $response->getUserId());
        $this->assertSame('c8677f0a-4e0f-429f-9b44-30e136088a46', $response->getTransactionReference());
    }
}
