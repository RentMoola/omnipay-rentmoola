<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
    protected $liveEndpoint = 'https://www.rentmoola.com/api/v2';
    protected $testEndpoint = 'https://sandbox.rentmoola.com/api/v2';

    public function isSuccessful()
    {
        return !isset($this->data['errorCode']);
    }

    public function getTransactionReference()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }

        return null;
    }

    public function getErrorCode()
    {
        if (isset($this->data['errorCode'])) {
            return $this->data['errorCode'];
        }

        return null;
    }

    public function getErrorMessage()
    {
        if (isset($this->data['message'])) {
            return $this->data['message'];
        }

        return null;
    }

    public function getStatus()
    {
        if (isset($this->data['status'])) {
            return $this->data['status'];
        }

        return null;
    }
}
