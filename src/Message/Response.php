<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
    protected $liveEndpoint = 'https://www.rentmoola.com/api/v2';
    protected $testEndpoint = 'https://sandbox.rentmoola.com/api/v2';

    public function isSuccessful()
    {
        if (isset($this->data['errorCode'])
            || isset($this->data['error'][0]['message'])
        ) {
            return false;
        }
        return true;
    }

    public function getTransactionReference()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }

        return null;
    }

    public function getAmount()
    {
        if (isset($this->data['total'])) {
            return $this->data['total'];
        }

        return null;
    }

    public function getDestinationAccountId()
    {
        if (isset($this->data['destinationAccountId'])) {
            return $this->data['destinationAccountId'];
        }

        return null;
    }

    public function getUserId()
    {
        if (isset($this->data['userId'])) {
            return $this->data['userId'];
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
        if (isset($this->data['error'][0]['message'])) {
            return $this->data['error'][0]['message'];
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
