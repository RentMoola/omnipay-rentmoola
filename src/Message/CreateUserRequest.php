<?php

namespace Omnipay\RentMoola\Message;

class CreateUserRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('firstname', 'lastname', 'email');
        $data = array();

        $data['firstname'] = $this->getFirstName();
        $data['lastname'] = $this->getLastName();
        $data['email'] = $this->getEmail();
        $data['propertyId'] = $this->getPropertyId();
        $data['suite'] = $this->getSuite();
        $data['primaryPaymentMethodId'] = $this->getPrimaryPaymentMethodId();

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('POST', '/users', $data);

        return $this->response = new Response($this, $httpResponse->json());
    }
}
