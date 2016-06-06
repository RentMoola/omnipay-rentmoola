<?php

namespace Omnipay\RentMoola\Message;

class UpdateCCPaymentMethodRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('userId');
        $this->validate('paymentMethodId');

        $data = array();

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest(
            'PUT',
            '/users/'.$this->getUserId().'/payments/'.$this->getPaymentMethodId().'/cc',
            $data
        );

        if ($httpResponse->isSuccessful()) {
            return $this->response = new Response($this, json_decode('[]'));
        }
        return $this->response = new Response($this, $httpResponse->json());
    }
}
