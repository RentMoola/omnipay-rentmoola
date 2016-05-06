<?php

namespace Omnipay\RentMoola\Message;

class FetchPaymentRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionId');

        $data = array();
        $data['transactionId'] = $this->getTransactionId();

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('GET',
            '/payments'.$this->getTransactionRefernce(),
            $data
        );

        return $this->response = new FetchPaymentRequest($this, $httpResponse->json());
    }
}
