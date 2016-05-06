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

    public function getTransactionId()
    {
        return $this->getParameter('transactionId');
    }

    public function setTransactionId($data)
    {
        return $this->setParameter('transactionId');
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

    public function getAuthorizationValue()
    {
        return $this->getParameter('authorizationValue');
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

    public function fetchPayment()
    {
        return $this->createRequest(
            '\Omnipay\RentMoola\Message\FetchPaymentRequest',
            $parameters
        );
    }
}
