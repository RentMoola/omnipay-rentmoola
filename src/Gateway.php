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
            'destinationAccountId' => '',
            'paymentMethodId' => '',
            'testMode' => 'false'
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

    /*
     * Calls to purchase requests/responses
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\RentMoola\Message\PurchaseRequest', $parameters);
    }
}