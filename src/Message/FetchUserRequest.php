<?php

namespace Omnipay\RentMoola\Message;

class FetchUserRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('userId');

        $data = array();
        $data['userId'] = $this->getUserId();

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest(
            'GET',
            '/users/'.$this->getUserId(),
            null
        );

        return $this->response = new Response($this, $httpResponse->json());
    }
}
