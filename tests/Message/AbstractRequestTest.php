<?php

namespace Omnipay\RentMoola\Message;

use Mockery;
use Omnipay\Tests\TestCase;

class AbstractRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = Mockery::mock('\Omnipay\RentMoola\Message\AbstractRequest')->makePartial();
        $this->request->initialize();
    }

    public function testUserId()
    {
        $this->assertSame($this->request, $this->request->setUserId('abc123'));
        $this->assertSame('abc123', $this->request->getUserId());
    }

    public function testTransactionReference()
    {
        $this->assertSame($this->request, $this->request->setTransactionReference('abc123'));
        $this->assertSame('abc123', $this->request->getTransactionReference());
    }

    public function testDestinationAccountId()
    {
        $this->assertSame($this->request, $this->request->setDestinationAccountId('abc123'));
        $this->assertSame('abc123', $this->request->getDestinationAccountId());
    }

    public function testPaymentMethodId()
    {
        $this->assertSame($this->request, $this->request->setPaymentMethodId('abc123'));
        $this->assertSame('abc123', $this->request->getPaymentMethodId());
    }

    public function testCode()
    {
        $this->assertSame($this->request, $this->request->setCode('abc123'));
        $this->assertSame('abc123', $this->request->getCode());
    }

    public function testUserName()
    {
        $this->assertSame($this->request, $this->request->setUserName('abc123'));
        $this->assertSame('abc123', $this->request->getUserName());
    }

    public function testPassword()
    {
        $this->assertSame($this->request, $this->request->setPassword('abc123'));
        $this->assertSame('abc123', $this->request->getPassword());
    }
}
