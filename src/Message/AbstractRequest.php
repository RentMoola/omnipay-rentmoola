<?php

namespace Omnipay\RentMoola\Message;

/**
 * Coinbase Abstract Request
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

    public function getAuthorizationValue()
    {
        return $this->getParameter('authorizationValue');
    }
    
    public function setAuthorizationValue($data)
    {
        return $this->setParameter('authorizationValue', $data);
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
            });

        $url = $this->getEndpoint() . $action;
        $body = json_encode($data);

        $httpRequest = $this->httpClient->createRequest($method, $url, null, $body);
        $httpRequest->setHeader('Content-type', 'application/json');
        $httpRequest->setHeader('Authorization', $this->getAuthorizationValue());

        return $httpRequest->send();
    }

}