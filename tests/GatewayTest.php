<?php

namespace Omnipay\RentMoola;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );
        $this->gateway->setTestMode(true);
        $this->options = array(
            "userId" => "24a58d3c-4774-48bb-803a-b0ccc6b2d8d5",
            "paymentMethodId" => "c4ec7ad4-5b20-456a-8ab5-5ad5c2300a17",
            "destinationAccountId" => "23535718-e3a9-4b13-a28c-85f0838083b1",
            "code" => "global.payments.other",
            "amount" => '10.00',
            "username" => '32b53506-d3b2-405a-8c83-9b5c82b67575',
            "password" => 'test',
        );
    }

    public function testCreateUser()
    {
        $this->gateway->setFirstName("firstname");
        $this->gateway->setLastName("lastname");
        $this->gateway->setEmail("email@email.com");
        $this->gateway->setPropertyId("12345678");
        $this->gateway->setPrimaryPaymentMethodId("23456789");
        $this->gateway->setSuite("5");

        $this->assertSame($this->gateway->getFirstName(), "firstname");
        $this->assertSame($this->gateway->getLastName(), "lastname");
        $this->assertSame($this->gateway->getEmail(), "email@email.com");
        $this->assertSame($this->gateway->getPropertyId(), "12345678");
        $this->assertSame($this->gateway->getPrimaryPaymentMethodId(), "23456789");
        $this->assertSame($this->gateway->getSuite(), "5");

        $request = $this->gateway->createUser();

        $this->assertInstanceOf(
            'Omnipay\RentMoola\Message\CreateUserRequest',
            $request
        );

        $this->assertSame($request->getFirstName(), "firstname");
        $this->assertSame($request->getLastName(), "lastname");
        $this->assertSame($request->getEmail(), "email@email.com");
        $this->assertSame($request->getPropertyId(), "12345678");
        $this->assertSame($request->getPrimaryPaymentMethodId(), "23456789");
        $this->assertSame($request->getSuite(), "5");
    }

    public function testFetchUser()
    {
        $this->options = array(
            "userId" => '0ff7ba61-1560-4d10-a1de-1b0edf29852f'
        );

        $request = $this->gateway->fetchUser($this->options);

        $this->assertInstanceOf(
            'Omnipay\RentMoola\Message\FetchUserRequest',
            $request
        );
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase($this->options);

        $this->assertInstanceOf(
            'Omnipay\RentMoola\Message\PurchaseRequest',
            $request
        );
        $this->assertSame($request->getAmount(), '10.00');
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     */
    public function testPurchaseInvalidAmount()
    {
        $this->options['amount'] = '';

        $request = $this->gateway->purchase($this->options);
        $this->assertEmpty($request->getAmount());
    }

    public function testCreateCCPaymentMethodRequest()
    {
        $request = $this->gateway->createCCPaymentMethod();

        $this->assertInstanceOf(
            'Omnipay\RentMoola\Message\CreateCCPaymentMethodRequest',
            $request
        );
    }

    public function testFetchPayment()
    {
        $request = $this->gateway->fetchPayment();

        $this->assertInstanceOf(
            'Omnipay\RentMoola\Message\FetchPaymentRequest',
            $request
        );
    }

    public function testRefund()
    {
        $request = $this->gateway->refund($this->options);

        $this->assertInstanceOf(
            'Omnipay\RentMoola\Message\RefundRequest',
            $request
        );
    }

    public function testAuthorizationValue()
    {
        $this->gateway->setUserName("username");
        $this->gateway->setPassword("password");

        $this->assertSame('Basic dXNlcm5hbWU6cGFzc3dvcmQ=', $this->gateway->getAuthorizationValue());
    }

    public function testTransactionReference()
    {
        $this->assertSame($this->gateway, $this->gateway->setTransactionReference('abc123'));
        $this->assertSame('abc123', $this->gateway->getTransactionReference());
    }
}
