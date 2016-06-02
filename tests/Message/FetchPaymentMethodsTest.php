<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;

class FetchPaymentMethodsTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchPaymentMethodsRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setUserId('0ff7ba61-1560-4d10-a1de-1b0edf29852f');
    }

    public function testFetchPaymentMethodsSuccess()
    {
        $this->setMockHttpResponse('FetchPaymentMethodsSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getErrorCode());
        $this->assertNull($response->getErrorMessage());
        $this->assertContains(
            "9da88f3a-3073-4f3f-bfd4-ae6e404b51dc",
            json_encode($response->getPaymentMethodList())
        );
    }

    public function testFetchPaymentMethodsFailure()
    {
        $this->setMockHttpResponse('FetchPaymentMethodsFailure.txt');
        $this->request->setUserId('notAValidUserId');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('User not found', $response->getErrorMessage());
        $this->assertEquals(201, $response->getErrorCode());
        $this->assertNull($response->getPaymentMethodList());
    }
}
