<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;

class CreateCCPaymentMethodRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new CreateCCPaymentMethodRequest(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );
        $this->request->initialize(
            array(
                'userId' => '24a58d3c-4774-48bb-803a-b0ccc6b2d8d5',
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

    public function testGetters()
    {
        $request = $this->request;

        $this->assertSame('Joe Smith', $request->getName());
        $this->assertSame('4444333322221111', $request->getNumber());
        $this->assertSame('212', $request->getCvc());
        $this->assertSame('09', $request->getExpiryMonth());
        $this->assertSame('2018', $request->getExpiryYear());
        $this->assertSame('WA', $request->getState());
        $this->assertSame('USA', $request->getCountry());
        $this->assertSame('90210', $request->getZip());
        $this->assertSame('Tampa', $request->getCity());
        $this->assertSame('124 West Street', $request->getAddress1());
        $this->assertSame('126 West Street', $request->getAddress2());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CreateCCPaymentMethodSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getErrorMessage());
        $this->assertNull($response->getErrorCode());
        $this->assertEquals('VI', $response->getBrand());
        $this->assertEquals('5eda2706-6dcf-40c3-8679-da877f69300c', $response->getCardReference());
    }

    public function testSendFailure()
    {
        $this->request->setNumber("notANumber");
        $this->setMockHttpResponse('CreateCCPaymentMethodFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertContains("valid credit card number", $response->getErrorMessage());
        $this->assertNull($response->getBrand());
        $this->assertNull($response->getCardReference());
    }
}
