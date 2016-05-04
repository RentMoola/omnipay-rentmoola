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
        return false;
    }
    
    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        $endpoint = $this->getRequest()->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
        return $endpoint.'?'.http_build_query($this->data);
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