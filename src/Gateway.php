<?php

namespace Omnipay\RentMoola;

use Omnipay\Common\AbstractGateway;

/**
 * RentMoola Gateway
 *
 * @link https://rentmoola.com/api/docs
 */
class Gateway extends AbstractGateway
{
    public function getDefaultParameters()
    {
        return array(
            'userId' => '',
            'username' => '',
            'password' => '',
            'destinationAccountId' => '',
            'paymentMethodId' => '',
            'code' => '',
            'testMode' => false
        );
    }

    public function getName()
    {
        return 'RentMoola';
    }

    /*
     * Getters and Setters
     */
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

    /*
     * Calls to purchase requests/responses
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest(
            '\Omnipay\RentMoola\Message\PurchaseRequest',
            $parameters
        );
    }

    public function createUser(array $parameters = array())
    {
        return $this->createRequest(
            '\Omnipay\RentMoola\Message\CreateUserRequest',
            $parameters
        );
    }

    public function createCCPaymentMethod(array $parameters = array())
    {
        return $this->createRequest(
            '\Omnipay\RentMoola\Message\CreateCCPaymentMethodRequest',
            $parameters
        );
    }

    public function fetchUser(array $parameters = array())
    {
        return $this->createRequest(
            '\Omnipay\RentMoola\Message\FetchUserRequest',
            $parameters
        );
    }

    public function fetchPayment(array $parameters = array())
    {
        return $this->createRequest(
            '\Omnipay\RentMoola\Message\FetchPaymentRequest',
            $parameters
        );
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest(
            '\Omnipay\RentMoola\Message\RefundRequest',
            $parameters
        );
    }
}
