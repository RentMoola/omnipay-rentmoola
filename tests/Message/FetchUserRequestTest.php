<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;

class FetchUserRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchUserRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setUserId('0ff7ba61-1560-4d10-a1de-1b0edf29852f');
    }

    public function testFetchUserSuccess()
    {
        $this->setMockHttpResponse('FetchUserSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getErrorCode());
        $this->assertNull($response->getErrorMessage());
        $this->assertSame('Joe', $response->getFirstName());
        $this->assertSame('Smith', $response->getLastName());
        $this->assertSame('12345678', $response->getPropertyId());
        $this->assertSame('example@example.com', $response->getEmail());
        $this->assertSame('23456789', $response->getPrimaryPaymentMethodId());
        $this->assertSame('5', $response->getSuite());
    }

    public function testFetchUserFailure()
    {
        $this->request->setUserId("not a valid Id");
        $this->setMockHttpResponse('FetchUserFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals(201, $response->getErrorCode());
        $this->assertContains("User not found", $response->getErrorMessage());
        $this->assertNull($response->getFirstName());
        $this->assertNull($response->getLastName());
        $this->assertNull($response->getEmail());
        $this->assertNull($response->getId());
        $this->assertNull($response->getSuite());
        $this->assertNull($response->getPropertyId());
        $this->assertNull($response->getPrimaryPaymentMethodId());
    }
}
