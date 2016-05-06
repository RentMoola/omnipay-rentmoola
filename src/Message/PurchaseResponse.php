<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $liveEndpoint = 'https://www.rentmoola.com/api/v2';
    protected $testEndpoint = 'https://sandbox.rentmoola.com/api/v2';

    public function isSuccessful()
    {
        return !isset($this->data['errorCode']);
    }

    public function isRedirect()
    {
        return true;
    }

    public function getTransactionReference()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }
    }

    public function getErrorCode()
    {
        if (isset($this->data['errorCode'])) {
            return $this->data['errorCode'];
        }
    }

    public function getErrorMessage()
    {
        if (isset($this->data['message'])) {
            return $this->data['message'];
        }
    }

    public function getRedirectUrl()
    {
        if (isset($this->data['url'])) {
            return $this->data['url'];
        }
    }

    public function getStatus()
    {
        if (isset($this->data['status'])) {
            return $this->data['status'];
        }
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return array();
    }
}
