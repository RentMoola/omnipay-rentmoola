<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;

class DeletePaymentMethodRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new DeletePaymentMethodRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setUserId('bd8ea33d-f11c-4e6e-863f-40cee2067875');
        $this->request->setPaymentMethodId('20c0d320-6e39-4f24-b06f-552d8a6b26a2');
    }

    public function testDeletePaymentMethodSuccess()
    {
        $this->setMockHttpResponse('DeletePaymentMethodRequest.txt');
        $response = $this->request->send();
        print_r($response->getData());

        $this->assertTrue($response->isSuccessful());
    }

    public function testDeletePaymentMethodFailure()
    {
        $this->setMockHttpResponse('DeletePaymentMethodRequestFailure.txt');
        $this->request->setUserId('notAVaildUserId');
        $response = $this->request->send();
        print_r($response->getData());

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals(201, $response->getErrorCode());
    }
}
