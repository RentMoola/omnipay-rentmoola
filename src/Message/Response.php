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

    public function getPaymentMethodList()
    {
        if (isset($this->data[0]['id'])) {
            $cardList = array();
            foreach ($this->data as $card) {
                $newCard = array();
                $newCard['id'] = $card['id'];
                $newCard['type'] = $card['type'];
                array_push($cardList, $newCard);
            }

            return $cardList;
        }

        return null;
    }

    public function getBrand()
    {
        if (isset($this->data['brand'])) {
            return $this->data['brand'];
        }

        return null;
    }

    public function getPaymentMethodType()
    {
        if (isset($this->data['type'])) {
            return $this->data['type'];
        }

        return null;
    }

    public function getNumber()
    {
        if (isset($this->data['number'])) {
            return $this->data['number'];
        }

        return null;
    }

    public function getTransactionReference()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }

        return null;
    }

    public function getCardReference()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }

        return null;
    }

    public function getExpiryYear()
    {
        if (isset($this->data['expiryYear'])) {
            return $this->data['expiryYear'];
        }

        return null;
    }

    public function getExpiryMonth()
    {
        if (isset($this->data['expiryMonth'])) {
            return $this->data['expiryMonth'];
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

    public function getId()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }

        return null;
    }

    public function getFirstName()
    {
        if (isset($this->data['firstname'])) {
            return $this->data['firstname'];
        }

        return null;
    }

    public function getLastName()
    {
        if (isset($this->data['lastname'])) {
            return $this->data['lastname'];
        }

        return null;
    }

    public function getEmail()
    {
        if (isset($this->data['email'])) {
            return $this->data['email'];
        }

        return null;
    }

    public function getSuite()
    {
        if (isset($this->data['suite'])) {
            return $this->data['suite'];
        }

        return null;
    }

    public function getPropertyId()
    {
        if (isset($this->data['propertyId'])) {
            return $this->data['propertyId'];
        }

        return null;
    }

    public function getPrimaryPaymentMethodId()
    {
        if (isset($this->data['primaryPaymentMethodId'])) {
            return $this->data['primaryPaymentMethodId'];
        }

        return null;
    }
}
