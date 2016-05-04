<?php

namespace Omnipay\RentMoola\Message;

class PurchaseRequest extends AbstractRequest
{
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
        $httpResponse = $this->sendRequest('POST', '/payments', $data);
        
        return $this->response = new PurchaseResponse($this, $httpResponse->json());
    }
}
