<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;

class UpdateCCPaymentMethodRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new UpdateCCPaymentMethodRequest(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );
        $this->request->initialize(
            array(
                'userId' => '24a58d3c-4774-48bb-803a-b0ccc6b2d8d5',
                'paymentMethodId' => 'd502ad2d-e103-4e04-b2a2-fdd7c547eb06',
                'name' => 'Joe Smith',
                'number' => '4444333322221111',
                'cvc' => '212',
                'expiryMonth' => '09',
                'expiryYear' => '2018',
                'destinationAccountId' => '41fcd0ff-7c57-403a-9bd5-e850056fdc2a',
                'state' => 'WA',
                'country' => 'USA',
                'zip' => '90210',
                'city' => 'Tampa',
                'address1' => '124 West Street',
                'address2' => '126 West Street',
            )
        );
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('UpdateCCPaymentMethodSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getErrorMessage());
        $this->assertNull($response->getErrorCode());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('UpdateCCPaymentMethodFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals("may not be empty", $response->getErrorMessage());
    }
}
