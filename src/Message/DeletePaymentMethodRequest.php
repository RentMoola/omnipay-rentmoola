<?php

namespace Omnipay\RentMoola\Message;

class DeletePaymentMethodRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('userId', 'paymentMethodId');

        $data = array();
        $data['paymentMethodId'] = $this->getPaymentMethodId();
        $data['userId'] = $this->getUserId();

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest(
            'DELETE',
            '/users/'.$this->getUserId().'/payment-methods/'.$this->getPaymentMethodId(),
            null
        );

        json_decode($httpResponse);
        if ($httpResponse->getStatusCode() == 200) {
            return $this->response = new Response($this, '[]');
        }
        return $this->response = new Response($this, $httpResponse->json());
    }
}