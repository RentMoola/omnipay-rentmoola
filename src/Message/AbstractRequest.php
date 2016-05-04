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
    protected $testEndpoint = 'https://192.168.0.18:8443/api/v2';

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

    public function getData()
    {
        $this->validate('amount');
        $data = array();

        $data['userId'] = $this->getUserId();
        $data['destinationAccountId'] = $this->getDestinationAccountId();
        $data['charges'] = array();
        $data['charges']['amount'] =  $this->getAmount();
        $data['charges']['code'] =  $this->getCode();

        return $data;
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    protected function sendRequest($method, $action, $data = null)
    {
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
        });

        $url = $this->getEndpoint().$action;
        $body = $data ? http_build_query($data) : null;

        $httpRequest = $this->httpClient->createRequest($method, $url, null, $body);
        return $httpRequest->send();
    } 
}