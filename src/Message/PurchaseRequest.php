<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    //TODO get endpoints
    protected $liveEndpoint = 'https://example.com';
    protected $testEndpoint = 'https://test.example.com';
    
    public function getUserId()
    {
        return $this->getParameter('userId');
    }
    
    public function setUserId($data)
    {
        return $this->setParameter('userId', $data);
    }

    public function getDestinationAccountId()
    {
        return $this->getParameter('destinationAccountId');
    }

    public function setDestinationAccountId($data)
    {
        return $this->setParameter('destinationAccountId', $data);
    }

    public function getPaymentMethodId()
    {
        return $this->getParameter('paymentMethodId');
    }

    public function setPaymentMethodId($data)
    {
        return $this->setParameter('paymentMethodId', $data);
    }
    
    public function getCode()
    {
        return $this->getParameter('code');
    }

    public function setCode($data)
    {
        return $this->setParameter('code', $data);
    }
    
    public function getData()
    {
        $this->validate('amount');
        $data = array();
        
        $data['userId'] = $this->getUserId();
        $data['paymentMethodId'] = $this->getPaymentMethodId();
        $data['destinationAccountId'] = $this->getDestinationAccountId();
        $data['charges'] = array();
        $data['charges']['amount'] =  $this->getAmount();
        $data['charges']['code'] =  $this->getCode();
        
        return $data;
    }
    
    public function sendData($data)
    {
        //TODO Look at different implementations (passing request type here?)
        return $this->response = new PurchaseResponse($this, $data);
    }
    
    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
