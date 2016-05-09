<?php

namespace Omnipay\RentMoola\Message;

class RefundRequest extends AbstractRequest
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
        $httpResponse = $this->sendRequest('POST',
            '/payments/'.$this->getTransactionReference().'/refund',
            $data
        );

        return $this->response = new Response($this, $httpResponse->json());
    }
}
