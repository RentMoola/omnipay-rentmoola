<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;

class CreateUserRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new CreateUserRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'firstname' => 'firstname',
                'lastname' => 'lastname',
                'email' => 'email@email.com',
                'propertyId' => '12345678',
                'primaryPaymentMethodId' => '23456789',
                'suite' => '5',
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('firstname', $data['firstname']);
        $this->assertSame('lastname', $data['lastname']);
        $this->assertSame('email@email.com', $data['email']);
        $this->assertSame('12345678', $data['propertyId']);
        $this->assertSame('23456789', $data['primaryPaymentMethodId']);
        $this->assertSame('5', $data['suite']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CreateUserSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('CreateUserFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertContains("email", $response->getErrorMessage());
    }
}

