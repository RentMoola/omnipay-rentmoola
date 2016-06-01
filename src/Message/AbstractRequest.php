<?php

namespace Omnipay\RentMoola\Message;

/**
 * RentMoola Abstract Request
 *
 * @method \Omnipay\RentMoola\Message\Response send()
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://rentmoola.com/api/v2';
    protected $testEndpoint = 'https://sandbox.rentmoola.com/api/v2';

    public function getUserId()
    {
        return $this->getParameter('userId');
    }

    public function setUserId($data)
    {
        return $this->setParameter('userId', $data);
    }

    public function getFirstName()
    {
        return $this->getParameter('firstname');
    }

    public function setFirstName($data)
    {
        return $this->setParameter('firstname', $data);
    }

    public function getLastName()
    {
        return $this->getParameter('lastname');
    }

    public function setLastName($data)
    {
        return $this->setParameter('lastname', $data);
    }

    public function getName()
    {
        return $this->getParameter('name');
    }

    public function setName($data)
    {
        return $this->setParameter('name', $data);
    }

    public function getNumber()
    {
        return $this->getParameter('number');
    }

    public function setNumber($data)
    {
        return $this->setParameter('number', $data);
    }

    public function getCvc()
    {
        return $this->getParameter('cvc');
    }

    public function setCvc($data)
    {
        return $this->setParameter('cvc', $data);
    }

    public function getExpiryYear()
    {
        return $this->getParameter('expiryYear');
    }

    public function setExpiryYear($data)
    {
        return $this->setParameter('expiryYear', $data);
    }

    public function getExpiryMonth()
    {
        return $this->getParameter('expiryMonth');
    }

    public function setExpiryMonth($data)
    {
        return $this->setParameter('expiryMonth', $data);
    }

    public function getAddress1()
    {
        return $this->getParameter('address1');
    }

    public function setAddress1($data)
    {
        return $this->setParameter('address1', $data);
    }

    public function getAddress2()
    {
        return $this->getParameter('address2');
    }

    public function setAddress2($data)
    {
        return $this->setParameter('address2', $data);
    }

    public function getZip()
    {
        return $this->getParameter('zip');
    }

    public function setZip($data)
    {
        return $this->setParameter('zip', $data);
    }

    public function getCity()
    {
        return $this->getParameter('city');
    }

    public function setCity($data)
    {
        return $this->setParameter('city', $data);
    }

    public function getCountry()
    {
        return $this->getParameter('country');
    }

    public function setCountry($data)
    {
        return $this->setParameter('country', $data);
    }

    public function getState()
    {
        return $this->getParameter('state');
    }

    public function setState($data)
    {
        return $this->setParameter('state', $data);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($data)
    {
        return $this->setParameter('email', $data);
    }

    public function getPropertyId()
    {
        return $this->getParameter('propertyId');
    }

    public function setPropertyId($data)
    {
        return $this->setParameter('propertyId', $data);
    }

    public function getSuite()
    {
        return $this->getParameter('suite');
    }

    public function setSuite($data)
    {
        return $this->setParameter('suite', $data);
    }

    public function getPrimaryPaymentMethodId()
    {
        return $this->getParameter('primaryPaymentMethodId');
    }

    public function setPrimaryPaymentMethodId($data)
    {
        return $this->setParameter('primaryPaymentMethodId', $data);
    }

    public function setTransactionReference($data)
    {
        return $this->setParameter('transactionReference', $data);
    }

    public function getTransactionReference()
    {
        return $this->getParameter('transactionReference');
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

    public function getCode()
    {
        return $this->getParameter('code');
    }

    public function setCode($data)
    {
        return $this->setParameter('code', $data);
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function getUserName()
    {
        return $this->getParameter('userName');
    }

    public function setUserName($data)
    {
        return $this->setParameter('userName', $data);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($data)
    {
        return $this->setParameter('password', $data);
    }

    /**
     * Uses the api username and password to return the authorization value
     * required the the http request header
     * @return mixed
     */
    public function getAuthorizationValue()
    {
        return 'Basic '.base64_encode($this->getUserName().":".$this->getPassword());
    }

    protected function sendRequest($method, $action, $data = null)
    {
        /*
         * Don't throw exceptions on 4xx errors
         */
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        $url = $this->getEndpoint() . $action;
        // If the body is null, don't send an string representation of an
        // empty json object
        $body = $data;
        if ($data) {
            $body = json_encode($data);
        }

        $httpRequest = $this->httpClient->createRequest($method, $url, null, $body);
        $httpRequest->setHeader('Content-type', 'application/json');
        $httpRequest->setHeader('Authorization', $this->getAuthorizationValue());

        return $httpRequest->send();
    }
}
