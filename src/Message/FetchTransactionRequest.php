<?php

namespace Omnipay\RentMoola\Message;

class FetchTransactionRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionId');

        $data = array();
        $data['transactionId'] = $this->getTransactionId();

        return $data;
    }
}
