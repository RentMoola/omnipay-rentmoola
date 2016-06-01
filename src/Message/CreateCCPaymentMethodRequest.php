<?php

namespace Omnipay\RentMoola\Message;

class CreateCCPaymentMethodRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('userId');
        $data = array();

        $data['name'] = $this->getName();
        $data['number'] = $this->getNumber();
        $data['cvc'] = $this->getCvc();
        $data['expiryYear'] = $this->getExpiryYear();
        $data['expiryMonth'] = $this->getExpiryMonth();
        $data['destinationAccountId'] = $this->getDestinationAccountId();
        $data['address']['state'] = $this->getState();
        $data['address']['country'] = $this->getCountry();
        $data['address']['city'] = $this->getCity();
        $data['address']['address1'] = $this->getAddress1();
        $data['address']['address2'] = $this->getAddress2();
        $data['address']['zip'] = $this->getZip();

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest(
            'POST',
            '/users/'.$this->getUserId().'/payment-methods/cc',
            $data
        );

        return $this->response = new Response($this, $httpResponse->json());
    }
}
