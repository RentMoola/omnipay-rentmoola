<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Tests\TestCase;
use Omnipay\RentMoola;

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
}