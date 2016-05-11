<?php

namespace Omnipay\RentMoola\Message;

class FetchPaymentRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionReference');

        $data = array();
        $data['transactionReference'] = $this->getTransactionReference();

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest(
            'GET',
            '/payments/'.$this->getTransactionReference(),
            null
        );

        return $this->response = new Response($this, $httpResponse->json());
    }
}
