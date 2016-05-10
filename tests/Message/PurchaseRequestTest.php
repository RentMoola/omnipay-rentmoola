<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTests extends TestCase
{
    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'userId' => 'exUserId',
                'paymentMethodId' => 'exPaymentMethod',
                'destinationAccountId' => 'exDestinationAccountId',
                'amount' => '123.00',
                'code' => 'code.example',
            )
        );
    }

    public function testGetData()
    {
        $this->request->initialize(
            array(
                'userId' => 'exUserId',
                'paymentMethodId' => 'exPaymentMethod',
                'destinationAccountId' => 'exDestinationAccountId',
                'amount' => '123.00',
                'code' => 'code.example',
            )
        );

        $data = $this->request->getData();
        $this->assertSame('exUserId', $data['userId']);
        $this->assertSame('exPaymentMethod', $data['paymentMethodId']);
        $this->assertSame('exDestinationAccountId', $data['destinationAccountId']);
        $this->assertSame('123.00', $data['charges'][0]['amount']);
        $this->assertSame('code.example', $data['charges'][0]['code']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getErrorCode());
        $this->assertNull($response->getErrorMessage());
        $this->assertSame('COMPLETE', $response->getStatus());
        $this->assertSame("4ff053de-55d3-4930-82bf-154b0063208a", $response->getTransactionReference());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getStatus());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getDestinationAccountId());
        $this->assertNull($response->getUserId());
        $this->assertSame(616, $response->getErrorCode());
        $this->assertSame(
            'The payment method was not found.  Check the paymentMethodId provided.',
            $response->getErrorMessage()
        );
    }
}
