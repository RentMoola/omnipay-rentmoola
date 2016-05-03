<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    
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
    
    public function getData()
    {
        // TODO: Implement getData() method.
    }
    
    public function sendData($data)
    {
        // TODO: Implement sendData() method.
    }
}
