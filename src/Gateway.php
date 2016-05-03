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
            'userId' => ''
        );
    }

    public function getName()
    {
        return 'RentMoola';
    }

    public function getShortName()
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
    

    public function purchase(array $parameters = array())
    {
    }
}