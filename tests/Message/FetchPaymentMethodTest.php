<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;

class FetchPaymentMethodTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchPaymentMethodRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setUserId('0ff7ba61-1560-4d10-a1de-1b0edf29852f');
        $this->request->setPaymentMethodId('d502ad2d-e103-4e04-b2a2-fdd7c547eb06');
    }

    public function testFetchPaymentMethodSuccess()
    {
        $this->setMockHttpResponse('FetchPaymentMethodSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getErrorCode());
        $this->assertNull($response->getErrorMessage());
        $this->assertContains('1111', $response->getNumber());
        $this->assertEquals('VI', $response->getBrand());
        $this->assertEquals('CC', $response->getPaymentMethodType());
        $this->assertEquals(9, $response->getExpiryMonth());
        $this->assertEquals(18, $response->getExpiryYear());
    }

    public function testFetchPaymentMethodFailure()
    {
        $this->setMockHttpResponse('FetchPaymentMethodFailure.txt');
        $this->request->setUserId('notAVaildUser');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('User not found', $response->getErrorMessage());
        $this->assertEquals(201, $response->getErrorCode());
        $this->assertNull($response->getNumber());
        $this->assertNull($response->getBrand());
        $this->assertNull($response->getPaymentMethodType());
        $this->assertNull($response->getExpiryMonth());
        $this->assertNull($response->getExpiryYear());
    }
}
