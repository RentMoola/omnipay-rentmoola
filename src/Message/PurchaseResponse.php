<?php

namespace Omnipay\RentMoola\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * When you do a 'purchase' the request is never successful
     * because you need to redirect off-site to complete the purchase.
     */
    public function isSuccessful()
    {
        return false;
    }
    
    public function isRedirect()
    {
        return true;
    }
    
    public function getRedirectUrl()
    {
        return $this->getRequest()->getEndpoint().'?'.http_build_query($this->data);
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }
    
    public function getRedirectData()
    {
        return null;
    }
}